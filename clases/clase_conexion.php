<?php
class Conexion
{
	public static function conectar()
	{
		$conexion = mysql_connect("localhost:3306","root","");
		mysql_query("SET NAMES 'utf8'");
		mysql_select_db("scmth");
		return $conexion;
	}
}
?>

