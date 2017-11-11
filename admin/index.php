<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="/miniproject/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/miniproject/logo.png">
    <style>
      h1{
        text-align: center;
      }
    </style>
  </head>
  <body>
    <?php
      session_start();
      if(isset($_SESSION["username"])){
          echo "<script>window.location.href='/miniproject/admin/station.php';</script>";
      }
    ?>
    <div class="ui container">
      <div id="login-form"  style="max-width:500px; margin:0 auto;">
        <h1>Admin Panel</h1>
        <br>
        <form action="login.php" method="post">
          <div class="ui fluid left icon input">
            <input type="text" name="username" placeholder="Username">
            <i class="user icon"></i>
          </div>
          <br>
          <div class="ui fluid left icon input">
            <input type="password" name="password" placeholder="Password">
            <i class="sign in icon"></i>
          </div>
          <div class="ui divider"></div>
          <input type="submit" class="ui teal fluid button" value="Submit">
        </form>
      </div>
    </div>
  </body>
</html>
