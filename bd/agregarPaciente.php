<?php
	require_once("conexion.php");
	$nombre=$_POST['nombre'];
	$apellido=$_POST['apellido'];
	$direccion=$_POST['direccion'];
	$correo=$_POST['correo'];
	$telefono=$_POST['telefono'];
	$celular=$_POST['celular'];
	$consulta = $mysqli->query('insert into pacientes(Nombre,Apellidos,Direccion,Correo,Telefono,Celular) values ("'.$nombre.'","'.$apellido.'","'.$direccion.'","'.$correo.'","'.$telefono.'","'.$celular.'")');
?>