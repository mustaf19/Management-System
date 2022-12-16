<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register</title>
	<script type="text/javascript">
		function formValidate(){
			var ret = true;
			try{
				var e1 = document.getElementById("email").value;
				var e2 = document.getElementById("emailtwo").value;
				if(e1 != e2){
					alert("email are not same");
					ret =  false;
				}

				var pn = document.getElementById('phoneno').value;
				if(pn==""){
					document.getElementById('phoneNojs').innerHTML = 'enter phone no';
					ret = false;
				}

				var dt=document.getElementById('dob').value;
				alert(dt);


			}
			catch(err2){
				// alert(err2);
				alert('err! come after some time!');
					return false;
				}
				return ret;
			}
	</script>
</head>
<body>	
<div style="text-align: center;">
	<h1 style="color: brown;">Register here!</h1>

		<h1 id="check"></h1>
		<form name="registrationForm" action="./Registerphp.php" onsubmit='return formValidate()' method="post" >
			<label>First Name:&nbsp;</label><br><input id='fname' type="text" name="firstname" pattern="[A-Za-z]{1,20}" placeholder="FirstName"/><br><br>

			<label>Last Name: &nbsp;</label><br><input id='lname' text="text" name="lastname" pattern="[A-Za-z]{1,20}"/><br><br>

			<label>Roll No: &nbsp;</label><br><input text="text" name="rollno" pattern="[0-9]{1,20}"><br><br>

			<label>Date of Birth: &nbsp;</label><br><input type="date" id="dob" name="dob"><br><br>

			<label>Graduation Year: &nbsp;</label><br><input type="text" name="gyear" pattern="[0-9]{4}"><br><br>

			<label>Password: &nbsp;</label><br><input type="password" name="password"><br><br>

			<label>Email: &nbsp;</label><br><input id="email" type="text" name="email"/><br><br>

			<label>Enter email again:&nbsp; </label><br><input id="emailtwo" type="text" name="email2"/><br><br>

			<label>Phone No: &nbsp;</label><br><input type="text" id='phoneno' name="phoneno"/>&nbsp;<h6 id="phoneNojs" style="color: indianred;"></h6>

			<input type="submit" style="background-color: green;color: white;"/>&nbsp;&nbsp;<input type="reset" name=""/>
		</form>
		<a href="index.php">Login</a>
	</div>
</body>
</html>