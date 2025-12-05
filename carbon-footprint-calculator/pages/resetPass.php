<?php
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Find the user with the provided token
    $sql = "SELECT * FROM password_resets WHERE token = :token";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':token', $token);
    $stmt->execute();

    $resetRequest = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resetRequest) {
        // Show the reset password form
        echo '
        <form method="POST" action="reset-password.php">
            <input type="hidden" name="token" value="' . $token . '">
            <label for="new-password">New Password:</label>
            <input type="password" name="new-password" required>
            <button type="submit">Reset Password</button>
        </form>';
    } else {
        echo "Invalid or expired token.";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['token'])) {
    $newPassword = $_POST['new-password'];
    $token = $_POST['token'];

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Update the password in the database
    $sql = "UPDATE users u INNER JOIN password_resets pr ON u.email = pr.email
            SET u.password = :password WHERE pr.token = :token";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':token', $token);
    $stmt->execute();

    // Remove the token from the password_resets table
    $sql = "DELETE FROM password_resets WHERE token = :token";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':token', $token);
    $stmt->execute();

    echo "Your password has been reset successfully.";
}
?>
