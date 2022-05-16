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
            sc1.rel = "icon";
            let imgValuta="";
            //head.appendChild(sc1);
            $('head').append(sc1);

            data.innerHTML = "";
            $('#container').append(`<div id="dati-azione" class="row"></div>`);

            $('#dati-azione').append(`<br/><br/><div id="sinistra" class="col-md-6 col-lg-4"><br/><br/></div>
                <div id="centro" class="col-md-6 col-lg-4"><br/><br/></div>
                <div id="destra" class="col-md-6 col-lg-4"><br/><br/></div>
                <div id="sotto" class="col-md-12 col-lg-12"><br/><br/></div>`);

            switch (obj.currency) {
                case "USD":
                    imgValuta = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                                    <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
                                </svg>`;
                    break;
                case "EUR":
                    imgValuta = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-euro" viewBox="0 0 16 16">
                                    <path d="M4 9.42h1.063C5.4 12.323 7.317 14 10.34 14c.622 0 1.167-.068 1.659-.185v-1.3c-.484.119-1.045.17-1.659.17-2.1 0-3.455-1.198-3.775-3.264h4.017v-.928H6.497v-.936c0-.11 0-.219.008-.329h4.078v-.927H6.618c.388-1.898 1.719-2.985 3.723-2.985.614 0 1.175.05 1.659.177V2.194A6.617 6.617 0 0 0 10.341 2c-2.928 0-4.82 1.569-5.244 4.3H4v.928h1.01v1.265H4v.928z"/>
                                </svg>`;
                    break;
                case "GBP":
                    imgValuta = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-pound" viewBox="0 0 16 16">
                                    <path d="M4 8.585h1.969c.115.465.186.939.186 1.43 0 1.385-.736 2.496-2.075 2.771V14H12v-1.24H6.492v-.129c.825-.525 1.135-1.446 1.135-2.694 0-.465-.07-.913-.168-1.352h3.29v-.972H7.22c-.186-.723-.372-1.455-.372-2.247 0-1.274 1.047-2.066 2.58-2.066a5.32 5.32 0 0 1 2.103.465V2.456A5.629 5.629 0 0 0 9.348 2C6.865 2 5.322 3.291 5.322 5.366c0 .775.195 1.515.399 2.247H4v.972z"/>
                                </svg>`;
                    break;
                default:
                    imgValuta = "";
                    break;
            }
            
            $('#sinistra').append(`<label><b>Nome:</b> ` + obj.companyName + `</label><br/>
            <label><b>Simbolo:</b> ` + obj.symbol + `</label><br/>
            <label><b>Prezzo:</b> ` + obj.price.toFixed(3) + `</label><br/>
            <label><b>Valuta:</b> ` + imgValuta +'&nbsp('+ obj.currency + `)</label><br/>
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

            $('#form-acquisto').append('<input type="hidden" name="prezzo" value="'+obj.price.toFixed(3)+'">');

            //script per la traduzione con API di google translate
            //però ha un basso numero di utilizzi massimi e quindi è inutilizzabile
            /* const settings = {
	            "async": true,
	            "crossDomain": true,
	            "url": "https://google-translate1.p.rapidapi.com/language/translate/v2",
	            "method": "POST",
	            "headers": {
		            "content-type": "application/x-www-form-urlencoded",
		            "Accept-Encoding": "application/gzip",
		            "X-RapidAPI-Host": "google-translate1.p.rapidapi.com",
		            "X-RapidAPI-Key": "2fbe7ee09amshf71ce9aa01eb1f1p121372jsnd2af913090f2"
	            },
	            "data": {
		            "q": obj.description,
		            "target": "es",
		            "source": "en"
	            }
            };

            $.ajax(settings).done(function (response) {
	            console.log(response[0]);
                $('#sotto').append(`<label><b>Descrizione:</b> ` + response + `</label><br/>
                    <br/><br/>`);
            }); */



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
        window.location = './home_azioni.php';
    });
    $('#linkETF').click(function (e) {
        window.location = './home_ETF.html';
    });
    $('#linkCrypto').click(function (e) {

    });

});