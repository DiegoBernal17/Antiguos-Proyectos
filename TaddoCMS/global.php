<?php
//Installation files? - Start
if(file_exists('ainstall.php'))
{
	echo 'Go to <a href="install.php">install.php</a>';
	die;
}
if(file_exists('aupdate.php'))
{
	echo 'Go to <a href="update.php">update.php</a>';
	die;
}
//Installation files? - End
define('SEP', DIRECTORY_SEPARATOR);
$dir = str_replace('register'.SEP, '', dirname(__FILE__).SEP);
$dir = str_replace('functions'.SEP, '', $dir);
$dir = str_replace('housekeeping'.SEP, '', $dir);
define('DIR', $dir);
define('DOCUMENT_ROOT', DIR.SEP);
define('INCLUDES', DIR.'InCorex'.SEP);
define('WWW', 'http://'.$_SERVER['SERVER_NAME']);

session_start();

require_once INCLUDES."config.php";

$connect = mysql_connect($host, $username, $password) or die("Could not connect to server, error: ".mysql_error());
mysql_select_db($dbname, $connect) or die("Could not connect to database, error: ".mysql_error());

require_once INCLUDES."class.core.php";
require_once INCLUDES."class.users.php";
require_once INCLUDES."class.pm.php";
$pms = new Pm();

$core = new Core();
$users = new Users();

define('MAINTENANCE', $core->Maintenance());

if(USERNAME_REQUIRED == TRUE && !isset($_SESSION["username"]))
header("Location: ".WWW."/characters.php");
if(ACCOUNT_REQUIRED == TRUE && !isset($_SESSION["account"]))
header("Location: ".WWW."/index.php");

$sitename = $core->CmsSetting('cms_name');

if(isset($_SESSION["username"]))
{
$username = $core->EscapeString($_SESSION['username']);
if($users->CheckBan($username))
header($users->BanInfo($username));
}

if(MAINTENANCE && !$users->UserPermission('hk_login', $username) && !defined('MAINTENANCE_PAGE'))
header("Location: ".WWW."/maintenance.php");
?>