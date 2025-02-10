<?php
session_start();
include('../includes/config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Check if vehicle ID is provided
if (isset($_GET['id'])) {
    $vehicle_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Ensure the vehicle belongs to the logged-in user
    $check_sql = "SELECT * FROM vehicles WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param('ii', $vehicle_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If vehicle exists and belongs to user, delete it
        $delete_sql = "DELETE FROM vehicles WHERE id = ?";
        $stmt = $conn->prepare($delete_sql);
        $stmt->bind_param('i', $vehicle_id);
        if ($stmt->execute()) {
            header("Location: dashboard.php?message=Vehicle deleted successfully");
            exit;
        } else {
            header("Location: dashboard.php?error=Error deleting vehicle");
            exit;
        }
    } else {
        header("Location: dashboard.php?error=Unauthorized action");
        exit;
    }
} else {
    header("Location: dashboard.php?error=Invalid request");
    exit;
}
?>
