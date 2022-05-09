"use strict"
$(document).ready(function () {
    $('#titoloMore').hide();

    $("#showMore-btn").click(function () {
        if ($("#showMore-btn").val() == "Mostra tutti") {
            $("#showMore-btn").val("Nascondi");
            $("#allMore").slideDown();
            $("#br").slideUp();
            $('#titoloMore').show();
        } else {
            $("#showMore-btn").val("Mostra tutti");
            $("#allMore").slideUp();
            $("#br").slideDown();
            $('#titoloMore').hide();
        }
    });
    
    $("#cercaAzioni").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#azioni *").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        $("#allMore *").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});