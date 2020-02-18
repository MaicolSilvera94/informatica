<?php
session_start()
?>
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
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">->
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
        if( isset($_SESSION['usuario_id'])){


            if ($_SESSION['usuario_id'] > 0){

                $sql = "SELECT * FROM usuarios WHERE id = " . $_SESSION['usuario_id'];
                $query = $connection->prepare($sql);
                $query->execute();
                $total = $query->rowCount();

            }

        }


        //Actualizar datos del usuario
       if(isset($_POST)){

            if($_POST['actualizar'] == 'actualizar' && $_POST['nombre'] != '' && $_POST['id'] > 0){
                   $sql = "UPDATE usuarios set nombre = :nombre, email = :email, password = :password, avatar = :avatar,  activo = :activo, fech_act=NOW() WHERE id = " . $_POST['id'];
                   $data =  array(
                        'nombre' => $_POST['nombre'],
                        'email' => $_POST['email'],
                        'password' => md5($_POST['password']),
                        'avatar' => $_POST['avatar'],
                        'activo' => $_POST['activo']
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
        Editar Usuarios
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

            <a href="usuarios.php" class="btn btn-warning btn-lg pull-right" href=""> <i class="fa fa-close"></i> Salir</a>
        </div>

        </div>


      </div>

      <div class="panel">
        <div class="row">
          <?php if($total > 0) {
                 $usuarios = $query->fetchAll()[0];
                // var_dump($usuario);
              ?>
            <form action="usuarios_edit.php" name="form" method="POST">
              <div class="form-group col-md-4">
                  <label>Nombre</label>
                  <input type="text" name="nombre" value="<?php echo $usuarios['nombre']; ?>" required class="form-control input-lg">
              </div>
              <div class="form-group col-md-4">
                  <label>Email</label>
                  <input type="text" name="email" value="<?php echo $usuarios['email']; ?>" required class="form-control input-lg">
              </div>
              <div class="form-group col-md-4">
                  <label>Password</label>
                  <input type="password" name="password" required class="form-control input-lg">
              </div>
              <div class="form-group col-md-1">
                  <img src="../images/usuarios/<?php echo $usuarios['avatar']; ?>" class="img-user" alt="User Image" width="100px">
              </div>
              <div class="form-group col-md-2">
                  <label>Imagen</label>
                  <input type="text" name="avatar" value="<?php echo $usuarios['avatar']; ?>"  class="form-control" id="avatar"  onclick="subir_imagen('avatar', 'usuarios')">
              </div>
              <div class="form-group col-md-2">
                 <label>Activo</label>
                 <select name="activo" class="form-control" required>
                     <option value="1" <?php if($usuarios['activo'] == 1){ echo 'selected'; } ?>  >Activo</option>
                     <option value="0" <?php if($usuarios['activo'] == 0){ echo 'selected'; } ?> >Inactivo</option>
                 </select>
             </div>
                <div class="col-md-2">
                        <br>
                        <input type="hidden" name="id"  value="<?php echo $usuarios['id']; ?>">
                       <button type="submit" name="actualizar" value="actualizar" class="btn btn-primary">Actualizar</button>
                </div>

            </form>
          <?php } else {  ?>

            <a href="usuarios.php" class="btn btn-warning">El servicio no exite, volver a la lista</a>

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
<script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>


<script>
		CKEDITOR.replace( 'descripcion_larga' );
</script>
</body>
</html>
