<?php
include("../lib/conn.php");
$sql="SELECT p.purchase_cost,p.category,d.has_stripes,d.option_name FROM product_info p INNER JOIN drug_category d on d.id=p.category  WHERE p.id='$_GET[id]'";
$res=$conn->query($sql);
$row=$res->fetch_assoc();
$data["price"]=$row["purchase_cost"];
if ($row["has_stripes"]==1) {
	$data["options"]="
		<option value=''>Select Sales Unit</option>
		<option value='box'>Box</option>
		<option value='stripe'>Stripe</option>
		<option value='item'>Piece</option>";
	
}
else{
	$data["options"]="
		<option value=''>Select Sales Unit</option>
		<option value='".$row["option_name"]."'>".$row["option_name"]."</option>
	";
}
echo json_encode($data);
?>