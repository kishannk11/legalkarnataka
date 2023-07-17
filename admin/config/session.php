<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
   header("location: login.php");
   exit;
}
if ($_SESSION["role"] === "client" && strpos($_SERVER['REQUEST_URI'], '/admin/') !== false) {
   session_destroy();
   header("location: ../client/login.php");
   exit;
} elseif ($_SESSION["role"] === "admin" && strpos($_SERVER['REQUEST_URI'], '/client/') !== false) {
   session_destroy();
   header("location: ../admin/login.php");
   exit;
}
?>