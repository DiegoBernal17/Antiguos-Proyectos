<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../global.php");
if(isset($_POST['cmd'])){
	$folder=$core->EscapeString($_POST['folder']);
	$cmd=$core->EscapeString($_POST['cmd']);
	$id=$core->EscapeString($_POST['id']);
	$userid=$users->UserID($_SESSION['username']);
	if(($folder=='trash') && ($cmd=='et')) $query = mysql_query("DELETE FROM cms_pm WHERE toid='".$userid."' AND folder='trash'");
	if($cmd=='move') $query = mysql_query("UPDATE cms_pm SET folder='inbox' WHERE id=".$id." AND toid='".$userid."'");
	}	
elseif(is_numeric($_POST['id'])){
	$folder=$core->EscapeString($_POST['folder']);
	$userid=$users->UserID($_SESSION['username']);
	$id=$core->EscapeString($_POST['id']);
	if($folder=='inbox') $query = mysql_query("UPDATE cms_pm SET folder='trash' WHERE id=".$id." AND toid='".$userid."'");
	if($folder=='outbox') $query = mysql_query("DELETE FROM cms_pm WHERE fromid='".$userid."' AND id='".$id."'");
	if($folder=='trash') $query = mysql_query("DELETE FROM cms_pm WHERE toid='".$userid."' AND id='".$id."'");
	}

?>