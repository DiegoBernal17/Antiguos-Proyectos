<?php
define('USERNAME_REQUIRED', FALSE);
define('ACCOUNT_REQUIRED', FALSE);
include('global.php');
if(isset($_SESSION["username"]))
header("Location: me.php");
elseif(isset($_SESSION["account"]))
header("Location: characters.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title><?php echo $sitename; ?>: Has amigos, no pidas rango, diviertete, sigue las reglas</title>
		<link type="text/css" rel="stylesheet" href="./Public/Styles/CSS/login.css" />
</head>

<body>

<div class="loginBox">
	<div class="top">
		<a href="./"><img src="./Public/Styles/Images/logo.png" /></a>
		<img src="./Public/Styles/images/online.gif" /> <?php echo $core->UsersOnline(); ?> Usarios Online
	</div>
	
	<div class="mid">
		<div class="loginForm">
			<?php
            if(isset($_GET["error"]) && $_GET["error"] == "password")
			{
			?>
				<div class="errormsg" id="habbo_name_message_box"> 
					<h3>Contraseña Incorrecta</h3> 
					Asegúrate de que tu contraseña está ingresada bien
				</div>
			<?php 
			}
			elseif(isset($_GET["error"]) && $_GET["error"] == "username")
			{
			?>
				<div class="errormsg" id="habbo_name_message_box"> 
					<h3>Usuario Incorrecto</h3> 
					Asegúrate de que tu contraseña está ingresada bien
				</div>
			<?php
			}
			
			elseif(isset($_GET["error"]) && $_GET["error"] == "ban")
			{
				if(isset($_GET["user"]))
				{
				$query = mysql_query("SELECT * FROM bans WHERE value = '".$_GET["user"]."' AND expire > UNIX_TIMESTAMP() ORDER BY expire DESC LIMIT 1");
				}
				elseif(isset($_GET["ip"]))
				{
				$query = mysql_query("SELECT * FROM bans WHERE value = '".$_GET["ip"]."' AND expire > UNIX_TIMESTAMP() ORDER BY expire DESC LIMIT 1");
				}
				$ban = @mysql_fetch_array($query);
			?>
				<div class="errormsg" id="habbo_name_message_box"> 
					<h3>¡Has sido banneado!',</h3> 
					Razón: <?php echo $ban['reason']; ?><br />
                    Expira: <?php echo @date("d-m-Y H:i", $ban['expire']); ?><br />
                    MOD: <?php echo $ban['added_by']; ?>
				</div>
			<?php
			}
			?>
			<form action="./safety_check.php" method="post">
				¿Nuevo aquí? <a href="./register" class="reglink">¡Regístrate Gratis!</a><br /><br />
				  <img src="./Public/Styles/images/login.gif" width="16" height="16" /> <img src="./Public/Styles/images/usuariooemail.png" width="179" height="15" /><br />				
                  <input type="text" name="username" /><br /><br />
				  <img src="./Public/Styles/images/pass.gif" width="16" height="12" /> <img src="./Public/Styles/images/contrasena.png" width="179" height="15" /><br /><input type="password" name="password" /><br /><br /> 
				<input type="submit" value="Entrar" onmousedown="this.style.backgroundColor='#ddd';" onmouseup="this.style.backgroundColor='#eee';" onmouseover="this.style.backgroundColor='#eee';" onmouseout="this.style.backgroundColor='#fff';" /> 
			</form>
		</div>
	</div>
	
	<?php include("site/footer.php"); ?>
<td><center>

</div>

</body>
</html>
