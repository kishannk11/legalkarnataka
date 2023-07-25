<?php
require_once('config/config.php');
require('Database.php');
$mainCategoryObj = new MainCategory($conn);
// Check if the form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate the input
    if(empty(trim($_POST['main_category']))) {
        $error="Please Enter Category";
        header("Location: main-category.php?error=". urlencode($error));
    } else {
        $mainCategory = htmlspecialchars(trim($_POST['main_category']), ENT_QUOTES, 'UTF-8');
        // Call the addMainCategory method
        $mainCategoryObj->addMainCategory($mainCategory);
        // Redirect back to main-category.php page
        $success="Category Added";
        header("Location: main-category.php?success=". urlencode($success));
        exit;
    }
}
?>