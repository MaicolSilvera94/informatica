<?php

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
$stylesheet = file_get_contents('estilo.css');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML('
                <div class="titulo form-group col-md-12">
                  <a>SECCIÓN INFORMÁTICA</a>
                </div>
                <div class="titulo form-group col-md-12">
                    <a>Solicitud de Servicios Informáticos</a>
                </div>
                <div class="form-group col-md-12">
                  <hr/>
                </div>
                <div class="solicitante form-group col-md-12">
                  <a>Datos del Solicitante</a>
                </div>
                  <div class="form-group col-md-12">
                      <label>Nombre y Apellido:</label>
                      <input type="text" name="nombreapellido" value="" required class="form-control">
                  </div>

                   <div class="form-group col-md-12">
                      <label>Cargo o Funcion:</label>
                      <input type="text" name="cargo" value="" required class="form-control">
                  </div>

                  <div class="form-group col-md-12">
                     <label>Dependencia:</label>
                     <input type="text" name="dependencia" value="" class="form-control">
                 </div>
                 <div class="form-group col-md-4">
                    <label>Interno:</label>
                    <input type="text" name="interno" value="" class="form-control">
                  </div>
                  <div class="form-group col-md-4">
                     <label>Fecha y Hora:</label>
                     <input type="text" name="fecha_add"  value="" class="form-control">
                   </div>
                    <div class="form-group col-md-12">
                         <hr/>
                    </div>
                ');
$mpdf->Output();
