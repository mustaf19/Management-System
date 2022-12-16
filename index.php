<?php
if( isset($_GET['login']) && $_GET['login']=='0' ){
  try{
    $rollno = $_POST['rollno'];
    $password = md5($_POST['password']);
    require_once "dbcon.php";
    $sql = "SELECT * from `placementdb`.`users` where rollno = '$rollno' and password='$password'";
    $res = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($res);

    if($count==1){   //== can also be used
        session_start();
        $details = mysqli_fetch_array($res);
        $_SESSION['name'] = $details['rname']." ".$details['lname'];
        $_SESSION['rollno'] = $rollno;
        header("location: account.php");
    }
    else{
      echo '<h1 style="text-align: center;">details not found!</h1>';
    }

  }
  catch(Exception $err){
    header("location:index.php?login=nf");
  }
    
}
else if( isset($_GET['login']) && $_GET['login'] == 'nf' ){
  echo '<h1 style="text-align: center;">details not found!</h1>';
}
// else{
//   echo '<h1 style="text-align: center;">details not found!</h1>';
// }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PLacement Project</title>
<link rel="stylesheet" type="text/css" href="./style.css">
  <script type="text/javascript">
    function formValidate(){
      var rno = document.getElementById('rno').value;
      var pwd = document.getElementById('pwd').value;
      if(rno==""){
        document.getElementById('rnoalert').innerHTML = "cant be empty";
        return false;
      }
      else{
        document.getElementById('rnoalert').innerHTML = "ok";
        document.getElementById('rnoalert').style.color = "green";
      }
      if(pwd==""){
        document.getElementById('pwdalert').innerHTML = "cant be empty";
        return false;
      }
      return true;
    }
    
  </script>
</head>
<body>

  <div class="index-div" style="text-align:  width: 50%;">
    <h1 style="color: green;">index</h1>
    <form class="index-form" method="post" action="index.php?login=0" onsubmit="return formValidate()">

      <label for="username">RollNo: </label><br><div id='rnoalert' style="color:red;"></div>
      <input type="text" id='rno' name="rollno" placeholder="Roll No"><br>

      <label for="password">Password: </label><br><div id='pwdalert' style="color:red;"></div>
      <input type="password" id="pwd" name="password"><br><br>

      <input class="btn" type="submit" value="Login">
    </form><br>

    <a href="admin.php?login=0" style="color: white;"><button class="btn">Admin Login</button></a>

    <a href="./register.php" ><button class="btn">Register</button></a>
  </div>
  

</body>
</html>

<?php
if(isset($_GET['logout'])){
  session_start();
  $res = $_GET['logout']; 
  if($res==1){
    session_destroy();
  }
}
 ?>
