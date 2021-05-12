          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
               <a href="sys_forms/frm_cashSales.php" data-form-label="Cash Sales" class="update_link"><button class="btn btn-primary"> <span class="fas fa-money-bill"></span> Cash Sales</button> </a>
               <a href="sys_forms/frm_customerSales.php" data-form-label="Customer Sales" class="update_link"><button class="btn btn-primary"> <span class="fas fa-user-tie"></span> Customer Sales</button> </a>
               <a href="sys_forms/frm_prescriptionSales.php" data-form-label="Prescription Sales" class="update_link"><button class="btn btn-primary"> <span class="fas fa-file-prescription"></span> Prescription Sales</button> </a>
               <a href="sys_forms/frm_addLab.php" data-form-label="Edit Customer" class="update_link"><button class="btn btn-primary btn-sm"> <span class="fas fa-plus mr-3"></span> Add New</button> </a>
              <div class="table-responsive">
                <table id="rpt" class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>S. NO</th>
                      <th>Sales Type</th>
                      <th>Description</th>
                      <th>Invoice Number</th>
                      <th>Total</th>
                      <th>Discount</th>
                      <th>Grand Total</th>
                      <th>Paid</th>
                      <th>Rest</th>
                      <th>Date</th>
                      <th>User</th>
                      <th>Edit</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  include '../lib/conn.php';
                  $sql="CALL rpt_sales()";
                  $result=$conn->query($sql);
                  $i=1;
                  while ($row=$result->fetch_assoc()) {
                  ?>
                     <tr>
                      <td style="color: black;"><?php  echo $i?></td>
                      <td style="color: black;"><?php echo $row["sales_type"]?></td>
                      <td style="color: black;"><?php echo $row["Description"]?></td>
                      <td style="color: black;"><?php echo $row["invoice"]?></td>
                      <td style="color: black;"><?php echo $row["total"]?></td>
                      <td style="color: black;"><?php echo $row["discount"]?></td>
                      <td style="color: black;"><?php echo $row["grand_total"]?></td>
                      <td style="color: black;"><?php echo $row["paid"]?></td>
                      <td style="color: black;"><?php echo $row["rest"]?></td>
                      <td style="color: black;"><?php echo $row["Date"]?></td>
                      <td style="color: black;" align="center"><?php echo $row["username"]?></td>
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