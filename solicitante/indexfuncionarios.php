<!DOCTYPE html>
<html lang="es">
<head>
	<title>Desarrollo Web Profesional</title>
	<meta name="description" content="">
	<?php include 'includes/head.php'; ?>
</head>
<body>
	<!-- Inicio encabezado del sitio -->
	<?php include 'includes/header.php'; ?>
	<!-- Fin encabezado del sitio -->

	<!-- Inicio cuerpo del sitio -->
	<main>
		<!-- Slider -->
		<section class="container-sli">
			<div id="slides" class="owl-carousel owl-theme">
				<div class="item">
					<img src="images/slides/sli1.jpg">
				</div>
				<div class="item">
				  	<img src="images/slides/sli2.jpg">
				</div>
			</div>
		</section>

		<!-- INICIO SECTION TEAM -->
				<section class="section-team">
					<div class="container">

						<div class="row">
							<?php for ($i=0; $i < 10; $i++) { ?>
							<div class="col-sm-6">
								<div class="box-team">
									<h5 class="soli">N°: 20 - Fecha: 19/08/2019</h5>
									<!--<i class="icon ion-md-person"></i>-->
									<img class="" src="images/usuario.png" width="40px">
									<h3>Gloria Vera - Actuaria</h3>
									<a class="bg-facebook">
										<i class=""></i> Juzgado: Sentencia N°7 Sec. 10 - Penal
									</a>

									<a class="bg-twitter" >
										<i class="icon"></i> Solicitud: Problema con la Impresora
									</a>

									<a class="bg-instagram">
										<i class="icon "></i> OBS: Urgente
									</a>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</section>


		<!-- INICIO SECTION TEAM -->
 </main>
	<!-- Fin cuerpo del sitio -->

	<!-- Inicio pie del sitio -->

	<!-- Fin pie del sitio -->
	<?php include 'includes/script.php'; ?>

</body>
</html>
