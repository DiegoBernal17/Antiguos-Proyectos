<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../global.php");
	
	if($core->EscapeString($_POST['uid'])==$users->UserID($_SESSION['username'])){
		$message = $core->EscapeStringHK(urldecode($_POST['message']));
		$from=$core->EscapeString($_POST['uid']);
		$subject=$core->EscapeString($_POST['subject']);
		$tusers=$core->EscapeString($_POST['to']);
		$tusers=str_replace(' ','',$tusers);
		$to_users=explode(";", $tusers);
		foreach ($to_users as $id) {
			$to=$users->UserID($id);
			$query = mysql_query("INSERT INTO cms_pm (fromid, toid, subject, message, timestamp_sent, folder) VALUES ('".$from."', '".$to."', '".$subject."', '".$message."', '".time()."', 'inbox');");
			}
		
		if((is_numeric($_POST['save'])) && ($_POST['save']=='1')){
			$query = mysql_query("INSERT INTO cms_pm (fromid, toid, subject, message, timestamp_sent, folder) VALUES ('".$from."', '".$to."', '".$subject."', '".$message."', '".time()."', 'outbox');");
			}
	}
			
		
	
?>