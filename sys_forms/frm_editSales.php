<?php
include '../lib/conn.php';
$sql="SELECT sales_type FROM sales_invoice_info WHERE invoice='$_GET[invoice]'";
$res=$conn->query($sql);
$row=$res->fetch_assoc();
if ($row["sales_type"]=="Cash") {
	$form="frm_editCashSales.php?invoice=".$_GET["invoice"];
	$form_label="Edit Cash Sales";
}
elseif ($row["sales_type"]=="Customer") {
	$form="frm_editCustomerSales.php?invoice=".$_GET["invoice"];
	$form_label="Edit Customer Sales";
}
elseif($row["sales_type"]=="Prescription"){
	$form="frm_prescriptionSales.php";
}
else{
	$form="frm_prescriptionCustomerSales.php";
}
?>
<script>
	var url="sys_forms/"+'<?php echo $form?>';
	$("#content-header").text('<?php echo $form_label?>');
	$(this).addClass("active");
	$("#dashboard-location-child").text('<?php echo $form_label?>');
	$("#content-body").empty();
	$.get(url,function(data){
		$("#content-body").html(data);
	});
</script>