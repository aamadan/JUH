<?php
//print_r($_POST);
$diagnosis_id = $_POST['diagnosis_id'];
$diagnosis_type = $_POST['diagnosis_type'];
foreach ($diagnosis_id as $key=>$value) {
	$sql="CALL sp_insert_patient_diagnosis('$_POST[patient_id]','$_POST[ticket]','$_POST[visit_date]','$_POST[doctor_id]','$value','$diagnosis_type[$key]','$_POST[user_id]')";
	insert($sql);
}
include ("../lib/conn.php");
	$res=$conn->query('UPDATE `setup` SET `value`= `value`+1 WHERE id=7');
?>

<?php
function insert($sql){
	include ("../lib/conn.php");
	$res=$conn->query($sql);
}
?>
