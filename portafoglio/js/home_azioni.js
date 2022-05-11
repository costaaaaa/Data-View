"use strict"
$(document).ready(function () {
    $('#titoloMore').hide();

    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    var res = urlParams.get('res');
    console.log(res);

    switch (res) {
        case 'error':
            var queryString = window.location.search;
            var urlParams = new URLSearchParams(queryString);
            var azione = urlParams.get('azione');
            if (azione == "acquisto") {
                alert("Devi effettuare il login");
                console.log("Login da effettuare");
            }
            console.log("Error");
            break;
        case 'success':
            var queryString = window.location.search;
            var urlParams = new URLSearchParams(queryString);
            var azione = urlParams.get('azione');

            console.log("Success");

            switch(azione){
                case "acquisto":
                    //alert("Acquisto effettuato con successo!");
                    $('#modal-acquisto-success').modal("show")
                    /* link per alert bootstrap da integrare: https://getbootstrap.com/docs/4.0/components/modal/ */
                    console.log("Acquisto effettuato");
                break;
            }
            break;
        default:
            console.log("Nessun messaggio da parte dell'API");
            break;
    }
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