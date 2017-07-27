<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../global.php");
if((isset($_POST['id'])) && (isset($_POST['reason'])) && (isset($_POST['uid']))&&($_POST['uid']==$users->UserID($_SESSION['username']))){
	$message_id=$core->EscapeString($_POST['id']);
	$reported_by=$users->UserID($_SESSION['username']);
	$reason=$core->EscapeStringHK(urldecode($_POST['reason']));
	$query = mysql_query("INSERT INTO cms_pm_report (reported_pm, reported_by, reason) VALUES ('".$message_id."', '".$reported_by."', '".$reason."');");
	$query = mysql_query("UPDATE cms_pm SET folder='report' WHERE id=".$message_id." AND toid='".$reported_by."'");
	}


?>