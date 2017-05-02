<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Heridas extends CI_Controller {

	public function __construct() {
        parent::__construct();

    }


    public function set_herida_paciente()
    {
        $this->load->model('Pacientes_model');
        $this->load->model('Medicos_model');
        $this->load->model('Fichas_model');
        $this->load->model('Atenciones_model');
        $this->load->model('Medicamentos_model');
        $this->load->model('Heridas_model');


        $id_paciente = $this->encrypt->decode(base64_decode($this->uri->segment(3)));
        $herida                     = $this->input->post('herida');
        $diagnostico                = $this->input->post('diagnostico');
        $ubicaciones_herida         = isset($herida['ubicacion']) ? $herida['ubicacion'] : false;
        $id_herida                  = isset($herida['id_herida']) ? $herida['id_herida'] : false;

        //datos para herida profesional
        $profesional = $this->Medicos_model->get_profesional_usuario($this->session->userdata('id_usuario'));

        //Datos para herida
        $id_tipo_herida             = isset($herida['tipo_herida']) ? $this->encrypt->decode(base64_decode($herida['tipo_herida']['id_tipo_herida'])) : false;
        $id_diagnostico             = isset($diagnostico['id_diagnostico']) ? $diagnostico['id_diagnostico'] : false;

        //datos para valoracion herida
        $profundidad_herida         = isset($herida['profundidad_herida']) ? $herida['profundidad_herida'] : null;
        $ancho_herida               = isset($herida['ancho_herida']) ? $herida['ancho_herida'] : null;
        $largo_herida               = isset($herida['largo_herida']) ? $herida['largo_herida'] : null;
        $tejido_granulatorio        = isset($herida['tejido_granulatorio']) ? $herida['tejido_granulatorio'] : null;
        $comentario                 = isset($herida['comentario']) ? $herida['comentario'] : '';


        $id_clasificacion_tipo_herida  = (isset($herida['clasificacion_tipo_herida']['id_clasificacion_tipo_herida']) && $herida['clasificacion_tipo_herida'] != null)  ? $this->encrypt->decode(base64_decode($herida['clasificacion_tipo_herida']['id_clasificacion_tipo_herida'])) : false;
        if($id_diagnostico){
            if($id_herida){
                $this->Heridas_model->update_herida_paciente($id_herida, $id_tipo_herida, $profundidad_herida, $ancho_herida, $largo_herida, $tejido_granulatorio, $comentario);
            }else{
                $id_herida = $this->Heridas_model->set_herida_paciente($id_diagnostico, $id_tipo_herida, $profundidad_herida, $ancho_herida, $largo_herida, $tejido_granulatorio, $comentario);

            }
            //Se debe setear la clasificacion del tipo de herida en caso de existir, si no existe se deben eliminar las existentes
            if($id_clasificacion_tipo_herida){
                $herida_clasificacion_tipo_herida = $this->Heridas_model->get_clasificacion_tipo_herida_id_herida($id_herida);
                if($herida_clasificacion_tipo_herida){
                    $this->Heridas_model->update_herida_clasificacion_tipo_herida($herida_clasificacion_tipo_herida->id_herida_clasificacion_tipo_herida,  $id_clasificacion_tipo_herida);
                }else{
                    $this->Heridas_model->set_herida_clasificacion_tipo_herida($id_herida,  $id_clasificacion_tipo_herida);
                }
            }else{
                // si no viene clasificacion tipo herida se eliminar las existentes
                $this->Heridas_model->delete_herida_clasificacion_tipo_herida($id_herida);
            }
            if($ubicaciones_herida){
                $this->Heridas_model->borrar_ubicaciones_herida($id_herida);
                foreach ($ubicaciones_herida as $ubicacion_herida) {
                    $this->Heridas_model->registrar_ubicacion_herida($id_herida,$ubicacion_herida['id_ubicacion_estoma']);
                }
            }else{
                $this->Heridas_model->borrar_ubicaciones_herida($id_herida);
            }

            //registrar herida profesional
            $this->Heridas_model->registrar_herida_profesional($id_herida, $profesional->id_profesional, 0);

            $heridas_paciente = $this->Heridas_model->get_heridas_paciente($id_diagnostico);
                 if($heridas_paciente){
                    foreach ($heridas_paciente as $herida) {
                        $herida->ubicaciones = $this->Heridas_model->get_ubicacion_herida($herida->id_heridas);
                        $tipo_herida = $this->Heridas_model->get_tipo_herida($herida->tipo_herida);
                        if($tipo_herida){
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
                        $heridas_list[] = array('id_herida' => $herida->id_heridas, 'diagnostico' => $herida->diagnostico ,'tipo_herida' => $herida->tipo_herida,'ubicacion'=> $ubicaciones_herida_value,  'clasificacion_tipo_herida' => $herida->clasificacion_tipo_herida, 'profesional'=>$herida->nombre_profesional." ".$herida->apellido_paterno, 'profundidad_herida'=> floatval($herida->profundidad), 'largo_herida'=> floatval($herida->largo), 'ancho_herida'=>floatval($herida->ancho), 'tejido_granulatorio'=>$herida->tejido_granulatorio, 'comentario'=>$herida->comentario, 'fecha_herida'=>$herida->fecha_herida, 'pintar' => true);
                    }
                    $datos['heridas'] = json_encode($heridas_list);
                }
                else{
                    $datos['heridas'] = '[]';
                }

        }
        echo $datos['heridas'];

    }

    public function get_clasificacion_herida()
    {
        $this->load->model('Heridas_model');

        $tipo_herida= $this->input->post('tipo_herida');
        $id_tipo_herida = $this->encrypt->decode(base64_decode($tipo_herida['id_tipo_herida']));

        $clasificaciones_herida = $this->Heridas_model->get_clasificaciones_tipo_herida($id_tipo_herida);

        if($clasificaciones_herida){
            foreach ($clasificaciones_herida as $clasificacion)
            {
                 $clasificaciones_values[] = array('id_clasificacion_tipo_herida' => base64_encode($this->encrypt->encode($clasificacion->id_clasificacion_tipo_herida)), 'nombre' => $clasificacion->nombre);
            }
            echo json_encode($clasificaciones_values);
        }else{
            echo false;
        }

    }

}
