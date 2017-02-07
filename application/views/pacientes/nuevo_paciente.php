<div class="bread-crumb pull-left">
    <a href="index.html"><i class="icon-home"></i> Home</a> 
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
                            <select class="form-control" id="tipo_documento_identificacion" name="tipo_documento_identificacion" title="Seleccione tipo documento">                                                              
                              <option value="" selected disabled> Seleccione tipo documento</option>
                                <?php foreach ($tipos_documentos as $tipo_documento): ?>
                                    <option value="<?php echo base64_encode($this->encrypt->encode($tipo_documento->id_tipo_documento_identificacion)); ?>"><?php echo $tipo_documento->nombre; ?></option>
                                <?php endforeach; ?>
                            </select>    
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">                    
                      <div class="form-group">
                        <label class="col-lg-3" for="content">Número</label>
                        <div class="col-lg-9">
                          <div class="input-group">
                            <input  id="rut" name="rut" class="form-control"/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="col-md-6">                    
                        <div class="form-group">
                          <label class="col-lg-3" for="content">Programa contigo</label>
                          <div class="col-lg-9">                               
                              <div class="toggle-button">
                                  <input id="programa_contigo" name="programa_contigo" class="form-control" type="checkbox">
                              </div> 
                          </div>
                          </div>
                        </div>
                        <div class="col-md-6">    
                          <div class="form-group">
                            <label class="col-lg-3" for="content">Atención domiciliaria</label>
                            <div class="col-lg-9">                               
                                <div class="toggle-button">
                                    <input id="programa_domiciliario" name="programa_domiciliario" class="form-control" type="checkbox">
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
                            <input  id="nombres" name="nombres" class="form-control"/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-lg-3">Apellido Paterno</label>
                        <div class="col-lg-9">
                            <input  id="apellido_paterno" name="apellido_paterno" class="form-control" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">                      
                      <div class="form-group">
                        <label class="col-lg-3">Apellido Materno</label>
                        <div class="col-lg-9">
                            <input  id="apellido_materno" name="apellido_materno" class="form-control" />
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
                                  <input id="fecha_nacimiento" name="fecha_nacimiento"  class="form-control"/>
                                  <span id="btn_fecha_nacimiento" class="input-group-addon btn btn-info btn-lg"><i class="icon-calendar"></i></span>
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
                            <select class="form-control" id="genero" name="genero" title="Seleccione género">                                                              
                              <option value="" selected disabled> Seleccione género</option>
                              <option value="1">Masculino</option>
                              <option value="2">Femenino</option>
                            </select>    
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-lg-3">Previsión salud</label>
                        <div class="col-lg-9">
                          <div class="input-group">
                            <select class="form-control" id="isapre" name="isapre" title="Seleccione isapre">                                                              
                              <option value="" selected disabled> Seleccione isapre</option>
                                <?php foreach ($isapres as $isapre): if($isapre->tramos){ ?>
                                    <option class="fonasa" value="<?php echo base64_encode($this->encrypt->encode($isapre->id_isapre)); ?>"><?php echo $isapre->isapre; ?></option>
                                    <?php }else { ?>
                                    <option value="<?php echo base64_encode($this->encrypt->encode($isapre->id_isapre)); ?>"><?php echo $isapre->isapre; ?></option>
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
                          <input id="direccion" name="direccion"  class="form-control"/>  
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-lg-3">Región</label>
                        <div class="col-lg-9">
                          <div class="input-group">
                            <select class="form-control" id="region" name="region" title="Seleccione región">                                                              
                              <option value="" selected disabled> Seleccione región</option>
                                <?php foreach ($regiones as $region): ?>
                                    <option value="<?php echo base64_encode($this->encrypt->encode($region->id_region)); ?>"><?php echo $region->region; ?></option>
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
                            <select class="form-control" id="letra_isapre" name="letra_isapre" title="Seleccione letra">                                                              
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
                            <select class="form-control" id="comuna" name="comuna" title="Seleccione comuna">                                                              
                              <option value="" selected disabled> Seleccione comuna</option>
                            </select>    
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">                      
                      <div class="form-group">
                        <label class="col-lg-3">Teléfono fijo</label>
                        <div class="col-lg-8">
                          <div class="input-group">
                              <div class="input-group">
                                  <input id="telefono" name="telefono"  class="form-control"/>  
                              </div>
                          </div>
                        </div>
                      </div></div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-lg-3">Celular</label>
                        <div class="col-lg-8">
                          <div class="input-group">
                              <input id="celular" name="celular"  class="form-control"/>  
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
                              <input id="email" name="email"  class="form-control"/>  
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-lg-3">Repetir email</label>
                        <div class="col-lg-9">
                          <input id="repetir_email" name="repetir_email"  class="form-control"/>  
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
              <hr />
              <div class="form-group">
                <div class="col-lg-offset-8 col-lg-9">
                <input id="redireccion" name= "redireccion"  type="hidden" value="" />
                  <button type="button" class="btn btn-default">Volver</button>
                   <button class="btn btn-success" type="button" onclick="guardar_paciente(1)"><i class="fa fa-floppy-o fa-fw"></i>Guardar</button>
                  <button  class="btn btn-success" type="button"  onclick= "guardar_paciente(2)"><i class="fa fa-floppy-o fa-fw"></i> Guardar y agregar diagnostico</button>
                </div>
              </div> 
            </div>  
          </div><!--fin col-6 -->
        </form>

<script src="<?php echo base_url(); ?>assets/js/bootstrap-select.js" type="text/javascript"></script>      

<script type="text/javascript">

    $('#fecha_nacimiento').datetimepicker({
        locale: 'es',
        useCurrent: false,
        format: 'YYYY-MM-DD',
        
    });

   $('#btn_fecha_nacimiento').click(function(){
      //$('#fecha_hora_inicio').data("DateTimePicker").show();
      $('#fecha_nacimiento').data("DateTimePicker").show();
  });


   $("#fecha_nacimiento").on("dp.change", function(e) {
    var edad = calcular_edad($('#fecha_nacimiento').val());
      $('#edad').val(edad+" años");
    });


    $("#region").change(function () {

        $('#comuna').find('option').remove();
       // $('#comuna').form-control("refresh");
        
        $.post("<?php echo base_url(); ?>Regiones/get_comunas_region", {region: $("#region").val()}, function (data) {
                var json_obj = jQuery.parseJSON(data);
                var output = '<option> Seleccione comuna</option>';
                if(data != 'false'){
                    $.each(json_obj, function (idx, obj) {
                        output += "<option value='" + obj.id + "'>" + obj.comuna + "</option>";
                    });
                }
                    
                $("#comuna").html(output);
                $("#comuna").trigger("liszt:updated");
                $("#comuna").form-control("refresh");
        });
    });

        $("#cie10_select").change(function () {
         $("#cie10").val($("#cie10_select").val());   
    });

    $('#btn_nuevos_estomas').click(function(){
       var wrapper = $('.form-estomias');
       var fieldHTML = '<div><label> Nombre</label><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="remove-icon.png"/></a></div>';
        $(wrapper).append(fieldHTML);
        $(wrapper).append(fieldHTML);
        $('#modal_ingreso_estomias').appendTo("body").modal('show');
        
    });
  

function calcular_edad(fecha)
{
        // Si la fecha es correcta, calculamos la edad
        var values=fecha.split("-");
        var dia = values[2];
        var mes = values[1];
        var ano = values[0];
 
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
 
       return edad;
    
} 

  </script>
