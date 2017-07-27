<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../../global.php");
$username = $core->EscapeString($_SESSION['username']);
if(!$users->UserPermission('hk_ban', $username))
{
header("Location: ../nopermission.php");
die;
}
if(isset($_POST['id']))
{
	$query = mysql_query("DELETE FROM bans WHERE id = '".$core->EscapeString($_POST['id'])."'");
	$core->MUS("reloadbans");
}
?>