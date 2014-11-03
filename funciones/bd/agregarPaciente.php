<?php
	require_once("conexion.php");
	("conexion.php");
	$nombre=$_POST['nombre'];
	$apellido=$_POST['apellido'];
	$direccion=$_POST['direccion'];
	$correo=$_POST['correo'];
	$telefono=$_POST['telefono'];
	$celular=$_POST['celular'];
	$consulta = $mysqli->query('insert into pacientes(nombre,apellido,direccion,correo,telefono,celular) values ("'.$nombre.'","'.$apellido.'","'.$direccion.'","'.$correo.'","'.$telefono.'","'.$celular.'")');
?>