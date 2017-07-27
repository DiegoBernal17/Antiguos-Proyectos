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
if(isset($_POST['id']) && isset($_POST['username']) && isset($_POST['oldusername']) && isset($_POST['mail']) && isset($_POST['rank']) && isset($_POST['credits']) && isset($_POST['activity_points']) && isset($_POST['vip']))
{
	$query = mysql_query("UPDATE users SET username = '".$core->EscapeString($_POST['username'])."', real_name = '".$core->EscapeString($_POST['real_name'])."', mail = '".$core->EscapeString($_POST['mail'])."', motto = '".$core->EscapeString($_POST['motto'])."', rank = ".$core->EscapeString($_POST['rank']).", credits = '".$core->EscapeString($_POST['credits'])."', activity_points = '".$core->EscapeString($_POST['activity_points'])."', vip = '".$core->EscapeString($_POST['vip'])."' WHERE id ='".$core->EscapeString($_POST['id'])."'");
	$query = mysql_query("UPDATE rooms SET owner = '".$core->EscapeString($_POST['username'])."' WHERE owner ='".$core->EscapeString($_POST['oldusername'])."'");
	$core->MUS("updatemotto", $core->EscapeString($_POST['id']));
	$core->MUS("updatecredits", $core->EscapeString($_POST['id']));
}
?>