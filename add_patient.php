<?php
session_start();

include("connection.php");
include("functions.php");

$dr_data = check_login($con);

if($_SERVER['REQUEST_METHOD'] == "POST")
{
  //something was posted
  $patient_name = $_POST['patient_name'];
  $diagnosis = $_POST['diagnosis'];
  $appointment_date = $_POST['appointment_date'];
  $severity = $_POST['severity'];
  $username = $dr_data['username'];

    //add to database
    $query = "insert into patients (dr_id, patient_name, diagnosis, appointment_date, severity) values ('$username','$patient_name', '$diagnosis', '$appointment_date', '$severity')";
    mysqli_query($con, $query);

    header("Location: doctor_info.php");
    die;
  
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
          <input type="text" name="patient_name" required>
          <span></span>
          <label>Patient name</label>
        </div>
        <div class="txt_field">
          <input type="text" name="diagnosis" required>
          <span></span>
          <label>Diagnosis</label>
        </div>
        <div class="txt_field">
          <input type="date" name="appointment_date" required>
          <span></span>
        </div>
        <div>
          <select name="severity" required>
          <span></span>
          <label>Severity</label>
          <option>Mild</option>
          <option>Moderate</option>
          <option>Severe</option>
</select>
<br>
        </div>
        <input type="submit" value="Add" class="submit-btn">
      </form>
    </div>

  </body>
</html>
