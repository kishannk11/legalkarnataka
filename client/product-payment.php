<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include 'config/config.php';
include '../admin/Database.php';
$orderObj = new Order($conn);
$cartObj = new Cart($conn);
$productObj = new Product($conn);
$userObj = new User($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $postalcode = $_POST['postalcode'];
    $state = $_POST['state'];
    $order = $_SESSION['order_id'];
    $user_email = $_SESSION['email'];
    $shippingMethod = $_POST['radio-group'];
    $cartDetails = $cartObj->getCartDetails($_SESSION['email']);
    $userinfo = $userObj->getUserInfo($_SESSION['id']);
    $total = 0;
    $productIds = []; // Array to store the product_ids
    $stampPrices = [];
    $commissions = [];
    $gstperItem = [];
    $gstProduct = 0;
    foreach ($cartDetails as $cartItem) {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $product = $productObj->getProductwithId($cartItem['product_id']);

        $stampPrice = $cartItem['stamp_price'];
        $commission = '0'; // Default commission value
        $gstOnCommission = 0;
        $commissionValue = 0;
        $gstOnCommissionValue = 0;

        // Add commission for stamp paper prices based on the table
        if ($stampPrice > 0) {
            if ($stampPrice <= 20) {
                $commission = 10;
            } elseif ($stampPrice <= 50) {
                $commission = 10;
            } elseif ($stampPrice <= 100) {
                $commission = 10;
            } elseif ($stampPrice <= 150) {
                $commission = 20;
            } elseif ($stampPrice <= 200) {
                $commission = 20;
            } elseif ($stampPrice <= 300) {
                $commission = 20;
            } elseif ($stampPrice <= 500) {
                $commission = 30;
            } elseif ($stampPrice <= 1000) {
                $commission = 50;
            } elseif ($stampPrice > 1000) {
                $commission = 100;
            }
            $gstOnCommission = ($commission * 5) / 100;
            //$commission += ($commission * 5) / 100; // Add 5% GST to the commission
        }
        $gstPercentage = 18;
        $gstProduct = $product[0]['price'];
        $gstAmount = ($gstProduct * $gstPercentage) / 100;
        // echo $gstAmount;
        $commissionValue += $commission; // Store the commission
        $gstOnCommissionValue += $gstOnCommission; // Store the GST on the commission
        //$total += $product[0]['price'] + $stampPrice + $commission + $gstOnCommissionValue + $commissionValue;
        $total += $product[0]['price'] + $stampPrice + $gstAmount + $gstOnCommissionValue + $commissionValue;
        //$total += $product[0]['price'] + $stampPrice + $commission;
        //$total += $product[0]['price'] + $cartItem['stamp_price'];
        $gstProduct += $product[0]['price'];
        $productIds[] = $cartItem['product_id'];
        $stampPrices[] = $stampPrice;
        $commissions[] = $commission;
        $gstperItem[] = $gstAmount;
    }
    //echo $total;
    if ($shippingMethod === '2') {
        $deliveryCharge = 50;
        $deliveryType = "Indian Post";
    } else {
        $deliveryCharge = 0;
        $deliveryType = "Instant Delivery";
    }
    // echo $deliveryCharge;
    //$deliveryCharge = $shippingMethod === '1' ? 10 : 50;
    $gstPercentage = 18;
    $totalWithDelivery = floatval($total) + $deliveryCharge;
    $gstAmount = ($gstProduct * $gstPercentage) / 100;
    $price = $totalWithDelivery;
    //echo $price;

    $stampPriceValue = implode(',', $stampPrices);
    $commissionValue = implode(',', $commissions);
    $gstValue = implode(',', $gstperItem);
    //echo $price;
    // Set your PayU credentials
    $merchantKey = "vfiulB";
    $salt = "HLk3ltGCqExDiJbADdFUBtS8G9ePX9v3";
    $baseUrl = "https://test.payu.in/_payment"; // Sandbox URL, replace with production URL when ready

    // Prepare data for the payment
    $txnid = uniqid(); // Generate a unique transaction ID
    $productInfo = "Sample Product";
    $phone = $userinfo['phonenumber'];
    $udf1 = implode(',', $productIds);
    // print_r($udf1); // Convert the array of product_ids to a comma-separated string
    $udf2 = $order;
    $udf3 = $deliveryCharge;
    $udf4 = "";
    $udf5 = "";



    $hashSequence = $merchantKey . "|" . $txnid . "|" . $price . "|" . $productInfo . "|" . $firstname . "|" . $user_email . "|" . $udf1 . "|" . $udf2 . "|" . $udf3 . "|" . $udf4 . "|" . $udf5 . "||||||" . $salt;
    $hash = strtolower(hash("sha512", $hashSequence));
    // Prepare form data
    $data = [
        "key" => $merchantKey,
        "txnid" => $txnid,
        "amount" => $price,
        "productinfo" => $productInfo,
        "firstname" => $firstname,
        "email" => $user_email,
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

    $OrderStatus = "New";
    $orderObj->saveOrder($firstname, $lastname, $address, $city, $postalcode, $state, $order, $user_email, $udf1, $price, $deliveryCharge, $gstValue, $stampPriceValue, $commissionValue, $deliveryType, $OrderStatus); // Pass the array of product_ids


    // Create a form to submit payment data to PayU
    echo '<form method="post" action="' . $baseUrl . '" name="payuForm" id="payuForm">';
    foreach ($data as $key => $value) {
        echo '<input type="hidden" name="' . htmlspecialchars($key, ENT_QUOTES, 'UTF-8') . '" value="' . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . '">';
    }
    echo '</form>';

    // Automatically submit the form when the page loads
    echo '<script>document.addEventListener("DOMContentLoaded", function () {document.getElementById("payuForm").submit();});</script>';
}
?>