<?php
require_once("clases/clase_login.php");
include_once('clases/clases.php');
if(!isset($_SESSION['usuario']) and !isset ($_SESSION['tipo_usuario'])){
  header('location:index.php');
}
$usuario=limpiar($_SESSION['usuario']);
$objUsuario=new ConsultarUsuario($usuario);
$nombre=$objUsuario->consultar('nombre');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Principal</title>
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
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="ico/est2.png">


</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">
	<!-- Navbar
    ================================================== -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active">
                <a href="inicio.php" target="admin"><strong>Inicio</strong></a>
              </li>
              <li class="active">
                <a href="paciente.php" target="admin"><strong>Pacientes</strong></a>
              </li>
              <?php if($_SESSION['tipo_usuario']=='A'){   ?>
              <li class="active">
                <a href="usuario.php" target="admin"><strong>Usuarios</strong></a>
              </li>
              <li class="active">
                <a href="registro.php" target="admin"><strong>Registros</strong></a>
              </li>
              <?php } ?>
              <li class="active">
                <a href="filtro.php" target="admin"><strong>Filtros</strong></a>
              </li>
              <li class="active">
                <a href="reporte.php" target="admin"><strong>Reportes</strong></a>
              </li>
            </ul>
            <ul class="nav pull-right">
            <li id="fat-menu" class="dropdown active">
              <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><strong> <?php echo $nombre; ?></strong> <b class="caret"></b></a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="cambiar_clave.php" target="admin">Cambiar Contraseña</a></li>
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="cerrarSesion.php"><i class="icon-off"></i> Salir</a></li>
              </ul>
            </li>
          </ul>
          </div>
        </div>
      </div>
    </div>
	<!-- Navbar ================================================== -->
    <div align="center">
        <table width="97%" border="0">
          <tr>
            <td>
            	<iframe src="inicio.php" name="admin" frameborder="0" scrolling="auto" width="100%" height="900" AllowTransparency="true"></iframe>
            </td>
          </tr>
        </table>
	</div>
</body>
</html>