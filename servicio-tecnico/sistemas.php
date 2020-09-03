<?php
@session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" type="text/css" href="../servicio-tecnico/css/estilo.css">
  <title>SISTEMAS</title>
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
   <?php include 'mensajes.php';?>
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
             $cedula = $_POST['cedula'];
             $tipo = $_POST['tipo'];
             $causa = $_POST['causa'];
             $ano =$_POST['ano'];
             $caratula = $_POST['caratula'];
             $relacion = $_POST['relacion'];
             $juzgado = $_POST['juzgado'];
             $obstran = $_POST['obstran'];
             if ($_POST['firmasolisitante'] == $_SESSION['password']) {

             //Definir una variable con la consulta SQL.
             $sql = 'INSERT INTO transferencias (nombreapellido, cargo, dependencia, interno, cedula, visible, tipo, causa, ano, caratula, relacion,
             juzgado, obstran, fecha_add)
             VALUES (:nombreapellido, :cargo, :dependencia, :interno, :cedula, 1, :tipo, :causa, :ano, :caratula, :relacion, :juzgado, :obstran, NOW())';

             //Definiendo una variable $data con los valores a guardase en la consulta sql
             $data = array(
                 'nombreapellido' => $nombreapellido,
                 'cargo' => $cargo,
                 'dependencia' => $dependencia,
                 'interno' => $interno,
                 'cedula' => $cedula,
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
                      echo '<script> window.location = "mensajeprocesado.php"; </script>';


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
    <section class="lines-effect">
      <div class="title">
      <h2>
        SOLICITUD DE SISTEMAS
      </h2>
      </div>
      <div class="solicitante form-group col-md-12">
        <div class="ini">
          <a href="index.php" class="ini fa fa-home"> Inicio</a>
          <a href="javascript: history.go(-1)" class="ini fa fa-undo "> Atras</a>
        </div>
      </div>
    </section>
    <section class="content container-fluid">

          <?php if($total > 0) {
                 $funcionarios = $query->fetchAll()[0];
                // var_dump($usuario);
              ?>
            <form action="transferencias.php" name="form" method="POST">
              <table class="tablenombre">
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
                      <label>Cedula:</label>
                      <input type="text" name="cedula" value="<?php echo $funcionarios['cedula']; ?>" readonly="readonly" class="form-control input-lg">
                  </div>
                </td>
              </table>
              <br>
              <table class="tablenombre">
                <tr>
                  <th>Datos de la Solicitud</th>
                </tr>
                <td>
                  <div id="content" class="solicitante form-group col-md-4">
                        <label>Sistemas:</label>
                        <select id="sistemas" name="sistemas" class="form-control input-lg">
                            <option value=""  >SELECCIONE UNA OPCION</option>
                            <option value="a1">CREACION DE USUARIOS</option>
                            <option value="a2">CAMBIO/RESETEO DE CLAVE</option>
                            <option value="a3">DESHABILITACION DE USUARIO</option>
                            <option value="a4">INSTALACION DE SISTEMA</option>
                            <option value="a5">ACTUALIZACION DE SISTEMA</option>
                            <option value="a6">OTROS</option>
                        </select>
                   </div>
                   <div class="DivPai col-md-4">
                     <div class="DivPai a1 a2 a3 a4 a5 solicitante form-group col-md-12">
                          <label>Sistema:</label>
                          <select name="sistema" class="form-control input-lg">
                              <option value=""  >Seleccione Una Opcion</option>
                              <?php
                                 include '../conexion/conexion2.php';
                                 $consulta="SELECT * FROM sistema";
                                 $ejecutar=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
                               ?>
                              <?php foreach ($ejecutar as $opciones):?>
                                <option value="<?php echo $opciones['nombre']?> "><?php echo $opciones['nombre']?> </option>
                              <?php endforeach ?>
                          </select>
                      </div>
                     </div>
                     <div class="solicitante form-group col-md-6">
                      <label>Solicitar por:</label>
                        <select name="solicitado" class="form-control input-lg">
                          <option value="Funcionario Disponible"  >Funcionario Disponible</option>
                          <?php
                             include '../conexion/conexion2.php';
                             $consulta="SELECT * FROM usuarios";
                             $ejecutar=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
                           ?>
                          <?php foreach ($ejecutar as $opciones):?>
                            <option value="<?php echo $opciones['nombre']?> <?php echo $opciones['apellido']?>"><?php echo $opciones['nombre']?> <?php echo $opciones['apellido']?></option>
                          <?php endforeach ?>
                        </select>
                      </div>


             <div class="solicitante form-group col-md-12">
                 <label>Observacion:</label>
                 <input type="text" name="obstran"  class="form-control input-lg">
             </div>
             <div class="form-group col-md-3">
                <label>Firma con tu Calve:</label>
                <input type="password" name="firmasolisitante" required class="form-control">
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
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
	integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</body>
</body>
</html>
<script type="text/javascript">
$(document).ready(function() {
    //Select para mostrar e esconder divs
    $('#sistemas').on('change',function(){
        var SelectValue='.'+$(this).val();
        $('.DivPai div').hide();
        $(SelectValue).toggle();
    });
});
</script>
