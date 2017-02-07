  <!-- Breadcrumb -->
        <div class="bread-crumb pull-left">
          <a href="index.html"><i class="icon-home"></i> Home</a> 
          <!-- Divider -->
          <span class="divider">/</span> 
          <a href="#" class="bread-current">Dashboard</a>
        </div>
    <div class="clearfix"></div>
      <div class="row">
            <div class="col-md-6">              
              <div class="widget">
                <div class="widget-head">
                  <div class="pull-left">Datos Generales</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">
                    <div class="form quick-post">
                                      <!-- Edit profile form (not working)-->
                                      <form class="form-horizontal">
                                          <!-- Title -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-3" for="title">Especialidad</label>
                                            <div class="col-lg-9">
                                              <div class="input-group"> 
                                                <select id="especialidad" name="especialidad" required="required" class="selectpicker" data-live-search="true" title="- Seleccione especialidad -">
                                                    <?php
                                                      foreach($especialidades as $especialidad) {
                                                      ?>
                                                      <option value="<?php echo base64_encode($this->encrypt->encode($especialidad->id_especialidad)); ?>"><?php echo $especialidad->especialidad; ?></option>
                                                    <?php
                                                          }
                                                      ?>
                                                </select> 
                                                </div>
                                            </div>
                                          </div>   
                                          <!-- Content -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-3" for="content">Médico</label>
                                            <div class="col-lg-9">
                                              <div class="input-group">
                                                  <select id="profesional" name="profesional" class="selectpicker" data-live-search="true" title="- Seleccione médico -">
                                                  </select>
                                              </div>
                                            </div>
                                          </div>                           
                                          <!-- Cateogry -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-3">Fecha</label>
                                            <div class="col-lg-9">
                                                <div class="input-group">
                                                    <input id="fecha_cita" name="fecha_cita"  class="form-control"/>
                                                    <span id="btn_fecha_cita" class="input-group-addon btn btn-info btn-lg"><i class=" icon-calendar"></i></span>
                                                </div>
                                               
                                            </div>
                                          </div>              
                                          <!-- Tags -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-3" for="tags">Horario</label>
                                            <div class="col-lg-9">
                                                <div class="input-group">
                                                  <select id="horario" name="horario" class="selectpicker" title="- Seleccione horario -">
                                                      <option value="08:00">08:00</option>
                                                      <option value="08:00">09:00</option>
                                                      <option value="08:00">10:00</option>
                                                      <option value="08:00">11:00</option>
                                                      <option value="08:00">12:00</option>
                                                      <option value="08:00">13:00</option>
                                                      <option value="08:00">14:00</option>
                                                      <option value="08:00">15:00</option>
                                                      <option value="08:00">16:00</option>
                                                      <option value="08:00">17:00</option>
                                                      <option value="08:00">18:00</option>
                                                      <option value="08:00">19:00</option>
                                                  </select>
                                              </div>
                                            </div>
                                          </div>
                                      </form>
                                    </div>
                  </div>
  
                </div>
              </div>  
            </div>

            <div class="col-md-6">              
              <div class="widget">
                <div class="widget-head">
                  <div class="pull-left">Datos paciente</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">
                    <div class="form quick-post">
                                      <!-- Edit profile form (not working)-->
                                      <form class="form-horizontal">
                                          <!-- Title -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-3" for="title">Paciente</label>
                                            <div class="col-lg-9">
                                              <div class="input-group">
                                                <select id="rut" name="rut" required="required" class="selectpicker form-control" data-live-search="true" title="- Ingrese rut -">
                                                    <?php
                                                      foreach($pacientes as $paciente) {
                                                      ?>
                                                      <option value="<?php echo $paciente->id_paciente; ?>"><?php echo $paciente->rut; ?></option>
                                                    <?php
                                                          }
                                                      ?>
                                                </select>
                                                <span id="btn_nuevo_paciente" class="input-group-addon btn-success"><i class="glyphicon glyphicon-plus"></i> Crear</span> 
                                                </div>
                                            </div>
                                          </div>   
                                         <div class="form-group">
                                            <label class="control-label col-lg-3" for="content">Nombres</label>
                                            <div class="col-lg-9">
                                              <div class="input-group">
                                                  <input disabled id="nombres_paciente" name="nombres_paciente" class="form-control">
                                                  </input>
                                              </div>
                                            </div>
                                          </div>                           
                                          <div class="form-group">
                                            <label class="control-label col-lg-3">Apellidos</label>
                                            <div class="col-lg-9">
                                              <div class="input-group">
                                                  <input disabled id="apellidos_paciente" name="apellidos_paciente" class="form-control" >
                                                  </input>
                                              </div>
                                               
                                            </div>
                                          </div>    
                                      </form>
                                    </div>
                            </div>
  
                        </div>
                      </div>  
                  </div><!--fin col-6 -->
           <div class="row">                                          
            <div class="form-group">                                             
                <div class="col-lg-offset-2 col-lg-9 pull-rigth">
                  <button type="submit" class="btn btn-success">Guardar</button>
                  <button type="submit" class="btn btn-danger">Cancelar</button>
                  <button type="reset" class="btn btn-default">Resetear</button>
                </div>
            </div>
        </div>



      <div id="modal_nuevo_paciente" class="modal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Modal title</h4>
              </div>
              <div class="modal-body">
                <p>One fine body…</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
      </div>


<script type="text/javascript">

    $('#fecha_cita').datetimepicker({
        locale: 'es',
        useCurrent: false,
        format: 'DD-MM-YYYY',
        
    });

    $('#btn_nuevo_paciente').click(function(){
        $('#modal_nuevo_paciente').appendTo("body").modal('show');
        
    });

   $('#btn_fecha_cita').click(function(){
      //$('#fecha_hora_inicio').data("DateTimePicker").show();
      $('#fecha_cita').data("DateTimePicker").show();
  });


  $("#especialidad").change(function () {
    
    $.post("<?php echo base_url(); ?>medicos/get_medicos_especialidad", {especialidad: $("#especialidad").val()}, function (data) {
      var json_obj = jQuery.parseJSON(data);
      var output = "";
      for (var i in json_obj) {
        output += "<option class='seleccionar' value='" + json_obj[i].id_profesional + "'>" + json_obj[i].nombre + "</option>";
      }

      $("#profesional").html(output);
      $("#profesional").trigger("liszt:updated");
      $("#profesional").selectpicker("refresh");
    });
  });

  $("#rut").change(function () {

    var id_paciente_selected = $("#rut").val();
    var pacientes = <?php echo json_encode($pacientes); ?>;
    
   // $("#nombres_paciente").val(output);

    for(var i=0; i< pacientes.length; i++){
      if(id_paciente_selected == pacientes[i].id_paciente){
          $("#nombres_paciente").val(pacientes[i].nombres);
          $("#apellidos_paciente").val(pacientes[i].apellido_paterno + ' '+pacientes[i].apellido_materno);
      }
    }
    
    //$("#nombres_paciente").val(output);
    //   $("#profesional").trigger("liszt:updated");
    //   $("#profesional").selectpicker("refresh");
    // });
  });

</script>

