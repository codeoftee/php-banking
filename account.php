<?php
session_start();
require_once "db.php";
$logged_in = false;
// check if session is set
if (isset($_SESSION['id'])) {
    $logged_in = true;
}
// check if cookie is set
if (isset($_COOKIE['id'])) {
    $logged_in = true;
    $_SESSION['id'] = $_COOKIE['id'];
}
if (!$logged_in) {
    // if no cookie or session set redirect to home page
    header('location: /');
}
// load account info

try {
    $user_id = $_SESSION['id'];
    $query = "SELECT * FROM users WHERE id=? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->execute(array($user_id));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    // data base error
    echo "Unable to connect to database " . $e;
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Profile Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require_once "top-nav.php" ?>
    <div class="profile-container">
        <img src="avatar.svg" alt="User Avatar" class="avatar">
        <h2><?= $user['firstname'] . " " . $user['lastname'] ?></h2>
        <p>Email: <a href="mailto:example@example.com"><?= $user['email'] ?></a></p>
        <p>Phone Number: <?= $user['phone'] ?></p>
        <p>Wallet Balance: &#8358;<?= $user['balance'] ?></p>
        <button class="logout-btn">Logout</button>
    </div>
</body>

</html>