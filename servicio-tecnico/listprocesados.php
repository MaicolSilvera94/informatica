<?php
session_start();
if(isset($_SESSION['logueado'])){
  if($_SESSION["rol"] == 0){   
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
  <link rel="stylesheet" href="dist/css/estilos.css">
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

    $sql = "SELECT * FROM servicios WHERE conformidad = 0 and visible = 0 AND cedula = " .$_SESSION['cedula'];
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
       Solicitud Procesados
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Inicio</a></li>
        <li><span>Solicitud Procesados</span></li>
      </ol>
    </section>
    <section class="container-fluid">
      <div class="tab panel">
        <table class="table table-bordered table-striped table-hover">
        <thead>
          <tr>
            <th>Nro.</th>
            <th>SOLICITUD</th>
            <th>FECHA SOLICITUD</th>
            <th>PROCESADO POR</th>
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
            <td><?php echo $file['sistemas']; ?><?php echo $file['equipos']; ?><?php echo $file['redes']; ?></td>
            <td><?php echo $file['fecha_add']; ?>  </td>
            <td><?php echo $file['procesado']; ?> </td>
            <td><?php echo $file['obsgeneral']; ?></td>
            <td><?php echo $file['fechaprocesado']; ?></td>

            <td>
                <?php if( $file['visible'] == 0 ) {  ?>
                    <i class="fa fa-check text-green">Procesado</i>

                <?php } else {   ?>
                    <i class="fa fa-remove text-red">Pendiente</i>
                <?php }  ?>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      </div>
 <!--*************************************************************************-->
      <section class="titletablesec">
        <h1>
         Transferencias Procesados
        </h1>
      </section>

      <div class="tab panel">
        <table class="table table-bordered table-striped table-hover">
        <thead>
          <tr>
            <th>Nro.</th>
            <th>SOLICITUD</th>
            <th>FECHA SOLICITUD</th>
            <th>CAUSA</th>
            <th>AÑO</th>
            <th>CARATULA</th>
            <th>OBSERVACIONES</th>
            <th>FECHA PROCESADO</th>
            <th class="text-center" width="10%">
              <i class="fa fa-cogs"></i>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php
           if (isset($_SESSION['cedula'])) {

            $sql = "SELECT * FROM transferencias WHERE visible = 0 AND conformidad = 0  AND cedula = " .$_SESSION['cedula'];
            $query = $connection->prepare($sql);
            $query->execute();
            }
          ?>
          <?php foreach ($query->fetchAll() as $filee ) {  ?>
           <tr>
            <td><?php echo $filee['id']; ?> </td>
            <td><?php echo $filee['tipo'];?> </td>
            <td><?php echo $filee['fecha_add']; ?></td>
            <td><?php echo $filee['causa']; ?>  </td>
            <td><?php echo $filee['ano']; ?> </td>
            <td><?php echo $filee['caratula']; ?></td>
            <td><?php echo $filee['obsgeneral']; ?></td>
            <td><?php echo $filee['fechaprocesado']; ?></td>

            <td class="text-center">
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
      <!--*************************************************************************-->
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
<?php 
  } else {
    header('Location:logout.php');
  }
} else {
  if(!isset($_SESSION['logueado'])){
    header('Location:login.php');
  }  
}  
?>