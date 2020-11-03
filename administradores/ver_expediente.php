<?php
session_start();
if(isset($_SESSION['logueado'])){
  if($_SESSION["rol"] == 1){   
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
            <form action="transferencias_edit.php" method="POST" name="form">
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
                  <div class="solicitante form-group col-md-12">
                     <a>Sistemas</a>
                         <input type="text" name="tipo" value="<?php echo $servicios['sistemas']; ?>" readonly="readonly"  class="form-control">
                 </div>
                 <div class="form-group col-md-12">
                    <label>Sistema:</label>
                    <input type="text" name="tipo" value="<?php echo $servicios['tipo']; ?>" readonly="readonly"  class="form-control">
                 </div>
                 <div class="form-group col-md-2">
                    <label>Causa Nro:</label>
                    <input type="text" name="causa" value="<?php echo $servicios['causa']; ?>" readonly="readonly" class="form-control">
                 </div>
                 <div class="form-group col-md-2">
                    <label>Año:</label>
                    <input type="text" name="ano" value="<?php echo $servicios['ano']; ?>" readonly="readonly" class="form-control">
                 </div>
                 <div class="form-group col-md-8">
                    <label>Caratula:</label>
                    <input type="text" name="caratula" value="<?php echo $servicios['caratula']; ?>" readonly="readonly" class="form-control">
                 </div>

                 <!--este codigo es para ocultar el div si es que esta el campo vacio-->
                 <?php
                 $relacion = $servicios['relacion'];
                 if ($relacion != '') { ?>
                   <div class="form-group col-md-6">
                      <label>Relacion a:</label>
                      <input type="text" name="relacion" value="<?php echo $servicios['relacion']; ?>" readonly="readonly" class="form-control">
                   </div>
                 <?php  } ?>


                 <div class="form-group col-md-6">
                    <label>Juzgado a Transferir:</label>
                      <input type="text" name="juzgado" value="<?php echo $servicios['juzgado']; ?>" readonly="readonly" class="form-control">
                 </div>
                 <div class="form-group col-md-12">
                    <label>Observaciones:</label>
                    <input type="text" value="<?php echo $servicios['obstran']; ?>" readonly="readonly" class="form-control">
                 </div>
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