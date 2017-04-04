<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendedores extends CI_Controller {

	public function __construct() {
        parent::__construct();

        if (!$this->session->userdata('id_usuario'))
        {
            redirect(base_url());
        }

    }
	public function home_vendedor()
	{
		$this->load->model('Ventas_model');
        $this->load->model('Usuarios_model');
        $this->load->model('Ventas_model');
		$this->load->helper('funciones');

 
        if($this->encrypt->decode(base64_decode($this->uri->segment(3)))){
            $id_usuario = $this->encrypt->decode(base64_decode($this->uri->segment(3)));
        }
        else{
             $id_usuario = $this->session->userdata('id_usuario');
        }

        $huso_horario = $this->Usuarios_model->get_huso_horario_usuario($id_usuario);

        $zonas_vendedor = $this->Ventas_model->get_zonas_vendedor($id_usuario);

        $ventas_list = [];
        $nro_ventas_contigo = 0;
        $nro_ventas_domiciliario = 0;
        $formato = 'Y-m-d H:i';

        foreach ($zonas_vendedor as $zona_vendedor) {
            switch ($zona_vendedor->id_rol_profesional_zona) {
                case '1':
                    $rol = 'gerente';
                    break;
                case '2':
                    $rol = 'supervisor';
                    break;    
                
                default:
                    $rol = 'vendedor';
                    break;
            }
        }

        if($rol == 'vendedor'){

            $ventas = $this->Ventas_model->get_ventas_usuario($id_usuario);
    		if($ventas){
    			foreach($ventas as $venta){

                    //se agrega huso horario a la fecha de venta
                    $fecha_venta     = $venta->created;
                    $fecha_gmt_venta       = strtotime('-' . $huso_horario->valor . ' hour', strtotime($fecha_venta));
                    $fecha_venta_local = date($formato, $fecha_gmt_venta);

                	$ventas_list[] = array('id_paciente_vendedor' => $venta->id_paciente_vendedor, 'rut_paciente' => $venta->rut, 'nombres_paciente' => $venta->nombres." ".$venta->apellido_paterno." ".$venta->apellido_materno ,'email_paciente' => $venta->email, 'fecha_venta'=>$fecha_venta_local, 'contigo' => $venta->contigo, 'domiciliario'=> $venta->domiciliario);
                    
                    if($venta->contigo){
                    	$nro_ventas_contigo++;
                    }
                     if($venta->domiciliario){
                    	$nro_ventas_domiciliario++;
                    }      																			
                }
               	$datos['ventas'] = json_encode($ventas_list);
            }else{
            	$datos['ventas'] = '[]';
            }

            $ventas_mensuales = $this->Ventas_model->ventas_mensuales_vendedor($id_usuario );

            if($ventas_mensuales){
    			foreach($ventas_mensuales as $venta_mensual){
                	$ventas_mensuales_list[] = array('name' => MesPalabra($venta_mensual->periodo), 'drilldown'=> MesPalabra($venta_mensual->periodo), 'y' => intval($venta_mensual->numero_ventas));     																			
                }

                $series[] = array('name'=> 'Ventas', 'data' => $ventas_mensuales_list);  

               	$datos['ventas_mensuales'] = json_encode($series);
            }else{
            	$datos['ventas_mensuales'] = '[]';
            }
            $datos['nro_ventas_contigo'] = $nro_ventas_contigo;
            $datos['nro_ventas_domiciliario'] = $nro_ventas_domiciliario;
        }
        

        if($rol == 'supervisor' && $zonas_vendedor){

            $zona = $zonas_vendedor[0];
                
            $listado_vendedores = $this->Ventas_model->get_vendedores_zona($zona->id_zona);

            if($listado_vendedores){
                foreach ($listado_vendedores as $vendedor) {
                    $rol_zona = $vendedor->id_rol_profesional_zona == 2 ? ' (SUPERVISOR)' : ''; 
                    $vendedores_list[] = array('id_usuario'=>base64_encode($this->encrypt->encode($vendedor->id_usuario)), 'id_profesional' => base64_encode($this->encrypt->encode($vendedor->id_profesional)),'rut' => $vendedor->rut, 'nombre'=> $vendedor->nombres." ".$vendedor->apellido_paterno." ".$vendedor->apellido_materno.$rol_zona);
                    $ids_vendedores[] = $vendedor->id_usuario;
                }
            }else{
                $vendedores_list = '[]';
            }
            //se obtienen las ventas totales de todos los vendedores de la zona
            $ventas = $this->Ventas_model->get_ventas_usuario($ids_vendedores);

            if($ventas){
                foreach($ventas as $venta){

                    //se agrega huso horario a la fecha de venta
                    $fecha_venta     = $venta->created;
                    $fecha_gmt_venta       = strtotime('-' . $huso_horario->valor . ' hour', strtotime($fecha_venta));
                    $fecha_venta_local = date($formato, $fecha_gmt_venta);

                    $ventas_list[] = array('id_paciente_vendedor' => $venta->id_paciente_vendedor, 'rut_paciente' => $venta->rut, 'nombres_paciente' => $venta->nombres." ".$venta->apellido_paterno." ".$venta->apellido_materno ,'email_paciente' => $venta->email, 'fecha_venta'=>$fecha_venta_local, 'contigo' => $venta->contigo, 'domiciliario'=> $venta->domiciliario);
                    
                    if($venta->contigo){
                        $nro_ventas_contigo++;
                    }
                     if($venta->domiciliario){
                        $nro_ventas_domiciliario++;
                    }                                                                               
                }
                $datos['ventas'] = json_encode($ventas_list);
            }else{
                $datos['ventas'] = '[]';
            }

            $ventas_mensuales = $this->Ventas_model->ventas_mensuales_vendedor_zona($zona->id_zona);
            $ventas_totales_por_vendedor = $this->Ventas_model->ventas_totales_zona_por_vendedor($zona->id_zona);

            if($ventas_mensuales){
                foreach($ventas_mensuales as $venta_mensual){
                    $ventas_mensuales_list[] = array('name' => MesPalabra($venta_mensual->periodo), 'drilldown'=> MesPalabra($venta_mensual->periodo), 'y' => intval($venta_mensual->numero_ventas));                                                                               
                }

                $series[] = array('name'=> 'Ventas', 'data' => $ventas_mensuales_list);  

                $datos['ventas_mensuales'] = json_encode($series);
            }else{
                $datos['ventas_mensuales'] = '[]';
            }

            if($ventas_totales_por_vendedor){
                foreach($ventas_totales_por_vendedor as $venta_total_por_vendedor){
                    $ventas_mensuales_por_vendedor_list[] = array('name' => $venta_total_por_vendedor->nombre." ".$venta_total_por_vendedor->apellido, 'y' => intval($venta_total_por_vendedor->numero_ventas));                                                                               
                }

                $series_ventas_por_vendedor[] = array('name'=> 'Ventas', 'data' => $ventas_mensuales_por_vendedor_list);  

                $datos['ventas_totales_por_vendedor'] = json_encode($series_ventas_por_vendedor);
            }else{
                $datos['ventas_totales_por_vendedor'] = '[]';
            }

            $datos['nro_ventas_contigo'] = $nro_ventas_contigo;
            $datos['nro_ventas_domiciliario'] = $nro_ventas_domiciliario;
           
            $datos['zona_supervisor'] = json_encode(array('id_zona'  => $zona->id_zona, 'nombre_zona' => $zona->nombre_zona, 'vendedores'=>$vendedores_list));
        }

        if($rol == 'gerente' && $zonas_vendedor){

            $zona = $zonas_vendedor;
                
            $listado_vendedores = $this->Ventas_model->get_vendedores();

            if($listado_vendedores){
                foreach ($listado_vendedores as $vendedor) {
                    $vendedores_list[] = array('id_usuario'=>base64_encode($this->encrypt->encode($vendedor->id_usuario)), 'id_profesional' => base64_encode($this->encrypt->encode($vendedor->id_profesional)),'rut' => $vendedor->rut, 'nombre'=> $vendedor->nombres." ".$vendedor->apellido_paterno." ".$vendedor->apellido_materno);
                    $ids_vendedores[] = $vendedor->id_usuario;
                }
            }else{
                $vendedores_list = '[]';
            }

            //se obtienen las ventas totales de todos los vendedores de la zona
            $ventas = $this->Ventas_model->get_ventas_usuario($ids_vendedores);

            if($ventas){
                foreach($ventas as $venta){

                    //se agrega huso horario a la fecha de venta
                    $fecha_venta     = $venta->created;
                    $fecha_gmt_venta       = strtotime('-' . $huso_horario->valor . ' hour', strtotime($fecha_venta));
                    $fecha_venta_local = date($formato, $fecha_gmt_venta);

                    $ventas_list[] = array('id_paciente_vendedor' => $venta->id_paciente_vendedor, 'rut_paciente' => $venta->rut, 'nombres_paciente' => $venta->nombres." ".$venta->apellido_paterno." ".$venta->apellido_materno ,'email_paciente' => $venta->email, 'fecha_venta'=>$fecha_venta_local, 'contigo' => $venta->contigo, 'domiciliario'=> $venta->domiciliario);
                    
                    if($venta->contigo){
                        $nro_ventas_contigo++;
                    }
                     if($venta->domiciliario){
                        $nro_ventas_domiciliario++;
                    }                                                                               
                }
                $datos['ventas'] = json_encode($ventas_list);
            }else{
                $datos['ventas'] = '[]';
            }

            $ventas_mensuales_totales = $this->Ventas_model->ventas_mensuales_totales();
            $ventas_totales_por_zona = $this->Ventas_model->ventas_totales_por_zona();

            if($ventas_mensuales_totales){
                foreach($ventas_mensuales_totales as $venta_mensual){
                    $ventas_mensuales_list[] = array('name' => MesPalabra($venta_mensual->periodo), 'drilldown'=> MesPalabra($venta_mensual->periodo), 'y' => intval($venta_mensual->numero_ventas));                                                                               
                }

                $series[] = array('name'=> 'Ventas', 'data' => $ventas_mensuales_list);  

                $datos['ventas_mensuales'] = json_encode($series);
            }else{
                $datos['ventas_mensuales'] = '[]';
            }

            if($ventas_totales_por_zona){
                foreach($ventas_totales_por_zona as $venta_total_por_zona){
                    $ventas_mensuales_por_zona_list[] = array('name' => $venta_total_por_zona->nombre_zona, 'y' => intval($venta_total_por_zona->numero_ventas));                                                                               
                }

                $series_ventas_por_zona[] = array('name'=> 'Ventas', 'data' => $ventas_mensuales_por_zona_list);  

                $datos['ventas_totales_por_zona'] = json_encode($series_ventas_por_zona);
            }else{
                $datos['ventas_totales_por_zona'] = '[]';
            }

            $datos['nro_ventas_contigo'] = $nro_ventas_contigo;
            $datos['nro_ventas_domiciliario'] = $nro_ventas_domiciliario;
           
            $datos['vendedores'] = json_encode($vendedores_list);

            if($zonas_vendedor){
                foreach($zonas_vendedor as $zona_vendedor){
                    $id_supervisor_zona = $this->Ventas_model->get_supervisor_zona($zona_vendedor->id_zona)->id_usuario;
                    $zonas_vendedor_list[] = array('id_supervisor_zona' =>base64_encode($this->encrypt->encode($id_supervisor_zona)), 'nombre' => $zona_vendedor->nombre_zona);                                                                               
                } 

                $datos['zonas_vendedor'] = json_encode($zonas_vendedor_list);
            }else{
                $datos['zonas_vendedor'] = '[]';
            }
        }

        $datos['active_view'] = 'vendedor';

		$this->load->view('header.php');
		$this->load->view('navigation_admin.php', $datos);

        if($rol == 'vendedor'){
            $this->load->view('vendedores/home_vendedor', $datos);
        }
        if($rol == 'supervisor'){
            $this->load->view('vendedores/home_supervisor', $datos);
        }
        if($rol == 'gerente'){
            $this->load->view('vendedores/home_gerente', $datos);
        }

		$this->load->view('footer.php');
	}

    public function reportes_ventas()
    {
        $this->load->model('Ventas_model');
        $this->load->model('Usuarios_model');
        $this->load->model('Ventas_model');
        $this->load->helper('funciones');

        $zonas_vendedor = $this->Ventas_model->get_zonas_activas();

        $ventas_list = [];
        $nro_ventas_contigo = 0;
        $nro_ventas_domiciliario = 0;

        if($zonas_vendedor){

            $listado_vendedores = $this->Ventas_model->get_vendedores();


            if($listado_vendedores){
                foreach ($listado_vendedores as $vendedor) {
                    $vendedores_list[] = array('id_usuario'=>base64_encode($this->encrypt->encode($vendedor->id_usuario)), 'id_profesional' => base64_encode($this->encrypt->encode($vendedor->id_profesional)),'rut' => $vendedor->rut, 'nombre'=> $vendedor->nombres." ".$vendedor->apellido_paterno." ".$vendedor->apellido_materno);
                    $ids_vendedores[] = $vendedor->id_usuario;
                }
            }else{
                $vendedores_list = '[]';
            }
            //se obtienen las ventas totales de todos los vendedores de la zona
            $ventas = $this->Ventas_model->get_ventas_usuario($ids_vendedores);

            if($ventas){
                foreach($ventas as $venta){

                    $ventas_list[] = array('id_paciente_vendedor' => $venta->id_paciente_vendedor, 'rut_paciente' => $venta->rut, 'nombres_paciente' => $venta->nombres." ".$venta->apellido_paterno." ".$venta->apellido_materno ,'email_paciente' => $venta->email, 'contigo' => $venta->contigo, 'domiciliario'=> $venta->domiciliario);
                    
                    if($venta->contigo){
                        $nro_ventas_contigo++;
                    }
                     if($venta->domiciliario){
                        $nro_ventas_domiciliario++;
                    }                                                                               
                }
                $datos['ventas'] = json_encode($ventas_list);
            }else{
                $datos['ventas'] = '[]';
            }

            $ventas_mensuales_totales = $this->Ventas_model->ventas_mensuales_totales();
            $ventas_totales_por_zona = $this->Ventas_model->ventas_totales_por_zona();

            if($ventas_mensuales_totales){
                foreach($ventas_mensuales_totales as $venta_mensual){
                    $ventas_mensuales_list[] = array('name' => MesPalabra($venta_mensual->periodo), 'drilldown'=> MesPalabra($venta_mensual->periodo), 'y' => intval($venta_mensual->numero_ventas));                                                                               
                }

                $series[] = array('name'=> 'Ventas', 'data' => $ventas_mensuales_list);  

                $datos['ventas_mensuales'] = json_encode($series);
            }else{
                $datos['ventas_mensuales'] = '[]';
            }

            if($ventas_totales_por_zona){
                foreach($ventas_totales_por_zona as $venta_total_por_zona){
                    $ventas_mensuales_por_zona_list[] = array('name' => $venta_total_por_zona->nombre_zona, 'y' => intval($venta_total_por_zona->numero_ventas));                                                                               
                }

                $series_ventas_por_zona[] = array('name'=> 'Ventas', 'data' => $ventas_mensuales_por_zona_list);  

                $datos['ventas_totales_por_zona'] = json_encode($series_ventas_por_zona);
            }else{
                $datos['ventas_totales_por_zona'] = '[]';
            }

            $datos['nro_ventas_contigo'] = $nro_ventas_contigo;
            $datos['nro_ventas_domiciliario'] = $nro_ventas_domiciliario;
           
            $datos['vendedores'] = json_encode($vendedores_list);

            if($zonas_vendedor){
                foreach($zonas_vendedor as $zona_vendedor){
                    $id_supervisor_zona = $this->Ventas_model->get_supervisor_zona($zona_vendedor->id_zona)->id_usuario;
                    $zonas_vendedor_list[] = array('id_supervisor_zona' =>base64_encode($this->encrypt->encode($id_supervisor_zona)), 'nombre' => $zona_vendedor->nombre_zona);                                                                               
                } 

                $datos['zonas_vendedor'] = json_encode($zonas_vendedor_list);
            }else{
                $datos['zonas_vendedor'] = '[]';
            }
        }

        $datos['active_view'] = 'vendedor';

        $this->load->view('header.php');
        $this->load->view('navigation_admin.php', $datos);
        $this->load->view('vendedores/home_gerente', $datos);

        $this->load->view('footer.php');
    }


}
