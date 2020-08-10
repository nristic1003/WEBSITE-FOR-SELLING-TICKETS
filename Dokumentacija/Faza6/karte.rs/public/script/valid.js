
$(document).ready(function(){
	$("#dugme").click(function(){
		$email = $("#korime").val();
		if ($email.length ==0) {
			$("#email_error").css({"border":"1px solid red", "display":"block"});
			$("#korime").focus();
			return false;
		}
		$pass = $("#lozinka").val();
		if ($pass.length ==0) {
			$("#pass_error").css({"border":"1px solid red", "display":"block"});
			$("#lozinka").focus();
			return false;
		}

	});
	$("#korime").keypress(function(){
		$email = $("#korime").val();
		if ($email.length > 8) {
			$("#email_error").css("display", "none");
		}
	});

	$("#lozinka").keypress(function(){
		$pass = $("#lozinka").val();
		if ($pass.length  >0) {
			$("#pass_error").css("display", "none");
		}
	});

});
