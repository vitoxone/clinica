<div id="wrapper" ng-app="myApp">
 <div id="page-wrapper" ng-controller="VentasController as vm">
    <div class="page-head">
        <h2 class="pull-left"><i class="icon-file-alt"></i> Home gerente</h2>
        <div class="bread-crumb pull-right">
          <a href="index.html"><i class="icon-home"></i> Home</a> 
          <span class="divider">/</span> 
          <a href="#" class="bread-current">Mis ventas</a>
        </div>
        <div class="clearfix"></div>
   </div>
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-8">
        <ul class="today-datas">
          <li>
            <div>
              <span id="todayspark1" class="spark">                  
                <div class="dashboard-info-card-data">
                  <div class="dashboard-info-card-bubble"><i class="icon-user"></i></div>
                    <div class="dashboard-info-card-data-title">
                      {{vm.vendedores.length}}
                    </div>
                </div>
              </span>
            </div>
            <div class="datas-text">Nº Vendedores</div>
          </li>
          <li>
            <div>
              <span id="todayspark2" class="spark">
                <div class="dashboard-info-card-data">
                  <div class="dashboard-info-card-bubble"><i class="icon-money"></i></div>
                    <div class="dashboard-info-card-data-title">
                      {{vm.ventas.length}}
                    </div>
                </div>
              </span>
            </div>
            <div class="datas-text">Nº total ventas</div>
          </li>
          <li>
            <div>
              <span id="todayspark3" class="spark">                  
                <div class="dashboard-info-card-data">
                  <div class="dashboard-info-card-bubble"><div class="col-lg-4" style="width: 50px; height: 30px; background-image: url('<?php echo base_url(); ?>assets/img/contigo_white.png');"></div></div>
                  <div class="dashboard-info-card-data-title">
                    {{vm.nro_ventas_contigo}}
                </div>
                </div>
              </span>
            </div>
            <div class="datas-text">Nº total contigo</div>
          </li>
          <li>
            <div>
              <span id="todayspark4" class="spark">                  
                <div class="dashboard-info-card-data">
                  <div class="dashboard-info-card-bubble"><div class="col-lg-4" style="width: 50px; height: 30px; background-image: url('<?php echo base_url(); ?>assets/img/PAD_white.png');"></div></div>
                  <div class="dashboard-info-card-data-title">
                    {{vm.nro_ventas_domiciliario}}
                </div>
                </div>
              </span>
            </div>
            <div class="datas-text">Nº total domiciliario</div>
          </li>                                                                                                               
        </ul>
      </div>
        <div class="col-md-2"></div>
      </div>
        <div class="row">
          <div class="col-md-2">
              <a href="<?php echo base_url()."pacientes/nuevo_paciente"?>" type="button" class="btn btn-success">Nueva venta</a>
          </div>
        </div>
      <div class="container">                         
          <div class="row">
            <div class="col-md-8">            
              <div class="widget">
                <div class="widget-head">
                  <div class="pull-left">Listado zonas</div>
                  <div class="widget-icons pull-right">
                    <span><span class="label label-primary">{{vm.zona_supervisor.vendedores.length}}</span></span>
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="widget-foot">          
                    <form class="form-inline">
                        <div class="form-group">
                            <div id="hoverdata">
                              <div class="row">
                                <div class="col-lg-2 ">
                                  <label>Mostrar</label>
                                </div>
                                <div  class="col-lg-3">
                                  <select class="form-control" ng-model="vm.itemsMostrar" title="Seleccione número" data-live-search="false">
                                      <option ng-value"10">10</option>
                                      <option ng-value"25">25</option>
                                      <option ng-value"50">50</option>
                                  </select>
                                </div>
                                <div class="col-lg-2">
                                  <label >Buscar</label>
                                </div>
                                <div class="col-lg-5">
                                  <input type="text" ng-model="vm.search" class="form-control" placeholder="Nombre / Rut / Pasaporte">
                                </div>
                              </div>
                            </div>
                        </div>
                      </form>
                    </div>
                  <table class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th ng-click="vm.ordenarTabla('nombre_vendedor')">ZONA
                          <span class="glyphicon sort-icon" ng-show="vm.sortKey=='nombre_vendedor'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr dir-paginate="zona in vm.zonas_vendedor|orderBy:vm.sortKey:vm.reverse|filter:vm.search|itemsPerPage:vm.itemsMostrar">
                        <td> <a  style="text-transform:uppercase" ng-href="<?php echo base_url(); ?>/vendedores/home_vendedor/{{zona.id_supervisor_zona}}"</a>{{zona.nombre}}</td>
                      </tr>
                    </tbody>
                  </table>
                  <dir-pagination-controls
                    max-size="5"
                    direction-links="true"
                    boundary-links="true" >
                  </dir-pagination-controls>
                </div>
            </div>             
          </div>
          <div class="col-md-4">
            <div class="widget">
              <div class="widget-head">
                <div class="pull-left">Ventas Objetadas</div>
                  <div class="widget-icons pull-right">
                </div>  
              <div class="clearfix"></div>
            </div>             
          <div class="widget-content">
            <div class="padd">

              <!-- Visitors, pageview, bounce rate, etc., Sparklines plugin used -->
              <ul class="current-status">
                <li>
                  <span id="status1"></span> <span class="bold">No existen ventas objetadas</span>
                </li>                                                                                                            
              </ul>
            </div>
          </div>
        </div>
      </div> 
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Resumen general por mes</div>
            <div class="widget-icons pull-right">
            </div>  
            <div class="clearfix"></div>
          </div>             
          <div class="widget-content">
            <div class="padd">
              <highchart id="chart1" config="vm.chartConfig"></highchart>
            </div>
          </div>
        </div>
      </div>
     </div>
     <div class="row"> 
      <div class="col-md-8">
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Resumen general por zona</div>
            <div class="widget-icons pull-right">
            </div>  
            <div class="clearfix"></div>
          </div>             
          <div class="widget-content">
            <div class="padd">
              <highchart id="chart2" config="vm.chartConfig2"></highchart>
            </div>
          </div>
        </div>
      </div>
    </div> 
  </div>
</div>
</div>

  <script src="<?php echo base_url(); ?>assets/js/bootstrap-select.js" type="text/javascript"></script>      
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/angular.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/angular-touch.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/angular-animate.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/ui-bootstrap-2.2.0.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/ui-bootstrap-tpls-2.2.0.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/angular-bootstrap-multiselect.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/angular-minicolors.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.minicolors.js"></script>

  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.0/angular-messages.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/rut.js"></script>

  <link href="<?php echo base_url(); ?>assets/css/jquery.minicolors.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
  , 
  <script src="<?php echo base_url(); ?>assets/js/angular-flash.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery.prettyPhoto.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/dirPagination.js"></script>
  <script src="https://code.highcharts.com/stock/highstock.src.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/highcharts-ng.js"></script>
<script>
(function(){
    'use strict';
    angular.module('myApp', ['ui.bootstrap', 'ui.multiselect', 'ngAnimate','angularUtils.directives.dirPagination','minicolors','ngMessages', 'platanus.rut', 'highcharts-ng']);
    angular.module('myApp').controller('VentasController', VentasController);


    VentasController.$inject = ['$http', '$timeout','minicolors'];
    function VentasController($http){
        var vm = this;

        vm.itemsMostrar = '7';
        vm.usuario = {};
        vm.ventas = JSON.parse('<?php echo $ventas; ?>');
        vm.ventas_mensuales = JSON.parse('<?php echo $ventas_mensuales; ?>');
        vm.nro_ventas_contigo =   '<?php echo $nro_ventas_contigo ?>';
        vm.nro_ventas_domiciliario = '<?php echo $nro_ventas_domiciliario ?>';
        vm.vendedores = JSON.parse('<?php echo $vendedores; ?>');
        vm.ventas_totales_por_zona = JSON.parse('<?php echo $ventas_totales_por_zona; ?>');
        vm.zonas_vendedor = JSON.parse('<?php echo $zonas_vendedor; ?>');
        
       // transformar_entero();

        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }

      //vm.usuario.color = '#dfdfdf';
      vm.customSettings = {
        control: 'brightness',
        theme: 'bootstrap',
        position: 'top left'
      };

      function transformar_entero(){
        for(var i=0; i<vm.ventas_mensuales.length; i++){
          vm.ventas_mensuales.y = parseInt(vm.ventas_mensuales.y);
        }
      }


  vm.chartSeries = vm.ventas_mensuales;


  vm.chartConfig = {

    chart: {
      type: 'column'
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total ventas por mes'
        },
        tickInterval: 1,

    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:1f}'
            }
        }
    },
    series: vm.chartSeries,
    title: {
      text: 'Distribución mensual de ventas'
    }
  }

  vm.chartSeries2 = vm.ventas_totales_por_zona;


  vm.chartConfig2 = {

    chart: {
      type: 'column'
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total ventas por vendedor'
        },
        tickInterval: 1,

    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:1f}'
            }
        }
    },
    series: vm.chartSeries2,
    title: {
      text: 'Distribución de ventas'
    }
  }

    }
})();

</script> 
