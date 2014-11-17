<?php
require_once("clase_conexion.php");
class ConsultarUsuario{
	
	private $consulta;
	private $fetch;
	
	function __construct($codigo){
		$this->consulta = mysql_query("SELECT * FROM usuario WHERE usuario='$codigo'",Conexion::conectar());
		$this->fetch = mysql_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}
class ProcesoPaciente{
	var $id_paciente;	var $nombre;		var $apellidos;		var $direccion;		var $correo;	var $telefono;		var $celular;		
	var $sexo;			var $edad;
	
	function __construct($id_paciente, $nombre, $apellidos, $direccion, $correo, $telefono, $celular, $sexo, $edad){
		$this->id_paciente=$id_paciente;	$this->nombre=$nombre;			$this->apellidos=$apellidos;	$this->direccion=$direccion;
		$this->correo=$correo;				$this->telefono=$telefono;		$this->celular=$celular;		$this->sexo=$sexo;
		$this->edad=$edad;
	}
	
	function crear(){
		$nombre=$this->nombre;				$apellidos=$this->apellidos;	$direccion=$this->direccion;	$correo=$this->correo;		
		$telefono=$this->telefono;			$celular=$this->celular;		$sexo=$this->sexo;				$edad=$this->edad;
		mysql_query("INSERT INTO paciente (nombre, apellidos, direccion, correo, telefono, celular, sexo, edad) 
		VALUES ('$nombre','$apellidos','$direccion','$correo','$telefono','$celular','$sexo','$edad')");
	}
	function actualizar(){
		$id_paciente=$this->id_paciente;	$nombre=$this->nombre;			$apellidos=$this->apellidos;	$direccion=$this->direccion;	
		$correo=$this->correo;				$telefono=$this->telefono;		$celular=$this->celular;		$sexo=$this->sexo;
		$edad=$this->edad;
		mysql_query("UPDATE paciente SET nombre='$nombre',apellidos='$apellidos',direccion='$direccion',correo='$correo',telefono='$telefono',celular='$celular',sexo='$sexo',edad='$edad' 
					WHERE id_paciente=$id_paciente");
	}
	function eliminar(){
		$id_paciente=$this->id_paciente;
		mysql_query("DELETE  FROM paciente where id_paciente= $id_paciente");
	}
	
}
class ProcesoUsuario{
	var $id_usuario;	var $usuario;		var $contrasenia;		var $nombre;		var $correo;	var $tipo;		var $estado;		
	
	function __construct($id_usuario,$usuario,$contrasenia, $nombre,$correo, $tipo, $estado){
		$this->id_usuario=$id_usuario;		$this->usuario=$usuario;			$this->contrasenia=$contrasenia;	$this->nombre=$nombre;
		$this->correo=$correo;				$this->tipo=$tipo;					$this->estado=$estado;
	}
	
	function crear(){
		$usuario=$this->usuario;			$contrasenia=$this->contrasenia;	$nombre=$this->nombre;				$correo=$this->correo;		
		$tipo=$this->tipo;					$estado=$this->estado;
		mysql_query("INSERT INTO usuario (usuario, contrasenia, nombre, correo, tipo, estado) 
		VALUES ('$usuario','$contrasenia','$nombre','$correo','$tipo','$estado')");
	}
	function actualizar(){
		$id_usuario=$this->id_usuario;			$usuario=$this->usuario;		$contrasenia=$this->contrasenia;	$nombre=$this->nombre;
		$correo=$this->correo;				$tipo=$this->tipo;					$estado=$this->estado;
		mysql_query("UPDATE usuario SET usuario='$usuario',contrasenia='$contrasenia', nombre='$nombre',correo='$correo',tipo='$tipo',estado='$estado' 
					WHERE id_usuario=$id_usuario");
	}
	function eliminar(){
		$id_usuario=$this->id_usuario;
		mysql_query("DELETE  FROM usuario where id_usuario= $id_usuario");
	}
	
}
?>