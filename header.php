		<div class="container-fluid">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
					  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Navegacion</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button>
					  <a class="navbar-brand" href="administrador.php"><span class="glyphicon glyphicon-home"></span>  Inicio</a>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li><a href="pacientes.php"><span class="glyphicon glyphicon-eye-open"></span> Pacientes</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-play-circle"></span> Rutina de Hoy</a></li>
							</li>
							<li><a href="#"><span class="glyphicon glyphicon-calendar"></span> Calendarización</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-comment"></span> Avisos</a></li>
							<li class="dropdown"><a id="drop2" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt"></span> Reportes <b class="caret"></b></a>							
								<ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
									<li role="presentation"><a role="menuitem" tabindex="-1" href="#" target="admin"><i class="icon-time"></i> <span class="glyphicon glyphicon-time"></span> Semanal</a></li>								
									<li role="presentation" class="divider"></li>
									<li role="presentation"><a role="menuitem" tabindex="-1" href="#" target="admin"><i class="icon-folder-open"></i> <span class="glyphicon glyphicon-time"></span> Mensual</a></li>
								</ul>
							</li>
						<?php if($_SESSION['tipo_usuario']=='a'){   ?>
							<li><a href="usuarios.php"><span class="glyphicon glyphicon-eye-open"></span> Usuarios</a></li>
						<?php } ?>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown"><a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span><?php echo $usuario; ?><b class="caret"></b></a>										
								<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
									<li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="icon-off"></i><span class="glyphicon glyphicon-edit"></span> Cambiar contraseña</a></li>
									<li role="presentation" class="divider"></li>
									<li role="presentation"><a role="menuitem" tabindex="-1" href="cerrarSesion.php"><i class="icon-off"></i><span class="glyphicon glyphicon-off"></span> Salir</a></li>
								</ul>
							</li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>
		</div>