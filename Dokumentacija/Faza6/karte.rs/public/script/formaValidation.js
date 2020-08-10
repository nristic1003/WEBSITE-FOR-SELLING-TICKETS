$(document).ready(function(){
    $title = $("#naslov").text();
	$("#dugmeForma").click(function(){
                //alert($title);
		
		$ime = $("#ime").val();
		if ($ime.length ==0) {
			$("#ime_error").css({"border":"1px solid red", "display":"block"});
			$("#ime").focus();
			return false;
		}
                else if ($ime.length > 0 && $ime.length < 20) {
                   $("#ime_error").css(
                           {
                                "margin-top": "5px",
                                "width": "100%",
                                "font-size": "18px",
                                "color": "#C62828",
                                "background": "rgba(255,0,0,0.1)",
                                "text-align": "center",
                                "border-radius": "3px",
                                "border": "1px solid #EF9A9A",
                                "display":"none"});
                }
                
                $prezime = $("#prezime").val();
		if ($prezime.length ==0) {
			$("#ime_error").css({"border":"1px solid red", "display":"block"});
			$("#ime").focus();
                        
			return false;
		}
                 else if ($prezime.length > 0 && $prezime.length < 20) {
                   $("#ime_error").css(
                           {
                                "margin-top": "5px",
                                "width": "100%",
                                "font-size": "18px",
                                "color": "#C62828",
                                "background": "rgba(255,0,0,0.1)",
                                "text-align": "center",
                                "border-radius": "3px",
                                "border": "1px solid #EF9A9A",
                                "display":"none"});
                }
                
                $email = $("#email").val();
		if (IsEmail($email)==false) {
			$("#email_error").css({"border":"1px solid red", "display":"block"});
			$("#email").focus();
			return false;
		}
                else if (IsEmail($email)) {
                   $("#email_error").css(
                           {
                                "margin-top": "5px",
                                "width": "100%",
                                "font-size": "18px",
                                "color": "#C62828",
                                "background": "rgba(255,0,0,0.1)",
                                "text-align": "center",
                                "border-radius": "3px",
                                "border": "1px solid #EF9A9A",
                                "display":"none"});
                }
                
                
                if($title=="Registracija"){
                $korime = $("#korime").val();
		if ($korime.length ==0) {
			$("#korime_error").css({"border":"1px solid red", "display":"block"});
			$("#korime").focus();
			return false;
		}
                else if ($korime.length > 0 && $korime.length < 15) {
                   $("#korime_error").css(
                           {
                                "margin-top": "5px",
                                "width": "100%",
                                "font-size": "18px",
                                "color": "#C62828",
                                "background": "rgba(255,0,0,0.1)",
                                "text-align": "center",
                                "border-radius": "3px",
                                "border": "1px solid #EF9A9A",
                                "display":"none"});
                }
            }
                
                if($title=="Registracija"){
                $sifra = $("#sifra").val();
                $ponsifra = $("#ponsifra").val();
		if ($sifra.length ==0 || $ponsifra.length==0) {
			$("#sifra_error").css({"border":"1px solid red", "display":"block"});
			if($sifra.length==0)
                            $("#sifra").focus();
                        else if($ponsifra.length==0)
                            $("#ponsifra").focus();
                        else
                            $("#sifra").focus();
			return false;
                    }
                else if($sifra!=$ponsifra)
                {
                    $("#nsifra_error").css({"border":"1px solid red", "display":"block"});
                    $("#nsifra_error").focus();
                    return false;  
                }
                if ( ($ponsifra.length > 0 && $ponsifra.length < 20) && ($sifra.length >0 && $sifra.length < 20)) {
                   $("#sifra_error").css(
                           {
                                "margin-top": "5px",
                                "width": "100%",
                                "font-size": "18px",
                                "color": "#C62828",
                                "background": "rgba(255,0,0,0.1)",
                                "text-align": "center",
                                "border-radius": "3px",
                                "border": "1px solid #EF9A9A",
                                "display":"none"});
                }
                 if ($sifra==$ponsifra) {
                   $("#nsifra_error").css(
                           {
                                "margin-top": "5px",
                                "width": "100%",
                                "font-size": "18px",
                                "color": "#C62828",
                                "background": "rgba(255,0,0,0.1)",
                                "text-align": "center",
                                "border-radius": "3px",
                                "border": "1px solid #EF9A9A",
                                "display":"none"});
                }
            }
                
                $telefon = $("#telefon").val();
		if (isPhoneNumber($telefon)==false) {
			$("#telefon_error").css({"border":"1px solid red", "display":"block"});
			$("#telefon").focus();
			return false;
		}
                else if (isPhoneNumber($telefon)) {
                   $("#telefon_error").css(
                           {
                                "margin-top": "5px",
                                "width": "100%",
                                "font-size": "18px",
                                "color": "#C62828",
                                "background": "rgba(255,0,0,0.1)",
                                "text-align": "center",
                                "border-radius": "3px",
                                "border": "1px solid #EF9A9A",
                                "display":"none"});
                }
                
                
                
                
                
                $brlk = $("#brlk").val();
		if ($brlk.length ==0 || !($brlk.length ==9)) {
			$("#brlk_error").css({"border":"1px solid red", "display":"block"});
			$("#brlk").focus();
                        
			return false;
		}
                 else if ($brlk.length==9) {
                   $("#brlk_error").css(
                           {
                                "margin-top": "5px",
                                "width": "100%",
                                "font-size": "18px",
                                "color": "#C62828",
                                "background": "rgba(255,0,0,0.1)",
                                "text-align": "center",
                                "border-radius": "3px",
                                "border": "1px solid #EF9A9A",
                                "display":"none"});
                }
                
                $grad = $("#grad").val();
		if ($grad.length == 0 || $grad.length>15) {
			$("#grad_error").css({"border":"1px solid red", "display":"block"});
			$("#grad").focus();
                        
			return false;
		}
                 else if ($grad.length>0 && $grad.length<15) {
                   $("#grad_error").css(
                           {
                                "margin-top": "5px",
                                "width": "100%",
                                "font-size": "18px",
                                "color": "#C62828",
                                "background": "rgba(255,0,0,0.1)",
                                "text-align": "center",
                                "border-radius": "3px",
                                "border": "1px solid #EF9A9A",
                                "display":"none"});
                }
                
                $adresa = $("#adresa").val();
		if ($adresa.length == 0 || $adresa.length>30) {
			$("#adresa_error").css({"border":"1px solid red", "display":"block"});
			$("#adresa").focus();
                        
			return false;
		}
                 else if ($adresa.length>0 && $adresa.length<30) {
                   $("#adresa_error").css(
                           {
                                "margin-top": "5px",
                                "width": "100%",
                                "font-size": "18px",
                                "color": "#C62828",
                                "background": "rgba(255,0,0,0.1)",
                                "text-align": "center",
                                "border-radius": "3px",
                                "border": "1px solid #EF9A9A",
                                "display":"none"});
                }
                
                
                
         
                
                

	});
        
  
        
	$("#ime").keypress(function(){
		$ime = $("#ime").val();
		if ($ime.length > 0 && $ime.length < 20) {
			$("#ime_error").css("display", "none");
		}
	});
        
        $("#prezime").keypress(function(){
		$prezime = $("#prezime").val();
		if ($prezime.length > 0 && $prezime.length < 20) {
			$("#ime_error").css("display", "none");
		}
	});
        $("#email").keypress(function(){
		$email = $("#email").val();
		if (IsEmail($email)) {
			$("#email_error").css("display", "none");
		}
	});
        
        $("#korime").keypress(function(){
		$korime = $("#korime").val();
		if (IsEmail($email)) {
			$("#korime_error").css("display", "none");
		}
	});
        
           $("#sifra").keypress(function(){
		$sifra = $("#sifra").val();
                $ponsifra = $("#ponsifra").val();
		if (($ponsifra.length > 0 && $ponsifra.length < 20) && ($sifra.length >0 && $sifra.length < 20) && $sifra==$ponsifra){
			$("#sifra_error").css("display", "none");
                        $("#nsifra_error").css("display", "none");
		}
	});
        
        $("#ponsifra").keypress(function(){
                $sifra = $("#sifra").val();
                $ponsifra = $("#ponsifra").val();
		if (($ponsifra.length > 0 && $ponsifra.length < 20) && ($sifra.length >0 && $sifra.length < 20) && $sifra==$ponsifra) {
			$("#sifra_error").css("display", "none");
                        $("#nsifra_error").css("display", "none");
		}
	});
        
            $("#telefon").keypress(function(){
		$telefon = $("#telefon").val();
		if (isPhoneNumber($telefon)) {
			$("#telefon_error").css("display", "none");
		}
	});
        
        
        $("#brlk").keypress(function(){
                $brlk = $("#brlk").val();
		if ($brlk.length==9) {
			$("#brlk_error").css("display", "none");
		}
	});
        
        
        $("#grad").keypress(function(){
                $grad = $("#grad").val();
		if ($grad.length>0 && $grad.length<15) {
			$("#grad_error").css("display", "none");
		}
	});
        
        
        $("#adresa").keypress(function(){
                $adresa = $("#adresa").val();
		if ($adresa.length>0 && $adresa.length<30) {
			$("#adresa_error").css("display", "none");
		}
	});
        
        
});



 function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(!regex.test(email)) {
    return false;
  }else{
    return true;
  }
}

 function isPhoneNumber(number) {
  var regex = /^(\+381-|\+381|0)?\d{9}$/;
  if(!regex.test(number)) {
    return false;
  }else{
    return true;
  }
}

