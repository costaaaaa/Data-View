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
            $username = $dat;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            echo "success login";
            header('Location: ../index.php?res=success&login=true');
        } else {
            echo "error login";
            header('Location: ../login.html?res=error&login=false');
        }
        break;
    case 'acquisto':
        /* echo $_REQUEST["simbolo"];
        echo '<br>';
        echo 'Numero di azioni:' . $_REQUEST["numAzioni"];
        echo '<br>';
        echo 'Prezzo:' . $_REQUEST["prezzo"]; */

        if (isset($_SESSION['username'])) {
            $query = "SELECT `idUser` FROM `users` WHERE `email`='" . $_SESSION['email'] . "'";
            $resId = mysqli_query($mysqli, $query);
            $dat = mysqli_fetch_assoc($resId);
            $nAzioni = $_REQUEST['numAzioni'];
            $prezzo = $_REQUEST['prezzo'];
            $totale = $prezzo * $nAzioni;
            $simbolo = $_REQUEST['simbolo'];
            $today = date("Y/m/d");

            //ricavo i soldi dell'utente
            $query = "SELECT `monetaVirtuale` FROM `users` WHERE `email`='" . $_SESSION['email'] . "'";
            $res = mysqli_query($mysqli, $query);
            $dat = mysqli_fetch_assoc($res);

            if($dat >= $totale){
                //inserisco l'acquisto nel database
                $query = "INSERT INTO `buy` (`simbolo`, `quote`, `prezzo_acquisto`, `totale`, `dataAcquisto`, `idUser`) VALUES ('$simbolo', '$nAzioni', '$prezzo', '$totale', '$today', '$dat'";
                $res = mysqli_query($mysqli, $query);

                $rimanente = $dat['monetaVirtuale'] - $totale;
                //aggiorno soldi utente
                $email = $_SESSION['email'];
                $query = "UPDATE `users` SET `monetaVirtuale`='$rimanente' WHERE `email`='$email'";
                $resId = mysqli_query($mysqli, $query);
            }
            

//UPDATE `users` SET `monetaVirtuale`='11' WHERE `idUser`='1'
            header('Location: ../home_azioni.php?res=success&azione=acquisto');
        } else {
            header('Location: ../login.html?res=error&azione=acquisto');
        }
        /*echo $_REQUEST["simbolo"];
        echo '<br>';
        echo 'Numero di azioni:' . $_REQUEST["numAzioni"];
        echo '<br>';
        echo 'Prezzo:' . $_REQUEST["prezzo"];*/
        break;
    default:
        echo "errore request";
        break;
}