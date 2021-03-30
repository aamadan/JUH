<?php
session_start();
include '../lib/conn.php';
?>
          <div class="card card-primary card-outline">
            <!-- /.card-header -->
            <div class="card-body">
              <form action="sys_res/filter_patient_visits.php" method="POST" id="sys_forms_filter_patient_visits">
                <div class="row mb-3">
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Select Patient</label>
                      <select class="form-control select2" style="width: 100%;" name="visit_patient_id" id="visit_patient_id" required>
                        <option selected="selected" value="%">Select Patient</option>
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
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Select Visit Date</label>
                      <input type="date" name="visit_date" class="form-control" id="visit_date">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label style="visibility: hidden;">Select Patient</label>
                      <button type="submit" class="btn btn-flat btn-block btn-primary"><span class="fas fa-search"></span> Search</button>
                    </div>
                  </div>
                </div>
              </form>
              <hr>
              <div class="table-responsive patient_visits">
                <?php                
                $sql="CALL rp_patient_by_doctor('$_SESSION[id]')";
                $result=$conn->query($sql);
                $col=$result->fetch_fields();
                ?>
                <table id="rpt" class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th width="6%" align="center">S. NO</th>
                      <th width="10%" align="center">Ticket No</th>
                      <th width="25%">Patient Full Name</th>
                      <th width="10%">Gender</th>
                      <th width="11%">Age</th>
                      <th width="11%">Status</th>
                      <th width="11%">Visit Date</th>
                      <th width="6%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  
                  $i=1;
                  while ($row=$result->fetch_assoc()) {
                  ?>
                    <tr>
                      <td width="6%" align="center" style="color: black;"><?php echo $i?></td>
                      <td width="10%" align="center" style="color: black;"><?php echo $row["Ticket No"]?></td>
                      <td width="25%" style="color: black;"><?php echo $row["Full Name"]?></td>
                      <td width="10%" style="color: black;"><?php echo $row["Gender"]?></td>
                      <td width="11%" style="color: black;"><?php echo $row["Age"]?></td>
                      <td width="11%" style="color: black;"><?php echo $row["Status"]?></td>
                      <td width="11%" style="color: black;"><?php echo $row["Ticket Date"]?></td>
                      <td width="6%" style="color: black;" align="center"><?php echo $row["Action"]?></td>
                    </tr>
                  <?php
                  $i++;
                  }
                  ?>
                  </tbody>
                </table>
              </div>
              
            </div>
            <!-- /.card-body -->
          </div>
          <script>
            $(function () {
              $("#example1").DataTable();
              $('#rpt').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": false,
              });
            });
          </script>
          <script type="text/javascript">
              $(document).ready(function () {
                  setInterval(function(){
                    var url="sys_res/patient_visits.php";
                    $.get(url,function(data){
                      $(".patient_visits").empty();
                      $(".patient_visits").append(data);
                    })
                  },120000)
                    $('.select2').select2();
                      //Initialize Select2 Elements
                   $('.select2bs4').select2({
                      theme: 'bootstrap4'
                    });
              });
            </script>