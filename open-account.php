<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Open an Online Account | KOLO BANK</title>
    <link href="style.css" rel="stylesheet">

</head>

<body>
    <?php

    if (isset($_GET['err'])) {
        $error = $_GET['err'];
        echo "<h4 style='color:red'>$error</h4>";
    }
    ?>
    <div class="container">
        <form method="post" action="auth.php">
            <h4>Online Account Opening</h4>
            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="firstname" required><br>

            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" required><br>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" required><br>

            <label for="bvn">BVN Number:</label>
            <input type="tel" id="bvn" name="bvn" required><br>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <input type="submit" value="Submit" name="registration">
        </form>
    </div>
</body>

</html>