<?php
session_start();
include '../lib/conn.php';
$sql="CALL prescription_sales_info('$_GET[p_serial]')";
$res=$conn->query($sql);
$i=1;
?>
<div class="card card-primary card-outline" id="prescription_info">
	<div class="card-body">
		<div class="row">                    
			<div class="col-md-12">                      
				<h3 class="mt-4 d-inline">Prescription Sales</h3>    
				<div class="table-responsive">
					<table class="table table-hover text-nowrap" style="table-layout: fixed;">
						<thead>
							<tr>
								<th width="5%">No</th>
								<th width="30%">Item Name</th>
								<th width="16%">Prescriped Qty</th>
								<th width="10%" align="center">Quantity</th>
								<th width="10%" align="center">Price</th>
								<th width="14%" align="center">Amount</th>
							</tr>
						</thead>
						<tbody>
							<?php
							while ($row=$res->fetch_assoc()) {
							?>
								<tr>
									<td width="7%">
										<div class="form-group clearfix">
					                      <div class="icheck-primary d-inline">
					                      	<?php echo $i;?>. 
					                        <input type="checkbox" class="prescription_check" id="prescription_check<?php echo $i?>" checked>
					                        <label for="prescription_check<?php echo $i?>">
					                        </label>
					                      </div>
					                    </div>		
									</td>
									<td width="30%">
										<?php echo $row["brand_name"]. " ".$row["category_name"]." ".$row["country"]?>
										<input type="hidden" class="product_id" name="" value="<?php echo $row["id"]?>">
									</td>
									<td width="16%">
										<?php echo $row["prescription_qty"]?>
									</td>
									<td width="10%">
										<input type="text" class="form-control qty number" name="sales_quantity" value="<?php echo $row["prescription_qty"]?>">
										<input type="hidden" class="form-control ap_qty number">
										<script>
											$(".qty").trigger("blur");
										</script>
									</td>
									<td width="10%">
										<?php
											if ($row["category"]==1 || $row["category"]==2 || $row["category"]==5) {
												$price=$row["sell_price"]/($row["num_strp_per_pack"] * $row["num_pills_per_pack"]);
											}
											else if ($row["category"]==4) {
								 				$price=$row["sell_price"]/$row["num_inj_per_pack"];
											}
											else if($row["category"]==3){
												$price=$row["sell_price"];
											}
										?>
										<input type="text" class="form-control price number" name="sales_price" readonly value="<?php echo $price?>">
									</td>
									<td width="14%">
										<input type="text" class="form-control amount" readonly>
									</td>
								</tr>
							<?php
							$i++;
							}
							?>
						</tbody>
					</table>
				</div>                     
			</div>
		</div>
		<div class="row">
            <div class="col-9"></div>
            <div class="col-3">
                <button type="button" class="btn btn-block float-right btn-success" id="sales_checkout"><i class="fas fa-shopping-cart"></i> Checkout</button>
            </div>
        </div>
	</div>
</div>