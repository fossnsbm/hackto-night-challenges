<?php
include "../connection.php";
?>
<?php
//declaring variables,arrays and requesting values
$errors = array();
$email_error = array();
$username_error = array();


$username = $_REQUEST['username'];
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$confpassword = $_REQUEST['confirm_password'];

//assigning username to a session
$_SESSION['username'] = $_POST['username'];

//php validations (**** if needed ***)

if (empty($username)) {
    array_push($errors, "Please Enter a username");
}
if (empty($email)) {
    array_push($errors, "Please Enter a Email");
}
if (empty($password)) {
    array_push($errors, "Please Enter a password");
} elseif (empty($confpassword)) {
    array_push($errors, "Please confirm your password");
} elseif ($password != $confpassword) {
    array_push($errors, "Passwords do not match");
}

//checking entered username and email already using
$user_check = "SELECT * FROM user WHERE username = '$username' or email= '$email' LIMIT 1";
$result = mysqli_query($connection, $user_check);
$user = mysqli_fetch_assoc($result);

if ($user) {
    if ($user['username'] === $username) {
        array_push($username_error, "Entered username already exsists");
        array_push($errors, "Entered username already exsists");

    }
    if ($user['email'] === $email) {
        array_push($email_error, "Entered Email already exsists");
        array_push($errors, "Entered username already exsists");
    }

}


//user registration
if (count($errors) == 0) {
    $enc_password = sha1($password);
    $user_regdata_sql = "INSERT INTO user(username, email, password, role) VALUES ('$username','$email','$enc_password' ,'user') LIMIT 1";
    if ($connection->query($user_regdata_sql)) {
        echo "User inserted Successfully";

    } else {
        echo "Database Connection Error................." . $connection->error;
    }

} else {
    echo "Input Error";
}

if (count($email_error) > 0 && count($username_error) > 0) {
    echo "<font size='5'><b><br> Sorry!!! <br> This Username and Email already exists. Please try again with a different Username and Email.</b><br><br>Entered Username : " . $username . "<br>Entered Email: " . $email . "<br></font>";
} elseif (count($email_error) > 0) {
    echo "<font size='5'><b> Sorry!!! <br> This Email address already exists. Please try again with a different email address.</b><br><br>Entered Email address : " . $email . "<br></font>";
} elseif (count($username_error) > 0) {
    echo "<font size='5'><b> Sorry!!! <br> This Username already exists. Please try again with a different Username.</b><br><br>Entered Username : " . $username . "<br></font>";
}

?>
<!DOCTYPE html>
<!--Creating and Styling Go back button-->
<html>
<head>
    <style type="text/css">
        #btnBack {
            background-color: #228b22;
            border-radius: 10px;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            font-size: 16px;
            cursor: pointer;
        }

        #btnBack:hover {
            background-color: #006400;
        }

    </style>
</head>

<body>

<br><br>
<button id="btnBack" onclick="history.back()">Go Back & Try Again</button>

</body>

</html>

