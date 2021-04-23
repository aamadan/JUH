<?php
include("../lib/conn.php");
$sql="SELECT p.category,p.num_strp_per_pack,p.num_pills_per_pack,p.num_inj_per_pack,p.qty,p.sell_price,p.category FROM product_info p WHERE p.id='$_GET[id]'";
$res=$conn->query($sql);
$row=$res->fetch_assoc();
if ($row["category"] ==1 || $row["category"] ==2 || $row["category"] ==5) {
	if ($row["qty"] < $row["num_pills_per_pack"]) {
		//item Notation
		$quantity=$row["qty"];
		$data["a_qty"]=$quantity." Items";
		$data["price"]=$row["sell_price"]/($row["num_strp_per_pack"] * $row["num_pills_per_pack"]);
		$data["options"]="
		<option value=''>Select Sales Unit</option>
		<option value='item'>Item</option>
	";		
	}
	else if ($row["qty"] < ($row["num_strp_per_pack"] * $row["num_pills_per_pack"])) {
		//stripe Notation
		$quantity=$row["qty"]/$row["num_pills_per_pack"];
		$data["a_qty"]=$quantity." Stripes";
		$data["price"]=$row["sell_price"]/$row["num_strp_per_pack"];

		$data["options"]="
		<option value=''>Select Sales Unit</option>
		<option value='stripe'>Stripe</option>
		<option value='item'>Item</option>
	";
	}
	else{
		//box Notation
		$quantity=$row["qty"]/($row["num_pills_per_pack"]*$row["num_strp_per_pack"]);
		$data["a_qty"]=$quantity." Box";
		$data["price"]=$row["sell_price"];

		$data["options"]="
		<option value=''>Select Sales Unit</option>
		<option value='box'>Box</option>
		<option value='stripe'>Stripe</option>
		<option value='item'>Item</option>";
	}
}
elseif ($row["category"] ==3) {
	$data["options"]="
		<option value=''>Select Purchase Unit</option>
		<option value='bottle'>Bottle</option>
	";
	$quantity=$row["qty"];
	$data["price"]=$row["sell_price"];
	$data["a_qty"]=$quantity." Bottles";
}
elseif ($row["category"] ==4) {
	if ($row["qty"] < $row["num_inj_per_pack"]){
		//item Notation
		$quantity=$row["qty"]/$row["num_inj_per_pack"];
		$data["a_qty"]=$quantity." Items";
		$data["price"]=$row["sell_price"]/$row["num_inj_per_pack"];
		$data["options"]="
		<option value=''>Select Sales Unit</option>
		<option value='item'>Item</option>
	";
	}
	else{
		// Box Notation
		$quantity=$row["qty"]/$row["num_inj_per_pack"];
		$data["a_qty"]=$quantity." Box";
		$data["price"]=$row["sell_price"];
		$data["options"]="
		<option value=''>Select Sales Unit</option>
		<option value='box'>Box</option>
		<option value='item'>Item</option>";	
	}
}
echo json_encode($data);
?>