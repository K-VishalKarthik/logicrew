<?php
session_start();
include('../includes/config.php');
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (isset($_POST['add_vehicle'])) {
    $user_id = $_SESSION['user_id'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $registration_number = $_POST['registration_number'];
    $status = $_POST['status'];

    $sql = "INSERT INTO vehicles (user_id, make, model, registration_number, status) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('issss', $user_id, $make, $model, $registration_number, $status);

    if ($stmt->execute()) {
        header('Location: dashboard.php');
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vehicle | Fleet Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Poppins', sans-serif;
        }
        .container {
            max-width: 500px;
            margin-top: 50px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-custom {
            background-color: #3498db;
            color: white;
            font-size: 1.1rem;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">Add Vehicle</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label"><i class="fa-solid fa-car"></i> Vehicle Make</label>
            <input type="text" name="make" class="form-control" placeholder="Enter Vehicle Make" required>
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="fa-solid fa-car-side"></i> Vehicle Model</label>
            <input type="text" name="model" class="form-control" placeholder="Enter Vehicle Model" required>
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="fa-solid fa-id-card"></i> Registration Number</label>
            <input type="text" name="registration_number" class="form-control" placeholder="Enter Registration Number" required>
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="fa-solid fa-clipboard-list"></i> Status</label>
            <select name="status" class="form-select">
                <option value="available">Available</option>
                <option value="under maintenance">Under Maintenance</option>
                <option value="in use">In Use</option>
            </select>
        </div>

        <button type="submit" name="add_vehicle" class="btn btn-custom w-100"><i class="fa-solid fa-plus"></i> Add Vehicle</button>
    </form>
</div>

</body>
</html>
