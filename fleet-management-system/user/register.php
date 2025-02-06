<?php
include('../includes/config.php');

// For OTP Simulation - In real scenario, you'd use an external API like Twilio
$otp_sent = false;
$otp = '';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    
    // Generate OTP (Simulated)
    if (!$otp_sent) {
        $otp = rand(100000, 999999); // Generate a 6-digit OTP
        // Send OTP via email/SMS (Simulated here)
        echo "<p>OTP Sent: $otp</p>";
        $otp_sent = true;
    }

    if ($_POST['otp'] == $otp) {
        // If OTP matches, hash password and insert into DB
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, phone, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssss', $username, $email, $phone, $hashed_password);
        
        if ($stmt->execute()) {
            header('Location: login.php');
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "<p>Invalid OTP. Please try again.</p>";
    }
}
?>

<!-- HTML Form with Enhanced CSS -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            padding: 30px;
            box-sizing: border-box;
        }

        .form-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-container input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }

        .form-container input:focus {
            border-color: #007BFF;
            outline: none;
        }

        .form-container button {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }

        .form-container p {
            text-align: center;
            font-size: 14px;
            color: #666;
        }

        .form-container p a {
            color: #007BFF;
            text-decoration: none;
        }

        .form-container p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Register</h2>
        <form method="POST" onsubmit="return validateForm()">
            <input type="text" name="username" id="username" placeholder="Username" required>
            <input type="email" name="email" id="email" placeholder="Email" required>
            <input type="text" name="phone" id="phone" placeholder="Phone Number" required>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <input type="text" name="otp" id="otp" placeholder="Enter OTP" required>
            <button type="submit" name="register">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>

    <script>
        function validateForm() {
            var username = document.getElementById('username').value;
            var email = document.getElementById('email').value;
            var phone = document.getElementById('phone').value;
            var password = document.getElementById('password').value;
            var otp = document.getElementById('otp').value;
            
            // Validate phone number
            var phoneRegex = /^[0-9]{10}$/;
            if (!phoneRegex.test(phone)) {
                alert("Please enter a valid 10-digit phone number.");
                return false;
            }
            
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

            // OTP validation is handled by backend in this example
            return true;
        }
    </script>

</body>
</html>
