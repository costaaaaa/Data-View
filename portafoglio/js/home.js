$(document).ready(function () {
    $('#linkAccount').hide();

    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    var res = urlParams.get('res');
    var login = urlParams.get('login');
    console.log('res: ' + res);
    console.log('Login: ' + login);

    switch (res) {
        case 'error':
            console.log("error");
            break;
        case 'success':
            if (login == 'true') {
                $('#linkLogin').hide();
                $('#linkSignup').hide();
                $('#linkAccount').show();
            } else {
                $('#linkLogin').show();
                $('#linkSignup').show();
                $('#linkAccount').hide();
            }
            break;
        case 'logout':
            break;
        default:
            console.log('switch default');
            $('#linkLogin').show();
                $('#linkSignup').show();
                $('#linkAccount').hide();
            break;
    }
});