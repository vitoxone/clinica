      
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
                </tr>
              </thead>
              <tbody>
                <tr dir-paginate="paciente in vm.pacientes|orderBy:vm.sortKey:vm.reverse|filter:vm.search|itemsPerPage:vm.itemsMostrar">
                  <td><a  style="text-transform:uppercase" ng-href="<?php echo base_url(); ?>/pacientes/nuevo_diagnostico/{{paciente.id_paciente}}"</a>{{paciente.nombre}}</td>
                 <!--  <td> <button class="btn btn-xs btn-success"><i class="icon-ok"></i> </button><button class="btn btn-xs btn-warning"><i class="icon-pencil"></i> </button></td> -->
                  <td>{{paciente.rut}}</td>
                  <td class="text-center"><span ng-if="paciente.contigo == 1" class="label label-success">Si</span><span ng-if="paciente.contigo == 0" class="label label-danger">No</span></td>
                  <td class="text-center"><span ng-if="paciente.domiciliario == 1" class="label label-success">Si</span><span ng-if="paciente.domiciliario == 0" class="label label-danger">No</span></td>
                   <td class="text-center"><img src="<?php echo base_url(); ?>assets/img/phone-green.png" alt="" ng-if="paciente.llamado == 1"><img src="<?php echo base_url(); ?>assets/img/phone-green.png" alt="" ng-if="paciente.llamado == 1"><img src="<?php echo base_url(); ?>assets/img/phone-green.png" alt="" ng-if="paciente.llamado == 1"><img src="<?php echo base_url(); ?>assets/img/phone-green.png" alt="" ng-if="paciente.llamado == 1"><img src="<?php echo base_url(); ?>assets/img/phone-red.png" alt=""  ng-if="paciente.llamado == 0"><img src="<?php echo base_url(); ?>assets/img/phone-red.png" alt=""  ng-if="paciente.llamado == 0"><img src="<?php echo base_url(); ?>assets/img/phone-red.png" alt=""  ng-if="paciente.llamado == 0"><img src="<?php echo base_url(); ?>assets/img/phone-red.png" alt=""  ng-if="paciente.llamado == 0"></td>
                  
                </tr>
              </tbody>
            </table>
            <dir-pagination-controls
              max-size="5"
              direction-links="true"
              boundary-links="true" >
            </dir-pagination-controls>
<!--
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th >#</th>
                  <th>Nombre<span class="icon-chevron-down"></span></th>
                  <th>¿Contigo?<span class="icon-chevron-up"></span></th> 
                  <th>Diagnóstico<span class="icon-chevron-up"></span></th>
                  <th>Atención domiciliaria<span class="icon-chevron-up"></span></th>
                  <th>Estado</th>
                  <th>Fecha registro</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
              <?php $numero = 1; ?>
              <?php foreach ($pacientes as $paciente): ?>
                <tr>
                  <td><?php echo $numero; ?></td>
                  <td><a  href="<?php echo base_url(); ?>pacientes/nuevo_diagnostico/<?php echo base64_encode($this->encrypt->encode($paciente->id_paciente)); ?>"> <?php echo $paciente->nombres. " ".$paciente->apellido_paterno." ".$paciente->apellido_materno; ?></a></td>
                  <td><?php if($paciente->contigo != 0){ echo '<span class="label label-success">Si</span>'; }else{echo '<span class="label label-danger">No</span>'; }?></td>
                  <td><?php if($paciente->diagnostico != null){ echo '<span class="label label-success">Si</span>'; }else{echo '<span class="label label-danger">No</span>'; }?></td>
                  <td><?php if($paciente->domiciliario != 0){ echo '<span class="label label-success">Si</span>'; }else{echo '<span class="label label-danger">No</span>'; }?></td>
                  <td><?php if($paciente->activo){ echo '<span class="label label-success">Activo</span>'; }else{echo '<span class="label label-danger">Inactivo</span>'; }?></td>
                  <td><?php echo $paciente->created; ?></td>
                  <td>
                      <button class="btn btn-xs btn-success"><i class="icon-ok"></i> </button>
                      <button class="btn btn-xs btn-warning"><i class="icon-pencil"></i> </button>
                      <button class="btn btn-xs btn-danger"><i class="icon-remove"></i> </button>
                  </td>
                </tr>                                 
                  <?php ++$numero; ?>
                <?php endforeach; ?>
              </tbody>
            </table>-->
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

        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }

      vm.ordenarTabla      = ordenarTabla;


    function ordenarTabla(keyname){
      vm.sortKey = keyname;   //set the sortKey to the param passed
      vm.reverse = !vm.reverse; //if true make it false and vice versa
  }
     
    }
})();

</script> 
