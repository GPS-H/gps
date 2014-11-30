<?php
        require_once("clases/clase_login.php");
        include_once('clases/clases.php');
        if(!isset($_SESSION['usuario']) and !isset ($_SESSION['tipo_usuario'])){
            header('location:index.php');
        }
        if($_SESSION['tipo_usuario']=='B'){
            header('location:error.php');
        }

		$bus='';#inicializar la variable
				
		#paginar
		$maximo=10;
		if(!empty($_GET['pag'])){
			$pag=limpiar($_GET['pag']);
		}else{
			$pag=1;
		}
		$inicio=($pag-1)*$maximo;
		
		$cans=mysql_query("SELECT COUNT(id_usuario)as total FROM usuario",Conexion::conectar());
		if($dat=mysql_fetch_array($cans)){
			$total=$dat['total']; #inicializo la variable en 0
		}
        $msg='';
        if( isset($_POST['guardar']) || isset($_POST['actualizar']) ){
            $usuario=limpiar($_POST['usuario']);        $nombre=limpiar($_POST['nombre']);      $correo=limpiar($_POST['correo']);
            $tipo=limpiar($_POST['tipo']);              $estado=limpiar($_POST['estado']);      $contrasenia=limpiar($_POST['contrasenia']);   
            if(isset($_POST['guardar'])){
                #guardar
                $objGuardar=new ProcesoUsuario('',$usuario,$contrasenia,$nombre,$correo,$tipo,$estado);
                $objGuardar->crear();
                $msg='  <div class="alert alert-success" align="center">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>El Usuario "'.$usuario.'" fue Guardado con Exito</strong>
                        </div>';
            }
            else if(isset($_POST['actualizar'])){
                    $id_usuario=limpiar($_POST['id_usuario']);
                    $objActualizar=new ProcesoUsuario($id_usuario,$usuario,$contrasenia,$nombre,$correo,$tipo,$estado);
                    $objActualizar->actualizar();
                    $msg='  <div class="alert alert-info" align="center">
                                  <button type="button" class="close" data-dismiss="alert">×</button>
                                  <strong>El usuario fue Actualizado con Exito</strong>
                                </div>';
            }
        }
        else if(isset($_POST['eliminar'])){
            #Eliminar
            $id_usuario=limpiar($_POST['id_usuario']);
            $objEliminar=new ProcesoUsuario($id_usuario,"","","","","","","","");
            $objEliminar->eliminar();
            $msg='  <div class="alert alert-danger" align="center">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>El usuario fue Eliminado con Exito</strong>
                            </div>';
        }

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Usuarios</title>
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
        			<h3 class="text-info"><img src="img/usuario.png" class="img-circle" width="60" height="60"> 
                    Registro y Control de Usuarios</h3>
                </div>
    			<div class="span6" align="right" >
                	<form name="form1" method="post" action="" class="form-inline">
                    <!-- INGRESAR NUEVA curso -->
                        <a href="#nuevo" role="button" class="btn" data-toggle="modal">
                            <i class="icon-book"></i> <strong>Ingresar Nuevo Usuario</strong>
                        </a> |
                    	<div class="input-prepend">
                        	<span class="add-on"><i class="icon-search"></i></span>
                            <input name="bus" type="text" placeholder="Buscar usuario por Nombre o Usuario" class="input-xlarge" autocomplete="off" autofocus>
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
        <td><strong>Usuario</strong></td>
        <td><strong>Nombre</strong></td>
        <td><strong>Correo</strong></td>
        <td><strong>Tipo</strong></td>
        <td><strong>Estado</strong></td>
        <td>&nbsp;</td>
      </tr>
      <?php
		if(empty($_POST['bus'])){
			$sql="SELECT * FROM usuario ORDER BY usuario LIMIT $inicio, $maximo";
		}else{
			$bus=limpiar($_POST['bus']);
			$sql="SELECT * FROM usuario WHERE usuario LIKE '%$bus%' or nombre LIKE '%$bus%' ORDER BY usuario LIMIT $inicio, $maximo";
		}
		$n=1;
		$can=mysql_query($sql,Conexion::conectar());
		while($dato=mysql_fetch_array($can)){
	  ?>
      <tr>
        <td><?php echo $dato['usuario'];?></td>
        <td><?php echo $dato['nombre']; ?></td>
        <td><?php echo $dato['correo'];?></td>
        <td><?php echo $dato['tipo']; ?></td>
        <td><?php echo $dato['estado']; ?></td>
        <td>
        	<center>
        	<a href="#act<?php echo $dato['id_usuario']; ?>" role="button" class="btn btn-info" data-toggle="modal" title="Actualizar Usuario">
            	<i class="icon-edit"></i>
            </a>
            <a href="#eli<?php echo $dato['id_usuario']; ?>" role="button" class="btn btn-danger" data-toggle="modal" title="Eliminar Usuario">
                <i class="icon-trash"></i>
            </a>
            </center>
        </td>
      </tr>
    <div id="act<?php echo $dato['id_usuario']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    	<form name="form1" method="post" action="" class="form-inline">
        <input type="hidden" name="id_usuario" value="<?php echo $dato['id_usuario']; ?>">
        <input type="hidden" name="contrasenia" value="<?php echo $dato['contrasenia']; ?>">
    	<div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    		<h3 id="myModalLabel">Actualizar usuario</h3>
    	</div>
    	<div class="modal-body">
   		    <div class="row-fluid">
	            <div class="span6">
                	<strong>Usuario</strong><br>
                    <input type="text" name="usuario" autocomplete="off" required value="<?php echo $dato['usuario']; ?>"><br>
                    <strong>Nombre</strong><br>
                    <input type="text" name="nombre" autocomplete="off" required value="<?php echo $dato['nombre']; ?>"><br>
                    <strong>Correo</strong><br>
                    <input type="email" name="correo" autocomplete="off" required value="<?php echo $dato['correo']; ?>"><br>
                </div>
    	        <div class="span6">
                	<strong>Tipo</strong><br>
                    <select name="tipo">
                        <?php if($dato['tipo']=='A'){ ?>
                        <option value="A" selected>Administrador</option>';     
                        <option value="B">Trabajador</option>';
                        <?php }else{ ?>
                        <option value="B" selected>Trabajador</option>';     
                        <option value="A">Administrador</option>';
                        <?php } ?>
                    </select>
                    <strong>Estado</strong><br>
                    <select name="estado">
                        <?php if($dato['estado']=='Y'){ ?>
                        <option value="Y" selected>Activo</option>';     
                        <option value="N">Inactivo</option>';
                        <?php }else{ ?>
                        <option value="N" selected>No activo</option>';     
                        <option value="Y">Activo</option>';
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

    <div id="eli<?php echo $dato['id_usuario']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form name="form1" method="post" action="" class="form-inline">
        <input type="hidden" name="id_usuario" value="<?php echo $dato['id_usuario']; ?>">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">¿Realmente desea eliminarlo?</h3>
        </div>
        <div class="modal-body">
            <div class="row-fluid">
                <div class="span12">
                    <h4 type="text" name="datousuario"><?php echo '<strong> Usuario: </strong>'.$dato['usuario']; ?></h4><br>
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
						echo '<li class="active"><a href="usuario.php?pag='.$n.'"><strong>'.$n.'</strong></a></li>';	
					}else{
						echo '<li><a href="usuario.php?pag='.$n.'"><strong>'.$n.'</strong></a></li>';	
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
    		<h3 id="myModalLabel">Guardar Nuevo usuario</h3>
    	</div>
    	<div class="modal-body">
        
   		    <div class="row-fluid">
	            <div class="span6">
                	<strong>Usuario</strong><br>
                    <input type="text" name="usuario" autocomplete="off" required><br>
                    <strong>Contraseña</strong><br>
                    <input type="password" name="contrasenia" autocomplete="off" required><br>
                    <strong>Nombre</strong><br>
                    <input type="text" name="nombre" autocomplete="off" required><br>
                    <strong>Correo</strong><br>
                    <input type="email" name="correo" autocomplete="off" required><br>
                </div>
    	        <div class="span6">
                	<strong>Tipo</strong><br>
                    <select name="tipo">
                        <option value="A" selected>Administrador</option>';
                        <option value="B">Trabajador</option>';
                    </select>
                    <strong>Estado</strong><br>
                    <select name="estado">
                        <option value="Y" selected>Activo</option>';
                        <option value="N">Inactivo</option>';
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