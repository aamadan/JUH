$(document).ready(function() {
	//Number validation
	$("body").on("keypress",".number",function(e){
		if ((e.which >=48 && e.which <=57) || e.which==46 ) {
		}
		else{
			e.preventDefault();
		}
	});
	$("body").on("keypress",".frequency",function(e){
		if ((e.which >=48 && e.which <=57) || e.which==88 || e.which==120 ) {
		}
		else{
			e.preventDefault();
		}
	});
});