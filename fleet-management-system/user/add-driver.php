<?php
session_start();
include('../includes/config.php');

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);

    // Validate inputs
    if (!empty($name) && !empty($phone)) {
        // Check if phone number is unique
        $check_sql = "SELECT id FROM drivers WHERE phone = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("s", $phone);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            $error = "Phone number already exists.";
        } else {
            // Insert new driver
            $sql = "INSERT INTO drivers (name, phone) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $name, $phone);

            if ($stmt->execute()) {
                $_SESSION['success'] = "Driver added successfully!";
                header("Location: dashboard.php");
                exit;
            } else {
                $error = "Error adding driver.";
            }
        }
        $check_stmt->close();
    } else {
        $error = "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Driver</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
<h2>Add Driver</h2>

<?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
<?php if (isset($_SESSION['success'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
    unset($_SESSION['success']);
} ?>

<form action="add-driver.php" method="POST">
<div class="mb-3">
<label for="name" class="form-label">Driver Name</label>
<input type="text" name="name" id="name" class="form-control" required>
</div>
<div class="mb-3">
<label for="phone" class="form-label">Phone Number</label>
<input type="text" name="phone" id="phone" class="form-control" required>
</div>
<button type="submit" class="btn btn-primary">Add Driver</button>
<a href="dashboard.php" class="btn btn-secondary">Back</a>
</form>
</div>

</body>
</html>
