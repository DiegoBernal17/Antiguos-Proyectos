<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include('global.php');
define("THIS_SCRIPT", 'settings');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title><?php echo $sitename; ?> - Ajustes</title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="Public/JS/jquery.history.js"></script>
    <link type="text/css" rel="stylesheet" href="Public/Styles/CSS/main.css" />
    <link type="text/css" rel="stylesheet" href="Public/Styles/CSS/main2.css" />

</head> 
<script type="text/javascript">

	function doCheckMail() {
		name = $("#email").val();
		$.get("./register/mailcheck.php", {ajaxAct: "check_habbo_name", mail: name}, function(data) {
			if( $.trim(data) == "0" ) {
				$("#habbo_name_message_box").html("<h3>Este email está siendo usado.</h3> No puedes usar un email que ya está siendo usado.");
				$("#habbo_name_message_box").removeClass().addClass("errormsg");
				MailisFree = 0;
			} else {
				MailisFree = 1;
			}
		});
	}

$().ready(function() {
	$('#email').keypress(function(e){
		if(e.which == 13){
			doCheckMail();
		}
	});

	$('#email').blur(function(e){
		doCheckMail();
	});

	$("#UserEmail").validate({
		submitHandler: function(form) {
			doCheckMail();
			if (MailisFree === 1) {
				form.submit();
			}
		},
		rules: {
			email: {
				required: true,
				email: true
			}
		},
		messages: {
			email: "Por favor por un email válido."
		}
	});	
});

MailisFree = 0;

</script>

 <?php
if(!isset($_GET['page']))
$_GET['page'] = 'general';
?>
<body> 

	<?php include("site/header.php"); ?>
	
	<div class="mid">
	<?php include("site/nav.php"); ?>
	<div id="column1">
    <?php include("site/homenav.php"); ?>
			<?php
		$userq = mysql_query("SELECT * FROM users WHERE username = '".$_SESSION['username']."' LIMIT 1");
		$user = mysql_fetch_array($userq);
        if($_GET['page'] == 'general')
		{ ?>
		    <section class="menu"><section class="menu2">
			<center><b>Ajustes Generales</b></center></section>
				<?php
                if(isset($_GET['success']) && $_GET['success'] == 'false')
				{
				?>
					<div class="errormsg" id="habbo_name_message_box"> 
						<h3>Ha ocurrido un error</h3> 
					</div>
				<?php
				}
                elseif(isset($_GET['success']) && $_GET['success'] == 'true')
				{
				?>
					<div class="goodmsg" id="habbo_name_message_box"> 
						<h3>Tus ajustes se han actualizado.</h3> 
					</div>
				<?php } ?>
				<form name="UserSettings" action="functions/updateusersettings.php" method="post">
					<p><strong>Peticiones de amigos</strong><br/>
					<input type="checkbox" name="friendreqs" id="friendreqs" <?php if($user['block_newfriends'] == 0) echo 'checked=checked'; ?> />
					<label for="friendreqs">Permitir que te envien peticiones</label></p>
					<p><strong>Estado Online</strong><br/>
					<input type="checkbox" name="online" id="online" <?php if($user['hide_online'] == 0) echo 'checked=checked'; ?>  />
					<label for="online">Permitir que tus amigos vean si estás online</label></p>
					<p><strong>Ajustes seguir usuario</strong><br/>
					<input type="checkbox" name="stalking" id="stalking" <?php if($user['hide_inroom'] == 0) echo 'checked=checked'; ?>  />
					<label for="stalking">Permitir que tus amigos te sigan</label></p>
					<div class="Submitbtn right">
						<button type="submit" class="positive" name="submitcomment">Aceptar</button>
		   			</div></form>
			</section>
		<?php } if($_GET['page'] == 'email') { ?>
		<section class="menu"><section class="menu2">
		<center><b>Ajustes de Email</b></center></section>
						<?php
                if(isset($_GET['success']) && $_GET['success'] == 'false')
				{
				?>
					<div class="errormsg" id="habbo_name_message_box"> 
						<h3>Ha ocurrido un error</h3> 
					</div>
				<?php
				}
                elseif(isset($_GET['success']) && $_GET['success'] == 'true')
				{
				?>
					<div class="goodmsg" id="habbo_name_message_box"> 
						<h3>Tu email ha sido actualizado</h3> 
					</div>
				<?php
				}
				if($user['mail_verified'] != 'true')
				{
				?>
					<div class="goodmsg" id="habbo_name_message_box"> 
						<h3>Tu email ha sido verificado correctamente</h3> 
					</div>
                <?php
				}
				if(isset($_GET['sent']) && $_GET['sent'] == 'true')
				{
				?>
					<div class="goodmsg" id="habbo_name_message_box"> 
						<h3>Te hemos enviado un email.</h3> Comprueba tu correo
					</div>
				<?php
				}
				if(isset($_GET['validated']) && $_GET['validated'] == 'true')
				{
				?>
					<div class="goodmsg" id="habbo_name_message_box"> 
						<h3>Tu dirección de email ha sido verificada</h3> 
					</div>
				<?php
				}
				?>
				<form id="UserEmail" name="UserEmail" action="functions/updatemail.php" method="post">
					<label for="email">Dirección de email</label><br/>
					<input type="text" name="email" id="email" value="<?php echo $user['mail']; ?>" /><br/>
					<div class="Submitbtn right">
					    <button type="submit" class="positive" name="submitcomment">Aceptar</button>
		   			</div>
	   			</form>
		</section>
		<?php } if($_GET['page'] == 'password') { ?>
		<section class="menu"><section class="menu2">
		<center><b>Contraseña</b></center></section>
						<?php
                if(isset($_GET['success']) && $_GET['success'] == 'false')
				{
				?>
					<div class="errormsg" id="habbo_name_message_box"> 
						<h3>Ha ocurrido un error</h3> 
					</div>
								<?php
				}
                elseif(isset($_GET['success']) && $_GET['success'] == 'true')
				{ ?>
					<div class="goodmsg" id="habbo_name_message_box"> 
						<h3>Tu contraseña ha sido actualizada</h3> 
					</div>
				<?php } ?>
				<form name="UserPassword" action="functions/updatepassword.php" method="post">
					<label for="curpassword">Contraseña Actual</label><br/>
					<input type="password" name="curpassword" id="curpassword" /><br/>
					<label for="newpassword">Nueva contraseña (Debe ser al menos de 6 carácteres) </label><br/>
					<input type="password" name="newpassword" id="newpassword" /><br/>
					<label for="conpassword">Confirmar contraseña</label><br/>
					<input type="password" name="conpassword" id="conpassword" /><br/>
					<div class="Submitbtn right">
						<button type="submit" class="positive" name="submitcomment">Aceptar</button>
		   			</div>
	   			</form>
		</section>
				<?php } ?></div>
	        <div id="column2">
			 <section class="menu"><section class="menu2">
			<center><b>Ajustes de cuenta</b></center></section>
			<a href="?page=general" <?php if($_GET['page'] == 'general') echo 'class="selected"'; ?>>Ajustes generales</a><br/>
			<a href="?page=email" <?php if($_GET['page'] == 'email') echo 'class="selected"'; ?>>Ajustes de Email</a><br/>
			<a href="?page=password" <?php if($_GET['page'] == 'password') echo 'class="selected"'; ?>>Contraseña</a>
			</section>
			
    	<?php include("site/sideads.php"); ?>
	</div>
	
	<?php include("site/footer.php"); ?>
<td><center>
</div>

</body>
</html>