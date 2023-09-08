<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//include '../admin/Database.php';
require_once 'vendor/autoload.php';
require_once('config/config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('smtp_credentails.php');
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
session_start();
include('config/config.php');
$orderID = $_SESSION['order_id'];
$cartObj = new Cart($conn);
$productObj = new Product($conn);
$cartDetails = $cartObj->getCartDetails($_SESSION['email']);
$table = '<table
style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; width: 100%; user-select: none;"
width="100%" cellspacing="0" cellpadding="0" bgcolor="#f5eeee">
<tbody>
    <tr style="vertical-align: top;" valign="top">
        <td style="word-break: break-word; vertical-align: top;" valign="top">
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tbody>
                    <tr>
                        <td align="center">
                            <div style="background-color: #f5eeee;">
                                <div
                                    style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: transparent;">
                                    <div
                                        style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
                                        <table style="background-color: #113969;" width="100%" cellspacing="0"
                                            cellpadding="0" border="0">
                                            <tbody>
                                                <tr>
                                                    <td align="center">
                                                        <table style="width: 600px;" cellspacing="0" cellpadding="0"
                                                            border="0">
                                                            <tbody>
                                                                <tr style="background-color: transparent;">
                                                                    <td style="background-color: transparent; width: 600px; border: 0px solid transparent;"
                                                                        width="600" valign="top" align="center">
                                                                        <table width="100%" cellspacing="0"
                                                                            cellpadding="0" border="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="padding: 0px;">
                                                                                        <div
                                                                                            style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
                                                                                            <div
                                                                                                style="width: 100% !important;">
                                                                                                <div
                                                                                                    style="border: 0px solid transparent; padding: 0px;">
                                                                                                    <div style="padding-right: 30px; padding-left: 30px;"
                                                                                                        align="center">
                                                                                                        <table
                                                                                                            width="100%"
                                                                                                            cellspacing="0"
                                                                                                            cellpadding="0"
                                                                                                            border="0">
                                                                                                            <tbody>
                                                                                                                <tr
                                                                                                                    style="line-height: 0px;">
                                                                                                                    <td style="padding-right: 30px; padding-left: 30px;"
                                                                                                                        align="center">
                                                                                                                        <div
                                                                                                                            style="font-size: 1px; line-height: 35px;">
                                                                                                                            &nbsp;
                                                                                                                        </div>
                                                                                                                        <img style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; width: 100%; max-width: 150px; display: block;"
                                                                                                                            src="https://legalkarnataka.com/client/assets/images/logo/legal.png"
                                                                                                                            alt=""
                                                                                                                            width="150"
                                                                                                                            border="0"
                                                                                                                            align="middle">
                                                                                                                        <div
                                                                                                                            style="font-size: 1px; line-height: 35px;">
                                                                                                                            &nbsp;
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </div>

                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div
                                style="background-position: top left; background-repeat: no-repeat; background-color: #f5f0f0;">
                                <div
                                    style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
                                    <div
                                        style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                            <tbody>
                                                <tr>
                                                    <td align="center">
                                                        <table style="width: 600px;" cellspacing="0" cellpadding="0"
                                                            border="0">
                                                            <tbody>
                                                                <tr style="background-color: #ffffff;">
                                                                    <td style="background-color: #ffffff; width: 600px; border: 0px solid transparent;"
                                                                        width="600" valign="top" align="center">
                                                                        <table width="100%" cellspacing="0"
                                                                            cellpadding="0" border="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="padding: 0px;">
                                                                                        <div
                                                                                            style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
                                                                                            <div
                                                                                                style="width: 100% !important;">
                                                                                                <div
                                                                                                    style="border: 0px solid transparent; padding: 0px;">
                                                                                                    <table
                                                                                                        style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                                                                        width="100%"
                                                                                                        cellspacing="0"
                                                                                                        cellpadding="0">
                                                                                                        <tbody>
                                                                                                            <tr style="vertical-align: top;"
                                                                                                                valign="top">
                                                                                                                <td style="word-break: break-word; vertical-align: top; text-align: center; width: 100%; padding: 25px 0px 5px 0px;"
                                                                                                                    width="100%"
                                                                                                                    valign="top"
                                                                                                                    align="center">
                                                                                                                    <h1
                                                                                                                        style="color: #555555; direction: ltr; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; font-size: 30px; font-weight: normal; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;padding: 0 50px;">

                                                                                                                    </h1>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <table
                                                                                                        width="100%"
                                                                                                        cellspacing="0"
                                                                                                        cellpadding="0"
                                                                                                        border="0">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td
                                                                                                                    style="font-family: Arial, sans-serif;">
                                                                                                                    <div
                                                                                                                        style="color: #737487; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; line-height: 1.8; padding: 20px 15px 20px 15px;">
                                                                                                                        <div
                                                                                                                            style="font-size: 14px; line-height: 1.8; color: #737487; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 25px;">
                                                                                                                            <p
                                                                                                                                style="margin: 0; font-size: 18px; line-height: 1.8; word-break: break-word; text-align: center; mso-line-height-alt: 32px; margin-top: 0; margin-bottom: 0;">
                                                                                                                                <span
                                                                                                                                    style="font-size: 18px;">
                                                                                                                                    Hi   
                                                                                                                                    
   
                                                                                                                                    
    
                                                                                                                                </span><br><span>
                                                                                                                                    Your order number is ' . $orderID . '
                                                                                                                                    <table style="border-collapse: collapse; border: 1px solid black;margin-left: auto; margin-right: auto;">
                                                                                                                                        <thead>
                                                                                                                                            <tr>
                                                                                                                                                <th style="border: 1px solid black;">Product Name</th>
                                                                                                                                                <th style="border: 1px solid black;">Price</th>
                                                                                                                                                <th style="border: 1px solid black;">Stamp Price</th>
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
                    <td style="border: 1px solid black;">' . $product[0]['prod_name'] . '</td>
                    <td style="border: 1px solid black;">' . $product[0]['price'] . '</td>
                    <td style="border: 1px solid black;">' . $cartItem['stamp_price'] . '</td>
                </tr>';
}
$deliveryCharge = 50;
$gstPercentage = 18;
$totalWithDelivery = $total + $deliveryCharge;
$gstAmount = ($totalWithDelivery * $gstPercentage) / 100;
$price = $totalWithDelivery + $gstAmount;
// Close the table
$table .= '<tr>
                <td style="border: 1px solid black;">Total GST Price</td>
                <td style="border: 1px solid black;">' . $gstAmount . '</td>
            </tr>
     ';
$table .= '<tr>
                <td style="border: 1px solid black;">Total Delivery Price</td>
                <td style="border: 1px solid black;">' . $deliveryCharge . '</td>
            </tr>
       ';
$table .= '<tr>
                <td style="border: 1px solid black;">Total Price</td>
                <td style="border: 1px solid black;">' . $price . '</td>
            </tr>
        </tbody>
    </table>
    &nbsp;
    &nbsp;
    &nbsp;
    Thank you for ordering </br>
                                                                                                                                    Team legal Karnataka
                                                                                                                                </span>
                                                                                                                            </p>
                                                                                                                            <p
                                                                                                                                style="margin: 0; font-size: 18px; line-height: 1.8; word-break: break-word; text-align: center; mso-line-height-alt: 32px; margin-top: 0; margin-bottom: 0;">

                                                                                                                            </p>
                                                                                                                            &nbsp;
                                                                                                                        &nbsp;
                                                                                                                        &nbsp;
                                                                                                                        
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <div
                                                                                                        align="center">
                                                                                                        <table
                                                                                                            style="border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                                                                            width="100%"
                                                                                                            cellspacing="0"
                                                                                                            cellpadding="0"
                                                                                                            border="0">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <td style="padding: 20px 15px 40px 15px;"
                                                                                                                        align="center">
                                                                                                                        <center
                                                                                                                            style="font-family: Arial, sans-serif; font-size: 16px;">
                                                                                                                            <div
                                                                                                                                style="text-decoration: none; display: inline-block; color: #ffffff; background-color: #ff4f5a; border-radius: 4px; -webkit-border-radius: 4px; -moz-border-radius: 4px; width: auto; padding-top: 10px; padding-bottom: 10px; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; text-align: center; mso-border-alt: none; word-break: keep-all; cursor: pointer;">

                                                                                                                            </div>
                                                                                                                        </center>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color: #f8f3f3;">
                                <div
                                    style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: transparent;">
                                    <div
                                        style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
                                        <table style="background-color: #ff4f5a;" width="100%" cellspacing="0"
                                            cellpadding="0" border="0">
                                            <tbody>
                                                <tr>
                                                    <td align="center">
                                                        <table style="width: 600px;" cellspacing="0" cellpadding="0"
                                                            border="0">
                                                            <tbody>
                                                                <tr style="background-color: transparent;">
                                                                    <td style="background-color: transparent; width: 600px; border: 0px solid transparent;"
                                                                        width="600" valign="top" align="center">
                                                                        <table width="100%" cellspacing="0"
                                                                            cellpadding="0" border="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="padding: 0px;">
                                                                                        <div
                                                                                            style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
                                                                                            <div
                                                                                                style="width: 100% !important;">
                                                                                                <div
                                                                                                    style="border: 0px solid transparent; padding: 0px;">

                                                                                                    <table
                                                                                                        width="100%"
                                                                                                        cellspacing="0"
                                                                                                        cellpadding="0"
                                                                                                        border="0">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td
                                                                                                                    style="font-family: Arial, sans-serif; padding: 30px 5px 5px 5px;">
                                                                                                                    <div
                                                                                                                        style="font-family: Arial, Helvetica Neue, Helvetica, sans-serif; line-height: 1.2; padding: 30px 5px 5px 5px;">
                                                                                                                        <div
                                                                                                                            style="line-height: 1.2; font-size: 12px; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;mso-line-height-alt: 14px;">
                                                                                                                            <p
                                                                                                                                style="margin: 0; color: #ffffff; font-size: 12px; line-height: 1.2; word-break: break-word; text-align: center; mso-line-height-alt: 14px; margin-top: 0; margin-bottom: 0;">
                                                                                                                                <span
                                                                                                                                    style="font-size: 12px;">&copy;
                                                                                                                                    2023
                                                                                                                                    <strong>Legal
                                                                                                                                        Karnataka</strong>|
                                                                                                                                         Bangalore, Karnataka, BHARATH
                                                                                                                                    </span>
                                                                                                                            </p>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <table
                                                                                                        width="100%"
                                                                                                        cellspacing="0"
                                                                                                        cellpadding="0"
                                                                                                        border="0">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td
                                                                                                                    style="font-family: Arial, sans-serif; padding: 5px 10px 35px 10px;">
                                                                                                                    <div
                                                                                                                        style="font-family: Arial, Helvetica Neue, Helvetica, sans-serif; line-height: 1.2; padding: 5px 10px 35px 10px;">
                                                                                                                        <div
                                                                                                                            style="line-height: 1.2; font-size: 12px; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 14px;">
                                                                                                                            <p
                                                                                                                                style="margin: 0;  color: #ffffff; font-size: 12px; line-height: 1.2; word-break: break-word; text-align: center; mso-line-height-alt: 14px; margin-top: 0; margin-bottom: 0;">
                                                                                                                                <span
                                                                                                                                    style="font-size: 12px;">
                                                                                                                                    <a style="text-decoration: underline;"
                                                                                                                                        href=""
                                                                                                                                        target="_blank"
                                                                                                                                        rel="noopener"><strong></strong></a></span>
                                                                                                                            </p>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
</tbody>
</table>';
/* $table = '<table style="border-collapse: collapse; border: 1px solid black;">
            <thead>
                <tr>
                    <th style="border: 1px solid black;">Product Name</th>
                    <th style="border: 1px solid black;">Price</th>
                    <th style="border: 1px solid black;">Stamp Price</th>
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
                    <td style="border: 1px solid black;">' . $product[0]['prod_name'] . '</td>
                    <td style="border: 1px solid black;">' . $product[0]['price'] . '</td>
                    <td style="border: 1px solid black;">' . $cartItem['stamp_price'] . '</td>
                </tr>';
}
$deliveryCharge = 50;
$gstPercentage = 18;
$totalWithDelivery = $total + $deliveryCharge;
$gstAmount = ($totalWithDelivery * $gstPercentage) / 100;
$price = $totalWithDelivery + $gstAmount;
// Close the table
$table .= '<tr>
                <td style="border: 1px solid black;">Total GST Price</td>
                <td style="border: 1px solid black;">' . $gstAmount . '</td>
            </tr>
     ';
$table .= '<tr>
                <td style="border: 1px solid black;">Total Delivery Price</td>
                <td style="border: 1px solid black;">' . $deliveryCharge . '</td>
            </tr>
       ';
$table .= '<tr>
                <td style="border: 1px solid black;">Total Price</td>
                <td style="border: 1px solid black;">' . $price . '</td>
            </tr>
        </tbody>
    </table>'; */
//echo $table;
$firstname = "test";
$lastname = "lastname";
$email = "ranjithchandran220@gmail.com";

/* require_once('TCPDF-main/tcpdf.php');


$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Sample PDF');
$pdf->SetSubject('Sample PDF');
$pdf->SetKeywords('TCPDF, PDF, example');

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage();

$pdf->writeHTML($table, true, false, true, false, '');

// Get the order ID and email from session
$order_id = $_SESSION['order_id'];
$email = $_SESSION['email'];
$pdf_name = $order_id . '.pdf';

// Specify the file path to save the PDF
$file_path = 'pdf/' . $pdf_name;

// Save the PDF to the specified file path
$pdf->Output($file_path, 'F');

// Save the PDF details to the database
$savepdfObj->savePdfToDb($order_id, $email, $pdf_name); */

// Output the generated PDF to the browser
//$dompdf->stream($pdf_name, ['Attachment' => false]);
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
        $mail->Subject = 'Order Details';
        $mail->Body = $table;
        $mail->send();
        //echo 'Email sent to ' . $email;
    } catch (Exception $e) {
        // Handle any exceptions or errors that occur during the email sending process
        echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
        //header("Location:register.php?error=" . $mail->ErrorInfo);
    }
}
?>