<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 'on');
  $servername = "localhost";
  $username = "root";
  $password = "password";
  $dbname = "miniproject";
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $Email=$_POST['email'];
  $Password=md5($_POST['password']);
  $sql = "SELECT * FROM User WHERE EmailID='$Email' AND Password='$Password'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0){
    $row = $result->fetch_assoc();
    session_start();
    $_SESSION['email']=$row['EmailID'];
    echo "<script>window.location.href='/miniproject/home.php';</script>";
  }
  else{
      echo "0 results";
  }
  $conn->close();
?>
