<div class="col-md-4 customer_input">
	<div class="form-group">
		<label>Select Customer</label>
		<select class="form-control select2" style="width: 100%;" name="customer" id="customer" required>
			<option value="">Select Customer</option>
			<?php
			include '../lib/conn.php';
              $sql="SELECT id,name FROM customer";
              $res=$conn->query($sql);
              while ($row=$res->fetch_assoc()) {
            ?>
              <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
            <?php
              }
            ?>
		</select>
	</div>
</div>
<script>
	$('.select2').select2();
      //Initialize Select2 Elements
   	$('.select2bs4').select2({
      theme: 'bootstrap4'
    });
</script>