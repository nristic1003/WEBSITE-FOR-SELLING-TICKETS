$(document).ready(function () {

 $(".icon").click(function () {
   var x = $("#nav");

   if (x.css("display") === "block") {
     x.css({"display": "none"});
   } else {
       x.css({"display": "block"});
   }
 });

    $(window).resize(function () {
        var w = window.innerWidth;
        var x = $("#nav");
        if(w>768) x.css({"display": "block"});
    });

    $("a[aria-label='Next']").css({"display":"none"});
    $("a[aria-label='Last']").css({"display":"none"});
    $("a[aria-label='Previous']").css({"display":"none"});
    $("a[aria-label='First']").css({"display":"none"});

 });


