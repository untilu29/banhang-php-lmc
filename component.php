<?php
if(isset($_GET['mod']) && $_GET['mod']){
    switch ($_GET['mod']) {
        case 'home':
            include 'sites/home.php';
            break;
        case 'about':
            include 'sites/about.php';
            break;
        default:
            break;
    }
}else{
    include 'sites/home.php';
}
?>