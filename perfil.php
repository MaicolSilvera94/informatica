<?php
session_start();
include('conexion/conexion.php');
if( !isset($_SESSION['logueado']) ){
    header('Location:administradores/login.php');
}
?>
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


	<?php include 'includes/script.php'; ?>
</body>
</html>
