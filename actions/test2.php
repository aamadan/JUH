<?php
if (isset($_POST['customer'])) {
	foreach ($_POST["sales_product"] as $key => $value) {
	$sql="CALL sp_customer_sales('".$_POST["id"][$key]."','".$_POST['invoice_no']."','".$_POST['customer']."','".$_POST['sales_product'][$key]."','".$_POST['sales_quantity'][$key]."','".$_POST['sales_price'][$key]."','".$_POST['total']."','".$_POST['discount']."','".$_POST['grand_total']."','".$_POST['paid']."','".$_POST['rest']."','".$_POST['user_id']."')";
	insert($sql);
	}
}
elseif (isset($_POST['prescription_number'])) {
	foreach ($_POST["sales_product"] as $key => $value) {
	$sql="CALL sp_prescription_sales('".$_POST['invoice_no']."','".$_POST['prescription_number']."','".$_POST['sales_product'][$key]."','".$_POST['sales_unit'][$key]."','".$_POST['sales_quantity'][$key]."','".$_POST['sales_price'][$key]."','".$_POST['total']."','".$_POST['discount']."','".$_POST['grand_total']."','".$_POST['paid']."','".$_POST['rest']."','".$_POST['user_id']."')";
	insert($sql);
	}
}
elseif (isset($_POST['customer_name'])) {
	if (empty($_POST["customer_name"])) {
		$_POST["customer_name"]="Cash Sales";
	}
	foreach ($_POST["sales_product"] as $key => $value) {
	$sql="CALL sp_cash_sales('".$_POST["id"][$key]."','".$_POST['invoice_no']."','".$_POST['customer_name']."','".$_POST['sales_product'][$key]."','".$_POST['sales_quantity'][$key]."','".$_POST['sales_price'][$key]."','".$_POST['total']."','".$_POST['discount']."','".$_POST['grand_total']."','".$_POST['paid']."','".$_POST['rest']."','".$_POST['user_id']."')";
	insert($sql);
	}
}
include '../lib/conn.php';
$sql="UPDATE setup SET value='$_POST[invoice_no]' WHERE name='invoice'";
$res=$conn->query($sql);
?>
	<script>
	    $("form").each(function(){
			this.reset();
			$(".select2").val("");
			$(".select2").trigger("change");
			$(".id").val(0);
		});
		Swal.fire({
			  title: 'Transction',
			  text: 'Transction processed successfully',
			  icon: 'success',
			  confirmButtonText: 'OK'
			})
		setTimeout(function(){
			Swal.fire({
				title: 'Print ',
				text: "Saved and Print!",
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				customClass: 'swal-wide',
				confirmButtonText: 'Print',
				allowOutsideClick: false,
				allowEscapeKey: false
			}).then((result) => {
					if (result.value) {
						window.open('sys_reports/rpt_invoice_print.php?invoice_number=<?php echo $_POST["invoice_no"]?>');
					}
					else{
						// $("a").removeClass("active");
						// $(this).parent().parent().parent().find(".anchor-active").addClass("active");
						// $("#content-header").text("Sales");
						// $(this).addClass("active");
						// $("#dashboard-location-child").text("Sales");
						// $("#content-body").empty();
						// var url = "sys_reports/rpt_sales.php";
						// $.get(url,function(data){
						// 	$("#content-body").html(data);
						// });
					}
			})
			
		},2000)
      </script>
<?php
$sql="SELECT value FROM setup WHERE name='invoice'";
$res=$conn->query($sql);
if ($res) {
	$row=$res->fetch_assoc();
?>
	<script>
		$("#invoice_no").val(<?php echo $row["value"]+1?>);
	</script>
<?php
}
else{
	echo $conn->error;
}
function insert($sql){
	include ("../lib/conn.php");
	$res=$conn->query($sql);
}
?>