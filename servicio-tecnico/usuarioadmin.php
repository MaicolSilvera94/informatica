<?php
session_start();
if( !isset($_SESSION['logueado']) ){
    header('Location: login.php');
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Inicio | Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="dist/css/skins/skin-purple.min.css">

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-purple fixed">
<div class="wrapper">

  <!-- HEADER -->
  <?php //include 'includes/header.php'; ?>

  <!-- ASIDE - SIDEBAR  -->
  <?php include 'includes/aside.php'; ?>

  <!-- CONTENIDO -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Página Inicial
      </h1>
      <ol class="breadcrumb">
        <li><a href="usuarioadmin.php"><i class="fa fa-home"></i> Inicio</a></li>
      </ol>
    </section>
    <section class="content container-fluid">
      <div class="panel">
              <div class="row">
                <div class="col-xs-12">
                  <a href="logout.php" class="btn btn-warning btn-lg pull-right" > <i class="fa fa-close"></i> Salir</a>
              </div>
              </div>
            </div>
    </section>
  </div>

</div>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7
<script src="../administradores/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
