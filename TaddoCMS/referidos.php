<?php
$server = 'http://'.$_SERVER['SERVER_NAME'];
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include('global.php');
define("THIS_SCRIPT", 'referidos');

$userq = mysql_query("SELECT username FROM users WHERE username = '".$_SESSION['username']."' LIMIT 1");
		$user = mysql_fetch_array($userq);
		?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title><?php echo $sitename; ?> - Referidos</title>
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
		    <section class="menu"><section class="menu2">
			<center><b>Referidos</b></center></section>
					<center><br>&iquest;Quieres <b>VIP</b> en este hotel, <b><?php echo $user['username']; ?></b>? <br><br>Ahora <b><?php echo $sitename; ?></b> da VIP seg&uacute;n lo que ayudes.<br> 
					<br>Entonces creamos un sistema de referidos! <br><br>

					<b>&iquest;Qu&eacute; hago?</b><br><br>
					Simplemente ir a alg&uacute;n xat, holo, crear un clon en habbo y flodear o poner el siguiente link en un foro.<br />
					<b>Debes dar cualquiera de las siguientes direcciones al publicar:<b><br><br>
					</textarea><br><br><textarea style="height: 35px; width: 350px; "><?php echo $server.'/refer.php?r='.$user['username']; ?></textarea><br><br>
					<h4>Ten en cuenta que:</h4>
					<ul type="square">
					<li>• Si dos personas, invitan a la misma, solo se le contara como REFERIDO a la primera en hacerlo.</li>
					<li>• La IP de tu referido queda guardada, as&iacute; que no intentes hacer trampas. </li>
					</ul>
			</section>	
	</div>
	        <div id="column2">
					    <section class="menu"><section class="menu2">
			<center><b>Contador de referidos.</b></center></section>
									<img src="http://images.wikia.com/habboworldteam/es/images/9/9e/Frank_welcome1.gif" style="float: left;">
	
					<p>
		Cuando lleves una cuenta considerable (<b>40+</b>) de referidos. Comunicate con
		algun staff de la siguiente lista: <?php
        $staffq = mysql_query("SELECT username FROM users WHERE rank = '8' LIMIT 4");
        while($rank = mysql_fetch_array($staffq))
        {
        echo '<u><i>'.$rank['username'].'</i></u>';
        ?>
,
<?php
}
?> suerte a todos.<br><br>
					Llevas un total de:


					<b><?php 

					$query = mysql_query("SELECT COUNT(*) AS aantalleden FROM users_referidos WHERE usuario ='". $_GET["n"] ."' ORDER BY ID") or die(mysql_error()); 
        				$data = mysql_fetch_assoc($query); echo $data['aantalleden']; 
					?></b>	</p>
			</section>
			
    	<?php include("site/sideads.php"); ?>
	</div>
	
	<?php include("site/footer.php"); ?>
</div>

</body>
</html>