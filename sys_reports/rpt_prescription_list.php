          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
               <a href="sys_forms/frm_addLab.php" class="update_link"><button class="btn btn-primary btn-sm" style="float:right;margin-left: 15px;"> <span class="fas fa-plus mr-3"></span> Add New</button> </a>
              <table id="rpt" class="table table-hover">
                <thead>
                  <tr>
                    <th>S. NO</th>
                    <th>Prescription No</th>
                    <th>Patient Name</th>
                    <th>Doctor</th>
                    <th>Date</th>
                    <th style="text-align: center;">Print</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                include '../lib/conn.php';
                $sql="CALL rp_prescription_list()";
                $result=$conn->query($sql);
                $i=1;
                while ($row=$result->fetch_assoc()) {
                ?>
                   <tr>
                    <td style="color: black;"><?php  echo $i?></td>
                    <td style="color: black;"><?php echo $row["prescription_serial"]?></td>
                    <td style="color: black;"><?php echo $row["patient"]?></td>
                    <td style="color: black;"><?php echo $row["doctor"]?></td>
                    <td style="color: black;"><?php echo $row["date"]?></td>
                    <td style="color: black;" align="center"><?php echo $row["print"]?></td>
                  </tr>
                <?php
                $i++;
                }
                ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <div class="modal fade" id="update-modal">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header" style="color: white;background-color:#0468CE;">
                  <h4 class="modal-title">Update</h4>
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