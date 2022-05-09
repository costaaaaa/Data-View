"use strict"
var obj;
let graficoCaricato = false;

function grafico(simbolo) {
    let interval;
    let range = document.getElementById("range").value;
    let numInterval;
    const myChart = document.getElementById('myChart');


    switch (range) {
        case 'Giornaliero':
            range = '1d';
            interval = '1h';
            numInterval = 24;
            break;
        case 'Mensile':
            range = '1mo';
            interval = '1d';
            numInterval = 30;
            break;
        case 'Annuale':
            range = '1y';
            interval = '1d';
            numInterval = 365;
            break;
        case '5 anni':
            range = '5y';
            interval = '1mo'
            numInterval = 60;
            break;
        case '10 anni':
            range = '10y';
            interval = '1mo';
            numInterval = 120;
            break;
        default:
            range = '1mo';
            interval = '1d';
            numInterval = 30;
            break;
    }
    let graf = document.getElementById('myChart');
    graf.innerHTML = "";

    const settings = {
        "async": true,
        "crossDomain": true,
        "url": "https://yh-finance.p.rapidapi.com/stock/v3/get-chart?interval=" + interval + "&symbol=" + simbolo + "&range=" + range + "&region=US&includePrePost=false&useYfid=true&includeAdjustedClose=true&events=capitalGain%2Cdiv%2Csplit",
        "method": "GET",
        "headers": {
            "x-rapidapi-key": "2fbe7ee09amshf71ce9aa01eb1f1p121372jsnd2af913090f2",
            "x-rapidapi-host": "yh-finance.p.rapidapi.com"
        }
    };
    //var obj;
    $.ajax(settings).done(function (response) {
        console.log(response);
        obj = response.chart.result[0].indicators.quote[0].close;
        console.log(obj);

        let array = [];
        for (let i = 0; i < numInterval; i++) {
            array[i] = i + 1;
        }
        const labels = array;

        const data = {
            labels: labels,
            datasets: [{
                label: 'Prezzo',
                backgroundColor: 'rgb(255, 255, 255)',
                borderColor: 'rgb(51, 153, 255)',
                data: obj
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {}
        };
        $('#myChart').remove();
        $('#containerGrafico').append('<canvas id="myChart"></canvas>');
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    });

    //if (graficoCaricato == false) {
        //initAzione(simbolo);
        //graficoCaricato = true;
    //}
    
    var fogli = document.styleSheets;
    console.log(fogli);

    var cssIndex = document.styleSheets[6];
    if (cssIndex) {
            cssIndex.insertRule("#containerGrafico{ box-shadow: 10px 10px 5px #dedede; }");
    }

    console.log('Grafico caricato con un range di: '+ range);
}

function initHomeAzione() {
    $('#allMore').hide();
    $('#caricamento').show();
    const settings = {
        "async": false, //true
        "crossDomain": true,
        "url": "https://financialmodelingprep.com/api/v3/stock-screener?marketCapMoreThan=1000000000&exchange=NASDAQ&apikey=bc3331aa94ecabb46567958f34751ccd",
        "method": "GET"
    };
    var obj;
    $.ajax(settings).done(function (response) {
        console.log(response);

        var k = 0;
        for (let i = 0; i < response.length; i++) {
            
            if (i < 15) {
                $('#azioni').append(`<div class="col-md-6 col-lg-4">
            <a class="d-block mx-auto portfolio-item" data-toggle="modal" href="#portfolio-modal-`+ i + `">
                        <div class="d-flex portfolio-item-caption position-absolute h-100 w-100">
                            <div class="my-auto portfolio-item-caption-content w-100 text-center text-white">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div><br /><br /><br /><br />
                        <h1>`+ response[i].companyName + `<br /></h1><br /><br /><br />
                    </a>
                </div>`);
            } else if (i == 15) {
                $('#azioni').append(`<div class="col-md-6 col-lg-4 mx-auto">
            <a class="d-block mx-auto portfolio-item" data-toggle="modal" href="#portfolio-modal-`+ i + `">
                        <div class="d-flex portfolio-item-caption position-absolute h-100 w-100">
                            <div class="my-auto portfolio-item-caption-content w-100 text-center text-white">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div><br /><br /><br /><br />
                        <h1>`+ response[i].companyName + `<br /></h1><br /><br /><br />
                    </a>
                </div>`);
            }
            else if (i > 15) {
                /* if ((i % 15)==0) {
                    k++;
                    $("#allMore").append(`<div class="row" id="more`+k+`" style="display: none;"></div>`);
                }
                var app = "more" + k;
                var more = document.getElementById(app); */
                $("#allMore").append(`<div class="col-md-6 col-lg-4">
            <a class="d-block mx-auto portfolio-item" data-toggle="modal" href="#portfolio-modal-`+ i + `">
                        <div class="d-flex portfolio-item-caption position-absolute h-100 w-100">
                            <div class="my-auto portfolio-item-caption-content w-100 text-center text-white">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div><br /><br /><br /><br />
                        <h1>`+ response[i].companyName + `<br /></h1><br /><br /><br />
                    </a>
                </div>`);
            }

            if (i == 9) {
                $('#titoloMore').append('<h3 class="text-uppercase text-center text-secondary">Tutti i titoli</h3>');
                /* $('#showMore-div').append(`<div class="col-md-6 col-lg-4 float-left">
                    <input type="submit" value="Precedente" id="prec-btn" class="btn btn-primary">
                    </div>`);
                $('#showMore-div').append(`<div class="col-md-6 col-lg-4 float-right">
                    <input type="submit" value="Successivo" id="succ-btn" class="btn btn-primary">
                    </div>`); */
                $('#showMore-div').append(`<div class="col-md-6 col-lg-4 mx-auto">
                    <input type="submit" value="Mostra tutti" id="showMore-btn" class="btn btn-primary">
                    </div>`);
                
            }

            $('#finestre').append(`<div class="modal text-center" role="dialog" tabindex="-1" id="portfolio-modal-` + i + `">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container text-center">
                                <div class="row">
                                    <div class="col-lg-8 mx-auto">
                                        <h2 class="text-uppercase text-secondary mb-0">`+ response[i].companyName + `</h2>
                                        <hr class="star-dark mb-5 mx-auto">
            
                                        <form action="./azione.php" method="POST">
                                            <input type="hidden" name="action" value="newPage">
                                            <input type="hidden" name="nome" value="`+ response[i].companyName + `">
                                            <input type="hidden" name="simbolo" value="`+ response[i].symbol + `">
                                            <button class="btn btn-primary btn-lg mx-auto rounded-pill portfolio-modal-dismiss"
                                                type="submit">
                                                Dati aggiuntivi
                                            </button>
                                            <br />
                                            <br />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer pb-5"></div>
                    </div>
                </div>`);
        }
        console.log(obj);
    });
    $('#caricamento').hide();
}

function initHomeETF() {
    $('#moreETF').hide();
    const settings = {
        "async": false, //true
        "crossDomain": true,
        "url": "https://financialmodelingprep.com/api/v3/etf/list?apikey=bc3331aa94ecabb46567958f34751ccd",
        "method": "GET"
    };
    var obj;
    $.ajax(settings).done(function (response) {
        console.log(response);


        for (let i = 0; i < response.length; i++) {

            if (i < 15) {
                $('#ETF').append(`<div class="col-md-6 col-lg-4">
            <a class="d-block mx-auto portfolio-item" data-toggle="modal" href="#portfolio-modal-`+ i + `">
                        <div class="d-flex portfolio-item-caption position-absolute h-100 w-100">
                            <div class="my-auto portfolio-item-caption-content w-100 text-center text-white">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div><br /><br /><br /><br />
                        <h1>`+ response[i].name + `<br /></h1><br /><br /><br />
                    </a>
                </div>`);
            } else if (i == 15) {
                $('#ETF').append(`<div class="col-md-6 col-lg-4 mx-auto">
            <a class="d-block mx-auto portfolio-item" data-toggle="modal" href="#portfolio-modal-`+ i + `">
                        <div class="d-flex portfolio-item-caption position-absolute h-100 w-100">
                            <div class="my-auto portfolio-item-caption-content w-100 text-center text-white">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div><br /><br /><br /><br />
                        <h1>`+ response[i].name + `<br /></h1><br /><br /><br />
                    </a>
                </div>`);
            }
            else if (i > 15) {
                $('#moreETF').append(`<div class="col-md-6 col-lg-4">
            <a class="d-block mx-auto portfolio-item" data-toggle="modal" href="#portfolio-modal-`+ i + `">
                        <div class="d-flex portfolio-item-caption position-absolute h-100 w-100">
                            <div class="my-auto portfolio-item-caption-content w-100 text-center text-white">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div><br /><br /><br /><br />
                        <h1>`+ response[i].name + `<br /></h1><br /><br /><br />
                    </a>
                </div>`);
            }

            if (i == 9) {
                $('#titoloMore').append('<h3 class="text-uppercase text-center text-secondary">Tutti gli ETF</h3>');
                $('#showMore-div').append(`<div class="col-md-6 col-lg-4 mx-auto"><input type="button" value="Mostra tutti" id="showMore-btn-ETF" class="btn btn-primary"></div>`);
            }

            $('#finestre').append(`<div class="modal text-center" role="dialog" tabindex="-1" id="portfolio-modal-` + i + `">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container text-center">
                                <div class="row">
                                    <div class="col-lg-8 mx-auto">
                                        <h2 class="text-uppercase text-secondary mb-0">`+ response[i].name + `</h2>
                                        <hr class="star-dark mb-5 mx-auto">
            
                                        <form action="./ETF.php" method="POST">
                                            <input type="hidden" name="action" value="newPage">
                                            <input type="hidden" name="nome" value="`+ response[i].name + `">
                                            <input type="hidden" name="simbolo" value="`+ response[i].symbol + `">
                                            <button class="btn btn-primary btn-lg mx-auto rounded-pill portfolio-modal-dismiss"
                                                type="submit">
                                                Dati aggiuntivi
                                            </button>
                                            <br />
                                            <br />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer pb-5"></div>
                    </div>
                </div>`);
        }
        console.log(obj);
    });
}

function initAzione(simbolo) {
    document.getElementById("range").value = "Mensile";
    grafico(simbolo);
    let data = document.getElementById('dati-azione');
    if (data != "") {
        /*
                const settings = {
                    "async": true,
                    "crossDomain": true,
                    "url": "https://yh-finance.p.rapidapi.com/stock/v3/get-chart?interval=1d&symbol=" + simbolo + "&range=1d&region=US&includePrePost=false&useYfid=true&includeAdjustedClose=true&events=capitalGain%2Cdiv%2Csplit",
                    "method": "GET",
                    "headers": {
                        "x-rapidapi-key": "2fbe7ee09amshf71ce9aa01eb1f1p121372jsnd2af913090f2",
                        "x-rapidapi-host": "yh-finance.p.rapidapi.com"
                    }
                };
                //var obj;
                $.ajax(settings).done(function (response) {
                    console.log(response);
                    obj = response.chart.result[0];
                    console.log('Dati azione giornalieri')
                    console.log(obj);
                    //$('#dati-azione').remove();
                
                    data.innerHTML = "";
                    $('#container').append(`<div id="dati-azione"></div>`);
                    $('#dati-azione').append(`<br/><br/><label>Currency: ` + obj.meta.currency + `</label><br/>
                    <label>Price: ` + obj.meta.regularMarketPrice + `</label><br/>
                    <label>Symbol: ` + obj.meta.symbol + `</label><br/>
                    <label>Volume: ` + obj.indicators.quote[0].volume + `</label><br/>`);
                });
        */

        const settings = {
            "async": true,
            "crossDomain": true,
            "url": "https://financialmodelingprep.com/api/v3/profile/" + simbolo + "?apikey=bc3331aa94ecabb46567958f34751ccd",
            "method": "GET"
        };

        $.ajax(settings).done(function (response) {
            console.log(response);
            obj = response[0];
            console.log('Dati azione giornalieri')
            console.log(obj);

            var head = document.getElementsByTagName("head");
            var sc1 = document.createElement("link");
            sc1.href=obj.image;
            sc1.rel="icon"
            //head.appendChild(sc1);
            $('head').append(sc1);

            data.innerHTML = "";
            $('#container').append(`<div id="dati-azione" class="row"></div>`);

            $('#dati-azione').append(`<br/><br/><div id="sinistra" class="col-md-6 col-lg-4"><br/><br/></div>
                <div id="centro" class="col-md-6 col-lg-4"><br/><br/></div>
                <div id="destra" class="col-md-6 col-lg-4"><br/><br/></div>
                <div id="sotto" class="col-md-12 col-lg-12"><br/><br/></div>`);

            $('#sinistra').append(`<label><b>Nome:</b> ` + obj.companyName + `</label><br/>
            <label><b>Simbolo:</b> ` + obj.symbol + `</label><br/>
            <label><b>Prezzo:</b> ` + obj.price.toFixed(3) + `</label><br/>
            <label><b>Valuta:</b> ` + obj.currency + `</label><br/>
            <label><b>Capitalizzazione di mercato:</b> ` + obj.mktCap + `</label><br/>
            
            <br/><br/>`);

            $('#centro').append(`<label><b>Nazione:</b> ` + obj.state + `</label><br/>
            <label><b>Città:</b> ` + obj.city + `</label><br/>
            <label><b>Range 52S:</b> ` + obj.range + `</label><br/>
            <label><b>Ultimo dividendo:</b> ` + obj.lastDiv.toFixed(3) + `</label><br/>
            <label><b>Exchange:</b> ` + obj.exchangeShortName + `</label><br/>
            <label><b>ISIN:</b> ` + obj.isin + `</label><br/>
            <br/><br/>`);

            $('#destra').append(`<label><b>CEO:</b> ` + obj.ceo + `</label><br/>
            <label><b>Sito:</b> ` + obj.website + `</label><br/>
            <label><b>Settore:</b> ` + obj.sector + `</label><br/>
            <label><b>Data IPO:</b> ` + obj.ipoDate + `</label><br/>
            <label><b>Dipendenti:</b> ` + obj.fullTimeEmployees + `</label><br/>
            <br/><br/>`);

            $('#sotto').append(`<label><b>Descrizione:</b> ` + obj.description + `</label><br/>
            <br/><br/>`);

            $('#spazioDiv').append('<br/><br/>');
            
        });
    }
}

function initETF(simbolo) {
    document.getElementById("range").value = "Mensile";
    grafico(simbolo);
    let data = document.getElementById('dati-ETF');
    if (data != "") {
        const settings = {
            "async": true,
            "crossDomain": true,
            "url": "https://financialmodelingprep.com/api/v3/profile/" + simbolo + "?apikey=bc3331aa94ecabb46567958f34751ccd",
            "method": "GET"
        };

        $.ajax(settings).done(function (response) {
            console.log(response);
            obj = response[0];
            console.log('Dati ETF giornalieri')
            console.log(obj);
            $('btn-grafico').val('Aggiorna grafico' + obj.companyName);

            var head = document.getElementsByTagName("head");
            var sc1 = document.createElement("link");
            sc1.href=obj.image;
            sc1.rel="icon"
            //head.appendChild(sc1);
            $('head').append(sc1);

            data.innerHTML = "";
            $('#container').append(`<div id="dati-ETF" class="row"></div>`);

            $('#dati-ETF').append(`<br/><br/><div id="sinistra" class="col-md-6 col-lg-4"><br/><br/></div>
                <div id="centro" class="col-md-6 col-lg-4"><br/><br/></div>
                <div id="destra" class="col-md-6 col-lg-4"><br/><br/></div>
                <div id="sotto" class="col-md-12 col-lg-12"><br/><br/></div>`);

            $('#sinistra').append(`<label><b>Nome:</b> ` + obj.companyName + `</label><br/>
            <label><b>Simbolo:</b> ` + obj.symbol + `</label><br/>
            <label><b>Prezzo:</b> ` + obj.price.toFixed(3) + `</label><br/>
            <label><b>Valuta:</b> ` + obj.currency + `</label><br/>
            <label><b>Capitalizzazione di mercato:</b> ` + obj.mktCap + `</label><br/>
            
            <br/><br/>`);

            $('#centro').append(`<label><b>Nazione:</b> ` + obj.state + `</label><br/>
            <label><b>Città:</b> ` + obj.city + `</label><br/>
            <label><b>Range 52S:</b> ` + obj.range + `</label><br/>
            <label><b>Ultimo dividendo:</b> ` + obj.lastDiv.toFixed(3) + `</label><br/>
            <label><b>Exchange:</b> ` + obj.exchangeShortName + `</label><br/>
            <label><b>ISIN:</b> ` + obj.isin + `</label><br/>
            <br/><br/>`);

            $('#destra').append(`<label><b>CEO:</b> ` + obj.ceo + `</label><br/>
            <label><b>Sito:</b> ` + obj.website + `</label><br/>
            <label><b>Settore:</b> ` + obj.sector + `</label><br/>
            <label><b>Data IPO:</b> ` + obj.ipoDate + `</label><br/>
            <label><b>Dipendenti:</b> ` + obj.fullTimeEmployees + `</label><br/>
            <br/><br/>`);

            $('#sotto').append(`<label><b>Descrizione:</b> ` + obj.description + `</label><br/>
            <br/><br/>`);

            $('#spazioDiv').append('<br/><br/>');
            
        });
    }
}

$(document).ready(function () {

    $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: (target.offset().top - 70)
                }, 1000, "easeInOutExpo");
                return false;
            }
        }
    });

    // Scroll to top button appear
    $(document).scroll(function () {
        var scrollDistance = $(this).scrollTop();
        if (scrollDistance > 100) {
            $('.scroll-to-top').fadeIn();
        } else {
            $('.scroll-to-top').fadeOut();
        }
    });

    // Closes responsive menu when a scroll trigger link is clicked
    $('.js-scroll-trigger').click(function () {
        $('.navbar-collapse').collapse('hide');
    });

    // Activate scrollspy to add active class to navbar items on scroll
    $('body').scrollspy({
        target: '#mainNav',
        offset: 80
    });

    // Collapse Navbar
    var navbarCollapse = function () {
        if ($("#mainNav").offset().top > 100) {
            $("#mainNav").addClass("navbar-shrink");
        } else {
            $("#mainNav").removeClass("navbar-shrink");
        }
    };
    // Collapse now if page is not at top
    navbarCollapse();
    // Collapse the navbar when page is scrolled
    $(window).scroll(navbarCollapse);

    // Floating label headings for the contact form
    $(function () {
        $("body").on("input propertychange", ".floating-label-form-group", function (e) {
            $(this).toggleClass("floating-label-form-group-with-value", !!$(e.target).val());
        }).on("focus", ".floating-label-form-group", function () {
            $(this).addClass("floating-label-form-group-with-focus");
        }).on("blur", ".floating-label-form-group", function () {
            $(this).removeClass("floating-label-form-group-with-focus");
        });
    });

    $('#linkAzioni').click(function (e) {
        window.location = './home_azioni.html';
    });
    $('#linkETF').click(function (e) {
        window.location = './home_ETF.html';
    });
    $('#linkCrypto').click(function (e) {

    });

});