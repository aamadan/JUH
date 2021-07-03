<?php
foreach ($_POST["purchase_product"] as $key => $value) {
	$sql="CALL sp_product_purchase('".$_POST['id'][$key]."','".$_POST['purchase_supplier']."','".$_POST['invoice_no']."','".$_POST['purchase_date']."','".$_POST['purchase_product'][$key]."','".$_POST['purchase_unit'][$key]."','".$_POST['purchase_quantity'][$key]."','".$_POST['purchase_price'][$key]."','".$_POST['total']."','".$_POST['discount']."','".$_POST['grand_total']."','".$_POST['paid']."','".$_POST['rest']."','".$_POST['user_id']."')";
	//echo $sql;
	insert($sql);
}
?>
	<script>
	    $("#sys_form_purchase").each(function(){
			this.reset();
			$(".select2").val("");
			$(".select2").trigger("change");
		});
		Swal.fire({
			  title: 'Transction',
			  text: 'Transction processed successfully',
			  icon: 'success',
			  confirmButtonText: 'OK'
			})
      </script>
<?php
function insert($sql){
	include ("../lib/conn.php");
	$res=$conn->query($sql);
	if (!$res) {
	?>
	<script>
		alert("<?php echo $conn->error?>");
		console.log("<?php echo $conn->error?>");
	</script>
	<?php
	}
}
?>