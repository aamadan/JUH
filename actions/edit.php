<!--
Four Parameters
	Form Name
	SP
	Table
	ID
-->
<script type="text/javascript">
	var url = "<?php  echo $_GET["form"]?>";
	$.ajax({
		url:url,
		async:false,
		success:function(data){
			$("#content-body").html(data);
		}
	})
	//$("form").attr("id","sys_rpt_edit");
	$("[name='sp']").val("<?php echo $_GET["sp"]?>");
	//$($("[name='user_id']")).remove();
	$(".user_credentials").remove();
	// $.get(url,function(data){
	// 	$("#content-body").html(data);
	// });
<?php
include '../lib/conn.php';
$sql="CALL sp_update_form('$_GET[table]',$_GET[id])";
$res=$conn->query($sql);
$col=$res->fetch_fields();
$row=$res->fetch_array();
$i=0;
foreach ($col as $value) {	
	$id=$value->name;
?>
	$("#<?php echo $id?>").val("<?php echo $row[$i]?>");
<?php
	$i++;
}
?>
</script>


