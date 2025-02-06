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
    <style>
        body {
            background-color: #f4f7fc;
        }
        .container {
            max-width: 1200px;
        }
        .card-header {
            background-color: #007bff;
            color: white;
        }
        .btn {
            border-radius: 20px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header text-center">
            <h2>Admin Dashboard</h2>
            <p class="mb-0">Manage Users</p>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
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
                                    <a href='edit-user.php?id={$user['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='delete-user.php?id={$user['id']}' class='btn btn-danger btn-sm'>Delete</a>
                                </td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap JS and Popper -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
