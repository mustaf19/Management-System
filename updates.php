<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Job Updates</title>
</head>
<body>
	<div style="width: 25%;
    height: 100%;
    float: left;
    background-color: rosybrown;
    border-collapse: collapse;">
		<h1>Updates</h1>
		<?php
			if( isset($_SESSION['rollno'])){
				echo "here comes updates";
				// require_once "dbcon.php";
				$rollno = $_SESSION['rollno'];
				echo "$rollno";
				$sql = "SELECT max(distinct(pkg)) from companydata where rollno='$rollno'";
				$res = mysqli_query($conn,$sql);
				$count = mysqli_num_rows($res);
				echo "<h1>here is count=$count</h1>";
				if(mysqli_num_rows($res)>0 && (mysqli_fetch_array($res))[0]!=NULL) {
					$details = mysqli_fetch_array($res); 
					echo "{$details[0]}";  // when fetching single things use indexes than column's Name
					$sql2 = "SELECT * from updates where maxpkg>=$details[0]";
					$res2 = mysqli_query($conn,$sql2);
					$count2 = mysqli_num_rows($res2);
					if($count2>0){
						while($details2 = mysqli_fetch_array($res)){
						echo"<p>{$details2['comment']}</p>";
						echo"<a href='{$details2['links']}'>{$details2['links']}</a>";
						echo"<br><br>";
						}
					}
					
				}
				else{
					$sql2 = "SELECT * from updates";
					$res2 = mysqli_query($conn,$sql2);
					while($details2 = mysqli_fetch_array($res2)){
						echo"<p>{$details2['comment']}</p>";
						echo"<a href='{$details2['links']}'>{$details2['links']}</a>";
						echo"<br><br>";
					}
				}
			}
			else{
				echo "err..";
			}
		?>
	</div>

</body>
</html>