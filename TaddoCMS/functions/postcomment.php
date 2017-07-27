<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../global.php");
	if($_POST['uid'] == $users->UserID($_SESSION['username']) && is_numeric($_POST['story']) && strlen($core->EscapeString($_POST['comment'])) <= 160)
	{
		$comment = $core->EscapeString($_POST['comment']);
		$query = mysql_query("INSERT INTO cms_comments (id, story, comment, date, author) VALUES (NULL, '".$core->EscapeString($_POST['story'])."', '".$comment."', '".time()."', '".$core->EscapeString($_POST['uid'])."');");
	}
	else
	{
	session_destroy();
	header("location: ../index.php");
	}
?>