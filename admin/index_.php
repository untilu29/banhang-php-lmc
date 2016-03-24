<?php
require_once "../database/connect.php";
include_once "includes/libs.php";
session_start();

$_SESSION['username'] = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$_SESSION['password'] = isset($_SESSION['password']) ? $_SESSION['password'] : '';


$vModule = isset($_GET["mod"]) ? $_GET["mod"] : '';
$vType = isset($_GET["type"]) ? $_GET["type"] : '';
$vAct = isset($_GET["act"]) ? $_GET["act"] : '';
$vID = isset($_GET["id"]) ? $_GET["id"] : '';
$vMsgStatus = isset($_GET["msgstatus"]) ? $_GET["msgstatus"] : '';



if (verify($_SESSION['username'], $_SESSION['password']) == false) {
    header("Location: login.php");
}

echo "<pre>";
print_r($_SESSION);
echo "</pre>";
?>
<html>
    <head>
        <link type="text/css" href="../webroots/css/style.css" rel="stylesheet" />
        <script src="../webroots/js/../" type="text/javascript" ></script>
    </head>
    <body>
        <header>
            <div class="container">
                <h1>Header</h1>
            </div>
        </header>
        <div class="container">
            <div class="main-content">
                <div class="left"><?php include "includes/left.php" ?></div>
                <div class="content">
<?php
if (empty($vModule)) {
    include "modules/home.php";
} else {
    $vPathModule = "modules/$vModule.php";
    if (file_exists($vPathModule)) {
        include $vPathModule;
    } else {
        echo "Chưa tồn tại mô-đun!";
    }
}
?>
                </div>
            </div>
        </div>
        <footer>
            <div class="container">
                <h1>Footer</h1>
            </div>
        </footer>
    </body>
</html>