<?php
define('USERNAME_REQUIRED', FALSE);
define('ACCOUNT_REQUIRED', FALSE);
include('global.php');
if(isset($_POST['username']))
{
	if(isset($_POST['password']))
	{
		$username = $core->EscapeString($_POST['username']);
		$password = md5($_POST['password']);
		$userq = mysql_query("SELECT * FROM users WHERE username ='".$username."'");
		if(mysql_num_rows($userq) > 0)
		{
		if($users->CheckBan($username))
		{
		header($users->BanInfo($username));
		die;
		}
			$userq = mysql_query("SELECT * FROM users WHERE username ='".$username."'");
			$user = mysql_fetch_array($userq);
			if($password == strtolower($user['password']))
			{
				$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE username ='".$username."'"));
				$_SESSION['username'] = $users->UserInfo($username, 'username');
				$_SESSION['account'] = $user['mail'];
				$query = mysql_query("UPDATE users SET last_online = UNIX_TIMESTAMP(), ip_last = '".$_SERVER['REMOTE_ADDR']."' WHERE username = '".$username."'");
				header("Location: ./me.php");
			}
			else
			header("Location: ./index.php?error=password");
		}
		else
		{
			$userq = mysql_query("SELECT * FROM users WHERE mail ='".$username."'");
			if(mysql_num_rows($userq) > 0)
			{
				$user = mysql_fetch_array($userq);
				if($password == strtolower($user['password']))
				{
					$_SESSION['account'] = $username;
					header("Location: ./characters.php");
				}
				else
				header("Location: ./index.php?error=password");
			}
			else
			header("Location: ./index.php?error=username");
		}
	}
	else
	header("Location: ./index.php?error=password");
}
else
header("Location: ./index.php?error=username");
?>