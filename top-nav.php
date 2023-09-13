<?php
$name = null;
?>
<div class="topnav">
    <a class="active" href="#home">Home</a>
    <a href="#about">About</a>
    <?php
    if ($name == null) {
    ?>
        <a href="login.php">Login</a>
        <a href="open-account.php">Open Account</a>
    <?php
    } else {
    ?>
        <a href="logout.php">Logout</a>
    <?php
    }
    ?>
</div>