
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Andhra Pradesh Environment Management Corporation Ltd</title>
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <a href="register.php" class="home-btn">
                <i class="fas fa-home"></i> Home
            </a>
            <!-- <p class="home-link"><a href="register.php" class="home-btn">Back to Home</a></p> -->
            <img src="./images/ap-logo.png" alt="AP Logo" class="logo">
            <h1>Government of Andhra Pradesh</h1>
            <h2>ANDHRA PRADESH ENVIRONMENT MANAGEMENT CORPORATION LTD</h2>
            <p>Environment, Forests, Science & Technology Department</p>
        </div>
    </header>
    <main class="main">
        <div class="container">
            <section class="register-section">
                <h4>Register Account</h4>
                <form action="register_process.php" method="post">
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <i class="fa fa-user icon" aria-hidden="true"></i>
                        <input type="text" id="firstname" name="firstname" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <i class="fa fa-user icon" aria-hidden="true"></i>
                        <input type="text" id="lastname" name="lastname" required>
                    </div>
                    <div class="form-group">
                        <label for="username">User Name</label>
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
                        <label for="enter-captcha">Enter Captcha</label>
                        <input type="text" id="captcha-input" name="captcha" size="6" maxlength="6" required> </p>
                    </div>
                    
                    <button type="submit" class="register-btn">REGISTER</button>
                </form>
                <p class="login-link">Already have an account? <a href="login.php">Login here</a></p>
                
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
