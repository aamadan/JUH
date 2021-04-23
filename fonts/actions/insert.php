<?php
include("../lib/conn.php"); 
$sql = "CALL ";
$i = 0;
foreach($_POST as $key => $val){
	if($i == 0) {
		$sql .= $val . "("; 
	}else if ($key == "upload" && $i == count($_POST) -1){
		$path = "images/".$_FILES[$val]['name'];
		move_uploaded_file($_FILES[$val]['tmp_name'],"../".$path);
		$sql.= "'".$path . "');";
	}
	else if ($key == "upload"){
		$path = "images/".$_FILES[$val]['name'];
		$sql.= "'".$path . "',";
	}
	else if($i == count($_POST) -1){
		$sql.= "'". $val . "');";
	}else{
		$sql.= "'".$val . "',";
	}
$i++;	
}
$res=$conn->query($sql);
if($res)
{
	$row=$res->fetch_array();
	$msg=explode("|", $row[0]);
	if($msg[0] == "success"){
		if (isset($_FILES) && !empty($_FILES)) {
			$image_file=$_POST['upload'];
			move_uploaded_file($_FILES[$image_file]['tmp_name'],"../".$path);
		}
?>
        <script>
	        $("#sys_form_res").each(function(){
				this.reset();
				$("#sys_form_res .select2").val("");
				$("#sys_form_res .selectDef").val("0");
				$("#sys_form_res .select2").trigger("change");
			});

			$("#sys_form_patient").each(function(){
				this.reset();
				$("#sys_form_patient .select2").val("");
				$("#sys_form_patient .selectDef").val("0");
				$("#sys_form_patient .select2").trigger("change");
			});
        </script>
<?php
	}
?>
        <div class="alert alert-<?php echo $msg[0];?> fade show alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-<?php if($msg[0] == "success"){ echo "check";} else{ echo "ban";}?>"></i> Message</h5>
                <?php echo $msg[1];?>
                <br>
        </div>
<?php
}
else{
?>
        <div class="alert alert-danger fade show alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-ban"></i> Message</h5>
                <?php echo $conn->error . $sql." Error";?>
        </div>

<?php
}
//echo $sql;
//print_r($_FILES);
?>