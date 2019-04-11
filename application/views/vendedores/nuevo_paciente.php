<div id="wrapper" ng-app="myApp">
 <div id="page-wrapper" ng-controller="UsuariosController as vm">
    <div class="page-head">
      <h2 class="pull-left"><i class="icon-file-alt"></i> Registro paciente</h2>
      <div class="bread-crumb pull-right">
        <a href="index.html"><i class="icon-home"></i> Home</a> 
        <span class="divider">/</span> 
        <a href="#" class="bread-current">Paciente: {{vm.paciente.nombres}} {{vm.paciente.apellido_paterno}} {{vm.paciente.apellido_materno}}</a>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
      <hr />
      <div class="row">
        <div class="col-md-12">            
          <div class="widget">
            <div class="widget-head">
              <div class="pull-left">Datos paciente: {{vm.paciente.nombres}} {{vm.paciente.apellido_paterno}} {{vm.paciente.apellido_materno}}</div>
              <div class="widget-icons pull-right">
                <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
              </div>  
              <div class="clearfix"></div>
            </div>
            <div class="widget-content">
              <div class="padd">
                <form name="userForm" novalidate>                               
                  <div class="row">
                    <div class="col-md-4" ng-show = "true">                    
                      <div class="form-group" ng-class="{ 'has-error': userForm.especialidad.$touched && userForm.especialidad.$invalid }">
                        <label class="col-lg-3" for="content">Tipo documento</label>
                        <div class="col-lg-9">
                          <!--<multiselect name="especialidad" ng-model="vm.usuario.especialidad" options="especialidad.nombre for especialidad in vm.especialidades" data-multiple="false" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5" required></multiselect> -->  
                          <select class="form-control" name="tipo_documento" id="mySelect" ng-options="tipo_documento_identificacion.nombre for tipo_documento_identificacion in vm.tipos_documentos track by tipo_documento_identificacion.id_tipo_documento" ng-model="vm.paciente.tipo_documento_identificacion" title="Seleccione especialidad" ng-change="vm.tipo_documento_cambiar()" required></select>
                            <div class="help-block" ng-messages="userForm.especialidad.$error" ng-if="userForm.especialidad.$touched">
                            <p ng-message="required">Campo requerido</p>
                          </div>
           
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4" id="rut_input">                    
                      <div class="form-group required" ng-class="{ 'has-error': userForm.rut.$touched && userForm.rut.$invalid}">
                        <label class="col-lg-3" for="content">Rut</label>
                        <div class="col-lg-9">
                            <input ng-rut rut-format="live" ng-model = "vm.paciente.rut" name="rut" class="form-control" style="text-transform:uppercase" required/>
                            <div class="help-block" ng-messages="userForm.rut.$error" ng-if="userForm.rut.$touched">
                            <p ng-message="required">Campo requerido</p>
                            <p ng-message="rut">Rut invalido</p>
                            <p ng-message="rut_existe">Rut ya existe</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4 hidden" id="passport_input">                    
                      <div class="form-group required">
                        <label class="col-lg-3" for="content">Pasaporte</label>
                        <div class="col-lg-9">
                            <input ng-model = "vm.paciente.passport" name="passport" class="form-control" style="text-transform:uppercase" required />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                      <div class="col-md-5">                    
                        <div class="form-group">
                          <div class="col-lg-4" style="width: 50px; height: 30px; background-image: url('<?php echo base_url(); ?>assets/img/contigo.png');"></div>
                          <div class="col-lg-6">                               
                              <div class="toggle-button">
                                  <input ng-model="vm.paciente.contigo" class="form-control" type="checkbox">
                              </div> 
                          </div>
                        </div>
                        </div>
                        <div class="col-md-5">    
                          <div class="form-group">
                          <div class="col-lg-4" style="width: 50px; height: 30px; background-image: url('<?php echo base_url(); ?>assets/img/PAD.png');"></div>
                            <div class="col-lg-6">                               
                                <div class="toggle-button">
                                    <input ng-model="vm.paciente.domiciliario" class="form-control" type="checkbox">
                                </div> 
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group required" ng-class="{ 'has-error': userForm.nombres.$touched && userForm.nombres.$invalid }">
                        <label class="col-lg-3" for="content">Nombres</label>
                        <div class="col-lg-9">
                            <input ng-model = "vm.paciente.nombres" name="nombres" class="form-control" style="text-transform:uppercase" required/>
                            <div class="help-block" ng-messages="userForm.nombres.$error" ng-if="userForm.nombres.$touched">
                            <p ng-message="required">Campo requerido</p>
                          </div>
           
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group required" ng-class="{ 'has-error': userForm.apellido_paterno.$touched && userForm.apellido_paterno.$invalid }">
                        <label class="col-lg-3" for="content">Apellido paterno</label>
                        <div class="col-lg-9">
                            <input ng-model = "vm.paciente.apellido_paterno" name="apellido_paterno" class="form-control" style="text-transform:uppercase" required/>
                            <div class="help-block" ng-messages="userForm.apellido_paterno.$error" ng-if="userForm.apellido_paterno.$touched">
                            <p ng-message="required">Campo requerido</p>
                          </div>
           
                        </div>
                      </div>
                    </div>
                  <div class="col-md-4">
                      <div class="col-md-5">                    
                        <div class="form-group">
                          <div class="col-lg-4" style="width: 50px; height: 30px; background-image: url('https://s3-us-west-1.amazonaws.com/convatec2017images1/oncovida.png');"></div>
                          <div class="col-lg-6">                               
                              <div class="toggle-button">
                                  <input ng-model="vm.paciente.oncovida" class="form-control" type="checkbox">
                              </div> 
                          </div>
                        </div>
                      </div>
                      <div class="col-md-5">    
                        <div class="form-group">
                        <div class="col-lg-4" style="width: 50px; height: 30px; background-image: url('https://s3-us-west-1.amazonaws.com/convatec2017images1/cmc.png');"></div>
                          <div class="col-lg-6">                               
                              <div class="toggle-button">
                                  <input ng-model="vm.paciente.cmc" class="form-control" type="checkbox">
                              </div> 
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <br/>
                  <br/>     
                  <div class="row">
                    <div class="col-md-4">                      
                      <div class="form-group">
                        <label class="col-lg-3">Apellido materno</label>
                        <div class="col-lg-9">
                            <input ng-model="vm.paciente.apellido_materno" class="form-control" style="text-transform:uppercase"/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-lg-3">Región</label>
                        <div class="col-lg-9">
                            <multiselect ng-model="vm.paciente.region" options="region.nombre for region in vm.regiones" data-multiple="false" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5" ng-change="vm.cargar_comunas()"></multiselect>    
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-lg-3">Comuna</label>
                        <div class="col-lg-9">
                          <div class="input-group">
                            <multiselect ng-model="vm.paciente.comuna" options="comuna.nombre for comuna in vm.comunas" data-multiple="false" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5"></multiselect>   
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                  <br/>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group required" ng-class="{ 'has-error': userForm.telefono.$touched && userForm.telefono.$invalid }">
                        <label class="col-lg-3" for="content">Telefono 1</label>
                        <div class="col-lg-9">
                            <input ng-model = "vm.paciente.telefono" name="telefono" class="form-control" style="text-transform:uppercase" required/>
                            <div class="help-block" ng-messages="userForm.telefono.$error" ng-if="userForm.telefono.$touched">
                            <p ng-message="required">Campo requerido</p>
                          </div>
           
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-lg-3">Celular</label>
                        <div class="col-lg-8">
                          <div class="input-group">
                              <input ng-model="vm.paciente.celular"  class="form-control"/>  
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-lg-3">Email</label>
                        <div class="col-lg-9">
                          <input type="email" name="email" class="form-control" ng-model="vm.paciente.email">  
                        </div>
                      </div>
                    </div>
                  </div>
                  <br>
                  <hr>
                  <div class="row">
                    <div class="col-md-3">                    
                      <div class="form-group">
                        <label class="col-lg-5">Fecha cirugía</label>
                        <div class="col-lg-7">
                          <div class="input-group">
                            <input type="text" class="form-control" uib-datepicker-popup datepicker-popup="yyyy-mm-dd" ng-model="vm.paciente.fecha_cirugia" is-open="vm.popup_tratamiento_actual_fecha_cirugia.opened" ng-required="true" close-text="Close" />
                            <span ng-click="vm.tratamientoActualFechaCirugia()" class="input-group-addon btn btn-info btn-lg"><i class="icon-calendar"></i></span>
                          </div>
                          </div>   
                        </div>
                      </div>
                    <div class="col-md-3">  
                      <div class="form-group">
                        <label class="col-lg-4">Institución salud</label>
                        <div class="col-lg-8">
                          <multiselect style="padding-right: 200px;overflow: hidden;text-overflow: ellipsis;" ng-model="vm.paciente.establecimiento" options="establecimiento.nombre for establecimiento in vm.establecimientos" data-multiple="false" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5" ng-change ="vm.cargar_medicos_establecimiento()"></multiselect>  
                        </div>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                        <label class="col-lg-3">Médico tratante</label>
                        <div class="col-lg-9">
                          <div class="input-group">
                            <multiselect ng-model="vm.paciente.medico_tratante" options="medico.nombres for medico in vm.medicos" data-multiple="false" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5"></multiselect>  
                            <span  ng-click="vm.abrirModalRegistroMedicos()" class="btn btn-info btn-md"><i class=" icon-plus"></i></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <br>
                </form>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="widget">
              <div class="widget-buttons">
                <div class="col-md-12 col-lg-offset-10">  
                  <input class="btn btn-success btn-lg"  type="button" value="Grabar paciente" ng-click="vm.validar_formulario(userForm)"/>
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
<script>
(function(){
    'use strict';
    angular.module('myApp', ['ui.bootstrap', 'ui.multiselect', 'ngAnimate','angularUtils.directives.dirPagination','minicolors','ngMessages', 'platanus.rut']);
    angular.module('myApp').controller('UsuariosController', UsuariosController);


    UsuariosController.$inject = ['$http', '$timeout','minicolors'];
    function UsuariosController($http){
        var vm = this;

        vm.tipos_documentos = JSON.parse('<?php echo $tipos_documentos; ?>');
        vm.isapres = JSON.parse('<?php echo $isapres; ?>');
        vm.regiones = JSON.parse('<?php echo $regiones; ?>');
        vm.documento = JSON.parse('<?php echo $documento; ?>');
        vm.establecimientos = JSON.parse('<?php echo $establecimientos; ?>');

        vm.paciente = {};
        vm.paciente.tipo_documento_identificacion = vm.documento;


        vm.sortKey = false;
        vm.reverse = false;
        vm.itemsMostrar = '20';

        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }

      vm.ordenarTabla                   = ordenarTabla;
      vm.guardar_paciente               = guardar_paciente;
      vm.validar_formulario             = validar_formulario;
      vm.cargar_comunas                 = cargar_comunas;
      vm.tratamientoActualFechaCirugia  = tratamientoActualFechaCirugia;
      vm.cargar_medicos_establecimiento = cargar_medicos_establecimiento;
      vm.tipo_documento_cambiar         = tipo_documento_cambiar;

      vm.popup_tratamiento_actual_fecha_cirugia = {
          opened: false
      };


    function tratamientoActualFechaCirugia() {
      vm.popup_tratamiento_actual_fecha_cirugia.opened = true;
    };


    function guardar_paciente() {

      var data = $.param({
          paciente: vm.paciente
      });

      $http.post('<?php echo base_url(); ?>pacientes/set_paciente', data, config)
          .then(function(response){
              if(response.data !== 'false'){
                window.location ='<?php echo base_url(); ?>vendedores/home_vendedor/';
                
              }
          },
          function(response){
              console.log("error al guardar paciente.");
          }
      );
            
    };

    function cargar_comunas(){
        var data = $.param({
        region: vm.paciente.region.id_region,
      });
      //reinicio el valor de la comuna seleccionada para el paciente
      vm.paciente.comuna = '';
      if(vm.paciente.region.id_region){

        $http.post('<?php echo base_url(); ?>regiones/get_comunas_region', data, config)
            .then(function(response){
                if(response.data !== 'false'){
                  vm.comunas = response.data;
                }
            },
            function(response){
                console.log("error al obtener comunas.");
            }
        );
      }
     }

    function validar_formulario(userForm){
      var error =false;

      if(vm.paciente.tipo_documento_identificacion.id_tipo_documento == 1){
        if(userForm.rut.$invalid){
          userForm.rut.$touched = true;
          error = true;
        }
      }
      /*if(userForm.especialidad.$invalid){
        userForm.especialidad.$touched = true;
        error = true;
      }*/
      if(userForm.nombres.$invalid){
        userForm.nombres.$touched = true;
        error = true;
      }
      if(userForm.apellido_paterno.$invalid){
        userForm.apellido_paterno.$touched = true;
        error = true;
      }
      if(userForm.telefono.$invalid){
        userForm.telefono.$touched = true;
        error = true;
      }

      if(!error){
        if(vm.paciente.fecha_cirugia){
            moment.locale('es');
            var fecha_cirugia = moment(vm.paciente.fecha_cirugia).format('YYYY-MM-DD');
            vm.paciente.fecha_cirugia = fecha_cirugia;
        }

        verificar_rut_unico();
      /*  if(!existe_rut){
          guardar_paciente();
        }
        else{
          alert("El rut ingresado ya esxiste, intente con otro");
        }*/
        //console.log(existe);
        //guardar_usuario();
      }

    }
    function ordenarTabla(keyname){
      vm.sortKey = keyname;   //set the sortKey to the param passed
      vm.reverse = !vm.reverse; //if true make it false and vice versa
    }

    function cargar_medicos_establecimiento(){

      if(vm.paciente.establecimiento.id_establecimiento){

          var data = $.param({
          establecimiento: vm.paciente.establecimiento.id_establecimiento
        });
          vm.medicos = '';
          vm.paciente.medico_tratante = '';
          $http.post('<?php echo base_url(); ?>medicos/get_medicos_establecimiento', data, config)
              .then(function(response){
                  if(response.data !== 'false'){
                    if(response.data){

                      vm.medicos = response.data;
                    }
                  }else{
                    vm.medicos = '';
                    vm.paciente.medico_tratante = false;
                  }

              },
              function(response){
                  console.log("error al obtener comunas.");
              }
          );
      }
     }

    function tipo_documento_cambiar(){
      if(vm.paciente.tipo_documento_identificacion != undefined && vm.paciente.tipo_documento_identificacion.id_tipo_documento == 2){
        $("#rut_input").addClass("hidden");
        $("#passport_input").removeClass("hidden");
      }else{
        $("#passport_input").addClass("hidden");
        $("#rut_input").removeClass("hidden");
      }
    }

    function verificar_rut_unico() {

      if(vm.paciente.tipo_documento_identificacion.id_tipo_documento == 1){
        var data = $.param({
            rut: vm.paciente.rut
        });
      }
      if(vm.paciente.tipo_documento_identificacion.id_tipo_documento == 2){
          var data = $.param({
            rut: vm.paciente.passport
        });
      }

      $http.post('<?php echo base_url(); ?>pacientes/verificar_rut_paciente/', data, config)
          .then(function(response){
            if(response.data == 1){
              alert("El rut ingresado ya esxiste, intente con otro");
            }else{
              guardar_paciente();
            }
          }, 
          function(response){
              console.log("error al verificar rut.");
          }
      );
    };

}
})();

</script> 
