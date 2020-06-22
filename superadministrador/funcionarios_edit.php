<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Usuarios | Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="dist/css/skins/skin-purple.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-purple fixed">
<div class="wrapper">

  <!-- HEADER -->

  <?php include 'includes/header.php'; ?>
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
       if(isset($_POST)){

            if($_POST['actualizar'] == 'actualizar' && $_POST['nombre'] != '' && $_POST['id'] > 0){
                   $sql = "UPDATE funcionarios set nombre = :nombre, cargo = :cargo, dependencia = :dependencia,
                    cedula = :cedula, password = :password, activo=:activo, transferencia=:transferencia WHERE id = " . $_POST['id'];
                   $data =  array(
                        'nombre' => $_POST['nombre'],
                        'cargo' => $_POST['cargo'],
                        'dependencia' => $_POST['dependencia'],
                        'cedula' => $_POST['cedula'],
                        'password' => $_POST['password'],
                        'activo' => $_POST['activo'],
                        'transferencia' => $_POST['transferencia']
                   );

                   $query = $connection->prepare($sql);


                 try{

                    $query->execute($data);

                    } catch(Exception $e){


                 }

            }

       }

   ?>
 <?php include 'includes/mensajes.php';?>

  <!-- ASIDE - SIDEBAR  -->
  <?php include 'includes/aside.php'; ?>

  <!-- CONTENIDO -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Editar Funcionario
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Inicio</a></li>
        <li><span>Usuarios</span></li>
      </ol>

    </section>
    <section class="content container-fluid">

<div class="panel">
        <div class="row">
          <div class="col-xs-12">

            <a href="funcionarios.php" class="btn btn-warning btn-lg pull-right" href=""> <i class="fa fa-close"></i> Salir</a>
        </div>

        </div>


      </div>

      <div class="panel">
        <div class="row">
          <?php if($total > 0) {
                 $funcionarios = $query->fetchAll()[0];
                // var_dump($usuario);
              ?>
            <form action="funcionarios_edit.php" method="POST">
                <div class="form-group col-md-3">
                    <label>Nombre</label>
                    <input type="text" name="nombre" value="<?php echo $funcionarios['nombre']; ?>" required class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Cargo</label>
                    <input type="text" name="cargo" value="<?php echo $funcionarios['cargo']; ?>" required class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Dependencia</label>
                    <input type="text" name="dependencia" value="<?php echo $funcionarios['dependencia']; ?>" required class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Cedula</label>
                    <input type="text" name="cedula" value="<?php echo $funcionarios['cedula']; ?>" required class="form-control">
                </div>
                <div class="form-group col-md-2">
                   <label>Activo Login</label>
                   <select name="activo" class="form-control" required>
                       <option value="1" <?php if($funcionarios['activo'] == 1){ echo 'selected'; } ?>  >Activo</option>
                       <option value="0" <?php if($funcionarios['activo'] == 0){ echo 'selected'; } ?> >Desactivado</option>
                   </select>
               </div>
               <div class="form-group col-md-2">
                  <label>Activo Tranferencias</label>
                  <select name="transferencia" class="form-control" required>
                      <option value="1" <?php if($funcionarios['transferencia'] == 1){ echo 'selected'; } ?>  >Activo</option>
                      <option value="0" <?php if($funcionarios['transferencia'] == 0){ echo 'selected'; } ?> >Desactivado</option>
                  </select>
              </div>
                <div class="form-group col-md-4">
                    <label>Contrasena</label>
                    <input type="password" name="password" value="<?php echo $funcionarios['password']; ?>" class="form-control">
                </div>



                <div class="col-md-2">
                        <br>
                        <input type="hidden" name="id"  value="<?php echo $funcionarios['id']; ?>">
                       <button type="submit" name="actualizar" value="actualizar" class="btn btn-primary">Actualizar</button>
                </div>

            </form>
          <?php } else {  ?>

            <a href="funcionarios.php" class="btn btn-warning">El usuario actualizado, volver a la lista</a>

          <?php } ?>

        </div>
      </div>
    </section>
  </div>

  <!-- FOOTER -->
  <?php include 'includes/footer.php'; ?>

</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
