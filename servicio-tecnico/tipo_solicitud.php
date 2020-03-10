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
             $cedula = $_POST['cedula'];
             $sistemas = $_POST['sistemas'];
             $sistema = $_POST['sistema'];
             $equipos = $_POST['equipos'];
             $redes = $_POST['redes'];
             $obsgeneral = $_POST['obsgeneral'];
             $solicitado = $_POST['solicitado'];
             $solicitante = $_POST['firmasolisitante'];
             if ( $solicitante == $_POST['password']) {

             //Definir una variable con la consulta SQL.
             $sql = 'INSERT INTO servicios (nombreapellido, cargo, dependencia, interno, cedula, fecha_add, sistemas, sistema, equipos, redes, visible, obsgeneral, solicitado)
             VALUES (:nombreapellido, :cargo, :dependencia, :interno, :cedula, NOW(), :sistemas, :sistema, :equipos, :redes, 1, :obsgeneral, :solicitado)';

             //Definiendo una variable $data con los valores a guardase en la consulta sql
             $data = array(
                 'nombreapellido' => $nombreapellido,
                 'cargo' => $cargo,
                 'dependencia' => $dependencia,
                 'interno' => $interno,
                 'cedula' => $cedula,
                 'sistemas' => $sistemas,
                 'sistema' => $sistema,
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
                      echo '<script> window.location = "mensajeprocesado.php"; </script>';
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
        Tipo de Solicitud
      </h1>
      <div class="solicitante form-group col-md-12">
        <!--<a href="index.php"><i class="inicio fa fa-home"></i> Inicio</a>-->
        <div class="ini">
          <a href="index.php" class="ini fa fa-home"> Inicio</a>
        </div>
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
                  <div class="divmostrar col-md-4">
                      <label>Mostrar:</label>
                      <input type="text"  name="password" value="<?php echo $funcionarios['password']; ?>" readonly="readonly"  class="form-control input-lg">
                  </div>
                  <div class="divmostrar col-md-4">
                      <label>Cedula:</label>
                      <input type="text"  name="cedula" value="<?php echo $funcionarios['cedula']; ?>" readonly="readonly"  class="form-control input-lg">
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
                     <select id="sistemas" name="sistemas" class="form-control input-lg">
                         <option value=""  >Seleccione Una Opcion</option>
                         <option value="a1">Creacion de Usuario</option>
                         <option value="a2">Cambio/Reseteo de Contraseña</option>
                         <option value="a3">Deshabilitacion de Usuario</option>
                         <option value="a4">Instalación de Sistema</option>
                         <option value="a5">Actualizacion de Sistema</option>
                         <option value="a6">Otros</option>
                     </select>
                 </div>

                 <div class="solicitante form-group col-md-4">
                    <label>Equipos:</label>
                    <select name="equipos" class="form-control input-lg" >
                        <option value=""  >Seleccione Una Opcion</option>
                        <?php
                           include '../conexion/conexion2.php';
                           $consulta="SELECT * FROM equipos";
                           $ejecutar=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
                         ?>
                        <?php foreach ($ejecutar as $opciones):?>
                          <option value="<?php echo $opciones['nombre']?> "><?php echo $opciones['nombre']?></option>
                        <?php endforeach ?>
                    </select>
                 </div>
                 <div class="solicitante form-group col-md-4">
                    <label>Redes:</label>
                    <select name="redes" class="form-control input-lg" >
                        <option value=""  >Seleccione Una Opcion</option>
                        <?php
                           include '../conexion/conexion2.php';
                           $consulta="SELECT * FROM redes";
                           $ejecutar=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
                         ?>
                        <?php foreach ($ejecutar as $opciones):?>
                          <option value="<?php echo $opciones['nombre']?> "><?php echo $opciones['nombre']?></option>
                        <?php endforeach ?>
                    </select>
                  </div>

                <div class="DivPai">
                  <div class="a1 a2 a3 a4 a5 solicitante form-group col-md-12">
                       <label>Sistema:</label>
                       <select name="sistema" class="form-control input-lg" >
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
                 <div class="solicitante form-group col-md-6">
                     <label>Observacion:</label>
                     <input type="text" name="obsgeneral"  class="form-control input-lg">
                 </div>
                 <div class="form-group col-md-3">
                    <label>Firma:</label>
                    <input type="password" name="firmasolisitante" required class="form-control">
                 </div>
                 <div class="col-md-2">
                        <button type="submit" name="guardar" value="guardar" class="btn btn-success btnsolicitud">FINALIZAR SOLICITUD</button>
                 </div>
               </td>
             </table>
         <div class="alert alert-info form-group col-md-12">
           <strong>¡Avido!</strong> PARA SOLICITAR TRANSFERENCIAS DEBES DE ESTAR HABILITADO!
         </div>
         <table class="tablenombre">
           <tr>
             <th>Gestion de Expedientes</th>
           </tr>
           <td>
             <!--<div class="col-md-4">
                    <a class="btn btn-primary btntable" href="transferencias.php?id=<?//php echo $funcionarios['id'] ?>">Transferencias Penal</a>
                    <a class="btn btn-primary btntable" href="transferenciasnopenal.php?id=<?//php echo $funcionarios['id'] ?>">Transferencias no Penal</a>
                    <a class="btn btn-primary btntable" href="activacionexpediente.php?id=<?//php echo $funcionarios['id'] ?>">Activacion de Expediente en Bandeja de Entrada</a>
             </div>-->
             <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle"
                        data-toggle="dropdown">
                  Gestion de Expediente <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="transferencias.php?id=<?php echo $funcionarios['id'] ?>">Transferencias Penal</a></li>
                  <li><a href="transferenciasnopenal.php?id=<?php echo $funcionarios['id'] ?>">Transferencias no Penal</a></li>
                  <li><a href="activacionexpediente.php?id=<?php echo $funcionarios['id'] ?>">Activacion de Expediente en Bandeja de Entrada</a></li>
                </ul>
              </div>
              </div>
           </td>
         </table>
       </form>
          <?php
            $activo = $funcionarios['activo'];
            }
          ?>
    </section>
  </div>
</div>

<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script type="text/javascript" src="ocultar-mostrar.js"></script>
<script src="js/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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
