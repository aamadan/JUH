          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
                <a href="sys_forms/frm_addProduct.php" class="update_link"><button class="btn btn-primary btn-sm" style="float:right;margin-left: 15px;"> <span class="fas fa-plus mr-3"></span> Add New</button> </a>
                <table id="rpt" class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>S. NO</th>
                      <th>Brand Name</th>
                      <th>Generic Name</th>
                      <th>Country</th>
                      <th>Drug Category</th>
                      <th>Stripes</th>
                      <th>Pieces</th>
                      <th>Preferred Supplier</th>
                      <th>Purchase Cost</th>
                      <th>Selling Price</th>
                      <th>Expairy Date</th>
                      <th>Username</th>
                      <th>Date</th>
                      <th style="text-align: center;">Update</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  include '../lib/conn.php';
                  $sql="CALL rp_product_info()";
                  $result=$conn->query($sql);
                  $i=1;
                  while ($row=$result->fetch_assoc()) {
                  ?>
                     <tr>
                      <td style="color: black;"><?php  echo $i?></td>
                      <td style="color: black;"><?php echo $row["brand_name"]?></td>
                      <td style="color: black;"><?php echo $row["generic_name"]?></td>
                      <td style="color: black;"><?php echo $row["country"]?></td>
                      <td style="color: black;"><?php echo $row["drug_category"]?></td>
                      <td style="color: black;"><?php echo $row["stripes"]?></td>
                      <td style="color: black;"><?php echo $row["pieces"]?></td>
                      <td style="color: black;"><?php echo $row["supplier"]?></td>
                      <td style="color: black;"><?php echo $row["purchase_cost"]?></td>
                      <td style="color: black;"><?php echo $row["sell_price"]?></td>
                      <td style="color: black;"><?php echo $row["exp_date"]?></td>
                      <td style="color: black;"><?php echo $row["username"]?></td>
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