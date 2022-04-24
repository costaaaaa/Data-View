$(document).ready(function () {
    $('#errore').hide();
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    var res = urlParams.get('res');
    console.log(res);

    switch (res) {
        case 'error':
            $('#errore').append('Email o password errati');
            $('#errore').show();
            console.log("Errore");
            break;
    
        default:
            $('#errore').hide();
            break;
    }
});