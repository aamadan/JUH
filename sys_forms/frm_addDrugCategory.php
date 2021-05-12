<?php session_start();?>
            <div class="card card-primary card-outline">
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="actions/insert.php" method="POST" enctype="multipart/form-data" id="sys_form_res">
                <input type="hidden" name="sp" value="sp_drug_category">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="category_name">Drug Category Name</label>
                        <input type="text" name="category_name" class="form-control" id="category_name" placeholder="Enter Drug Category name" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                    <!-- radio -->
                      <label>Has Stripes</label>
                      <div class="form-group clearfix">
                        <div class="icheck-primary d-inline">
                          <input type="radio" id="has_stripes_yes" name="has_stripes" value="1" required>
                          <label for="has_stripes_yes">Yes
                          </label>
                        </div>
                        <div class="icheck-primary d-inline ml-3">
                          <input type="radio" id="has_stripes_no" name="has_stripes" value="0" required>
                          <label for="has_stripes_no">No
                          </label>
                        </div>
                      </div>                  
                    </div>
                  <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
                  <input type="hidden" name="id" id="id" value="0">
                </div>              
                <!-- /.card-body -->
                <div class="card-footer">
                  <div class="row">
                    <div class="col-6">
                    </div>
                    <div class="col-3">
                      <button type="reset" class="btn btn-danger btn-block float-right sys-cancel" style="background-color: #990000;">Cancel</button>
                    </div>
                    <div class="col-3">
                      <button type="submit" class="btn btn-block float-right btn-success">Submit</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>

            <!-- Message Modal-->
            <div class="container-fluid">
              <div class="row">
                <div class="col-12" id="sys-message"></div>
                <div class="modal fade" id="sys-modal">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" style="color: white;background-color:#00128C;">
                        <h4 class="modal-title">Message</h4>
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
            <!-- /.card -->