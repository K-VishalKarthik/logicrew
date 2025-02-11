<?php
session_start();
include('../includes/config.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user from the database
    $sql = "SELECT * FROM users WHERE email = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Check if the user exists and password matches
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];

        // Check if the user is admin
        if ($email == 'admin@example.com') {
            $_SESSION['role'] = 'admin'; // Admin role
            header('Location: ../admin/dashboard.php'); // Redirect to admin dashboard
            exit;
        } else {
            $_SESSION['role'] = 'user'; // User role
            header('Location: ../user/dashboard.php'); // Redirect to user dashboard
            exit;
        }
    } else {
        echo "<div class='alert alert-danger text-center'>Invalid email or password</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Fleet Management</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #007bff,rgb(217, 220, 224));
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            width: 400px;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
            font-weight: 600;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px;
            font-size: 16px;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s ease-in-out;
        }

        .btn-login:hover {
            background: #0056b3;
        }

        .forgot-password {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin-top: 10px;
        }

        .forgot-password a {
            text-decoration: none;
            color: #007bff;
            font-weight: 500;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Fleet Management Login</h2>
        
        <!-- Login Form -->
        <form method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
            </div>
            
            <!-- Login Button -->
            <button type="submit" name="login" class="btn-login">Login</button>

            <div class="forgot-password">
                <a href="register.php">Create an account</a>
                <a href="#">Forgot password?</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS and Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
