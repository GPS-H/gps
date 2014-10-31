<?php
require_once("clases/clase_login.php");
include_once('clases/clases.php');
if(!isset($_SESSION['usuario']) and !isset ($_SESSION['tipo_usuario'])){
	header('location:index.php');
}
$usuario=limpiar($_SESSION['usuario']);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include("head.php"); ?>
		<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
		<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>

	</head>
	<body>
		<?php include("header.php"); ?>
		<div class="container">
			<table class="table table-bordered">
			  <tr class="info">
				<td>
					<div class="row-fluid">
						<div class="span5">
							<h3 class="text-info"><img src="img/usuario.png" class="img-circle" width="80" height="80"> 
							Registro y Control de Pacientes</h3>        
						</div>
					</div>
				</td>
			  </tr>
			</table>

			<table class="table table-bordered table table-hover">
			  <tr class="info">
				<td><strong>Nombres</strong></td>
				<td><strong>Apellidos</strong></td>
				<td><strong>Direccion</strong></td>
				<td><strong>Correo</strong></td>
				<td><strong><center>Telefono</center></strong></td>
				<td><strong><center>Celular</center></strong></td>
				<td><strong><center>Filtro</center></strong></td>
				<td><strong><center>Operacion</center></strong></td>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td>Nombre1</td>
				<td>Apellido1</td>
				<td>Conocido</td>
				<td>Correo1</td>
				<td>92838373</td>
				<td>93938383</td>
				<td>ID del filtro</td>
				<td>
					<center>
					<a href="#" role="button" class="btn btn-mini" data-toggle="modal" title="Actualizar Informacion">
						<i class="icon-edit">eliminar</i>
					</a>
					<a href="#" role="button" class="btn btn-mini" data-toggle="modal" title="Asignar Materias">
						<i class="icon-briefcase">actualizar</i>
					</a>
					</center>
				</td>
			  </tr>
			</table>
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="js/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>