<?php
try {
    $pickupLocationId = '4156431';
    $pickupPostCode = '560037';
    $destinationPostalCode = $_POST['pincode'];
    // API endpoint for authentication
    $authEndpoint = 'https://apiv2.shiprocket.in/v1/external/auth/login';

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
        throw new Exception('Error: ' . curl_error($authCh));
    }

    curl_close($authCh);

    $authData = json_decode($authResponse, true);

    if (!isset($authData['token'])) {
        throw new Exception('Failed to authenticate. Please check your credentials or try again later.');
    }

    $token = $authData['token'];
    $weight = 0.5;
    $cod = 1;
    // Generate the shipping charges endpoint
    $shippingChargesEndpoint = 'https://apiv2.shiprocket.in/v1/external/courier/serviceability';
    $shippingChargesEndpoint .= '?pickup_postcode=' . urlencode($pickupPostCode); // Add pickup_postcode as GET parameter
    $shippingChargesEndpoint .= '&delivery_postcode=' . urlencode($destinationPostalCode); // Add delivery_postcode as GET parameter
    $shippingChargesEndpoint .= '&weight=' . $weight; // Add weight as GET parameter
    $shippingChargesEndpoint .= '&cod=' . $cod; // Add cod as GET parameter

    $shippingChargesCh = curl_init($shippingChargesEndpoint);
    curl_setopt($shippingChargesCh, CURLOPT_RETURNTRANSFER, true);
    curl_setopt(
        $shippingChargesCh,
        CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token,
        )
    );
    curl_setopt($shippingChargesCh, CURLOPT_CUSTOMREQUEST, 'GET');

    $shippingChargesResponse = curl_exec($shippingChargesCh);
    //echo $shippingChargesResponse;

    if ($shippingChargesResponse === false) {
        throw new Exception('Error: ' . curl_error($shippingChargesCh));
    }

    curl_close($shippingChargesCh);

    $shippingChargesData = json_decode($shippingChargesResponse, true);

    if (!isset($shippingChargesData['data']['available_courier_companies'][0]['freight_charge'])) {
        throw new Exception('Invalid Delivery Pincode.');
    }

    $shippingCharges = $shippingChargesData['data']['available_courier_companies'][0]['freight_charge'];

    // Output the response
    echo $shippingCharges;
} catch (Exception $e) {
    echo $e->getMessage();
}
?>