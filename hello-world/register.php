<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <title>Document</title>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BBH_Warehouse";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$fname = $_REQUEST['fname'];
$lname = $_REQUEST['lname'];
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];

//$sql = `INSERT INTO user (fname, lname, email, password) VALUES ('$fname', '$lname', '$email', '$password')`;

if ($conn->multi_query($sql) === TRUE) {
    $sql = `INSERT INTO user (fname, lname, email, password) VALUES ('$fname', '$lname', '$email', '$password')`;
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?> 
    <?php
    include 'nav.php';
    ?>
    <div class="register">
        <div class="register-img">
            <img src="assets/Online Groceries-amico.png" alt="">
        </div>
        <div class="register-form">
            <form action="login.php" method="$_POST">
                <input type="text" placeholder="First Name" name="fname">
                <input type="text" placeholder="Last Name" name="lname">
                <br>
                <input type="email" placeholder="Email" name="email">
                <br>
                <input type="password" placeholder="Password" name="password">
                <br>
                <input type="password" placeholder="Confirm Password" name="passwordConfirm">
                <br>
                <input type="submit" value="Register">
                <br>
                <p>Do you have an acoount? <br>
                   <a href="login.php">Sign In</a> from here
                </p>
            </form>
        </div>
    </div>
</body>
</html>