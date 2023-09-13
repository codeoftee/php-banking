<?php
session_start();
// connect to database using mysqli procedural technique
require "db.php";

if (isset($_POST['registration'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $bvn = $_POST['bvn'];
    // validate form
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('location: register.php?err=Invalid email address');
    }
    if (strlen($phone) < 11) {
        header('location: register.php?err=Invalid phone number');
    }
    $hashed_password = hash('sha256', $password);

    $sql = "INSERT INTO users (firstname, lastname, password, email, phone, bvn, balance)
    VALUES('$firstname', '$lastname', '$hashed_password', '$email', '$phone', '$bvn', 0)";

    try {
        // use exec() because no results are returned
        $conn->exec($sql);
        header('location: /login.php?success');
    } catch (Exception $e) {
        echo "Error happened: $e";
    }
}
// process login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    try {
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user == null) {
            // no user with email found
            header('location: login.php?err');
        } else {
            // hash submitted password
            $p_hash = hash('sha256', $password);
            // compare saved hash vs submitted hash
            if ($p_hash !== $user['password']) {
                //password is not correct
                header('location: login.php?err');
            } else {
                // login correct
                // set sessions in php
                $_SESSION['id'] = $user['id'];
                $_SESSION['pw'] = $user['password'];
                // set cookies for 2 days
                setcookie("user_id", $user['id'], time() + (86400 * 2), "/");
                setcookie("username", $user['username'], time() + (86400 * 2), "/");
                // redirect back to homepage
                header('location: account.php');
            }
        }
    } catch (Exception $e) {
        echo "Error happened: $e";
    }
}
