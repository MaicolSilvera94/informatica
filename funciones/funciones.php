<?php
    function getRealIP()
    {
        // Mediante $_SERVER['HTTP_CLIENT_IP'] verificamos si la IP es una conexión compartida.
        // Mediante $_SERVER['HTTP_X_FORWARDED_FOR'] verificamos si la IP pasa por un proxy.
        // Mediante $_SERVER['REMOTE_ADDR'] obtenemos la dirección IP desde la cual está viendo la página actual el usuario.

        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];

        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];

        return $_SERVER['REMOTE_ADDR'];
    }

    function getSliders($cantidad)
    {
        include '../conexion/conexion.php';

        $sql = "SELECT * FROM sliders WHERE visible = 1 LIMIT " . $cantidad;
        $query = $connection->prepare($sql);
        $query->execute();

        return $query->fetchAll();
      }

      function getMarcas($cantidad)
      {
          include '../conexion/conexion.php';

          $sql = "SELECT * FROM marcas WHERE visible = 1 LIMIT " . $cantidad;
          $query = $connection->prepare($sql);
          $query->execute();

          return $query->fetchAll();
        }

  function v_email_newsletters($var)
  {
      require '../conexion/conexion.php';
      $sql = "SELECT email FROM newsletters WHERE email = '$var'";
      $query = $connection->prepare($sql);
      $query->execute();
      $total = $query->rowCount();
      return $total;
  }

  function getCms($id)
  {
      include '../conexion/conexion.php';
      $sql = "SELECT * FROM servicios WHERE id = " . $id;
      $query = $connection->prepare($sql);
      $query->execute();
      if ($query->rowCount() > 0) {
         return $query->fetchAll()[0];
      }
      return 0;
  }
  function getCmsLista($cantidad)
  {
      include '../conexion/conexion.php';
      $sql = "SELECT * FROM servicios WHERE visible = 1 ORDER BY id DESC LIMIT " . $cantidad;
      $query = $connection->prepare($sql);
      $query->execute();
      return $query->fetchAll();


  }

  function getTran($id)
  {
      include '../conexion/conexion.php';
      $sql = "SELECT * FROM transferencias WHERE id = " . $id;
      $query = $connection->prepare($sql);
      $query->execute();
      if ($query->rowCount() > 0) {
         return $query->fetchAll()[0];
      }
      return 0;
  }
  function getTranLista($cantidad)
  {
      include '../conexion/conexion.php';
      $sql = "SELECT * FROM transferencias WHERE visible = 1 ORDER BY id DESC LIMIT " . $cantidad;
      $query = $connection->prepare($sql);
      $query->execute();
      return $query->fetchAll();
  }

  function registrar_mensaje($post){

    include '../conexion/conexion.php';
    $sql = "INSERT INTO mensajes (nombre, email, asunto, telefono, mensaje, fecha_add) values (:nombre, :email, :asunto, :telefono, :mensaje, :NOW() )";
    //Definiendo una variable $data con los valores a guardase en la consulta sql
    $data = array(
        'nombre' => $post['nombre'],
        'email' => $post['email'],
        'asunto' => $post['asunto'],
        'telefono' => $post['telefono'],
        'mensaje' => $post['mensaje']
    );
    $query = $connection->prepare($sql);
    try {
        if($query->execute($data)){
            return enviar_email($post);
        }
        return 'Mensaje no enviado';


    } catch (PDOException $e) {
        //si sale mal devuelve el error con el motivo
      return $e;

    }

}
function parametros(){
    include '../conexion/conexion.php';
    $sql = "SELECT * FROM parametros where id = 1 ";
    $query = $connection->prepare($sql);
    $query->execute();

    if(!$query->rowCount() > 0) {
        $sql = "INSERT INTO parametros (id) values (1)";
        $query2 = $connection->prepare($sql);
        $query2->execute();
     }
     $query->execute();
     return $query->fetchAll()[0];
}
function getDespachoLista()
  {
      include '../conexion/conexion.php';
      $sql = "SELECT * FROM juzgadodetransferencia";
      $query = $connection->prepare($sql);
      $query->execute();
      return $query->fetchAll();
  }
function getfuncionariosLista()
  {
      include '../conexion/conexion.php';
      $sql = "SELECT * FROM funcionarios WHERE id LIKE '%$q%' OR nombre LIKE '%$q%' OR cedula LIKE '%$q%' LIMIT 1 ";
      $query = $connection->prepare($sql);
      $query->execute();
      return $query->fetchAll();
  }
?>
