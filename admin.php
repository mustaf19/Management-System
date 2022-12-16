<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<h1 style="background-color: brown;color: white;text-align: center;">Admins Town</h1>

</body>


</html>
<?php
session_start();
if(!isset($_GET['login'])){
	header("location:admin.php?login=0");
}
if($_GET['login']=='0'){
	echo "<div style='text-align:center;'><form  action='admin.php?login=1' method='post'>
		<label>username</label><input type='text' name='usr'><br>
		<label>password</label><input type='password' name='pwd'><br>
		<input type='submit'><h1>hello</h1>
	</form>
	<a href='index.php'>INDEX</a></div>";

}
else if($_GET['login']=='1'){  // when we submit our login details--> maybe right or wrong
	$username = $_POST['usr'];
	$password = md5($_POST['pwd']);

		$sql = "SELECT * from `placementdb`.`adminPass` WHERE username='$username' and password='$password'";
		require_once "dbcon.php";
		$res = mysqli_query($conn,$sql);
		$count = mysqli_num_rows($res); 
		if($count>0){
			// session_start(); // when there is correct login details.. we start our session;
			$_SESSION['session'] = 'y';
			header("location:admin.php?login=2");  // 2 to admin details portal
		}
		else{
			header("location:admin.php?login=0");
		}

}
else if($_GET['login']=='2'){
	if(isset( $_SESSION['session'] )) {
		// echo " $_SESSION['session'] ";
		// echo "<h1>welcome to admin town</h1>";
		// echo '<input type="submit" value="Bring all details"><br>';
		// echo '<a href="admin.php?login=3">add Admin</a><br>';
		// echo "<a href='admin.php?login=4'>Logout</a>";

		// FORM ACTION TO BRING DETAILS FROM THE STUDENT DB
		echo'<div style="text-align: center;">
				<h1>Welcome to admin town</h1>
				<form method="post" action="admin.php?login=2&p=1">  
					<label>RollNo: </label><input type="text" name="rollno"><br><br>
					<label>CompanyName: </label><input type="text" name="companyname"><br><br>
					<label>MaxPackage: </label><input type="text" name="maxpackage" pattern=[.0-9]{1,4}><br><br>
					<input type="submit" value="Bring details!" name=""><br><br>
				</form>';
		if(isset($_GET['p'])){
			$rollno = $_POST['rollno'];
			$companyname = $_POST['companyname'];
			$maxpackage = $_POST['maxpackage'];



			if($rollno == "" && $companyname=="" && $maxpackage != ""){
				// search all users table to find users with pkg<=maxpackage
				echo "<h1>lp1</h1>";
				require_once "dbcon.php";
				var_dump($maxpackage);
				$maxpackage = $maxpackage+0.0;
				var_dump($maxpackage);

				// !! use join here!!
				$sql = "SELECT users.rollno,users.rname,users.lname,companydata.companyName,companydata.pkg FROM users JOIN companydata ON users.rollno = companydata.rollno where companydata.pkg<=$maxpackage;";
				$query = mysqli_query($conn,$sql);
				echo "<h1>Details</h1>";
				if(mysqli_num_rows($query) > 0){
					while($res = mysqli_fetch_array($query)){
						echo "<p>{$res['rname']} {$res['lname']} {$res['rollno']} {$res['companyName']} {$res['pkg']}</p>";
					}

				}
				else{
					echo "<p>no details found</p>";
				}
				

			}
			else if($rollno == "" && $companyname !="" && $maxpackage == ""){
				require_once "dbcon.php";
				$sql = "SELECT users.rollno,users.rname,users.lname,companydata.companyName,companydata.pkg FROM users JOIN companydata ON users.rollno = companydata.rollno where companydata.companyName='$companyname';";
				$query = mysqli_query($conn,$sql);
				echo "<h1>Details</h1>";
				if(mysqli_num_rows($query) > 0){
					while($res = mysqli_fetch_array($query)){
						echo "<p>{$res['rname']} {$res['lname']} {$res['rollno']} {$res['companyName']} {$res['pkg']}</p>";
					}

				}
				else{
					echo "<p>no details found</p>";
				}
					echo "<h1>lp2</h1>";
				}
			else if($rollno != "" && $companyname=="" && $maxpackage == ""){
				//search all users table i.e students table contaning columns (rollno,rname,lname,dob,gyear,password,email,phoneno)
				require_once "dbcon.php";
				$sql = "SELECT * from `placementdb`.`users` where rollno='$rollno';";
				$res = mysqli_query($conn,$sql);
				if(mysqli_num_rows($res)>0){
					$details = mysqli_fetch_array($res);
					echo "<p>Students name: {$details["rname"]} ${details["lname"]}</p>";  // IMPORTANT!! so ''--> not working with $details but "" works fine!!
					echo "<p>DOB : {$details["dob"]}</p>";
					echo "<p>Graduation Year : {$details["gyear"]}</p>";
					echo "<p>Email : {$details["email"]} <br>PhoneNo : {$details["phoneno"]}</p>";
				}
				$sql = "SELECT * from `placementdb`.`companyData` where rollno='$rollno';";
				$res = mysqli_query($conn,$sql);
				if(mysqli_num_rows($res)>0){
					//table heading
					echo "<h1>Company data</h1>";
					while($details = mysqli_fetch_array($res)){
						echo "<p>{$details['companyName']} {$details['pkg']}</p>";
					}
				}
				else{
					echo "no match";
				}
				echo "<h1>lp3</h1>";
			}
			else{
				echo "lp0<br>";
			}
		}
		else{
			echo "else";
		}

				echo'<a href="admin.php?login=3">add Admin</a><br><br>
				<a href="admin.php?login=4">Logout</a>
			</div>';


		
	}
	else{
		session_destroy();
		header("location:admin.php?login=0");
	}
	

}
else if($_GET['login']=='3'){
	if(isset($_SESSION['session']))
	{
		echo '<div style="text-align: center;">
		<h1>Admin Town Registration</h1><br>
		<form  method="post" action="admin.php?login=rgstr">
		<label>Name</label><input type="text" name="name" pattern="[ a-zA-Z]{2-20}"><br><br>
		<label>Username</label><input type="text" name="username"><br><br>
		<label>Password</label><input type="password" name="password">
		<input type="submit" name="">
	</form>
	</div>';
	}
	else{
		echo "please login";
	}
		

}
else if($_GET['login']=='4'){
	session_destroy();
	header("location:admin.php?login=0");
}
else if($_GET['login']=='rgstr'){
	if(isset($_SESSION['session'])){
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		require_once "dbcon.php";
		$sql = "SELECT * from `placementdb`.`adminPass` WHERE username='$username' and password='$password'";
		require_once "dbcon.php";
		$res = mysqli_query($conn,$sql);
		$count = mysqli_num_rows($res); 
		if($count>0){
			// session_start(); // when there is correct login details.. we start our session;
			$_SESSION['session'] = 'y';
			header("location:admin.php?login=2");  // 2 to admin details portal
		}
		else{
			header("location:admin.php?login=0");
		}

		$sql2 = "INSERT INTO `placementdb`.`adminpass` (username,password) VALUES ('$username','$password')" or die("SERVER err...");

		$r1 = mysqli_query($conn,$sql2);
		header("location:admin.php?login=0");
	}
	else{
		header("location:admin?login=0");
	}
	

}
else{
	// echo '<h1>bad gate way</h1>';
	header("location:admin.php?login=0");
}

?>

