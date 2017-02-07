<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador extends CI_Controller {

	public function __construct() {
        parent::__construct();

    }


	public function index()
	{
		$this->load->view('header.php');
		$this->load->view('navigation_admin.php');
		$this->load->view('citas/calendario_citas');
		$this->load->view('footer.php');
	}

}
