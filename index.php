<?php
require_once './database/connect.php';
mysql_query("SET NAMES utf8");
session_start();

$vModule = isset($_GET["mod"]) ? $_GET["mod"] : '';
$vType = isset($_GET["type"]) ? $_GET["type"] : '';
$vAct = isset($_GET["act"]) ? $_GET["act"] : '';
$vID = isset($_GET["id"]) ? $_GET["id"] : '';
$vMsgStatus = isset($_GET["msgstatus"]) ? $_GET["msgstatus"] : '';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<?php include 'templates/header.php' ?>
	</header><!--/header-->
	
	<section id="slider"><!--slider-->
		<?php include 'templates/slider.php' ?>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
            	<div class="col-sm-3">
					<?php include 'templates/left.php' ?>
                </div>
            </div>
            		<div class="col-sm-9 padding-right">
			<?php	if(empty($vModule)) 
					{
						include 'templates/features.php';
                  	//	<!--features_items-->
						include 'templates/category.php';
					//	<!--/category-tab-->
						include 'templates/recommend.php';
					//	<!--/recommended_items-->
					}
					else
    				{
					//	$type = (!empty($vType)) ? '_type' : '';	
    				//	$vPathModule = "templates/$vModule$type.php";
						$vPathModule = "templates/$vModule.php";
    					if(file_exists($vPathModule)) 
    					{
    						include_once($vPathModule); 
    					} 
    					else 
    					{
    						include '404.html';
    					}
    				}
				?>	
				</div>
			</div>
		</div>
	</section>
	
	<?php include 'templates/footer.php'?>
    <!--/Footer-->
	

  
    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>