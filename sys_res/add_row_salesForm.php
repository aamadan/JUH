<?php
include("../lib/conn.php");
?>
<tr>
	<td width="7%"><?php echo $_GET["number"]?></td>
	<td width="40%">
		<select class="form-control select2 sales_product" style="width: 100%;"  id="sales_product<?php echo $_GET["number"]?>">
			<option selected="selected" value="">Select Product</option>
			<?php
			$sql="SELECT p.id,p.name,p.watt,p.amp,p.port,p.cable_size FROM products p WHERE p.quantity >0
			";
			$res=$conn->query($sql);
			while ($row=$res->fetch_assoc()) {
			?>
			<option value="<?php echo $row['id']?>"><?php echo $row["name"]." - ".$row["watt"]." - ".$row['amp']." - ".$row["port"]." - ".$row["cable_size"]?></option>
			<?php
			}
			?>
		</select>
	</td>
	<td width="15%">
		<input type="text" class="form-control a_qty" readonly>
	</td>
	<td width="10%">
		<input type="text" class="form-control qty sales_qty number">
		<input type="hidden" class="form-control ap_qty number">
	</td>
	<td width="10%">
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