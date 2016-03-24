<?php

function login($user, $pass) {
    $vSQL = "SELECT * FROM admin WHERE username='$user' AND password='$pass'";
    $vResult = mysql_query($vSQL);
    if (mysql_num_rows($vResult) > 0) {
        $_SESSION['username'] = $user;
        $_SESSION['password'] = $pass;
        return true;
    }
    return false;
}

function verify($user, $pass) {
    $vSQL = "SELECT * FROM admin WHERE username='$user' AND password='$pass'";
    $vResult = mysql_query($vSQL);
    if (mysql_num_rows($vResult) > 0) {
        return true;
    }

    return false;
}

function logout() {
    $_SESSION['user'] = '';
    $_SESSION['pass'] = '';

    header("Location: login.php");
}

//----------- FLASH MESSAGE BEGIN---------
function getFlash($name = '') {
    $message = '';
    if (!(session_id()))
        session_start();
    if (!empty($name) && isset($_SESSION[$name])) {
        $message = $_SESSION[$name];
        unset($_SESSION[$name]);
    }
    return $message;
}

function setFlash($name = '', $message = '') {
    if (!(session_id()))
        session_start();
    if (!empty($name) && isset($_SESSION[$name])) {
        unset($_SESSION[$name]);
    } else
        $_SESSION[$name] = $message;
}
//----------FLASH MESSAGE END------------


?>

