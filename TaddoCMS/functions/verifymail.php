<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../global.php");
$email = $core->EscapeString($_GET['mail']);
$ver = $core->EscapeString($_GET['ver']);
$vermail = mysql_query("SELECT * FROM users WHERE mail = '$email' AND mail_verified = '$ver' LIMIT 1");
if(mysql_num_rows($vermail) > 0)
{
	$query = mysql_query("UPDATE users SET mail_verified = 'true' WHERE mail = '$email' AND mail_verified = '$ver'");
	header("location: ../settings.php?page=email&validated=true");
}
else
header("location: ../settings.php?page=email");
?>
