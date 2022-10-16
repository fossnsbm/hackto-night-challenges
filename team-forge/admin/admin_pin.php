<?php
//checking connection and session start
include "../connection.php";
?>
<?php
//redirecting to login page if admin is unknown
if ($_SESSION['username_logged'] != 'admin') {
    header("location:../../LoginPage/LogIn.php");
}
?>
<?php error_reporting(E_ERROR | E_PARSE); ?>
<?php

$admin_pin = $_REQUEST['pin'];
$enc_pin = sha1($admin_pin);

$empty = 0;
if (empty($admin_pin)) {
    $empty = 1;
}

$check = "SELECT * FROM user WHERE admin_pin = '$enc_pin' LIMIT 1";
$result = mysqli_query($connection, $check);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Pin</title>
    <link rel="icon" href="../../Logo.png">
    <style rel="stylesheet" type="text/css">
        body {
            background-color: #808080;
            font-family: sans-serif;
        }

        .box {
            width: 320px;
            height: 300px;
            padding: 90px 30px;
            background: #000000;
            color: #ffffff;
            top: 50%;
            left: 50%;
            position: absolute;
            transform: translate(-50%, -50%);
            box-sizing: border-box;

        }

        .avatar {
            width: 100px;
            position: absolute;
            top: -50px;
            left: calc(50% - 50px);
            border: 5px solid darkgrey;
            border-radius: 50%;
            background-color: black;
        }

        .box p {
            margin: 0;
            padding: 0;
            font-weight: bold;
        }

        .box input {
            width: 100%;
            margin-bottom: 20px;
        }

        .box input[type="password"] {
            border: none;
            border-bottom: 1px solid #fff;
            background: transparent;
            color: #ff0000;
            outline: none;
            height: 40px;
            font-size: 16px;
        }

        ::-ms-reveal {
            filter: invert(100%);
        }

        .box input[type="submit"] {
            border: none;
            outline: none;
            height: 40px;
            background: #228b22;
            color: #fff;
            font-size: 18px;
            border-radius: 20px;
        }

        .box input[type="submit"]:hover {
            cursor: pointer;
            background: #fff;
            color: #000;
        }

    </style>

    <script language="JavaScript" type="text/javascript">

        function validPin() {
            if (document.pinform.pin.value.length < 1) {
                window.alert("Admin Pin Required");
                return false;
            } else if (document.pinform.pin.value.length < 5) {
                window.alert("Invalid Admin Pin (Too short)")
                return false;
            } else if (isNaN(document.pinform.pin.value)) {
                window.alert("Invalid Admin Pin (Pin should be Numerics)");
                return false;
            }

        }
    </script>

</head>
<body>
<div class="box">
    <img src="admin.png" class="avatar" alt="Admin-Avatar">
    <form method="post" name="pinform" action="admin_pin.php" onsubmit="return validPin()">

        <p>PIN</p>
        <input type="password" name="pin" size="15" maxlength="20" placeholder="Enter the Admin Pin" required autofocus>
        <br>
        <?php
        if ($result and $empty == 0) {
            if (mysqli_num_rows($result) == 1) {
                $_SESSION['admin-pin'] = $enc_pin;
                unset($_SESSION['username_logged']);
                header("location:../../home.php");

            } else {
                echo "<div style='color: red;font-size: 14px;'>Invalid Pin</div>";
            }

        }
        ?>
        <br>
        <input type="submit" name="submit" value="Continue" onclick="validPin()">

    </form>

</div>


</body>
</html>


