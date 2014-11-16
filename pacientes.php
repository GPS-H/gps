<?php
require_once("clases/clase_login.php");
include_once('clases/clases.php');
if(!isset($_SESSION['usuario']) and !isset ($_SESSION['tipo_usuario'])){
	header('location:index.php');
}
$usuario=limpiar($_SESSION['usuario']);
?>

<?php 
include("bd/conexion.php")
?>

<!DOCTYPE html>
<html lang="en">
	<head> 
		
		<?php include("head.php"); ?>
		<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
		
		<link href="css/css/bootstrap.css" rel="stylesheet" type="text/css"/>
		
		
		<script type="text/javascript" src="js/js/jquery.js"></script> 
		<script type="text/javascript" src="js/js/typeahead.js"></script> 
	

		<style>
		.typeahead-devs, .tt-hint,.buscar,.allcountry  {
		 	border: 2px solid #CCCCCC;
		    border-radius: 8px 8px 8px 8px;
		    font-size: 20px;
		    height: 35px;
		    outline: medium none;
		    width: 350px;
		}

		.tt-dropdown-menu {
		  width: 350px;
		  margin-top: 5px;
		  padding: 8px 12px;
		  background-color: #F1F1F1;
		}
		</style>
		<script>
			$(document).ready(function() {
				$('input.buscar').typeahead({
					  name: 'buscar',
					  remote : 'buscar.php?query=%QUERY'
				});
			})
		</script>
	</head>
	<body>
		<?php include("header.php"); ?>
		<div class="container">
     
	  
			<table class="table table-bordered" id="example">
			  <tr class="info">
				<td>
					<div class="row-fluid">
						<div class="span2">
							<h3 class="text-info"><img src="img/usuario.png" class="img-circle" width="60" height="60"> 
							Control de Pacientes</h3>        
						</div>
					</div>
				</td>
				<td>
					<div class="row-fluid">
						<div class="span4">
							<h3 class="text-info"> <img src="img/busca.jpg" class="img-circle" width="50" height="50"> Buscar:</h3>
				              <form id="frm_filtro" method="POST" action="">
				              <input type="text" name="buscar" size="18" class="buscar" placeholder="introdusca sus apellidos"  id="nombre" >
				              </form>
						</div>
					</div>
				</td>
			  </tr>
			</table>
             
			<table class="table table-bordered table table-hover" id="data">
			<thead>
            	<tr class="info">
                    <th ><span title="nombre">Nombre</span></th>
                    <th ><span title="apellidos">Apellidos</span></th>
                    <th ><span title="direccion">Direccion</span></th>
                    <th><span title="email">Email</span></th>
					<th><span title="celular">Celular</span></th>
					<th><span title="telefono">Telefono</span></th>
                </tr>
            </thead>
           <tbody>
		   </body>
	</table>
	</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
		
		
		<script type="text/javascript" src="js/jquery-ui-1.8.13.custom.min.js"></script>
		<script type="text/javascript" src="js/assets/js/js.js"></script>

	
</html>