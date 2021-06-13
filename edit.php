<?php
include("connection.php");
include("functions.php");
$dr_data = check_login($con);

$username = $dr_data['username'];

$patient_edit = $_GET('edit');
$query_sel = "SELECT * FROM patients WHERE 'dr_id' = '$username' AND patient_name = '$patient_edit'";
$result = mysqli_query($con, $query_sel);
$selassoc = mysqli_fetch_assoc($result);

$dr_id = $selassoc["dr_id"];
$patient_name = $selassoc["patient_name"];
$diagnosis = $selassoc["diagnosis"];
$appointment_date = $selassoc["appointment_date"];
$severity = $selassoc["severity"];

if(isset($_POST['updateedit'])) {
 $up_name =  $_POST['up_name'];
 $up_diagnosis =  $_POST['up_diagnosis'];
 $up_appointment =  $_POST['up_appointment'];
 $up_severity =  $_POST['up_severity'];
 
 
 $seleditt = "UPDATE patients SET patient_name = '$up_name', diagnosis = '$up_diagnosis', appointment_date = '$up_appointment', severity = '$up_severity' WHERE dr_id = '$username' AND patient_name = '$patient_edit'";
 $result = mysqli_query($con,$seleditt);
 if($result) {
  header("location: doctor_info.php");
 }
}
?>
 
<!DOCTYPE html>
<html>
<head>
 <title></title>
</head>
<body>
<form method="POST" action="">
   <input type="text" name="up_name" value="<?php echo $patient_name; ?>"><br><br>
 <input type="text" name="up_diagnosis" value="<?php echo $diagnosis; ?>"><br><br>
 <input type="date" name="up_appointment" value="<?php echo $appointment_date ; ?>"><br><br>
 <input type="text" name="up_severity" value="<?php echo $severity; ?>"><br><br>
 <input type="submit" name="updateedit" value="Update">
</form>
</body>
</html>