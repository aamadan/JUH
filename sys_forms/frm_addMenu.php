<?php session_start();?>
            <div class="card card-primary card-outline">
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="actions/insert.php" id="sys_form_change">
                <input type="hidden" name="sp" value="sp_menu">
                <div class="card-body">
                  <div class="row"> 
                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Menu Name</label>
                        <input type="text" name="menu_name"class="form-control" id="menu_name" placeholder="Enter Menu Name" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="re_enter_password">Icon</label>
                        <input type="text" name="icon"class="form-control" id="icon" placeholder="Enter icon" required>

                      </div>
                    </div>                    
                  </div>
                  <input type="hidden" name="id"  id="id" value="<?php echo $_SESSION['user_id'];?>">
                  <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
                </div>
              
                <!-- /.card-body -->

                <div class="card-footer">
                  <div class="row">
                    <div class="col-6">
                    </div>
                    <div class="col-3">
                      <button type="reset" class="btn btn-danger btn-block float-right sys-cancel" style="background-color: #990000">Cancel</button>
                    </div>
                    <div class="col-3">
                      <button type="submit" class="btn btn-block float-right btn-success">Submit</button>
                    </div>
                  </div>
                  
                </div>
              </form>
            </div>
            <div id="sys-message" class="container-fluid">
              <div class="modal fade" id="sys-modal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header" style="color: white;background-color:#0468CE;">
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