<?php session_start();?>
            <div class="card card-primary card-outline">
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="actions/insert.php" method="POST" enctype="multipart/form-data" id="sys_form_res">
                <input type="hidden" name="sp" value="sp_patient">
                <div class="card-body">
                  <div class="row mb-2">
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                      <button type="button" class="btn btn-primary btn-block btn-flat" id="patient_exist"><i class="fas fa-ticket-alt mr-2"></i> Ticket</button>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="patient_name">Patient Full Name</label>
                        <input type="text" name="patient_name" class="form-control" id="patient_name" placeholder="Enter Patient Full Name" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="patient_telephone">Patient Telephone</label>
                        <input type="text" name="patient_telephone"class="form-control" id="patient_telephone" placeholder="Enter Patient Telephone" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="patient_address">Patient Address</label>
                        <input type="text" name="patient_address" class="form-control" id="patient_address" placeholder="Enter Patient Address" required>
                      </div>
                    </div>                   
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Select Patient Gender</label>
                        <select class="form-control select2" style="width: 100%;" name="gender" id="gender" required>
                          <option selected="selected" value="">Select Patient Gender</option>
                            <?php
                            include "../lib/conn.php";
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
                    <div class="col-md-4">
                      <label for="patient_age">Patient Age</label>
                      <input type="number" name="patient_age" id="patient_age" class="form-control" placeholder="Enter Patient Age" required>
                    </div>
                     <div class="col-md-4">
                      <div class="form-group">
                        <label>Select Martial Status</label>
                        <select class="form-control select2" style="width: 100%;" name="marital_status" id="marital_status" required>
                          <option selected="selected" value="">Select Martial Status</option>
                            <?php
                            include "../lib/conn.php";
                            $sql="SELECT id,name FROM marital_status";
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
                        <label>Select Doctor</label>
                        <select class="form-control select2" style="width: 100%;" name="doctor" id="doctor" required>
                          <option selected="selected" value="" >Select Doctor</option>
                            <?php
                            include "../lib/conn.php";
                            $sql="SELECT id,name FROM doctor";
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
                        <label for="patient_ticket">Ticket</label>
                        <input type="text" name="patient_ticket" class="form-control" id="patient_ticket" placeholder="Ticket Cost" required>
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
                <div class="modal fade" id="sys-modal" role="dialog">
                  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Patient Visit</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true" class="text-light">&times;</span>
                        </button>
                      </div>
                      <form method="POST" id="sys_form_patient" action="actions/insert.php">
                        <input type="hidden" name="sp" value="sp_ticket">
                        <div class="modal-body" id="sys-modal-body">                      
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Select Patient</label>
                                <select class="form-control select2" style="width: 100%;" name="patient" id="patient" required>
                                  <option selected="selected" value="">Select Patient</option>
                                    <?php
                                    include "../lib/conn.php";
                                    $sql="SELECT id,name,tell FROM patient";
                                    $res=$conn->query($sql);
                                    while ($row=$res->fetch_assoc()) {
                                    ?>
                                      <option value="<?php echo $row['id']?>"><?php echo $row['name']." | ".$row["tell"]?></option>
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
                                <label>Select Doctor</label>
                                <select class="form-control select2" style="width: 100%;" name="select_dotor" id="select_dotor" required>
                                  <option selected="selected" value="">Select Patient</option>
                                  <?php
                                  include "../lib/conn.php";
                                  $sql="SELECT id,name FROM doctor";
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
                                <label for="select_ticket">Ticket Cost</label>
                                <input type="text" name="select_ticket" class="form-control"  id="select_ticket" required>
                              </div>
                            </div>
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
                          </div>
                        </div>
                        <div class="modal-footer">
                             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                             <button type="submit" class="btn btn-success">Save</button>
                        </div>
                      </form>
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
			  
			  $('#sys-modal').modal({
					backdrop: 'static',
					keyboard: false
				})
            </script>
            <!-- /.card -->