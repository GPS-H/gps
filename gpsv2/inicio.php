<?php
        require_once("clases/clase_login.php");
        include_once('clases/clases.php');
        if(!isset($_SESSION['usuario']) and !isset ($_SESSION['tipo_usuario'])){
          header('location:index.php');
        }
        if($_SESSION['tipo_usuario']=='A'){
          $titulo='Administrador';
        }
        else{
          $titulo='Enfermera';
        }
		
		$usuario=limpiar($_SESSION['usuario']);
		$objUsuario=new ConsultarUsuario($usuario);
		$nombre=$objUsuario->consultar('nombre');
		$nombre=ucwords(strtolower($nombre));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blanco</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    
    
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" />
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
    <style>
    .span4:hover {
        background-color:white;
        background-color: rgba(200,200,200,.3);
        -webkit-border-radius: 10px;
        border-radius: 10px;          
        cursor: pointer;
         margin-top: 5px;    
    }
            .img-circle:hover {
                -webkit-transform: rotate(-7deg);
                -moz-transform: rotate(-7deg);
                -o-transform: rotate(-7deg);
            }
    </style>

</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">

            <table class="table table-bordered">
              <tr class="success">
                <td>
                    <h3 class="text-info"><img src="img/usuario.png" class="img-circle" width="60" height="60"> 
                    Bienvenid@ <?php echo $titulo ." ". $nombre; ?></h3>
                </td>
              </tr>
            </table>
<?php
        $can=mysql_query("SELECT COUNT(id_paciente)as numero FROM paciente where fecha_registro>= (select date_add(NOW(), INTERVAL -3 DAY))");
        if($dato=mysql_fetch_array($can)){
            $ultimos_pacientes=$dato['numero'];
        }
        $can=mysql_query("SELECT COUNT(id_filtro)as numero FROM filtro where estado_filtro = 'NUEVO' and numero_lavado=0");
        if($dato=mysql_fetch_array($can)){
            $filtros_nuevos=$dato['numero'];
        }
        $can=mysql_query("SELECT COUNT(id_filtro)as numero FROM filtro where estado_filtro = 'USO' and numero_lavado>7");
        if($dato=mysql_fetch_array($can)){
            $filtros_viejos=$dato['numero'];
        }
?>
    <div class="row-fluid" align="center">
        <div class="span4">
            <h4 align="center">Ultimos  Pacientes Registrados</h4>
            <img src="img/paciente.jpg" class="img-circle" style="width: 200px; height: 200px;" title="Profesores"><br>
            <h3>Registrados: <?php echo $ultimos_pacientes; ?></h3><br>
            <a href="#pacienteU" role="button" class="btn btn-success" data-toggle="modal" >Mas Detalles</a>
        </div>
        <div class="span4">
            <h4 align="center">Filtros Nuevos</h4>
            <img src="img/filtros.jpg" class="img-circle" style="width: 200px; height: 200px;" title="Materias"><br>
            <h3>Registradas: <?php echo $filtros_nuevos; ?></h3><br>
            <a href="#filtroN" role="button" class="btn btn-info" data-toggle="modal" >Mas Detalles</a>
        </div>
        <div class="span4">
            <h4 align="center">Filtros por cambiar</h4>
            <img src="img/filtros2.jpg" class="img-circle" style="width: 200px; height: 200px;" title="Alumnos"><br>
            <h3>Registrados: <?php echo $filtros_viejos; ?></h3><br>
            <a href="#filtroV" role="button" class="btn btn-danger" data-toggle="modal" >Mas Detalles</a>
        </div>
    </div>

    <div id="pacienteU" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-header" align="center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 id="myModalLabel">Lista de filtros nuevos</h4>
            </div>
            <div class="modal-body">
                <?php
                $can1=mysql_query("SELECT * FROM paciente where fecha_registro>= (select date_add(NOW(), INTERVAL -7 DAY))");
                if ($dato1=mysql_num_rows($can1) == 0){
                    echo'<div class="alert alert-danger" align="center">
                            <strong>No hay filtros nuevos! <a href="filtro.php"> Ver filtros</a></strong>
                         </div>';
                }
                else {
                    while($dato1=mysql_fetch_array($can1)){
                        $url=$dato1['nombre'];
                    ?>
                        <div height:50px;>
                            <blockquote>
                                <a href="paciente.php?bus=<?php echo $url; ?>">
                                    <i class="icon-chevron-right"></i> Nombre: <?php echo $dato1['nombre'].' '.$dato1['apellidos']; ?><br>
                                </a>
                            </blockquote>
                        </div>
                    <?php }
                } ?>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cerrar</strong></button>
            </div>
    </div>
    <div id="filtroN" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-header" align="center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 id="myModalLabel">Lista de los filtros proximos a cambiar</h4>
            </div>
            <div class="modal-body">
                <?php
                $can2=mysql_query("SELECT * FROM filtro where estado_filtro = 'NUEVO' and numero_lavado=0");
                if ($dato2=mysql_num_rows($can2) == 0){
                    echo'<div class="alert alert-danger" align="center">
                            <strong>No hay filtros nuevos! <a href="filtro.php"> Ver filtros</a></strong>
                         </div>';
                }
                else{
                    while($dato2=mysql_fetch_array($can2)) {
                        $url2=$dato2['id_filtro'];
                    ?>
                        <div height:50px;>
                            <blockquote>
                                <a href="filtro.php?bus=<?php echo $url2; ?>">
                                    <i class="icon-chevron-right"></i> Id Filtro: <?php echo $dato2['id_filtro']; ?><br>
                                </a>
                            </blockquote>
                        </div>
                    <?php }
                }   ?>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cerrar</strong></button>
            </div>
    </div>
    <div id="filtroV" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-header" align="center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 id="myModalLabel">Lista de los ultimos pacientes registrados:</h4>
            </div>
            <div class="modal-body">
                <?php
                $can3=mysql_query("SELECT * FROM filtro where estado_filtro = 'USO' and numero_lavado>7");
                if ($dato3=mysql_num_rows($can3) == 0){
                    echo'<div class="alert alert-info" align="center">
                            <strong>No hay filtro proximos a cambiar <a href="filtro.php"> Ver filtros</a></strong>
                         </div>';
                }
                else{
                    while($dato3=mysql_fetch_array($can3)) {
                    $url3=$dato3['id_filtro'];
                ?>
                    <div height:50px;>
                        <blockquote>
                            <a href="filtro.php?bus=<?php echo $url3; ?>">
                                <i class="icon-chevron-right"></i> Id Filtro: <?php echo $dato3['id_filtro']; ?><br>
                            </a>
                        </blockquote>
                    </div>
                    <?php } 
                } ?>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cerrar</strong></button>
            </div>
    </div>
</body>
</html>