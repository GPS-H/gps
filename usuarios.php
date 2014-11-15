<?php
require_once("clases/clase_login.php");
include_once('clases/clases.php');
if(!isset($_SESSION['usuario']) and !isset ($_SESSION['tipo_usuario'])){
	header('location:index.php');
}
if($_SESSION['tipo_usuario']=='e'){
	header('location:error.php');
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

		.typeahead-devs, .tt-hint,.buscarUsuario,.allcountry  {
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
				$('input.buscarUsuario').typeahead({
					  name: 'buscarUsuario',
					  remote : 'buscar.php?queryUsuario=%QUERY'
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
		$query = $mysqli->query('select *from usuarios');
       ?>
			<table class="table table-bordered" id="example">
			  <tr class="info">
				<td>
					<div class="row-fluid">
						<div class="span2">
							<h3 class="text-info"><img src="img/usuario.png" class="img-circle" width="60" height="60"> 
							Control de Usuarios</h3>        
						</div>
					</div>
				</td>
				<td>
					<div class="row-fluid">
						<div class="span4">
							<h3 class="text-info"> <img src="img/busca.jpg" class="img-circle" width="50" height="50"> Buscar:</h3>
				              <form method="POST" action="#">
				              <input type="text" name="buscarUsuario" size="18" class="buscarUsuario" placeholder="introdusca sus apellidos">
				              </form>
						</div>
					</div>
				</td>
			  </tr>
			</table>

			<table class="table table-bordered table table-hover">
			  <tr class="info">
				<td><strong>Usuario</strong></td>
				<td><strong>Contraseña</strong></td>
				<td><strong>Nombre</strong></td>
                <td><strong>Email</strong></td>
			  </tr>
            <tbody>
            <?php
            //SACAMOS LOS REGISTROS DE LA TABLA
			while($row = $query->fetch_assoc()) {
             ?>
            <tr>
                <td><?php echo $row["usu"]; ?></td>
                <td><?php echo $row["con"]; ?></td>
                <td><?php echo $row["nombre"]; ?></td>
                <td><?php echo $row["correo"]; ?></td>
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