<?php
include 'config/config.php';
include '../admin/Database.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$searchQuery = filter_var(urldecode($_POST['query']), FILTER_SANITIZE_FULL_SPECIAL_CHARS); // Decode and sanitize user input
$productObj = new Product($conn);
$products = $productObj->searchProducts($searchQuery);

if ($products) {
    foreach ($products as $product) {
        echo "<p><a href='product-info.php?id=" . htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($product['prod_name'], ENT_QUOTES, 'UTF-8') . "</a></p>";
    }
} else {
    echo "<p>No results found</p>";
}
?>