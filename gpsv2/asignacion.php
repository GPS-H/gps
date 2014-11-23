<?php
        require_once("clases/clase_login.php");
        include_once('clases/clases.php');

		$bus='';#inicializar la variable
				
		#paginar
		$maximo=20;
		if(!empty($_GET['pag'])){
			$pag=limpiar($_GET['pag']);
		}else{
			$pag=1;
		}
		$inicio=($pag-1)*$maximo;
		
		$cans=mysql_query("SELECT COUNT(id_paciente)as total FROM asignacion",Conexion::conectar());
		if($dat=mysql_fetch_array($cans)){
			$total=$dat['total']; #inicializo la variable en 0
		}
        $msg='';
        if( isset($_POST['guardar']) || isset($_POST['actualizar']) ){
            $nombre=limpiar($_POST['nombre']);              $apellidos=limpiar($_POST['apellidos']);
            $direccion=limpiar($_POST['direccion']);        $correo=limpiar($_POST['correo']);
            $telefono=limpiar($_POST['telefono']);          $celular=limpiar($_POST['celular']);
            $sexo=limpiar($_POST['sexo']);                  $edad=limpiar($_POST['edad']);
            if(isset($_POST['guardar'])){
                #guardar
                $estado_filtro='NUEVO';
                $objConsultaPaciente=new ConsultarPaciente($direccion);
                $objConsultaFiltro=new ConsultarFiltro($estado_filtro);
                $id_paciente1=$objConsultaPaciente->consultar('id_paciente');
                $id_filtro=$objConsultaFiltro->consultar('id_filtro');
                $numero_lavado=$objConsultaFiltro->consultar('numero_lavado');
                $razon_desecho=$objConsultaFiltro->consultar('razon_desecho');
                $estado_filtro='USO';
                $objGuardarPaciente=new ProcesoPaciente('',$nombre,$apellidos,$direccion,$correo,$telefono,$celular,$sexo,$edad);
                $objActualizarFiltro=new ProcesoFiltro($id_filtro,$numero_lavado,$estado_filtro,$razon_desecho);
                $objGuardarAsignacion=new ProcesoAsignacion($id_paciente1,$id_filtro);
                $objActualizarFiltro->actualizar();
                $objGuardarPaciente->crear();
                $objGuardarAsignacion->crear();
                $msg='  <div class="alert alert-success" align="center">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>"'.$id_paciente1.' '.$id_filtro.' '.$numero_lavado.' '.$razon_desecho.'"</strong>
                        </div>';
            }
            else if(isset($_POST['actualizar'])){
                    $id_paciente=limpiar($_POST['id_paciente']);
                    $objActualizar=new ProcesoPaciente($id_paciente,$nombre,$apellidos,$direccion,$correo,$telefono,$celular,$sexo,$edad);
                    $objActualizar->actualizar();
                    $msg='  <div class="alert alert-info" align="center">
                                  <button type="button" class="close" data-dismiss="alert">×</button>
                                  <strong>El paciente fue Actualizado con Exito</strong>
                                </div>';
            }
        }
        else if(isset($_POST['eliminar'])){
            #Eliminar
            $id_paciente=limpiar($_POST['id_paciente']);
            $objEliminar=new ProcesoPaciente($id_paciente,"","","","","","","","");
            $objEliminar->eliminar();
            $msg='  <div class="alert alert-danger" align="center">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>El paciente fue Eliminado con Exito</strong>
                            </div>';
        }

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Pacientes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/docs.css" rel="stylesheet">
    <link href="js/google-code-prettify/prettify.css" rel="stylesheet">
    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
	<script src="js/jquery.js"></script>
    <script src="js/bootstrap-transition.js"></script>
    <script src="js/bootstrap-alert.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-carousel.js"></script>
    <script src="js/bootstrap-typeahead.js"></script>
    <script src="js/bootstrap-affix.js"></script>
    <script src="js/holder/holder.js"></script>
    <script src="js/google-code-prettify/prettify.js"></script>
    <script src="js/application.js"></script>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="assets/ico/est2.png">

</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">
	<table class="table table-bordered">
      <tr class="info">
        <td>
        	<div class="row-fluid">
	  			<div class="span6">
        			<h3 class="text-info"><img src="img/usuario.png" class="img-circle" width="80" height="80"> 
                    Asignación</h3>
                </div>
    		</div>
        </td>
      </tr>
    </table>
    <?echo $msg; ?>
    <table class="table table-bordered table table-hover">
      <tr class="info">
        <td><strong>ID PACIENTE</strong></td>
        <td><strong>ID FILTRO</strong></td>
        <td><strong>FECHA REGISTRO</strong></td>
        <td>&nbsp;</td>
      </tr>
      <?php
		if(empty($_POST['bus'])){
			$sql="SELECT * FROM registro ORDER BY id_paciente LIMIT $inicio, $maximo";
		}else{
			$bus=limpiar($_POST['bus']);
			$sql="SELECT * FROM registro WHERE id_paciente LIKE '%$bus%' or id_filtro LIKE '%$bus%' ORDER BY id_paciente LIMIT $inicio, $maximo";
		}
		$n=1;
		$can=mysql_query($sql,Conexion::conectar());
		while($dato=mysql_fetch_array($can)){
	  ?>
      <tr>
        <td><?php echo $dato['id_paciente']; ?></td>
        <td><?php echo $dato['id_filtro']; ?></td>
        <td><?php echo $dato['fecha_lavado'];?></td>
        <td>
            <center>
            <?php if($_SESSION['tipo_usuario']=='A'){   ?>
            <a href="#eli<?php echo $dato['id_paciente']; ?>" role="button" class="btn btn-danger" data-toggle="modal" title="Eliminar paciente">
                Eliminar
            </a>
             <?php } ?>
            </center>
        </td>
      </tr>

    <div id="eli<?php echo $dato['id_paciente']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form name="form1" method="post" action="" class="form-inline">
        <input type="hidden" name="id_paciente" value="<?php echo $dato['id_paciente']; ?>">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">¿Realmente desea eliminarlo?</h3>
        </div>
        <div class="modal-body">
            <div class="row-fluid">
                <div class="span12">
                    <h4 type="text" name="apellido"><?php echo '<strong> ID PACIENTE: </strong>'.$dato['id_paciente']; ?></h4><br>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cancelar</strong></button>
            <button type="submit" name="eliminar" class="btn btn-danger"><i class="icon-ok"></i> <strong>Eliminar</strong></button>
        </div>
        </form>
    </div>  

    <?php } ?>
    </table>
	<div class="pagination" align="center">
        <ul>
        	<?php
			if(empty($_POST['bus'])){
				$tp = ceil($total/$maximo);#funcion que devuelve entero redondeado
         		for	($n=1; $n<=$tp ; $n++){
					if($pag==$n){
						echo '<li class="active"><a href="asignacion.php?pag='.$n.'"><strong>'.$n.'</strong></a></li>';	
					}else{
						echo '<li><a href="asignacion.php?pag='.$n.'"><strong>'.$n.'</strong></a></li>';	
					}
				}
			}
			?>
        </ul>
    </div>
</body>
</html>