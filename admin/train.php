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
    <div class="ui sidebar menu vertical labeled icon">
    <img src="/miniproject/logo.png" id="logo">
    <br>
    <h4>Railway Reservation System</h4>
    <div class="ui divider"></div>
    <a href="/miniproject/admin/station.php" class="item">
      <i class="add circle icon"></i>
      Add Station
    </a>
    <a href="#" class="item active">
      <i class="train icon"></i>
      Add Train
    </a>
    <a href="/miniproject/admin/avail.php" class="item">
      <i class="location arrow icon"></i>
      Avail
    </a>
    <a href="/miniproject/admin/logout.php" class="item">
      <i class="sign out icon"></i>
      Logout
    </a>
  </div>

  <!-- Pusher contents -->
  <div class="ui pusher">

    <!-- Menu button top attached -->
    <div class="ui top attached demo menu">
      <a class="item" id="menu-button">
        <i class="sidebar icon"></i>
        Menu
      </a>
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
          <input type="checkbox" name="daysRun[]" value="1">
          <label>Sunday</label>
        </div>
        <div class="ui checkbox">
          <input type="checkbox" name="daysRun[]" value="2">
          <label>Monday</label>
        </div>
        <div class="ui checkbox">
          <input type="checkbox" name="daysRun[]" value="3">
          <label>Tuesday</label>
        </div>
        <div class="ui checkbox">
          <input type="checkbox" name="daysRun[]" value="4">
          <label>Wednesday</label>
        </div>
        <div class="ui checkbox">
          <input type="checkbox" name="daysRun[]" value="5">
          <label>Thursday</label>
        </div>
        <div class="ui checkbox">
          <input type="checkbox" name="daysRun[]" value="6">
          <label>Friday</label>
        </div>
        <div class="ui checkbox">
          <input type="checkbox" name="daysRun[]" value="7">
          <label>Saturday</label>
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
