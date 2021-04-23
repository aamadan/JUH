<?php
include("../lib/conn.php");
$sql="SELECT p.purchase_cost,p.category FROM product_info p WHERE p.id='$_GET[id]'";
$res=$conn->query($sql);
$row=$res->fetch_assoc();
$data["price"]=$row["purchase_cost"];
if ($row["category"] ==1 || $row["category"] ==2 || $row["category"] ==5) {
	$data["options"]="
		<option value=''>Select Purchase Unit</option>
		<option value='box'>Box</option>
		<option value='stripe'>Stripe</option>
		<option value='item'>Item</option>
	";
}
elseif ($row["category"] ==4) {
	$data["options"]="
		<option value=''>Select Purchase Unit</option>
		<option value='box'>Box</option>
		<option value='item'>Item</option>
	";
}
elseif ($row["category"] ==3) {
	$data["options"]="
		<option value=''>Select Purchase Unit</option>
		<option value='bottle'>Bottle</option>
	";
}
echo json_encode($data);
?>