<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Open an Online Account | KOLO BANK</title>

</head>

<body>
    <?php
    if (isset($_GET['err'])) {
        $error = $_GET['err'];
        echo "<h4 style='color:red'>$error</h4>";
    }
    ?>
    <div class="center-form">
        <form method="post" action="auth.php">
            <h4>Register</h4>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required><br>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required><br>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select><br>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" required><br>

            <input type="submit" value="Submit" name="registration">
        </form>
    </div>
</body>

</html>