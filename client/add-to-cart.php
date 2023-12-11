<?php
session_start();
require_once('config/config.php');
include('../admin/Database.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['id'])) {
    $productId = $_POST['id'];
    $price = $_POST['price'];
    $email = $_SESSION['email'];
    $cartObj = new Cart($conn);
    $productObj = new Product($conn);
    if (empty($price)) {
        $StamPrice = 0;
    } else {
        $StamPrice = $price;
    }
    $product = $productObj->getProductwithId($productId);
    $price = $product[0]['price'];
    $result = $cartObj->addToCart($productId, $price, $email, $StamPrice);
    $encodedProductId = urlencode($productId);
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Product added to cart']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: Unable to add to cart']);
    }
}
?>