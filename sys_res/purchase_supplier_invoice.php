<?php
include '../lib/conn.php';
$sql="SELECT p.invoice FROM purchase_invoice_info p WHERE p.supplier_id='$_GET[supplier]'";
$res=$conn->query($sql);
?>
<option selected="selected" value="">Select Invoice</option>
<?php
while ($row=$res->fetch_assoc()) {
?>
	<option value="<?php echo $row['invoice']?>"><?php echo $row["invoice"]?></option>
<?php
 }
?>