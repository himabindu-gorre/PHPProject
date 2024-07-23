<?php
include('connect.php');
    
    $message = ''; 
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
    
       
        if (!empty($username) && !empty($email) && !empty($password)) {
           
            $sql = "SELECT * FROM register WHERE username = ? AND email = ? AND password = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $username, $email, $password);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result->num_rows > 0) {

                $user = $result->fetch_assoc();
                if ($password === $user['password']) {
                    
                    $message = '<p style="color: green;">Login successful!</p>';
                    
                    header('Location: success.php');
                    exit();
                } else {
                    $message = '<p style="color: red;">Incorrect password.</p>';
                }
            } else {
              
                $message = '<p style="color: red;">No account found with this username and email. Please <a href="register.php">register</a>.</p>';
            }
    
            $stmt->close();
        } else {
            $message = '<p style="color: red;">Please fill in all fields.</p>';
        }
    }
    
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>

        form {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
     
        label, input[type="text"], input[type="password"], input[type="submit"] , input[type= "email"]{
            display: block;
            width: 100%;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        p {
            text-align: center;
            font-weight: bold;
        }
        p[style*="color: red;"] {
            color: red;
        }
        p[style*="color: green;"] {
            color: green;
        }
    </style>
</head>
<body>

<h1>Login to Receiver & Generator</h1>
<form method="post" action="">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" required><br>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" required><br>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" required><br>

    <input type="submit" value="Login">

    <p class="pass-btn">Don't Have An Account? / <a href="register.php">Register</a></p>
    <p><a href="forgot_password.php">Forgot Password</a></p>

</form>


<?php if (!empty($message)) echo $message; ?>

</body>
</html>
