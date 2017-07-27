<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../global.php");
	if(is_numeric($_GET['id']) && mysql_num_rows(mysql_query("SELECT * FROM user_tags WHERE id = '".$core->EscapeString($_GET['id'])."' AND user_id = '".$users->UserID($_SESSION['username'])."'")) > 0)
	{
		$query = mysql_query("DELETE FROM user_tags WHERE id = '".$core->EscapeString($_GET['id'])."'");
		$core->MUS("updatetags", $users->UserID($_SESSION['username']));
		header("location: ../home.php");
	}
	else
	{
	header("location: ../index.php");
	}
?>