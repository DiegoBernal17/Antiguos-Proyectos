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
if(isset($_POST['client_ip']) && isset($_POST['client_port']) && isset($_POST['client_mus']) && isset($_POST['client_texts']) && isset($_POST['client_variables']) && isset($_POST['client_swf_path']) && isset($_POST['client_habbo_swf']))
{
	$query = mysql_query("UPDATE cms_settings SET value = '".$core->EscapeString($_POST['client_ip'])."' WHERE variable = 'client_ip'");
	$query = mysql_query("UPDATE cms_settings SET value = '".$core->EscapeString($_POST['client_port'])."' WHERE variable = 'client_port'");
	$query = mysql_query("UPDATE cms_settings SET value = '".$core->EscapeString($_POST['client_mus'])."' WHERE variable = 'client_mus'");
	$query = mysql_query("UPDATE cms_settings SET value = '".$core->EscapeString($_POST['client_texts'])."' WHERE variable = 'client_texts'");
	$query = mysql_query("UPDATE cms_settings SET value = '".$core->EscapeString($_POST['client_variables'])."' WHERE variable = 'client_variables'");
	$query = mysql_query("UPDATE cms_settings SET value = '".$core->EscapeString($_POST['client_swf_path'])."' WHERE variable = 'client_swf_path'");
	$query = mysql_query("UPDATE cms_settings SET value = '".$core->EscapeString($_POST['client_habbo_swf'])."' WHERE variable = 'client_habbo_swf'");
}
?>