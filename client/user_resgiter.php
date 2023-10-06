<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('config/config.php');
require_once('../admin/Database.php');
require_once('smtp_credentails.php');
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = sanitizeInput($_POST['firstname']);
    $lastname = sanitizeInput($_POST['lastname']);
    $email = sanitizeInput($_POST['email']);
    $phonenumber = sanitizeInput($_POST['phonenumber']);
    $password = sanitizeInput($_POST['password']);
    $confirmpassword = sanitizeInput($_POST['confirmpassword']);

    // Validate the input
    $errors = array();

    if (empty($firstname)) {
        $errors[] = "First name is required.";
    }

    if (empty($lastname)) {
        $errors[] = "Last name is required.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($phonenumber)) {
        $errors[] = "Phone number is required.";
    }

    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    if ($password !== $confirmpassword) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($errors)) {
        // Create a User object and save the data to the database
        $userObj = new User($conn);
        $result = $userObj->registerUser($firstname, $lastname, $email, $phonenumber, $password);

        if ($result) {
            // Registration successful
            sendRegistrationEmail($firstname, $lastname, $email);
            header("Location: register.php?success=User Registered");
            exit();
        } else {

            header("Location: register.php?error=Error: User Already exist.");
            exit();
        }
    } else {
        // Send errors to the register.php page using GET method
        $errorString = implode(",", $errors);
        $url = "register.php?error=" . urlencode($errorString);
        header("Location: " . $url);
        exit();
    }
}

function sanitizeInput($input)
{
    $sanitizedInput = htmlspecialchars($input);
    return $sanitizedInput;
}
function sendRegistrationEmail($firstname, $lastname, $email)
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
        $mail->Subject = 'Registration Successful';
        $mail->Body = '<table
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
                                                                                                                                            Dear 
                                                                                                                                            '
            .
            $firstname
            .
            '
                                                                                                                                            '
            .
            $lastname
            .
            '
                                                                                                                                        </span><br><span>
                                                                                                                                            Welcome
                                                                                                                                            to
                                                                                                                                            Legal
                                                                                                                                            Karnataka.
                                                                                                                                            Thank
                                                                                                                                            You
                                                                                                                                            for
                                                                                                                                            Registering.
                                                                                                                                        </span>
                                                                                                                                    </p>
                                                                                                                                    <p
                                                                                                                                        style="margin: 0; font-size: 18px; line-height: 1.8; word-break: break-word; text-align: center; mso-line-height-alt: 32px; margin-top: 0; margin-bottom: 0;">
    
                                                                                                                                    </p>
                                                                                                                                    &nbsp;
																																&nbsp;
																																&nbsp;
																																<p
																																	style="margin: 0; font-size: 18px; line-height: 1.8; word-break: break-word; text-align: center; mso-line-height-alt: 32px; margin-top: 0; margin-bottom: 0;">
																																	<a href="https://legalkarnataka.com/client/index.php"
																																		style="text-decoration: none;">
																																		<button
																																			style="padding: 10px 20px; background-color: #007bff; color: #fff; border: none; cursor: pointer;">
																																			Login
																																		</button>
																																	</a>
																																</p>
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
                                                                                                                                            <strong>LegalKarnataka.com</strong> |
                                                                                                                                                Bangalore, Karnataka, BHARATH</span>
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
    </table>
        '
        ;

        $mail->send();
        echo 'Email sent to ' . $email;
    } catch (Exception $e) {
        // Handle any exceptions or errors that occur during the email sending process
        echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
        //header("Location:register.php?error=" . $mail->ErrorInfo);
    }
}
?>