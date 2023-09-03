<?php
require_once('config/config.php');
require_once('Database.php');
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $userObj = new User($conn);
    $result = $userObj->deleteUser($userId);

    if ($result) {
        $success = "User Deleted";
        header('Location: user-list.php?success=' . urlencode($success));
        exit();
    } else {
        $error = "Error deleting the User.";
        header('Location: user-list.php?success=' . urlencode($error));


    }
}
?>