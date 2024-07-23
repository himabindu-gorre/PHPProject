<?php

$status = isset($_GET['status']) ? $_GET['status'] : '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="message-container">
            <h1>Log In Successful</h1>
            <?php
            if ($status == 'login') {
                echo '<p class="message success">You have successfully logged in!</p>';
            } else {
                echo '<p class="message success">Success!</p>';
            }
            ?>
            <p><a href="register.php" class="link">Go to Homepage</a></p>
        </div>
    </div>
</body>
</html>
