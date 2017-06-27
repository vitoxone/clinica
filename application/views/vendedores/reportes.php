<meta http-equiv=\"Content-Type\" content=\"text/html;charset=utf-8\">
<div id="wrapper" ng-app="myApp">
 <div id="page-wrapper" ng-controller="VentasController as vm">
    <div class="page-head">
        <h2 class="pull-left"><i class="icon-file-alt"></i> Reportes de ventas</h2>
        <div class="bread-crumb pull-right">
          <a href="index.html"><i class="icon-home"></i> Home</a> 
          <span class="divider">/</span> 
          <a href="#" class="bread-current">Mis ventas</a>
        </div>
        <div class="clearfix"></div>
   </div>
    <div class="row">
      <div hidden>
        <div class="col-md-12">
              <h2 class="reporte">Este reporte entrega el detalle de ventas por periodo de tiempo y tipo.</h2>
              <div class="clearfix"></div>
              <h4 class="reporte-select">Seleccionar fecha para exportar reporte:</h4>
        </div>
        <div hidden class="row">
          <div class="col-md-12">
              <div class="col-md-1">
                <button class="btn btn-primary btn-xs" ng-click="vm.abrirModalCita()" style="width: 100px;">
                 Julio 2016
               </button>
              </div>
              <div class="col-md-1">
                <button class="btn btn-primary btn-xs" ng-click="vm.abrirModalCita()" style="width: 100px;">
                  Agosto 2016
                </button>
              </div>  
              <div class="col-md-1">
                <button class="btn btn-primary btn-xs" ng-click="vm.abrirModalCita()" style="width: 100px;">
                 Septiembre 2016
               </button>
              </div>
              <div class="col-md-1">
                <button class="btn btn-primary btn-xs" ng-click="vm.abrirModalCita()" style="width: 100px;">
                 Octubre 2016
               </button>
              </div>
              <div class="col-md-1">
                <button class="btn btn-primary btn-xs" ng-click="vm.abrirModalCita()" style="width: 100px;">
                 Noviembre 2016
               </button>
              </div>
              <div class="col-md-1">
                <button class="btn btn-primary btn-xs" ng-click="vm.abrirModalCita()" style="width: 100px;">
                 Diciembre 2016
               </button>
              </div>
          </div>
        </div>
        <div class="clearfix"></div> 
        <div hidden class="row">
          <div class="col-md-12">
            <div class="col-md-1">
              <button class="btn btn-primary btn-xs" ng-click="vm.abrirModalCita()" style="width: 100px;">
               Enero 2017
             </button>
            </div>
            <div class="col-md-1">
              <button class="btn btn-primary btn-xs" ng-click="vm.abrirModalCita()" style="width: 100px;">
               Febrero 2017
             </button>
            </div>
            <div class="col-md-1">
              <button class="btn btn-primary btn-xs" ng-click="vm.abrirModalCita()" style="width: 100px;">
               Marzo 2017
             </button>
            </div>
            <div class="col-md-1">
              <button class="btn btn-primary btn-xs" ng-click="vm.abrirModalCita()" style="width: 100px;">
               Abril 2017
             </button>
            </div>
            <div class="col-md-1">
              <button class="btn btn-primary btn-xs" ng-click="vm.abrirModalCita()" style="width: 100px;">
               Mayo 2017
             </button>
            </div>
            <div class="col-md-1">
              <button class="btn btn-primary btn-xs" ng-click="vm.abrirModalCita()" style="width: 100px;">
               Junio 2017
             </button>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
          <div class="col-md-12">
                <h4 class="reporte-select">Seleccionar fecha para exportar reporte:</h4>
          </div>
        <div class="row" style="border-bottom: 2px solid #aaa;height: 40px;margin-bottom: 25px;">
          <div class="col-md-12">
            <div class="col-md-2">
              <button class="btn btn-primary btn-xs" ng-click="vm.abrirModalCita()" style="width: 150px;">
               Trimestre 3 (2016)
             </button>
            </div>
            <div class="col-md-2">
              <button class="btn btn-primary btn-xs" ng-click="vm.abrirModalCita()" style="width: 150px;">
               Trimestre 1 (2017)
             </button>
            </div>
            <div class="col-md-2">
              <button class="btn btn-primary btn-xs" ng-click="vm.abrirModalCita()" style="width: 150px;">
               Trimestre 2 (2017)
             </button>
            </div>
            <div class="col-md-2">
              <button class="btn btn-primary btn-xs" ng-click="vm.abrirModalCita()" style="width: 150px;">
               Trimestre 3 (2017)
             </button>
            </div>
          </div>
        </div>
      </div>
      <br>
      <div class="container">                       
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-4">                
                <div class="form-group">
                  <label class="control-label col-lg-4">Fecha inicio</label>    
                  <div class="col-lg-8" >           
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-calendar"></i></span>
                        <input class="form-control"
                           placeholder="Fecha de inicio"
                           moment-picker="fecha_inicio"
                           locale="es"
                           format="DD MMM YYYY" 
                           today="true"
                           max-date ="vm.now"
                           ng-model="vm.reporte.fecha_inicio"
                           ng-model-options="{ updateOn: 'blur' }">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">                
                <div class="form-group">
                  <label class="control-label col-lg-4">Fecha fin</label>    
                  <div class="col-lg-8" >           
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-calendar"></i></span>
                        <input class="form-control"
                           placeholder="Fecha inicio"
                           moment-picker="fecha_fin"
                           locale="es"
                           format="DD MMM YYYY" 
                           today="true"
                           max-date ="vm.now"
                           ng-model="vm.reporte.fecha_fin"
                           ng-model-options="{ updateOn: 'blur' }">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="col-md-5">                    
                  <div class="form-group">
                    <div class="col-lg-4" style="width: 50px; height: 30px; background-image: url('<?php echo base_url(); ?>assets/img/contigo.png');"></div>
                    <div class="col-lg-6">                               
                        <div class="toggle-button">
                            <input ng-model="vm.reporte.contigo" class="form-control" type="checkbox">
                        </div> 
                    </div>
                  </div>
                </div>
                <div class="col-md-5">    
                  <div class="form-group">
                  <div class="col-lg-4" style="width: 50px; height: 30px; background-image: url('<?php echo base_url(); ?>assets/img/PAD.png');"></div>
                    <div class="col-lg-6">                               
                        <div class="toggle-button">
                            <input ng-model="vm.reporte.domiciliario" class="form-control" type="checkbox">
                        </div> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row"> 
            <div class="col-md-12">
              <div class="col-md-4">                    
                <div class="form-group">
                  <label class="col-lg-4">Tipo</label>
                  <div class="col-lg-8">
                  <select class="form-control" ng-model="vm.reporte.tipo">
                    <option value="1">Por vendedor</option>
                    <option value="2">Por paciente</option>
                  </select> 
                  </div>
                </div>
              </div>
<!--               <div class="col-md-4">                    
                <div class="form-group">
                  <label class="col-lg-4">Zonas</label>
                  <div class="col-lg-8"> 
                      <select class="form-control"  ng-model="vm.reporte.zona">
                        <option value="todas">Todas</option>
                        <option value="1">Zona norte</option>
                        <option value="2">Zona sur</option>
                      </select>   
                  </div>
                </div>
              </div> -->
              <div class="col-md-4">                    
                <div class="form-group">
                  <label class="col-lg-4">Vendedores</label>
                  <div class="col-lg-8">
                      <multiselect ng-model="vm.reporte.vendedor" name="vendedor" options="vendedor.nombre for vendedor in vm.vendedores" data-multiple="true" filter-after-rows="5" min-width="500" tabindex="-1" scroll-after-rows="5"></multiselect>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <br>
          <div class="row">       
            <div class="col-md-12 col-lg-offset-10">  
              <input class="btn btn-success btn-lg"  type="button" value="Buscar" ng-click="vm.cargar_reporte()"/>
            </div>
          </div>
            <div class="col-md-12">            
              <div class="widget" ng-show="vm.reportes_por_vendedores.length > 0">
                <div class="widget-head">
                  <div class="pull-left">Reporte por vendedores</div>
                  <div class="widget-icons pull-right">
                    <span><span class="label label-primary">{{vm.reportes_por_vendedores.length}}</span></span>
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
                        <th ng-click="vm.ordenarTabla('rut')">RUT
                          <span class="glyphicon sort-icon" ng-show="vm.sortKey=='nombre_vendedor'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                        </th>
                        <th ng-click="vm.ordenarTabla('rut')">VENDEDOR
                          <span class="glyphicon sort-icon" ng-show="vm.sortKey=='nombre_vendedor'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                        </th>
                        <th ng-click="vm.ordenarTabla('rut')">CANTIDAD VENTAS
                          <span class="glyphicon sort-icon" ng-show="vm.sortKey=='nombre_vendedor'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr dir-paginate="vendedor in vm.reportes_por_vendedores|orderBy:vm.sortKey:vm.reverse|filter:vm.search|itemsPerPage:vm.itemsMostrar">
                        <td>{{vendedor.rut}}</td>
                        <td>{{vendedor.nombre_vendedor}}</td>
                        <td>{{vendedor.cantidad_ventas}}</td>
                      </tr>
                    </tbody>
                  </table>
                  <div hidden id="tabla_pacientes">
                    <table  class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>RUT</th>
                          <th>VENDEDOR</th>
                          <th>CANTIDAD VENTAS</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="vendedor in vm.reportes_por_vendedores">
                          <td>{{vendedor.rut}}</td>
                          <td>{{vendedor.nombre_vendedor}}</td>
                          <td>{{vendedor.cantidad_ventas}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <dir-pagination-controls
                    max-size="5"
                    direction-links="true"
                    boundary-links="true" >
                  </dir-pagination-controls>
                </div>
              <button class="btn btn-warning pull-right" btn-lg ng-click="vm.exportar_tabla('tabla_pacientes')">Exportar a excel</button> 
            </div>
            <div class="widget" ng-show="vm.reportes_por_pacientes.length > 0">
                <div class="widget-head">
                  <div class="pull-left">Reporte por pacientes</div>
                  <div class="widget-icons pull-right">
                    <span><span class="label label-primary">{{vm.reportes_por_pacientes.length}}</span></span>
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
                        <th ng-click="vm.ordenarTabla('nombre_vendedor')">RUT PACIENTE
                          <span class="glyphicon sort-icon" ng-show="vm.sortKey=='nombre_vendedor'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                        </th>
                        <th ng-click="vm.ordenarTabla('nombre_vendedor')">NOMBRE PACIENTE
                          <span class="glyphicon sort-icon" ng-show="vm.sortKey=='nombre_vendedor'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                        </th>
                        <th ng-click="vm.ordenarTabla('nombre_vendedor')">FECHA REGISTRO
                          <span class="glyphicon sort-icon" ng-show="vm.sortKey=='nombre_vendedor'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                        </th>
                        <th ng-click="vm.ordenarTabla('nombre_vendedor')">VENDEDOR
                          <span class="glyphicon sort-icon" ng-show="vm.sortKey=='nombre_vendedor'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr dir-paginate="paciente in vm.reportes_por_pacientes|orderBy:vm.sortKey:vm.reverse|filter:vm.search|itemsPerPage:vm.itemsMostrar">
                        <td>{{paciente.rut}}</td>
                        <td>{{paciente.nombre}}</td>
                        <td>{{paciente.fecha_registro}}</td>
                        <td>{{paciente.nombre_vendedor}}</td>
                      </tr>
                    </tbody>
                  </table>
                  <div hidden id="tabla_vendedores">
                    <table  class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>RUT PACIENTE</th>
                          <th>NOMBRE PACIENTE</th>
                          <th>FECHA REGISTRO</th>
                          <th>VENDEDOR</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="paciente in vm.reportes_por_pacientes">                          
                          <td>{{paciente.rut}}</td>
                          <td>{{paciente.nombre}}</td>
                          <td>{{paciente.fecha_registro}}</td>
                          <td>{{paciente.nombre_vendedor}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <dir-pagination-controls
                    max-size="5"
                    direction-links="true"
                    boundary-links="true" >
                  </dir-pagination-controls>
                </div>
                <button class="btn btn-warning pull-right" ng-click="vm.exportar_tabla('tabla_vendedores')">Exportar a excel</button> 
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

  <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/plugins/angular_calendar/angular-moment-picker.min.js"></script>
  <link href="<?php echo base_url(); ?>assets/css/jquery.minicolors.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
  <script src="<?php echo base_url(); ?>assets/js/angular-flash.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery.prettyPhoto.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/dirPagination.js"></script>
  <script src="https://code.highcharts.com/stock/highstock.src.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/highcharts-ng.js"></script>
  <link href="<?php echo base_url(); ?>assets/css/angular-moment-picker.min.css" rel="stylesheet">
  <script src="https://rawgithub.com/eligrey/FileSaver.js/master/FileSaver.js" type="text/javascript"></script>

<script>
(function(){
    'use strict';
    angular.module('myApp', ['ui.bootstrap', 'ui.multiselect', 'ngAnimate','angularUtils.directives.dirPagination','minicolors','ngMessages', 'platanus.rut', 'highcharts-ng', 'moment-picker']);
    angular.module('myApp').controller('VentasController', VentasController);


    VentasController.$inject = ['$http', '$timeout','minicolors', '$location'];
    function VentasController($http, $location){
        var vm = this;

        vm.itemsMostrar = '7';
        vm.reporte = {};
       
        vm.vendedores = JSON.parse('<?php echo $vendedores; ?>');
        vm.reporte.vendedor = vm.vendedores;

      moment.locale('es_cl', {
          week : {
            dow : 1,
          }
        });

      moment.locale('es');
      vm.now        = moment();

        vm.popup_fecha_cita = {
                                opened: false
                            };

        vm.cargar_reporte = cargar_reporte;  
        vm.exportar_tabla = exportar_tabla;               
        
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }
    function fechaCita() {
      vm.popup_fecha_cita.opened = true;
    };


    function exportar_tabla(id_tabla) {
        var blob = new Blob([document.getElementById(id_tabla).innerHTML], {
            type: "text/plain;charset=utf-8;"
        });
        saveAs(blob, "Report.xls");
    }

    function cargar_reporte() 
    {
        vm.reporte.fecha_inicio = moment(vm.reporte.fecha_inicio, 'lll').format('DD-MM-YYYY');
        vm.reporte.fecha_fin   = moment(vm.reporte.fecha_fin, 'lll').format('DD-MM-YYYY');

        var data = $.param({
            reporte: vm.reporte
          });
        vm.reportes_por_vendedores = [];
        vm.reportes_por_pacientes = [];

       $http.post('<?php echo base_url(); ?>vendedores/get_reporte', data, config)
        .then(function(response){
          vm.reporte.fecha_inicio = moment(vm.reporte.fecha_inicio);
          vm.reporte.fecha_fin   = moment(vm.reporte.fecha_inicio);

            if(response.data !== 'false'){
              if(vm.reporte.tipo == 1){
                vm.reportes_por_vendedores = response.data;
              }
              if(vm.reporte.tipo == 2){
                vm.reportes_por_pacientes = response.data;
              }              
            }
        },
        function(response)
        {
            console.log("error al obtener comunas.");
        }
      );
    }
    }
})();

</script> 
