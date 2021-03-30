<?php session_start();
include("../lib/conn.php");
?>
            <div class="card card-primary card-outline">
              <!-- form start -->
              <form role="form" action="actions/insert.php" method="POST" enctype="multipart/form-data" id="sys_form_res">
                <input type="hidden" name="sp" value="sp_product_registration" id="sp">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="brnad_name">Brand Name</label>
                        <input type="text" name="brnad_name" class="form-control" id="brnad_name" placeholder="Enter Brancd name" required>
                      </div>
                    </div>  
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="generic_name">Generic Name</label>
                        <input type="text" name="generic_name" class="form-control" id="generic_name" placeholder="Enter Generic Name" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Select Country</label>
                        <select class="form-control select2" style="width: 100%;" name="country" id="country" required>
                            <option selected="selected" value="">Select Country</option>
                            <?php
                              $sql="SELECT id,name FROM country";
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
                    <div class="col-md-4 drugs_category">
                      <div class="form-group">
                        <label>Select Category</label>
                        <select class="form-control select2" style="width: 100%;" name="drug_category" id="drug_category" required>
                            <option selected="selected" value="">Select Category</option>
                            <?php
                              $sql="SELECT id,name FROM drug_category";
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
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Select Preferred Supplier</label>
                        <select class="form-control select2 selectDef" style="width: 100%;" name="preffered_supplier" id="preffered_supplier" required>
                            <option selected="selected" value="0">Select Preferred Supplier</option>
                            <?php
                              $sql="SELECT id,name FROM supplier";
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
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="purchase_price">Purchase Price</label>
                        <input type="text" name="purchase_price" class="form-control" id="purchase_price" placeholder="Enter Purchase Price" required>
                      </div>
                    </div>                                   
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="sell_price">Selling Price</label>
                        <input type="text" name="sell_price" class="form-control" id="sell_price" placeholder="Enter Selling Price" required>
                      </div>
                    </div>    
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="mfg_date">Manufactored Date</label>
                        <input type="date" name="mfg_date" class="form-control" id="mfg_date"required>
                      </div>
                    </div>   
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exp_date">Expire Date</label>
                        <input type="date" name="exp_date" class="form-control" id="exp_date"required>
                      </div>
                    </div>                                
                  </div>
                  <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
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