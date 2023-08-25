<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('config/config.php');
require('Database.php');
$admin = new Admin($conn);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $id = 1; // Assuming admin ID is 1

    // Validate and sanitize input
    $name = htmlspecialchars(strip_tags($name));
    $email = htmlspecialchars(strip_tags($email));
    $password = htmlspecialchars(strip_tags($password));
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
                    header('Location: profile.php?error=' . urlencode($error));
                }
            } else {
                $error = "Image file too large!";
                header('Location: profile.php?error=' . urlencode($error));
            }
        } else {
            $error = "Invalid image file format!";
            header('Location: profile.php?error=' . urlencode($error));
        }
    } else {
        // No new image uploaded, get old image filename
        $old_image = $admin->getAdminInfo();
        $target_file = $old_image['image'];
    }
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    // Update admin info
    if (!empty($password)) {
        $result = $admin->updateAdmin([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'id' => $id,
            'image' => $target_file
        ]);
    } else {
        $result = $admin->updateAdminWithoutPassword([
            'name' => $name,
            'email' => $email,
            'id' => $id,
            'image' => $target_file
        ]);
    }

    if ($result) {
        $success = "Admin updated successfully.";
        header('Location: profile.php?success=' . urlencode($success));
    } else {
        $error = "Unable to update admin.";
        header('Location: profile.php?error=' . urlencode($error));
    }
}
?>