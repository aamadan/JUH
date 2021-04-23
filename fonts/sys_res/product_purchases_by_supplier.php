<div class="card card-primary card-outline">
	<div class="card-body">
		<table id="rpt" class="table table-hover" style="margin-top: 10px;">
		    <thead>
		        <tr>
		          <th>S.NO</th>
		          <th>Invoice Number</th>
		          <th>Total</th>
		          <th>Discount</th>
		          <th>Grand Total</th>
		          <th>Paid</th>
		          <th>Rest</th>
		          <th>Date</th>
		          <th>Edit</th>
		          <th>Cancel</th>
		        </tr>
		    </thead>
		    <tbody>
				<?php
				include '../lib/conn.php';
				$sql="CALL rp_product_purchase_by_supplier('$_POST[supplier]')";
				$result=$conn->query($sql);
				$i=1;
				while ($row=$result->fetch_assoc()) {
				?>
		        <tr>
			        <td style="color: black;"><?php  echo $i?></td>
			        <td style="color: black;"><?php echo $row["invoice"]?></td>
			        <td style="color: black;"><?php echo $row["total"]?></td>
			        <td style="color: black;"><?php echo $row["discount"]?></td>
			        <td style="color: black;"><?php echo $row["grand_total"]?></td>
			        <td style="color: black;"><?php echo $row["paid"]?></td>
			        <td style="color: black;"><?php echo $row["rest"]?></td>
			        <td style="color: black;"><?php echo $row["date"]?></td>
			        <td style="color: black;" align="center"><?php echo $row["Edit"]?></td>
			        <td style="color: black;" align="center"><?php echo $row["Cancel"]?></td>
		       	</tr>
		        <?php
		        $i++;
		        }
		        ?>
		    </tbody>
		</table>
	</div>
</div>
		
<script>
  $(function () {
    $("#example1").DataTable();
    $('#rpt').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false,
    });
  });
</script>