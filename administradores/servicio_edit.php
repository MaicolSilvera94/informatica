<?php
session_start();
if(isset($_SESSION['logueado'])){
  if($_SESSION["rol"] == 1){   
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php include '../includes/head.php'; ?>
  <title>Solicitud de Servicios Informaticos</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
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
                $sql = "SELECT * FROM servicios WHERE id = " . $_GET['id'];
                $query = $connection->prepare($sql);
                $query->execute();
                $total = $query->rowCount();

            }

        }
        //Actualizar datos del usuario
       if(isset($_POST)){
            if($_POST['actualizar'] == 'actualizar' && $_POST['nombreapellido'] != '' && $_POST['id'] > 0){
              $firmaprocesado = $_POST['firmaprocesado'];
              if ($_POST['sistemas'] != '' and $_POST['equipos'] == '' and $_POST['redes'] == '') { 
                if ($firmaprocesado == $_SESSION['password']) {
                     $sql = "UPDATE servicios set nombreapellido = :nombreapellido, cargo = :cargo, interno = :interno,
                     fecha_add = :fecha_add, sistemas = :sistemas, sistema = :sistema, obssistema = :obssistema, procesado = :procesado,
                     fechaprocesado=NOW(), obsgeneral = :obsgeneral, firmaprocesado = :firmaprocesado,  visible = 0, conformidad = 1, 
                     cedulaprocesado = :cedulaprocesado, equipos = null, obsequipos = null, redes = null, obsredes = null  WHERE id = " . $_POST['id'];
                     $data =  array(
                          'nombreapellido' => $_POST['nombreapellido'],
                          'cargo' => $_POST['cargo'],
                          'interno' => $_POST['interno'],
                          'fecha_add' => $_POST['fecha_add'],
                          'sistemas' => $_POST['sistemas'],
                          'sistema' => $_POST['sistema'],
                          'obssistema' => $_POST['obssistema'],
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
              }//FIN DE SISTEMAS NULO
              if ($_POST['equipos'] != '' and $_POST['sistemas'] == '' and $_POST['redes'] == '') {
                if ($firmaprocesado == $_SESSION['password']) {
                     $sql = "UPDATE servicios set nombreapellido = :nombreapellido, cargo = :cargo, interno = :interno,
                     fecha_add = :fecha_add, equipos = :equipos, datosequipos = :datosequipos, obsequipos = :obsequipos, procesado = :procesado,
                     fechaprocesado=NOW(), obsgeneral = :obsgeneral, firmaprocesado = :firmaprocesado,  visible = 0, conformidad = 1, 
                     cedulaprocesado = :cedulaprocesado, sistemas = null, sistema = null, obssistema = null, redes = null, obsredes = null  WHERE id = " . $_POST['id'];
                     $data =  array(
                          'nombreapellido' => $_POST['nombreapellido'],
                          'cargo' => $_POST['cargo'],
                          'interno' => $_POST['interno'],
                          'fecha_add' => $_POST['fecha_add'],
                          'equipos' => $_POST['equipos'],
                          'datosequipos' => $_POST['datosequipos'],
                          'obsequipos' => $_POST['obsequipos'],
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
              } //FIN DE equipos NULO
              if ($_POST['redes'] != '' and $_POST['equipos'] == '' and $_POST['sistemas'] == '') {
                if ($firmaprocesado == $_SESSION['password']) {
                     $sql = "UPDATE servicios set nombreapellido = :nombreapellido, cargo = :cargo, interno = :interno,
                     fecha_add = :fecha_add, redes = :redes, obsredes = :obsredes, procesado = :procesado, fechaprocesado=NOW(), obsgeneral = :obsgeneral, 
                     firmaprocesado = :firmaprocesado,  visible = 0, conformidad = 1, cedulaprocesado = :cedulaprocesado, sistemas = null,
                     sistema = null, obssistema = null, equipos = null, obsequipos = null  WHERE id = " . $_POST['id'];
                     $data =  array(
                          'nombreapellido' => $_POST['nombreapellido'],
                          'cargo' => $_POST['cargo'],
                          'interno' => $_POST['interno'],
                          'fecha_add' => $_POST['fecha_add'],
                          'redes' => $_POST['redes'],
                          'obsredes' => $_POST['obsredes'],
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
              if (($_POST['redes'] != '' and $_POST['equipos'] == '' and $_POST['sistemas'] == '') or ($_POST['redes'] == '' and $_POST['equipos'] != '' and $_POST['sistemas'] == '') or ($_POST['redes'] == '' and $_POST['equipos'] == '' and $_POST['sistemas'] != '')) {
                echo '<script> window.location = "index2.php"; </script>';
               } else {  
              ?>
                <script type="text/javascript">
                  alert ('POR EL MOMENTO NO SE PUEDE REALIZAR DOS SERVICIOS AL MISMO TIEMPO!! - VERIFICAR QUE ESTES REALIZANDO UN SOLO SERVICIO DE SISTEMAS EQUIPOS O REDES');
                </script>
              <?php
                echo '<script> window.location = "index2.php"; </script>';
              }  
            }
       }
   ?>
 <?php include 'includes/mensajes.php';?>

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
            <form action="servicio_edit.php" method="POST" name="form">
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
                     
                       <select name="sistemas" class="form-control">
                        <?php if($servicios['sistemas'] != '' ){ ?>
                            <option value=""  >SELECCIONE UNA OPCION</option>
                           <?php
                              include '../conexion/conexion2.php';
                              $idsistemas = $servicios['sistemas'];
                              $consulta="SELECT * FROM sistemas WHERE idsistemas = '$idsistemas' ";
                              $ejecutar=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
                            ?>
                           <?php foreach ($ejecutar as $opciones):?>
                           <option value="CREACION DE USUARIO"  <?php if($opciones['nombre'] == "CREACION DE USUARIO"){ echo 'selected'; } ?> >CREACION DE USUARIO</option>
                           <option value="CAMBIO/RESETEO DE CLAVE"  <?php if($opciones['nombre'] == "CAMBIO/RESETEO DE CLAVE"){ echo 'selected'; } ?>>CAMBIO/RESETEO DE CLAVE</option>
                           <option value="DESHABILITACION DE USUARIO"  <?php if($opciones['nombre'] == "DESHABILITACION DE USUARIO"){ echo 'selected'; } ?>>DESHABILITACION DE USUARIO</option>
                           <option value="INSTALACION DE SISTEMA"  <?php if($opciones['nombre'] == "INSTALACION DE SISTEMA"){ echo 'selected'; } ?>>INSTALACION DE SISTEMA</option>
                           <option value="ACTUALIZACION DE SISTEMA"  <?php if($opciones['nombre'] == "ACTUALIZACION DE SISTEMA"){ echo 'selected'; } ?>>ACTUALIZACION DE SISTEMA</option>
                           <option value="OTROS"  <?php if($opciones['nombre'] == "OTROS"){ echo 'selected'; } ?>>OTROS</option>
                           <?php endforeach ?>
                        <?php } else { ?>
                            <option value=""  >SELECCIONE UNA OPCION</option>
                            <option value="CREACION DE USUARIO"  >CREACION DE USUARIO</option>
                            <option value="CAMBIO/RESETEO DE CLAVE"  >CAMBIO/RESETEO DE CLAVE</option>
                            <option value="DESHABILITACION DE USUARIO"  >DESHABILITACION DE USUARIO</option>
                            <option value="INSTALACION DE SISTEMA"  >INSTALACION DE SISTEMA</option>
                            <option value="ACTUALIZACION DE SISTEMA"  >ACTUALIZACION DE SISTEMA</option>
                            <option value="OTROS"  >OTROS</option>
                        <?php } ?>       
                       </select>
                       
                 </div>
                 <div class="form-group col-md-12">
                    <label>Sistema:</label>
                    <input type="text" name="sistema" value="<?php echo $servicios['sistema']; ?>"  class="form-control">
                 </div>
                 <?php
                  if ($servicios['sistemas'] == '') { ?>
                 <div class="form-group col-md-12">
                    <label>Observaciones:</label>
                    <input type="text" name="obssistema" value="" class="form-control">
                 </div>
                 <?php  } else { ?>
                 <div class="form-group col-md-12">
                    <label>Observaciones:</label>
                    <input type="text" name="obssistema" value="<?php echo $servicios['obsgeneral']; ?><?php echo $servicios['obssistema']; ?> <?php  echo $servicios['causa']; ?> <?php  echo $servicios['ano']; ?> <?php  echo $servicios['caratula']; ?> <?php  echo $servicios['relacion']; ?>" class="form-control">
                 </div>
                 <?php  } ?>

                 <div class="solicitante form-group col-md-12">
                    <a>Equipos</a>
                    <select name="equipos" class="form-control" >
                      <?php if($servicios['equipos'] != '' ){ ?>
                        <option value=""  >SELECCIONE UNA OPCION</option>
                        <?php

                           include '../conexion/conexion2.php';
                           $nombre = $servicios['equipos'];
                           $consulta="SELECT * FROM equipos WHERE nombre = '$nombre' ";
                           $ejecutar=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
                         ?>
                        <?php foreach ($ejecutar as $opciones):?>
                        <option value="MONTAJE"  <?php if($opciones['nombre'] == "MONTAJE"){ echo 'selected'; } ?> >MONTAJE</option>
                        <option value="CONFIGURACION"  <?php if($opciones['nombre'] == "CONFIGURACION"){ echo 'selected'; } ?>>CONFIGURACION</option>
                        <option value="VERIFICACION"  <?php if($opciones['nombre'] == "VERIFICACION"){ echo 'selected'; } ?>>VERIFICACION</option>
                        <option value="INSTALACION DE SOFTWARE"  <?php if($opciones['nombre'] == "INSTALACION DE SOFTWARE"){ echo 'selected'; } ?>>INSTALACION DE SOFTWARE</option>
                        <option value="MANTENIMIENTO"  <?php if($opciones['nombre'] == "MANTENIMIENTO"){ echo 'selected'; } ?>>MANTENIMIENTO</option>
                        <option value="OTROS"  <?php if($opciones['nombre'] == "OTROS"){ echo 'selected'; } ?>>OTROS</option>
                        <?php endforeach ?>
                      <?php } else { ?>
                        <option value=""  >SELECCIONE UNA OPCION</option>
                         <?php
                            include '../conexion/conexion2.php';
                            $consulta="SELECT * FROM equipos";
                            $ejecutar=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
                          ?>
                         <?php foreach ($ejecutar as $opciones):?>
                           <option value="<?php echo $opciones['nombre']?> "><?php echo $opciones['nombre']?></option>
                         <?php endforeach ?>       
                        <?php  } ?>
                    </select>
                 </div>
                 <div class="form-group col-md-12">
                    <label>Datos del Equipo:</label>
                    <input type="text" name="datosequipos" value="<?php echo $servicios['datosequipos']; ?>" class="form-control">
                 </div>
                 <?php
                  if ($servicios['equipos'] == '') { ?>
                 <div class="form-group col-md-12">
                    <label>Observaciones:</label>
                    <input type="text" name="obsequipos" class="form-control">
                 </div>
                 <?php  } else { ?>
                 <div class="form-group col-md-12">
                    <label>Observaciones:</label>
                    <input type="text" name="obsequipos" value="<?php echo $servicios['obsgeneral']; ?> <?php echo $servicios['obsequipos']; ?>" class="form-control">
                 </div>
                 <?php  } ?>
                 <div class="solicitante form-group col-md-12">
                    <a>Redes</a>
                    <select name="redes" class="form-control" >
                      <?php if($servicios['redes'] != '' ){ ?>
                        <option value=""  >SELECCIONE UNA OPCION</option>
                        <?php

                           include '../conexion/conexion2.php';
                           $nombre = $servicios['redes'];
                           $consulta="SELECT * FROM redes WHERE nombre = '$nombre' ";
                           $ejecutar=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
                         ?>
                        <?php foreach ($ejecutar as $opciones):?>
                        <option value="CREACION DE USUARIO"  <?php if($opciones['nombre'] == "CREACION DE USUARIO"){ echo 'selected'; } ?> >CREACION DE USUARIO</option>
                        <option value="CAMBIO/RESETEO DE CLAVE"  <?php if($opciones['nombre'] == "CAMBIO/RESETEO DE CLAVE"){ echo 'selected'; } ?>>CAMBIO/RESETEO DE CLAVE</option>
                        <option value="DESHABILITACION DE USUARIO"  <?php if($opciones['nombre'] == "DESHABILITACION DE USUARIO"){ echo 'selected'; } ?>>DESHABILITACION DE USUARIO</option>
                        <option value="CONFIGURACION DE RED"  <?php if($opciones['nombre'] == "CONFIGURACION DE RED"){ echo 'selected'; } ?>>CONFIGURACION DE RED</option>
                        <option value="COMPARTIR RECURSOS DE RED"  <?php if($opciones['nombre'] == "COMPARTIR RECURSOS DE RED"){ echo 'selected'; } ?>>COMPARTIR RECURSOS DE RED</option>
                        <option value="OTROS"  <?php if($opciones['nombre'] == "OTROS"){ echo 'selected'; } ?>>OTROS</option>
                        <?php endforeach ?>
                      <?php } else { ?>
                        <option value=""  >SELECCIONE UNA OPCION</option>
                         <?php
                            include '../conexion/conexion2.php';
                            $consulta="SELECT * FROM redes";
                            $ejecutar=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
                          ?>
                         <?php foreach ($ejecutar as $opciones):?>
                           <option value="<?php echo $opciones['nombre']?> "><?php echo $opciones['nombre']?></option>
                         <?php endforeach ?>
                      <?php } ?>
                    </select>
                 </div>
                 <?php
                  if ($servicios['redes'] == '') { ?>
                 <div class="form-group col-md-12">
                    <label>Observaciones:</label>
                    <input type="text" name="obsredes" class="form-control">
                 </div>
                 <?php  } else { ?>
                  <div class="form-group col-md-12">
                    <label>Observaciones:</label>
                    <input type="text" name="obsredes" value="<?php echo $servicios['obsgeneral']; ?> <?php echo $servicios['obsredes']; ?>" class="form-control">
                 </div>
                 <?php  } ?>
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
