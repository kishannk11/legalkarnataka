<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('config/config.php');
require('Database.php');
$product = new Product($conn);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prodId = $_POST['prod_id'];
    $prodName = $_POST['prod_name'];
    $category = $_POST['categories'];
    $price = $_POST['price'];
    $details = $_POST['details'];
    $images = $_FILES['images'];
    $additionalfiles = $_POST['additionalfiles'];
    $categoryValues = explode('|', $category);
    $optgroup = $categoryValues[0];
    $selectedValue = $categoryValues[1];
    print_r($categoryValues);
    $result = $product->updateProduct($prodId, $prodName, $selectedValue, $price, $details, $images, $additionalfiles, $optgroup);

    if ($result) {
        $success = "Product updated successfully.";
        header('Location: update_prod.php?id=' . $prodId . '&success=' . urlencode($success));
    } else {
        $result = "Error: Unable to update product.";
        header('Location: update_prod.php?error=' . urlencode($result) . '&id=' . $prodId);
    }
}
?>