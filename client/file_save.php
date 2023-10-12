<?php
require_once('config/session.php');
require_once('config/config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$response = ['success' => false, 'message' => ''];

if (isset($_FILES['files']) && isset($_GET['id'])) {
    $fileCount = count($_FILES['files']['name']);
    $id = $_GET['id']; // Get the id from the query parameter

    for ($i = 0; $i < $fileCount; $i++) {
        $fileName = $_FILES['files']['name'][$i];
        $fileTmpName = $_FILES['files']['tmp_name'][$i];
        $fileType = $_FILES['files']['type'][$i];
        $fileSize = $_FILES['files']['size'][$i];
        $fileError = $_FILES['files']['error'][$i];
        $targetDirectory = '../admin/upload/';
        $targetFile = $targetDirectory . $fileName;
        // Fix: Sanitize the file name before moving it
        $sanitizedFileName = basename($fileName);
        // Check if the file is a PDF or an image
        if (in_array($fileType, ['application/pdf', 'image/jpeg', 'image/png', 'image/gif'])) {
            move_uploaded_file($fileTmpName, $targetDirectory . $sanitizedFileName);

            $email = $_SESSION['email'];
            $orderID = $_SESSION['order_id'];

            $stmt = $conn->prepare("INSERT INTO files (email, order_id, file_name, prod_id) VALUES (?, ?, ?, ?)");
            $stmt->execute([$email, $orderID, $fileName, $id]);

            $response['success'] = true;
            $response['message'] = 'File(s) uploaded successfully';
        } else {
            $response['message'] = "Error: Only PDF and image files are allowed.";
        }
    }
} else {
    $response['message'] = "Error: No files or id provided.";
}

header('Content-Type: application/json');
echo json_encode($response);
?>