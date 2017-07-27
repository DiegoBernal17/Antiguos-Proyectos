<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../../global.php");
$username = $core->EscapeString($_SESSION['username']);
if(!$users->UserPermission('hk_plugins', $username))
{
header("Location: ../nopermission.php");
die;
}
$path_info = pathinfo($_POST["file"]);
if($path_info['extension'] == 'xml')
{
$xml = simplexml_load_file($_POST["file"]);
mysql_query("INSERT INTO plugin (id, name, uninstall_code, hk_tab, hk_text, hk_link, cms_tab, cms_text, cms_link) VALUES
(NULL, '".$xml->name."', '".$xml->uninstall_code."', '".$xml->hk_tab."', '".$xml->hk_text."', '".$xml->hk_link."', '".$xml->cms_tab."', '".$xml->cms_text."', '".$xml->cms_link."')");
$install = $xml->install_code;
eval($install);
echo "Plugin ".$xml->name." installed.";
}
else
echo 'Error.';
?>