<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../global.php");
if(isset($_GET['motto']))
{
	$username = $core->EscapeString($_SESSION['username']);
	$motto = $core->EscapeString($_GET['motto']);
	$query = mysql_query("UPDATE users SET motto = '".$motto."' WHERE username = '".$username."'");
	$query = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE username = '".$username."' LIMIT 1"));
	$core->MUS("updatemotto", $query['id']);
}
?>