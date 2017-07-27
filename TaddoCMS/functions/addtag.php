<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../global.php");
	if(strlen($core->EscapeString($_POST['tag'])) <= 20 && isset($_POST['tag']) && mysql_num_rows(mysql_query("SELECT * FROM user_tags WHERE user_id = '".$users->UserID($_SESSION['username'])."'")) <= 15)
	{
		$comment = $core->EscapeString($_POST['comment']);
		$query = mysql_query("INSERT INTO user_tags (id, user_id, tag) VALUES (NULL, '".$users->UserID($_SESSION['username'])."', '".$core->EscapeString($_POST['tag'])."')");
		header("location: ../home.php");
	}
	else
	{
	header("location: ../index.php");
	}
?>