<?php 
// Filtro tabla mysql con ajax php & mysql
// Demo Script

// Variables de conexion
$server = "localhost";
<<<<<<< HEAD
$user	= "gps";
$pwd    = "12345";
$bd     = "scmth";
=======
$user	= "root";
$pwd    = "LuisOskr";
$bd     = "proyecto";
>>>>>>> 46cfff9f18cc7cc7f873a2d4ad45d29eff62ab60

$cn = mysql_connect($server, $user, $pwd) or die("Error de conexion!");
mysql_select_db($bd, $cn);

?>