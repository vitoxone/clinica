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

        //datos para herida profesional
        $profesional = $this->Medicos_model->get_profesional_usuario($this->session->userdata('id_usuario'));

        //Datos para herida
        $tipo_herida                = isset($herida['tipo_herida']) ? $herida['tipo_herida']['id_tipo_herida'] : false;
        $id_diagnostico             = isset($diagnostico['id_diagnostico']) ? $diagnostico['id_diagnostico'] : false;

        //datos para valoracion herida
        $ancho_herida               = isset($herida['ancho_herida']) ? $herida['ancho_herida'] : false;
        $largo_herida               = isset($herida['largo_herida']) ? $herida['largo_herida'] : false;
        $tejido_granulatorio        = isset($herida['tejido_granulatorio']) ? $herida['tejido_granulatorio'] : false;
        $comentario                 = isset($herida['comentario']) ? $herida['comentario'] : false;



        if($id_diagnostico){
            $id_herida = $this->Heridas_model->set_herida_paciente($id_diagnostico, $tipo_herida, NULL);

            //registrar herida profesional
            $this->Heridas_model->registrar_herida_profesional($id_herida, $profesional->id_profesional, 0);
            die();

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

}
