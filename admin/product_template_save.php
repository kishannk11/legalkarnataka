<?php
require_once('config/config.php');
require_once('Database.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $templatesObj = new Templates($conn);
    $prodName = $_POST['prod_name'];
    $selectedIDs = array();
    print_r($selectedIDs);
    for ($i = 1; $i <= 10; $i++) {
        $selectedID = $_POST['categories' . $i];
        if (!empty($selectedID)) {
            $selectedIDs[] = $selectedID;
        }
    }
    if (!empty($selectedIDs)) {
        if ($templatesObj->saveProdTemplate($prodName, $selectedIDs)) {
            header('Location: product_template.php?success=Template saved');
            exit();
        } else {
            header('Location: product_template.php?success=Error in Saving Data');
            exit();
        }
    } else {
        header('Location: product_template.php?error=No data selected');
        exit();
    }
}
?>