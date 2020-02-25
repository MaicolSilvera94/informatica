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
<section class="container">

	<h1>Solicitud de Servicio Tecnico</h1>

	<div class="formulario">
		<div class="formu">
		<label class="form"  for="caja_busqueda">Ingresa N° de CI o Nombre:</label>
		<input type="text" name="caja_busqueda" id="caja_busqueda"></input>

		</div>
	</div>

	<div id="datos"></div>
	<!--<div class="alert alert-warning alert-dismissable">
  	<button type="button" class="close" data-dismiss="alert">&times;</button>
  	<strong>¡Avido!</strong> En el Campo de Texto puede ingresar su Nombre o numero de Cedula.
	</div>-->




</section>
<!--</section>-->


<script type="text/javascript" src="../servicio-tecnico/js/jquery.min.js"></script>
<script type="text/javascript" src="../servicio-tecnico/js/main.js"></script>
</body>

</html>
