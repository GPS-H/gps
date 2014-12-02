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
class ConsultarPaciente{
	
	private $consulta;
	private $fetch;
	
	function __construct(){
		$this->consulta = mysql_query("SELECT * FROM paciente ORDER BY id_paciente DESC LIMIT 1");
		$this->fetch = mysql_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}
class ConsultarPacienteId{
	
	private $consulta;
	private $fetch;
	
	function __construct($codigo){
		$this->consulta = mysql_query("SELECT * FROM paciente WHERE id_paciente=$codigo");
		$this->fetch = mysql_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}
class ConsultarFiltro{
	
	private $consulta;
	private $fetch;
	
	function __construct($codigo){
		$this->consulta = mysql_query("SELECT * FROM filtro WHERE estado_filtro='$codigo' ORDER BY id_filtro ASC limit 1");
		$this->fetch = mysql_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}
class ConsultarFiltroId{
	
	private $consulta;
	private $fetch;
	
	function __construct($codigo){
		$this->consulta = mysql_query("SELECT * FROM filtro WHERE id_filtro='$codigo'");
		$this->fetch = mysql_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}
class ConsultarAsignacion{
	
	private $consulta;
	private $fetch;
	
	function __construct($codigo){
		$this->consulta = mysql_query("SELECT * FROM asignacion WHERE id_paciente='$codigo'");
		$this->fetch = mysql_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}
class ConsultarAsignacion2{
	
	private $consulta;
	private $fetch;
	
	function __construct($codigo){
		$this->consulta = mysql_query("SELECT * FROM asignacion WHERE id_filtro='$codigo'");
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
		VALUES ('$nombre','$apellidos','$direccion','$correo','$telefono','$celular','$sexo',$edad)");
	}
	function actualizar(){
		$id_paciente=$this->id_paciente;	$nombre=$this->nombre;			$apellidos=$this->apellidos;	$direccion=$this->direccion;	
		$correo=$this->correo;				$telefono=$this->telefono;		$celular=$this->celular;		$sexo=$this->sexo;
		$edad=$this->edad;
		mysql_query("UPDATE paciente SET nombre='$nombre',apellidos='$apellidos',direccion='$direccion',correo='$correo',telefono='$telefono',celular='$celular',sexo='$sexo',edad=$edad 
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
class ProcesoFiltro{
	var $id_filtro;		var $numero_lavado;		var $estado_filtro;		var $razon_desecho;
	
	function __construct($id_filtro,$numero_lavado,$estado_filtro,$razon_desecho){
		$this->id_filtro=$id_filtro;	$this->numero_lavado=$numero_lavado;	$this->estado_filtro=$estado_filtro;	$this->razon_desecho=$razon_desecho;
	}
	function crear(){
		mysql_query("INSERT INTO filtro () VALUES ()");
	}
	function actualizar(){
		$id_filtro=$this->id_filtro;	$numero_lavado=$this->numero_lavado;	$estado_filtro=$this->estado_filtro;	$razon_desecho=$this->razon_desecho;
		mysql_query("UPDATE filtro SET numero_lavado=$numero_lavado, estado_filtro='$estado_filtro', razon_desecho='$razon_desecho'  WHERE id_filtro=$id_filtro");
	}
	function actualizar2(){
		$id_filtro=$this->id_filtro;	$numero_lavado=$this->numero_lavado;
		mysql_query("UPDATE filtro SET numero_lavado=$numero_lavado WHERE id_filtro=$id_filtro");
	}
	function eliminar(){
		$id_filtro=$this->id_filtro;
		mysql_query("DELETE  FROM filtro where id_filtro= $id_filtro");
	}
}
class ProcesoAsignacion{
	var $id_paciente;		var $id_filtro;		var $fecha_asignacion;
	
	function __construct($id_paciente,$id_filtro){
		$this->id_filtro=$id_filtro;	$this->id_paciente=$id_paciente;
	}
	function crear(){
		$id_paciente=$this->id_paciente;	$id_filtro=$this->id_filtro;
		mysql_query("INSERT INTO asignacion (id_paciente, id_filtro) VALUES ($id_paciente,$id_filtro)");
	}
	function actualizar(){
		$id_paciente=$this->id_paciente;	$id_filtro=$this->id_filtro;	$fecha_asignacion=$this->fecha_asignacion;
		mysql_query("UPDATE asignacion SET id_paciente='$id_paciente',id_filtro='$id_filtro' 
					WHERE id_paciente=$id_paciente");
	}
	function eliminar(){
		$id_filtro=$this->id_filtro;	$id_paciente=$this->id_paciente;
		mysql_query("DELETE  FROM asignacion where id_filtro= $id_filtro and id_paciente=$id_paciente");
	}
}
class ProcesoRegistro{
	var $id_paciente;		var $id_filtro;
	
	function __construct($id_paciente,$id_filtro){
		$this->id_filtro=$id_filtro;	$this->id_paciente=$id_paciente;
	}
	function crear(){
		$id_paciente=$this->id_paciente;	$id_filtro=$this->id_filtro;
		mysql_query("INSERT INTO registro (id_paciente, id_filtro) VALUES ($id_paciente,$id_filtro)");
	}
	function eliminar(){
		$id_filtro=$this->id_filtro;
		mysql_query("DELETE  FROM asignacion where id_filtro= $id_filtro");
	}
}
?>