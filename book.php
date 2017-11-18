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

  $sql="SELECT * FROM `Train_status` WHERE `Train_ID` = '$_POST[trainId]' AND `Available_Date` ='$_POST[journeyDate]' LIMIT 1";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $availableSeats=$row['Available_Seats']-1;
  $bookedSeats=$row['Booked_Seats']+1;

  $sql = "UPDATE `Train_status` SET `Available_Seats` = '$availableSeats', `Booked_Seats` = '$bookedSeats'
          WHERE `Train_ID` = '$_POST[trainId]' AND `Available_Date` = '$_POST[journeyDate]'";

  if ($conn->query($sql) === TRUE) {
    $sql="INSERT INTO `Passenger` (`Seat_no`, `Passenger_name`, `Age`, `Gender`, `Train_ID`, `Booked_By`, `Journey_Date`)
          VALUES ('$bookedSeats', '$_POST[name]', '$_POST[age]', '$_POST[gender]', '$_POST[trainId]', '$_POST[bookedBy]',
          '$_POST[journeyDate]')";
    if ($conn->query($sql) === TRUE){
      $ticket=array(
        'Status' => "success",
        'Seat_no' => $bookedSeats,
        'Passenger_name' => $_POST['name'],
        'Age' => $_POST['age'],
        'Gender' => $_POST['gender'],
        'Train_ID' => $_POST['trainId'],
        'Journey_Date' => $_POST['journeyDate']
      );
      print_r(json_encode($ticket));
    }
    else{
      $ticket=array(
        'Status' => "failed"
      );
      print_r(json_encode($ticket));
    }
  }
  else{
    $ticket=array(
      'Status' => "failed"
    );
    print_r(json_encode($ticket));
  }

  $conn->close();
?>
