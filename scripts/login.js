$(document).ready(function() {
	$("form").submit(function(e){
		e.preventDefault();
		$.post("login.php",$(this).serialize(),function(data){
			if(data=="success"){
				window.location.href = "index.php";
			}
			else{
				console.log("This is wrong")
				console.log(data);
				$(".placeholder").text(data);
				$(".placeholder").addClass("bg-danger");
				$(".placeholder").addClass("text-light");
			}
		})
	});
});