<?php
session_start();
include('../includes/config.php');

// Ensure the user is an admin
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

// Fetch vehicles with driver details
$sql = "SELECT vehicles.*, drivers.name AS driver_name FROM vehicles
LEFT JOIN drivers ON vehicles.driver_id = drivers.id";
$result = $conn->query($sql);

// Fetch drivers for dropdown selection
$drivers = $conn->query("SELECT * FROM drivers");

// Assign driver to vehicle
if (isset($_POST['assign_driver'])) {
    $vehicle_id = $_POST['vehicle_id'];
    $driver_id = $_POST['driver_id'];
    $sql = "UPDATE vehicles SET driver_id = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $driver_id, $vehicle_id);
    $stmt->execute();
    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard | Fleet Management</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
<h2>Admin Dashboard</h2>
<a href="../user/logout.php" class="btn btn-danger">Logout</a>

<!-- Vehicle Table -->
<table class="table table-bordered mt-3">
<thead>
<tr>
<th>#</th>
<th>Make</th>
<th>Model</th>
<th>Registration Number</th>
<th>Status</th>
<th>Assigned Driver</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php while ($vehicle = $result->fetch_assoc()): ?>
<tr>
<td><?php echo $vehicle['id']; ?></td>
<td><?php echo $vehicle['make']; ?></td>
<td><?php echo $vehicle['model']; ?></td>
<td><?php echo $vehicle['registration_number']; ?></td>
<td><?php echo $vehicle['status']; ?></td>
<td><?php echo $vehicle['driver_name'] ? $vehicle['driver_name'] : 'Not Assigned'; ?></td>
<td>
<button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#assignDriverModal"
data-id="<?php echo $vehicle['id']; ?>">Assign Driver</button>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>

<!-- Assign Driver Modal -->
<div class="modal fade" id="assignDriverModal" tabindex="-1" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<form method="POST">
<div class="modal-header">
<h5 class="modal-title">Assign Driver</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<input type="hidden" id="vehicle_id" name="vehicle_id">
<div class="mb-3">
<label for="driver_id" class="form-label">Select Driver</label>
<select class="form-control" id="driver_id" name="driver_id">
<?php while ($driver = $drivers->fetch_assoc()): ?>
<option value="<?php echo $driver['id']; ?>"><?php echo $driver['name']; ?></option>
<?php endwhile; ?>
</select>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<button type="submit" name="assign_driver" class="btn btn-primary">Assign</button>
</div>
</form>
</div>
</div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script>
var assignDriverModal = document.getElementById('assignDriverModal');
assignDriverModal.addEventListener('show.bs.modal', function(event) {
    var button = event.relatedTarget;
    var vehicle_id = button.getAttribute('data-id');
    var modal = assignDriverModal.querySelector('form');
    modal.querySelector('#vehicle_id').value = vehicle_id;
});
</script>
</body>
</html>
