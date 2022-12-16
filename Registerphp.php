<?php
// check if the user is already logged in
// if(isset($_SESSION['username']))
// {
//   header("location: welcome.php");
//   exit;
// }
require_once "dbcon.php";

$fname = $lname = $email = $year = $dob= $rollno = $password = $phoneno = "";

$fname = $_POST['firstname'];
$lname  = $_POST['lastname'];
$email = $_POST['email'];
$year = $_POST['gyear'];
$dob = $_POST['dob'];
$password = md5($_POST['password']);
$rollno = $_POST['rollno'];
$phoneno = $_POST['phoneno'];


$sql = "INSERT INTO `placementdb`.`users` (rollno,rname,lname,dob,gyear,password,email,phoneno) VALUES ('$rollno','$fname','$lname','$dob','$year','$password','$email','$phoneno') ;" or die("error");
$res=mysqli_query($conn,$sql);
 echo "res";
echo "$fname , $lname ,$email,$year,$phoneno, $rollno, $dob, $password ";
header("location:index.php");
?>