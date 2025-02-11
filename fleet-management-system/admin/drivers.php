<?php
session_start();
include('../includes/config.php');

if ($_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

// Fetch all drivers
$sql = "SELECT * FROM drivers";
$result = $conn->query($sql);

// Add driver
if (isset($_POST['add_driver'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    $stmt = $conn->prepare("INSERT INTO drivers (name, phone) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $phone);
    if ($stmt->execute()) {
        header("Location: drivers.php?message=Driver added successfully");
        exit;
    } else {
        header("Location: drivers.php?error=Error adding driver");
        exit;
    }
}

// Delete driver
if (isset($_GET['delete_driver'])) {
    $id = $_GET['delete_driver'];
    $stmt = $conn->prepare("DELETE FROM drivers WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: drivers.php?message=Driver deleted successfully");
        exit;
    } else {
        header("Location: drivers.php?error=Error deleting driver");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Drivers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Manage Drivers</h2>
    <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDriverModal">Add Driver</button>
    <hr>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($driver = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $driver['id']; ?></td>
                <td><?php echo $driver['name']; ?></td>
                <td><?php echo $driver['phone']; ?></td>
                <td>
                    <a href="?delete_driver=<?php echo $driver['id']; ?>" class="btn btn-danger" onclick="return confirm('Delete this driver?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Add Driver Modal -->
<div class="modal fade" id="addDriverModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Add Driver</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="add_driver" class="btn btn-primary">Add Driver</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
