$(document).ready(function() {
    $(".confirm").click(function (e) {
        var txt = $(this).data("txt");
        txt = (txt == undefined ) ? "Operacja wymaga potwierdzenia" : txt;
        var c =  confirm(txt);
        if (c == true){

        } else{
            return false;
        }
    });



});