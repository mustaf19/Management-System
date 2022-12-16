
	<div class="f1">
		<h1>Updates</h1>
		<?php
			if( isset($_SESSION['rollno'])){
				echo "<p>Updates for you!</p>";
				// require_once "dbcon.php";
				$rollno = $_SESSION['rollno'];
				echo "$rollno";
				$sql = "SELECT max(distinct(pkg)) from companydata where rollno='$rollno'";
				$res = mysqli_query($conn,$sql);
				$count = mysqli_num_rows($res);

				$details = mysqli_fetch_array($res); 
				if($details[0]) {
					
					// echo "{$details[0]}";  // when fetching single things use indexes than column's Name
					$mx = $details[0]+0.0;
					$s = "SELECT * from `placementdb`.`updates` WHERE maxpkg=$mx";
					$r = mysqli_query($conn,$s);
					$c = mysqli_num_rows($r);
					if($c>0){
						while($details2 = mysqli_fetch_array($r)){
						echo"<p>{$details2['comment']}</p>";
						echo"<a class='links' href='{$details2['links']}' target='_blank'>{$details2['links']}</a>";
						echo"<br><br>";
						}
					}
					
				}
				else{
					$sql2 = "SELECT * from updates";
					$res2 = mysqli_query($conn,$sql2);
					while($details2 = mysqli_fetch_array($res2)){
						echo"<p>{$details2['comment']}</p>";
						echo"<a style='text-decoration: none; background-color: royalblue; padding: 10px; border-radius: 5px;color: white;' href='{$details2['links']}'>{$details2['links']}</a>";
						echo"<br><br>";
					}
				}
			}
			else{
				echo "err..";
			}
		?>
	</div>