<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../../global.php");
$username = $core->EscapeString($_SESSION['username']);
if(!$users->UserPermission('hk_news', $username))
{
header("Location: ../nopermission.php");
die;
}
if(isset($_POST['shortstory']) && isset($_POST['longstory']) && isset($_POST['image']) && isset($_POST['title']) && isset($_POST['campaign']) && isset($_POST['id']))
{
	$query = mysql_query("UPDATE cms_news SET title = '".$core->EscapeStringHK($_POST['title'])."', shortstory = '".$core->EscapeStringHK(urldecode($_POST['shortstory']))."', longstory = '".$core->EscapeStringHK(urldecode($_POST['longstory']))."', image = '".$core->EscapeStringHK($_POST['image'])."', campaign = ".$core->EscapeStringHK($_POST['campaign']).", campaignimg = '".$core->EscapeStringHK($_POST['campaignimage'])."' WHERE id ='".$core->EscapeStringHK($_POST['id'])."'");
}
?>