          
              <div class="col-md-12">
                                  <div class="row">

                      <div class="col-md-2">
                          <a href="<?php echo base_url()."pacientes/nuevo_paciente"?>"type="button" class="btn btn-success">Nuevo paciente</a>
                      </div>

                      <div class="col-md-2">
                        <div class="well">
                          <h2>5</h2>
                          <p>Total pacientes</p>                        
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="well">
                          <h2>0/5</h2>
                          <p>Con ficha / Sin ficha</p>
                        </div>
                      </div>

                    </div>
                <div class="widget">

                <div class="widget-head">

                  <div class="pull-left">Listado de pacientes CONTIGO</div>
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
                          <th>#</th>
                          <th>Nombre</th>
                          <th>Prioridad</th>
                          <th>Estado</th>
                          <th>Fecha registro</th>
                          <th>Último llamado</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $numero = 1; ?>
                      <?php foreach ($pacientes as $paciente): ?>
                        <tr>
                          <td><?php echo $numero; ?></td>
                          <td><?php echo $paciente->nombres. " ".$paciente->apellido_paterno." ".$paciente->apellido_materno; ?></td>
                          <td><?php if($paciente->ficha != NULL){ echo '<span class="label label-success">Si</span>'; }else{echo '<span class="label label-danger">ALTA</span>'; }?></td>
                          <td><?php if($paciente->activo){ echo '<span class="label label-success">Activo</span>'; }else{echo '<span class="label label-danger">Inactivo</span>'; }?></td>
                          <td><?php echo $paciente->created; ?></td>
                          <td><?php echo $paciente->created; ?></td>

                          <td>
                              <a  href="<?php echo base_url(); ?>pacientes/nuevo_seguimiento_paciente/<?php echo base64_encode($this->encrypt->encode($paciente->id_paciente));?>" class="btn btn-xs btn-success"><i class="icon-ok"></i>Llamar</a>
                              <a class="btn btn-xs btn-warning"><i class="icon-pencil"></i> Ver Seguimiento</a>
                              <a class="btn btn-xs btn-danger"><i class="icon-remove"></i> </a>
                          
                          </td>
                        </tr>
                                                            
                          <?php ++$numero; ?>
                        <?php endforeach; ?>
                      </tbody>
                    </table>

                    <div class="widget-foot">

                     
                        <ul class="pagination pull-right">
                          <li><a href="#">Prev</a></li>
                          <li><a href="#">1</a></li>
                          <li><a href="#">2</a></li>
                          <li><a href="#">3</a></li>
                          <li><a href="#">4</a></li>
                          <li><a href="#">Next</a></li>
                        </ul>
                     
                      <div class="clearfix"></div> 

                    </div>

                  </div>

                </div>


              </div>
