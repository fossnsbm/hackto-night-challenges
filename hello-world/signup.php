<?php 
include './connect.php';

// Initialize the session


 
// Check if the user is logged in, if not then redirect him to login page
// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
//     header("location: login.php");
//     exit;
// }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- <link rel="stylesheet" href="login.css"> -->
    <!-- <link rel="stylesheet" href="./loginmy.css"> -->
    <link rel="stylesheet" href="./signup.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
</head>
<body>

<?php 
include './navbar.php';
?>

<?php 

// if($_POST["username"] && $_POST["password"] && $_POST["email"] && $_POST["passwordConfirm"] ){
if($_SERVER['REQUEST_METHOD']=='POST'){
  $username = $_POST["username"];
  $password = $_POST["password"];
  $email = $_POST["email"];
  $passwordConfirm = $_POST["passwordConfirm"];

  if($password != $passwordConfirm){
      echo "Your passwords dont match please check again";
  }

  $sql = "INSERT INTO users (username,email,password) VALUES ('$username','$email','$password')";

  if(mysqli_query($con,$sql)){
      echo"Data inserted successfully...";
      header("location:login.php");
  }else{
      die(mysqli_error($con));
  }

}



?>
<div class="signup-container">
  <h1>SignUp</h1>

<form  method="post">

  <div class="container">
    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>
    <label for="email"><b>Email</b></label>
    <input type="email" placeholder="Enter Email" name="email" required>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
    <label for="passwordConfirm"><b>Password Confirm</b></label>
    <input type="password" placeholder="Password Confirm" name="passwordConfirm" required>
        
    <button type="submit">Signup</button>
  </div>

  <div class="container container-2" style="background-color:#f1f1f1">
    <!-- <button type="button" class="cancelbtn">Cancel</button> -->
    <span class="password">Forgot <a href="#">password?</a></span>
    <span class="password">Allready have an account? <a href="./login.php">Signin?</a></span>
  </div>
</form>

</div>

<?php 
include './footer.php';
?>

</body>
</html>