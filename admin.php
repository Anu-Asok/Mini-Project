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
  </head>
  <body>
    <div class="ui container">
        <div id="login-form"  style="max-width:500px; margin:0 auto;">
          <div class="ui fluid left icon input">
            <input type="email" id="email" placeholder="Email">
            <i class="user icon"></i>
          </div>
          <br>
          <div class="ui fluid left icon input">
            <input type="password" id="password" placeholder="Password">
            <i class="sign in icon"></i>
          </div>
          <div class="ui divider"></div>
          <button id="login" class="ui teal fluid button">Login</button>
        </div>
      </div>
    </div>
    <script src="/miniproject/script/auth.js"></script>
  </body>
</html>
