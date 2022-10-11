<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Account</title>
</head>

<body>
	<div style="width: 50%;
    height: 100%;
    float: left;
    background-color: royalblue;
    border-collapse: collapse;">
		<?php
			session_start();
			if( !isset($_SESSION['rollno'])){
				header("location:index.php");
			}
			require_once "dbcon.php";
			require_once "updates.php";
			$name = $_SESSION['name'];
			$rollno = $_SESSION['rollno'];
			echo "<h1>$name</h1>";
			$sql = "SELECT * from users where rollno='$rollno'";
			
			$res = mysqli_query($conn,$sql);
			$details = mysqli_fetch_array($res);


			echo"<table>
							<tr>
								<th>Legend</th>
								<th>Values</th>
							</tr>
							<tr>
								<td>Student's Name</td>
								<td>{$details["rname"]} ${details["lname"]}</td>
							</tr>
							<tr>
								<td>Date of Birth</td>
								<td>{$details["dob"]}</td>
							</tr>
							<tr>
								<td>Graduation Year</td>
								<td>{$details["gyear"]}</td>
							</tr>
							<tr>
								<td>Email</td>
								<td>{$details["email"]}</td>
							</tr>
							<tr>
								<td>PhoneNo</td>
								<td>{$details["phoneno"]}</td>
							</tr>
						</table>";

			echo "<a href='account.php?logout=1' style='background-color: white;
  color: black;
  border: 2px solid green;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;'>Logout</a>";

			if( isset($_GET['logout']) && $_GET['logout']==1){
				session_destroy();
				header("location:index.php");
			}
			// require_once "index.php"; // can bring all code here.. just like a function or files importing
		?>
		

	</div>
	<div style="width: 25%;
  height: 100%;
  position: relative;
  float: right;
  background-color: yellow;
  border-collapse: collapse;" 
    >

			<h2>Companies selected in : </h2>
			<?php 
			$sql = "SELECT * from companydata where rollno=$rollno order by pkg;";
			$res = mysqli_query($conn,$sql);
			if(mysqli_num_rows($res)>0){
				echo"<table>
						<tr>
							<th>Company</th>
							<th>Package</th>
						</tr>";
				while($details = mysqli_fetch_array($res)){
				echo "<tr>
						<td>{$details['companyName']}</td>
						<td>{$details['pkg']}</td>
					</tr>";
				}	
			}
			
			 ?>
			
		</div>
	
</body>
</html>



<!-- <?php 
require_once 'dbcon.php';
session_start();
$name = $_SESSION['name'];
echo "hello $name";
$rno = $_POST['rno'];
$login = $_GET['login'];
$password = md5($_POST['pwd']);
echo "$rno $password";

$sql = mysqli_query($conn,"SELECT * FROM `placementdb`.`users` WHERE rollno='$rno' AND password='$password';") or die("error");
$count = mysqli_num_rows($sql);
$row = mysqli_fetch_array($sql);
echo "<h1>$count</h1>";
if($count>0){
	session_start();
	$name = $row['rname'];
	$rno = $row['rollno'];
	$_SESSION['rollno'] = $rno;

	$_SESSION['name'] =$name;
	header("location:userpage.php?q=$rno");

}
else{
	echo "not here";
}	
 ?>

 -->