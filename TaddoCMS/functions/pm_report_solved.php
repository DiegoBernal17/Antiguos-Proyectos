<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../global.php");
if((isset($_POST['id'])) && (isset($_POST['uid']))&&($_POST['uid']==$users->UserID($_SESSION['username']))){
	$message_id=$core->EscapeString($_POST['id']);
	$handled_by=$users->UserID($_SESSION['username']);
	$query = mysql_query("UPDATE cms_pm_report SET solved='1', handled_by='".$handled_by."' WHERE reported_pm='".$message_id."';");
	}


?>