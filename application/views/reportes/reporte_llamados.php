<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>

<div class="row">
    <div class="col-md-12">              
        <div class="widget">
            <div class="row">
                <div class="col-md-8">
                    <div id ="tiempos_respuesta"> </div>
                </div>
                <div class="col-md-4">
                    <div id ="tiempos_vendedor"> </div>
                </div>
            </div>
        </div>
    </div>
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
        </div>
    </div>
    <div class="col-md-12">              
        <div class="widget">
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
    <div class="col-md-12">              
        <div class="widget">
            <div class="row">
                <div class="col-md-12">
                    <div id ="correccion_entrega_por_establecimiento"> </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    var ranges = <?php echo $rangos_tiempo_llamados; ?>;
    var averages = <?php echo $promedio_tiempo_llamados; ?>;
	
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

        $('#tiempos_respuesta').highcharts({
            title: {
                text: 'Tiempos Respuesta'
            },

            xAxis: {
                type: 'date',
                tickInterval: 30 * 24 * 3600 * 1000,
            },

            yAxis: {
                title: {
                    text: 'Minutos'
                },
                min : 0,
            },

            tooltip: {
                crosshairs: true,
                shared: true,
                valueSuffix: 'Min'
            },

            legend: {
                enabled:true,
            },

            series: [{
                name: 'Promedio',
                data: averages,
                zIndex: 1,
                marker: {
                    fillColor: 'white',
                    lineWidth: 2,
                    lineColor: Highcharts.getOptions().colors[0]
                }
            }, {
                name: 'Rango',
                data: ranges,
                type: 'arearange',
                lineWidth: 0,
                linkedTo: ':previous',
                color: Highcharts.getOptions().colors[0],
                fillOpacity: 0.3,
                zIndex: 0,
                marker: {
                    enabled: true
                }
            }]
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
        Highcharts.chart('correccion_entrega_por_establecimiento', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Correccion entrega por establecimiento general '
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
            series: <?php echo $pacientes_correccion_entrega_establecimiento; ?>
        });
        

        Highcharts.chart('tiempos_vendedor', {
            title: {
                text: 'Tiempo llamados por profesional'
            },
            xAxis: {
                categories: <?php echo $nombres_profesionales_llamados; ?>
            },
            yAxis: {
                title: {
                    text: 'Minutos'
                }
            },
            labels: {
                items: [{
                    style: {
                        left: '50px',
                        top: '18px',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
                    }
                }]
            },
            series: [{
                type: 'column',
                name: 'Mínimo',
                data: <?php echo $min_profesionales_llamados; ?>
            }, {
                type: 'column',
                name: 'Máximo',
                data: <?php echo $max_profesionales_llamados; ?>
            }, {
                type: 'spline',
                name: 'promedio',
                data: <?php echo $promedio_profesionales_llamados; ?>,
            }]
        });
    });
</script>

