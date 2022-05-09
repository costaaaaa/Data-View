<?php
include('./incl.php');
switch ($_REQUEST["action"]) {
    case 'signup':
        //try {

        $username = mysqli_real_escape_string($conn, $_REQUEST['nick']);
        $email = mysqli_real_escape_string($conn, $_REQUEST['email']);
        $nome = mysqli_real_escape_string($conn, $_REQUEST['nome']);
        $cognome = mysqli_real_escape_string($conn, $_REQUEST['cognome']);
        $date = mysqli_real_escape_string($conn, $_REQUEST['date']);
        $sesso = mysqli_real_escape_string($conn, $_REQUEST['sesso']);
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
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                echo "success signup";
                header('Location: ../index.html?res=success&login=true');
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
        //header('Location: ../index.html');
        break;
    case 'logout':
        session_destroy();
        $_SESSION['username'] = "";
        $_SESSION['email'] = "";
        echo "success logout";
        header('Location: ../index.html?res=logout&login=true');
        break;
    case 'login':
        //$email = mysqli_real_escape_string($conn, $_REQUEST['email']);
        $email = $_REQUEST['email'];
        $psw = password_hash($_REQUEST['password'], PASSWORD_DEFAULT);

        $query = "SELECT `psw` FROM `users` WHERE `email`='$email'";
        $res = mysqli_query($mysqli, $query);
        $dat = mysqli_fetch_assoc($res);
        if (password_verify($_REQUEST['password'], $dat['psw'])) {
            $query = "SELECT `username` FROM `users` WHERE `email`='$email'";
            $res = mysqli_query($mysqli, $query);
            $username = $res;
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            echo "success login";
            header('Location: ../index.html?res=success&login=true');
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
            $query = "INSERT INTO `buy` (`simbolo`, `quote`, `prezzo_acquisto`, `dataAcquisto`, `idUser`) VALUES ('" . $_REQUEST["simbolo"] . "', '" . $_REQUEST["numAzioni"] . "', '" . $_REQUEST["prezzo"] . "', '" . date("d/m/Y") . "', '$resId'";
            $res = mysqli_query($mysqli, $query);
            header('Location: ../home_azioni.html?res=success&azione=acquisto');
        } else {
            header('Location: ../login.html?res=error&azione=acquisto');
        }
        break;
    default:
        echo "errore request";
        break;
}
