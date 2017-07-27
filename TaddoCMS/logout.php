<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include('global.php');
$core->MUS('signout', $users->UserID($_SESSION['username']));
session_destroy();
header('Location: index.php');
?>