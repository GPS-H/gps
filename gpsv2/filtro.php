<?php
        require_once("clases/clase_login.php");
        include_once('clases/clases.php');
/*        if(!isset($_SESSION['usuario']) and !isset ($_SESSION['tipo_usuario'])){
          header('location:index.php');
        }*/
		$bus='';#inicializar la variable
				
		#paginar
		$maximo=20;
		if(!empty($_GET['pag'])){
			$pag=limpiar($_GET['pag']);
		}else{
			$pag=1;
		}
		$inicio=($pag-1)*$maximo;
		
		$cans=mysql_query("SELECT COUNT(id_filtro)as total FROM filtro",Conexion::conectar());
		if($dat=mysql_fetch_array($cans)){
			$total=$dat['total']; #inicializo la variable en 0
		}
        $msg='';
        if( isset($_POST['guardar']) ){
            $cantidad=limpiar($_POST['cantidad']);
            #guardar
            $objGuardarfiltro=new ProcesoFiltro('','','','');
            for($cant=1;$cant<=$cantidad;$cant++){
                $objGuardarfiltro->crear();
            }
            $msg='  <div class="alert alert-success" align="center">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>"Filtros agregados: '.$cantidad.'"</strong>
                        </div>';
        }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Filtros</title>
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
                    <h3 class="text-info"><img src="img/filtros.jpg" class="img-circle" width="60" height="60"> 
                    Filtros</h3>
                </div>
                <div class="span6" align="right" >
                    <form name="form1" method="post" action="" class="form-inline">
                    <!-- INGRESAR NUEVA curso -->
                        <a href="#nuevo" role="button" class="btn" data-toggle="modal">
                            <i class="icon-book"></i> <strong>Ingresar Nuevos Filtros</strong>
                        </a> |
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-search"></i></span>
                            <input name="bus" type="text" placeholder="Buscar paciente por Nombre" class="input-xlarge" autocomplete="off" autofocus>
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
        <td><strong>ID FILTRO</strong></td>
        <td><strong>NUM LAVADOS</strong></td>
        <td><strong>ESTADO ACTUAL</strong></td>
        <td>&nbsp;</td>
      </tr>
      <?php
		if(empty($_POST['bus']) && empty($_GET['bus'])){
			$sql="SELECT * FROM filtro  ORDER BY id_filtro LIMIT $inicio, $maximo";
		}
        else if(!empty($_POST['bus'])) {
			$bus=limpiar($_POST['bus']);
			$sql="SELECT * FROM filtro WHERE id_filtro=$bus ORDER BY id_filtro LIMIT $inicio, $maximo";
		}
        else if(!empty($_GET['bus'])) {
            $bus=limpiar($_GET['bus']);
            $sql="SELECT * FROM filtro WHERE id_filtro=$bus ORDER BY id_filtro LIMIT $inicio, $maximo";
        }
		$n=1;
		$can=mysql_query($sql,Conexion::conectar());
        if ($dato=mysql_num_rows($can) == 0){
            echo'<div class="alert alert-error" align="center">
                    <strong>No Se encontraron resultados</strong>
                 </div>';
        }
		while($dato=mysql_fetch_array($can)){
            $filtro1=$dato['id_filtro'];
	  ?>
      <tr>
        <td><?php echo $dato['id_filtro']; ?></td>
        <?php if($dato['numero_lavado']>8){ ?>
        <td style="color: #f49f00;"><?php echo $dato['numero_lavado']; ?></td>
        <?php }else{ ?>
        <td><?php echo $dato['numero_lavado']; ?></td>
        <?php } ?>
        <td><?php echo $dato['estado_filtro'];?></td>
        <td>
            <center>
            <a href="#eli<?php echo $dato['id_filtro']; ?>" role="button" class="btn btn-danger" data-toggle="modal" title="Eliminar filtro">
                <i class="icon-remove"></i>
            </a>
            <a href="#paciente<?php echo $dato['id_filtro']; ?>" role="button" class="btn btn-mini" data-toggle="modal" title="Paciente">
                <i class="icon-list"></i>
            </a>
            </center>
        </td>
      </tr>
        <div id="paciente<?php echo $dato['id_filtro']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header" align="center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 id="myModalLabel">Filtro: <?php echo $dato['id_filtro']; ?></h4>
            </div>
            <div class="modal-body">
                        <?php   
                            $objConsultaAsignacion1=new ConsultarAsignacion2($filtro1);
                            $id_paciente1=$objConsultaAsignacion1->consultar('id_paciente');
                            if(!$id_paciente1){
                                echo '  <div class="alert alert-error" align="center">
                                            <strong>No hay Paciente Asignado a este filtro</strong>
                                        </div>';
                            }
                            else{
                            $objConsultaPaciente1=new ConsultarPacienteId($id_paciente1);
                            $nombrepaciente1=$objConsultaPaciente1->consultar('nombre');
                            $apellidopaciente1=$objConsultaPaciente1->consultar('apellidos');
                            $correopaciente1=$objConsultaPaciente1->consultar('correo');
                            $telefonopaciente1=$objConsultaPaciente1->consultar('telefono');
                            $celularpaciente1=$objConsultaPaciente1->consultar('celular');
                            echo '<div id="" style="overflow:scroll; height:200px;">
                                    <blockquote>';
                            echo '<i class="icon-chevron-right"></i> Id Paciente: '.$id_paciente1.'<br>';
                            echo '<i class="icon-chevron-right"></i> Nombre: '.$nombrepaciente1.'<br>';
                            echo '<i class="icon-chevron-right"></i> Paciente: '.$apellidopaciente1.'<br>';
                            echo '<i class="icon-chevron-right"></i> Correo: '.$correopaciente1.'<br>';
                            echo '<i class="icon-chevron-right"></i> Telefono '.$telefonopaciente1.'<br>';
                            echo '<i class="icon-chevron-right"></i> Celular '.$celularpaciente1.'<br>';

                            echo '  </blockquote>
                                </div>';
                            }
                        ?>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cerrar</strong></button>
            </div>
        </div>

    <div id="eli<?php echo $dato['id_filtro']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form name="form1" method="post" action="" class="form-inline">
        <input type="hidden" name="id_filtro" value="<?php echo $dato['id_filtro']; ?>">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">¿Realmente desea eliminarlo?</h3>
        </div>
        <div class="modal-body">
            <div class="row-fluid">
                <div class="span12">
                    <h4 type="text" name="apellido"><?php echo '<strong> ID FILTRO: </strong>'.$dato['id_filtro']; ?></h4><br>
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
						echo '<li class="active"><a href="filtro.php?pag='.$n.'"><strong>'.$n.'</strong></a></li>';	
					}else{
						echo '<li><a href="filtro.php?pag='.$n.'"><strong>'.$n.'</strong></a></li>';	
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
            <h3 id="myModalLabel">Agregar Nuevos Filtros</h3>
        </div>
        <div class="modal-body">
            <div class="row-fluid">
                <div class="span6">
                    <strong>Cantidad de Filtros</strong><br>
                    <select name="cantidad">
                        <?php
                        for($canfiltros=1; $canfiltros<=20; $canfiltros++){
                            echo '<option value="'.$canfiltros.'">'.$canfiltros.'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cancelar</strong></button>
            <button name="guardar" type="submit" class="btn btn-success"><i class="icon-ok"></i> <strong>Agregar</strong></button>
        </div>
        </form>
    </div>
</body>
</html>