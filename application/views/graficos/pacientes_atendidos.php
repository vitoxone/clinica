<script src="<?php echo base_url().'assets/js/highcharts';?>/highcharts.js"></script>
<script src="<?php echo base_url().'assets/js/highcharts';?>/data.js"></script>
<script src="<?php echo base_url().'assets/js/highcharts';?>/drilldown.js"></script>
<script src="<?php echo base_url().'assets/js/highcharts';?>/exporting.js"></script>
<script src="<?php echo base_url(); ?>assets/js/moment.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datepicker.min.js"></script>


<div class="row">
  <div class="col-md-4" style="margin-bottom: 30px">
    <label>Seleccione una opción:</label>
    <div class="col-sm-10" style="padding: 0">
    <select class="form-control" id="opciones">
      <?php 
      $lista[0] = "Porcentaje del total están activos en el Programa ConTigo Me+";
      $lista[1] = "Porcentaje se atiende en las diferentes instituciones utiliza Convatec";
      $lista[2] = "Porcentaje utiliza Convatec";
      $lista[3] = "Porcentaje recomienda Convatec";
      $lista[4] = "Porcentaje ha tenido complicaciones con su dispositivo medico";
      $lista[5] = "Porcentaje ha cambiado su dispositivo médico";
      $lista[6] = "Porcentaje recomienda el Programa ConTigo Me+";

      for ($i=0; $i < 7; $i++) { 
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
    <a href="<?php echo base_url().'graficos/exportar_pacientes_atendidos/'.$posicion.'/'.$startDate.'/'.$endDate; ?>" class="btn btn-success">Exportar</a></div>
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
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: '<?php echo $titulo; ?>'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            },
            showInLegend: true
        }
    },
      series: [{
          name: 'Pacientes',
          colorByPoint: true,
          data: [
              <?php 
              if ($datos!=false) {
                  echo "{name:'".$tituloX."',";
                  echo "y:".$datos[0]['porcentaje']."}";
                  echo ",{name:'".$tituloY."',y:".(100 - $datos[0]['porcentaje'])."}"; 
              }
          ?>
          ]
      }]
  });

  $('select').on('change', function() {
    start = $('#datetimepicker6').data('date')
    end = $('#datetimepicker7').data('date')
    url = "<?php echo base_url().'graficos/pacientes_atendidos/'; ?>" + this.value + "/" + start + "/" + end
    location.href = url
  })

  $("#aplicarDate").click(function(){
    op = $('#opciones').find(":selected").val();
    url = "<?php echo base_url().'graficos/pacientes_atendidos/'; ?>" + op + "/" + $('#datetimepicker6').data('date') + "/" + $('#datetimepicker7').data('date');
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
$("#menu_graficos ul li:nth-child(2) a").css("background","#dedede")
</script>