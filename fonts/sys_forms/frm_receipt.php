<?php session_start();
include("../lib/conn.php");
?>
            <!-- form start -->
            <form role="form" action="actions/insert_purchase.php" method="POST" enctype="multipart/form-data" id="sys_form_purchase">
              <div class="card card-primary card-outline">
                <input type="hidden" name="sp" value="sp_supplier" id="sp_purchase">
                <div class="card-body">
                  <h3>Patient Information</h3>
                  <hr>
                  <div class="row">
				  <form>
                    <div class="col-md-6">
                      <div class="form-group">
                                <label>Select Patient</label>
                                <select class="form-control select2" style="width: 100%;" name="patient" id="patient" required>
                                  <option selected="selected" value="">Select Patient</option>
                                    <?php
                                    include "../lib/conn.php";
                                    $sql="SELECT id,name,tell FROM patient";
                                    $res=$conn->query($sql);
                                    while ($row=$res->fetch_assoc()) {
                                    ?>
                                      <option value="<?php echo $row['id']?>"><?php echo $row['name']." | ".$row["tell"]?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                              </div>
                    </div>
					
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="purchase_date">Start Date</label>
                        <input type="date" name="start_date" id="start_date" value="<?php echo date("Y-m-d"); ?>" class="form-control" placeholder="Enter Purchase Date" required>
                      </div>
                    </div>  
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="purchase_date">End Date</label>
                        <input type="date" name="end_date" id="end_date" value="<?php echo date("Y-m-d"); ?>" class="form-control" placeholder="Enter Purchase Date" required>
                      </div>
                    </div>
					<div class="col-md-2">
                      <div class="form-group">
                        <label for="purchase_date" style="visibility: hidden;">Search</label>
                        <input type="button" class="btn btn-block btn-flat btn-primary"  value="Search" id="Search">
                      </div>
                    </div> 
					</form>
                  </div>
                </div>
              </div>
                  
                  <div class="row" id="patient_charges">                    
                    <div class="col-md-10">
                      <div class="card card-primary card-outline">
                        <div class="card-body">
                          <h3 class="mt-4 d-inline">Billing Information</h3>      
                          <div class="table-responsive">
                            <table class="table table-hover table-bordered" style="table-layout: fixed;">
                              <thead>
                                <tr>
                                  <th width="7%">S.No</th>
                                  <th width="20%">Name</th>
								  
                                  <th width="12%" align="center">Amount</th>
                                </tr>
                              </thead>
                              <tbody >
							  <tr>
							  <td colspan="3" align="center">Please select patient</td>
							  </tr>
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
                                <input type="text" name="purchase_total" id="purchase_total" class="form-control" readonly required>
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
                <!-- /.card-body -->
                  <div class="row">
                    <div class="col-6">
                    </div>
                    <div class="col-3">
                      <button type="reset" class="btn btn-danger btn-block float-right sys-cancel" >Cancel</button>
                    </div>
                    <div class="col-3">
                      <button type="submit" class="btn btn-block float-right btn-success">Submit</button>
                    </div>
                  </div>              
            </form>
            <script type="text/javascript">
              $(document).ready(function () {
                bsCustomFileInput.init();
              });
            </script>
            <script type="text/javascript">
              $(document).ready(function () {
                    $('.select2').select2();
                      //Initialize Select2 Elements
                   $('.select2bs4').select2({
                      theme: 'bootstrap4'
                    });
              });
			  
          		$("body").on("click","#Search",function(){
                var patient_id = $("#patient").val();
          		  var start_date = $("#start_date").val();
          		  var end_date = $("#end_date").val();                 
                  $.ajax({
                    type:'POST',
                    url:'sys_res/get_patient_charge.php',
                    data:{patient_id:patient_id,start_date:start_date,end_date:end_date},
                    // data:'patient_id='+patient_id,'start_date='+start_date,'end_date='+end_date
                    success:function(html){
          				  $("#patient_charges").html(html);
                      console.log(html);
                    }
                  });
              });
	
            </script>
            <!-- /.card -->