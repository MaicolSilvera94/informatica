<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" type="text/css" href="css/estilo.css">
  <!--<link rel="stylesheet" href="../administradores/dist/css/estilos.css">-->
  <title>Tipo de Solicitud</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">




</head>
<body class="">
<div class="wrapper">

  <!-- HEADER -->

  <?php require '../conexion/conexion.php';?>
  <?php

        //Obtener el registro del usuario
        $total = 0;
        if(isset($_GET['id'])){

            if($_GET['id'] > 0){

                $sql = "SELECT * FROM funcionarios WHERE id = " . $_GET['id'];
                $query = $connection->prepare($sql);
                $query->execute();
                $total = $query->rowCount();

            }

        }


        //Actualizar datos del usuario

   ?>
   <?php include 'mensajes.php';?>
   <?php
     //Validad si existe un post
     if( isset($_POST) ){
         //Si existe un POST, validar que los campos cumplan con los requisitos

         if($_POST['guardar'] == 'guardar' && $_POST['nombreapellido'] != ''  ){



             //Preparar variables segun los post recibidos
             //mediante el post resive los datos ingresados y guardan en $nombre
             $nombreapellido = $_POST['nombreapellido'];
             $cargo =$_POST['cargo'];
             $dependencia = $_POST['dependencia'];
             $interno = $_POST['interno'];
             $sistemas = $_POST['sistemas'];
             $equipos = $_POST['equipos'];
             $redes = $_POST['redes'];
             $obsgeneral = $_POST['obsgeneral'];
             $solicitado = $_POST['solicitado'];

             //Definir una variable con la consulta SQL.
             $sql = 'INSERT INTO servicios (nombreapellido, cargo, dependencia, interno,  fecha_add, sistemas, equipos, redes, visible, obsgeneral, solicitado)
             VALUES (:nombreapellido, :cargo, :dependencia, :interno, NOW(), :sistemas, :equipos, :redes, 1, :obsgeneral, :solicitado)';

             //Definiendo una variable $data con los valores a guardase en la consulta sql
             $data = array(
                 'nombreapellido' => $nombreapellido,
                 'cargo' => $cargo,
                 'dependencia' => $dependencia,
                 'interno' => $interno,
                 'sistemas' => $sistemas,
                 'equipos' => $equipos,
                 'redes' => $redes,
                 'obsgeneral' => $obsgeneral,
                 'solicitado' => $solicitado

             );

            //Prepamos la conexion
            $query = $connection->prepare($sql);

             //Definimos un try catch para que devuelta un estado
             try{
                  //Si sale bien se guarda los reigstros
                  if( $query->execute($data) ){

                      //mensaje verda
                      //$mensaje = '<p class="alert alert-success">Su solicitud fue Procesado</p>';
                      echo '<script> window.location = "mensajeprocesado.php"; </script>';


                  } else {
                      //mesnaje falso
                     $mensaje = '<p class="alert alert-danger">Firma Incorrecta!</p>';
                  }

             } catch (PDOException $e) {
                 //si sale mal devuelve el error con el motivo
                 print_r($e);

                 $mensaje = '<p class="alert alert-danger">'. $e .'</p>';

             }
         }
     }
   ?>

  <div class="container">
    <section class="content-header">
      <h1>
        Tipo de Solicitud
      </h1>
      <div class="solicitante form-group col-md-12">
        <a href="index.php"><i class="inicio fa fa-home"></i> Inicio</a>
      </div>

    </section>
    <section class="content container-fluid">

          <?php if($total > 0) {
                 $funcionarios = $query->fetchAll()[0];
                // var_dump($usuario);
              ?>
            <form action="tipo_solicitud.php" name="form" method="POST">
              <table class="tablenombre">
                <tr>
                  <th>Datos de Funcionario</th>
                </tr>
                <td>
                  <div class="solicitante form-group col-md-4">
                      <label>Funcionario Solicitante:</label>
                      <input type="text" name="nombreapellido" value="<?php echo $funcionarios['nombre']; ?>" required readonly="readonly" class="form-control input-lg">
                  </div>
                  <div class="solicitante form-group col-md-4">
                      <label>Cargo:</label>
                      <input type="text" name="cargo" value="<?php echo $funcionarios['cargo']; ?>" required readonly="readonly" class="form-control input-lg">
                  </div>
                  <div class="solicitante form-group col-md-4">
                      <label>Dependencia:</label>
                      <input type="text" name="dependencia" value="<?php echo $funcionarios['dependencia']; ?>" required readonly="readonly" class="form-control input-lg">
                  </div>
                  <div class="divmostrar col-md-4">
                      <label>Interno:</label>
                      <input type="text" name="interno" value="<?php echo $funcionarios['interno']; ?>" readonly="readonly" class="form-control input-lg">
                  </div>
                </td>
              </table>
              <div class="alert alert-info form-group col-md-12">
              	<strong>¡Avido!</strong> SELECCIONE UNA DE LAS OPCIONES DEACURDO A LA SOLICITUD QUE QUIERAS REALIZAR!!
            	</div>
              <table class="tablenombre">
                <tr>
                  <th>Datos de Servicios Informaticos</th>
                </tr>
                <td>
              <div class="solicitante form-group col-md-4">
                  <label>Sistemas:</label>
                 <select name="sistemas" class="form-control input-lg">
                     <option value=""  >Seleccione Una Opcion</option>
                     <option value="Creacion de Usuario"  >Creacion de Usuario</option>
                     <option value="Cambio/Reseteo de Contraseña"  >Cambio/Reseteo de Contraseña</option>
                     <option value="Deshabilitacion de Usuario"  >Deshabilitacion de Usuario</option>
                     <option value="Instalación de Sistema"  >Instalación de Sistema</option>
                     <option value="Actualizacion de Sistema"  >Actualizacion de Sistema</option>
                 </select>
             </div>
             <div class="solicitante form-group col-md-4">
                <label>Equipos:</label>
                <select name="equipos" class="form-control input-lg" >
                    <option value=""  >Seleccione Una Opcion</option>
                    <option value="Montaje"  >Montaje</option>
                    <option value="Configuracion"  >Configuracion</option>
                    <option value="Verificacion"  >Verificacion</option>
                    <option value="Instalación de Software"  >Instalación de Software</option>
                    <option value="Mantenimeito"  >Mantenimieto</option>
                </select>
             </div>
             <div class="solicitante form-group col-md-4">
                <label>Redes:</label>
                <select name="redes" class="form-control input-lg" >
                    <option value=""  >Seleccione Una Opcion</option>
                    <option value="Creacion de Usuarios"  >Creacion de Usuarios</option>
                    <option value="Cambio/Reseteo de Contraseña"  >Cambio/Reseteo de Contraseña</option>
                    <option value="Deshabilitacion de Usuario"  >Deshabilitacion de Usuario</option>
                    <option value="Configuracion de Red"  >Configuracion de Red</option>
                    <option value="Compartir recursos de Red"  >Compartir recursos de Red</option>
                </select>
             </div>
             <div class="solicitante form-group col-md-6">
              <label>Solicitar por:</label>
                <select name="solicitado" class="form-control input-lg">
                  <option value=""  >Funcionario Disponible</option>
                  <?php
                    include 'conexion.php';
                    $consulta="SELECT * FROM usuarios";
                    $ejecutar=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
                   ?>
                  <?php foreach ($ejecutar as $opciones):?>
                    <option value="<?php echo $opciones['nombre']?> <?php echo $opciones['apellido']?>"><?php echo $opciones['nombre']?> <?php echo $opciones['apellido']?></option>
                  <?php endforeach ?>
                </select>
              </div>

             <div class="solicitante form-group col-md-6">
                 <label>Observacion:</label>
                 <input type="text" name="obsgeneral"  class="form-control input-lg">
             </div>
             <div class="col-md-2">
                    <button type="submit" name="guardar" value="guardar" class="btn btn-success btntable">FINALIZAR SOLICITUD</button>
             </div>
           </td>
         </table>
         <div class="alert alert-info form-group col-md-12">
           <strong>¡Avido!</strong> PARA SOLICITAR TRANSFERENCIAS DE EXPEDINETES DEBERAS TENER UNA CLAVE!!
         </div>
         <table class="tablenombre">
           <tr>
             <th>Transferencias de Expedientes</th>
           </tr>
           <td>
             <div class="col-md-6">
                    <a class="btn btn-primary btntable" href="transferencias.php?id=<?php echo $funcionarios['id'] ?>">Transferencias de Expedientes</a>
             </div>
           </td>
         </table>

            </form>
          <?php }  ?>




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
<script type="text/javascript" src="ocultar-mostrar.js"></script>
<script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>

</body>
</html>
