<?php
        require_once("clases/clase_login.php");
        include_once('clases/clases.php');
        if(!isset($_SESSION['usuario']) and !isset ($_SESSION['tipo_usuario'])){
          header('location:index.php');
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
                <div class="span12">
                    <h3 class="text-info"><img src="img/paciente.jpg" class="img-circle" width="60" height="60"> 
                    Reporte y estadisticas</h3>
                </div>
                <div class="span5" align="left" >
                    <form name="form1" method="post" action="" class="form-inline">
                    <!-- INGRESAR NUEVA curso -->
                        <a href="reporteexcel.php" role="button" class="btn" data-toggle="modal">
                            <i class="icon-book"></i> <strong>Generar Grafica</strong>
                        </a> |
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-search"></i></span>
                            <select name="grafica">
                                <option value="grafica1" selected>Grafica1</option>
                                <option value="grafica2">Grafica2</option>
                                <option value="grafica3">Grafica3</option>
                                <option value="grafica4">Grafica4</option>
                                <option value="grafica5">Grafica5</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="span6" align="right" >
                    <form name="form1" method="post" action="" class="form-inline">
                    <!-- INGRESAR NUEVA curso -->
                        <a href="reporteexcel.php" role="button" class="btn" data-toggle="modal">
                            <i class="icon-book"></i> <strong>Generar Reporte</strong>
                        </a> |
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-search"></i></span>
                            <select name="grafica">
                                <option value="reporte1" selected>Reporte1</option>
                                <option value="reporte2">Reporte2</option>
                                <option value="reporte3">Reporte3</option>
                                <option value="reporte4">Reporte4</option>
                                <option value="reporte5">Reporte5</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </td>
      </tr>
    </table>
</body>
</html>