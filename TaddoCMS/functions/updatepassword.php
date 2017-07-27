<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../global.php");
	$username = $_SESSION['username'];
	$curpassword = md5($_POST['curpassword']);
	$newpassword = md5($_POST['newpassword']);
	$conpassword = md5($_POST['conpassword']);
	$userq = mysql_query("SELECT * FROM users WHERE username = '".$_SESSION['username']."' LIMIT 1");
	$user = mysql_fetch_array($userq);
	if($curpassword == strtolower($user['password']) && $newpassword == $conpassword && strlen($_POST['newpassword']) >= 6)
	{
	$query = mysql_query("UPDATE users SET password = '".$newpassword."' WHERE mail = '".$user['mail']."'") or header("location: ../settings.php?page=password&success=false");
	header("location: ../settings.php?page=password&success=true");
	}
	else
	header("location: ../settings.php?page=password&success=false");
?>