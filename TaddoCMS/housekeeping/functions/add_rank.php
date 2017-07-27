<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../../global.php");
$username = $core->EscapeString($_SESSION['username']);
if(!$users->UserPermission('hk_permissions', $username))
{
header("Location: ../nopermission.php");
die;
}
if(isset($_POST['name']))
{
	mysql_query("INSERT INTO ranks SET name = '".$core->EscapeString($_POST['name'])."', badgeid = '".$core->EscapeString($_POST['badgeid'])."'");
}
?>