<?php
include ("../lib/conn.php");
$sql="SELECT p.category,d.has_stripes,d.option_name,p.num_strp_per_pack,p.num_pieces_per_str,p.num_inj_per_pack,p.qty,p.sell_price,p.category,p.sell_price FROM product_info p INNER JOIN drug_category d on d.id=p.category WHERE p.id='$_GET[id]'";
// $sql="SELECT category,qty,num_strp_per_pack,num_pieces_per_str,num_inj_per_pack,sell_price FROM product_info WHERE id='$_GET[id]'";
$res=$conn->query($sql);
$row=$res->fetch_assoc();
if ($row["has_stripes"]==1) {
	if ($_GET["type"]=="item") {
		//item Notation
		$quantity=$row["qty"];
		$data["ap_qty"]=$quantity;
		$data["a_qty"]=$quantity." Items";
		$data["price"]=$row["sell_price"]/($row["num_strp_per_pack"] * $row["num_pieces_per_str"]);
		$data["type"]=$_GET["type"];
	}
	else if ($_GET["type"]=="stripe") {
		//stripe Notation
		$quantity=$row["qty"]/$row["num_pieces_per_str"];
		$data["ap_qty"]=$quantity;
		$data["a_qty"]=$quantity." Stripes";
		$data["price"]=$row["sell_price"]/$row["num_strp_per_pack"];
		$data["type"]=$_GET["type"];
	}
	else{
		//box Notation
		$quantity=$row["qty"]/($row["num_pieces_per_str"]*$row["num_strp_per_pack"]);
		$data["ap_qty"]=$quantity;
		$data["a_qty"]=$quantity." Box";
		$data["price"]=$row["sell_price"];
		$data["type"]=$_GET["type"];
	}
}
else{
	$quantity=$row["qty"];
	$data["ap_qty"]=$quantity;
	$data["price"]=$row["sell_price"];
	$data["a_qty"]=$quantity." ".$row["option_name"];
}
echo json_encode($data);
?>