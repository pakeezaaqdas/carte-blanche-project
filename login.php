<?php
session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
  //something was posted
  $username_ = $_POST['username'];
  $password_ = $_POST['password'];

  if(!ctype_alnum($username_))
  {
    //read from database
    $query = "select * from doctors where username = '$username_' limit 1";
    $result = mysqli_query($con, $query);

    if($result)
    {
      if($result && mysqli_num_rows($result) > 0)
        {
            $dr_data = mysqli_fetch_assoc($result);
             if($dr_data['password'] === $password_)
             {
               $_SESSION['username'] = $username_;
              header("Location: doctor_info.php");
              die;
             }
             else
             {
              $password_error = "Username or password is incorrect";
             }
        }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  </head>
  <body>
    <div class="center">
      <h1>Login</h1>
      <form method="post">
        <div class="txt_field">
          <input type="text" name="username" required>
          <span></span>
          <label>Username</label>
        </div>
        <?php if(isset($username_error) & !empty($username_error)){ echo "<p class='alert alert-danger'>".$username_error."</p>";} ?>
        <div class="txt_field">
          <input type="password" name="password" required>
          <span></span>
          <label>Password</label>
        </div>
        <?php if(isset($password_error) & !empty($password_error)){ echo "<p class='alert alert-danger'>".$password_error."</p>";} ?>
        <input type="submit" value="Login" class="submit-btn">
        <div class="signup_link">
          Not a member? <a href="signup.php">Signup</a>
        </div>
      </form>
    </div>

  </body>
</html>
