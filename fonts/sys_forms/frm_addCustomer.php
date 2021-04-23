<?php session_start();
include("../lib/conn.php");
?>
            <div class="card card-primary card-outline">
              <!-- form start -->
              <form role="form" action="actions/insert.php" method="POST" enctype="multipart/form-data" id="sys_form_res">
                <input type="hidden" name="sp" value="sp_customer" id="sp">
                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label>Select Customer Type</label>
                        <select class="form-control select2" style="width: 100%;" name="customer_type" id="customer_type" required>
                            <option selected="selected" value="">Select Customer Type</option>
                            <option value="company">Company</option>
                            <option value="personal">Personal</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="customer_name">Customer Name</label>
                        <input type="text" name="customer_name" class="form-control" id="customer_name" placeholder="Enter Customer name" required>
                      </div>
                    </div>  
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="customer_email">Customer Email</label>
                        <input type="email" name="customer_tell" class="form-control" id="customer_tell" placeholder="Enter Supplier Telephone">
                      </div>
                    </div>                                     
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="customer_mobile">Customer Mobile No</label>
                        <input type="text" name="customer_mobile" class="form-control number" id="customer_mobile" placeholder="Enter Costomer Mobile Number" >
                      </div>
                    </div>  
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="customer_landline">Customer Landline No</label>
                        <input type="text" name="customer_landline" class="form-control" id="customer_landline" placeholder="Enter Customer Landline No">
                      </div>
                    </div> 
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="customer_address">Customer Address</label>
                        <input type="text" name="customer_address" class="form-control" id="customer_address" placeholder="Enter Customer Address">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label>Select Marketer</label>
                        <select class="form-control select2" style="width: 100%;" name="marketer" id="marketer" required>
                            <option selected="selected" value="">Select Marketer</option>
                            <?php
                              $sql="SELECT id,name FROM marketer";
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
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="max_balance">Maximum Balance</label>
                        <input type="text" name="max_balance" class="number form-control" id="max_balance" placeholder="Enter Maximum Balance">
                      </div>
                    </div>                                 
                  </div>
                  <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
                  <input type="hidden" name="id" value="0" id="id">

                </div>              
                <!-- /.card-body -->
                <div class="card-footer">
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
                </div>
              </form>
            </div>

            <!-- Message Modal-->
            <div class="container-fluid">
              <div class="row">
                <div class="col-12" id="sys-message"></div>
                <div class="modal fade" id="sys-modal">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" style="color: white;background-color:#00128C;">
                        <h4 class="modal-title">Message</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true" class="text-light">&times;</span>
                        </button>
                      </div>
                  <div class="modal-body" id="sys-modal-body">
                            
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                        </div>
                  <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>                
              </div>
            </div>
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
            </script>
            <!-- /.card -->