<?php
session_start();
$otp = $_POST['otp'];
if ($otp == $_SESSION['otp']) {
    // If the OTP is valid, redirect to dashboard.php
    unset($_SESSION['otp']);
    header("Location: dashboard.php");
    exit();
} else {
    // If the OTP is invalid, redirect to login_otp.php
    header("Location: login_otp.php?error=Invalid OTP");

    exit();
}
?>