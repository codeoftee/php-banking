<!DOCTYPE html>
<html>

<head>
    <title>Login to your KOLO account</title>
    <link href="style.css" rel="stylesheet">
</head>

<body>
    
    <br /><br />
    <div class="container">
        <h2>Login Form</h2>
        <?php
        if (isset($_GET['err'])) {
            echo "<h4 style='color: red'>Invalid email or password<h4>";
        }
        if (isset($_GET['success'])) {
            echo "<h4 style='color: green'>Registration successful, please login to continue.<h4>";
        }
        ?>
        <form method="post" action="auth.php">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" placeholder="Enter your email">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password">
            <input type="submit" value="Login" name="login">
        </form>
    </div>
</body>

</html>