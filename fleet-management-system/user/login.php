<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Check if email exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Generate unique token
        $token = bin2hex(random_bytes(50));
        $expiry = date("Y-m-d H:i:s", strtotime("+1 hour")); // Token expires in 1 hour

        // Save token in database
        $stmt = $conn->prepare("UPDATE users SET password_reset_token=?, token_expiry=? WHERE email=?");
        $stmt->bind_param("sss", $token, $expiry, $email);
        $stmt->execute();

        // Send email
        $reset_link = "http://localhost/fleet_management/reset_password.php?token=$token";
        mail($email, "Password Reset Request", "Click this link to reset your password: $reset_link");

        echo "Password reset link has been sent to your email.";
    } else {
        echo "No user found with this email.";
    }
}
?>

<form method="POST">
    <input type="email" name="email" placeholder="Enter your email" required>
    <button type="submit">Reset Password</button>
</form>
