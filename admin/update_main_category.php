<?php
require_once('config/config.php');
require_once('Database.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($_POST['submit'])) {
    $MainCategoryObj = new MainCategory($conn);
    $id = $_POST['id'];
    $name = $_POST['main_category'];

    $result = $MainCategoryObj->updateMainCategory($id, $name);

    if ($result) {
        header('Location: main-edit.php?id=..');
        $success = "Updated";
        header('Location: main-edit.php?id=' . $id . '&success=' . urlencode($success));
        exit();
    } else {
        $error = "Error: Unable to update Main-category.";
        header('Location: main-edit.php?id=' . $id . '&error=' . urlencode($error));
    }
}
?>