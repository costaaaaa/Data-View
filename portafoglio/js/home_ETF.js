"use strict"
$(document).ready(function () {
    $('#titoloMore').hide();

    $("#showMore-btn-ETF").click(function () {
        if ($("#showMore-btn-ETF").val() == "Mostra tutti") {
            $("#showMore-btn-ETF").val("Nascondi");
            $("#moreETF").slideDown();
            $("#br").slideUp();
            $('#titoloMore').show();
        } else {
            $("#showMore-btn-ETF").val("Mostra tutti");
            $("#moreETF").slideUp();
            $("#br").slideDown();
            $('#titoloMore').hide();
        }
    });
    
    $("#cercaETF").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#ETF *").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        $("#moreETF *").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});