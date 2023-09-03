<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('config/config.php');
require('Database.php');
$admin = new User($conn);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $id = $_POST['id'];
    $phone = $_POST['phone'];

    // Validate and sanitize input
    $firstname = htmlspecialchars(strip_tags($firstname));
    $lastname = htmlspecialchars(strip_tags($lastname));
    $email = htmlspecialchars(strip_tags($email));
    $password = htmlspecialchars(strip_tags($password));
    $phone = htmlspecialchars(strip_tags($phone));
    $new_image = $_FILES['image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        if ($_FILES['image']['type'] == 'image/png' || $_FILES['image']['type'] == 'image/jpg' || $_FILES['image']['type'] == 'image/jpeg') {
            if ($_FILES['image']['size'] < 1000000) { // Check file size
                // Image file is valid, continue with upload
                $random_filename = rand() . $_FILES['image']['name'];
                $target_file = 'upload/' . $random_filename;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    // Image uploaded successfully 
                } else {
                    $error = "Unable to upload image.";
                    header('Location: user-edit.php?id=' . $id . '&error=' . urlencode($error));
                }
            } else {
                $error = "Image file too large!";
                header('Location: user-edit.php?id=' . $id . '&error=' . urlencode($error));
            }
        } else {
            $error = "Invalid image file format!";
            header('Location: user-edit.php?id=' . $id . '&error=' . urlencode($error));
        }
    } else {
        // No new image uploaded, get old image filename
        $old_image = $admin->getUserInfo($id);
        $target_file = $old_image['image'];
    }
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    // Update user info
    if (!empty($password)) {
        $result = $admin->updateUser([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => $hashedPassword,
            'phonenumber' => $phone,
            'id' => $id,
            'image' => $target_file
        ]);
    } else {
        $result = $admin->updateUserWithoutPassword([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'phonenumber' => $phone,
            'id' => $id,
            'image' => $target_file
        ]);
    }

    if ($result) {
        $success = "User updated successfully.";
        header('Location: user-edit.php?id=' . $id . '&success=' . urlencode($success));
    } else {
        $error = "Unable to update the User.";
        header('Location: user-edit.php?id=' . $id . '&error=' . urlencode($error));
    }
}
?>