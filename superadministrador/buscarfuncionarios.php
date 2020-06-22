<!--<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">-->
<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
<?php
		include '../conexion/conexion3.php';
    $salida = "";

    $query = "SELECT * FROM funcionarios WHERE id > 0 ORDER By ID";

    if (isset($_POST['consulta'])) {
    	$q = $conn->real_escape_string($_POST['consulta']);
    	$query = "SELECT * FROM funcionarios WHERE id LIKE '%$q%' OR nombre LIKE '%$q%' OR cedula LIKE '%$q%'  ";
    }

    $resultado = $conn->query($query);

   if ($resultado->num_rows>0) {
    	$salida.= "<table border=1 class='tabla_datos table table-bordered table-striped table-hover'>
    			<thead>
    				<tr id='titulo'>
              <th>ID</th>
    					<th>CEDULA</th>
    					<th>NOMBRE</th>
    					<th>CARGO</th>
              <th>ACTIVO LOGIN</th>
              <th>ACTIVO TRANSFERENCIAS</th>
							<th class='text-center' width='10%'>
              <i class='fa fa-cogs'></i>
            </th>
    				</tr>
    			</thead>


    	<tbody>";

    	while ($fila = $resultado->fetch_assoc()) {
    		$salida.="<tr>
              <td>".$fila['id']."</td>
    					<td>".$fila['cedula']."</td>
    					<td>".$fila['nombre']."</td>
    					<td>".$fila['cargo']."</td>
              <td>".$fila['activo']."</td>
              <td>".$fila['transferencia']."</td>
							<td class='text-center' style='vertical-align:middle;'>
								<a class='btn btn-warning btn-xs' href='funcionarios_edit.php?id=".$fila['id']."'> <i class='fa fa-edit'></i></a>
                <a class='btn btn-danger btn-xs' href='funcionarios_delete.php?id=".$fila['id']."'> <i class='fa fa-remove'></i></a>
							</td>

    					</tr>";

    	}
    	$salida.="</tbody></table>";
    }else{
    	$salida.="<div class='alert alert-warning col-md-12'>
		  						<strong>No se encontro ningun Registro</strong>
							  </div>";
    }


    echo $salida;

    $conn->close();

?>
