<div id="wrapper" ng-app="myApp">
 <div id="page-wrapper" ng-controller="VentasController as vm">
    <div class="page-head">
        <h2 class="pull-left"><i class="icon-file-alt"></i> Home vendedor</h2>
        <div class="bread-crumb pull-right">
          <a href="index.html"><i class="icon-home"></i> Home</a> 
          <span class="divider">/</span> 
          <a href="#" class="bread-current">Mis ventas</a>
        </div>
        <div class="clearfix"></div>
   </div>
    </br>
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <ul class="today-datas">
          <li>
            <div>
              <span id="todayspark2" class="spark">
                <div class="dashboard-info-card-data">
                  <div class="dashboard-info-card-bubble"><i class="icon-money"></i></div>
                    <div class="dashboard-info-card-data-title">
                      {{vm.ventas.length}}
                    </div>
                </div>
              </span>
            </div>
            <div class="datas-text">Nº total ventas</div>
          </li>
          <li>
            <div>
              <span id="todayspark3" class="spark">                  
                <div class="dashboard-info-card-data">
                  <div class="dashboard-info-card-bubble"><div class="col-lg-4" style="width: 50px; height: 30px;margin-top: 7px; background-image: url('<?php echo base_url(); ?>assets/img/contigo_white.png');"></div></div>
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
                  <div class="dashboard-info-card-bubble"><div class="col-lg-4" style="width: 50px; height: 30px;margin-top: 7px; background-image: url('<?php echo base_url(); ?>assets/img/PAD_white.png');"></div></div>
                  <div class="dashboard-info-card-data-title">
                    {{vm.nro_ventas_domiciliario}}
                </div>
                </div>
              </span>
            </div>
            <div class="datas-text">Nº total domiciliario</div>
          </li>  
          <li>
            <div>
              <span id="todayspark4" class="spark">                  
                <div class="dashboard-info-card-data">
                  <div class="dashboard-info-card-bubble"><div class="col-lg-4" style="width: 50px; height: 30px;margin-top: 7px; background-image: url('https://s3-us-west-1.amazonaws.com/convatec2017images1/oncovida_white.png');"></div></div>
                  <div class="dashboard-info-card-data-title">
                    {{vm.nro_ventas_oncovida}}
                </div>
                </div>
              </span>
            </div>
            <div class="datas-text">Nº total oncovida</div>
          </li>
          <li>
            <div>
              <span id="todayspark4" class="spark">                  
                <div class="dashboard-info-card-data">
                  <div class="dashboard-info-card-bubble"><div class="col-lg-4" style="width: 50px; height: 30px;margin-top: 7px; background-image: url('https://s3-us-west-1.amazonaws.com/convatec2017images1/cmc_white.png');"></div></div>
                  <div class="dashboard-info-card-data-title">
                    {{vm.nro_ventas_cmc}}
                </div>
                </div>
              </span>
            </div>
            <div class="datas-text">Nº total cmc</div>
          </li>                                                                                                             
        </ul>
      </div>
      <div class="col-md-2"></div>
      </div>
        <div class="row">
          <div class="col-md-2">
              <a href="<?php echo base_url()."pacientes/nuevo_paciente"?>" type="button" class="btn btn-success">Nueva venta</a>
          </div>
        </div>
      <div class="container">
          <div class="row">
            <div class="col-md-8">            
              <div class="widget">
                <div class="widget-head">
                  <div class="pull-left">Listado de ventas</div>
                  <div class="widget-icons pull-right">
                    <span><span class="label label-primary">{{vm.ventas.length}}</span></span>
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
                        <th ng-click="vm.ordenarTabla('id_paciente_vendedor')">CÓDIGO VENTA
                          <span class="glyphicon sort-icon" ng-show="vm.sortKey=='id_paciente_vendedor'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                        </th>
                        <th ng-click="vm.ordenarTabla('rut_paciente')">RUT PACIENTE
                          <span class="glyphicon sort-icon" ng-show="vm.sortKey=='rut_paciente'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                        </th>
                        <th class="text-center" ng-click="vm.ordenarTabla('nombre_paciente')">NOMBRE PACIENTE
                          <span class="glyphicon sort-icon" ng-show="vm.sortKey=='nombre_paciente'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                        </th>
                        <th class="text-center" ng-click="vm.ordenarTabla('email_paciente')">EMAIL
                          <span class="glyphicon sort-icon" ng-show="vm.sortKey=='email_paciente'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                        </th>
                        <th class="text-center" ng-click="vm.ordenarTabla('contigo')">CONTIGO
                          <span class="glyphicon sort-icon" ng-show="vm.sortKey=='contigo'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                        </th>
                        <th class="text-center" ng-click="vm.ordenarTabla('domiciliario')">PAD
                          <span class="glyphicon sort-icon" ng-show="vm.sortKey=='domiciliario'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                        </th>
                        <th class="text-center" ng-click="vm.ordenarTabla('oncovida')">ONCOVIDA
                          <span class="glyphicon sort-icon" ng-show="vm.sortKey=='oncovida'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                        </th>
                        <th class="text-center" ng-click="vm.ordenarTabla('cmc')">CMC
                          <span class="glyphicon sort-icon" ng-show="vm.sortKey=='cmc'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                        </th>
                        <th class="text-center" ng-click="vm.ordenarTabla('domiciliario')">FECHA
                          <span class="glyphicon sort-icon" ng-show="vm.sortKey=='domiciliario'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr dir-paginate="venta in vm.ventas|orderBy:vm.sortKey:vm.reverse|filter:vm.search|itemsPerPage:vm.itemsMostrar">
                        <td>{{venta.id_paciente_vendedor}}</td>
                        <td>{{venta.rut_paciente}}</td>
                        <td><a ng-click="vm.mostrar_modal_paciente(venta)" style="text-transform:uppercase; width: 30%;">{{venta.nombres_paciente}}</a></td>
                        <td>{{venta.email_paciente}}</td>
                        <td style="width: 5%;"><span ng-if="venta.contigo == 1" class="label label-success">Si</span><span ng-if="venta.contigo == 0" class="label label-danger">No</span></td>
                        <td style="width: 5%;"><span ng-if="venta.domiciliario == 1" class="label label-success">Si</span><span ng-if="venta.domiciliario == 0" class="label label-danger">No</span></td>                      
                        <td style="width: 5%;"><span ng-if="venta.oncovida == 1" class="label label-success">Si</span><span ng-if="venta.oncovida == 0" class="label label-danger">No</span></td>                      
                        <td style="width: 5%;"><span ng-if="venta.cmc == 1" class="label label-success">Si</span><span ng-if="venta.cmc == 0" class="label label-danger">No</span></td>                      
                        <td style="width: 15%;">{{venta.fecha_venta}}</td>
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
             <highchart id="chart1" config="vm.chartConfig"></highchart>
          </div>
         <div class="col-md-4">
            <div class="widget">
              <div class="widget-head">
                <div class="pull-left">Ventas Objetadas</div>
                  <div class="widget-icons pull-right">
                    <span><span class="label label-primary">{{vm.ventas_objetadas.length}}</span></span>
                  </div> 
              <div class="clearfix"></div>
            </div>             
          <div class="widget-content">
            <div class="padd">
              <table class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th>VENTA</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr ng-repeat="venta_objetada in vm.ventas_objetadas">
                    <td><a ng-click="vm.mostrar_modal_paciente(venta_objetada)" style="text-transform:uppercase">{{venta_objetada.nombres_paciente}}</a>  </td>
                     <td><a ng-show="venta_objetada.corregido == false" class="btn btn-warning btn-xs" ng-click="vm.mostrar_modal_paciente(venta_objetada)">Rectificar</a><span ng-show="venta_objetada.corregido == true" class="label label-success">Corregido - Verificando</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
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
                    <div class="row" ng-show="vm.show_comentario_validacion">
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="col-lg-4 control-label">Verificado</label>
                          <div class="col-lg-8">
                            <div class="radio" >
                              <label>
                                <input  type="radio" name="optionsRadios" id="radio_objetar" value="option2">
                                Objetada
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-8">
                        <label ng-show="vm.show_comentario_validacion" class="col-lg-2">Comentario</label>
                        <div class="col-lg-10">
                          <textarea disabled ng-show="vm.show_comentario_validacion" ng-model="vm.paciente.comentario_validacion" class="form-control textarea" style="text-transform:uppercase; height: 96px;"></textarea>
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
                    <input class="btn btn-danger"  type="button" value="Corregir" ng-click="vm.validar_formulario(userForm)"/>  
                    
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- fin modal nuevo paciente -->
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
  <script src="https://code.highcharts.com/stock/highstock.src.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/highcharts-ng.js"></script>
<script>
(function(){
    'use strict';
    angular.module('myApp', ['ui.bootstrap', 'ui.multiselect', 'ngAnimate','angularUtils.directives.dirPagination','minicolors','ngMessages', 'platanus.rut', 'highcharts-ng']);
    angular.module('myApp').controller('VentasController', VentasController);


    VentasController.$inject = ['$http', '$timeout','minicolors'];
    function VentasController($http){
        var vm = this;

        vm.sortKey = false;
        vm.reverse = false;
        vm.itemsMostrar = '7';
        vm.usuario = {};
        vm.mostrar_colores = false;
        vm.ventas = JSON.parse('<?php echo $ventas; ?>');
        vm.ventas_objetadas = JSON.parse('<?php echo $ventas_objetadas; ?>');
        vm.nro_ventas_contigo =   '<?php echo $nro_ventas_contigo ?>';
        vm.nro_ventas_domiciliario = '<?php echo $nro_ventas_domiciliario ?>';
        vm.nro_ventas_oncovida = '<?php echo $nro_ventas_oncovida ?>';
        vm.nro_ventas_cmc = '<?php echo $nro_ventas_cmc ?>';
        vm.ventas_mensuales = JSON.parse('<?php echo $ventas_mensuales; ?>');


        vm.tipos_documentos = JSON.parse('<?php echo $tipos_documentos; ?>');
        vm.regiones = JSON.parse('<?php echo $regiones; ?>');
        vm.establecimientos = JSON.parse('<?php echo $establecimientos; ?>');
       // transformar_entero();

        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }

      vm.ordenarTabla               = ordenarTabla;
      vm.guardar_usuario            = guardar_usuario;
      vm.validar_formulario         = validar_formulario;
      vm.activar_colores            = activar_colores;
      vm.mostrar_modal              = mostrar_modal;
      vm.mostrar_modal_paciente     = mostrar_modal_paciente;
      vm.tipo_documento_cambiar     = tipo_documento_cambiar;

    function transformar_entero(){
        for(var i=0; i<vm.ventas_mensuales.length; i++){
          vm.ventas_mensuales.y = parseInt(vm.ventas_mensuales.y);
        }
    }

    function mostrar_modal_paciente(paciente){



      if(paciente){
        var data = $.param({
            paciente: paciente.id_paciente
        });

        $http.post('<?php echo base_url(); ?>pacientes/get_paciente', data, config)
            .then(function(response){
                if(response.data !== 'false'){
                  if(response.data){
                    vm.paciente = response.data;
                         tipo_documento_cambiar();
                         vm.paciente.passport = vm.paciente.rut;
                    if(response.data.objetado == 1){
                        vm.show_comentario_validacion = true;
                        vm.show_objetar_paciente = true;
                        document.getElementById("radio_objetar").checked = true;
                    } 
                    else{
                        vm.show_comentario_validacion = false;
                        vm.show_objetar_paciente = false;
                    }

                    vm.paciente.fecha_cirugia    = new Date(vm.paciente.fecha_cirugia);
                    $('#modal-paciente').appendTo("body").modal('show');
                  }
                }
            },
            function(response){
                console.log("error al obtener comunas.");
            }
        );
      }else{
        $('#modal-paciente').appendTo("body").modal('show');
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

      if(vm.paciente.tipo_documento_identificacion.id_tipo_documento == 1){
        if(userForm.rut.$invalid){
          userForm.rut.$touched = true;
          error = true;
        }
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
        guardar_paciente();
      }

    }


    function guardar_paciente(objetar, validar) {

      vm.paciente.objetar = 1;
      vm.paciente.validar = 0;
      vm.paciente.corregir = 1;
      var data = $.param({

          paciente: vm.paciente
      });
      var id_paciente_antiguo = vm.paciente.id_paciente;

      $http.post('<?php echo base_url(); ?>pacientes/set_paciente', data, config)
          .then(function(response){
              if(response.data !== 'false'){
                 // get_pacientes_sin_verificar();
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


    function guardar_usuario(){
          var data = $.param({
          usuario: vm.usuario
      });

      $http.post('<?php echo base_url(); ?>usuarios/update_usuario', data, config)
          .then(function(response){
              if(response.data !== 'false'){
                if(response.data){
                 // window.location ='<?php echo base_url(); ?>usuarios/listado_usuarios/';

                }
              }
          },
          function(response){
              console.log("error al guardar stock.");
          }
      );
     }

  vm.chartSeries = vm.ventas_mensuales;

  vm.chartConfig = {

    chart: {
      type: 'column'
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total ventas por mes'
        },
        tickInterval: 1,

    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:1f}'
            }
        }
    },
    series: vm.chartSeries,
    title: {
      text: 'Distribución mensual de ventas'
    }
  }

    }
})();

</script> 
