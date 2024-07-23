<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];

    if (!empty($email)) {

        echo "Password reset link sent to $email";
    } else {
        echo "Please enter your email address.";
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
    <div class="container">
        <h1>Forgot Password</h1>
        <form method="post" action="">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            <input type="submit" value="Send Reset Link">
        </form>
    </div>
</body>
</html>
