<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('config/config.php');
require_once('Database.php');
$templates = new Templates($conn);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the template name and fields from the form
    $templateName = $_POST['template_name'];
    $templateFields = $_POST['details'];
    $id = $_POST['id'];

    // Save the template
    $result = $templates->updateTemplate($templateName, $templateFields, $id);

    if ($result === true) {
        header('Location: template-info.php?success=Template Updated successfully&id=' . $id);
        exit();
    } else {
        header('Location: template-info.php?error=Error in updating');
        exit();
    }
}
?>