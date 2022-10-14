<?php
include "../connection.php";
?>
<?php
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

$empty = array();

//checking for empty inputs (php validations)
if (empty($username)) {
    array_push($empty, "empty username");
}
if (empty($password)) {
    array_push($empty, "empty password");
}

if (count($empty) == 0) {

    //getting encrypted password
    $enc_pword = sha1($password);
    //query for check users in database
    $user_check = "SELECT * FROM user WHERE username = '$username' AND password= '$enc_pword' LIMIT 1";
    $result = mysqli_query($connection, $user_check);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            //if result == 1 row ,getting that raw to an array
            $row = mysqli_fetch_assoc($result);
            if ($row['role'] == "admin") {
                $_SESSION['username_logged'] = "admin";
                echo "done admin";
                //header("location:../profile/admin/admin_pin.php");
            } else {
                $_SESSION['username_logged'] = $username;
                echo "done user";
                //header("location:../home.php");
            }

        } else {
            $_SESSION['invalid-msg'] = "Invalid User Credentials";
            echo "Invalid Username and password";
        }

    } else {
        echo "<b>Error!!!!!</b><br>Can't Check users in database......." . $connection->error;
    }

} else {
    echo "<b>Username or Password empty.......</b>";
}


?>
