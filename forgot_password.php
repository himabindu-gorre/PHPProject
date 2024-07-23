<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "environment_management";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
        $stmt = $conn->prepare("SELECT id FROM register WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {

            $token = bin2hex(random_bytes(50));
            $stmt->close();

         
            $stmt = $conn->prepare("INSERT INTO passwordresets (email, token) VALUES (?, ?)");
            $stmt->bind_param("ss", $email, $token);
            $stmt->execute();

           
            $resetLink = "http://yourdomain.com/reset_password.php?token=$token";
            $subject = "Password Reset Request";
            $message = "Click the following link to reset your password: <a href='$resetLink'>Reset Password</a>";
            $headers = "From: your-email@yourdomain.com\r\n";
            $headers .= "Reply-To: your-email@yourdomain.com\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=UTF-8\r\n";

            if (mail($email, $subject, $message, $headers)) {
                echo 'Password reset link sent to ' . htmlspecialchars($email);
            } else {
                echo 'Failed to send reset link.';
            }
        } else {
            echo 'Email address not found.';
        }
    } else {
        echo 'Please enter a valid email address.';
    }
}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="forgot-password-container">
        <h2>Forgot Password</h2>
        <form action="reset_password.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <button type="submit">Send Reset Link</button>
        </form>

    </div>
</body>
</html>


