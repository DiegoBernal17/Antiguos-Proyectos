<?php
define('USERNAME_REQUIRED', FALSE);
define('ACCOUNT_REQUIRED', FALSE);
include('global.php');
echo $pms->NewPM($users->UserID($_SESSION['username']));
?>
