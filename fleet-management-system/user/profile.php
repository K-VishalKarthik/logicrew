<?php
session_start();
include('../includes/config.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$user_result = $stmt->get_result();
$user = $user_result->fetch_assoc();

// Fetch vehicle details associated with user
$sql_vehicles = "SELECT * FROM vehicles WHERE user_id = ?";
$stmt_vehicles = $conn->prepare($sql_vehicles);
$stmt_vehicles->bind_param('i', $user_id);
$stmt_vehicles->execute();
$vehicles_result = $stmt_vehicles->get_result();

// Fetch admin updates (e.g., vehicle status changes, admin notes)
$sql_updates = "SELECT * FROM admin_updates WHERE user_id = ?";
$stmt_updates = $conn->prepare($sql_updates);
$stmt_updates->bind_param('i', $user_id);
$stmt_updates->execute();
$updates_result = $stmt_updates->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Fleet Management</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="vehicle.php">Add Vehicle</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Profile Section -->
<div class="container mt-5">
    <h2>User Profile</h2>
    <hr>

    <!-- User Details -->
    <h4>Your Details</h4>
    <form action="update_profile.php" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>

    <!-- Vehicle Details -->
    <h4 class="mt-5">Your Vehicles</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Make</th>
                <th>Model</th>
                <th>Registration Number</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($vehicle = $vehicles_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($vehicle['make']); ?></td>
                    <td><?php echo htmlspecialchars($vehicle['model']); ?></td>
                    <td><?php echo htmlspecialchars($vehicle['registration_number']); ?></td>
                    <td><?php echo htmlspecialchars($vehicle['status']); ?></td>
                    <td>
                        <a href="edit_vehicle.php?id=<?php echo $vehicle['id']; ?>" class="btn btn-warning">Edit</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Admin Updates -->
    <h4 class="mt-5">Admin Updates</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Update</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($update = $updates_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($update['update_text']); ?></td>
                    <td><?php echo htmlspecialchars($update['date']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Footer -->
<footer class="bg-primary text-white text-center py-3 mt-5">
    <p>&copy; 2025 Fleet Management System. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
