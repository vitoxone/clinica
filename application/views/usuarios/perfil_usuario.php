<div id="wrapper" ng-app="myApp">
 <div id="page-wrapper" ng-controller="UsuariosController as vm">
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
                <div class="row">
                  <div class="col-md-8">            
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
                              <div class="col-md-6">
                                <div class="form-group" ng-class="{ 'has-error': userForm.rut.$touched && userForm.rut.$invalid}">
                                  <label class="col-lg-3" for="content">Rut</label>
                                  <div class="col-lg-9">
                                      <input disabled ng-rut rut-format="live" ng-model = "vm.usuario.rut" name="rut" class="form-control" style="text-transform:uppercase" required/>
                                      <div class="help-block" ng-messages="userForm.rut.$error" ng-if="userForm.rut.$touched">
                                      <p ng-message="required">Campo requerido</p>
                                      <p ng-message="rut">Rut invalido</p>
                                    </div>
                     
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group" ng-class="{ 'has-error': userForm.especialidad.$touched && userForm.especialidad.$invalid }">
                                  <label class="col-lg-3" for="content">Especialidad</label>
                                  <div class="col-lg-9">
                                    <multiselect disabled name="especialidad" ng-model="vm.usuario.especialidad" options="especialidad.nombre for especialidad in vm.especialidades" data-multiple="false" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5" required></multiselect>  
                                      <div class="help-block" ng-messages="userForm.especialidad.$error" ng-if="userForm.especialidad.$touched">
                                      <p ng-message="required">Campo requerido</p>
                                    </div>
                     
                                  </div>
                                </div>
                              </div>
                            </div>
                            <br/>
                            <div class="row">
                              <div class="col-md-6">
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
                              <div class="col-md-6">
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
                            </div>
                            <br/>
                            <div class="row">
                              <div class="col-md-6">                      
                                <div class="form-group">
                                  <label class="col-lg-3">Apellido materno</label>
                                  <div class="col-lg-9">
                                      <input ng-model="vm.usuario.apellido_materno" class="form-control" style="text-transform:uppercase"/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group" ng-class="{ 'has-error': userForm.nombre_usuario.$touched && userForm.nombre_usuario.$invalid }">
                                  <label class="col-lg-3" for="content">Nombre usuario</label>
                                  <div class="col-lg-9">
                                      <input disabled ng-model = "vm.usuario.nombre_usuario" name="nombre_usuario" class="form-control" required/>
                                      <div class="help-block" ng-messages="userForm.nombre_usuario.$error" ng-if="userForm.nombre_usuario.$touched">
                                      <p ng-message="required">Campo requerido</p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <br/>     
                            <div class="row">
                              <div class="col-md-6">                      
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
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="col-lg-3">Celular</label>
                                  <div class="col-lg-8">
                                    <div class="input-group">
                                        <input ng-model="vm.usuario.celular"  class="form-control"/>  
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <br/> 
                            <div class="row">
                              <div class="col-md-6">
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
                       <div ng-show="vm.usuario.id_especialidad == 4">
                        <div  class="widget-head">
                          <div class="pull-left">Visualización en calendario</div>
                          <div class="widget-icons pull-right">
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
                                  </div>
                <div class="widget-foot">
                  <div class="col-md-12 col-lg-offset-9"> 
                    <form class="form-inline"> 
                      <input class="btn btn-success btn-lg"  type="submit" value="Actualizar datos" ng-click="vm.validar_formulario(userForm)"/>
                    </form>
                  </div>
                </div>

            </div>
          </div>
          <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Contraseña</div>
            <div class="widget-icons pull-right">
              <span></span>
            </div>  
            <div class="clearfix"></div>
          </div>
            <div class="widget-content">
              <div class="padd">
                <div class="form">                             
                  <div class="row">
                    <div class="col-md-4">                    
                      <div class="form-group">
                         <label class="col-lg-3">Actual</label>
                         <div class="col-lg-9">
                            <input class="form-control" type="password" ng-model="vm.usuario.password_actual"> 
                          </div>
                      </div>
                    </div>
                    <div class="col-md-4">                    
                      <div class="form-group">
                         <label class="col-lg-3">Nueva</label>
                         <div class="col-lg-9">
                            <input class="form-control" type="password" ng-model="vm.usuario.password_nuevo"> 
                          </div>
                      </div>
                    </div>
                    <div class="col-md-4">                    
                      <div class="form-group">
                         <label class="col-lg-3">Repetir nueva</label>
                         <div class="col-lg-9">
                            <input class="form-control" type="password" ng-model="vm.usuario.password_nuevo_repetido"> 
                          </div>
                      </div>
                    </div>
                  <br/>
                </div>
              </div>
            </div>
          </div>
          <div class="widget-foot">
            <div class="col-md-12 col-lg-offset-10"> 
              <form class="form-inline">
                  <button type="submit" class="btn btn-danger">Grabar</button>
              </form>
            </div>
          </div>
        </div>
        </div>
        <div ng-show="vm.usuario.id_especialidad == 4" class="col-md-4">
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Listado de insumos</div>
            <div class="widget-icons pull-right">
              <span><span class="label label-primary">{{vm.insumos_profesional.length}}</span>  Insumos</span>
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
                            <input type="text" ng-model="vm.search" class="form-control" placeholder="DESCRIPCIÓN...">
                          </div>
                        </div>
                      </div>
                  </div>
                </form>
              </div>
            <table ng-show = "vm.insumos_profesional.length > 0" class="table table-striped table-bordered table-hover">
              <thead ng-show="vm.tipo_dispositivo == 'movil'">
                <tr>
                  <th ng-click="vm.ordenarTabla('sap')">SAP
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='sap'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                  <th class="text-center" ng-click="vm.ordenarTabla('unidad_medida')">U/M
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='unidad_medida'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                  <th class="text-center" ng-click="vm.ordenarTabla('stock_unitario')">CANTIDAD UNITARIA
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='stock_unitario'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                </tr>
              </thead>
              <thead ng-show="vm.tipo_dispositivo != 'movil'">
                <tr>
                  <th ng-click="vm.ordenarTabla('descripcion_sap')">DESCRIPCIÓN
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='descripcion_sap'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                  <th class="text-center" ng-click="vm.ordenarTabla('stock_unitario')">CANTIDAD UNITARIA
                    <span class="glyphicon sort-icon" ng-show="vm.sortKey=='stock_unitario'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr  dir-paginate="insumo in vm.insumos_profesional|orderBy:vm.sortKey:vm.reverse|filter:vm.search|itemsPerPage:vm.itemsMostrar">

                 <td ng-show="vm.tipo_dispositivo != 'movil'"><a  style="text-transform:uppercase" ng-click="vm.mostrar_modal(insumo)"</a>{{insumo.descripcion_sap}}</td>
                  <td>
                    <div class="input-group"> 
                     <input disabled type="number" ng-model="insumo.stock_unitario" class="form-control" style="width:50%" />
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
        vm.itemsMostrar = '7';
        vm.usuario = {};
        vm.mostrar_colores = false;
        vm.usuario = JSON.parse('<?php echo $usuario; ?>');
        vm.colores_usados = JSON.parse('<?php echo $colores_usados; ?>');  
        vm.insumos_profesional = JSON.parse('<?php echo $insumos_profesional; ?>');

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

      if(userForm.especialidad.$invalid){
        userForm.especialidad.$touched = true;
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
    }
})();

</script> 
