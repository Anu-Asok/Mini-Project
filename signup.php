<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 'On');
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
  $Name=$_POST['name'];
  $Gender=$_POST['gender'];
  $Mobile=$_POST['phonenumber'];
  $sql = "INSERT INTO `User` (`EmailID`, `Password`, `Name`, `Gender`, `Mobile`)
          VALUES ('$Email', '$Password', '$Name', '$Gender', '$Mobile')";

  if ($conn->query($sql) === TRUE) {
      session_start();
      $_SESSION["email"]=$Email;
      echo "<script>window.location.href='/miniproject/home.php';</script>";
  } else {
      echo "<script>alert('Email ID already exists!');window.location.href='/miniproject/index.php';</script>";
  }

  $conn->close();
?>
