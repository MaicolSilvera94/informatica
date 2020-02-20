<?php
@session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" setlocale(LC_ALL,"es_Es")>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
  $total = 0;
  if(isset($_GET['id'])){

      if($_GET['id'] > 0){

          $sql = "SELECT * FROM funcionarios WHERE id = " . $_GET['id'];
          $query = $connection->prepare($sql);
          $query->execute();
          $total = $query->rowCount();

      }

  }

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
            $sistema = $_POST['sistema'];
            $obssistema = $_POST['obssistema'];
            $equipos = $_POST['equipos'];
            $datosequipos = $_POST['datosequipos'];
            $obsequipos = $_POST['obsequipos'];
            $redes = $_POST['redes'];
            $obsredes = $_POST['obsredes'];
            $procesado = $_POST['procesado'];
            $cargoprocesado = $_POST['cargoprocesado'];
            $firmaprocesado = $_POST['firmaprocesado'];
            $obsgeneral = $_POST['obsgeneral'];
            if ($firmaprocesado == $_SESSION['password']) {

            //Definir una variable con la consulta SQL.
            $sql = 'INSERT INTO servicios (nombreapellido, cargo, dependencia, interno, fecha_add, sistemas, sistema, obssistema,
              equipos, datosequipos, obsequipos, redes, obsredes, procesado, firmaprocesado, visible, cargoprocesado, obsgeneral)
              VALUES (:nombreapellido, :cargo, :dependencia, :interno, NOW(), :sistemas, :sistema, :obssistema,
              :equipos, :datosequipos, :obsequipos, :redes, :obsredes, :procesado, :firmaprocesado, 1, :cargoprocesado, :obsgeneral)';

            //Definiendo una variable $data con los valores a guardase en la consulta sql
            $data = array(
                'nombreapellido' => $nombreapellido,
                'cargo' => $cargo,
                'dependencia' => $dependencia,
                'interno' => $interno,
                'sistemas' => $sistemas,
                'sistema' => $sistema,
                'obssistema' => $obssistema,
                'equipos' => $equipos,
                'datosequipos' => $datosequipos,
                'obsequipos' => $obsequipos,
                'redes' => $redes,
                'obsredes' => $obsredes,
                'procesado' => $procesado,
                'cargoprocesado' => $cargoprocesado,
                'firmaprocesado'    => $firmaprocesado,
                'obsgeneral'    => $obsgeneral
            );

           //Prepamos la conexion
           $query = $connection->prepare($sql);

            //Definimos un try catch para que devuelta un estado
            try{
                 //Si sale bien se guarda los reigstros
                 if( $query->execute($data) ){
                     //mensaje verdadero
                     $mensaje = '<p class="alert alert-success">Registrado correctamente</p>';
                     echo '<script> window.location = "index.php"; </script>';


                 } else {
                     //mesnaje falso
                    $mensaje = '<p class="alert alert-danger">Firma Incorrecta!</p>';
                 }

            } catch (PDOException $e) {
                //si sale mal devuelve el error con el motivo
                print_r($e);

                $mensaje = '<p class="alert alert-danger">'. $e .'</p>';

            }
        } else {
        $mensaje = '<p class="alert alert-danger">Firma Incorrecta!</p>';
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
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Inicio</a></li>
      </ol>
    </section>
    <div class="form-group col-md-12">
         <hr/>
     </div>
    <section class="content container-fluid">
      <!--<div class="panel">
        <div class="row">
          <div class="col-xs-12">
            <a href="../index.php" class="btn btn-warning btn-lg pull-right" href=""> <i class="fa fa-close"></i> Salir</a>
          </div>
        </div>
      </div>-->
      <?php if($total > 0) {
             $funcionarios = $query->fetchAll()[0];
            // var_dump($usuario);
          ?>

      <div class="panel">
        <div class="row">
            <form action="servicio_add.php" method="POST" name="form">
              <div class="solicitante form-group col-md-12">
                <a>Datos del Solicitante</a>
              </div>
                <div class="form-group col-md-12">
                    <label>Nombre y Apellido:</label>
                    <input type="text" name="nombreapellido" value="<?php echo $funcionarios['nombre']; ?>" required class="form-control">
                </div>

                 <div class="form-group col-md-12">
                    <label>Cargo o Funcion:</label>
                    <input type="text" name="cargo" value="<?php echo $funcionarios['cargo']; ?>" required class="form-control">
                </div>

                <div class="form-group col-md-12">
                   <label>Dependencia:</label>
                   <input type="text" name="dependencia" value="<?php echo $funcionarios['dependencia']; ?>" class="form-control">
               </div>
               <div class="form-group col-md-4">
                  <label>Interno:</label>
                  <input type="text" name="interno" value="<?php echo $funcionarios['interno']; ?>" class="form-control">
                </div>
                <div class="form-group col-md-4">
                   <label>Fecha:</label>
                   <input type="date" name="fecha_add" step="1" min="2019-01-01" max="2050-12-31" value="<?php echo date("Y-m-d");?>" class="form-control">
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
                         <option value=""  >Seleccione Una Opcion</option>
                         <option value="Creacion de Usuario"  >Creacion de Usuario</option>
                         <option value="Cambio/Reseteo de Contraseña"  >Cambio/Reseteo de Contraseña</option>
                         <option value="Deshabilitacion de Usuario"  >Deshabilitacion de Usuario</option>
                         <option value="Instalación de Sistema"  >Instalación de Sistema</option>
                         <option value="Actualizacion de Sistema"  >Actualizacion de Sistema</option>
                         <option value="Otros"  >Otros</option>
                     </select>
                 </div>
                 <div class="form-group col-md-12">
                    <label>Sistema:</label>
                    <input type="text" name="sistema"  class="form-control">
                 </div>
                 <div class="form-group col-md-12">
                    <label>Observaciones:</label>
                    <input type="text" name="obssistema" class="form-control">
                 </div>
                 <div class="solicitante form-group col-md-12">
                    <a>Equipos</a>
                    <select name="equipos" class="form-control" >
                        <option value=""  ></option>
                        <option value="Montaje"  >Montaje</option>
                        <option value="Configuracion"  >Configuracion</option>
                        <option value="Verificacion"  >Verificacion</option>
                        <option value="Instalación de Software"  >Instalación de Software</option>
                        <option value="Mantenimeito"  >Mantenimieto</option>
                        <option value="Otros"  >Otros</option>
                    </select>
                 </div>
                 <div class="form-group col-md-12">
                    <label>Datos del Equipo:</label>
                    <input type="text" name="datosequipos" class="form-control">
                 </div>
                 <div class="form-group col-md-12">
                    <label>Observaciones:</label>
                    <input type="text" name="obsequipos" class="form-control">
                 </div>
                 <div class="solicitante form-group col-md-12">
                    <a>Redes</a>
                    <select name="redes" class="form-control" >
                        <option value=""  ></option>
                        <option value="Creacion de Usuarios"  >Creacion de Usuarios</option>
                        <option value="Cambio/Reseteo de Contraseña"  >Cambio/Reseteo de Contraseña</option>
                        <option value="Deshabilitacion de Usuario"  >Deshabilitacion de Usuario</option>
                        <option value="Configuracion de Red"  >Configuracion de Red</option>
                        <option value="Compartir recursos de Red"  >Compartir recursos de Red</option>
                        <option value="Otros"  >Otros</option>
                    </select>
                 </div>
                 <div class="form-group col-md-12">
                    <label>Observaciones:</label>
                    <input type="text" name="obsredes" class="form-control">
                 </div>
                 <div class="form-group col-md-12">
                      <hr/>
                 </div>
                 <div class="tipo form-group col-md-12">
                   <a>Funcionario de Informatica recepcionante de la Solicitud</a>
                 </div>
                 <div class="form-group col-md-6">
                    <label>Nombre y Apellido:</label>
                    <input type="text" name="procesado" value="<?php echo $_SESSION['usuario']; ?> <?php echo $_SESSION['apellido']; ?>" required class="form-control">
                 </div>
                 <div class="form-group col-md-3">
                    <label>Cargo:</label>
                    <input type="text" name="cargoprocesado" value="<?php echo $_SESSION['cargo']; ?>" required class="form-control">
                 </div>
                 <div class="form-group col-md-12">
                    <label>Observacion:</label>
                    <input type="text" name="obsgeneral"  required class="form-control">
                 </div>
                 <div class="form-group col-md-3">
                    <label>Firma:</label>
                    <input type="password" name="firmaprocesado" required class="form-control">
                 </div>



                <div class="col-md-2">
                        <br>
                       <button type="submit" name="guardar" value="guardar" class="btn btn-primary">Guardar</button>
                </div>

            </form>
            <?php }  ?>
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
