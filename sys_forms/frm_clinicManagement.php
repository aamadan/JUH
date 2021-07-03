<?php session_start();?>
        <div class="card card-primary card-outline">
          <div class="card-body">
            <div class="row">
              <div class="col-md-11">
                <h4>Patient Information</h4>
              </div>
              <div class="col-md-1">
                <a href="sys_forms/frm_patientVisits.php" class="nav-link close_patient_visit fa fa-arrow-left float-right"></a>
              </div>
            </div>        
            <hr>
            <?php
            include("../lib/conn.php");
              $sql="CALL rp_patient_single__info('$_GET[id]')";
              $result=$conn->query($sql);
              $row=$result->fetch_assoc();
            ?>
            <div class="row">
              <div class="col-md-3 col-sm-6 text-truncate">
                <p><span class="font-weight-bold">Name</span>: <?php echo $row["name"]?></p>
              </div>
              <div class="col-md-1 col-sm-6">
                <p><span class="font-weight-bold">Age</span>: <?php echo $row["age"]?></p>
              </div>
              <div class="col-md-2 col-sm-6">
                <p><span class="font-weight-bold">Gender</span>: <?php echo $row["gender"]?></p>
              </div>
              <div class="col-md-2 col-sm-6">
                <p><span class="font-weight-bold">Marital Status</span>: <?php echo $row["marital"]?></p>
              </div>
              <div class="col-md-2 col-sm-6">
                <p><span class="font-weight-bold">Visit Date</span>: <?php echo $_GET["ticket_date"];?></p>
              </div>
              <div class="col-md-2 col-sm-6">
                <p><span class="font-weight-bold">Ticket NO</span>: <?php echo $_GET["ticket"];?></p>
                <input type="hidden" id="ticket_no" value="<?php echo $_GET["ticket"];?>">
              </div>
            </div>

            <input type="hidden" value="<?php echo $_GET['id']?>" id="p_id">
			<input type="hidden" name="ticket_no" id="ticket_no" value="<?php echo $_GET["ticket"];?>">
            <input type="hidden" value="<?php echo $_GET['ticket_date']?>" id="visit_date">
            <input type="hidden" id="doctor_id" value="<?php echo $_SESSION['id'];?>">
            <input type="hidden" id="user_id" value="<?php echo $_SESSION["user_id"];?>">
            <hr>
			
					<div class="row">
          <div class="col-12">
            <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Add Medical Records</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">View Medical Records</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                     <!-- Add Medical Records -->
					 <div class="row">              
              <div class="col-4 col-sm-3">
                <div class="nav flex-column nav-tabs nav-pills h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link active" id="history_taken_tab" href="#history_taken" data-toggle="pill" aria-selected="true"><i class="fas fa-user-edit"></i> History Taken</a>

                  <a class="nav-link" id="physical_examination_tab" href="#physical_examination" data-toggle="pill" aria-selected="false"><i class="fas fa-stethoscope"></i> Physical Examination</a>

                  <a class="nav-link" id="current_medication_tab" href="#current_medication" data-toggle="pill" aria-selected="false"><i class="fas fa-pills"></i> Current Medication</a>

                  <a class="nav-link" id="lab_request_tab" href="#lab_request" data-toggle="pill" aria-selected="false"><i class="fas fa-microscope"></i> Lab Request</a>
				  
				   <a class="nav-link" id="image_request_tab" href="#imag_request" data-toggle="pill" aria-selected="false"><i class="fas fa-x-ray"></i> Imaging Request</a>
					
				   <a class="nav-link" id="service_request_tab" href="#service_request" data-toggle="pill" aria-selected="false"><i class="fas fa-cogs"></i> Services Request</a>	

                  <a class="nav-link" id="diagnosis_tab"  href="#diagnosis" data-toggle="pill" aria-selected="false"><i class="fas fa-diagnoses"></i> Diagnosis</a>

                  <a class="nav-link" id="prescription_tab" href="#prescription" data-toggle="pill" aria-selected="false"><i class="fas fa-prescription"></i> Prescription</a>

                  <a class="nav-link" id="advice_tab" href="#advice" data-toggle="pill" aria-selected="false"><i class="fas fa-user-md"></i> Advice</a>
				  
				  <a class="nav-link" id="medical_certificate_tab" href="#medical_certificate" data-toggle="pill" aria-selected="false"><i class="fas fa-award"></i> Medical Certificate</a>
                </div>
              </div>
              <div class="col-8 col-sm-9">
                <div class="tab-content" id="vert-tabs-tabContent">
                  <div class="tab-pane text-left fade show active" id="history_taken" role="tabpanel" aria-labelledby="history_taken_tab">
                    <form role="form" action="actions/clinicManagement.php" method="POST" class="sys_form_clinic">
                      <input type="hidden" name="sp" value="sp_insert_history_taken">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="cheif_complaint">Cheif Complaint</label>
                            <textarea rows="4" class="form-control" name="cheif_complaint" id="cheif_complaint"></textarea>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="history_of_present_illness">History of Present Illness</label>
                            <textarea rows="4" class="form-control" name="history_of_present_illness" id="history_of_present_illness"></textarea>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="past_history">Past Medical/Surgical History</label>
                            <textarea rows="4" class="form-control" name="past_history" id="past_history"></textarea>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="drug_history">Drug History & Currenct Medication</label>
                            <textarea rows="4" class="form-control" name="drug_history" id="drug_history"></textarea>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="allergies">Allergies</label>
                            <textarea rows="4" class="form-control" name="allergies" id="allergies"></textarea>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="family_history">Family History</label>
                            <textarea rows="4" class="form-control" name="family_history" id="family_history"></textarea>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="social_history">Socail History</label>
                            <textarea rows="4" class="form-control" name="social_history" id="social_history"></textarea>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="obs_gyne">Obs & Gyne History</label>
                            <textarea rows="4" class="form-control" name="obs_gyne" id="obs_gyne"></textarea>
                          </div>
                        </div>
                      </div>
                      <hr>
                      <div class="row">                        
                        <div class="col-md-9"></div>
                        <div class="col-md-3">
                          <button type="submit" class="btn btn-success float-right btn-block btn-flat next">Save & Next</button>
                        </div>                        
                      </div> 
                    </form>                    
                  </div>
                  <div class="tab-pane fade" id="physical_examination" role="tabpanel" aria-labelledby="physical_examination_tab">
                    <form action="actions/clinicManagement.php" class="sys_form_clinic">
                      <input type="hidden" name="sp" value="sp_insert_physical_examination">
                      <div class="row">
                       <div class="col-md-12">
                         <label for="appearence">Appearence</label>
                         <input type="text" name="appearence" id="appearence" class="form-control">
                       </div>
                      </div>
                      <div class="row">
                       <div class="col-md-12 mt-2">
                         <h4>Vital Signs</h4>
                       </div>
                      </div>
                      <hr> 
                      <div class="row">
                        <div class="col-md-3">
                          <label for="temperature">Temperature(oC)</label>
                          <input type="text" name="temperature" id="temperature" class="form-control number" required>
                        </div>
                        <div class="col-md-3">
                          <label for="pr">Pulse Rate</label>
                          <input type="text" name="pr" id="pr" class="form-control number" required>
                        </div>
                        <div class="col-md-3">
                          <label for="rr">Respirotary Rate</label>
                          <input type="text" name="rr" id="rr" class="form-control number" required>
                        </div>
                        <div class="col-md-3">
                          <label for="bp">Blood Pressure</label>
                          <input type="text" name="bp" id="bp" class="form-control" required>
                        </div>
                      </div> 
                      <hr>
                      <div class="row">
                        <div class="col-md-3">
                          <label for="weight">Weight (KG)</label>
                          <input type="text" name="weight" id="weight" class="form-control number">
                        </div>
                        <div class="col-md-3">
                          <label for="height">Height(CM)</label>
                          <input type="text" name="height" id="height" class="form-control number">
                        </div>
                        <div class="col-md-3">
                          <label for="bmi">BMI</label>
                          <input type="text" name="bmi" id="bmi" class="form-control" readonly>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-md-9"></div>
                        <div class="col-md-3">
                          <button type="submit" class="btn btn-success float-right btn-block btn-flat next">Save & Next</button>
                        </div>                        
                      </div>
                    </form>                    
                  </div>
                  <div class="tab-pane fade" id="current_medication" role="tabpanel" aria-labelledby="current_medication_tab">
                    <form action="actions/insert.php" class="sys_form_clinic">
                      <div class="row">
					  <div class="table-responsive">
                      <table class="table table-hover table-bordered">
                        <thead>
                          <tr>
                            <th>S.NO</th>
                            <th>Drug Name</th>
                            <th>Quantity</th>                             
                            <th>Frequency</th>
                            <th>Route</th>
							<th>Prescriped Date</th>
							<th>End Date</th>
                            <th style="color:white;background-color:red">Stop</th>                          
                          </tr>
                        </thead>
                        <tbody id="medication" class="medication">
                         <?php
							include '../lib/conn.php';
							$sql="CALL rp_prescription($_GET[id])";
							$result=$conn->query($sql);
							$i=1;
							while ($row=$result->fetch_assoc()) {
							?>
							   <tr>
								<td style="color: black;"><?php  echo $i?></td>
								<td style="color: black;"><?php echo $row["brand_name"]?></td>
								<td style="color: black;"><?php echo $row["quantity"]?></td>
								<td style="color: black;" align="center"><?php echo $row["frequency"]?></td>
								<td style="color: black;" align="center"><?php echo $row["instruction"]?></td>
								<td style="color: black;" align="center"><?php echo $row["prescription_date"]?></td>
								<td style="color: black;" align="center"><?php echo $row["end_date"]?></td>
								<td style="color: red;" align="center"><?php echo $row["stop"]?></td>
							  </tr>
						<?php
						$i++;
						}
						?>    
                        </tbody>
                      </table>
                    </div>
                        <div class="col-md-9"></div>
                        <div class="col-md-3">
                          <button type="submit" class="btn btn-success float-right btn-block btn-flat next">Save & Next</button>
                        </div>                        
                      </div>
                    </form>
                    
                  </div>
                  <div class="tab-pane fade" id="lab_request" role="tabpanel" aria-labelledby="lab_request_tab">
                    <form action="actions/insert_lab_request.php" class="sys_form_clinic_lab">
                      <div class="row">
                        <div class="col-md-8">
                          <div class="form-group">
                            <label>Select Test</label>
                            <select class="form-control select2" style="width: 100%;" name="lab_name" id="lab_name">
                              <option selected="selected" value="">Select Test</option>
                                <?php
                                include "../lib/conn.php";
                                $sql="SELECT t.id,t.name,l.name as lab FROM test t join lab l on t.lab=l.id";
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
                        <div class="col-md-4">
                          <label style="visibility: hidden;">Add</label>
                          <button type="button" class="btn btn-block btn-flat btn-primary" id="add_lab_request">Add Test Request</button>
                        </div>
                      </div>     
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th>S.NO</th>
                              <th>Lab Name</th>
                              <th>Status</th> 
                              <th>Visit Date</th>
                              <th></th>                          
                            </tr>
                          </thead>
                          <tbody id="lab">
                              
                          </tbody>
                        </table>			
                      </div>
                      <hr>
                      <div class="row">
                          <div class="col-md-9"></div>
                          <div class="col-md-3">
                            <button type="submit" class="btn btn-success float-right btn-block btn-flat ">Save & Next</button>
                          </div>                        
                      </div>  
                    </form>           
                  </div>
                  <div class="tab-pane fade" id="imag_request" role="tabpanel" aria-labelledby="image_request_tab">
                    <form action="actions/insert_image_request.php" class="sys_form_clinic_image">
                      <div class="row">
                        <div class="col-md-8">
                          <div class="form-group">
                            <label>Select Image Type</label>
                            <select class="form-control select2" style="width: 100%;" name="image_name" id="image_name">
                              <option selected="selected" value="">Select Image Type</option>
                                <?php
                                include "../lib/conn.php";
                                $sql="SELECT c.id,c.name,i.name as image FROM clinicaldata c JOIN image i on c.image=i.id";
                                $res=$conn->query($sql);
                                while ($row=$res->fetch_assoc()) {
                                ?>
                                  <option value="<?php echo $row['id']?>"><?php echo $row['image'] ?> - <?php echo $row['name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <label style="visibility: hidden;">Add</label>
                          <button type="button" class="btn btn-block btn-flat btn-primary" id="add_image_request">Add Image Request</button>
                        </div>
                      </div>     
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th>S.NO</th>
                              <th>Image Name</th>
                              <th>Status</th> 
                              <th>Visit Date</th>
                              <th></th>                          
                            </tr>
                          </thead>
                          <tbody id="image">
                              
                          </tbody>
                        </table>
                      </div>
                      <hr>
                      <div class="row">
                          <div class="col-md-9"></div>
                          <div class="col-md-3">
                            <button type="submit" class="btn btn-success float-right btn-block btn-flat next">Save & Next</button>
                          </div>                        
                      </div>  
                    </form>           
                  </div>
				   <div class="tab-pane fade" id="service_request" role="tabpanel" aria-labelledby="service_request_tab">
                    <form action="actions/insert_service_request.php" class="sys_form_clinic_service">
                      <div class="row">
                        <div class="col-md-8">
                          <div class="form-group">
                            <label>Select Service Type</label>
                            <select class="form-control select2" style="width: 100%;" name="service_name" id="service_name">
                              <option selected="selected" value="">Select Service Type</option>
                                <?php
                                include "../lib/conn.php";
                                $sql="SELECT `id`, `name` FROM `service_type`";
                                $res=$conn->query($sql);
                                while ($row=$res->fetch_assoc()) {
                                ?>
                                  <option value="<?php echo $row['id']?>"><?php echo $row['name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <label style="visibility: hidden;">Add</label>
                          <button type="button" class="btn btn-block btn-flat btn-primary" id="add_service_request">Add Service Request</button>
                        </div>
                      </div>     
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th>S.NO</th>
                              <th>Service Name</th>
                              <th>Status</th> 
                              <th>Visit Date</th>
                              <th></th>                          
                            </tr>
                          </thead>
                          <tbody id="service">
                              
                          </tbody>
                        </table>
                      </div>
                      <hr>
                      <div class="row">
                          <div class="col-md-9"></div>
                          <div class="col-md-3">
                            <button type="submit" class="btn btn-success float-right btn-block btn-flat next">Save & Next</button>
                          </div>                        
                      </div>  
                    </form>           
                  </div>
                  <div class="tab-pane fade" id="diagnosis" role="tabpanel" aria-labelledby="diagnosis_tab">
				  <form action="actions/insert_patient_diagnosis.php" class="sys_form_clinic_diagnosis">
                     <div class="row">                      
                       <div class="col-md-4">
                         <div class="form-group">
                           <label for="diagnosis">Select Diagnosis</label>
                           <select class="form-control select2" id="diagnosis_name" name="diagnosis_name">
                             <option value="" selected="selected">Select Diagnosis</option>
                             <?php
                              include "../lib/conn.php";
                              $sql="SELECT id,name FROM diagnosis";
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
					   <div class="col-md-4">
                         <div class="form-group">
                           <label for="diagnosis_type">Diagnosis Type</label>
                           <select class="form-control select2" id="diagnosis_type" name="diagnosis_type">
                             <option value="principal" selected>Principle</option>
                             <option value="provissional">Provissional</option>
                           </select>
                         </div>
                       </div>
					   <div class="col-md-4">
                          <label style="visibility: hidden;">Add</label>
                          <button type="button" class="btn btn-block btn-flat btn-primary" id="add_diagnosis">Add Diagnosis </button>
                        </div>
                     </div>
					 
					 <div class="table-responsive">
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th>S.NO</th>
                              <th>Diagnosis Name</th>
                              <th>Diagnosis Type</th>
                              <th></th>                          
                            </tr>
                          </thead>
                          <tbody id="diagnosis_row">
                              
                          </tbody>
                        </table>
                      </div>
                     <hr>
                     <div class="row">
                        <div class="col-md-9"></div>
                        <div class="col-md-3">
                          <button type="submit" class="btn btn-success float-right btn-block btn-flat next">Save & Next</button>
                        </div>                        
                     </div>
					 </form>
                  </div>
                  <div class="tab-pane fade" id="prescription" role="tabpanel" aria-labelledby="prescription_tab">
				  <form action="actions/insert_prescription.php" class="sys_form_clinic_prescription">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="drug_id">Select Drug</label>
                          <select class="form-control select2" id="drug_name" name="drug_name" style="width: 100%;">
                            <option value="" selected="selected">Select Drug</option>
                            <?php
                              include "../lib/conn.php";
                              $sql="SELECT p.id,brand_name 'drug_name',d.name 'category' FROM product_info p INNER JOIN drug_category d ON p.category = d.id";
                              $res=$conn->query($sql);
                              while ($row=$res->fetch_assoc()) {
                              ?>
                                <option value="<?php echo $row['id']?>"><?php echo $row['drug_name']." ".$row['category']?></option>
                              <?php
                              }
                              ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="qty">Quantity</label>
                          <input type="text" name="qty" id="qty" class="form-control number" placeholder="Enter Quantity">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="frequency">Frequency</label>
                          <input type="text" name="frequency" id="frequency" class="form-control frequency" placeholder="Enter Frequency">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="duration">Duration</label>
                          <input type="text" name="duration" id="duration" class="form-control number" placeholder="Enter Duration">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="route">Route/Instruction</label>
                          <input type="text" name="route" id="route" class="form-control" placeholder="Enter Route">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-8"></div>
                      <div class="col-md-4">
                        <button type="button" class="btn btn-primary btn-flat btn-block" id="add_prescripted_list">Add Drug</button>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>S.NO</th>
                            <th>Drug Name</th>
                            <th>Quantity</th>                             
                            <th>Frequency</th>
                            <th>Duration</th>
                            <th>Route</th>
                            <th></th>                          
                          </tr>
                        </thead>
                        <tbody id="prescription" class="prescription">
                            
                        </tbody>
                      </table>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-9"></div>
                      <div class="col-md-3">
                        <button type="submit" class="btn btn-success float-right btn-block btn-flat next">Save & Next</button>
                      </div>                        
                    </div>
					</form>
                  </div>
                  <div class="tab-pane fade" id="advice" role="tabpanel" aria-labelledby="advice_tab">
				  <div class="row">
				  <div class="col-md-12">
                          <div class="form-group">
                            <label for="drug_history">Doctor Advice</label>
                            <textarea rows="3" class="form-control" name="advice" id="drug_history" placeholder="Enter Advice"></textarea>
                          </div>
					</div>
				  </div>
				  <div class="row">
					<div class="col-md-4">
						<div class="form-group">
                        <label for="purchase_date">Follow-up Date</label>
                        <input type="date" name="purchase_date" id="purchase_date" class="form-control" placeholder="Enter Purchase Date" required>
                      </div>	
					</div>
					<div class="col-md-4">
						<div class="form-group clearfix">
						  <div class="icheck-primary d-inline">
							<input type="checkbox" id="Emergency">
							<label for="Emergency">
                          Refer to Emergency
                        </label>
						  </div>
						</div>
						<div class="form-group clearfix">
						  <div class="icheck-primary d-inline">
							<input type="checkbox" id="Admission">
							<label for="Admission">
                          Refer to Admission
                        </label>
						  </div>
						</div>
						<div class="form-group clearfix">
						  <div class="icheck-primary d-inline">
							<input type="checkbox" id="Antenatal">
							<label for="Antenatal">
                          Refer to Antenatal care
                        </label>
						  </div>
						</div>	
					</div>
					<div class="col-md-4">
						<div class="form-group clearfix">
						  <div class="icheck-primary d-inline">
							<input type="checkbox" id="Surgery">
							<label for="Surgery">
                          Surgery Request
                        </label>
						  </div>
						</div>	
						<div class="form-group clearfix">
						  <div class="icheck-primary d-inline">
							<input type="checkbox" id="Complete">
							<label for="Complete">
                          Visit Complete
                        </label>
						  </div>
						</div>
						<div class="form-group clearfix">
						  <div class="icheck-primary d-inline">
							<input type="checkbox" id="Outside">
							<label for="Outside">
                          Refer to Outside Hospital
                        </label>
						  </div>
						</div>
					</div>	
                   </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-3">
                        <input type="hidden" value="Previous" class="btn btn-primary float-right btn-block btn-flat prev">
                      </div>
                      <div class="col-md-6"></div>
                      <div class="col-md-3">
                        <button type="submit" class="btn btn-success float-right btn-block btn-flat complete">Save & Next</button>
                      </div>                        
                    </div>
                  </div>
				  <div class="tab-pane fade" id="medical_certificate" role="tabpanel" aria-labelledby="medical_certificate_tab">
				  
				 
                    <hr>
                    <div class="row">
                      <div class="col-md-3">
                        <input type="hidden" value="Previous" class="btn btn-primary float-right btn-block btn-flat prev">
                      </div>
                      <div class="col-md-6"></div>
                      <div class="col-md-3">
                        <button type="submit" class="btn btn-success float-right btn-block btn-flat complete">Save</button>
                      </div>                        
                    </div>
                  </div>
                </div>
              </div>
            </div>
					 <!-- -->
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                     <!-- View Medical Records -->
					 <!-- -->
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
		</div>
			
            
          </div>
          <!-- /.card -->
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