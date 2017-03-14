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
            ->where('vp.usuario', $id_usuario)
            ->order_by('vp.created', 'DESC');

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

    public function ventas_mensuales_vendedor($id_usuario)
    {
        $consulta = $this->db->query("SELECT Count(pv.id_paciente_vendedor)  AS numero_ventas,
                                        DATE_FORMAT(pv.created, '%m') AS periodo
                                        FROM
                                            paciente_vendedor pv
                                        WHERE
                                            pv.usuario = $id_usuario
                                        GROUP BY DATE_FORMAT(pv.created, '%m')
                                        ORDER BY periodo ASC");

        //var_dump($this->db->last_query()); die();

        if ($consulta->num_rows() > 0)
        {
            return $consulta->result();
        } 
        else
        {
            return FALSE;
        }
    } 

}
