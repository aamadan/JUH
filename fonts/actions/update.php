<?php
require '../lib/conn.php';
$sql="UPDATE $_GET[table] SET $_GET[col]='$_GET[val]' WHERE id=$_GET[id]";
$res=$conn->query($sql);
if($res){
	echo "success";
}
else{
	echo $conn->error.$sql;
}
?>