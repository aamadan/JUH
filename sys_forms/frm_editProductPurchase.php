<?php session_start();
include("../lib/conn.php");
?>
            <script>
              var unit=new Array();
            </script>
            <!-- form start -->
            <form role="form" action="actions/insert_purchase.php" method="POST" enctype="multipart/form-data" id="sys_form_purchase">
              <div class="card card-primary card-outline">
                <input type="hidden" name="sp" value="sp_supplier" id="sp_purchase">
                <div class="card-body">
                  <h3>Billing Information</h3>
                  <hr>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Select Supplier</label>
                        <select class="form-control select2" style="width: 100%;" name="purchase_supplier" id="purchase_supplier" required>
                            <option selected="selected" value="">Select Supplier</option>
                            <?php
                              $sql="SELECT id,name FROM supplier";
                              $res=$conn->query($sql);
                              while ($row=$res->fetch_assoc()) {
                            ?>
                              <option <?php echo $row["id"] == $_GET["supplier"]?"selected":" ";?> value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                            <?php
                              }
                            ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="invoice_no">Invoice Number</label>
                        <input type="text" name="invoice_no" id="invoice_no" class="form-control" placeholder="Enter Invoice Number" required value="<?php echo $_GET['invoice']?>">
                      </div>
                    </div> 
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="purchase_date">Purchase Date</label>
                        <input type="date" name="purchase_date" id="purchase_date" class="form-control" placeholder="Enter Purchase Date" required value="<?php echo $_GET['date']?>">
                      </div>
                    </div>                                    
                  </div>
                </div>
              </div>
                  
                  <div class="row">                    
                    <div class="col-md-10">
                      <div class="card card-primary card-outline">
                        <div class="card-body">
                          <h3 class="mt-4 d-inline">Purchase Information</h3>
                          <div class="float-right bg-primary">
                            <button type="button" class="btn btn-flat btn-primary text-center" id="purchase_addNew"><span class="fas fa-shopping-cart mr-3" ></span> Register New Product</button>
                            <button type="button" class="btn btn-flat btn-primary text-center" id="purchase_addRow"><span class="fas fa-plus mr-3" ></span> Add New Row</button>
                          </div>
                          
                          <div class="table-responsive">
                            <table class="table table-hover" style="table-layout: fixed;">
                              <thead>
                                <tr>
                                  <th width="7%">S.No</th>
                                  <th width="35%">Item Name</th>
                                  <th width="20%">Purchase Unit</th>
                                  <th width="12%" align="center">Quantity</th>
                                  <th width="12%" align="center">Price</th>
                                  <th width="14%" align="center">Amount</th>
                                  <!-- <th width="10%" align="center">Action</th> -->
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                              $invoice_data="CALL rp_purchase_invoice_items('$_GET[invoice]','$_GET[supplier]')";
                              $invoice_result=$conn->query($invoice_data);
                              $i=1;
                              while ($invoice_row=$invoice_result->fetch_assoc()) {
                              ?>
                                <tr>
                                  <td width="7%"><?php echo $i;?></td>
                                  <td width="35%">
                                    <input type="hidden" class="id" value="<?php echo $invoice_row['purchase_id']?>">
                                    <select class="form-control select2 purchase_product" style="width: 100%;"  id="purchase_product<?php echo $i;?>">
                                      <option selected="selected" value="">Select Product</option>
                                      <?php select_products($i,$invoice_row["id"],$invoice_row["purchase_unit"])?>
                                    </select>
                                  </td>
                                  <td width="20%">
                                    <select class="select2 form-control purchase_unit" style="width: 100%" id="purchase_unit<?php echo $i;?>">
                                      <option value="">Select Purchase Unit</option>
                                    </select>
                                  </td>
                                  <td width="12%">
                                    <input type="text" class="form-control qty number" value="<?php echo $invoice_row["qty"]?>">
                                  </td>
                                  <td width="12%">
                                    <input type="text" class="form-control price number" value="<?php echo $invoice_row["price"]?>">
                                  </td>
                                  <td width="14%">
                                    <input type="text" class="form-control amount" readonly value="<?php echo $invoice_row["amount"]?>">
                                  </td>
                                  <!-- <td align="center">
                                    <button class="btn"><span class="fas fa-trash"></span></button>
                                  </td> -->
                                </tr>
                              <?php  
                              $i++;
                              }
                              ?>                                                        
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>                      
                    </div>
                    <div class="col-md-2">
                      <div class="card card-primary card-outline">
                        <div class="card-body">                          
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="total">Total</label>
                                <input type="text" name="total" id="total" class="form-control" readonly required>
                              </div>
                            </div>                         
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="discount">Discount</label>
                                <input type="text" name="discount" id="discount" class="form-control number" value="0">
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="grand_total">Grand Total</label>
                                <input type="text" name="grand_total" id="grand_total" class="form-control" readonly>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="paid">Paid</label>
                                <input type="text" name="paid" id="paid" class="form-control number" value="0">
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="rest">Rest</label>
                                <input type="text" name="rest" id="rest" class="form-control" readonly>
                              </div>
                            </div>  
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">                          
                          </div>
                        </div>
                      </div>                                            
                    </div>
                  </div>             
                <!-- /.card-body -->
                  <div class="row">
                    <div class="col-6">
                    </div>
                    <div class="col-3">
                      <button type="reset" class="btn btn-danger btn-block float-right sys-cancel" >Cancel</button>
                    </div>
                    <div class="col-3">
                      <button type="submit" class="btn btn-block float-right btn-success">Submit</button>
                    </div>
                  </div>              
            </form>
            <!-- Message Modal-->
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
            <?php
            function select_products($id,$value_product,$value_unit){
              include '../lib/conn.php';
              $sql="SELECT p.id,p.brand_name,c.name FROM product_info p INNER JOIN country c ON c.id=p.country";
              $res=$conn->query($sql);
              while ($row=$res->fetch_assoc()) {
            ?>
                <option <?php echo $row["id"]==$value_product? "selected":'';?> value="<?php echo $row['id']?>"><?php echo $row["brand_name"]." ".$row['name']?></option>
            <?php
              }
            ?>
            <script>
              $(".purchase_product").trigger("change");
              unit.push("<?php echo $value_unit?>");
              var i=0;
              var id=1;
              $(".purchase_product").each(function(){                
                $("#purchase_unit"+id).val(unit[i]);
                i++;
                id++;
              });
            </script>
            <?php
            }

            ?>
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