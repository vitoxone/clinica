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
        $this->load->model('Pacientes_model');
        $this->load->model('Regiones_model');
        $this->load->model('Fichas_model');
		$this->load->helper('funciones');

 
        if($this->encrypt->decode(base64_decode($this->uri->segment(3)))){
            $id_usuario = $this->encrypt->decode(base64_decode($this->uri->segment(3)));
        }
        else{
             $id_usuario = $this->session->userdata('id_usuario');
        }

        $tipos_documentos = $this->Pacientes_model->get_tipos_documentos();
        $regiones = $this->Regiones_model->get_regiones();
        $establecimientos = $this->Fichas_model->get_establecimientos();
     
        foreach($regiones as $region){
            $regiones_value[] = array('id_region' => base64_encode($this->encrypt->encode($region->id_region)), 'nombre' => $region->region);
        }
        //Se crea json de tipos documentos
        foreach($tipos_documentos as $tipo_documento){
            $tipos_documentos_value[] = array('id_tipo_documento' => $tipo_documento->id_tipo_documento_identificacion, 'nombre' => $tipo_documento->nombre);
        }

        foreach($establecimientos as $establecimiento){
            $establecimientos_list[] = array('id_establecimiento' => base64_encode($this->encrypt->encode($establecimiento->id_establecimiento)), 'nombre' => $establecimiento->nombre);
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

            $ventas_objetadas = $this->Pacientes_model->get_pacientes_objetados_vendedor($id_usuario);

            if($ventas_objetadas){
                foreach ($ventas_objetadas as $venta_objetada) {
                    $fecha_venta     = $venta_objetada->created;
                    $fecha_gmt_venta       = strtotime('-' . $huso_horario->valor . ' hour', strtotime($fecha_venta));
                    $fecha_venta_local = date($formato, $fecha_gmt_venta);
                    $ventas_objetadas_list[] = array('id_paciente' => base64_encode($this->encrypt->encode($venta_objetada->id_paciente)), 'rut_paciente' => $venta_objetada->rut, 'nombres_paciente' => $venta_objetada->nombres." ".$venta_objetada->apellido_paterno." ".$venta_objetada->apellido_materno ,'email_paciente' => $venta_objetada->email, 'fecha_venta'=>$fecha_venta_local, 'contigo' => $venta_objetada->contigo, 'domiciliario'=> $venta_objetada->domiciliario, 'corregido'=>$venta_objetada->corregido);
                }
                
                $datos['ventas_objetadas'] = json_encode($ventas_objetadas_list);
            }else{
                $datos['ventas_objetadas'] = '[]';
            }

            $ventas = $this->Ventas_model->get_ventas_usuario($id_usuario, 'all');

    		if($ventas){
    			foreach($ventas as $venta){
                    //se agrega huso horario a la fecha de venta
                    $fecha_venta     = $venta->created;
                    $fecha_gmt_venta       = strtotime('-' . $huso_horario->valor . ' hour', strtotime($fecha_venta));
                    $fecha_venta_local = $venta->fecha_venta;

                	$ventas_list[] = array('id_paciente' => base64_encode($this->encrypt->encode($venta->id_paciente)), 'id_paciente_vendedor' => $venta->id_paciente_vendedor, 'rut_paciente' => $venta->rut, 'nombres_paciente' => $venta->nombres." ".$venta->apellido_paterno." ".$venta->apellido_materno ,'email_paciente' => $venta->email, 'fecha_venta'=>$fecha_venta_local, 'contigo' => $venta->contigo, 'domiciliario'=> $venta->domiciliario);
                    
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

            $ventas_mensuales = $this->Ventas_model->ventas_mensuales_vendedor($id_usuario, 'all');
            $ventas_mensuales_contigo = $this->Ventas_model->ventas_mensuales_vendedor($id_usuario, 'contigo');
            $ventas_mensuales_pad = $this->Ventas_model->ventas_mensuales_vendedor($id_usuario, 'pad');
            $ventas_mensuales_otros = $this->Ventas_model->ventas_mensuales_vendedor($id_usuario, 'otros');

            $ventas_mensuales_list = [];
            $ventas_mensuales_list_contigo = [];
            $ventas_mensuales_list_pad = [];    
            $ventas_mensuales_list_otros = [];

            if($ventas_mensuales){
    			foreach($ventas_mensuales as $venta_mensual){
                	$ventas_mensuales_list[] = array('name' => MesPalabra($venta_mensual->periodo), 'drilldown'=> MesPalabra($venta_mensual->periodo), 'y' => intval($venta_mensual->numero_ventas));     																			
                }
                foreach($ventas_mensuales_contigo as $venta_mensual_contigo){
                    $ventas_mensuales_list_contigo[] = array('name' => MesPalabra($venta_mensual_contigo->periodo), 'drilldown'=> MesPalabra($venta_mensual_contigo->periodo), 'y' => intval($venta_mensual_contigo->numero_ventas));                                                                               
                }
                foreach($ventas_mensuales_pad as $venta_mensual_pad){
                    $ventas_mensuales_list_pad[] = array('name' => MesPalabra($venta_mensual_pad->periodo), 'drilldown'=> MesPalabra($venta_mensual_pad->periodo), 'y' => intval($venta_mensual_pad->numero_ventas));                                                                               
                }
                foreach($ventas_mensuales_otros as $venta_mensual_otro){
                    $ventas_mensuales_list_otros[] = array('name' => MesPalabra($venta_mensual_otro->periodo), 'drilldown'=> MesPalabra($venta_mensual_otro->periodo), 'y' => intval($venta_mensual_otro->numero_ventas));                                                                               
                }

                $series[] = array('name'=> 'Ventas', 'data' => $ventas_mensuales_list);
                $series[] = array('name'=> 'Contigo', 'data' => $ventas_mensuales_list_contigo);    
                $series[] = array('name'=> 'Pad', 'data' => $ventas_mensuales_list_pad);  
                $series[] = array('name'=> 'Otras', 'data' => $ventas_mensuales_list_otros);  

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
            $ventas_mensuales_contigo = $this->Ventas_model->ventas_mensuales_vendedor_zona_contigo($zona->id_zona);
            $ventas_mensuales_pad = $this->Ventas_model->ventas_mensuales_vendedor_zona_pad($zona->id_zona);
            $ventas_mensuales_otros = $this->Ventas_model->ventas_mensuales_vendedor_zona_otros($zona->id_zona);

            $ventas_mensuales_list_contigo = [];
            $ventas_mensuales_list = [];
            $ventas_mensuales_list_otros = [];

            if($ventas_mensuales){
                foreach($ventas_mensuales as $venta_mensual){
                    $ventas_mensuales_list[] = array('name' => MesPalabra($venta_mensual->periodo), 'drilldown'=> MesPalabra($venta_mensual->periodo), 'y' => intval($venta_mensual->numero_ventas));                                                                               
                }
                foreach($ventas_mensuales_contigo as $venta_mensual_contigo){
                    $ventas_mensuales_list_contigo[] = array('name' => MesPalabra($venta_mensual_contigo->periodo), 'drilldown'=> MesPalabra($venta_mensual_contigo->periodo), 'y' => intval($venta_mensual_contigo->numero_ventas));                                                                               
                }
                foreach($ventas_mensuales_pad as $venta_mensual_pad){
                    $ventas_mensuales_list_pad[] = array('name' => MesPalabra($venta_mensual_pad->periodo), 'drilldown'=> MesPalabra($venta_mensual_pad->periodo), 'y' => intval($venta_mensual_pad->numero_ventas));                                                                               
                }
                foreach($ventas_mensuales_otros as $venta_mensual_otro){
                    $ventas_mensuales_list_otros[] = array('name' => MesPalabra($venta_mensual_otro->periodo), 'drilldown'=> MesPalabra($venta_mensual_otro->periodo), 'y' => intval($venta_mensual_otro->numero_ventas));                                                                               
                }

                $series[] = array('name'=> 'Totales', 'data' => $ventas_mensuales_list);
                $series[] = array('name'=> 'Contigo', 'data' => $ventas_mensuales_list_contigo);    
                $series[] = array('name'=> 'Pad', 'data' => $ventas_mensuales_list_pad);  
                $series[] = array('name'=> 'Otras', 'data' => $ventas_mensuales_list_otros);  

                $datos['ventas_mensuales'] = json_encode($series);
            }else{
                $datos['ventas_mensuales'] = '[]';
            }

            $ventas_totales_por_vendedor = $this->Ventas_model->ventas_totales_zona_por_vendedor($zona->id_zona, 'all');
            $ventas_totales_por_vendedor_contigo = $this->Ventas_model->ventas_totales_zona_por_vendedor($zona->id_zona, 'contigo');
            $ventas_totales_por_vendedor_pad = $this->Ventas_model->ventas_totales_zona_por_vendedor($zona->id_zona, 'pad');
            $ventas_totales_por_vendedor_otros = $this->Ventas_model->ventas_totales_zona_por_vendedor($zona->id_zona, 'otros');

            $ventas_mensuales_por_vendedor_list_contigo = [];
            $ventas_mensuales_por_vendedor_list_list = [];
            $ventas_mensuales_por_vendedor_list_otros = [];

            if($ventas_totales_por_vendedor){
                foreach($ventas_totales_por_vendedor as $venta_total_por_vendedor){
                    $ventas_mensuales_por_vendedor_list[] = array('name' => $venta_total_por_vendedor->nombre." ".$venta_total_por_vendedor->apellido, 'y' => intval($venta_total_por_vendedor->numero_ventas));                                                                               
                }
                foreach($ventas_totales_por_vendedor_contigo as $venta_total_por_vendedor_contigo){
                    $ventas_mensuales_por_vendedor_list_contigo[] = array('name' => $venta_total_por_vendedor_contigo->nombre." ".$venta_total_por_vendedor_contigo->apellido, 'y' => intval($venta_total_por_vendedor_contigo->numero_ventas));                                                                               
                }
                foreach($ventas_totales_por_vendedor_pad as $venta_total_por_vendedor_pad){
                    $ventas_mensuales_por_vendedor_list_pad[] = array('name' => $venta_total_por_vendedor_pad->nombre." ".$venta_total_por_vendedor_pad->apellido, 'y' => intval($venta_total_por_vendedor_pad->numero_ventas));                                                                               
                }
                foreach($ventas_totales_por_vendedor_otros as $venta_total_por_vendedor_otro){
                    $ventas_mensuales_por_vendedor_list_otros[] = array('name' => $venta_total_por_vendedor_otro->nombre." ".$venta_total_por_vendedor_otro->apellido, 'y' => intval($venta_total_por_vendedor_otro->numero_ventas));                                                                               
                }

                $series_ventas_por_vendedor[] = array('name'=> 'Totales', 'data' => $ventas_mensuales_por_vendedor_list); 
                $series_ventas_por_vendedor[] = array('name'=> 'Contigo', 'data' => $ventas_mensuales_por_vendedor_list_contigo); 
                $series_ventas_por_vendedor[] = array('name'=> 'Pad', 'data' => $ventas_mensuales_por_vendedor_list_pad);  
                $series_ventas_por_vendedor[] = array('name'=> 'Otras', 'data' => $ventas_mensuales_por_vendedor_list_otros); 

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
        $datos['establecimientos']       = json_encode($establecimientos_list);
        $datos['regiones']               = json_encode($regiones_value);
        $datos['tipos_documentos']       = json_encode($tipos_documentos_value);


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
            $ventas_mensuales_contigo = $this->Ventas_model->ventas_mensuales_contigo();
            $ventas_mensuales_pad     = $this->Ventas_model->ventas_mensuales_pad();
            $ventas_mensuales_no     = $this->Ventas_model->ventas_mensuales_no();


            $ventas_totales_por_zona  = $this->Ventas_model->ventas_totales_por_zona();
            $ventas_contigo_por_zona  = $this->Ventas_model->ventas_contigo_por_zona();
            $ventas_pad_por_zona      = $this->Ventas_model->ventas_pad_por_zona();
            $ventas_otros_por_zona    = $this->Ventas_model->ventas_otros_por_zona();

            if($ventas_mensuales_totales){
                foreach($ventas_mensuales_totales as $venta_mensual){
                    $ventas_mensuales_list[] = array('name' => MesPalabra($venta_mensual->periodo), 'drilldown'=> MesPalabra($venta_mensual->periodo), 'y' => intval($venta_mensual->numero_ventas));                                                                               
                }
                foreach($ventas_mensuales_contigo as $venta_mensual_contigo){
                    $ventas_mensuales_contigo_list[] = array('name' => MesPalabra($venta_mensual_contigo->periodo), 'drilldown'=> MesPalabra($venta_mensual_contigo->periodo), 'y' => intval($venta_mensual_contigo->numero_ventas));                                                                               
                }
                foreach($ventas_mensuales_pad as $venta_mensual_pad){
                    $ventas_mensuales_pad_list[] = array('name' => MesPalabra($venta_mensual_pad->periodo), 'drilldown'=> MesPalabra($venta_mensual_pad->periodo), 'y' => intval($venta_mensual_pad->numero_ventas));                                                                               
                }

                foreach($ventas_mensuales_no as $venta_mensual_no){
                    $ventas_mensuales_no_list[] = array('name' => MesPalabra($venta_mensual_no->periodo), 'drilldown'=> MesPalabra($venta_mensual_no->periodo), 'y' => intval($venta_mensual_no->numero_ventas));                                                                               
                }

                $series[] = array('name'=> 'Totales', 'data' => $ventas_mensuales_list); 
                $series[] = array('name'=> 'Contigo', 'data' => $ventas_mensuales_contigo_list);  
                $series[] = array('name'=> 'Pad', 'data' => $ventas_mensuales_pad_list);  
                $series[] = array('name'=> 'Otros', 'data' => $ventas_mensuales_no_list); 

                $datos['ventas_mensuales'] = json_encode($series);
            }else{
                $datos['ventas_mensuales'] = '[]';
            }

            if($ventas_totales_por_zona){
                foreach($ventas_totales_por_zona as $venta_total_por_zona){
                    $ventas_mensuales_por_zona_list[] = array('name' => $venta_total_por_zona->nombre_zona, 'y' => intval($venta_total_por_zona->numero_ventas));                                                                               
                }

                foreach($ventas_contigo_por_zona as $venta_contigo_por_zona){
                    $ventas_contigo_por_zona_list[] = array('name' => $venta_contigo_por_zona->nombre_zona, 'y' => intval($venta_contigo_por_zona->numero_ventas));                                                                               
                }

                foreach($ventas_pad_por_zona as $venta_pad_por_zona){
                    $ventas_pad_por_zona_list[] = array('name' => $venta_pad_por_zona->nombre_zona, 'y' => intval($venta_pad_por_zona->numero_ventas));                                                                               
                }
                foreach($ventas_otros_por_zona as $venta_otro_por_zona){
                    $ventas_otros_por_zona_list[] = array('name' => $venta_otro_por_zona->nombre_zona, 'y' => intval($venta_otro_por_zona->numero_ventas));                                                                               
                }

                $series_ventas_por_zona[] = array('name'=> 'Totales', 'data' => $ventas_mensuales_por_zona_list);  
                $series_ventas_por_zona[] = array('name'=> 'Contigo', 'data' => $ventas_contigo_por_zona_list);   
                $series_ventas_por_zona[] = array('name'=> 'Pad', 'data' => $ventas_pad_por_zona_list); 
                $series_ventas_por_zona[] = array('name'=> 'Otros', 'data' => $ventas_otros_por_zona_list); 


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

    public function reportes()
    {
        $this->load->model('Ventas_model');
        $this->load->model('Usuarios_model');
        $this->load->model('Ventas_model');
        $this->load->helper('funciones');

        $listado_vendedores = $this->Ventas_model->get_vendedores();
        if($listado_vendedores){
            foreach ($listado_vendedores as $vendedor) {
                $vendedores_list[] = array('id_usuario'=>base64_encode($this->encrypt->encode($vendedor->id_usuario)), 'id_profesional' => base64_encode($this->encrypt->encode($vendedor->id_profesional)),'rut' => $vendedor->rut, 'nombre'=> $vendedor->nombres." ".$vendedor->apellido_paterno." ".$vendedor->apellido_materno);
                $ids_vendedores[] = $vendedor->id_usuario;
            }
        }else{
            $vendedores_list = '[]';
        }
        $datos['vendedores'] = json_encode($vendedores_list);

        $datos['active_view'] = 'vendedor';

        $this->load->view('header.php');
        $this->load->view('navigation_admin.php', $datos);
        $this->load->view('vendedores/reportes', $datos);
        $this->load->view('footer.php');
    }
    function get_reporte()
    {
        $this->load->model('Ventas_model');
        $this->load->model('Usuarios_model');
        $this->load->model('Ventas_model');
        $this->load->helper('funciones');

        $reporte = $this->input->post('reporte');

        $vendedores = isset($reporte['vendedor']) ?  $reporte['vendedor'] : false;
        $fecha_inicio = isset($reporte['fecha_inicio']) ?  $reporte['fecha_inicio'] : false;
        $fecha_fin = isset($reporte['fecha_fin']) ?  $reporte['fecha_fin'] : false;
        $tipo = isset($reporte['tipo']) ?  $reporte['tipo'] : false;
        $zona = isset($reporte['zona']) ?  $reporte['zona'] : false;

        $contigo = isset($reporte['contigo']) ?  $reporte['contigo'] : "false";
        $domiciliario = isset($reporte['domiciliario']) ?  $reporte['domiciliario'] : "false";

        if($contigo == "true"){
            $contigo = 1;
        }else{
            $contigo = 0;
        }
        if($domiciliario == "true"){
            $domiciliario = 1;
        }else{
            $domiciliario = 0;
        }

        if($zona){
            if($zona == 'todas'){
                $zonas = [1,2];
            }else{
                $zonas[] = $zona;
            }
        }else{
            $zonas = [];
        }

        $vendedores_list = [];
        $result_list = [];
        if($vendedores){
            foreach ($vendedores as $vendedor) {
                $vendedores_list[] = $this->encrypt->decode(base64_decode($vendedor['id_usuario']));
            }
        }
        if($tipo == 2){
            $busquedas = $this->Ventas_model->get_reporte_pacientes($fecha_inicio, $fecha_fin, $vendedores_list, $contigo, $domiciliario);

            if($busquedas){
                foreach ($busquedas as $busqueda) {
                    $result_list[] = array('id_paciente'=>base64_encode($this->encrypt->encode($busqueda->id_paciente)),'rut' => $busqueda->rut, 'nombre'=> $busqueda->nombres." ".$busqueda->apellido_paterno." ".$busqueda->apellido_materno, 'fecha_registro'=>$busqueda->fecha_registro, 'nombre_vendedor'=>$busqueda->nombre_vendedor." ".$busqueda->apellido_vendedor);

                }
            }
        }
        elseif($tipo == 1){
            $busquedas = $this->Ventas_model->get_reporte_vendedores($fecha_inicio, $fecha_fin, $vendedores_list, $contigo, $domiciliario);

            if($busquedas){
                foreach ($busquedas as $busqueda) {
                    $result_list[] = array('id_vendedor'=>base64_encode($this->encrypt->encode($busqueda->id_usuario)),'rut' => $busqueda->rut, 'nombre_vendedor'=>$busqueda->nombre_vendedor." ".$busqueda->apellido_vendedor, 'cantidad_ventas'=>$busqueda->cantidad_ventas);

                }
            }
        }

        echo json_encode($result_list);
    }

    public function get_vendedores(){
        $this->load->model('Ventas_model');

        $listado_vendedores = $this->Ventas_model->get_vendedores();

        if($listado_vendedores){
            foreach ($listado_vendedores as $vendedor) {
                $vendedores_list[] = array('id_usuario'=>base64_encode($this->encrypt->encode($vendedor->id_usuario)), 'id_profesional' => base64_encode($this->encrypt->encode($vendedor->id_profesional)),'rut' => $vendedor->rut, 'nombre'=> $vendedor->nombres." ".$vendedor->apellido_paterno." ".$vendedor->apellido_materno);
            }
        }else{
            $vendedores_list = '[]';
        }

        echo json_encode($vendedores_list);
    }
}
