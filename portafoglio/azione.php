<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        <?php
        $simbolo = $_POST['simbolo'];
        echo $simbolo;
        ?> - Data-View
    </title>
    <meta name="description" content="Data-View di Costamagna Andrea">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/untitled-1.css">
    <link rel="stylesheet" href="../assets/css/untitled.css">
    <link rel="stylesheet" href="./css/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/intro.js@2.9.3/intro.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/intro.js@2.9.3/introjs.css" rel="stylesheet" />

    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.js"></script>
    <script src="./js/index.js"></script>

</head>

<body id="page-top" onload="initAzione('<?php $nome = $_POST['simbolo'];
                                        echo $simbolo;
                                        ?>')">
    <nav class=" navbar navbar-light navbar-expand-lg fixed-top bg-secondary text-uppercase" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">
                Data-View
            </a>
            <button data-toggle="collapse" data-target="#navbarResponsive" class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item mx-0 mx-lg-1" role="presentation">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="./index.php">
                            Home
                        </a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1" role="presentation">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="./home_azioni.php">
                            Azioni
                        </a>
                    </li>
                    <?php session_start();
                    if (isset($_SESSION['username'])) {
                        echo '<li class="nav-item mx-0 mx-lg-1" role="presentation" id="linkAccount">
                            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="./account.php">
                                Account
                            </a>
                        </li>';
                    } else {

                        echo '<li class="nav-item mx-0 mx-lg-1" role="presentation">
                            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="./login.html">
                                Log-in
                            </a>
                        </li>
                        <li class="nav-item mx-0 mx-lg-1" role="presentation">
                            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="./signup.html">
                                Sign-up
                            </a>
                        </li>';
                    } ?>
                    </li>

                    <!-- 'tour' della pagina-->
                    <li class="nav-item mx-0 mx-lg-1" role="presentation"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" onclick="introJs().start()">START TOUR</a></li>
                </ul>
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"></li>
                    <li class="nav-item" role="presentation"></li>
                    <li class="nav-item" role="presentation"></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- section centrale con i vari collegamenti -->
    <section id="portfolio" class="portfolio">
        <br /><br />
        <div class="container">
            <?php
            $nome = $_POST['nome'];
            echo '<h2 class="text-uppercase text-center text-secondary">Dati ' . $nome . '</h2>'
            ?>
            <hr class="star-dark mb-5 mx-auto">

            <div id="head" class="row">
                <div class="col">
                    <label for="intervallo">Intervallo dei dati nel grafico: </label>
                    <select class="form-control mx-auto" id="range">
                        <option value="Giornaliero">Giornaliero</option>
                        <option value="Mensile">Mensile</option>
                        <option value="Annuale">Annuale</option>
                        <option value="5 anni">5 anni</option>
                        <option value="10 anni">10 anni</option>
                    </select>
                    <br />
                    <?php
                    $nome = $_POST['nome'];
                    $simbolo = $_POST['simbolo'];
                    echo '<button id="btn-grafico" type="button" class="btn btn-primary" onclick="grafico(`' . $simbolo . '`)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-graph-up" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0Zm14.817 3.113a.5.5 0 0 1 .07.704l-4.5 5.5a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61 4.15-5.073a.5.5 0 0 1 .704-.07Z"/>
                            </svg>
                            &nbsp
                            Aggiorna grafico ' . $nome . '</button>';
                    ?>
                </div>
                <div class="col">
                    <br />
                    <form action="./api/index.php" method="POST" class="mx-auto" id="form-acquisto">
                        <input type="hidden" name="action" value="acquisto">
                        <input type="hidden" name="simbolo" value=<?php $simbolo = $_POST['simbolo'];
                                                                    echo $simbolo; ?>>
                        <input type="number" id="numAzioni" name="numAzioni" placeholder="Numero di azioni" required>
                        <br /><br />
                        <button id="btn-acquista-azione" class="btn btn-primary" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z" />
                                <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z" />
                                <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z" />
                                <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z" />
                            </svg>
                            &nbsp
                            Acquista azioni
                        </button>
                    </form>
                </div>
            </div>
            <br /><br />
            <div id="containerGrafico" data-intro="Grafico dell'azione" data-step="1">
                <canvas id="myChart">

                </canvas>
            </div>

            <div id="dati-azione" class="row" data-intro="Dati relativi all'azione" data-step="2">

            </div>
            <div id="spazioDiv"></div>
        </div>
    </section>

    <br /><br /><br />

    <footer class="footer text-center fondo fixed-bottom">
        <div class="container">
            <div id="location">
                <h4 class="text-uppercase mb-4">Location</h4>
                <p>Via chiari 48</p>
                <p>
                    Narzole (CN) 12068
                </p>
            </div>
            <div id="social" data-intro="Social networks of dev" data-step="3">
                <h4 class="text-uppercase">Around the Web</h4>
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://github.com/costaaaaa" target="_blank">
                    <i class="fa fa-github"></i>
                </a>
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://www.instagram.com/costamagna.andrea/" target="_blank">
                    <i class="fa fa-instagram fa-fw"></i>
                </a>
            </div>
            <br /><br />
        </div>
    </footer>
    <div class="copyright py-4 text-center text-white fondo fixed-bottom">
        <div class="container"><small>Copyright ©&nbsp;Data-View 2022</small></div>
    </div>


    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="../assets/js/freelancer.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->


</body>

</html>