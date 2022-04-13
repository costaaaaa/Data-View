<?php
include('./incl.php');
switch ($_REQUEST["action"]) {
    case 'signup':
        try {
            //$username = mysqli_real_escape_string($conn, $_REQUEST['nick']);
            //$email = mysqli_real_escape_string($conn, $_REQUEST['email']);
            $email = $_REQUEST['email'];
            $username = $_REQUEST['nick'];
            $psw = password_hash($_REQUEST['password'], PASSWORD_DEFAULT);
            $query = "INSERT INTO `users` (`idUser`, `email`, `psw`, `username`) VALUES ('', '$email', '$psw', '$username')";
            $res = mysqli_query($conn, $query);
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            echo "Inserito <br/>";
            echo $_SESSION['email'] . ', ' . $_SESSION['username'];
        } catch (\Throwable $th) {
            //echo $th;
            echo "errore";
        }
        //header('Location: ../index.html');
        break;
    default:
        echo "errore request";
        break;
}
