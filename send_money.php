<?php
session_start();
// add database file
require "db.php";
// check if user session is set
if (!isset($_SESSION['id'])) {
    header('location: /login.php');
    die();
}
// get user account
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

$user_id = $_SESSION['id'];
if (isset($_POST['transfer'])) {
    $account_number = $_POST['account_number'];
    $bank = $_POST['bank'];
    $amount = $_POST['amount'];
    $ref = $_POST['ref'];
    // check form
    if ($account_number == "") {
        $message = "Account number required";
        header('location: /transfer.php?err=' . $message);
    }
    if ($bank == '') {
        $message = "Please select bank";
        header('location: /transfer.php?err=' . $message);
    }
    if ($amount == '') {
        $message = "Please enter amount";
        header('location: /transfer.php?err=' . $message);
    }
    // convert amount to float
    $amount = floatval($amount);
    // check the balance
    if ($user['balance'] < $amount) {
        $message = "Insufficient fund";
        header('location: /transfer.php?err=' . $message);
    } else {
        // remove amount from user balance
        $bal = $user['balance'] - $amount;
        // update user balance
        $query = "UPDATE users set balance = ? WHERE id = ? LIMIT 1";
        try {
            $stmt = $conn->prepare($query);
            $stmt->execute(array($bal, $user_id));
        } catch (Exception $e) {
            echo "We are unable to process your request at the moment, please try again later <br/>" . $e;
        }

        // find receiver account
        try {
            $query = "SELECT * FROM users WHERE account_number=? LIMIT 1";
            $stmt = $conn->prepare($query);
            $stmt->execute(array($account_number));
            $receiver = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($receiver == null) {
                header('location: /transfer.php?err=Recipient not found!');
            }
            // credit recipient account
            $recipient_id = $receiver['id'];
            $sql = "UPDATE users SET balance = balance+$amount WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($recipient_id));
            // save transaction history
            $save_query = "INSERT INTO transaction_history (sender, receiver, amount, transaction_status, ref)
                                                            VALUES(?,?,?,?,?)";
            $stmt = $conn->prepare($save_query);
            $stmt->execute(array($user['account_number'], $receiver['account_number'], $amount, 'successful', $ref));
            // send credit alert with mail()
            // mail($receiver['email'], 'Credit Alert', 'Your account has been credited with ....');
            header('location: /transfer.php?success=1');
        } catch (Exception $e) {
            // data base error
            echo "Unable to connect to database " . $e;
            exit();
        }
    }
}
