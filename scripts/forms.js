$(document).ready(function () {
	$(".sys-forms").click(function(e){
		e.preventDefault();
		$("a").removeClass("active");
		$(this).parent().parent().parent().find(".anchor-active").addClass("active");
		$("#content-header").text($(this).text());
		$(this).addClass("active");
		$("#dashboard-location-parent").text($(this).parent().parent().parent().find(".anchor-active").text());
		$("#dashboard-location-child").text($(this).text());
		$("#content-body").empty();
		var url = $(this).attr("href");
		$.get(url,function(data){
			$("#content-body").html(data);
		});
	});
	$("body").on("submit","#sys_form_search",function(e){
		e.preventDefault();
		var url=$(this).attr("action");
		var data=new FormData(this);		
		$.ajax({
			url:url,
			data:data,
			method:"POST",
			processData:false,
			contentType:false,
			success:function(data){
				$("#report_section").html(data);
			}
		});
	});
	$("body").on("click",".close_patient_visit",function(e){
		e.preventDefault();
		e.preventDefault();
		$(this).addClass("active");
		$("#dashboard-location-parent").text("Home");
		$("#dashboard-location-child").text("Clinic Management");
		$("#content-body").empty();
		var url = $(this).attr("href");
		$.get(url,function(data){
			$("#content-body").html(data);
		});
	})

	$("body").on("click",".patient_visit",function(e){
		e.preventDefault();
		$(this).addClass("active");
		$("#dashboard-location-parent").text("Home");
		$("#dashboard-location-child").text("Clinic Management");
		$("#content-body").empty();
		var url = $(this).attr("href");
		$.get(url,function(data){
			$("#content-body").html(data);
		});
	});

	$("body").on("keyup","#re_enter_password",function(){
		if ($("#re_enter_password").val()!= "") {
			if ($("#re_enter_password").val() != $("#new_password").val()) {
				$(".password_check").text("Password mismatched! Please confirm the new password");
				$(".password_check").addClass("text-danger");
				//alert($("#re_enter_password").val() + "  "+ $("#new_password").val());
			}
			else{
				$(".password_check").text("Password matched!");
				$(".password_check").removeClass("text-danger");
				$(".password_check").addClass("text-success");
				//alert("match")
			}
		}
		else{
			$(".password_check").text(" ");	
		}
	});
	$("body").on("keyup","#new_password",function(){
		if ($("#re_enter_password").val()!= "") {
			if ($("#new_password").val() != $("#re_enter_password").val()) {
				$(".password_check").text("Password mismatched! Please confirm the new password");
				$(".password_check").addClass("text-danger");
				//alert($("#re_enter_password").val() + "  "+ $("#new_password").val());
			}
			else{
				$(".password_check").text("Password matched!");
				$(".password_check").removeClass("text-danger");
				$(".password_check").addClass("text-success");
				//alert("match")
			}
		}		
	});
	//Report search
	$("body").on("submit","#report_search",function(e){
		e.preventDefault();
		var url=$(this).attr("action");
		var data=new FormData(this);
		$.ajax({
			url:url,
			data:data,
			method:"POST",
			processData:false,
			contentType:false,
			success:function(data){
				$("#report_section").empty();
				$("#report_section").append(data);
			}
		});
	})
	//Change Password script
	$("body").on("submit","#sys_form_change",function(e){
		e.preventDefault();
		if ($("#re_enter_password").val() != $("#new_password").val()) {
			$("#sys-modal-body").html("<p>Password confirmation mismatched! Please confirm the new password</p>");
			$("#sys-modal").modal("show");
		}
		else{
			var url=$(this).attr("action");
			var data=new FormData(this);		
			$.ajax({
				url:url,
				data:data,
				method:"POST",
				processData:false,
				contentType:false,
				success:function(data){
					$("#sys-message").append(data);
					setTimeout(function(){
						$(".alert").remove();
					},5000);
				}
			});
		}	
	});

	//take data from the form to the insert
	$("body").on("submit","#sys_form_res",function(e){
		e.preventDefault();	
		var url=$(this).attr("action");
		var data=new FormData(this);	
		if ($("#re_enter_password").val() != $("#new_password").val()) {
			$("#sys-modal-body").html("<p>Password confirmation mismatched! Please confirm the new password</p>");
			$("#sys-modal").modal("show");
		}
		else{
			//check if it contains file 
			if($(".sys-file-pic").length > 0){
				//check if picture file is not chosen
				if(fileValidation("image") != 1){
					$("#sys-modal-body").html("<p>This type of file is not allowed here.</p><strong>Please select the files which have the followeing extensions ('jpeg','jpg','png')");
					$("#sys-modal").modal("show");
					$("#sys-file-label").text("Choose Image");	
				}
				else{
					$.ajax({
						url:url,
						data:data,
						method:"POST",
						async:false,
						processData:false,
						contentType:false,
						success:function(data){
							$("#sys-message").append(data);
							setTimeout(function(){
								$(".alert").remove();
							},5000);
						}
					});
				}
			}
			//If the form doesnt have file
			else
			{
				$.ajax({
				url:url,
				data:data,
				method:"POST",
				async:false,
				processData:false,
				contentType:false,
				success:function(data){
					$("#sys-message").append(data);
					setTimeout(function(){
						$(".alert").remove();
					},5000);
				}
				});
			}
			var url="sys_res/products.php";
            $.get(url,function(data){
              $(".purchase_product").each(function(){
                if ($(this).val()== "") {
                  $(this).html(data);
                }
              })
            });
		}		
	});
	$("body").on("submit","#sys_form_patient",function(e){
		e.preventDefault();
		var url=$(this).attr("action");
		var data=new FormData(this);
		$.ajax({
			url:url,
			data:data,
			method:"POST",
			processData:false,
			contentType:false,
			success:function(data){
				$("#sys-message").append(data);
				setTimeout(function(){
					$(".alert").remove();
				},5000);
			}
		});
	});
	//Usertype change
	$("body").on("change","#usertype",function(e){
		var value=$(this).val();
		var url="sys_res/usertype.php?usertype="+value;
		$.get(url,function(data){
			$("#username").empty();
			$("#username").append('<option value="">Select Username</option>');
			$("#username").append(data);
		})
	});

	//Update
	$("body").on("click",".update_link",function(e){
		e.preventDefault();
		$("a").removeClass("active");
		$(this).parent().parent().parent().find(".anchor-active").addClass("active");
		$("#content-header").text($(this).attr("data-form-label"));
		$(this).addClass("active");
		$("#dashboard-location-child").text($(this).attr("data-form-label"));
		$("#content-body").empty();
		var url = $(this).attr("href");
		$.get(url,function(data){
			$("#content-body").html(data);
		});
	})
	//Show Update Modal
	$("body").on("click",".update-modal",function(e){
		e.preventDefault();
		var url=$(this).parent().attr("href");
		$.get(url,function(data){
			$(".modal-body").html(data);
		});
		$("#update-modal").modal("show");
	});
	//Show update button
	$("body").on("keyup",".update-text",function(){
		$(this).parent().parent().next().children().find(".update").removeClass("hide");
	});
	$("body").on("change",".update-select",function(){
		$(this).parent().parent().next().children().find(".update").removeClass("hide");
	});
	//Update Button
	$("body").on("click",".update",function(e){
		e.preventDefault();
		var val=$(this).parent().parent().prev().children().find(".form-control").val();
		var url=$(this).attr("href");
		url = url +"&val="+val;
		$.get(url,function(data){
			if (data == "success") {
				toastr.success('Successfully Updated.');
			}
			else{
				toastr.error(data);
			}
		});
		$(this).addClass("hide");
		//var file_url=$("#url").val();	
	});
	//Get ticket cost after doctor selection change
	$("body").on("change","#doctor",function(){
		var value=$(this).val();
		var url="sys_res/ticketcost.php?id="+value;
		$.get(url,function(data){
			$("#patient_ticket").val(data);
		})
	});
	$("body").on("change","#select_dotor",function(){
		var value=$(this).val();
		var url="sys_res/ticketcost.php?id="+value;
		$.get(url,function(data){
			$("#select_ticket").val(data);
		})
	});
	//Ticket Button
	$("body").on("click","#patient_exist",function(){
		$("#sys-modal").modal("show");
	})	
    //frm_patient_visits
    $("body").on("submit","#sys_forms_filter_patient_visits",function(e){
    	e.preventDefault();
    	$(".table-responsive").remove();
    	var patient_id=$("#visit_patient_id").val();
    	var visit_date=$("#visit_date").val();
    	var url="sys_res/patient_visits_filter.php?p_id="+patient_id+"&visit_date="+visit_date;
    	$.get(url,function(data){
    		$(".card-body").append(data);
    	})
    })
    //frm_clinic Management
    //next and prev button
    $("body").on("submit",".sys_form_clinic",function(e){
		e.preventDefault();
		var url=$(this).attr("action");
		var data=new FormData(this);
		data.append("patient_id",$("#p_id").val());
		data.append("ticket",$("#ticket_no").val());
		data.append("visit_date",$("#visit_date").val());
		data.append("doctor_id",$("#doctor_id").val());
		data.append("user_id",$("#user_id").val());
		$.ajax({
			url:url,
			data:data,
			method:"POST",
			processData:false,
			contentType:false,
			success:function(data){
				console.log(data);
			}
		});
		var active_anchor_id=$(this).parent().attr("aria-labelledby");
    	$("#"+active_anchor_id+"").removeClass("active");
    	$("#"+active_anchor_id+"").removeAttr("aria-selected");
    	var active_div_id=$(this).parent().attr("id");
    	$("#"+active_div_id+"").removeClass(" show active");

    	var next_active_anchor_id=$(this).parent().next().attr("aria-labelledby");
    	$("#"+next_active_anchor_id+"").addClass("active");
    	$("#"+next_active_anchor_id+"").attr("aria-selected","true");
    	var next_active_div_id=$(this).parent().next().attr("id");
    	$("#"+next_active_div_id+"").addClass(" show active");
	});
    //Lab Request Tab form submit
	$("body").on("submit",".sys_form_clinic_lab",function(e){
		e.preventDefault();
		var lab_count=0;
		$("#lab tr").each(function(){
    		lab_count=lab_count+1;
    	});
    	if (lab_count == 0) {
    		toastr.error("No requested lab");
    	}
    	else{
    		var url=$(this).attr("action");
			var data=new FormData(this);
			data.append("patient_id",$("#p_id").val());
			data.append("ticket",$("#ticket_no").val());
			data.append("visit_date",$("#visit_date").val());
			data.append("doctor_id",$("#doctor_id").val());
			data.append("user_id",$("#user_id").val());
			$.ajax({
				url:url,
				data:data,
				method:"POST",
				processData:false,
				contentType:false,
				success:function(data){
					console.log(data);
				}
			});
			var active_anchor_id=$(this).parent().attr("aria-labelledby");
	    	$("#"+active_anchor_id+"").removeClass("active");
	    	$("#"+active_anchor_id+"").removeAttr("aria-selected");
	    	var active_div_id=$(this).parent().attr("id");
	    	$("#"+active_div_id+"").removeClass(" show active");

	    	var next_active_anchor_id=$(this).parent().next().attr("aria-labelledby");
	    	$("#"+next_active_anchor_id+"").addClass("active");
	    	$("#"+next_active_anchor_id+"").attr("aria-selected","true");
	    	var next_active_div_id=$(this).parent().next().attr("id");
	    	$("#"+next_active_div_id+"").addClass(" show active");
    	}		
	});
	
	
	//Image Request Tab form submit
	$("body").on("submit",".sys_form_clinic_image",function(e){
		e.preventDefault();
		var lab_count=0;
		$("#image tr").each(function(){
    		lab_count=lab_count+1;
    	});
    	if (lab_count == 0) {
    		toastr.error("No requested Image");
    	}
    	else{
    		var url=$(this).attr("action");
			var data=new FormData(this);
			data.append("patient_id",$("#p_id").val());
			data.append("ticket",$("#ticket_no").val());
			data.append("visit_date",$("#visit_date").val());
			data.append("doctor_id",$("#doctor_id").val());
			data.append("user_id",$("#user_id").val());
			$.ajax({
				url:url,
				data:data,
				method:"POST",
				processData:false,
				contentType:false,
				success:function(data){
					console.log(data);
				}
			});
			var active_anchor_id=$(this).parent().attr("aria-labelledby");
	    	$("#"+active_anchor_id+"").removeClass("active");
	    	$("#"+active_anchor_id+"").removeAttr("aria-selected");
	    	var active_div_id=$(this).parent().attr("id");
	    	$("#"+active_div_id+"").removeClass(" show active");

	    	var next_active_anchor_id=$(this).parent().next().attr("aria-labelledby");
	    	$("#"+next_active_anchor_id+"").addClass("active");
	    	$("#"+next_active_anchor_id+"").attr("aria-selected","true");
	    	var next_active_div_id=$(this).parent().next().attr("id");
	    	$("#"+next_active_div_id+"").addClass(" show active");
    	}		
	});
	
	//service Request Tab form submit
	$("body").on("submit",".sys_form_clinic_service",function(e){
		e.preventDefault();
		var lab_count=0;
		$("#service tr").each(function(){
    		lab_count=lab_count+1;
    	});
    	if (lab_count == 0) {
    		toastr.error("No requested service");
    	}
    	else{
    		var url=$(this).attr("action");
			var data=new FormData(this);
			data.append("patient_id",$("#p_id").val());
			data.append("ticket",$("#ticket_no").val());
			data.append("visit_date",$("#visit_date").val());
			data.append("doctor_id",$("#doctor_id").val());
			data.append("user_id",$("#user_id").val());
			$.ajax({
				url:url,
				data:data,
				method:"POST",
				processData:false,
				contentType:false,
				success:function(data){
					console.log(data);
				}
			});
			var active_anchor_id=$(this).parent().attr("aria-labelledby");
	    	$("#"+active_anchor_id+"").removeClass("active");
	    	$("#"+active_anchor_id+"").removeAttr("aria-selected");
	    	var active_div_id=$(this).parent().attr("id");
	    	$("#"+active_div_id+"").removeClass(" show active");

	    	var next_active_anchor_id=$(this).parent().next().attr("aria-labelledby");
	    	$("#"+next_active_anchor_id+"").addClass("active");
	    	$("#"+next_active_anchor_id+"").attr("aria-selected","true");
	    	var next_active_div_id=$(this).parent().next().attr("id");
	    	$("#"+next_active_div_id+"").addClass(" show active");
    	}		
	});
	
		//diagnosis Tab form submit
	$("body").on("submit",".sys_form_clinic_diagnosis",function(e){
		e.preventDefault();
		var lab_count=0;
		$("#diagnosis_row tr").each(function(){
    		lab_count=lab_count+1;
    	});
    	if (lab_count == 0) {
    		toastr.error("No diagnosis");
    	}
    	else{
    		var url=$(this).attr("action");
			var data=new FormData(this);
			data.append("patient_id",$("#p_id").val());
			data.append("ticket",$("#ticket_no").val());
			data.append("visit_date",$("#visit_date").val());
			data.append("doctor_id",$("#doctor_id").val());
			data.append("user_id",$("#user_id").val());
			$.ajax({
				url:url,
				data:data,
				method:"POST",
				processData:false,
				contentType:false,
				success:function(data){
					console.log(data);
				}
			});
			var active_anchor_id=$(this).parent().attr("aria-labelledby");
	    	$("#"+active_anchor_id+"").removeClass("active");
	    	$("#"+active_anchor_id+"").removeAttr("aria-selected");
	    	var active_div_id=$(this).parent().attr("id");
	    	$("#"+active_div_id+"").removeClass(" show active");

	    	var next_active_anchor_id=$(this).parent().next().attr("aria-labelledby");
	    	$("#"+next_active_anchor_id+"").addClass("active");
	    	$("#"+next_active_anchor_id+"").attr("aria-selected","true");
	    	var next_active_div_id=$(this).parent().next().attr("id");
	    	$("#"+next_active_div_id+"").addClass(" show active");
    	}		
	});
	//prescription Tab form submit
	$("body").on("submit",".sys_form_clinic_prescription",function(e){
		e.preventDefault();
		var lab_count=0;
		$("#prescription tr").each(function(){
    		lab_count=lab_count+1;
    	});
    	if (lab_count == 1) {
    		toastr.error("No prescription");
    	}
    	else{
    		var url=$(this).attr("action");
			var data=new FormData(this);
			var p_id=$("#p_id").val();
			data.append("patient_id",$("#p_id").val());
			data.append("ticket",$("#ticket_no").val());
			data.append("visit_date",$("#visit_date").val());
			data.append("doctor_id",$("#doctor_id").val());
			data.append("user_id",$("#user_id").val());
			$.ajax({
				url:url,
				data:data,
				method:"POST",
				processData:false,
				contentType:false,
				success:function(data){
					console.log(data);
					Swal.fire({
					  title: 'Print ',
					  text: "Saved and Print!",
					  icon: 'question',
					  showCancelButton: true,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  customClass: 'swal-wide',
					  confirmButtonText: 'Print',
					  allowOutsideClick: false,
					  allowEscapeKey: false
					}).then((result) => {
						  if (result.value) {
							window.open('sys_reports/rpt_prescription.php?id=p_id','_Details',
						 'width=750, height=500, scrollbars=1, resizable=1');
						  }
						})
				}
			});
			var active_anchor_id=$(this).parent().attr("aria-labelledby");
	    	$("#"+active_anchor_id+"").removeClass("active");
	    	$("#"+active_anchor_id+"").removeAttr("aria-selected");
	    	var active_div_id=$(this).parent().attr("id");
	    	$("#"+active_div_id+"").removeClass(" show active");

	    	var next_active_anchor_id=$(this).parent().next().attr("aria-labelledby");
	    	$("#"+next_active_anchor_id+"").addClass("active");
	    	$("#"+next_active_anchor_id+"").attr("aria-selected","true");
	    	var next_active_div_id=$(this).parent().next().attr("id");
	    	$("#"+next_active_div_id+"").addClass(" show active");
    	}		
	});
    // $("body").on("click",".next",function(){
    // 	var active_anchor_id=$(this).parent().parent().parent().attr("aria-labelledby");
    // 	$("#"+active_anchor_id+"").removeClass("active");
    // 	$("#"+active_anchor_id+"").removeAttr("aria-selected");
    // 	var active_div_id=$(this).parent().parent().parent().attr("id");
    // 	$("#"+active_div_id+"").removeClass(" show active");

    // 	var next_active_anchor_id=$(this).parent().parent().parent().next().attr("aria-labelledby");
    // 	$("#"+next_active_anchor_id+"").addClass("active");
    // 	$("#"+next_active_anchor_id+"").attr("aria-selected","true");
    // 	var next_active_div_id=$(this).parent().parent().parent().next().attr("id");
    // 	$("#"+next_active_div_id+"").addClass(" show active");
    // });
    $("body").on("click",".prev",function(){
    	var active_anchor_id=$(this).parent().parent().parent().parent().attr("aria-labelledby");
    	$("#"+active_anchor_id+"").removeClass("active");
    	$("#"+active_anchor_id+"").removeAttr("aria-selected");
    	var active_div_id=$(this).parent().parent().parent().parent().attr("id");
    	$("#"+active_div_id+"").removeClass(" show active");

    	var next_active_anchor_id=$(this).parent().parent().parent().parent().prev().attr("aria-labelledby");
    	$("#"+next_active_anchor_id+"").addClass("active");
    	$("#"+next_active_anchor_id+"").attr("aria-selected","true");
    	var next_active_div_id=$(this).parent().parent().parent().parent().prev().attr("id");
    	$("#"+next_active_div_id+"").addClass(" show active");
    });
    //Physical
    $("body").on("change","#weight",function(){
    	if ($(this).val() && $("#height").val()) {
    		var weight=$(this).val();
    		var height=$("#height").val()/100;
    		var bmi=weight/(height*height);
    		$("#bmi").val(bmi.toFixed(3));
    	}
    });
    $("body").on("change","#height",function(){
    	if ($(this).val() && $("#weight").val()) {
    		var height=$(this).val()/100;
    		var weight=$("#weight").val();
    		var bmi=weight/(height*height);
    		$("#bmi").val(bmi.toFixed(3));
    	}
    })
    //Lab Request
    $("body").on("click","#add_lab_request",function(){
    	var lab_count=1;
    	var requested=0;
    	if($("#lab_name").val()){
    		$("#lab tr").each(function(){
    			lab_count=lab_count+1;
    		});
    		$(".lab_id").each(function(){
    			if ($(this).val() ==$("#lab_name").val()) {
    				requested=1;
    				toastr.error("You have already requested this lab investigation");
    			}
    		});
    		if (requested ==0) {
	    		var row="<tr>";
	    		row+="<td class='count'>"+lab_count+"</td>";
	    		row+="<td><input type='hidden' value='"+$("#lab_name option:selected").val()+"' name='lab_id[]' class='lab_id'>"+$("#lab_name option:selected").text()+"</td>";
	    		row+="<td>Ordered</t>";
	    		row+="<td>"+$("#visit_date").val()+"</td>";
	    		row+="<td><span class='fas fa-times text-danger remove_row'></span></td>"
	    		row+="</tr>";
	    		$("#lab").append(row);
	    		$("#lab_name").val("");
	    		$("#lab_name").trigger("change");
    		}    		
    	}
    	else{
    		toastr.error('Please select lab')
    	}
    	
    });
	//Image Request
	$("body").on("click","#add_image_request",function(){
		//alert(1);
    	var lab_count=1;
    	var requested=0;
    	if($("#image_name").val()){
    		$("#image tr").each(function(){
    			lab_count=lab_count+1;
    		});
    		$(".image_id").each(function(){
    			if ($(this).val() ==$("#image_name").val()) {
    				requested=1;
    				toastr.error("You have already requested this image investigation");
    			}
    		});
    		if (requested ==0) {
	    		var row="<tr>";
	    		row+="<td class='count'>"+lab_count+"</td>";
	    		row+="<td><input type='hidden' value='"+$("#image_name option:selected").val()+"' name='image_id[]' class='image_id'>"+$("#image_name option:selected").text()+"</td>";
	    		row+="<td>Ordered</t>";
	    		row+="<td>"+$("#visit_date").val()+"</td>";
	    		row+="<td><span class='fas fa-times text-danger remove_row'></span></td>"
	    		row+="</tr>";
	    		$("#image").append(row);
	    		$("#image_name").val("");
	    		$("#image_name").trigger("change");
    		}    		
    	}
    	else{
    		toastr.error('Please select image')
    	}
    	
    });
	
	//service Request
	$("body").on("click","#add_service_request",function(){
		//alert(1);
    	var lab_count=1;
    	var requested=0;
    	if($("#service_name").val()){
    		$("#service tr").each(function(){
    			lab_count=lab_count+1;
    		});
    		$(".service_id").each(function(){
    			if ($(this).val() ==$("#service_name").val()) {
    				requested=1;
    				toastr.error("You have already requested this service investigation");
    			}
    		});
    		if (requested ==0) {
	    		var row="<tr>";
	    		row+="<td class='count'>"+lab_count+"</td>";
	    		row+="<td><input type='hidden' value='"+$("#service_name option:selected").val()+"' name='service_id[]' class='service_id'>"+$("#service_name option:selected").text()+"</td>";
	    		row+="<td>Ordered</t>";
	    		row+="<td>"+$("#visit_date").val()+"</td>";
	    		row+="<td><span class='fas fa-times text-danger remove_row'></span></td>"
	    		row+="</tr>";
	    		$("#service").append(row);
	    		$("#service_name").val("");
	    		$("#service_name").trigger("change");
    		}    		
    	}
    	else{
    		toastr.error('Please select service')
    	}
    	
    });
	
	//Add diagnosis
$("body").on("click","#add_diagnosis",function(){
		//alert(1);

    	var lab_count=1;
    	var requested=0;
    	if($("#diagnosis_name").val()){
    		$("#diagnosis tr").each(function(){
    			lab_count=lab_count+1;
    		});
    		$(".diagnosis_id").each(function(){
    			if ($(this).val() ==$("#diagnosis_name").val()) {
    				requested=1;
    				toastr.error("You have already requested this diagnosis investigation");
    			}
    		});
    		if (requested ==0) {
	    		var row="<tr>";
	    		row+="<td class='count'>"+lab_count+"</td>";
	    		row+="<td><input type='hidden' value='"+$("#diagnosis_name option:selected").val()+"' name='diagnosis_id[]' class='diagnosis_id'>"+$("#diagnosis_name option:selected").text()+"</td>";
	    		row+="<td><input type='hidden' value='"+$("#diagnosis_type option:selected").val()+"' name='diagnosis_type[]' class='diagnosis_type'>"+$("#diagnosis_type option:selected").text()+"</td>";
	    		row+="<td><span class='fas fa-times text-danger remove_row'></span></td>"
	    		row+="</tr>";
	    		$("#diagnosis_row").append(row);
	    		$("#diagnosis_name").val("");
	    		$("#diagnosis_name").trigger("change");	
    		}    		
    	}
    	else{
    		toastr.error('Please select diagnosis')
    	}
    	
    });
	
    $("body").on("click",".remove_row",function(){
    	$(this).parent().parent().remove();
    	var count=1;
    	$("tbody tr").each(function(){
    		$(this).find(".count").text(count);
    		count=count+1;
    	})
    });
    //Prescription
    $("body").on("click","#add_prescripted_list",function(){
    	var count=1;
    	var prescripted=0;
    	if ($("#drug_name").val() && $("#qty").val() && $("#frequency").val() && $("#duration").val() && $("#route").val()) {
    		$("prescription tr").each(function(){
    			count=count+1;
    		});
    		$(".drug_id").each(function(){
    			if ($(this).val() ==$("#drug_id").val()) {
    				prescripted=1;
    			}
    		});
    		if (prescripted ==0) {
	    		var row="<tr>";
	    		row+="<td class='count'>"+count+"</td>";
	    		row+="<td><input type='hidden' value='"+$("#drug_name").val()+"' name='drug_id[]' class='drug_id'>"+$("#drug_name option:selected").text()+"</td>";
	    		row+="<td><input type='hidden' value='"+$("#qty").val()+"' name='qty[]'>"+$("#qty").val()+"</td>";
	    		row+="<td><input type='hidden' value='"+$("#frequency").val()+"' name='frequency[]'>"+$("#frequency").val()+"</t>";
	    		row+="<td><input type='hidden' value='"+$("#duration").val()+"' name='duration[]'>"+$("#duration").val()+"</td>";
	    		row+="<td><input type='hidden' value='"+$("#route").val()+"' name='route[]'>"+$("#route").val()+"</td>";
	    		row+="<td><span class='fas fa-times text-danger remove_row'></span></td>"
	    		row+="</tr>";
	    		$(".prescription").append(row);
	    		$("#drug_id").val("");
	    		$("#qty").val("");
	    		$("#frequency").val("");
	    		$("#duration").val("");
	    		$("#route").val("");
	    		$("#drug_id").trigger("change");
    		}
    		else{
    			toastr.error("You have already prescripted this drug");
    		}
    	}
    	else{
    		toastr.error("Please fill required fields");
    	}
    });
    //Permission
    $("body").on("change",".check",function(){
		var sidebr_id = $(this).val();
		var user_id = $("#user-id").val();
		var action = "";
		var active_user=$("#user_id").val();
		if ($(this).is(":checked")){
			action = "1";
		}else{
			action = "2";
		}
		var data = "sp=sp_permission&sidebar="+sidebr_id+"&user="+user_id+"&action="+action+"&active="+active_user;
		//alert(data);
		$.post("actions/insert.php",data,function(res){
		});
	});
    $("body").on("change",".menu",function(){
		if($(this).is(":checked")){
			$(this).parent().find(".check").each(function(){
				if($(this).is(":checked")){

				}
				else{
					$(this).trigger("click");
				}
			});
		}
		else{
			$(this).parent().find(".check").each(function(){
				if($(this).is(":checked")){
					$(this).trigger("click");
				}
				else{
					
				}
			});
		}
	});
function fileValidation(fileClass) {
	if(fileClass =="image"){
		var file=$(".sys-file-pic");
		var length=file[0].files.length;
		var item=file[0].files
		var type=item[0].type
		var fileType=type.substring(0,5)
			if (fileType == "image") {
			 return 1;
			}
	}
	else if (fileClass == "video") {
		var file=$(".sys-file-vid");
		var length=file[0].files.length;
		var item=file[0].files
		var type=item[0].type
		var fileType=type.substring(0,5)
		if (fileType == "video") {
		 	return 1;
		}
	}
	else if (fileClass == "zip") {

	}
	else if (fileClass =="pdf") {		
	}
}
})