$(document).ready(function(){
	//frm_prouct_purchase.php
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
    	$("#purchase_total").val(total);
    	if ($("#purchase_discount").val()) {
    		var purchase_discount=parseFloat($("#purchase_discount").val());
    		var purchase_total=parseFloat($("#purchase_total").val());
    		var grand_total=purchase_total - purchase_discount;
    		$("#purchase_grand_total").val(grand_total);
    		$("#purchase_rest").val(grand_total);
    	}
    	else{
    		$("#purchase_grand_total").val($("#purchase_total").val());
    		$("#purchase_rest").val($("#purchase_total").val());
    	}
    });

    // $("body").on("keydown","#purchase_discount",function(e){
    // 	e.preventDefault();
    // })

    $("body").on("change","#purchase_discount",function(){
    	if ($("#purchase_total").val()) {
    		if ($(this).val()) {
	    		var purchase_discount=parseFloat($(this).val());
	    		var purchase_total=parseFloat($("#purchase_total").val());
	    		var grand_total=purchase_total - purchase_discount;
	    		$("#purchase_grand_total").val(grand_total);
	    		if ($("#purchase_paid").val()) {
		    		var purchase_paid=parseFloat($("#purchase_paid").val());
		    		var grand_total=parseFloat($("#purchase_grand_total").val());
		    		var rest=grand_total - purchase_paid;
		    		$("#purchase_rest").val(rest);
	    		}
		    	else{
		    		$("#purchase_rest").val($("#purchase_grand_total").val());
		    	}
    		}
    		else if($("#purchase_paid").val() && $(this).val() == ""){
    			$("#purchase_grand_total").val($("#purchase_total").val());
    			var purchase_paid=parseFloat($("#purchase_paid").val());
		    	var grand_total=parseFloat($("#purchase_grand_total").val());
		    	var rest=grand_total - purchase_paid;
		    	$("#purchase_rest").val(rest);
    		}
	    	else if($(this).val() == ""){
	    		$("#purchase_grand_total").val($("#purchase_total").val());
	    		$("#purchase_rest").val($("#purchase_total").val());
	    	}
    	}    	
    });
    $("body").on("keyup","#purchase_discount",function(){
    	if ($("#purchase_total").val()) {
    		if ($(this).val()) {
	    		var purchase_discount=parseFloat($(this).val());
	    		var purchase_total=parseFloat($("#purchase_total").val());
	    		var grand_total=purchase_total - purchase_discount;
	    		$("#purchase_grand_total").val(grand_total);
	    		if ($("#purchase_paid").val()) {
		    		var purchase_paid=parseFloat($("#purchase_paid").val());
		    		var grand_total=parseFloat($("#purchase_grand_total").val());
		    		var rest=grand_total - purchase_paid;
		    		$("#purchase_rest").val(rest);
	    		}
		    	else{
		    		$("#purchase_rest").val($("#purchase_grand_total").val());
		    	}
    		}
    		else if($("#purchase_paid").val()){
    			$("#purchase_grand_total").val($("#purchase_total").val());
    			var purchase_paid=parseFloat($("#purchase_paid").val());
		    	var grand_total=parseFloat($("#purchase_grand_total").val());
		    	var rest=grand_total - purchase_paid;
		    	$("#purchase_rest").val(rest);
    		}
	    	else if($(this).val() == ""){
	    		$("#purchase_grand_total").val($("#purchase_total").val());
	    		$("#purchase_rest").val($("#purchase_total").val());
	    	}
    	}    	
    });
    $("body").on("change","#purchase_paid",function(){
    	if ($("#purchase_grand_total").val()) {
    		if ($(this).val()) {
	    		var purchase_paid=parseFloat($(this).val());
	    		var grand_total=parseFloat($("#purchase_grand_total").val());
	    		var rest=grand_total - purchase_paid;
	    		$("#purchase_rest").val(rest);
    		}
	    	else{
	    		$("#purchase_rest").val($("#purchase_grand_total").val());
	    	}
    	}    	
    });
    $("body").on("keyup","#purchase_paid",function(){
    	if ($("#purchase_grand_total").val()) {
    		if ($(this).val()) {
	    		var purchase_paid=parseFloat($(this).val());
	    		var grand_total=parseFloat($("#purchase_grand_total").val());
	    		var rest=grand_total - purchase_paid;
	    		$("#purchase_rest").val(rest);
    		}
	    	else{
	    		$("#purchase_rest").val($("#purchase_grand_total").val());
	    	}
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
			if($("#customer_name").val() =="" || $("#sales_rest").val() > 0){
				if($("#customer_name").val() ==""){
					toastr.error("Please fill customer name");		
				}
				else if ($("#sales_rest").val() > 0) {
					toastr.error("Cash sales must be paid fully")
				}						
			}
			else{
				checked=1;
			}
		}
		else if ($("#sales_type").val()=="customer"){
			var balance=Number($("#current_balance").val());
			var rest=Number($("#sales_rest").val());
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
				if ($("#sales_rest").val() > 0) {
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
    	$("#sales_total").val(total);
    	if ($("#sales_discount").val()) {
    		var sales_discount=parseFloat($("#sales_discount").val());
    		var sales_total=parseFloat($("#sales_total").val());
    		var grand_total=sales_total - sales_discount;
    		$("#sales_grand_total").val(grand_total);
    		$("#sales_rest").val(grand_total);
    	}
    	else{
    		$("#sales_grand_total").val($("#sales_total").val());
    		$("#sales_rest").val($("#sales_total").val());
    	}
    });

    // $("body").on("keydown","#purchase_discount",function(e){
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
    $("body").on("change","#sales_discount",function(){
    	if ($("#sales_total").val()) {
    		if ($(this).val()) {
	    		var sales_discount=parseFloat($(this).val());
	    		var sales_total=parseFloat($("#sales_total").val());
	    		var grand_total=sales_total - sales_discount;
	    		$("#sales_grand_total").val(grand_total);
	    		if ($("#sales_paid").val()) {
		    		var sales_paid=parseFloat($("#sales_paid").val());
		    		var grand_total=parseFloat($("#sales_grand_total").val());
		    		var rest=grand_total - sales_paid;
		    		$("#sales_rest").val(rest);
	    		}
		    	else{
		    		$("#sales_rest").val($("#sales_grand_total").val());
		    	}
    		}
    		else if($("#sales_paid").val() && $(this).val() == ""){
    			$("#sales_grand_total").val($("#sales_total").val());
    			var sales_paid=parseFloat($("#sales_paid").val());
		    	var grand_total=parseFloat($("#sales_grand_total").val());
		    	var rest=grand_total - sales_paid;
		    	$("#sales_rest").val(rest);
    		}
	    	else if($(this).val() == ""){
	    		$("#sales_grand_total").val($("#sales_total").val());
	    		$("#sales_rest").val($("#sales_total").val());
	    	}
    	}    	
    });
    $("body").on("keyup","#sales_discount",function(){
    	if ($("#sales_total").val()) {
    		if ($(this).val()) {
	    		var sales_discount=parseFloat($(this).val());
	    		var sales_total=parseFloat($("#sales_total").val());
	    		var grand_total=sales_total - sales_discount;
	    		$("#sales_grand_total").val(grand_total);
	    		if ($("#sales_paid").val()) {
		    		var sales_paid=parseFloat($("#sales_paid").val());
		    		var grand_total=parseFloat($("#sales_grand_total").val());
		    		var rest=grand_total - sales_paid;
		    		$("#sales_rest").val(rest);
	    		}
		    	else{
		    		$("#sales_rest").val($("#sales_grand_total").val());
		    	}
    		}
    		else if($("#sales_paid").val()){
    			$("#sales_grand_total").val($("#sales_total").val());
    			var sales_paid=parseFloat($("#sales_paid").val());
		    	var grand_total=parseFloat($("#sales_grand_total").val());
		    	var rest=grand_total - sales_paid;
		    	$("#sales_rest").val(rest);
    		}
	    	else if($(this).val() == ""){
	    		$("#sales_grand_total").val($("#sales_total").val());
	    		$("#sales_rest").val($("#sales_total").val());
	    	}
    	}    	
    });
    $("body").on("change","#sales_paid",function(){
    	if ($("#sales_grand_total").val()) {
    		if ($(this).val()) {
	    		var sales_paid=parseFloat($(this).val());
	    		var grand_total=parseFloat($("#sales_grand_total").val());
	    		var rest=grand_total - sales_paid;
	    		$("#sales_rest").val(rest);
    		}
	    	else{
	    		$("#sales_rest").val($("#sales_grand_total").val());
	    	}
    	}    	
    });
    $("body").on("keyup","#sales_paid",function(){
    	if ($("#sales_grand_total").val()) {
    		if ($(this).val()) {
	    		var sales_paid=parseFloat($(this).val());
	    		var grand_total=parseFloat($("#sales_grand_total").val());
	    		var rest=grand_total - sales_paid;
	    		$("#sales_rest").val(rest);
    		}
	    	else{
	    		$("#sales_rest").val($("#sales_grand_total").val());
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
    	var total=Number($("#sales_total").val());
    	if($(this).is(":checked")){
			$(this).prop( "checked", true );
			total=total+amount;	
		}
		else{			
			$(this).prop( "checked", false );
			total=total-amount;		
		}
		$("#sales_total").val(total);
		$("#sales_discount").trigger("change");
    });
    //frm_purchase_return
    $("body").on("change","#supplier",function(){
    	var val=$(this).val();
    	var url="sys_res/purchase_supplier_invoice?supplier="+val;
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
    			$("#return_unit").empty();
    			$("#return_unit").append(data.options);
    			$("#purchasedQuantity").val(data.purchased_quantity);
    			$("#p_quantity").val(data.p_quantity);

    		}
    	})
    })
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
});