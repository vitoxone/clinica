<?php $fecha_hoy = date("Y-m-d H:i:s", strtotime('-4 hour' , strtotime(date('Y-m-d H:i:s'))));

var_dump($fecha_hoy);?>

<div id="wrapper" ng-app="myApp">
 <div id="page-wrapper" ng-controller="EncuestaController as vm">
  <!-- Breadcrumb -->
        <div class="bread-crumb pull-left">
          <a href="index.html"><i class="icon-home"></i> Home</a> 
          <!-- Divider -->
          <span class="divider">/</span> 
          <a href="#" class="bread-current">Dashboard</a>
        </div>
    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12">              
          <div class="widget">
            <div class="widget-head">
              <div class="pull-left">Datos paciente</div>
              <div class="widget-icons pull-right">
                <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
              </div>  
              <div class="clearfix"></div>
            </div>
            <form class="form-horizontal" id="formulario" method="post" action="<?php echo base_url(); ?>pacientes/nuevo_paciente">
            <div class="widget-content">
              <div class="padd">
                <div class="form">                             
                  <div class="row">
                    <div class="col-md-4">                    
                      <div class="form-group">
                        <label class="col-lg-3">Tipo documento</label>
                        <div class="col-lg-8">
                          <div class="input-group">
                            <select  disabled class="form-control" id="tipo_documento_identificacion" name="tipo_documento_identificacion" title="Seleccione tipo documento">                                                              
                                <?php foreach ($tipos_documentos as $tipo_documento): ?>
                                    <option value="<?php echo base64_encode($this->encrypt->encode($tipo_documento->id_tipo_documento_identificacion)); ?>" <?php if($tipo_documento->id_tipo_documento_identificacion == $paciente->tipo_documento_identificacion){ echo "selected"; } ?>><?php echo $tipo_documento->nombre; ?></option>
                                <?php endforeach; ?>
                            </select>    
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">                    
                      <div class="form-group">
                        <label class="col-lg-3" for="content">Rut</label>
                        <div class="col-lg-9">
                          <div class="input-group">
                            <input  disabled id="rut" name="rut" class="form-control" value="<?php echo $paciente->rut; ?>"/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">                    
                      <div class="form-group">
                        <label class="col-lg-3" for="content">Programa contigo</label>
                        <div class="col-lg-2">                               
                            <div class="toggle-button">
                                <input disabled id="programa_contigo" name="programa_contigo" class="form-control" type="checkbox" value="<?php echo $paciente->contigo;?>" checked="checked">
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
                            <input disabled  id="nombres" name="nombres" class="form-control"  value="<?php echo $paciente->nombres;?>"/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-lg-3">Apellido Peterno</label>
                        <div class="col-lg-9">
                            <input  disabled id="apellidos_paterno" name="apellido_paterno" class="form-control"  value="<?php echo $paciente->apellido_paterno; ?>"/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">                      
                      <div class="form-group">
                        <label class="col-lg-3">Apellido Materno</label>
                        <div class="col-lg-9">
                            <input  disabled id="apellidos_materno" name="apellido_materno" class="form-control"  value="<?php echo $paciente->apellido_materno; ?>"/>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">                          
                      <div class="form-group">
                          <label class="col-lg-3">Fecha Nacimiento</label>
                          <div class="col-lg-9">
                              <div class="input-group">
                                  <input disabeld id="fecha_nacimiento" name="fecha_nacimiento"  class="form-control"  value="<?php echo $paciente->fecha_nacimiento; ?>"/>
                                  <span id="btn_fecha_nacimiento" class="input-group-addon btn btn-info btn-lg"><i class=" icon-calendar"></i></span>
                                  <input disabled id="edad" name="edad" class="form-control" />
                              </div>
                          </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-lg-3">Género</label>
                        <div class="col-lg-8">
                          <div class="input-group">
                            <select disabled class="form-control" id="genero" name="genero" title="Seleccione género">                                                              
                              <option value="" selected disabled> Seleccione género</option>
                              <option value="1" <?php if($paciente->genero == 1){ echo "selected"; }?>>Masculino</option>
                              <option value="2" <?php if($paciente->genero == 2){ echo "selected"; }?>>Femenino</option>
                            </select>    
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-lg-3">Isapre</label>
                        <div class="col-lg-8">
                          <div class="input-group">
                            <select disabled class="form-control" id="isapre" name="isapre" title="Seleccione isapre">                                                              
                              <option value="" selected disabled> Seleccione isapre</option>
                                <?php foreach ($isapres as $isapre): if($isapre->tramos){ ?>
                                    <option class="fonasa" value="<?php echo base64_encode($this->encrypt->encode($isapre->id_isapre)); ?>"><?php echo $isapre->isapre; ?></option>
                                    <?php }else { ?>
                                    <option value="<?php echo base64_encode($this->encrypt->encode($isapre->id_isapre)); ?>" <?php if($isapre->id_isapre == $paciente->isapre){ echo "selected"; }?> ><?php echo $isapre->isapre; ?></option>
                                <?php } endforeach; ?>
                            </select>    
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-lg-3">Dirección</label>
                        <div class="col-lg-9">
                          <input disabled id="direccion" name="direccion"  class="form-control" value="<?php echo $paciente->direccion_nombre; ?>"/>  
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-lg-3">Región</label>
                        <div class="col-lg-9">
                          <div class="input-group">
                            <select disabled class="form-control" id="region" name="region" title="Seleccione región">                                                              
                              <option value="" selected disabled> Seleccione región</option>
                                <?php foreach ($regiones as $region): ?>
                                    <option value="<?php echo base64_encode($this->encrypt->encode($region->id_region)); ?>" <?php if($region->id_region == $paciente->padre){ echo "selected"; }?> ><?php echo $region->region; ?></option>
                                <?php endforeach; ?>
                            </select>    
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-lg-3">Tramo</label>
                        <div class="col-lg-8">
                          <div class="input-group">
                            <select disabled class="form-control" id="letra_isapre" name="letra_isapre" title="Seleccione letra">                                                              
                              <option value="" selected disabled> Seleccione tramo</option>
                              <option value="a">A</option>
                              <option value="b">B</option>
                              <option value="c">C</option>
                              <option value="d">D</option>
                            </select>    
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>     
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-lg-3">Comuna</label>
                        <div class="col-lg-9">
                          <div class="input-group">
                            <select disabled class="form-control" id="comuna" name="comuna" title="Seleccione comuna">                                                              
                                <?php foreach ($comunas as $comuna): ?>
                                    <option value="<?php echo base64_encode($this->encrypt->encode($comuna->id)); ?>" <?php if($comuna->id == $paciente->id){ echo "selected"; }?> ><?php echo $comuna->comuna; ?></option>
                                <?php endforeach; ?>
                            </select>    
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">                      
                      <div class="form-group">
                        <label class="col-lg-3">Teléfono</label>
                        <div class="col-lg-8">
                          <div class="input-group">
                              <div class="input-group">
                                  <input disabled id="telefono" name="telefono"  class="form-control" value="<?php echo $paciente->telefono;?>"/>  
                              </div>
                          </div>
                        </div>
                      </div></div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-lg-3">Celular</label>
                        <div class="col-lg-8">
                          <div class="input-group">
                              <input disabled id="celular" name="celular"  class="form-control" value="<?php echo $paciente->celular;?>"/>  
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-lg-3">Email</label>
                        <div class="col-lg-9">
                              <input disabled id="email" name="email"  class="form-control" value="<?php echo $paciente->email;?>"/>  
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
       <input class="btn btn-success btn-lg" ng-model="button" id="btn_activar_estomas"  ng-disabled="vm.isDisabled" type="button" value="Llamar" ng-click="vm.abrirModalEncuesta()" />     
            <div class="widget">
                <div class="widget-head">

                  <div class="pull-left">Últimas encuestas realizadas al paciente</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="icon-remove"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>

                  <div class="widget-content">

                <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Contestado</th>
                      <th>Fecha Llamado</th>
                      <th>Hora</th>
                      <th>Realizado por</th>
                      <th>Observaciones</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="encuesta in vm.encuestas">
                        <td ng-if="encuesta.contesta == '1'"><span class="label label-success">Si</span> <td ng-if="encuesta.contesta == 0"> <span class="label label-danger">NO</span></td>
                        <td>{{encuesta.fecha}}</td>
                        <td>{{encuesta.hora_inicio}}</td>
                        <td>{{encuesta.profesional}}</td>
                        <td>{{encuesta.observaciones}}</td>
                        <td>
                          <button class="btn btn-xs btn-success"><i class="icon-ok"></i> </button>
                          <button class="btn btn-xs btn-warning"><i class="icon-pencil"></i> </button>
                          <button class="btn btn-xs btn-danger"><i class="icon-remove"></i> </button>
                        
                        </td>
                    </tr>
                  </tbody>
                </table>

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
                    <h2> Tiempo: {{vm.encuesta.transcurrido}}</h2>
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
                    <div class="col-md-6">                    
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
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                          <label class="col-lg-3">Fecha cirugía</label>
                          <div class="col-lg-9">
                              <div class="input-group">
                                <input type="text" class="form-control" uib-datepicker-popup ng-model="vm.encuesta.fecha_cirugia" is-open="vm.popup_fecha_cirugia.opened" ng-required="true" close-text="Close" />
                                  <span class="input-group-btn">
                                    <button  class="btn btn-default" ng-click="vm.fechaCirugia()"><i class="icon-calendar"></i></button>
                                  </span>
                              </div>
                          </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-lg-3">Ingreso programa</label>
                          <div class="col-lg-9">
                              <div class="input-group">
                                <input type="text" class="form-control" uib-datepicker-popup ng-model="vm.encuesta.ingreso_programa" is-open="vm.popup_fecha_ingreso.opened" ng-required="true" close-text="Close" />
                                  <span class="input-group-btn">
                                    <button  class="btn btn-default" ng-click="vm.fechaIngresoPrograma()"><i class="icon-calendar"></i></button>
                                  </span>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <label class="col-lg-3">Institución salud</label>
                        <div class="col-lg-9">
                           <multiselect ng-model="vm.encuesta.establecimiento" options="establecimiento.nombre for establecimiento in vm.establecimientos" data-multiple="false" filter-after-rows="5" min-width="100" tabindex="-1" scroll-after-rows="5"></multiselect>  
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
                                  <input type="text" class="form-control" uib-datepicker-popup  ng-model="vm.encuesta.proximo_llamado" is-open="vm.popup_fecha_nacimiento.opened" ng-required="true" close-text="Close" ng-change="vm.calcularEdad(vm.paciente.fecha_nacimiento)"/>
                                  <span  ng-click="vm.fechaNacimiento()" class="input-group-addon btn btn-info btn-lg"><i class="icon-calendar"></i></span>
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
                               <textarea ng-model="vm.encuesta.observaciones" class="form-control"/></textarea>
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
      <script src="<?php echo base_url(); ?>assets/js/bootstrap-select.js" type="text/javascript"></script>      
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/angular.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/angular-touch.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/angular-animate.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/ui-bootstrap-2.2.0.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/ui-bootstrap-tpls-2.2.0.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/angular-bootstrap-multiselect.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/angular-flash.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/jquery.prettyPhoto.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datetimepicker.js"></script>


<script>
(function(){
    'use strict';
    angular.module('myApp', ['ui.bootstrap', 'ui.multiselect', 'ngFlash', 'ngAnimate']);
    angular.module('myApp').controller('EncuestaController', EncuestaController);


    EncuestaController.$inject = ['$http', 'Flash', '$timeout', '$interval'];
    function EncuestaController($http, $flash, $timeout, $interval){
        var vm = this;
        vm.sistemas = JSON.parse('<?php echo $sistemas; ?>');
        vm.especialistas = JSON.parse('<?php echo $especialistas; ?>');
        vm.adjuvantes_antiguos = JSON.parse('<?php echo $adjuvantes_antiguos; ?>');
        vm.encuestas = JSON.parse('<?php echo $encuestas; ?>');
        vm.establecimientos = JSON.parse('<?php echo $establecimientos; ?>');
        vm.fecha_hoy = false;
        vm.hora_actual = false;
        vm.opened = false;
        vm.currenttime = '<?php echo date("Y-m-d H:i:s", strtotime('-4 hour' , strtotime(date('Y-m-d H:i:s'))))?>';
        vm.serverdate = new Date(vm.currenttime);
        
        vm.encuesta = {};
        vm.encuesta.hora_fin =  vm.serverdate.getHours()+':'+vm.serverdate.getMinutes()+':'+vm.serverdate.getSeconds();
        vm.encuesta.tiempo_transcurrido = new Date();
        vm.encuesta.tiempo_transcurrido.setHours(0,0,0,0);

        vm.abrirModalEncuesta      = abrirModalEncuesta;;
        vm.success                 =  success;
        vm.guardar_encuesta        = guardar_encuesta;
        vm.getCargoEspecialista    = getCargoEspecialista;
        vm.fechaInicio             = fechaInicio;
        vm.fechaCirugia            = fechaCirugia;
        vm.fechaIngresoPrograma    = fechaIngresoPrograma;
        vm.fechaProximoLlamado     = fechaProximoLlamado;
        vm.correrTiempo           = correrTiempo;


        vm.popup_fecha_inicio = {
          opened: false
        };
        vm.popup_fecha_cirugia = {
          opened: false
        };
        vm.popup_fecha_ingreso = {
          opened: false
        };
        vm.popup_proximo_llamado = {
          opened: false
        };

        vm.hstep = 1;
        vm.mstep = 1;

        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }

   $interval(vm.correrTiempo, 1000);

  vm.dateOptions = {
    formatYear: 'yy',
    maxDate: new Date(2020, 5, 22),
    minDate: new Date(),
    startingDay: 1
  };

  function fechaInicio() {
    vm.popup_fecha_inicio.opened = true;
  };

  function fechaCirugia() {
    vm.popup_fecha_cirugia.opened = true;
  };

  function fechaIngresoPrograma() {
    vm.popup_fecha_ingreso.opened = true;
  };

    function fechaProximoLlamado() {
    vm.popup_proximo_llamado.opened = true;
  };

   function correrTiempo(){
    vm.serverdate.setSeconds(vm.serverdate.getSeconds()+1);
    vm.encuesta.tiempo_transcurrido.setSeconds(vm.encuesta.tiempo_transcurrido.getSeconds()+1);
    vm.encuesta.hora_fin = ("0" + vm.serverdate.getHours('H')).slice(-2)+':'+ ("0" + vm.serverdate.getMinutes('M')).slice(-2)+':'+ ("0" + vm.serverdate.getSeconds('S')).slice(-2);
    vm.encuesta.transcurrido = ("0" + vm.encuesta.tiempo_transcurrido.getHours('H')).slice(-2)+':'+ ("0" + vm.encuesta.tiempo_transcurrido.getMinutes('M')).slice(-2)+':'+ ("0" + vm.encuesta.tiempo_transcurrido.getSeconds('S')).slice(-2);
  }


    function success(mensaje) {
        var id = $flash.create('success', mensaje, 0, {class: 'custom-class', id: 'custom-id'}, true);
  
    }    

    function guardar_encuesta(estado) {
      if(estado){
        vm.encuesta.contesta = 1;
      }
      else{
        vm.encuesta.contesta = 0;
      }

      var data = $.param({
          encuesta: vm.encuesta,
      });

      $http.post('<?php echo base_url(); ?>pacientes/guardar_encuesta_paciente/'+'<?php echo base64_encode($this->encrypt->encode($paciente->id_paciente)); ?>', data, config)
          .then(function(response){
              if(response.data !== 'false'){
                console.log(response.data);
                vm.encuestas = response.data;
                vm.success("Se ha guardado la encuesta correctamente.");
                $('#modal_nueva_encuesta').modal('hide').destroy()

              }
          },
          function(response){
              console.log("error al guardar la encuesta.");
          }
      );
            
    };

    function getCargoEspecialista(){
      $("#cargo").val(vm.encuesta.notifica.cargo);

    }
    
   function abrirModalEncuesta() {

    vm.fecha_hoy = <?php echo "'".date("Y-m-d", strtotime('-4 hour' , strtotime(date('Y-m-d'))))."'"; ?>;
    vm.hora_actual = <?php echo "'".date("H:i:s", strtotime('-4 hour' , strtotime(date('H:i:s'))))."'";?>;
    vm.encuesta.fecha_inicio = vm.fecha_hoy;
    vm.encuesta.hora_inicio = vm.hora_actual;

    vm.serverdate_inicio = vm.serverdate;
    vm.encuesta.hora_inicio =  ("0" + vm.serverdate_inicio.getHours('H')).slice(-2)+':'+ ("0" + vm.serverdate_inicio.getMinutes('M')).slice(-2)+':'+ ("0" + vm.serverdate_inicio.getSeconds('S')).slice(-2);
    vm.encuesta.tiempo_transcurrido = new Date();
    vm.encuesta.tiempo_transcurrido.setHours(0,0,0,0);
    
    console.log(vm.hora_actual);
      $('#modal_nueva_encuesta').appendTo("body").modal('show');
        
    }
}
})();

</script>

      
       
