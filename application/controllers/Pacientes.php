<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pacientes extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->session->userdata('id_usuario'))
        {
            redirect(base_url());
        }
         date_default_timezone_set('America/Santiago');
    }


    public function index()
    {
        $this->load->view('header.php');
        $this->load->view('navigation_admin.php');
        $this->load->view('administrador/home');
        $this->load->view('footer.php');
    }

    public function listado_pacientes()
    {
        $this->load->model('Pacientes_model');
        $this->load->model('Encuestas_model');
        $this->load->model('Medicos_model');


        $pacientes = $this->Pacientes_model->get_pacientes();

        $profesional = $this->Medicos_model->get_profesional_usuario($this->session->userdata('id_usuario'));
        $datos['nombre_profesional'] = $profesional->nombre. " ".$profesional->apellido_paterno;

        foreach($pacientes as $paciente){
            $llamado = 0;
            $llamados = array();
            //verifico si ha sido llamado alguna vez
            $encuestas = $this->Encuestas_model->get_encuestas_paciente($paciente->id_paciente);
            $nro_llamados = 0;
            if($encuestas != false){
                foreach ($encuestas as $encuesta) {
                    if($encuesta->contesta){
                        $llamado = 1;
                        $nro_llamados++;
                    }
                }
            }

            for($i = 0; $i<4; $i++){
                if($i < $nro_llamados){
                    $llamados[] = array('value'=> true, 'label'=>'label-success', 'numero'=>$i+1);
                }else{
                    $llamados[] = array('value'=> false, 'label'=>'label-default', 'numero'=>$i+1);
                }
            }

            $pacientes_list[] = array('id_paciente' =>  base64_encode($this->encrypt->encode($paciente->id_paciente)), 'nombre' => $paciente->nombres. " ".$paciente->apellido_paterno." ".$paciente->apellido_materno,'rut'=>$paciente->rut, 'contigo'=>$paciente->contigo, 'diagnostico'=>$paciente->diagnostico, 'domiciliario'=>$paciente->domiciliario, 'activo'=>$paciente->activo, 'fecha_registro'=>$paciente->created, 'llamado'=>$llamados);
        }

        if($pacientes_list){
            $datos['pacientes'] = json_encode($pacientes_list);
        }else{
            $datos['pacientes'] ='{}';
        }
        
        $datos['active_view'] = 'pacientes';

        $this->load->view('header.php');
        $this->load->view('navigation_admin.php', $datos);
        $this->load->view('pacientes/listado_pacientes', $datos);
        $this->load->view('footer.php');
    }

    function verificar_rut_paciente(){
        $this->load->model('Pacientes_model');

        $rut = $this->input->post('rut');

        echo $this->Pacientes_model->existe_paciente_rut($rut);

    }

    public function listado_pacientes_contigo()
    {
        $this->load->model('Pacientes_model');
        $this->load->model('Encuestas_model');
        $this->load->model('Medicos_model');


        $pacientes = $this->Pacientes_model->get_pacientes_contigo();
        $profesional = $this->Medicos_model->get_profesional_usuario($this->session->userdata('id_usuario'));
        $datos['nombre_profesional'] = $profesional->nombre. " ".$profesional->apellido_paterno;

        foreach($pacientes as $paciente){
            $llamado = 0;
            $llamados = array();
            //verifico si ha sido llamado alguna vez
            $encuestas = $this->Encuestas_model->get_encuestas_paciente($paciente->id_paciente);
            $nro_llamados = 0;
            if($encuestas != false){
                foreach ($encuestas as $encuesta) {
                    if($encuesta->contesta){
                        $llamado = 1;
                        $nro_llamados++;
                    }
                }
            }

            for($i = 0; $i<4; $i++){
                if($i < $nro_llamados){
                    $llamados[] = array('value'=> true, 'label'=>'label-success', 'numero'=>$i+1);
                }else{
                    $llamados[] = array('value'=> false, 'label'=>'label-default', 'numero'=>$i+1);
                }
            }

            $pacientes_list[] = array('id_paciente' =>  base64_encode($this->encrypt->encode($paciente->id_paciente)), 'nombre' => $paciente->nombres. " ".$paciente->apellido_paterno." ".$paciente->apellido_materno,'rut'=>$paciente->rut, 'contigo'=>$paciente->contigo, 'diagnostico'=>$paciente->diagnostico, 'domiciliario'=>$paciente->domiciliario, 'activo'=>$paciente->activo, 'fecha_registro'=>$paciente->created, 'llamado'=>$llamados);
        }

        if($pacientes_list){
            $datos['pacientes'] = json_encode($pacientes_list);
        }else{
            $datos['pacientes'] ='{}';
        }
        $datos['active_view'] = 'callcenter';

        $this->load->view('header.php');
        $this->load->view('navigation_admin.php', $datos);
        $this->load->view('pacientes/listado_pacientes_contigo', $datos);
        $this->load->view('footer.php');
    }

    public function get_pacientes()
    {

        $this->load->model('Pacientes_model');


        $pacientes = $this->Pacientes_model->get_pacientes();

        foreach($pacientes as $paciente){
            $pacientes_list[] = array('id_paciente' =>  base64_encode($this->encrypt->encode($paciente->id_paciente)), 'nombre' => $paciente->nombres. " ".$paciente->apellido_paterno." ".$paciente->apellido_materno,'rut'=>$paciente->rut, 'contigo'=>$paciente->contigo, 'diagnostico'=>$paciente->diagnostico, 'domiciliario'=>$paciente->domiciliario, 'activo'=>$paciente->activo, 'fecha_registro'=>$paciente->created);
        }

        if($pacientes_list){
            echo json_encode($pacientes_list);
        }else{
            echo false;
        }
    }

    public function eliminar_paciente()
    {
        $this->load->model('Pacientes_model');
        $this->load->model('Encuestas_model');
        $this->load->model('Medicos_model');

        $paciente = $this->input->post('paciente');

        if(isset($paciente['id_paciente'])){
            $id_paciente = $this->encrypt->decode(base64_decode($paciente['id_paciente']));
            $paciente_antiguo = $this->Pacientes_model->get_paciente($id_paciente);
            if($paciente_antiguo){
                $this->Pacientes_model->delete_paciente($paciente_antiguo->id_paciente);
            }

        }
        $pacientes = $this->Pacientes_model->get_pacientes();

        foreach($pacientes as $paciente){
            $llamado = 0;
            $llamados = array();
            //verifico si ha sido llamado alguna vez
            $encuestas = $this->Encuestas_model->get_encuestas_paciente($paciente->id_paciente);
            $nro_llamados = 0;
            if($encuestas != false){
                foreach ($encuestas as $encuesta) {
                    if($encuesta->contesta){
                        $llamado = 1;
                        $nro_llamados++;
                    }
                }
            }

            for($i = 0; $i<4; $i++){
                if($i < $nro_llamados){
                    $llamados[] = array('value'=> true, 'label'=>'label-success', 'numero'=>$i+1);
                }else{
                    $llamados[] = array('value'=> false, 'label'=>'label-default', 'numero'=>$i+1);
                }
            }

            $pacientes_list[] = array('id_paciente' =>  base64_encode($this->encrypt->encode($paciente->id_paciente)), 'nombre' => $paciente->nombres. " ".$paciente->apellido_paterno." ".$paciente->apellido_materno,'rut'=>$paciente->rut, 'contigo'=>$paciente->contigo, 'diagnostico'=>$paciente->diagnostico, 'domiciliario'=>$paciente->domiciliario, 'activo'=>$paciente->activo, 'fecha_registro'=>$paciente->created, 'llamado'=>$llamados);
        }

        if($pacientes_list){
            echo json_encode($pacientes_list);
        }else{
            echo false;
        }
    }

    public function seguimiento_pacientes()
    {

        $this->load->model('Pacientes_model');


        $datos['pacientes'] = $this->Pacientes_model->get_pacientes_contigo();

        $this->load->view('header.php');
        $this->load->view('navigation_admin.php');
        $this->load->view('pacientes/listado_seguimiento_pacientes', $datos);
        $this->load->view('footer.php');
    }

    public function historial_estomias()
    {

        $this->load->model('Pacientes_model');

        $id_ostomia = $this->uri->segment(3);

        $datos['historial_valoraciones'] = $this->Pacientes_model->get_valoraciones_ostomias($id_ostomia);
        $datos['id_ostomia'] = $id_ostomia;

        $this->load->view('header.php');
        $this->load->view('ostomias/historial_valoraciones', $datos);
        $this->load->view('footer.php');
    }

    public function nuevo_paciente()
    {   
        $this->load->model('Regiones_model');
        $this->load->model('Pacientes_model');
        $this->load->model('Fichas_model');


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

        $datos['establecimientos']       = json_encode($establecimientos_list);

        $datos['documento']              = json_encode($tipos_documentos_value[0]);
        $datos['isapres']                = json_encode($isapres_value);
        $datos['regiones']               = json_encode($regiones_value);
        $datos['tipos_documentos']       = json_encode($tipos_documentos_value);

        $datos['active_view'] = 'pacientes';
        
        $this->load->view('header.php');
        $this->load->view('navigation_admin.php', $datos);
        $this->load->view('vendedores/nuevo_paciente', $datos);
        $this->load->view('footer.php');
    }


    public function set_paciente(){
        $this->load->model('Pacientes_model');
        $this->load->model('Regiones_model');
        $this->load->model('Fichas_model');
        $this->load->model('Ventas_model');
        $this->load->model('Medicos_model');

        $paciente = $this->input->post('paciente');

        if(isset($paciente['id_paciente'])){
            $id_paciente_antiguo = $this->encrypt->decode(base64_decode($paciente['id_paciente']));
            $paciente_antiguo = $this->Pacientes_model->get_paciente($id_paciente_antiguo);
        }else{
            $id_paciente_antiguo = false;
        }
        $id_tipo_documento_identificacion   = $paciente['tipo_documento_identificacion']['id_tipo_documento'];
        $rut                                = $paciente['rut'];
        $nombres                            = $paciente['nombres'];
        $apellido_paterno                   = $paciente['apellido_paterno'];
        $apellido_materno                   = isset($paciente['apellido_materno']) ? $paciente['apellido_materno'] : '';


        if(!(isset($paciente['fecha_nacimiento'])) or $paciente['fecha_nacimiento'] == '0000-00-00 00:00:00' or $paciente['fecha_nacimiento'] == "Invalid date"){
            $fecha_nacimiento = null;

        }else{
            $fecha_nacimiento = date_format(date_create($paciente['fecha_nacimiento']), 'Y-m-d');
        }
        if(!(isset($paciente['fecha_cirugia'])) or $paciente['fecha_cirugia'] == '0000-00-00 00:00:00' or $paciente['fecha_cirugia'] == "Invalid date"){
            $fecha_cirugia = null;

         }else{
             $fecha_cirugia = date_format(date_create($paciente['fecha_cirugia']), 'Y-m-d');
         }  
     
        $genero                             = isset($paciente['genero']) ? $paciente['genero'] : '';
        $direccion                          = isset($paciente['direccion']) ? $paciente['direccion'] : '';
        $id_region                          = isset($paciente['region']) ? $paciente['region'] : '';
        $id_comuna                          = isset($paciente['comuna']['id_comuna']) ? $this->encrypt->decode(base64_decode($paciente['comuna']['id_comuna'])) : false;
        $id_isapre                          = isset($paciente['isapre']['id_isapre']) ? $paciente['isapre']['id_isapre'] : NULL;
        $isapre_nombre                      = isset($paciente['isapre']['nombre']) ? $paciente['isapre']['nombre'] : '';
        if($isapre_nombre == 'Fonasa'){
            $fonasa_plan                        = $paciente['tramo_isapre'];
        }else{
            $fonasa_plan                        = NULL;
        }
        $telefono                           = isset($paciente['telefono']) ? $paciente['telefono'] : '';
        $celular                            = isset($paciente['celular']) ? $paciente['celular'] : '';
        $email                              = isset($paciente['email']) ? $paciente['email'] : '';
        $programa_contigo                   = isset($paciente['contigo']) ? $paciente['contigo'] : '';
        $programa_domiciliario              = isset($paciente['domiciliario']) ? $paciente['domiciliario'] : '';
        $nombre_acompanante                 = isset($paciente['nombre_acompanante']) ? $paciente['nombre_acompanante'] : '';
        $edad_acompanante                   = isset($paciente['edad_acompanante']) ? $paciente['edad_acompanante'] : '';
        $parentesco_acompanante             = isset($paciente['parentesco_acompanante']) ? $paciente['parentesco_acompanante'] : '';
        $telefono_acompanante               = isset($paciente['telefono_acompanante']) ? $paciente['telefono_acompanante'] : '';

        //var_dump($programa_contigo ); die();
        $contigo = 0;
        if($programa_contigo == 'true'){
            $contigo = 1;
        }else{
            $contigo = 0;
        }

        $domiciliario = 0;
        if($programa_domiciliario == 'true'){
            $domiciliario = 1;
        }else{
            $domiciliario = 0;
        }
        if($id_comuna){
            //se debe buscar si existe una direccion registrada
            if(isset($paciente_antiguo) and $paciente_antiguo->direccion != NULL){
                $this->Regiones_model->actualizar_direccion($paciente_antiguo->direccion, $direccion, $id_comuna);
                $id_direccion = $paciente_antiguo->direccion;
            }else{
                $id_direccion = $this->Regiones_model->set_nueva_direccion($direccion, $id_comuna);
            }
            
        }else{
            $id_direccion = NULL;
        }
        $establecimiento                           = isset($paciente['establecimiento']['id_establecimiento']) ?  $this->encrypt->decode(base64_decode($paciente['establecimiento']['id_establecimiento'])) : null;
        $medico_tratante                           = isset($paciente['medico_tratante']['id_medico']) ?  $this->encrypt->decode(base64_decode($paciente['medico_tratante']['id_medico'])) : null;

        $id_paciente = $this->Pacientes_model->set_nuevo_paciente($id_paciente_antiguo, $id_tipo_documento_identificacion, $rut,  $nombres, $apellido_paterno, $apellido_materno, $fecha_nacimiento, $genero, $id_direccion, $id_isapre, $fonasa_plan, $telefono, $celular, $email, $contigo, $domiciliario, $nombre_acompanante, $edad_acompanante, $parentesco_acompanante, $telefono_acompanante, $establecimiento, $medico_tratante, $fecha_cirugia);
       // redirect('/pacientes/nuevo_diagnostico/' . base64_encode($this->encrypt->encode($id_paciente)));
        if($id_paciente){

            //Si se registró y el usuario actual es un vendedor se lo asigno a el
            $profesional = $this->Medicos_model->get_profesional_usuario($this->session->userdata('id_usuario'));

            if($profesional->especialidad == 'Vendedor'){
                 $this->Ventas_model->registrar_venta_paciente($id_paciente, $profesional->id_usuario);
            }

            if($profesional->id_vendedor){
                 $this->Ventas_model->registrar_venta_paciente($id_paciente, $profesional->id_vendedor);
            }

            $paciente = $this->Pacientes_model->get_paciente($id_paciente);


            if($paciente->contigo){
                $paciente->contigo = true;
            }else{
                $paciente->contigo = false;
            }
            if($paciente->domiciliario){
                $paciente->domiciliario = true;
            }else{
                $paciente->domiciliario = false;
            }

            if(isset($paciente->padre)){
                $comunas =      $this->Regiones_model->get_comunas_by_region($paciente->padre);
            }
            $datos['diagnostico'] =  $this->Pacientes_model->get_diagnostico_paciente($id_paciente);
            if(isset($paciente->id_tipo_documento_identificacion)){
                $tipo_documento_identificacion = array('id_tipo_documento' => $paciente->id_tipo_documento_identificacion, 'nombre'=>$paciente->nombre_tipo_documento);
            }
            else{
                $tipo_documento_identificacion  = '{}';
            }
            if(isset($paciente->id_isapre)){  
                $isapre = array('id_isapre' => $paciente->id_isapre, 'nombre' => $paciente->isapre, 'tramos'=>$paciente->tramos);
            }
            else{
                $isapre = '';
            }
            if(isset($paciente->comuna)){ 
                $comuna = array('id_comuna' => base64_encode($this->encrypt->encode($paciente->id)), 'nombre' =>$paciente->comuna);
            }
            else{
                $comuna = '';
            }
            if(isset($paciente->region)){
                $region = array('id_region' => $paciente->id_region, 'nombre' =>$paciente->region);
            }
            else{
                $region = '';
            }
            $f_nacimiento = explode(" ",$paciente->fecha_nacimiento);

            $fecha_nacimiento = $f_nacimiento[0].'T03:00:00.000Z';

            $f_cirugia = explode(" ",$paciente->fecha_cirugia);

            $fecha_cirugia = $f_cirugia[0].'T03:00:00.000Z';

            if(isset($paciente->establecimiento)){
                    $establecimiento = $this->Fichas_model->get_establecimiento($paciente->establecimiento);
                    
                    $datos['establecimiento'] = array('id_establecimiento' =>  base64_encode($this->encrypt->encode($establecimiento->id_establecimiento)), 'nombre' =>$establecimiento->nombre);
                    
                    $medicos_establecimiento = $this->Fichas_model->get_medicos_establecimiento($establecimiento->id_establecimiento);
                }
                else{
                    $datos['establecimiento'] = '';
                    $medicos_establecimiento = false;
                }
                if(isset($paciente->medico_tratante)){
                    $medico = $this->Fichas_model->get_medico_tratante($paciente->medico_tratante);
                    
                    $datos['medico_tratante'] = array('id_medico' =>  base64_encode($this->encrypt->encode($medico->id_medico)), 'nombres' =>$medico->nombres);
                }
                else{
                    $datos['medico_tratante'] = '';
                }

            $paciente_values = array('id_paciente' =>  base64_encode($this->encrypt->encode($paciente->id_paciente)), 'tipo_documento_identificacion'=>$tipo_documento_identificacion, 'rut'=>$paciente->rut, 'nombres'=>$paciente->nombres, 'apellido_paterno'=>$paciente->apellido_paterno, 'apellido_materno'=>$paciente->apellido_materno, 'fecha_nacimiento'=>$fecha_nacimiento, 'fecha_cirugia' =>$fecha_cirugia, 'genero'=>$paciente->genero, 'telefono'=>$paciente->telefono, 'celular'=>$paciente->celular, 'email'=>$paciente->email,'contigo'=>$paciente->contigo,'domiciliario'=>$paciente->domiciliario, 'isapre'=>$isapre,'tramo_isapre'=> $paciente->fonasa_plan, 'direccion'=>$paciente->direccion_nombre, 'comuna'=>$comuna, 'region'=>$region, 'nombre_acompanante'=>$paciente->nombre_acompanante, 'parentesco_acompanante'=>$paciente->parentesco_acompanante, 'edad_acompanante'=>$paciente->edad_acompanante, 'telefono_acompanante' => $paciente->telefono_acompanante, 'establecimiento'=>$datos['establecimiento'], 'medico_tratante'=>$datos['medico_tratante']);
            echo json_encode($paciente_values);
            }else{
                echo '{}';
            }
    }
      public function getRewriteString($sString) {
          $string = strtolower(htmlentities($sString));
          //$string = preg_replace("/&(.)(uml);/", "$1e", $string);
         // $string = preg_replace("/&(.)(acute|cedil|circ|ring|tilde|uml);/", "$1", $string);
          $string = preg_replace("/([\n]+)/", ' ', html_entity_decode($string));
          $string = trim($string, "-");
         return $string;
    }

    public function nuevo_diagnostico()
    {   
        $this->load->model('Pacientes_model');
        $this->load->model('Fichas_model');
        $this->load->model('Regiones_model');
        $this->load->model('Especialidades_model');
        $this->load->model('Medicos_model');
        $this->load->model('Encuestas_model');
        $this->load->model('Atenciones_model');
        $this->load->model('Heridas_model');


        $id_paciente = $this->encrypt->decode(base64_decode($this->uri->segment(3)));

        $profesional = $this->Medicos_model->get_profesional_usuario($this->session->userdata('id_usuario'));
        $datos['nombre_profesional'] = $profesional->nombre. " ".$profesional->apellido_paterno;
        $datos['diagnostico'] = false;
        $comunas = false;

        if($id_paciente){
            $paciente = $this->Pacientes_model->get_paciente($id_paciente);
            //var_dump($paciente); die();
         if(isset($paciente->padre)){
            $comunas =      $this->Regiones_model->get_comunas_by_region($paciente->padre);
        }
            $datos['diagnostico'] =  $this->Pacientes_model->get_diagnostico_paciente($id_paciente);
          if(isset($paciente->id_tipo_documento_identificacion)){
                $tipo_documento_identificacion = array('id_tipo_documento' => $paciente->id_tipo_documento_identificacion, 'nombre'=>$paciente->nombre_tipo_documento);
            }
            else{
                $tipo_documento_identificacion  = '{}';
            }
          if(isset($paciente->id_isapre)){  
            $isapre = array('id_isapre' => $paciente->id_isapre, 'nombre' => $paciente->isapre, 'tramos'=>$paciente->tramos);
            }
            else{
                $isapre = '';
            }
           if(isset($paciente->comuna)){ 
                $comuna = array('id_comuna' => base64_encode($this->encrypt->encode($paciente->id)), 'nombre' =>$paciente->comuna);
            }
            else{
                $comuna = '';
            }
           if(isset($paciente->region)){
                $region = array('id_region' => $paciente->id_region, 'nombre' =>$paciente->region);
            }
            else{
                $region = '';
            }

            if($paciente->contigo){
                $paciente->contigo = true;
            }else{
                $paciente->contigo = false;
            }
            if($paciente->domiciliario){
                $paciente->domiciliario = true;
            }else{
                $paciente->domiciliario = false;
            }
            $f_nacimiento = explode(" ",$paciente->fecha_nacimiento);

            $fecha_nacimiento = $f_nacimiento[0].'T03:00:00.000Z';

            $f_cirugia = explode(" ",$paciente->fecha_cirugia);

            $fecha_cirugia = $f_cirugia[0].'T03:00:00.000Z';

            if(isset($paciente->establecimiento)){
                $establecimiento = $this->Fichas_model->get_establecimiento($paciente->establecimiento);
                
                $datos['establecimiento'] = array('id_establecimiento' =>  base64_encode($this->encrypt->encode($establecimiento->id_establecimiento)), 'nombre' =>$establecimiento->nombre);
                
                $medicos_establecimiento = $this->Fichas_model->get_medicos_establecimiento($establecimiento->id_establecimiento);
            }
            else{
                $datos['establecimiento'] = '';
                $medicos_establecimiento = false;
            }
            if(isset($paciente->medico_tratante)){
                $medico = $this->Fichas_model->get_medico_tratante($paciente->medico_tratante);
                
                $datos['medico_tratante'] = array('id_medico' =>  base64_encode($this->encrypt->encode($medico->id_medico)), 'nombres' =>$medico->nombres);
            }
            else{
                $datos['medico_tratante'] = '';
            }
            $paciente_values = array('id_paciente' => base64_encode($this->encrypt->encode($paciente->id_paciente)), 'tipo_documento_identificacion'=>$tipo_documento_identificacion, 'rut'=>$paciente->rut, 'nombres'=>$paciente->nombres, 'apellido_paterno'=>$paciente->apellido_paterno, 'apellido_materno'=>$paciente->apellido_materno, 'fecha_nacimiento'=>$fecha_nacimiento, 'fecha_cirugia'=>$fecha_cirugia, 'genero'=>$paciente->genero, 'telefono'=>$paciente->telefono, 'celular'=>$paciente->celular, 'email'=>$paciente->email,'contigo'=>$paciente->contigo,'domiciliario'=>$paciente->domiciliario, 'isapre'=>$isapre,'tramo_isapre'=> $paciente->fonasa_plan, 'direccion'=>$paciente->direccion_nombre, 'comuna'=>$comuna, 'region'=>$region, 'nombre_acompanante'=>$paciente->nombre_acompanante, 'parentesco_acompanante'=>$paciente->parentesco_acompanante, 'edad_acompanante'=>$paciente->edad_acompanante, 'telefono_acompanante' => $paciente->telefono_acompanante, 'establecimiento'=>$datos['establecimiento'], 'medico_tratante'=>$datos['medico_tratante']);
            $datos['paciente']    = json_encode($paciente_values);
        }else{

            $datos['paciente'] = '{}';
        }

        $tipos_documentos = $this->Pacientes_model->get_tipos_documentos();
        $isapres = $this->Fichas_model->get_isapres();
        $regiones = $this->Regiones_model->get_regiones();
        $datos['cies10'] = $this->Fichas_model->get_cies();
        $datos['tipos_ostomias'] = $this->Fichas_model->get_tipos_ostomias();
        $datos['tipos_heridas'] = $this->Heridas_model->get_tipos_heridas();
        //var_dump($datos['tipos_ostomias']); die();

        $adjuvantes_antiguos =  $this->Fichas_model->get_adjuvantes(0);
        $adjuvantes_actuales =  $this->Fichas_model->get_adjuvantes(1);
        $sistemas = $this->Fichas_model->get_marcas_sistemas();
        $sistemas_convatec = $this->Fichas_model->get_sistemas_convatec();
        $establecimientos = $this->Fichas_model->get_establecimientos();
        $especialidades_externas = $this->Especialidades_model->get_especialidades_externas();
        $categorias_ostomias = $this->Fichas_model->get_categorias_ostomias();
        $ubicaciones_estomas = $this->Fichas_model->get_ubicaciones_estomas('estoma');
        $ubicaciones_heridas = $this->Fichas_model->get_ubicaciones_estomas('herida');


        if($datos['diagnostico'] != false){
            //obtengo todos los cie10 del diagnostico
            $datos['diagnostico']->cie10 =  $this->Pacientes_model->get_cie10_diagnostico($datos['diagnostico']->id_diagnostico);

            if($datos['diagnostico']->cie10){
                foreach($datos['diagnostico']->cie10 as $cie10_diagnostico){
                        $valores_cie10_diagnostico[] = array('id_cie10' => $cie10_diagnostico->id_cie10, 'nombre' => $cie10_diagnostico->nombre, 'codigo'=>$cie10_diagnostico->codigo);
                    }
                    $datos['cie10_selected'] = json_encode($valores_cie10_diagnostico);
                }else{
                    $datos['cie10_selected'] = '{}';
                }
            if($datos['diagnostico']->tratamiento_actual_quirurgico){
                $datos['diagnostico']->tratamiento_actual_quirurgico = true;
            }else{
                $datos['diagnostico']->tratamiento_actual_quirurgico = false;
            }
            if($datos['diagnostico']->tratamiento_actual_radioterapia){
                $datos['diagnostico']->tratamiento_actual_radioterapia = true;
            }else{
                $datos['diagnostico']->tratamiento_actual_radioterapia = false;
            }
            if($datos['diagnostico']->tratamiento_actual_quimioterapia){
                $datos['diagnostico']->tratamiento_actual_quimioterapia = true;
            }else{
                $datos['diagnostico']->tratamiento_actual_quimioterapia = false;
            }

            // if(isset($datos['diagnostico']->establecimiento)){
            //     $establecimiento = $this->Fichas_model->get_establecimiento($datos['diagnostico']->establecimiento);
                
            //     $datos['establecimiento'] = array('id_establecimiento' =>  base64_encode($this->encrypt->encode($establecimiento->id_establecimiento)), 'nombre' =>$establecimiento->nombre);
                
            //     $medicos_establecimiento = $this->Fichas_model->get_medicos_establecimiento($establecimiento->id_establecimiento);
            // }
            // else{
            //     $datos['establecimiento'] = '';
            //     $medicos_establecimiento = false;
            // }
            // if(isset($datos['diagnostico']->medico_tratante)){
            //     $medico = $this->Fichas_model->get_medico_tratante($datos['diagnostico']->medico_tratante);
                
            //     $datos['medico_tratante'] = array('id_medico' =>  base64_encode($this->encrypt->encode($medico->id_medico)), 'nombres' =>$medico->nombres);
            // }
            // else{
            //     $datos['medico_tratante'] = '';
            // }

            $listado_profesionales_modificaciones = $this->Pacientes_model->get_diagnosticos_profesionales($datos['diagnostico']->id_diagnostico);
            if($listado_profesionales_modificaciones){
                $primer_registro_profesional = array('nombres' =>$listado_profesionales_modificaciones[0]->nombre_profesional." ".$listado_profesionales_modificaciones[0]->apellido_paterno, 'fecha'=>$listado_profesionales_modificaciones[0]->fecha_registro);
                $numero_modificaciones = count($listado_profesionales_modificaciones);
                if($numero_modificaciones > 1){
                    $ultimo_registro_profesional = array('nombres' =>$listado_profesionales_modificaciones[$numero_modificaciones-1]->nombre_profesional." ".$listado_profesionales_modificaciones[$numero_modificaciones-1]->apellido_paterno, 'fecha'=>$listado_profesionales_modificaciones[$numero_modificaciones-1]->fecha_registro);
                }else{
                    $ultimo_registro_profesional = '{}';
                }
            }else{
                $primer_registro_profesional = '{}';
                $ultimo_registro_profesional = '{}';
            }

            $f_cirugia = explode(" ",$datos['diagnostico']->fecha_cirugia);

            $fecha_cirugia = $f_cirugia[0].'T03:00:00.000Z';
            $datos['diagnostico']->seguimiento = $this->getRewriteString($datos['diagnostico']->seguimiento);
            $datos['diagnostico']->principal= $this->getRewriteString($datos['diagnostico']->principal);
            $datos['diagnostico']->secundario = $this->getRewriteString($datos['diagnostico']->secundario);
            $datos['diagnostico']->motivo_consulta = $this->getRewriteString($datos['diagnostico']->motivo_consulta);
            $datos['diagnostico']->historia_clinica= $this->getRewriteString($datos['diagnostico']->historia_clinica);
            $diagnostico = array('id_diagnostico' => $datos['diagnostico']->id_diagnostico, 'diagnostico_principal'=>$datos['diagnostico']->principal, 'diagnostico_atencion'=>$datos['diagnostico']->secundario, 'recibe_kit'=>$datos['diagnostico']->recibe_kit, 'seguimiento'=>$datos['diagnostico']->seguimiento, 'motivo_consulta'=>$datos['diagnostico']->motivo_consulta, 'antecedentes_patologicos' =>$datos['diagnostico']->antecedentes_patologicos, 'antecedentes_quirurgicos'=>$datos['diagnostico']->antecedentes_quirurgicos, 'antecedentes_alergicos'=>$datos['diagnostico']->antecedentes_alergicos, 'antecedentes_farmacologicos'=>$datos['diagnostico']->antecedentes_farmacologicos, 'antecedentes_familiares'=>$datos['diagnostico']->antecedentes_familiares, 'historia_clinica'=>$datos['diagnostico']->historia_clinica, 'tratamiento_actual_quirurgico'=>$datos['diagnostico']->tratamiento_actual_quirurgico, 'tratamiento_actual_radioterapia'=>$datos['diagnostico']->tratamiento_actual_radioterapia, 'tratamiento_actual_quimioterapia'=>$datos['diagnostico']->tratamiento_actual_quimioterapia, 'tratamiento_actual_otro'=>$datos['diagnostico']->tratamiento_actual_otro, 'establecimiento'=>$datos['establecimiento'], 'medico_tratante'=>$datos['medico_tratante'], 'primer_registro_profesional' =>$primer_registro_profesional, 'ultimo_registro_profesional'=>$ultimo_registro_profesional, 'tratamiento_actual_fecha_cirugia'=>$fecha_cirugia);
            $datos['diagnostico_antiguo']    = json_encode($diagnostico);
            
            $primer_registro_profesional = isset($diagnostico['primer_registro_profesional']->primer_registro_profesional) ? $diagnostico['primer_registro_profesional']->primer_registro_profesional : false;               
            $ostomias_paciente = $this->Pacientes_model->get_ostomias_diagnostico($datos['diagnostico']->id_diagnostico);
            if($ostomias_paciente){
                foreach($ostomias_paciente as $ostomia_paciente){

                    $listado_profesionales_modificaciones_estomia = $this->Pacientes_model->get_ostomias_profesionales($ostomia_paciente->id_ostomia);
                    if($listado_profesionales_modificaciones_estomia){
                        $primer_registro_profesional = array('nombres' =>$listado_profesionales_modificaciones_estomia[0]->nombre_profesional." ".$listado_profesionales_modificaciones_estomia[0]->apellido_paterno, 'fecha'=>$listado_profesionales_modificaciones_estomia[0]->fecha_registro);
                        $numero_modificaciones = count($listado_profesionales_modificaciones_estomia);
                        if($numero_modificaciones > 1){
                            $ultimo_registro_profesional = array('nombres' =>$listado_profesionales_modificaciones_estomia[$numero_modificaciones-1]->nombre_profesional." ".$listado_profesionales_modificaciones_estomia[$numero_modificaciones-1]->apellido_paterno, 'fecha'=>$listado_profesionales_modificaciones_estomia[$numero_modificaciones-1]->fecha_registro);
                        }else{
                            $ultimo_registro_profesional = '{}';
                        }
                    }else{
                        $primer_registro_profesional = '{}';
                        $ultimo_registro_profesional = '{}';
                    }
                    if(isset($ostomia_paciente->ubicacion)){
                        $ubicacion_estoma = $this->Fichas_model->get_ubicacion_estoma($ostomia_paciente->ubicacion);
                    
                        $ubicacion_estoma_value = array('id_ubicacion_estoma' =>  $ubicacion_estoma->id_ubicacion_estoma, 'nombre' =>$ubicacion_estoma->nombre, 'coordenadas'=>json_decode($ubicacion_estoma->coordenadas));
                    }
                    else{
                        $ubicacion_estoma_value = '{}';
                    }
                    if($ostomia_paciente->temporalidad){
                        $ostomia_paciente->temporalidad_nombre = 'Temporal';  
                    }
                    else{
                        $ostomia_paciente->temporalidad_nombre = 'Definitiva';
                    }
                    if(isset($ostomia_paciente->tipo_ostomia)){
                        $tipo_ostomia = $this->Fichas_model->get_tipo_ostomia($ostomia_paciente->tipo_ostomia);
                    
                        $tipo_ostomia_value = array('id_tipo_ostomia' =>  $tipo_ostomia->id_tipo_ostomia, 'nombre' =>$tipo_ostomia->nombre);
                        
                        $categoria_ostomia = $this->Fichas_model->get_categoria_ostomia($ostomia_paciente->categoria);

                        $categoria_ostomia_value = array('id_categoria_ostomia' =>  $categoria_ostomia->id_categoria_ostomia, 'nombre' =>$categoria_ostomia->nombre);
                    }
                    else{
                        $tipo_ostomia_value = '{}';
                        $categoria_ostomia_value = '{}';
                    }

                    if($ostomia_paciente->una_boca){
                        $ostomia_paciente->una_boca = true;
                    }else{
                        $ostomia_paciente->una_boca = false;
                    }
                    if($ostomia_paciente->dos_bocas){
                        $ostomia_paciente->dos_bocas = true;
                    }else{
                        $ostomia_paciente->dos_bocas = false;
                    }
                    if($ostomia_paciente->en_asa){
                        $ostomia_paciente->en_asa = true;
                    }else{
                        $ostomia_paciente->en_asa = false;
                    }
                    if($ostomia_paciente->fisula){
                        $ostomia_paciente->fisula = true;
                    }else{
                        $ostomia_paciente->fisula = false;
                    }

                    $valoracion_ostomia = $this->Pacientes_model->get_ultima_valoracion_ostomia($ostomia_paciente->id_ostomia);

                    if($valoracion_ostomia){
                        $valoracion_ostomia->comentario_sacs = $this->getRewriteString($valoracion_ostomia->comentario_sacs);
                        $ultima_valoracion_estomia = array('id_valoracion_ostomia'=>$valoracion_ostomia->id_valoracion_ostomia, 'sacsl'=>$valoracion_ostomia->sacsl, 'sacst'=>$valoracion_ostomia->sacst, 'comentario_sacs'=>$valoracion_ostomia->comentario_sacs,'created'=>$valoracion_ostomia->created, 'primer_registro'=>$valoracion_ostomia->primer_registro, 'atencion'=>$valoracion_ostomia->atencion);

                    }else{
                        $ultima_valoracion_estomia = false;
                    }
                    //Comentario drenaje

                    $ostomia_paciente->comentario_drenaje = $this->getRewriteString($ostomia_paciente->comentario_drenaje);
                    $ostomias[] = array('id_ostomia' => $ostomia_paciente->id_ostomia, 'tipo_ostomia' => $tipo_ostomia_value ,'categoria_ostomia' => $categoria_ostomia_value , 'marcacion_prequirurgica'=> $ostomia_paciente->marcacion_pre_quirurgica, 'temporalidad'=> $ostomia_paciente->temporalidad, 'temporalidad_nombre' => $ostomia_paciente->temporalidad_nombre, 'boca_proximal' => $ostomia_paciente->tamano_boca_proximal, 'boca_distal' => $ostomia_paciente->tamano_boca_distal, 'puente_piel' => $ostomia_paciente->puente_piel, 'ubicacion_estoma'=>$ubicacion_estoma_value, 'una_boca'=>$ostomia_paciente->una_boca, 'dos_bocas'=>$ostomia_paciente->dos_bocas,'en_asa'=>$ostomia_paciente->en_asa,'fisula'=>$ostomia_paciente->fisula,'angulo_drenaje'=>$ostomia_paciente->angulo_drenaje,'comentario_drenaje'=>$ostomia_paciente->comentario_drenaje, 'valoracion_ostomia'=>$ultima_valoracion_estomia, 'created' => $ostomia_paciente->created, 'fecha_modificacion' => $ostomia_paciente->modified, 'diagnostico' => $ostomia_paciente->diagnostico, 'checked' =>'checked', 'primer_registro_profesional'=>$primer_registro_profesional, 'ultimo_registro_profesional'=>$ultimo_registro_profesional, 'mostrar_nuevo_sacs'=>false);
                                    // $ostomia['ubicacion_estoma']['id_ubicacion_estoma'], $ostomia['boca_proximal'], $ostomia['boca_distal'], $ostomia['puente_piel'], $ostomia['temporalidad'], $una_boca, $dos_bocas, $en_asa, $fisula, $ostomia['angulo_drenaje'], $ostomia['comentario_drenaje'], $ostomia['sacsl'], $ostomia['sacst'], $ostomia['comentario_sacs'], $ostomia['marcacion_prequirurgica']);

                }
                $datos['ostomias']               = json_encode($ostomias);
            }else{
                 $datos['ostomias']             ='{}';
            }

            $atenciones_paciente = $this->Atenciones_model->get_atenciones_paciente($datos['diagnostico']->id_diagnostico);

            if($atenciones_paciente){
                foreach ($atenciones_paciente as $atencion) {
                    $atenciones_list[] = array('id_atencion' => $atencion->id_atencion, 'diagnostico' => $atencion->diagnostico ,'frecuencia_cardiaca' => $atencion->frecuencia_cardiaca, 'presion_arterial'=> $atencion->presion_arterial, 'temperatura'=> $atencion->temperatura, 'estatura'=>$atencion->estatura, 'imc'=>$atencion->imc, 'estado_animo'=>$atencion->estado_animo, 'agudeza_visual'=>$atencion->agudeza_visual, 'destreza_manual'=>$atencion->destreza_manual, 'dependencia'=>$atencion->dependencia, 'fecha_registro'=>$atencion->fecha_registro, 'profesional'=>$atencion->nombre_profesional." ".$atencion->apellido_paterno);
                }
                $datos['atenciones'] = json_encode($atenciones_list);
            }
            else{
                $datos['atenciones'] = '[]';
            }


             $heridas_paciente = $this->Heridas_model->get_heridas_paciente($datos['diagnostico']->id_diagnostico);
             if($heridas_paciente){
                foreach ($heridas_paciente as $herida) {
                    $herida->ubicaciones = $this->Heridas_model->get_ubicacion_herida($herida->id_heridas);
                    $tipo_herida = $this->Heridas_model->get_tipo_herida($herida->tipo_herida);
                    if($tipo_herida){
                        $tipo_herida = $this->Heridas_model->get_tipo_herida($herida->tipo_herida);
                        if($tipo_herida){
                            $herida->tipo_herida = array('id_tipo_herida' =>  base64_encode($this->encrypt->encode($tipo_herida[0]->id_tipo_herida)), 'nombre' => $tipo_herida[0]->nombre);
                        }
                        $herida->tipo_herida = array('id_tipo_herida' =>  base64_encode($this->encrypt->encode($tipo_herida[0]->id_tipo_herida)), 'nombre' => $tipo_herida[0]->nombre);
                    }
                    $herida_clasificacion_tipo_herida = $this->Heridas_model->get_clasificacion_tipo_herida_id_herida($herida->id_heridas);
                    if($herida_clasificacion_tipo_herida){
                        $herida->clasificacion_tipo_herida = array('id_clasificacion_tipo_herida' =>  base64_encode($this->encrypt->encode($herida_clasificacion_tipo_herida->id_clasificacion_tipo_herida)), 'nombre' => $herida_clasificacion_tipo_herida->nombre);
                    }else{
                        $herida->clasificacion_tipo_herida = '[]';
                    }
                }
             }
            if($heridas_paciente){
                foreach ($heridas_paciente as $herida) {
                    $ubicaciones_herida_value = [];
                    if($herida->ubicaciones){
                        foreach ($herida->ubicaciones as $ubicacion_herida) {
                             $ubicaciones_herida_value[] = array('id_ubicacion_estoma' => $ubicacion_herida->id_ubicacion_estoma, 'nombre' => $ubicacion_herida->nombre, 'coordenadas'=>json_decode($ubicacion_herida->coordenadas));
                        }
                    }
                    $heridas_list[] = array('id_herida' => $herida->id_heridas, 'diagnostico' => $herida->diagnostico ,'tipo_herida' => $herida->tipo_herida, 'clasificacion_tipo_herida' => $herida->clasificacion_tipo_herida,'ubicacion'=> $ubicaciones_herida_value, 'profesional'=>$herida->nombre_profesional." ".$herida->apellido_paterno, 'profundidad_herida'=> intval($herida->profundidad), 'largo_herida'=> intval($herida->largo), 'ancho_herida'=>intval($herida->ancho), 'tejido_granulatorio'=>$herida->tejido_granulatorio, 'comentario'=>$herida->comentario, 'fecha_herida'=>$herida->fecha_herida);
                }
                $datos['heridas'] = json_encode($heridas_list);
            }
            else{
                $datos['heridas'] = '[]';
            }

        }else{
            $diagnostico = array('id_diagnostico' => '', 'diagnostico_principal'=>'', 'diagnostico_atencion'=>'', 'kit_poshospit'=>'', 'cantidad_poshospit'=>'', 'kit_consul'=>'', 'cantidad_consul'=>'', 'seguimiento'=>'');
            $datos['diagnostico_antiguo'] =json_encode($diagnostico);
            $datos['ostomias']             ='{}';
            $datos['cie10_selected'] = '{}';
            $datos['encuestas'] = '[]';
            $datos['encuestas_no_contestadas'] ='[]';
            $datos['atenciones'] ='[]';
            $datos['heridas'] ='[]';
        }

        $encuestas_paciente = $this->Encuestas_model->get_encuestas_paciente($id_paciente);

        if($encuestas_paciente){
            foreach($encuestas_paciente as $encuesta){
                if($encuesta->contesta){
                    $encuesta->observaciones = $this->getRewriteString($encuesta->observaciones);
                    $encuestas_contesta[] = array('id_encuesta' => $encuesta->id_encuesta, 'fecha' => $encuesta->fecha_creacion,'hora_inicio' => $encuesta->hora_inicio,'hora_fin' => $encuesta->hora_fin, 'profesional' => $encuesta->nombres." ".$encuesta->apellido_paterno, 'observaciones' => $encuesta->observaciones);
                }else{
                    $encuesta->observaciones = $this->getRewriteString($encuesta->observaciones);
                    $encuestas_no_contesta[] = array('id_encuesta' => $encuesta->id_encuesta, 'fecha' => $encuesta->fecha_creacion ,'hora_inicio' => $encuesta->hora_inicio,'hora_fin' => $encuesta->hora_fin, 'profesional' => $encuesta->nombres." ".$encuesta->apellido_paterno, 'observaciones' => $encuesta->observaciones);
                }
                
            }

            $datos['encuestas']                 = isset($encuestas_contesta) ? json_encode($encuestas_contesta) : '[]';
            $datos['encuestas_no_contestadas']  = isset($encuestas_no_contesta) ? json_encode($encuestas_no_contesta) : '[]';
        }else{
            $datos['encuestas'] = '[]';
            $datos['encuestas_no_contestadas'] ='[]';

            }


        //Se crea json de isapres
        foreach($regiones as $region){
            $regiones_value[] = array('id_region' => base64_encode($this->encrypt->encode($region->id_region)), 'nombre' => $region->region);
        }

        //Se crea json de isapres
        if($comunas){
            foreach($comunas as $comuna){
                $comunas_value[] = array('id_comuna' => base64_encode($this->encrypt->encode($comuna->id)), 'nombre' => $comuna->comuna);
            }
            $datos['comunas']                = json_encode($comunas_value);
        }else{
            $datos['comunas'] = '{}';
        }

        foreach($ubicaciones_estomas as $ubicacion_estoma){
            $ubicaciones_estomas_value[] = array('id_ubicacion_estoma' => $ubicacion_estoma->id_ubicacion_estoma, 'nombre' => $ubicacion_estoma->nombre, 'coordenadas'=>json_decode($ubicacion_estoma->coordenadas));
        }
        foreach($ubicaciones_heridas as $ubicacion_herida){
            $ubicaciones_heridas_value[] = array('id_ubicacion_estoma' => $ubicacion_herida->id_ubicacion_estoma, 'nombre' => $ubicacion_herida->nombre, 'coordenadas'=>json_decode($ubicacion_herida->coordenadas));
        }

        //Se crea json de isapres
        foreach($isapres as $isapre){
            $isapres_value[] = array('id_isapre' => $isapre->id_isapre, 'nombre' => $isapre->isapre, 'tramos'=>$isapre->tramos);
        }

        //Se crea json de tipos documentos
        foreach($tipos_documentos as $tipo_documento){
            $tipos_documentos_value[] = array('id_tipo_documento' => $tipo_documento->id_tipo_documento_identificacion, 'nombre' => $tipo_documento->nombre);
        }
        //Se crea json adjuvantes antiguos
        foreach($adjuvantes_antiguos as $adjuvante_antiguo){
            $adjuvantes_ant[] = array('id_adjuvante' => $adjuvante_antiguo->id_adjuvante, 'nombre' => $adjuvante_antiguo->nombre);
        }

        //Se crea json de adjuvantes actuales
        foreach($adjuvantes_actuales as $adjuvante_actual){
            $adjuvantes_act[] = array('id_adjuvante' => $adjuvante_actual->id_adjuvante, 'nombre' => $adjuvante_actual->nombre);
        }

        //Se crea json de sistemas convatec
        foreach($sistemas_convatec as $sistema_convatec){
            $sistemas_convatec_activos[] = array('id_sistema' => $sistema_convatec->id_sistema, 'nombre' => $sistema_convatec->nombre);
        }

        //Se crea json de sistemas
        foreach($sistemas as $sistema){
            $sistemas_activos[] = array('id_sistema' => $sistema->id_sistema, 'nombre' => $sistema->nombre." (".$sistema->marca.")");
        }

     //   foreach ($datos['tipos_ostomias'] as $tipo_ostomia) {
       //     $tipo_ostomia->ostomias = $this->Fichas_model->get_tipos_ostomias_por_categoria($tipo_ostomia->categoria);
       // }

        foreach ($datos['cies10'] as $cie10){
            $valores_cie10[] = array('id_cie10' => $cie10->id_cie10, 'nombre' => $cie10->nombre, 'codigo'=> $cie10->codigo);

        }
        foreach ($datos['tipos_heridas'] as $tipo_herida){
            $valores_tipos_heridas[] = array('id_tipo_herida' =>  base64_encode($this->encrypt->encode($tipo_herida->id_tipo_herida)), 'nombre' => $tipo_herida->nombre);
        }
        foreach ($datos['tipos_ostomias'] as $tipo_ostomia){
            $valores_tipos_ostomias[] = array('id_tipo_ostomia' => $tipo_ostomia->id_tipo_ostomia, 'categoria' => $tipo_ostomia->nombre);
        }
        foreach ($categorias_ostomias as $categoria_ostomia){
            $categorias_ostomias_list[] = array('id_categoria_ostomia' => $categoria_ostomia->id_categoria_ostomia, 'nombre' => $categoria_ostomia->nombre);
        }
        if($establecimientos){
            foreach($establecimientos as $establecimiento){
                $establecimientos_list[] = array('id_establecimiento' => base64_encode($this->encrypt->encode($establecimiento->id_establecimiento)), 'nombre' => $establecimiento->nombre);
            }

            $datos['establecimientos']       = json_encode($establecimientos_list);
        }else{
            $datos['establecimientos']             ='{}';
        }

        if($especialidades_externas){
            foreach($especialidades_externas as $especialidad_externa){
                $especialidades_list[] = array('id_especialidad' => base64_encode($this->encrypt->encode($especialidad_externa->id_especialidad)), 'nombre' => $especialidad_externa->especialidad);
            }

            $datos['especialidades']       = json_encode($especialidades_list);
        }else{
            $datos['especialidades']             ='{}';
        }

        
        if(  isset($medicos_establecimiento) && $medicos_establecimiento){
            foreach($medicos_establecimiento as $medico_establecimiento){
                $medicos_establecimiento_list[] = array('id_medico' => $medico_establecimiento->id_medico, 'nombres' => $medico_establecimiento->nombres);
            }

            $datos['medicos']       = json_encode($medicos_establecimiento_list); 
        }
        else{
                $datos['medicos'] = '{}';
            }
        $datos['ubicaciones_estomas']   = json_encode($ubicaciones_estomas_value); 
        $datos['ubicaciones_heridas']   = json_encode($ubicaciones_heridas_value);
        //var_dump(json_decode($ubicaciones_estomas_value[0]['coordenadas']));die();
        //var_dump($datos['ubicaciones_estomas']);
        //var_dump(json_decode($datos['ubicaciones_estomas'])); die();   
        $datos['categorias_ostomias']   = json_encode($categorias_ostomias_list);
        $datos['isapres']                = json_encode($isapres_value);
        $datos['regiones']               = json_encode($regiones_value);
        $datos['adjuvantes_antiguos']    = json_encode($adjuvantes_ant);
        $datos['adjuvantes_actuales']    = json_encode($adjuvantes_act);
        $datos['sistemas']               = json_encode($sistemas_activos);
        $datos['sistemas_convatec']      = json_encode($sistemas_convatec_activos);
        $datos['cies10']                 = json_encode($valores_cie10);
        $datos['tipos_documentos']       = json_encode($tipos_documentos_value);
        $datos['tipos_ostomias']         = json_encode($valores_tipos_ostomias);
        $datos['tipos_heridas']          = json_encode($valores_tipos_heridas);
        $datos['documento']              = json_encode($tipos_documentos_value[0]);

        $datos['active_view'] = 'pacientes';
        
        $this->load->view('header.php');
        $this->load->view('navigation_admin.php', $datos);
        $this->load->view('pacientes/nuevo_diagnostico', $datos);
        $this->load->view('footer.php');

    }

    public function set_diagnostico_paciente()
    {
        $this->load->model('Pacientes_model');
        $this->load->model('Medicos_model');


        $id_paciente = $this->encrypt->decode(base64_decode($this->uri->segment(3)));
        $diagnostico                      = $this->input->post('diagnostico');

        //saber si existe diagnostico para el paciente
        $diagnostico_antiguo = $this->Pacientes_model->get_diagnostico_paciente($id_paciente); 

        $tratamiento_actual_quirurgico = 0;
        if(isset($diagnostico['tratamiento_actual_quirurgico']) && $diagnostico['tratamiento_actual_quirurgico'] == 'true'){
            $tratamiento_actual_quirurgico = 1;
        }else{
            $tratamiento_actual_quirurgico = 0;
        }

        $tratamiento_actual_radioterapia = 0;
        if(isset($diagnostico['tratamiento_actual_radioterapia']) && $diagnostico['tratamiento_actual_radioterapia'] == 'true'){
            $tratamiento_actual_radioterapia = 1;
        }else{
            $tratamiento_actual_radioterapia = 0;
        }

        $tratamiento_actual_quimioterapia = 0;
        if(isset($diagnostico['tratamiento_actual_quimioterapia']) && $diagnostico['tratamiento_actual_quimioterapia'] == 'true'){
            $tratamiento_actual_quimioterapia = 1;
        }else{
            $tratamiento_actual_quimioterapia = 0;
        }
         $recibe_kit    = isset($diagnostico['recibe_kit']) ?  $diagnostico['recibe_kit'] : null;
         $motivo_consulta    = isset($diagnostico['motivo_consulta']) ?  $diagnostico['motivo_consulta'] : '';
         $antecedentes_patologicos    = isset($diagnostico['antecedentes_patologicos']) ?  $diagnostico['antecedentes_patologicos'] : '';
         $antecedentes_quirurgicos    = isset($diagnostico['antecedentes_quirurgicos']) ?  $diagnostico['antecedentes_quirurgicos'] : '';
         $antecedentes_alergicos    = isset($diagnostico['antecedentes_alergicos']) ?  $diagnostico['antecedentes_alergicos'] : '';
         $antecedentes_farmacologicos    = isset($diagnostico['antecedentes_farmacologicos']) ?  $diagnostico['antecedentes_farmacologicos'] : '';
         $antecedentes_familiares    = isset($diagnostico['antecedentes_familiares']) ?  $diagnostico['antecedentes_familiares'] : '';
         $historia_clinica    = isset($diagnostico['historia_clinica']) ?  $diagnostico['historia_clinica'] : '';
         $tratamiento_actual_otro    = isset($diagnostico['tratamiento_actual_otro']) ?  $diagnostico['tratamiento_actual_otro'] : '';
         

        if(isset($diagnostico['tratamiento_actual_fecha_cirugia'])== false || $diagnostico['tratamiento_actual_fecha_cirugia'] == 'Invalid Date' || $diagnostico['tratamiento_actual_fecha_cirugia'] == '0000-00-00 00:00:00'){
            $fecha_cirugia = null;

        }else{
            $fecha_cirugia = date_format(date_create($diagnostico['tratamiento_actual_fecha_cirugia']), 'Y-m-d');
        }

        $establecimiento                           = isset($diagnostico['establecimiento']['id_establecimiento']) ?  $this->encrypt->decode(base64_decode($diagnostico['establecimiento']['id_establecimiento'])) : null;
        $medico_tratante                           = isset($diagnostico['medico_tratante']['id_medico']) ?  $this->encrypt->decode(base64_decode($diagnostico['medico_tratante']['id_medico'])) : null;
        
        $profesional = $this->Medicos_model->get_profesional_usuario($this->session->userdata('id_usuario'));
        if($diagnostico_antiguo == false){

            $id_diagnostico = $this->Pacientes_model->set_nuevo_diagnostico($diagnostico['diagnostico_principal'], $diagnostico['diagnostico_atencion'], $recibe_kit, $diagnostico['seguimiento'], $motivo_consulta, $antecedentes_patologicos, $antecedentes_quirurgicos, $antecedentes_alergicos, $antecedentes_farmacologicos, $antecedentes_familiares, $historia_clinica,$tratamiento_actual_quirurgico, $tratamiento_actual_radioterapia, $tratamiento_actual_quimioterapia, $tratamiento_actual_otro, $establecimiento, $medico_tratante, $fecha_cirugia);

            //se vincula el diagnostico al paciente
            $this->Pacientes_model->vincular_diagnostico_paciente($id_paciente, $id_diagnostico);

            //ingreso el profesional como primer registro de la lista de modificaciones
            $this->Pacientes_model->registrar_diagnostico_profesional($id_diagnostico, $profesional->id_profesional, 1);

        }
        else{
            $this->Pacientes_model->actualizar_diagnostico($diagnostico_antiguo->id_diagnostico, $diagnostico['diagnostico_principal'], $diagnostico['diagnostico_atencion'],$recibe_kit, $diagnostico['seguimiento'], $motivo_consulta, $antecedentes_patologicos, $antecedentes_quirurgicos, $antecedentes_alergicos, $antecedentes_farmacologicos, $antecedentes_familiares, $historia_clinica, $tratamiento_actual_quirurgico, $tratamiento_actual_radioterapia, $tratamiento_actual_quimioterapia, $tratamiento_actual_otro, $establecimiento, $medico_tratante, $fecha_cirugia);
            $id_diagnostico = $diagnostico_antiguo->id_diagnostico;

            //ingreso el profesional a la lista de modificaciones
            $this->Pacientes_model->registrar_diagnostico_profesional($diagnostico_antiguo->id_diagnostico, $profesional->id_profesional, 0);
        }


        
        //borro todos los cie10_diagnostico del diagnostico
        $this->Pacientes_model->borrar_cie10_diagnostico($id_diagnostico);


        //se vinculan los cie10 al diagnostico
        if(isset($diagnostico['cie10'])){
            foreach($diagnostico['cie10'] as $cie10){
                $this->Pacientes_model->vincular_cie10_diagnostico($id_diagnostico, $cie10['id_cie10']);
            }
        }

        //Obtengo los datos del diagnostico para enviarlos de vuelta a la vista
        $datos['diagnostico'] =  $this->Pacientes_model->get_diagnostico_paciente($id_paciente);
        if($datos['diagnostico'] != false){
                //obtengo todos los cie10 del diagnostico
                $datos['diagnostico']->cie10 =  $this->Pacientes_model->get_cie10_diagnostico($datos['diagnostico']->id_diagnostico);

                if($datos['diagnostico']->cie10){
                    foreach($datos['diagnostico']->cie10 as $cie10_diagnostico){
                            $valores_cie10_diagnostico[] = array('id_cie10' => $cie10_diagnostico->id_cie10, 'nombre' => $cie10_diagnostico->nombre, 'codigo'=>$cie10_diagnostico->codigo);
                        }
                        $datos['cie10_selected'] = json_encode($valores_cie10_diagnostico);
                    }else{
                        $datos['cie10_selected'] = '{}';
                    }
                if($datos['diagnostico']->tratamiento_actual_quirurgico){
                    $datos['diagnostico']->tratamiento_actual_quirurgico = true;
                }else{
                    $datos['diagnostico']->tratamiento_actual_quirurgico = false;
                }
                if($datos['diagnostico']->tratamiento_actual_radioterapia){
                    $datos['diagnostico']->tratamiento_actual_radioterapia = true;
                }else{
                    $datos['diagnostico']->tratamiento_actual_radioterapia = false;
                }
                if($datos['diagnostico']->tratamiento_actual_quimioterapia){
                    $datos['diagnostico']->tratamiento_actual_quimioterapia = true;
                }else{
                    $datos['diagnostico']->tratamiento_actual_quimioterapia = false;
                }

                if(isset($datos['diagnostico']->establecimiento)){
                    $establecimiento = $this->Fichas_model->get_establecimiento($datos['diagnostico']->establecimiento);
                    
                    $datos['establecimiento'] = array('id_establecimiento' =>  base64_encode($this->encrypt->encode($establecimiento->id_establecimiento)), 'nombre' =>$establecimiento->nombre);
                    
                    $medicos_establecimiento = $this->Fichas_model->get_medicos_establecimiento($establecimiento->id_establecimiento);
                }
                else{
                    $datos['establecimiento'] = '';
                    $medicos_establecimiento = false;
                }
                if(isset($datos['diagnostico']->medico_tratante)){
                    $medico = $this->Fichas_model->get_medico_tratante($datos['diagnostico']->medico_tratante);
                    
                    $datos['medico_tratante'] = array('id_medico' =>  base64_encode($this->encrypt->encode($medico->id_medico)), 'nombres' =>$medico->nombres);
                }
                else{
                    $datos['medico_tratante'] = '';
                }

                $listado_profesionales_modificaciones = $this->Pacientes_model->get_diagnosticos_profesionales($datos['diagnostico']->id_diagnostico);
                if($listado_profesionales_modificaciones){
                    $primer_registro_profesional = array('nombres' =>$listado_profesionales_modificaciones[0]->nombre_profesional." ".$listado_profesionales_modificaciones[0]->apellido_paterno, 'fecha'=>$listado_profesionales_modificaciones[0]->fecha_registro);
                    $numero_modificaciones = count($listado_profesionales_modificaciones);
                    if($numero_modificaciones > 1){
                        $ultimo_registro_profesional = array('nombres' =>$listado_profesionales_modificaciones[$numero_modificaciones-1]->nombre_profesional." ".$listado_profesionales_modificaciones[$numero_modificaciones-1]->apellido_paterno, 'fecha'=>$listado_profesionales_modificaciones[$numero_modificaciones-1]->fecha_registro);
                    }else{
                        $ultimo_registro_profesional = '{}';
                    }
                }else{
                    $primer_registro_profesional = '{}';
                    $ultimo_registro_profesional = '{}';
                }

                $f_cirugia = explode(" ",$datos['diagnostico']->fecha_cirugia);

                $fecha_cirugia = $f_cirugia[0].'T03:00:00.000Z';
                $datos['diagnostico']->seguimiento = $this->getRewriteString($datos['diagnostico']->seguimiento);
                $datos['diagnostico']->principal= $this->getRewriteString($datos['diagnostico']->principal);
                $datos['diagnostico']->secundario = $this->getRewriteString($datos['diagnostico']->secundario);
                $datos['diagnostico']->motivo_consulta = $this->getRewriteString($datos['diagnostico']->motivo_consulta);
                $datos['diagnostico']->historia_clinica= $this->getRewriteString($datos['diagnostico']->historia_clinica);
                $diagnostico = array('id_diagnostico' => $datos['diagnostico']->id_diagnostico, 'diagnostico_principal'=>$datos['diagnostico']->principal, 'diagnostico_atencion'=>$datos['diagnostico']->secundario, 'recibe_kit'=>$datos['diagnostico']->recibe_kit, 'seguimiento'=>$datos['diagnostico']->seguimiento, 'motivo_consulta'=>$datos['diagnostico']->motivo_consulta, 'antecedentes_patologicos' =>$datos['diagnostico']->antecedentes_patologicos, 'antecedentes_quirurgicos'=>$datos['diagnostico']->antecedentes_quirurgicos, 'antecedentes_alergicos'=>$datos['diagnostico']->antecedentes_alergicos, 'antecedentes_farmacologicos'=>$datos['diagnostico']->antecedentes_farmacologicos, 'antecedentes_familiares'=>$datos['diagnostico']->antecedentes_familiares, 'historia_clinica'=>$datos['diagnostico']->historia_clinica, 'tratamiento_actual_quirurgico'=>$datos['diagnostico']->tratamiento_actual_quirurgico, 'tratamiento_actual_radioterapia'=>$datos['diagnostico']->tratamiento_actual_radioterapia, 'tratamiento_actual_quimioterapia'=>$datos['diagnostico']->tratamiento_actual_quimioterapia, 'tratamiento_actual_otro'=>$datos['diagnostico']->tratamiento_actual_otro, 'establecimiento'=>$datos['establecimiento'], 'medico_tratante'=>$datos['medico_tratante'], 'primer_registro_profesional' =>$primer_registro_profesional, 'ultimo_registro_profesional'=>$ultimo_registro_profesional, 'tratamiento_actual_fecha_cirugia'=>$fecha_cirugia);
                
            echo json_encode($diagnostico);
        }else{
            echo false;
        }

    }

    public function set_ostomias_paciente()
    {
        $this->load->model('Pacientes_model');
        $this->load->model('Medicos_model');
        $this->load->model('Fichas_model');


        $id_paciente = $this->encrypt->decode(base64_decode($this->uri->segment(3)));
        $id_diagnostico                = $this->input->post('id_diagnostico');
        $ostomia                       = $this->input->post('ostomia');

        //saber si existe diagnostico para el paciente
        $diagnostico_antiguo = $this->Pacientes_model->get_diagnostico_paciente($id_paciente); 
        $profesional = $this->Medicos_model->get_profesional_usuario($this->session->userdata('id_usuario'));

        if($diagnostico_antiguo == false){
                     
        }
        else{

            $una_boca = 0;
            if(isset($ostomia['una_boca']) && $ostomia['una_boca'] == 'true'){
                $una_boca = 1;
            }else{
                $una_boca = 0;
            }
            $dos_bocas = 0;
            if(isset($ostomia['dos_bocas']) && $ostomia['dos_bocas'] == 'true'){
                $dos_bocas = 1;
            }else{
                $dos_bocas = 0;
            }
            $en_asa = 0;
            if(isset($ostomia['en_asa']) && $ostomia['en_asa'] == 'true'){
                $en_asa = 1;
            }else{
                $en_asa = 0;
            }
            $fisula = 0;
            if(isset($ostomia['fisula']) && $ostomia['fisula'] == 'true'){
                $fisula = 1;
            }else{
                $fisula = 0;
            }
           //var_dump($ostomia['ubicacion_estoma']); die();
            $tipo_ostomia = isset($ostomia['tipo_ostomia']['id_tipo_ostomia'])  ? $ostomia['tipo_ostomia']['id_tipo_ostomia'] : null;
            $ubicacion_estoma = isset($ostomia['ubicacion_estoma']['id_ubicacion_estoma']) ? $ostomia['ubicacion_estoma']['id_ubicacion_estoma'] : null;

            $boca_proximal = isset($ostomia['boca_proximal']) ? $ostomia['boca_proximal'] : '';
            $boca_distal = isset($ostomia['boca_distal']) ? $ostomia['boca_distal'] : '';
            $puente_piel = isset($ostomia['puente_piel']) ? $ostomia['puente_piel'] : null;
            $temporalidad = isset($ostomia['temporalidad']) ? $ostomia['temporalidad'] : null;
            $angulo_drenaje = isset($ostomia['angulo_drenaje']) ? $ostomia['angulo_drenaje'] : null;
            $comentario_drenaje = isset($ostomia['comentario_drenaje']) ? $ostomia['comentario_drenaje'] : '';
            $sacsl = isset($ostomia['valoracion_ostomia']['sacsl']) ? $ostomia['valoracion_ostomia']['sacsl'] : '';
            $sacst = isset($ostomia['valoracion_ostomia']['sacst']) ? $ostomia['valoracion_ostomia']['sacst'] : '';
            $comentario_sacs = isset($ostomia['valoracion_ostomia']['comentario_sacs']) ? $ostomia['valoracion_ostomia']['comentario_sacs'] : '';
            $marcacion_prequirurgica = isset($ostomia['marcacion_prequirurgica']) ? $ostomia['marcacion_prequirurgica'] : null;

            if(isset($ostomia['id_ostomia'])){
                $id_ostomia = $this->Pacientes_model->update_ostomia_diagnostico($ostomia['id_ostomia'], $diagnostico_antiguo->id_diagnostico, $tipo_ostomia, $ubicacion_estoma, $boca_proximal, $boca_distal, $puente_piel, $temporalidad, $una_boca, $dos_bocas, $en_asa, $fisula, $angulo_drenaje, $comentario_drenaje, $marcacion_prequirurgica);
                $this->Pacientes_model->registrar_estomia_profesional($ostomia['id_ostomia'], $profesional->id_profesional, 0);
                $this->Pacientes_model->registrar_valoracion_estomia($ostomia['id_ostomia'], $sacsl, $sacst, $comentario_sacs,0);
            }else{
                $id_ostomia = $this->Pacientes_model->set_ostomia_diagnostico($diagnostico_antiguo->id_diagnostico, $tipo_ostomia, $ubicacion_estoma, $boca_proximal, $boca_distal, $puente_piel, $temporalidad, $una_boca, $dos_bocas, $en_asa, $fisula,$angulo_drenaje, $comentario_drenaje, $marcacion_prequirurgica);
                $this->Pacientes_model->registrar_estomia_profesional($id_ostomia, $profesional->id_profesional, 1);
                $this->Pacientes_model->registrar_valoracion_estomia($id_ostomia, $sacsl, $sacst, $comentario_sacs,1);
            }
        }
           
         $ostomias_paciente = $this->Pacientes_model->get_ostomias_diagnostico($diagnostico_antiguo->id_diagnostico);
            if($ostomias_paciente){
                foreach($ostomias_paciente as $ostomia_paciente){
                    if(isset($ostomia_paciente->ubicacion)){
                        $ubicacion_estoma = $this->Fichas_model->get_ubicacion_estoma($ostomia_paciente->ubicacion);
                    
                        $ubicacion_estoma_value = array('id_ubicacion_estoma' =>  $ubicacion_estoma->id_ubicacion_estoma, 'nombre' =>$ubicacion_estoma->nombre, 'coordenadas'=>json_decode($ubicacion_estoma->coordenadas));
                    }
                    else{
                        $ubicacion_estoma_value = '{}';
                    }
                    if(isset($ostomia_paciente->tipo_ostomia)){
                        $tipo_ostomia = $this->Fichas_model->get_tipo_ostomia($ostomia_paciente->tipo_ostomia);
                    
                        $tipo_ostomia_value = array('id_tipo_ostomia' =>  $tipo_ostomia->id_tipo_ostomia, 'nombre' =>$tipo_ostomia->nombre);
                        
                        $categoria_ostomia = $this->Fichas_model->get_categoria_ostomia($ostomia_paciente->categoria);

                        $categoria_ostomia_value = array('id_categoria_ostomia' =>  $categoria_ostomia->id_categoria_ostomia, 'nombre' =>$categoria_ostomia->nombre);
                    }
                    else{
                        $tipo_ostomia_value = '{}';
                        $categoria_ostomia_value = '{}';
                    }

                    if($ostomia_paciente->una_boca){
                        $ostomia_paciente->una_boca = true;
                    }else{
                        $ostomia_paciente->una_boca = false;
                    }
                    if($ostomia_paciente->dos_bocas){
                        $ostomia_paciente->dos_bocas = true;
                    }else{
                        $ostomia_paciente->dos_bocas = false;
                    }
                    if($ostomia_paciente->en_asa){
                        $ostomia_paciente->en_asa = true;
                    }else{
                        $ostomia_paciente->en_asa = false;
                    }
                    if($ostomia_paciente->fisula){
                        $ostomia_paciente->fisula = true;
                    }else{
                        $ostomia_paciente->fisula = false;
                    }
                    if($ostomia_paciente->temporalidad){
                            $ostomia_paciente->temporalidad_nombre = 'Temporal';  
                    }
                    else{
                        $ostomia_paciente->temporalidad_nombre = 'Definitiva';
                    }

                    $listado_profesionales_modificaciones_estomia = $this->Pacientes_model->get_ostomias_profesionales($ostomia_paciente->id_ostomia);
                    if($listado_profesionales_modificaciones_estomia){

                        $primer_registro_profesional = array('nombres' =>$listado_profesionales_modificaciones_estomia[0]->nombre_profesional." ".$listado_profesionales_modificaciones_estomia[0]->apellido_paterno, 'fecha'=>$listado_profesionales_modificaciones_estomia[0]->fecha_registro);
                        
                        $numero_modificaciones = count($listado_profesionales_modificaciones_estomia);

                        if($numero_modificaciones > 1){
                            $ultimo_registro_profesional = array('nombres' =>$listado_profesionales_modificaciones_estomia[$numero_modificaciones-1]->nombre_profesional." ".$listado_profesionales_modificaciones_estomia[$numero_modificaciones-1]->apellido_paterno, 'fecha'=>$listado_profesionales_modificaciones_estomia[$numero_modificaciones-1]->fecha_registro);
                        }else{
                            $ultimo_registro_profesional = '{}';
                        }
                    }else{
                        $primer_registro_profesional = '{}';
                        $ultimo_registro_profesional = '{}';
                    }

                    $valoracion_ostomia = $this->Pacientes_model->get_ultima_valoracion_ostomia($ostomia_paciente->id_ostomia);
                    if($valoracion_ostomia){
                        $ultima_valoracion_estomia = array('id_valoracion_ostomia'=>$valoracion_ostomia->id_valoracion_ostomia, 'sacsl'=>$valoracion_ostomia->sacsl, 'sacst'=>$valoracion_ostomia->sacst, 'comentario_sacs'=>$valoracion_ostomia->comentario_sacs,'created'=>$valoracion_ostomia->created, 'primer_registro'=>$valoracion_ostomia->primer_registro, 'mostrar_nuevo_sacs'=>false, 'atencion'=>$valoracion_ostomia->atencion);

                    }else{
                        $ultima_valoracion_estomia = '{}';
                    }
                    if(isset($ostomia['id_ostomia']) && $ostomia['id_ostomia'] == $ostomia_paciente->id_ostomia){
                        $ostomias[] = array('id_ostomia' => $ostomia_paciente->id_ostomia, 'tipo_ostomia' => $tipo_ostomia_value ,'categoria_ostomia' => $categoria_ostomia_value , 'marcacion_prequirurgica'=> $ostomia_paciente->marcacion_pre_quirurgica, 'temporalidad'=> $ostomia_paciente->temporalidad, 'temporalidad_nombre' => $ostomia_paciente->temporalidad_nombre, 'boca_proximal' => $ostomia_paciente->tamano_boca_proximal, 'boca_distal' => $ostomia_paciente->tamano_boca_distal, 'puente_piel' => $ostomia_paciente->puente_piel, 'ubicacion_estoma'=>$ubicacion_estoma_value, 'una_boca'=>$ostomia_paciente->una_boca, 'dos_bocas'=>$ostomia_paciente->dos_bocas,'en_asa'=>$ostomia_paciente->en_asa,'fisula'=>$ostomia_paciente->fisula,'angulo_drenaje'=>$ostomia_paciente->angulo_drenaje,'comentario_drenaje'=>$ostomia_paciente->comentario_drenaje, 'valoracion_ostomia'=>$valoracion_ostomia, 'created' => $ostomia_paciente->created, 'fecha_modificacion' => $ostomia_paciente->modified, 'diagnostico' => $ostomia_paciente->diagnostico,'checked' =>'checked', 'primer_registro_profesional'=>$primer_registro_profesional, 'ultimo_registro_profesional'=>$ultimo_registro_profesional, 'mostrar_nuevo_sacs'=>false);
                    }else{
                        $ostomias[] = array('id_ostomia' => $ostomia_paciente->id_ostomia, 'tipo_ostomia' => $tipo_ostomia_value ,'categoria_ostomia' => $categoria_ostomia_value , 'marcacion_prequirurgica'=> $ostomia_paciente->marcacion_pre_quirurgica, 'temporalidad'=> $ostomia_paciente->temporalidad, 'temporalidad_nombre' => $ostomia_paciente->temporalidad_nombre, 'boca_proximal' => $ostomia_paciente->tamano_boca_proximal, 'boca_distal' => $ostomia_paciente->tamano_boca_distal, 'puente_piel' => $ostomia_paciente->puente_piel, 'ubicacion_estoma'=>$ubicacion_estoma_value, 'una_boca'=>$ostomia_paciente->una_boca, 'dos_bocas'=>$ostomia_paciente->dos_bocas,'en_asa'=>$ostomia_paciente->en_asa,'fisula'=>$ostomia_paciente->fisula,'angulo_drenaje'=>$ostomia_paciente->angulo_drenaje,'comentario_drenaje'=>$ostomia_paciente->comentario_drenaje, 'valoracion_ostomia'=>$valoracion_ostomia, 'created' => $ostomia_paciente->created, 'fecha_modificacion' => $ostomia_paciente->modified, 'diagnostico' => $ostomia_paciente->diagnostico, 'primer_registro_profesional'=>$primer_registro_profesional, 'ultimo_registro_profesional'=>$ultimo_registro_profesional, 'mostrar_nuevo_sacs'=>false);
                    }          
                }
                $datos['ostomias']               = json_encode($ostomias);
            }else{
                $datos['ostomias']             ='{}';
            } 
        echo $datos['ostomias'];
    }

    public function set_atencion_paciente()
    {
        $this->load->model('Pacientes_model');
        $this->load->model('Medicos_model');
        $this->load->model('Fichas_model');
        $this->load->model('Atenciones_model');
        $this->load->model('Medicamentos_model');


        $id_paciente = $this->encrypt->decode(base64_decode($this->uri->segment(3)));
        $atencion                = $this->input->post('atencion');
        $ostomias                = $this->input->post('ostomias');
        $diagnostico             = $this->input->post('diagnostico');

        $profesional = $this->Medicos_model->get_profesional_usuario($this->session->userdata('id_usuario'));

        $frecuencia_cardiaca    = isset($atencion['frecuencia_cardiaca']) ? $atencion['frecuencia_cardiaca'] : '';
        $presion_arterial       = isset($atencion['presion_arterial']) ? $atencion['presion_arterial'] : '';
        $temperatura            = isset($atencion['temperatura']) ? $atencion['temperatura'] : '';
        $estatura               = isset($atencion['estatura']) ? $atencion['estatura'] : '';
        $imc                    = isset($atencion['imc']) ? $atencion['imc'] : '';
        $estado_animo           = isset($atencion['estado_animo']) ? $atencion['estado_animo'] : '';
        $agudeza_visual         = isset($atencion['agudeza_visual']) ? $atencion['agudeza_visual'] : '';
        $destreza_manual        = isset($atencion['destreza_manual']) ? $atencion['destreza_manual'] : '';
        $dependencia            = isset($atencion['dependencia']) ? $atencion['dependencia'] : '';
        $id_diagnostico         = isset($diagnostico['id_diagnostico']) ? $diagnostico['id_diagnostico'] : false;   

        if($id_diagnostico){
            $id_atencion = $this->Atenciones_model->set_atencion_paciente($id_diagnostico, $frecuencia_cardiaca,$presion_arterial,  $temperatura, $estatura, $imc, $estado_animo, $agudeza_visual, $destreza_manual, $dependencia);
            $this->Atenciones_model->registrar_atencion_profesional($id_atencion, $profesional->id_profesional, 0);


            //Se deben guardar los insumos asociados a la atencion
            $insumos         = isset($atencion['insumos']) ? $atencion['insumos'] : false;

            if($insumos){
                foreach ($insumos as $insumo) {
                    $gratis = isset($insumo['gratis']) ? $insumo['gratis'] : false; 
                
                 if($gratis){
                        $gratis = 1;
                    }else{
                        $gratis = 0;
                    }

                   $this->Atenciones_model->guardar_insumos_utilizados($id_atencion, $insumo['id_insumo'], $insumo['cantidad'], $gratis);
                   $stock = $this->Medicamentos_model->get_stock_insumo($insumo['id_insumo']);
                   $this->Medicamentos_model->update_stock_insumo($insumo['id_insumo'], $stock->stock_unitario-$insumo['cantidad']);
                }

            } 

            $atenciones = $this->Atenciones_model->get_atenciones_paciente($id_diagnostico);

            $atenciones_list = [];
            if($atenciones){
                foreach ($atenciones as $atencion) {
                    $atenciones_list[] = array('id_atencion' => $atencion->id_atencion, 'diagnostico' => $atencion->diagnostico ,'frecuencia_cardiaca' => $atencion->frecuencia_cardiaca, 'presion_arterial'=> $atencion->presion_arterial, 'temperatura'=> $atencion->temperatura, 'estatura'=>$atencion->estatura, 'imc'=>$atencion->imc, 'estado_animo'=>$atencion->estado_animo, 'agudeza_visual'=>$atencion->agudeza_visual, 'destreza_manual'=>$atencion->destreza_manual, 'dependencia'=>$atencion->dependencia, 'fecha_registro'=>$atencion->fecha_registro, 'profesional'=>$atencion->nombre_profesional." ".$atencion->apellido_paterno);
                }

            }

            echo json_encode($atenciones_list);
        }
        echo false;
    }

    public function set_valoracion_ostomia()
    {
        $this->load->model('Pacientes_model');
        $this->load->model('Medicos_model');
        $this->load->model('Fichas_model');

        $ostomia                       = $this->input->post('ostomia');

        //cuando implemente el registro del profesional que realizó la valoracion}
        $profesional = $this->Medicos_model->get_profesional_usuario($this->session->userdata('id_usuario'));


        $sacsl = isset($ostomia['valoracion_ostomia']['sacsl']) ? $ostomia['valoracion_ostomia']['sacsl'] : '';
        $sacst = isset($ostomia['valoracion_ostomia']['sacst']) ? $ostomia['valoracion_ostomia']['sacst'] : '';
        $comentario_sacs = isset($ostomia['valoracion_ostomia']['comentario_sacs']) ? $ostomia['valoracion_ostomia']['comentario_sacs'] : '';


        $this->Pacientes_model->registrar_valoracion_estomia($ostomia['id_ostomia'], $sacsl, $sacst, $comentario_sacs,0);

        $valoracion_ostomia = $this->Pacientes_model->get_ultima_valoracion_ostomia($ostomia['id_ostomia']);

        if($valoracion_ostomia){
            $ultima_valoracion_estomia = array('id_valoracion_ostomia'=>$valoracion_ostomia->id_valoracion_ostomia, 'sacsl'=>$valoracion_ostomia->sacsl, 'sacst'=>$valoracion_ostomia->sacst, 'comentario_sacs'=>$valoracion_ostomia->comentario_sacs, 'primer_registro'=>$valoracion_ostomia->primer_registro, 'created'=>$valoracion_ostomia->created, 'mostrar_nuevo_sacs'=>false, 'atencion'=>$valoracion_ostomia->atencion, 'registrar_atencion'=>true);
        }else{
            $ultima_valoracion_estomia = '{}';
        }
        echo json_encode($ultima_valoracion_estomia);

    }
    
    
    public function guardar_encuesta_paciente()
    {
        $this->load->model('Pacientes_model');
        $this->load->model('Encuestas_model');
        $this->load->model('Medicos_model');
        $this->load->model('Fichas_model');

        $encuesta                = $this->input->post('encuesta'); 
        $paciente                = $this->input->post('paciente'); 

        $profesional = $this->Medicos_model->get_profesional_usuario($this->session->userdata('id_usuario'));

        $fecha_inicio = date_create($encuesta['fecha_inicio']);
        $fecha_inicio = date_format($fecha_inicio, 'Y-m-d'); 

        $hora_inicio = date_create($encuesta['hora_inicio']);
        $hora_inicio = date_format($hora_inicio, 'Y-m-d H:m:s'); 

        $hora_fin = date_create($encuesta['hora_fin']);
        $hora_fin = date_format($hora_fin, 'Y-m-d H:m:s'); 


        $proximo_llamado = isset($encuesta['proximo_llamado']) ? date_create($encuesta['proximo_llamado']) : false;
        if($proximo_llamado){
                    $proximo_llamado = date_format($proximo_llamado, 'Y-m-d');
        }
 

        $id_profesional = $profesional->id_profesional;
        $id_paciente =  $this->encrypt->decode(base64_decode($paciente['id_paciente']));

        $correccion_entrega = isset($encuesta['correccion_entrega']) ? $encuesta['correccion_entrega'] : false;
        $cierre_quirurgico = isset($encuesta['cierre_quirurgico']) ? $encuesta['cierre_quirurgico'] : false;
        $remitido = isset($encuesta['remitido']) ? $encuesta['remitido'] : false;
        $evento_adverso = isset($encuesta['evento_adverso']) ? $encuesta['evento_adverso'] : false;
        $numero_placas = isset($encuesta['numero_placas']) ? $encuesta['numero_placas'] : false;
        $dispositivos_mes = isset($encuesta['dispositivos_mes']) ? $encuesta['dispositivos_mes'] : false;
        $numero_bolsas = isset($encuesta['numero_bolsas']) ? $encuesta['numero_bolsas'] : false;
        $recomienda_convatec = isset($encuesta['recomienda_convatec']) ? $encuesta['recomienda_convatec'] : false;
        $actividad_laboral = isset($encuesta['actividad_laboral']) ? $encuesta['actividad_laboral'] : false;
        $recomendaria_programa = isset($encuesta['recomendaria_programa']) ? $encuesta['recomendaria_programa'] : false;
        $autocuidado = isset($encuesta['autocuidado']) ? $encuesta['autocuidado'] : false;
        $tiempo_retorno_laboral = isset($encuesta['tiempo_retorno_laboral']) ? $encuesta['tiempo_retorno_laboral'] : false;
        $estado_programa = isset($encuesta['estado_programa']) ? $encuesta['estado_programa'] : false;
        $sistema_dispositivo = isset($encuesta['sistema_dispositivo']) ? $encuesta['sistema_dispositivo'] : false;
        $observaciones = isset($encuesta['observaciones']) ? $encuesta['observaciones'] : '';

        $sistemas_actuales = isset($encuesta['dispositivo_antiguo']) ? $encuesta['dispositivo_antiguo'] : false;
        $adjuvantes_actuales = isset($encuesta['adjuvantes']) ? $encuesta['adjuvantes'] : false;

        $id_encuesta = $this->Encuestas_model->set_nueva_encuesta($id_paciente, $fecha_inicio, $hora_inicio, $hora_fin, $id_profesional, $correccion_entrega, $cierre_quirurgico, $remitido, $evento_adverso, $sistema_dispositivo, $numero_placas, $dispositivos_mes, $numero_bolsas, $actividad_laboral, $recomienda_convatec, $recomendaria_programa, $autocuidado, $tiempo_retorno_laboral, $estado_programa, $proximo_llamado, $observaciones, $encuesta['contesta']);  
        
        if($sistemas_actuales){
            foreach($sistemas_actuales as $sistema_actual){
                $this->Fichas_model->registrar_sistema_encuesta($id_encuesta, $sistema_actual['id_sistema']);
            }
        }
        if($adjuvantes_actuales){
            foreach($adjuvantes_actuales as $adjuvante_actual){
                $this->Fichas_model->registrar_adjuvante_encuesta($id_encuesta, $adjuvante_actual['id_adjuvante']);
            }
        }
        
        $encuestas_paciente = $this->Encuestas_model->get_encuestas_paciente($id_paciente);
        $encuestas_contestadas = [];
        $encuestas_no_contestadas = [];
        $encuestas = [];

        if($encuestas_paciente){
            foreach($encuestas_paciente as $encuesta){
                if($encuesta->contesta){
                     $encuesta->observaciones = $this->getRewriteString($encuesta->observaciones);
                    $encuestas_contestadas[] = array('id_encuesta' => $encuesta->id_encuesta, 'fecha' => $encuesta->fecha_creacion ,'hora_inicio' => $encuesta->hora_inicio,'hora_fin' => $encuesta->hora_fin, 'profesional' => $encuesta->nombres." ".$encuesta->apellido_paterno, 'observaciones' => $encuesta->observaciones);
                }else{
                     $encuesta->observaciones = $this->getRewriteString($encuesta->observaciones);
                     $encuestas_no_contestadas[] = array('id_encuesta' => $encuesta->id_encuesta, 'fecha' => $encuesta->fecha_creacion ,'hora_inicio' => $encuesta->hora_inicio,'hora_fin' => $encuesta->hora_fin, 'profesional' => $encuesta->nombres." ".$encuesta->apellido_paterno, 'observaciones' => $encuesta->observaciones);
                }
                
            }
            $encuestas = array('encuestas_contestadas' => $encuestas_contestadas, 'encuestas_no_contestadas'=>$encuestas_no_contestadas);
        }
        echo json_encode($encuestas);    
        
    }

    public function get_complicaciones_tipo_estomia()
    {
        $this->load->model('Fichas_model');


        $estoma                      = $this->input->post('estoma');

        if($estoma != false){

            $complicaciones = $this->Fichas_model->get_complicaciones_tipo_estomia($estoma['tipo_ostomia']);

        }

        if($complicaciones){
            foreach ($complicaciones as $complicacion){
                $valores_complicaciones[] = array('id_complicacion' => $complicacion->id_complicacion, 'nombre' => $complicacion->nombre, 'categoria'=>$complicacion->categoria, 'evaluacion_sacs'=>$complicacion->evaluacion_sacs);
            }
        }

        echo json_encode($valores_complicaciones);
    }

    public function get_tipos_ostomias_desde_categoria()
    {
        $this->load->model('Fichas_model');


        $id_categoria                      = $this->input->post('categoria');
        $tipos_ostomias = $this->Fichas_model->get_tipos_ostomias_por_categoria($id_categoria);

            foreach ($tipos_ostomias as $tipo_ostomia){
                $tipos_ostomias_list[] = array('id_tipo_ostomia' => $tipo_ostomia->id_tipo_ostomia, 'nombre' => $tipo_ostomia->nombre);
            }

        echo json_encode($tipos_ostomias_list);
    }
    
    public function nuevo_seguimiento_paciente()
    {   
        $this->load->model('Regiones_model');

        /*if ($this->session->userdata('tipo_usuario') != 'profesor')
        {
            redirect('/usuarios/logout');
        }*/

        if ($this->input->post('rut') != false && $this->input->post('nombres') != false && $this->input->post('apellido_paterno') != false)
        {

            $this->load->model('Pacientes_model');


            //Datos del paciente

            $id_tipo_documento_identificacion   = $this->encrypt->decode(base64_decode($this->input->post('tipo_documento_identificacion')));
            $rut                                = $this->input->post('rut');
            $nombres                            = $this->input->post('nombres');
            $apellido_paterno                   = $this->input->post('apellido_paterno');
            $apellido_materno                   = $this->input->post('apellido_materno');
            $fecha_nacimiento                   = $this->input->post('fecha_nacimiento');
            $genero                             = $this->input->post('genero');
            $direccion                          = $this->input->post('direccion');
            $id_region                          = $this->input->post('region');
            $id_comuna                          = $this->encrypt->decode(base64_decode($this->input->post('comuna')));
            $id_isapre                          =  $this->encrypt->decode(base64_decode($this->input->post('isapre')));
            $fonasa_plan                        = $this->input->post('fonasa_plan');
            $telefono                           = $this->input->post('telefono');
            $celular                            = $this->input->post('celular');
            $email                              = $this->input->post('email');
            $programa_contigo                   = $this->input->post('programa_contigo');

            if($programa_contigo == 'on'){
                $contigo = 1;
            }else{
                $contigo = 0;
            }

                $id_cie10                           = $this->encrypt->decode(base64_decode($this->input->post('cie10')));
                $diagnostico_principal              = $this->input->post('diagnostico_principal');
                $diagnostico_atencion               = $this->input->post('diagnostico_atencion');
                $id_tipo_ostomia                    = $this->encrypt->decode(base64_decode($this->input->post('tipo_ostomia')));
                $id_barrera                         = $this->encrypt->decode(base64_decode($this->input->post('barrera')));
                $temporabilidad                     = $this->input->post('temporabilidad');
                $id_bolsa                           = $this->encrypt->decode(base64_decode($this->input->post('bolsa')));
                $accesorios                         = $this->input->post('accesorios');
                $cambio_cantidad_accesorios         = $this->input->post('cambio_cantidad_accesorios');
                $kit_poshospit                      = $this->input->post('kit_poshospit');
                $cantidad_kit_poshospit             = $this->input->post('cantidad_poshospit');
                $kit_consul                         = $this->input->post('kit_consul');
                $cantidad_kit_consul                = $this->input->post('cantidad_consul');
                $numero_estomas                     = $this->input->post('numero_estomas');
                $cantidad_previa_barreras           = $this->input->post('cantidad_previa_barreras');
                $cantidad_actual_barreras           = $this->input->post('cantidad_actual_barreras');
                $tamano                             = $this->input->post('tamano');
                $cantidad_previa_bolsas             = $this->input->post('cantidad_previa_bolsas');
                $cantidad_actual_bolsas             = $this->input->post('cantidad_actual_bolsas');
                $id_tipo_accesorio                  = $this->encrypt->decode(base64_decode($this->input->post('tipo_accesorio')));
                $seguimiento                        = $this->input->post('seguimiento');
                $complicaciones                     = $this->input->post('complicaciones');

                $id_diagnostico = $this->Pacientes_model->set_nuevo_diagnostico($id_cie10, $diagnostico_principal, $diagnostico_atencion, $id_tipo_ostomia, $id_barrera, $temporabilidad, $id_bolsa, $accesorios, $cambio_cantidad_accesorios, $kit_poshospit, $cantidad_kit_poshospit, $kit_consul, $cantidad_kit_consul, $numero_estomas, $cantidad_previa_barreras, $cantidad_actual_barreras, $tamano, $cantidad_previa_bolsas, $cantidad_actual_bolsas, $id_tipo_accesorio, $seguimiento, $complicaciones);


            $id_direccion = $this->Regiones_model->set_nueva_direccion($direccion, $id_comuna);
            $id_paciente = $this->Pacientes_model->set_nuevo_paciente($id_tipo_documento_identificacion, $rut,  $nombres, $apellido_paterno, $apellido_materno, $fecha_nacimiento, $genero, $id_direccion, $id_isapre, $fonasa_plan, $telefono, $celular, $email, $contigo, $id_diagnostico);
            if ($this->input->post('action') == "guardar")
            {
                redirect('/pacientes/listado_pacientes/');
            }
            elseif ($this->input->post('action') == "guardar_crear_ficha")
            {
                redirect('/fichas/nueva_ficha/' . base64_encode($this->encrypt->encode($id_paciente)));
            }
        }
        else
        {

            $this->load->model('Pacientes_model');
            $this->load->model('Fichas_model');
            $this->load->model('Regiones_model');
            $this->load->model('Medicos_model');
            $this->load->model('Encuestas_model');


            $id_paciente = $this->encrypt->decode(base64_decode($this->uri->segment(3)));
            $datos['paciente'] = $this->Pacientes_model->get_paciente($id_paciente);
            $sistemas = $this->Fichas_model->get_marcas_sistemas();

            $datos['tipos_documentos'] = $this->Pacientes_model->get_tipos_documentos();
            $datos['isapres'] = $this->Fichas_model->get_isapres();
            $datos['regiones'] = $this->Regiones_model->get_regiones();
            $datos['cies10'] = $this->Fichas_model->get_cies();
            $datos['tipos_ostomias'] = $this->Fichas_model->get_tipos_ostomias();
            $datos['tipos_heridas'] = $this->Heridas_model->get_tipos_heridas();
            $datos['barreras'] = $this->Fichas_model->get_barreras();
            $datos['bolsas'] = $this->Fichas_model->get_bolsas();
            $especialistas = $this->Medicos_model->get_medicos();
            $establecimientos = $this->Fichas_model->get_establecimientos();

          //  $datos['tipos_accesorios'] = $this->Fichas_model->get_tipos_accesorios();
            $datos['comunas'] = $this->Regiones_model->get_comunas_by_region($datos['paciente']->padre);

            $encuestas_paciente = $this->Encuestas_model->get_encuestas_paciente($id_paciente);

            if($encuestas_paciente){
                foreach($encuestas_paciente as $encuesta){
                        $encuestas_p[] = array('id_encuesta' => $encuesta->id_encuesta, 'fecha' => $encuesta->fecha_llamado ,'hora_inicio' => $encuesta->hora_inicio,'hora_fin' => $encuesta->hora_fin, 'profesional' => $encuesta->nombres." ".$encuesta->apellido_paterno, 'observaciones' => $encuesta->observaciones, 'contesta' => $encuesta->contesta);
                    
                }
            }else{
                    $encuestas_p[] = '{}';

                }


            $adjuvantes_antiguos =  $this->Fichas_model->get_adjuvantes(0);

            foreach($adjuvantes_antiguos as $adjuvante_antiguo){
                $adjuvantes_ant[] = array('id_adjuvante' => $adjuvante_antiguo->id_adjuvante, 'nombre' => $adjuvante_antiguo->nombre);
            }

            foreach($sistemas as $sistema){
                $sistemas_activos[] = array('id_sistema' => $sistema->id_sistema, 'nombre' => $sistema->nombre." (".$sistema->marca.")");
            }

            foreach($especialistas as $especialista){
                $especialistas_list[] = array('id_profesional' => $especialista->id_profesional, 'nombre' => $especialista->nombre." ".$especialista->apellido_paterno." ".$especialista->apellido_materno, 'cargo'=>$especialista->especialidad);
            }

            foreach($establecimientos as $establecimiento){
                $establecimientos_list[] = array('id_establecimiento' => $establecimiento->id_establecimiento, 'nombre' => $establecimiento->nombre);
            }

            $datos['establecimientos']       = json_encode($establecimientos_list);

            $datos['sistemas']               = json_encode($sistemas_activos);
            $datos['adjuvantes_antiguos']    = json_encode($adjuvantes_ant);
            $datos['especialistas']          = json_encode($especialistas_list);
            $datos['encuestas']              = json_encode($encuestas_p);


            $this->load->view('header.php');
            $this->load->view('navigation_admin.php');
            $this->load->view('pacientes/encuesta_pacientes_contigo', $datos);
            $this->load->view('footer.php');
    }

    }

    public function encuesta_resumen()
    {
        $this->load->model('Encuestas_model');


        $id_encuesta = $this->uri->segment(3);
        $label_sistema = "";
        $label_adjuvante = "";

            $datos['encuesta'] = $this->Encuestas_model->get_encuesta($id_encuesta);

            if($datos['encuesta']){
               $sistemas = $this->Encuestas_model->get_sistemas_encuesta($datos['encuesta']->id_encuesta);
            }
            if($sistemas){
                foreach ($sistemas as $key => $sistema) {
                 if($key >0){
                    $label_sistema = $label_sistema.", ".$sistema->nombre." ".$sistema->marca;
                 }else{
                     $label_sistema = $label_sistema." ".$sistema->nombre." ".$sistema->marca;
                 }   

                }
            }

            if($datos['encuesta']){
               $adjuvantes = $this->Encuestas_model->get_adjuvantes_encuesta($datos['encuesta']->id_encuesta);
            }
            if($adjuvantes){
                foreach ($adjuvantes as $key => $adjuvante) {
                 if($key >0){
                    $label_adjuvante = $label_adjuvante.", ".$adjuvante->nombre;
                 }else{
                     $label_adjuvante = $label_adjuvante." ".$adjuvante->nombre;
                 }   

                }
            }

            $datos['encuesta']->adjuvantes = $label_adjuvante;
            $datos['encuesta']->sistemas = $label_sistema;


            $this->load->view('header.php');
            $this->load->view('pacientes/encuesta_resumen', $datos);
            $this->load->view('footer.php');    

    }

    public function set_direccion()
    {
        $this->load->model('Pacientes_model');
        $cita    = $this->input->post('cita');
        $id_paciente = $this->encrypt->decode(base64_decode($cita["paciente"]["id_paciente"]));
        $direccion   = $cita["nuevo_domicilio"];
        $this->Pacientes_model->set_direccion($id_paciente,$direccion);


        $domicilios  = $this->Pacientes_model->get_direcciones_paciente($id_paciente);
         if($domicilios){
            foreach($domicilios as $domicilio){
                $domicilios_list[] = array('id_direccion' => base64_encode($this->encrypt->encode($domicilio->id_direccion)), 'direccion' => $domicilio->direccion, 'defecto' =>$domicilio->defecto );
                                                                                                
            }
        }else{
            $domicilios_list[] = '{}';
        }
        echo(json_encode($domicilios_list));
    }

}