          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
                <a href="sys_forms/frm_addSidebar.php" class="update_link"><button class="btn btn-primary btn-sm" style="float:right;margin-left: 15px;"> <span class="fas fa-plus mr-3"></span> Add New</button> </a>
                <table id="rpt" class="table table-hover table-striped text-nowrap">
                  <thead>
                    <tr>
                      <th>S.NO</th>
                      <th>Menu Name</th>
                      <th>Submenu Text</th>
                      <th>Submenu Link</th>
                      <th>Date</th>
                      <th style="text-align: center;">Update</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  include '../lib/conn.php';
                  $sql="CALL rp_submenu";
                  $result=$conn->query($sql);
                  $i=1;
                  while ($row=$result->fetch_assoc()) {
                  ?>
                     <tr>
                      <td style="color: black;"><?php  echo $i?></td>
                      <td style="color: black;"><?php echo $row["name"]?></td>
                      <td style="color: black;"><?php echo $row["text"]?></td>
                      <td style="color: black;"><?php echo $row["href"]?></td>
                      <td style="color: black;"><?php echo $row["date"]?></td>
                      <td style="color: black;" align="center"><?php echo $row["Edit"]?></td>
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