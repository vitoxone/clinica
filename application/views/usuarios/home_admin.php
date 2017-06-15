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
                <div class="col-md-3"></div>
                <div class="col-md-8">
                  <ul class="today-datas">
                    <li>
                      <div>
                        <span id="todayspark1" class="spark">                  
                          <div class="dashboard-info-card-data">
                            <div class="dashboard-info-card-bubble"><i class="icon-user"></i></div>
                              <div class="dashboard-info-card-data-title">
                                {{vm.nro_pacientes_verificados}}
                              </div>
                          </div>
                        </span>
                      </div>
                      <div class="datas-text">Nº pacientes verificados</div>
                    </li>
                    <li>
                      <div>
                        <span id="todayspark2" class="spark">
                          <div class="dashboard-info-card-data">
                            <div class="dashboard-info-card-bubble"><i class="icon-user"></i></div>
                              <div class="dashboard-info-card-data-title">
                                {{vm.pacientes_sin_verificar.length}}
                              </div>
                          </div>
                        </span>
                      </div>
                      <div class="datas-text">Nº pacientes sin verificar</div>
                    </li>
                    <li>
                      <div>
                        <span id="todayspark3" class="spark">                  
                          <div class="dashboard-info-card-data">
                            <div class="dashboard-info-card-bubble"><div class="col-lg-4" style="width: 50px; height: 30px; background-image: url('<?php echo base_url(); ?>assets/img/contigo_white.png');"></div></div>
                            <div class="dashboard-info-card-data-title">
                              {{vm.nro_ventas_contigo}}
                          </div>
                          </div>
                        </span>
                      </div>
                      <div class="datas-text">Nº total contigo</div>
                    </li>
                    <li>
                      <div>
                        <span id="todayspark4" class="spark">                  
                          <div class="dashboard-info-card-data">
                            <div class="dashboard-info-card-bubble"><div class="col-lg-4" style="width: 50px; height: 30px; background-image: url('<?php echo base_url(); ?>assets/img/PAD_white.png');"></div></div>
                            <div class="dashboard-info-card-data-title">
                              {{vm.nro_ventas_domiciliario}}
                          </div>
                          </div>
                        </span>
                      </div>
                      <div class="datas-text">Nº total domiciliario</div>
                    </li>                                                                                                               
                  </ul>
                </div>
                  <div class="col-md-2"></div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="widget">
                      <div class="widget-head">
                        <div class="pull-left">Listado de pacientes nuevos</div>
                        <div class="widget-icons pull-right">
                          <span><span class="label label-primary">{{vm.pacientes_sin_verificar.length}}</span>  Pacientes nuevos</span>
                        </div>  
                        <div class="clearfix"></div>
                      </div>

                      <div class="widget-content" ng-show = "vm.pacientes_sin_verificar.length > 0">
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
                          <table class="table table-striped table-bordered table-hover">
                            <thead ng-show="vm.tipo_dispositivo == 'movil'">
                              <tr>
                                <th ng-click="vm.ordenarTabla('sap')">NOMBRE
                                  <span class="glyphicon sort-icon" ng-show="vm.sortKey=='nombre'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                                </th>
                                <th class="text-center" ng-click="vm.ordenarTabla('unidad_medida')">TIPO
                                  <span class="glyphicon sort-icon" ng-show="vm.sortKey=='tipo'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                                </th>
                                <th class="text-center" ng-click="vm.ordenarTabla('stock_unitario')">VENDEDOR
                                  <span class="glyphicon sort-icon" ng-show="vm.sortKey=='vendedor'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                                </th>
                              </tr>
                            </thead>
                            <thead ng-show="vm.tipo_dispositivo != 'movil'">
                              <tr>
                                <th ng-click="vm.ordenarTabla('descripcion_sap')">NOMBRE
                                  <span class="glyphicon sort-icon" ng-show="vm.sortKey=='descripcion_sap'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                                </th>
                                <th class="text-center" ng-click="vm.ordenarTabla('stock_unitario')">VENDEDOR
                                  <span class="glyphicon sort-icon" ng-show="vm.sortKey=='stock_unitario'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                                </th>
                                <th class="text-center" ng-click="vm.ordenarTabla('contigo')">¿Contigo?
                                  <span class="glyphicon sort-icon" ng-show="vm.sortKey=='contigo'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                                </th>
                                <th class="text-center" ng-click="vm.ordenarTabla('domiciliario')">¿PAD?
                                  <span class="glyphicon sort-icon" ng-show="vm.sortKey=='domiciliario'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                                </th>
                                <th class="text-center" ng-click="vm.ordenarTabla('created')">FECHA REGISTRO
                                  <span class="glyphicon sort-icon" ng-show="vm.sortKey=='created'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                                </th>
                                <th class="text-center" ng-click="vm.ordenarTabla('stock_unitario')">ACCIONES
                                  <span class="glyphicon sort-icon"></span>
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr  dir-paginate="paciente in vm.pacientes_sin_verificar|orderBy:vm.sortKey:vm.reverse|filter:vm.search|itemsPerPage:vm.itemsMostrar">

                               <td ng-show="vm.tipo_dispositivo != 'movil'"><a  style="text-transform:uppercase" ng-click="vm.mostrar_modal_paciente(paciente)">{{paciente.nombre}}</a>   <span ng-show="paciente.corregido == true" class="label label-success">Corregido</span></td></td>
                                <td>{{paciente.nombre_vendedor}}</td>
                                <td class="text-center"><span ng-if="paciente.contigo == 1" class="label label-success">Si</span><span ng-if="paciente.contigo == 0" class="label label-danger">No</span></td>
                                <td class="text-center"><span ng-if="paciente.domiciliario == 1" class="label label-success">Si</span><span ng-if="paciente.domiciliario == 0" class="label label-danger">No</span></td>
                                <td>{{paciente.fecha_registro}}</td>
                                <td><a class="btn {{paciente.nombre_objetado}} btn-xs" ng-click="vm.mostrar_modal_paciente(paciente)"</a>Verificar</td>
                              </tr>
                            </tbody>
                          </table>
                          <dir-pagination-controls
                            max-size="5"
                            direction-links="true"
                            boundary-links="true" >
                          </dir-pagination-controls>
                        </div>
                        <div class="alert alert-info" ng-show = "vm.pacientes_sin_verificar.length == 0">
                          No existen pacientes por verificar
                        </div>
                    </div>

                  </div> 
              </div>
            </div>
            <div id="modal-paciente" class="modal fade" tabindex='9000'>
                <div class="modal-dialog">
                  <div class="modal-content" style="width: 900px;  margin-left:-120px; margin-right:auto;">
                    <div class="modal-header-convatec convatec-bgcolor-1">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                          Detalle paciente
                    </div>         
                    <div class="modal-body">                                       
                        <div class="widget-content">
                          <div class="padd">
                            <form name="userForm" novalidate>                               
                              <div class="row">
                                <div class="col-md-4" ng-show = "true">                    
                                  <div class="form-group" ng-class="{ 'has-error': userForm.especialidad.$touched && userForm.especialidad.$invalid }">
                                    <label class="col-lg-3" for="content">Tipo documento</label>
                                    <div class="col-lg-9">
                                      <!--<multiselect name="especialidad" ng-model="vm.usuario.especialidad" options="especialidad.nombre for especialidad in vm.especialidades" data-multiple="false" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5" required></multiselect> -->  
                                      <select class="form-control" name="tipo_documento" id="mySelect" ng-options="tipo_documento_identificacion.nombre for tipo_documento_identificacion in vm.tipos_documentos track by tipo_documento_identificacion.id_tipo_documento" ng-model="vm.paciente.tipo_documento_identificacion" title="Seleccione especialidad" required></select>
                                        <div class="help-block" ng-messages="userForm.especialidad.$error" ng-if="userForm.especialidad.$touched">
                                        <p ng-message="required">Campo requerido</p>
                                      </div>
                       
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-4">                    
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
                                    <label class="col-lg-3" for="content" style="display: inline-flex;">Nombres</label>
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
                                    <label class="col-lg-3" for="content" style="display: inline-flex;">Apellido paterno</label>
                                    <div class="col-lg-9">
                                        <input ng-model = "vm.paciente.apellido_paterno" name="apellido_paterno" class="form-control" style="text-transform:uppercase" required/>
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
                                        <input ng-model="vm.paciente.apellido_materno" class="form-control" style="text-transform:uppercase"/>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <br/>
                              <br/>     
                              <div class="row">
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
                                <div class="col-md-4">
                                  <div class="form-group required" ng-class="{ 'has-error': userForm.telefono.$touched && userForm.telefono.$invalid }">
                                    <label class="col-lg-3" for="content" style="display: inline-flex;">Telefono1</label>
                                    <div class="col-lg-9">
                                        <input ng-model = "vm.paciente.telefono" name="telefono" class="form-control" style="text-transform:uppercase" required/>
                                        <div class="help-block" ng-messages="userForm.telefono.$error" ng-if="userForm.telefono.$touched">
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
                                <div class="col-md-4">                    
                                  <div class="form-group">
                                    <label class="col-lg-3">Fecha cirugía</label>
                                    <div class="col-lg-9">
                                      <div class="input-group">
                                        <input type="text" class="form-control" uib-datepicker-popup datepicker-popup="yyyy-mm-dd" ng-model="vm.paciente.fecha_cirugia" is-open="vm.popup_tratamiento_actual_fecha_cirugia.opened" ng-required="true" close-text="Close" />
                                        <span ng-click="vm.tratamientoActualFechaCirugia()" class="input-group-addon btn btn-info btn-lg"><i class="icon-calendar"></i></span>
                                      </div>
                                    </div>   
                                  </div>
                                </div>
                              </div>
                              <br>
                              <hr>
                              <div class="row">
                                <div class="col-md-6">  
                                  <div class="form-group">
                                    <label class="col-lg-4">Institución salud</label>
                                    <div class="col-lg-8">
                                      <multiselect style="padding-right: 200px;overflow: hidden;text-overflow: ellipsis;" ng-model="vm.paciente.establecimiento" options="establecimiento.nombre for establecimiento in vm.establecimientos" data-multiple="false" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5" ng-change ="vm.cargar_medicos_establecimiento()"></multiselect>  
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
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
                              <hr />
                              <div class="row">
                                <div class="col-lg-4">
                                  <div class="form-group">
                                    <label class="col-lg-4 control-label">Verificar</label>
                                    <div class="col-lg-8">
                                      <div class="radio">
                                        <label>
                                          <input type="radio" name="optionsRadios" id="radio_validar" value="option1" checked ng-click="vm.show_comentario_validacion = false; vm.show_objetar_paciente = false">
                                          Verificar sin comentarios
                                        </label>
                                      </div>
                                      <div class="radio">
                                        <label>
                                          <input type="radio" name="optionsRadios" id="radio_validar_comentar" value="option2" ng-click="vm.show_comentario_validacion = true; vm.show_objetar_paciente = false">
                                          Verificar con comentarios
                                        </label>
                                      </div>
                                      <div class="radio">
                                        <label>
                                          <input type="radio" name="optionsRadios" id="radio_objetar" value="option2" ng-click="vm.show_comentario_validacion = true; vm.show_objetar_paciente = true">
                                          Objetar y comentar
                                        </label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-8">
                                  <label ng-show="vm.show_comentario_validacion" class="col-lg-2">Comentario</label>
                                  <div class="col-lg-10">
                                    <textarea  ng-show="vm.show_comentario_validacion" ng-model="vm.paciente.comentario_validacion" class="form-control textarea" style="text-transform:uppercase; height: 96px;"></textarea>
                                  </div>
                                </div> 
                              </div>                     
                            </form>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <div class="row">
                          <div class="col-md-12">
                              <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                              <input ng-show="vm.show_objetar_paciente" class="btn btn-danger"  type="button" value="Objetar paciente" ng-click="vm.validar_formulario(userForm, 1, 0)"/>  
                              <input class="btn btn-success"  type="button" value="Aceptar" ng-click="vm.validar_formulario(userForm, 0, 1)"/>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- fin modal paciente -->
              <div id="modal_registro_medico" class="modal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">Nuevo médico</h4>            
                    </div>
                    <div class="modal-body">                            
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                              <label class="col-lg-3">Institución salud</label>
                            <div class="col-lg-9">
                               <multiselect ng-model="vm.nuevo_medico.establecimiento" options="establecimiento.nombre for establecimiento in vm.establecimientos" data-multiple="false" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5"></multiselect>  
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                              <label class="col-lg-3">Nombre</label>
                              <div class="col-lg-9">
                                  <div class="input-group">
                                    <input ng-model="vm.nuevo_medico.nombres" type="text" class="form-control" />
                                  </div>
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                              <label class="col-lg-3">Especialidad</label>
                            <div class="col-lg-9">
                               <multiselect ng-model="vm.nuevo_medico.especialidad" options="especialidad.nombre for especialidad in vm.especialidades" data-multiple="false" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5"></multiselect>  
                            </div>
                          </div>
                        </div>
                      </div>
                      <br/>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                        <button type="button" class="btn btn-primary" ng-click="vm.guardar_nuevo_medico()">Guardar</button>
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
    function UsuariosController($http, $location, $window){
        var vm = this;

        vm.sortKey = false;
        vm.reverse = false;
        vm.itemsMostrar = '7';
        vm.usuario = {};
        vm.usuario = JSON.parse('<?php echo $usuario; ?>');
        vm.nro_pacientes_verificados = JSON.parse('<?php echo $nro_pacientes_verificados; ?>');
        vm.nro_pacientes_sin_verificar = JSON.parse('<?php echo $nro_pacientes_sin_verificar; ?>');
        vm.pacientes_sin_verificar = JSON.parse('<?php echo $pacientes_sin_verificar; ?>');
        vm.ventas_mensuales = JSON.parse('<?php echo $ventas_mensuales; ?>');
        vm.nro_ventas_contigo =   '<?php echo $nro_ventas_contigo ?>';
        vm.nro_ventas_domiciliario =   '<?php echo $nro_ventas_domiciliario ?>';

        vm.tipos_documentos = JSON.parse('<?php echo $tipos_documentos; ?>');
        vm.isapres = JSON.parse('<?php echo $isapres; ?>');
        vm.regiones = JSON.parse('<?php echo $regiones; ?>');
        vm.documento = JSON.parse('<?php echo $documento; ?>');
        vm.establecimientos = JSON.parse('<?php echo $establecimientos; ?>');
        vm.especialidades = JSON.parse('<?php echo $especialidades; ?>');

        vm.paciente = {};
        vm.paciente.tipo_documento_identificacion = vm.documento;

        vm.opened = false;

        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }

      vm.ordenarTabla                     = ordenarTabla;
      vm.guardar_usuario                  = guardar_usuario;
      vm.validar_formulario               = validar_formulario;
      vm.activar_colores                  = activar_colores;
      vm.mostrar_modal_paciente           = mostrar_modal_paciente;
      vm.cargar_comunas                   = cargar_comunas;
      vm.abrirModalRegistroMedicos        = abrirModalRegistroMedicos;
      vm.guardar_nuevo_medico             = guardar_nuevo_medico;
      vm.cargar_medicos_establecimiento   = cargar_medicos_establecimiento;
      vm.tratamientoActualFechaCirugia    = tratamientoActualFechaCirugia;

      vm.customSettings = {
        control: 'brightness',
        theme: 'bootstrap',
        position: 'top left'
      };

      vm.popup_tratamiento_actual_fecha_cirugia = {
        opened: false
      };

    function mostrar_modal_paciente(paciente){
      var data = $.param({
          paciente: paciente.id_paciente
      });

      $http.post('<?php echo base_url(); ?>pacientes/get_paciente', data, config)
          .then(function(response){
              if(response.data !== 'false'){
                if(response.data){
                  vm.paciente = response.data;
                  if(response.data.objetado == 1){
                      vm.show_comentario_validacion = true;
                      vm.show_objetar_paciente = true;
                      document.getElementById("radio_objetar").checked = true;
                  }
                  else{
                      vm.show_comentario_validacion = false;
                      vm.show_objetar_paciente = false;
                      document.getElementById("radio_validar").checked = true;
                  }

                  vm.paciente.fecha_cirugia    = new Date(vm.paciente.fecha_cirugia);
                  //radio_validar = document.getElementById("radio_validar");
                  
                  //radio_validar.checked = true;
                  $('#modal-paciente').appendTo("body").modal('show');
                }
              }
          },
          function(response){
              console.log("error al obtener comunas.");
          }
      );
    }

    function get_pacientes_sin_verificar(){

        $http.get('<?php echo base_url(); ?>pacientes/get_pacientes_sin_verificar')
          .then(function(response) {
            console.log(response.data);
              vm.pacientes_sin_verificar = response.data;
          
          }, function(response) {
            console.log("error al obtener los insumos")
        });
     }

    function cargar_medicos_establecimiento(){
      var data = $.param({
          establecimiento: vm.paciente.establecimiento.id_establecimiento,
      });
      vm.medicos = '';
      // vm.diagnostico.medico_tratante = '';
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

    function tratamientoActualFechaCirugia() {
      vm.popup_tratamiento_actual_fecha_cirugia.opened = true;
    };

    function guardar_nuevo_medico(){
          var data = $.param({
          medico: vm.nuevo_medico,
          establecimiento: vm.nuevo_medico.establecimiento.id_establecimiento
      });

      $http.post('<?php echo base_url(); ?>medicos/set_nuevo_medico', data, config)
          .then(function(response){
              if(response.data !== 'false'){

                if(response.data){
                  vm.medicos = response.data;
                }
              }
          },
          function(response){
              console.log("error al obtener comunas.");
          }
      );
         $('#modal_registro_medico').modal('hide');
          vm.nuevo_medico = false;
     }

    function activar_colores(especialidad){
        if(especialidad.nombre == 'Enfermera Clínica' || especialidad.nombre == 'Enfermera PAD' || especialidad.nombre == 'Técnico enfermería' || especialidad.nombre == 'Enfermera coordinadora técnica CMC'){
          vm.mostrar_colores = true;
        }else{
          vm.mostrar_colores = false;
        }
      }

    function abrirModalRegistroMedicos() {
      $('#modal_registro_medico').appendTo("body").modal('show');
        
    } 

    function validar_formulario(userForm, objetar, validar){
      var error =false;

      if(userForm.rut.$invalid){
        userForm.rut.$touched = true;
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
      if(!error){
        moment.locale('es');
        if(vm.paciente.fecha_nacimiento){
            
            var fecha_nacimiento = moment(vm.paciente.fecha_nacimiento).format('YYYY-MM-DD');
            vm.paciente.fecha_nacimiento = fecha_nacimiento;
        }
        if(vm.paciente.fecha_cirugia){
            var fecha_cirugia = moment(vm.paciente.fecha_cirugia).format('YYYY-MM-DD');
            vm.paciente.fecha_cirugia = fecha_cirugia;
        }

        //verificar_rut_unico();
        guardar_paciente(objetar, validar);
      }

    }

    function guardar_paciente(objetar, validar) {

      vm.paciente.objetar = objetar;
      vm.paciente.validar = validar;
      var data = $.param({

          paciente: vm.paciente
      });
      var id_paciente_antiguo = vm.paciente.id_paciente;

      $http.post('<?php echo base_url(); ?>pacientes/set_paciente', data, config)
          .then(function(response){
              if(response.data !== 'false'){
                  get_pacientes_sin_verificar();
                  $('#modal-paciente').modal('hide');
              }
          },
          function(response){
              console.log("error al guardar paciente.");
          }
      );
            
    };
    function ordenarTabla(keyname){
      vm.sortKey = keyname;   //set the sortKey to the param passed
      vm.reverse = !vm.reverse; //if true make it false and vice versa
    }

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

      function calcularEdad(fecha1)
      {
        var fecha = new Date(fecha1);
        var ultimoDiaMes;
        if(validate_fecha(fecha)==true)
        {
            // Si la fecha es correcta, calculamos la edad
            var dia = fecha.getDate();
            var mes = fecha.getMonth()+1;
            var ano = fecha.getFullYear();
     
            // cogemos los valores actuales
            var fecha_hoy = new Date();
            var ahora_ano = fecha_hoy.getYear();
            var ahora_mes = fecha_hoy.getMonth()+1;
            var ahora_dia = fecha_hoy.getDate();
     
            // realizamos el calculo
            var edad = (ahora_ano + 1900) - ano;
            if ( ahora_mes < mes )
            {
                edad--;
            }
            if ((mes == ahora_mes) && (ahora_dia < dia))
            {
                edad--;
            }
            if (edad > 1900)
            {
                edad -= 1900;
            }
     
            // calculamos los meses
            var meses=0;
            if(ahora_mes>mes)
                meses=ahora_mes-mes;
            if(ahora_mes<mes)
                meses=12-(mes-ahora_mes);
            if(ahora_mes==mes && dia>ahora_dia)
                meses=11;
     
            // calculamos los dias
            var dias=0;
            if(ahora_dia>dia)
                dias=ahora_dia-dia;
            if(ahora_dia<dia)
            {
                ultimoDiaMes=new Date(ahora_ano, ahora_mes, 0);
                dias=ultimoDiaMes.getDate()-(dia-ahora_dia);
            }
            
            var text_edad = "";
            if(edad > 0){
              text_edad = edad+" Años";
            }
            if(meses > 0){
              text_edad = text_edad +" "+meses+" meses";
            }

              text_edad = text_edad+" "+dias+" días";

            vm.paciente.edad =  text_edad;
        }else{
          vm.paciente.edad = "";
        }
      }
    }
})();

</script> 
