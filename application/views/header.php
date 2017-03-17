<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <!-- Title and other stuffs -->
  <title>Clínica Convatec</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.png"> 


  <!-- Stylesheets -->
  <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
  <!-- Font awesome icon -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.css"> 
  <!-- jQuery UI -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css"> 
  <!-- Calendar -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fullcalendar.css">
  <!-- prettyPhoto -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/prettyPhoto.css">  
  <!-- Star rating -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/rateit.css">
  <!-- Date picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css">
  <!-- CLEditor -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.cleditor.css"> 
  <!-- Bootstrap toggle -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-switch.css">
  <!-- Main stylesheet -->
  <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
  <!-- Widgets stylesheet -->
  <link href="<?php echo base_url(); ?>assets/css/widgets.css" rel="stylesheet"> 

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-select.css"> 

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css" />

  <!--<script src="https://code.jquery.com/jquery-1.10.2.js"></script>-->
  <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.min.js"></script> <!-- jQuery -->

  <!-- JS -->
<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script> <!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script> <!-- Bootstrap -->
<script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.9.2.custom.min.js"></script> <!-- jQuery UI -->
<script src="<?php echo base_url();?>assets/js/moment-with-locales.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->



<script src="<?php echo base_url(); ?>assets/js/jquery.rateit.min.js"></script> <!-- RateIt - Star rating -->
<script src="<?php echo base_url(); ?>assets/js/jquery.prettyPhoto.js"></script> <!-- prettyPhoto -->

<!-- jQuery Flot -->
<script src="<?php echo base_url(); ?>assets/js/excanvas.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.flot.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.flot.resize.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.flot.pie.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.flot.stack.js"></script>

<!-- jQuery Notification - Noty -->
<script src="<?php echo base_url(); ?>assets/js/jquery.noty.js"></script> <!-- jQuery Notify -->
<script src="<?php echo base_url(); ?>assets/js/themes/default.js"></script> <!-- jQuery Notify -->
<script src="<?php echo base_url(); ?>assets/js/layouts/bottom.js"></script> <!-- jQuery Notify -->
<script src="<?php echo base_url(); ?>assets/js/layouts/topRight.js"></script> <!-- jQuery Notify -->
<script src="<?php echo base_url(); ?>assets/js/layouts/top.js"></script> <!-- jQuery Notify -->
<!-- jQuery Notification ends -->

<script src="<?php echo base_url(); ?>assets/js/sparklines.js"></script> <!-- Sparklines -->
<script src="<?php echo base_url(); ?>assets/js/jquery.cleditor.min.js"></script> <!-- CLEditor -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap-switch.min.js"></script> <!-- Bootstrap Toggle -->
<script src="<?php echo base_url(); ?>assets/js/filter.js"></script> <!-- Filter for support page -->
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script> <!-- Custom codes -->
<script src="<?php echo base_url(); ?>assets/js/charts.js"></script> <!-- Charts & Graphs -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap-select.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js"></script> 
  
  <!-- HTML5 Support for IE -->
  <!--[if lt IE 9]>
  <script src="js/html5shim.js"></script>
  <![endif]-->

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.png">
</head>

<body>

<div class="navbar navbar-fixed-top bs-docs-nav" role="banner">
  
    <div class="conjtainer">
      <!-- Menu button for smallar screens -->
      <div class="navbar-header">
      <button class="navbar-toggle btn-navbar" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
      <span>Menu</span>
      </button>
      <!-- Site name for smallar screens 
      <a href="index.html" class="navbar-brand hidden-lg">Convatec</a>-->
    </div>
      
      

      <!-- Navigation starts -->
      <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">         


        <!-- Search form -->
      <form class="navbar-form navbar-left" role="search">
      <!--<div class="form-group">
        <input type="text" class="form-control" placeholder="Search">
      </div>-->
        <div class="logo">
          <img src="<?php echo base_url()."assets/img/convatec_logo_small.png"?>"/>
        </div>
    </form>
        <!-- Links -->
        <ul class="nav navbar-nav pull-right">
          <li class="dropdown pull-right">            
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <i class="icon-user"></i> <?php echo $this->session->userdata('nombre_usuario')?> <b class="caret"></b>              
            </a>
            
            <!-- Dropdown menu -->
            <ul class="dropdown-menu">
              <li><a href="<?php echo base_url()."usuarios/perfil_usuario"?>/<?php echo base64_encode($this->encrypt->encode($this->session->userdata('id_usuario')))?>"><i class="icon-user"></i> Perfil</a></li>
              <li><a href="<?php echo base_url()."usuarios/mantenedor_password"?>/<?php echo base64_encode($this->encrypt->encode($this->session->userdata('id_usuario')))?>"><i class="icon-cogs"></i> Contraseña</a></li>
              <li><a href="<?php echo base_url()."usuarios/logout"?>"><i class="icon-off"></i> Salir</a></li>
            </ul>
          </li>
          
        </ul>
      </nav>

    </div>
  </div>
