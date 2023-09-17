<?php
$host = "localhost";
$username = "pediforte";
$password = "pediforteDb2020";
$db = "banking";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

function generate_account_number($length = 6)
{
    $prefix = "4005";
    $key = '';
    $keys = array_merge(range(0, 9));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }
    $account_numb = $prefix . $key;
    return $account_numb;
}
