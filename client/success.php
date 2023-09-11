<?php
session_start();
include 'config/config.php';
include '../admin/Database.php';
$payment = new Payment($conn);
$cartObj = new Cart($conn);
$txnid = $_POST['txnid'];
$amount = $_POST['amount'];
$status = $_POST['status'];
$prodids = $_POST['udf1'];
$orderid = $_POST['udf2'];
if ($status === "success") {
    if ($payment->saveTransaction($txnid, $amount, $status, $prodids, $orderid)) {
        $cartObj->removeAllCartItems();
        $success = "Payment Successful! Transaction ID: " . $txnid;
        echo $success;
        header("Location: payment-success.php?txnid=" . $success);

    } else {
        $cartObj->removeAllCartItems();
        $success = "Payment Successful! Transaction ID: " . $txnid . " (but failed to save)";
        echo $success;
        header("Location: payment-success.php?txnid=" . $success);

    }
} elseif ($status === "failure") {
    if ($payment->saveTransaction($txnid, $amount, $status, $prodids, $orderid)) {
        $cartObj->removeAllCartItems();
        $error = "Payment Failed! Transaction ID: " . $txnid;
        header("Location: payment-success.php?txnid=" . $error);

    } else {
        $cartObj->removeAllCartItems();
        $error = "Payment Failed! Transaction ID: " . $txnid . " (but failed to save)";
        header("Location: payment-success.php?txnid=" . $error);
    }
} else {
    echo "Unexpected response.";
}

// Unset the $_SESSION['order_id']
unset($_SESSION['order_id']);
?>