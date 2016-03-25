<?php

function login($user, $pass) {
    $vSQL = "SELECT * FROM users WHERE username='$user' AND role_id=1 AND actived=1";
    $vResult = mysql_query($vSQL);
    if (mysql_num_rows($vResult) > 0) {
        $row = mysql_fetch_array($vResult);
        $stored_hash_for_user = $row['password'];
        if (Bcrypt::check($pass, $stored_hash_for_user)) {
            $_SESSION['user_admin'] = $user;
            $_SESSION['name'] = $row['name'];
            return true;
        }
    }
    return false;
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

