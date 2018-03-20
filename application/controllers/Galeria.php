<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galeria extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('galeria_model');
        $this->load->helper('download');
    }

    function guardar_imagen(){
         $this->load->library('form_validation');
         $this->config->set_item('language', 'spanish');
            $this->load->helper('form');
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('imagen_nombre','Nombre','required');
            //$this->form_validation->set_rules('imagen_detalle','Detalle','required');
            if (empty($_FILES['imagen_archivo']['name'])){
                $this->form_validation->set_rules('imagen_archivo','Imagen','required');
            }

            if ($this->form_validation->run() === TRUE) {
                $this->load->library('aws3');
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 0;
                $config['max_width']            = 5000;
                $config['max_height']           = 5000;

                $_FILES['userfile'] = $_FILES['imagen_archivo'];
         
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ( ! $this->upload->do_upload('imagen_archivo')){
                    
                    $rows[0]["tipo"] = "error_imagen";
                    $rows[1]["mensaje"] = $this->upload->display_errors();
                    echo json_encode($rows);
                }else{

                    $file_info = $this->upload->data();
                    $imagen = $file_info['file_name'];
                    $_FILES['userfile']['name'] = $file_info['file_name'];
         
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './upload/'.$imagen;
                    $config['create_thumb'] = TRUE;
                    $config['maintain_ratio'] = TRUE;
                    $config['thumb_marker'] = FALSE;
                    $config['new_image'] = './upload/tumb_'.$imagen;
                    $config['width']         = 300;
                    $config['height']       = 300;
         
                    $this->load->library('image_lib', $config);
         
                    $this->image_lib->resize();
                    date_default_timezone_set('America/Santiago');
                    $slug = convert_accented_characters($imagen);
                    $data = array(
                        'id_paciente' => $this->input->post('id_paciente'),
                        'nombre' => $this->input->post('imagen_nombre'),
                        'detalle' => $this->input->post('imagen_detalle'),
                        'slug' => $slug,
                        'id_usuario' => $this->session->userdata('id_usuario'),
                        'fecha_creacion' => date('Y-m-d H:i:s',time()),
                        );
                    if ($this->galeria_model->guardar_imagen($data)){
                        $mensaje = "<p>Imagen guardada correctamente</p>";
                        $rows[0]["tipo"] = "mensaje";

                        //Se sube a Amazon S3
                        $image_data['file_name'] = $this->aws3->sendFile('convatec2018imagenespacientes', $_FILES['userfile']);    
 

                    }else{
                        $rows[0]["tipo"] = "error_imagen";
                        $mensaje = "<p>Error al guardar la imagen</p>";

                    } 
                    $rows[1]["mensaje"] = $mensaje;
                    echo json_encode($rows); 
                } 
                 
            }else{
                $rows[0]["tipo"] = "validacion";
                $rows[1]["mensaje"] = validation_errors('<p>','</p>');
                echo json_encode($rows);
            }
        } else {
            show_404();
        }
    }
    
    function editar_imagen(){
         $this->load->library('form_validation');
         $this->config->set_item('language', 'spanish');
            $this->load->helper('form');
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('imagen_nombre','Nombre','required');
            //$this->form_validation->set_rules('imagen_detalle','Detalle','required');
            
            if ($this->form_validation->run() === TRUE) {

                if (empty($_FILES['imagen_archivo']['name'])){
                    date_default_timezone_set('America/Lima');
                    $data = array(
                        'id_paciente' => $this->input->post('id_paciente'),
                        'nombre' => $this->input->post('imagen_nombre'),
                        'detalle' => $this->input->post('imagen_detalle'),
                        'id_usuario' => $this->session->userdata('id_usuario'),
                        'fecha_modificacion' => date('Y-m-d H:i:s',time()),
                        );
                    if ($this->galeria_model->actualizar_imagen($data,$this->input->post('id_imagen_nueva'))){
                        $mensaje = "<p>Imagen actualizada correctamente</p>";
                        $rows[0]["tipo"] = "mensaje";
                    }else{
                        $rows[0]["tipo"] = "error_imagen";
                        $mensaje = "<p>Edite por lo menos un campo</p>";

                    }
                    $rows[1]["mensaje"] = $mensaje;
                    echo json_encode($rows);  
                }else{

                    $this->load->library('aws3');
                    $config['upload_path']          = './uploads/';
                    $config['allowed_types']        = 'gif|jpg|png|jpeg';
                    $config['max_size']             = 0;
                    $config['max_width']            = 5000;
                    $config['max_height']           = 5000;
             
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ( ! $this->upload->do_upload('imagen_archivo')){
                        $rows[0]["tipo"] = "error_imagen";
                        $rows[1]["mensaje"] = $this->upload->display_errors();
                        echo json_encode($rows);
                    }else{

                        $file_info = $this->upload->data();
                        $imagen = $file_info['file_name'];
             
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = './upload/'.$imagen;
                        $config['create_thumb'] = TRUE;
                        $config['maintain_ratio'] = TRUE;
                        $config['thumb_marker'] = FALSE;
                        $config['new_image'] = './upload/tumb_'.$imagen;
                        $config['width']         = 300;
                        $config['height']       = 300;
             
                        $this->load->library('image_lib', $config);
             
                        $this->image_lib->resize();
                        date_default_timezone_set('America/Lima');
                        $slug = convert_accented_characters($imagen);
                        $data = array(
                            'id_paciente' => $this->input->post('id_paciente'),
                            'nombre' => $this->input->post('imagen_nombre'),
                            'detalle' => $this->input->post('imagen_detalle'),
                            'slug' => $slug,
                            'id_usuario' => $this->session->userdata('id_usuario'),
                            'fecha_modificacion' => date('Y-m-d H:i:s',time()),
                            );
                        if ($this->galeria_model->actualizar_imagen($data,$this->input->post('id_imagen_nueva'))){
                            $mensaje = "<p>Imagen actualizada correctamente</p>";
                            $rows[0]["tipo"] = "mensaje";
                        }else{
                            $rows[0]["tipo"] = "error_imagen";
                            $mensaje = "<p>Error al actualizar la imagen</p>";

                        } 
                        $rows[1]["mensaje"] = $mensaje;
                        echo json_encode($rows); 
                    } 
                }
                
                 
            }else{
                $rows[0]["tipo"] = "validacion";
                $rows[1]["mensaje"] = validation_errors('<p>','</p>');
                echo json_encode($rows);
            }
        } else {
            show_404();
        }
    }

    public function descargar_imagenes(){
        $imagen = explode("||", $this->input->post('lista'));
        $var = array();
        for ($i=0; $i < (count($imagen) - 1) ; $i++) { 
            array_push($var, $imagen[$i]);
        }
        
        $data = file_get_contents('./assets/img/back.png'); 
       force_download("nueva.png",$data); 

    }

    public function downloads($name){
         
       $data = file_get_contents('./uploads/'.$name); 
       force_download($name,$data); 
     
    }
    public function eliminar_imagenes(){
        $rows = $this->galeria_model->eliminar_imagenes($this->input->post('lista'));
        echo json_encode($rows);
    }

    public function datos_imagen(){
        $rows = $this->galeria_model->obtener_datos($this->input->post('id_imagen'));
        echo json_encode($rows);
    }

    public function mostrar_galeria(){
        $rows = $this->galeria_model->obtener_galerias($this->input->post('id_paciente'));
        echo json_encode($rows);
    }

    public function eliminar_imagen(){
        $rows = $this->galeria_model->delete($this->input->post('id_imagen'));
        echo json_encode($rows);
    }

}