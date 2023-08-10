<?php
require_once('config/config.php');
require_once('Database.php');

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    $productObj = new Product($conn);
    $result = $productObj->deleteProduct($productId);

    if ($result) {
        $success = "Product Deleted";
        header('Location: product-list.php?success=' . urlencode($success));
        exit();
    } else {
        $error = "Error deleting the product.";
        header('Location: product-list.php?success=' . urlencode($error));


    }
}
?>