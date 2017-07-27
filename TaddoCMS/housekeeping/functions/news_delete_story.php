<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../../global.php");
$username = $core->EscapeString($_SESSION['username']);
if(!$users->UserPermission('hk_news', $username))
{
header("Location: ../nopermission.php");
die;
}
if(isset($_GET['id']))
{
	$query = mysql_query("DELETE FROM cms_news WHERE id = '".$core->EscapeString($_GET['id'])."'");
}
?>