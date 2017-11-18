<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Miniproject | Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.js"></script>
    <link rel="shortcut icon" href="/miniproject/logo.png">
    <link rel="stylesheet" href="/miniproject/css/menu.css">
  </head>
  <body>
    <?php
      session_start();
      if(!isset($_SESSION["email"])){
          echo "<script>window.location.href='/miniproject/index.php';</script>";
      }
    ?>
    <?php
      error_reporting(E_ALL);
      ini_set('display_errors', 'on');
      $servername = "localhost";
      $username = "root";
      $password = "password";
      $dbname = "miniproject";
      $GLOBALS['option']="";
      $conn = new mysqli($servername, $username, $password, $dbname);
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      $sql = "SELECT * FROM Station";
      $result = $conn->query($sql);
      if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
          $Station_code = $row['Station_Code'];
          $Station_name = $row['Station_Name'];
          $GLOBALS['option'].="<option value='".$Station_code."'>".$Station_name." ".$Station_code." "."</option>";
        }

      }
      else{
        echo "<script>alert('Error fetching train id!');</script>";
      }
      $conn->close();
    ?>
    <div class="ui secondary pointing menu" id="menu">
      <a href="home.php" class="item">
        Home
      </a>
      <a href="#" class="active item">
        Transactions
      </a>
      <div class="right menu">
        <a class="ui item" href="#">
          <b>Welcome
          <?php
            $servername = "localhost";
            $username = "root";
            $password = "password";
            $dbname = "miniproject";
            $email = $_SESSION["email"];
            $sql = "SELECT * FROM User WHERE EmailID='$email'";
            $con = mysqli_connect($servername, $username, $password, $dbname);
            $result = mysqli_query($con,$sql);
            while($row = mysqli_fetch_array($result)) {
              $GLOBALS['user-info']=$row;
              echo $row['Name'];
            }
            mysqli_close($con);
          ?></b>
        </a>
        <a href="logout.php" class="ui item">
          Logout &nbsp;
          <i class="sign out icon"></i>
        </a>
      </div>
    </div>
    <div class="ui container">
          <?php
            error_reporting(E_ALL);
            ini_set('display_errors', 'On');
            $servername = "localhost";
            $username = "root";
            $password = "password";
            $dbname = "miniproject";
            $email=$GLOBALS['user-info']['EmailID'];
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql="SELECT * FROM `Passenger` WHERE Booked_By='$email'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0){
              echo "<table class='ui celled table'>";
              echo "<thead>";
              echo "<th>PNR</th>";
              echo "<th>Train No.</th>";
              echo "<th>Journey Date</th>";
              echo "<th>Passenger Name</th>";
              echo "<th>Seat No.</th>";
              echo "<th>Age</th>";
              echo "<th>Gender</th>";
              echo "<th>Fare<i class='rupee icon'></i></th>";
              echo "</thead>";
              echo "<tbody>";
              while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['PNR']."</td>";
                echo "<td>".$row['Train_ID']."</td>";
                echo "<td>".$row['Journey_Date']."</td>";
                echo "<td>".$row['Passenger_name']."</td>";
                echo "<td>".$row['Seat_no']."</td>";
                echo "<td>".$row['Age']."</td>";
                echo "<td>".$row['Gender']."</td>";
                echo "<td>".$row['Fare']."</td>";
                echo "</tr>";
              }
              echo "</tbody></table>";
            }
            else{
              echo "<h4>No tickets found!</h4>";
            }
            $conn->close();
          ?>
        </tbody>
      </table>
    </div>
  <script src="/miniproject/script/menu.js"></script>
  </body>
</html>
