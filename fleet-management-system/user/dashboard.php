<?php
session_start();
include('../includes/config.php');
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">
    <h2>Welcome, User</h2>
    <a href="vehicle.php" class="btn btn-primary">Add Vehicle</a>
    <a href="profile.php" class="btn btn-secondary">Profile</a>
    <hr>

    <h3>Your Vehicles</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Make</th>
                <th>Model</th>
                <th>Registration</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $user_id = $_SESSION['user_id'];
            $sql = "SELECT * FROM vehicles WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($vehicle = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$vehicle['make']}</td>
                        <td>{$vehicle['model']}</td>
                        <td>{$vehicle['registration_number']}</td>
                        <td>{$vehicle['status']}</td>
                        <td>
                            <a href='edit-vehicle.php?id={$vehicle['id']}' class='btn btn-warning'>Edit</a>
                            <a href='delete-vehicle.php?id={$vehicle['id']}' class='btn btn-danger'>Delete</a>
                        </td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
