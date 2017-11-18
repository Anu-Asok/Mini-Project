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
  $source=$_POST['source'];
  $destination=$_POST['destination'];
  $journeydate=$_POST['journeyDate'];
  $sql="SELECT s.Train_ID,s.Departure_Time,d.Arrival_Time,ts.Available_Seats,(d.Source_Distance-s.Source_Distance) AS Distance FROM `Route` AS s, `Route` AS d, `Train_status` AS ts WHERE s.Station_Code='$source' AND
        d.Station_Code='$destination' AND s.Train_ID=d.Train_ID AND s.Stop_number < d.Stop_number AND ts.Train_ID=s.Train_ID AND ts.Available_Date='$journeydate'
        AND ts.Available_Seats > 0;";
  $result = $conn->query($sql);
  if ($result->num_rows > 0){
    $details=array("success");
    while($row = $result->fetch_assoc()) {
      array_push($details,$row);
    }
  }
  else{
    $details=array("failed");
  }
  print_r(json_encode($details));
  $conn->close();
?>
