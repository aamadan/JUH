<?php
include("../lib/conn.php");
$sql="SELECT 
		p.category,
		pp.qty,
		pp.purchase_unit,
		p.category,
		d.has_stripes,
		d.name
	FROM product_info p 
	INNER JOIN product_purchase pp ON pp.product_id=p.id
	INNER JOIN drug_category d ON d.id=p.category
	WHERE p.id='$_GET[id]' AND pp.supplier_id='$_GET[supplier_id]' AND pp.invoice='$_GET[invoice]'";
$res=$conn->query($sql);
$row=$res->fetch_assoc();
$quantity=$row["qty"];
$data["p_quantity"]=$quantity;
if ($row['has_stripes']==1) {
	$data["purchased_quantity"]=$quantity." ".$row["purchase_unit"];
}
else{
	$data["purchased_quantity"]=$quantity." ".$row["name"];
}
echo json_encode($data);
?>