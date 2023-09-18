<?php
session_start();
include 'config/config.php';
include '../admin/Database.php';
include 'order-mail.php';
$payment = new Payment($conn);
$cartObj = new Cart($conn);
$txnid = $_POST['txnid'];
$amount = $_POST['amount'];
$status = $_POST['status'];
$prodids = $_POST['udf1'];
$orderid = $_POST['udf2'];
$deliveryCharge = $_POST['udf3'];
$user_email = $_SESSION['email'];
$paymentMethod = $_POST['mode'];
//echo $paymentMethod;
if ($status === "success") {
    if ($payment->saveTransaction($txnid, $amount, $status, $prodids, $orderid)) {
        sendOrderEmail($user_email, $deliveryCharge);
        $cartObj->removeAllCartItems();
        $success = "Payment Successful! Transaction ID: " . $txnid;
        echo htmlspecialchars($success, ENT_QUOTES, 'UTF-8');
        header("Location: payment-success.php?txnid=" . htmlspecialchars($success, ENT_QUOTES, 'UTF-8'));

    } else {
        $cartObj->removeAllCartItems();
        $success = "Payment Successful! Transaction ID: " . $txnid . " (but failed to save)";
        echo htmlspecialchars($success, ENT_QUOTES, 'UTF-8');
        header("Location: payment-success.php?txnid=" . htmlspecialchars($success, ENT_QUOTES, 'UTF-8'));

    }
} elseif ($status === "failure") {
    if ($payment->saveTransaction($txnid, $amount, $status, $prodids, $orderid)) {
        sendOrderEmail($user_email, $deliveryCharge);
        $cartObj->removeAllCartItems();
        $error = "Payment Failed! Transaction ID: " . $txnid;
        header("Location: payment-success.php?txnid=" . htmlspecialchars($error, ENT_QUOTES, 'UTF-8'));

    } else {
        $cartObj->removeAllCartItems();
        $error = "Payment Failed! Transaction ID: " . $txnid . " (but failed to save)";
        header("Location: payment-success.php?txnid=" . htmlspecialchars($error, ENT_QUOTES, 'UTF-8'));
    }
} else {
    echo "Unexpected response.";
}

// Unset the $_SESSION['order_id']
unset($_SESSION['order_id']);
?>