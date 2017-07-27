<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../../global.php");
$username = $core->EscapeString($_SESSION['username']);
if(!$users->UserPermission('hk_basics', $username))
{
header("Location: ../nopermission.php");
die;
}
if(isset($_POST['timer']) && isset($_POST['pixels']) && isset($_POST['credits']) && isset($_POST['motd']))
{
	$query = mysql_query("UPDATE server_settings SET timer = '".$core->EscapeString($_POST['timer'])."', pixels = '".$core->EscapeString($_POST['pixels'])."', credits = '".$core->EscapeString($_POST['credits'])."', motd = '".$core->EscapeString($_POST['motd'])."'");
}
?>