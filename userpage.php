<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<div style="text-align: center;">
		<h1>enter your current details</h1>
		<form method="post" action="userpage.php?q=$rno&pg=2">
			<label>Enter company: </label><input type="text" name="company"/><br><br>
			<label>Package :</label><input type="text" name="pkg"/><br><br>
			<input type="submit" name="">
		</form>
		<a href="index.php?logout=1" <?php echo"efubi";  ?>>Logout</a><br>
		<a href="userpage.php?q=$rno&pg=2">enter new details</a><br>
		<a href="userpage.php?q=$rno&pg=1">show details</a><br>

	</div>
</body>
</html>
<?php
session_start();
if(isset($_SESSION['name'])){
	$var = $_SESSION['name'];
	$rno = $_GET['q'];
	$s = $_SESSION['rollno'];
	echo "$s";
}
else{
	header("location:index.php");
}
echo "<h1>you are here!!</h1>" ; 

echo "<h1>$rno</h1>";
if(isset($_SESSION['pg']))
$pg = $_GET['pg'];
$rno = $_SESSION['rollno'];
echo "<h1 style='color: blue;'>$rno</h1>";
include_once "dbcon.php";
 $sql = "SELECT * from `placementdb`.`companyData` where rollno='$rno';";
 $count= mysqli_num_rows(mysqli_query($conn,$sql));
 if($count>0){
 	$query = mysqli_query($conn,$sql);
 	// echo "$query";
 	while($res = mysqli_fetch_array($query)){
 		echo "<div>{$res['rollno']} {$res['companyName']} {$res['pkg']}</div><br>";

 	}
 }

 if(isset( $_GET['pg']) && $_GET['pg'] =='2' ){
 	echo "<h1>pg is 2</h1><h2>$rno</h2>";
 	$company = $_POST['company'];
 	$pkg = $_POST['pkg'];
 	$rno =$_SESSION['rollno'];
 	$sqlinsert = "INSERT into `placementdb`.`companyData` (rollno,companyName,pkg) VALUES ('$rno','$company','$pkg');";
 	$q = mysqli_query($conn,$sqlinsert);
 		echo "<h1>updated</h1>";
 	// }
 	// else{
 	// 	echo "<h1 style="color: red;">not updated</h1>";
 	// }
 }
?>
