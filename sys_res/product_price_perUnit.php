<?php
include ("../lib/conn.php");
$sql="SELECT category,num_pills_per_pack,num_inj_per_pack,num_strp_per_pack,purchase_cost FROM product_info WHERE id='$_GET[id]'";
$res=$conn->query($sql);
$row=$res->fetch_assoc();
if($_GET["type"] == "stripe"){	
	$product_price=$row["purchase_cost"]/$row["num_strp_per_pack"];
	echo $product_price;
}
elseif ($_GET["type"] == "item") {
	if ($row["category"] ==4) {
		$product_price=$row["purchase_cost"]/$row["num_inj_per_pack"];
	}
	else{
		$product_price=$row["purchase_cost"]/($row["num_strp_per_pack"]*$row["num_pills_per_pack"]);
	}
	echo $product_price;
}
else{
	echo $row["purchase_cost"];
}
?>