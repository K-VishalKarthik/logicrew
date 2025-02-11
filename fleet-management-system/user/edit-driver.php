<?php
session_start();
include('../includes/config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['id'])) {
    $driver_id = $_GET['id'];

    // Fetch driver details
    $sql = "SELECT * FROM drivers WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $driver_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $driver = $result->fetch_assoc();
    } else {
        echo "Driver not found.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $license_number = $_POST['license_number'];
    $phone = $_POST['phone'];

    $update_sql = "UPDATE drivers SET name=?, license_number=?, phone=? WHERE id=? AND user_id=?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param('sssii', $name, $license_number, $phone, $driver_id, $user_id);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Error updating driver.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Driver</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Edit Driver</h2>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($driver['name']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">License Number</label>
            <input type="text" class="form-control" name="license_number" value="<?php echo htmlspecialchars($driver['license_number']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" class="form-control" name="phone" value="<?php echo htmlspecialchars($driver['phone']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Driver</button>
        <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

</body>
</html>
