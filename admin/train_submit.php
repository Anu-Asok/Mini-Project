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
  $t_id=$_POST['train-id'];
  $t_name=$_POST['train-name'];
  $t_type=$_POST['train-type'];
  $source=$_POST['source'];
  $destination=$_POST['destination'];

  $arrivalTime=$_POST['arrivaltime'];
  $departureTime=$_POST['departuretime'];
  $distance=$_POST['distance'];
  $stationCode=$_POST['stationCode'];

  // foreach ($stopCode as $key => $value) {
  //   $sql = "INSERT INTO `Route` (`Train_ID`, `Station_Code`, `Stop_number`, `Arrival_time`, `Departure_time`, `Source_distance`)
  //           VALUES ('$t_id', '', '3', '10:30', '20:30', '158');";
  //   $conn->query($sql);
  // }
  for ($x = 0; $x < sizeof($stationCode); $x++) {
    echo "$stationCode[$x] $arrivalTime[$x] $departureTime[$x]"."<br>";
}
  // if($source===$destination){
  //   echo "<script>alert('Source and destination cannot be the same');window.location.href='/miniproject/admin/train.php';</script>";
  // }
  // else{
  //   $sql = "INSERT INTO `Train` (`Train_ID`, `Train_name`, `Train_type`, `Source_Code`,`Destination_Code`)
  //           VALUES ('$t_id', '$t_name', '$t_type', '$source', '$destination')";
  //
  //   if ($conn->query($sql) === TRUE) {
  //     echo "<script>alert('Train added successfully');window.location.href='/miniproject/admin/train.php';</script>";
  //   }
  //
  //   else {
  //     echo "<script>alert('Train already added!');window.location.href='/miniproject/admin/train.php';</script>";
  //   }
  // }
  $conn->close();
?>
