              <?php session_start();?>
              <div class="row" id="patient_charges">                    
                    <div class="col-md-10">
                      <div class="card card-primary card-outline">
                        <div class="card-body">
                          <h3 class="mt-4 d-inline">Billing Information</h3>      
                          <div class="table-responsive">
                            <table class="table table-hover" style="table-layout: fixed;">
                              <thead>
                                <tr>
                                  <th width="7%">S.No</th>
                                  <th width="20%">Name</th>
								  
                                  <th width="12%" align="center">Amount</th>
                                </tr>
                              </thead>
                              <tbody >
							  <?php
							  $total=0;
							  if(!empty($_POST["patient_id"])){
								  
							  
								include '../lib/conn.php';
								$sql="CALL rp_patient_charges($_POST[patient_id],'$_POST[start_date]','$_POST[end_date]')";
								$result=$conn->query($sql);
								$i=1;
                echo $sql;
								
								while ($row=$result->fetch_assoc()) {
								$total += $row["amount"];
								?>
							  <tr>
								  <td width="7%"><?php  echo $i?></td>
								  <td width="20%">
								 <input type="hidden" value="<?php echo $row["investigation_id"]?>" class="form-control qty number"><?php echo $row["Name / Description"]?>
								  </td>
								  
								  <td width="12%">
								   <input type="hidden" value="<?php echo $row["amount"]?>" class="form-control amount">$<?php echo $row["amount"]?> 
								  </td>
								</tr> 
								<?php
								$i++;
								}
								}
								?> 
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>                      
                    </div>
                    <div class="col-md-2">
                      <div class="card card-primary card-outline">
                        <div class="card-body">                          
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="purchase_total">Total</label>
                                <input type="text" value="<?php echo $total ?>" name="purchase_total" id="purchase_total" class="form-control" readonly required>
                              </div>
                            </div>                         
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="purchase_discount">Discount</label>
                                <input type="text" name="purchase_discount" id="purchase_discount" class="form-control number" value="0">
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="purchase_grand_total">Grand Total</label>
                                <input type="text" name="purchase_grand_total" id="purchase_grand_total" class="form-control" readonly>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="purchase_paid">Paid</label>
                                <input type="text" name="purchase_paid" id="purchase_paid" class="form-control number" value="0">
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="purchase_rest">Rest</label>
                                <input type="text" name="purchase_rest" id="purchase_rest" class="form-control" readonly>
                              </div>
                            </div>  
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">                          
                          </div>
                        </div>
                      </div>                                            
                    </div>
                  </div>  