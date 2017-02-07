<div class="tabbable">
  <ul class="nav nav-tabs">
      <li class="active"><a href="#tab1" data-toggle="tab">Ficha del paciente</a></li>
      <li><a href="#tab2" data-toggle="tab">Consultas</a></li>
      <li><a href="#tab3" data-toggle="tab">Imágenes</a></li>
      <li><a href="#tab3" data-toggle="tab">Citas</a></li>
      <li><a href="#tab3" data-toggle="tab">Informes</a></li>
  </ul>
    <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
      <div class="tab-pane active" id="tab1">
          <div class="row">
          <hr />
          <div class="col-lg-offset-0 col-lg-9">
            <h3> Datos Paciente</h3>
          </div>
          <hr />
            <br>
              <div class="col-md-3">                     
                <div class="form-group">
                  <label class="control-label col-lg-3" for="title">Nombres</label>
                    <div class="col-lg-9">
                      <div class="input-group"> 
                        <input disabled id="nombres" name="nombres" required="required" class="form-control" value= "<?php echo $paciente->nombres; ?>"/>
                      </div>
                    </div>
                </div> 
              </div>
              <div class="col-md-4">                     
                <div class="form-group">
                  <label class="control-label col-lg-4" for="title">Apellido P.</label>
                    <div class="col-lg-8">
                      <div class="input-group"> 
                        <input disabled id="apellido_paterno" name="apellido_paterno" required="required" class="form-control" value= "<?php echo $paciente->apellido_paterno; ?>"/>
                      </div>
                    </div>
                </div> 
              </div>
              <div class="col-md-4">                     
                <div class="form-group">
                  <label class="control-label col-lg-4" for="title">Apellido M.</label>
                    <div class="col-lg-8">
                      <div class="input-group"> 
                        <input disabled id="apellido_materno" name="apellido_materno" required="required" class="form-control" value= "<?php echo $paciente->apellido_materno; ?>"/>
                      </div>
                    </div>
                </div> 
              </div>
            </div>
            <div class="row">
            <br>
              <div class="col-md-3">                     
                <div class="form-group">
                  <label class="control-label col-lg-3" for="title">Sexo</label>
                   <div class="col-lg-8">
                   <div class="row">
                   <div class="col-md-6">  
                      <div class="radio col-lg-1">
                        <label>
                          <input type="radio" name="sexo" id="sexo1" value="1">
                          Hombre
                        </label>
                      </div>
                      </div>
                      <div class="col-md-6"> 
                        <div class="radio col-lg-2">
                          <label>
                            <input type="radio" name="sexo" id="sexo2" value="2">
                           Mujer
                          </label>
                        </div>
                      </div>
                      </div>
                    </div>
                </div> 
              </div>
              <div class="col-md-3">                     
                <div class="form-group">
                  <label class="control-label col-lg-4" for="title">Fecha N.</label>
                    <div class="col-lg-8">
                      <div class="input-group"> 
                        <input type = "date" id="fecha_nacimiento" name="fecha_nacimiento" required="required" class="form-control"/>
                      </div>
                    </div>
                </div> 
              </div>
              <div class="col-md-2">                     
                <div class="form-group">
                  <label class="control-label col-lg-3" for="title">Edad</label>
                    <div class="col-lg-9">
                      <div class="input-group"> 
                        <input id="edad" name="edad" required="required" class="form-control"/>
                      </div>
                    </div>
                </div> 
              </div>
              <div class="col-md-4">                     
                      <div class="form-group">
                        <label class="control-label col-lg-3" for="title">G. Sangre</label>
                        <div class="col-lg-9">
                          <div class="input-group"> 
                           <select id="grupo_sangre" name="grupo_sangre" required="required" class="selectpicker" title="- Seleccione grupo -">
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
              </div>
            </div>
            <div class="row">
            <br>
              <div class="col-md-3">                     
                <div class="form-group">
                  <label class="control-label col-lg-3" for="title">Rut</label>
                   <div class="col-lg-8">
                      <div class="input-group"> 
                        <input disabled id="rut" name="rut" required="required" class="form-control" value= "<?php echo $paciente->rut; ?>"/>
                      </div>
                    </div>
                </div> 
              </div>
              <div class="col-md-3">                     
                <div class="form-group">
                  <label class="control-label col-lg-4" for="title">Isapre</label>
                    <div class="col-lg-8">
                      <div class="input-group"> 
                          <select id="especialidad" name="especialidad" required="required" class="selectpicker" title="- Seleccione isapre -">
                          <?php
                              foreach($isapres as $isapre) {
                            ?>
                            <option value="<?php echo base64_encode($this->encrypt->encode($isapre->id_isapre)); ?>"><?php echo $isapre->isapre; ?></option>
                            <?php
                                }
                              ?>
                            </select> 
                      </div>
                    </div>
                </div> 
              </div>
              <div class="col-md-3">                     
                <div class="form-group">
                  <label class="control-label col-lg-4" for="title">Teléfono</label>
                    <div class="col-lg-8">
                      <div class="input-group"> 
                        <input id="telefono" name="telefono" class="form-control"/>
                      </div>
                    </div>
                </div> 
              </div>
              <div class="col-md-3">                     
                <div class="form-group">
                  <label class="control-label col-lg-4" for="title">Celular</label>
                  <div class="col-lg-8">
                    <div class="input-group"> 
                      <input id="celular" name="celular" class="form-control"/>
                    </div>
                  </div>
                </div> 
              </div>
            </div>
            <div class="row">
            <br>
              <div class="col-md-4">                     
                <div>
                  <label class="control-label col-lg-2" for="title">Dirección</label>
                   <div class="col-lg-10">
                      <div class="input-group"> 
                        <input type="text" id="direccion" name="direccion" required="required" class="form-control"/>
                      </div>
                    </div>
                </div> 
              </div>
              <div class="col-md-3">                     
                <div class="form-group">
                  <label class="control-label col-lg-4" for="title">Región</label>
                    <div class="col-lg-8">
                      <div class="input-group"> 
                          <select id="especialidad" name="especialidad" required="required" class="selectpicker" title="- Seleccione región -">
                          <?php
                              foreach($isapres as $isapre) {
                            ?>
                            <option value="<?php echo base64_encode($this->encrypt->encode($isapre->id_isapre)); ?>"><?php echo $isapre->isapre; ?></option>
                            <?php
                                }
                              ?>
                            </select> 
                      </div>
                    </div>
                </div> 
              </div>
              <div class="col-md-3">                     
                <div class="form-group">
                  <label class="control-label col-lg-4" for="title">Comuna</label>
                    <div class="col-lg-8">
                      <div class="input-group"> 
                          <select id="especialidad" name="especialidad" required="required" class="selectpicker" title="- Seleccione comuna -">
                          <?php
                              foreach($isapres as $isapre) {
                            ?>
                            <option value="<?php echo base64_encode($this->encrypt->encode($isapre->id_isapre)); ?>"><?php echo $isapre->isapre; ?></option>
                            <?php
                                }
                              ?>
                            </select> 
                      </div>
                    </div>
                </div> 
              </div>
            </div>
            <br>
        <div class="row">
          <div class="col-md-4">                     
            <div>
              <label class="control-label col-lg-2" for="title">Email</label>
               <div class="col-lg-10">
                  <div class="input-group"> 
                    <input type="text" id="direccion" name="direccion" required="required" class="form-control"/>
                  </div>
                </div>
            </div> 
          </div>
          <div class="col-md-4">                     
            <div>
              <label class="control-label col-lg-4" for="title">Repetir Email*</label>
               <div class="col-lg-8">
                  <div class="input-group"> 
                    <input type="text" id="direccion" name="direccion" required="required" class="form-control"/>
                  </div>
                </div>
            </div> 
          </div>
        </div>    
        <div class="row">
          <hr />
          <div class="col-lg-offset-0 col-lg-9">
            <h3> Familiar de contacto</h3>
          </div>
          <hr />
          <br>
          <div class="col-md-3">                     
            <div class="form-group">
              <label class="control-label col-lg-3" for="title">Nombre</label>
                <div class="col-lg-9">
                  <div class="input-group"> 
                    <input id="nombre_familiar" name="nombre_familiar" required="required" class="form-control"/>
                  </div>
                </div>
            </div> 
          </div>
          <div class="col-md-3">                     
            <div class="form-group">
              <label class="control-label col-lg-3" for="title">Teléfono</label>
                <div class="col-lg-8">
                  <div class="input-group"> 
                    <input id="telefono_familiar" name="telefono_familiar" required="required" class="form-control"/>
                  </div>
                </div>
            </div> 
          </div>
          <div class="col-md-5">                     
            <div class="form-group">
              <label class="control-label col-lg-2" for="title">Email</label>
                <div class="col-lg-8">
                  <div class="input-group"> 
                    <input id="email_familiar" name="email_familiar" required="required" class="form-control"/>
                  </div>
                </div>
            </div> 
          </div>
        </div> 
        <hr />   
        <div class="row">
                                                      <!-- Buttons -->
            <div class="form-group pull right">                                             <!-- Buttons -->
                <div class="col-lg-offset-8 col-lg-9 pull-rigth">
                  <button type="submit" class="btn btn-success">Gaardar</button>
                  <button type="submit" class="btn btn-danger">Cancelar</button>
                  <button type="reset" class="btn btn-default">Resetear</button>
                </div>
            </div>
        </div>

      </div>
      <div class="tab-pane" id="tab2">
            <div class="row">
            <br>
            <div class="col-md-12">
            <div class="col-md-6">
            <img src="<?php echo base_url(); ?>assets/img/humano.png"></img>
            </div> 
            <div class="col-md-6"> 
              <div class="col-md-6">
                <div class="row">                     
                  <div class="form-group">
                    <label class="control-label col-lg-4" for="title">Estado inicial</label>
                      <div class="col-lg-8">
                        <div class="input-group"> 
                          <textarea rows="4" cols="50">La herida presenta coloración saludable. </textarea>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="row">                      
                    <div class="form-group">
                      <label class="control-label col-lg-4" for="title">Detalle atención</label>
                        <div class="col-lg-8">
                          <div class="input-group"> 
                           <textarea rows="4" cols="50">Se realizó limpieza y cambio del vendaje de la herida.</textarea>
                          </div>
                        </div>
                    </div>
                </div>
                </div>  
          </div>
        </div>
      </div>
      </div>
      <div class="tab-pane" id="tab3">
        <p>What up girl, this is Section 3.</p>
      </div>
    </div>
  </div>






