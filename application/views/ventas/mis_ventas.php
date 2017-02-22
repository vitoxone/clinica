     <div class="page-head">
        <h2 class="pull-left"><i class="icon-file-alt"></i> Home Vendedor</h2>
        <div class="bread-crumb pull-right">
          <a href="index.html"><i class="icon-home"></i> Home</a> 
          <span class="divider">/</span> 
          <a href="#" class="bread-current">Home vendedor</a>
        </div>
        <div class="clearfix"></div>
   </div>

          <div class="row">
            <div class="col-md-8">

              <div class="widget">

                <div class="widget-head">
                  <div class="pull-left">Mis Ventas: </div>
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
                          <th>Rut</th>
                          <th>Nombre</th>
                          <th>Email</th>
                          <th>Fecha venta</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $numero = 1; 
                      if($ventas){ 

                       foreach ($ventas as $venta): ?>
                        <tr>
                          <td><?php echo $venta->id_paciente_vendedor; ?></td>
                          <td><?php echo $venta->rut; ?></td>
                          <td><?php echo $venta->nombres.' '.$venta->apellido_paterno.' '.$venta->apellido_materno; ?></td>
                          <td><?php echo $venta->email; ?></td>
                          <td><?php echo $venta->created; ?></td>
  
                        </tr>
                                                            
                          <?php ++$numero; ?>
                        <?php endforeach; 
                        }?>
                      </tbody>
                    </table>
                   
                    </div>
                    </div>
            </div>

            <div class="col-md-4">

              <div class="widget">

                <div class="widget-head">
                  <div class="pull-left">Resumen general</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="icon-remove"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>             

                <div class="widget-content">
                  <div class="padd">

                    <!-- Visitors, pageview, bounce rate, etc., Sparklines plugin used -->
                    <ul class="current-status">
                      <li>
                        <span id="status1"></span> <span class="bold">Total ventas : <?php echo count($ventas); ?></span>
                      </li>
                      <li>
                        <span id="status2"></span> <span class="bold">Total ventas contigo : - </span>
                      </li>
                      <li>
                        <span id="status3"></span> <span class="bold">Total ventas PAD : - </span>
                      </li>
                      <li>
                        <span id="status4"></span> <span class="bold">Promedio mensual ventas : -</span>
                      </li>
                      <li>
                        <span id="status5"></span> <span class="bold">Promedio semanal ventas : - </span>
                      </li>
                      <li>
                        <span id="status6"></span> <span class="bold">Promedio diario  : - </span>
                      </li>   
                      <li>
                        <span id="status7"></span> <span class="bold">Ventas hoy : - </span>
                      </li>                                                                                                            
                    </ul>

                  </div>
                </div>

              </div>

            </div>
          </div>