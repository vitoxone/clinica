<?php

class Heridas_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function get_tipos_heridas()
    {
        $this->db
            ->select('*')
            ->from('tipos_heridas')
            ->where('activo', 1)
            ->order_by('id_tipo_herida','ASC');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function set_herida_paciente($id_diagnostico, $tipo_herida, $ubicacion)
    {
        $data = array(
            'diagnostico'                       => $id_diagnostico,
            'tipo_herida'                       => $tipo_herida,
            'ubicacion'                  => $ubicacion
        );
        $this->db->set('created', 'NOW()', false);
        $this->db->insert('heridas', $data);

        return $this->db->insert_id();
    }

    public function registrar_herida_profesional($id_herida, $id_profesional, $primer_registro)
    {
        $data = array(
            'herida'                        => $id_herida,
            'profesional'                  => $id_profesional,
            'primer_registro'              => $primer_registro
        );
        $this->db->set('created', 'NOW()', false);
        $this->db->insert('herida_profesional', $data);

        return $this->db->insert_id();
    }



}
