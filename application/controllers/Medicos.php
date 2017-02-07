<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medicos extends CI_Controller {

	public function __construct() {
        parent::__construct();

    }


	public function index()
	{
		$this->load->view('header.php');
		$this->load->view('navigation_admin.php');
		$this->load->view('administrador/home');
		$this->load->view('footer.php');
	}

	public function listado_medicos()
	{

		$this->load->model('Medicos_model');


		$datos['medicos'] = $this->Medicos_model->get_medicos();


		$this->load->view('header.php');
		$this->load->view('navigation_admin.php');
		$this->load->view('medicos/listado_medicos', $datos);
		$this->load->view('footer.php');
	}

    public function listado_enfermeras_activas()
    {

        $this->load->model('Medicos_model');


        $datos['medicos'] = $this->Medicos_model->get_enfermeras_activas();
        var_dump($datos['medicos']); die();


        $this->load->view('header.php');
        $this->load->view('navigation_admin.php');
        $this->load->view('medicos/listado_medicos', $datos);
        $this->load->view('footer.php');
    }

    public function set_nuevo_medico(){

        $this->load->model('Medicos_model');

        $medico = $this->input->post('medico');
        $id_establecimiento     = isset($medico['establecimiento']) ?  $this->encrypt->decode(base64_decode($medico['establecimiento']['id_establecimiento'])) : false;
        $id_especialidad        = isset($medico['especialidad']) ?  $this->encrypt->decode(base64_decode($medico['especialidad']['id_especialidad'])) : false;
        $nombres                = $medico['nombres'];
        $id_establecimiento_seleccionado = $this->encrypt->decode(base64_decode($this->input->post('establecimiento')));

        $id_medico = $this->Medicos_model->set_nuevo_medico($id_establecimiento, $nombres, $id_especialidad);
        
        //se obtienen todos los medicos del establecimiento previamente seleccionado
        $medicos = $this->Medicos_model->get_medicos_establecimiento($id_establecimiento_seleccionado);

        if($medicos){
            foreach($medicos as $medico){
                $medicos_value[] = array('id_medico' => base64_encode($this->encrypt->encode($medico->id_medico)), 'nombres' => $medico->nombres);
            }
            echo json_encode($medicos_value);
        }
    }

	public function get_medicos_especialidad()
    {
        $this->load->model('Medicos_model');

        $id_especialidad = $this->encrypt->decode(base64_decode($this->input->post('especialidad')));

        $profesionales = $this->Medicos_model->get_medicos();

        $i  = 0;
        foreach ($profesionales as $profesional)
        {
            $profesionales[$i]->id_profesional = base64_encode($this->encrypt->encode($profesional->id_profesional));
            $profesionales[$i]->nombre   = $profesional->nombre.' '.$profesional->apellido_paterno.' '.$profesional->apellido_materno;
            ++$i;
        }

       // $datos['profesionales'] = $profesionales;

        echo json_encode($profesionales);
    }

    public function get_medicos_establecimiento()
    {
        $this->load->model('Medicos_model');

        $id_establecimiento = $this->encrypt->decode(base64_decode($this->input->post('establecimiento')));

        $medicos = $this->Medicos_model->get_medicos_establecimiento($id_establecimiento);

        if($medicos){
            foreach($medicos as $medico){
                $medicos_value[] = array('id_medico' => base64_encode($this->encrypt->encode($medico->id_medico)), 'nombres' => $medico->nombres);
            }
            echo json_encode($medicos_value);
        }
    }

   	public function get_profesional()
    {
        $this->load->model('Medicos_model');

        $id_profesional = $this->encrypt->decode(base64_decode($this->input->post('profesional')));

        $profesional = $this->Medicos_model->get_profesional($id_profesional);


       // $datos['profesionales'] = $profesionales;

        echo json_encode($profesional);
    }

}
