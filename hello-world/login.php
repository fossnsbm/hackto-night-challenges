<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Document</title>
</head>
<body>
<?php
    include 'nav.php';
    ?>
    <div class="register">
        <div class="register-img">
            <img src="assets/Online Groceries-amico.png" alt="">
        </div>
        <div class="register-form">
            <form action="">
                <input type="email" placeholder="Email">
                <br>
                <input type="password" placeholder="Password">
                <br>
                <input type="submit" value="Login">
                <br>
                <p>Don't you have an acoount? <br>
                   <a href="register.php">Register</a> from here
                </p>
            </form>
        </div>
    </div>
</body>
</html>