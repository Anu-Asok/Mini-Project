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
    <div class="ui sidebar menu vertical labeled icon">
    <img src="/miniproject/logo.png" id="logo">
    <br>
    <h4>Railway Reservation System</h4>
    <div class="ui divider"></div>
    <a href="#" class="item" id="menu-user-info">
      <i class="user icon"></i>
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
      ?>
    </a>
    <a href="#" class="active item">
      <i class="home icon"></i>
      Home
    </a>
    <a href="/miniproject/transaction.php" class="item">
      <i class="rupee icon"></i>
      Transactions
    </a>
    <a href="/miniproject/logout.php" class="item">
      <i class="sign out icon"></i>
      Logout
    </a>
  </div>
  <div class="ui modal">
    <i class="close icon"></i>
    <div class="header">
      Profile
    </div>
    <div class="content">
      <div class="ui list">
        <div class="item">
          <div class="header">Email ID</div>
          <?php echo($GLOBALS['user-info']['EmailID']); ?>
        </div>
        <div class="ui divider"></div>
        <div class="item">
          <div class="header">Name</div>
          <?php echo($GLOBALS['user-info']['Name']); ?>
        </div>
        <div class="ui divider"></div>
        <div class="item">
          <div class="header">Mobile</div>
          <?php echo($GLOBALS['user-info']['Mobile']); ?>
        </div>
      </div>
    </div>
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
      <div class="ui three top attached steps">
        <div class="active step" id="search-trains">
          <i class="search icon"></i>
          <div class="content">
            <div class="description">Search trains</div>
          </div>
        </div>
        <div class="disabled step" id="fill-details">
          <i class="user icon"></i>
          <div class="content">
            <div class="description">Fill details</div>
          </div>
        </div>
        <div class="disabled step" id="confirm-order">
          <i class="info icon"></i>
          <div class="content">
            <div class="description">Ticket confirmation</div>
          </div>
        </div>
      </div>
      <div class="ui attached segment">
        <div id="search-trains-body">
          <div class="ui form">
            <div class="field">
              <label>Source</label>
              <select class="ui search dropdown" name="source">
                <?php
                echo $GLOBALS['option'];
                ?>
              </select>
            </div>
            <div class="field">
              <label>Destination</label>
              <select class="ui search dropdown" name="destination">
                <?php
                echo $GLOBALS['option'];
                ?>
              </select>
            </div>
            <div class="field">
              <label>Journey Date</label>
              <input type="date" name="journey-date">
            </div>
            <button class="ui fluid button" id="search-trains-next">Search Trains</button>
          </div>
          <table class="ui celled table" hidden>
            <thead>
              <tr>
                <th>Train No.</th>
                <th>Departure Time</th>
                <th>Arrival Time</th>
                <th>Available Seats</th>
                <th>Distance</th>
                <th></th>
              </tr>
            </thead>
            <tbody id="train-details">
            </tbody>
            <tfoot class="full-width" hidden>
              <tr>
                <th colspan="6">
                  <div class="ui right floated small primary button" id="select-train">
                    Book
                  </div>
                </th>
              </tr>
            </tfoot>
          </table>
        </div>
        <div id="fill-details-body" hidden>
          <div class="ui form">
            <div class="disabled field">
              <label>Train No.</label>
              <input type="text" name="selected-train">
            </div>
            <div class="disabled field">
              <label>Journey Date</label>
              <input type="date" name="selected-journey-date">
            </div>
            <div class="field">
              <label>Name</label>
              <input type="text" name="name" placeholder="Name">
            </div>
            <div class="field">
              <label>Age</label>
              <input type="number" name="age" placeholder="Age">
            </div>
            <div class="inline fields">
              <label>Gender:</label>
              <div class="field">
                <div class="ui radio checkbox">
                  <input type="radio" id="male" name="gender" value="Male">
                  <label for="male">Male</label>
                </div>
              </div>
              <div class="field">
                <div class="ui radio checkbox">
                  <input type="radio" id="female" name="gender" value="Female">
                  <label for="female">Female</label>
                </div>
              </div>
            </div>
            <button class="ui button" id="book">Submit</button>
          </div>
        </div>
        <div style="text-align:center;" id="confirm-order-body" hidden>
          <h4>Waiting for confirmation...</h4>
        </div>
      </div>
    </div>
  </div>
  <script src="/miniproject/script/menu.js"></script>
  <script>
    var trainNo,journeyDate;
    $('.ui .dropdown').dropdown();
    $('#select-train').on('click',function(){
      trainNo=$("input:checked").val();
      journeyDate=$('input[name=journey-date]').val();
      if(trainNo===undefined){
        alert('Select a train!');
        return;
      }
      $('input[name="selected-train"]').val(trainNo);
      $('input[name="selected-journey-date"]').val(journeyDate);
      $('#search-trains').addClass('completed');
      $('#search-trains').removeClass('active');
      $('#search-trains-body').hide();
      $('#fill-details').removeClass('disabled');
      $('#fill-details').addClass('active');
      $('#fill-details-body').show();
    });
    $('#book').on('click',function(){
      $('#fill-details').addClass('completed');
      $('#fill-details').removeClass('active');
      $('#fill-details-body').hide();
      $('#confirm-order').removeClass('disabled');
      $('#confirm-order').addClass('active');
      $('#confirm-order-body').show();
      $('.loader').show();
      $.post(
        "book.php",
        {
          "trainId":trainNo,
          "journeyDate":journeyDate,
          "name":$('input[name="name"]').val(),
          "age":$('input[name="age"]').val(),
          "gender":$('input[name="gender"]').val(),
          "bookedBy":"<?php echo($GLOBALS['user-info']['EmailID']);?>"
        },
        function(data,status){
          data=JSON.parse(data);
          if(data['Status']=='success'){
            $('#confirm-order').addClass('completed');
            var ticket=`
              <h3>Ticket</h3>
              <table class="ui celled table">
                <tbody>
                  <tr>
                    <td>Passenger name</td>
                    <td>${data['Passenger_name']}</td>
                  </tr>
                  <tr>
                    <td>Seat number</td>
                    <td>${data['Seat_no']}</td>
                  </tr>
                  <tr>
                    <td>Date of journey</td>
                    <td>${data['Journey_Date']}</td>
                  </tr>
                  <tr>
                    <td>Age</td>
                    <td>${data['Age']}</td>
                  </tr>
                  <tr>
                    <td>Gender</td>
                    <td>${data['Gender']}</td>
                  </tr>
                </tbody>
              </table>
              <a href="/miniproject/home.php" class="ui fluid green button">Book another ticket</a>
            `;
          }
          else{
            var ticket=`
              <h3>Ticket booking failed!</h3>
              <a href="/miniproject/home.php" class="ui fluid green button">Book another ticket</a>
            `;
          }
          $('#confirm-order-body').html(ticket);
        }
      );
    });
    $('#search-trains-next').on('click',function(){
      var jd=$('input[name=journey-date]').val();
      if(jd==''){
        alert('Select journey date!');
        return;
      }
      $.post("getTrain.php",
      {
        "source":$("select[name='source']").val(),
        "destination":$("select[name='destination']").val(),
        "journeyDate":jd
      },
      function(data, status){
        data=JSON.parse(data);
        if(data[0]=='success'){
          $('#train-details').html('');
          for(var i=1; i<data.length; i++){
            var row=`
              <tr>
                <td>${data[i]['Train_ID']}</td>
                <td>${data[i]['Departure_Time']}</td>
                <td>
                  ${data[i]['Arrival_Time']}
                </td>
                <td>
                  ${data[i]['Available_Seats']}
                </td>
                <td>
                  ${data[i]['Distance']}
                </td>
                <td>
                  <input type="radio" name="trainID" value="${data[i]['Train_ID']}">
                </td>
              </tr>
            `;
            $('#train-details').append(row);
          }
          $('table').show();
          $('tfoot').show();
        }
        else{
          $('table').hide();
          $('tfoot').hide();
          alert("No trains found!");
        }
      console.log(data);
      });
    });
  </script>
  </body>
</html>
