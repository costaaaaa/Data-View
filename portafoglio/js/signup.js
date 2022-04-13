$(document).ready(function () {
    $('#errore').hide();
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    var res = urlParams.get('res');
    console.log(res);

    switch (res) {
        case 'error':
            var string = urlParams.get('error');
            console.log(string);

            switch (string) {
                case 'email':
                    $('#errore').append('Email già registrata');
                    $('#errore').show();
                    break;
                case 'username':
                    $('#errore').append('Username già in uso');
                    $('#errore').show();
                    break;
                default:
                    break;
            }

            $('#errore').append(string);
            $('#errore').show();
            break;
    
        default:
            break;
    }
});