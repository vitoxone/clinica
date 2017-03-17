<div id="wrapper" ng-app="myApp">
 <div id="page-wrapper" ng-controller="PasswordController as vm">
  <div class="bread-crumb pull-left">
    <a href="<?php echo base_url(); ?>"><i class="icon-home"></i> Home</a> 
      <span class="divider">/</span> 
        <a href="<?php echo base_url(); ?>/usuarios/listado_usuarios" class="bread-current">Usuarios</a>
        <span class="divider">/</span>
        <a href="#" class="bread-current">Usuario: {{vm.usuario.nombres}} {{vm.usuario.apellido_paterno}} {{vm.usuario.apellido_materno}} </a> 
  </div>
    <div class="clearfix"></div>
      <hr />
      <div class="container">
        <div class="admin-form">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="widget">
                  <div class="widget-head">
                    <i class="icon-lock"></i> Cambio contraseña 
                  </div>
                  <div class="widget-content" ng-if="vm.cambio_password_success == 0">
                    <div class="padd">      
                      <form class="form-horizontal" name="userForm" novalidate>  
                          <div class="form-group" ng-class="{ 'has-error': userForm.password.$touched && userForm.password.$invalid }">
                            <label class="col-lg-3" for="content">Nueva contraseña</label>
                            <div class="col-lg-9">
                                <input type= "password" ng-model = "vm.usuario.password" name="password" class="form-control" required/>
                                <div class="help-block" ng-messages="userForm.password.$error" ng-if="userForm.password.$touched">
                                <p ng-message="required">Campo requerido</p>
                              </div>
                            </div>
                          </div> 
                          <div class="form-group" ng-class="{ 'has-error': userForm.password_repit.$touched && userForm.password_repit.$invalid }">
                            <label class="col-lg-3" for="content">Repetir nueva contraseña</label>
                            <div class="col-lg-9">
                                <input type= "password" ng-model = "vm.usuario.password_repit" name="password_repit" class="form-control" required/>
                                <div class="help-block" ng-messages="userForm.password_repit.$error" ng-if="userForm.password_repit.$touched">
                                  <p ng-message="required">Campo requerido</p>
                                </div>
                            </div>
                          </div> 
                          <div class="help-block" ng-if="vm.no_iguales">
                              <p>Las contraseñas no coiciden</p>
                          </div>                                       
                    </form>
                  </div>
                  <div class="widget-foot">
                    <div class="col-md-12 col-lg-offset-10"> 
                      <form class="form-inline">
                          <input class="btn btn-danger btn-md"  type="button" value="Grabar" ng-click="vm.validar_formulario(userForm)"/>
                      </form>
                    </div>
                  </div> 
                </div>
                <div class="widget-content" ng-if="vm.cambio_password_success">
                  <div class="alert alert-info">
                      Ha cambiado su contraseña satisfactoriamente.
                  </div>
                </div> 
              </div>  
            </div>
          </div>
        </div> 
      </div>
  <div id="modal_verificar_usuario" class="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Verificación de usuario</h4>            
        </div>
        <div class="modal-body">                            
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                  <label class="col-lg-3">Profesional</label>
                  <div class="col-lg-9">
                      <div class="input-group">
                        <h4>{{vm.usuario.nombres}} {{vm.usuario.apellido_paterno}}</h4>
                      </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                  <label class="col-lg-3">Contraseña actual</label>
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
            <button type="button" class="btn btn-danger" ng-click="vm.verificar_usuario()">Verificar</button>
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
    angular.module('myApp').controller('PasswordController', PasswordController);


    PasswordController.$inject = ['$http', '$timeout','minicolors'];
    function PasswordController($http){
        var vm = this;

        vm.usuario = {};
        vm.usuario = JSON.parse('<?php echo $usuario; ?>');
        vm.cambio_password_success = 0;

        vm.modal_verificar_usuario = modal_verificar_usuario;
        vm.verificar_usuario = verificar_usuario;
        vm.validar_formulario = validar_formulario;

        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }


    function validar_formulario(userForm){
      var error =false;
      vm.no_iguales = false;

      if(userForm.password.$invalid){
        userForm.password.$touched = true;
        error = true;
      }
      if(userForm.password_repit.$invalid){
        userForm.password_repit.$touched = true;
        error = true;
      }
      if(vm.usuario.password_repit !== vm.usuario.password){
        vm.no_iguales = true;
        error = true;
      }else{
            vm.no_iguales = false;
          error = false;
      }

      if(!error){
        modal_verificar_usuario();
      }

    }

    function actualizar_password() {

      var data = $.param({
          usuario: vm.usuario
      });

      $http.post('<?php echo base_url(); ?>usuarios/update_password_usuario', data, config)
          .then(function(response){
              if(response.data !== 'false'){
                vm.cambio_password_success = 1;
              }
          },
          function(response){
              console.log("error al actualizar password.");
          }
      );
            
    };

    function modal_verificar_usuario(datos){
      vm.datos_verificar = datos;
      vm.error_verificacion_usuario = '';
      $('#modal_verificar_usuario').appendTo("body").modal('show');
    }

    function verificar_usuario() {
      var data = $.param({
          password: vm.password_verificar
      });
      console.log("sdsdsd");

      $http.post('<?php echo base_url(); ?>usuarios/verificar_password/', data, config)
          .then(function(response){
              if(response.data !== 'false'){
                if(response.data == 1){
                  console.log(response.data);
                  $('#modal_verificar_usuario').modal('hide');
                    actualizar_password();
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
    }
})();

</script> 
