<?php
include("../lib/conn.php");
$sql="SELECT 
		p.category,
		p.num_strp_per_pack,
		p.num_pills_per_pack,
		p.num_inj_per_pack,
		pp.qty,p.sell_price,
		pp.purchase_unit,
		p.category 
		FROM product_info p 
		INNER JOIN product_purchase pp ON pp.product_id=p.id 
		WHERE p.id='$_GET[id]' AND pp.supplier_id='$_GET[supplier_id]' AND pp.invoice='$_GET[invoice]'";
$res=$conn->query($sql);
$row=$res->fetch_assoc();
if ($row["category"] ==1 || $row["category"] ==2 || $row["category"] ==5) {
		//item Notation
		$quantity=$row["qty"];
		$data["purchased_quantity"]=$quantity." ".$row["purchase_unit"];
		$data["p_quantity"]=$quantity;
		$data["options"]="
		<option value=''>Select Return Unit</option>
		<option value='item'>Item</option>
	";		
}
elseif ($row["category"] ==3) {
	$data["options"]="
		<option value=''>Select Purchase Unit</option>
		<option value='bottle'>Bottle</option>
	";
	$quantity=$row["qty"];
	$data["purchased_quantity"]=$quantity." Bottles";
	$data["p_quantity"]=$quantity;
}
elseif ($row["category"] ==4) {
		//item Notation
		$quantity=$row["qty"]/$row["num_inj_per_pack"];
		$data["purchased_quantity"]=$quantity." ".$row["purchase_unit"];
		$data["options"]="
		<option value=''>Select Return Unit</option>
		<option value='item'>Item</option>
	";
		$data["p_quantity"]=$quantity;
}
echo json_encode($data);
?>