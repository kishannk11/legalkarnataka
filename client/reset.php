<?php
require_once 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['token'], $_POST['password'], $_POST['conpassword'])) {
        $token = $_POST['token'];
        $password = $_POST['password'];
        $conpassword = $_POST['conpassword'];

        if ($password === $conpassword) {
            // Check if the token is valid
            $stmt = $conn->prepare("SELECT * FROM password_token WHERE token = ?");
            $stmt->execute([$token]);
            $row = $stmt->fetch();
            date_default_timezone_set('Asia/Kolkata');
            if ($row && (time() - strtotime($row['created_at'])) < 300) {
                // Token is valid, update the password
                $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
                $stmt->execute([password_hash($password, PASSWORD_DEFAULT), $row['email']]);

                // Delete the token
                $stmt = $conn->prepare("DELETE FROM password_token WHERE token = ?");
                $stmt->execute([$token]);

                $success = 'Password has been updated.';
                header('Location: index.php?success=' . urlencode($success));
                exit;
            } else {
                $error = 'Invalid token.';
                header('Location: forgot-password.php?error=' . urlencode($error));
                exit;
            }
        } else {
            $error = 'Passwords do not match.';
            header('Location: reset-password.php?error=' . urlencode($error));
            exit;
        }
    } else {
        $error = 'Missing parameters.';
        header('Location: reset-password.php?error=' . urlencode($error));
        exit;
    }
} else {
    $error = 'Invalid request method.';
    header('Location: reset-password.php?error=' . urlencode($error));
    exit;
}
?>