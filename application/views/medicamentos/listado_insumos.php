          
<div id="wrapper" ng-app="myApp">
 <div id="page-wrapper" ng-controller="InsumosController as vm">
    <div class="col-md-12">
        <div class="row">
          <div class="col-md-2">
              <a type="button" class="btn btn-success">Nuevo Insumo</a>
          </div>
        </div>
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Listado de insumos</div>
            <div class="widget-icons pull-right">
              <span><span class="label label-primary">{{vm.insumos.length}}</span>  Insumos</span>
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
                            <input type="text" ng-model="vm.search" class="form-control" placeholder="Sap / Icc / Linea / Familia ...">
                          </div>
                        </div>
                      </div>
                  </div>
                </form>
              </div>
            <table class="table table-striped table-bordered table-hover">
              <thead ng-show="vm.tipo_dispositivo == 'movil'">
                <tr>
                  <th ng-click="vm.ordenarTabla('sap')">SAP
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='sap'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                  <th ng-show="vm.tipo_dispositivo != 'movil'" ng-click="vm.ordenarTabla('icc')">ICC
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='icc'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                  <th ng-show="vm.tipo_dispositivo != 'movil'" class="text-center" ng-click="vm.ordenarTabla('linea')">LINEA
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='linea'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                  <th ng-show="vm.tipo_dispositivo != 'movil'" class="text-center" ng-click="vm.ordenarTabla('familia')">FAMILIA
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='familia'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                  <th class="text-center" ng-click="vm.ordenarTabla('descripcion_sap')">DESC.SAP
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='descripcion_sap'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                  <th ng-show="vm.tipo_dispositivo != 'movil'" class="text-center" ng-click="vm.ordenarTabla('material')">MATERIAL
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='material'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                  <th class="text-center" ng-click="vm.ordenarTabla('composicion')">COMP.
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='composicion'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                  <th class="text-center" ng-click="vm.ordenarTabla('unidad_medida')">U/M
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='unidad_medida'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                  <th class="text-center" ng-click="vm.ordenarTabla('stock_unitario')">CANTIDAD UNITARIA
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='stock_unitario'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                  <th class="text-center" ng-click="vm.ordenarTabla('stock_unitario')">
                  </th>
                </tr>
              </thead>
              <thead ng-show="vm.tipo_dispositivo != 'movil'">
                <tr>
                  <th ng-click="vm.ordenarTabla('sap')">SAP
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='sap'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                  <th ng-click="vm.ordenarTabla('icc')">ICC
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='icc'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                  <th  class="text-center" ng-click="vm.ordenarTabla('linea')">LINEA
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='linea'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                  <th  class="text-center" ng-click="vm.ordenarTabla('familia')">FAMILIA
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='familia'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                  <th class="text-center" ng-click="vm.ordenarTabla('descripcion_sap')">DESCRIPCIONSAP
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='descripcion_sap'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                  <th  class="text-center" ng-click="vm.ordenarTabla('material')">MATERIAL
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='material'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                  <th class="text-center" ng-click="vm.ordenarTabla('composicion')">COMPOSICIÓN
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='composicion'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                  <th class="text-center" ng-click="vm.ordenarTabla('unidad_medida')">UNIDAD MEDIDA
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='unidad_medida'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                  <th class="text-center" ng-click="vm.ordenarTabla('stock_unitario')">CANTIDAD UNITARIA
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='stock_unitario'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                  <th class="text-center" ng-click="vm.ordenarTabla('stock_unitario')">ACTIVO
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr dir-paginate="insumo in vm.insumos|orderBy:vm.sortKey:vm.reverse|filter:vm.search|itemsPerPage:vm.itemsMostrar">

                  <td>{{insumo.sap}}</td>
                  <td ng-show="vm.tipo_dispositivo != 'movil'">{{insumo.icc}}</td>
                  <td ng-show="vm.tipo_dispositivo != 'movil'">{{insumo.linea}}</td>
                  <td ng-show="vm.tipo_dispositivo != 'movil'" >{{insumo.familia}}</td>
                  <td ng-show="vm.tipo_dispositivo != 'movil'">{{insumo.descripcion_sap}}</td>
                  <td>{{insumo.material}}</td>
                  <td>{{insumo.composicion}}</td>
                  <td>{{insumo.unidad_medida}}</td>
                  <td>
                    <div class="input-group"> 
                     <input type="number" ng-model="insumo.stock_unitario" class="form-control" style="width:50%" />
                      
                      <span ng-click="vm.guardar_stock(insumo)" class="btn btn-xs btn-success"><i class="icon-ok"></i></span>
                      <span ng-click="vm.fechaNacimiento()" class="btn btn-xs btn-danger"><i class="icon-remove"></i></span>
                    </div>         
                  </td>
                  <td>
                    <div class="input-group"> 

                     <input ng-model="insumo.activo" ng-click="vm.activar_insumo(insumo)" type="checkbox">

                    </div>          
                  </td>
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
    </div>
  </div>
  <script src="<?php echo base_url(); ?>assets/js/bootstrap-select.js" type="text/javascript"></script>      
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/angular.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/angular-touch.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/angular-animate.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/ui-bootstrap-2.2.0.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/ui-bootstrap-tpls-2.2.0.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/angular-bootstrap-multiselect.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/movil.js"></script>

  <script src="<?php echo base_url(); ?>assets/js/angular-flash.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery.prettyPhoto.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/dirPagination.js"></script>
<script>
(function(){
    'use strict';
    angular.module('myApp', ['ui.bootstrap', 'ui.multiselect', 'ngAnimate','angularUtils.directives.dirPagination']);
    angular.module('myApp').controller('InsumosController', InsumosController);


    InsumosController.$inject = ['$http', '$timeout'];
    function InsumosController($http){
        var vm = this;

        vm.sortKey = false;
        vm.reverse = false;
        vm.itemsMostrar = '20';
        vm.tipo_dispositivo = false;

        vm.insumos = JSON.parse('<?php echo $insumos; ?>');

        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }

      deteccion();

      vm.ordenarTabla      = ordenarTabla;
      vm.guardar_stock     = guardar_stock;
      vm.activar_insumo    = activar_insumo;


    function ordenarTabla(keyname){
      vm.sortKey = keyname;   //set the sortKey to the param passed
      vm.reverse = !vm.reverse; //if true make it false and vice versa
    }

    function guardar_stock(insumo){
          var data = $.param({
          insumo: insumo
      });

      $http.post('<?php echo base_url(); ?>medicamentos/update_stock_insumo', data, config)
          .then(function(response){
              if(response.data !== 'false'){
              }
          },
          function(response){
              console.log("error al guardar stock.");
          }
      );
     }
     function deteccion(){
      if(navigator.platform == 'iPad' || navigator.platform == 'iPhone' || navigator.platform == 'iPod')
      { 
        vm.tipo_dispositivo = 'movil';
      }
    }

    function activar_insumo(insumo){
          var data = $.param({
          insumo: insumo
      });

      $http.post('<?php echo base_url(); ?>medicamentos/activar_insumo', data, config)
          .then(function(response){
              if(response.data !== 'false'){
                console.log(response.data);
              }
          },
          function(response){
              console.log("error al guardar stock.");
          }
      );
     }
    }
})();

</script> 
