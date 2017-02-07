<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fichas extends CI_Controller {

	public function __construct() {
        parent::__construct();

    }


	public function nueva_ficha()
	{

		$this->load->model('Fichas_model');
		$this->load->model('Pacientes_model');

		$id_paciente            = $this->security->xss_clean(strip_tags($this->encrypt->decode(base64_decode($this->uri->segment(3)))));

		$datos['paciente'] = $this->Pacientes_model->get_paciente($id_paciente);
		$datos['isapres'] = $this->Fichas_model->get_isapres();

		$this->load->view('header.php');
		$this->load->view('navigation_admin.php');
		$this->load->view('fichas/nueva_ficha', $datos);
		$this->load->view('footer.php');
	}




}
