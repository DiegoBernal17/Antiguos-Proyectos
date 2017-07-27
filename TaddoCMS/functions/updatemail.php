<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../global.php");
if(isset($_POST['email']))
{
	$email = $core->EscapeString($_POST['email']);
	$username = $core->EscapeString($_SESSION['username']);
	$userq = mysql_query("SELECT * FROM users WHERE username = '".$username."' LIMIT 1");
	$user = mysql_fetch_array($userq);
	$check = mysql_query("SELECT * FROM users WHERE mail = '".$email."' AND mail != '".$user['mail']."' LIMIT 1");
	if(mysql_num_rows($check) == 0)
	{
		$query = mysql_query("UPDATE users SET mail = '".$email."', mail_verified = 0 WHERE mail = '".$user['mail']."'") or header("location: ../settings.php?page=email&success=false");
		$_SESSION['account'] = $email;
		header("location: ../settings.php?page=email&success=true");
	}
	else
	header("location: ../settings.php?page=email&success=false");
}
?>