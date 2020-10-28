<?php
session_start()
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
                $sql = "SELECT * FROM servicios WHERE id = " . $_GET['id'];
                $query = $connection->prepare($sql);
                $query->execute();
                $total = $query->rowCount();

            }

        }
        //Actualizar datos del usuario

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
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Inicio</a></li>
      </ol>
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
                    <input type="text" name="nombreapellido" value="<?php echo $servicios['nombreapellido']; ?>" readonly="readonly" class="form-control">
                </div>

                 <div class="form-group col-md-12">
                    <label>Cargo o Funcion:</label>
                    <input type="text" name="cargo" value="<?php echo $servicios['cargo']; ?>" readonly="readonly" class="form-control">
                </div>

                <div class="form-group col-md-12">
                   <label>Dependencia:</label>
                   <input type="text" name="dependencia" value="<?php echo $servicios['dependencia']; ?>" readonly="readonly" class="form-control">
               </div>
               <div class="form-group col-md-4">
                  <label>Interno:</label>
                  <input type="text" name="interno" value="<?php echo $servicios['interno']; ?>" readonly="readonly" class="form-control">
                </div>
                <div class="form-group col-md-4">
                   <label>Fecha y Hora:</label>
                   <input type="text" name="fecha_add"  value="<?php echo $servicios['fecha_add']; ?>" readonly="readonly" class="form-control">
                 </div>
                  <div class="form-group col-md-12">
                       <hr/>
                  </div>
                  <div class="tipo form-group col-md-12">
                    <a>TIPO DE SOLICITUD</a>
                  </div>
                  <?php
                  $sistemas = $servicios['sistemas'];
                  if ($sistemas != '') { ?>
                  <div class="solicitante form-group col-md-12">
                     <a>Sistemas</a>
                     <select name="sistemas" class="form-control" readonly="readonly">
                         <option value=""  >Seleccione Una Opcion</option>

                         <?php

                            include '../conexion/conexion2.php';
                            $nombre = $servicios['sistemas'];
                            $consulta="SELECT * FROM sistemas WHERE nombre = '$nombre' ";
                            $ejecutar=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
                          ?>
                         <?php foreach ($ejecutar as $opciones):?>
                         <option value="CREACION DE USUARIOS"  <?php if($opciones['nombre'] == "CREACION DE USUARIOS"){ echo 'selected'; } ?> >CREACION DE USUARIOS</option>
                         <option value="CAMBIO/RESETEO DE CLAVE"  <?php if($opciones['nombre'] == "CAMBIO/RESETEO DE CLAVE"){ echo 'selected'; } ?>>CAMBIO/RESETEO DE CLAVE</option>
                         <option value="DESHABILITACION DE USUARIO"  <?php if($opciones['nombre'] == "DESHABILITACION DE USUARIO"){ echo 'selected'; } ?>>DESHABILITACION DE USUARIO</option>
                         <option value="INSTALACION DE SISTEMA"  <?php if($opciones['nombre'] == "INSTALACION DE SISTEMA"){ echo 'selected'; } ?>>INSTALACION DE SISTEMA</option>
                         <option value="ACTUALIZACION DE SISTEMA"  <?php if($opciones['nombre'] == "ACTUALIZACION DE SISTEMA"){ echo 'selected'; } ?>>ACTUALIZACION DE SISTEMA</option>
                         <option value="OTROS"  <?php if($opciones['nombre'] == "OTROS"){ echo 'selected'; } ?>>OTROS</option>
                         <?php endforeach ?>
                     </select>
                 </div>
                 <div class="form-group col-md-12">
                    <label>Sistema:</label>
                    <input type="text" name="sistema" value="<?php echo $servicios['sistema']; ?>" readonly="readonly"  class="form-control">
                 </div>
                 <div class="form-group col-md-12">
                    <label>Observaciones:</label>
                    <input type="text" name="obssistema" value="<?php echo $servicios['obssistema']; ?> <?php  echo $servicios['causa']; ?> <?php  echo $servicios['ano']; ?> <?php  echo $servicios['caratula']; ?> <?php  echo $servicios['relacion']; ?>" readonly="readonly" class="form-control">
                 </div>
                 <?php  } ?>
                 <?php
                 $equipos = $servicios['equipos'];
                 if ($equipos != '') { ?>
                 <div class="solicitante form-group col-md-12">
                    <a>Equipos</a>
                    <select name="equipos" class="form-control" readonly="readonly">
                        <option value=""  >Seleccione Una Opcion</option>
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

                    </select>
                 </div>
                 <div class="form-group col-md-12">
                    <label>Datos del Equipo:</label>
                    <input type="text" name="datosequipos" value="<?php echo $servicios['datosequipos']; ?>" readonly="readonly" class="form-control">
                 </div>
                 <div class="form-group col-md-12">
                    <label>Observaciones:</label>
                    <input type="text" name="obsequipos" value="<?php echo $servicios['obsequipos']; ?>" readonly="readonly" class="form-control">
                 </div>
                 <?php  } ?>
                 <?php
                 $redes = $servicios['redes'];
                 if ($redes != '') { ?>
                 <div class="solicitante form-group col-md-12">
                    <a>Redes</a>
                    <select name="redes" class="form-control" readonly="readonly">
                        <option value=""  >Seleccione Una Opcion</option>

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
                    </select>
                 </div>
                 <div class="form-group col-md-12">
                    <label>Observaciones:</label>
                    <input type="text" name="obsredes" value="<?php echo $servicios['obsredes']; ?>" readonly="readonly" class="form-control">
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
                    <input type="text" name="procesado" value="<?php echo $servicios['procesado']; ?>" readonly="readonly" class="form-control">
                 </div>
                 <div class="form-group col-md-2">
                    <label>Cedula:</label>
                    <input type="text" name="cedulaprocesado" value="<?php echo $servicios['cedulaprocesado']; ?>" readonly="readonly" class="form-control">
                 </div>
                 <div class="form-group col-md-4">
                    <label>Fecha:</label>
                    <input type="text" name="fechaprocesado" value="<?php echo $servicios['fechaprocesado']; ?>" readonly="readonly" class="form-control">
                 </div>
                 <div class="form-group col-md-12">
                    <label>Observaciones:</label>
                    <input type="text" name="obsgeneral" value="<?php echo $servicios['obsgeneral']; ?>" readonly="readonly" class="form-control">
                 </div>
                 <?php
                 if ($servicios['conformidad'] == 1) { ?>
                   <div class="form-group col-md-12">
                      <label>Confirmado por:</label>
                      <input type="text" value="<?php echo 'PENDIENTE DE CONFORMIDAD'; ?>" readonly="readonly" class="form-control">
                   </div>
                 <?php  } else { ?>
                  <div class="form-group col-md-6">
                    <label>Confirmado por:</label>
                    <input type="text" value="<?php echo $servicios['nombreapellido']; ?>" readonly="readonly" class="form-control">
                 </div>
                 <div class="form-group col-md-6">
                    <label>Calificacion del Servicio:</label>
                    <input type="text" value="<?php echo $servicios['calificacion']; ?>" readonly="readonly" class="form-control">
                 </div>
                 <?php  } ?>
            </form>
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
