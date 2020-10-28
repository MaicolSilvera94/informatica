<?php
session_start();
if(isset($_SESSION['logueado'])){
  if($_SESSION["rol"] != 1){
    header('Location:logout.php');
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php include '../includes/head.php'; ?>
  <title>Solicitud de Servicios Informaticos</title>
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
  <link rel="stylesheet" href="dist/css/skins/skin-purple.min.css">
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <script>
            function subir_imagen(input, carpeta)
            {
                self.name = 'opener';
                var name = document.getElementsByName("nombre")[0].value;
                remote = open('gestor/subir_imagen.php?name='+name+'&input='+input+'&carpeta='+carpeta ,'remote', 'align=center,width=600,height=300,resizable=yes,status=yes');
                remote.focus();
            }

            </script>
</head>
<body class="">
<div class="wrapper">

  <?php include 'includes/header.php'; ?>
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

            if($_POST['actualizar'] == 'actualizar' && $_POST['nombreapellido'] != '' && $_POST['id'] > 0){
              $firmaprocesado = $_POST['firmaprocesado'];
              if ($firmaprocesado == $_SESSION['password']) {
                   $sql = "UPDATE transferencias set nombreapellido = :nombreapellido, cargo = :cargo, dependencia = :dependencia,
                   interno = :interno, fecha_add = :fecha_add, sistemas = :sistemas, tipo = :tipo, causa = :causa, ano = :ano,
                   caratula = :caratula, relacion = :relacion, juzgado = :juzgado, obstran = :obstran, procesado = :procesado, fechaprocesado=NOW(),
                   obsgeneral = :obsgeneral, firmaprocesado = :firmaprocesado,  visible = 0, conformidad = 1, cedulaprocesado = :cedulaprocesado   WHERE id = " . $_POST['id'];
                   $data =  array(
                        'nombreapellido' => $_POST['nombreapellido'],
                        'cargo' => $_POST['cargo'],
                        'dependencia' => $_POST['dependencia'],
                        'interno' => $_POST['interno'],
                        'fecha_add' => $_POST['fecha_add'],
                        'sistemas' => $_POST['sistemas'],
                        'tipo' => $_POST['tipo'],
                        'causa' => $_POST['causa'],
                        'ano' => $_POST['ano'],
                        'caratula' => $_POST['caratula'],
                        'relacion' => $_POST['relacion'],
                        'juzgado' => $_POST['juzgado'],
                        'obstran' => $_POST['obstran'],
                        'procesado' => $_POST['procesado'],
                        'obsgeneral' => $_POST['obsgeneral'],
                        'firmaprocesado' => $_SESSION['usuario'],
                        'cedulaprocesado' => $_POST['cedulaprocesado']
                   );

                   $query = $connection->prepare($sql);


                 try{

                    $query->execute($data);
                    } catch(Exception $e){
                 }
               } else {
                  echo '<script> window.location = "mensajenoprocesado.php"</script>';
               }
            }
       }
   ?>
 <?php include 'includes/mensajes.php';?>

  <!-- ASIDE - SIDEBAR  -->

  <!-- CONTENIDO -->
  <div class="container">
    <section class="content-header">
      <div class="tituloinfor form-group col-md-12">
        <a>SECCIÓN INFORMÁTICA</a>
      </div>
      <div class="tituloinfor form-group col-md-12">
        <a>Solicitud de Servicios Informáticos</a>
      </div>
      <!--<ol class="breadcrumb">
        <li><a href="index2.php"><i class="fa fa-home"></i> Inicio</a></li>
      </ol>-->
    </section>
    <div class="form-group col-md-12">
         <hr/>
     </div>
    <section class="content container-fluid">

      <div class="panel">
        <div class="row">
          <?php if($total > 0) {
                 $servicios = $query->fetchAll()[0];
                // var_dump($usuario);
              ?>
            <form action="transferencias_edit.php" method="POST" name="form">
              <div class="solicitante form-group col-md-12">
                <a>Datos del Solicitante</a>
              </div>
                <div class="form-group col-md-12">
                    <label>Nombre y Apellido:</label>
                    <input type="text" name="nombreapellido" value="<?php echo $servicios['nombreapellido']; ?>" required class="form-control">
                </div>

                 <div class="form-group col-md-12">
                    <label>Cargo o Funcion:</label>
                    <input type="text" name="cargo" value="<?php echo $servicios['cargo']; ?>" required class="form-control">
                </div>

                <div class="form-group col-md-12">
                   <label>Dependencia:</label>
                   <input type="text" name="dependencia" value="<?php echo $servicios['dependencia']; ?>" class="form-control">
               </div>
               <div class="form-group col-md-4">
                  <label>Interno:</label>
                  <input type="text" name="interno" value="<?php echo $servicios['interno']; ?>" class="form-control">
                </div>
                <div class="form-group col-md-4">
                   <label>Fecha y Hora:</label>
                   <input type="text" name="fecha_add"  value="<?php echo $servicios['fecha_add']; ?>" class="form-control">
                 </div>
                  <div class="form-group col-md-12">
                       <hr/>
                  </div>
                  <div class="tipo form-group col-md-12">
                    <a>TIPO DE SOLICITUD</a>
                  </div>
                  <div class="solicitante form-group col-md-12">
                     <a>Sistemas</a>
                     <select name="sistemas" class="form-control" required>
                         <option value=""  >Seleccione Una Opcion</option>
                         <option value="Creacion de Usuario"  <?php if($servicios['sistemas'] == "Creacion de Usuario"){ echo 'selected'; } ?> >Creacion de Usuario</option>
                         <option value="Cambio/Reseteo de Contraseña"  <?php if($servicios['sistemas'] == "Cambio/Reseteo de Contraseña"){ echo 'selected'; } ?>>Cambio/Reseteo de Contraseña</option>
                         <option value="Deshabilitacion de Usuario"  <?php if($servicios['sistemas'] == "Deshabilitacion de Usuario"){ echo 'selected'; } ?>>Deshabilitacion de Usuario</option>
                         <option value="Instalación de Sistema"  <?php if($servicios['sistemas'] == "Instalación de Sistema"){ echo 'selected'; } ?>>Instalación de Sistema</option>
                         <option value="Actualizacion de Sistema"  <?php if($servicios['sistemas'] == "Actualizacion de Sistema"){ echo 'selected'; } ?>>Actualizacion de Sistema</option>
                         <option value="Otros"  <?php if($servicios['sistemas'] == "Otros"){ echo 'selected'; } ?>>Otros</option>
                     </select>
                 </div>
                 <div class="form-group col-md-12">
                    <label>Sistema:</label>
                    <input type="text" name="tipo" value="<?php echo $servicios['tipo']; ?>"  class="form-control">
                 </div>
                 <div class="form-group col-md-2">
                    <label>Causa Nro:</label>
                    <input type="text" name="causa" value="<?php echo $servicios['causa']; ?>" class="form-control">
                 </div>
                 <div class="form-group col-md-2">
                    <label>Año:</label>
                    <input type="text" name="ano" value="<?php echo $servicios['ano']; ?>" class="form-control">
                 </div>
                 <div class="form-group col-md-8">
                    <label>Caratula:</label>
                    <input type="text" name="caratula" value="<?php echo $servicios['caratula']; ?>" class="form-control">
                 </div>

                 <!--este codigo es para ocultar el div si es que esta el campo vacio-->
                 <?php
                 $relacion = $servicios['relacion'];
                 if ($relacion != '') { ?>
                   <div class="form-group col-md-6">
                      <label>Relacion a:</label>
                      <input type="text" name="relacion" value="<?php echo $servicios['relacion']; ?>" class="form-control">
                   </div>
                 <?php  } ?>


                 <div class="form-group col-md-6">
                    <label>Juzgado a Transferir:</label>
                    <?php
                    $juzgadoid = $servicios['juzgado'];
                    $sql = "SELECT * FROM juzgadodetransferencia  WHERE id = " . $juzgadoid;
                    $query = $connection->prepare($sql);
                    $query->execute();
                    $total = $query->rowCount();
                    if($total > 0) {
                           $juzgados = $query->fetchAll()[0];
                     ?>
                    <input type="text" name="juzgado" value="<?php echo $juzgados['despachos']; ?>" class="form-control">
                    <?php } ?>
                 </div>
                 <div class="form-group col-md-12">
                    <label>Observaciones:</label>
                    <input type="text" name="obstran" value="<?php echo $servicios['obstran']; ?>" required class="form-control">
                 </div>
                 <div class="form-group col-md-12">
                      <hr/>
                 </div>
                 <div class="tipo form-group col-md-12">
                   <a>Funcionario de Informatica recepcionante de la Solicitud</a>
                 </div>
                 <div class="form-group col-md-6">
                    <label>Procesado por:</label>
                    <input type="text" name="procesado" value="<?php echo $_SESSION['usuario']; ?> <?php echo $_SESSION['apellido']; ?>" required class="form-control">
                 </div>
                 <div class="form-group col-md-2">
                    <label>Cedula:</label>
                    <input type="text" name="cedulaprocesado" value="<?php echo $_SESSION['cedula']; ?>" required class="form-control">
                 </div>
                 <div class="form-group col-md-4">
                    <label>Fecha:</label>
                    <input type="date" name="fechaprocesado" step="1" min="2019-01-01" max="2050-12-31" value="<?php echo date("Y-m-d");?>" class="form-control">
                 </div>
                 <div class="form-group col-md-12">
                    <label>Observaciones:</label>
                    <input type="text" name="obsgeneral" required class="form-control">
                 </div>
                 <div class="form-group col-md-3">
                    <label>Firma:</label>
                    <input type="password" name="firmaprocesado" required class="form-control">
                 </div>
                <div class="col-md-2">
                        <br>
                        <input type="hidden" name="id"  value="<?php echo $servicios['id']; ?>">
                       <button type="submit" name="actualizar" value="actualizar" class="btn btn-primary">Finalizar</button>
                </div>
            </form>
            <?php } else {  ?>
              <!--<a href="index.php" class="btn btn-warning">El servico fue procesado, volver al Inicio</a>-->
              <div class="container">
                <div class="alert alert-success form-group col-md-12">
                  <strong>¡Bien hecho!</strong> Procesado Correctamente!!
                  <a href="index2.php" class="alert-link">Volver al Inicio</a>
                </div>
              </div>

            <?php } ?>
        </div>
      </div>
    </section>
  </div>

  <!-- FOOTER -->

</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>
</body>
</html>
