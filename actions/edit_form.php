<style>
	.hide{
		display: none;
	}
</style>
<?php
require '../lib/conn.php';
$sql = "call update_form('$_GET[table]','$_GET[id]')";
$res = $conn->query($sql);
$col = $res->fetch_fields();
$row = $res->fetch_array();
$i=-1;
foreach ($col as $value) {
	$i++;
	$label=explode("|", $value->name);
?>
	<div class="row">
		<div class="col-10">
    		<div class="form-group">
            	<label><?php echo $label[0];?></label>
				<?php
				if(!empty($label[1]) && $label[1]=="dropdown"){
                ?>
					<select class="form-control select2 update-select" style="width: 100%;" required>
						<option value="">Select <?php echo $label[0];?></option>
						<?php select($label[2],$row[$i])?>
					</select>
				<?php
				}
				else{
				?>
		   	 		<input type="text" class="form-control update-text" placeholder="Enter <?php echo $label[0];?>" value="<?php echo $row[$i];?>" required>
				<?php
				}
				?>
        	</div>
    	</div>
    	<div class="col-2">
    		<div class="form-group">
                <label style="visibility: hidden;">Update</label>
                <a href="actions/update.php?table=<?php echo $_GET['table']?>&id=<?php echo $_GET['id']?>&col=<?php echo $value->orgname?>" class="btn btn-primary update hide">Update</a>    			
    		</div>
    	</div> 
    </div>
<?php
}
?>



<?php
function select($table,$value){
	require '../lib/conn.php';
    if ($table == "tblteachers_deans") {
        $sql="SELECT id,name from tblteachers WHERE title='Dean'";
    }
    else{
        $sql="SELECT id,name from $table";    
    }
	$options=$conn->query($sql);
	while($option_row=$options->fetch_assoc()){
?>
	<option <?php echo $option_row["id"] == $value?"selected":" ";?> value="<?php echo $option_row['id']?>"><?php echo $option_row["name"]?></option>
<?php
	}
}
?>
            <script type="text/javascript">
              $(document).ready(function () {
                    $('.select2').select2();
                      //Initialize Select2 Elements
                   $('.select2bs4').select2({
                      theme: 'bootstrap4'
                    });
              });
            </script>