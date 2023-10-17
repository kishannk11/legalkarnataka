<?php
include 'config/config.php';
include 'Database.php';
$status = $_POST['status'];
$orderId = $_POST['order_id'];

$orderDetailsObj = new Order($conn);
$result = $orderDetailsObj->updateOrderStatus($orderId, $status);

if ($result) {
    echo "Status updated successfully";
} else {
    echo "An error occurred";
}
?>