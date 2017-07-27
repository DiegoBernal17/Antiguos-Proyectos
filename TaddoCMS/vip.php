<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include('global.php');
define("THIS_SCRIPT", 'vip');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title><?php echo $sitename; ?> - Comprar Vip</title>
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
	<?php include("site/communitynav.php"); ?>
		    <section class="menu"><section class="menu2">
			<center><b>Habbos VIP</b></center></section>

                <?php
			$expsql = mysql_query("SELECT * FROM users WHERE vip = '1' ORDER BY id DESC");
			while($exp = mysql_fetch_array($expsql))
			{
				?>
				<div class="StaffBox">
					<img src="http://www.habbo.com/habbo-imaging/avatarimage?figure=<?php echo $exp['look']; ?>" alt="<?php echo $exp['username']; ?>" style="float:left" />
					<div class="OnlineStatus">
						<?php
						if($exp['online'] == 1)
						{
						?>
							<div class="Online">Online</div>
						<?php
						}
						else
						{
						?>
							<div class="Offline">Offline</div>
						<?php
						}
						?>
					</div>
					<div class="Usersname"><a href="home.php?u=<?php echo $exp['username']; ?>"><?php echo $exp['username']; ?></a></div>
					<div class="Usersmotto"><?php echo $staff['motto']; ?></div>
					<img src="./Public/Images/badges/VIP.gif" alt="Teen Staff" />
				</div>
            <?php } ?>
			</section>	
	</div>
	        <div id="column2">
					    <section class="menu"><section class="menu2">
			<center><b>Beneficios VIP</b></center></section>
- :push x empuja un usuario especificado<br>
- :pull x atrae cualquier usuario que este cerca a ti<br>
- :mimic x copia el look de cualquier usuario<br>
- :moonwalk camina detras como MJ<br>
- :flagme cambia tu nombre<br>
- Recibe 500 creditos cada 15 minutos <br>
- Entra salas aunque esten llenas<br>
- Catalogo VIP solo para usuarios VIP<br>
			</section>
			
			<section class="menu"><section class="menu2">
			<center><b>Comprar VIP</b></center></section>

			</section>
			
    	<?php include("site/sideads.php"); ?>
	</div>
	
	<?php include("site/footer.php"); ?>
</div>

</body>
</html>