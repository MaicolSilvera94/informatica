<?php
@session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" type="text/css" href="../servicio-tecnico/css/estilo.css">
  <title>Transferencia de Expedientes</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
</head>
<body class="">
<div class="wrapper">
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
   <?php include '../servicio-tecnico/mensajes.php';?>
   <?php
     //Validad si existe un post
     if( isset($_POST) ){
         //Si existe un POST, validar que los campos cumplan con los requisitos

         if($_POST['guardar'] == 'guardar' &&  $_POST['nombreapellido'] != '' ){



             //Preparar variables segun los post recibidos
             //mediante el post resive los datos ingresados y guardan en $nombre
             $nombreapellido = $_POST['nombreapellido'];
             $cargo =$_POST['cargo'];
             $dependencia = $_POST['dependencia'];
             $interno = $_POST['interno'];
             $tipo = $_POST['tipo'];
             $causa = $_POST['causa'];
             $ano =$_POST['ano'];
             $caratula = $_POST['caratula'];
             $relacion = $_POST['relacion'];
             $juzgado = $_POST['juzgado'];
             $obstran = $_POST['obstran'];
             $firmaprocesado = $_POST['firmaprocesado'];
             if ($firmaprocesado == $_SESSION['password'] &&  $_POST['activo'] == 1) {

             //Definir una variable con la consulta SQL.
             $sql = 'INSERT INTO transferencias (nombreapellido, cargo, dependencia, interno, visible, tipo, causa, ano, caratula, relacion,
             juzgado, obstran, fecha_add)
             VALUES (:nombreapellido, :cargo, :dependencia, :interno, 1, :tipo, :causa, :ano, :caratula, :relacion, :juzgado, :obstran, NOW())';

             //Definiendo una variable $data con los valores a guardase en la consulta sql
             $data = array(
                 'nombreapellido' => $nombreapellido,
                 'cargo' => $cargo,
                 'dependencia' => $dependencia,
                 'interno' => $interno,
                 'tipo' => $tipo,
                 'causa' => $causa,
                 'ano' => $ano,
                 'caratula' => $caratula,
                 'relacion' => $relacion,
                 'juzgado' => $juzgado,
                 'obstran'   => $obstran
             );

            //Prepamos la conexion
            $query = $connection->prepare($sql);

             //Definimos un try catch para que devuelta un estado
             try{
                  //Si sale bien se guarda los reigstros
                  if( $query->execute($data) ){

                      //mensaje verda
                      //$mensaje = '<p class="alert alert-success">Su solicitud fue Procesado</p>';
                      echo '<script> window.location = "index.php"; </script>';


                  } else {
                      //mesnaje falso
                     $mensaje = '<p class="alert alert-danger">Algo salio mal</p>';
                  }

             } catch (PDOException $e) {
                 //si sale mal devuelve el error con el motivo
                 print_r($e);

                 $mensaje = '<p class="alert alert-danger">'. $e .'</p>';

             }
            } else {
               echo '<script> window.location = "mensajenoprocesado.php"</script>';
            }
          }
        }
   ?>

  <div class="container">
    <section class="content-header">
      <h1>
        Transferencias de Expedientes
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
            <form action="transferencias.php" name="form" method="POST">
              <table class="tabletran">
                <tr>
                  <th>Datos de Funcionario</th>
                </tr>
                <td>
                  <div class="solicitante form-group col-md-4">
                      <label>Funcionario Solicitante:</label>
                      <input type="nombre" name="nombreapellido" value="<?php echo $funcionarios['nombre']; ?>" readonly="readonly" required  class="form-control input-lg">
                  </div>
                  <div class="solicitante form-group col-md-4">
                      <label>Cargo:</label>
                      <input type="text"  name="cargo" value="<?php echo $funcionarios['cargo']; ?>" readonly="readonly" required  class="form-control input-lg">
                  </div>
                  <div class="solicitante form-group col-md-4">
                      <label>Dependencia:</label>
                      <input type="text"  name="dependencia" value="<?php echo $funcionarios['dependencia']; ?>" readonly="readonly" required  class="form-control input-lg">
                  </div>
                  <div class="divmostrar col-md-4">
                      <label>Interno:</label>
                      <input type="text" name="interno" value="<?php echo $funcionarios['interno']; ?>" readonly="readonly" class="form-control input-lg">
                  </div>
                  <div class="divmostrar col-md-4">
                      <label>Password:</label>
                      <input type="text"  name="password" value="<?php echo $funcionarios['password']; ?>" readonly="readonly"  class="form-control input-lg">
                  </div>
                  <div class="divmostrar col-md-4">
                      <label>Mostrar:</label>
                      <input type="text"  name="activo" value="<?php echo $funcionarios['activo']; ?>" readonly="readonly" class="form-control input-lg">
                  </div>
                </td>
              </table>
              <br>
              <table class="tabletran">
                <tr>
                  <th>Datos de la Transferencia</th>
                </tr>
                <td>
              <div class="solicitante form-group col-md-6">
                  <label>Tipo de Transferencia:</label>
                 <select name="tipo" class="form-control input-lg">
                     <option value=""  >Seleccione Una Opcion</option>
                     <option value="Transferir a otro Despacho"  >Transferir a otro Despacho</option>
                     <option value="No figura en mi Despacho"  >No figura en mi Despacho</option>
                 </select>
             </div>

             <div class="solicitante form-group col-md-3">
                 <label>N° de Causa:</label>
                 <input type="text" name="causa" value="" required class="form-control input-lg">
             </div>
             <div class="solicitante form-group col-md-3">
                 <label>Año:</label>
                 <input type="text" name="ano" value="" required class="form-control input-lg">
             </div>
             <div class="solicitante form-group col-md-12">
                 <label>Caratula:</label>
                 <input type="text" name="caratula" value="" required class="form-control input-lg">
             </div>
             <div class="solicitante form-group col-md-6">
                 <label>En Relacion a:</label>
                 <input type="text" name="relacion" value="" required class="form-control input-lg">
             </div>
             <!--<div class="solicitante form-group col-md-6">
                 <label>Juzgado a Transferir:</label>
                 <input type="text" name="juzgado" required class="form-control input-lg">
             </div>-->

             <div class="solicitante form-group col-md-6">
              <label>Juzgado a Transferir:</label>
                <select name="juzgado" class="form-control input-lg">
                  <option value=""  >Seleccione Una Opcion</option>
                  <?php
                    include '../conexion/conexion2.php';
                    $entidad = $funcionarios['entidad'];
                    $consulta="SELECT * FROM juzgados WHERE entidad = '$entidad' " ;
                    $ejecutar=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
                   ?>
                  <?php foreach ($ejecutar as $opciones):?>
                    <option value="<?php echo $opciones['nombre']?>"><?php echo $opciones['nombre']?></option>
                  <?php endforeach ?>
                </select>
              </div>

             <div class="solicitante form-group col-md-12">
                 <label>Observacion:</label>
                 <input type="text" name="obstran"  class="form-control input-lg">
             </div>
             <div class="form-group col-md-3">
                <label>Firma:</label>
                <input type="password" name="firmaprocesado" required class="form-control">
             </div>
                <div class="col-md-3">
                        <br>
                       <button type="submit" name="guardar" value="guardar" class="btn btn-success ">FINALIZAR SOLICITUD</button>
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
