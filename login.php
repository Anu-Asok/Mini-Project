<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 'on');
  $servername = "localhost";
  $username = "root";
  $password = "mysql";
  $dbname = "miniproject";

  $con = mysqli_connect($servername, $username, $password, $dbname);
  if (mysqli_connect_errno()) {
      echo "failed to connect".mysqli_connect_errno();
  }
  session_start();
  $email=mysqli_real_escape_string($con,$_POST['email']);
  $password=mysqli_real_escape_string($con,$_POST['password']);

  $sql = "SELECT user_id FROM User WHERE email_id='$email' AND password='$password'";
  $sql = str_replace("\'","",$sql);
  $result = mysqli_query($con,$sql);

  while($row = mysqli_fetch_array($result)) {
    $count=$row['user_id'];
  }
  if($count!=0){
    $_SESSION['email']=$email;
    echo "<script>window.location.assign('home.php');</script>";
  }
  if($count==0){
    echo "Sorry!";
  }

  mysqli_close($con);
?>
