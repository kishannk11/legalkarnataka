<?php
require_once('config/config.php');
require_once('../admin/Database.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Define the maximum number of requests allowed per minute
$maxRequestsPerMinute = 5;

// Generate a unique identifier for the current request
$requestIdentifier = $_SERVER['REMOTE_ADDR'] . $_SERVER['REQUEST_URI'];

// Check if the request identifier exists in the session
session_start();
if (!isset($_SESSION['requestCounts'])) {
    $_SESSION['requestCounts'] = array();
}

// Retrieve the request counts from the session
$requestCounts = $_SESSION['requestCounts'];

// Check if the request identifier has exceeded the maximum number of requests or if the last request was made more than 1 minute ago
if (!isset($requestCounts[$requestIdentifier]) || $requestCounts[$requestIdentifier]['count'] < $maxRequestsPerMinute || (time() - $requestCounts[$requestIdentifier]['time']) > 60) {
    // Reset the request count if the last request was made more than 1 minute ago
    if (!isset($requestCounts[$requestIdentifier]) || (time() - $requestCounts[$requestIdentifier]['time']) > 60) {
        $requestCounts[$requestIdentifier] = array(
            'count' => 0,
            'time' => time()
        );
    }

    // Increment the request count for the current request identifier
    $requestCounts[$requestIdentifier]['count']++;

    // Store the updated request counts in the session
    $_SESSION['requestCounts'] = $requestCounts;

    // Get the name and phone number from the form
    $phone = $_POST['phone'];

    // Check if the phone number exists in the register table
    $registerObj = new User($conn);
    $registerData = $registerObj->getUserByPhone($phone);

    if ($registerData) {
        $firstname = $registerData['firstname'];
        //$lastname = $registerData['lasttname'];

        // Generate a random 6-digit OTP
        $otp = rand(100000, 999999);
        $_SESSION['otpGenerationTime'] = time();
        // Store the OTP in a session variable
        $_SESSION['otp'] = $otp;
        // Send the OTP using Fast2SMS API
        $url = "https://www.fast2sms.com/dev/bulkV2";
        $headers = array(
            "authorization: gsJ4OvbMK1cCuiSwraRTjA3qneZ2XYDkNht5dy0Wm98IUpPzx6l1sTtvZuGzoL3rDg5VOBIiwdYnM0pm",
            "Content-Type: application/json"
        );
        $data = array(
            "route" => "dlt",
            "sender_id" => "LGLKTK",
            "message" => "158887",
            "variables_values" => "$firstname | $otp",
            "flash" => 0,
            "numbers" => "$phone"
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        echo "present";
    } else {
        echo "not_present";
    }
} else {
    // Handle rate limit exceeded error
    http_response_code(429);
    echo "Rate limit exceeded. Please try again later.";
}
?>