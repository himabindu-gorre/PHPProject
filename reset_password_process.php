<?php

include('connect.php');

$message = ''; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email'])) {
        $email = trim($_POST['email']);

        if (!empty($email)) {
           
            $token = bin2hex(random_bytes(16));
            $token_hash = hash("sha256", $token);
            $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

            $sql = "UPDATE register
                    SET reset_token_hash = ?, reset_token_expires_at = ?
                    WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $token_hash, $expiry, $email);

            if ($stmt->execute()) {
             
                $reset_link = "http://yourdomain.com/reset_password.php?token=$token";
                $to = $email;
                $subject = "Password Reset Request";
                $message = "Click on the following link to reset your password: $reset_link";
                $headers = "From: no-reply@yourdomain.com";

                if (mail($to, $subject, $message, $headers)) {
                    $message = '<p style="color: green;">Reset link sent! Please check your email.</p>';
                } else {
                    $message = '<p style="color: red;">Failed to send email. Please try again.</p>';
                }
            } else {
                $message = '<p style="color: red;">Failed to process request. Please try again.</p>';
            }

            $stmt->close();
        } else {
            $message = '<p style="color: red;">Email is required.</p>';
        }
    } else {
        $message = '<p style="color: red;">Email field is missing.</p>';
    }
}

$conn->close();
?>
