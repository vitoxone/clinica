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
		$this->load->helper('funciones'); 

		$fecha = date('Y-m-j');
		$actual =  strtotime ( $fecha ) ;
        $mes_actual = MesPalabra(date ( 'n' , $actual ));
        $nuevafecha = strtotime ( '-1 month' , strtotime ( $fecha ) ) ;
        $mes_pasado= MesPalabra(date ( 'm' , $nuevafecha ));


		$encuestas_establecimiento = $this->Pacientes_model->get_pacientes_por_establecimiento();
		$encuestas_establecimiento_mes_actual = $this->Pacientes_model->get_pacientes_por_establecimiento_mes();
		$encuestas_establecimiento_mes_pasado = $this->Pacientes_model->get_pacientes_por_establecimiento_mes_pasado();

		$encuestas_correccion_entrega = $this->Pacientes_model->get_pacientes_correccion_entrega();

		$data_d = [];
		foreach ($encuestas_establecimiento as $encuesta) {

			$data_d[] = array('name' => $encuesta->nombre_establecimiento, 'y' => intval($encuesta->numero) );
		}
		$pacientes_t[] =array("name"=> 'Establecimiento', 'data'=>$data_d);
		$data_d = [];
		foreach ($encuestas_establecimiento_mes_actual as $encuesta) {
			$data_d[] = array('name' => $encuesta->nombre_establecimiento, 'y' => intval($encuesta->numero) );
		}
		$pacientes_mes_actual[] =array("name"=> 'Establecimiento', 'data'=>$data_d);

		$data_d = [];
		foreach ($encuestas_establecimiento_mes_pasado as $encuesta) {
			$data_d[] = array('name' => $encuesta->nombre_establecimiento, 'y' => intval($encuesta->numero) );
		}
		$pacientes_mes_pasado[] =array("name"=> 'Establecimiento', 'data'=>$data_d);

		$pacientes_contigo = $this->Pacientes_model->get_pacientes_contigo_agrupados();
		$pacientes_contigo_encuestados = $this->Pacientes_model->get_pacientes_contigo_encuestados();

		foreach ($encuestas_correccion_entrega as $paciente) {
			if($paciente->correccion_entrega){
				$tipo= "Si";
			}
			else{
				$tipo= "No";
			}

			$data_correccion_entrega[] = array('name' => $tipo, 'y' => intval($paciente->numero) );
		}
		$pacientes_correccion_entrega[] =array("name"=> 'Corrección entrega', 'data'=>$data_correccion_entrega);

		foreach ($pacientes_contigo as $paciente) {
			if($paciente->contigo){
				$tipo= "Contigo";
			}
			else{
				$tipo= "Otros";
			}

			$data_c[] = array('name' => $tipo, 'y' => intval($paciente->numero) );
		}
		$pacientes_c[] =array("name"=> 'Tipo paciente', 'data'=>$data_c);

		foreach ($pacientes_contigo_encuestados as $paciente) {
			if($paciente->id_encuesta != null ){
				$tipo= "si";
			}
			else{
				$tipo= "No";
			}
			$data_encuestados[] = array('name' => $tipo, 'y' => intval($paciente->numero) );
		}
		$pacientes_contigo_encuestados[] =array("name"=> 'Encuestado', 'data'=>$data_encuestados);

		$datos['pacientes_contigo_encuestados'] = json_encode($pacientes_contigo_encuestados);
		$datos['pacientes_mes_pasado'] = json_encode($pacientes_mes_pasado);
		$datos['pacientes_mes_actual'] = json_encode($pacientes_mes_actual);
		$datos['pacientes_por_tipo'] = json_encode($pacientes_t);
		$datos['pacientes_contigo'] = json_encode($pacientes_c);
		$datos['pacientes_correccion_entrega'] = json_encode($pacientes_correccion_entrega);

		$datos['mes_actual'] = $mes_actual;
		$datos['mes_pasado'] = $mes_pasado;

		$datos['active_view'] = 'callcenter';

		$this->load->view('header.php');
		$this->load->view('navigation_admin.php', $datos);
		$this->load->view('reportes/reporte_llamados', $datos);
		$this->load->view('footer.php');
	}

}
