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
if(isset($_POST['cms_url']) && isset($_POST['cms_name']) && isset($_POST['maintenance']))
{
	mysql_query("UPDATE cms_settings SET value = '".$core->EscapeString($_POST['cms_url'])."' WHERE variable = 'cms_url'");
	mysql_query("UPDATE cms_settings SET value = '".$core->EscapeString($_POST['cms_name'])."' WHERE variable = 'cms_name'");
	mysql_query("UPDATE cms_settings SET value = '".$core->EscapeString($_POST['maintenance'])."' WHERE variable = 'maintenance'");
}
?>