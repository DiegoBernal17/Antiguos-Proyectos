<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../../global.php");
$username = $core->EscapeString($_SESSION['username']);
if(!$users->UserPermission('hk_voucher', $username))
{
header("Location: ../nopermission.php");
die;
}
if(isset($_POST['code']) && isset($_POST['value']) && is_numeric($_POST['value']))
{
	$query = mysql_query("INSERT INTO credit_vouchers (code, value) VALUES ('".$core->EscapeString($_POST['code'])."', '".$core->EscapeString($_POST['value'])."');");
}
?>