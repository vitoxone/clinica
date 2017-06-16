<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller {

	public function __construct() {
        parent::__construct();

        if (!$this->session->userdata('id_usuario'))
        {
            redirect(base_url());
        }

    }


	public function agenda()
	{
		$this->load->model('Medicos_model');
		$this->load->model('Citas_model');
        $this->load->model('Fichas_model');
        $this->load->model('Pacientes_model');


        $profesional = $this->Medicos_model->get_profesional_usuario($this->session->userdata('id_usuario'));

        if($profesional->especialidad == 'Enfermera PAD'){

            $enfermeras = $this->Medicos_model->get_enfermera_session($profesional->id_profesional);
            $datos['modo_agenda'] = 'atencion';
        }
        else{
            $enfermeras = $this->Medicos_model->get_enfermeras_activas();
            $datos['modo_agenda'] = 'registro';
        }

        if($profesional->especialidad ==  'Técnico enfermería'){
            $datos['modo_agenda'] = 'visualizar';
        }


        foreach ($enfermeras as $enfermera) {
            $ids_enfermeras[] = $enfermera->id_profesional;
        }

        $citas = $this->Citas_model->get_citas($ids_enfermeras);
        $tipos_atenciones = $this->Fichas_model->get_tipos_atenciones_activas();

        if($tipos_atenciones){
            foreach($tipos_atenciones as $tipo_atencion){
                $tipos_atenciones_list[] = array('id_tipo_atencion' => base64_encode($this->encrypt->encode($tipo_atencion->id_tipo_atencion)), 'nombre' => $tipo_atencion->nombre);
                                                                                                
            }
        }else{
            $tipos_atenciones_list[] = '{}';
        }

        if($enfermeras){
        	foreach($enfermeras as $enfermera){
            	$enfermeras_list[] = array('id_usuario' => base64_encode($this->encrypt->encode($enfermera->id_usuario)), 'nombres' => $enfermera->nombre." ".$enfermera->apellido_paterno." ".$enfermera->apellido_materno, 'color' =>$enfermera->color);
                     																			
            }
        }else{
        	$enfermeras_list[] = '{}';
        }
        $datos['enfermeras'] = json_encode($enfermeras_list);

        $actions[] =  array('label' => '<i class=\'glyphicon glyphicon-pencil\'></i>', 'onClick' => 'function(args) { show("Edited", args.calendarEvent);}');
        $actions[] =  array('label'=> '<i class=\'glyphicon glyphicon-remove\'></i>', 'onClick' => 'function(args) {show("Deleted", args.calendarEvent);}');
        if($citas){
        	foreach($citas as $cita){
                if($cita->profesional == $profesional->id_profesional){
                    $ir_cita = true;
                }
                else{
                    $ir_cita = false;
                }
                $color = array('primary'=> $cita->color_calendario, 'secondary'=>$cita->color_calendario);
            	$citas_list[] = array('id_cita' => $cita->id_cita, 'title' =>$cita->nombre_tipo_atencion." - ".$cita->nombre_paciente." ".$cita->apellido_paciente, 'startsAt'=>$cita->fecha_inicio, 'endsAt'=>$cita->fecha_fin, 'color' => $color, 'draggable'=> true, 'ir_cita'=>$ir_cita);
                     																			
            }
        }else{
        	$citas_list[] = false;
        }
        $pacientes = $this->Pacientes_model->get_pacientes();
        if($pacientes){
            foreach($pacientes as $paciente){
                $pacientes_list[] = array('id_paciente' =>  base64_encode($this->encrypt->encode($paciente->id_paciente)), 'nombre' => $paciente->nombres. " ".$paciente->apellido_paterno." ".$paciente->apellido_materno,'rut'=>$paciente->rut, 'contigo'=>$paciente->contigo, 'diagnostico'=>$paciente->diagnostico, 'domiciliario'=>$paciente->domiciliario, 'activo'=>$paciente->activo, 'fecha_registro'=>$paciente->created);
            }
        }else{
            $pacientes_list[] = '{}';
        }
        if(count($citas_list) > 0){
            $datos['citas'] = json_encode($citas_list);  
        }else{
            $datos['citas']= $citas_list;
        }

        $datos['enfermeras'] = json_encode($enfermeras_list);
        $datos['tipos_atenciones'] = json_encode($tipos_atenciones_list);
        $datos['pacientes'] = json_encode($pacientes_list);

        $datos['active_view'] = 'agenda';


		$this->load->view('header.php');
		$this->load->view('navigation_admin.php', $datos);
		$this->load->view('citas/agenda', $datos);
		$this->load->view('footer.php');
	}

    public function eliminar_cita()
    {
        $this->load->model('Citas_model');
        $this->load->model('Medicos_model');

        $cita = $this->input->post('cita');

        if(isset($cita['id_cita'])){
            $id_cita = $cita['id_cita'];
            $cita_antigua = $this->Citas_model->get_cita($id_cita);
            if($cita_antigua){
                $this->Citas_model->delete_cita($cita_antigua->id_cita);
            }

        }

        $profesional = $this->Medicos_model->get_profesional_usuario($this->session->userdata('id_usuario'));

        if($profesional->especialidad == 'Enfermera PAD' or $profesional->especialidad == 'Enfermera clínica' or $profesional->especialidad ==  'Técnico enfermería' ){

            $enfermeras = $this->Medicos_model->get_enfermera_session($profesional->id_profesional);
        }
        else{
            $enfermeras = $this->Medicos_model->get_enfermeras_activas();
        }


        foreach ($enfermeras as $enfermera) {
            $ids_enfermeras[] = $enfermera->id_profesional;
        }

        $citas = $this->Citas_model->get_citas($ids_enfermeras);

        if($citas){
            foreach($citas as $cita){
                $color = array('primary'=> $cita->color_calendario, 'secondary'=>$cita->color_calendario);
                $citas_list[] = array('id_cita' => $cita->id_cita, 'title' =>$cita->nombre_tipo_atencion." - ".$cita->nombre_paciente, 'startsAt'=>$cita->fecha_inicio, 'endsAt'=>$cita->fecha_fin, 'color' => $color, 'draggable'=> true);
                                                                                                
            }
        }else{
            $citas_list[] = false;
        }

        if($citas_list){
            echo json_encode($citas_list);
        }else{
            echo false;
        }
    }


	public function nueva_cita()
	{
	$this->load->model('Especialidades_model');
	$this->load->model('Pacientes_model');

	$datos['especialidades'] = $this->Especialidades_model->get_especialidades();

	$datos['pacientes'] = $this->Pacientes_model->get_pacientes_activos();

		$this->load->view('header.php');
		$this->load->view('navigation_admin.php');
		$this->load->view('citas/nueva_cita', $datos);
		$this->load->view('footer.php');
	}

    public function set_nueva_cita(){

        $this->load->model('Citas_model');
        $this->load->model('Medicos_model');
        $this->load->model('Pacientes_model');

        date_default_timezone_set('america/santiago');
        $cita = $this->input->post('cita');
        //var_dump($cita); die();
        $id_cita                        = isset($cita['id_cita']) ?  $cita['id_cita'] : false;
        $id_paciente                    = isset($cita['paciente']) ?  $this->encrypt->decode(base64_decode($cita['paciente']['id_paciente'])) : false;
        $id_tipo_atencion               = isset($cita['tipo_atencion']) ?  $this->encrypt->decode(base64_decode($cita['tipo_atencion']['id_tipo_atencion'])) : false;
                 //var_dump($id_tipo_atencion); die();
        $id_enfermera                   = isset($cita['enfermera']) ?  $this->encrypt->decode(base64_decode($cita['enfermera']['id_usuario'])) : false;
        $domiciliaria                   = $cita['domicilio'];

         if($domiciliaria == 'false')
         {
            $id_direccion_paciente      = null;
         }
         else
         {
            $id_direccion               = $this->encrypt->decode(base64_decode($cita['paciente']['domicilio']['id_direccion']));
            $id_direccion_paciente       = $this->Pacientes_model->get_direccion_paciente($id_direccion)->id_direccion_paciente;
         }
        $fecha_cita                     = $cita['fecha_inicio_cita'];
        $hora_inicio_cita               = $cita['fecha_inicio_cita'];
        $hora_fin_cita                  = $cita['fecha_fin_cita'];
        $fecha = Date($fecha_cita);

        $fecha_inicio = date("Y-m-d", strtotime($fecha_cita));
        //$hora_fin_cita = date("Y-m-d H:i:s", strtotime('+' . -4 . ' hour', strtotime($hora_fin_cita)));
        //$hora_inicio_cita = date("Y-m-d H:i:s", strtotime('+' . -4 . ' hour', strtotime($hora_inicio_cita)));

        $hora_fin_cita = date("Y-m-d H:i:s", strtotime($hora_fin_cita));
        $hora_inicio_cita = date("Y-m-d H:i:s", strtotime($hora_inicio_cita));
        //Se debe obtener el id_profesional de la enfermera

        $profesional = $this->Medicos_model->get_profesional_usuario($id_enfermera);

        $id_cita = $this->Citas_model->set_nueva_cita($id_tipo_atencion, $profesional->id_profesional, $id_paciente, $hora_inicio_cita, $hora_fin_cita,$id_direccion_paciente);


        $profesional = $this->Medicos_model->get_profesional_usuario($this->session->userdata('id_usuario'));

        if($profesional->especialidad == 'Enfermera PAD' or $profesional->especialidad == 'Enfermera clínica' or $profesional->especialidad ==  'Técnico enfermería' ){

            $enfermeras = $this->Medicos_model->get_enfermera_session($profesional->id_profesional);
            $datos['modo_agenda'] = 'atencion';
        }
        else{
            $enfermeras = $this->Medicos_model->get_enfermeras_activas();
            $datos['modo_agenda'] = 'registro';
        }

        foreach ($enfermeras as $enfermera) {
            $ids_enfermeras[] = $enfermera->id_profesional;
        }

        
        $citas = $this->Citas_model->get_citas($ids_enfermeras);

        if($citas){
            foreach($citas as $cita){
                $color = array('primary'=> $cita->color_calendario, 'secondary'=>$cita->color_calendario);
                $citas_list[] = array('id_cita' => $cita->id_cita, 'title' =>$cita->nombre_tipo_atencion." - ".$cita->nombre_paciente, 'startsAt'=>$cita->fecha_inicio, 'endsAt'=>$cita->fecha_fin, 'color' => $color);
                                                                                                
            }
            echo json_encode($citas_list);
        }else{
            echo false;
        }
    }

    public function actualizar_cita(){

        $this->load->model('Citas_model');
        $this->load->model('Medicos_model');
        $this->load->model('Pacientes_model');

        $cita = $this->input->post('cita');
        //var_dump($cita); die();
        $id_cita                        = isset($cita['id_cita']) ?  $cita['id_cita'] : false;
        $id_paciente                    = isset($cita['paciente']) ?  $this->encrypt->decode(base64_decode($cita['paciente']['id_paciente'])) : false;
        $id_tipo_atencion               = isset($cita['tipo_atencion']) ?  $this->encrypt->decode(base64_decode($cita['tipo_atencion']['id_tipo_atencion'])) : false;
        $id_enfermera                   = isset($cita['enfermera']) ?  $this->encrypt->decode(base64_decode($cita['enfermera']['id_usuario'])) : false;
        $fecha_cita                     = $cita['fecha_inicio_cita'];
        $hora_inicio_cita               = $cita['fecha_inicio_cita'];
        $hora_fin_cita                  = $cita['fecha_fin_cita'];
        $fecha_inicio                   = date("Y-m-d", strtotime($fecha_cita));


         if(!isset($cita['domicilio']))
         {  
            $id_direccion_paciente      = null;
         }
         else
         {
            $id_direccion               = $this->encrypt->decode(base64_decode($cita['paciente']['domicilio']['id_direccion']));
            $id_direccion_paciente       = $this->Pacientes_model->get_direccion_paciente($id_direccion)->id_direccion_paciente;
         }

        //$hora_fin_cita = date("Y-m-d H:i:s", strtotime('+' . -4 . ' hour', strtotime($hora_fin_cita)));
        //$hora_inicio_cita = date("Y-m-d H:i:s", strtotime('+' . -4 . ' hour', strtotime($hora_inicio_cita)));

        $hora_fin_cita = date("Y-m-d H:i:s", strtotime($hora_fin_cita));
        $hora_inicio_cita = date("Y-m-d H:i:s", strtotime($hora_inicio_cita));

        $profesional = $this->Medicos_model->get_profesional_usuario($id_enfermera);

        if($id_cita){
            $this->Citas_model->update_cita($id_cita, $id_tipo_atencion, $profesional->id_profesional, $id_paciente, $hora_inicio_cita, $hora_fin_cita,$id_direccion_paciente);
        }

        $profesional = $this->Medicos_model->get_profesional_usuario($this->session->userdata('id_usuario'));

        if($profesional->especialidad == 'Enfermera PAD' or $profesional->especialidad == 'Enfermera clínica' or $profesional->especialidad ==  'Técnico enfermería' ){

            $enfermeras = $this->Medicos_model->get_enfermera_session($profesional->id_profesional);
            $datos['modo_agenda'] = 'atencion';
        }
        else{
            $enfermeras = $this->Medicos_model->get_enfermeras_activas();
            $datos['modo_agenda'] = 'registro';
        }


        foreach ($enfermeras as $enfermera) {
            $ids_enfermeras[] = $enfermera->id_profesional;
        }
        
        $citas = $this->Citas_model->get_citas($ids_enfermeras);

        if($citas){
            foreach($citas as $cita){

                $color = array('primary'=> $cita->color_calendario, 'secondary'=>$cita->color_calendario, 'border'=>'#fff');
                $citas_list[] = array('id_cita' => $cita->id_cita, 'title' =>$cita->nombre_tipo_atencion." - ".$cita->nombre_paciente, 'startsAt'=>$cita->fecha_inicio, 'endsAt'=>$cita->fecha_fin, 'color' => $color, 'draggable'=> true);                                                                                              
            }
            echo json_encode($citas_list);
        }else{
            echo false;
        }
    }

    public function get_cita()
    {
        $this->load->model('Citas_model');
        $this->load->model('Pacientes_model');
        $this->load->model('Medicos_model');


        $profesional = $this->Medicos_model->get_profesional_usuario($this->session->userdata('id_usuario'));
        $datos_cita  = $this->input->post('id_cita');
        $cita = $this->Citas_model->get_cita($datos_cita['id_cita']);


        if($cita->profesional == $profesional->id_profesional){
            $ir_cita = true;
        }
        else{
            $ir_cita = false;
        }

        if($cita->direcciones_paciente == NULL)
        {
            $domicilio_cita = false;
        }
        else
        {
            $domicilio_cita = $this->Pacientes_model->get_domicilio_por_id_direccion_paciente($cita->direcciones_paciente);
            $domicilio_cita ->id_direccion = base64_encode($this->encrypt->encode($domicilio_cita->id_direccion));
        }
        $paciente = array('id_paciente' =>  base64_encode($this->encrypt->encode($cita->id_paciente)), 'nombre' => $cita->nombre_paciente. " ".$cita->apellido_paterno_paciente." ".$cita->apellido_materno_paciente,'rut'=>$cita->rut_paciente, 'contigo'=>$cita->contigo, 'diagnostico'=>$cita->diagnostico, 'domiciliario'=>$cita->domiciliario);
        $tipo_atencion = array('id_tipo_atencion' => base64_encode($this->encrypt->encode($cita->id_tipo_atencion)), 'nombre' => $cita->nombre_tipo_atencion);
        $profesional = array('id_usuario' => base64_encode($this->encrypt->encode($cita->id_usuario)), 'nombres' => $cita->nombre_profesional." ".$cita->apellido_paterno);
        $cita = array('id_cita' => $cita->id_cita, 'paciente' => $paciente, 'tipo_atencion' => $tipo_atencion, 'enfermera' => $profesional, 'fecha_inicio'=>$cita->fecha_inicio, 'fecha_fin'=>$cita->fecha_fin, 'domicilio_cita'=>$domicilio_cita, 'ir_cita' =>$ir_cita);


        echo json_encode($cita);
    }

    public function get_domicilios()
    {
        $this->load->model('Pacientes_model');
        $paciente= $this->input->post('paciente');
        $id_paciente = $this->encrypt->decode(base64_decode($paciente["id_paciente"]));
        $domicilios = $this->Pacientes_model->get_direcciones_paciente($id_paciente);
         if($domicilios){
            foreach($domicilios as $domicilio){
                
                $domicilios_list[] = array('id_direccion' => base64_encode($this->encrypt->encode($domicilio->id_direccion)), 'direccion' => $domicilio->direccion, 'defecto' =>$domicilio->defecto  );
                                                                                                
            }
        }else{
            $domicilios_list[] = '{}';
        }
        echo(json_encode($domicilios_list));
    }

}
