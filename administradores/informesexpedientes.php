<?php
session_start();
if( !isset($_SESSION['logueado']) ){
    header('Location:login.php');
}
//include('../funciones/funciones.php');
?>


<!DOCTYPE html>
<html lang="es_PY">
<head>
	<title>Informes</title>
  <meta name="theme-color" content="#1a2d90">
	<meta name="description" content="">
	<?php include '../includes/head.php'; ?>
  <link rel="stylesheet" href="dist/css/estilos.css">
</head>
<body>
	<!-- Inicio encabezado del sitio -->
	<?php include 'includes/header.php'; ?>
	<!-- Fin encabezado del sitio -->

	<!-- Inicio cuerpo del sitio -->
	<main>


		<!-- INICIO SECTION TEAM -->
      <section class="section-team">
        <div class="container">
          <h3 class="title">Lista de Gestiones de Expedientes Procesados por <?php echo $_SESSION['usuario'];?> <?php echo $_SESSION['apellido']; ?></h3>
          <div class="row">
            <div class="infobuscar col-xs-3">
              <input name="caja_busqueda" id="caja_busqueda" type="text" class="buscar form-control" placeholder="BUSCAR" />
            </div>
          </div>
          <div id="datos" class="tab panel">
          </div>
        </div>

      </section>
<!--****************************************************************************************************************************-->
<section class="section-team">
  <div class="container">
    <h3 class="title">CANTIDAD de Gestiones de Expedientes REALIZADOS POR <?php echo $_SESSION['usuario'];?> <?php echo $_SESSION['apellido']; ?></h3>


    <div class="row">
      <div class="col-sm-4">
        <div class="box-teamb">
          <h4>Gestiones de Expedientes</h4>
          <a class="bg-a">
            <?php
             include '../conexion/conexion.php';
             $sql = "SELECT COUNT(id) as quantity FROM transferencias WHERE tipo = 'transferencia penal' and cedulaprocesado = ".$_SESSION['cedula'];
             $stmt = $connection->prepare($sql);
             $stmt->execute();
             $row = $stmt->fetch(PDO::FETCH_ASSOC);
             echo ' Transferencia Penal: ' .$row['quantity'] ;
            ?>
          </a>

          <a class="bg-b">
              <?php
               include '../conexion/conexion.php';
               $sql = "SELECT COUNT(id) as quantity FROM transferencias WHERE tipo = 'transferencia no penal' and cedulaprocesado = ".$_SESSION['cedula'];
               $stmt = $connection->prepare($sql);
               $stmt->execute();
               $row = $stmt->fetch(PDO::FETCH_ASSOC);
               echo ' Transferencia no Penal: ' .$row['quantity'] ;
              ?>
          </a>

          <a class="bg-a">
              <?php
               include '../conexion/conexion.php';
               $sql = "SELECT COUNT(id) as quantity FROM transferencias WHERE tipo = 'activacion de expediente' and cedulaprocesado = ".$_SESSION['cedula'];
               $stmt = $connection->prepare($sql);
               $stmt->execute();
               $row = $stmt->fetch(PDO::FETCH_ASSOC);
               echo ' Activacion de Expediente: ' .$row['quantity'] ;
              ?>
          </a>

          <a class="bg-a">
              <?php
               include '../conexion/conexion.php';
               $sql = "SELECT COUNT(id) as quantity FROM transferencias WHERE tipo != '' and cedulaprocesado = ".$_SESSION['cedula'];
               $stmt = $connection->prepare($sql);
               $stmt->execute();
               $row = $stmt->fetch(PDO::FETCH_ASSOC);
               echo ' Total: ' .$row['quantity'] ;
              ?>
          </a>
        </div>
      </div>

    </div>
  </div>
</section>

<!--****************************************************************************************************************************-->


 </main>

 <script type="text/javascript" src="js/jquery.min.js"></script>
 <script type="text/javascript" src="js/mains2.js"></script>
</body>
</html>
