<?php
session_start();

include("connection.php");
include("functions.php");

$dr_data = check_login($con);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Doctor Information</title>
        <link rel="stylesheet" href="style.css">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
<body>
<div class="topnav">
  <a class="active" href="#home">Home</a>
  <div class="topnav-right">
    <a href="login.php">Logout</a>
  </div>
</div>
    <br>
    <div class="hello-dr">
    <a href="add_patient.php">
    <button class="add-patient-btn">Add patient</button></a>
        <p><h3>Hello <?php 
        $username = $dr_data['username'];
        echo $username;
        ?>
            
        <p><h5>Here is a list of your patients</h5></p>
    </div>
    <div>
        <?php
        if(isset($_GET['severity'])){
            $severity_value = $_GET['severity'];
            $query = "select patient_name, diagnosis, appointment_date from patients where dr_id = '$username' AND severity = '$severity_value'";
            if($result = mysqli_query($con, $query)) {
                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_array($result)){
                        $dbselected = $row['severity'];
                    }
                    // Function frees the memory associated with the result
                    mysqli_free_result($result);
                }
                else {
                    echo "Something went wrong...";
                }
            }
            else {
                echo "ERROR: Could not execute $sql." . mysql_error($con);
            }
        }
        $options = array('Mild', 'Moderate', 'Severe');
        echo "<select>";
        foreach($options as $option){
            if($dbselected == $option) {
                echo "<option selected='selected' value='$option'>$option</option>";
            }
            else {
                echo "<option value='$option'>$option</option>";
            }
        }
        echo "</select>";
        ?>
    </div>
    <table class="patient-table">
        <tr>
            <th>Patient name</th>
            <th>diagnosis</th>
            <th>Appointment date</th>
            <th> </th>
</tr>
<?php 
$query = "select patient_name, diagnosis, appointment_date from patients where dr_id = '$username'";
$result = mysqli_query($con, $query);
if($result && mysqli_num_rows($result) > 0)
{
    while($row = $result -> fetch_assoc()){
        $patient_name = $row["patient_name"];
        $diagnosis = $row["diagnosis"];
        $appointment_date = $row["appointment_date"];

        echo "<tr><td>".$patient_name."</td><td>".$diagnosis."</td><td>".$appointment_date."</td>
        <td><a href='edit.php?edit=$patient_name'>Edit</a><br><a href='delete.php?patientdel=$patient_name'>Delete</a></td></tr>";
    }
    ?>
    </table>
    <?php
}
else{
    echo "0 result"; 
}
?>

</body>
</html>
