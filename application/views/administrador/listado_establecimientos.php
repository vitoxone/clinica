<div id="wrapper" ng-app="myApp">
 <div id="page-wrapper" ng-controller="PacientesController as vm">
    <div class="col-md-12">
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Listado de establecimientos</div>
            <div class="widget-icons pull-right">
              <span><span class="label label-primary">{{vm.establecimientos.length}}</span>  Establecimientos</span>
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
                  <th ng-click="vm.ordenarTabla('nombre')">Nombre
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='nombre'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                  <th ng-click="vm.ordenarTabla('alias')">Alias
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='alias'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
<!--                   <th ng-click="vm.ordenarTabla('tipo')">Tipo
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='tipo'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th> -->
                  <th ng-click="vm.ordenarTabla('region')">Región
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='region'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                  <th ng-click="vm.ordenarTabla('comuna')">Comuna
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='comuna'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr dir-paginate="establecimiento in vm.establecimientos|orderBy:vm.sortKey:vm.reverse|filter:vm.search|itemsPerPage:vm.itemsMostrar">
                 	<td style="text-transform:uppercase;">{{establecimiento.nombre}}</td> 
                    <td ng-show="establecimiento.alias == ''"><a ng-click="vm.mostrar_asignar_alias(establecimiento)">Asignar</a></td>
					<td ng-show="establecimiento.alias != ''"><p style="text-transform:uppercase;">{{establecimiento.alias}}</p><a style="cursor: pointer;" ng-click="vm.mostrar_asignar_alias(establecimiento)"> (Cambiar)</a></td> 
                  	<!-- <td class="text-center"> {{establecimiento.tipo}}</td> -->
                  	<td class="text-center"> {{establecimiento.region}}</td>
                  	<td class="text-center"> {{establecimiento.comuna}}</td>
                </tr>
              </tbody>
            </table>
            <dir-pagination-controls
              max-size="5"
              direction-links="true"
              boundary-links="true">
            </dir-pagination-controls>
          </div>
        </div>
      </div>
      <div id="modal_asignar_alias" class="modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Asignar alias a {{vm.establecimiento_selected.nombre}}</h4>            
            </div>
            <div class="modal-body">                            
              <div class="row">
                <div class="col-md-12">                    
                  <div class="form-group">
                    <label class="col-lg-3" style="display: inline-flex;"> Alias</label>
                    <div class="col-lg-8">
                     <input ng-model = "vm.establecimiento_selected.alias" name="alias" class="form-control" style="text-transform:uppercase;" required/>
                    </div>
                  </div>
                </div>
              </div>
              <br/>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                <button type="button" class="btn btn-primary" ng-click="vm.guardar_alias_establecimiento(vm.establecimiento_selected)">Asignar</button>
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

  <script src="<?php echo base_url(); ?>assets/js/angular-flash.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery.prettyPhoto.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/dirPagination.js"></script>
<script>
(function(){
    'use strict';
    angular.module('myApp', ['ui.bootstrap', 'ui.multiselect', 'ngAnimate','angularUtils.directives.dirPagination']);
    angular.module('myApp').controller('PacientesController', PacientesController);


    PacientesController.$inject = ['$http', '$timeout'];
    function PacientesController($http){
        var vm = this;

        vm.sortKey = false;
        vm.reverse = false;
        vm.itemsMostrar = '20';

        vm.establecimientos = JSON.parse('<?php echo $establecimientos; ?>');

        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }

      vm.ordenarTabla                  = ordenarTabla;
      vm.mostrar_asignar_alias         = mostrar_asignar_alias;
      vm.guardar_alias_establecimiento = guardar_alias_establecimiento;



    function ordenarTabla(keyname){
      vm.sortKey = keyname;   //set the sortKey to the param passed
      vm.reverse = !vm.reverse; //if true make it false and vice versa
  }

  function mostrar_asignar_alias(establecimiento){

      vm.establecimiento_selected = establecimiento;
      $('#modal_asignar_alias').appendTo("body").modal('show');
    }
  

  function guardar_alias_establecimiento(establecimiento){
      var data = $.param({
            establecimiento: establecimiento
        });
      $http.post('<?php echo base_url(); ?>administrador/set_alias_establecimiento/', data, config)
        .then(function(response){
            if(response.data !== 'false'){
              vm.establecimientos = response.data;
              $('#modal_asignar_alias').modal('hide');
            }
        },
        function(response){
            console.log("error guardar el alias.");
        }
    	);
    }

     
    }
})();

</script> 

