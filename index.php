<?php
session_start();
require_once "db.php";
$logged_in = false;
// check login
if (isset($_SESSION['id'])) {
    $logged_in = true;
}
if (isset($_COOKIE['id'])) {
    $logged_in = true;
    $_SESSION['id'] = $_COOKIE['id'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banking System</title>
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <?php require_once "top-nav.php" ?>
    <div>
        <h1>Welcome to KOLO BANK</h1>

    </div>
</body>

</html>