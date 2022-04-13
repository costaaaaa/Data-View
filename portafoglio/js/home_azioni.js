"use strict"
$(document).ready(function () {
    var l = 0;
    $('#titoloMore').hide();
    $('#succ-btn').hide();
    $('#prec-btn').hide();
    $('#allMore').hide();
    //$('#allMore').hide();
    console.log('Documento pronto');
    
    $("#showMore-btn").click(function () {
        if ($("#showMore-btn").val() == "Mostra tutti") {
            l = 0;
            for (let i = 0; i < 100; i++) {
                var app = "more" + i;
                var more = document.getElementById(app);
                $(more).hide();
            }
            $("#showMore-btn").val("Nascondi");
            $("#more0").show();
            //$("#br").hide();
            $("#br").slideUp();
            $('#titoloMore').show();
            $('#succ-btn').show();
        
        }else{
            l = 0;
            $("#showMore-btn").val("Mostra tutti");
            $("#allMore").slideUp();
            $("#br").slideDown();
            $('#titoloMore').hide();
            $('#prec-btn').hide();
            $('#succ-btn').hide();
        }
    });

    $('#btn-grafico').click(function () { 
        $('#btn-grafico').val("Aggiorna grafico");
    });

    $("#cercaAzioni").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#azioni *").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        $("#allMore *").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $('#succ-btn').click(function (e) { 
        $('#prec-btn').show();
        var app = "more" + l;
        var l2 = l + 1;
        var app2 = "more" + l2;
        var moreAtt = document.getElementById(app);
        var moreSucc = document.getElementById(app2);
        $(moreSucc).show();
        $(moreAtt).hide();
        //$(moreSucc).slideDown();
        l = l + 1;
        if (l > 0) {
            $('#prec-btn').show();
        }
        console.log(l);
    });

    $('#prec-btn').click(function (e) {
        var app = "more" + l;
        var l2 = l - 1;
        var app2 = "more" + l2;
        var moreAtt = document.getElementById(app);
        var morePrec = document.getElementById(app2);
        $(moreAtt).hide();
        $(morePrec).show();
        l = l - 1;
        if (l = 0) {
            $('#prec-btn').hide();
        }
        console.log(l);
    });
});