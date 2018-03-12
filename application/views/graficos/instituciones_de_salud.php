<script src="<?php echo base_url().'assets/js/highcharts';?>/highmaps.js"></script>
<script src="<?php echo base_url().'assets/js/highcharts';?>/data.js"></script>
<script src="<?php echo base_url().'assets/js/highcharts';?>/drilldown.js"></script>
<script src="<?php echo base_url().'assets/js/highcharts';?>/exporting.js"></script>
<script src="<?php echo base_url().'assets/js/highcharts';?>/cl-all.js"></script>
<script src="<?php echo base_url(); ?>assets/js/moment.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datepicker.min.js"></script>

<div class="row">
	<div class="col-md-4" style="margin-bottom: 30px">
    <label>Seleccione una opción:</label>
    <div class="col-sm-10" style="padding: 0">
		<select class="form-control" id="opciones">
      <?php 
      $lista[0] = "Porcentaje de cada institución utiliza Convatec";
      $lista[1] = "Porcentaje de cada institución recomienda Convatec";
      $lista[2] = "Porcentaje de cada institución cambio sus dispositivos médicos";
      $lista[3] = "Porcentaje de cada institución utiliza complementos";
      $lista[4] = "Porcentaje de cada institución recomienda el Programa ConTigo Me más";
      $lista[5] = "Porcentaje de cada institución está activo en el programa";
      $lista[6] = "Porcentaje de cada institución tienen cierre quirúrgico pendiente";
      $lista[7] = "Porcentaje de cada institución ha tenido complicaciones por el dispositivo médico que le entregan en una institución de salud";

      for ($i=0; $i < 8; $i++) { 
        if ($i == $posicion) {
          echo "<option value='".$i."' selected='selected'>".$lista[$i]."</option>";
        }else{
          echo "<option value='".$i."'>".$lista[$i]."</option>";
        }
        
      } ?>
		</select>
  </div>
	</div>
  <div class="col-md-6" style="margin-bottom: 30px;">
    <label>Seleccione un rango de fecha:</label>
    <div class="row">
      <div class='col-sm-4'>
          <div class="form-group">
              <div class='input-group date' id='datetimepicker6'>
                  <input type='text' class="form-control" />
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
          </div>
      </div>
      <div class='col-sm-4'>
          <div class="form-group">
              <div class='input-group date' id='datetimepicker7'>
                  <input type='text' class="form-control" />
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
          </div>
      </div>
      <div class="col-sm-2">
        <input class="btn btn-default" type="button" value="Aplicar" id="aplicarDate">
      </div>
  </div>
  </div>
  <div class="col-md-2" style="margin-bottom: 30px">
    <label>Exportar en excel:</label>
    <div>
    <a href="<?php echo base_url().'graficos/exportar_instituciones_de_salud/'.$posicion.'/'.$startDate.'/'.$endDate; ?>" class="btn btn-success">Exportar</a></div>
  </div>
    <div class="col-md-12" style="clear: both;">
    	<div id ="container">
    		
    	</div>
    </div>
</div>


<script type="text/javascript">

	$(function () {

    var chart = new Highcharts.chart('container', {
      chart: {
          type: 'column'
      },
      title: {
          text: '<?php echo $titulo; ?>'
      },
      xAxis: {
          type: 'category',
          labels: {
              rotation: -45,
              style: {
                  fontSize: '8px',
                  fontFamily: 'Verdana, sans-serif'
              }
          },
          title: {
              text: '<?php echo $tituloX; ?>'
          }
      },
      yAxis: {
          min: 0,
          title: {
              text: '<?php echo $tituloY; ?>'
          }
      },
      legend: {
          enabled: true,
      },
      tooltip: {
              headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
              pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b><br/>'
          },
      series: [{
          name: 'Porcentaje de cada Institución',
          data: [
              <?php 
              if ($datos!=false) {
                foreach ($datos as $key => $value) {
                  echo "['".$value['nombre']."',";
                  echo $value['porcentaje']."],";
              }} ?>
          ],
          dataLabels: {
              enabled: true,
              rotation: -90,
              color: '#FFFFFF',
              align: 'right',
              format: '{point.y:.1f}', // one decimal
              y: 5, // 10 pixels down from the top
              style: {
                  fontSize: '10px',
              }
          }
      }]
  });

  $('select').on('change', function() {
    start = $('#datetimepicker6').data('date')
    end = $('#datetimepicker7').data('date')
    url = "<?php echo base_url().'graficos/instituciones_de_salud/'; ?>" + this.value + "/" + start + "/" + end
    location.href = url
  })

  $("#aplicarDate").click(function(){
    op = $('#opciones').find(":selected").val();
    url = "<?php echo base_url().'graficos/instituciones_de_salud/'; ?>" + op + "/" + $('#datetimepicker6').data('date') + "/" + $('#datetimepicker7').data('date');
    location.href = url
  })
       
})

$(function () {
    $('#datetimepicker6').datetimepicker({
      format: 'DD-MM-YYYY',
      locale: 'es',
      defaultDate: '<?php echo date_format(date_create($startDate), 'm-d-Y'); ?>',
    });
    $('#datetimepicker7').datetimepicker({
        useCurrent: false, //Important! See issue #1075
        format: 'DD-MM-YYYY',
        locale: 'es',
        defaultDate: '<?php echo date_format(date_create($endDate), 'm-d-Y'); ?>'
    });
    $("#datetimepicker6").on("dp.change", function (e) {
        $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
    });
    $("#datetimepicker7").on("dp.change", function (e) {
        $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
    });
});

$("#menu_graficos ul").slideDown(350);
$("#menu_graficos .open").addClass("subdrop");
$("#menu_graficos ul li:nth-child(1) a").css("background","#dedede")
</script>
