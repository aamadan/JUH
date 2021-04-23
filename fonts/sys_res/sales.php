              <?php
                session_start();
                include"../lib/conn.php";
              ?>

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
                                  $sql="SELECT p.id,p.brand_name,c.name FROM product_info p INNER JOIN country c ON c.id=p.country WHERE p.qty >0";
                                  $res=$conn->query($sql);
                                  while ($row=$res->fetch_assoc()) {
                                  ?>
                                  <option value="<?php echo $row['id']?>"><?php echo $row["brand_name"]." ".$row['name']?></option>
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
                                    $sql="SELECT p.id,p.brand_name,c.name FROM product_info p INNER JOIN country c ON c.id=p.country WHERE p.qty >0";
                                    $res=$conn->query($sql);
                                    while ($row=$res->fetch_assoc()) {
                                  ?>
                                  <option value="<?php echo $row['id']?>"><?php echo $row["brand_name"]." ".$row['name']?><option>
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
                                    $sql="SELECT p.id,p.brand_name,c.name FROM product_info p INNER JOIN country c ON c.id=p.country WHERE p.qty >0";
                                    $res=$conn->query($sql);
                                    while ($row=$res->fetch_assoc()) {
                                  ?>
                                  <option value="<?php echo $row['id']?>"><?php echo $row["brand_name"]." ".$row['name']?></option>
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
                                    $sql="SELECT p.id,p.brand_name,c.name FROM product_info p INNER JOIN country c ON c.id=p.country WHERE p.qty >0";
                                    $res=$conn->query($sql);
                                    while ($row=$res->fetch_assoc()) {
                                  ?>
                                  <option value="<?php echo $row['id']?>"><?php echo $row["brand_name"]." ".$row['name']?><option>
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
                                    $sql="SELECT p.id,p.brand_name,c.name FROM product_info p INNER JOIN country c ON c.id=p.country WHERE p.qty >0";
                                    $res=$conn->query($sql);
                                    while ($row=$res->fetch_assoc()) {
                                  ?>
                                  <option value="<?php echo $row['id']?>"><?php echo $row["brand_name"]." ".$row['name']?></option>
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


              <script type="text/javascript">
              $(document).ready(function () {
                    $('.select2').select2();
                      //Initialize Select2 Elements
                   $('.select2bs4').select2({
                      theme: 'bootstrap4'
                    });
              });
            </script>