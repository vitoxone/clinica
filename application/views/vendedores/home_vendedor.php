<div id="wrapper" ng-app="myApp">
 <div id="page-wrapper" ng-controller="VentasController as vm">
    <div class="page-head">
        <h2 class="pull-left"><i class="icon-file-alt"></i> Home vendedor</h2>
        <div class="bread-crumb pull-right">
          <a href="index.html"><i class="icon-home"></i> Home</a> 
          <span class="divider">/</span> 
          <a href="#" class="bread-current">Mis ventas</a>
        </div>
        <div class="clearfix"></div>
   </div>
    </br>
        <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-8">
        <ul class="today-datas">
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
                  <div class="pull-left">Listado de ventas</div>
                  <div class="widget-icons pull-right">
                    <span><span class="label label-primary">{{vm.ventas.length}}</span></span>
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
                        <th ng-click="vm.ordenarTabla('id_paciente_vendedor')">CÓDIGO VENTA
                          <span class="glyphicon sort-icon" ng-show="vm.sortKey=='id_paciente_vendedor'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                        </th>
                        <th ng-click="vm.ordenarTabla('rut_paciente')">RUT PACIENTE
                          <span class="glyphicon sort-icon" ng-show="vm.sortKey=='rut_paciente'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                        </th>
                        <th class="text-center" ng-click="vm.ordenarTabla('nombre_paciente')">NOMBRE PACIENTE
                          <span class="glyphicon sort-icon" ng-show="vm.sortKey=='nombre_paciente'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                        </th>
                        <th class="text-center" ng-click="vm.ordenarTabla('email_paciente')">EMAIL
                          <span class="glyphicon sort-icon" ng-show="vm.sortKey=='email_paciente'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                        </th>
                        <th class="text-center" ng-click="vm.ordenarTabla('contigo')">¿CONTIGO?
                          <span class="glyphicon sort-icon" ng-show="vm.sortKey=='contigo'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                        </th>
                        <th class="text-center" ng-click="vm.ordenarTabla('domiciliario')">¿PAD?
                          <span class="glyphicon sort-icon" ng-show="vm.sortKey=='domiciliario'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                        </th>
                        <th class="text-center" ng-click="vm.ordenarTabla('domiciliario')">FECHA
                          <span class="glyphicon sort-icon" ng-show="vm.sortKey=='domiciliario'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr dir-paginate="venta in vm.ventas|orderBy:vm.sortKey:vm.reverse|filter:vm.search|itemsPerPage:vm.itemsMostrar">
                        <td>{{venta.id_paciente_vendedor}}</td>
                        <td>{{venta.rut_paciente}}</td>
                        <td style="text-transform:uppercase"> {{venta.nombres_paciente}}</td>
                        <td>{{venta.email_paciente}}</td>
                        <td class="text-center"><span ng-if="venta.contigo == 1" class="label label-success">Si</span><span ng-if="venta.contigo == 0" class="label label-danger">No</span></td>
                        <td class="text-center"><span ng-if="venta.domiciliario == 1" class="label label-success">Si</span><span ng-if="venta.domiciliario == 0" class="label label-danger">No</span></td>                      
                        <td>{{venta.fecha_venta}}</td>
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
             <highchart id="chart1" config="vm.chartConfig"></highchart>
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
  </div>
  <div id="modal-insumo" class="modal fade" tabindex='9000'>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header-convatec convatec-bgcolor-1">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                Detalle insumo
            </div>         
          <div class="modal-body">                            
            <form class="form-horizontal" name="userForm" novalidate>
              <div class="col-md-6">  
                <div class="row">                    
                  <div class="form-group">
                    <label class="control-label col-lg-4" >SAP</label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" ng-model="vm.insumo_selected.sap" disabled/>

                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="well">
                  <h2>{{vm.insumo_selected.stock_unitario}}</h2>
                  <p>Stock unitario</p><span ng-if="vm.insumo_selected.activo == 1" class="label label-success">Activo</span><span ng-if="vm.insumo_selected.activo == 0" class="label label-danger">Inactivo</span>
                  <input class="btn btn-warning btn-lg"  type="button" value="Solicitar" ng-click="vm.solicitar_insumo = true"/>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">  
                  <div class="row"> 
                    <div class="form-group">
                      <label class="control-label col-lg-4" for="title">ICC</label>
                      <div class="col-lg-8">
                      <input type="text" class="form-control" ng-model="vm.insumo_selected.icc" disabled/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">  
                  <div class="row"> 
                    <div class="form-group">
                      <label class="control-label col-lg-4" for="content">LINEA</label>
                      <div class="col-lg-8">
                        <div class="input-group">
                        <input type="text" class="form-control" ng-model="vm.insumo_selected.linea" disabled/>
                        </div>
                      </div>
                    </div> 
                  </div> 
                </div>
              </div> 
              <div class="col-md-12">                          
                <div class="form-group">
                    <label class="control-label col-lg-5">DESCRIPCIÓN SAP</label>
                    <div class="col-lg-7">
                      <div class="input-group"> 
                        <textarea  class="form-control textarea" style="text-transform: uppercase; margin: 0px; width: 410px; height: 53px;" disabled>{{vm.insumo_selected.descripcion_sap}}</textarea>                       
                      </div>
                    </div>
                </div>
              </div>
              <div class="col-md-12"> 
                <div class="form-group">
                    <label class="control-label col-lg-5">MATERIAL</label>
                    <div class="col-lg-7">
                      <div class="input-group"> 
                          <textarea  class="form-control textarea"style="text-transform: uppercase; margin: 0px; width: 410px; height: 53px;" disabled>{{vm.insumo_selected.material}}</textarea>                        
                      </div>
                    </div>
                </div>
              </div>
              <hr>
              <div class="col-md-12">
                <div class="col-md-6">  
                  <div class="row"> 
                    <div class="form-group">
                      <label class="control-label col-lg-4" for="title">COMPOSICIÓN</label>
                      <div class="col-lg-7">
                        <input type="text" class="form-control" ng-model="vm.insumo_selected.composicion" disabled/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">  
                  <div class="row"> 
                    <div class="form-group">
                      <label class="control-label col-lg-4" for="content">UNIDAD MEDIDA</label>
                      <div class="col-lg-7">
                        <div class="input-group">
                          <input type="text" class="form-control" ng-model="vm.insumo_selected.unidad_medida" disabled>
                        </div>
                      </div>
                    </div> 
                  </div> 
                </div>
              </div> 

              <div ng-show="vm.solicitar_insumo" class="col-md-12">
                <h3>Solicitud de insumo</h3>
                <hr>
                <div class="col-md-6">  
                  <div class="row"> 
                    <div class="form-group">
                      <label class="control-label col-lg-4" for="title">Cantidad solicitar</label>
                      <div class="col-lg-7">
                      <input type="number" class="form-control" ng-model="vm.insumo_selected.cantidad_solicitar"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">  
                  <div class="row"> 
                    <div class="form-group">
                      <div class="col-lg-12">
                        <div class="input-group">
                         <input class="btn btn-success btn-lg"  type="button" value="Enviar solicitud" ng-click="vm.solicitar_insumo(vm.insumo_selected)"/>
                        </div>
                      </div>
                    </div> 
                  </div> 
                </div>
              </div>
            </form>
            <br/>
            <br/>
            <br/>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
    </div><!-- fin modal programar cita -->
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

        vm.sortKey = false;
        vm.reverse = false;
        vm.itemsMostrar = '7';
        vm.usuario = {};
        vm.mostrar_colores = false;
        vm.ventas = JSON.parse('<?php echo $ventas; ?>');
        vm.nro_ventas_contigo =   '<?php echo $nro_ventas_contigo ?>';
        vm.nro_ventas_domiciliario = '<?php echo $nro_ventas_domiciliario ?>';
        vm.ventas_mensuales = JSON.parse('<?php echo $ventas_mensuales; ?>');
       // transformar_entero();

        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }

      vm.ordenarTabla         = ordenarTabla;
      vm.guardar_usuario      = guardar_usuario;
      vm.validar_formulario   = validar_formulario;
      vm.activar_colores      = activar_colores;
      vm.mostrar_modal        = mostrar_modal;
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

    function mostrar_modal(insumo){
      vm.insumo_selected = insumo;
      $('#modal-insumo').appendTo("body").modal('show');
    }

      function activar_colores(especialidad){
        if(especialidad.nombre == 'Enfermera Clínica' || especialidad.nombre == 'Enfermera PAD' || especialidad.nombre == 'Técnico enfermería' || especialidad.nombre == 'Enfermera coordinadora técnica CMC'){
          vm.mostrar_colores = true;
        }else{
          vm.mostrar_colores = false;
        }
      }

    function validar_formulario(userForm){
      var error =false;

      // if(userForm.rut.$invalid){
      //   userForm.rut.$touched = true;
      //   error = true;
      //   console.log(userForm.rut.$error);
      // }
      // if(userForm.especialidad.$invalid){
      //   userForm.especialidad.$touched = true;
      //   error = true;
      // }
      // if(userForm.nombres.$invalid){
      //   userForm.nombres.$touched = true;
      //   error = true;
      // }
      // if(userForm.apellido_paterno.$invalid){
      //   userForm.apellido_paterno.$touched = true;
      //   error = true;
      // }
      // if(userForm.nombre_usuario.$invalid){
      //   userForm.nombre_usuario.$touched = true;
      //   error = true;
      // }
      // if(userForm.email.$invalid){
      //   userForm.email.$touched = true;
      //   error = true;
      // }

      if(!error){
        guardar_usuario();
      }

    }
    function ordenarTabla(keyname){
      vm.sortKey = keyname;   //set the sortKey to the param passed
      vm.reverse = !vm.reverse; //if true make it false and vice versa
    }


    function guardar_usuario(){
          var data = $.param({
          usuario: vm.usuario
      });

      $http.post('<?php echo base_url(); ?>usuarios/update_usuario', data, config)
          .then(function(response){
              if(response.data !== 'false'){
                if(response.data){
                 console.log(response.data);
                 // window.location ='<?php echo base_url(); ?>usuarios/listado_usuarios/';

                }
              }
          },
          function(response){
              console.log("error al guardar stock.");
          }
      );
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

    }
})();

</script> 
