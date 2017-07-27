<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include('global.php');
require_once('badge.php');
define("THIS_SCRIPT", 'shop');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title><?php echo $sitename; ?> - Tienda</title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="Public/JS/jquery.history.js"></script>
    <link type="text/css" rel="stylesheet" href="Public/Styles/CSS/main.css" />
    <link type="text/css" rel="stylesheet" href="Public/Styles/CSS/main2.css" />

</head> 
 
<body> 

	<?php include("site/header.php"); ?>
	
	<div class="mid">
	<?php include("site/nav.php"); ?>
	<div id="column1">
	<?php include("site/shopnav.php"); ?>
		    <section class="menu"><section class="menu2">
			<center><b>Comprar placas</b></center></section>
       <center>
        <form method="post">
        <?php echo $error; ?>
        
        	<h4>Consigue una placa a un bajo precio.</h4>
        	<img src="http://images.habbo.com/c_images/album1584/<?php echo $placa; ?>.gif" />
        	<br />
            <br />
            Esta vez, la placa que puedes comptrar es <strong><?php echo $placa; ?></strong>.<br />
            Su precio es de: <strong><?php echo number_format($precio); ?> píxeles</strong>
            <br /><br />
            <input type="submit" value="¡Comprar placa!" name="buy-bad"/>
            <input name="habbo" type="hidden" id="habbo" value="<?php echo $username; ?>"/>
</center>		
			</section>
			
	</div>
	        <div id="column2">
					    <section class="menu"><section class="menu2">
			<center><b>Informacion</b></center></section>
			
			</section>

    	<?php include("site/sideads.php"); ?>
	</div>
	
	<?php include("site/footer.php"); ?>
</div>

</body>
</html>