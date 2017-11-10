<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 'on');
  $servername = "localhost";
  $username = "root";
  $password = "password";
  $dbname = "miniproject";
  $conn = new mysqli($servername, $username, $password, $dbname);
  $date=$_POST['date'];
  $train=$_POST['train-id'];
  $available=$_POST['available-seats'];
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $sql = "CALL addStatus('$date',$train,$available);";
  $result = $conn->query($sql);
  if($result){
    echo "<script>alert('Train status updated successfully!');window.location.href='/miniproject/admin/avail.php';</script>";
  }
  else{
    echo "<script>alert('Train is not available on that day OR Train status already added!');window.location.href='/miniproject/admin/avail.php';</script>";
  }
  print_r($result);
  $conn->close();
?>
