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

            $query = "SELECT `email` FROM `users` WHERE `email`='$email'";
            $res = mysqli_query($mysqli, $query);
            if ($res == "") {
                $query = "SELECT `username` FROM `users` WHERE `username`='$username'";
                $res = mysqli_query($mysqli, $query);
                if ($res == "") {
                    $query = "INSERT INTO `users` (`username`, `email`, `psw`) VALUES ('$username', '$email', '$psw')";
                    $res = mysqli_query($mysqli, $query);
                    session_start();
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;
                    header('Location: ../index.html?res=success');
                } else {
                    header('Location: ../signup.html?res="error"&error=username');
                }
            } else {
                header('Location: ../signup.html?res=error&error=email');
            }
            //echo "Inserito <br/>";
            //echo $_SESSION['email'] . ', ' . $_SESSION['username'];
        } catch (\Throwable $th) {
            //echo $th;
            //echo "errore";
        }
        //header('Location: ../index.html');
        break;
    case 'logout':
        session_destroy();
        $_SESSION['username'] = "";
        $_SESSION['email'] = "";
        break;
    case 'login':

        break;
    default:
        echo "errore request";
        break;
}
