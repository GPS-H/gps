<?php
require_once("clase_conexion.php");
class ConsultarUsuario{
	
	private $consulta;
	private $fetch;
	
	function __construct($codigo){
		$this->consulta = mysql_query("SELECT * FROM usuarios WHERE usu='$codigo'",Conexion::conectar());
		$this->fetch = mysql_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}
?>