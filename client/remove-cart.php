<?php
require_once('config/config.php');
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM cart WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            $response = 'success';
        } else {
            $response = 'error';
        }
    } else {
        $response = 'error';
    }
} else {
    $response = 'error';
}

echo $response;
?>