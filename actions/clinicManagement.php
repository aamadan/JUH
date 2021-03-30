<?php
include("../lib/conn.php"); 
$sql = "CALL ";
$i = 0;
foreach($_POST as $key => $val){
	if($i == 0) {
		$sql .= $val . "("; 
	}
	else if($i == count($_POST) -1){
		$sql.= "'". $val . "');";
	}
	else{
		$sql.= "'".$val . "',";
	}
$i++;	
}
echo $sql;
$res=$conn->query($sql);
if($res)
{
?>
        <script>
	        $("form").each(function(){
				this.reset();
				$(".select2").val("");
				$(".select2").trigger("change");
			});
        </script>
<?php
	}
?>