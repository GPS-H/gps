<?php 
require_once 'clases/clase_login.php';
$msg="";
$sesion = new Login();
if(!empty($_POST['usu']) and !empty($_POST['con'])){
	$sesion->crearSesion();
}
if(isset ($_GET['usuario'])){
	if($_GET['usuario']=='no_existe'){
		$msg='<label>Usuario o contraseña <span class="blue">Incorrecta!</span></label>';
	}
	else if($_GET['usuario']=='inactivo'){
		$msg='<label>Usuario Inactivo consulte con el <span class="blue">Administrador!</span></label>';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Responsive HTML template for Your company">
    <meta name="author" content="Oskar Żabik (oskar.zabik@gmail.com)">

    <!-- Le styles -->
    <link href="css/inicio/bootstrap.min.css" rel="stylesheet">
    <link href="css/inicio/bootstrap-responsive.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/inicio/typica-login.css">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le favicon -->
    <link rel="shortcut icon" href="img/icono.png">

  </head>

  <body>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="index.html"><img src="img/logo.png" alt="Typica - Bootstrap Awesome Template!"></a><br>
        </div>
      </div>
    </div>

    <div class="container">

        <div id="login-wraper">
            <form class="form login-form"method="post" action="">
                <legend>Iniciar Sesión <span class="blue">Acceso</span></legend>
				<h3 class="text-info"><img src="img/usuario.png" class="img-circle" width="80" height="80"> 
                <div class="body">
                    <input type="text" name="usu" placeholder="Usuario" autocomplete="off" required><br>
                    <input type="password" name="con" placeholder="Contraseña" autocomplete="off" required>
                </div>
				<?php echo $msg; ?>
                <div class="footer">
                    <label class="checkbox inline">
                        <input type="checkbox" id="inlineCheckbox1" value="option1"> Recordarme
                    </label>
                                
                    <button type="submit" class="btn btn-success">Acceder</button>
                </div>
            
            </form>
        </div>

    </div>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/inicio/jquery.js"></script>
    <script src="js/inicio/bootstrap.js"></script>
    <script src="js/inicio/backstretch.min.js"></script>
    <script src="js/typica-login.js"></script>
  </body>
</html>