<?php require '../conexion/conexion.php';?>
<aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <?php if (isset($_SESSION['avatar'])) { ?>
            <?php if ($_SESSION['avatar'] != '') { ?>
              <img src="../images/usuarios/<?php echo $_SESSION['avatar'];?>" class="img-user" alt="User Image" width="18px">
            <?php } else { ?>
              <img src="../images/usuarios/no-imagen.png" class="user-image" alt="User Image" width="18px">
            <?php } ?>
          <?php } ?>
        </div>
        <div class="pull-left info">
          <p>
            <?php if (isset($_SESSION['usuario'])) {
            echo $_SESSION['usuario'];
            } ?>
        </p>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">HEADER</li>

        <li class="active"><a href="index.php">
          <i class="fa fa-home"></i> <span>Inicio</span></a>
        </li>

        <li>
          <a href="sliders.php"><i class="fa fa-link"></i> <span>Sliders</span></a>
        </li>

        <li>
          <a href="marcas.php"><i class="fa fa-link"></i> <span>Marcas</span></a>
        </li>

        <li>
          <a href="cms.php"><i class="fa fa-link"></i> <span>Contenido</span></a>
        </li>

        <li>
          <a href="enlaces.php"><i class="fa fa-link"></i> <span>Enlaces</span></a>
        </li>

        <li>
          <a href="usuarios.php"><i class="fa fa-link"></i> <span>Usuarios</span></a>
        </li>

        <li>
          <a href="mensajes.php"><i class="fa fa-link"></i> <span>Mensajes</span></a>
        </li>

        <li>
          <a href="parametros.php"><i class="fa fa-link"></i> <span>Parametros</span></a>
        </li>

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
