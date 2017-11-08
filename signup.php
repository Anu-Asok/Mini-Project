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
  $email=$_POST['email'];
  $password=$_POST['password'];
  $name=$_POST['name'];
  $gender=$_POST['gender'];
  $mobile=$_POST['phonenumber'];
  $sql = "INSERT INTO `User` (`email_id`, `password`, `name`, `gender`, `mobile`)
          VALUES ('$email', '$password', '$name', '$gender', '$mobile')";

  if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
?>
