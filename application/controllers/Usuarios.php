<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function __construct() {
        parent::__construct();

    }


	public function index()
	{	$fail = $this->uri->segment(3);

		if($fail){
			$datos['fail'] = 1;
		}
		else{
			$datos['fail'] = 0;
		}
		$this->load->view('usuarios/login',$datos);
	}

    function login() {
	    $this->load->model('Usuarios_model');
        $this->load->model('Medicos_model');

	    $nombre_usuario = $this->security->xss_clean(strip_tags($this->input->post('username')));
	    $pass = md5($this->security->xss_clean(strip_tags($this->input->post('password'))));


	    $remember = ($this->input->post('recordar') == NULL )? false : true;

	    $this->Usuarios_model->login($nombre_usuario, $pass, $remember);


	    if (!$this->session->userdata('id_usuario'))
	    {
	        redirect('usuarios/index/fail');
	    }
	    else
	    {    
        $profesional = $this->Medicos_model->get_profesional_usuario($this->session->userdata('id_usuario'));

            if($profesional->especialidad == 'Vendedor'){
                redirect(base_url().'ventas/mis_ventas');

            }else{
                redirect(base_url().'pacientes/listado_pacientes');
            }


    	}
	}


	function logout($del_cookie = false) {
        $this->load->helper('url');
        $this->load->helper('cookie');
        $this->session->sess_destroy();
 
        
        if ($del_cookie)
        {
            $cookie = array(
                'name'   => 'pleno_token_int',
                'value'  => '',
                'expire' => 0,
                );
            delete_cookie($cookie);
        }

        redirect('usuarios');
    }

    function verificar_password(){
    	$this->load->model('Usuarios_model');
    	$this->load->model('Medicos_model');

    	$profesional = $this->Medicos_model->get_profesional_usuario($this->session->userdata('id_usuario'));
    	$password    = md5($this->security->xss_clean(strip_tags($this->input->post('password'))));

    	echo $this->Usuarios_model->verificar_usuario($profesional->nombre_usuario, $password);

    }

	public function listado_usuarios()
	{

		$this->load->model('Usuarios_model');


		$usuarios = $this->Usuarios_model->get_usuarios();

		if($usuarios){
        	foreach($usuarios as $usuario){
        		if($usuario->activo){
        			$activo = true;
        		}else{
        			$activo = false;
        		}
            	$usuarios_list[] = array('id_usuario' => base64_encode($this->encrypt->encode($usuario->id_usuario)), 'rut' => $usuario->rut, 'nombres' => $usuario->nombre." ".$usuario->apellido_paterno." ".$usuario->apellido_materno ,'tipo_usuario' => $usuario->tipo, 'activo' => $activo);
                     																			
            }
        }else{
        	$usuarios_list[] = '{}';
        }
        $datos['usuarios'] = json_encode($usuarios_list);
 
		$this->load->view('header.php');
		$this->load->view('navigation_admin.php');
		$this->load->view('usuarios/listado_usuarios', $datos);
		$this->load->view('footer.php');
	}

    public function detalle_usuario(){
        $this->load->model('Medicos_model');
        $this->load->model('Medicamentos_model');

        $id_usuario = $this->encrypt->decode(base64_decode($this->uri->segment(3)));
        if(isset($id_usuario) && $id_usuario){
            $usuario = $this->Usuarios_model->get_usuario($id_usuario);
            if($usuario){
                $especialidad = array('id_especialidad' => base64_encode($this->encrypt->encode($usuario->id_especialidad)), 'nombre' => $usuario->nombre_especialidad);
                $datos_usuario = array('id_usuario' => base64_encode($this->encrypt->encode($usuario->id_usuario)), 'nombres' => $usuario->nombre, 'apellido_paterno' => $usuario->apellido_paterno, 'apellido_materno' => $usuario->apellido_materno, 'rut' => $usuario->rut, 'direccion' => $usuario->direccion, 'telefono' => $usuario->telefono, 'color_calendario'=>$usuario->color_calendario, 'nombre_usuario'=> $usuario->nombre_usuario, 'telefono'=>$usuario->telefono, 'celular'=>$usuario->celular, 'email'=>$usuario->email, 'color'=>$usuario->color_calendario,  'especialidad'=>$especialidad);
            
                $insumos_profesional = $this->Medicamentos_model->get_insumos_profesional($usuario->id_profesional);

                if($insumos_profesional){
                    foreach ($insumos_profesional as $insumo) {
                        $insumos[] = array('id_insumo' => $insumo->id_insumo, 'linea' => $insumo->nombre_linea ,'familia' => $insumo->nombre_familia,'sap' => $insumo->sap, 'icc' => $insumo->icc, 'descripcion_sap' => $insumo->descripcion_sap, 'material' => $insumo->material, 'composicion' => $insumo->composicion, 'unidad_medida'=>$insumo->unidad_medida, 'stock_unitario'=>intval($insumo->stock_profesional), 'cantidad'=>1, 'gratis'=>0);

                    }
                    $datos['insumos_profesional'] = json_encode($insumos);
                }else{
                    $datos['insumos_profesional'] = '[]';
                }
            }else{
                $datos_usuario = '{}';
            }
        }

        $enfermeras = $this->Medicos_model->get_enfermeras();
        $colores_usados = [];
        if($enfermeras){
            foreach($enfermeras as $enfermera){
                if($enfermera->id_usuario != $id_usuario){
                    $colores_usados[] = array('color'=>"background-color:".$enfermera->color_calendario);
                }
                                                                                                
            }
        }else{
            $colores_usados[] = '{}';
        }

        $datos['usuario'] = json_encode($datos_usuario);
        $datos['colores_usados'] = json_encode($colores_usados);

        $this->load->view('header.php');
        $this->load->view('navigation_admin.php');
        if($usuario->id_especialidad == 4){
            $this->load->view('usuarios/home_enfermera', $datos);
        }
        $this->load->view('footer.php');

    }

    public function nuevo_usuario()
    {

        $this->load->model('Especialidades_model');
        $this->load->model('Medicos_model');


        $especialidades = $this->Especialidades_model->get_especialidades_internas();

        if($especialidades){
            foreach($especialidades as $especialidad){
                $especialidades_list[] = array('id_especialidad' => base64_encode($this->encrypt->encode($especialidad->id_especialidad)), 'nombre' => $especialidad->especialidad);
                                                                                                
            }
        }else{
            $especialidades_list[] = '{}';
        }

        $enfermeras = $this->Medicos_model->get_enfermeras();

        if($enfermeras){
            foreach($enfermeras as $enfermera){
                $colores_usados[] = array('color'=>"background-color:".$enfermera->color_calendario);
                                                                                                
            }
        }else{
            $colores_usados[] = '{}';
        }

        $datos['colores_usados'] = json_encode($colores_usados);
        $datos['especialidades'] = json_encode($especialidades_list);
 
        $this->load->view('header.php');
        $this->load->view('navigation_admin.php');
        $this->load->view('usuarios/nuevo_usuario', $datos);
        $this->load->view('footer.php');
    }

    public function set_usuario(){

        $this->load->model('Usuarios_model');
        $this->load->model('Medicos_model');

        $usuario = $this->input->post('usuario');

        $rut     = isset($usuario['rut']) ?  $usuario['rut'] : false;
        $id_especialidad        = isset($usuario['especialidad']) ?  $this->encrypt->decode(base64_decode($usuario['especialidad']['id_especialidad'])) : false;
        $especialidad        = isset($usuario['especialidad']) ?  $usuario['especialidad']['nombre'] : false;
        $nombres                = $usuario['nombres'];
        $apellido_paterno       = $usuario['apellido_paterno'];
        $apellido_materno       = isset($usuario['apellido_materno']) ?  $usuario['apellido_materno'] : '';
        $nombre_usuario         = $usuario['nombre_usuario'];
        $pass                   = md5($this->security->xss_clean(strip_tags($usuario['password'])));
        $telefono               = isset($usuario['telefono']) ?  $usuario['telefono'] : '';
        $celular                = isset($usuario['celular']) ?  $usuario['celular'] : '';;
        $email                  = $usuario['email'];

        if(isset($usuario['color'])){
            $color = 'background-color: '.$usuario['color'];
            $color_calendario = $usuario['color'];
        }else{
            $color = '';
            $color_calendario = '';
        }
        

        $id_persona = $this->Usuarios_model->set_persona($nombres, $apellido_paterno, $apellido_materno, $rut, NULL);
        if($id_persona){
             $id_usuario = $this->Usuarios_model->set_usuario($id_persona,  1, $especialidad, $nombre_usuario, $pass);
             if($id_usuario){

                $id_profesional = $this->Medicos_model->set_profesional($id_usuario,  $id_especialidad, 45, $telefono, $color, $color_calendario);
             }
        }
        if($id_profesional){
            echo true;
        }else{
            echo false;
        }

    }

    public function update_usuario(){

        $this->load->model('Usuarios_model');
        $this->load->model('Medicos_model');

        $usuario = $this->input->post('usuario');
        $id_usuario        = isset($usuario['id_usuario']) ?  $this->encrypt->decode(base64_decode($usuario['id_usuario'])) : false;
        $nombres                = $usuario['nombres'];
        $apellido_paterno       = $usuario['apellido_paterno'];
        $apellido_materno       = isset($usuario['apellido_materno']) ?  $usuario['apellido_materno'] : '';
        $telefono               = isset($usuario['telefono']) ?  $usuario['telefono'] : '';
        $celular                = isset($usuario['celular']) ?  $usuario['celular'] : '';;
        $email                  = $usuario['email'];

        if(isset($usuario['color'])){
            $color = 'background-color: '.$usuario['color'];
            $color_calendario = $usuario['color'];
        }else{
            $color = '';
            $color_calendario = '';
        }
        

        $usuario = $this->Usuarios_model->get_usuario($id_usuario);

        if($usuario->id_persona){
            $this->Usuarios_model->update_persona($usuario->id_persona, $nombres, $apellido_paterno, $apellido_materno, NULL);
            //$this->Usuarios_model->update_usuario($usuario->id_usuario,  1, $especialidad, $nombre_usuario);
             if($id_usuario){

                $id_profesional = $this->Medicos_model->update_profesional($usuario->id_profesional, 45, $telefono, $color, $color_calendario);
             }
        }
        if($id_profesional){
            echo true;
        }else{
            echo false;
        }

    }

    public function activar_usuario(){

        $this->load->model('Usuarios_model');

        $insumo = $this->input->post('usuario');
        //$activo           = isset($insumo['activo']) ?  $insumo['activo'] : false;

        if($insumo['activo'] == 'true'){
            $activo = 1;
        }else{
            $activo = 0;
        }
        
        $usuario = $this->Usuarios_model->activar_usuario($insumo['id_usuario'], $activo);
       
    }
}
