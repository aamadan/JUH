<?php
include "../lib/conn.php";
$sql="SELECT has_stripes FROM drug_category WHERE id='$_GET[id]'";
$res=$conn->query($sql);
$row=$res->fetch_assoc();
echo $row["has_stripes"];
?>