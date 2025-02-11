<?php
session_start();
include('../includes/config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (isset($_POST['assign_driver'])) {
    $vehicle_id = $_POST['vehicle_id'];
    $driver_id = $_POST['driver_id'];

    $stmt = $conn->prepare("UPDATE vehicles SET driver_id = ? WHERE id = ?");
    $stmt->bind_param("ii", $driver_id, $vehicle_id);
    if ($stmt->execute()) {
        header("Location: dashboard.php?message=Driver assigned successfully");
        exit;
    }
}

$vehicle_id = $_GET['id'];
$drivers = $conn->query("SELECT * FROM drivers");
?>

<form method="POST">
    <input type="hidden" name="vehicle_id" value="<?php echo $vehicle_id; ?>">
    <label>Select Driver:</label>
    <select name="driver_id">
        <?php while ($driver = $drivers->fetch_assoc()): ?>
            <option value="<?php echo $driver['id']; ?>"><?php echo $driver['name']; ?></option>
        <?php endwhile; ?>
    </select>
    <button type="submit" name="assign_driver">Assign</button>
</form>
