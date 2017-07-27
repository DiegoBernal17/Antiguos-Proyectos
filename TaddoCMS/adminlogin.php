<?php
define('USERNAME_REQUIRED', FALSE);
define('ACCOUNT_REQUIRED', FALSE);
define('MAINTENANCE_PAGE', TRUE);
include('global.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $sitename; ?></title>
		<link type="text/css" rel="stylesheet" href="./Public/Styles/CSS/login.css" />
</head>

<body>

<div class="loginBox">
	<div class="top">
		<a href="./"><img src="./Public/Styles/Images/logo.png" /></a>
		<?php echo $core->UsersOnline(); ?> Usuarios online
	</div>
	
	<div class="mid">
		<div class="loginForm">
			<?php
            if(isset($_GET["error"]) && $_GET["error"] == "password")
			{
			?>
				<div class="errormsg" id="habbo_name_message_box"> 
					<h3>Wrong password</h3> 
					Make sure you typed it out correctly!
				</div>
			<?php 
			}
			elseif(isset($_GET["error"]) && $_GET["error"] == "username")
			{
			?>
				<div class="errormsg" id="habbo_name_message_box"> 
					<h3>Wrong username</h3> 
					Make sure you typed it out correctly!
				</div>
			<?php
			}
			?>
			<form action="./login.php" method="post">
				Entrada de administrador<br /><br /> 
				Nombre o Email:<br /><input type="text" name="username" /><br /><br />
				Contraseña:<br /><input type="password" name="password" /><br /><br /> 
				<input type="submit" value="Entrar" onmousedown="this.style.backgroundColor='#ddd';" onmouseup="this.style.backgroundColor='#eee';" onmouseover="this.style.backgroundColor='#eee';" onmouseout="this.style.backgroundColor='#fff';" /> 
			</form>
		</div>
	</div>
	
	<?php include("site/footer.php"); ?>
</div>

</body>
</html>