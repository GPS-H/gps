<?php
session_start();
require_once("clase_conexion.php");
class Login{
	public function crearSesion(){
		$nombre = limpiar($_POST['usu']);
		$password =limpiar( $_POST['con']);
	    $query = "SELECT * FROM usuario WHERE usuario='".($nombre)."' AND contrasenia='".($password)."';";
		$resultado = mysql_query($query,Conexion::conectar());

		if ($registro=mysql_num_rows($resultado) == 0){
			header("Location:index.php?usuario=no_existe");
		}
		if($registro=mysql_fetch_array($resultado))
		{
			if($registro['estado']=='N'){
				header("Location:index.php?usuario=inactivo");
			}
			else{
				if($registro['estado']=='Y'){
					$_SESSION['usuario']=$registro['usuario'];
					$_SESSION['tipo_usuario']=$registro['tipo'];
					header('location:administrador.php');
				}
			}
		}
	}
}
	function limpiar($tags){
		$tags = strip_tags($tags);
		return $tags;
	}
?>
