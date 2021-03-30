          <div class="card">
            <div class="card-header" style="background-color: #990000;color: white;">
              <h3 class="card-title">Users Report</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="rpt" class="table table-hover">
                <thead>
                  <tr>
                    <th width="7%">S. NO</th>
                    <th width="25%">Name</th>
                    <th width="10%">Username</th>
                    <th width="20%">Email</th>
                    <th width="15%">Phone</th>
                    <th width="10%">Usertype</th>
                    <th width="8%">Status</th>
                    <th width="5%">Update</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                include '../lib/conn.php';
                $sql="CALL report_users";
                $result=$conn->query($sql);
                $i=1;
                while ($row=$result->fetch_assoc()) {
                ?>
                  <tr>
                    <td style="color: black;" width="7%"><?php  echo $i?></td>
                    <td style="color: black;" width="25%"><?php echo $row["name"]?></td>
                    <td style="color: black;" width="10%"><?php echo $row["username"]?></td>
                    <td style="color: black;" width="20%"><?php echo $row["email"]?></td>
                    <td style="color: black;" width="15%"><?php echo $row["phone"]?></td>
                    <td style="color: black;" width="10%"><?php echo $row["usertype"]?></td>
                    <td style="color: black;" width="8%"><?php echo $row["status"]?></td>
                    <td style="color: black;" align="center" width="5%"><?php echo $row["update"]?></td>
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