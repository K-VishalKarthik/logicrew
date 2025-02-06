<?php
include('../includes/config.php');

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email already exists in the database
    $sql_check_email = "SELECT * FROM users WHERE email = ?";
    $stmt_check_email = $conn->prepare($sql_check_email);
    $stmt_check_email->bind_param('s', $email);
    $stmt_check_email->execute();
    $result = $stmt_check_email->get_result();

    if ($result->num_rows > 0) {
        // Email already exists, show error
        echo "<p style='color: red;'>Error: The email '$email' is already taken. Please use a different email.</p>";
    } else {
        // If email doesn't exist, proceed with registration
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $username, $email, $hashed_password);
        
        if ($stmt->execute()) {
            header('Location: login.php');
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}
?>

<!-- HTML Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        /* Add your existing CSS code here */
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Register</h2>
        <form method="POST" onsubmit="return validateForm()">
            <input type="text" name="username" id="username" placeholder="Username" required>
            <input type="email" name="email" id="email" placeholder="Email" required>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <button type="submit" name="register">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>

    <script>
        function validateForm() {
            var username = document.getElementById('username').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;

            // Validate email
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            // Validate password length
            if (password.length < 6) {
                alert("Password should be at least 6 characters long.");
                return false;
            }

            return true;
        }
    </script>

</body>
</html>
