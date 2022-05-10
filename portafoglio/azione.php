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
                    <?php session_start(); if(isset($_SESSION['username'])){
                            echo '<li class="nav-item mx-0 mx-lg-1" role="presentation" id="linkAccount">
                            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="./account.php">
                                Account
                            </a>
                        </li>';
                        }else{
                            
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
                    echo '<input id="btn-grafico" type="button" class="btn btn-primary" onclick="grafico(`' . $simbolo . '`)" value="Aggiorna grafico ' . $nome . '" />';
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