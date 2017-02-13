
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.png">

<div class="content">
    <div class="sidebar">
        <div class="sidebar-dropdown"><a href="#">Navigation</a></div>
        <ul id="nav">
        <?php if($this->session->userdata('especialidad') != 'Enfermera Clínica'){?> 
           <li><a  class="open" href="<?php echo base_url()."agenda/agenda"?>"><i class="icon-calendar"></i> Calendario<span class="pull-right"><i class="icon-chevron-right"></i></span></a>
          </li><?php } ?> 

          <li class="has_sub"><a href="#"><i class="icon-list-alt"></i> Pacientes  <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
            <ul>
              <li><a  href="<?php echo base_url()."pacientes/nuevo_diagnostico"?>" >Nuevo</a></li>
              <li><a  href="<?php echo base_url()."pacientes/listado_pacientes"?>">Listado</a></li>
              <li><a  href="<?php echo base_url()."reportes/reporte_general"?>">Estadísticas generales</a></li>
            </ul>
          </li>
          <li class="has_sub"><a href="#"><i class="icon-phone"></i> Call center  <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
            <ul>
              <li><a  href="<?php echo base_url()."pacientes/listado_pacientes_contigo"?>">Pacientes contigo </a></li>
              <li><a  href="<?php echo base_url()."reportes/reporte_llamados"?>">Estadísticas</a></li>
            </ul>
          </li>
          <?php if($this->session->userdata('especialidad') != 'Enfermera Clínica'){?> 
          <li class="has_sub"><a href="#"><i class="icon-table"></i> M.Insumos <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
            <ul>
              <li><a class="open"  href="<?php echo base_url()."medicamentos/listado_insumos"?>">Listado Insumos</a></li>
            </ul>
          </li> 
          <li><a  href="<?php echo base_url()."usuarios/listado_usuarios"?>"><i class="icon-user"></i> M. Usuarios <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
          </li> <?php } ?> 

          <!-- <li><a href="<?php echo base_url()."reportes/reporte_general"?>"><i class="icon-bar-chart"></i> Reportes</a></li> -->
          <!--<li><a href="forms.html"><i class="icon-tasks"></i> Configuración</a></li> -->
        </ul>
    </div>
    <div class="mainbar">
      <div class="matter">
        <div class="container">


