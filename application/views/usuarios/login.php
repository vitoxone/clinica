<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <!-- Title and other stuffs -->
  <title>Login - Clínica</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">

  <!-- Stylesheets -->
  <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url(); ?>font/font-awesome.css">
  <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">

  
  <!-- HTML5 Support for IE -->
  <!--[if lt IE 9]>
  <script src="js/html5shim.js"></script>
  <![endif]-->

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.png">
</head>

<body>

<div class="admin-form">

  <div class="col-md-12 ">
      <div class="logo center">
            <img src="<?php echo base_url()."assets/img/convatec-log.png"?>"/><p class="meta">Mejorando la Vida de las Personas que Tocamos</p>
      </div>
  </div>

  <div class="container">

    <div class="row">

      <div class="col-md-12">

        <!-- Widget starts -->
            <div class="widget worange">
              <!-- Widget head -->
              <div class="widget-head">
                <i class="icon-lock"></i> Login Clínica Convatec
              </div>

              <div class="widget-content">
                <div class="padd">
                  <!-- Login form -->
                  <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>usuarios/login">
                    <!-- Email -->
                    <div class="form-group">
                      <label class="control-label col-lg-3" for="inputUsuario">Usuario/Email</label>
                      <div class="col-lg-9">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Nombre de usuario">
                      </div>
                    </div>
                    <!-- Password -->
                    <div class="form-group">
                      <label class="control-label col-lg-3" for="inputPassword">Contraseña</label>
                      <div class="col-lg-9">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
                      </div>
                    </div>
                    <!-- Remember me checkbox and sign in button -->
                    <div class="form-group">
                    <?php if($fail){ ?>
                      <div class="alert alert-danger pull center">
                        La contraseña y/o usuario no corresponden.
                      </div>
                      <?php } ?>
                    <div class="col-lg-9 col-lg-offset-3">
                                <div class="checkbox">
                                  <label>
                                    <input id="recordar" id="name" type="checkbox"> Recordame en este equipo
                                  </label>
                      </div>
                    </div>
                </div>
                  <div class="col-lg-12">
                  <button type="submit" class="btn btn-primary btn-lg ng-isolate-scope pull-right">Entrar</button>
                </div>
                    <br />
                  </form>
            </div>
          </div>
              
                <div class="widget-foot">
                  Desarrollado por <a target="_blank" href="http://itsia.cl/"><img border="0" alt="W3Schools" src="<?php echo base_url(); ?>assets/img/itsia.png" width="55" height="20"></a>
                </div>
            </div>  
      </div>
    </div>
  </div> 
</div>
   

<!-- JS -->
<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
</body>
</html>
		


