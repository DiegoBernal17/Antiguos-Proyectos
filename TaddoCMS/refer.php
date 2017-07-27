<?php
///// Conexión con la base de datos /////
define('USERNAME_REQUIRED', FALSE);
define('ACCOUNT_REQUIRED', FALSE);
include("global.php");
///// Termina conexión con la base de datos /////

///// Variables /////
$r = $_GET['r'];
$ip = $_SERVER['REMOTE_ADDR'];
///// Terminan variables /////


///// Verificar si existe el usuario /////
$sql = mysql_query("SELECT * FROM users WHERE ip_last='".$ip."'");
    if(mysql_num_rows($sql) > 0) {
header("Location: ".WWW."");
        die;
//// Termina verificar usuario /////
    }
else
{
///// Verificar si existe el referido /////
$sql = mysql_query("SELECT * FROM users_referidos WHERE ip_referida='$_SERVER[REMOTE_ADDR]'");
    if(mysql_num_rows($sql) > 0) {
header("Location: ".WWW."");
        die;
///// Termina verificar referido /////
    }
else
{

mysql_query("INSERT INTO users_referidos (id, usuario, ip_referida, fecha) VALUES (LAST_INSERT_ID(), '".$r."', '".$ip."', NOW());");

header("Location: ".WWW."");
}
}
?>