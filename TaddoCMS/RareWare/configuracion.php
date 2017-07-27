<?php
#######################################
##   RareWare v1.0.2                 ##
##   By: Leixx                       ##
##   Compatible con: Phoenix 3.5.5   ##
#######################################

// Configuración de la Tienda

### Rare Nº 1 ###
$rare1_c = (int)""; //Costo en créditos
$rare1_p = (int)"40000"; //Costo en píxeles
$rare1_i = "259"; //ID del Furni
$rare1_n = "Fontana Verde"; //Nombre del Furni

### Rare Nº 2 ###
$rare2_c = (int)""; //Costo en créditos
$rare2_p = (int)"50000"; //Costo en píxeles
$rare2_i = "414"; //ID del Furni
$rare2_n = "Dragón Dorado"; //Nombre del Furni

### Rare Nº 3 ###
$rare3_c = (int)""; //Costo en créditos
$rare3_p = (int)"40000"; //Costo en píxeles
$rare3_i = "356"; //ID del Furni
$rare3_n = "Máquina de Humo"; //Nombre del Furni

### Mensaje del Regalo ###
$MsjRegalo = " ¡Yatienes tu rare comprado desde la Home! Gracias por usar Pixel CMS";

//------------------------- No Tocar -----------------------------------------//

$userN = $_SESSION['username'];
$userI = @mysql_query("SELECT * FROM users WHERE username='". $userN ."'");
?>