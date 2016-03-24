<?php
require_once "../database/connect.php";
include_once "includes/libs.php";
session_start();

$_SESSION['username'] = isset($_SESSION['username'])? $_SESSION['username'] : '';
$_SESSION['password'] = isset($_SESSION['password'])? $_SESSION['password'] : '';

if(verify($_SESSION['username'], $_SESSION['password'])==false) {
  header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
 <head>
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>E-commerce Admin</title>

    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <?php require_once("templates/css.php")?>
 </head>
  
  <body class="no-skin">    <!-- #section:basics/navbar.layout -->

    <?php include_once 'templates/navbar.php'; ?>

    <!-- /section:basics/navbar.layout -->
    <div class="main-container" id="main-container">
      <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
      </script>

      <?php require_once 'templates/sidebar.php'; ?>
 
      <div class="main-content">
      <?php include_once 'main.php'; ?>      
      </div><!-- /.main-content -->

      <?php require_once 'templates/footer.php'; ?>

      <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
      </a>
    </div><!-- /.main-container -->
    
    <?php require_once("templates/js.php")?>
  </body>
</html>
