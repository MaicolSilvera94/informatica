<?php
session_start()
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
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
              if ($firmaprocesado == $_SESSION['password']) {
                   $sql = "UPDATE servicios set nombreapellido = :nombreapellido, cargo = :cargo, dependencia = :dependencia, interno = :interno,
                   fecha_add = :fecha_add, sistemas = :sistemas, sistema = :sistema, obssistema = :obssistema, equipos = :equipos,
                   datosequipos = :datosequipos, obsequipos = :obsequipos, redes = :redes, obsredes = :obsredes, procesado = :procesado,
                   fechaprocesado=NOW(), obsgeneral = :obsgeneral, firmaprocesado = :firmaprocesado,  visible = 0  WHERE id = " . $_POST['id'];
                   $data =  array(
                        'nombreapellido' => $_POST['nombreapellido'],
                        'cargo' => $_POST['cargo'],
                        'dependencia' => $_POST['dependencia'],
                        'interno' => $_POST['interno'],
                        'fecha_add' => $_POST['fecha_add'],
                        'sistemas' => $_POST['sistemas'],
                        'sistema' => $_POST['sistema'],
                        'obssistema' => $_POST['obssistema'],
                        'equipos' => $_POST['equipos'],
                        'datosequipos' => $_POST['datosequipos'],
                        'obsequipos' => $_POST['obsequipos'],
                        'redes' => $_POST['redes'],
                        'obsredes' => $_POST['obsredes'],
                        'procesado' => $_POST['procesado'],
                        'obsgeneral' => $_POST['obsgeneral'],
                        'firmaprocesado' => $_POST['firmaprocesado']
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
                    <input type="text" name="sistema" value="<?php echo $servicios['sistema']; ?> <?php echo $servicios['tipo']; ?>"  class="form-control">
                 </div>
                 <div class="form-group col-md-12">
                    <label>Observaciones:</label>
                    <input type="text" name="obssistema" value="<?php echo $servicios['obssistema']; ?> <?php  echo $servicios['causa']; ?> <?php  echo $servicios['ano']; ?> <?php  echo $servicios['caratula']; ?> <?php  echo $servicios['relacion']; ?>" class="form-control">
                 </div>
                 <div class="solicitante form-group col-md-12">
                    <a>Equipos</a>
                    <select name="equipos" class="form-control" >
                        <option value=""  >Seleccione Una Opcion</option>
                        <option value="Montaje"  <?php if($servicios['equipos'] == "Montaje"){ echo 'selected'; } ?> >Montaje</option>
                        <option value="Configuracion"  <?php if($servicios['equipos'] == "Configuracion"){ echo 'selected'; } ?>>Configuracion</option>
                        <option value="Verificacion"  <?php if($servicios['equipos'] == "Verificacion"){ echo 'selected'; } ?>>Verificacion</option>
                        <option value="Instalación de Software"  <?php if($servicios['equipos'] == "Instalación de Software"){ echo 'selected'; } ?>>Instalación de Software</option>
                        <option value="Mantenimeito"  <?php if($servicios['equipos'] == "Mantenimeito"){ echo 'selected'; } ?>>Mantenimeito</option>
                        <option value="Otros"  <?php if($servicios['equipos'] == "Otros"){ echo 'selected'; } ?>>Otros</option>
                    </select>
                 </div>
                 <div class="form-group col-md-12">
                    <label>Datos del Equipo:</label>
                    <input type="text" name="datosequipos" value="<?php echo $servicios['datosequipos']; ?>" class="form-control">
                 </div>
                 <div class="form-group col-md-12">
                    <label>Observaciones:</label>
                    <input type="text" name="obsequipos" value="<?php echo $servicios['obsequipos']; ?>" class="form-control">
                 </div>
                 <div class="solicitante form-group col-md-12">
                    <a>Redes</a>
                    <select name="redes" class="form-control" >
                        <option value=""  >Seleccione Una Opcion</option>
                        <option value="Creacion de Usuarios"  <?php if($servicios['redes'] == "Creacion de Usuarios"){ echo 'selected'; } ?> >Creacion de Usuarios</option>
                        <option value="Cambio/Reseteo de Contraseña"  <?php if($servicios['redes'] == "Cambio/Reseteo de Contraseña"){ echo 'selected'; } ?>>Cambio/Reseteo de Contraseña</option>
                        <option value="Deshabilitacion de Usuario"  <?php if($servicios['redes'] == "Deshabilitacion de Usuario"){ echo 'selected'; } ?>>Deshabilitacion de Usuario</option>
                        <option value="Configuracion de Red"  <?php if($servicios['redes'] == "Configuracion de Red"){ echo 'selected'; } ?>>Configuracion de Red</option>
                        <option value="Compartir recursos de Red"  <?php if($servicios['redes'] == "Compartir recursos de Red"){ echo 'selected'; } ?>>Compartir recursos de Red</option>
                        <option value="Otros"  <?php if($servicios['redes'] == "Otros"){ echo 'selected'; } ?>>Otros</option>
                    </select>
                 </div>
                 <div class="form-group col-md-12">
                    <label>Observaciones:</label>
                    <input type="text" name="obsredes" value="<?php echo $servicios['obsredes']; ?>" class="form-control">
                 </div>
                 <div class="form-group col-md-12">
                      <hr/>
                 </div>
                 <div class="tipo form-group col-md-12">
                   <a>Funcionario de Informatica recepcionante de la Solicitud</a>
                 </div>
                 <div class="form-group col-md-8">
                    <label>Procesado por:</label>
                    <input type="text" name="procesado" value="<?php echo $_SESSION['usuario']; ?> <?php echo $_SESSION['apellido']; ?>" required class="form-control">
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
                  <a href="index.php" class="alert-link">Volver al Inicio</a>
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
