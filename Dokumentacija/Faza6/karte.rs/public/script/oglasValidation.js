
$(document).ready(function(){
	$("#dugmeValid").click(function(){
                //alert("gagsdgs");
		
		$naziv = $("#naziv").val();
		if ($naziv.length ==0) {
			$("#naziv_error").css({"border":"1px solid red", "display":"block"});
			$("#naziv").focus();
			return false;
		}
                else if ($naziv.length > 0) {
                   $("#naziv_error").css(
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
                
                $brojkarata = $("#brojkarata").val();
		if ($brojkarata.length ==0) {
			$("#brojkarata_error").css({"border":"1px solid red", "display":"block"});
			$("#brojkarata").focus();
                        
			return false;
		}
                 else if ($brojkarata.length > 0) {
                   $("#brojkarata_error").css(
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
                
                $cena = $("#cena").val();
		if ($cena.length ==0) {
			$("#cena_error").css({"border":"1px solid red", "display":"block"});
			$("#cena").focus();
                        
			return false;
		}
                
                 else if ($cena.length > 0) {
                   $("#cena_error").css(
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
                
                $datum = $("#datum").val();
		if ($datum.length ==0) {
			$("#datum_error").css({"border":"1px solid red", "display":"block"});
			$("#datum").focus();
                        
			return false;
		}
                
                else if ($datum.length > 0) {
                   $("#datum_error").css(
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
                
                $vreme = $("#vreme").val();
		if ($vreme.length ==0) {
			$("#vreme_error").css({"border":"1px solid red", "display":"block"});
			$("#vreme").focus();
                        
			return false;
		}
                
                else if ($vreme.length > 0) {
                   $("#vreme_error").css(
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
                
                $lokacija = $("#lokacija").val();
		if ($lokacija.length ==0) {
			$("#lokacija_error").css({"border":"1px solid red", "display":"block"});
			$("#lokacija").focus();
                        
			return false;
		}
                
                else if ($lokacija.length > 0) {
                   $("#lokacija_error").css(
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

                
                
                
                if($('#slikaa').length ){
                $slikaa = $("#slikaa").val();
                 if ($slikaa) {
                   $("#slika_error").css(
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
                else{
			$("#slika_error").css({"border":"1px solid red", "display":"block"});
			$("#slikaa").focus();
                        
			return false;
		}
            }
                
                
                
	
                
                //Validacija za oglase :D
                
                
              
                
                
                
                //

	});
        
  
        
	$("#naziv").keypress(function(){
		$naziv = $("#naziv").val();
		if ($naziv.length > 0) {
			$("#naziv_error").css("display", "none");
		}
	});
        
        $("#brojkarata").keypress(function(){
		$brojkarata = $("#brojkarata").val();
		if ($brojkarata.length > 0) {
			$("#brojkarata_error").css("display", "none");
		}
	});
        
        $("#cena").keypress(function(){
		$cena = $("#cena").val();
		if ($cena.length > 0) {
			$("#cena_error").css("display", "none");
		}
	});
        
        
        
        
        $("#datum").keypress(function(){
		$datum = $("#datum").val();
		if ($datum.length > 0) {
			$("#datum_error").css("display", "none");
		}
	});
        
        
         $("#vreme").keypress(function(){
		$vreme = $("#vreme").val();
		if ($vreme.length > 0) {
			$("#vreme_error").css("display", "none");
		}
	});
        
        $("#lokacija").keypress(function(){
		$lokacija = $("#lokacija").val();
		if ($lokacija.length > 0) {
			$("#lokacija_error").css("display", "none");
		}
	});
        
        $("#telefon").keypress(function(){
		$telefon = $("#telefon").val();
		if (isPhoneNumber($telefon)) {
			$("#telefon_error").css("display", "none");
		}
	});
        
        
       
          $("#slikaa").click(function(){
		$slikaa = $("#slikaa").val();
		if ($slikaa) {
			$("#slika_error").css("display", "none");
		}
	});
    
        
   function isPhoneNumber(number) {
  var regex = /^(\+381-|\+381|0)?\d{9}$/;
  if(!regex.test(number)) {
    return false;
  }else{
    return true;
  }
}
                
         

        
        

});


