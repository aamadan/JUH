<?php
include("../lib/conn.php");
$sql="SELECT p.quantity,p.actual_price FROM products p WHERE p.id='$_GET[id]'";
// echo $sql;
$res=$conn->query($sql);
$row=$res->fetch_assoc();
	$quantity=$row["quantity"];
	$data["price"]=$row["actual_price"];
	$data["a_qty"]=$quantity;
echo json_encode($data);
?>