<?php
//print_r($_POST);
$i=0;
foreach ($_POST["lab_id"] as $value) {
	$sql="CALL sp_insert_lab_request('$_POST[patient_id]','$_POST[ticket]','$_POST[visit_date]','$_POST[doctor_id]','$value','$_POST[user_id]')";
	insert($sql);
}
include ("../lib/conn.php");
	$res=$conn->query('UPDATE `setup` SET `value`= `value`+1 WHERE id=3');
?>

<?php
function insert($sql){
	include ("../lib/conn.php");
	$res=$conn->query($sql);
}
?>
