<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        <?php
        session_start();
        $account = $_SESSION['username'];
        echo $account;
        ?> - Data-View
    </title>
    <meta name="description" content="Data-View di Costamagna Andrea">
    <link rel="icon" href="./img/logo.ico">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/untitled-1.css">
    <link rel="stylesheet" href="../assets/css/untitled.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/account.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/intro.js@2.9.3/intro.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/intro.js@2.9.3/introjs.css" rel="stylesheet" />

    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.js"></script>
    <script src="./js/index.js"></script>

</head>

<body id="page-top">
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
                    <li class="nav-item mx-0 mx-lg-1" role="presentation">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="./home_ETF.php">
                            ETF
                        </a>
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
            $account = $_SESSION['username'];
            echo '<h2 class="text-uppercase text-center text-secondary">Bentornato ' . $account . '</h2>'
            ?>
            <hr class="star-dark mb-5 mx-auto">

            <div id="head" class="row">
                <div class="col-2" id="divPreferiti" data-intro="Titoli preferiti" data-step="1">
                    <h4>Preferiti:</h4>
                    <?php
                    include('./api/incl.php');
                    $email = $_SESSION['email'];
                    $query = "SELECT `simbolo`, `nome` FROM `preferiti` WHERE `email`='$email'";
                    $res = mysqli_query($mysqli, $query);
                    //$dat = mysqli_fetch_object($res);
                    //echo $dat['simbolo'];
                    //echo $res;
                    echo '<table class="table table-striped table-responsive-sm table-responsive-md table-responsive-lg table-hover">
                        <thead class="bg-secondary">
                            <tr>
                                
                                <th scope="col">Simbolo</th>
                            </tr>
                        </thead>
                        <tdoby>';
                    $i = 0;
                    while ($dat = mysqli_fetch_object($res)) {
                        $i = $i + 1;
                        echo '<tr>
                                
                                <td><a class="link-secondary" href="./azione.php?simbolo=' . $dat->simbolo . '&nome=' . $dat->nome . '">' . $dat->simbolo . '</a></td>
                            </tr> ';
                    }
                    echo '</tbody></table>';
                    ?>
                    <!-- 
                        intestazione:
                        <th scope="col">#</th>

                        righe:
                        <th scope="row">' . $i . '</th>
                     -->
                </div>


                <div class="col-8" id="divStorico" data-intro="Storico dei movimenti" data-step="2">
                    <h4>Storico movimenti:</h4>
                    <?php
                    include('./api/incl.php');
                    $email = $_SESSION['email'];
                    $query = "SELECT `simbolo`,`quote`,`prezzo`,`dataTransazione`,`tipo` FROM `buy` WHERE `email`='$email'";
                    $res = mysqli_query($mysqli, $query);
                    //$dat = mysqli_fetch_assoc($res);
                    //echo $dat['simbolo'];
                    echo '<table class="table table-striped table-responsive-sm table-responsive-md table-responsive-lg table-hover">
                        <thead class="bg-secondary">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Simbolo</th>
                                <th scope="col">Quote</th>
                                <th scope="col">Prezzo</th>
                                <th scope="col">Data</th>
                                <th scope="col">Tipo transazione</th>
                            </tr>
                        </thead>
                        <tdoby>';
                    $i = 0;
                    while ($dat = mysqli_fetch_object($res)) {
                        $i = $i + 1;
                        $simbolo = $dat->simbolo;
                        $quote = $dat->quote;
                        $prezzo = $dat->prezzo;
                        $data = $dat->dataTransazione;
                        $tipo = $dat->tipo;
                        if ($tipo == 'A') {
                            $tipo = "Acquisto";
                        } else {
                            $tipo = "Vendita";
                        }
                        echo '<tr>
                                <th scope="row">' . $i . '</th>
                                <td>' . $simbolo . '</td>
                                <td>' . $quote . '</td>
                                <td>' . $prezzo . '</td>
                                <td>' . $data . '</td>
                                <td>' . $tipo . '</td>
                            </tr> ';
                    }
                    echo '</tbody></table>';
                    ?>
                </div>

                <div class="col-2" data-intro="Liquidità utente:" data-step="3">
                    <h4>Utente:</h4>
                    <?php
                    include('./api/incl.php');
                    $email = $_SESSION['email'];
                    $query = "SELECT `simbolo`,`quote`,`prezzo`,`dataTransazione`,`tipo` FROM `buy` WHERE `email`='$email'";
                    $res = mysqli_query($mysqli, $query);
                    //$dat = mysqli_fetch_assoc($res);
                    //echo $dat['simbolo'];
                    echo '<table class="table table-striped table-responsive-sm table-responsive-md table-responsive-lg table-hover">
                        <thead class="bg-secondary">
                            <tr>
                                <th scope="col">Utente</th>
                                <th scope="col">Soldi</th>
                            </tr>
                        </thead>
                        <tdoby>
                        <tr>
                                <th scope="row">' . $_SESSION['username'] . '</th>
                                <td>' . $_SESSION['monetaVirtuale'] . '</td>
                        </tr>
                        </tbody></table>';
                    ?>
                </div>


            </div>
            <br /><br /><br />
            <div class="row">
                <form action="./api/index.php" method="POST" class="mx-auto">
                    <input type="hidden" name="action" value="logout">
                    <button class="onboard login-custom-button btn btn-primary" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
                            <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                        </svg>
                        &nbsp;
                        Log-out
                    </button>
                    <br />
                    <br />
                </form>
            </div>
            <br /><br />
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
            <div id="social" data-intro="Social networks sviluppatore" data-step="4">
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