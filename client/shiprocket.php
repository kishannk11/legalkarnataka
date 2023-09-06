<?php
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
    'order_id' => '14533333',
    'order_date' => date('Y-m-d H:i:s'),
    'pickup_location' => 'Primary',
    'pickup_location_id' => $pickupLocationId,
    'billing_customer_name' => 'John Doe',
    'billing_last_name' => 'Doe',
    'billing_address' => '123, Silkboard, Banglore',
    'billing_city' => 'Banglore',
    'billing_pincode' => '560068',
    'billing_state' => 'Karnataka',
    'billing_country' => 'India',
    'billing_email' => 'john.doe@example.com',
    'billing_phone' => '7978443474',
    'shipping_is_billing' => true,
    'order_items' => array(
        array(
            'name' => 'Product 1',
            'sku' => 'SKU001',
            'units' => 1,
            'selling_price' => 100,
            'discount' => 0,
            'tax' => 0,
            'hsn' => 1234,
        ),
        array(
            'name' => 'Product 2',
            'sku' => 'SKU002',
            'units' => 2,
            'selling_price' => 50,
            'discount' => 0,
            'tax' => 0,
            'hsn' => 5678,
        ),
    ),
    'payment_method' => 'Prepaid',
    'sub_total' => 250,
    'length' => 10,
    'breadth' => 5,
    'height' => 8,
    'weight' => 0.25,
);


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
//echo $shipmentResponse;
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
?>