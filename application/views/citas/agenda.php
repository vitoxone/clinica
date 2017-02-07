<div id="wrapper" ng-app="myApp">
  <div id="page-wrapper" ng-controller="AgendaController as vm">
     <div class="page-head">
        <h2 class="pull-left"><i class="icon-file-alt"></i> Agenda</h2>
        <div class="bread-crumb pull-right">
          <a href="index.html"><i class="icon-home"></i> Home</a> 
          <span class="divider">/</span> 
          <a href="#" class="bread-current">Agenda</a>
        </div>
        <div class="clearfix"></div>
   </div>
  <h2 class="text-center">{{ vm.titulo_calendario }}</h2>
<div class="container">
  <div class="row"> 
    <br><br><br> 
    <div class="col-md-2">
        <button class="btn btn-primary ng-isolate-scope" ng-click="vm.abrirModalCita()">
              Nueva cita
            </button>
    </div>
    <div class="col-md-9">
      <div class="row">

        <div class="col-md-6 text-center">
          <div class="btn-group">

            <button
              class="btn btn-primary"
              mwl-date-modifier
              date="vm.viewDate"
              decrement="vm.calendarView"
              ng-click="vm.cellIsOpen = false">
              Anterior
            </button>
            <button
              class="btn btn-default"
              mwl-date-modifier
              date="vm.viewDate"
              set-to-today
              ng-click="vm.cellIsOpen = false">
              Hoy
            </button>
            <button
              class="btn btn-primary"
              mwl-date-modifier
              date="vm.viewDate"
              increment="vm.calendarView"
              ng-click="vm.cellIsOpen = false">
              Siguiente
            </button>
          </div>
        </div>

        <br class="visible-xs visible-sm">

        <div class="col-md-6 text-center">
          <div class="btn-group">
            <label class="btn btn-primary" ng-model="vm.calendarView" uib-btn-radio="'year'" ng-click="vm.cellIsOpen = false">Año</label>
            <label class="btn btn-primary" ng-model="vm.calendarView" uib-btn-radio="'month'" ng-click="vm.cellIsOpen = false">Mes</label>
            <label class="btn btn-primary" ng-model="vm.calendarView" uib-btn-radio="'week'" ng-click="vm.cellIsOpen = false">Semana</label>
            <label class="btn btn-primary" ng-model="vm.calendarView" uib-btn-radio="'day'" ng-click="vm.cellIsOpen = false">Día</label>
          </div>
        </div>
      </div>
    </div>
    <div class="row">

      <div class="col-md-9">
        <mwl-calendar
          events="vm.events"
          view="vm.calendarView"
          view-title="vm.titulo_calendario"
          view-date="vm.viewDate"
          on-event-click="vm.eventClicked(calendarEvent)"
          on-event-times-changed="vm.eventTimesChanged(calendarEvent); calendarEvent.startsAt = calendarNewEventStart; calendarEvent.endsAt = calendarNewEventEnd"
          cell-is-open="vm.cellIsOpen"
          day-view-start="09:00"
          day-view-end="19:59"
          day-view-split="15"
          cell-modifier="vm.modifyCell(calendarCell)"
          cell-auto-open-disabled="true"
          on-timespan-click="vm.timespanClicked(calendarDate, calendarCell)">
        </mwl-calendar>
        </div>
              <br>
        <div class="col-md-3">
        <br>
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Enfermeras</div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
          <table class="table table-striped table-hover">
           <tbody>
              <tr ng-show="vm.enfermeras">
              <th><center><span class="uni"><input value="check1" type="checkbox" checked></span> </center></th>
              <th>Todos</th>
              <th></th>
            </tr>
              <tr ng-repeat="enfermera in vm.enfermeras">
              <th><center><span class="uni"><input value="check1" type="checkbox" checked></span> </center></th>
              <th>{{enfermera.nombres}}</th>
              <th><span class="label label-danger pull-right" style="{{enfermera.color}}"> </span></th>
            </tr>                                             
            </tbody>
          </table>
               <!-- 227,188,8
                30,144,255
                173,33,33-->
            <div class="widget-foot">
            </div>
          </div>
        </div>
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Tipo atención</div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
          <table class="table table-striped table-hover">
               <tbody>
                 <tr>
                  <th><center><span class="uni"><input value="check1" type="checkbox" checked></span> </center></th>
                  <th>Todos</th>
                </tr>
                <tr>
                  <th><center><span class="uni"><input value="check1" type="checkbox" checked></span> </center></th>
                  <th>Clínica</th>
                </tr>
                  <tr>
                  <th><center><span class="uni"><input value="check1" type="checkbox" checked></span> </center></th>
                  <th>Domicilio</th>
                </tr>                                              
                </tbody>
                </table>
            <div class="widget-foot">
            </div>
          </div>
        </div>
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Estado</div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
          <table class="table table-striped table-hover">
               <tbody>
                 <tr>
                  <th><center><span class="uni"><input value="check1" type="checkbox" checked></span> </center></th>
                  <th>Todos</th>
                </tr>
                <tr>
                  <th><center><span class="uni"><input value="check1" type="checkbox" checked></span> </center></th>
                  <th>Confirmadas</th>
                </tr>
                  <tr>
                  <th><center><span class="uni"><input value="check1" type="checkbox" checked></span> </center></th>
                  <th>Sin confirmar</th>
                </tr>
                 <tr>
                  <th><center><span class="uni"><input value="check1" type="checkbox"></span> </center></th>
                  <th>Canceladas</th>
                </tr> 
                <tr>
                  <th><center><span class="uni"><input value="check1" type="checkbox" ></span> </center></th>
                  <th>Terminadas</th>
                </tr>                                                
                </tbody>
                </table>
            <div class="widget-foot">
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
</div>
  <br><br><br>
  <div ng-show=false>
    <h3 id="event-editor">
      Editar cita
      <button
        class="btn btn-primary pull-right"
        ng-click="vm.addEvent()">
        Nueva cita
      </button>
      <div class="clearfix"></div>
    </h3>

      <table class="table table-bordered">

        <thead>
          <tr>
            <th>Title</th>
            <th>Primary color</th>
            <th>Secondary color</th>
            <th>Starts at</th>
            <th>Ends at</th>
            <th>Remove</th>
          </tr>
        </thead>

        <tbody>
          <tr ng-repeat="event in vm.events track by $index">
            <td>
              <input
                type="text"
                class="form-control"
                ng-model="event.title">
            </td>
            <td>
              <input class="form-control" colorpicker type="text" ng-model="event.color.primary">
            </td>
            <td>
              <input class="form-control" colorpicker type="text" ng-model="event.color.secondary">
            </td>
            <td>
              <p class="input-group" style="max-width: 250px">
                <input
                  type="text"
                  class="form-control"
                  readonly
                  uib-datepicker-popup="dd MMMM yyyy"
                  ng-model="event.startsAt"
                  is-open="event.startOpen"
                  close-text="Close" >
                <span class="input-group-btn">
                  <button
                    type="button"
                    class="btn btn-default"
                    ng-click="vm.toggle($event, 'startOpen', event)">
                    <i class="glyphicon glyphicon-calendar"></i>
                  </button>
                </span>
              </p>
              <div
                uib-timepicker
                ng-model="event.startsAt"
                hour-step="1"
                minute-step="15"
                show-meridian="true">
              </div>
            </td>
            <td>
              <p class="input-group" style="max-width: 250px">
                <input
                  type="text"
                  class="form-control"
                  readonly
                  uib-datepicker-popup="dd MMMM yyyy"
                  ng-model="event.endsAt"
                  is-open="event.endOpen"
                  close-text="Close">
                <span class="input-group-btn">
                  <button
                    type="button"
                    class="btn btn-default"
                    ng-click="vm.toggle($event, 'endOpen', event)">
                    <i class="glyphicon glyphicon-calendar"></i>
                  </button>
                </span>
              </p>
              <div
                uib-timepicker
                ng-model="event.endsAt"
                hour-step="1"
                minute-step="15"
                show-meridian="true">
              </div>
            </td>
            <td>
              <button
                class="btn btn-danger"
                ng-click="vm.events.splice($index, 1)">
                Delete
              </button>
            </td>
          </tr>
        </tbody>

      </table>
    </div>
  <!-- modal programar cita -->
    <div id="modal-nueva-cita" class="modal fade" tabindex='9000'>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header-convatec convatec-bgcolor-1">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                Nueva cita
            </div>         
          <div class="modal-body">                            
            <form class="form-horizontal" name="userForm" novalidate>
              <div class="col-md-12">  
                <div class="row">                    
                  <div class="form-group" ng-class="{ 'has-error': userForm.paciente.$touched && userForm.paciente.$invalid }">
                    <label class="control-label col-lg-4" >Paciente</label>
                    <div class="col-lg-4">
                      <multiselect ng-model="vm.nueva_cita.paciente" name="paciente" options="paciente.nombre+' ('+paciente.rut+') ' for paciente in vm.pacientes" data-multiple="false" filter-after-rows="5" min-width="300" tabindex="-1" scroll-after-rows="5" required></multiselect> 
                    </div>
                    <div class="col-lg-4">
                      <div class="help-block" ng-messages="userForm.paciente.$error" ng-if="userForm.paciente.$touched">
                        <p ng-message="required" style="color:red;">Campo requerido</p>
                      </div> 
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">  
                <div class="row"> 
                  <div class="form-group"  ng-class="{ 'has-error': userForm.tipo_atencion.$touched && userForm.tipo_atencion.$invalid }">
                    <label class="control-label col-lg-4" for="title">Tipo atención</label>
                    <div class="col-lg-4">
                        <multiselect ng-model="vm.nueva_cita.tipo_atencion" name="tipo_atencion" options="tipo_atencion.nombre for tipo_atencion in vm.tipos_atenciones" data-multiple="false" filter-after-rows="5" min-width="300" tabindex="-1" scroll-after-rows="5"></multiselect>
                    </div>
                    <div class="col-lg-4">
                      <div class="help-block" ng-messages="userForm.tipo_atencion.$error" ng-if="userForm.tipo_atencion.$touched">
                        <p ng-message="required" style="color:red;">Campo requerido</p>
                      </div> 
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">  
                <div class="row"> 
                  <div class="form-group" ng-class="{ 'has-error': userForm.enfermera.$touched && userForm.enfermera.$invalid }">
                    <label class="control-label col-lg-6" for="content">Enfermera</label>
                    <div class="col-lg-4">
                      <div class="input-group">
                        <multiselect ng-model="vm.nueva_cita.enfermera" name="enfermera" options="enfermera.nombres for enfermera in vm.enfermeras" data-multiple="false" filter-after-rows="5" min-width="300" tabindex="-1" scroll-after-rows="5"></multiselect>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="help-block" ng-messages="userForm.enfermera.$error" ng-if="userForm.enfermera.$touched">
                        <p ng-message="required" style="color:red;">Campo requerido</p>
                      </div> 
                    </div>
                  </div>                           
                <div class="form-group">
                    <label class="control-label col-lg-6">Fecha cita</label>
                    <div class="col-lg-6">
                      <div class="input-group"> 
                        <input type="text" class="form-control" uib-datepicker-popup  ng-model="vm.nueva_cita.fecha_cita" is-open="vm.popup_fecha_cita.opened" ng-required="true" close-text="Close"/>
                        <span  ng-click="vm.fechaCita()" class="input-group-addon btn btn-info btn-lg"><i class="icon-calendar"></i></span>
                      </div>
                    </div>
                </div>

              <hr />
              <div class="row">
                <div class="col-md-6 text-center">
                  <p class="form-group">
                  <label class="control-label" for="tags">Hora inicio</label>
                    <div class="input-group">
                       <div uib-timepicker ng-model="vm.nueva_cita.hora_inicio_cita" hour-step="vm.hstep" minute-step="vm.mstep" show-meridian="vm.ismeridian"></div>
                    </div>
                  </p>
                </div>

                <div class="col-md-6 text-center">
                  <p class="input-group">
                    <label class="control-label" for="tags">Hora fin</label>
                      <div class="input-group">
                         <div uib-timepicker ng-model="vm.nueva_cita.hora_fin_cita"  hour-step="vm.hstep" minute-step="vm.mstep" show-meridian="vm.ismeridian"></div>
                      </div>
                  </p>
                </div>
              </div>
              <hr />
            </form>
            <br/>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cerrar</button>
              <button type="button" class="btn btn-primary" ng-click="vm.validar_formulario(userForm)">Guardar</button>
            </div>
          </div>
        </div>
      </div>
    </div><!-- fin modal programar cita -->
      <!-- modal editar cita -->
    <div id="modal-editar-cita" class="modal fade" tabindex='9000'>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header-convatec convatec-bgcolor-1">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                Editar cita
            </div>         
          <div class="modal-body">                            
            <form class="form-horizontal" name="userForm" novalidate>
              <div class="col-md-12">  
                <div class="row">                    
                  <div class="form-group">
                    <label class="control-label col-lg-4" >Paciente</label>
                    <div class="col-lg-4">
                      <multiselect ng-model="vm.nueva_cita.paciente" name="paciente" options="paciente.nombre+' ('+paciente.rut+') ' for paciente in vm.pacientes" data-multiple="false" filter-after-rows="5" min-width="300" tabindex="-1" scroll-after-rows="5" required></multiselect> 
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">  
                <div class="row"> 
                  <div class="form-group">
                    <label class="control-label col-lg-4" for="title">Tipo atención</label>
                    <div class="col-lg-4">
                        <multiselect ng-model="vm.nueva_cita.tipo_atencion" name="tipo_atencion" options="tipo_atencion.nombre for tipo_atencion in vm.tipos_atenciones" data-multiple="false" filter-after-rows="5" min-width="300" tabindex="-1" scroll-after-rows="5"></multiselect>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">  
                <div class="row"> 
                  <div class="form-group">
                    <label class="control-label col-lg-6" for="content">Enfermera</label>
                    <div class="col-lg-4">
                      <div class="input-group">
                        <multiselect ng-model="vm.nueva_cita.enfermera" name="enfermera" options="enfermera.nombres for enfermera in vm.enfermeras" data-multiple="false" filter-after-rows="5" min-width="300" tabindex="-1" scroll-after-rows="5"></multiselect>
                      </div>
                    </div>
                  </div>                           
                <div class="form-group">
                    <label class="control-label col-lg-6">Fecha cita</label>
                    <div class="col-lg-6">
                      <div class="input-group"> 
                        <input type="text" class="form-control" uib-datepicker-popup  ng-model="vm.nueva_cita.fecha_cita" is-open="vm.popup_fecha_cita.opened" ng-required="true" close-text="Close"/>
                        <span  ng-click="vm.fechaCita()" class="input-group-addon btn btn-info btn-lg"><i class="icon-calendar"></i></span>
                      </div>
                    </div>
                </div>

              <hr />
              <div class="row">
                <div class="col-md-6 text-center">
                  <p class="form-group">
                  <label class="control-label" for="tags">Hora inicio</label>
                    <div class="input-group">
                       <div uib-timepicker ng-model="vm.nueva_cita.hora_inicio_cita" hour-step="vm.hstep" minute-step="vm.mstep" show-meridian="vm.ismeridian"></div>
                    </div>
                    {{vm.nueva_cita.hora_inicio_cita}}
                  </p>
                </div>

                <div class="col-md-6 text-center">
                  <p class="input-group">
                    <label class="control-label" for="tags">Hora fin</label>
                      <div class="input-group">
                         <div uib-timepicker ng-model="vm.nueva_cita.hora_fin_cita"  hour-step="vm.hstep" minute-step="vm.mstep" show-meridian="vm.ismeridian"></div>
                      </div>
                      {{vm.nueva_cita.hora_fin_cita}}
                  </p>
                </div>
              </div>
              <hr />
            </form>
            <br/>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cerrar</button>
              <button type="button" class="btn btn-primary" ng-click="vm.actualizarCita()">Guardar</button>
            </div>
          </div>
        </div>
      </div>
    </div><!-- fin modal programar cita -->
  </div>
</div>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/moment.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/interact.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/angular.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-select.js" type="text/javascript"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/angular_calendar/bootstrap-colorpicker-module.min.js"></script>      
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/angular_calendar/angular-bootstrap-calendar.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/angular-touch.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/angular-animate.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/ui-bootstrap-2.2.0.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/ui-bootstrap-tpls-2.2.0.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/angular-bootstrap-multiselect.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/angular-locale_es-cl.js"></script>

      

      <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.0/angular-messages.js"></script>

    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/colorpicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/plugins/angular_calendar/angular-bootstrap-calendar.css" rel="stylesheet">

<script>
(function(){
    'use strict'
    angular.module('myApp', ['mwl.calendar', 'ngAnimate', 'ui.bootstrap', 'colorpicker.module','ui.multiselect', 'ngMessages']);
    angular.module('myApp').controller('AgendaController',AgendaController);

    AgendaController.$inject = ['$http', '$timeout', '$location', '$window', '$interval'];
    function AgendaController($http, $location, $window, $timeout, $interval){

        var vm = this;

        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }

    vm.calendarView = 'month';
    vm.viewDate = new Date();
    vm.nueva_cita = {};
    vm.enfermeras = JSON.parse('<?php echo $enfermeras; ?>');
    vm.tipos_atenciones = JSON.parse('<?php echo $tipos_atenciones; ?>');
    vm.pacientes = JSON.parse('<?php echo $pacientes; ?>');;


    vm.fechaCita = fechaCita;
    vm.guardarNuevaCita = guardarNuevaCita;
    vm.actualizarCita = actualizarCita;
    vm.validar_formulario = validar_formulario;

    vm.hstep = 1;
    vm.mstep = 15;
    vm.ismeridian = false;
    vm.popup_fecha_cita = {
        opened: false
    };

    moment.locale('es_cl', {
      week : {
        dow : 1, // Monday is the first day of the week
      }
    });

    var actions = [{
      label: '<i class=\'glyphicon glyphicon-pencil\'></i>',
      onClick: function(args) {
        show('Edited', args.calendarEvent);
      }
    }, {
      label: '<i class=\'glyphicon glyphicon-remove\'></i>',
      onClick: function(args) {
        show('Deleted', args.calendarEvent);
      }
    }];
   // calendarConfig.showTimesOnWeekView = true;
    vm.events = JSON.parse('<?php echo $citas; ?>');
       for (var i = 0; i < vm.events.length; i++) {
           vm.events[i].startsAt = new Date(vm.events[i].startsAt);
           vm.events[i].endsAt = new Date(vm.events[i].endsAt);
           vm.events[i].draggable = true;
        }
    console.log(vm.events);

    vm.cellIsOpen = true;

    function fechaCita() {
      vm.popup_fecha_cita.opened = true;
    };

    function validar_formulario(userForm){
      var error =false;

      if(userForm.paciente.$dirty == false){
          userForm.paciente.$touched = true;
          userForm.paciente.$error.required = true;
        error = true;
      }
      if(userForm.tipo_atencion.$dirty == false){
          userForm.tipo_atencion.$touched = true;
          userForm.tipo_atencion.$error.required = true;
        error = true;
      }
      if(userForm.enfermera.$dirty == false){
          userForm.enfermera.$touched = true;
          userForm.enfermera.$error.required = true;
        error = true;
      }

      if(!error){
        guardarNuevaCita();
      }

    }

    function guardarNuevaCita(){

          var data = $.param({
          cita: vm.nueva_cita,
      });

      $http.post('<?php echo base_url(); ?>agenda/set_nueva_cita', data, config)
          .then(function(response){
              if(response.data !== 'false'){
                console.log(response.data);
                if(response.data){
                  vm.events = response.data;
                  for (var i = 0; i < vm.events.length; i++) {
                    vm.events[i].startsAt = new Date(vm.events[i].startsAt);
                    vm.events[i].endsAt = new Date(vm.events[i].endsAt);
                  }
                }
              }
          },
          function(response){
              console.log("error al guardar la cita.");
          }
      );
          $('#modal-nueva-cita').modal('hide');
     }

    function actualizarCita(){

          var data = $.param({
          cita: vm.nueva_cita,
      });

      $http.post('<?php echo base_url(); ?>agenda/actualizar_cita', data, config)
          .then(function(response){
              if(response.data !== 'false'){
                console.log(response.data);
                if(response.data){
                  vm.events = response.data;
                  for (var i = 0; i < vm.events.length; i++) {
                    vm.events[i].startsAt = new Date(vm.events[i].startsAt);
                    vm.events[i].endsAt = new Date(vm.events[i].endsAt);
                  }
                }
              }
          },
          function(response){
              console.log("error al actualizar la cita.");
          }
      );
          $('#modal-editar-cita').modal('hide');
     }

   /* vm.addEvent = function() {
      vm.events.push({
        title: 'New event',
        startsAt: moment().startOf('day').toDate(),
        endsAt: moment().endOf('day').toDate(),
        color: calendarConfig.colorTypes.important,
        draggable: true,
        resizable: true
      });
    };*/

    function show(action, event) {

          var data = $.param({
          id_cita: event
      });
       $http.post('<?php echo base_url(); ?>agenda/get_cita', data, config)
        .then(function(response){
            if(response.data !== 'false'){
              console.log(response.data);
                vm.nueva_cita = response.data;

                $('#modal-editar-cita').appendTo("body").modal('show');
                vm.nueva_cita.id_cita = response.data.id_cita;
                vm.nueva_cita.fecha_cita = new Date(response.data.fecha_inicio);
               // var fecha_inicio = new Date(response.data.fecha_inicio);
                vm.nueva_cita.hora_inicio_cita = moment(response.data.fecha_inicio);//moment(response.data.fecha_inicio).format('HH:mm');
                vm.nueva_cita.hora_fin_cita = moment(response.data.fecha_fin);//moment(response.data.fecha_fin).format('HH:mm');
            }
        },
        function(response){
            console.log("error al obtener comunas.");
        }
      );
    }

    vm.eventClicked = function(event) {
      show('Clicked', event);
    };

    vm.eventEdited = function(event) {
      alert.show('Edited', event);
    };

    vm.eventDeleted = function(event) {
      alert.show('Deleted', event);
    };

    vm.eventTimesChanged = function(event) {
      setTimeout(function(){

            vm.nueva_cita.fecha_cita = new Date(event.startsAt);
      vm.nueva_cita.hora_inicio_cita = new Date(event.startsAt);
      vm.nueva_cita.hora_fin_cita = new Date(event.endsAt);
      $('#modal-nueva-cita').appendTo("body").modal('show');
    }, 1000);

    };

    vm.toggle = function($event, field, event) {
      $event.preventDefault();
      $event.stopPropagation();
      event[field] = !event[field];
    };

    vm.abrirModalCita = function (date){

      $('#modal-nueva-cita').appendTo("body").modal('show');
      vm.nueva_cita.fecha_cita = new Date(date.format('YYYY-MM-DD'));
      vm.nueva_cita.hora_inicio_cita = new Date(date);
      var new_date = date.clone();
      vm.nueva_cita.hora_fin_cita = new Date(date.add(45, 'm'));
        
     }


    vm.timespanClicked = function(date, cell) {
      if (vm.calendarView === 'month') {
        if ((vm.cellIsOpen && moment(date).startOf('day').isSame(moment(vm.viewDate).startOf('day'))) || cell.events.length === 0 || !cell.inMonth) {
          vm.cellIsOpen = false;
        } else {
          vm.cellIsOpen = true;
          vm.viewDate = date;
        }
      }else if (vm.calendarView === 'year') {
        if ((vm.cellIsOpen && moment(date).startOf('month').isSame(moment(vm.viewDate).startOf('month'))) || cell.events.length === 0) {
          vm.cellIsOpen = false;
        } else {
          vm.cellIsOpen = true;
          vm.viewDate = date;
        }
      }
      else if (vm.calendarView === 'week' || vm.calendarView === 'day') {
       console.log(date);

        vm.abrirModalCita(date);
        
      }
    };

    }
})();

</script> 
