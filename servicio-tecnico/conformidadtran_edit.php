<?php
session_start()
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Confromidad | Admin</title>
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-purple fixed">
<div class="wrapper">

  <!-- HEADER -->

  <?php require '../conexion/conexion.php';?>
  <?php
        //Obtener el registro del usuario
        $total = 0;
        if(isset($_GET['id'])){

            if($_GET['id'] > 0){

                $sql = "SELECT * FROM transferencias WHERE id = " . $_GET['id'];
                $query = $connection->prepare($sql);
                $query->execute();
                $total = $query->rowCount();

            }

        }


        //Actualizar datos del usuario
        if(isset($_POST)){
             if($_POST['actualizar'] == 'actualizar' && $_POST['tipo'] != '' && $_POST['id'] > 0){
               if ($_POST['firmafuncionario'] == $_SESSION['password']){
                    $sql = "UPDATE transferencias set tipo = :tipo, conformidad = 0, calificacion = :calificacion  WHERE id = " . $_POST['id'];
                    $data =  array(
                         'tipo' => $_POST['tipo'],
                         'calificacion' => $_POST['calificacion']

                    );
                    $query = $connection->prepare($sql);
                  try{

                    if( $query->execute($data) ){

                        echo '<script> alert ("SU SOLICITUD FUE FINALIZADO CORRECTAMENTE!!"); window.location = "conformidad.php"; </script>';

                    }

                     } catch(Exception $e){
                  }
              ?><?php  } else { ?>
                  <script type="text/javascript">
                    alert ('CLAVE INCORRECTA');
                    window.location = "conformidad.php";
                  </script>
                <?php } ?>
            <?php } ?>
  <?php } ?>


  <!-- ASIDE - SIDEBAR  -->
  <?php include 'includes/aside.php'; ?>

  <!-- CONTENIDO -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Confirmar Solicitud
      </h1>
      <ol class="breadcrumb">
        <li><a href="conformidad.php"><i class="fa fa-home"></i> Inicio</a></li>
        <li><span>Confirmar Solicitud</span></li>
      </ol>

    </section>
    <section class="content container-fluid">

      <div class="panel">
        <div class="row">
          <?php if($total > 0) {
                 $transferencias = $query->fetchAll()[0];
                // var_dump($usuario);
              ?>
            <form action="conformidadtran_edit.php" method="POST">
                <div class="form-group col-md-3">
                    <label>Solicitud</label>
                    <input type="text" name="tipo" value="<?php echo $transferencias['tipo']; ?>" readonly="readonly" class="form-control">
                </div>
                <div class="form-group col-md-1">
                    <label>Causa</label>
                    <input type="text" name="causa" value="<?php echo $transferencias['causa']; ?>" readonly="readonly" class="form-control">
                </div>
                <div class="form-group col-md-1">
                    <label>Año</label>
                    <input type="text" name="ano" value="<?php echo $transferencias['ano']; ?>" readonly="readonly" class="form-control">
                </div>
                <div class="form-group col-md-7">
                    <label>Caratula</label>
                    <input type="text" name="caratula" value="<?php echo $transferencias['caratula']; ?>" readonly="readonly" class="form-control">
                </div>
                <?php
                $relacion = $transferencias['relacion'];
                if ($relacion != '') { ?>
                  <div class="form-group col-md-3">
                      <label>En Relacion a</label>
                      <input type="text" name="relacion" value="<?php echo $transferencias['relacion']; ?>" readonly="readonly" class="form-control">
                  </div>
                <?php  } ?>
                <div class="form-group col-md-3">
                    <label>Juzgado de Destino</label>
                    <input type="text" name="juzgado" value="<?php echo $transferencias['juzgado']; ?>"  readonly="readonly" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Procesado por</label>
                    <input type="text" name="procesado" value="<?php echo $transferencias['procesado']; ?>"  readonly="readonly" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Fecha de Proceso</label>
                    <input type="text" name="fechaprocesado" value="<?php echo $transferencias['fechaprocesado']; ?>"  readonly="readonly" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label>Observacion</label>
                    <input type="text" name="obsgeneral" value="<?php echo $transferencias['obsgeneral']; ?>"  readonly="readonly" class="form-control">
                </div>

                <div class="form-group col-md-2">
                   <label>Calificacion:</label>
                   <select name="calificacion" class="form-control " required>
                       <option value=""  >Seleccione Una Opcion</option>
                       <option value="Mal Servicio"  >Mal Servicio</option>
                       <option value="Buen Servicio"  >Buen Servicio</option>
                       <option value="Muy Buen Servicio"  >Muy Buen Servicio</option>
                       <option value="Excelente Servicio"  >Excelente Servicio</option>
                   </select>
                 </div>

                <div class="form-group col-md-3">
                    <label>Firma con tu Clave</label>
                    <input type="password" name="firmafuncionario" value="" required class="form-control">
                </div>

                <div class="col-md-1">
                        <br>
                        <input type="hidden" name="id"  value="<?php echo $transferencias['id']; ?>">
                       <button type="submit" name="actualizar" value="actualizar" class="btn btn-primary">Confirmar</button>
                </div>

            </form>

          <?php } ?>

        </div>
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
