<?php
require_once('config/config.php');
require_once('Database.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($_GET['id'])) {
    $Id = $_GET['id'];

    $userObj = new MainCategory($conn);
    $result = $userObj->deleteMain($Id);

    if ($result) {
        $success = "Main Category Deleted";
        header('Location: view-all-main-category.php?success=' . urlencode($success));
        exit();
    } else {
        $error = "Error deleting the Main Category.";
        header('Location: view-all-main-category.php?success=' . urlencode($error));


    }
}
?>