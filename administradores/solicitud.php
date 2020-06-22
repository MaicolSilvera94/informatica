<?php
@session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../servicio-tecnico/css/estilo.css">
	<title>Solicitud de Servicio Tecnico</title>
</head>
<body>
	<main>
	<section class="container">
		<div class="logo col-md-2">
			<img src="../images/csj.jpg" width="200px">
		</div>
		<div class="col-md-7">
			<h1>Solicitud de Servicio Tecnico</h1>
		</div>
		<div class="col-md-2">
			<img src="../images/compromiso.jpg" width="200px">
		</div>
		<div class="formulario col-md-12">
			<div class="formu">

			<label class="form"  for="caja_busqueda">Ingresa N° de CI o Nombre:</label>
			<input type="text" name="caja_busqueda" id="caja_busqueda"></input>

			</div>
		</div>

		<div id="datos"></div>
	</section>
</main>
<!--</section>-->

<?php include '../includes/script.php'; ?>
<script type="text/javascript" src="../servicio-tecnico/js/jquery.min.js"></script>
<script type="text/javascript" src="../servicio-tecnico/js/main.js"></script>
</body>

</html>
