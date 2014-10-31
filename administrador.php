<?php
require_once("clases/clase_login.php");
include_once('clases/clases.php');
if(!isset($_SESSION['usuario']) and !isset ($_SESSION['tipo_usuario'])){
	header('location:index.php');
}
$usuario=limpiar($_SESSION['usuario']);
$objUsuario=new ConsultarUsuario($usuario);
$nombre=$objUsuario->consultar('nombre');
$palabra=explode(" ", $nombre);
$nomb=$palabra[0];
if($_SESSION['tipo_usuario']=='a'){
	$titulo='Administrador';
}
else{
	$titulo='Enfermera';
}
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
			  <tr class="success">
				<td>
					<h3 class="text-info"><img src="img/usuario.png" class="img-circle" width="60" height="60"> 
					Bienvenid@ <?php echo $titulo ." ". $nomb; ?></h3>
				</td>
			  </tr>
			</table>

			<!-- Icon Panels - START -->
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-lg-4">
						<div class="box">
							<div class="icon">
								<div class="image"><span class="glyphicon glyphicon-list-alt btn-lg white"></span></div>
								<div class="info">
									<h3 class="title">Recalendarización!</h3>
									<p>
										<h3>5 </h3>Ultimos pacientes con recalendarizacion.
									</p>
									<div class="more">
										<a href="#" title="Title Link"><i class="fa fa-plus"></i> Mas Información
										</a>
									</div>
								</div>
							</div>
							<div class="space"></div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-lg-4">
						<div class="box">
							<div class="icon">
								<div class="image"><span class="glyphicon glyphicon-envelope btn-lg white"></span></div>
								<div class="info">
									<h3 class="title">Avizo!</h3>
									<p>
										<h3>5 </h3> Pacientes proximos a un cambio de filtro
									</p>
									<div class="more">
										<a href="#" title="Title Link"><i class="fa fa-plus"></i> Mas Información
										</a>
									</div>
								</div>
							</div>
							<div class="space"></div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-lg-4">
						<div class="box">
							<div class="icon">
								<div class="image"><span class="glyphicon glyphicon-volume-up btn-lg white"></span></div>
								<div class="info">
									<h3 class="title">Filtro Nuevo!</h3>
									<p>
										<h3>0 </h3> Pacientes con cambio de filtro el dia de hoy.
									</p>
									<div class="more">
										<a href="#" title="Title Link"><i class="fa fa-plus"></i> Mas Información
										</a>
									</div>
								</div>
							</div>
							<div class="space"></div>
						</div>
					</div>
				</div>
			</div>

			<style>
			.white {
				color: white;
			}

			.btn-lg {
				font-size: 38px;
				line-height: 1.33;
				border-radius: 6px;
			}

			.box > .icon {
				text-align: center;
				position: relative;
			}

			.box > .icon > .image {
				position: relative;
				z-index: 2;
				margin: auto;
				width: 88px;
				height: 88px;
				border: 7px solid white;
				line-height: 88px;
				border-radius: 50%;
				background: #63B76C;
				vertical-align: middle;
			}

			.box > .icon:hover > .image {
				border: 4px solid black;
			}

			.box > .icon > .image > i {
				font-size: 40px !important;
				color: #fff !important;
			}

			.box > .icon:hover > .image > i {
				color: white !important;
			}

			.box > .icon > .info {
				margin-top: -24px;
				background: rgba(0, 0, 0, 0.04);
				border: 1px solid #e0e0e0;
				padding: 15px 0 10px 0;
			}

				.box > .icon > .info > h3.title {
					color: #222;
					font-weight: 500;
				}

				.box > .icon > .info > p {
					color: #666;
					line-height: 1.5em;
					margin: 20px;
				}

			.box > .icon:hover > .info > h3.title, .box > .icon:hover > .info > p, .box > .icon:hover > .info > .more > a {
				color: #222;
			}

			.box > .icon > .info > .more a {
				color: #222;
				line-height: 12px;
				text-transform: uppercase;
				text-decoration: none;
			}

			.box > .icon:hover > .info > .more > a {
				color: #000;
				padding: 6px 8px;
				border-bottom: 4px solid black;
			}

			.box .space {
				height: 30px;
			}
			</style>

			<!-- Icon Panels - END -->

		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="js/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>