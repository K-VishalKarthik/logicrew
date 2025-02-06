<?php
session_start();
include('../includes/config.php');

// Ensure the user is an admin
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

// Fetch vehicles
$sql = "SELECT * FROM vehicles";
$result = $conn->query($sql);

// Add a new vehicle
if (isset($_POST['add_vehicle'])) {
    $make = $_POST['make'];
    $model = $_POST['model'];
    $registration_number = $_POST['registration_number'];
    $status = $_POST['status'];

    $sql = "INSERT INTO vehicles (make, model, registration_number, status)
    VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $make, $model, $registration_number, $status);
    $stmt->execute();
    header("Location: dashboard.php"); // Refresh page
}

// Update vehicle
if (isset($_POST['edit_vehicle'])) {
    $id = $_POST['id'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $registration_number = $_POST['registration_number'];
    $status = $_POST['status'];

    $sql = "UPDATE vehicles SET make = ?, model = ?, registration_number = ?, status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssi', $make, $model, $registration_number, $status, $id);
    $stmt->execute();
    header("Location: dashboard.php");
}

// Delete vehicle
if (isset($_GET['delete_vehicle'])) {
    $id = $_GET['delete_vehicle'];
    $sql = "DELETE FROM vehicles WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
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
<style>
.container {
    margin-top: 50px;
}
.btn {
    margin-bottom: 20px;
}
</style>
</head>
<body>
<div class="container">
<h2>Admin Dashboard</h2>
<a href="../user/logout.php" class="btn btn-danger">Logout</a>


<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addVehicleModal">Add New Vehicle</button>

<!-- Vehicle Table -->
<table class="table table-bordered">
<thead>
<tr>
<th>#</th>
<th>Make</th>
<th>Model</th>
<th>Registration Number</th>
<th>Status</th>
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
<td>
<a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editVehicleModal"
data-id="<?php echo $vehicle['id']; ?>"
data-make="<?php echo $vehicle['make']; ?>"
data-model="<?php echo $vehicle['model']; ?>"
data-registration_number="<?php echo $vehicle['registration_number']; ?>"
data-status="<?php echo $vehicle['status']; ?>">Edit</a>
<a href="?delete_vehicle=<?php echo $vehicle['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>

<!-- Add Vehicle Modal -->
<div class="modal fade" id="addVehicleModal" tabindex="-1" aria-labelledby="addVehicleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<form method="POST">
<div class="modal-header">
<h5 class="modal-title" id="addVehicleModalLabel">Add New Vehicle</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<div class="mb-3">
<label for="make" class="form-label">Make</label>
<input type="text" class="form-control" id="make" name="make" required>
</div>
<div class="mb-3">
<label for="model" class="form-label">Model</label>
<input type="text" class="form-control" id="model" name="model" required>
</div>
<div class="mb-3">
<label for="registration_number" class="form-label">Registration Number</label>
<input type="text" class="form-control" id="registration_number" name="registration_number" required>
</div>
<div class="mb-3">
<label for="status" class="form-label">Status</label>
<select class="form-control" id="status" name="status">
<option value="Available">Available</option>
<option value="Under Maintenance">Under Maintenance</option>
<option value="Booked">Booked</option>
</select>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<button type="submit" name="add_vehicle" class="btn btn-primary">Add Vehicle</button>
</div>
</form>
</div>
</div>
</div>

<!-- Edit Vehicle Modal -->
<div class="modal fade" id="editVehicleModal" tabindex="-1" aria-labelledby="editVehicleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<form method="POST">
<div class="modal-header">
<h5 class="modal-title" id="editVehicleModalLabel">Edit Vehicle</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<input type="hidden" id="vehicle_id" name="id">
<div class="mb-3">
<label for="edit_make" class="form-label">Make</label>
<input type="text" class="form-control" id="edit_make" name="make" required>
</div>
<div class="mb-3">
<label for="edit_model" class="form-label">Model</label>
<input type="text" class="form-control" id="edit_model" name="model" required>
</div>
<div class="mb-3">
<label for="edit_registration_number" class="form-label">Registration Number</label>
<input type="text" class="form-control" id="edit_registration_number" name="registration_number" required>
</div>
<div class="mb-3">
<label for="edit_status" class="form-label">Status</label>
<select class="form-control" id="edit_status" name="status">
<option value="Available">Available</option>
<option value="Under Maintenance">Under Maintenance</option>
<option value="Booked">Booked</option>
</select>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<button type="submit" name="edit_vehicle" class="btn btn-primary">Update Vehicle</button>
</div>
</form>
</div>
</div>
</div>

<!-- Bootstrap JS and Dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<script>
// Pass data to edit modal
var editVehicleModal = document.getElementById('editVehicleModal');
editVehicleModal.addEventListener('show.bs.modal', function(event) {
    var button = event.relatedTarget;
    var id = button.getAttribute('data-id');
    var make = button.getAttribute('data-make');
    var model = button.getAttribute('data-model');
    var registration_number = button.getAttribute('data-registration_number');
    var status = button.getAttribute('data-status');

    var modal = editVehicleModal.querySelector('form');
    modal.querySelector('#vehicle_id').value = id;
    modal.querySelector('#edit_make').value = make;
    modal.querySelector('#edit_model').value = model;
    modal.querySelector('#edit_registration_number').value = registration_number;
    modal.querySelector('#edit_status').value = status;
});
</script>
</body>
</html>
