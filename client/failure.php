<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'config/config.php';
include '../admin/Database.php';
$payment = new Payment($conn);
$txnid = $_POST['txnid'];
$amount = $_POST['amount'];
$status = $_POST['status'];

if ($status === "failure") {
    if ($payment->saveTransaction($txnid, $amount, $status)) {
        echo "Payment Failed! Transaction ID: " . $txnid;
    } else {
        echo "Payment Failed! Transaction ID: " . $txnid . " (but failed to save)";
    }
} else {
    echo "Unexpected response.";
}
?>