<?php session_start();?>
            <div class="card card-primary card-outline">
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="actions/insert.php" method="POST" enctype="multipart/form-data" id="sys_form_res">
                <input type="hidden" name="sp" value="sp_purchase_return">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="supplier">Select Supplier</label>
                        <select class="form-control select2" style="width: 100%" name="supplier" id="supplier" required>
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
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="invoice">Select Invoice</label>
                        <select class="form-control select2" style="width: 100%" name="invoice" id="invoice" required>
                          <option value="">Select Invoice</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="product">Select Product</label>
                        <select class="form-control select2" style="width: 100%" name="product" id="product" required>
                          <option value="">Select Product</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="purchasedQuantity">Purchased Quantity</label>
                        <input type="text" class="form-control" id="purchasedQuantity" value="" readonly placeholder="Purchase Quantity">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="returnQuantity">Return Quantity</label>
                        <input type="hidden" id="p_quantity">
                        <input type="text" class="form-control" id="returnQuantity" name="returnQuantity" placeholder="Return Quantity">
                      </div>
                    </div>                 
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" id="return_desc" name="return_desc"></textarea>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
                  <input type="hidden" name="id" id="id" value="0">
                </div>              
                <!-- /.card-body -->
                <div class="card-footer">
                  <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-3">
                      <button type="reset" class="btn btn-default btn-block btn-flat">Cancel</button>
                    </div>
                    <div class="col-md-3">
                      <button class="btn btn-success btn-block btn-flat">Submit</button>
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