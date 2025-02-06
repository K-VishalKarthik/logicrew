<?php
session_start();
include('../includes/config.php');
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../user/dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
<!-- Bootstrap CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Admin Dashboard</h2>
    <h3>Manage Users</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM users";
            $result = $conn->query($sql);

            while ($user = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$user['username']}</td>
                        <td>{$user['email']}</td>
                        <td>{$user['role']}</td>
                        <td>
                            <a href='edit-user.php?id={$user['id']}' class='btn btn-warning'>Edit</a>
                            <a href='delete-user.php?id={$user['id']}' class='btn btn-danger'>Delete</a>
                        </td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
