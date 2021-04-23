<?php
include '../lib/conn.php';
$sql="SELECT p.id,p.brand_name,c.name FROM product_info p INNER JOIN country c ON c.id=p.country ";
$res=$conn->query($sql);
?>
<option selected="selected" value="">Select Product</option>
<?php
while ($row=$res->fetch_assoc()) {
?>
	<option value="<?php echo $row['id']?>"><?php echo $row["brand_name"]." ".$row['name']?></option>
<?php
 }
?>