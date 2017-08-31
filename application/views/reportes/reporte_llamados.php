<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<div class="row">
    <div class="col-md-12">              
        <div class="widget">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div id ="container"> </div>
                    </div>
                    <div class="col-md-6">
                        <div id ="pacientes_encuestados"> </div>
                    </div>     
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div id ="correccion_entrega"> </div>
                    </div>
                    <div class="col-md-6">
                        <div id ="pacientes_encuestados"> </div>
                    </div>     
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id ="container1"> </div>
                </div>
                
            </div>
            <br/>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div id ="container_mes_pasado"> </div>
                    </div>
                    <div class="col-md-6">
                        <div id ="container_mes_actual"> </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<script type="text/javascript">
	
	$(function () 
{        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Distribucion por tipo de paciente'
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
            series: <?php echo $pacientes_contigo; ?>
        });
        $('#correccion_entrega').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Pacientes correccion entrega'
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
            series: <?php echo $pacientes_correccion_entrega; ?>
        });

        $('#pacientes_encuestados').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Pacientes contigo encuestados'
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
            series: <?php echo $pacientes_contigo_encuestados; ?>
        });

        Highcharts.chart('container1', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Distribución por establecimiento general '
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
                    showInLegend: false
                }
            },
            series: <?php echo $pacientes_por_tipo; ?>
        });

        Highcharts.chart('container_mes_actual', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Distribución por establecimiento mes actual <?php echo $mes_actual; ?>'
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
                        format: '<b> {point.percentage:.1f} %',
                    },
                    showInLegend: true
                }
            },
            series: <?php echo $pacientes_mes_actual; ?>
        });

        Highcharts.chart('container_mes_pasado', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Distribución por establecimiento mes pasado <?php echo $mes_pasado; ?>'
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
                        format: '<b> {point.percentage:.1f} %',
                    },
                    showInLegend: true
                }
            },
            series: <?php echo $pacientes_mes_pasado; ?>
        });
         });
</script>

