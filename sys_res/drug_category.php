<?php
include "../lib/conn.php";
$sql="SELECT has_stripes FROM drug_category WHERE id='$_GET[id]'";
$res=$conn->query($sql);
$row=$res->fetch_assoc();
if($row["has_stripes"]==1){
	echo "stripes";
}
else{
	echo "test";
}
?>