<div id="wrapper" ng-app="myApp">
 <div id="page-wrapper" ng-controller="PacientesController as vm">
    <div class="col-md-12">
        <div class="row">
          <div class="col-md-2">
              <a href="<?php echo base_url()."pacientes/nuevo_diagnostico"?>"type="button" class="btn btn-success">Nuevo paciente</a>
          </div>
        </div>
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Listado de pacientes</div>
            <div class="widget-icons pull-right">
              <span><span class="label label-primary">{{vm.pacientes.length}}</span>  Pacientes</span>
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
                  <!-- <th> Validar</th> -->
                  <th ng-click="vm.ordenarTabla('rut')">Rut/Pasaporte
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='rut'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                  <th class="text-center" ng-click="vm.ordenarTabla('contigo')">¿Contigo?
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='contigo'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                  <th class="text-center" ng-click="vm.ordenarTabla('domiciliario')">¿PAD?
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='domiciliario'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                  <th class="text-center" ng-click="vm.ordenarTabla('domiciliario')">¿Encuestado?
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='llamado'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                  <th class="text-center" ng-click="vm.ordenarTabla('fecha_registro')">Fecha registro
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='fecha_registro'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                  <th class="text-center">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr dir-paginate="paciente in vm.pacientes|orderBy:vm.sortKey:vm.reverse|filter:vm.search|itemsPerPage:vm.itemsMostrar">
                  <td><a  style="text-transform:uppercase" ng-href="<?php echo base_url(); ?>pacientes/nuevo_diagnostico/{{paciente.id_paciente}}"</a>{{paciente.nombre}}</td>
                 <!--  <td> <button class="btn btn-xs btn-success"><i class="icon-ok"></i> </button><button class="btn btn-xs btn-warning"><i class="icon-pencil"></i> </button></td> -->
                  <td>{{paciente.rut}}</td>
                  <td class="text-center"><span ng-if="paciente.contigo == 1" class="label label-success">Si</span><span ng-if="paciente.contigo == 0" class="label label-danger">No</span></td>
                  <td class="text-center"><span ng-if="paciente.domiciliario == 1" class="label label-success">Si</span><span ng-if="paciente.domiciliario == 0" class="label label-danger">No</span></td>
                  <td class="text-center"><span data-ng-repeat="llamado in paciente.llamado" class="label {{llamado.label}}">{{llamado.numero}}</span> </td>
                  <td class="text-center"> {{paciente.fecha_registro}}</td>
                    <td class="text-center">
                      <div class="col-md-12">
                        <a class="btn btn-xs btn-default" ng-href="<?php echo base_url(); ?>/pacientes/nuevo_diagnostico/{{paciente.id_paciente}}"><i class="icon-pencil"></i></a>
                        <button ng-show="vm.mostrar_eliminar == true" class="btn btn-xs btn-default" ng-click = "vm.modal_eliminar_paciente(paciente)"><i class="icon-remove"></i> </button>
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
  <div id="modal_verificar_eliminar_paciente" class="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header-eliminar-convatec">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4-eliminar-modal class="modal-title">Eliminar paciente: {{vm.paciente_eliminar.nombre}}</h4-eliminar-modal>            
        </div>
        <div class="modal-body">                            
            <div class="row">
              <div class="col-md-12">
                <div class="alert alert-danger">Cuidado!! Está a punto de eliminar un paciente de forma permanente.</div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                    <label class="col-lg-3">Profesional</label>
                    <div class="col-lg-9">
                        <div class="input-group">
                          <h4>{{vm.nombre_profesional}}</h4>
                        </div>
                    </div>
                </div>
              </div>
              <br>
              <div class="col-md-12">
                <div class="form-group">
                    <label class="col-lg-3">Contraseña</label>
                    <div class="col-lg-9">
                        <div class="input-group">
                          <input type="password" ng-model="vm.password_verificar"  placeholder="Contraseña" class="form-control" />
                          {{vm.error_verificacion_usuario}}
                        </div>
                    </div>
                </div>
              </div>
          </div>
          <br/>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
            <button type="button" class="btn btn-danger" ng-click="vm.verificar_usuario()">Verificar y eliminar</button>
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

        vm.pacientes = JSON.parse('<?php echo $pacientes; ?>');
        vm.nombre_profesional = '<?php echo $nombre_profesional; ?>';
        vm.mostrar_eliminar = '<?php echo $mostrar_eliminar; ?>';

        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }

      vm.ordenarTabla                 = ordenarTabla;
      vm.modal_eliminar_paciente      = modal_eliminar_paciente;
      vm.mostrar_editar_paciente      = mostrar_editar_paciente;
      vm.verificar_usuario            = verificar_usuario;
      vm.eliminar_paciente            = eliminar_paciente;   


    function ordenarTabla(keyname){
      vm.sortKey = keyname;   //set the sortKey to the param passed
      vm.reverse = !vm.reverse; //if true make it false and vice versa
  }

  function modal_eliminar_paciente(paciente){
      vm.error_verificacion_usuario = '';
      vm.paciente_eliminar = paciente;
      $('#modal_verificar_eliminar_paciente').appendTo("body").modal('show');
    }

  function mostrar_editar_paciente(paciente){

    console.log(paciente); 
      // vm.datos_verificar = datos;
      // vm.error_verificacion_usuario = '';
      // $('#modal_verificar_usuario').appendTo("body").modal('show');
    }

    function verificar_usuario() {

      var data = $.param({
          password: vm.password_verificar
      });

      $http.post('<?php echo base_url(); ?>usuarios/verificar_password/', data, config)
          .then(function(response){
              if(response.data !== 'false'){
                if(response.data == 1){
                  $('#modal_verificar_eliminar_paciente').modal('hide');
                    eliminar_paciente(vm.paciente_eliminar);
                }else{
                  vm.error_verificacion_usuario = 'Contraseña Incorrecta';

                } 
              }
          },
          function(response){
              console.log("error al verificar password.");
          }
      );
    };

  function eliminar_paciente(paciente_eliminar) {

          var data = $.param({
            paciente: paciente_eliminar
          });

      $http.post('<?php echo base_url(); ?>pacientes/eliminar_paciente/', data, config)
          .then(function(response){
              if(response.data !== 'false'){
                vm.pacientes = response.data;
              }
          },
          function(response){
              console.log("error al guardar diagnostico.");
          }
      );
    };
     
    }
})();

</script> 
