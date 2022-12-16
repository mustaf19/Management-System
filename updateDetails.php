<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Update Details</title>
</head>
<body>
	<div style="text-align:center;">
		<h1>Update Details</h1>
		<?php
			session_start();
			if(!isset($_SESSION['rollno']))
			{
				session_destroy();
				header("location:index.php");
			}
			require_once "dbcon.php";$rollno = $_SESSION['rollno'];
			if(isset($_GET['update']) && ($_GET['update'] == '1'))
			{
				$newfname = $_POST['fname'];
				$newlname = $_POST['lname'];
				$newdob = $_POST['dob'];
				$newemail = $_POST['email'];
				$newphoneno = $_POST['phoneno'];
				$newgyear = $_POST['gyear'];

				$r = mysqli_query($conn,"UPDATE users SET rname = '$newfname',lname = '$newlname',dob = '$newdob', email = '$newemail',phoneno = '$newphoneno',gyear = '$newgyear' where rollno='$rollno'");
				// $d = mysqli_fetch_array($conn,$r);
			}

			
			
			$res = mysqli_query($conn,"select * from users where rollno=$rollno");
			$details = mysqli_fetch_array($res);
			$fname = $details['rname'];
			$lname = $details['lname'];
			$dob = $details['dob'];
			$gyear = $details['gyear'];
			$email = $details['email'];
			$phoneno = $details['phoneno'];
			echo "<a href='account.php' style='background-color:green;
									color:white;
									border-radius:2px;
									padding: 5px;
									padding-left: 10px;
									padding-right: 10px;
									margin:20px;
									'>Back</a>";
			echo "<form method='post' action='updateDetails.php?update=1'>
						<label>First Name: </label><input type='text' name='fname' value={$fname}><br><br>
						<label>Last Name: </label><input type='text' name='lname' value={$lname}><br><br>
						<label>Date Of Birth: </label><input type='date' name='dob' value={$dob}><br><br>
						<label>Graduation Year: </label><input type='text' name='gyear' value={$gyear}><br><br>
						<label>Email: </label><input type='text' name='email' value={$email}><br><br>
						<label>PhoneNo: </label><input type='text' name='phoneno' value={$phoneno}><br><br>
						<input type='submit' value='update'>

				
			</form>";

		?>

	</div>

</body>
</html>