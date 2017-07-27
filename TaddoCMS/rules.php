<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include('global.php');
define("THIS_SCRIPT", 'rules');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title><?php echo $sitename; ?> - Reglas del hotel</title>
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
	<?php include("site/homenav.php"); ?>
		    <section class="menu"><section class="menu2">
			<center><b>Reglas del hotel</b></center></section>
<br><b>Al registrarte y entrar al hotel estas aceptando estas reglas:</b><br><br>

       1.-Reglas de los usuarios<br><br>
	   
1.1 No insultarás a ningún staff ni usuario.<br>
1.2 No hackearás el hotel y/o utilizarás script o será banneada tu IP<br>
1.3 No pedirás placas a ningún staff, solo los vips pueden pedirlas.<br>
1.4 No timarás/hackearás usuarios.<br>
1.5 No pedirás contraseñas, email ni datos personales a los usuarios.<br>
1.6 No acosarás a los usuarios en el hotel.<br>
1.7 Tienes el derecho a reportar cualquier usuario/staff que te moleste, o bannee sin razón, por favor hazlo en el facebook de taddo o al twitter o al correo del hotel.<br>
1.8 Aceptas que si no te conectas en más de 20 días tu usuario será borrado, a menos que seas VIP o Staff, no lo será.<br>
1.9 No pediras rango.<br><br>

<b>// Los staffs se reservan el derecho a bannearte siempre y cuando lo vea necesario. <br>
// Si incumples alguna de estas reglas tu usuario será banneado. </b><br><br>

2 Al ser Staff del hotel:<br><br>

2.1 No utilizarás los comandos en beneficio propio o para amigos.<br>
2.2 No darás más de 500 mil créditos en concursos.<br>
2.3 No enviarás alertas sin sentido, ni colocarás noticias sin sentido.<br>
2.4 No bannearás/kickearás sin razón.<br>
2.5 No insultarás a ningún usuario, aunque este te insulte.<br>
2.6 Moderarás SIEMPRE el hotel y no te quedarás vagueando.<br>
2.7 No harás más de 5 noticias por semana.<br>
2.8 No ignorarás a los usuarios que te pidan ayuda.<br>
2.9 Los imperios son solo para los usuarios, si haces uno serás destituido de tu rango.<br>
2.10 Los staffs no pueden jugar ningún juego de azar.<br><br>

<b>// Si incumples alguna de estas reglas tu usuario perderá su rango, será banneado o se le bajará el rango. //</b><br><br>

3 Al comprar o tener VIP en el hotel:<br><br>

3.1 No usarás :mimic :pull :push :override para molestar a los usuarios, siempre y cuando ellos te digan que pares.<br>
3.2 No obtienes beneficios especiales como no ser banneado o kickeado de una sala así que cumple las normas de todos los usuarios.<br>
3.3 Si no cumples las reglas, se te quitará el vip/serás banneado, según que reglas incumplas.<br>
3.4 El vip comprado por sms lo puedes comprar <a href="vip.php" >aquí</a>, después de que lo hayas comprado te llegará automaticamente.<br>
3.5 El vip por paypal tarda almenos 24 horas en llegar, si no lo obtienes en ese lapso ponte en contacto con un administrator.<br>
3.6 No se hacen devoluciones de ningún tipo.<br><br>

<b>Si incumples alguna de estas reglas tu usuario perderá el vip o será banneado</b><br><br>

4 Staff:<br><br>

4.1 Si no te conectas en 5 días se te irá bajando rango hasta que quedes como usuario.<br>
4.2 Respetarás todas las reglas del apartado 2.<br>
4.3 El hotel tiene el derecho de quitarte el rango cuando sea necesario.<br>
4.4 No te daras placas sin permiso.<br>
4.5 No puedes tener mas de 10 millones de creditos al igual que pixeles.<br>
4.6 No banearas a alguien solo porque te cayo mal o te insulto.<br><br>

<b>Si incumples alguna de estas reglas tu usuario perderá tu rango/será banneado/se le bajará el rango.</b><br><br>

5 Usuarios del Chat:<br><br>

5.1 No haras linea.<br>
5.2 No pasaras otras paginas en el chat.<br>
5.3 No pediras(se gana, no se pide).<br>
5.4 No insultaras a nadien(dueños,mods,members,usuarios).<br>
5.5 No pediras rango en el hotel.<br>
5.6 No insultaras el hotel
5.7 No pediras ningun dato personal a nadien<br><br>

<b>Si incumples alguna de estas reglas tu usuario perdera member o seras baneado.</b><br><br>

6 Mods y Dueños del chat:<br><br>

6.1 No daras member a cualquiera.<br>
6.2 No insultaras a nadien.<br>
6.3 No daras kik o baneo sin razon a alguien.<br>
6.4 No pasaras otras paginas.<br><br>

<b>Si incumples alguna de estas reglas tu usuario perdera rango,se te bajara rango o seras baneado.</b><br>

			</section>	
	</div>
	        <div id="column2">
					    <section class="menu"><section class="menu2">
			<center><b>Dueños</b></center></section>
						<?php
			$rankq = mysql_query("SELECT * FROM `ranks` WHERE id = '8' ORDER BY id DESC");
			$rank = mysql_fetch_array($rankq);
			$expsql = mysql_query("SELECT * FROM users WHERE rank = ".$rank['id']." ORDER BY id DESC");
			while($exp = mysql_fetch_array($expsql))
			{
				?>
				<div class="StaffBox">
					<img src="http://www.habbo.com/habbo-imaging/avatarimage?figure=<?php echo $exp['look']; ?>" alt="<?php echo $exp['username']; ?>" style="float:left" />

					<div class="Usersname"><a href="home.php?u=<?php echo $exp['username']; ?>"><?php echo $exp['username']; ?></a></div>
					<div class="Usersmotto"><?php echo $staff['motto']; ?></div>
					<img src="./Public/Images/badges/ADM.gif" alt="Teen Staff" />
				</div>
            <?php } ?>
			</section>
			
    	<?php include("site/sideads.php"); ?>
	</div>
	
	<?php include("site/footer.php"); ?>
</div>

</body>
</html>