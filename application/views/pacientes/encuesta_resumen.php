

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
                  <th>MARCA DE DISPOSITIVO QUE UTILIZA ACTUALMENTE</th>
                  <td><?php echo $encuesta->sistemas; ?></td>
                </tr>
                <tr>
                  <th>¿CAMBIÓ EL TIPO DE SISTEMA DE QUE LE ENTREGARON EN SU HOSPITAL/CLINICA?</th>
                  <td><?php if($encuesta->correccion_entrega){ echo 'SI'; }else{echo 'NO'; }?></td>
                </tr>  
                <tr>  
                  <th>¿TIENE CIERRE QUIRÚRGICO PENDIENTE?</th>
                  <td><?php if($encuesta->cierre_quirurgico){ echo 'SI'; }else{echo 'NO'; }?></td>
                </tr>
                <tr>  
                  <th>¿FUE ENVIADO A SU INSTITUCIÓN DE SALUD POR ALGUNA COMPLICACIÓN EN SU SISTEMA DE OSTOMÍAS?</th>
                  <td><?php if($encuesta->remitido){ echo 'SI'; }else{echo 'NO'; }?></td>
                </tr>
                <tr>
                  <th>¿DE CUÁNTAS PIEZAS ES SU SISTEMA DE OSTOMÍAS?</th>
                  <td><?php if($encuesta->sistema_dispositivo == 1){ echo '1 Pieza'; }elseif($encuesta->sistema_dispositivo == 2){echo '2 Piezas'; }?></td>
                </tr>
                <tr>  
                  <th>¿NÚMERO DE PLACAS QUE LE ENTREGAN AL MES?</th>
                  <td><?php echo $encuesta->numero_placas; ?></td>
                </tr>
                <tr>  
                  <th>¿CUÁNTOS SISTEMAS DE OSTOMÍAS UTILIZA AL MES?</th>
                  <td><?php echo $encuesta->dispositivos_mes; ?></td>
                </tr>
                <tr>  
                  <th>¿NÚMERO DE BOLSAS QUE LE ENTREGAN AL MES?</th>
                  <td><?php echo $encuesta->numero_bolsas; ?></td>
                </tr>
                <tr>  
                  <th>¿UTILIZA COMPLEMENTOS PARA OSTOMIAS APARTE DE LOS SISTEMAS?</th>
                  <td><?php echo $encuesta->adjuvantes; ?></td>
                </tr>
                <tr>  
                  <th>¿POR QUÉ NO UTILIZA LOS PRODUCTOS CONVATEC?</th>
                  <td><?php echo $encuesta->numero_bolsas; ?></td>
                </tr>
                <tr>
                  <th>¿QUÉ ACTIVIDAD LABORAL REALIZA?</th>
                  <td><?php echo $encuesta->actividad_laboral; ?></td>
                </tr>
                <tr>  
                  <th>¿RECOMIENDA LOS PRODUCTOS CONVATEC?</th>
                  <td><?php if($encuesta->recomienda_convatec){ echo 'SI'; }else{echo 'NO'; }?></td>
                </tr>
                <tr>  
                  <th>¿RECOMENDARÍA A OTROS PACIENTES EL PROGRAMA CONTIGO?</th>
                  <td><?php if($encuesta->recomienda_programa){ echo 'SI'; }else{echo 'NO'; }?></td>
                </tr>
                <tr>  
                  <th>¿REALIZA USTED EL CAMBIO DE SU SISTEMA DE OSTOMIA?</th>
                  <td><?php if($encuesta->autocuidado){ echo 'SI'; }else{echo 'NO'; }?></td>
                </tr>
                <tr>  
                  <th>¿CUANTAS SEMANAS DEMORO EN RETOMAR SU VIDA LABORAL?</th>
                  <td><?php if($encuesta->tiempo_retorno_laboral == 1){ echo '1-2 semanas'; }elseif($encuesta->tiempo_retorno_laboral == 2){echo '2-3 semanas'; }elseif($encuesta->tiempo_retorno_laboral == 3){echo '3-4 semanas'; }elseif($encuesta->tiempo_retorno_laboral == 4){echo '5-6 semanas'; }elseif($encuesta->tiempo_retorno_laboral == 2){echo '7-8 semanas'; }elseif($encuesta->tiempo_retorno_laboral == 5){echo '9-10 semanas'; }elseif($encuesta->tiempo_retorno_laboral == 6){echo 'Más de 10 semanas'; }?></td>
                </tr>
                <tr>  
                  <th>¿ESTADO  DEL PACIENTE EN EL PROGRAMA?</th>
                  <td><?php if($encuesta->autocuidado){ echo 'ACTIVO'; }else{echo 'INACTIVO'; }?></td>
                </tr>
                <tr>  
                  <th>FECHA PRÓXIMO LLAMADO</th>
                  <td><?php echo $encuesta->proximo_llamado; ?></td>
                </tr>  
                  <th>OBSERVACIONES</th>
                  <td><?php echo $encuesta->observaciones; ?></td>
                </tr>                                                           
              </tbody>
            </table>
          </div>  
      </div>
    </div>
  </div> 
	