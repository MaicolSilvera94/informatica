<?php
session_start();
if( !isset($_SESSION['logueado']) ){
    header('Location:login.php');
}
include('../funciones/funciones.php');
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

<body class="hold-transition skin-purple fixed">
<div class="wrapper">

  <!-- HEADER -->

<?php include '../conexion/conexion.php'; ?>
  <?php
        //Obtener el registro del usuario
        $total = 0;
        if( isset($_SESSION['usuario_id'])){


            if ($_SESSION['usuario_id'] > 0){

                $sql = "SELECT * FROM funcionarios WHERE id = " . $_SESSION['usuario_id'];
                $query = $connection->prepare($sql);
                $query->execute();
                $total = $query->rowCount();

            }

        }


        //Actualizar datos del usuario
        if(isset($_POST)){
             if($_POST['actualizar'] == 'actualizar' && $_POST['nombre'] != '' && $_POST['id'] > 0){
              if($_POST['password'] == $_POST['confirmarpassword']){
                    $sql = "UPDATE funcionarios set nombre = :nombre, cargo = :cargo, dependencia = :dependencia, interno = :interno, password = :password, fech_act=NOW() WHERE id = " . $_POST['id'];
                    $data =  array(
                         'nombre' => $_POST['nombre'],
                         'cargo' => $_POST['cargo'],
                         'dependencia' => $_POST['dependencia'],
                         'interno' => $_POST['interno'],
                         'password' => $_POST['password']
                    );

                    $query = $connection->prepare($sql);


                  try{

                    if( $query->execute($data) ){
                      ?>
                        <script type="text/javascript">
                          alert ('DATOS ACTUALIZADOS');
                        </script>
                      <?php
                        echo '<script> window.location = "logout.php"; </script>';

                    }

                     } catch(Exception $e){
                  }
              ?><?php  } else { ?>
                  <script type="text/javascript">
                    alert ('LA CLAVE NO COINCIDE');
                  </script>
                <?php } ?>
            <?php } ?>
  <?php } ?>

  <!-- ASIDE - SIDEBAR  -->
  <?php include 'includes/aside.php'; ?>

  <!-- CONTENIDO -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Editar usuario
      </h1>
      <ol class="breadcrumb">
        <li><a href="usuarioadmin.php"><i class="fa fa-home"></i> Inicio</a></li>
        <li><span>Usuarios</span></li>
      </ol>

    </section>
    <section class="content container-fluid">


      <div class="panel">
        <div class="row">
          <?php if($total > 0) {
                 $usuarios = $query->fetchAll()[0];
                // var_dump($usuario);
              ?>
            <form action="usuarios_edit.php" method="POST">
              <div class="form-group col-md-6">
                  <label>Nombre</label>
                  <input type="text" name="nombre" value="<?php echo $usuarios['nombre']; ?>" required readonly="readonly" class="form-control input-lg">
              </div>
              <div class="form-group col-md-6">
                  <label>Cargo</label>
                  <input type="text" name="cargo" value="<?php echo $usuarios['cargo']; ?>" required readonly="readonly" class="form-control input-lg">
              </div>
              <div class="form-group col-md-12">
                  <label>Dependencia</label>
                  <input type="text" name="dependencia" value="<?php echo $usuarios['dependencia']; ?>" required readonly="readonly" class="form-control input-lg">
              </div>
              <div class="form-group col-md-2">
                  <label>Interno</label>
                  <input type="text" name="interno" value="<?php echo $usuarios['interno']; ?>" required class="form-control input-lg">
              </div>
              <div class="form-group col-md-4">
                  <label>Clave</label>
                  <input type="password" value="<?php echo $usuarios['password']; ?>" name="password" required class="form-control input-lg">
              </div>
              <div class="form-group col-md-4">
                  <label>Confirmar Clave</label>
                  <input type="password" value="<?php echo $usuarios['password']; ?>" name="confirmarpassword" required class="form-control input-lg">
              </div>
                <div class="col-md-2">
                        <br>
                        <input type="hidden" name="id"  value="<?php echo $usuarios['id']; ?>">
                       <button type="submit" name="actualizar" value="actualizar" class="btn btn-primary">Actualizar</button>
                </div>

            </form>

          <?php } ?>

        </div>
      </div>
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
<script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>
<script>
		CKEDITOR.replace( 'descripcion_larga' );
</script>
</body>
</html>
