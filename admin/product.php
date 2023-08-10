<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('config/config.php');
require('Database.php');
$product = new Product($conn);
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $prod_name = $_POST['prod_name'];
    $category = $_POST['categories'];
    $price = $_POST['price'];
    $details = $_POST['details'];
    $image = $_FILES['image'];

    // Save the product and handle any errors
    $result = $product->saveProduct($prod_name, $category, $price, $details, $image);

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