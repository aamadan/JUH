<?php
include("../lib/conn.php");
$sql="SELECT p.category,d.has_stripes,d.option_name,p.num_strp_per_pack,p.num_pieces_per_str,p.num_inj_per_pack,p.qty,p.sell_price,p.category FROM product_info p INNER JOIN drug_category d on d.id=p.category WHERE p.id='$_GET[id]'";
// echo $sql;
$res=$conn->query($sql);
$row=$res->fetch_assoc();

if ($row["has_stripes"]==1) {
	if ($row["qty"] < $row["num_pieces_per_str"]) {
		//item Notation
		$quantity=$row["qty"];
		$data["a_qty"]=$quantity." Items";
		$data["price"]=$row["sell_price"]/($row["num_strp_per_pack"] * $row["num_pieces_per_str"]);
		$data["options"]="
		<option value=''>Select Sales Unit</option>
		<option value='item'>Piece</option>
	";		
	}
	else if ($row["qty"] < ($row["num_strp_per_pack"] * $row["num_pieces_per_str"])) {
		//stripe Notation
		$quantity=$row["qty"]/$row["num_pieces_per_str"];
		$data["a_qty"]=$quantity." Stripes";
		$data["price"]=$row["sell_price"]/$row["num_strp_per_pack"];

		$data["options"]="
		<option value=''>Select Sales Unit</option>
		<option value='stripe'>Stripe</option>
		<option value='item'>Piece</option>
	";
	}
	else{
		//box Notation
		$quantity=$row["qty"]/($row["num_pieces_per_str"]*$row["num_strp_per_pack"]);
		$data["a_qty"]=$quantity." Box";
		$data["price"]=$row["sell_price"];

		$data["options"]="
		<option value=''>Select Sales Unit</option>
		<option value='box'>Box</option>
		<option value='stripe'>Stripe</option>
		<option value='item'>Piece</option>";
	}
}
else{
	$data["options"]="
		<option value=''>Select Sales Unit</option>
		<option value='".$row["option_name"]."'>".$row["option_name"]."</option>
	";
	$quantity=$row["qty"];
	$data["price"]=$row["sell_price"];
	$data["a_qty"]=$quantity." ".$row["option_name"];
}
echo json_encode($data);
?>