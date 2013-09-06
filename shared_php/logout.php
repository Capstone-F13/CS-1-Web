<?php

session_start();
$_SESSION = array();
unset($_SESSION);
session_destroy();

//redirect to index page after logout
header('Location: ../index.php');
?>