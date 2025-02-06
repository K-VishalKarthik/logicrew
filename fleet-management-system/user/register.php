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
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #1d2b64 0%, #f8cdda 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Form Container */
        .form-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            padding: 40px;
            box-sizing: border-box;
            text-align: center;
        }

        .form-container h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 30px;
            font-weight: bold;
        }

        /* Input Fields */
        .form-container input {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            background-color: #f9f9f9;
            transition: all 0.3s ease;
        }

        .form-container input:focus {
            border-color: #5c6bc0;
            background-color: #f1f5f9;
            outline: none;
        }

        /* Submit Button */
        .form-container button {
            width: 100%;
            padding: 15px;
            background-color: #5c6bc0;
            border: none;
            color: white;
            font-size: 18px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-container button:hover {
            background-color: #3f4c8a;
        }

        /* Error Message */
        .form-container p {
            font-size: 14px;
            color: #f44336;
            margin-top: 20px;
        }

        /* Success Message */
        .form-container .success {
            color: #4caf50;
        }

        /* Links */
        .form-container p {
            font-size: 14px;
            color: #777;
            margin-top: 20px;
        }

        .form-container p a {
            color: #5c6bc0;
            text-decoration: none;
        }

        .form-container p a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .form-container {
                padding: 20px;
            }

            .form-container h2 {
                font-size: 22px;
            }

            .form-container input,
            .form-container button {
                padding: 12px;
                font-size: 14px;
            }
        }
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

            // Validate email format
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
