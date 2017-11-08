<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 'On');
  $servername = "localhost";
  $username = "root";
  $password = "mysql";
  $dbname = "miniproject";
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  echo $_POST['name']." ";
  echo $_POST['email']." ";
  echo md5($_POST['password'])." ";
  echo $_POST['gender']." ";
  echo $_POST['date']." ";
  echo $_POST['state']." ";
  // Check connection
  // if ($conn->connect_error) {
  //     die("Connection failed: " . $conn->connect_error);
  // }
  //
  // $sql = "INSERT INTO `user` (`id`, `name`) VALUES ('2', 'Test2')";
  //
  // if ($conn->query($sql) === TRUE) {
  //     echo "New record created successfully";
  // } else {
  //     echo "Error: " . $sql . "<br>" . $conn->error;
  // }

  $conn->close();
?>
