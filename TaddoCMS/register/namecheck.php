<?php
define('USERNAME_REQUIRED', FALSE);
define('ACCOUNT_REQUIRED', FALSE);
include("../global.php");
$username = $core->EscapeString($_GET['habbo_name']);
if($users->ValidName($username) && !$users->NameTaken($username))
echo 1;
else
echo 0;
?>
