<?php
session_start();
include('../includes/config.php');

// Redirect to login if user is not authenticated
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'] ?? 'User';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
<div class="d-flex justify-content-between align-items-center">
<h2>Welcome, <?php echo htmlspecialchars($username); ?></h2>
<a href="logout.php" class="btn btn-danger">Logout</a>
</div>

<a href="vehicle.php" class="btn btn-primary mt-3">Add Vehicle</a>
<a href="profile.php" class="btn btn-secondary mt-3">Profile</a>
<a href="add-driver.php" class="btn btn-success mt-3">Add Driver</a> <!-- ✅ Add Driver Button -->
<hr>

<!-- 🚗 VEHICLES TABLE -->
<h3>Your Vehicles</h3>
<table class="table table-bordered table-striped">
<thead class="table-dark">
<tr>
<th>Make</th>
<th>Model</th>
<th>Registration</th>
<th>Status</th>
<th>Driver</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
// Fetch vehicles with assigned driver
$sql = "SELECT v.*, d.name AS driver_name FROM vehicles v
LEFT JOIN drivers d ON v.driver_id = d.id
WHERE v.user_id = ?";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($vehicle = $result->fetch_assoc()) {
        echo "<tr>
        <td>" . htmlspecialchars($vehicle['make']) . "</td>
        <td>" . htmlspecialchars($vehicle['model']) . "</td>
        <td>" . htmlspecialchars($vehicle['registration_number']) . "</td>
        <td>" . htmlspecialchars($vehicle['status']) . "</td>
        <td>" . htmlspecialchars($vehicle['driver_name'] ?? 'No Driver') . "</td>
        <td>
        <a href='edit-vehicle.php?id=" . $vehicle['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
        <a href='delete-vehicle.php?id=" . $vehicle['id'] . "' class='btn btn-danger btn-sm'
        onclick=\"return confirm('Are you sure you want to delete this vehicle?');\">Delete</a>
        </td>
        </tr>";
    }
    $stmt->close();
} else {
    echo "<tr><td colspan='6' class='text-danger'>Error loading vehicles.</td></tr>";
}
?>
</tbody>
</table>

<!-- 🚚 DRIVERS TABLE -->
<h3 class="mt-5">All Drivers</h3>
<table class="table table-bordered table-striped">
<thead class="table-dark">
<tr>
<th>Name</th>
<th>Phone</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
// Fetch all drivers (since drivers are not directly linked to users)
$sql = "SELECT * FROM drivers";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->execute();
    $result = $stmt->get_result();

    while ($driver = $result->fetch_assoc()) {
        echo "<tr>
        <td>" . htmlspecialchars($driver['name']) . "</td>
        <td>" . htmlspecialchars($driver['phone']) . "</td>
        <td>
        <a href='edit-driver.php?id=" . $driver['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
        <a href='delete-driver.php?id=" . $driver['id'] . "' class='btn btn-danger btn-sm'
        onclick=\"return confirm('Are you sure you want to delete this driver?');\">Delete</a>
        </td>
        </tr>";
    }
    $stmt->close();
} else {
    echo "<tr><td colspan='3' class='text-danger'>Error loading drivers.</td></tr>";
}
?>
</tbody>
</table>
</div>

</body>
</html>
