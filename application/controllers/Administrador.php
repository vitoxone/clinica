<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador extends CI_Controller {

	public function __construct() {
        parent::__construct();

        if (!$this->session->userdata('id_usuario'))
	    {
	      redirect(base_url());
	    }

    }

	public function index()
	{
		$this->load->view('header.php');
		$this->load->view('navigation_admin.php');
		$this->load->view('citas/calendario_citas');
		$this->load->view('footer.php');
	}

	/**
	 * Funcion que lista todos los hopitales que se ven en el registro de pacientes
	 * @return [type] Json               [description] retorna listado de hospitales con formato json
	 * @author vsilva
	 */
	public function listado_establecimientos(){
		$this->load->model('Fichas_model');

		$establecimientos = $this->Fichas_model->get_total_establecimientos();

		if($establecimientos){
			foreach ($establecimientos as $establecimiento) {
				$establecimientos_list[] = array('id_establecimiento' => $establecimiento->id_establecimiento, 'nombre' => $establecimiento->nombre, 'alias' => $establecimiento->alias, 'tipo' => $establecimiento->tipo, 'comuna' =>$establecimiento->nombre_comuna, 'region' =>$establecimiento->nombre_region);
			}

            $datos['establecimientos'] = json_encode($establecimientos_list);
        }
	    else{
	        $datos['establecimientos'] = '[]';
	    }

        $datos['active_view'] = 'configuraciones';

		$this->load->view('header.php');
		$this->load->view('navigation_admin.php', $datos);
		$this->load->view('administrador/listado_establecimientos', $datos);
		$this->load->view('footer.php');
	}

	public function set_alias_establecimiento(){

        $this->load->model('Fichas_model');

        $establecimiento        = $this->input->post('establecimiento');
        $id_establecimiento     = $establecimiento['id_establecimiento'] ;//?  $this->encrypt->decode(base64_decode($establecimiento['id_establecimiento'])) : false;
        $alias                  = $establecimiento['alias'];
        
        if($this->Fichas_model->set_alias_establecimiento($id_establecimiento, $alias)){
        
			$establecimientos = $this->Fichas_model->get_total_establecimientos();

			if($establecimientos){
				foreach ($establecimientos as $establecimiento) {
					$establecimientos_list[] = array('id_establecimiento' => $establecimiento->id_establecimiento, 'nombre' => $establecimiento->nombre, 'alias' => $establecimiento->alias, 'tipo' => $establecimiento->tipo, 'comuna' =>$establecimiento->nombre_comuna, 'region' =>$establecimiento->nombre_region);
				}

	           echo json_encode($establecimientos_list);
	        }
		    else{
		        echo '[]';
		    }
    	}
    }

}
