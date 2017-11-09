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
    <a href="/miniproject/logout.php" class="item">
      <i class="rupee icon"></i>
      <span id="auth-state">Transactions</span>
    </a>
    <a href="/miniproject/logout.php" class="item">
      <i class="sign out icon"></i>
      <span id="auth-state">Logout</span>
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
  <script src="/miniproject/script/menu.js"></script>
  </body>
</html>
