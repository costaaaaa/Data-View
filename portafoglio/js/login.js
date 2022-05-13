$(document).ready(function () {
    $('#errore').hide();
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    var res = urlParams.get('res');
    console.log(res);

    switch (res) {
        case 'error':
            var azione = urlParams.get('azione');
            switch (azione) {
                case "acquisto":
                    $('#errore').append('Richiesto log-in per effettuare acquisti');
                    $('#errore').show();
                    console.log("Richiesto login per acquisti");
                    break;
                case "login":
                    $('#errore').append('Email o password errati');
                    $('#errore').show();
                    console.log("Email o password errati");
                    break;
                case "vendita":
                    $('#errore').append('Richiesto log-in per effettuare vendite');
                    $('#errore').show();
                    console.log("Richiesto login per vendere");
                    break;
                default:
                    $('#errore').hide();
                    break;
            }
            break;
        default:
            $('#errore').hide();
            break;
    }
});