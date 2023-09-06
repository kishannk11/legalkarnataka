<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//include '../admin/Database.php';
require_once('config/config.php');
require_once('smtp_credentails.php');
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include('config/config.php');
$cartObj = new Cart($conn);
$productObj = new Product($conn);
$cartDetails = $cartObj->getCartDetails($_SESSION['email']);
$table = '<table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Stamp Price</th>
                </tr>
            </thead>
            <tbody>';
$total = 0;
foreach ($cartDetails as $cartItem) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $product = $productObj->getProductwithId($cartItem['product_id']);
    $total += $product[0]['price'] + $cartItem['stamp_price'];
    $productIds[] = $cartItem['product_id'];
    // Add each product to the table
    $table .= '<tr>
                    <td>' . $product[0]['prod_name'] . '</td>
                    <td>' . $product[0]['price'] . '</td>
                    <td>' . $cartItem['stamp_price'] . '</td>
                </tr>';
}
$deliveryCharge = 50;
$gstPercentage = 18;
$totalWithDelivery = $total + $deliveryCharge;
$gstAmount = ($totalWithDelivery * $gstPercentage) / 100;
$price = $totalWithDelivery + $gstAmount;
// Close the table
$table .= '<tr>
                <td>Total GST Price</td>
                <td>' . $gstAmount . '</td>
            </tr>
     ';
$table .= '<tr>
                <td>Total Delivery Price</td>
                <td>' . $deliveryCharge . '</td>
            </tr>
       ';
$table .= '<tr>
                <td>Total Price</td>
                <td>' . $price . '</td>
            </tr>
        </tbody>
    </table>';
//echo $table;
$firstname = "test";
$lastname = "lastname";
$email = "ranjithchandran220@gmail.com";
function sendOrderEmail($firstname, $lastname, $email, $table)
{


    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = SMTP_HOST;
        $mail->Port = SMTP_PORT;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->SMTPSecure = 'ssl';

        $mail->setFrom('support@legalkarnataka.com', 'Legal Karnataka');
        $mail->addAddress($email, $firstname . ' ' . $lastname);

        $mail->isHTML(true);
        $mail->Subject = 'Orde Details';
        $mail->Body = $table;
        $mail->send();
        echo 'Email sent to ' . $email;
    } catch (Exception $e) {
        // Handle any exceptions or errors that occur during the email sending process
        echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
        //header("Location:register.php?error=" . $mail->ErrorInfo);
    }
}
?>