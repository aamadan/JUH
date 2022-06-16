<?php session_start();
include("../lib/conn.php");
?>
            <!-- form start -->
            <form role="form" action="actions/test2.php" method="POST" enctype="multipart/form-data" id="sys_form_cashSales">
              <div class="card card-primary card-outline" id="invoice_info">
                <div class="card-body">
                  <h3>Invoice Information</h3>
                  <hr>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="invoice_no">Invoice Number</label>
                        <?php
                          $sql="select value from setup where name='invoice'";
                          $res=$conn->query($sql);
                          $row=$res->fetch_assoc();
                        ?>
                        <input type="text" name="invoice_no" id="invoice_no" class="form-control" placeholder="Enter Invoice Number" value="<?php echo $row['value']+1?>" required readonly>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Enter Customer Name</label>
                        <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Enter Customer Name">
                      </div>
                    </div>                                                  
                  </div>
                </div>
              </div>
              <div class="card card-primary card-outline" id="sales_info">
                <div class="card-body">
                  <div class="row">                    
                    <div class="col-md-12">                      
                      <h3 class="mt-4 d-inline">Sales Information</h3>
                      <div class="float-right bg-primary">
                        <button type="button" class="btn btn-flat btn-primary text-center" id="sales_addRow"><span class="fas fa-plus mr-3" ></span> Add New Row</button>
                      </div>    
                      <div class="table-responsive">
                        <table class="table table-hover text-nowrap" style="table-layout: fixed;">
                          <thead>
                            <tr>
                              <th width="5%">No</th>
                              <th width="40%">Item Name</th>
                              <th width="15%" align="center">A.Quantity</th>
                              <th width="10%" align="center">Quantity</th>
                              <th width="10%" align="center">Price</th>
                              <th width="14%" align="center">Amount</th>
                              <!-- <th width="10%" align="center">Action</th> -->
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td width="7%">1</td>
                              <td width="40%">
                                <input type="hidden" class="id" value="0">
                                <select class="form-control select2 sales_product" style="width: 100%;"  id="sales_product1">
                                  <option selected="selected" value="">Select Product</option>
                                  <?php
                                  $sql="SELECT p.id,p.name,p.watt,p.amp,p.port,p.cable_size FROM products p WHERE p.quantity >0";
                                  $res=$conn->query($sql);
                                  while ($row=$res->fetch_assoc()) {
                                  ?>
                                  <option value="<?php echo $row['id']?>"><?php echo $row["name"]." - ".$row["watt"]." - ".$row['amp']." - ".$row["port"]." - ".$row["cable_size"]?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                              </td>
                              <td width="15%">
                                <input type="text" class="form-control a_qty" readonly>
                              </td>
                              <td width="10%">
                                <input type="text" class="form-control qty sales_qty number">
                                <input type="hidden" class="form-control ap_qty number">
                              </td>
                              <td width="10%">
                                <input type="text" class="form-control price number">
                              </td>
                              <td width="14%">
                                <input type="text" class="form-control amount" readonly>
                              </td>
                                  <!-- <td align="center">
                                    <button class="btn"><span class="fas fa-trash"></span></button>
                                  </td> -->
                            </tr>
                            <tr >
                              <td width="7%">2</td>
                              <td width="40%">
                                <select class="form-control select2 sales_product" style="width: 100%;"  id="sales_product2">
                                  <option selected="selected" value="">Select Product</option>
                                  <?php
                                    $sql="SELECT p.id,p.name,p.watt,p.amp,p.port,p.cable_size FROM products p WHERE p.quantity >0";
                                    $res=$conn->query($sql);
                                    while ($row=$res->fetch_assoc()) {
                                  ?>
                                  <option value="<?php echo $row['id']?>"><?php echo $row["name"]." - ".$row["watt"]." - ".$row['amp']." - ".$row["port"]." - ".$row["cable_size"]?><option>
                                  <?php
                                    }
                                  ?>
                                </select>
                              </td>
                              <td width="15%">
                                <input type="text" class="form-control a_qty" readonly>
                              </td>
                              <td width="10%">
                                <input type="text" class="form-control qty sales_qty number">
                                <input type="hidden" class="form-control ap_qty number">
                              </td>
                              <td width="10%">
                                <input type="text" class="form-control price number">
                              </td>
                              <td width="14%">
                                <input type="text" class="form-control amount" readonly>
                              </td>
                                  <!-- <td align="center">
                                    <button class="btn"><span class="fas fa-trash"></span></button>
                                  </td> -->
                            </tr>
                            <tr >
                              <td width="7%">3</td>
                              <td width="40%">
                                <select class="form-control select2 sales_product" style="width: 100%;"  id="sales_product3">
                                  <option selected="selected" value="">Select Product</option>
                                  <?php
                                    $sql="SELECT p.id,p.name,p.watt,p.amp,p.port,p.cable_size FROM products p WHERE p.quantity >0";
                                    $res=$conn->query($sql);
                                    while ($row=$res->fetch_assoc()) {
                                  ?>
                                  <option value="<?php echo $row['id']?>"><?php echo $row["name"]." - ".$row["watt"]." - ".$row['amp']." - ".$row["port"]." - ".$row["cable_size"]?></option>
                                  <?php
                                    }
                                  ?>
                                </select>
                              </td>
                              <td width="15%">
                                <input type="text" class="form-control a_qty" readonly>
                              </td>
                              <td width="10%">
                                <input type="text" class="form-control qty sales_qty number">
                                <input type="hidden" class="form-control ap_qty number">
                              </td>
                              <td width="10%">
                                <input type="text" class="form-control price number">
                              </td>
                              <td width="14%">
                                <input type="text" class="form-control amount" readonly>
                              </td>
                                  <!-- <td align="center">
                                    <button class="btn"><span class="fas fa-trash"></span></button>
                                  </td> -->
                            </tr>
                            <tr >
                              <td width="7%">4</td>
                              <td width="40%">
                                <select class="form-control select2 sales_product" style="width: 100%;"  id="sales_product4">
                                  <option selected="selected" value="">Select Product</option>
                                  <?php
                                    $sql="SELECT p.id,p.name,p.watt,p.amp,p.port,p.cable_size FROM products p WHERE p.quantity >0";
                                    $res=$conn->query($sql);
                                    while ($row=$res->fetch_assoc()) {
                                  ?>
                                  <option value="<?php echo $row['id']?>"><?php echo $row["name"]." - ".$row["watt"]." - ".$row['amp']." - ".$row["port"]." - ".$row["cable_size"]?><option>
                                  <?php
                                    }
                                  ?>
                                </select>
                              </td>
                              <td width="15%">
                                <input type="text" class="form-control a_qty" readonly>
                              </td>
                              <td width="10%">
                                <input type="text" class="form-control qty sales_qty number">
                                <input type="hidden" class="form-control ap_qty number">
                              </td>
                              <td width="10%">
                                <input type="text" class="form-control price number">
                              </td>
                              <td width="14%">
                                <input type="text" class="form-control amount" readonly>
                              </td>
                                  <!-- <td align="center">
                                    <button class="btn"><span class="fas fa-trash"></span></button>
                                  </td> -->
                            </tr>
                            <tr >
                              <td width="7%">5</td>
                              <td width="40%">
                                <select class="form-control select2 sales_product" style="width: 100%;"  id="sales_product5">
                                  <option selected="selected" value="">Select Product</option>
                                  <?php
                                    $sql="SELECT p.id,p.name,p.watt,p.amp,p.port,p.cable_size FROM products p WHERE p.quantity >0";
                                    $res=$conn->query($sql);
                                    while ($row=$res->fetch_assoc()) {
                                  ?>
                                  <option value="<?php echo $row['id']?>"><?php echo $row["name"]." - ".$row["watt"]." - ".$row['amp']." - ".$row["port"]." - ".$row["cable_size"]?></option>
                                  <?php
                                    }
                                  ?>
                                </select>
                              </td>
                              <td width="15%">
                                <input type="text" class="form-control a_qty" readonly>
                              </td>
                              <td width="10%">
                                <input type="text" class="form-control qty sales_qty number">
                                <input type="hidden" class="form-control ap_qty number">
                              </td>
                              <td width="10%">
                                <input type="text" class="form-control price number">
                              </td>
                              <td width="14%">
                                <input type="text" class="form-control amount" readonly>
                              </td>
                                  <!-- <td align="center">
                                    <button class="btn"><span class="fas fa-trash"></span></button>
                                  </td> -->
                            </tr>                        
                          </tbody>
                        </table>
                      </div>                     
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="row">
                    <div class="col-6"></div>
                    <div class="col-3">
                      <button type="reset" class="btn btn-danger btn-block float-right sys-cancel" >Cancel</button>
                    </div>
                    <div class="col-3">
                      <button type="button" class="btn btn-block float-right btn-success" id="sales_checkout"><i class="fas fa-shopping-cart"></i> Check Out</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="container-fluid">
                <div class="row">
                  <div class="col-12" id="sys-message"></div>
                  <div class="modal fade" id="sys-modal">
                    <div  class="modal-dialog modal-dialog-centered modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Payment Information</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-dark">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body" id="sys-modal-body">
                          <div class="row">                          
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="total">Total</label>
                                <input type="text" name="total" id="total" class="form-control" readonly required>
                              </div>
                            </div>                         
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="discount">Discount</label>
                                <input type="text" name="discount" id="discount" class="form-control number" >
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="grand_total">Grand Total</label>
                                <input type="text" name="grand_total" id="grand_total" class="form-control" readonly>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="paid">Paid</label>
                                <input type="text" name="paid" id="paid" class="form-control number" >
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="rest">Rest</label>
                                <input type="text" name="rest" id="rest" class="form-control" readonly>
                              </div>
                            </div>  
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-success btn-flat">Submit</button>

                        </div>
                      </div>
                    <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>                
                </div>
              </div>
                  
                              
                <!-- /.card-body -->
                                
            </form>
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