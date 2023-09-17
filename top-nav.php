<div class="topnav">
    <a href="/">Home</a>
    <a href="#about">About</a>
    <?php
    if ($logged_in !== true) {
    ?>
        <a href="login.php">Login</a>
        <a href="open-account.php">Open Account</a>
    <?php
    } else {
    ?>
        <a href="account.php">My Account</a>
        <a href="transfer.php">Transfer Money</a>
        <a href="logout.php">Logout</a>
    <?php
    }
    ?>
</div>