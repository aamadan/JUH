<?php
include '../lib/conn.php';
$sql="SELECT c.max_balance,a.amount FROM customer c LEFT JOIN account_receivable a ON a.customer_id=c.id WHERE c.id='$_GET[id]'";
$res=$conn->query($sql);
$row=$res->fetch_assoc();
if ($row["amount"]=="") {
	$data["current"]=0;
}
else{
	$data["current"]=$row["amount"];
}
$data["max"]=$row["max_balance"];
echo json_encode($data);
?>