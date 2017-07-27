<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../global.php");
$username = $core->EscapeString($_SESSION['username']);
if(!$users->UserPermission('hk_login', $username))
{
header("Location: ../index.php");
die;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<title><?php echo $sitename." - Housekeeping"; ?></title>
	<link type="text/css" rel="stylesheet" href="includes/style.css" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script type="text/javascript" src="includes/jquery.tooltip.js"></script>
	<script language="javascript">
		var OldPage = 'basics';
		
		function LoadPage(PageName) {
		    $('.page').css('display', 'none');
		    $('.overlay').css('display', 'none');
			$.ajax({
			   type: "POST",
			   url: PageName + ".php",
			   success: function(msg){
			     $('.conColumn').html(msg);
			     $('li#' + OldPage).removeClass('selected');
			     $('li#' + PageName).addClass('selected');
			     OldPage = PageName;
			   }
			 });
		}
		
		$(document).ready(function() {
			LoadPage('basics');
		});
	</script>
</head>

<body>
	<div class="overlay hidden"></div>
	<div class="navColumn">
		<div>
			<h1>Ajustes</h1>
			<ul>
            	<li onclick="window.location='../index.php'" id="site">Ir A Tu Hotel</li>
                <li></li>
				<li onclick="LoadPage('basics');" id="basics" class="selected">Basico</li>
				<li onclick="LoadPage('news');" id="news">Noticias</li>
				<li onclick="LoadPage('users');" id="users" >Usuarios</li>
				<li onclick="LoadPage('rooms');" id="rooms">Salas</li>
                <li onclick="LoadPage('mod');" id="mod">MOD Utilidades</li>
                <li onclick="LoadPage('voucher');" id="voucher">Voucher de credito</li>
                <li onclick="LoadPage('badge');" id="badge">Placas</li>
                <li onclick="LoadPage('permissions');" id="permissions">Permisos & Rangos</li>
                <li onclick="LoadPage('plugins');" id="plugins">Plugins</li>
                <?php
				$getplugin = mysql_query("SELECT * FROM plugin WHERE hk_tab = '1'");
				while($plugin = mysql_fetch_array($getplugin))
				{
					echo '<li onclick="LoadPage(\''.$plugin['hk_link'].'\');" id="'.$plugin['hk_link'].'">'.$plugin['hk_text'].'</li>';
				}
				?>
			</ul>
		</div>
	</div>
		
	<div class="conColumn">
	</div>
</body>

</html>
