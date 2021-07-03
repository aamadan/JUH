<?php session_start();
include("../lib/conn.php");
?>
            <!-- form start -->
            <form role="form" action="actions/test2.php" method="POST" enctype="multipart/form-data" id="sys_form_prescriptionSales">
              <div class="card card-primary card-outline" id="invoice_info">
                <input type="hidden" name="sp" value="sp_supplier" id="sp_purchase">
                <div class="card-body">
                  <h3>Invoice Information</h3>
                  <hr>
                  <input type="hidden" value="exists" id="checkSales">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="invoice_no">Invoice Number</label>
                        <?php
                          $sql="select value from setup where name='invoice'";
                          $res=$conn->query($sql);
                          $row=$res->fetch_assoc();
                        ?>
                        <input type="text" name="invoice_no" id="invoice_no" class="form-control" placeholder="Enter Invoice Number" value="<?php echo $row['value']+1?>" required readonly>
                      </div>
                    </div>
                    <div class="col-md-4 prescription_input">
                      <div class="form-group">
                        <label>Enter Prescription No</label>
                        <input type="text" class="form-control number" name="prescription_number" id="prescription_number" placeholder="Enter Prescription Number">
                      </div>
                    </div> 
                    <div class="col-md-4">
                      <label style="visibility: hidden;">Search</label>
                      <button type="button" class="btn btn-flat btn-primary btn-block" id="prescription_search_sales"><i class="fas fa-search"></i> Search</button>
                    </div>                                                   
                  </div>
                </div>
              </div>
              <div class="container-fluid">
                <div class="row">
                  <div class="col-12" id="sys-message"></div>
                  <div class="modal fade" id="sys-modal">
                    <div  class="modal-dialog modal-dialog-centered modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Payment Information</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-dark">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body" id="sys-modal-body">
                          <div class="row">                          
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="total">Total</label>
                                <input type="text" name="total" id="total" class="form-control" readonly required>
                              </div>
                            </div>                         
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="discount">Discount</label>
                                <input type="text" name="discount" id="discount" class="form-control number" value="0">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="grand_total">Grand Total</label>
                                <input type="text" name="grand_total" id="grand_total" class="form-control" readonly>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="paid">Paid</label>
                                <input type="text" name="paid" id="paid" class="form-control number" value="0">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="rest">Rest</label>
                                <input type="text" name="rest" id="rest" class="form-control" readonly>
                              </div>
                            </div>  
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-success btn-flat">Submit</button>

                        </div>
                      </div>
                    <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>                
                </div>
              </div>
                  
                              
                <!-- /.card-body -->
                                
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
            </script>
            <!-- /.card -->