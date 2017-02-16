

  <div class="container">

    <div class="row">
      <div>
        <?php foreach ($historial_valoraciones as $valoracion ) { ?>
        <div class="widget">

        <div class="widget-head">
          <div class="pull-left">Fecha registro : <?php echo $valoracion->created; ?></div>
          <div class="widget-icons pull-right">

          </div>  
          <div class="clearfix"></div>
        </div>

          <div class="widget-content">


           
            <table class="table table-striped table-bordered table-hover">
                <tr>
                  <th>SACS L</th>
                  <td><?php echo $valoracion->sacsl; ?></td>
                </tr>  
                <tr>  
                  <th>SACS T</th>
                  <td><?php echo $valoracion->sacst; ?></td>
                </tr>
                <tr>  
                  <th>COMENTARIO SACS</th>
                  <td><?php echo $valoracion->comentario_sacs; ?></td>
                </tr>                                                          
            </table>
            <br>
            

        </div>  
      </div>
      <?php } ?>
    </div>
  </div> 
  