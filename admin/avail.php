<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Miniproject | Admin</title>
    <link rel="shortcut icon" href="/miniproject/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.js"></script>
    <link rel="stylesheet" href="/miniproject/css/menu.css">
  </head>
  <body>
    <?php
      session_start();
      if(!isset($_SESSION["username"])){
          echo "<script>window.location.href='/miniproject/admin/index.php';</script>";
      }
    ?>
    <div class="ui secondary pointing menu" id="menu">
      <a href="station.php" class="item">
        Add Station
      </a>
      <a href="train.php" class="item">
        Add Train
      </a>
      <a href="#" class="active item">
        Avail
      </a>
      <div class="right menu">
        <a class="ui item" href="#">
          <b>Welcome Admin</b>
        </a>
        <a href="logout.php" class="ui item">
          Logout &nbsp;
          <i class="sign out icon"></i>
        </a>
      </div>
    </div>
    <div class="ui container">
      <form class="ui form" action="/miniproject/admin/submit-available.php" method="post">
        <div class="field">
          <label>Train ID</label>
          <select class="ui fluid search normal dropdown" name="train-id" required>
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
              $sql = "SELECT Train_ID, Train_name FROM Train";
              $result = $conn->query($sql);
              if ($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                  $trainid = $row['Train_ID'];
                  $trainName = $row['Train_name'];
                  echo "<option value='".$trainid."'>".$trainName." (".$trainid.")</option>";
                }
              }
              else{
                echo "<script>alert('Error fetching train id!);</script>";
              }
              $conn->close();
            ?>
          </select>
        </div>
        <div class="field">
          <label>Available Date</label>
          <input type="date" name="date" placeholder="Date" min=<?php
            echo date('Y-m-d');
            ?>
          required>
        </div>
        <div class="field">
          <label>Available Seats</label>
          <input type="number" name="available-seats" placeholder="Available Seats" required>
        </div>
        <button class="ui button" type="submit">Submit</button>
      </form>
    </div>
  <script>
    $('#menu-button').click(function() {
      $('.ui.sidebar').sidebar('toggle');
    });
    $('.ui.dropdown').dropdown();
    $("input[type=date]").datepicker({
      minDate: 0
    });
  </script>
  </body>
</html>
