          
              <div class="col-md-12">
                <div class="widget">

                <div class="widget-head">
                  <div class="pull-left">Listado de medicamentos</div>
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
                          <th>Código</th>
                          <th>Nombre</th>
                          <th>Laboratorio</th>
                          <th>Principio Activo</th>
                          <th>Estado</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $numero = 1; ?>
                      <?php foreach ($medicamentos as $medicamento): ?>
                        <tr>
                          <td><?php echo $medicamento->codigo; ?></td>
                          <td><?php echo $medicamento->descriptor; ?></td>
                          <td><?php echo $medicamento->laboratorio; ?></td>
                          <td><?php echo $medicamento->principioActivo; ?></td>
                          <td><span class="label label-success">Activo</span></td>
                          <td>

                              <button class="btn btn-xs btn-success"><i class="icon-ok"></i> </button>
                              <button class="btn btn-xs btn-warning"><i class="icon-pencil"></i> </button>
                              <button class="btn btn-xs btn-danger"><i class="icon-remove"></i> </button>
                          
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
