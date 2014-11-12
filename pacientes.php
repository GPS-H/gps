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
      <?php
        //LLENAMOS LA BASE DE DATOS
        require_once("bd/conexion.php");      
		$query = $mysqli->query('select *from pacientes');
       ?>
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
				              <form method="POST" action="#">
				              <input type="text" name="buscar" size="18" class="buscar" placeholder="introdusca sus apellidos">
				              </form>
						</div>
					</div>
				</td>
			  </tr>
			</table>

			<table class="table table-bordered table table-hover">
			  <tr class="info">
				<td><strong>Nombres</strong></td>
				<td><strong>Apellidos</strong></td>
				<td><strong>Dirección</strong></td>
                <td><strong>email</strong></td>
                <td><strong>celular</strong></td>
                <td><strong>teléfono</strong></td>
			  </tr>
            <tbody>
            <?php
            //SACAMOS LOS REGISTROS DE LA TABLA
			while($row = $query->fetch_assoc()) {
             ?>
            <tr>
                <td><?php echo $row["Nombre"]; ?></td>
                <td><?php echo $row["Apellidos"]; ?></td>
                <td><?php echo $row["Direccion"]; ?></td>
                <td><?php echo $row["Correo"]; ?></td>
                <td><?php echo $row["Telefono"]; ?></td>
                <td><?php echo $row["Celular"]; ?></td>
            </tr>                
                <?php
            }
            ?> 
			</table>
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>

	</body>
</html>