<?php
require_once('config/config.php');
require_once('Database.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($_POST['submit'])) {
    $subCategoryObj = new SubCategory($conn);
    $id = $_POST['id'];
    $name = $_POST['sub_category'];
    $parentCategory = $_POST['parent-category'];

    $result = $subCategoryObj->updateSubCategory($id, $name, $parentCategory);

    if ($result) {
        header('Location: sub-edit.php?id=..');
        $success = "Updated";
        header('Location: sub-edit.php?id=' . $id . '&success=' . urlencode($success));
        exit();
    } else {
        $error = "Error: Unable to update sub-category.";
        header('Location: sub-edit.php?id=' . $id . '&error=' . urlencode($error));
    }
}
?>