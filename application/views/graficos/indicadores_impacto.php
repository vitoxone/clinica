<?php if ($tipo_grafico == 'barras'){ ?>
<script src="<?php echo base_url().'assets/js/highcharts';?>/highmaps.js"></script>
<?php }else{ ?>
<script src="<?php echo base_url().'assets/js/highcharts';?>/highcharts.js"></script>
<?php } ?>
<script src="<?php echo base_url().'assets/js/highcharts';?>/data.js"></script>
<script src="<?php echo base_url().'assets/js/highcharts';?>/drilldown.js"></script>
<script src="<?php echo base_url().'assets/js/highcharts';?>/exporting.js"></script>
<script src="<?php echo base_url().'assets/js/highcharts';?>/cl-all.js"></script>
<script src="<?php echo base_url(); ?>assets/js/moment.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datepicker.min.js"></script>


<div class="row">
  <div class="col-md-4">
    <label>Seleccione una opción:</label>
    <div class="col-sm-10" style="padding: 0">
    <select class="form-control" id="opciones">
      <?php 
      $lista[0] = "Clasificación por tipos de ostomías";
      $lista[1] = "Clasificación por etiología";
      $lista[2] = "Número de pacientes con ostomias temporales y definitivas";
      $lista[3] = "Recomendación de productos convatec";

      for ($i=0; $i < 4; $i++) { 
        if ($i == $posicion) {
          echo "<option value='".$i."' selected='selected'>".$lista[$i]."</option>";
        }else{
          echo "<option value='".$i."'>".$lista[$i]."</option>";
        }
        
      } ?>
    </select>
  </div>
  </div>
  <div class="col-md-6">
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
  <div class="col-md-2">
    <label>Exportar en excel:</label>
    <div>
    <?php if($posicion == 3){ ?>
    	 <a href="<?php echo base_url().'graficos/exportar_indicadores_impacto/'.$posicion.'/'.$startDate.'/'.$endDate.'/'.$pregunta12.'/'.$pregunta13; ?>" class="btn btn-success">Exportar</a></div>
    <?php }else{ ?>
    	 <a href="<?php echo base_url().'graficos/exportar_indicadores_impacto/'.$posicion.'/'.$startDate.'/'.$endDate.'/'.$pregunta12.'/'.$pregunta13; ?>" class="btn btn-success">Exportar</a></div>
    <?php } ?>
   
  </div>
  <?php if($posicion == 3){ ?>
  <div class="col-md-12" style="clear: both;">
  	<label>¿RECOMIENDA LOS PRODUCTOS CONVATEC?</label>
  	Si <input type="radio" name="pregunta12" value="1">
  	No <input type="radio" name="pregunta12" value="0">
  </div>
  <div class="col-md-12" style="clear: both;">
  	<label>¿RECOMENDARÍA A OTROS PACIENTES EL PROGRAMA CONTIGO?</label>
  	Si <input type="radio" name="pregunta13" value="1">
  	No <input type="radio" name="pregunta13" value="0">
  </div>
  <?php } ?>
  <div class="col-md-12" style="clear: both;margin-bottom: 30px">
  </div>
    <div class="col-md-12" style="clear: both;">
      <div id ="container">
        
      </div>
    </div>
</div>

<script type="text/javascript">

  $(function () {

  	<?php if ($tipo_grafico == 'barras'){ ?>
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
          name: 'Porcentaje',
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

		<?php }else{ ?>
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
	                  echo ",{name:'".$tituloY."',y:".$datos[1]['porcentaje']."}";
	                  if($posicion == 2)
	                  echo ",{name:'Otros',y:".(100 - ($datos[1]['porcentaje']+$datos[0]['porcentaje']))."}"; 
	              }
	          ?>
	          ]
	      }]
	  });
		<?php } ?>
    

  $('select').on('change', function() {
    

    <?php if($posicion == 3){ ?>
    	start = $('#datetimepicker6').data('date')
	    end = $('#datetimepicker7').data('date')
	    op1 = $('input[name=pregunta12]:checked').val()
	    op2 = $('input[name=pregunta13]:checked').val()
	    url = "<?php echo base_url().'graficos/indicadores_impacto/'; ?>" + this.value + "/" + start + "/" + end + "/" + op1 + "/" + op2
	    location.href = url
    <?php }else{ ?>
    	start = $('#datetimepicker6').data('date')
	    end = $('#datetimepicker7').data('date')
	    url = "<?php echo base_url().'graficos/indicadores_impacto/'; ?>" + this.value + "/" + start + "/" + end
	    location.href = url
    <?php } ?>
  })

<?php if($posicion == 3){ ?>
  $('input[type=radio]').on('change', function() {
  	op = $('#opciones').find(":selected").val();
    op1 = $('input[name=pregunta12]:checked').val()
    op2 = $('input[name=pregunta13]:checked').val()
    url = "<?php echo base_url().'graficos/indicadores_impacto/'; ?>" + op + "/" + $('#datetimepicker6').data('date') + "/" + $('#datetimepicker7').data('date') + "/" + op1 + "/" + op2
    location.href = url
  })
<?php } ?>
  $("#aplicarDate").click(function(){
  	<?php if($posicion == 3){ ?>
  		op = $('#opciones').find(":selected").val();
	    op1 = $('input[name=pregunta12]:checked').val()
	    op2 = $('input[name=pregunta13]:checked').val()
	    url = "<?php echo base_url().'graficos/indicadores_impacto/'; ?>" + op + "/" + $('#datetimepicker6').data('date') + "/" + $('#datetimepicker7').data('date') + "/" + op1 + "/" + op2
	    location.href = url
  	<?php }else{ ?>
  		op = $('#opciones').find(":selected").val();
	    url = "<?php echo base_url().'graficos/indicadores_impacto/'; ?>" + op + "/" + $('#datetimepicker6').data('date') + "/" + $('#datetimepicker7').data('date')
	    location.href = url
  	<?php } ?>
    
  })
       
})


$(function () {
	<?php if($posicion == 3){ ?>
		$("input[name=pregunta12][value=" + <?php echo $pregunta12 ?> + "]").attr('checked', 'checked');
		$("input[name=pregunta13][value=" + <?php echo $pregunta13 ?> + "]").attr('checked', 'checked');
	<?php } ?>
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
$("#menu_graficos ul li:nth-child(5) a").css("background","#dedede")
</script>