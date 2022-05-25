<?php
include('./incl.php');
session_start();
switch ($_REQUEST["action"]) {
    case 'signup':
        /*
        $username = mysqli_real_escape_string($conn, $_REQUEST['nick']);
        $email = mysqli_real_escape_string($conn, $_REQUEST['email']);
        $nome = mysqli_real_escape_string($conn, $_REQUEST['nome']);
        $cognome = mysqli_real_escape_string($conn, $_REQUEST['cognome']);
        $date = mysqli_real_escape_string($conn, $_REQUEST['date']);
        $sesso = mysqli_real_escape_string($conn, $_REQUEST['sesso']);
        */
        //$email = $_REQUEST['email'];
        //$username = $_REQUEST['nick'];
        $psw = password_hash($_REQUEST['password'], PASSWORD_DEFAULT);

        $query = "SELECT `email` FROM `users` WHERE `email`='$email'";
        $res = mysqli_query($mysqli, $query);
        if ($res == "") {
            $query = "SELECT `username` FROM `users` WHERE `username`='$username'";
            $res = mysqli_query($mysqli, $query);
            if ($res == "") {
                //$query = "INSERT INTO `users` (`username`, `email`, `psw`) VALUES ('$username', '$email', '$psw')";
                $query = "INSERT INTO `users` (`username`, `email`, `psw`, `nome`, `cognome`, `sesso`, `dataNascita`) VALUES ('$username', '$email', '$psw', '$nome', '$cognome', '$sesso', '$date')";
                $res = mysqli_query($mysqli, $query);
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                echo "success signup";
                header('Location: ../index.php?res=success&login=true');
            } else {
                echo "error signup";
                header('Location: ../signup.html?res="error"&error=username&login=false');
            }
        } else {
            echo "error signup";
            header('Location: ../signup.html?res=error&error=email&login=false');
        }
        //echo "Inserito <br/>";
        //echo $_SESSION['email'] . ', ' . $_SESSION['username'];
        //} catch (\Throwable $th) {
        //echo $th;
        //echo "errore";
        //}
        //header('Location: ../index.php');
        break;
    case 'logout':
        $_SESSION['username'] = "";
        $_SESSION['email'] = "";
        echo "success logout";
        header('Location: ../index.php?res=logout&login=false');
        break;
    case 'login':
        $email = $_REQUEST['email'];
        $psw = password_hash($_REQUEST['password'], PASSWORD_DEFAULT);

        $query = "SELECT `psw` FROM `users` WHERE `email`='$email'";
        $res = mysqli_query($mysqli, $query);
        $dat = mysqli_fetch_assoc($res);
        if (password_verify($_REQUEST['password'], $dat['psw'])) {
            $query = "SELECT `username` FROM `users` WHERE `email`='$email'";
            $res = mysqli_query($mysqli, $query);
            $dat = mysqli_fetch_assoc($res);
            $username = $dat['username'];
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            echo "success login";
            header('Location: ../index.php?res=success&azione=login');
        } else {
            echo "error login";
            header('Location: ../login.html?res=error&azione=login');
        }
        break;
    case 'acquisto':
        /* echo $_REQUEST["simbolo"];
        echo '<br>';
        echo 'Numero di azioni:' . $_REQUEST["numAzioni"];
        echo '<br>';
        echo 'Prezzo:' . $_REQUEST["prezzo"]; */

        if (isset($_SESSION['username'])) {
            //variabili dell'acquisto
            $nAzioni = $_REQUEST['numAzioni'];
            $prezzo = $_REQUEST['prezzo'];
            $totale = $prezzo * $nAzioni;
            $simbolo = $_REQUEST['simbolo'];
            $today = date("Y/m/d");
            $email = $_SESSION['email'];

            //ricavo i soldi dell'utente
            $query = "SELECT `monetaVirtuale` FROM `users` WHERE `email`='" . $_SESSION['email'] . "'";
            $res = mysqli_query($mysqli, $query);
            $dat = mysqli_fetch_assoc($res);

            if ($dat >= $totale) {
                //inserisco l'acquisto nella tabella delle transazioni
                $query = "INSERT INTO `buy` (`simbolo`, `quote`, `prezzo`, `totale`, `dataTransazione`, `email`) VALUES ('" . $simbolo . "', '" . $nAzioni . "', '" . $prezzo . "', '" . $totale . "', '" . $today . "', 'A', '" . $email . "')";
                $res = mysqli_query($mysqli, $query);

                //seleziono azioni possedute dall'utente per il relativo simbolo dell'azione
                $query = "SELECT `quote`, `prezzo_medio`, `totale` FROM `possedute` WHERE `email` = '$email' AND `simbolo`='$simbolo'";
                $res = mysqli_query($mysqli, $query);
                $possedute = mysqli_fetch_assoc($res);

                if ($res == "") {
                    //inserisco l'acquisto nella tabella con le azioni possedute dagli utenti
                    $query = "INSERT INTO `possedute` (`simbolo`, `quote`, `prezzo_medio`, `totale`, `email`) VALUES ('" . $simbolo . "', '" . $nAzioni . "', '" . $prezzo . "', '" . $totale . "', '" . $email . "')";
                    $res = mysqli_query($mysqli, $query);
                } else {
                    $prezzoMedio = ($dat['prezzo_medio'] + $prezzo) / 2;
                    $numeroAzioniTotali = $possedute['quote'] + $nAzioni;
                    $totalePortafoglio = $dat['totale'] + $totale;
                    $query = "UPDATE `possedute` SET `quote`='$numeroAzioniTotali', `prezzo_medio`='$prezzoMedio', `totale`='$totalePortafoglio' WHERE `email`='$email' AND `simbolo`='$simbolo'";
                    $res = mysqli_query($mysqli, $query);
                }

                //rimuovo soldi utente
                $rimanente = $dat['monetaVirtuale'] - $totale;
                $query = "UPDATE `users` SET `monetaVirtuale`='$rimanente' WHERE `email`='$email'";
                $resId = mysqli_query($mysqli, $query);
            }
            $_SESSION['acquisto'] = "success";
            header('Location: ../home_azioni.php?res=success&azione=acquisto');
        } else {
            header('Location: ../login.html?res=error&azione=acquisto');
        }
        break;
    case 'vendita':
        if (isset($_SESSION['username'])) {
            $nAzioni = $_REQUEST['numAzioni'];
            $prezzo = $_REQUEST['prezzo'];
            $totale = $prezzo * $nAzioni;
            $simbolo = $_REQUEST['simbolo'];
            $today = date("Y/m/d");
            $email = $_SESSION['email'];

            //ricavo i soldi dell'utente
            $query = "SELECT `monetaVirtuale` FROM `users` WHERE `email`='$email'";
            $res = mysqli_query($mysqli, $query);
            $soldiUtente = mysqli_fetch_assoc($res);

            //inserisco la vendita nella tabella delle transazioni
            $query = "INSERT INTO `buy` (`simbolo`, `quote`, `prezzo`, `totale`, `dataTransazione`, `tipo`, `email`) VALUES ('" . $simbolo . "', '" . $nAzioni . "', '" . $prezzo . "', '" . $totale . "', '" . $today . "', 'V', '" . $email . "')";
            $res = mysqli_query($mysqli, $query);

            //seleziono le quote possedute
            $query = "SELECT `quote` FROM `portafogli` WHERE `email`='$email' AND `simbolo`=$simbolo";
            $res = mysqli_query($mysqli, $query);
            $dat = mysqli_fetch_assoc($res);
            if ($dat['quote'] >= $nAzioni) {
                $azioniRimanenti = $dat['quote'] - $nAzioni;

                //tolgo le quote dal portafoglio
                $query = "UPDATE `portafogli` SET `quote`='$azioniRimanenti' WHERE `email`='$email' AND `simbolo`='$simbolo'";
                $res = mysqli_query($mysqli, $query);

                //aggiungo i soldi all'utente
                $soldiUtente += $totale;
                $query = "UPDATE `users` SET `monetaVirtuale`='$soldiUtente' WHERE `email`='$email'";
                $res = mysqli_query($mysqli, $query);

                header('Location: ../home_azioni.php?res=success&azione=vendita');
                //header('Location: ../account.php?res=success&azione=vendita');
            } else {
                header('Location: ../home_azioni.php?res=error&azione=vendita');
            }
        } else {
            header('Location: ../login.html?res=error&azione=vendita');
        }
        break;
    case "AggiungiPreferito":
        $simbolo = $_REQUEST['simbolo'];
        $email = $_SESSION['email'];
        $query = "INSERT INTO `preferiti` (`idPreferiti`, `simbolo`, `email`) VALUES (NULL, '$simbolo', '$email');";
        $res = mysqli_query($mysqli, $query);
        echo "Aggiunto ai preferiti";
        break;
    case "RimuoviPreferito":
        $simbolo = $_REQUEST['simbolo'];
        $email = $_SESSION['email'];
        $query = "DELETE FROM `preferiti` WHERE `preferiti`.`simbolo`= '$simbolo' AND `preferiti`.`email`=$email";
        $res = mysqli_query($mysqli, $query);
        echo "Rimosso dai preferiti";
        break;
    default:
        echo "errore request";
        break;
}
