<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {

	public function __construct() {
        parent::__construct();

    }


	public function reporte_general()
	{
		$this->load->model('Pacientes_model');


		$pacientes_tipo = $this->Pacientes_model->get_pacientes_domiciliarios();

		foreach ($pacientes_tipo as $paciente) {
			if($paciente->domiciliario){
				$tipo= "Domiciliario";
			}
			else{
				$tipo= "Normal";
			}
			$data_d[] = array('name' => $tipo, 'y' => intval($paciente->numero) );
		}
		$pacientes_t[] =array("name"=> 'Tipo Atención', 'data'=>$data_d);

		$pacientes_contigo = $this->Pacientes_model->get_pacientes_contigo_agrupados();

		foreach ($pacientes_contigo as $paciente) {
			if($paciente->contigo){
				$tipo= "Contigo";
			}
			else{
				$tipo= "Normal";
			}
			$data_c[] = array('name' => $tipo, 'y' => intval($paciente->numero) );
		}
		$pacientes_c[] =array("name"=> 'Tipo paciente', 'data'=>$data_c);


		$datos['pacientes_por_tipo'] = json_encode($pacientes_t);
		$datos['pacientes_contigo'] = json_encode($pacientes_c);

		$datos['active_view'] = 'pacientes';


		$this->load->view('header.php');
		$this->load->view('navigation_admin.php', $datos);
		$this->load->view('reportes/reporte_general', $datos);
		$this->load->view('footer.php');
	}

	public function reporte_llamados()
	{
		$this->load->model('Pacientes_model');


		$encuestas_establecimiento = $this->Pacientes_model->get_pacientes_por_establecimiento();
		$encuestas_establecimiento_octubre = $this->Pacientes_model->get_pacientes_por_establecimiento_mes(10);
		$encuestas_establecimiento_noviembre = $this->Pacientes_model->get_pacientes_por_establecimiento_mes(11);
		$data_d = [];
		foreach ($encuestas_establecimiento as $encuesta) {

			$data_d[] = array('name' => $encuesta->nombre_establecimiento, 'y' => intval($encuesta->numero) );
		}
		$pacientes_t[] =array("name"=> 'Establecimiento', 'data'=>$data_d);
				$data_d = [];
		foreach ($encuestas_establecimiento_octubre as $encuesta) {
			$data_d[] = array('name' => $encuesta->nombre_establecimiento, 'y' => intval($encuesta->numero) );
		}
		$pacientes_octubre[] =array("name"=> 'Establecimiento', 'data'=>$data_d);

				$data_d = [];
		foreach ($encuestas_establecimiento_noviembre as $encuesta) {
			$data_d[] = array('name' => $encuesta->nombre_establecimiento, 'y' => intval($encuesta->numero) );
		}
		$pacientes_noviembre[] =array("name"=> 'Establecimiento', 'data'=>$data_d);

		$pacientes_contigo = $this->Pacientes_model->get_pacientes_contigo_agrupados();

		foreach ($pacientes_contigo as $paciente) {
			if($paciente->contigo){
				$tipo= "Contigo";
			}
			else{
				$tipo= "Normal";
			}
			$data_c[] = array('name' => $tipo, 'y' => intval($paciente->numero) );
		}
		$pacientes_c[] =array("name"=> 'Tipo paciente', 'data'=>$data_c);

		$datos['pacientes_octubre'] = json_encode($pacientes_octubre);
		$datos['pacientes_noviembre'] = json_encode($pacientes_noviembre);
		$datos['pacientes_por_tipo'] = json_encode($pacientes_t);
		$datos['pacientes_contigo'] = json_encode($pacientes_c);

		$datos['active_view'] = 'callcenter';

		$this->load->view('header.php');
		$this->load->view('navigation_admin.php', $datos);
		$this->load->view('reportes/reporte_llamados', $datos);
		$this->load->view('footer.php');
	}

}
