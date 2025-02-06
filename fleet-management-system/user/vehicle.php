<?php
session_start();
include('../includes/config.php');
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (isset($_POST['add_vehicle'])) {
    $user_id = $_SESSION['user_id'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $registration_number = $_POST['registration_number'];
    $status = $_POST['status'];

    $sql = "INSERT INTO vehicles (user_id, make, model, registration_number, status) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('issss', $user_id, $make, $model, $registration_number, $status);

    if ($stmt->execute()) {
        header('Location: dashboard.php');
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!-- HTML Form -->
<form method="POST">
    <input type="text" name="make" placeholder="Make" required>
    <input type="text" name="model" placeholder="Model" required>
    <input type="text" name="registration_number" placeholder="Registration Number" required>
    <select name="status">
        <option value="available">Available</option>
        <option value="under maintenance">Under Maintenance</option>
        <option value="in use">In Use</option>
    </select>
    <button type="submit" name="add_vehicle">Add Vehicle</button>
</form>
