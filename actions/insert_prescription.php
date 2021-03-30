<?php
//print_r($_POST);
$qty=$_POST['qty'];
$frequency=$_POST['frequency'];
$duration=$_POST['duration'];
$route=$_POST['route'];
foreach ($_POST['drug_id'] as $key=>$value) {
	$sql="CALL sp_insert_prescription('$_POST[patient_id]','$_POST[ticket]','$_POST[visit_date]','$_POST[doctor_id]','$value','$qty[$key]','$frequency[$key]','$duration[$key]','$route[$key]','$_POST[user_id]')";
	echo $sql;
	insert($sql);
}
include ("../lib/conn.php");
	$res=$conn->query('UPDATE `setup` SET `value`= `value`+1 WHERE id=1');
?>

<?php
function insert($sql){
	include ("../lib/conn.php");
	$res=$conn->query($sql);
}
?>
