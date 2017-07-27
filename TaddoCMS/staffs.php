<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include('global.php');
define("THIS_SCRIPT", 'staff');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title><?php echo $sitename; ?> - Equipo del hotel</title>
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
			<?php
		    include("site/communitynav.php"); 
			$rankq = mysql_query("SELECT * FROM `ranks` WHERE id >= 3 ORDER BY id DESC");
			while($rank = mysql_fetch_array($rankq))
			{ ?>
			
		    <section class="menu"><section class="menu2">
			<center><b><?php echo $rank['name']; ?></b></center></section>
               <?php
			$staffq = mysql_query("SELECT * FROM users WHERE rank = ".$rank['id']." ORDER BY rank DESC");
			while($staff = mysql_fetch_array($staffq))
			{
				?>
				<div class="StaffBox">
					<img src="http://www.habbo.com/habbo-imaging/avatarimage?figure=<?php echo $staff['look']; ?>" alt="<?php echo $staff['username']; ?>" style="float:left" />
					<div class="OnlineStatus">
						<?php
						if($staff['online'] == 1)
						{
						?>
							<div class="Online">Conectado</div>
						<?php
						}
						else
						{
						?>
							<div class="Offline">Desconectado</div>
						<?php
						}
						?>
					</div>
					<div class="Usersname"><a href="home.php?u=<?php echo $staff['username']; ?>"><?php echo $staff['username']; ?></a></div>
					<div class="Usersmotto"><?php echo $staff['motto']; ?></div>
					<img src="./Public/Images/badges/<?php echo $rank['badgeid']; ?>.gif" alt="Teen Staff" />
				</div>
            <?php
			}
			echo('</section>');
			}
			?>
			
	</div>
	        <div id="column2">
					    <section class="menu"><section class="menu2">
			<center><b>¿Quieres formar parte del Equipo Staff?</b></center></section>
Si quieres formar parte del equipo Staff lo que debes hacer es enviar las encuenstas que se proporcionarán en una noticia al correo del Hotel. Pero mientras tanto, cualquier correo/petición que se haga sobe el tema de rangos seré ignorado completamente. Esto es algo crucial que nos ayuda a no perder tiempo. Muchas Gracias.
			</section>
			
			<section class="menu"><section class="menu2">
			<center><b>Creadores y Hotel Managers.</b></center></section>
Encargados de actualizaciones, mejoras y diversión del hotel. Se encargan de insertar todos los nuevos furnis, de hacer mejor el hotel y de los concursos, para que os divirtais y disfruteis aun más del Hotel.
			</section>
			
		    <section class="menu"><section class="menu2">
			<center><b>Head Mods y Moderadores.</b></center></section>
Los encargados de velar por vuestra seguridad. Ellos son los que llevan todo lo relacionado con la seguridad, todas las alertas de ayuda que pidais, todos los reportes a otros usuarios, ellos los recibirán y los resolverán.
			</section>
			
			<section class="menu"><section class="menu2">
			<center><b>Head Lince y Linces.</b></center></section>
Los más listos. Dueños de la central de ayuda, es decir, los que resolverán todas y cada una de tus dudas, es su misión. Los encontrarás en la Central de Ayuda Oficial, situada en el apartado de salas Oficiales.
			</section>
    	<?php include("site/sideads.php"); ?>
	</div>
	
	<?php include("site/footer.php"); ?>
</div>

</body>
</html>