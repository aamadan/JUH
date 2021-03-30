<?php session_start();?>
            <div class="card card-primary card-outline">
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="actions/insert.php" method="POST" enctype="multipart/form-data" id="sys_form_res">
                <input type="hidden" name="sp" value="sp_room">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="room_number">Room Number</label>
                        <input type="number" name="room_number"class="form-control" id="room_number" placeholder="Enter Room Number" required>
                      </div>
                    </div>  
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Select Room Category</label>
                        <select class="form-control select2" style="width: 100%;" name="room_category" id="room_category" required>
                          <option selected="selected" value="">Select Room Category</option>
                            <?php
                            include "../lib/conn.php";
                            $sql="SELECT id,name FROM room_category";
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
                        <label for="beds">Number Of bed</label>
                        <input type="number" name="beds"class="form-control" id="Beds" placeholder="Enter Number of Beds" required>
                      </div>
                    </div>                    
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Select Department</label>
                        <select class="form-control select2" style="width: 100%;" name="department" id="department" required>
                          <option selected="selected" value="">Select Department</option>
                            <?php
                            include "../lib/conn.php";
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
                        <label>Room Cost</label>
                        <input type="text" name="room_cost" class="form-control" id="room_cost" required placeholder="Enter Room Cost">
                      </div>
                    </div>
                  </div>
                  <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
                    <input type="hidden" id="id" name="id" value="0">
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