<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../global.php");
	$username = $_SESSION['username'];
	$friendreqs = $core->EscapeString($_POST['friendreqs']);
	if($friendreqs == 'on')
	$friendreqs = 0;
	else
	$friendreqs = 1;
	$online = $core->EscapeString($_POST['online']);
	if($online == 'on')
	$online = 0;
	else
	$online = 1;
	$stalking = $core->EscapeString($_POST['stalking']);
	if($stalking == 'on')
	$stalking = 0;
	else
	$stalking = 1;
	$query = mysql_query("UPDATE users SET block_newfriends = '$friendreqs', hide_online = '$online', hide_inroom = '$stalking' WHERE username = '$username'") or header("location: ../settings.php?page=general&success=false");
	header("location: ../settings.php?page=general&success=true");
?>