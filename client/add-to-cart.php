<?php
session_start();
require_once('config/config.php');
include('../admin/Database.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['submit'])) {
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
        header("Location: product-info.php?id=$encodedProductId&success=product added to cart");
        exit();
    } else {
        //echo "Error: Unable to add to cart.";
        header("Location: product-info.php?id=$encodedProductId&error=Error: Unable to add to cart");
    }
}
?>