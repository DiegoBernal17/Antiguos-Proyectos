<?php
define('USERNAME_REQUIRED', FALSE);
define('ACCOUNT_REQUIRED', FALSE);
include("../global.php");
$username = $core->EscapeString($_GET['habbo_name']);

$username=str_replace(' ', '', $username);
$to_users=explode(";", $username);

$i=1;
foreach ($to_users as $id) {

if(!$users->NameTaken($id)) $i++;
}
if($i==1) echo 1;
else echo 0;
?>