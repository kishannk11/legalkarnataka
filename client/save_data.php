<?php
session_start();
require_once('config/config.php');
// Assuming you have a database connection object named $conn
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Get the data from the AJAX request
$data = json_decode(file_get_contents('php://input'), true);

// Sanitize and validate the data if needed
$label = isset($data['label']) ? $data['label'] : '';
$value = isset($data['value']) ? $data['value'] : '';
$id = isset($data['id']) ? $data['id'] : '';
$order_id = isset($data['order_id']) ? $data['order_id'] : '';

// Get the email from the session
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

$sql = "INSERT INTO preview_data (label, value, email,product_id,order_id) VALUES (:label, :value, :email, :product_id, :order_id)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':label', $label);
$stmt->bindParam(':value', $value);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':product_id', $id);
$stmt->bindParam(':order_id', $order_id);

// Execute the statement
if ($stmt->execute()) {
    $response = array('success' => true, 'message' => 'Data saved successfully');
} else {
    $response = array('success' => false, 'message' => 'Failed to save data');
}

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);

?>