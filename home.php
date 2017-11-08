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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui-calendar/0.0.8/calendar.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui-calendar/0.0.8/calendar.min.css" />
  </head>
  <body>
    <div class="ui container">
      <div class="ui secondary menu">
        <div id="auth-menu">
          <a class="item active" data-tab="login" style="display:inline-block;">Login</a>
          <a class="item" data-tab="signup" style="display:inline-block;">Sign up</a>
        </div>
      </div>
      <div id="tab">
        <div class="ui active tab segment" data-tab="login">
          <form action="login.php" method="post">
            <div id="login-form">
              <div class="ui fluid left icon input">
                <input type="email" name="email" placeholder="Email" >
                <i class="user icon"></i>
              </div>
              <br>
              <div class="ui fluid left icon input">
                <input type="password" name="password" placeholder="Password" >
                <i class="sign in icon"></i>
              </div>
              <div class="ui divider"></div>
              <input type="submit" class="ui teal fluid button" value="Login">
            </div>
          </form>
        </div>
        <div class="ui tab segment" data-tab="signup">
          <form action="signup.php" method="post">
            <div id="signup-form">
              <div class="ui fluid left icon input">
                <input type="text" placeholder="Name" name="name" required>
                <i class="font icon"></i>
              </div>
              <br>
              <div class="ui fluid left icon input">
                <input type="email" placeholder="Email" name="email" required>
                <i class="user icon"></i>
              </div>
              <br>
              <div class="ui fluid left icon input">
                <input type="password" placeholder="Password" name="password" minlength="8" required>
                <i class="sign in icon"></i>
              </div>
              <br>
              <select class="ui fluid normal dropdown" name="gender" required>
                <option value="m">Male</option>
                <option value="f">Female</option>
              </select>
              <br>
              <div class="ui calendar" id="date">
                <div class="ui fluid  input left icon">
                  <i class="calendar icon"></i>
                  <input type="text" placeholder="Date of Birth" name="dob" required>
                </div>
              </div>
              <br>
              <div class="ui fluid left icon input">
                <input type="text" placeholder="State" name="state" required>
                <i class="marker icon"></i>
              </div>
              <br>
              <div class="ui fluid left icon input">
                <input type="number" placeholder="Phone Number" name="phonenumber" required>
                <i class="text telephone icon"></i>
              </div>
              <br>
              <div class="ui fluid left icon input">
                <input type="date" placeholder="State" name="state" required>
                <i class="marker icon"></i>
              </div>
              <div class="ui divider"></div>
              <input type="submit" class="ui teal fluid button" value="Sign Up">
            </div>
          </form>
        </div>
      </div>
    </div>
    <script>
      $('.menu .item').tab();
      $('.dropdown').dropdown();
      var today = new Date();
       $('#date').calendar({
         type:'date'
       });
    </script>
    <script src="/miniproject/script/auth.js"></script>
  </body>
</html>
