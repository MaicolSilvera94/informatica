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

<body class="hold-transition skin-purple fixed">
<div class="wrapper">

  <!-- HEADER -->

  <?php require '../conexion/conexion.php';?>
  <?php
        //Obtener el registro del usuario
        $total = 0;
        if(isset($_GET['id'])){

            if($_GET['id'] > 0){

                $sql = "SELECT * FROM servicios WHERE id = " . $_GET['id'];
                $query = $connection->prepare($sql);
                $query->execute();
                $total = $query->rowCount();

            }

        }


        //Actualizar datos del usuario
        if(isset($_POST)){
             if($_POST['actualizar'] == 'actualizar' && $_POST['sistemas'] != '' && $_POST['id'] > 0){
               if ($_POST['firmafuncionario'] == $_SESSION['password']){
                    $sql = "UPDATE servicios set sistemas = :sistemas, fecha_add = :fecha_add, obsgeneral = :obsgeneral,
                    procesado = :procesado, fechaprocesado = :fechaprocesado, conformidad = 0, calificacion = :calificacion  WHERE id = " . $_POST['id'];
                    $data =  array(
                         'sistemas' => $_POST['sistemas'],
                         'fecha_add' => $_POST['fecha_add'],
                         'obsgeneral' => $_POST['obsgeneral'],
                         'procesado' => $_POST['procesado'],
                         'fechaprocesado' => $_POST['fechaprocesado'],
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
                 $servicios = $query->fetchAll()[0];
                // var_dump($usuario);
              ?>
            <form action="conformidad_edit.php" method="POST">
                <div class="form-group col-md-3">
                    <label>Solicitud</label>
                    <input type="text" name="sistemas" value="<?php echo $servicios['sistemas']; ?><?php echo $servicios['equipos']; ?><?php echo $servicios['redes']; ?>" readonly="readonly" class="form-control">
                </div>
                <?php
                $sistema = $servicios['sistema'];
                if ($sistema != '') { ?>
                  <div class="form-group col-md-3">
                      <label>Sistema</label>
                      <input type="text" name="sistema" value="<?php echo $servicios['sistema']; ?>" readonly="readonly" class="form-control">
                  </div>
                <?php  } ?>
                <?php
                $equipo = $servicios['datosequipos'];
                if ($equipo != '') { ?>
                  <div class="form-group col-md-3">
                      <label>Datos del Equipo</label>
                      <input type="text" name="datosequipos" value="<?php echo $servicios['datosequipos']; ?>" readonly="readonly" class="form-control">
                  </div>
                <?php  } ?>
                <div class="form-group col-md-3">
                    <label>Fecha solicitud</label>
                    <input type="text" name="fecha_add" value="<?php echo $servicios['fecha_add']; ?>" readonly="readonly" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Observacion</label>
                    <input type="text" name="obsgeneral" value="<?php echo $servicios['obsgeneral']; ?>" readonly="readonly" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Procesado Por</label>
                    <input type="text" name="procesado" value="<?php echo $servicios['procesado']; ?>" readonly="readonly" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Fecha Procesado</label>
                    <input type="text" name="fechaprocesado" value="<?php echo $servicios['fechaprocesado']; ?>"  readonly="readonly" class="form-control">
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
                        <input type="hidden" name="id"  value="<?php echo $servicios['id']; ?>">
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
