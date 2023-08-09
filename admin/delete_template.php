<?php
require_once('config/config.php');
require_once('Database.php');

if (isset($_GET['id'])) {
    $templateId = $_GET['id'];

    $templateObj = new Templates($conn);
    $result = $templateObj->deleteTemplate($templateId);

    if ($result) {
        $success = "Template Deleted";
        header('Location: template_list.php?success=' . urlencode($success));
        exit();
    } else {
        $error = "Error deleting this Template.";
        header('Location: template_list.php?success=' . urlencode($error));


    }
}
?>