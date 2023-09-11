<?php
require_once('config/config.php');
require_once('Database.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($_GET['id'])) {
    $Id = $_GET['id'];

    $userObj = new SubCategory($conn);
    $result = $userObj->deleteSub($Id);

    if ($result) {
        $success = "Sub Category Deleted";
        header('Location: view-all-sub-category.php?success=' . urlencode($success));
        exit();
    } else {
        $error = "Error deleting the Sub Category.";
        header('Location: view-all-sub-category.php?success=' . urlencode($error));


    }
}
?>