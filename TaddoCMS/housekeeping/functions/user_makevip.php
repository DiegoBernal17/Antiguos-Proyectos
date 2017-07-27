<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../../global.php");
$username = $core->EscapeString($_SESSION['username']);
if(!$users->UserPermission('hk_edit', $username))
{
header("Location: ../nopermission.php");
die;
}
if(isset($_POST['id']) && isset($_POST['vip']) && isset($_POST['rank']))
{
	if($users->UserRank($users->UserName($core->EscapeString($_POST['id']))) == 1 || $users->UserRank($users->UserName($core->EscapeString($_POST['id']))) == 2)
	$rank = $core->EscapeString($_POST['rank']);
	else
	$rank = $users->UserRank($users->UserName($core->EscapeString($_POST['id'])));
	$query = mysql_query("UPDATE users SET vip = '".$core->EscapeString($_POST['vip'])."', rank = '".$rank."' WHERE id ='".$core->EscapeString($_POST['id'])."'");
}
?>