<?php
include("connection.php");
include("functions.php");
$dr_data = check_login($con);

$username = $dr_data['username'];
$patient_del = $_GET['patient_del'];

$query = "DELETE FROM patients WHERE 'dr_id' = '$username' AND patient_name = '$patient_del'";
$result = mysqli_query($con, $query);
if($result) {
 header("Location: doctor_info.php");
}

?>