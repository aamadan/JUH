<?php session_start();
include("../lib/conn.php");
?>
            <div class="card card-primary card-outline">
              <!-- form start -->
              <form role="form" action="actions/insert.php" method="POST" enctype="multipart/form-data" id="sys_form_res">
                <input type="hidden" name="sp" value="sp_supplier" id="sp">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="supplier_name">Supplier Name</label>
                        <input type="text" name="supplier_name" class="form-control" id="supplier_name" placeholder="Enter Supplier name" required>
                      </div>
                    </div>  
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="supplier_tell">Supplier Telephone</label>
                        <input type="text" name="supplier_tell" class="form-control" id="supplier_tell" placeholder="Enter Supplier Telephone" required>
                      </div>
                    </div>                                     
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="supplier_email">Supplier Email</label>
                        <input type="email" name="supplier_email" class="form-control" id="supplier_email" placeholder="Enter Supplier Email" required>
                      </div>
                    </div>  
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="supplier_address">Supplier Address</label>
                        <input type="text" name="supplier_address" class="form-control" id="supplier_address" placeholder="Enter Supplier Address" required>
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