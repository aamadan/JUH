<?php
include ("../lib/conn.php");
$sql="SELECT category,qty,num_strp_per_pack,num_pills_per_pack,num_inj_per_pack,sell_price FROM product_info WHERE id='$_GET[id]'";
$res=$conn->query($sql);
$row=$res->fetch_assoc();
if ($row["category"] ==1 || $row["category"] ==2 || $row["category"] ==5) {
	//if the quantity is less then a stripe
	if ($_GET["type"] == "box") {
		$quantity=$row["qty"]/($row["num_pills_per_pack"]*$row["num_strp_per_pack"]);
		$data["ap_qty"]=$quantity;
		$data["a_qty"]=$quantity." Box";
		$data["price"]=$row["sell_price"];
		$data["type"]=$_GET["type"];
	}
	elseif($_GET["type"] == "stripe"){	
		//stripe Notation
		$quantity=$row["qty"]/$row["num_pills_per_pack"];
		$data["ap_qty"]=$quantity;
		$data["a_qty"]=$quantity." Stripes";
		$data["price"]=$row["sell_price"]/$row["num_strp_per_pack"];
		$data["type"]=$_GET["type"];
	}
	else{
		$quantity=$row["qty"];
		$data["ap_qty"]=$quantity;
		$data["a_qty"]=$quantity." Items";
		$data["price"]=$row["sell_price"]/($row["num_strp_per_pack"] * $row["num_pills_per_pack"]);
		$data["type"]=$_GET["type"];
	}
}
elseif ($row["category"] ==3) {
	$quantity=$row["qty"];
	$data["ap_qty"]=$quantity;
	$data["a_qty"]=$quantity ." Bottles";
	$data["price"]=$row["sell_price"];
}
elseif ($row["category"] ==4) {
	if ($_GET["type"]=="item") {
		$quantity=$row["qty"];
		$data["ap_qty"]=$quantity;
		$data["a_qty"]=$quantity." Items";
		$data["price"]=$row["sell_price"]/($row["num_inj_per_pack"]);
	}
	else{
		$quantity=$row["qty"]/$row["num_inj_per_pack"];
		$data["ap_qty"]=$quantity;
		$data["a_qty"]=$quantity." Box";
		$data["price"]=$row["sell_price"];
	}
}
echo json_encode($data);
?>