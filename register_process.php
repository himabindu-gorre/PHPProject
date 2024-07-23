<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $captcha = $_POST['captcha'];

    $conn = new mysqli('localhost', 'root', '', 'environment_management');

    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    } else {
        
        $stmt = $conn->prepare("SELECT * FROM register WHERE firstname = ? OR lastname =  ? OR username = ? OR email = ?");
        $stmt->bind_param("ssss", $firstname, $lastname, $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Error: Username or Email already exists, Please try with another mail or username";
        } else {
           
            $stmt = $conn->prepare("INSERT INTO register(firstname, lastname, username, email, password, captcha) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $firstname, $lastname, $username, $email, $password, $captcha);
            if ($stmt->execute()) {
                echo "Registration Successful!";
            } else {
                echo "Error: Could not register user.";
            }
        }
        $stmt->close();
        $conn->close();
    }
}


?>
