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
if(isset($_POST['id']) && isset($_POST['caption']) && isset($_POST['owner']) && isset($_POST['model_name']) && isset($_POST['state']) && isset($_POST['users_max']))
{
	$query = mysql_query("UPDATE rooms SET caption = '".$core->EscapeString($_POST['caption'])."', owner = '".$core->EscapeString($_POST['owner'])."', state = '".$core->EscapeString($_POST['state'])."', model_name = '".$core->EscapeString($_POST['model_name'])."', password = '".$_POST['password']."', users_max = '".$core->EscapeString($_POST['users_max'])."' WHERE id ='".$core->EscapeString($_POST['id'])."'");
}
?>