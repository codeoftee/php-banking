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
// load transfer history
$account_number = $user['account_number'];
$query = "SELECT * FROM transaction_history WHERE sender=? OR receiver=?";
$stmt = $conn->prepare($query);
$stmt->execute(array($account_number, $account_number));
$histories = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>

<head>
    <title>Profile Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require_once "top-nav.php";

    if (isset($_GET['err'])) {
        $error = $_GET['err'];
        echo "<h4 style='color:red'>$error</h4>";
    }
    ?>
    <div class="history">
        <h2>Transfer History</h2>
        <table>
            <thead>
                <th>No.</th>
                <th>Amount</th>
                <th>Type</th>
                <th>Status</th>
                <th>Reference</th>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($histories as $history) {
                    if ($history['sender'] == $user['account_number']) {
                        $t_type = 'debit';
                    } else {
                        $t_type = 'credit';
                    }
                ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td>&#8358;<?= $history['amount'] ?></td>
                        <td><?= $t_type ?></td>
                        <td><?= $history['transaction_status'] ?></td>
                        <td><?= $history['ref'] ?></td>
                    </tr>
                <?php
                }
                $i++;
                ?>

            </tbody>
        </table>
    </div>
    <div class="container">
        <form method="post" action="send_money.php">
            <h2>Transfer Money</h4>
                <label for="acn">Account Number:</label>
                <input type="tel" id="acn" name="account_number"><br>

                <label for="bank">Bank Name:</label>
                <select id="bank" name="bank">
                    <option name="">Select Bank</option>
                    <option name="Kako Bank">Kako Bank</option>
                    <option name="Second Bank">Second Bank</option>
                    <option name="BTO">BTO Bank</option>
                    <option name="SAPA">SAPA Bank</option>
                </select>
                <br />
                <label for="amount">Amount:</label>
                <input type="text" id="amount" name="amount"><br>

                <label for="ref">Description:</label>
                <input type="text" id="ref" name="ref"><br>

                <input type="submit" value="Send Money" name="transfer">
        </form>
    </div>
</body>

</html>