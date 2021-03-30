<?php
//print_r($_POST);
$i=0;
foreach ($_POST["image_id"] as $value) {
	$sql="CALL sp_insert_image_request('$_POST[patient_id]','$_POST[ticket]','$_POST[visit_date]','$_POST[doctor_id]','$value','$_POST[user_id]')";
	insert($sql);
}
include ("../lib/conn.php");
	$res=$conn->query('UPDATE `setup` SET `value`= `value`+1 WHERE id=5');
?>

<?php
function insert($sql){
	include ("../lib/conn.php");
	$res=$conn->query($sql);
}
?>
