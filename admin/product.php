<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('config/config.php');
require('Database.php');
$product = new Product($conn);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prod_name = $_POST['prod_name'];
    $categories = $_POST['categories'];
    $price = $_POST['price'];
    $details = $_POST['details'];
    $image = $_FILES['image'];
    $additionalfiles = $_POST['additionalfiles']; // Get the additional files from the form data
    $categoryValues = explode('|', $categories);
    $optgroup = $categoryValues[0];
    $selectedValue = $categoryValues[1];

    // Save the product and handle any errors
    $result = $product->saveProduct($prod_name, $selectedValue, $price, $details, $image, $additionalfiles, $optgroup);

    // Redirect with error message if necessary
    if ($result === true) {
        $success = "Product saved successfully";
        header('Location: product-add.php?success=' . urlencode($success));
        exit();
    } elseif (!empty($result)) {
        header('Location: product-add.php?error=' . urlencode($result));
        exit();
    }
}

?>