<?php if( count($cms = getCms(1)) > 0) { ?>
  <div class="col-sm-3">
    <div class="box-info">
      <i class="icon ion-md-analytics"></i>
      <h3><?php echo $cms['titulo']; ?></h3>
      <p>
        <?php echo $cms['descripcion_corta']; ?>
      </p>
    </div>
  </div>
<?php } ?>
