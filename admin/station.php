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
    <div class="ui sidebar menu vertical labeled icon">
    <img src="/miniproject/logo.png" id="logo">
    <br>
    <h4>Railway Reservation System</h4>
    <div class="ui divider"></div>
    <a href="#" class="item" id="menu-user-info">
      <i class="user icon"></i>
      Welcome Admin
    </a>
    <a href="/miniproject/admin/station.php" class="item" id="logout">
      <i class="add circle icon"></i>
      <span id="auth-state">Add Station</span>
    </a>
    <a href="/miniproject/admin/logout.php" class="item" id="logout">
      <i class="train icon"></i>
      <span id="auth-state">Add Train</span>
    </a>
    <a href="/miniproject/admin/logout.php" class="item" id="logout">
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
      <form class="ui form" action="/miniproject/admin/station_submit.php" method="post">
        <div class="field">
          <label>Station Name</label>
          <input type="text" name="s_name" placeholder="Station Name">
        </div>
        <div class="field">
          <label>Station Code</label>
          <input type="text" name="s_code" placeholder="Station Code">
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
