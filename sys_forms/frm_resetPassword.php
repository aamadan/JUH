<?php session_start();?>
            <div class="card card-primary card-outline">
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="actions/reset_password.php" id="sys_form_change">
                <input type="hidden" name="sp" value="sp_reset_password">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Select Usertype</label>
                        <select class="form-control select2" style="width: 100%;" name="usertype" required id="usertype">
                           <option selected="selected" value="">Select Usertype</option>
                          <?php
                            include '../lib/conn.php';
                            $sql="SELECT id,name FROM usertype";
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
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Select Username</label>
                        <select class="form-control select2" style="width: 100%;" name="username" required id="username">
                           <option selected="selected" value="">Select Username</option>
                        </select>
                      </div>
                    </div>                        
                  </div>
                  <div class="row"> 
                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" name="password"class="form-control" id="new_password" placeholder="Enter new password" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="re_enter_password">Confirm Password</label>
                        <input type="password" name="re_enter_password"class="form-control" id="re_enter_password" placeholder="Enter re-enter password" required>
                        <span class="ml-2 password_check"></span>
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