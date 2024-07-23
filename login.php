<?php 
session_start();


if (!isset($_SESSION['captcha'])) {
    $_SESSION['captcha'] = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 3);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['captcha']) && $_POST['captcha'] == $_SESSION['captcha']) {
        echo "CAPTCHA validated successfully!";

        header("Location: success.php");
        exit;
    } else {
        echo "CAPTCHA validation failed. Please try again.";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Andhra Pradesh Environment Management Corporation Ltd</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <a href="login.php" class="home-btn">
                <i class="fas fa-home"></i> Home
            </a>
            <img src="./images/ap-logo.png" alt="AP Logo" class="logo">
            <h1>Government of Andhra Pradesh</h1>
            <h2>ANDHRA PRADESH ENVIRONMENT MANAGEMENT CORPORATION LTD</h2>
            <p>Environment, Forests, Science & Technology Department</p>
        </div>
    </header>
    <main class="main">
        <div class="container">
            <section class="login-section">
                <h4>Login Here</h4>
                <form action="login_process.php" method="post">
                    <div class="form-group">
                        <label for="username">User name</label>
                        <i class="fa fa-user icon" aria-hidden="true"></i>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-group email">
                        <label for="email">Email</label>
                        <i class="fa fa-envelope icon" aria-hidden="true"></i>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <i class="fa fa-key icon" aria-hidden="true"></i>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group captcha-container">
                        <p><img src="captcha.php" alt="captcha image" id="captcha-image"> <br>
                        <button type="button" id="reload-captcha">Reload Captcha</button>
                        <label for="captcha-input">Enter Captcha</label>
                        <input type="text" id="captcha-input" name="captcha" size="6" maxlength="6" required></p>
                    </div>
                    <button type="submit" class="login-btn">LOGIN</button>
                    <p class="pass-btn">
                        Don't Have An Account? 
                        <a href="register.php">Register Here</a>
                    </p>
                </form>
            </section>
            <section class="links-section">
                <h4>Register or Forgot Password?</h4>
                <div class="links-container">
                    <div class="link-box">
                        <i class="icon">🏭</i>
                        <div class="title">Generator/Receiver</div>
                        <a class="button" href="register_generator.php">Login Here</a>
                        <a href="forgot_password_generator.php">Forgot Password?</a>
                    </div>
                    <div class="link-box">
                        <i class="icon">🚚</i>
                        <div class="title">Transporter</div>
                        <a class="button" href="register_transporter.php">Login Here</a>
                        <a href="forgot_password_transporter.php">Forgot Password?</a>
                    </div>
                    <div class="link-box">
                        <i class="icon">🌋</i>
                        <div class="title">Fly Ash Receiver</div>
                        <a class="button" href="register_flyash.php">Login Here</a>
                        <a href="forgot_password_flyash.php">Forgot Password?</a>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script>
        document.getElementById('reload-captcha').addEventListener('click', function() {
            document.getElementById('captcha-image').src = 'captcha.php?' + Math.random();
        });
    </script>
</body>
</html>
