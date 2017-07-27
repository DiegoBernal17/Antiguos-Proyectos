<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include('global.php');
if(is_numeric($_GET['id']) && isset($_GET['id']))
{
	$query = mysql_query("SELECT * FROM users WHERE id = '".$core->EscapeString($_GET['id'])."' LIMIT 1");
	$user = mysql_fetch_array($query);
	header("Location: ".WWW."/home.php?u=".$user['username']);
}
else
{
	header("Location: ".WWW."/index.php");
}
?>