<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Miniproject | Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.js"></script>
    <link rel="stylesheet" href="/miniproject/css/menu.css">
  </head>
  <body>
    <?php
      session_start();
      if(!isset($_SESSION["email"])){
          echo "<script>window.location.href='/miniproject/auth.php';</script>";
      }
    ?>
    <div class="ui sidebar menu vertical labeled icon">
    <img src="/miniproject/train-icon.png" id="logo">
    <br>
    <h4>Railway Reservation System</h4>
    <div class="ui divider"></div>
    <a href="#" class="item" id="menu-user-info">
      <i class="user icon"></i>
      Welcome
      <?php
        session_start();
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "miniproject";
        $email = $_SESSION["email"];
        $sql = "SELECT Name FROM User WHERE EmailID='$email'";
        $con = mysqli_connect($servername, $username, $password, $dbname);
        $result = mysqli_query($con,$sql);
        while($row = mysqli_fetch_array($result)) {
          echo $row['Name'];
        }
        mysqli_close($con);
      ?>
    </a>
    <a href="/miniproject/logout.php" class="item" id="logout">
      <i class="sign out icon"></i>
      <span id="auth-state">Logout</span>
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
      <form class="ui form">
        <div class="field">
          <label>First Name</label>
          <input type="text" name="first-name" placeholder="First Name">
        </div>
        <div class="field">
          <label>Last Name</label>
          <input type="text" name="last-name" placeholder="Last Name">
        </div>
        <div class="field">
          <div class="ui checkbox">
            <input type="checkbox" tabindex="0" class="hidden">
            <label>I agree to the Terms and Conditions</label>
          </div>
        </div>
        <button class="ui button" type="submit">Submit</button>
      </form>
    </div>
  </div>
  <script>
    $('#menu-button').click(function() {
      $('.ui.sidebar').sidebar('toggle');
    });
  </script>
  </body>
</html>
