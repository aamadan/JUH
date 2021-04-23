<?php
session_start();
include 'lib/conn.php';
$sql="call sp_login('$_POST[username]','$_POST[password]')";
$res=$conn->query($sql);
if($res){
	$row=$res->fetch_assoc();
	if($row['msg'] !="success")
	{
		echo $row['msg'];
	}
	else
	{
		$_SESSION["user_id"]=$row["id"];
		$_SESSION["id"]=$row["user_id"];
		$_SESSION["user_type"]=$row["usertype"];
		echo "success";
	}
}
else{
	echo $conn->error;
}
?>
