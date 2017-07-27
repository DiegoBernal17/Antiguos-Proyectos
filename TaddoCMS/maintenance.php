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
				<div class="errormsg" id="habbo_name_message_box"> 
					<h3>¡Estamos en Mantenimiento!</h3> 
					¡Lo sentimos!<?php echo $sitename ?> esta en mantenimiento para mejorar,regresa pronto.<br /><br />
                    <a href="adminlogin.php">Entrada de administrador</a>
				</div>
		</div>
	</div>
	
	<?php include("site/footer.php"); ?>
</div>

</body>
</html>