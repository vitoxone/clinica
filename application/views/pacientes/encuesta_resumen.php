

  <div class="container">

    <div class="row">
      <div>
        <div class="widget">

        <div class="widget-head">
          <div class="pull-left">Encuesta nro : <?php echo $encuesta->id_encuesta?></div>
          <div class="widget-icons pull-right">
            <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
            <a href="#" class="wclose"><i class="icon-remove"></i></a>
          </div>  
          <div class="clearfix"></div>
        </div>

          <div class="widget-content">

            <table class="table table-striped table-bordered table-hover">
                <tr>
                  <th>Tipo dispositivo que usa actualmente</th>
                  <td><?php echo $encuesta->sistemas; ?></td>
                </tr>
                <tr>
                  <th>Corrección de entrega</th>
                  <td><?php if($encuesta->correccion_entrega){ echo 'SI'; }else{echo 'NO'; }?></td>
                </tr>  
                <tr>  
                  <th>Cierre quirurgico pendiente</th>
                  <td><?php if($encuesta->cierre_quirurgico){ echo 'SI'; }else{echo 'NO'; }?></td>
                </tr>
                <tr>  
                  <th>Remitido a su institución de salud</th>
                  <td><?php if($encuesta->remitido){ echo 'SI'; }else{echo 'NO'; }?></td>
                </tr>
                <tr> 
                  <th>¿Evento adverso por uso de dispositivo médico?</th>
                  <td><?php if($encuesta->evento_adverso){ echo 'SI'; }else{echo 'NO'; }?></td>
                </tr>
                <tr>
                  <th>Sistema de dispositivos</th>
                  <td><?php if($encuesta->sistema_dispositivo == 1){ echo '1 Pieza'; }elseif($encuesta->sistema_dispositivo == 2){echo '2 Piezas'; }?></td>
                </tr>
                <tr>  
                  <th>Número de placas que le entregan al mes</th>
                  <td><?php echo $encuesta->numero_placas; ?></td>
                </tr>
                <tr>  
                  <th>¿Cuantos dispositivos utiliza al mes?</th>
                  <td><?php echo $encuesta->dispositivos_mes; ?></td>
                </tr>
                <tr>  
                  <th>Número de bolsas que le entregan al mes</th>
                  <td><?php echo $encuesta->numero_bolsas; ?></td>
                </tr>
                <tr>  
                  <th>Utiliza accesorios</th>
                  <td><?php echo $encuesta->adjuvantes; ?></td>
                </tr>
                <tr>  
                  <th>¿Por qué no utiliza Convatec?</th>
                  <td><?php echo $encuesta->numero_bolsas; ?></td>
                </tr>
                <tr>
                  <th>Actividad laboral</th>
                  <td><?php echo $encuesta->actividad_laboral; ?></td>
                </tr>
                <tr>  
                  <th>¿Recomienda productos Convatec?</th>
                  <td><?php if($encuesta->recomienda_convatec){ echo 'SI'; }else{echo 'NO'; }?></td>
                </tr>
                <tr>  
                  <th>¿Recomendaría otros pacientes al programa?</th>
                  <td><?php if($encuesta->recomienda_programa){ echo 'SI'; }else{echo 'NO'; }?></td>
                </tr>
                <tr>  
                  <th>¿Tiene adherencia a su autocuidado?</th>
                  <td><?php if($encuesta->autocuidado){ echo 'SI'; }else{echo 'NO'; }?></td>
                </tr>
                <tr>  
                  <th>¿Semanas de retorno a su vida laboral?</th>
                  <td><?php if($encuesta->tiempo_retorno_laboral == 1){ echo '1-2 semanas'; }elseif($encuesta->tiempo_retorno_laboral == 2){echo '2-3 semanas'; }elseif($encuesta->tiempo_retorno_laboral == 3){echo '3-4 semanas'; }elseif($encuesta->tiempo_retorno_laboral == 4){echo '5-6 semanas'; }elseif($encuesta->tiempo_retorno_laboral == 2){echo '7-8 semanas'; }elseif($encuesta->tiempo_retorno_laboral == 5){echo '9-10 semanas'; }elseif($encuesta->tiempo_retorno_laboral == 6){echo 'Más de 10 semanas'; }?></td>
                </tr>
                <tr>  
                  <th>¿Estado del paciente en el programa?</th>
                  <td><?php if($encuesta->autocuidado){ echo 'ACTIVO'; }else{echo 'INACTIVO'; }?></td>
                </tr>
                <tr>  
                  <th>Fecha próxima llamada</th>
                  <td><?php echo $encuesta->proximo_llamado; ?></td>
                </tr>  
                  <th>Observaciones</th>
                  <td><?php echo $encuesta->observaciones; ?></td>
                </tr>                                                           
              </tbody>
            </table>
          </div>  
      </div>
    </div>
  </div> 
	