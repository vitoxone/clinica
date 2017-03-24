          
<div id="wrapper" ng-app="myApp">
 <div id="page-wrapper" ng-controller="InsumosController as vm">
      <div class="page-head">
        <h2 class="pull-left"><i class="icon-file-alt"></i> Bodega insumos</h2>
        <div class="bread-crumb pull-right">
          <a href="index.html"><i class="icon-home"></i> Home</a> 
          <span class="divider">/</span> 
          <a href="#" class="bread-current">Bodega insumos</a>
        </div>
        <div class="clearfix"></div>
   </div>
    <div class="col-md-12">
    </br>
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
                  <th  ng-show="false" class="text-center" ng-click="vm.ordenarTabla('material')">MATERIAL
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
                <tr  dir-paginate="insumo in vm.insumos|orderBy:vm.sortKey:vm.reverse|filter:vm.search|itemsPerPage:vm.itemsMostrar">

                  <td> <a  style="text-transform:uppercase" ng-click="vm.mostrar_modal(insumo)"</a>{{insumo.sap}}</td>
                  <td ng-show="vm.tipo_dispositivo != 'movil'"><a  style="text-transform:uppercase" ng-click="vm.mostrar_modal(insumo)"</a>{{insumo.icc}}</td>
                  <td ng-show="vm.tipo_dispositivo != 'movil'"><a  style="text-transform:uppercase" ng-click="vm.mostrar_modal(insumo)"</a>{{insumo.linea}}</td>
                  <td ng-show="vm.tipo_dispositivo != 'movil'" ><a  style="text-transform:uppercase" ng-click="vm.mostrar_modal(insumo)"</a>{{insumo.familia}}</td>
                  <td ng-show="vm.tipo_dispositivo != 'movil'"><a  style="text-transform:uppercase" ng-click="vm.mostrar_modal(insumo)"</a>{{insumo.descripcion_sap}}</td>
                  <td ng-show="false">{{insumo.material}}</td>
                  <td>{{insumo.composicion}}</td>
                  <td>{{insumo.unidad_medida}}</td>
                  <td>
                    <div class="input-group"> 
                     <input type="number" ng-model="insumo.stock_unitario" class="form-control" style="width:50%" />
                      <span ng-click="vm.guardar_stock(insumo)" class="btn btn-xs btn-success"><i class="icon-ok"></i></span>
                     <img ng-show="insumo.guardando" src="<?php echo base_url(); ?>assets/img/preloader.gif" alt="Smiley face" height="42" width="42">
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

              <hr />
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
                        <input type="text" class="form-control" ng-model="vm.insumo_selected.unidad_medida" disabled/>
                        </div>
                      </div>
                    </div> 
                  </div> 
                </div>
              </div> 
              <hr />
            </form>
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
        vm.insumo_selected  = false;

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
      vm.mostrar_modal     = mostrar_modal;


    function ordenarTabla(keyname){
      vm.sortKey = keyname;   //set the sortKey to the param passed
      vm.reverse = !vm.reverse; //if true make it false and vice versa
    }
    function mostrar_modal(insumo){
      vm.insumo_selected = insumo;
      $('#modal-insumo').appendTo("body").modal('show');
    }

    function guardar_stock(insumo){
      insumo.guardando = 1;
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

        insumo.guardando = 0;
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
