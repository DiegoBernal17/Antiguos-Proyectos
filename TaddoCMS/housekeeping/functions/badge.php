<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../../global.php");
$username = $core->EscapeString($_SESSION['username']);
if(!$users->UserPermission('hk_badge', $username))
{
header("Location: ../nopermission.php");
die;
}
if(isset($_POST['method']) && isset($_POST['username']) && isset($_POST['badge']) && $_POST['method'] == 'add')
{
	$query = mysql_query("INSERT INTO user_badges (user_id, badge_id, badge_slot) VALUES ('".$users->UserID($core->EscapeString($_POST['username']))."', '".$core->EscapeString($_POST['badge'])."', 0)");
}
if(isset($_POST['method']) && isset($_POST['user']) && isset($_POST['badge']) && $_POST['method'] == 'remove')
{
	$query = mysql_query("DELETE FROM user_badges WHERE user_id = '".$core->EscapeString($_POST['user'])."' AND badge_id = '".$core->EscapeString($_POST['badge'])."'");
}
?>