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
  $Seat_no='1';
  $Name=$_POST['name'];
  $Age=$_POST['age']
  $Gender=$_POST['gender'];
  $Train_id='16301';
  $Booked_by='jacob@gmail.com';
  $sql = "INSERT INTO `Passenger` (`Seat_no`, `Passenger_name`, `Age`, `Gender`, `Train_ID`,`Booked_By`)
          VALUES ('$Seat_no', '$Name', '$Age', '$Gender', '$Train_id','$Booked_by')";

  if ($conn->query($sql) === TRUE) {
      echo "<script>alert('Passenger added');window.location.href='/miniproject/passenger.html';</script>";
  } else {
      echo "<script>alert('Redundant Entry');window.location.href='/miniproject/passenger';</script>";
  }

  $conn->close();
?>
