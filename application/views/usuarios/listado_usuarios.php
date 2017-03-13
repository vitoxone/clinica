<div id="wrapper" ng-app="myApp">
 <div id="page-wrapper" ng-controller="UsuariosController as vm">
    <div class="page-head">
        <h2 class="pull-left"><i class="icon-file-alt"></i> Mantenedor usuarios</h2>
        <div class="bread-crumb pull-right">
          <a href="index.html"><i class="icon-home"></i> Home</a> 
          <span class="divider">/</span> 
          <a href="#" class="bread-current">Listado usuarios</a>
        </div>
        <div class="clearfix"></div>
   </div>
    <div class="col-md-12">
    </br>
        <div class="row">
          <div class="col-md-2">
              <a href="<?php echo base_url()."usuarios/nuevo_usuario"?>" type="button" class="btn btn-success">Nuevo Usuario</a>
          </div>
        </div>
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Listado de usuarios</div>
            <div class="widget-icons pull-right">
              <span><span class="label label-primary">{{vm.usuarios.length}}</span>  Usuarios</span>
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
                            <input type="text" ng-model="vm.search" class="form-control" placeholder="Nombre / Rut">
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
                  <th class="text-center" ng-click="vm.ordenarTabla('rut')">Rut
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='rut'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                  <th class="text-center" ng-click="vm.ordenarTabla('tipo_usaurio')">TIPO USUARIO
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='tipo_usuario'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                  <th class="text-center" ng-click="vm.ordenarTabla('stock_unitario')">ACTIVO</th>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr dir-paginate="usuario in vm.usuarios|orderBy:vm.sortKey:vm.reverse|filter:vm.search|itemsPerPage:vm.itemsMostrar">
                  <td> <a  style="text-transform:uppercase" ng-href="<?php echo base_url(); ?>usuarios/detalle_usuario/{{usuario.id_usuario}}"</a>{{usuario.nombres}}</td>
                  <td>{{usuario.rut}}</td>
                  <td>{{usuario.tipo_usuario}}</td>
                  <td>
                    <div class="input-group"> 

                     <input ng-model="usuario.activo" ng-click="vm.activar_usuario(usuario)" type="checkbox">

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

  <script src="<?php echo base_url(); ?>assets/js/angular-flash.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery.prettyPhoto.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/dirPagination.js"></script>
<script>
(function(){
    'use strict';
    angular.module('myApp', ['ui.bootstrap', 'ui.multiselect', 'ngAnimate','angularUtils.directives.dirPagination']);
    angular.module('myApp').controller('UsuariosController', UsuariosController);


    UsuariosController.$inject = ['$http', '$timeout'];
    function UsuariosController($http){
        var vm = this;

        vm.sortKey = false;
        vm.reverse = false;
        vm.itemsMostrar = '20';

        vm.usuarios = JSON.parse('<?php echo $usuarios; ?>');

        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }

      vm.ordenarTabla      = ordenarTabla;
      vm.activar_usuario    = activar_usuario;


    function ordenarTabla(keyname){
      vm.sortKey = keyname;   //set the sortKey to the param passed
      vm.reverse = !vm.reverse; //if true make it false and vice versa
    }


    function activar_usuario(usuario){
          var data = $.param({
          usuario: usuario
      });

      $http.post('<?php echo base_url(); ?>usuarios/activar_usuario', data, config)
          .then(function(response){
              if(response.data !== 'false'){
                console.log(response.data);
              }
          },
          function(response){
              console.log("error al activar usuario.");
          }
      );
     }
    }
})();

</script> 
