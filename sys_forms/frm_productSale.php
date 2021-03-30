<?php session_start();
include("../lib/conn.php");
?>
            <!-- form start -->
            <form role="form" action="actions/insert_sales.php" method="POST" enctype="multipart/form-data" id="sys_form_sales">
              <div class="card card-primary card-outline" id="invoice_info">
                <input type="hidden" name="sp" value="sp_supplier" id="sp_purchase">
                <div class="card-body">
                  <h3>Invoice Information</h3>
                  <hr>
                  <input type="hidden" value="exists" id="checkSales">
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
                    <div class="col-md-4" id="sales">
                      <div class="form-group">
                        <label>Select Sales Type</label>
                        <select class="form-control select2" style="width: 100%;" name="sales_type" id="sales_type" required>
                          <option selected="selected" value="">Select Sales Type</option>
                          <option value="customer">Customer Sales</option>
                          <option value="cash">Cash Sales</option>
                          <option value="prescription">Prescription Sales</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4 cash_input d-none">
                      <div class="form-group">
                        <label>Enter Customer Name</label>
                        <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Enter Customer Name">
                      </div>
                    </div>
                    <div class="col-md-4 customer_input d-none">
                      <div class="form-group">
                        <label>Select Customer</label>
                        <select class="form-control select2" style="width: 100%;" name="customer" id="customer">
                          <option value="">Select Customer</option>
                          <?php
                          include '../lib/conn.php';
                                  $sql="SELECT id,name FROM customer";
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
                    <div class="col-md-4 prescription_input d-none">
                      <div class="form-group">
                        <label>Enter Prescription No</label>
                        <input type="text" class="form-control number" name="prescription_number" id="prescription_number" placeholder="Enter Prescription Number">
                      </div>
                    </div>  
                    <input type="hidden" id="current_balance">
                    <input type="hidden" id="max_balance">                                                  
                  </div>
                  <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                      <button type="button" class="btn btn-flat btn-primary btn-block d-none" id="prescription_search_sales"><i class="fas fa-shopping-cart"></i> Proceed</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card card-primary card-outline" id="sales_info">
                <div class="card-body">
                  <h3 class="mt-4 d-inline">Payment Information</h3>
                  <hr>
                  <div class="row bg-primary mb-3 py-1">                          
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="sales_total">Total</label>
                        <input type="text" name="sales_total" id="sales_total" class="form-control" readonly required>
                      </div>
                    </div>                         
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="sales_discount">Discount</label>
                        <input type="text" name="sales_discount" id="sales_discount" class="form-control number" value="0">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="sales_grand_total">Grand Total</label>
                        <input type="text" name="sales_grand_total" id="sales_grand_total" class="form-control" readonly>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="sales_paid">Paid</label>
                        <input type="text" name="sales_paid" id="sales_paid" class="form-control number" value="0">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="sales_rest">Rest</label>
                        <input type="text" name="sales_rest" id="sales_rest" class="form-control" readonly>
                      </div>
                    </div>  
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">              
                  </div>
                  <div class="row">                    
                    <div class="col-md-12">                      
                      <h3 class="mt-4 d-inline">sales Information</h3>
                      <div class="float-right bg-primary">
                        <button type="button" class="btn btn-flat btn-primary text-center" id="sales_addRow"><span class="fas fa-plus mr-3" ></span> Add New Row</button>
                      </div>    
                      <div class="table-responsive">
                        <table class="table table-hover text-nowrap" style="table-layout: fixed;">
                          <thead>
                            <tr>
                              <th width="5%">No</th>
                              <th width="30%">Item Name</th>
                              <th width="16%">Purchase Unit</th>
                              <th width="15%" align="center">A.Quantity</th>
                              <th width="10%" align="center">Quantity</th>
                              <th width="10%" align="center">Price</th>
                              <th width="14%" align="center">Amount</th>
                              <!-- <th width="10%" align="center">Action</th> -->
                            </tr>
                          </thead>
                          <tbody>
                            <tr >
                              <td width="7%">1</td>
                              <td width="30%">
                                <select class="form-control select2 sales_product" style="width: 100%;"  id="sales_product1">
                                  <option selected="selected" value="">Select Product</option>
                                  <?php
                                  $sql="SELECT p.id,p.brand_name,c.name,ca.name 'category' FROM product_info p INNER JOIN country c ON c.id=p.country INNER JOIN drug_category ca ON ca.id=p.category WHERE p.qty >0";
                                  $res=$conn->query($sql);
                                  while ($row=$res->fetch_assoc()) {
                                  ?>
                                  <option value="<?php echo $row['id']?>"><?php echo $row["brand_name"]." ".$row["category"]." ".$row['name']?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                              </td>
                              <td width="16%">
                                <select class="select2 form-control sales_unit" style="width: 100%" id="sales_unit1">
                                  <option value="">Select Sales Unit</option>
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
                                <input type="text" class="form-control price number" readonly>
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
                              <td width="30%">
                                <select class="form-control select2 sales_product" style="width: 100%;"  id="sales_product2">
                                  <option selected="selected" value="">Select Product</option>
                                  <?php
                                    $sql="SELECT p.id,p.brand_name,c.name,ca.name 'category' FROM product_info p INNER JOIN country c ON c.id=p.country INNER JOIN drug_category ca ON ca.id=p.category WHERE p.qty >0";
                                    $res=$conn->query($sql);
                                    while ($row=$res->fetch_assoc()) {
                                  ?>
                                  <option value="<?php echo $row['id']?>"><?php echo $row["brand_name"]." ".$row["category"]." ".$row['name']?><option>
                                  <?php
                                    }
                                  ?>
                                </select>
                              </td>
                              <td width="16%">
                                <select class="select2 form-control sales_unit" style="width: 100%" id="sales_unit2">
                                  <option value="">Select Sales Unit</option>
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
                                <input type="text" class="form-control price number" readonly>
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
                              <td width="30%">
                                <select class="form-control select2 sales_product" style="width: 100%;"  id="sales_product3">
                                  <option selected="selected" value="">Select Product</option>
                                  <?php
                                    $sql="SELECT p.id,p.brand_name,c.name,ca.name 'category' FROM product_info p INNER JOIN country c ON c.id=p.country INNER JOIN drug_category ca ON ca.id=p.category WHERE p.qty >0";
                                    $res=$conn->query($sql);
                                    while ($row=$res->fetch_assoc()) {
                                  ?>
                                  <option value="<?php echo $row['id']?>"><?php echo $row["brand_name"]." ".$row["category"]." ".$row['name']?></option>
                                  <?php
                                    }
                                  ?>
                                </select>
                              </td>
                              <td width="16%">
                                <select class="select2 form-control sales_unit" style="width: 100%" id="sales_unit3">
                                  <option value="">Select Sales Unit</option>
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
                                <input type="text" class="form-control price number" readonly>
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
                              <td width="30%">
                                <select class="form-control select2 sales_product" style="width: 100%;"  id="sales_product4">
                                  <option selected="selected" value="">Select Product</option>
                                  <?php
                                    $sql="SELECT p.id,p.brand_name,c.name,ca.name 'category' FROM product_info p INNER JOIN country c ON c.id=p.country INNER JOIN drug_category ca ON ca.id=p.category WHERE p.qty >0";
                                    $res=$conn->query($sql);
                                    while ($row=$res->fetch_assoc()) {
                                  ?>
                                  <option value="<?php echo $row['id']?>"><?php echo $row["brand_name"]." ".$row["category"]." ".$row['name']?><option>
                                  <?php
                                    }
                                  ?>
                                </select>
                              </td>
                              <td width="16%">
                                <select class="select2 form-control sales_unit" style="width: 100%" id="sales_unit4">
                                  <option value="">Select Sales Unit</option>
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
                                <input type="text" class="form-control price number" readonly>
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
                              <td width="30%">
                                <select class="form-control select2 sales_product" style="width: 100%;"  id="sales_product5">
                                  <option selected="selected" value="">Select Product</option>
                                  <?php
                                    $sql="SELECT p.id,p.brand_name,c.name,ca.name 'category' FROM product_info p INNER JOIN country c ON c.id=p.country INNER JOIN drug_category ca ON ca.id=p.category WHERE p.qty >0";
                                    $res=$conn->query($sql);
                                    while ($row=$res->fetch_assoc()) {
                                  ?>
                                  <option value="<?php echo $row['id']?>"><?php echo $row["brand_name"]." ".$row["category"]." ".$row['name']?></option>
                                  <?php
                                    }
                                  ?>
                                </select>
                              </td>
                              <td width="16%">
                                <select class="select2 form-control sales_unit" style="width: 100%" id="sales_unit5">
                                  <option value="">Select Sales Unit</option>
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
                                <input type="text" class="form-control price number" readonly>
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
                  <div class="row">
                    <div class="col-6"></div>
                    <div class="col-3">
                      <button type="reset" class="btn btn-danger btn-block float-right sys-cancel" >Cancel</button>
                    </div>
                    <div class="col-3">
                      <button type="submit" class="btn btn-block float-right btn-success">Submit</button>
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
                          <h4 class="modal-title">Product Registration</h4>
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