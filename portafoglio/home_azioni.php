<!DOCTYPE html>
<html lang="it">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Azioni - Data-View</title>
        <meta name="description" content="Tutte le azioni">
        <link rel="icon" href="./img/logo.ico">

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
        <script src="./js/home_azioni.js"></script>
    </head>
    
    <body id="page-top" onload="initHomeAzione()">

        <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-secondary text-uppercase" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top">
                    Data-View
                </a>
                <button data-toggle="collapse" data-target="#navbarResponsive" 
                    class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">

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
                            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#portfolio">
                                Titoli
                            </a>
                        </li>


                        <?php session_start();
                             if(isset($_SESSION['username']) && $_SESSION['username'] != ""){
                            
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
                        

                        <!-- 'tour' della pagina-->
                        <li class="nav-item mx-0 mx-lg-1" role="presentation"><a
                                class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                                onclick="introJs().start()">START TOUR</a></li>
                    </ul>
                    <ul class="nav navbar-nav">
                        <li class="nav-item" role="presentation"></li>
                        <li class="nav-item" role="presentation"></li>
                        <li class="nav-item" role="presentation"></li>
                    </ul>
                </div>
            </div>
        </nav>

        <br/><br/>
        
        <!-- section centrale con i vari collegamenti -->
        <section id="portfolio" class="portfolio">

            <div class="container">
                <h2 class="text-uppercase text-center text-secondary">Titoli</h2>
                <hr class="star-dark mb-5 mx-auto">

                <br/>
                <input class="form-control" id="cercaAzioni" type="text" data-step="1" data-intro="Cerca azioni nella nostra pagina" placeholder="Cerca..">
                <br/>

                <div id="caricamento">
                    <br/><br/><br/>
                    <div class="spinner-border text-primary"></div>
                </div>
                

                <div class="row" id="azioni" data-step="2" data-intro="Le principali azioni del nostro sito">
                    
                </div>

                <div class="mx-auto" id="titoloMore">
                    
                </div>
                <div id="allMore" class="row">
                    
                </div>
                

                <div id="showMore-div">
                
                </div>
            </div>
        </section>

        <br /><br /><br />
        
        <footer class="footer text-center fondo">
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
                    <a class="btn btn-outline-light btn-social text-center rounded-circle"
                        href="https://github.com/costaaaaa" target="_blank">
                        <i class="fa fa-github"></i>
                    </a>
                    <a class="btn btn-outline-light btn-social text-center rounded-circle"
                        href="https://www.instagram.com/costamagna.andrea/" target="_blank">
                        <i class="fa fa-instagram fa-fw"></i>
                    </a>
                </div>
                <br /><br />
            </div>
        </footer>
        <div class="copyright py-4 text-center text-white fondo">
            <div class="container"><small>Copyright ©&nbsp;Data-View 2022</small></div>
        </div>

        <div id="finestre">

        </div>
        

        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <script src="../assets/js/freelancer.js"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
        
  
        <!-- Modal -->
        <div class="modal fade" id="modal-acquisto-success" tabindex="-1" role="dialog" aria-labelledby="modal-acquisto-success-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body">
          Acquisto effettuato con successo!
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Esci</button>
        </div>
      </div>
    </div>
  </div>

    </body>

</html>