<?php
session_start();
if( !isset($_SESSION['logueado']) ){
    header('Location:login.php');
}
include('../funciones/funciones.php');
?>


<!DOCTYPE html>
<html lang="es_PY">
<head>
	<title>Desarrollo Web Profesional</title>
	<meta name="description" content="">
	<?php include '../includes/head.php'; ?>
</head>
<body>
	<!-- Inicio encabezado del sitio -->
	<?php include '../includes/header.php'; ?>
	<!-- Fin encabezado del sitio -->

	<!-- Inicio cuerpo del sitio -->
	<main>
		<!-- Slider
		<section class="container">
			<div id="slides" class="owl-carousel owl-theme">
				<div class="item">
					<img src="../images/slides/sli4.png">
				</div>
				<div class="item">
				  	<img src="../images/slides/sli4.png">
				</div>
			</div>
		</section>-->

		<!-- INICIO SECTION TEAM -->
				<section class="section-team">
					<div class="container">
						<div class="row">
              <!--**************************************************************************************************-->
              <?php foreach(getTranLista(100) as $tran) { ?>
              <div class="col-sm-6">
                <div class="box-team">
                  <h5 class="soli">N°: <?php echo $tran['id']; ?> - Fecha: <?php echo $tran['fecha_add']; ?></h5>
                  <!--<i class="icon ion-md-person"></i>-->
                  <img class="" src="../images/usuario.png" width="40px">
                  <h3><?php echo $tran['nombreapellido']; ?> - <?php echo $tran['cargo']; ?></h3>
                  <a class="bg-facebook">
                    <i class=""></i> Juzgado: <?php echo $tran['dependencia']; ?>
                  </a>

                  <a class="bg-twitter" >
                    <i class="icon"></i> Solicitud: <?php echo $tran['sistemas'];?> <?php echo $tran['tipo'];?>
                  </a>

                  <a class="bg-instagram">
                    <i class="icon "></i>Caratula:  <?php echo $tran['caratula'];?>
                  </a>

                  <a class="bg-instagram">
                    <i class="icon "></i> OBS:  <?php echo $tran['obsgeneral'];?> <?php echo $tran['obstran'];?>
                  </a>

                  <a class="btn btn-primary pull-right" href="transferencias_edit.php?id=<?php echo $tran['id'] ?>">Procesar<i class="fa fa-edit"></i></a>
                </div>
              </div>
              <?php } ?>
              <!--**************************************************************************************************-->
							<?php foreach(getCmsLista(100) as $cms) { ?>
							<div class="col-sm-6">
								<div class="box-team">
									<h5 class="soli">N°: <?php echo $cms['id']; ?> - Fecha: <?php echo $cms['fecha_add']; ?></h5>
									<!--<i class="icon ion-md-person"></i>-->
									<img class="" src="../images/usuario.png" width="40px">
									<h3><?php echo $cms['nombreapellido']; ?> - <?php echo $cms['cargo']; ?></h3>
									<a class="bg-facebook">
										<i class=""></i> Juzgado: <?php echo $cms['dependencia']; ?>
									</a>

									<a class="bg-twitter" >
										<i class="icon"></i> Solicitud: <?php echo $cms['sistemas'];?> <?php echo $cms['equipos'];?> <?php echo $cms['redes'];?> <?php echo $cms['tipo'];?>
									</a>

									<a class="bg-instagram">
										<i class="icon "></i>Solicitado por:  <?php echo $cms['solicitado'];?>
									</a>

                  <a class="bg-instagram">
										<i class="icon "></i> OBS:  <?php echo $cms['obsgeneral'];?> <?php echo $cms['obsequipos'];?> <?php echo $cms['obsredes'];?> <?php echo $cms['obstran'];?>
									</a>

                  <a class="btn btn-primary pull-right" href="servicio_edit.php?id=<?php echo $cms['id'] ?>">Procesar<i class="fa fa-edit"></i></a>
								</div>
							</div>
							<?php } ?>
						</div>
						<div class="fixed-action-btn">
							<a href="servicio_add.php" class="btn-floating btn-large red">
								<i class="large material-icons">add</i>
							</a>
						</div>
					</div>
				</section>

 </main>
<!-- <div class="containerbut">
 	<input type="checkbox" id="toggle">
 	<label for="toggle" class="buttonfl"></label>
 	<nav class="navfl">
 		<a href="#">Inicio</a>
 		<a href="#">Registrar</a>
 		<a href="#">Eliminar</a>
 	</nav>
 </div>-->

	<?php include '../includes/script.php'; ?>
</body>
</html>
