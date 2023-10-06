<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config/config.php';
require('../admin/Database.php');
$phone = $_POST['phone'];
$otp = $_POST['otp'];
$registerObj = new User($conn);
$registerData = $registerObj->getUserByPhone($phone);
if ($otp == $_SESSION['otp'] && $phone == $_SESSION['phone']) {
    // If the OTP is valid, redirect to dashboard.php
    unset($_SESSION['otp']);
    unset($_SESSION['phone']);
    $_SESSION['loggedin'] = true;
    $_SESSION["email"] = $registerData['email'];
    $_SESSION["role"] = $registerData['role'];
    $_SESSION['id'] = $registerData['id'];
    header("Location: product-left-sidebar.php");
    exit();
} else {
    // If the OTP is invalid, redirect to login_otp.php
    unset($_SESSION['otp']);
    unset($_SESSION['phone']);
    header("Location: login_otp.php?error=Invalid OTP");

    exit();
}
?>