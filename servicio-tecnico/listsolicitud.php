<?php
session_start();
if( !isset($_SESSION['logueado']) ){
    header('Location:login.php');
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Usuarios | Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="dist/css/skins/skin-purple.min.css">
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-purple fixed">
<div class="wrapper">

  <!-- HEADER -->
  <?php include '../conexion/conexion.php'; ?>
  <?php
   if (isset($_SESSION['cedula'])) {

    $sql = "SELECT * FROM servicios WHERE visible = 1 and cedula = " .$_SESSION['cedula'];
    $query = $connection->prepare($sql);
    $query->execute();
    }

  ?>

  <!-- ASIDE - SIDEBAR  -->
  <?php include 'includes/aside.php'; ?>

  <!-- CONTENIDO -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
       Pendientes de Procesamientos
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Inicio</a></li>
        <li><span>Pendientes de Procesamientos</span></li>
      </ol>
    </section>
    <section class="content container-fluid">



      <div class="panel">
        <table class="table table-bordered table-striped table-hover">
        <thead>
          <tr>
            <th>Nro.</th>
            <th>SOLICITUD</th>
            <th>FECHA SOLICITUD</th>
            <th>SOLICITADO POR</th>
            <th>OBSERVACIONES</th>
            <th>FECHA PROCESADO</th>
            <th class="text-center" width="10%">
              <i class="fa fa-cogs"></i>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($query->fetchAll() as $file ) {  ?>
           <tr>
            <td><?php echo $file['id']; ?>  </td>
            <td>
              <?php
             include '../conexion/conexion2.php';
             if( $file['sistemas']  != ''){
                 $idsistemas = $file['sistemas'];
                 $consulta="SELECT * FROM sistemas WHERE idsistemas = '$idsistemas' ";
                 $ejecutar=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
               ?>
               <?php foreach ($ejecutar as $opciones):?>
                 <?php echo $opciones['nombre'];?>
               <?php endforeach ?>
             <?php   } else { ?>
                <?php echo $file['equipos'];?> <?php echo $file['redes'];?>
             <?php }  ?>

            </td>
            <td><?php echo $file['fecha_add']; ?>  </td>
            <td><?php echo $file['solicitado']; ?> </td>
            <td><?php echo $file['obsgeneral']; ?></td>
            <td><?php echo $file['fechaprocesado']; ?></td>

            <td>
                <?php if( $file['visible'] == 1 ) {  ?>
                   <i class="fa fa-remove text-red">Pendiente</i>
                <?php } else {   ?>
                    <i class="fa fa-check text-green">Procesado</i>
                <?php }  ?>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      </div>
    </section>
  </div>


</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
