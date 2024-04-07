<?php
include_once('../config/app.php');


session_start();

$_SESSION = array();

session_destroy();

redirect("Logout Sucsessfully", "login.php");
exit();
?>
