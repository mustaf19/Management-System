<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Account</title>

<style>

	#updatedetails{
		border: 1px solid black;
		padding: 10px;
		border-radius: 10px;
		text-decoration: none;
	}

	table{
		padding: 10px;
		margin: 10px;
		margin-left: auto;
		margin-right: auto;
	}


.grid-container {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  background-color: sandybrown;
}

.header{
	grid-column: 3fr;
	background-color: forestgreen;
}
.f1 { 
background-color:darkblue;
grid-column: 1fr;
color: whitesmoke;
border-radius: 10px;
text-align: center;
/*margin: 10px;*/
margin-top: 10px;
}


.f2 { 
background-color:white;
grid-column: 1fr;
text-align: center;
border-radius: 10px;
margin-top: 10px;

 }
.f3 { 
background-color:red;
grid-column: 1fr;
border-radius: 10px;
padding: 10px;
/*margin: 10px;*/
margin-top: 10px;

  }
  .footer{
  		grid-column: 3fr;
	background-color: forestgreen;

  }

  @media screen and (max-width: 700px){
  .grid-container{
  	display: block;

  }
}
#logout{
	border: 1px solid white;
	padding: 10px;
	border-radius: 10px;
	text-decoration: none;
	justify-content: left;
}
</style>

</head>

<body>
	<div class="header" style="padding: 10px;">
		<a id='logout' href='account.php?logout=1'>Logout</a>
		
	</div>

	<?php require_once "dbcon.php"; ?>
	<div class="grid-container">
			<?php
			session_start();
			if( !isset($_SESSION['rollno'])){
				header("location:index.php");
			}
			
			require_once "updates.php";

			?>

	<div class="f2" >

			<?php
			$name = $_SESSION['name'];
			$rollno = $_SESSION['rollno'];
			echo "<p style='font-size: 50px; margin: none; padding: none;'>$name</p>";
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

			// echo "";

			if( isset($_GET['logout']) && $_GET['logout']==1){
				session_destroy();
				header("location:index.php");
			}
			// require_once "index.php"; // can bring all code here.. just like a function or files importing
			echo "<a id='updatedetails' href='updateDetails.php'>Update My Details</a>";
		?>
		
		

	</div>
	<div class="f3" >

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
			else{
				echo "<h5>No records found!</h5>";
			}
			
			 ?>
			
		</div>
		
	</div>
	<hr>
	<div class="footer" style="text-align: center;">
		Made by Mustafizur Rahman.<br>
		Contact- mustafeez0001@gmail.com

	</div>
	
</body>
</html>