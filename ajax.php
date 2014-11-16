<?php 
include("bd/conexion_base.php");

if($_GET['action'] == 'listar')
{
	// valores recibidos por POST
	$vnm   = $_POST['buscar'];
	
	$sql = "SELECT * FROM pacientes   ";	
										
	// Vericamos si hay algun filtro
	$sql .= ($vnm != '')      ? " where Apellidos  LIKE '%$vnm%'" : "";
													
	
	// Ordenar por
	$vorder = $_POST['orderby'];
	
	if($vorder != ''){
		$sql .= " ORDER BY ".$vorder;
	}
	
	$query = mysql_query($sql);
	$datos = array();
	
	while($row = mysql_fetch_array($query))
	{
		$datos[] = array(
			
			'nombre'      => $row['Nombre'],
			'apellidos'  => $row['Apellidos'],
			'direccion'  => $row['Direccion'],
			'email'  => $row['Correo'],
			'celular'  => $row['Celular'],
			'telefono'  => $row['Telefono']
		);
	}
	// convertimos el array de datos a formato json
	echo json_encode($datos);
}

?>