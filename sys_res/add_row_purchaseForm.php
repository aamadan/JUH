<?php
include("../lib/conn.php");
?>
<tr>
	<td width="7%"><?php echo $_GET["number"]?></td>
	<td width="35%">
		<input type="hidden" class="id" value="0">
		<select class="form-control select2 purchase_product" style="width: 100%;"  id="purchase_product<?php echo $_GET["number"]?>">
			<option selected="selected" value="">Select Product</option>
			<?php
			$sql="SELECT p.id,p.brand_name,c.name FROM product_info p INNER JOIN country c ON c.id=p.country ";
			$res=$conn->query($sql);
			while ($row=$res->fetch_assoc()) {
			?>
			<option value="<?php echo $row['id']?>"><?php echo $row["brand_name"]." ".$row['name']?></option>
			<?php
			}
			?>
		</select>
	</td>
	<td width="20%">
		<select class="select2 form-control purchase_unit" style="width: 100%" id="purchase_unit<?php echo $_GET["number"]?>">
			<option value="">Select Purchase Unit</option>
		</select>
	</td>
	<td width="12%">
		<input type="text" class="form-control qty number">
	</td>
	<td width="12%">
		<input type="text" class="form-control price number">
	</td>
	<td width="14%">
		<input type="text" class="form-control amount" readonly>
	</td>
</tr>
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