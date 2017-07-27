<?php
define('USERNAME_REQUIRED', FALSE);
define('ACCOUNT_REQUIRED', FALSE);
include("../global.php");
if(!isset($_SESSION['username']))
{
	$mail = $core->EscapeString($_GET['mail']);
	if($users->ValidMail($mail) && !$users->MailTaken($mail))
	echo 1;
	else
	echo 0;
}
else
{
	$mail = $core->EscapeString($_GET['mail']);
	$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE username = '".$_SESSION['username']."' LIMIT 1"));
	$query = mysql_query("SELECT * FROM users WHERE mail = '".$mail."' AND mail != '".$user['mail']."' LIMIT 1");
	if(mysql_num_rows($query) > 0)
		echo 0;
	else
		echo 1;
}
?>