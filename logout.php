<?php
session_start();
// set sessions to null
$_SESSION['id'] = null;
$_SESSION['pw'] = null;

// unset sessions
unset($_SESSION['id']);
unset($_SESSION['pw']);

// cookies cannot be unset but you can make it expire
// set the expiration date to one hour ago
setcookie("id", "", time() - 3600);
header('location: /');
