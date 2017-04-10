<div id="wrapper" ng-app="myApp">
 <div id="page-wrapper" ng-controller="UsuariosController as vm">
    <div class="page-head">
      <h2 class="pull-left"><i class="icon-file-alt"></i> Registro usuario</h2>
      <div class="bread-crumb pull-right">
        <a href="index.html"><i class="icon-home"></i> Home</a> 
        <span class="divider">/</span> 
          <a href="#" class="bread-current">Nuevo usuario: {{vm.usuario.nombres}} {{vm.usuario.apellido_paterno}} {{vm.usuario.apellido_materno}} </a> 
      </div>
      <div class="clearfix"></div>
    </div>
      <div class="row">
        <div class="col-md-12">            
              <div class="widget">
                <div class="widget-head">
                  <div class="pull-left">Datos usuario: {{vm.usuario.nombres}} {{vm.usuario.apellido_paterno}} {{vm.usuario.apellido_materno}}</div>
                  <div class="widget-icons pull-right">
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">
                    <form name="userForm" novalidate>                            
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group" ng-class="{ 'has-error': userForm.rut.$touched && userForm.rut.$invalid}">
                            <label class="col-lg-3" for="content">Rut</label>
                            <div class="col-lg-9">
                                <input ng-rut rut-format="live" ng-model = "vm.usuario.rut" name="rut" class="form-control" style="text-transform:uppercase" required/>
                                <div class="help-block" ng-messages="userForm.rut.$error" ng-if="userForm.rut.$touched">
                                <p ng-message="required">Campo requerido</p>
                                <p ng-message="rut">Rut invalido</p>
                              </div>
               
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group" ng-class="{ 'has-error': userForm.especialidad.$touched && userForm.especialidad.$invalid }">
                            <label class="col-lg-3" for="content">Especialidad</label>
                            <div class="col-lg-9">
                              <!--<multiselect name="especialidad" ng-model="vm.usuario.especialidad" options="especialidad.nombre for especialidad in vm.especialidades" data-multiple="false" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5" required></multiselect> -->  
                              <select class="form-control" name="especialidad" id="mySelect" ng-options="especialidad.nombre for especialidad in vm.especialidades track by especialidad.id_especialidad" ng-model="vm.usuario.especialidad" title="Seleccione especialidad" ng-change="vm.activar_colores(vm.usuario.especialidad)" required>
                              <option value="">---Seleccione---</option></select> 
                                <div class="help-block" ng-messages="userForm.especialidad.$error" ng-if="userForm.especialidad.$touched">
                                <p ng-message="required">Campo requerido</p>
                              </div>
               
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group" ng-class="{ 'has-error': userForm.huso_horario.$touched && userForm.huso_horario.$invalid }">
                            <label class="col-lg-3" for="content">Huso Horario</label>
                            <div class="col-lg-9">
                              <multiselect disabled name="huso_horario" ng-model="vm.usuario.huso_horario" options="huso_horario.nombre for huso_horario in vm.husos_horarios" data-multiple="false" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5" required></multiselect>  
                                <div class="help-block" ng-messages="userForm.huso_horario.$error" ng-if="userForm.huso_horario.$touched">
                                <p ng-message="required">Campo requerido</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <br/>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group" ng-class="{ 'has-error': userForm.nombres.$touched && userForm.nombres.$invalid }">
                            <label class="col-lg-3" for="content">Nombres</label>
                            <div class="col-lg-9">
                                <input ng-model = "vm.usuario.nombres" name="nombres" class="form-control" style="text-transform:uppercase" required/>
                                <div class="help-block" ng-messages="userForm.nombres.$error" ng-if="userForm.nombres.$touched">
                                <p ng-message="required">Campo requerido</p>
                              </div>
               
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group" ng-class="{ 'has-error': userForm.apellido_paterno.$touched && userForm.apellido_paterno.$invalid }">
                            <label class="col-lg-3" for="content">Apellido Paterno</label>
                            <div class="col-lg-9">
                                <input ng-model = "vm.usuario.apellido_paterno" name="apellido_paterno" class="form-control" style="text-transform:uppercase" required/>
                                <div class="help-block" ng-messages="userForm.apellido_paterno.$error" ng-if="userForm.apellido_paterno.$touched">
                                <p ng-message="required">Campo requerido</p>
                              </div>
               
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">                      
                          <div class="form-group">
                            <label class="col-lg-3">Apellido materno</label>
                            <div class="col-lg-9">
                                <input ng-model="vm.usuario.apellido_materno" class="form-control" style="text-transform:uppercase"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <br/>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group" ng-class="{ 'has-error': userForm.nombre_usuario.$touched && userForm.nombre_usuario.$invalid }">
                            <label class="col-lg-3" for="content">Nombre usuario</label>
                            <div class="col-lg-9">
                                <input ng-model = "vm.usuario.nombre_usuario" name="nombre_usuario" class="form-control" required/>
                                <div class="help-block" ng-messages="userForm.nombre_usuario.$error" ng-if="userForm.nombre_usuario.$touched">
                                <p ng-message="required">Campo requerido</p>
                              </div>
               
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group" ng-class="{ 'has-error': userForm.password.$touched && userForm.password.$invalid }">
                            <label class="col-lg-3" for="content">Contraseña</label>
                            <div class="col-lg-9">
                                <input type="password" ng-model = "vm.usuario.password" name="password" class="form-control" required/>
                                <div class="help-block" ng-messages="userForm.password.$error" ng-if="userForm.password.$touched">
                                <p ng-message="required">Campo requerido</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <br/>     
                      <div class="row">
                        <div class="col-md-4">                      
                          <div class="form-group">
                            <label class="col-lg-3">Teléfono</label>
                            <div class="col-lg-9">
                              <div class="input-group">
                                  <div class="input-group">
                                      <input ng-model = "vm.usuario.telefono"  class="form-control"/>  
                                  </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="col-lg-3">Celular</label>
                            <div class="col-lg-8">
                              <div class="input-group">
                                  <input ng-model="vm.usuario.celular"  class="form-control"/>  
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group" ng-class="{ 'has-error': userForm.email.$touched && userForm.email.$invalid }">
                            <label class="col-lg-3">Email</label>
                            <div class="col-lg-9">
                              <input type="email" name="email" class="form-control" ng-model="vm.usuario.email" required>  
                              <div class="help-block" ng-messages="userForm.email.$error" ng-if="userForm.email.$touched">
                                <p ng-message="required">Campo requerido</p>
                                <p ng-message="email">Ingrese email válido</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- datos acompañante -->
                     <div ng-show="vm.mostrar_colores == true">
                      <div  class="widget-head">
                        <div class="pull-left">Visualizacion en calendario</div>
                        <div class="widget-icons pull-right">
                          <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                        </div>  
                        <div class="clearfix"></div>
                      </div>
                      <div class="widget-content">
                        <div class="padd">
                          <div class="form">                             
                            <div class="row">
                              <div class="col-md-4">                    
                                <div class="form-group">
                                   <label class="col-lg-3">Color</label>
                                   <div class="col-lg-9">
                                    <input
                                      minicolors="vm.customSettings"
                                      id="color-input"
                                      class="form-control"
                                      type="text"
                                      ng-model="vm.usuario.color">
                                    </div>
                                </div>
                              </div>
                              <div class="col-md-8">                    
                                <div class="form-group">
                                   <label class="col-lg-3">Colores ya usados</label>
                                   <div class="col-lg-9">
                                      <span ng-repeat="color in vm.colores_usados"class="label_colores" style="{{color.color}}">  </span>
                                    </div>
                                </div>
                              </div>
                            <br/>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- datos acompañante -->
                 <div ng-show="vm.mostrar_zona == true">
                  <div  class="widget-head">
                    <div class="pull-left">Zona de ventas</div>
                    <div class="widget-icons pull-right">
                      <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                    </div>  
                    <div class="clearfix"></div>
                  </div>
                  <div class="widget-content">
                    <div class="padd">
                      <div class="form">                             
                        <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="col-lg-3" for="content">Zona</label>
                            <div class="col-lg-9">
                              <multiselect  ng-model="vm.usuario.zona" options="zona.nombre for zona in vm.zonas" data-multiple="true" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5"></multiselect>  
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="col-lg-3" for="content">Rol</label>
                            <div class="col-lg-9"> 
                              <multiselect  ng-model="vm.usuario.rol_zona" options="zona_rol.nombre for zona_rol in vm.roles_zonas" data-multiple="false" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5"></multiselect>                                 
                            </div>
                          </div>
                        </div>
                        <br/>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                  <br>
                  <div class="row">
                    <div class="widget">
                      <div class="widget-buttons">
                        <div class="col-md-12 col-lg-offset-10">  
                          <input class="btn btn-success btn-lg"  type="submit" value="Grabar usuario" ng-click="vm.validar_formulario(userForm)"/>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
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

        vm.sortKey = false;
        vm.reverse = false;
        vm.itemsMostrar = '20';
        vm.usuario = {};
        vm.mostrar_colores = false;
        vm.mostrar_zona    = false;

        vm.especialidades = JSON.parse('<?php echo $especialidades; ?>');
        vm.colores_usados = JSON.parse('<?php echo $colores_usados; ?>');
        vm.husos_horarios = JSON.parse('<?php echo $husos_horarios; ?>');
        vm.zonas          = JSON.parse('<?php echo $zonas_ventas; ?>');
        vm.roles_zonas    = JSON.parse('<?php echo $roles_profesional_zona; ?>');
        vm.usuario.huso_horario = vm.husos_horarios[0];


        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }

      vm.ordenarTabla         = ordenarTabla;
      vm.guardar_usuario      = guardar_usuario;
      vm.validar_formulario   = validar_formulario;
      vm.activar_colores      = activar_colores;
      vm.usuario.color = '#dfdfdf';
      vm.customSettings = {
        control: 'brightness',
        theme: 'bootstrap',
        position: 'top left'
      };


      function activar_colores(especialidad){
        if(especialidad.nombre == 'Enfermera Clínica' || especialidad.nombre == 'Enfermera PAD' || especialidad.nombre == 'Técnico enfermería' || especialidad.nombre == 'Enfermera coordinadora técnica CMC'){
          vm.mostrar_colores = true;
        }else{
          vm.mostrar_colores = false;
        }
        if(especialidad.nombre == 'Vendedor'){
          vm.mostrar_zona = true;
        }else{
          vm.mostrar_zona = false;
        }
      }

    function validar_formulario(userForm){
      var error =false;

      if(userForm.rut.$invalid){
        userForm.rut.$touched = true;
        error = true;
      }
      if(userForm.especialidad.$invalid){
        userForm.especialidad.$touched = true;
        error = true;
      }
      if(userForm.huso_horario.$invalid){
        userForm.huso_horario.$touched = true;
        error = true;
      }
      if(userForm.nombres.$invalid){
        userForm.nombres.$touched = true;
        error = true;
      }
      if(userForm.apellido_paterno.$invalid){
        userForm.apellido_paterno.$touched = true;
        error = true;
      }
      if(userForm.nombre_usuario.$invalid){
        userForm.nombre_usuario.$touched = true;
        error = true;
      }
      if(userForm.password.$invalid){
        userForm.password.$touched = true;
        error = true;
      }
      if(userForm.email.$invalid){
        userForm.email.$touched = true;
        error = true;
      }

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

      $http.post('<?php echo base_url(); ?>usuarios/set_usuario', data, config)
          .then(function(response){
              if(response.data !== 'false'){
                console.log(response.data);
                if(response.data){
                  window.location ='<?php echo base_url(); ?>usuarios/listado_usuarios/';

                }
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
