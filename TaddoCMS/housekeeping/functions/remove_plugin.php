<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../../global.php");
$username = $core->EscapeString($_SESSION['username']);
if(!$users->UserPermission('hk_plugins', $username))
{
header("Location: ../nopermission.php");
die;
}
if(isset($_GET['id']))
{
	$pluginq = mysql_query("SELECT * FROM plugin WHERE id = '".$_GET['id']."'");
	$plugin = mysql_fetch_array($pluginq);
	eval($plugin['uninstall_code']);
	mysql_query("DELETE FROM plugin WHERE id = '".$_GET['id']."'");
}
else
echo 'Error.';
?>