<?php
require_once('config/config.php');
require_once('../admin/Database.php');
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
            header("Location: register.php?success=User Registered");
            exit();
        } else {
            echo "Error: Unable to register user.";
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
?>