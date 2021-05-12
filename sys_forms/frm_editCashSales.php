<?php session_start();
include("../lib/conn.php");
?>
            <script>
              var unit=new Array();
            </script>
            <!-- form start -->
            <form role="form" action="actions/test2.php" method="POST" enctype="multipart/form-data" id="sys_form_cashSales">

              <div class="card card-primary card-outline">
                <input type="hidden" name="sp" value="sp_supplier" id="sp_purchase">
                <div class="card-body">
                  <h3>Invoice Information</h3>
                  <hr>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="invoice_no">Invoice Number</label>
                        <input type="text" name="invoice_no" id="invoice_no" class="form-control" placeholder="Enter Invoice Number" required readonly value="<?php echo $_GET['invoice']?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Enter Customer Name</label>
                        <?php
                        include '../lib/conn.php';
                        $sql="SELECT DISTINCT(customer_name) FROM cash_sales WHERE invoice_no='$_GET[invoice]'";
                        $res=$conn->query($sql);
                        $row=$res->fetch_assoc();
                        ?>
                        <input type="text" name="customer_name" id="customer_name" class="form-control" value="<?php echo $row['customer_name']?>">
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
                             <?php
                              $invoice_data="CALL rp_cash_sales_invoice_items('$_GET[invoice]')";
                              $invoice_result=$conn->query($invoice_data);
                              $i=1;
                              while ($invoice_row=$invoice_result->fetch_assoc()) {
                              ?>
                                <tr>
                                  <td width="7%">1</td>
                                  <td width="30%">
                                    <input type="hidden" class="id" value="<?php echo $invoice_row['sales_id']?>">
                                    <select class="form-control select2 sales_product" style="width: 100%;"  id="sales_product<?php echo $i;?>">
                                      <option selected="selected" value="">Select Product</option>
                                      <?php select_products($i,$invoice_row["id"],$invoice_row["sales_unit"],$invoice_row["qty"],$invoice_row["price"])?>
                                    </select>
                                  </td>
                                  <td width="16%">
                                    <select class="select2 form-control sales_unit" style="width: 100%" id="sales_unit<?php echo $i;?>">
                                      <option value="">Select Sales Unit</option>
                                    </select>
                                  </td>
                                  <td width="15%">
                                    <input type="text" class="form-control a_qty" readonly>
                                  </td>
                                  <td width="10%">
                                    <input type="text" class="form-control qty sales_qty number" value="<?php echo $invoice_row["qty"]?>">
                                    <input type="hidden" class="form-control ap_qty number">
                                  </td>
                                  <td width="10%">
                                    <input type="text" class="form-control price number" readonly value="<?php echo $invoice_row["price"]?>">
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
            </form>
            <!-- Message Modal-->
            <?php
            function select_products($id,$value_product,$value_unit,$qty,$price){
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
              $(".sales_product").trigger("change");
              unit.push("<?php echo $value_unit?>");
              var i=0;
              var id=1;
              $(".sales_product").each(function(){                
                $("#sales_unit"+id).val(unit[i]);
                $("#sales_unit"+id).trigger("change");
                $(this).parent().parent().find(".price").val("<?php echo $price?>");
                $(this).parent().parent().find(".qty").val('<?php echo $qty?>');
                $(this).parent().parent().find(".qty").trigger('blur');
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