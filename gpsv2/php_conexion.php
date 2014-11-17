<?php
	
	$conexion = mysql_connect("localhost:3306","gps","12345");
	mysql_select_db("scmth",$conexion);

	
	date_default_timezone_set("America/Mexico_City");
	$s='$';
	
	function limpiar($tags){
		$tags = strip_tags($tags);
		return $tags;
	}

	
?>