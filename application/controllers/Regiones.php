<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Regiones extends CI_Controller {

	public function __construct() {
        parent::__construct();

    }


    public function get_comunas_region()
    {
        $this->load->model('Regiones_model');

        $id_region = $this->encrypt->decode(base64_decode($this->input->post('region')));

        $comunas = $this->Regiones_model->get_comunas_by_region($id_region);
        if($comunas){
            foreach ($comunas as $comuna)
            {
                 $comunas_values[] = array('id_comuna' => base64_encode($this->encrypt->encode($comuna->id)), 'nombre' => $comuna->comuna);
            }
            echo json_encode($comunas_values);
        }else{
            echo '{}';
        }

    }

}
