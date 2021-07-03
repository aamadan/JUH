$(document).ready(function(){
	//form submits
	//frm_prouct_purchase.php submit
	$("body").on("submit","#sys_form_purchase",function(e){
		e.preventDefault();
		var url=$(this).attr("action");
		var data=new FormData(this);
		var purchase_valid=0;
		$(".purchase_product").each(function(){
			if ($(this).val()) {
				data.append("purchase_product[]",$(this).val());
				data.append("purchase_unit[]",$(this).parent().parent().find(".purchase_unit").val());
				data.append("purchase_quantity[]",$(this).parent().parent().find(".qty").val());
				data.append("purchase_price[]",$(this).parent().parent().find(".price").val());
				data.append("id[]",$(this).parent().parent().find(".id").val());
				purchase_valid=1;
			}
		});
		if (purchase_valid ==1) {
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
		else{
			toastr.error("Please fill purchase form");
		}
	});
	//frm cash sales submit
	$("body").on("submit","#sys_form_cashSales",function(e){
		e.preventDefault();
		var url=$(this).attr("action");
		var data=new FormData(this);
		var sales_valid=0;
		var checked=0;
		if ($("#rest").val() > 0) {
			toastr.error("Cash sales must be paid fully")
		}						
		else{
			checked=1;
		}
		if(checked ==1){
			$(".sales_product").each(function(){
				if ($(this).val()) {
					data.append("sales_product[]",$(this).val());
					data.append("sales_unit[]",$(this).parent().parent().find(".sales_unit").val());
					data.append("sales_quantity[]",$(this).parent().parent().find(".qty").val());
					data.append("sales_price[]",$(this).parent().parent().find(".price").val());
					data.append("id[]",$(this).parent().parent().find(".id").val());
					sales_valid=1;
				}
			});	
			for (var pair of data.entries()) {
		    	console.log(pair[0]+ ', ' + pair[1]); 
			}
			if (sales_valid ==1) {
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
			else{
				toastr.error("Please fill sales form");
			}
		}
	});
	//frm customer sales submit
	$("body").on("submit","#sys_form_customerSales",function(e){
		e.preventDefault();
		var url=$(this).attr("action");
		var data=new FormData(this);
		var sales_valid=0;
		var checked=0;
		var balance=Number($("#current_balance").val());
		var rest=Number($("#rest").val());
		var max_balance=Number($("#max_balance").val());
		var current_balance=balance+rest;
		if(balance+rest > max_balance){
			Swal.fire({
				title: 'Customer balance',
				text: "Customer is exeeding maximum allowed balance are you sure to continue?",
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				customClass: 'swal-wide',
				confirmButtonText: 'OK',
				allowOutsideClick: false,
				allowEscapeKey: false
			}).then((result) => {
				if (result.value) {
					checked=1;
					submit();
				}
			});
		}
		else{
			checked=1;
		}
		submit();
		function submit(){
			alert("submitting");
			if(checked ==1){
				alert("done");
				$(".sales_product").each(function(){
					if ($(this).val()) {
						data.append("sales_product[]",$(this).val());
						data.append("sales_unit[]",$(this).parent().parent().find(".sales_unit").val());
						data.append("sales_quantity[]",$(this).parent().parent().find(".qty").val());
						data.append("sales_price[]",$(this).parent().parent().find(".price").val());
						data.append("id[]",$(this).parent().parent().find(".id").val());
						sales_valid=1;
					}
				});	
				if (sales_valid ==1) {
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
				else{
					toastr.error("Please fill sales form");
				}
			}
			else{
				alert("problem");
			}
		}
	});
	//frm_prescription_sales submit
	$("body").on("submit","#sys_form_prescriptionSales",function(e){
		e.preventDefault();
		var url=$(this).attr("action");
		var data=new FormData(this);
		for (var pair of data.entries()) {
		    console.log(pair[0]+ ', ' + pair[1]); 
		}
		var sales_valid=0;
		var checked=0;
		if ($("#rest").val() > 0) {
			toastr.error("Prescription sales must be paid fully")
		}						
		else{
			checked=1;
		}
		if(checked ==1){
			$(".prescription_check").each(function(){
				if ($(this).is(":checked")) {
					data.append("sales_product[]",$(this).parent().parent().parent().parent().find(".product_id").val());
					data.append("sales_unit[]"," ");
					data.append("sales_quantity[]",$(this).parent().parent().parent().parent().find(".qty").val());
					data.append("sales_price[]",$(this).parent().parent().parent().parent().find(".price").val());
					data.append("id[]",$(this).parent().parent().find(".id").val());
					sales_valid=1;
				}
			})	
			if (sales_valid ==1) {
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
				$("#prescription_info").remove();
			}
			else{
				toastr.error("Please fill sales form");
			}
		}
	});
	//-----------------------------------------------------------//
	//frm_prdocut_registrations
		//Drug categories
	//Get extra inputs if the type is pill
	$("body").on("change","#drug_category",function(){
		var id=$(this).val();
		var url="sys_res/drug_category.php?id="+id;
		$.get(url,function(data){
			if (data==1) {
				if (!$(".stripes").length) {
					var inputs='<div class="col-md-4 stripes"><div class="form-group"><label>Num of Stripe Per Pack</label><input type="text" class="form-control" name="num_stp" id="num_stp" required placeholder="Num of Stripe Per Pack"></div></div>	<div class="col-md-4 stripes">		<div class="form-group">			<label>Num of Pieces Per Stripe</label>			<input type="text" class="form-control" name="num_pieces" id="num_pieces" required placeholder="Num of Pieces Per Stripe">		</div>	</div>'
					$(".drugs_category").after(inputs);
					$("#sp").val("sp_product_registration_stripes");
				}
			}
			else{
				$(".stripes").remove();
				$("#sp").val("sp_product_registration");
			}
		});
	});
	//frm_product_purchase
	$("body").on("change",".purchase_product",function(){
		if ($(this).val() == "") {
			$(this).parent().parent().find(".price").val("");
			$(this).parent().parent().find(".qty").val("");
			$(this).parent().parent().find(".purchase_unit").val("");
			$(this).parent().parent().find(".amount").val("");
			$(this).parent().parent().find(".purchase_unit").trigger("change");

			$(this).parent().parent().find(".price").removeAttr("required");
	    	$(this).parent().parent().find(".qty").removeAttr("required");
	    	$(this).parent().parent().find(".purchase_unit").removeAttr("required");
		}
		else{
			var obj=$(this);
	    	var value=$(this).val();      
	    	var purchase_cost="";          
	    	//var url="sys_res/product_price.php?id="+value;
	    	$.ajax({
				url:"sys_res/product_price.php",
				data:{id:value},
				method:"GET",
				dataType:'json',
				async:false,
				success:function(data){
					obj.parent().parent().find(".price").val(data.price);
					obj.parent().parent().find(".price").trigger("blur");
					obj.parent().parent().find(".purchase_unit").html(data.options);
					//purchase_cost=data.price;
				}
			});
	    	$(this).parent().parent().find(".price").attr("required","true");
	    	$(this).parent().parent().find(".qty").attr("required","true");
	    	$(this).parent().parent().find(".purchase_unit").attr("required","true");
		}    	                
    });
    $("body").on("click","#purchase_addRow",function(){
    	var obj=$(this);
    	$(this).attr("disabled","true");
    	var count=0;
    	$("tr").each(function(){
    		count=count+1;
    	});
		var url="sys_res/add_row_purchaseForm.php?number="+count;
		$.get(url,function(data){
			$("table").append(data);
		});
		setTimeout(function(){
			obj.removeAttr("disabled");
		},200)
    });
    $("body").on("change",".purchase_unit",function(){
    	if($(this).val()){
    		var obj=$(this);
    		var type=$(this).val();
    		var id=$(this).parent().parent().find(".purchase_product").val();
			var url="sys_res/product_price_perUnit.php?type="+type+"&id="+id;
			$.get(url,function(data){
				obj.parent().parent().find(".price").val(data);
			})
    	}
    });
    $("body").on("click","#purchase_addNew",function(){
    	$("#sys-modal").modal("show");
    	var url="sys_forms/frm_addProduct.php";
    	$.get(url,function(data){
    		$("#sys-modal-body").html(data);
    	})
    });
	//frm sales
	$("body").on("click","#sales_checkout",function(){
		$("#sys-modal").modal("show");
	});
    $("body").on("change","#sales_type",function(){
    	$(".prescription_input").addClass("d-none");
    	$(".cash_input").addClass("d-none");
    	$(".customer_input").addClass("d-none");
    	$("#prescription_search_sales").addClass("d-none");
    	$("#customer_name").val("");
    	$("#customer").val("");
    	$("#prescription_number").val("");

    	if ($(this).val() =="prescription") {
    		$(".prescription_input").removeClass("d-none");
    		$("#prescription_search_sales").removeClass("d-none");
    		$("#sales_info").remove();
    		$("#checkSales").val("removed");
    	}
    	else if ($(this).val()=="cash" || $(this).val() =="customer") {
    		$("#prescription_info").remove();
    		if ($("#checkSales").val() !="exists") {
    			var url="sys_res/sales.php";
	    		$.get(url,function(data){
	    			$("#invoice_info").after(data);
	    		});
    		}
    		if ($(this).val()=="cash") {
    			$(".cash_input").removeClass("d-none");
    		}
    		else if ($(this).val() =="customer") {
    			$(".customer_input").removeClass("d-none");
    		}
    		$("#checkSales").val("exists");
    	}
    });
    $("body").on("change","#customer",function(){
    	if ($(this).val()) {
	    	var value=$(this).val();            
	    	$.ajax({
				url:"sys_res/customer_balance.php",
				data:{id:value},
				method:"GET",
				dataType:'json',
				success:function(data){
					$("#current_balance").val(data.current);
					$("#max_balance").val(data.max);
				},
				error:function(xhr,status,error){
					console.log(xhr);
					console.log(status);
					console.log(error);
				}
			});
    	}
    })
	$("body").on("submit","#sys_form_sales",function(e){
		e.preventDefault();
		var url=$(this).attr("action");
		var data=new FormData(this);
		var sales_valid=0;
		var checked=0;
		if ($("#sales_type").val()=="cash") {
			if($("#customer_name").val() =="" || $("#rest").val() > 0){
				if($("#customer_name").val() ==""){
					toastr.error("Please fill customer name");		
				}
				else if ($("#rest").val() > 0) {
					toastr.error("Cash sales must be paid fully")
				}						
			}
			else{
				checked=1;
			}
		}
		else if ($("#sales_type").val()=="customer"){
			var balance=Number($("#current_balance").val());
			var rest=Number($("#rest").val());
			var max_balance=Number($("#max_balance").val());
			var current_balance=balance+rest;
			alert(balance)
			alert(rest);
			alert(max_balance);
			alert(current_balance);
			if($("#customer").val() =="" || balance+rest > max_balance){
				if ($("#customer").val()=="") {
					toastr.error("Please select customer name");
				}
				else{
					Swal.fire({
					  title: 'Customer balance',
					  text: "Customer is exeeding maximum allowed balance are you sure to continue?",
					  icon: 'question',
					  showCancelButton: true,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  customClass: 'swal-wide',
					  confirmButtonText: 'OK',
					  allowOutsideClick: false,
					  allowEscapeKey: false
					}).then((result) => {
						  if (result.value) {
							$(".sales_product").each(function(){
								if ($(this).val()) {
									data.append("sales_product[]",$(this).val());
									data.append("sales_unit[]",$(this).parent().parent().find(".sales_unit").val());
									data.append("sales_quantity[]",$(this).parent().parent().find(".qty").val());
									data.append("sales_price[]",$(this).parent().parent().find(".price").val());
									sales_valid=1;
								}
							});
							if (sales_valid ==1) {
								$.ajax({
									url:url,
									data:data,
									method:"POST",
									processData:false,
									contentType:false,
									success:function(data){
										$("#sys-message").append(data);
										console.log(data);
										setTimeout(function(){
											$(".alert").remove();
										},5000);
									}
								});
							}
						  }
						})
				}
			}
			else{
				checked=1;
			}
		}
		else{
			if ($("#checkSales").val() =="removed") {
				if ($("#rest").val() > 0) {
					toastr.error("No rest is allowed please");
				}
				else{
					checked =1;
				}
			}
		}
		if(checked ==1){
			if ($("#sales_type").val()=="cash" || $("#sales_type").val()=="customer") {
				$(".sales_product").each(function(){
					if ($(this).val()) {
						data.append("sales_product[]",$(this).val());
						data.append("sales_unit[]",$(this).parent().parent().find(".sales_unit").val());
						data.append("sales_quantity[]",$(this).parent().parent().find(".qty").val());
						data.append("sales_price[]",$(this).parent().parent().find(".price").val());
						sales_valid=1;
					}
				});	
			}
			else{
				$(".prescription_check").each(function(){
					if ($(this).is(":checked")) {
						data.append("sales_product[]",$(this).parent().parent().parent().parent().find(".product_id").val());
						data.append("sales_unit[]"," ");
						data.append("sales_quantity[]",$(this).parent().parent().parent().parent().find(".qty").val());
						data.append("sales_price[]",$(this).parent().parent().parent().parent().find(".price").val());
						for (var pair of data.entries()) {
						    console.log(pair[0]+ ', ' + pair[1]); 
						}
						sales_valid=1;
					}
				})
			}
			if (sales_valid ==1) {
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
			else{
				toastr.error("Please fill sales form");
			}
		}
	});
	$("body").on("change",".sales_product",function(){
		if ($(this).val() == "") {
			$(this).parent().parent().find(".price").val("");
			$(this).parent().parent().find(".qty").val("");
			$(this).parent().parent().find(".purchase_unit").val("");
			$(this).parent().parent().find(".amount").val("");
			$(this).parent().parent().find(".purchase_unit").trigger("change");

			$(this).parent().parent().find(".price").removeAttr("required");
	    	$(this).parent().parent().find(".qty").removeAttr("required");
	    	$(this).parent().parent().find(".sales_unit").removeAttr("required");
		}
		else{
			var obj=$(this);
	    	var value=$(this).val();      
	    	var purchase_cost="";          
	    	//var url="sys_res/product_price.php?id="+value;
	    	$.ajax({
				url:"sys_res/product_price_sales.php",
				data:{id:value},
				method:"GET",
				dataType:'json',
				async:false,
				success:function(data){
					obj.parent().parent().find(".price").val(data.price);
					obj.parent().parent().find(".a_qty").val(data.a_qty);
					obj.parent().parent().find(".price").trigger("blur");
					obj.parent().parent().find(".sales_unit").html(data.options);
					//purchase_cost=data.price;
				}
			});
	    	$(this).parent().parent().find(".price").attr("required","true");
	    	$(this).parent().parent().find(".qty").attr("required","true");
	    	$(this).parent().parent().find(".sales_unit").attr("required","true");
		}    	                
    });
    // $("body").on("keydown","#discount",function(e){
    // 	e.preventDefault();
    // })
    $("body").on("keypress",".sales_qty",function(e){
    	if($(this).val().length == 0){
    		if($(this).next().val() == ""){
    			toastr.success("Please choose sales unit first");
    			e.preventDefault();
    		}
    		else{
    			if(Number(e.key) > $(this).next().val()){
    			toastr.error("That quantity is not available");
    			e.preventDefault();
    			}
    		}    		
    	}
    	else{
    		var requested_quantity=Number($(this).val()+e.key);
	    	if(requested_quantity > $(this).next().val()){
	    		toastr.error("That quantity is not available");
	    		e.preventDefault();
	    	}
    	}
    });
    $("body").on("click","#sales_addRow",function(){
    	var obj=$(this);
    	$(this).attr("disabled","true");
    	var count=0;
    	$("tr").each(function(){
    		count=count+1;
    	});
		var url="sys_res/add_row_salesForm.php?number="+count;
		$.get(url,function(data){
			$("table").append(data);
		});
		setTimeout(function(){
			obj.removeAttr("disabled");
		},200)
    });
    $("body").on("change",".sales_unit",function(){
    	if($(this).val()){
    		var obj=$(this);
    		var type=$(this).val();
    		var id=$(this).parent().parent().find(".sales_product").val();
			//var url="sys_res/product_price_perUnit_sales.php?type="+type+"&id="+id;
			var url="sys_res/product_price_perUnit_sales.php";
			$.ajax({
				url:url,
				data:{id:id,type:type},
				method:"GET",
				dataType:'json',
				async:false,
				success:function(data){
					obj.parent().parent().find(".price").val(data.price);
					obj.parent().parent().find(".a_qty").val(data.a_qty);
					obj.parent().parent().find(".ap_qty").val(data.ap_qty);
					obj.parent().parent().find(".qty").val("");
				}
			});
			// $.get(url,function(data){
				
			// })
    	}
    });
    $("body").on("click","#prescription_search_sales",function(){
    	if ($("#prescription_number").val()) {
    		$("#prescription_info").remove();
    		var url="sys_res/prescription_info.php?p_serial="+$("#prescription_number").val();
    		$.get(url,function(data){
    			$("#invoice_info").after(data);
    		})
    	}
    	else{

    	}
    });
    $("body").on("click",".prescription_check",function(){
    	var amount=Number($(this).parent().parent().parent().parent().find(".amount").val());
    	var total=Number($("#total").val());
    	if($(this).is(":checked")){
			$(this).prop( "checked", true );
			total=total+amount;	
		}
		else{			
			$(this).prop( "checked", false );
			total=total-amount;		
		}
		$("#total").val(total);
		$("#discount").trigger("change");
    });
    //frm_purchase_return
    $("body").on("change","#supplier",function(){
    	var val=$(this).val();
    	var url="sys_res/purchase_supplier_invoice.php?supplier="+val;
    	$.get(url,function(data){
    		$("#invoice").empty();
    		$("#invoice").append(data);
    	})
    });
    $("body").on("change","#invoice",function(){
    	if($(this).val()){
    		var val=$(this).val();
	    	var url="sys_res/productByInvoice.php?invoice="+val;
	    	$.get(url,function(data){
	    		$("#product").empty()
	    		$("#product").append(data);
	    	});
    	}  	
    });
    $("body").on("change","#product",function(){
    	var id=$(this).val();
    	var supplier_id=$("#supplier").val();
    	var invoice=$("#invoice").val();
    	var url="sys_res/purchase_return_info.php";
    	$.ajax({
    		url:url,
    		data:{id:id,supplier_id:supplier_id,invoice:invoice},
    		method:"GET",
    		dataType:'json',
    		success:function(data){
    			// $("#return_unit").empty();
    			// $("#return_unit").append(data.options);
    			$("#purchasedQuantity").val(data.purchased_quantity);
    			$("#p_quantity").val(data.p_quantity);

    		}
    	})
    })
    $("body").on("keypress","#returnQuantity",function(e){
	    if($(this).val().length == 0){
	    	if($(this).next().val() == ""){
	    		toastr.success("Please select product from product list");
	    		e.preventDefault();
	    	}
	    	else{
	    		if(Number(e.key) > $(this).prev().val()){
		    		toastr.error("That quantity is more than you bought");
		    		e.preventDefault();
	    		}
	    	}    		
	    }
	    else{
	    	var requested_quantity=Number($(this).val()+e.key);
		    if(requested_quantity > $(this).prev().val()){
		    	toastr.error("That quantity is more than you bought");
		    	e.preventDefault();
		    }
	    }
    });
    $("body").on("submit","#sys_form_purchase_return",function(e){
    	e.preventDefault();
    	var url="sys_forms/frm_productPurchaseReturn.php";
    	var data=new FormData(this);
    	$.ajax({
    		url:url,
    		data:data,
    		method:"POST",
    		processData:false,
    		contentType:false,
    		success:function(data){
    			$("#content-body").empty();
    			$("#content-body").append(data);
    		}
    	})
    });
    //Calculations
    $("body").on("blur",".qty",function(e){
        var quantity_val=parseFloat($(this).val());
        if (!isNaN(quantity_val)) {
            if ($(this).parent().parent().find(".price").val() != "" ) {
                var price_val=parseFloat($(this).parent().parent().find(".price").val());
                var amount_val=price_val*quantity_val;
                $(this).parent().parent().find(".amount").val(amount_val.toFixed(4));
                $(this).parent().parent().find(".amount").trigger("change");
            }
        }
        else{
            $(this).parent().parent().find(".amount").val("");
        }  
    });
    $("body").on("blur",".price",function(e){
        var price_val=parseFloat($(this).val());
        if (!isNaN(price_val)) {
            if ($(this).parent().parent().find(".qty").val() != "") {
                var quantity_val=parseFloat($(this).parent().parent().find(".qty").val());
                var amount_val=price_val*quantity_val;
                $(this).parent().parent().find(".amount").val(amount_val.toFixed(4));
                $(this).parent().parent().find(".amount").trigger("change");
            }
        }
        else{
            $(this).parent().parent().find(".amount").val("");
        }                  
    });
    $("body").on("change",".amount",function(){
    	var total=0.0;
    	$(".amount").each(function(){
    		if($(this).val() != ""){
    			total=parseFloat(total)+parseFloat($(this).val());
    		}
    	});
    	$("#total").val(total);
    	if ($("#discount").val()) {
    		var discount=parseFloat($("#discount").val());
    		var total=parseFloat($("#total").val());
    		var grand_total=total - discount;
    		$("#grand_total").val(grand_total);
    		$("#rest").val(grand_total);
    	}
    	else{
    		$("#grand_total").val($("#total").val());
    		$("#rest").val($("#total").val());
    	}
    });
    $("body").on("change","#discount",function(){
    	if ($("#total").val()) {
    		if ($(this).val()) {
	    		var discount=parseFloat($(this).val());
	    		var total=parseFloat($("#total").val());
	    		var grand_total=total - discount;
	    		$("#grand_total").val(grand_total);
	    		if ($("#paid").val()) {
		    		var paid=parseFloat($("#paid").val());
		    		var grand_total=parseFloat($("#grand_total").val());
		    		var rest=grand_total - paid;
		    		$("#rest").val(rest);
	    		}
		    	else{
		    		$("#rest").val($("#grand_total").val());
		    	}
    		}
    		else if($("#paid").val() && $(this).val() == ""){
    			$("#grand_total").val($("#total").val());
    			var paid=parseFloat($("#paid").val());
		    	var grand_total=parseFloat($("#grand_total").val());
		    	var rest=grand_total - paid;
		    	$("#rest").val(rest);
    		}
	    	else if($(this).val() == ""){
	    		$("#grand_total").val($("#total").val());
	    		$("#rest").val($("#total").val());
	    	}
    	}    	
    });
    $("body").on("keyup","#discount",function(){
    	if ($("#total").val()) {
    		if ($(this).val()) {
	    		var discount=parseFloat($(this).val());
	    		var total=parseFloat($("#total").val());
	    		var grand_total=total - discount;
	    		$("#grand_total").val(grand_total);
	    		if ($("#paid").val()) {
		    		var paid=parseFloat($("#paid").val());
		    		var grand_total=parseFloat($("#grand_total").val());
		    		var rest=grand_total - paid;
		    		$("#rest").val(rest);
	    		}
		    	else{
		    		$("#rest").val($("#grand_total").val());
		    	}
    		}
    		else if($("#paid").val()){
    			$("#grand_total").val($("#total").val());
    			var paid=parseFloat($("#paid").val());
		    	var grand_total=parseFloat($("#grand_total").val());
		    	var rest=grand_total - paid;
		    	$("#rest").val(rest);
    		}
	    	else if($(this).val() == ""){
	    		$("#grand_total").val($("#total").val());
	    		$("#rest").val($("#total").val());
	    	}
    	}    	
    });
    $("body").on("keypress","#discount",function(e){
    	if($(this).val().length == 0){
    		if($("#total").val() == ""){
    			toastr.success("Please fill the form before discount");
    			e.preventDefault();
    		}
    		else{
    			if(Number(e.key) > $("#total").val()){
    			toastr.error("Discount money can not be exceeded the total");
    			e.preventDefault();
    			}
    		}    		
    	}
    	else{
    		var discount_money=Number($(this).val()+e.key);
	    	if(discount_money > $("#total").val()){
	    		toastr.error("Discount money can not be exceeded the total");
	    		e.preventDefault();
	    	}
    	}	
    })
    $("body").on("change","#paid",function(){
    	if ($("#grand_total").val()) {
    		if ($(this).val()) {
	    		var paid=parseFloat($(this).val());
	    		var grand_total=parseFloat($("#grand_total").val());
	    		var rest=grand_total - paid;
	    		$("_rest").val(rest);
    		}
	    	else{
	    		$("#rest").val($("#grand_total").val());
	    	}
    	}    	
    });
    $("body").on("keyup","#paid",function(){
    	if ($("#grand_total").val()) {
    		if ($(this).val()) {
	    		var paid=parseFloat($(this).val());
	    		var grand_total=parseFloat($("#grand_total").val());
	    		var rest=grand_total - paid;
	    		$("#rest").val(rest);
    		}
	    	else{
	    		$("#rest").val($("#grand_total").val());
	    	}
    	} 	
    });
    $("body").on("keypress","#paid",function(e){
    	if($(this).val().length == 0){
    		if($("#grand_total").val() == ""){
    			toastr.success("Please fill the form before payment");
    			e.preventDefault();
    		}
    		else{
    			if(Number(e.key) > $("#grand_total").val()){
    			toastr.error("Paying money can not be exceeded the grand total");
    			e.preventDefault();
    			}
    		}    		
    	}
    	else{
    		var paying_money=Number($(this).val()+e.key);
	    	if(paying_money > $("#grand_total").val()){
	    		toastr.error("Paying money can not be exceeded the grand total");
	    		e.preventDefault();
	    	}
    	}	
    })
});