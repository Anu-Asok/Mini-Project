<!DOCTYPE html>
<html>
  <head>
    <title>Passenger</title>
  </head>
  <body>
    <form action="passenger_submit.php" method="post">
      <label>Passenger Name</label><br />
      <input type="text" placeholder="Passenger Name" name="name"/><br/><br />
      <label>Age</label><br />
      <input type="text" placeholder="Age" name="age"/><br /><br />
      <label>Gender</label><br />
      <select name="gender">
        <option value="male">Male</option>
        <option value="female">Female</option>
      </select><br /><br />
      <input type="submit" value="Confirm">
    </form>
  </body>
</html>
