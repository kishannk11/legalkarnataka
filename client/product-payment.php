<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include 'config/config.php';
include '../admin/Database.php';
include 'order-mail.php';
$orderObj = new Order($conn);
$cartObj = new Cart($conn);
$productObj = new Product($conn);
$userObj = new User($conn);
$cartDetails = $cartObj->getCartDetails($_SESSION['email']);
$userinfo = $userObj->getUserInfo($_SESSION['id']);
$total = 0;
$productIds = []; // Array to store the product_ids
foreach ($cartDetails as $cartItem) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $product = $productObj->getProductwithId($cartItem['product_id']);
    $total += $product[0]['price'] + $cartItem['stamp_price'];
    $productIds[] = $cartItem['product_id'];
}
$deliveryCharge = 50;
$gstPercentage = 18;
$totalWithDelivery = $total + $deliveryCharge;
$gstAmount = ($totalWithDelivery * $gstPercentage) / 100;
$price = $totalWithDelivery + $gstAmount;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $postalcode = $_POST['postalcode'];
    $state = $_POST['state'];
    $order = $_SESSION['order_id'];
    $user_email = $_SESSION['email'];

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
    $udf3 = "";
    $udf4 = "";
    $udf5 = "";

    $pickupLocationId = '4153676';
    // API endpoint for authentication
    $authEndpoint = 'https://apiv2.shiprocket.in/v1/external/auth/login';

    // API endpoint for creating a shipment
    $shipmentEndpoint = 'https://apiv2.shiprocket.in/v1/external/orders/create/adhoc';

    // Sample authentication credentials
    $email = 'ranjithc@duck.com';
    $password = 'Fr7tqz@iWPdvNit';

    // Authenticate and obtain token
    $authData = array(
        'email' => $email,
        'password' => $password,
    );

    $authPayload = json_encode($authData);

    $authCh = curl_init($authEndpoint);
    curl_setopt($authCh, CURLOPT_RETURNTRANSFER, true);
    curl_setopt(
        $authCh,
        CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/json',
        )
    );
    curl_setopt($authCh, CURLOPT_POST, true);
    curl_setopt($authCh, CURLOPT_POSTFIELDS, $authPayload);

    $authResponse = curl_exec($authCh);

    if ($authResponse === false) {
        die('Error: ' . curl_error($authCh));
    }

    curl_close($authCh);

    $authData = json_decode($authResponse, true);

    if (!isset($authData['token'])) {
        die('Failed to authenticate. Please check your credentials or try again later.');
    }

    $token = $authData['token'];

    // Sample shipment data
    $shipmentData = array(
        'order_id' => $order,
        'order_date' => date('Y-m-d H:i:s'),
        'pickup_location' => 'Primary',
        'pickup_location_id' => $pickupLocationId,
        'billing_customer_name' => $firstname,
        'billing_last_name' => $lastname,
        'billing_address' => $address,
        'billing_city' => $city,
        'billing_pincode' => $postalcode,
        'billing_state' => $state,
        'billing_country' => 'India',
        'billing_email' => $userinfo['email'],
        'billing_phone' => $userinfo['phonenumber'],
        'shipping_is_billing' => true,
        'order_items' => array(),
        'payment_method' => 'Prepaid',
        'sub_total' => $price,
        'length' => 10,
        'breadth' => 5,
        'height' => 8,
        'weight' => 0.50,
    );
    foreach ($cartDetails as $cartItem1) {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $product1 = $productObj->getProductwithId($cartItem1['product_id']);

        $shipmentData['order_items'][] = array(
            'name' => $product1[0]['prod_name'],
            'sku' => $product1[0]['id'],
            'units' => 1,
            'selling_price' => $product1[0]['price'],
            'discount' => 0,
            'tax' => 0,
            'hsn' => 1234,
        );
    }

    // Convert shipment data to JSON
    $payload = json_encode($shipmentData);

    // Create cURL request for creating a shipment
    $shipmentCh = curl_init($shipmentEndpoint);
    curl_setopt($shipmentCh, CURLOPT_RETURNTRANSFER, true);
    curl_setopt(
        $shipmentCh,
        CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token,
        )
    );
    curl_setopt($shipmentCh, CURLOPT_POST, true);
    curl_setopt($shipmentCh, CURLOPT_POSTFIELDS, $payload);

    $shipmentResponse = curl_exec($shipmentCh);
    echo $shipmentResponse;
    if ($shipmentResponse === false) {
        die('Error: ' . curl_error($shipmentCh));
    }

    curl_close($shipmentCh);

    $shipmentData = json_decode($shipmentResponse, true);


    if (!isset($shipmentData['shipment_id'])) {
        die('Failed to create shipment. Please check your data or try again later.');
    }

    $shipmentId = $shipmentData['shipment_id'];

    // Output the response
    //echo 'Shipment ID: ' . $shipmentId;


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

    // print_r($data['udf1']);
    // Save order details to the database
    $orderObj->saveOrder($firstname, $lastname, $address, $city, $postalcode, $state, $order, $user_email, $udf1, $price); // Pass the array of product_ids
    sendOrderEmail($firstname, $lastname, $user_email, $table);

    // Create a form to submit payment data to PayU
    echo '<form method="post" action="' . $baseUrl . '" name="payuForm" id="payuForm">';
    foreach ($data as $key => $value) {
        echo '<input type="text" name="' . $key . '" value="' . $value . '">';
    }
    echo '</form>';

    // Automatically submit the form when the page loads
    echo '<script>document.addEventListener("DOMContentLoaded", function () {document.getElementById("payuForm").submit();});</script>';
}
?>