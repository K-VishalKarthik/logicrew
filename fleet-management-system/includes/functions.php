
<?php
session_start();
include('config.php');

// Register User
function register($username, $email, $password) {
    global $conn;
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $passwordHash);
    return $stmt->execute();
}

// Login Function
function login($username, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        return true;
    }
    return false;
}

// Add Vehicle Function
function addVehicle($user_id, $make, $model, $registration_number, $status) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO vehicles (user_id, make, model, registration_number, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $user_id, $make, $model, $registration_number, $status);
    return $stmt->execute();
}

// Get Vehicles for User
function getVehicles($user_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM vehicles WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    return $stmt->get_result();
}
?>
