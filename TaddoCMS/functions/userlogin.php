<?php
define('USERNAME_REQUIRED', FALSE);
define('ACCOUNT_REQUIRED', FALSE);
include('../global.php');
if(isset($_GET['name']))
{
	$username = $core->EscapeString($_GET['name']);
	$email = $core->EscapeString($_SESSION['account']);
	$userq = mysql_query("SELECT * FROM users WHERE username ='".$username."' LIMIT 1");
	if(mysql_num_rows($userq) > 0)
	{
		if($users->CheckBan($username))
		{
		header($users->BanInfo($username));
		die;
		}
		$userq = mysql_query("SELECT * FROM users WHERE username ='".$username."'");
		$user = mysql_fetch_array($userq);
		if($user['mail'] == $email)
		{
			$_SESSION['username'] = $users->UserInfo($username, 'username');
			$query = mysql_query("UPDATE users SET last_online = UNIX_TIMESTAMP(), ip_last = '".$_SERVER['REMOTE_ADDR']."' WHERE username = '".$username."'");
			header("Location: ../me.php");
		}
		else
		header("Location: ../characters.php?error=username");
	}
	else
	header("Location: ../characters.php?error=username");
}
else
header("Location: ../characters.php?error=username");
?>