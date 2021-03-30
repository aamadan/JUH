<?php session_start();
include("../lib/conn.php");
?>
            <div class="card card-primary card-outline">
              <!-- form start -->
              <form role="form" action="actions/insert.php" method="POST" enctype="multipart/form-data" id="sys_form_res">
                <input type="hidden" name="sp" value="sp_doctor">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="doctor_name">Full Name</label>
                        <input type="text" name="doctor_name" class="form-control" id="doctor_name" placeholder="Enter Full name" required>
                      </div>
                    </div>  
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="doctor_tell">Telephone</label>
                        <input type="text" name="doctor_tell" class="form-control sys-text" id="doctor_tell" placeholder="Enter telephone" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="doctor_email">Email</label>
                        <input type="email" name="doctor_email" class="form-control sys-text" id="doctor_email" placeholder="Enter Email" required>
                      </div>
                    </div>                    
                  </div>
                  <div class="row">
                    <div class="col-md-8">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="doctor_address">Address</label>
                            <input type="text" name="doctor_address" class="form-control" id="doctor_address" placeholder="Enter Address" required>
                          </div>
                        </div>  
                        <div class="col-md-6">
                          <input type="hidden" name="upload" value="doctor_image">
                          <div class="form-group">
                            <label for="doctor_image">Picture</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input sys-file-pic sys-file" id="doctor_image" name="doctor_image" required>
                                <label class="custom-file-label" for="doctor_image" id="sys-file-label">Choose Image</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Select Department</label>
                            <select class="form-control select2" style="width: 100%;" name="doctor_dep" id="doctor_dep" required>
                                <option selected="selected" value="">Select Department</option>
                                <?php
                                  $sql="SELECT id,name FROM department";
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
                            <label>Select Specialist</label>
                            <select class="form-control select2" style="width: 100%;" name="specialist" id="doctor_specialist" required>
                                <option selected="selected" value="">Select Specialist</option>
                                <?php
                                  $sql="SELECT id,name FROM specialist";
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

                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="doctor_biography">Short Biography</label>
                        <textarea id="doctor_biography" class="form-control" name="doctor_biography" rows="5" required></textarea>
                      </div>
                    </div>                    
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="office_tel">Office Telephone</label>
                        <input type="text" name="office_tel" class="form-control" id="office_tel" placeholder="Enter Office Telephone" required>
                      </div>
                    </div>  
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Select Gender</label>
                        <select class="form-control select2" style="width: 100%;" id="gender" name="gender" required>
                            <option selected="selected" value="">Select Gender</option>
                            <?php
                              $sql="SELECT id,name FROM gender";
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
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Select Blood Group</label>
                        <select class="form-control select2" style="width: 100%;" name="blood_group" id="blood_group" required>
                          <option selected="selected" value="">Select Blood Group</option>
                          <?php
                            $sql="SELECT id,name FROM blood_group";
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
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="ticket">Ticket Cost</label>
                        <input type="text" name="user_phone"class="form-control sys-text" id="ticket" placeholder="Enter Ticket Cost" required>
                      </div>
                    </div>                    
                  </div>

                  <div class="user_credentials">
                    <div class="row">
                      <div class="col-md-12">
                        <br>
                        <h3>User Credentials</h3>
                        <hr class="bg-primary">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="username">Username</label>
                          <input type="text" name="username"class="form-control" id="username" placeholder="Enter username" required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="password">Password</label>
                          <input type="password" name="password"class="form-control sys-text" id="new_password" placeholder="Enter password" required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="admin_password">Confirm Password</label>
                          <input type="password" name=""class="form-control sys-text" id="re_enter_password" placeholder="Confirm password" required>
                          <span class="ml-2 password_check"></span>
                        </div>
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