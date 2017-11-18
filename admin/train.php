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
      $sql = "SELECT Station_Code, Station_Name FROM Station";
      $result = $conn->query($sql);
      if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
          $Station_code = $row['Station_Code'];
          $Station_name = $row['Station_Name'];
          $GLOBALS['option'].="<option value='".$Station_code."'>".$Station_name." (".$Station_code.")</option>";
        }

      }
      else{
        echo "<script>alert('Error fetching train id!');</script>";
      }
      $conn->close();
    ?>
    <div class="ui secondary pointing menu" id="menu">
      <a href="station.php" class="item">
        Add Station
      </a>
      <a href="#" class="active item">
        Add Train
      </a>
      <a href="avail.php" class="item">
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
      <form class="ui form" action="/miniproject/admin/train_submit.php" method="post">
        <div class="field">
          <label>Train ID</label>
          <input type="number" name="train-id" placeholder="Train ID" required>
        </div>
        <div class="field">
          <label>Train name</label>
          <input type="text" name="train-name" placeholder="Train Name" required>
        </div>
        <div class="field">
          <label>Source</label>
          <select class="ui fluid search normal dropdown" name="source" required>
            <?php
              echo $GLOBALS['option'];
            ?>
          </select>
        </div>
        <div class="field">
          <label>Destination</label>
          <select class="ui fluid search normal dropdown" name="destination" required>
            <?php
              echo $GLOBALS['option'];
            ?>
          </select>
        </div>
        <b>Which all days train run in a week?</b>
        <br><br>
        <div class="ui checkbox">
          <label>Sunday</label>
          <input type="checkbox" name="daysRun[]" value="1">
        </div>
        <div class="ui checkbox">
          <label>Monday</label>
          <input type="checkbox" name="daysRun[]" value="2">
        </div>
        <div class="ui checkbox">
          <label>Tuesday</label>
          <input type="checkbox" name="daysRun[]" value="3">
        </div>
        <div class="ui checkbox">
          <label>Wednesday</label>
          <input type="checkbox" name="daysRun[]" value="4">
        </div>
        <div class="ui checkbox">
          <label>Thursday</label>
          <input type="checkbox" name="daysRun[]" value="5">
        </div>
        <div class="ui checkbox">
          <label>Friday</label>
          <input type="checkbox" name="daysRun[]" value="6">
        </div>
        <div class="ui checkbox">
          <label>Saturday</label>
          <input type="checkbox" name="daysRun[]" value="7">
        </div>
        <table class="ui striped table">
          <thead>
            <tr>
              <th>
                Stop No.
              </th>
              <th>
                Station Code
              </th>
              <th>
                Arrival Time (HH:MM)
              </th>
              <th>
                Departure Time (HH:MM)
              </th>
              <th>
                Source Distance (Km)
              </th>
            </tr>
          </thead>
          <tbody id="add-stops">

          </tbody>
          <tfoot class="full-width">
            <tr>
              <th colspan="5">
                <div class="ui right floated small primary button" id="add">
                  Add Stops
                </div>
              </th>
            </tr>
          </tfoot>
        </table>
        <button class="ui button" type="submit">Submit</button>
      </form>
    </div>
  </div>
  <script>
    $('#menu-button').click(function() {
      $('.ui.sidebar').sidebar('toggle');
    });
    var stopNo=1;
    $('.ui.dropdown').dropdown();
    $('#add').on('click',function(){
      var tr=`
      <tr>
        <td>
          ${stopNo}
        </td>
        <td>
          <select class="ui fluid normal dropdown" name="stationCode[]" required>
            <?php
              echo $GLOBALS['option'];
            ?>
          </select>
        </td>
        <td>
          <input type="time" name="arrivaltime[]">
        </td>
        <td>
        <input type="time" name="departuretime[]">
        </td>
        <td>
          <input type="number" name="distance[]" step="0.01" required>
        </td>
      </tr>
      `;
      stopNo+=1;
      $('#add-stops').append(tr);
    });
  </script>
  </body>
</html>
