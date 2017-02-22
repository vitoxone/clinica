<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends CI_Controller {

	public function __construct() {
        parent::__construct();

    }


	public function mis_ventas()
	{
		$this->load->model('Ventas_model');

		$datos['ventas'] = $this->Ventas_model->get_ventas_usuario($this->session->userdata('id_usuario'));

		$this->load->view('header.php');
		$this->load->view('navigation_admin.php');
		$this->load->view('ventas/mis_ventas', $datos);
		$this->load->view('footer.php');
	}


}
