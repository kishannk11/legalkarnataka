<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('config/config.php');
require('Database.php');
if (isset($_POST['submit'])) {
    $productObj = new Product($conn);
    $prodName = $_POST['prod_name'];
    $category = $_POST['categories'];
    $price = $_POST['price'];
    $details = $_POST['details'];

    $result = $productObj->addProduct($prodName, $category, $price, $details);

    if ($result) {
        echo "Product added successfully.";
    } else {
        echo "Error: Unable to add product.";
    }
}
?>