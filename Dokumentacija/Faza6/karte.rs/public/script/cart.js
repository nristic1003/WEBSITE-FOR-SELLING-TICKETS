$(document).ready(function(){
    $(".ukorpi").each(function() {
        $(this).text("\u2713");
    });
});

$(window).on('load', function(){

    var $addbuttons = jQuery('.btn')
    $addbuttons.click(function(){
        var cart = $('#shopping-cart');
        var imgtodrag = $(this).parent().parent().find("#slikaIndex").find("img").eq(0);



        $(this).text("\u2713");
        $link = $(this).attr('link');
        $.ajax({
            url: $link,
            cache: false,
            type: 'POST', // GET or POST
            //data: 'add=', // will be in $_POST on PHP side
            success: function(data) { // data is the response from your php script
                if(data == 1)
                {
                    if (imgtodrag) {
                        var imgclone = imgtodrag.clone()
                            .offset({
                                top: imgtodrag.offset().top,
                                left: imgtodrag.offset().left
                            })
                            .css({
                                'opacity': '0.8',
                                'position': 'absolute',
                                'height': '150px',
                                'width': '150px',
                                'z-index': '100'
                            })
                            .appendTo($('body'))
                            .animate({
                                'top': cart.offset().top + 40,
                                'left': cart.offset().left + 50,
                                'width': 75,
                                'height': 75
                            }, 1000, 'easeInOutExpo');
                        setTimeout(function () {
                            cart.effect("shake", {
                                times: 2
                            }, 200);
                        }, 1500);
                        imgclone.animate({
                            'width': 0,
                            'height': 0
                        }, function () {
                            $(this).detach()
                        });
                    }
                    $num = "";
                    $tekst = $("#korpaUkupno").text();
                    if($tekst.length == 0) {
                        $num = "(1)";
                    }
                    else {
                        $tekst = $tekst.replace("(","").replace(")","");
                        $num = parseInt($tekst);
                        $num++;
                        $num = "(" + $num + ")";
                    }
                    $("#korpaUkupno").text($num);
                }
                // This function is called if your AJAX query was successful
                //alert("Response is: " + data);
            },
            error: function() {
                // This callback is called if your AJAX query has failed
                //alert("Error!");
            }
        });
    });
    var $cartbuttons = jQuery('.dugmecart')
    $cartbuttons.click(function(){

        $kol = $(this).attr('kol');
        $cena = $(this).attr('cena');
        $iddog = $(this).attr('iddog');
        $opt = $(this).attr('opt');
        $suma = parseInt($("#suma").text());

        if($opt == 0)
        {
            $kol++;
            $(this).next().attr('kol', $kol);
            $suma += parseInt($cena);
            $("#suma").text($suma);
        }
        else
        {
            if($kol > 1)
            {
                $kol = $kol - 1;
                $suma -= parseInt($cena);
                $(this).prev().attr('kol', $kol);
                $("#suma").text($suma)
            }

        }

        $cena = $kol * $cena;
        $(this).attr('kol', $kol);
        $("#kol"+$iddog).text($kol);
        $("#cena"+$iddog).text($cena);
        /*document.getElementById("kol" + $iddog).innerHTML = $kol;
        document.getElementById("cena" + $iddog).innerHTML = $cena;*/

        $link = $(this).attr('link');
        $.ajax({
            url: $link,
            cache: false,
            type: 'POST', // GET or POST
            //data: 'add=', // will be in $_POST on PHP side
            success: function(data) { // data is the response from your php script
                // This function is called if your AJAX query was successful
                //alert("Response is: " + data);
            },
            error: function() {
                // This callback is called if your AJAX query has failed
                //alert("Error!");
            }
        });
    });

    var $delbuttons = jQuery('.dugmecartdel')
    $delbuttons.click(function(){
        $tekst = $("#korpaUkupno").text();
        $tekst = $tekst.replace("(","").replace(")","");
        $num = parseInt($tekst);
        $num--;
        if($num == 0)
            $num = "";
        else
            $num = "(" + $num + ")";
        $("#korpaUkupno").text($num);
        $iddog = $(this).attr('iddog');
        $("#" + $iddog).css("display", "none");

        $link = $(this).attr('link');
        $suma = parseInt($("#suma").text());
        $minus = parseInt($("#cena"+$iddog).text());
        $suma -= $minus;
        $("#suma").text($suma);

        $.ajax({
            url: $link,
            cache: false,
            type: 'POST', // GET or POST
            //data: 'add=', // will be in $_POST on PHP side
            success: function(data) { // data is the response from your php script
                // This function is called if your AJAX query was successful
                //alert("Response is: " + data);
            },
            error: function() {
                // This callback is called if your AJAX query has failed
                //alert("Error!");
            }
        });
    });



});