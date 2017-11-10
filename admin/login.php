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
  $username=trim($_POST['username']);
  $password=md5($_POST['password']);
  $sql = "SELECT * FROM `Admin` WHERE Username='$username' AND Password='$password'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0){
    $row = $result->fetch_assoc();
    session_start();
    $_SESSION['username']=$row['Username'];
    echo "<script>window.location.href='/miniproject/admin/station.php';</script>";
  }
  else{
      echo "<script>alert('Incorrect Email ID/Password');window.location.href='/miniproject/admin/index.php';</script>";
  }
  $conn->close();
?>
