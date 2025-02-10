
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
        // If correct, store user data in session
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
        echo "Invalid email or password";
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

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fa;
        }
        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 40px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-container .btn-login {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .login-container .btn-login:hover {
            background-color: #218838;
        }
        .login-container .form-group {
            margin-bottom: 20px;
        }
        .login-container .forgot-password {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
        }
        .login-container .forgot-password a {
            text-decoration: none;
            color: #007bff;
        }
        .login-container .forgot-password a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login to Fleet Management</h2>
        
        <!-- Login Form -->
        <form method="POST">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
            </div>
            
            <!-- Login Button -->
            <button type="submit" name="login" class="btn-login">Login</button>

            <div class="forgot-password">
                <a href="register.php">Don't have an account? Register here</a>
                <a href="#">Forgot password?</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS and Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
