<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (!empty($username) && !empty($email) && !empty($password)) {
        $conn = new mysqli('localhost', 'root', '', 'environment_management');

        if ($conn->connect_error) {
            die('Connection Failed: ' . $conn->connect_error);
        } else {
            // Prepare statement to check if the user credentials match
            $stmt = $conn->prepare("SELECT * FROM register WHERE username = ? AND email = ? AND password = ? ");
            $stmt->bind_param("sss", $username, $email, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                // Verify the password
                if (password_verify($password, $user['password'])) {
                    // Redirect to success.php
                    header("Location: success.php?status=login");
                    exit();
                } else {
                    echo '<p style="color: red;">Invalid password.</p>';
                }
            } else {
                echo '<p style="color: red;">Invalid username or email.</p>';
            }

            $stmt->close();
            $conn->close();
        }
    } else {
        echo '<p style="color: red;">Please fill in all fields.</p>';
    }
}
?>
