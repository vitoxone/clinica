<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendedores extends CI_Controller {

	public function __construct() {
        parent::__construct();

    }


	public function home_vendedor()
	{
		$this->load->model('Ventas_model');
		$this->load->helper('funciones');

 
        if($this->encrypt->decode(base64_decode($this->uri->segment(3)))){
            $id_usuario = $this->encrypt->decode(base64_decode($this->uri->segment(3)));
        }
        else{
             $id_usuario = $this->session->userdata('id_usuario');
        }
		$ventas = $this->Ventas_model->get_ventas_usuario($id_usuario);

		$ventas_list = [];
		$nro_ventas_contigo = 0;
		$nro_ventas_domiciliario = 0;
		if($ventas){
			foreach($ventas as $venta){
            	$ventas_list[] = array('id_paciente_vendedor' => $venta->id_paciente_vendedor, 'rut_paciente' => $venta->rut, 'nombres_paciente' => $venta->nombres." ".$venta->apellido_paterno." ".$venta->apellido_materno ,'email_paciente' => $venta->email, 'fecha_venta'=>$venta->created, 'contigo' => $venta->contigo, 'domiciliario'=> $venta->domiciliario);
                
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

		$this->load->view('header.php');
		$this->load->view('navigation_admin.php');
		$this->load->view('vendedores/home_vendedor', $datos);
		$this->load->view('footer.php');
	}


}
