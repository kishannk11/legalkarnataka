<?php
require_once('config/config.php');
require('Database.php');
 if (isset($_POST['submit'])) {
    $subCategoryObj = new SubCategory($conn);
    $name = $_POST['sub_category'];
    $parentCategory = $_POST['parent-category'];
     // Validate the sub_category field
     if (empty($parentCategory)) {
        $error = "Parent Category name is required.";
        header("Location: sub-category.php?error=".urlencode($error));
    }else if (empty($name)) {
        $error = "Sub Category name is required.";
        header("Location: sub-category.php?error=".urlencode($error));
    } else {
        $result = $subCategoryObj->addSubCategory($name, $parentCategory);
         if ($result) {
            $success = "Added Sub Category";
            header("Location: sub-category.php?success=".urlencode($success));
            exit();
        } else {
            $error = "Error: Unable to add sub-category.";
            header("Location: sub-category.php?error=".urlencode($error));
        }
    }
}
?>