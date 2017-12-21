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


        //Se obtiene la ubicacion del usuario obtenida en javascript al loguearse
        $lat = '';
        $lng = '';
        if(isset($_COOKIE['lat'])) {
            $lat = $_COOKIE['lat'];
        }
        if(isset($_COOKIE['lng'])) {
            $lng = $_COOKIE['lng'];
        }

        $info= $this->detect();

        $sistema_operativo = $info["os"];
        $navegador = $info["browser"];
        $navegador_version = $info["version"];
        $user_agent =  $_SERVER['HTTP_USER_AGENT'];

	    $remember = ($this->input->post('recordar') == NULL )? false : true;

	    $this->Usuarios_model->login($nombre_usuario, $pass, $remember);


	    if (!$this->session->userdata('id_usuario'))
	    {
	        redirect('usuarios/index/fail');
	    }
	    else
	    {    
            $profesional = $this->Medicos_model->get_profesional_usuario($this->session->userdata('id_usuario'));

            //Se guardan los registros de acceso del usuario

            $this->Usuarios_model->set_acceso_usuario($this->session->userdata('id_usuario'), $sistema_operativo, $navegador, $navegador_version, $user_agent, $lat, $lng);

            if($profesional->especialidad == 'Vendedor'){
                redirect(base_url().'vendedores/home_vendedor');

            }else if($profesional->especialidad == 'Enfermera coordinadora'){
                redirect(base_url().'usuarios/home_admin');
            }
            else{
                redirect(base_url().'pacientes/listado_pacientes');
            }


    	}
	}
 
/**
 * Funcion que devuelve un array con los valores:
 *  os => sistema operativo
 *  browser => navegador
 *  version => version del navegador
 */
function detect()
{
    $browser=array("IE","OPERA","MOZILLA","NETSCAPE","FIREFOX","SAFARI","CHROME");
    $os=array("WIN","MAC","LINUX");
 
    # definimos unos valores por defecto para el navegador y el sistema operativo
    $info['browser'] = "OTHER";
    $info['os'] = "OTHER";
 
    # buscamos el navegador con su sistema operativo
    foreach($browser as $parent)
    {
        $s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent);
        $f = $s + strlen($parent);
        $version = substr($_SERVER['HTTP_USER_AGENT'], $f, 15);
        $version = preg_replace('/[^0-9,.]/','',$version);
        if ($s)
        {
            $info['browser'] = $parent;
            $info['version'] = $version;
        }
    }
 
    # obtenemos el sistema operativo
    foreach($os as $val)
    {
        if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']),$val)!==false)
            $info['os'] = $val;
    }
 
    # devolvemos el array de valores
    return $info;
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

        if (!$this->session->userdata('id_usuario'))
        {
            redirect(base_url());
        }

		$this->load->model('Usuarios_model');


		$usuarios = $this->Usuarios_model->get_usuarios();

		if($usuarios){
        	foreach($usuarios as $usuario){
        		if($usuario->activo){
        			$activo = true;
        		}else{
        			$activo = false;
        		}
            	$usuarios_list[] = array('id_usuario' => base64_encode($this->encrypt->encode($usuario->id_usuario)), 'rut' => $usuario->rut, 'nombres' => $usuario->nombre." ".$usuario->apellido_paterno." ".$usuario->apellido_materno ,'tipo_usuario' => $usuario->nombre_especialidad, 'vendedor_nombre' => $usuario->vendedor_nombre, 'activo' => $activo);
                     																			
            }
        }else{
        	$usuarios_list[] = '{}';
        }
        $datos['usuarios'] = json_encode($usuarios_list);

        $datos['active_view'] = 'usuarios';
 
		$this->load->view('header.php');
		$this->load->view('navigation_admin.php', $datos);
		$this->load->view('usuarios/listado_usuarios', $datos);
		$this->load->view('footer.php');
	}

    public function perfil_usuario(){

        if (!$this->session->userdata('id_usuario'))
        {
            redirect(base_url());
        }

        $this->load->model('Medicos_model');
        $this->load->model('Medicamentos_model');


        $id_usuario = $this->encrypt->decode(base64_decode($this->uri->segment(3)));

        $profesional = $this->Medicos_model->get_profesional_usuario($this->session->userdata('id_usuario'));

        if($profesional->especialidad == 'Enfermera PAD' or $profesional->especialidad == 'Enfermera clínica' or $profesional->especialidad ==  'Técnico enfermería' ){

            $datos['perfil_usuario'] = 'enfermera';
        }
        else{
            $datos['perfil_usuario'] = 'no_enfermera';
        }

        if(isset($id_usuario) && $id_usuario){
            $usuario = $this->Usuarios_model->get_usuario($id_usuario);
            // if($usuario->id_especialidad == 10){

            //     redirect('/vendedores/home_vendedor/'.$this->uri->segment(3));
            // }
            if($usuario){
                $especialidad = array('id_especialidad' => base64_encode($this->encrypt->encode($usuario->id_especialidad)), 'nombre' => $usuario->nombre_especialidad);
                $datos_usuario = array('id_usuario' => base64_encode($this->encrypt->encode($usuario->id_usuario)), 'nombres' => $usuario->nombre, 'apellido_paterno' => $usuario->apellido_paterno, 'apellido_materno' => $usuario->apellido_materno, 'rut' => $usuario->rut, 'direccion' => $usuario->direccion, 'telefono' => $usuario->telefono, 'color_calendario'=>$usuario->color_calendario, 'nombre_usuario'=> $usuario->nombre_usuario, 'telefono'=>$usuario->telefono, 'celular'=>$usuario->celular, 'email'=>$usuario->email, 'color'=>$usuario->color_calendario,  'especialidad'=>$especialidad,  'id_especialidad'=>$usuario->id_especialidad);
            
                if($usuario->id_especialidad == 4){
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

        $datos['active_view'] = 'usuarios';

        $this->load->view('header.php');
        $this->load->view('navigation_admin.php', $datos);
        $this->load->view('usuarios/perfil_usuario', $datos);
        $this->load->view('footer.php');

    }

    public function mantenedor_password(){

        if (!$this->session->userdata('id_usuario'))
        {
            redirect(base_url());
        }

        $this->load->model('Medicos_model');
        $this->load->model('Medicamentos_model');


        $id_usuario = $this->encrypt->decode(base64_decode($this->uri->segment(3)));
        if(isset($id_usuario) && $id_usuario){
            $usuario = $this->Usuarios_model->get_usuario($id_usuario);
            if($usuario){
                $datos_usuario = array('id_usuario' => base64_encode($this->encrypt->encode($usuario->id_usuario)), 'nombres' => $usuario->nombre, 'apellido_paterno' => $usuario->apellido_paterno, 'apellido_materno' => $usuario->apellido_materno, 'rut' => $usuario->rut, 'direccion' => $usuario->direccion, 'telefono' => $usuario->telefono, 'color_calendario'=>$usuario->color_calendario, 'nombre_usuario'=> $usuario->nombre_usuario, 'telefono'=>$usuario->telefono, 'celular'=>$usuario->celular, 'email'=>$usuario->email);
            
            }else{
                $datos_usuario = '{}';
                
            }
        }

        $datos['usuario'] = json_encode($datos_usuario);
        $datos['active_view'] = 'usuarios';

        $this->load->view('header.php');
        $this->load->view('navigation_admin.php', $datos);
        $this->load->view('usuarios/mantenedor_password', $datos);
        $this->load->view('footer.php');

    }

    public function nuevo_usuario()
    {
        if (!$this->session->userdata('id_usuario'))
        {
            redirect(base_url());
        }

        $this->load->model('Especialidades_model');
        $this->load->model('Medicos_model');
        $this->load->model('Ventas_model');


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

        $husos_horarios = $this->Usuarios_model->get_husos_horarios();

        if($husos_horarios){
            foreach($husos_horarios as $huso_horario){
                $husos_horarios_list[] = array('id_huso_horario'=>base64_encode($this->encrypt->encode($huso_horario->id_huso_horario)), 'nombre'=>$huso_horario->nombre, 'valor'=>$huso_horario->valor);                                                                               
            }
        }else{
            $husos_horarios_list[] = '{}';
        }

        $zonas_ventas = $this->Ventas_model->get_zonas_ventas();


        if($zonas_ventas){
            foreach($zonas_ventas as $zona_venta){
                $zonas_ventas_list[] = array('id_zona'=>base64_encode($this->encrypt->encode($zona_venta->id_zona)), 'nombre'=>$zona_venta->nombre);                                                                               
            }
        }else{
            $zonas_ventas_list[] = '{}';
        }

        $roles_profesional_zona = $this->Ventas_model->get_roles_zonas();
        if($roles_profesional_zona){
            foreach($roles_profesional_zona as $rol_profesional_zona){
                $roles_profesional_zona_list[] = array('id_rol_zona'=>base64_encode($this->encrypt->encode($rol_profesional_zona->id_rol_profesional_zona)), 'nombre'=>$rol_profesional_zona->nombre);                                                                               
            }
        }else{
            $roles_profesional_zona_list[] = '{}';
        }

        $datos['colores_usados']        = json_encode($colores_usados);
        $datos['especialidades']        = json_encode($especialidades_list);
        $datos['husos_horarios']        = json_encode($husos_horarios_list);
        $datos['zonas_ventas']          = json_encode($zonas_ventas_list);
        $datos['roles_profesional_zona']    = json_encode($roles_profesional_zona_list);

        $datos['active_view'] = 'usuarios';
 
        $this->load->view('header.php');
        $this->load->view('navigation_admin.php', $datos);
        $this->load->view('usuarios/nuevo_usuario', $datos);
        $this->load->view('footer.php');
    }

    public function set_usuario(){

        if (!$this->session->userdata('id_usuario'))
        {
            redirect(base_url());
        }

        $this->load->model('Usuarios_model');
        $this->load->model('Medicos_model');
        $this->load->model('Ventas_model');

        $usuario = $this->input->post('usuario');

        $rut                    = isset($usuario['rut']) ?  $usuario['rut'] : false;
        $id_especialidad        = isset($usuario['especialidad']) ?  $this->encrypt->decode(base64_decode($usuario['especialidad']['id_especialidad'])) : false;
        $id_huso_horario        = isset($usuario['huso_horario']) ?  $this->encrypt->decode(base64_decode($usuario['huso_horario']['id_huso_horario'])) : false;
        $especialidad           = isset($usuario['especialidad']) ?  $usuario['especialidad']['nombre'] : false;
        $nombres                = $usuario['nombres'];
        $apellido_paterno       = $usuario['apellido_paterno'];
        $apellido_materno       = isset($usuario['apellido_materno']) ?  $usuario['apellido_materno'] : '';
        $nombre_usuario         = $usuario['nombre_usuario'];
        $pass                   = md5($this->security->xss_clean(strip_tags($usuario['password'])));
        $telefono               = isset($usuario['telefono']) ?  $usuario['telefono'] : '';
        $celular                = isset($usuario['celular']) ?  $usuario['celular'] : '';
        $email                  = $usuario['email'];



        //En caso de ser vendedor:
        $zonas_venta          = isset($usuario['zona']) ?  $usuario['zona'] : false;
        $id_rol_zona          = isset($usuario['rol_zona']) ?  $this->encrypt->decode(base64_decode($usuario['rol_zona']['id_rol_zona'])) : false;

        if(isset($usuario['color'])){
            $color = 'background-color: '.$usuario['color'];
            $color_calendario = $usuario['color'];
        }else{
            $color = '';
            $color_calendario = '';
        }
        

        $id_persona = $this->Usuarios_model->set_persona($nombres, $apellido_paterno, $apellido_materno, $rut, NULL);
        if($id_persona){
             $id_usuario = $this->Usuarios_model->set_usuario($id_persona,  1, $especialidad, $nombre_usuario, $id_huso_horario, $pass);
             if($id_usuario){

                $id_profesional = $this->Medicos_model->set_profesional($id_usuario,  $id_especialidad, 45, $telefono, $color, $color_calendario);
             }
        }
        if($id_profesional && $zonas_venta && $id_rol_zona){
            foreach ($zonas_venta as $zona_venta) {
                $usuario_zona = $this->Ventas_model->get_profesional_zona($id_profesional, $this->encrypt->decode(base64_decode($zona_venta['id_zona'])), $id_rol_zona);
                if($usuario_zona == false){
                    $this->Ventas_model->set_profesional_zona($id_profesional, $this->encrypt->decode(base64_decode($zona_venta['id_zona'])), $id_rol_zona);
                }
            }
        }
        if($id_profesional){
            echo true;
        }else{
            echo false;
        }

    }

    public function update_usuario(){

        if (!$this->session->userdata('id_usuario'))
        {
            redirect(base_url());
        }

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

    public function update_password_usuario(){

        $this->load->model('Usuarios_model');

        $usuario = $this->input->post('usuario');
        $id_usuario        = isset($usuario['id_usuario']) ?  $this->encrypt->decode(base64_decode($usuario['id_usuario'])) : false;
        $password        = isset($usuario['password']) ?  md5($this->security->xss_clean(strip_tags($usuario['password']))) : false;

        $this->Usuarios_model->update_password($id_usuario, $password);
        return true;
       
    }

    public function home_admin()
    {
        if (!$this->session->userdata('id_usuario'))
        {
            redirect(base_url());
        }

        $this->load->model('Ventas_model');
        $this->load->model('Usuarios_model');
        $this->load->model('Pacientes_model');
        $this->load->model('Regiones_model');
        $this->load->model('Fichas_model');
        $this->load->model('Especialidades_model');
        $this->load->helper('funciones');

 
        if($this->encrypt->decode(base64_decode($this->uri->segment(3)))){
            $id_usuario = $this->encrypt->decode(base64_decode($this->uri->segment(3)));
        }
        else{
             $id_usuario = $this->session->userdata('id_usuario');
        }

        $usuario = $this->Usuarios_model->get_usuario($id_usuario);
        if($usuario){
            $especialidad = array('id_especialidad' => base64_encode($this->encrypt->encode($usuario->id_especialidad)), 'nombre' => $usuario->nombre_especialidad);
            $datos_usuario = array('id_usuario' => base64_encode($this->encrypt->encode($usuario->id_usuario)), 'nombres' => $usuario->nombre, 'apellido_paterno' => $usuario->apellido_paterno, 'apellido_materno' => $usuario->apellido_materno, 'rut' => $usuario->rut, 'direccion' => $usuario->direccion, 'telefono' => $usuario->telefono, 'color_calendario'=>$usuario->color_calendario, 'nombre_usuario'=> $usuario->nombre_usuario, 'telefono'=>$usuario->telefono, 'celular'=>$usuario->celular, 'email'=>$usuario->email, 'color'=>$usuario->color_calendario,  'especialidad'=>$especialidad,  'id_especialidad'=>$usuario->id_especialidad);
        }else{
            $datos_usuario = '{}';
            
        }

        $huso_horario = $this->Usuarios_model->get_huso_horario_usuario($id_usuario);

        $nro_ventas_contigo = 0;
        $nro_ventas_domiciliario = 0;
        $formato = 'Y-m-d H:i';

        $pacientes_sin_verificar = $this->Pacientes_model->get_pacientes_sin_verificar();
        $pacientes_verificados = $this->Pacientes_model->get_pacientes_verificados();
        $especialidades_externas = $this->Especialidades_model->get_especialidades_externas();

        if($pacientes_sin_verificar){
            foreach ($pacientes_sin_verificar as $paciente) {
                $nombre_vendedor = '-';
                $vendedor_paciente = $this->Ventas_model->get_vendedor_paciente($paciente->id_paciente);
                if($vendedor_paciente){
                    $nombre_vendedor = $vendedor_paciente->nombres." ".$vendedor_paciente->apellido_paterno;
                }
                $nombre_objetado = $paciente->objetado == true ? 'btn-danger' : 'btn-success';
                $pacientes_sin_verificar_list[] = array('id_paciente' =>  base64_encode($this->encrypt->encode($paciente->id_paciente)), 'nombre' => $paciente->nombres. " ".$paciente->apellido_paterno." ".$paciente->apellido_materno,'rut'=>$paciente->rut, 'contigo'=>$paciente->contigo, 'diagnostico'=>$paciente->diagnostico, 'domiciliario'=>$paciente->domiciliario, 'activo'=>$paciente->activo, 'fecha_registro'=>$paciente->created, 'nombre_vendedor' => $nombre_vendedor, 'objetado' => $paciente->objetado, 'nombre_objetado' => $nombre_objetado, 'comentario_validacion' => $paciente->comentario_validacion, 'corregido'=>$paciente->corregido);
            }
        }else{
            $pacientes_sin_verificar_list = [];
        }

        $listado_vendedores = $this->Ventas_model->get_vendedores();
        if($listado_vendedores){
            foreach ($listado_vendedores as $vendedor) {
                $vendedores_list[] = array('id_usuario'=>base64_encode($this->encrypt->encode($vendedor->id_usuario)), 'id_profesional' => base64_encode($this->encrypt->encode($vendedor->id_profesional)),'rut' => $vendedor->rut, 'nombre'=> $vendedor->nombres." ".$vendedor->apellido_paterno." ".$vendedor->apellido_materno);
                $ids_vendedores[] = $vendedor->id_usuario;
            }
        }else{
            $vendedores_list = '[]';
        }

        //se obtienen las ventas totales de todos los vendedores de la zona
        $ventas = $this->Ventas_model->get_ventas_usuario($ids_vendedores);
        if($ventas){
            foreach($ventas as $venta){
                //se agrega huso horario a la fecha de venta
                $fecha_venta     = $venta->created;
                $fecha_gmt_venta       = strtotime('-' . $huso_horario->valor . ' hour', strtotime($fecha_venta));
                $fecha_venta_local = date($formato, $fecha_gmt_venta);

                $ventas_list[] = array('id_paciente_vendedor' => $venta->id_paciente_vendedor, 'rut_paciente' => $venta->rut, 'nombres_paciente' => $venta->nombres." ".$venta->apellido_paterno." ".$venta->apellido_materno ,'email_paciente' => $venta->email, 'fecha_venta'=>$fecha_venta_local, 'contigo' => $venta->contigo, 'domiciliario'=> $venta->domiciliario);
                
                if($venta->contigo){
                    $nro_ventas_contigo++;
                }
                 if($venta->domiciliario){
                    $nro_ventas_domiciliario++;
                }                                                                               
            }
            $datos['ventas'] = json_encode($ventas_list);
        }else{
            $datos['ventas'] = '[]';
        }

        $ventas_mensuales_totales = $this->Ventas_model->ventas_mensuales_totales();

        if($ventas_mensuales_totales){
            foreach($ventas_mensuales_totales as $venta_mensual){
                $ventas_mensuales_list[] = array('name' => MesPalabra($venta_mensual->periodo), 'drilldown'=> MesPalabra($venta_mensual->periodo), 'y' => intval($venta_mensual->numero_ventas));                                                                               
            }

            $series[] = array('name'=> 'Ventas', 'data' => $ventas_mensuales_list);  

            $datos['ventas_mensuales'] = json_encode($series);
        }else{
            $datos['ventas_mensuales'] = '[]';
        }

        $tipos_documentos = $this->Pacientes_model->get_tipos_documentos();
        $isapres = $this->Fichas_model->get_isapres();
        $regiones = $this->Regiones_model->get_regiones();
        $establecimientos = $this->Fichas_model->get_establecimientos();
     
        //Se crea json de isapres
        foreach($regiones as $region){
            $regiones_value[] = array('id_region' => base64_encode($this->encrypt->encode($region->id_region)), 'nombre' => $region->region);
        }

        //Se crea json de isapres
        foreach($isapres as $isapre){
            $isapres_value[] = array('id_isapre' => $isapre->id_isapre, 'nombre' => $isapre->isapre, 'tramos'=>$isapre->tramos);
        }

        //Se crea json de tipos documentos
        foreach($tipos_documentos as $tipo_documento){
            $tipos_documentos_value[] = array('id_tipo_documento' => $tipo_documento->id_tipo_documento_identificacion, 'nombre' => $tipo_documento->nombre);
        }


        foreach($establecimientos as $establecimiento){
            $establecimientos_list[] = array('id_establecimiento' => base64_encode($this->encrypt->encode($establecimiento->id_establecimiento)), 'nombre' => $establecimiento->nombre);
        }

        if($especialidades_externas){
            foreach($especialidades_externas as $especialidad_externa){
                $especialidades_list[] = array('id_especialidad' => base64_encode($this->encrypt->encode($especialidad_externa->id_especialidad)), 'nombre' => $especialidad_externa->especialidad);
            }

            $datos['especialidades']       = json_encode($especialidades_list);
        }else{
            $datos['especialidades']             ='{}';
        }

        $datos['establecimientos']       = json_encode($establecimientos_list);

        $datos['documento']              = json_encode($tipos_documentos_value[0]);
        $datos['isapres']                = json_encode($isapres_value);
        $datos['regiones']               = json_encode($regiones_value);
        $datos['tipos_documentos']       = json_encode($tipos_documentos_value);

        $datos['nro_pacientes_verificados'] =  count($pacientes_verificados);
        $datos['nro_pacientes_sin_verificar'] =  count($pacientes_sin_verificar);
        $datos['nro_ventas_contigo'] = $nro_ventas_contigo;
        $datos['nro_ventas_domiciliario'] = $nro_ventas_domiciliario;

        $datos['vendedores'] = json_encode($vendedores_list);
        $datos['pacientes_sin_verificar'] = json_encode($pacientes_sin_verificar_list);
        $datos['usuario']                 = json_encode($usuario);


        $datos['active_view'] = 'home_admin';

        $this->load->view('header.php');
        $this->load->view('navigation_admin.php', $datos);
        $this->load->view('usuarios/home_admin', $datos);
        $this->load->view('footer.php');
    }
}
