$(document).ready(function(){
    $("#kupi").click(function() {
        $brkart = $("#brkartice").val();
        $god = $("#kartgod").val();
        $mesec = $("#kartmesec").val();
        $cvc = $("#kartcvc").val();

        if($.isNumeric($brkart)&& $.isNumeric($brkart)&& $.isNumeric($brkart)&&$.isNumeric($brkart)
        && $brkart.length == 16 && $god.length == 4 && parseInt($mesec) < 13  && parseInt($mesec) > 0 && $cvc.length == 3)
        {
            $("#kart_error").css({"display":"none"});
        }
        else {
            $("#kart_error").css({"border":"1px solid red", "display":"block", "margin-bottom":"10px"});
            return false;
        }

    });
});