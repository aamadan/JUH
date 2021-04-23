<?php
include '../lib/conn.php';
$sql="SELECT p.id,p.brand_name,pp.invoice,c.name FROM product_purchase pp INNER JOIN product_info p ON pp.product_id=p.id INNER JOIN country c ON c.id=p.country WHERE pp.invoice='$_GET[invoice]'";
$res=$conn->query($sql);
if (!$res) {
	echo $conn->error;
}
?>
<option selected="selected" value="">Select Product</option>
<?php
while ($row=$res->fetch_assoc()) {
?>
    <option value="<?php echo $row['id']?>"><?php echo $row["brand_name"]." ".$row['name']?></option>
<?php
}
?>