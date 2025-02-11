
<?php
session_start();
include('../includes/config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['id'])) {
    $vehicle_id = $_GET['id'];

    // Fetch vehicle details
    $sql = "SELECT * FROM vehicles WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $vehicle_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $vehicle = $result->fetch_assoc();
    } else {
        echo "Vehicle not found.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $make = $_POST['make'];
    $model = $_POST['model'];
    $registration_number = $_POST['registration_number'];
    $status = $_POST['status'];

    $update_sql = "UPDATE vehicles SET make=?, model=?, registration_number=?, status=? WHERE id=? AND user_id=?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param('ssssii', $make, $model, $registration_number, $status, $vehicle_id, $user_id);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Error updating vehicle.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Vehicle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Edit Vehicle</h2>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Make</label>
            <input type="text" class="form-control" name="make" value="<?php echo htmlspecialchars($vehicle['make']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Model</label>
            <input type="text" class="form-control" name="model" value="<?php echo htmlspecialchars($vehicle['model']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Registration Number</label>
            <input type="text" class="form-control" name="registration_number" value="<?php echo htmlspecialchars($vehicle['registration_number']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select class="form-control" name="status">
                <option value="Active" <?php echo ($vehicle['status'] == 'Active') ? 'selected' : ''; ?>>Active</option>
                <option value="Inactive" <?php echo ($vehicle['status'] == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Vehicle</button>
        <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

</body>
</html>
