<?php
$name=$_POST['name'];
$email=$_POST['email'];
$uname=$_POST['uname'];
$number=$_POST['number'];
$pw=$_POST['pw'];

$cpw=$_POST['cpw'];
if($pw!=$cpw)
{
    die('wrong password');
}
$conn = new mysqli('localhost','root','','','test');
if($conn ->connect_error){
die('connection error');
}
else{
    $stmt = $conn->prepare("insert into registration(name, email, uname, number, pw)
        values(?,?,?,?,?)");
    $stmt ->bind_param("sssis",$name,$email,$uname,$number);
    $stmt->execute();
    echo"registration sucessfull";
    $stmt->close();
    $conn->close();
}
?>
