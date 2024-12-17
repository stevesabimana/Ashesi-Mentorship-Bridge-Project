<?php
include("../config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newPassword = $_POST['password'];
    $token = $_POST['token'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE reset_token = ? AND token_expiry > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $userId = $user['id'];
        
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        
        $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, token_expiry = NULL WHERE id = ?");
        $stmt->bind_param("si", $hashedPassword, $userId);
        $stmt->execute();

        echo "Your password has been updated successfully.";
    } else {
        echo "Invalid or expired token.";
    }
}
?>

<form action="reset-password.php" method="POST">
    <label for="password">Enter a new password:</label>
    <input type="password" name="password" required>
    <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
    <button type="submit">Reset Password</button>
</form>
