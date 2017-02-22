<?php

class Ventas_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function get_ventas_usuario($id_usuario)
    {
        $this->db
            ->select('vp.*, p.*')
            ->from('paciente_vendedor vp')
            ->join('pacientes p', 'vp.paciente = p.id_paciente')
            ->where('vp.usuario', $id_usuario);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }


    public function registrar_venta_paciente($id_paciente, $id_usuario)
    {
        $data = array(
            'paciente'                 => $id_paciente,
            'usuario'                  => $id_usuario
        );
        $this->db->set('created', 'NOW()', false);
        $this->db->insert('paciente_vendedor', $data);

        return $this->db->insert_id();
    }

}
