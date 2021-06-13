<?php
session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
  //something was posted
  $username = $_POST['username'];
  $dr_name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password1'];
  $password_confirm = $_POST['password2'];

  $query = "select username from doctors where username = $username";
  $result = mysqli_query($con, $query);

  if(!ctype_alnum($username) || !is_numeric($username) && $password_confirm == $password)
  {
    //save to database
    $query = "insert into doctors (username, dr_name, email, password) values ('$username', '$dr_name', '$email', '$password')";
    mysqli_query($con, $query);
   // $dr_data[$dr_username]
   //$_SESSION['dr_name'] = $dr_name;
    header("Location: login.php");
    die;
  }
  else
  {
    if(is_numeric($username))
    {
      $username_error = "Please enter valid username";
    }
    if($result == $username)
    {
      $exist_error = "Username already exists";
    }
    if($password_confirm != $password)
    {
      $password_error = "Passwords do not match";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign up</title>
    <link rel="stylesheet" href="style.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  </head>
  <body>
    <div class="center">
      <h1>Sign Up</h1>
      <form method="post">
        <div class="txt_field">
          <input type="text" name="username" required >
          <span></span>
          <label>Username</label>
        </div>
        <?php if(isset($username_error) & !empty($username_error)){ echo "<p class='alert alert-danger'>".$username_error."</p>";} ?>
        <?php if(isset($exist_error) & !empty($exist_error)){ echo "<p class='alert alert-danger'>".$exist_error."</p>";} ?>
        <div class="txt_field">
          <input type="text" name="name" required >
          <span></span>
          <label>Name</label>
        </div>
        <div class="txt_field">
            <input type="email" name="email" required>
            <span></span>
            <label>Email</label>
          </div>
        <div class="txt_field">
          <input type="password" name="password1" required>
          <span></span>
          <label>Password</label>
        </div>
        <div class="txt_field">
            <input type="password" name="password2" required>
            <span></span>
            <label>Confirm Password</label>
          </div>
          <?php if(isset($password_error) & !empty($password_error)){ echo "<p class='alert alert-danger'>".$password_error."</p>";} ?>
          <input type="submit" value="Sign up" class="submit-btn">
      </form>
    </div>
    </body>
</html>
