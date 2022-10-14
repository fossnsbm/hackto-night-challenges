<?php 

$servername = "localhost";
$dbusername = "root";
$password = "";
$database = "webfinal";

$con = new mysqli($servername,$dbusername,$password,$database);

if($con == false){
    die("Error:could not connect".mysqli_connect_error());
}
?>