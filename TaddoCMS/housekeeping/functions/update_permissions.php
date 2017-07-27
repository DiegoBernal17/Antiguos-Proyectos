<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../../global.php");
$username = $core->EscapeString($_SESSION['username']);
if(!$users->UserPermission('hk_permissions', $username))
{
header("Location: ../nopermission.php");
die;
}
if(isset($_POST['type']) && $_POST['type'] == 'rank')
{
$skip=array('type','rank');
foreach($_POST as $k=>$v){
        if(!in_array($k, $skip)){
        @$permissions.=" ".mysql_real_escape_string($k)." = '".mysql_real_escape_string($v)."',";
}}
$permissions = rtrim($permissions,',');
$permissions = mysql_query("UPDATE permissions_ranks SET".$permissions." WHERE rank = ".$_POST['rank']);
}
?>