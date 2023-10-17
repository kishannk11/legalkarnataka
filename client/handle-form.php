<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'config/config.php';
include '../admin/Database.php';
$OrderObj = new Order($conn);

if (isset($_GET['action'])) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS);
    if ($action === 'accept' || $action === 'callback') {
        // Check if email and orderid parameters are set
        if (isset($_GET['email']) && isset($_GET['orderid'])) {
            $email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL);
            $orderid = filter_input(INPUT_GET, 'orderid', FILTER_SANITIZE_NUMBER_INT);

            // Check if email is associated with the orderid
            $isAssociated = $OrderObj->checkEmailOrderAssociation($email, $orderid);

            if ($isAssociated) {
                // Save the email, orderid, and action to the database
                $OrderObj->saveSoftcopyInfo($action, $email, $orderid);

                // Check the value of $action
                if ($action === 'callback') {
                    echo "Our representative will call you for more information.";
                } else {
                    echo "Thank you for your submission.";
                }
            } else {
                echo "Email is not associated with the provided order ID.";
            }
        } else {
            echo "Missing email or orderid parameter.";
        }
    } else {
        echo "Invalid action! Only 'accept' and 'callback' are allowed.";
    }
}
?>