<?php 
session_start();
include("../lib/conn.php");
?>
            <div class="card card-primary card-outline">
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="actions/insert.php" method="POST" enctype="multipart/form-data" id="sys_form_res">
                <input type="hidden" name="sp" value="sp_test">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Select Lab</label>
                        <select class="form-control select2" style="width: 100%;" name="lab_name" id="lab_name" required>
                            <option selected="selected" value="">Select Lab</option>
                            <?php
                              $sql="SELECT id,name FROM lab";
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
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="lab_test_name">Lab Test Name</label>
                        <input type="text" name="lab_test_name" class="form-control" id="lab_test_name" placeholder="Enter Lab Test name" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="text" name="amount" class="form-control" id="amount" placeholder="Enter Amount" required>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
                  <input type="hidden" name="id" id="id" value="0">
                </div>              
                <!-- /.card-body -->
                <div class="card-footer">
                  <div class="row">
                    <div class="col-6">
                    </div>
                    <div class="col-3">
                      <button type="reset" class="btn btn-danger btn-block float-right sys-cancel" style="background-color: #990000;">Cancel</button>
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
                    $('.select2').select2();
                      //Initialize Select2 Elements
                   $('.select2bs4').select2({
                      theme: 'bootstrap4'
                    });
              });
            </script>
            <!-- /.card -->