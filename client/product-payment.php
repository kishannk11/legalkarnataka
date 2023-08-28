<?php
session_start();

include 'config/config.php';
include '../admin/Database.php';

$orderObj = new Order($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $postalcode = $_POST['postalcode'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $order = $_SESSION['order_id'];
    $email = $_SESSION['email'];
    $prod_id = $_POST['id'];
    $price = $_POST['value'];

    // Set your PayU credentials
    $merchantKey = "Z5LxwB";
    $salt = "BvrZHvmeBjkEdQxJrxlBIiVhVyjirOac";
    $baseUrl = "https://test.payu.in/_payment"; // Sandbox URL, replace with production URL when ready

    // Prepare data for the payment
    $txnid = uniqid(); // Generate a unique transaction ID
    $productInfo = "Sample Product";
    $phone = "1234567890";
    $udf1 = $prod_id;
    $udf2 = $order;
    $udf3 = "";
    $udf4 = "";
    $udf5 = "";

    // Create hash
    $hashSequence = $merchantKey . "|" . $txnid . "|" . $price . "|" . $productInfo . "|" . $firstname . "|" . $email . "|" . $udf1 . "|" . $udf2 . "|" . $udf3 . "|" . $udf4 . "|" . $udf5 . "||||||" . $salt;
    $hash = strtolower(hash("sha512", $hashSequence));

    // Prepare form data
    $data = [
        "key" => $merchantKey,
        "txnid" => $txnid,
        "amount" => $price,
        "productinfo" => $productInfo,
        "firstname" => $firstname,
        "email" => $email,
        "phone" => $phone,
        "udf1" => $udf1,
        "udf2" => $udf2,
        "udf3" => $udf3,
        "udf4" => $udf4,
        "udf5" => $udf5,
        "surl" => "http://localhost/legalkarnataka/client/success.php",
        "furl" => "http://localhost/legalkarnataka/client/success.php",
        "hash" => $hash,
    ];

    // Save order details to the database
    $orderObj->saveOrder($firstname, $lastname, $address, $city, $postalcode, $country, $state, $order, $email, $prod_id, $price);

    // Create a form to submit payment data to PayU
    echo '<form method="post" action="' . $baseUrl . '" name="payuForm" id="payuForm">';
    foreach ($data as $key => $value) {
        echo '<input type="hidden" name="' . $key . '" value="' . $value . '">';
    }
    echo '</form>';

    // Automatically submit the form when the page loads
    echo '<script>document.addEventListener("DOMContentLoaded", function () {document.getElementById("payuForm").submit();});</script>';
}
?>