<?php
        require_once("clases/clase_login.php");
        include_once('clases/clases.php');
        if(!isset($_SESSION['usuario']) and !isset ($_SESSION['tipo_usuario'])){
          header('location:index.php');
        }
		$bus='';#inicializar la variable
				
		#paginar
		$maximo=20;
		if(!empty($_GET['pag'])){
			$pag=limpiar($_GET['pag']);
		}else{
			$pag=1;
		}
		$inicio=($pag-1)*$maximo;
		
		$cans=mysql_query("SELECT COUNT(*)as total FROM registro",Conexion::conectar());
		if($dat=mysql_fetch_array($cans)){
			$total=$dat['total'];
		}
        $msg='';
        $msg2='';
        if(isset($_POST['guardar1'])){
                $id_f=limpiar($_POST['id_filtro']);     $id_p=limpiar($_POST['id_paciente']);   $numero_lavado=limpiar($_POST['numero_lavado']);
                $objGuardarRegistro=new ProcesoRegistro($id_p,$id_f);
                $numero_lavado++;
                $objActualizarFiltro=new ProcesoFiltro($id_f,$numero_lavado,"","");
                $objGuardarRegistro->crear();
                $objActualizarFiltro->actualizar2();
                $msg='  <div class="alert alert-success" align="center">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>Registro del tratamiento guardado'.$id_f.' '.$id_p.' '.$numero_lavado.'</strong>
                        </div>';
        }
        else if(isset($_POST['guardar2'])){
                $id_filtro=limpiar($_POST['id_filtro']);            $id_paciente=limpiar($_POST['id_paciente']);   
                $numero_lavado=limpiar($_POST['numero_lavado']);    $estado_filtro=limpiar($_POST['estado_filtro']);    
                $razon_desecho=limpiar($_POST['razon_desecho']);
                $objGuardarRegistro=new ProcesoRegistro($id_paciente,$id_filtro);
                $objGuardarRegistro->crear();
                $numero_lavado++;
                $objActualizarFiltro=new ProcesoFiltro($id_filtro,$numero_lavado,$estado_filtro,$razon_desecho);
                $objActualizarFiltro->actualizar();
                $objetoEliminarAsignacion=new ProcesoAsignacion($id_paciente,$id_filtro);
                $objetoEliminarAsignacion->eliminar();
                $estado_filtro='NUEVO';
                $objConsultaFiltro=new ConsultarFiltro($estado_filtro);
                $id_filtro=$objConsultaFiltro->consultar('id_filtro');
                $numero_lavado=$objConsultaFiltro->consultar('numero_lavado');
                $estado_filtro='USO';
                $razon_desecho='';
                $objActualizarFiltro2=new ProcesoFiltro($id_filtro,$numero_lavado,$estado_filtro,$razon_desecho);
                $objActualizarFiltro2->actualizar();
                $objGuardarAsignacion=new ProcesoAsignacion($id_paciente,$id_filtro);
                $objGuardarAsignacion->crear();
                $msg='  <div class="alert alert-success" align="center">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>El Registro del tratamiento y la asignacion de un nuevo filtro fue un exito.</strong>
                        </div>';
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
      <tr class="success">
        <td>
        	<div class="row-fluid">
	  			<div class="span6">
        			<h3 class="text-info"><img src="img/registro.jpg" class="img-circle" width="60" height="60"> 
                    Registros</h3>
                </div>
    		</div>
        </td>
      </tr>
    </table>
    <?echo $msg; ?>

    <div class="row-fluid">
        <div class="span6">
                <table class="table table-bordered table table-hover">
                    <tr class="success">
                        <td colspan="4"><center><strong class="text-info">Lista de Registros</strong></center></td>
                    </tr>
                    <tr class="success">
                        <td><strong>ID PACIENTE</strong></td>
                        <td><strong>ID FILTRO</strong></td>
                        <td><strong>FECHA REGISTRO</strong></td>
                        <td>&nbsp;</td>
                    </tr>
                    <?php
            			$sql="SELECT * FROM registro ORDER BY fecha_lavado DESC LIMIT $inicio, $maximo";
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
                                    <i class="icon-trash"></i>
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
                                <h3 id="myModalLabel">¿Realmente desea eliminarlo el registro?</h3>
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
        </div>
        <div class="span6">
                <table class="table table-bordered table table-hover">
                    <tr class="success">
                        <td colspan="4"><center><strong class="text-info">Registrar Paciente a consulta</strong></center></td>
                    </tr>
                    <tr class="success">
                        <td colspan="4">
                            <div class="row-fluid">
                                <div class="span6" align="right" >
                                    <form name="form1" method="post" action="" class="form-inline">
                                        <div class="input-prepend">
                                            <span class="add-on"><i class="icon-search"></i></span>
                                            <input name="bus" type="text" placeholder="Buscar paciente por Nombre o Apellidos" class="input-xlarge" autocomplete="off" autofocus>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="success">
                        <td><strong>Nombre</strong></td>
                        <td><strong>Apellidos</strong></td>
                        <td>&nbsp;</td>
                    </tr>
                    <?php
                    if(empty($_POST['bus'])){
                        $sql="SELECT * FROM paciente where id_paciente=100000000000000 ORDER BY id_paciente LIMIT $inicio, $maximo";
                    }else{
                        $bus=limpiar($_POST['bus']);
                        $sql="SELECT * FROM paciente WHERE id_paciente='$bus'";
                    }
                    $n=1;
                    $can2=mysql_query($sql,Conexion::conectar());
                    while($dato2=mysql_fetch_array($can2)){
                        $dato2['id_paciente'];
                  ?>
                    <tr>
                        <td><?php echo $dato2['nombre']; ?></td>
                        <td><?php echo $dato2['apellidos']; ?></td>
                        <td>
                            <center>
                                <a href="#registrarT<?php echo $dato2['id_paciente']; ?>" role="button" class="btn btn-success" data-toggle="modal" title="registrar cita">  <i class="icon-book"></i> Registrar cita</a>
                            </center>
                        </td>
                    </tr>

                    <div id="registrarT<?php echo $dato2['id_paciente']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <form name="form1" method="post" action="" class="form-inline">
                            <input type="hidden" name="id_paciente" value="<?php echo $dato2['id_paciente']; ?>">
                            <?php   
                                $objConsultaAsignacion=new ConsultarAsignacion($dato2['id_paciente']);
                                $id_filtro1=$objConsultaAsignacion->consultar('id_filtro');
                                $objConsultaFiltro=new ConsultarFiltroId($id_filtro1);
                                $numero_lavado=$objConsultaFiltro->consultar('numero_lavado');
                                if($numero_lavado<9){
                            ?>
                            <input type="hidden" name="id_filtro" value="<?php echo $id_filtro1; ?>">
                            <input type="hidden" name="numero_lavado" value="<?php echo $numero_lavado; ?>">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3 id="myModalLabel">Registrar tratamiento</h3>
                                <h4 type="text" name="apellido"><?php echo '<strong> Nombre del paciente: </strong>'.$dato2['nombre']; ?></h4><br>
                                <h4 type="text" name="apellido"><?php echo '<strong> Numero de uso actual del filtro: </strong>'.$numero_lavado; ?></h4><br>
                                <?php if($numero_lavado==8){ ?>
                                <h4 type="text" name="apellido"><strong>El filtro asignado a este paciente ya esta proximo a cambiarse </strong></h4><br>
                                <?php } ?>
                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cancelar</strong></button>
                                <button type="submit" name="guardar1" class="btn btn-success"><i class="icon-ok"></i> <strong>Registrar</strong></button>
                            </div>
                            <?php } else{ ?>
                            <input type="hidden" name="id_filtro" value="<?php echo $id_filtro1; ?>">
                            <input type="hidden" name="numero_lavado" value="<?php echo $numero_lavado; ?>">
                            <input type="hidden" name="estado_filtro" value="DESECHADO">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3 id="myModalLabel">Registrar tratamiento</h3>
                                <h4 type="text" name="apellido"><?php echo '<strong> Nombre del paciente: </strong>'.$dato2['nombre']; ?></h4><br>
                                <h4 type="text" name="apellido"><?php echo '<strong> El filtro asignado a  llegaŕa a sus </strong>10  usos maximos'; ?></h4><br>
                                <h4 type="text" name="apellido"><strong> Se le asignara un filtro disponible automaticamente</strong></h4><br>
                                <h4 type="text" name="apellido"><strong> Razon de desecho </strong></h4><br>
                                <input type="text" name="razon_desecho" autocomplete="off" readonly value="DEFAULT"><br>
                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cancelar</strong></button>
                                <button type="submit" name="guardar2" class="btn btn-success"><i class="icon-ok"></i> <strong>Registrar</strong></button>
                            </div>

                            <?php } ?>
                        </form>
                    </div>  

                <?php } ?>
                </table>
        </div>
    </div>
	<div class="pagination" align="center">
        <ul>
        	<?php
				$tp = ceil($total/$maximo);#funcion que devuelve entero redondeado
         		for	($n=1; $n<=$tp ; $n++){
					if($pag==$n){
						echo '<li class="active"><a href="registro.php?pag='.$n.'"><strong>'.$n.'</strong></a></li>';	
					}else{
						echo '<li><a href="registro.php?pag='.$n.'"><strong>'.$n.'</strong></a></li>';	
					}
				}
			?>
        </ul>
    </div>
</body>
</html>