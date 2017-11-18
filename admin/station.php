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
      <a href="#" class="active item">
        Add Station
      </a>
      <a href="train.php" class="item">
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
  <script>
    $('#menu-button').click(function() {
      $('.ui.sidebar').sidebar('toggle');
    });
  </script>
  </body>
</html>
