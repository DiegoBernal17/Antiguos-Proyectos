<?php
session_start();
include("../InCorex/config.php");
if(!isset($_SESSION["username"]))
header("Location: ../characters.php");
elseif(!isset($_SESSION["account"]))
header("Location: ../index.php");
$username = $_SESSION['username'];
$ban = mysql_query("SELECT * FROM bans WHERE bantype = 'user' AND value ='".$username."' AND expire > ".time()."");
if(mysql_num_rows($ban) > 0)
{
session_destroy();
header("Location: index.php?error=ban");
die;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<link type="text/css" rel="stylesheet" href="../Public/Styles/CSS/main2.css" />
</head>
<body style="text-align:center">
		<table style="padding:50px 50px 50px 50px;">
			<tr>
				<td width="30%"></td>
				<td style="width:64px; height:64px; background-image:url(/Public/Styles/Default/Images/icons/warning_64.png); background-repeat:no-repeat"></td>
				<td style="width:400px">
					<strong>Se produjo un problema, ¡lo siento!</strong><br/>
					Por favor, intente volver a cargar el hotel, si el problema continúa espere unos minutos antes de intentarlo de nuevo. Si usted no puede conseguir en el hotel para una identificación Pero mucho tiempo por favor informe el tema en nuestros foros.
				</td>
				<td width="30%"></td>
			</tr>
		</table>
	<?php include("../site/footer.php"); ?>
</body>