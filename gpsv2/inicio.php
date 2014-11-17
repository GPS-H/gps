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
		
		$can=mysql_query("SELECT COUNT(nombre)as numero FROM paciente");
		if($dato=mysql_fetch_array($can)){
			$n_profesor=$dato['numero'];
		}
		$can=mysql_query("SELECT COUNT(nombre)as numero FROM usuario");
		if($dato=mysql_fetch_array($can)){
			$n_materias=$dato['numero'];
		}
		$can=mysql_query("SELECT COUNT(nombre)as numero FROM usuario");
		if($dato=mysql_fetch_array($can)){
			$n_alumno=$dato['numero'];
		}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Inicio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
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

</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">
        <div class="container">

            <table class="table table-bordered">
              <tr class="success">
                <td>
                    <h3 class="text-info"><img src="img/usuario.png" class="img-circle" width="60" height="60"> 
                    Bienvenid@ <?php echo $titulo ." ". $nombre; ?></h3>
                </td>
              </tr>
            </table>

            <!-- Icon Panels - START -->
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <div class="box">
                            <div class="icon">
                                <div class="image"><span class="glyphicon glyphicon-list-alt btn-lg white"></span></div>
                                <div class="info">
                                    <h3 class="title">Recalendarización!</h3>
                                    <p>
                                        <h3>Registrados: <?php echo $n_materias; ?></h3><br>
                                    </p>
                                    <div class="more">
                                        <a href="#" title="Title Link"><i class="fa fa-plus"></i> Mas Información
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="space"></div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <div class="box">
                            <div class="icon">
                                <div class="image"><span class="glyphicon glyphicon-envelope btn-lg white"></span></div>
                                <div class="info">
                                    <h3 class="title">Avizo!</h3>
                                    <p>
                                        <h3>Registrados: <?php echo $n_profesor; ?></h3><br>
                                    </p>
                                    <div class="more">
                                        <a href="#" title="Title Link"><i class="fa fa-plus"></i> Mas Información
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="space"></div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <div class="box">
                            <div class="icon">
                                <div class="image"><span class="glyphicon glyphicon-volume-up btn-lg white"></span></div>
                                <div class="info">
                                    <h3 class="title">Filtro Nuevo!</h3>
                                    <p>
                                        <h3>Registrados: <?php echo $n_materias; ?></h3><br>
                                    </p>
                                    <div class="more">
                                        <a href="#" title="Title Link"><i class="fa fa-plus"></i> Mas Información
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="space"></div>
                        </div>
                    </div>
                </div>
            </div>

            <style>
            .white {
                color: white;
            }

            .btn-lg {
                font-size: 38px;
                line-height: 1.33;
                border-radius: 6px;
            }

            .box > .icon {
                text-align: center;
                position: relative;
            }

            .box > .icon > .image {
                position: relative;
                z-index: 2;
                margin: auto;
                width: 88px;
                height: 88px;
                border: 7px solid white;
                line-height: 88px;
                border-radius: 50%;
                background: #63B76C;
                vertical-align: middle;
            }

            .box > .icon:hover > .image {
                border: 4px solid black;
            }

            .box > .icon > .image > i {
                font-size: 40px !important;
                color: #fff !important;
            }

            .box > .icon:hover > .image > i {
                color: white !important;
            }

            .box > .icon > .info {
                margin-top: -24px;
                background: rgba(0, 0, 0, 0.04);
                border: 1px solid #e0e0e0;
                padding: 15px 0 10px 0;
            }

                .box > .icon > .info > h3.title {
                    color: #222;
                    font-weight: 500;
                }

                .box > .icon > .info > p {
                    color: #666;
                    line-height: 1.5em;
                    margin: 20px;
                }

            .box > .icon:hover > .info > h3.title, .box > .icon:hover > .info > p, .box > .icon:hover > .info > .more > a {
                color: #222;
            }

            .box > .icon > .info > .more a {
                color: #222;
                line-height: 12px;
                text-transform: uppercase;
                text-decoration: none;
            }

            .box > .icon:hover > .info > .more > a {
                color: #000;
                padding: 6px 8px;
                border-bottom: 4px solid black;
            }

            .box .space {
                height: 30px;
            }
            </style>

            <!-- Icon Panels - END -->

        </div>
    </body>
</body>
</html>