<?php session_start();?>
            <div class="card" >
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="sys_res/show_permission.php" id="sys_form_search">
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
                  <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
                </div>
              
                <!-- /.card-body -->

                <div class="card-footer">
                  <div class="row float-right">
                    <div class="col-md-12">
                      <button type="submit" class="form-control btn btn-block btn-primary"><i class="fas fa-search"></i> Search</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div id="report_section"></div>
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