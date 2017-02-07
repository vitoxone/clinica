<?php

class Especialidades_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function get_especialidades()
    {
        $this->db
            ->select('e.*')
            ->from('especialidades e')
            ->join('profesionales p', 'p.especialidad = e.id_especialidad')
            ->where('e.activa', '1');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_especialidades_externas()
    {
        $this->db
            ->select('e.*')
            ->from('especialidades e')
            ->where('e.activa', '1')
            ->where('e.externo', '1');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_especialidades_internas()
    {
        $this->db
            ->select('e.*')
            ->from('especialidades e')
            ->where('e.activa', '1')
            ->where('e.externo', '0');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

}
