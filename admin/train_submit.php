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

  if($source == $destination){
    echo "<script>alert('Source and destination cannot be the same');window.location.href='/miniproject/admin/train.php';</script>";
  }
  else{
    $sql = "INSERT INTO `Train` (`Train_ID`, `Train_name`, `Source_Code`,`Destination_Code`)
            VALUES ('$t_id', '$t_name', '$source', '$destination')";
    if ($conn->query($sql) == TRUE) {
      $stopNo=1;
      for ($x = 0; $x < sizeof($stationCode); $x++) {
        if($arrivalTime[$x]=='')
          $sql = "INSERT INTO `Route` (`Train_ID`, `Station_Code`, `Stop_number`, `Arrival_time`, `Departure_time`, `Source_distance`)
          VALUES ('$t_id', '$stationCode[$x]', '$stopNo', NULL, '$departureTime[$x]','$distance[$x]')";
        else if($departureTime[$x]=='')
          $sql = "INSERT INTO `Route` (`Train_ID`, `Station_Code`, `Stop_number`, `Arrival_time`, `Departure_time`, `Source_distance`)
          VALUES ('$t_id', '$stationCode[$x]', '$stopNo', '$arrivalTime[$x]', NULL,'$distance[$x]')";
        else
          $sql = "INSERT INTO `Route` (`Train_ID`, `Station_Code`, `Stop_number`, `Arrival_time`, `Departure_time`, `Source_distance`)
          VALUES ('$t_id', '$stationCode[$x]', '$stopNo', '$arrivalTime[$x]', '$departureTime[$x]','$distance[$x]')";
        $conn->query($sql);
        $stopNo+=1;
      }
      $daysRun=$_POST['daysRun'];
      foreach($daysRun as $day){
        $sql="INSERT INTO `Days_available` (`Train_ID`, `Dayofweek`) VALUES ('$t_id', '$day');";
        $conn->query($sql);
      }
      echo "<script>alert('Train added successfully');window.location.href='/miniproject/admin/train.php';</script>";
    }

    else {
      echo "<script>alert('Train already added!');window.location.href='/miniproject/admin/train.php';</script>";
    }
  }
  $conn->close();
?>
