<?php
session_set_cookie_params([
   'secure' => true,
   // cookie is sent over secure connections only
   'httponly' => true,
   // cookie is accessible over HTTP/HTTPS only (not JavaScript)
   'samesite' => 'None',
   // cookie is available for cross-site usage
]);

session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
   header("location: index.php");
   exit;
}
?>