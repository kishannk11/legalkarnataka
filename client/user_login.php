<?php
require_once('config/config.php');
require_once('../admin/Database.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$errors = array();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userObj = new User($conn);
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (empty($email)) {
        $errors[] = "Please enter your email.";
    }
    if (empty($password)) {
        $errors[] = "Please enter your password.";
    }

    if (empty($errors)) {
        // Call the loginUser method
        $result = $userObj->loginUser($email, $password);

        if ($result) {
            // Start a session and store the email ID
            session_start();
            $_SESSION['email'] = $email;

            // Login successful, redirect to the dashboard or home page
            header("Location: dashboard.php");
            exit();
        } else {
            $errors[] = "Invalid email or password.";
            header("Location: login.php?error=" . urlencode(implode(", ", $errors)));
        }
    } else {
        header("Location: login.php?error=" . urlencode(implode(", ", $errors)));
    }
}
?>