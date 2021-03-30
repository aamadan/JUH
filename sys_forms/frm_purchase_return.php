<?php session_start();?>
            <div class="card card-primary card-outline">
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="actions/insert.php" method="POST" enctype="multipart/form-data" id="sys_form_res">
                <input type="hidden" name="sp" value="sp_insert_diagnosis">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-group">
                        <label for="supplier_invoice">Select Supplier</label>
                        <select class="form-control select2" name="supplier_invoice" id="supplier_invoice">
                          <option value="">Select Supplier</option>
                          <?php
                          include '../lib/conn.php';
                          $sql="SELECT id,name FROM supplier";
                          $res=$conn->query($sql);
                          while ($row=$res->fetch_assoc()) {
                          ?>
                          <option value="<?php echo $row["id"]?>"><?php echo $row["name"]?></option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>  
                    <div class="col-md-5">
                      <div class="form-group">
                        <label for="invoice">Select Invoice</label>
                        <select class="form-control select2" name="invoice" id="invoice">
                          <option value="">Select Invoice</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <label style="visibility: hidden;">Search</label>
                      <button class="btn btn-primary btn-block btn-flat"><i class="fas fa-search"></i> Search</button>
                    </div>                 
                  </div>
                  <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
                </div>              
                <!-- /.card-body -->
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
            <!-- /.card -->
            <script type="text/javascript">
              $(document).ready(function () {
                    $('.select2').select2();
                      //Initialize Select2 Elements
                   $('.select2bs4').select2({
                      theme: 'bootstrap4'
                    });
              });
            </script>