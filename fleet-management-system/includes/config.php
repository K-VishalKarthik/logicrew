<?php
$host = 'localhost';
$username = 'root'; // Default XAMPP username
$password = '';     // Default XAMPP password (empty)
$database = 'fleet_management';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
