
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.png">

<div class="content">
    <div class="sidebar">
        <div class="sidebar-dropdown"><a href="#">Navigation</a></div>
        <ul id="nav">
        <?php if($this->session->userdata('especialidad') == 'Enfermera coordinadora'){?> 
          <li><a  <?php if($active_view == 'home_admin')echo 'class="open"' ?> href="<?php echo base_url()."usuarios/home_admin"?>"><i class="icon-home"></i> Inicio<span class="pull-right"><i class="icon-chevron-right"></i></span></a>
          </li>
           <li><a  <?php if($active_view == 'agenda')echo 'class="open"' ?> href="<?php echo base_url()."agenda/agenda"?>"><i class="icon-calendar"></i> Calendario<span class="pull-right"><i class="icon-chevron-right"></i></span></a>
          </li>

          <li class="has_sub"><a <?php if($active_view == 'pacientes')echo 'class="open"' ?> href="#"><i class="icon-list-alt"></i> Pacientes  <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
            <ul>
              <li><a  href="<?php echo base_url()."pacientes/nuevo_diagnostico"?>" >Nuevo</a></li>
              <li><a  href="<?php echo base_url()."pacientes/listado_pacientes"?>">Listado</a></li>
              <li><a  href="<?php echo base_url()."reportes/reporte_general"?>">Estadísticas generales</a></li>
            </ul>
          </li>
          <li class="has_sub"><a <?php if($active_view == 'callcenter')echo 'class="open"' ?> href="#"><i class="icon-phone"></i> Call center  <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
            <ul>
              <li><a  href="<?php echo base_url()."pacientes/listado_pacientes_contigo"?>">Pacientes contigo </a></li>
              <li><a  href="<?php echo base_url()."reportes/reporte_llamados"?>">Estadísticas</a></li>
            </ul>
          </li>
            <li class="has_sub"><a <?php if($active_view == 'insumos')echo 'class="open"' ?> href="#"><i class="icon-table"></i> M.Insumos <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
            <ul>
              <li><a class="open"  href="<?php echo base_url()."medicamentos/listado_insumos"?>">Listado Insumos</a></li>
            </ul>
          </li> 
          <li><a  <?php if($active_view == 'usuarios')echo 'class="open"' ?> href="<?php echo base_url()."usuarios/listado_usuarios"?>"><i class="icon-user"></i> M. Usuarios <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
          </li>
          <li class="has_sub"><a <?php if($active_view == 'vendedor')echo 'class="open"' ?> href="#"><i class="icon-phone"></i> Ventas  <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
            <ul>
              <li><a  href="<?php echo base_url()."vendedores/reportes_ventas"?>">Panel </a></li>
              <li><a  href="<?php echo base_url()."vendedores/reportes"?>">Reportes</a></li>
            </ul>
          </li>

          <?php } ?>
          <?php if($this->session->userdata('especialidad') == 'Técnico enfermería'){?> 
           <li><a  <?php if($active_view == 'agenda')echo 'class="open"' ?> href="<?php echo base_url()."agenda/agenda"?>"><i class="icon-calendar"></i> Calendario<span class="pull-right"><i class="icon-chevron-right"></i></span></a>
          </li>

          <li class="has_sub"><a <?php if($active_view == 'pacientes')echo 'class="open"' ?> href="#"><i class="icon-list-alt"></i> Pacientes  <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
            <ul>
              <li><a  href="<?php echo base_url()."pacientes/nuevo_diagnostico"?>" >Nuevo</a></li>
              <li><a  href="<?php echo base_url()."pacientes/listado_pacientes"?>">Listado</a></li>
              <li><a  href="<?php echo base_url()."reportes/reporte_general"?>">Estadísticas generales</a></li>
            </ul>
          </li>
          <li class="has_sub"><a <?php if($active_view == 'callcenter')echo 'class="open"' ?> href="#"><i class="icon-phone"></i> Call center  <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
            <ul>
              <li><a  href="<?php echo base_url()."pacientes/listado_pacientes_contigo"?>">Pacientes contigo </a></li>
              <li><a  href="<?php echo base_url()."reportes/reporte_llamados"?>">Estadísticas</a></li>
            </ul>
          </li>
          <?php } ?> 
          <?php if($this->session->userdata('especialidad') == 'Secretaria'){?> 
           <li><a  <?php if($active_view == 'agenda')echo 'class="open"' ?> href="<?php echo base_url()."agenda/agenda"?>"><i class="icon-calendar"></i> Calendario<span class="pull-right"><i class="icon-chevron-right"></i></span></a>
          </li>

          <li class="has_sub"><a <?php if($active_view == 'pacientes')echo 'class="open"' ?> href="#"><i class="icon-list-alt"></i> Pacientes  <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
            <ul>
              <li><a  href="<?php echo base_url()."pacientes/nuevo_diagnostico"?>" >Nuevo</a></li>
              <li><a  href="<?php echo base_url()."pacientes/listado_pacientes"?>">Listado</a></li>
              <li><a  href="<?php echo base_url()."reportes/reporte_general"?>">Estadísticas generales</a></li>
            </ul>
          </li>
          <?php } ?> 
          <?php if($this->session->userdata('especialidad') == 'Gerente general'){?> 
           <li><a  <?php if($active_view == 'agenda')echo 'class="open"' ?> href="<?php echo base_url()."agenda/agenda"?>"><i class="icon-calendar"></i> Calendario<span class="pull-right"><i class="icon-chevron-right"></i></span></a>
          </li>

          <li class="has_sub"><a <?php if($active_view == 'pacientes')echo 'class="open"' ?> href="#"><i class="icon-list-alt"></i> Pacientes  <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
            <ul>
              <li><a  href="<?php echo base_url()."pacientes/nuevo_diagnostico"?>" >Nuevo</a></li>
              <li><a  href="<?php echo base_url()."pacientes/listado_pacientes"?>">Listado</a></li>
              <li><a  href="<?php echo base_url()."reportes/reporte_general"?>">Estadísticas generales</a></li>
            </ul>
          </li>
          <li class="has_sub"><a <?php if($active_view == 'callcenter')echo 'class="open"' ?> href="#"><i class="icon-phone"></i> Call center  <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
            <ul>
              <li><a  href="<?php echo base_url()."pacientes/listado_pacientes_contigo"?>">Pacientes contigo </a></li>
              <li><a  href="<?php echo base_url()."reportes/reporte_llamados"?>">Estadísticas</a></li>
            </ul>
          </li>
            <li class="has_sub"><a <?php if($active_view == 'insumos')echo 'class="open"' ?> href="#"><i class="icon-table"></i> M.Insumos <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
            <ul>
              <li><a class="open"  href="<?php echo base_url()."medicamentos/listado_insumos"?>">Listado Insumos</a></li>
            </ul>
          </li> 
          <li><a  <?php if($active_view == 'usuarios')echo 'class="open"' ?> href="<?php echo base_url()."usuarios/listado_usuarios"?>"><i class="icon-user"></i> M. Usuarios <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
          </li>
          <li><a  <?php if($active_view == 'vendedor')echo 'class="open"' ?> href="<?php echo base_url()."vendedores/reportes_ventas"?>"><i class="icon-user"></i> Ventas <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
          </li>

          <?php } ?> 
          <?php if($this->session->userdata('especialidad') == 'Enfermera clínica'){?> 
          <li><a  <?php if($active_view == 'agenda')echo 'class="open"' ?> href="<?php echo base_url()."agenda/agenda"?>"><i class="icon-calendar"></i> Calendario<span class="pull-right"><i class="icon-chevron-right"></i></span></a></li>
          <li class="has_sub"><a href="#"><i class="icon-list-alt"></i> Pacientes  <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
            <ul>
              <li><a  href="<?php echo base_url()."pacientes/nuevo_diagnostico"?>" >Nuevo</a></li>
              <li><a  href="<?php echo base_url()."pacientes/listado_pacientes"?>">Listado</a></li>
              <li><a  href="<?php echo base_url()."reportes/reporte_general"?>">Estadísticas generales</a></li>
            </ul>
          </li>
          <li class="has_sub"><a <?php if($active_view == 'callcenter')echo 'class="open"' ?> href="#"><i class="icon-phone"></i> Call center  <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
            <ul>
              <li><a  href="<?php echo base_url()."pacientes/listado_pacientes_contigo"?>">Pacientes contigo </a></li>
              <li><a  href="<?php echo base_url()."reportes/reporte_llamados"?>">Estadísticas</a></li>
            </ul> <?php } ?>
          <?php if($this->session->userdata('especialidad') == 'Enfermera PAD'){?> 
          <li><a  <?php if($active_view == 'agenda')echo 'class="open"' ?> href="<?php echo base_url()."agenda/agenda"?>"><i class="icon-calendar"></i> Calendario<span class="pull-right"><i class="icon-chevron-right"></i></span></a>
          </li>
          <li class="has_sub"><a href="#"><i class="icon-list-alt"></i> Pacientes  <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
            <ul>
              <li><a  href="<?php echo base_url()."pacientes/nuevo_diagnostico"?>" >Nuevo</a></li>
              <li><a  href="<?php echo base_url()."pacientes/listado_pacientes"?>">Listado</a></li>
              <li><a  href="<?php echo base_url()."reportes/reporte_general"?>">Estadísticas generales</a></li>
            </ul>
          </li> <?php } ?>
          <?php if($this->session->userdata('especialidad') == 'Vendedor'){?> 
          <li class="has_sub"><a <?php if($active_view == 'vendedor')echo 'class="open"' ?> href="#"><i class="icon-list-alt"></i> Ventas  <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
            <ul>
              <li><a  href="<?php echo base_url()."pacientes/nuevo_paciente"?>" >Nuevo</a></li>
              <li><a  href="<?php echo base_url()."vendedores/home_vendedor"?>">Mis ventas</a></li>
            </ul>
          </li><?php } ?>  

          <!-- <li><a href="<?php echo base_url()."reportes/reporte_general"?>"><i class="icon-bar-chart"></i> Reportes</a></li> -->
          <!--<li><a href="forms.html"><i class="icon-tasks"></i> Configuración</a></li> -->
        </ul>
    </div>
    <div class="mainbar">
      <div class="matter">
        <div class="container">


