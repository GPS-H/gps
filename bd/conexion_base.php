<?php 
// Filtro tabla mysql con ajax php & mysql
// Demo Script

// Variables de conexion
$server = "localhost";
$user	= "root";
$pwd    = "LuisOskr";
$bd     = "proyecto";

$cn = mysql_connect($server, $user, $pwd) or die("Error de conexion!");
mysql_select_db($bd, $cn);

?>