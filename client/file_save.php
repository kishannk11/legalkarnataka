<?php
require_once('config/session.php');
require_once('config/config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($_FILES['files'])) {
    $fileCount = count($_FILES['files']['name']);
    for ($i = 0; $i < $fileCount; $i++) {
        $fileName = $_FILES['files']['name'][$i];
        $fileTmpName = $_FILES['files']['tmp_name'][$i];
        $fileType = $_FILES['files']['type'][$i];
        $fileSize = $_FILES['files']['size'][$i];
        $fileError = $_FILES['files']['error'][$i];

        $targetDirectory = '../admin/upload/';
        $targetFile = $targetDirectory . $fileName;
        move_uploaded_file($fileTmpName, $targetFile);

        // Save file details to the database
        $email = $_SESSION['email'];
        $orderID = $_SESSION['order_id'];
        $stmt = $conn->prepare("INSERT INTO files (email, order_id, file_name) VALUES (?, ?, ?)");
        $stmt->execute([$email, $orderID, $fileName]);
    }
}
?>