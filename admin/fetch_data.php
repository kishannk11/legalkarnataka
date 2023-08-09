<?php
require_once('config/config.php');
require_once('Database.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ids = json_decode($_POST['ids']);

    $templates = new Templates($conn);
    $data = $templates->getTemplate($ids);

    // Convert the data to JSON format and send it as the response
    echo json_encode($data);
}
?>