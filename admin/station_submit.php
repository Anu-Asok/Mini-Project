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
  $sname=$_POST['s_name'];
  $scode=$_POST['s_code'];
  $sql = "INSERT INTO `Station` (`Station_Code`, `Station_Name`)
          VALUES ('$scode', '$sname')";

  if ($conn->query($sql) === TRUE) {
      //Prints success message
      echo "<script>alert('Station added successfully');window.location.href='/miniproject/admin/station.php';</script>";
  } else {
      //Alerts when insert is unsuccessful
      echo "<script>alert('Station already added!');window.location.href='/miniproject/admin/station.php';</script>";
  }

  $conn->close();
?>
