<?php

include('connect.php');

$message = '';

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $token_hash = hash("sha256", $token);

    $sql = "SELECT * FROM register WHERE reset_token_hash = ? AND reset_token_expires_at > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token_hash);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $new_password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if (!empty($new_password) && !empty($confirm_password)) {
                if ($new_password === $confirm_password) {
                    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

                    
                    $sql = "UPDATE register SET password = ?, reset_token_hash = NULL, reset_token_expires_at = NULL WHERE reset_token_hash = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ss", $hashed_password, $token_hash);

                    if ($stmt->execute()) {
                        $message = '<p style="color: green;">Password changed successfully!</p>';
                    } else {
                        $message = '<p style="color: red;">Failed to update password. Please try again.</p>';
                    }
                } else {
                    $message = '<p style="color: red;">Passwords do not match.</p>';
                }
            } else {
                $message = '<p style="color: red;">Please fill in all fields.</p>';
            }
        }
    } else {
        $message = '<p style="color: red;">Invalid or expired token.</p>';
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>
    <form action="reset_password_process.php" method="POST">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
        <div>
            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" required>
        </div>
        <div>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
