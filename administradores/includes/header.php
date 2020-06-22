<?php require '../conexion/conexion.php';?>
<header>
	<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-navbar" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<!--<a class="navbar-header" href="index.php">
							<img src="images/logos/logopng2.png" width="40px">
						</a>-->
            <a class="navbar-header navbar-brand">INFORMATICA PJCDE</a>
						<!--<div class="asem navbar-header collapse navbar-collapse" id="menu-navbar">
							<h3>ASEM</h3>
						</div>-->
				</div>

			    <div class="collapse navbar-collapse" id="menu-navbar">
			      <ul class="nav navbar-nav navbar-right">
			        <li><a href="index.php">INICIO</a></li>
							<li class="dropdown">
			         <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">INFORMES <span class="caret"></span></a>
			         <ul class="dropdown-menu">
			            <li><a href="informes.php">INFORMES DE SERVICIOS</a></li>
			            <li><a href="informesexpedientes.php">INFORMES DE EXPEDIENTES</a></li>
			            <!--<li><a href="#">Something else here</a></li>
			            <li role="separator" class="divider"></li>
			            <li><a href="#">Separated link</a></li>-->
			          </ul>
			        </li>
			        <li><a href="perfil_edit.php">PERFIL</a></li>
			        <li><a class="usuario" href="#">BIENVENIDO  <?php echo $_SESSION['usuario']; ?></a></li>
			          </ul>
			        </li>
			      </ul>
			    </div>
		  </div>
		</nav>
</header>
