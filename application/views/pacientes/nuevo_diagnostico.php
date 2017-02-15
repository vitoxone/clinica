<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/angular-flash.css" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/prettyPhoto.css">
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
<div id="wrapper" ng-app="myApp">
 <div id="page-wrapper" ng-controller="EstomasController as vm">
  <div class="bread-crumb pull-left">
    <a href="<?php echo base_url(); ?>"><i class="icon-home"></i> Home</a> 
      <span class="divider">/</span> 
        <a href="<?php echo base_url(); ?>/pacientes/listado_pacientes" class="bread-current">Pacientes</a>
        <span class="divider">/</span>
        <a href="#" class="bread-current">Paciente: {{vm.paciente.nombres}} {{vm.paciente.apellido_paterno}} {{vm.paciente.apellido_materno}} </a> 
  </div>
    <div class="clearfix"></div>
      <hr />
      <div class="row">
        <div class="col-md-12"> 
          <ul id="myTab" class="nav nav-tabs">
            <li ng-show="vm.paciente.id_paciente"class="active"><a href="#datos-paciente" data-toggle="tab">Datos del paciente</a></li>
            <li ng-show="vm.paciente.id_paciente"><a href="#diagnostico" data-toggle="tab">Diagnóstico</a></li>
            <li ng-show="vm.paciente.id_paciente"><a href="#estomas" data-toggle="tab">Estomas</a></li>
            <li ng-show="vm.paciente.id_paciente"><a href="#heridas" data-toggle="tab">Otras heridas</a></li>
            <li ng-show="vm.paciente.id_paciente"><a href="#atenciones" data-toggle="tab">Atenciones</a></li>
            <li ng-show="vm.paciente.id_paciente"><a href="#llamados" data-toggle="tab">Llamados</a></li>
          </ul>
          <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade in active" id="datos-paciente">             
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
                    <div class="form">                             
                      <div class="row">
                        <div class="col-md-4">                    
                          <div class="form-group">
                            <label class="col-lg-3">Tipo documento</label>
                            <div class="col-lg-9">
                              <div class="input-group">
                                 <multiselect ng-model="vm.paciente.tipo_documento_identificacion" options="tipo_documento.nombre for tipo_documento in vm.tipos_documentos" data-multiple="false" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5"></multiselect>   
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">                    
                          <div class="form-group">
                            <label class="col-lg-3" for="content">Rut</label>
                            <div class="col-lg-9">
                              <div class="input-group">
                                <input ng-model="vm.paciente.rut" class="form-control"/>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="col-md-6">                    
                            <div class="form-group">
                              <label class="col-lg-6" for="content">Programa contigo</label>
                              <div class="col-lg-6">                               
                                  <div class="toggle-button">
                                      <input ng-model="vm.paciente.contigo" class="form-control" type="checkbox">
                                  </div> 
                              </div>
                            </div>
                            </div>
                            <div class="col-md-6">    
                              <div class="form-group">
                                <label class="col-lg-6" for="content">Atención domiciliaria</label>
                                <div class="col-lg-6">                               
                                    <div class="toggle-button">
                                        <input ng-model="vm.paciente.domiciliario" class="form-control" type="checkbox">
                                    </div> 
                                </div>
                              </div>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="col-lg-3" for="content">Nombres</label>
                            <div class="col-lg-9">
                                <input ng-model = "vm.paciente.nombres" class="form-control" style="text-transform:uppercase"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="col-lg-3">Apellido paterno</label>
                            <div class="col-lg-9">
                                <input ng-model="vm.paciente.apellido_paterno" class="form-control" style="text-transform:uppercase"/>
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
                      <div class="row">
                        <div class="col-md-4">                          
                          <div class="form-group">
                              <label class="col-lg-3">Fecha nacimiento</label>
                              <div class="col-lg-9">
                                <div class="input-group"> 
                                  <input type="text" class="form-control" uib-datepicker-popup  ng-model="vm.paciente.fecha_nacimiento" is-open="vm.popup_fecha_nacimiento.opened" ng-required="true" close-text="Close" ng-change="vm.calcularEdad(vm.paciente.fecha_nacimiento)"/>
                                  <span  ng-click="vm.fechaNacimiento()" class="input-group-addon btn btn-info btn-lg"><i class="icon-calendar"></i></span>
                                </div>
                              </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="col-lg-3">Edad</label>
                            <div class="col-lg-8">
                              <div class="input-group">
                                 <span class="bold" style="text-transform:uppercase">{{vm.paciente.edad}}</span>
                            </div>
                          </div>
                         </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="col-lg-3">Previsión salud</label>
                            <div class="col-lg-8">
                              <div class="input-group">
                                <multiselect ng-model="vm.paciente.isapre" options="isapre.nombre for isapre in vm.isapres" data-multiple="false" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5"></multiselect>   
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="col-lg-3">Género</label>
                            <div class="col-lg-8">
                              <div class="input-group">
                                <select ng-model="vm.paciente.genero" class="form-control">                                                               
                                  <option value="1">Masculino</option>
                                  <option value="2">Femenino</option>
                                </select>  
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="col-lg-3">Dirección</label>
                            <div class="col-lg-9">
                              <input ng-model="vm.paciente.direccion" class="form-control" style="text-transform:uppercase"/>  
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group" ng-show="vm.paciente.isapre.tramos == 1">
                            <label class="col-lg-3">Tramo</label>
                            <div class="col-lg-8">
                              <select ng-model="vm.paciente.tramo_isapre" class="form-control">                                                               
                                <option value="a">A</option>
                                <option value="b">B</option>
                                <option value="c">C</option>
                                <option value="d">D</option>
                              </select>   
                            </div>
                          </div>
                        </div>
                      </div>
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
                          <div class="form-group">
                            <label class="col-lg-3">Teléfono</label>
                            <div class="col-lg-9">
                              <div class="input-group">
                                  <div class="input-group">
                                      <input ng-model = "vm.paciente.telefono"  class="form-control"/>  
                                  </div>
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
                                  <input ng-model= "vm.paciente.email" class="form-control"/>  
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
                          <label class="col-lg-4">Médico tratante</label>
                          <div class="col-lg-8">
                            <div class="input-group">
                              <multiselect ng-model="vm.paciente.medico_tratante" options="medico.nombres for medico in vm.medicos" data-multiple="false" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5"></multiselect>  
                              <span  ng-click="vm.abrirModalRegistroMedicos()" class="btn btn-info btn-md"><i class=" icon-plus"></i></span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
                 <!-- datos acompañante -->
                <div class="widget-head">
                  <div class="pull-left">Datos acompañante</div>
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
                            <label class="col-lg-3">Nombres</label>
                            <div class="col-lg-9">
                                <input  ng-model ="vm.paciente.nombre_acompanante" class="form-control" style="text-transform:uppercase"/>   
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">                    
                          <div class="form-group">
                            <label class="col-lg-3" for="content">Parentesco</label>
                            <div class="col-lg-9">
                              <input ng-model="vm.paciente.parentesco_acompanante" class="form-control" style="text-transform:uppercase"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="col-lg-3">Teléfono</label>
                            <div class="col-lg-9">
                                <input ng-model="vm.paciente.telefono_acompanante" class="form-control"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <br/>
                    </div>
                  </div>

                </div>
              </div>
              <div class="row">
                <div class="widget">
                  <div class="widget-buttons">
                    <div class="col-md-12 col-lg-offset-10">  
                      <input class="btn btn-success btn-lg"  type="button" value="Grabar paciente" ng-click="vm.guardar_paciente(vm.paciente)"/>
                    </div>
                  </div>
                </div>
              </div>
              <br> 
            </div><!-- Fin tab datos-paciente-->
          <div class="tab-pane" id="diagnostico">
            <div class="col-md-12" ng-show="(vm.diagnostico.id_diagnostico == '' && vm.primer_diagnostico == false)">
              <div class="col-md-3"></div>
              <div class="col-md-6">
                <div class="widget wred">
                  <div class="widget-head">
                    <div class="pull-left">Primera atención</div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="widget-content">
                    <div class="padd">                                 
                      <div class="alert alert-info">
                        Este paciente no ha sido diagnosticado, para ello debe registrar su primera atención.
                      </div>                                        
                    </div>
                  </div>
                  <div class="widget-foot pull right">
                    <div class="pull right">
            
                      <button type="button" class="btn btn-primary" ng-click="vm.primer_diagnostico = true">Registrar primera atención</button>
                    </div>
                  </div>
                </div>  
              </div>
              <div class="col-md-3"></div>
            </div>

            <div ng-show="vm.primer_diagnostico">
              <div  class="widget">
                  <div class="widget-head">
                    <div class="pull-left">Examen físico: {{vm.ultima_atencion.fecha_registro}}</div><div class="center">Signos vitales</div>
                  </div>
                  <div class="widget-content">
                    <div class="padd">
                      <div class="form">                             
                        <div class="row">
                          <div class="col-md-4">                    
                            <div class="form-group">
                              <label class="col-lg-3" for="content">Frecuencia cardiaca</label>
                              <div class="col-lg-9">
                                <div class="input-group">
                                  <input ng-model="vm.ultima_atencion.frecuencia_cardiaca" class="form-control"/>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4">                    
                            <div class="form-group">
                              <label class="col-lg-3" for="content">Presion arterial</label>
                              <div class="col-lg-9">
                                <div class="input-group">
                                  <input ng-model="vm.ultima_atencion.presion_arterial" class="form-control"/>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4">                    
                            <div class="form-group">
                              <label class="col-lg-3" for="content">Temperatura</label>
                              <div class="col-lg-9">
                                <div class="input-group">
                                  <input ng-model="vm.ultima_atencion.temperatura" class="form-control"/>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="widget-head">
                          <div class="center">Estado nutricional</div>  
                        </div>
                        <br/>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="col-lg-3" for="content">Peso (Kg)</label>
                              <div class="col-lg-9">
                                  <input ng-model = "vm.ultima_atencion.peso" class="form-control"/>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="col-lg-3">Estatura (Cms)</label>
                              <div class="col-lg-9">
                                  <input ng-model="vm.ultima_atencion.estatura" class="form-control"/>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4">                      
                            <div class="form-group">
                              <label class="col-lg-3">I.M.C</label>
                              <div class="col-lg-9">
                                  <input ng-model="vm.ultima_atencion.imc" class="form-control"/>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="widget-head">
                          <div class="center">Estado emocional</div>  
                        </div>
                        <br/>
                        <div class="row">
                          <div class="col-md-3">                          
                            <div class="form-group">
                                <label class="col-lg-12">Estado:</label>
                            </div>
                          </div>
                        <div class="col-md-2">                    
                          <div class="form-group">
                            <label class="col-lg-7">Ansioso</label>
                              <div class="col-lg-5">                               
                                <div class="toggle-button">
                                    <input class="form-control" type="radio" ng-model="vm.ultima_atencion.estado_animo" value="ansioso">
                                </div> 
                              </div>
                          </div>
                        </div>
                        <div class="col-md-2">                    
                          <div class="form-group">
                            <label class="col-lg-7">Deprimido</label>
                              <div class="col-lg-5">                               
                                <div class="toggle-button">
                                    <input class="form-control" type="radio" ng-model="vm.ultima_atencion.estado_animo" value="deprimido">
                                </div> 
                              </div>
                          </div>
                        </div>
                        <div class="col-md-2">                    
                          <div class="form-group">
                            <label class="col-lg-7">Normal</label>
                              <div class="col-lg-5">                               
                                <div class="toggle-button">
                                    <input class="form-control" type="radio" ng-model="vm.ultima_atencion.estado_animo" value="normal">
                                </div> 
                              </div>
                          </div>
                        </div>
                        <div class="col-md-2">                    
                          <div class="form-group">
                            <label class="col-lg-7">Adaptado</label>
                              <div class="col-lg-5">                               
                                <div class="toggle-button">
                                    <input class="form-control" type="radio" ng-model="vm.ultima_atencion.estado_animo" value="adaptado">
                                </div> 
                              </div>
                          </div>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                          <div class="col-md-3">                          
                            <div class="form-group">
                                <label class="col-lg-12">Agudeza visual:</label>
                            </div>
                          </div>
                        <div class="col-md-2">                    
                          <div class="form-group">
                            <label class="col-lg-7">Adecuada</label>
                              <div class="col-lg-5">                               
                                <div class="toggle-button">
                                    <input class="form-control" type="radio" ng-model="vm.ultima_atencion.agudeza_visual" value="adecuada">
                                </div> 
                              </div>
                          </div>
                        </div>
                        <div class="col-md-2">                    
                          <div class="form-group">
                            <label class="col-lg-7">Disminuida</label>
                              <div class="col-lg-5">                               
                                <div class="toggle-button">
                                    <input class="form-control" type="radio" ng-model="vm.ultima_atencion.agudeza_visual" value="disminuida">
                                </div> 
                              </div>
                          </div>
                        </div>
                        <div class="col-md-2">                    
                          <div class="form-group">
                            <label class="col-lg-7">Limitación</label>
                              <div class="col-lg-5">                               
                                <div class="toggle-button">
                                    <input class="form-control" type="radio" ng-model="vm.ultima_atencion.agudeza_visual" value="limitacion">
                                </div> 
                              </div>
                          </div>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                          <div class="col-md-3">                          
                            <div class="form-group">
                                <label class="col-lg-12">Destreza manual:</label>
                            </div>
                          </div>
                        <div class="col-md-2">                    
                          <div class="form-group">
                            <label class="col-lg-7">Adecuada</label>
                              <div class="col-lg-5">                               
                                <div class="toggle-button">
                                    <input class="form-control" type="radio" ng-model="vm.ultima_atencion.destreza_manual" value="adecuada">
                                </div> 
                              </div>
                          </div>
                        </div>
                        <div class="col-md-2">                    
                          <div class="form-group">
                            <label class="col-lg-7">Disminuida</label>
                              <div class="col-lg-5">                               
                                <div class="toggle-button">
                                    <input class="form-control" type="radio" ng-model="vm.ultima_atencion.destreza_manual" value="disminuida">
                                </div> 
                              </div>
                          </div>
                        </div>
                        <div class="col-md-2">                    
                          <div class="form-group">
                            <label class="col-lg-7">Limitación</label>
                              <div class="col-lg-5">                               
                                <div class="toggle-button">
                                    <input class="form-control" type="radio" ng-model="vm.ultima_atencion.destreza_manual" value="limitacion">
                                </div> 
                              </div>
                          </div>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                          <div class="col-md-3">                          
                            <div class="form-group">
                                <label class="col-lg-12">Actividad y ejercicio:</label>
                            </div>
                          </div>
                        <div class="col-md-2">                    
                          <div class="form-group">
                            <label class="col-lg-7">Ninguno</label>
                              <div class="col-lg-5">                               
                                <div class="toggle-button">
                                    <input class="form-control" type="radio" ng-model="vm.ultima_atencion.actividad" value="ninguno">
                                </div> 
                              </div>
                          </div>
                        </div>
                        <div class="col-md-2">                    
                          <div class="form-group">
                            <label class="col-lg-7">Leve</label>
                              <div class="col-lg-5">                               
                                <div class="toggle-button">
                                    <input class="form-control" type="radio" ng-model="vm.ultima_atencion.actividad" value="leve">
                                </div> 
                              </div>
                          </div>
                        </div>
                        <div class="col-md-2">                    
                          <div class="form-group">
                            <label class="col-lg-7">Moderada</label>
                              <div class="col-lg-5">                               
                                <div class="toggle-button">
                                    <input class="form-control" type="radio" ng-model="vm.ultima_atencion.actividad" value="moderada">
                                </div> 
                              </div>
                          </div>
                        </div>
                        <div class="col-md-2">                    
                          <div class="form-group">
                            <label class="col-lg-7">Activo</label>
                              <div class="col-lg-5">                               
                                <div class="toggle-button">
                                    <input class="form-control" type="radio" ng-model="vm.ultima_atencion.actividad" value="activo">
                                </div> 
                              </div>
                          </div>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                          <div class="col-md-3">                          
                            <div class="form-group">
                                <label class="col-lg-12">Dependencia autocuidado:</label>
                            </div>
                          </div>
                        <div class="col-md-2">                    
                          <div class="form-group">
                            <label class="col-lg-7">Independiente</label>
                              <div class="col-lg-5">                               
                                <div class="toggle-button">
                                    <input class="form-control" type="radio" ng-model="vm.ultima_atencion.dependencia" value="independiente">
                                </div> 
                              </div>
                          </div>
                        </div>
                        <div class="col-md-2">                    
                          <div class="form-group">
                            <label class="col-lg-7">Dependencia parcial</label>
                              <div class="col-lg-5">                               
                                <div class="toggle-button">
                                    <input class="form-control" type="radio" ng-model="vm.ultima_atencion.dependencia" value="parcial">
                                </div> 
                              </div>
                          </div>
                        </div>
                        <div class="col-md-2">                    
                          <div class="form-group">
                            <label class="col-lg-7">Dependencia total</label>
                              <div class="col-lg-5">                               
                                <div class="toggle-button">
                                    <input class="form-control" type="radio" ng-model="vm.ultima_atencion.dependencia" value="total">
                                </div> 
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="widget">
                <div class="widget-head">
                  <div class="pull-left">Datos diagnóstico</div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">                           
                      <div class="col-md-6">  
                        <div class="row">                    
                          <div class="form-group">
                            <label class="col-lg-3">Cie10</label>
                            <div class="col-lg-9">
                              <multiselect ng-model="vm.diagnostico.cie10" options="cie10.codigo+' '+cie10.nombre for cie10 in vm.cies10" data-multiple="true" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5"></multiselect>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                            <div class="widget">
                              <div class="widget-content">
                                <ul class="task" ng-repeat="cie10_seleccionada in vm.diagnostico.cie10">
                                  <li>
                                  <a ng-click="vm.remover_cie10_selected(cie10_seleccionada)"class="pull-right"><i class="icon-remove"></i></a>
                                  <span class="label label-info">{{cie10_seleccionada.codigo}}</span>
                                    {{cie10_seleccionada.nombre}}
                                  </li>                                                                           
                                </ul>
                              </div>
                            </div>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6"> 
                          <div class="row">                    
                            <div class="form-group">
                              <label class="col-lg-3">Detalle</label>
                              <div class="col-lg-9">
                                <textarea  ng-model="vm.diagnostico.diagnostico_principal" id="diagnostico_principal" name="diagnostico_principal" class="form-control textarea" style="text-transform:uppercase">{{vm.diagnostico.diagnostico_principal}}</textarea>
                              </div>
                            </div>
                          </div>
                          <br/>
                          <div class="row">                    
                            <div class="form-group">
                              <label class="col-lg-3">Comentarios</label>
                              <div class="col-lg-9">
                                  <textarea  ng-model="vm.diagnostico.diagnostico_atencion" id="diagnostico_atencion" name="diagnostico_atencion" class="form-control textarea" style="text-transform:uppercase">{{vm.diagnostico.diagnostico_atencion}}</textarea>
                              </div>
                            </div>
                          </div>
                          <br/>
                          <div class="row">
                            <div class="form-group">
                              <label class="col-lg-3">Recibió kit</label>
                              <div class="col-lg-9">
                                  <select ng-model="vm.diagnostico.recibe_kit" class="form-control" id="recibe_kit" name="recibe_kit">                                                               
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                  </select>    
                              </div>
                            </div>
                          </div>
                        </div>
                        <br/>
                      </div>
                      <br/>
      
                      <br/>
                      <div class="row">
                        <div class="col-md-12">
                            <label class="col-lg-1">Seguimiento</label>
                            <div class="col-lg-9">
                                <textarea  ng-model="vm.diagnostico.seguimiento" id="seguimiento" name="seguimiento" class="form-control textarea" style="text-transform:uppercase">{{vm.diagnostico.seguimiento}}</textarea>
                            </div>
                        </div>
                      </div>
                      <br/>
                      <div class="widget-head">
                        <div class="center">Motivo consulta</div>
                        <div class="clearfix"></div>
                      </div>
                      <br/>
                      <div class="row">
                        <div class="col-md-12">                    
                          <div class="form-group">
                            <label class="col-lg-1">Motivo consulta:</label>
                            <div class="col-lg-9">
                                <textarea  ng-model="vm.diagnostico.motivo_consulta" class="form-control textarea" style="text-transform:uppercase">{{vm.diagnostico.motivo_consulta}}</textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                      <br/>
                      <div class="widget-head">
                        <div class="center">Antecedentes</div>
                        <div class="clearfix"></div>
                      </div>
                      <br/>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="col-lg-1" for="content">Patológicos:</label>
                            <div class="col-lg-9">
                                <input ng-model="vm.diagnostico.antecedentes_patologicos" class="form-control" style="text-transform:uppercase"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="col-lg-1" for="content">Quirurgicos:</label>
                            <div class="col-lg-9">
                                <input ng-model="vm.diagnostico.antecedentes_quirurgicos" class="form-control" style="text-transform:uppercase"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="col-lg-1" for="content">Alérgicos:</label>
                            <div class="col-lg-9">
                                <input ng-model="vm.diagnostico.antecedentes_alergicos" class="form-control" style="text-transform:uppercase"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="col-lg-1" for="content">Farmacológicos:</label>
                            <div class="col-lg-9">
                                <input ng-model="vm.diagnostico.antecedentes_farmacologicos" class="form-control" style="text-transform:uppercase"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="col-lg-1" for="content">Familiares:</label>
                            <div class="col-lg-9">
                                <input ng-model="vm.diagnostico.antecedentes_familiares" class="form-control" style="text-transform:uppercase"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <br/>
                      <div class="widget-head">
                        <div class="center">Historia clínica</div>
                        <div class="clearfix"></div>
                      </div>
                      <br/>
                      <div class="row">
                        <div class="col-md-12">                    
                          <div class="form-group">
                            <label class="col-lg-1">Historia clínica:</label>
                            <div class="col-lg-9">
                                <textarea  ng-model="vm.diagnostico.historia_clinica" class="form-control textarea" style="text-transform:uppercase">{{vm.diagnostico.historia_clinica}}</textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                      <br/>
                      <div class="widget-head">
                        <div class="center">Tratamiento actual</div>
                        <div class="clearfix"></div>
                      </div>
                      <br/>
                      <div class="row">
                        <div class="col-md-2">                    
                          <div class="form-group">
                            <label class="col-lg-7">Quirúrgico:</label>
                            <div class="col-lg-5">
                              <input type="checkbox" ng-model="vm.diagnostico.tratamiento_actual_quirurgico" class="form-control">                                                                  
                            </div>
                          </div>
                        </div>
                        <div class="col-md-2">                    
                          <div class="form-group">
                            <label class="col-lg-7">Radioterapia:</label>
                            <div class="col-lg-5">
                              <input type="checkbox" ng-model="vm.diagnostico.tratamiento_actual_radioterapia" class="form-control">                                                               
                            </div>
                          </div>
                        </div>
                        <div class="col-md-2">                    
                          <div class="form-group">
                            <label class="col-lg-7">Quimioterapia:</label>
                            <div class="col-lg-5">
                              <input type="checkbox" ng-model="vm.diagnostico.tratamiento_actual_quimioterapia" class="form-control">                                                                   
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">                    
                          <div class="form-group">
                            <label class="col-lg-2">Otro:</label>
                            <div class="col-lg-10">
                              <input ng-model="vm.diagnostico.tratamiento_actual_otro" class="form-control" style="text-transform:uppercase"/>   
                            </div>
                          </div>
                        </div>
                      </div>
                      <br/>
                      <div class="row">
                        <div class="col-md-6">                    
                          <div class="form-group">
                            <label class="col-lg-3">Fecha cirugía:</label>
                            <div class="col-lg-5">
                              <div class="input-group">
                                <input type="text" class="form-control" uib-datepicker-popup datepicker-popup="yyyy-mm-dd" ng-model="vm.diagnostico.tratamiento_actual_fecha_cirugia" is-open="vm.popup_tratamiento_actual_fecha_cirugia.opened" ng-required="true" close-text="Close" />
                                <span ng-click="vm.tratamientoActualFechaCirugia()" class="input-group-addon btn btn-info btn-lg"><i class="icon-calendar"></i></span>
                              </div>
                              </div>   
                            </div>
                          </div>
                        </div>
                        <br>
                        <div class="row">
                        <div class="col-md-6">  
                          <div class="form-group">
                            <label class="col-lg-4">Institución salud</label>
                            <div class="col-lg-8">
                              <multiselect style="padding-right: 200px;overflow: hidden;text-overflow: ellipsis;" ng-model="vm.diagnostico.establecimiento" options="establecimiento.nombre for establecimiento in vm.establecimientos" data-multiple="false" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5" ng-change ="vm.cargar_medicos_establecimiento()"></multiselect>  
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="col-lg-4">Médico tratante</label>
                            <div class="col-lg-8">
                              <div class="input-group">
                                <multiselect ng-model="vm.diagnostico.medico_tratante" options="medico.nombres for medico in vm.medicos" data-multiple="false" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5"></multiselect>  
                                <span  ng-click="vm.abrirModalRegistroMedicos()" class="btn btn-info btn-md"><i class=" icon-plus"></i></span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      </div>
                      <br/>
                      <div class="widget-head">
                        <div class="center">Datos de registro</div>
                        <div class="clearfix"></div>
                      </div>
                      <br/>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="col-lg-3" for="content">Registrado por:</label>
                            <div class="col-lg-5">
                                <label>{{vm.diagnostico.primer_registro_profesional.nombres}}</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="col-lg-5" for="content">Última modificación:</label>
                            <div class="col-lg-5">
                                <label>{{vm.diagnostico.ultimo_registro_profesional.nombres}}</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <br/>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="col-lg-3" for="content">Fecha registro:</label>
                            <div class="col-lg-5">
                                <label>{{vm.diagnostico.primer_registro_profesional.fecha}}</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="col-lg-5" for="content">Fecha modificación:</label>
                            <div class="col-lg-5">
                                <label>{{vm.diagnostico.ultimo_registro_profesional.fecha}}</label>
                            </div>
                          </div>
                        </div>
                      </div>


                    <flash-message duration="5000" show-close="true" on-dismiss="myCallback(flash)"></flash-message>
                </div>
              </div>
              <div class="row">
                <div class="widget">
                  <div class="widget-buttons">
                    <div class="col-md-12 col-lg-offset-10">  
                      <input class="btn btn-success btn-lg"  type="button" value="Grabar diagnóstico" ng-click="vm.modal_verificar_usuario('diagnostico')"/>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- fin tab diagnostico -->
          <div class="tab-pane" id="estomas">
            <div ng-show="vm.diagnostico.id_diagnostico != ''">
              <div class="widget" ng-show="vm.ostomias_diagnostico.length > 0">
                <div class="widget-head">
                  <div class="pull-left">Estomas del paciente    
                    <button class="btn btn-success" type="button" ng-click="vm.nuevo_estomia()"><i class="fa fa-floppy-o fa-fw"></i>Nuevo</button>
                  </div> 
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <ul class="task">
                    <li ng-repeat="ostomia_diagnostico in vm.ostomias_diagnostico" data-ng-click="vm.seleccionar_estoma(ostomia_diagnostico)">
                      <input type="radio" ng-model='vm.ostomia_selected.id_ostomia' value ="{{ostomia_diagnostico.id_ostomia}}" class="css-checkbox"/><label for="radio5" class="css-label radGroup2">{{ostomia_diagnostico.tipo_ostomia.nombre}}  </label>
                                      <span class="bold">  </span>{{ostomia_diagnostico.temporalidad_nombre}}
                        <span class="pull-right label label-success">Activo</span>
                        <p class="p-meta">
                          <span>Última modificacion : {{ostomia_diagnostico.fecha_modificacion}}</span> 
                        </p>
                    </li>                                                                                                            
                  </ul>
                  <div class="clearfix"></div>  
                    <div class="widget-foot">
                    </div>
                  </div>
              </div>  
              <div class="widget">
                <div class="widget-head">
                  <div class="pull-left">Valoración de la estomía</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">
                    <div class="form">                             
                      <div class="row">
                        <div class="col-md-8"> 
                          <div class="row">
                            <div class="col-md-6">                    
                              <div class="form-group">
                                <label class="col-lg-3">Categoría</label>
                                <div class="col-lg-9">
                                  <div class="input-group">
                                     <multiselect ng-model="vm.ostomia_selected.categoria_ostomia" options="categoria_ostomia.nombre for categoria_ostomia in vm.categorias_ostomias" data-multiple="false" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5" ng-change="vm.cargar_tipos_ostomias()"></multiselect>   
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                              <label class="col-lg-3">Tipo estomía</label>
                              <div class="col-lg-9">
                                <div class="input-group">
                                   <multiselect ng-model="vm.ostomia_selected.tipo_ostomia" options="tipo_ostomia.nombre for tipo_ostomia in vm.tipos_ostomias" data-multiple="false" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5"></multiselect>   
                                </div>
                              </div>
                            </div>
                            </div>
                          </div>
                          <br/>
                          <div class="row">
                            <div class="col-md-6">                   
                              <div class="form-group">
                                <label class="col-lg-3">Marcación pre-quirúrgica</label>
                                <div class="col-lg-9">
                                  <div class="input-group-xs">
                                    <select ng-model="vm.ostomia_selected.marcacion_prequirurgica" class="form-control">                                                               
                                      <option value="1">SI</option>
                                      <option value="0">NO</option>
                                    </select>  
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">                   
                              <div class="form-group">
                                <label class="col-lg-3">Temporalidad</label>
                                <div class="col-lg-9">
                                  <div class="input-group-xs">
                                    <select ng-model="vm.ostomia_selected.temporalidad" class="form-control">                                                               
                                      <option value="1">Temporal</option>
                                      <option value="0">Definitiva</option>
                                    </select>  
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        <br/>

                        <div class="center"><h3>Tamaño</h3></div>
                        <hr>
                        <div class="clearfix"></div>
                        <br/>
                      <div class="row"> 
                        <div class="col-md-4">                    
                          <div class="form-group">
                            <label class="col-lg-6">Boca proximal (mm)</label>
                            <div class="col-lg-6">
                              <div class="input-group">
                                <input type="text" ng-model="vm.ostomia_selected.boca_proximal" class="form-control">   
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">                    
                          <div class="form-group">
                            <label class="col-lg-6">Boca distal (mm)</label>
                            <div class="col-lg-6">
                              <div class="input-group">
                                <input type="text" ng-model="vm.ostomia_selected.boca_distal" class="form-control">  
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">                   
                          <div class="form-group">
                            <label class="col-lg-6">Puente de piel</label>
                            <div class="col-lg-6">
                              <select ng-model="vm.ostomia_selected.puente_piel" class="form-control">                                                               
                                <option value="1">SI</option>
                                <option value="0">NO</option>
                              </select>  
                            </div>
                          </div>
                        </div>                  
                      </div>
                      <div class="row">
                        <div class="col-md-8">                    
                          <div class="form-group">
                            <label class="col-lg-4">Cargar imagenes</label>
                            <div class="col-lg-8">
                              <div class="input-group">
                                <input type="file" ng-model="vm.ostomia_selected.boca_distal" class="form-control">  
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3">                 
                          <a href="#">Ver imagenes</a>
                          <hr>
                        </div>
                      </div>
                    </div>
                      <div class="col-md-4">
                        <div class="row">
                          <div class="form-group">                    
                            <div id="lienzo" style="width: 300px; height: 300px; background-image: url('<?php echo base_url(); ?>assets/img/torso_ostomia.png');"></div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group">
                            <label class="col-lg-3">Localizacion</label>
                            <div class="col-lg-9">
                               <multiselect ng-model="vm.ostomia_selected.ubicacion_estoma" options="ubicacion_estoma.nombre for ubicacion_estoma in vm.ubicaciones_estomas" data-multiple="false" filter-after-rows="10" min-width="100" tabindex="-1" scroll-after-rows="7" ng-change="vm.dibujar_estoma()"></multiselect>   
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <br/>
                    <div class="center"><h3>Drenaje</h3></div>
                    <hr>
                    <div class="clearfix"></div>
                    <br/>
                      <div class="row"> 
                        <div class="col-md-2">                    
                          <div class="form-group">
                            <label class="col-lg-5">Una boca:</label>
                              <div class="col-lg-5">                               
                                <div class="toggle-button">
                                    <input ng-model="vm.ostomia_selected.una_boca" class="form-control" type="checkbox">
                                </div> 
                              </div>
                          </div>
                        </div>
                        <div class="col-md-2">                    
                          <div class="form-group">
                            <label class="col-lg-7">Dos bocas:</label>
                              <div class="col-lg-5">                               
                                <div class="toggle-button">
                                    <input ng-model="vm.ostomia_selected.dos_bocas" class="form-control" type="checkbox">
                                </div> 
                              </div>
                          </div>
                        </div>
                        <div class="col-md-2">                    
                          <div class="form-group">
                            <label class="col-lg-7">En Asa:</label>
                              <div class="col-lg-5">                               
                                <div class="toggle-button">
                                    <input ng-model="vm.ostomia_selected.en_asa" class="form-control" type="checkbox">
                                </div> 
                              </div>
                          </div>
                        </div>
                        <div class="col-md-3">                    
                          <div class="form-group">
                            <label class="col-lg-7">Una boca con físula mucosa:</label>
                            <div class="col-lg-5">                               
                              <div class="toggle-button">
                                  <input ng-model="vm.ostomia_selected.fisula" class="form-control" type="checkbox">
                              </div> 
                            </div>
                          </div>
                        </div>
                  
                      </div>
                      <br/>
                      <div class="center"><h3>Drenaje</h3></div>
                        <hr>
                        <div class="clearfix"></div>
                        <br/>
                      <div class="row"> 
                        <div class="col-md-3">                    
                          <div class="form-group">
                            <label class="col-lg-3">Angulo de drenaje</label>
                            <div class="col-lg-9">
                              <div class="input-group">
                                <select class="form-control" ng-model="vm.ostomia_selected.angulo_drenaje" ng-change="vm.dibujar_drenaje()">
                                  <option value="1">Centro</option>
                                  <option value="2">Cuadrante 3 a 6</option>
                                  <option value="3">Cuadrante 6 a 9</option>
                                  <option value="4">Cuadrante 9 a 12</option>
                                  <option value="5">Cuadrante 12 a 3</option>
                                </select>   
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3">                    
                          <div class="form-group">
                            <div class="col-lg-9">
                              <div class="input-group">
                                <div id="lienzo_drenaje" style="width: 200px; height: 200px; background-image: url('<?php echo base_url(); ?>assets/img/angulo_ostomia.png');"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label class="col-lg-2">Comentario</label>
                          <div class="col-lg-10">
                            <textarea  ng-model="vm.ostomia_selected.comentario_drenaje" class="form-control textarea" style="text-transform:uppercase">{{vm.ostomia_selected.comentario_drenaje}}</textarea>
                          </div>
                        </div>                  
                      </div>
                    <br/>
                  </div>
                      <br/>
                      <div class="center"><h3>Instrumento SACS</h3></div>
                        <hr>
                        <div class="clearfix"></div>
                        <br/>
                      <div class="row">
                        <div class="col-md-3">                      
                          <div class="form-group">
                            <label class="col-lg-3">SacsL</label>
                            <div class="col-lg-9">
                                <select class="form-control" ng-model="vm.ostomia_selected.valoracion_ostomia.sacsl" ng-change="vm.dibujar_sacsl(vm.ostomia_selected)">
                                  <option value="l1">L1</option>
                                  <option value="l2">L2</option>
                                  <option value="l3">L3</option>
                                  <option value="l4">L4</option>
                                  <option value="lx">LX</option>
                                </select> 
                            </div>
                          </div>
                        </div>
                          <div class="col-md-3">                          
                            <div class="form-group">
                                <div class="col-lg-9">
                                  <div class="input-group"> 
                                    <div id="lienzo_sacs_l" style="width: 213px; height: 361px; background-image: url('<?php echo base_url(); ?>assets/img/sacsl.png');"></div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3">                      
                          <div class="form-group">
                            <label class="col-lg-3">SacsT</label>
                            <div class="col-lg-9">
                                <select class="form-control" ng-model="vm.ostomia_selected.valoracion_ostomia.sacst" ng-change="vm.dibujar_sacst(vm.ostomia_selected)">
                                  <option value="t1">TI</option>
                                  <option value="t2">TII</option>
                                  <option value="t3">TIII</option>
                                  <option value="t4">TIV</option>
                                  <option value="tv">TV</option>
                                </select> 
                            </div>
                          </div>
                        </div>
                          <div class="col-md-3">                          
                            <div class="form-group">
                                <div class="col-lg-9">
                                  <div class="input-group"> 
                                    <div id="lienzo_sacs_t" style="width: 200px; height: 300px; background-image: url('<?php echo base_url(); ?>assets/img/sacst.png');"></div>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <br/>
                      <div class="row">
                        <div class="col-md-12">
                          <label class="col-lg-2">Comentario</label>
                          <div class="col-lg-10">
                            <textarea  ng-model="vm.ostomia_selected.valoracion_ostomia.comentario_sacs" class="form-control textarea" style="text-transform:uppercase">{{vm.ostomia_selected.comentario_sacs}}</textarea>
                          </div>
                        </div> 
                      </div>
                      <br/>
                      <div class="widget-head">
                        <div class="center">Datos de registro</div>
                        <div class="clearfix"></div>
                      </div>
                      <br/>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="col-lg-3" for="content">Registrado por:</label>
                            <div class="col-lg-5">
                                <label>{{vm.ostomia_selected.primer_registro_profesional.nombres}}</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="col-lg-5" for="content">Última modificación:</label>
                            <div class="col-lg-5">
                                <label>{{vm.ostomia_selected.ultimo_registro_profesional.nombres}}</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <br/>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="col-lg-3" for="content">Fecha registro:</label>
                            <div class="col-lg-5">
                                <label>{{vm.diagnostico.primer_registro_profesional.fecha}}</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="col-lg-5" for="content">Fecha modificación:</label>
                            <div class="col-lg-5">
                                <label>{{vm.ostomia_selected.ultimo_registro_profesional.fecha}}</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <br/>     
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="widget">
                    <div class="widget-buttons">
                      <div class="col-md-12 col-lg-offset-10">  
                        <input class="btn btn-success btn-lg"  type="button" value="Grabar ostomía" ng-click="vm.modal_verificar_usuario('ostomia')"/>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div ng-show="vm.diagnostico.id_diagnostico == ''">
                <div class="alert alert-info pull-center">
                      Se debe registrar el diagnóstico para agregar estomías.
                </div>
              </div>
            </div>

      <!--fin tab estomas -->
        <div class="tab-pane" id="heridas">
          <div ng-show="vm.diagnostico.id_diagnostico != ''"> 
            <div class="widget">
              <div class="widget-head">
                <div class="pull-left">Datos herida</div>
                <div class="widget-icons pull-right">
                  <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                </div>  
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
                <div class="col-md-5"> 
                <br/> 
                    <div class="row">
                        <div id="lienzo_cuerpo" style="width: 400px; height: 400px; background-image: url('<?php echo base_url(); ?>assets/img/cuerpo_humano.png');"></div>
                    </div>
                  </div>
                </div> 
                <div class="row">
                <br/>
                  <div class="col-md-6"> 
                    <div class="row">                    
                      <div class="form-group">
                        <label class="col-lg-3">Tipo herida</label>
                        <div class="col-lg-9">
                          <multiselect ng-model="vm.herida.tipo_herida" options="tipo_herida.nombre for tipo_herida in vm.tipos_heridas" data-multiple="false" filter-after-rows="10" min-width="100" tabindex="-1" scroll-after-rows="7"></multiselect>   
                        </div>
                      </div>
                    </div>
                    <br/>
                    <div class="row">                    
                      <div class="form-group">
                        <label class="col-lg-3">Ubicación</label>
                        <div class="col-lg-9">
                          <multiselect ng-model="vm.herida.ubicacion" options="ubicacion_herida.nombre for ubicacion_herida in vm.ubicaciones_heridas" ng-change="vm.dibujar_herida()" data-multiple="true" filter-after-rows="10" min-width="100" tabindex="-1" scroll-after-rows="7"></multiselect>   
                        </div>
                      </div>
                    </div>
                    <br/>
                    <div class="row">                    
                      <div class="form-group">
                        <label class="col-lg-3">Largo (mm)</label>
                        <div class="col-lg-9">
                           <input type="number" ng-model="vm.herida.largo_herida" class="form-control"/>
                        </div>
                      </div>
                    </div>
                    <br/>
                    <div class="row">                    
                      <div class="form-group">
                        <label class="col-lg-3">Ancho (mm)</label>
                        <div class="col-lg-9">
                           <input type="number" ng-model="vm.herida.ancho_herida" class="form-control"/>
                        </div>
                      </div>
                    </div>
                    <br/>
                    <div class="row">
                      <div class="form-group">
                        <label class="col-lg-3">% tejido granulatorio</label>
                        <div class="col-lg-9">
                            <select ng-model="vm.herida.tejido_granulatorio" class="form-control">                                                               
                              <option value="1">I (< 25%)</option>
                              <option value="2">II (25% - 50%)</option>
                              <option value="3">II (50% - 75%</option>
                              <option value="4">II (75% - 100%</option>
                            </select>    
                        </div>
                      </div>
                    </div>
                  </div>
                  <br/>
                </div>
                <br/>
              </div>     
              <br/>
              <div class="row">
                <div class="col-md-12">
                  <label class="col-lg-1">Comentario</label>
                  <div class="col-lg-10">
                      <textarea  ng-model="vm.herida.comentario" class="form-control textarea">{{vm.herida.comentario}}</textarea>
                  </div>
                </div>
              </div>
              <br/>
              <div class="form-group">
                <div class="col-lg-offset-10 col-lg-10">
                  <button class="btn btn-success" type="button" ng-click="vm.guardar_herida(vm.herida)"><i class="fa fa-floppy-o fa-fw"></i>Guardar</button>
                </div>
              </div>
              <br/>
              <flash-message duration="5000" show-close="true" on-dismiss="myCallback(flash)"></flash-message>
            </div>
            <div ng-show="vm.diagnostico.id_diagnostico == ''">
              <div class="alert alert-info pull-center">
                Se debe registrar el diagnóstico para agregar estomías.
              </div> 
            </div>
          </div> <!-- fin tab heridas -->
          <div class="tab-pane" id="llamados"> 
          <br/>
          <input class="btn btn-success btn-lg" ng-model="button" id="btn_activar_estomas"  ng-disabled="vm.isDisabled" type="button" value="Llamar" ng-click="vm.abrirModalEncuesta(1)" />     
            <div class="widget">
              <div class="widget-head">
                <div class="pull-left">
                  
                    <img src="<?php echo base_url(); ?>assets/img/phone-green.png" alt="">

                    Listado de llamados contestados</div>
                <div class="widget-icons pull-right">
                  <span><span class="label label-primary">{{vm.encuestas.length}}</span>  Llamados</span>
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
                                <input type="text" ng-model="vm.search" class="form-control" placeholder="Profesional / Comentarios">
                              </div>
                            </div>
                          </div>
                      </div>
                    </form>
                  </div>
                <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th ng-click="vm.ordenarTabla('fecha')">Fecha
                        <span class="glyphicon sort-icon" ng-show="vm.sortKey=='rut'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                      </th>
                      <th class="text-center" ng-click="vm.ordenarTabla('profesional')">Profesional
                        <span class="glyphicon sort-icon" ng-show="vm.sortKey=='contigo'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                      </th>
                      <th class="text-center" ng-click="vm.ordenarTabla('observaciones')">Comentarios
                        <span class="glyphicon sort-icon" ng-show="vm.sortKey=='contigo'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-show="vm.encuestas.length" dir-paginate="encuesta in vm.encuestas|orderBy:vm.sortKey:vm.reverse|filter:vm.search|itemsPerPage:vm.itemsMostrar">
                      <td><a target="_blank" style="text-transform:uppercase" ng-href="<?php echo base_url(); ?>/pacientes/encuesta_resumen/{{encuesta.id_encuesta}}"</a>{{encuesta.fecha}}</td>
                      <td>{{encuesta.profesional}}</td>
                      <td>{{encuesta.observaciones}}</td>
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
            <div class="widget">
              <div class="widget-head">
                <div class="pull-left"><img src="<?php echo base_url(); ?>assets/img/phone-red.png" alt=""> Listado de llamados no contestados</div>
                <div class="widget-icons pull-right">
                  <span><span class="label label-primary">{{vm.encuestas_no_contestadas.length}}</span>  Llamados</span>
                </div>  
                <div class="clearfix"></div>
              </div>

              <div class="widget-content">

                <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th ng-click="vm.ordenarTabla('fecha')">Fecha
                        <span class="glyphicon sort-icon" ng-show="vm.sortKey=='rut'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                      </th>
                      <th class="text-center" ng-click="vm.ordenarTabla('profesional')">Profesional
                        <span class="glyphicon sort-icon" ng-show="vm.sortKey=='contigo'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                      </th>
                      <th class="text-center" ng-click="vm.ordenarTabla('observaciones')">Comentarios
                        <span class="glyphicon sort-icon" ng-show="vm.sortKey=='contigo'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-show="vm.encuestas_no_contestadas.length" dir-paginate="encuesta in vm.encuestas_no_contestadas|orderBy:vm.sortKey:vm.reverse|filter:vm.search|itemsPerPage:vm.itemsMostrar">
                      <td>{{encuesta.fecha}}</td>
                      <td>{{encuesta.profesional}}</td>
                      <td>{{encuesta.observaciones}}</td>
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
        </div> <!-- fin tab llamados -->

        <div class="tab-pane" id="atenciones"> 
          <div ng-show="vm.diagnostico.id_diagnostico != ''"> 
          <br/>
          <div class="row">
            <div class="col-md-12 col-lg-offset-9">
              <input ng-show="vm.registrar_atencion == false" class="btn btn-success btn-lg"  type="button" value="Registrar atención" ng-click="vm.nuevaAtencion(true)" /> 
              <input ng-show="vm.registrar_atencion" class="btn btn-warning btn-lg"  type="button" value="Limpiar campos" ng-click="vm.limpiarNuevaAtencion()" /> 
              <input ng-show="vm.registrar_atencion" class="btn btn-danger btn-lg"  type="button" value="Cancelar registro" ng-click="vm.nuevaAtencion(false)" />    
            </div>
          </div>
              <div class="widget" ng-show="vm.registrar_atencion">
                <div class="widget-head">
                  <div class="pull-left">Examen físico</div><div class="center">Signos vitales</div>  
                </div>
                <div class="widget-content">
                  <div class="padd">
                    <div class="form">                             
                      <div class="row">
                        <div class="col-md-4">                    
                          <div class="form-group">
                            <label class="col-lg-3" for="content">Frecuencia cardiaca</label>
                            <div class="col-lg-9">
                              <div class="input-group">
                                <input ng-model="vm.atencion.frecuencia_cardiaca" class="form-control"/>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">                    
                          <div class="form-group">
                            <label class="col-lg-3" for="content">Presion arterial</label>
                            <div class="col-lg-9">
                              <div class="input-group">
                                <input ng-model="vm.atencion.presion_arterial" class="form-control"/>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">                    
                          <div class="form-group">
                            <label class="col-lg-3" for="content">Temperatura</label>
                            <div class="col-lg-9">
                              <div class="input-group">
                                <input ng-model="vm.atencion.temperatura" class="form-control"/>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="widget-head">
                        <div class="center">Estado nutricional</div>  
                      </div>
                      <br/>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="col-lg-3" for="content">Peso (Kg)</label>
                            <div class="col-lg-9">
                                <input ng-model = "vm.atencion.peso" class="form-control"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="col-lg-3">Estatura (Cms)</label>
                            <div class="col-lg-9">
                                <input ng-model="vm.atencion.estatura" class="form-control"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">                      
                          <div class="form-group">
                            <label class="col-lg-3">I.M.C</label>
                            <div class="col-lg-9">
                                <input ng-model="vm.atencion.imc" class="form-control"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="widget-head">
                        <div class="center">Estado emocional</div>  
                      </div>
                      <br/>
                      <div class="row">
                        <div class="col-md-3">                          
                          <div class="form-group">
                              <label class="col-lg-12">Estado:</label>
                          </div>
                        </div>
                      <div class="col-md-2">                    
                        <div class="form-group">
                          <label class="col-lg-7">Ansioso</label>
                            <div class="col-lg-5">                               
                              <div class="toggle-button">
                                  <input class="form-control" type="radio" ng-model="vm.atencion.estado_animo" value="ansioso">
                              </div> 
                            </div>
                        </div>
                      </div>
                      <div class="col-md-2">                    
                        <div class="form-group">
                          <label class="col-lg-7">Deprimido</label>
                            <div class="col-lg-5">                               
                              <div class="toggle-button">
                                  <input class="form-control" type="radio" ng-model="vm.atencion.estado_animo" value="deprimido">
                              </div> 
                            </div>
                        </div>
                      </div>
                      <div class="col-md-2">                    
                        <div class="form-group">
                          <label class="col-lg-7">Normal</label>
                            <div class="col-lg-5">                               
                              <div class="toggle-button">
                                  <input class="form-control" type="radio" ng-model="vm.atencion.estado_animo" value="normal">
                              </div> 
                            </div>
                        </div>
                      </div>
                      <div class="col-md-2">                    
                        <div class="form-group">
                          <label class="col-lg-7">Adaptado</label>
                            <div class="col-lg-5">                               
                              <div class="toggle-button">
                                  <input class="form-control" type="radio" ng-model="vm.atencion.estado_animo" value="adaptado">
                              </div> 
                            </div>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">                          
                          <div class="form-group">
                              <label class="col-lg-12">Agudeza visual:</label>
                          </div>
                        </div>
                      <div class="col-md-2">                    
                        <div class="form-group">
                          <label class="col-lg-7">Adecuada</label>
                            <div class="col-lg-5">                               
                              <div class="toggle-button">
                                  <input class="form-control" type="radio" ng-model="vm.atencion.agudeza_visual" value="adecuada">
                              </div> 
                            </div>
                        </div>
                      </div>
                      <div class="col-md-2">                    
                        <div class="form-group">
                          <label class="col-lg-7">Disminuida</label>
                            <div class="col-lg-5">                               
                              <div class="toggle-button">
                                  <input class="form-control" type="radio" ng-model="vm.atencion.agudeza_visual" value="disminuida">
                              </div> 
                            </div>
                        </div>
                      </div>
                      <div class="col-md-2">                    
                        <div class="form-group">
                          <label class="col-lg-7">Limitación</label>
                            <div class="col-lg-5">                               
                              <div class="toggle-button">
                                  <input class="form-control" type="radio" ng-model="vm.atencion.agudeza_visual" value="limitacion">
                              </div> 
                            </div>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">                          
                          <div class="form-group">
                              <label class="col-lg-12">Destreza manual:</label>
                          </div>
                        </div>
                      <div class="col-md-2">                    
                        <div class="form-group">
                          <label class="col-lg-7">Adecuada</label>
                            <div class="col-lg-5">                               
                              <div class="toggle-button">
                                  <input class="form-control" type="radio" ng-model="vm.atencion.destreza_manual" value="adecuada">
                              </div> 
                            </div>
                        </div>
                      </div>
                      <div class="col-md-2">                    
                        <div class="form-group">
                          <label class="col-lg-7">Disminuida</label>
                            <div class="col-lg-5">                               
                              <div class="toggle-button">
                                  <input class="form-control" type="radio" ng-model="vm.atencion.destreza_manual" value="disminuida">
                              </div> 
                            </div>
                        </div>
                      </div>
                      <div class="col-md-2">                    
                        <div class="form-group">
                          <label class="col-lg-7">Limitación</label>
                            <div class="col-lg-5">                               
                              <div class="toggle-button">
                                  <input class="form-control" type="radio" ng-model="vm.atencion.destreza_manual" value="limitacion">
                              </div> 
                            </div>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">                          
                          <div class="form-group">
                              <label class="col-lg-12">Actividad y ejercicio:</label>
                          </div>
                        </div>
                      <div class="col-md-2">                    
                        <div class="form-group">
                          <label class="col-lg-7">Ninguno</label>
                            <div class="col-lg-5">                               
                              <div class="toggle-button">
                                  <input class="form-control" type="radio" ng-model="vm.atencion.actividad" value="ninguno">
                              </div> 
                            </div>
                        </div>
                      </div>
                      <div class="col-md-2">                    
                        <div class="form-group">
                          <label class="col-lg-7">Leve</label>
                            <div class="col-lg-5">                               
                              <div class="toggle-button">
                                  <input class="form-control" type="radio" ng-model="vm.atencion.actividad" value="leve">
                              </div> 
                            </div>
                        </div>
                      </div>
                      <div class="col-md-2">                    
                        <div class="form-group">
                          <label class="col-lg-7">Moderada</label>
                            <div class="col-lg-5">                               
                              <div class="toggle-button">
                                  <input class="form-control" type="radio" ng-model="vm.atencion.actividad" value="moderada">
                              </div> 
                            </div>
                        </div>
                      </div>
                      <div class="col-md-2">                    
                        <div class="form-group">
                          <label class="col-lg-7">Activo</label>
                            <div class="col-lg-5">                               
                              <div class="toggle-button">
                                  <input class="form-control" type="radio" ng-model="vm.atencion.actividad" value="activo">
                              </div> 
                            </div>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">                          
                          <div class="form-group">
                              <label class="col-lg-12">Dependencia autocuidado:</label>
                          </div>
                        </div>
                      <div class="col-md-2">                    
                        <div class="form-group">
                          <label class="col-lg-7">Independiente</label>
                            <div class="col-lg-5">                               
                              <div class="toggle-button">
                                  <input class="form-control" type="radio" ng-model="vm.atencion.dependencia" value="independiente">
                              </div> 
                            </div>
                        </div>
                      </div>
                      <div class="col-md-2">                    
                        <div class="form-group">
                          <label class="col-lg-7">Dependencia parcial</label>
                            <div class="col-lg-5">                               
                              <div class="toggle-button">
                                  <input class="form-control" type="radio" ng-model="vm.atencion.dependencia" value="parcial">
                              </div> 
                            </div>
                        </div>
                      </div>
                      <div class="col-md-2">                    
                        <div class="form-group">
                          <label class="col-lg-7">Dependencia total</label>
                            <div class="col-lg-5">                               
                              <div class="toggle-button">
                                  <input class="form-control" type="radio" ng-model="vm.atencion.dependencia" value="total">
                              </div> 
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="widget" ng-show="vm.registrar_atencion">
              <div class="widget-head">
                <div class="pull-left">Ostomias del paciente</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="icon-remove"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <ul class="task">
                    <li ng-repeat="ostomia_diagnostico in vm.ostomias_diagnostico">
                    <div class="row">
                      <div class="col-md-9">
                        <h2><img src="<?php echo base_url(); ?>assets/img/colon-icon.png" alt=""> {{ostomia_diagnostico.tipo_ostomia.nombre}}</h2>
                      {{ostomia_diagnostico.temporalidad_nombre}}
                         <p class="p-meta">
                          <span>Última modificacion : {{ostomia_diagnostico.valoracion_ostomia.created}}</span> 
                        </p>
                      </div>
                      <div class="col-md-3">
                          <input ng-show="ostomia_diagnostico.mostrar_nuevo_sacs == false" class="btn btn-success btn-lg"  type="button" value="Actualizar sacs" ng-click="vm.mostrarActualizarSacs(ostomia_diagnostico, true)" /> 
                      </div>
                    </div>
                      <br/>
                      <div class="widget-foot" ng-show="ostomia_diagnostico.mostrar_nuevo_sacs">
                      <div class="row">
                        <div class="col-md-3">                      
                          <div class="form-group">
                            <label class="col-lg-3">SacsL</label>
                            <div class="col-lg-9">
                                <select class="form-control" ng-model="ostomia_diagnostico.valoracion_ostomia.sacsl" ng-change="vm.dibujar_sacsl(ostomia_diagnostico)">
                                  <option value="l1">L1</option>
                                  <option value="l2">L2</option>
                                  <option value="l3">L3</option>
                                  <option value="l4">L4</option>
                                  <option value="lx">LX</option>
                                </select> 
                            </div>
                          </div>
                        </div>
                          <div class="col-md-3">                          
                            <div class="form-group">
                                <div class="col-lg-9">
                                  <div class="input-group"> 
                                    <div id="lienzo_sacs_l{{ostomia_diagnostico.id_ostomia}}" style="width: 213px; height: 361px; background-image: url('<?php echo base_url(); ?>assets/img/sacsl.png');"></div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3">                      
                          <div class="form-group">
                            <label class="col-lg-3">SacsT</label>
                            <div class="col-lg-9">
                                <select class="form-control" ng-model="ostomia_diagnostico.valoracion_ostomia.sacst" ng-change="vm.dibujar_sacst(ostomia_diagnostico)">
                                  <option value="t1">TI</option>
                                  <option value="t2">TII</option>
                                  <option value="t3">TIII</option>
                                  <option value="t4">TIV</option>
                                  <option value="tv">TV</option>
                                </select> 
                            </div>
                          </div>
                        </div>
                          <div class="col-md-3">                          
                            <div class="form-group">
                                <div class="col-lg-9">
                                  <div class="input-group"> 
                                    <div id="lienzo_sacs_t{{ostomia_diagnostico.id_ostomia}}" style="width: 200px; height: 300px; background-image: url('<?php echo base_url(); ?>assets/img/sacst.png');"></div>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-md-12">
                          <label class="col-lg-2">Comentario</label>
                          <div class="col-lg-10">
                            <textarea  ng-model="ostomia_diagnostico.valoracion_ostomia.comentario_sacs" class="form-control textarea">{{vm.ostomia_selected.comentario_sacs}}</textarea>
                          </div>
                        </div> 
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-md-12 col-lg-offset-9">  
                          <input ng-show="ostomia_diagnostico.mostrar_nuevo_sacs" class="btn btn-danger btn-lg"  type="button" value="Cancelar registro" ng-click="vm.mostrarActualizarSacs(ostomia_diagnostico, false)" /> 
                          <input ng-show="ostomia_diagnostico.mostrar_nuevo_sacs" class="btn btn-success btn-lg"  type="button" value="Grabar valoración" ng-click="vm.guardar_valoracion_ostomia(ostomia_diagnostico)" />
                        </div>
                      </div>

                    </div>
                    </li>                                                                                                            
                  </ul>
                  <div class="clearfix"></div>  

                  <div class="widget-foot">
                  </div>
                </div>
              </div>
            <div class="row" ng-show="vm.registrar_atencion">
              <div class="col-md-6">
                <div class="row">                    
                  <div class="form-group">
                    <label class="col-lg-3">Insumos</label>
                    <div class="col-lg-9">
                      <multiselect  ng-model="vm.atencion.insumos" options="insumo.sap+' '+insumo.icc+' '+insumo.descripcion_sap for insumo in vm.insumos" data-multiple="true" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5"></multiselect>
                    </div>
                  </div>
                </div>                    
                <div class="widget">
                  <div class="widget-head">
                    <div class="pull-left">Insumos utilizados</div> 
                    <div class="clearfix"></div>
                  </div>
                  <div class="widget-content">
                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>SAP</th>
                          <th>ICC</th>
                          <th class="text-center" >DESCRIPCIÓN SAP
                           
                          </th>
                          <th class="text-center">CANTIDAD</th>
                          <th class="text-center">GRATIS</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="insumo in vm.atencion.insumos">
                          <td>{{insumo.sap}}</td>
                          <td>{{insumo.icc}}</td>
                          <td>{{insumo.descripcion_sap}}</td>
                          <td>
                            <div class="input-group"> 
                             <input type="number" ng-model="insumo.cantidad" ng-value="1" class="form-control" style="width:100%" />
                            </div>          
                          </td>
                          <td>
                            <div class="input-group text-center"> 
                             <input ng-model="insumo.gratis" type="checkbox">
                            </div>          
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <div class="clearfix"></div>  

                    <div class="widget-foot">
                    </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="col-md-12">
                    <label class="col-lg-2">Detalle</label>
                    <div class="col-lg-10">
                      <textarea  ng-model="vm.atencion.comentario_insumos" class="form-control textarea" style="text-transform:uppercase">{{vm.atencion.comentario_insumos}}</textarea>
                    </div>
                  </div>
                </div>
            </div>
            <hr>
            <div class="row">
              <div class="widget" ng-show="vm.registrar_atencion">
                <div class="widget-buttons">
                  <div class="col-md-12 col-lg-offset-9">  
                    <input ng-show="vm.registrar_atencion" class="btn btn-danger btn-lg"  type="button" value="Cancelar registro" ng-click="vm.nuevaAtencion(false)" /> 
                    <input ng-show="vm.registrar_atencion" class="btn btn-success btn-lg"  type="button" value="Registrar atención" ng-click="vm.guardar_atencion_paciente('atencion')"/>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="widget">
              <div class="widget-head">
                <div class="pull-left">
                  
                    <img src="<?php echo base_url(); ?>assets/img/parche-icon.png" alt="">

                    Listado de atenciones</div>
                <div class="widget-icons pull-right">
                  <span><span class="label label-primary">{{vm.encuestas.length}}</span>  Llamados</span>
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
                                <input type="text" ng-model="vm.search" class="form-control" placeholder="Profesional / Comentarios">
                              </div>
                            </div>
                          </div>
                      </div>
                    </form>
                  </div>
                <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th ng-click="vm.ordenarTabla('fecha_registro')">Fecha
                        <span class="glyphicon sort-icon" ng-show="vm.sortKey=='fecha_registro'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                      </th>
                      <th class="text-center" ng-click="vm.ordenarTabla('profesional')">Profesional
                        <span class="glyphicon sort-icon" ng-show="vm.sortKey=='profesional'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                      </th>
                      <th class="text-center" ng-click="vm.ordenarTabla('observaciones')">Comentarios
                        <span class="glyphicon sort-icon" ng-show="vm.sortKey=='estado_animo'" ng-class="{'glyphicon-chevron-up':vm.reverse,'glyphicon-chevron-down':!vm.reverse}"></span>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-show="vm.atenciones.length" dir-paginate="atencion in vm.atenciones |orderBy:vm.sortKey:vm.reverse|filter:vm.search|itemsPerPage:vm.itemsMostrar">
                      <td>{{atencion.fecha_registro}}</td>
                      <td>{{atencion.profesional}}</td>
                      <td>{{atencion.estado_animo}}</td>
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
          <div ng-show="vm.diagnostico.id_diagnostico == ''">
            <div class="alert alert-info pull-center">
              Se debe registrar el diagnóstico para agregar estomías.
            </div> 
          </div>
        </div> <!-- fin tab atenciones -->
      </div>
    </div>
  </div>
        <div id="modal_ingreso_estomias" class="modal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Ingreso estomías</h4>
              </div>
              <div class="modal-body">
              <div class="tabbable" style="margin-bottom: 18px;">
                <ul class="nav nav-tabs">
                  <li ng-repeat="estoma in vm.numero_estomas"  ng-click="vm.activar_tab(estoma)"> 
                    <a data-toggle="tab">{{estoma.tipo_estoma}}</a>
                  </li>
                </ul>
                <div class="tab-content" ng-repeat="estoma in vm.numero_estomas">
                  <div class="tab-pane {{estoma.active}}"  id="{{estoma.id}}">
                    <div  class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="col-lg-3">Tipo estomía</label>
                          <div class="col-lg-9">
                              <select class="form-control" title="Seleccione tipo ostomía" data-live-search="false"  ng-model="estoma.tipo_ostomia" ng-change="vm.cambiar_nombre_tab(estoma, tipo_ostomia)">                                                          
                                <option  ng-repeat="tipo_ostomia in vm.tipos_ostomias" value="{{tipo_ostomia.id_tipo_ostomia}}" >{{tipo_ostomia.categoria}}</option>
                              </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div  class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="col-lg-3">Diametro (mm)</label>
                          <div class="col-lg-9">
                            <input type="number" ng-model="estoma.diametro" class="form-control"/> 
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="col-lg-3">Temporalidad</label>
                          <div class="col-lg-9">
                            <select class="form-control" ng-model="estoma.temporalidad" title="Seleccione número" data-live-search="false">
                                <option ng-value="1">Definitiva</option>
                                <option ng-value="0">Temporal</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <br/>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="col-lg-5">Complicaciones</label>
                          <div class="col-lg-5">
                               <multiselect ng-model="estoma.complicaciones" options="complicacion.nombre for complicacion in vm.complicaciones" data-multiple="true" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5" ng-change="vm.visualizar_sacs(estoma.complicaciones)"></multiselect>      
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <div class="col-lg-10">
                            <select class="form-control" title="T" data-live-search="false" ng-model="estoma.sacs_t" ng-disabled="vm.sacs_disabled">
                                <option selected disabled value="">T</option>
                                <option value"1">I</option>
                                <option value"2">II</option>
                                <option value"3">III</option>
                                <option value"4">IV</option>
                                <option value"5">V</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3" ng-disabled="vm.sacs_disabled">
                        <div class="form-group">
                          <div class="col-lg-10">
                            <select class="form-control" title="L" data-live-search="false" ng-model="estoma.sacs_l" ng-disabled="vm.sacs_disabled">
                                <option selected disabled value="">L</option>
                                <option value"1">1</option>
                                <option value"2">2</option>
                                <option value"3">3</option>
                                <option value"4">4</option>
                                <option value"5">X</option>
                            </select>                          
                          </div>
                        </div>
                      </div>
                    </div>
                     <hr /> 
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="col-lg-5">Sistemas anteriores</label>
                          <div class="col-lg-5">
                              <multiselect ng-model="estoma.sistemas_anteriores" options="sistema.nombre for sistema in vm.sistemas" data-multiple="true" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5"></multiselect>  
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <div class="col-lg-12">
                          <div class="gallery">
                             Ayuda evaluacion SACS (link)
                          </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="col-lg-5">Adjuvantes</label>
                          <div class="col-lg-5">
                              <multiselect ng-model="estoma.adjuvantes_antiguos" options="adjuvante_antiguo.nombre for adjuvante_antiguo in vm.adjuvantes_antiguos" data-multiple="true" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5"></multiselect>  
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="col-lg-4">Tipo barrera</label>
                          <div class="col-lg-5">
                            <select class="form-control" ng-model="estoma.tipo_barrera_antigua" title="Seleccione número" data-live-search="false">
                                <option ng-value"0">Plana</option>
                                <option ng-value"1">Convexa</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <hr /> 
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="col-lg-5">Sistemas actual</label>
                          <div class="col-lg-5">
                              <multiselect ng-model="estoma.sistemas_actuales" options="sistema.nombre for sistema in vm.sistemas_convatec" data-multiple="true" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5"></multiselect>  
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="col-lg-4">Tipo barrera</label>
                          <div class="col-lg-5">
                            <select class="form-control" ng-model="estoma.tipo_barrera_actual" title="Seleccione número" data-live-search="false">
                                <option value"0">Plana</option>
                                <option value"1">Convexa</option>
                            </select>                          
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="col-lg-5">Adjuvantes</label>
                          <div class="col-lg-5">
                              <multiselect ng-model="estoma.adjuvantes_actuales" options="adjuvante_actual.nombre for adjuvante_actual in vm.adjuvantes_actuales" data-multiple="true" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5"></multiselect>  
                          </div>
                        </div>
                      </div>
                    </div>
                 </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                <button type="button" class="btn btn-primary" ng-click="vm.guardar_ostomia()">Guardar</button>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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
                        <h4>{{vm.nombre_profesional}}</h4>
                      </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="row">
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
          *Doy fe que los datos ingresados son fidedignos
          <br/>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" ng-click="vm.verificar_usuario()">Verificar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="modal_nueva_encuesta" class="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Datos encuesta</h4>            
        </div>
        <div class="modal-body">

          <div class="form">                             
            <div class="row">
              <div class="col-md-6" ng-show="false">                    
                <div class="form-group">
                    <label class="col-lg-3">Fecha llamado</label>
                    <div class="col-lg-9">
                        <div class="input-group">
                          <input type="text" class="form-control" ng-model="vm.encuesta.fecha_inicio" is-open="vm.popup_fecha_inicio.opened" ng-required="true" close-text="Close" />
                            <span class="input-group-btn">
                              <button  class="btn btn-default"><i class="icon-calendar"></i></button>
                            </span>
                        </div>
                    </div>
                </div>
              </div>
              <div class="col-lg-8">
              </div>
              <div class="col-md-4">                    
                <div class="form-group">
                  <div class="col-lg-offset-2 col-lg-12">
                    <input class="btn btn-danger btn-lg" ng-model="button" id="btn_no_contesta"  type="button" value="No contesta" ng-click="vm.guardar_encuesta(0)" />     
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6"> 
                  <h2> Tiempo: {{vm.encuesta.transcurrido}}</h2>
              </div>
              <div class="col-md-6">                    
                <div class="form-group">
                    <label class="col-lg-3">Hora inicio</label>
                    <div class="col-lg-9">
                        <div class="input-group">
                           <input ng-readonly="true" type="text" class="form-control" ng-model="vm.encuesta.hora_inicio" ng-required="true" close-text="Close" />
                            <span class="input-group-btn">
                              <button  class="btn btn-default"><i class="icon-time"></i></button>
                            </span>
                        </div>
                    </div>
                </div>
              </div>
              <div class="col-md-6" ng-show="false">                    
                  <div class="form-group">
                      <label class="col-lg-3">Hora fin</label>
                      <div class="col-lg-9">
                          <div class="input-group">
                            <input ng-readonly="true" type="text" class="form-control" ng-model="vm.encuesta.hora_fin" ng-required="true" close-text="Close" />
                            <span class="input-group-btn">
                              <button  class="btn btn-default"><i class="icon-time"></i></button>
                            </span>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-1">
              1.
              </div>
              <div class="col-md-10">
                <div class="form-group">
                  <label class="col-lg-5">Tipo dispositivo que usa actualmente</label>
                  <div class="col-lg-7">
                     <multiselect ng-model="vm.encuesta.dispositivo_antiguo" options="sistema_antiguo.nombre for sistema_antiguo in vm.sistemas" data-multiple="true" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5"></multiselect>  
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-1">
              2.
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <label class="col-lg-5">Corrección de entrega</label>
                  <div class="col-lg-7">
                      <select ng-model="vm.encuesta.correccion_entrega" class="form-control">  
                        <option value="" selected disabled> Seleccione</option>                                                        
                        <option value="1">SI</option>
                        <option value="0">NO</option>
                      </select>
                  </div>
                </div>
              </div>
              </div>
              <div class="row">
              <div class="col-md-1">
              3.
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <label class="col-lg-5">Cierre quirurgico pendiente</label>
                  <div class="col-lg-7">
                      <select ng-model="vm.encuesta.cierre_quirurgico" class="form-control">  
                        <option value="" selected disabled> Seleccione</option>                                                        
                        <option value="1">SI</option>
                        <option value="0">NO</option>
                      </select>
                  </div>
                </div>
              </div>
              </div>
              <div class="row">
              <div class="col-md-1">
              4.
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <label class="col-lg-5">Remitido a su institución de salud</label>
                  <div class="col-lg-7">
                      <select ng-model="vm.encuesta.remitido" class="form-control">  
                        <option value="" selected disabled> Seleccione</option>                                                        
                        <option value="1">SI</option>
                        <option value="0">NO</option>
                      </select>
                  </div>
                </div>
              </div>
              </div>
              <div class="row">
              <div class="col-md-1">
              5.
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <label class="col-lg-5">¿Evento adverso por uso de dispositivo médico?</label>
                  <div class="col-lg-7">
                      <select ng-model="vm.encuesta.evento_adverso" class="form-control">  
                        <option value="" selected disabled> Seleccione</option>                                                        
                        <option value="1">SI</option>
                        <option value="0">NO</option>
                      </select>
                  </div>
                </div>
              </div>
              </div>
              <div class="row">
              <div class="col-md-1">
              6.
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <label class="col-lg-5">Sistema de dispositivos</label>
                  <div class="col-lg-7">
                      <select ng-model="vm.encuesta.sistema_dispositivo" class="form-control">  
                        <option value="" selected disabled> Seleccione</option>                                                        
                        <option value="1">1 pieza</option>
                        <option value="2">2 piezas</option>
                      </select>
                  </div>
                </div>
              </div>
              </div>
              <div class="row">
              <div class="col-md-1">
              7.
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <label class="col-lg-5">Número de placas que le entregan al mes (1-30)</label>
                  <div class="col-lg-7">
                    <input type="number" ng-model="vm.encuesta.numero_placas" class="form-control"/> 
                  </div>
                </div>
              </div>
              </div>
              <div class="row">
              <div class="col-md-1">
              8.
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <label class="col-lg-5">¿Cuantos dispositivos utiliza al mes? (1-30)</label>
                  <div class="col-lg-7">
                    <input type="number" ng-model="vm.encuesta.dispositivos_mes" class="form-control"/>
                  </div>
                </div>
              </div>
              </div>
              <div class="row">
              <div class="col-md-1">
              9.
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <label class="col-lg-5">Número de bolsas que le entregan al mes (1-30)</label>
                  <div class="col-lg-7">
                    <input type="number" ng-model="vm.encuesta.numero_bolsas" class="form-control"/>
                  </div>
                </div>
              </div>
              </div>
              <div class="row">
              <div class="col-md-1">
              10.
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <label class="col-lg-5">Utiliza accesorios</label>
                  <div class="col-lg-7">
                    <multiselect ng-model="vm.encuesta.adjuvantes" options="adjuvante.nombre for adjuvante in vm.adjuvantes_antiguos" data-multiple="true" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5"></multiselect>  
                  </div>
                </div>
              </div>
              </div>
              <div class="row">
              <div class="col-md-1">
              12.
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <label class="col-lg-5">¿Por qué no utiliza Convatec?</label>
                  <div class="col-lg-7">
                    <input   class="form-control"/>
                  </div>
                </div>
              </div>
              </div>
              <div class="row">
              <div class="col-md-1">
              13.
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <label class="col-lg-5">Actividad laboral</label>
                  <div class="col-lg-7">
                    <input ng-model="vm.encuesta.actividad_laboral"  class="form-control"/>
                  </div>
                </div>
              </div>
              </div>
              <div class="row">
              <div class="col-md-1">
              14.
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <label class="col-lg-5">¿Recomienda productos Convatec?</label>
                  <div class="col-lg-7">
                      <select ng-model="vm.encuesta.recomienda_convatec" class="form-control">  
                        <option value="" selected disabled> Seleccione</option>                                                        
                        <option value="1">SI</option>
                        <option value="0">NO</option>
                      </select>
                  </div>
                </div>
              </div>
              </div>
              <div class="row">
              <div class="col-md-1">
              15.
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <label class="col-lg-5">¿Recomendaría otros pacientes al programa?</label>
                  <div class="col-lg-7">
                      <select ng-model="vm.encuesta.recomendaria_programa" class="form-control">  
                        <option value="" selected disabled> Seleccione</option>                                                        
                        <option value="1">SI</option>
                        <option value="0">NO</option>
                      </select>
                  </div>
                </div>
              </div>
              </div>
              <div class="row">
              <div class="col-md-1">
              16.
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <label class="col-lg-5">¿Tiene adherencia a su autocuidado?</label>
                  <div class="col-lg-7">
                      <select ng-model="vm.encuesta.autocuidado" class="form-control">  
                        <option value="" selected disabled> Seleccione</option>                                                        
                        <option value="1">SI</option>
                        <option value="0">NO</option>
                      </select>
                  </div>
                </div>
              </div>
              </div>
              <div class="row">
              <div class="col-md-1">
              17.
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <label class="col-lg-5">¿Semanas de retorno a su vida laboral?</label>
                  <div class="col-lg-7">
                      <select ng-model="vm.encuesta.tiempo_retorno_laboral" class="form-control">  
                        <option value="" selected disabled> Seleccione</option>                                                        
                        <option value="1">1-2</option>
                        <option value="2">3-4</option>
                        <option value="3">5-6</option>
                        <option value="4">7-8</option>
                        <option value="5">9-10</option>
                        <option value="6">Más</option>
                      </select>
                  </div>
                </div>
              </div>
              </div>
              <div class="row">
              <div class="col-md-1">
              18.
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <label class="col-lg-5">¿Estado del paciente en el programa?</label>
                  <div class="col-lg-7">
                  <select ng-model="vm.encuesta.estado_programa" class="form-control">
                        <option value="" selected disabled> Seleccione</option>     
                        <option value"1">Activo</option>
                        <option value"0">Inactivo</option>
                    </select>
                  </div>
                </div>
              </div>
              </div>
              <div class="row">
              <div class="col-md-1">
              19.
              </div>
                <div class="col-md-9">                          
                  <div class="form-group">
                      <label class="col-lg-5">Fecha próxima llamada</label>
                      <div class="col-lg-7">
                        <div class="input-group"> 
                          <input type="text" class="form-control" uib-datepicker-popup  ng-model="vm.encuesta.proximo_llamado" is-open="vm.popup_fecha_proximo_llamado.opened" ng-required="true" close-text="Close"/>
                          <span  ng-click="vm.fechaProximoLlamado()" class="input-group-addon btn btn-info btn-lg"><i class="icon-calendar"></i></span>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="row">
              <div class="col-md-1">
              21.
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <label class="col-lg-5">Observaciones</label>
                  <div class="col-lg-7">
                      <div class="input-group">
                         <textarea ng-model="vm.encuesta.observaciones" class="form-control textarea"/></textarea>
                      </div>
                  </div>
                </div>
              </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cerrar</button>
          <button type="button" class="btn btn-primary" ng-click="vm.guardar_encuesta(1)">Guardar</button>
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
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/angular-locale_es-cl.js"></script>
      

      <script src="<?php echo base_url(); ?>assets/js/angular-flash.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/jquery.prettyPhoto.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/dirPagination.js"></script>

      

<script>
(function(){
    'use strict';
    angular.module('myApp', ['ui.bootstrap', 'ui.multiselect', 'angularUtils.directives.dirPagination'])
    angular.module('myApp').controller('EstomasController', EstomasController);


    EstomasController.$inject = ['$http', '$timeout', '$location', '$window', '$interval'];
    function EstomasController($http, $location, $window, $timeout, $interval){
        var vm = this;

        vm.paciente = JSON.parse('<?php echo $paciente; ?>');
        vm.paciente.fecha_nacimiento = new Date(vm.paciente.fecha_nacimiento);
        vm.numero_estomas = [];
        vm.ostomias_diagnostico = JSON.parse('<?php echo $ostomias; ?>');
        vm.tipos_ostomias = JSON.parse('<?php echo $tipos_ostomias; ?>');
        vm.tipos_heridas = JSON.parse('<?php echo $tipos_heridas; ?>');
        vm.tipos_documentos = JSON.parse('<?php echo $tipos_documentos; ?>');
        vm.isDisabled = false;
        vm.sacs_disabled = true;
        vm.diagnostico = JSON.parse('<?php echo $diagnostico_antiguo; ?>');

        vm.diagnostico.tratamiento_actual_fecha_cirugia = new Date(vm.diagnostico.tratamiento_actual_fecha_cirugia);
        vm.cies10 = JSON.parse('<?php echo $cies10; ?>');
        vm.sistemas = JSON.parse('<?php echo $sistemas; ?>');
        vm.isapres = JSON.parse('<?php echo $isapres; ?>');
        vm.sistemas_convatec = JSON.parse('<?php echo $sistemas_convatec; ?>');
        vm.adjuvantes_antiguos = JSON.parse('<?php echo $adjuvantes_antiguos; ?>');
        vm.adjuvantes_actuales = JSON.parse('<?php echo $adjuvantes_actuales; ?>');
        vm.establecimientos = JSON.parse('<?php echo $establecimientos; ?>');
        vm.especialidades = JSON.parse('<?php echo $especialidades; ?>');
        vm.nombre_profesional = '<?php echo $nombre_profesional; ?>';
        vm.medicos = JSON.parse('<?php echo $medicos; ?>');
        vm.categorias_ostomias = JSON.parse('<?php echo $categorias_ostomias; ?>');
        vm.ubicaciones_estomas = JSON.parse('<?php echo $ubicaciones_estomas; ?>');
        vm.ubicaciones_heridas = JSON.parse('<?php echo $ubicaciones_heridas; ?>');
        vm.encuestas = JSON.parse('<?php echo $encuestas; ?>');
        vm.encuestas_no_contestadas = JSON.parse('<?php echo $encuestas_no_contestadas; ?>');
        vm.complicaciones = [];
        vm.insumos = [];
        vm.herida_seleccionada = false;
        vm.ultimo_pintado = 0;
        vm.medico = false;
        vm.nuevo_medico = false;
        vm.datos_verificar = false;
        vm.tipos_ostomias = false;
        vm.atenciones = JSON.parse('<?php echo $atenciones; ?>');
        vm.ostomia_selected =     vm.ostomias_diagnostico[vm.ostomias_diagnostico.length-1];
        vm.registrar_atencion = false;


        vm.comunas  = JSON.parse('<?php echo $comunas; ?>');
        vm.regiones = JSON.parse('<?php echo $regiones; ?>');

        vm.diagnostico.cie10 = JSON.parse('<?php echo $cie10_selected; ?>');

        vm.fecha_hoy = false;
        vm.hora_actual = false;
        vm.opened = false;
        vm.currenttime = '<?php echo date("Y-m-d H:i:s", strtotime('-4 hour' , strtotime(date('Y-m-d H:i:s'))))?>';
        vm.serverdate = new Date(vm.currenttime);
        
        vm.encuesta = {};
        //vm.encuesta.hora_fin =  vm.serverdate.getHours()+':'+vm.serverdate.getMinutes()+':'+vm.serverdate.getSeconds();
        vm.encuesta.tiempo_transcurrido = new Date();
        vm.encuesta.tiempo_transcurrido.setHours(0,0,0,0);

        vm.movimientos = new Array();
        vm.pulsado = false;
        vm.context= false;
        vm.opened = false;
        if(vm.diagnostico.id_diagnostico == ''){
          vm.primer_diagnostico = false;
        }else{
          vm.primer_diagnostico = true;
        }

        if(vm.atenciones){
          vm.ultima_atencion = vm.atenciones[0];
        }

        vm.abrirModalEstomas                = abrirModalEstomas;
        vm.activar_tab                      = activar_tab;
        vm.cambiar_nombre_tab               = cambiar_nombre_tab;
        vm.guardar_diagnostico              = guardar_diagnostico;
        vm.guardar_herida                   = guardar_herida;
        vm.nuevo_estomia                    = nuevo_estomia;
        vm.visualizar_sacs                  = visualizar_sacs;
        vm.success                          = success;
        vm.guardar_ostomia_paciente         = guardar_ostomia_paciente;
        vm.remover_cie10_selected           = remover_cie10_selected;
        vm.remover_insumo_selected          = remover_insumo_selected;
        vm.repinta                          = repinta;
        vm.crearLienzo                      = crearLienzo;
        vm.cargar_comunas                   = cargar_comunas;
        vm.fechaNacimiento                  = fechaNacimiento;
        vm.fechaProximoLlamado              = fechaProximoLlamado;
        vm.tratamientoActualFechaCirugia    = tratamientoActualFechaCirugia;
        vm.guardar_paciente                 = guardar_paciente;
        vm.cargar_medicos_establecimiento   = cargar_medicos_establecimiento;
        vm.abrirModalRegistroMedicos        = abrirModalRegistroMedicos;
        vm.guardar_nuevo_medico             = guardar_nuevo_medico;
        vm.verificar_usuario                = verificar_usuario;
        vm.modal_verificar_usuario          = modal_verificar_usuario;
        vm.cargar_tipos_ostomias            = cargar_tipos_ostomias;
        vm.dibujar_estoma                   = dibujar_estoma;
        vm.dibujar_herida                   = dibujar_herida;
        vm.dibujar_drenaje                  = dibujar_drenaje;
        vm.dibujar_sacsl                    = dibujar_sacsl;
        vm.dibujar_sacst                    = dibujar_sacst;
        vm.seleccionar_estoma               = seleccionar_estoma;
        vm.ordenarTabla                     = ordenarTabla;
        vm.abrirModalEncuesta               = abrirModalEncuesta;
        vm.correrTiempo                     = correrTiempo;
        vm.guardar_encuesta                 = guardar_encuesta;
        vm.calcularEdad                     = calcularEdad;
        vm.nuevaAtencion                    = nuevaAtencion;
        vm.limpiarNuevaAtencion             = limpiarNuevaAtencion;
        vm.mostrarActualizarSacs            = mostrarActualizarSacs;
        vm.guardar_valoracion_ostomia       = guardar_valoracion_ostomia;
        vm.guardar_atencion_paciente        = guardar_atencion_paciente;
        //vm.seleccionar_estoma = seleccionar_estoma;

        vm.sortKey = '{}';
        vm.reverse = '{}';
        vm.itemsMostrar = '20';


        vm.canvasDiv = document.getElementById('lienzo');
        vm.canvasDivCuerpo = document.getElementById('lienzo_cuerpo');
        vm.canvasDivDrenaje = document.getElementById('lienzo_drenaje');
        vm.canvasDivSacsL = document.getElementById('lienzo_sacs_l');
        vm.canvasDivSacsT = document.getElementById('lienzo_sacs_t');
        vm.canvas = document.createElement('canvas');
        vm.canvas_drenaje = document.createElement('canvas');
        vm.canvas_sacsl = document.createElement('canvas');
        vm.canvas_sacst = document.createElement('canvas');
        vm.canvas_cuerpo = document.createElement('canvas');

        crearLienzo();

        if(vm.ostomia_selected){
          dibujar_estoma();
          dibujar_drenaje();
          dibujar_sacsl(vm.ostomia_selected);
          dibujar_sacst(vm.ostomia_selected);
        }
        if(vm.paciente.fecha_nacimiento != 'Invalid Date'){ 
          vm.paciente.fecha_nacimiento.setDate(vm.paciente.fecha_nacimiento.getDate() + 1);
          calcularEdad(vm.paciente.fecha_nacimiento);
        }
      
        app.config((FlashProvider) => {
            FlashProvider.setTimeout(500);
            FlashProvider.setShowClose(true);
            FlashProvider.setOnDismiss(myCallback);
        });

        vm.hstep = 1;
        vm.mstep = 1;
        vm.popup_fecha_nacimiento = {
          opened: false
        };
        vm.popup_fecha_proximo_llamado = {
          opened: false
        };
        vm.popup_tratamiento_actual_fecha_cirugia = {
          opened: false
        };

        vm.valorDefecto = {
        value: '1'
        }

      var config = {
          headers : {
              'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
          }
      }

      vm.dateOptions = {
        formatYear: 'yy',
        maxDate: new Date(2020, 5, 22),
        minDate: new Date(),
        startingDay: 1
      };
     //limpio modal ingreso de medicos una vez que se cerró 
    $("#modal_registro_medico").on('hidden.bs.modal', function () {
      $(this).data('bs.modal', null);
      vm.nuevo_medico = '';
    });
    function mostrarActualizarSacs(ostomia, value){
    /* vm.canvasDivSacsL = document.getElementById('lienzo_sacs_l'+ostomia.id_ostomia);
      vm.canvas_sacsl.setAttribute('width', 213);
      vm.canvas_sacsl.setAttribute('height', 361);
      vm.canvas_sacsl.setAttribute('id', 'canvas');
      vm.canvasDivSacsL.appendChild(vm.canvas_sacsl);

      vm.canvasDivSacsT = document.getElementById('lienzo_sacs_t'+ostomia.id_ostomia);
      vm.canvas_sacst.setAttribute('width', 200);
      vm.canvas_sacst.setAttribute('height', 300);
      vm.canvas_sacst.setAttribute('id', 'canvas');*/
      vm.canvasDivSacsT.appendChild(vm.canvas_sacst);

      ostomia.mostrar_nuevo_sacs = value; 
    }

    function limpiarNuevaAtencion(){
      vm.atencion = "";
    }
    function nuevaAtencion(value){
      cargar_insumos();

      vm.registrar_atencion = value;
    }    

    function ordenarTabla(keyname){
      vm.sortKey = keyname;   //set the sortKey to the param passed
      vm.reverse = !vm.reverse; //if true make it false and vice versa
    }

    function correrTiempo(){

      vm.serverdate.setSeconds(vm.serverdate.getSeconds()+1);
      vm.encuesta.tiempo_transcurrido.setSeconds(vm.encuesta.tiempo_transcurrido.getSeconds()+1);
    //  vm.encuesta.hora_fin = ("0" + vm.serverdate.getHours('H')).slice(-2)+':'+ ("0" + vm.serverdate.getMinutes('M')).slice(-2)+':'+ ("0" + vm.serverdate.getSeconds('S')).slice(-2);
      vm.encuesta.transcurrido = ("0" + vm.encuesta.tiempo_transcurrido.getHours('H')).slice(-2)+':'+ ("0" + vm.encuesta.tiempo_transcurrido.getMinutes('M')).slice(-2)+':'+ ("0" + vm.encuesta.tiempo_transcurrido.getSeconds('S')).slice(-2);
    }

    function guardar_encuesta(estado) {
      if(estado){
        vm.encuesta.contesta = 1;
      }
      else{
        vm.encuesta.contesta = 0;
      }

      vm.hora_fin = <?php echo "'".date("H:i:s", strtotime(date('H:i:s')))."'";?>;
      vm.encuesta.hora_fin = <?php echo "'".date("H:i:s", strtotime(date('H:i:s')))."'";?>;

      var data = $.param({
          encuesta: vm.encuesta,
          paciente: vm.paciente,
      });

      $http.post('<?php echo base_url(); ?>pacientes/guardar_encuesta_paciente/', data, config)
          .then(function(response){
              if(response.data !== 'false'){
                vm.encuestas = response.data.encuestas_contestadas;
                vm.encuestas_no_contestadas = response.data.encuestas_no_contestadas;
                //console.log(response.data);
                //vm.success("Se ha guardado la encuesta correctamente.");
                $('#modal_nueva_encuesta').modal('hide');

               //$interval.cancel(vm.correrTiempo(0));
                  setTimeout(function(){
                    if(vm.encuesta.contesta == 0){
                      vm.abrirModalEncuesta(0);
                    }
                  }, 2000); 
              }
          },
          function(response){
              console.log("error al guardar la encuesta.");
          }
      );
            
    };

    $(".textarea").keydown(function(e){
      if (e.keyCode == 13 && !e.shiftKey)
      {
        // prevent default behavior
        e.preventDefault();
        //alert("ok");
        return false;
        }
      });

    function nuevo_estomia(){
      vm.ostomia_selected = false;
    }
    function fechaNacimiento() {
      vm.popup_fecha_nacimiento.opened = true;
    };
    function fechaProximoLlamado() {
      vm.popup_fecha_proximo_llamado.opened = true;
    };
    function seleccionar_estoma(ostomia) {
      vm.ostomia_selected = ostomia;
      dibujar_estoma();
      dibujar_drenaje();
      dibujar_sacsl(vm.ostomia_selected);
      dibujar_sacst(vm.ostomia_selected);
    };
    
    function tratamientoActualFechaCirugia() {
      vm.popup_tratamiento_actual_fecha_cirugia.opened = true;
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
     function cargar_insumos(){

        $http.get('<?php echo base_url(); ?>medicamentos/get_insumos_activos')
          .then(function(response) {
              vm.insumos = response.data;
          
          }, function(response) {
            console.log("error al obtener los insumos")
        });
     }

      function cargar_tipos_ostomias(){
          var data = $.param({
          categoria: vm.ostomia_selected.categoria_ostomia.id_categoria_ostomia
      });
        if(vm.ostomia_selected.categoria_ostomia.id_categoria_ostomia){

           $http.post('<?php echo base_url(); ?>pacientes/get_tipos_ostomias_desde_categoria', data, config)
            .then(function(response){
                if(response.data !== 'false'){
                    vm.tipos_ostomias = response.data;
                }
            },
            function(response){
                console.log("error al obtener comunas.");
            }
          );
        }
     }

    function cargar_medicos_establecimiento(){
          var data = $.param({
          establecimiento: vm.paciente.establecimiento.id_establecimiento,
      });
      vm.medicos = '';
      vm.diagnostico.medico_tratante = '';
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

    function guardar_nuevo_medico(){
          var data = $.param({
          medico: vm.nuevo_medico,
          establecimiento: vm.diagnostico.establecimiento.id_establecimiento
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
          //vm.nuevo_medico = false;
     }

    function success(mensaje) {
        var id = $flash.create('success', mensaje, 0, {class: 'custom-class', id: 'custom-id'}, true);
  
    }

    function abrirModalRegistroMedicos() {
      $('#modal_registro_medico').appendTo("body").modal('show');
        
    }    


    function remover_cie10_selected(cie10_selected){
      for (var i =0; i < vm.diagnostico.cie10.length; i++)
       if (vm.diagnostico.cie10[i].id_cie10 === cie10_selected.id_cie10) {
          vm.diagnostico.cie10.splice(i,1);
          break;
       }
    }

    function remover_insumo_selected(insumo_selected){
      for (var i =0; i < vm.atencion.insumos.length; i++)
       if (vm.atencion.insumos[i].id_insumo === insumo_selected.id_insumo) {
          vm.atencion.insumos.splice(i,1);
          break;
       }
    }

    function guardar_paciente() {

      var data = $.param({
          paciente: vm.paciente
      });
      var id_paciente_antiguo = vm.paciente.id_paciente;

      $http.post('<?php echo base_url(); ?>pacientes/set_paciente', data, config)
          .then(function(response){
              if(response.data !== 'false'){
                vm.paciente = response.data;
                vm.paciente.fecha_nacimiento = new Date(vm.paciente.fecha_nacimiento);
                if(vm.paciente.fecha_nacimiento != 'Invalid Date'){ 
                  vm.paciente.fecha_nacimiento.setDate(vm.paciente.fecha_nacimiento.getDate() + 1);
                  calcularEdad(vm.paciente.fecha_nacimiento);
                }
               // vm.success("Se ha guardado paciente.");
                var id_paciente = vm.paciente.id_paciente;

                // redirecciona cuando es un registro de usuario para que quede el id en la url
                if(id_paciente_antiguo == null){
                  window.location ='<?php echo base_url(); ?>pacientes/nuevo_diagnostico/'+id_paciente;
                }
              }
          },
          function(response){
              console.log("error al guardar paciente.");
          }
      );
            
    };

    function guardar_ostomia_paciente() {

      var data = $.param({
          ostomia: vm.ostomia_selected,
          id_diagnostico: vm.diagnostico.id_diagnostico
      });

      $http.post('<?php echo base_url(); ?>pacientes/set_ostomias_paciente/'+vm.paciente.id_paciente, data, config)
          .then(function(response){
              if(response.data !== 'false'){
                vm.ostomias_diagnostico = response.data;
                 for(var i=0; i<vm.ostomias_diagnostico.length; i++){
                      if(vm.ostomias_diagnostico[i].id_ostomia == vm.ostomia_selected.id_ostomia){
                         vm.ostomia_selected = vm.ostomias_diagnostico[i];
                       
                        break;
                      }
                    }
                //vm.success("Se ha guardado el nuevo estoma.");

              }
          },
          function(response){
              console.log("error al guardar estoma.");
          }
      );
            
    };

    function guardar_atencion_paciente() {

      if(vm.primer_diagnostico){
        var data = $.param({
            diagnostico: vm.diagnostico,
            atencion: vm.ultima_atencion,
            ostomias: vm.ostomias_diagnostico
        });
      }else{
          var data = $.param({
            diagnostico: vm.diagnostico,
            atencion: vm.atencion,
            ostomias: vm.ostomias_diagnostico
        });
      }

      $http.post('<?php echo base_url(); ?>pacientes/set_atencion_paciente/'+vm.paciente.id_paciente, data, config)
          .then(function(response){
              if(response.data !== 'false'){
                vm.atenciones = response.data;
                vm.registrar_atencion = false;
                vm.ultima_atencion = vm.atenciones[0]; 
               // vm.success("Se ha guardado el nuevo estoma.");

              }
          },
          function(response){
              console.log("error al guardar atencion.");
          }
      );
            
    };

    function guardar_valoracion_ostomia(ostomia) {

      var data = $.param({
          ostomia: ostomia,
      });

      $http.post('<?php echo base_url(); ?>pacientes/set_valoracion_ostomia/', data, config)
          .then(function(response){
              if(response.data !== 'false'){
                //console.log(response.data);
                ostomia.valoracion_ostomia = response.data;
                ostomia.mostrar_nuevo_sacs = false;
                //vm.success("Se ha guardado el nuevo estoma.");

              }
          },
          function(response){
              console.log("error al guardar valoracion ostomia.");
          }
      );
            
    };

    function guardar_diagnostico() {

          var data = $.param({
            diagnostico: vm.diagnostico
          });



      $http.post('<?php echo base_url(); ?>pacientes/set_diagnostico_paciente/'+vm.paciente.id_paciente, data, config)
          .then(function(response){
              if(response.data !== 'false'){
                //vm.success("<strong>Guardado!</strong> se ha grabado el diagnostico del paciente.");
                vm.diagnostico = response.data;
                if(vm.primer_diagnostico){
                  guardar_atencion_paciente();
                }
                //vm.activar_boton_estomas(); 
              }
          },
          function(response){
              console.log("error al guardar diagnostico.");
          }
      );
    };

    function guardar_herida() {

      var data = $.param({
        diagnostico: vm.diagnostico,
          herida: vm.herida
      });

      $http.post('<?php echo base_url(); ?>heridas/set_herida_paciente/'+vm.paciente.id_paciente, data, config)
          .then(function(response){
              if(response.data !== 'false'){
                //vm.success("<strong>Guardado!</strong> se ha grabado la herida del paciente."); 
              }
          },
          function(response){
              console.log("error al guardar herida.");
          }
      );
    };

    function modal_verificar_usuario(datos){
      vm.datos_verificar = datos;
      vm.error_verificacion_usuario = '';
      $('#modal_verificar_usuario').appendTo("body").modal('show');
    }

    function verificar_usuario(diagnostico) {

      var data = $.param({
          password: vm.password_verificar
      });

      $http.post('<?php echo base_url(); ?>usuarios/verificar_password/', data, config)
          .then(function(response){
              if(response.data !== 'false'){
                if(response.data == 1){
                  $('#modal_verificar_usuario').modal('hide');
                  if(vm.datos_verificar == 'diagnostico'){
                    guardar_diagnostico();
                    //guardar_ostomia_paciente();
                  }
                  if(vm.datos_verificar == 'ostomia'){
                    guardar_ostomia_paciente();
                  }
                  if(vm.datos_verificar == 'atencion'){
                    guardar_atencion_paciente();
                  }
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


    function visualizar_sacs(complicaciones){
      var existe_sacs = 0;
      for(var i=0; i< complicaciones.length; i++){
        if(complicaciones[i].evaluacion_sacs == 1){
                 vm.sacs_disabled = false;
                 existe_sacs= 1;
        }

      }
      if(existe_sacs == 0){
        vm.sacs_disabled = true;
      }
 
   
    }

    function cambiar_nombre_tab(estoma, tipo_ostomia){


      //Se debe buscar las complicaciones asociadas a la estomia
      var data = $.param({
            estoma: estoma
        });
      $http.post('<?php echo base_url(); ?>pacientes/get_complicaciones_tipo_estomia/', data, config)
        .then(function(response){
            if(response.data !== 'false'){
              estoma.complicaciones = [];
              vm.complicaciones = response.data;
              estoma.tipo_estoma = vm.complicaciones[0].categoria;
            }
        },
        function(response){
            console.log("error al obtener los cursos.");
        }
    );
    }

  function activar_tab(estoma){

    for(var i=0; i<vm.numero_estomas.length; i++ ){

      if(vm.numero_estomas[i].id == estoma.id){
        vm.numero_estomas[i].active = "active"
      }else{
        vm.numero_estomas[i].active= "";
      }
    }
  }
    
   function abrirModalEstomas() {
      vm.numero_estomas = [];
      var numero = $('#numero_estomas').val();

      for(var i=1; i<=numero; i++){
        if(i==1){
            var estoma = {"tipo_estoma" : "Estoma " +i,"id":"estoma_"+i, "active":"active"};
              }
              else{
                var estoma = {"tipo_estoma" : "Estoma " +i,"id":"estoma_"+i, "active":""};
              }

        vm.numero_estomas.push(estoma);
              }

 
      $('#modal_ingreso_estomias').appendTo("body").modal('show');
        
    }
  function abrirModalEncuesta(inicial) {
    if(inicial){
      $interval(vm.correrTiempo, 1000);
    }
    vm.fecha_hoy = <?php echo "'".date("Y-m-d",  strtotime(date('Y-m-d')))."'"; ?>;
    vm.hora_actual = <?php echo "'".date("H:i:s", strtotime(date('H:i:s')))."'";?>;
    vm.encuesta.fecha_inicio = vm.fecha_hoy;
    vm.encuesta.hora_inicio = vm.hora_actual;
    vm.serverdate_inicio = vm.serverdate;
    vm.encuesta.hora_inicio = vm.encuesta.hora_inicio;// ("0" + vm.serverdate_inicio.getHours('H')).slice(-2)+':'+ ("0" + vm.serverdate_inicio.getMinutes('M')).slice(-2)+':'+ ("0" + vm.serverdate_inicio.getSeconds('S')).slice(-2);
    vm.encuesta.tiempo_transcurrido = new Date();
    vm.encuesta.tiempo_transcurrido.setHours(0,0,0,0);
        
      $('#modal_nueva_encuesta').appendTo("body").modal('show');
        
    }

    function dibujar_estoma(){
      if(vm.ostomia_selected.ubicacion_estoma.coordenadas){
        var puntos = vm.ostomia_selected.ubicacion_estoma.coordenadas;
        // console.log(punto1);
        vm.context.clearRect(0, 0, vm.canvas.width, vm.canvas.height);
        vm.context.beginPath(); //iniciar ruta
        vm.context.globalAlpha=1; //Quitamos transparencia: valor 1
        vm.context.fillStyle="rgba(255,0,0,5)"; //color relleno 
        vm.context.strokeStyle="#ff9933"; //color contornocontexto.strokeStyle = '#ff9933';
        //vm.context.arc(100,100,20,0,2*Math.PI); //dibujar círculo
        vm.context.fillRect(puntos[0].x,puntos[0].y, puntos[1].x - puntos[0].x, puntos[2].y - puntos[0].y)
        vm.context.stroke(); //visualizar contorno
        vm.context.fill(); //visualizar relleno
      }
    }

    function dibujar_herida(){
      if(vm.herida.ubicacion){
        vm.context_cuerpo.clearRect(0, 0, vm.canvas_cuerpo.width, vm.canvas_cuerpo.height);
        vm.context_cuerpo.beginPath(); //iniciar ruta
        for(var i=0; i< vm.herida.ubicacion.length; i++){
          var puntos = vm.herida.ubicacion[i].coordenadas;
           //console.log(punto1);

          vm.context_cuerpo.globalAlpha=1; //Quitamos transparencia: valor 1
          vm.context_cuerpo.fillStyle="rgba(255,0,0,5)"; //color relleno 
          vm.context_cuerpo.strokeStyle="#ff9933"; //color contornocontexto.strokeStyle = '#ff9933';
          //vm.context.arc(100,100,20,0,2*Math.PI); //dibujar círculo
          vm.context_cuerpo.fillRect(puntos[0].x,puntos[0].y, puntos[1].x - puntos[0].x, puntos[2].y - puntos[0].y)
          vm.context_cuerpo.stroke(); //visualizar contorno
          vm.context_cuerpo.fill(); //visualizar relleno
        }
      }
    }

    function dibujar_drenaje(){
      if(vm.ostomia_selected.angulo_drenaje){
        var puntos = vm.ostomia_selected.angulo_drenaje;
        // console.log(punto1);
        var x = 0;
        var y = 0;
        if(vm.ostomia_selected.angulo_drenaje  == 1){
          x= 100;
          y = 100;
        }
        if(vm.ostomia_selected.angulo_drenaje  == 2){
          x= 140;
          y = 135;
        }
        if(vm.ostomia_selected.angulo_drenaje  == 3){
          x= 55;
          y = 130;
        }
        if(vm.ostomia_selected.angulo_drenaje  == 4){
          x = 60;
          y = 65;
        }
        if(vm.ostomia_selected.angulo_drenaje  == 5){
          x = 140;
          y = 65;
        }
        vm.context_drenaje.clearRect(0, 0, vm.canvas_drenaje.width, vm.canvas_drenaje.height);
        vm.context_drenaje.beginPath(); //iniciar ruta
        vm.context_drenaje.globalAlpha=1; //Quitamos transparencia: valor 1
        vm.context_drenaje.fillStyle="rgba(255,0,0,5)"; //color relleno 
        vm.context_drenaje.strokeStyle="#ff9933"; //color contornocontexto.strokeStyle = '#ff9933';
        vm.context_drenaje.arc(x,y,20,0,2*Math.PI); //dibujar círculo
       // vm.context.fillRect(puntos[0].x,puntos[0].y, puntos[1].x - puntos[0].x, puntos[2].y - puntos[0].y)
        vm.context_drenaje.stroke(); //visualizar contorno
        vm.context_drenaje.fill(); //visualizar relleno
      }
    }

    function dibujar_sacsl(ostomia){
      if(ostomia){
       // var puntos = vm.ostomia_selected.valoracion_ostomia.sacsl;
        // console.log(punto1);
        var x = 0;
        var y = 0;
        if(ostomia.valoracion_ostomia.sacsl  == 'l1'){
          x= 0;
          y = 0;
        }
        if(ostomia.valoracion_ostomia.sacsl  == 'l2'){
          x = 0;
          y = 63;
        }
        if(ostomia.valoracion_ostomia.sacsl  == 'l3'){
          x = 0;
          y = 140;
        }
        if(ostomia.valoracion_ostomia.sacsl  == 'l4'){
          x = 0;
          y = 220;
        }
        if(ostomia.valoracion_ostomia.sacsl  == 'lx'){
          x = 0;
          y = 296;
        }
        vm.context_sacsl.clearRect(0, 0, vm.canvas_sacsl.width, vm.canvas_sacsl.height);
        vm.context_sacsl.beginPath(); //iniciar ruta
        vm.context_sacsl.globalAlpha=1; //Quitamos transparencia: valor 1
        vm.context_sacsl.fillStyle="rgba(255,0,0,0.3)"; //color relleno 
        vm.context_sacsl.strokeStyle="#ff9933"; //color contornocontexto.strokeStyle = '#ff9933';
        //vm.context_drenaje.arc(x,y,20,0,2*Math.PI); //dibujar círculo
        vm.context_sacsl.fillRect(x,y, 250, 70)
        vm.context_sacsl.stroke(); //visualizar contorno
        vm.context_sacsl.fill(); //visualizar relleno
      }
    }
    function dibujar_sacst(ostomia){
      if(ostomia){
       // var puntos = vm.ostomia_selected.sacst;

        // console.log(punto1);
        var x = 0;
        var y = 0;
        if(ostomia.valoracion_ostomia.sacst  == 't1'){
          x= 144;
          y = 74;
        }
        if(ostomia.valoracion_ostomia.sacst  == 't2'){
          x = 145;
          y = 180;
        }
        if(ostomia.valoracion_ostomia.sacst == 't3'){
          x = 55;
          y = 177;
        }
        if(ostomia.valoracion_ostomia.sacst == 't4'){
          x = 50;
          y = 74;
        }
        if(ostomia.valoracion_ostomia.sacst  == 'tv'){
          x = 100;
          y = 120;
        }
        vm.context_sacst.clearRect(0, 0, vm.canvas_sacst.width, vm.canvas_sacst.height);
        vm.context_sacst.beginPath(); //iniciar ruta
        vm.context_sacst.globalAlpha=1; //Quitamos transparencia: valor 1
        vm.context_sacst.fillStyle="rgba(255,0,0,0.3)"; //color relleno 
        vm.context_sacst.strokeStyle="#ff9933"; //color contornocontexto.strokeStyle = '#ff9933';
        vm.context_sacst.arc(x,y,20,0,2*Math.PI); //dibujar círculo
      //  vm.context_sacsl.fillRect(x,y, 250, 70)
        vm.context_sacst.stroke(); //visualizar contorno
        vm.context_sacst.fill(); //visualizar relleno
      }
    }

    function crearLienzo() {
        vm.canvas.setAttribute('width', 300);
        vm.canvas.setAttribute('height', 300);
        vm.canvas.setAttribute('id', 'canvas');
        vm.canvasDiv.appendChild(vm.canvas);

        //canvas drenaje
        vm.canvas_drenaje.setAttribute('width', 200);
        vm.canvas_drenaje.setAttribute('height', 200);
        vm.canvas_drenaje.setAttribute('id', 'canvas');
        vm.canvasDivDrenaje.appendChild(vm.canvas_drenaje);


        //canvas sacsl
        vm.canvas_sacsl.setAttribute('width', 213);
        vm.canvas_sacsl.setAttribute('height', 361);
        vm.canvas_sacsl.setAttribute('id', 'canvas');
        vm.canvasDivSacsL.appendChild(vm.canvas_sacsl);


        //canvas sacst
        vm.canvas_sacst.setAttribute('width', 213);
        vm.canvas_sacst.setAttribute('height', 361);
        vm.canvas_sacst.setAttribute('id', 'canvas');
        vm.canvasDivSacsT.appendChild(vm.canvas_sacst);

        vm.canvas_cuerpo.setAttribute('width', 400);
        vm.canvas_cuerpo.setAttribute('height', 400);
        vm.canvas_cuerpo.setAttribute('id', 'canvas');
        vm.canvasDivCuerpo.appendChild(vm.canvas_cuerpo);

        if(typeof G_vmlCanvasManager != 'undefined') {
            vm.canvas = G_vmlCanvasManager.initElement(vm.canvas);
            vm.canvas_drenaje = G_vmlCanvasManager.initElement(vm.canvas_drenaje);
            vm.canvas_sacsl = G_vmlCanvasManager.initElement(vm.canvas_sacsl);
            vm.canvas_sacst = G_vmlCanvasManager.initElement(vm.canvas_sacst);
            vm.canvas_cuerpo = G_vmlCanvasManager.initElement(vm.canvas_cuerpo);
        }
        vm.context = vm.canvas.getContext("2d");
        vm.context_drenaje = vm.canvas_drenaje.getContext("2d");
        vm.context_sacsl = vm.canvas_sacsl.getContext("2d");
        vm.context_sacst = vm.canvas_sacst.getContext("2d");
        vm.context_cuerpo = vm.canvas_cuerpo.getContext("2d");

 /*  $('#canvas').mousedown(function(e){
      vm.pulsado = true;
      var parentOffset = $(this).offset(); 
      var relX = e.pageX - parentOffset.left;
      var relY = e.pageY - parentOffset.top;
      vm.movimientos.push([relX,
          relY,
          false]);
      repinta();
    });*/

 /*   $('#canvas').mousedown(function(e){
      vm.pulsado = true;
      var parentOffset = $(this).offset(); 
      var relX = e.pageX - parentOffset.left;
      var relY = e.pageY - parentOffset.top;
      var x1 = 0;
      var x2 = 0;
      var y1= 0;
      var y2= 0;
      var coordenadas_selected;

      for(var i = 0; i < vm.ubicaciones_estomas.length; i++){
        if(relX > vm.ubicaciones_estomas[i].coordenadas[0].x && relX < vm.ubicaciones_estomas[i].coordenadas[1].x && relY > vm.ubicaciones_estomas[i].coordenadas[0].y  && relY < vm.ubicaciones_estomas[i].coordenadas[3].y){
          vm.ostomia_selected.ubicacion_estoma = '{}';
          coordenadas_selected = vm.ubicaciones_estomas[i].coordenadas;
          vm.ostomia_selected.ubicacion_estoma = vm.ubicaciones_estomas[i]; 
           console.log(vm.ostomia_selected.ubicacion_estoma);
        }
     }

     vm.context.clearRect(0, 0, vm.canvas.width, vm.canvas.height);
     vm.context.beginPath(); //iniciar ruta
     vm.context.globalAlpha=1; //Quitamos transparencia: valor 1
     vm.context.fillStyle="rgba(255,0,0,5)"; //color relleno 
     vm.context.strokeStyle="#ff9933"; //color contornocontexto.strokeStyle = '#ff9933';
    //   //vm.context.arc(100,100,20,0,2*Math.PI); //dibujar círculo
     vm.context.fillRect(coordenadas_selected[0].x,coordenadas_selected[0].y, coordenadas_selected[1].x - coordenadas_selected[0].x, coordenadas_selected[2].y - coordenadas_selected[0].y);
     vm.context.stroke(); //visualizar contorno
     vm.context.fill(); //visualizar relleno
   });*/
 
    $('#canvas').mousemove(function(e){
      var parentOffset = $(this).offset(); 
      var relX = e.pageX - parentOffset.left;
      var relY = e.pageY - parentOffset.top;
     // console.log(relX +":"+relY);
      //repinta(relX,relY);
      if(relX > 285 && relX < 309 && relY > 287 && relY < 371){
        console.log('gemelo derecho');
        vm.movimientos.push([285,287, true]);
        vm.movimientos.push([309,287, true]);
        vm.movimientos.push([283,371, true]);
        vm.movimientos.push([293,279, true]);
        
      }

      //console.log(vm.movimientos);
      if(vm.pulsado){
       // console.log(relX +":"+relY);
          vm.movimientos.push([relX,
              relY,
              true]);
        repinta();
      }
    });
 
    $('#canvas').mouseup(function(e){
      vm.pulsado = false;
    });
 
    $('#canvas').mouseleave(function(e){
      vm.pulsado = false;
    });
    repinta();
    }
    function repinta(x, y){
     vm.context.clearRect(0, 0, vm.canvas.width, vm.canvas.height);
     // vm.canvas.width = vm.canvas.width; // Limpia el lienzo
      //vm.context.strokeStyle = "rgba(0,255,0,0.5)";
      //vm.context.fillStyle="rgba(0,255,0,0.5)";
      //vm.context.lineJoin = "round";
     // vm.context.lineWidth = 6;
      vm.context.beginPath(); //iniciar ruta
      vm.context.globalAlpha=1; //Quitamos transparencia: valor 1
      vm.context.fillStyle="rgba(0,255,0,0.5)"; //color relleno semitransparente
      vm.context.strokeStyle="rgb(255,0,255)"; //color contorno
      vm.context.arc(x,y,20,0,2*Math.PI); //dibujar círculo
      vm.context.stroke(); //visualizar contorno
      vm.context.fill(); //visualizar relleno
     
   /*   for(var i=vm.ultimo_pintado; i < vm.movimientos.length; i++)
      {     
        vm.context.beginPath();
        if(vm.movimientos[i][2] && i){
          vm.context.moveTo(vm.movimientos[i-1][0], vm.movimientos[i-1][1]);
         }else{
          vm.context.moveTo(vm.movimientos[i][0], vm.movimientos[i][1]);
         }
         vm.context.lineTo(vm.movimientos[i][0], vm.movimientos[i][1]);
         vm.context.closePath();
         vm.context.stroke();
      }*/
      vm.ultimo_pintado = vm.movimientos.length;
    }
    function upload() {
    $.post('/upload-imagen.php',
        {
        img : canvas.toDataURL()
        },
        function(data) { 
        // Cuando ha finalizado el envío, presenta en pantalla la imagen que ha
        // quedado almacenada en el servidor
        $('#imagen').attr('src', '/uploads/imagen.png?timestamp=' + new Date().getTime());
        });
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
function validate_fecha(fecha)
{
    var patron=new RegExp("^(19|20)+([0-9]{2})([-])([0-9]{1,2})([-])([0-9]{1,2})$");
 

    return true;
}
function isValidDate(day,month,year)
{
    var dteDate;
 
    // En javascript, el mes empieza en la posicion 0 y termina en la 11 
    //   siendo 0 el mes de enero
    // Por esta razon, tenemos que restar 1 al mes
    month=month-1;
    // Establecemos un objeto Data con los valore recibidos
    // Los parametros son: año, mes, dia, hora, minuto y segundos
    // getDate(); devuelve el dia como un entero entre 1 y 31
    // getDay(); devuelve un num del 0 al 6 indicando siel dia es lunes,
    //   martes, miercoles ...
    // getHours(); Devuelve la hora
    // getMinutes(); Devuelve los minutos
    // getMonth(); devuelve el mes como un numero de 0 a 11
    // getTime(); Devuelve el tiempo transcurrido en milisegundos desde el 1
    //   de enero de 1970 hasta el momento definido en el objeto date
    // setTime(); Establece una fecha pasandole en milisegundos el valor de esta.
    // getYear(); devuelve el año
    // getFullYear(); devuelve el año
    dteDate=new Date(year,month,day);
 
    //Devuelva true o false...
    return ((day==dteDate.getDate()) && (month==dteDate.getMonth()) && (year==dteDate.getFullYear()));
}
     
    }
})();

</script>
