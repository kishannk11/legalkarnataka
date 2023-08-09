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

    // Save the template
    $result = $templates->saveTemplate($templateName, $templateFields);

    if ($result === true) {
        header('Location: create_template.php?success=Template saved successfully');
        exit();
    } elseif (!empty($result)) {
        header('Location: create_template.php?error=All fields Required');
        exit();
    }
}
?>