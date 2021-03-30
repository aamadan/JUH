          <?php
            include '../lib/conn.php';
          ?>
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <form action="sys_res/product_purchases_by_supplier.php" id="report_search" method="POST">
                <div class="row">
                  <div class="col-md-9">
                    <div class="form-group">
                      <label>Select Supplier</label>
                      <select class="form-control select2" style="width: 100%;" id="supplier" name="supplier">
                        <option selected="selected" value="">Select Supplier</option>
                        <?php
                          $sql="SELECT id,name FROM supplier";
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
                    <label style="visibility: hidden;">Search</label>
                    <button type="submit" class="btn btn-flat btn-block btn-primary">
                      <i class="fas fa-search"></i> Search
                    </button>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <div class="table-responsive" id="report_section">
          </div>
<script>
  $('.select2').select2();
    //Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  });
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