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
if(isset($_POST['shortstory']) && isset($_POST['longstory']) && isset($_POST['image']) && isset($_POST['title']) && isset($_POST['campaign']))
{
	$query = mysql_query("INSERT INTO cms_news (id, title, shortstory, longstory, author, published, image, campaign, campaignimg) VALUES
(NULL, '".$core->EscapeStringHK($_POST['title'])."', '".$core->EscapeStringHK(urldecode($_POST['shortstory']))."', '".$core->EscapeStringHK(urldecode($_POST['longstory']))."', ".$users->UserID($username).", ".time().", '".$core->EscapeStringHK($_POST['image'])."', ".$core->EscapeStringHK($_POST['campaign']).", '".$core->EscapeStringHK($_POST['campaignimage'])."')");
}
?>
