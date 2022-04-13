<?php
include('./incl.php');
switch ($_REQUEST["action"]) {
    case 'signup':
        try {
            $username = mysqli_real_escape_string($conn, $_REQUEST['nick']);
            $email = mysqli_real_escape_string($conn, $_REQUEST['email']);
            //$email = $_REQUEST['email'];
            //$username = $_REQUEST['nick'];
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
    default:
        echo "errore request";
        break;
}
