<?php
session_start();
include('../includes/config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch current user details
$sql = "SELECT username, email FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];

    $update_sql = "UPDATE users SET username = ?, email = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param('ssi', $username, $email, $user_id);

    if ($update_stmt->execute()) {
        // Redirect to dashboard after successful update
        header('Location: dashboard.php');
        exit;
    } else {
        $message = "Error updating profile!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update Profile | Fleet Management</title>
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
<h2 class="text-center mb-4">Update Profile</h2>

<?php if (isset($message)): ?>
<div class="alert alert-danger"><?= $message; ?></div>
<?php endif; ?>

<form method="POST">
<div class="mb-3">
<label class="form-label"><i class="fa-solid fa-user"></i> Username</label>
<input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']); ?>" required>
</div>

<div class="mb-3">
<label class="form-label"><i class="fa-solid fa-envelope"></i> Email</label>
<input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']); ?>" required>
</div>

<button type="submit" class="btn btn-custom w-100"><i class="fa-solid fa-save"></i> Update Profile</button>
</form>
</div>

</body>
</html>
