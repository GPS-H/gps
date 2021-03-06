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
		
		$cans=mysql_query("SELECT COUNT(id_paciente)as total FROM paciente",Conexion::conectar());
		if($dat=mysql_fetch_array($cans)){
			$total=$dat['total']; #inicializo la variable en 0
		}
        $msg='';

        if( isset($_POST['guardar']) || isset($_POST['actualizar']) ){
            $registrosfiltros=mysql_query("SELECT * FROM filtro WHERE numero_lavado=0 and estado_filtro='NUEVO'");
            if ($datoss=mysql_num_rows($registrosfiltros) == 0){
                $msg='  <div class="alert alert-danger" align="center">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>"No se pudo realizar la operacion, no hay filtros disponibles!"</strong>
                        </div>';
            }else{
                $nombre=limpiar($_POST['nombre']);              $apellidos=limpiar($_POST['apellidos']);
                $direccion=limpiar($_POST['direccion']);        $correo=limpiar($_POST['correo']);
                $telefono=limpiar($_POST['telefono']);          $celular=limpiar($_POST['celular']);
                $sexo=limpiar($_POST['sexo']);                  $edad=limpiar($_POST['edad']);
                if(isset($_POST['guardar'])){
                    #guardar
                    $estado_filtro='NUEVO';
                    $objGuardarPaciente=new ProcesoPaciente('',$nombre,$apellidos,$direccion,$correo,$telefono,$celular,$sexo,$edad);
                    $objGuardarPaciente->crear();
                    $objConsultaPaciente=new ConsultarPaciente();
                    $id_paciente1=$objConsultaPaciente->consultar('id_paciente');
                    $objConsultaFiltro=new ConsultarFiltro($estado_filtro);
                    $id_filtro=$objConsultaFiltro->consultar('id_filtro');
                    $numero_lavado=$objConsultaFiltro->consultar('numero_lavado');
                    $estado_filtro='USO';
                    $razon_desecho=$objConsultaFiltro->consultar('razon_desecho');
                    $objActualizarFiltro=new ProcesoFiltro($id_filtro,$numero_lavado,$estado_filtro,$razon_desecho);
                    $objActualizarFiltro->actualizar();
                    $objGuardarAsignacion=new ProcesoAsignacion($id_paciente1,$id_filtro);
                    $objGuardarAsignacion->crear();
                    $msg='  <div class="alert alert-success" align="center">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>"El paciente '.$nombre.' '.$apellidos.' a sido registrado y asignandole el filtro con id '.$id_filtro.'"</strong>
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
        			<h3 class="text-info"><img src="img/paciente.jpg" class="img-circle" width="60" height="60"> 
                    Registro y Control de Paciente</h3>
                </div>
    			<div class="span6" align="right" >
                	<form name="form1" method="post" action="" class="form-inline">
                    <!-- INGRESAR NUEVA curso -->
                        <a href="#nuevo" role="button" class="btn" data-toggle="modal">
                            <i class="icon-book"></i> <strong>Ingresar Nuevo Paciente</strong>
                        </a> |
                    	<div class="input-prepend">
                        	<span class="add-on"><i class="icon-search"></i></span>
                            <input name="bus" type="text" placeholder="Buscar paciente por Nombre o Apellidos" class="input-xlarge" autocomplete="off" autofocus>
                        </div>
                    </form>
                </div>
    		</div>
        </td>
      </tr>
    </table>
    <?echo $msg; ?>
    <table class="table table-bordered table table-hover">
      <tr class="success">
        <td><strong>Apellido y Nombre</strong></td>
        <td><strong>Correo</strong></td>
        <td><strong>Telefono</strong></td>
        <td><strong>Celular</strong></td>
        <td><strong>Edad</strong></td>
        <td>&nbsp;</td>
      </tr>
      <?php
		if(empty($_POST['bus']) && empty($_GET['bus'])){
			$sql="SELECT * FROM paciente ORDER BY nombre LIMIT $inicio, $maximo";
		}
        else if(!empty($_POST['bus'])) {
			$bus=limpiar($_POST['bus']);
			$sql="SELECT * FROM paciente WHERE nombre LIKE '%$bus%' or apellidos LIKE '%$bus%' ORDER BY nombre LIMIT $inicio, $maximo";
		}
        else if(!empty($_GET['bus'])) {
            $bus=limpiar($_GET['bus']);
            $sql="SELECT * FROM paciente WHERE nombre LIKE '%$bus%' ORDER BY nombre LIMIT $inicio, $maximo";   
        }

		$n=1;
		$can=mysql_query($sql,Conexion::conectar());
        if ($dato=mysql_num_rows($can) == 0){
            echo'<div class="alert alert-error" align="center">
                    <strong>No Se encontraron pacientes</strong>
                 </div>';
        }
		while($dato=mysql_fetch_array($can)){
            $paciente1=$dato['id_paciente'];
	  ?>
      <tr>
        <td><?php echo $dato['nombre'].' '.$dato['apellidos']; ?></td>
        <td><?php echo $dato['correo']; ?></td>
        <td><?php echo $dato['telefono'];?></td>
        <td><?php echo $dato['celular']; ?></td>
        <td><?php echo $dato['edad']; ?></td>
        <td>
        	<center>
        	<a href="#act<?php echo $dato['id_paciente']; ?>" role="button" class="btn btn-info" data-toggle="modal" title="Actualizar Informacion">
            	<i class="icon-edit"></i>
            </a>
            <?php if($_SESSION['tipo_usuario']=='A'){   ?>
            <a href="#eli<?php echo $dato['id_paciente']; ?>" role="button" class="btn btn-danger" data-toggle="modal" title="Eliminar paciente">
                <i class="icon-trash"></i>
            </a>
             <?php } ?>
            <a href="#filtro<?php echo $dato['id_paciente']; ?>" role="button" class="btn btn-mini" data-toggle="modal" title="Filtro">
                <i class="icon-list"></i>
            </a>
            </center>
        </td>
      </tr>

        <div id="filtro<?php echo $dato['id_paciente']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header" align="center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 id="myModalLabel">Filtro del paciente: <?php echo $dato['nombre'].' '.$dato['apellidos'];; ?></h4>
            </div>
            <div class="modal-body">
                        <?php   
                            $objConsultaAsignacion1=new ConsultarAsignacion($paciente1);
                            $id_filtro1=$objConsultaAsignacion1->consultar('id_filtro');
                            $objConsultaFiltro1=new ConsultarFiltroId($id_filtro1);
                            $numero_lavado1=$objConsultaFiltro1->consultar('numero_lavado');
                            $estado_filtro1=$objConsultaFiltro1->consultar('estado_filtro');
                            echo '<div id="" style="overflow:scroll; height:100px;">
                                    <blockquote>';
                            echo '<i class="icon-chevron-right"></i> Id Filtro: '.$id_filtro1.'<br>';
                            echo '<i class="icon-chevron-right"></i> Numero de Lavados: '.$numero_lavado1.'<br>';
                            echo '<i class="icon-chevron-right"></i> Estado actual del filtro: '.$estado_filtro1.'<br>';

                            echo '  </blockquote>
                                </div>';
                        ?>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cerrar</strong></button>
            </div>
        </div>

    <div id="act<?php echo $dato['id_paciente']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    	<form name="form1" method="post" action="" class="form-inline">
        <input type="hidden" name="id_paciente" value="<?php echo $dato['id_paciente']; ?>">
    	<div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    		<h3 id="myModalLabel">Actualizar Paciente</h3>
    	</div>
    	<div class="modal-body">
   		    <div class="row-fluid">
	            <div class="span6">
                	<strong>Nombre</strong><br>
                    <input type="text" name="nombre" autocomplete="off" required value="<?php echo $dato['nombre']; ?>"><br>
                    <strong>Apellido</strong><br>
                    <input type="text" name="apellidos" autocomplete="off" required value="<?php echo $dato['apellidos']; ?>"><br>
                    <strong>Direccion</strong><br>
                    <input type="text" name="direccion" autocomplete="off" required value="<?php echo $dato['direccion']; ?>"><br>
                    <strong>Correo</strong><br>
                    <input type="email" name="correo" autocomplete="off" required value="<?php echo $dato['correo']; ?>"><br>
                </div>
    	        <div class="span6">
                	<strong>Telefono</strong><br>
                    <input type="text" name="telefono" autocomplete="off" required value="<?php echo $dato['telefono']; ?>"><br>
                    <strong>Celular</strong><br>
                    <input type="text" name="celular" autocomplete="off" requerid value="<?php echo $dato['celular']; ?>"><br>
                    <strong>Edad</strong><br>
                    <input type="text" name="edad" autocomplete="off" requerid value="<?php echo $dato['edad']; ?>"><br>
                    <strong>Sexo</strong><br>
                    <select name="sexo">
                        <?php if($dato['sexo']=='M'){ ?>
                        <option value="M" selected>M</option>		
                        <option value="F">F</option>';
                        <?php }else{ ?>
                        <option value="F" selected>F</option>     
                        <option value="M">M</option>
                        <?php } ?>
                    </select>
                </div>
            </div>
    	</div>
   	 	<div class="modal-footer">
    		<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cancelar</strong></button>
    		<button type="submit" name="actualizar" class="btn btn-info"><i class="icon-ok"></i> <strong>Actualizar</strong></button>
	    </div>
        </form>
    </div> 

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
                    <h4 type="text" name="apellido"><?php echo '<strong> Nombre: </strong>'.$dato['nombre'].' '. $dato['apellidos']; ?></h4><br>
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
			if(empty($_POST['bus']) && empty($_GET['bus'])) {
				$tp = ceil($total/$maximo);#funcion que devuelve entero redondeado
         		for	($n=1; $n<=$tp ; $n++){
					if($pag==$n){
						echo '<li class="active"><a href="paciente.php?pag='.$n.'"><strong>'.$n.'</strong></a></li>';	
					}else{
						echo '<li><a href="paciente.php?pag='.$n.'"><strong>'.$n.'</strong></a></li>';	
					}
				}
			}
			?>
        </ul>
    </div>
    
    <div id="nuevo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    	 <form name="form1" method="post" action="" class="form-inline">
    	<div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    		<h3 id="myModalLabel">Guardar Nuevo Paciente</h3>
    	</div>
    	<div class="modal-body">
        
   		    <div class="row-fluid">
	            <div class="span6">
                	<strong>Nombres</strong><br>
                    <input type="text" name="nombre" autocomplete="off" required><br>
                    <strong>Apellidos</strong><br>
                    <input type="text" name="apellidos" autocomplete="off" required><br>
                    <strong>Direccion</strong><br>
                    <input type="text" name="direccion" autocomplete="off" required><br>
                    <strong>Correo</strong><br>
                    <input type="email" name="correo" autocomplete="off" required><br>
                </div>
    	        <div class="span6">
                	<strong>Telefono</strong><br>
                    <input type="text" name="telefono" autocomplete="off" required><br>
                    <strong>Celular</strong><br>
                    <input type="text" name="celular" autocomplete="off" requerid><br>
                    <strong>Edad</strong><br>
                    <input type="text" name="edad" autocomplete="off" requerid><br>
                    <strong>Sexo</strong><br>
                    <select name="sexo">
                        <option value="M" selected>M</option>
                        <option value="F">F</option>
                    </select>
                </div>
            </div>
    	</div>
   	 	<div class="modal-footer">
    		<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cancelar</strong></button>
    		<button name="guardar" type="submit" class="btn btn-success"><i class="icon-ok"></i> <strong>Guardar</strong></button>
	    </div>
        </form>
    </div>
</body>
</html>