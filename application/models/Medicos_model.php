<?php

class Medicos_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function get_medicos()
    {
        $this->db
            ->select('u.*, p.*, pe.*, e.especialidad as especialidad')
            ->from('profesionales p')
            ->join('usuarios u', 'p.usuario  = u.id_usuario')
            ->join('personas pe', 'u.persona  = pe.id_persona')
            ->join('especialidades e', 'p.especialidad  = e.id_especialidad');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_enfermeras_activas()
    {
        $this->db
            ->select('u.*, p.*, pe.*, e.especialidad as especialidad')
            ->from('profesionales p')
            ->join('usuarios u', 'p.usuario  = u.id_usuario')
            ->join('personas pe', 'u.persona  = pe.id_persona')
            ->join('especialidades e', 'p.especialidad  = e.id_especialidad')
            ->where('e.id_especialidad', 4)
            ->where('u.activo',1);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_enfermeras()
    {
        $this->db
            ->select('u.*, p.*, pe.*, e.especialidad as especialidad')
            ->from('profesionales p')
            ->join('usuarios u', 'p.usuario  = u.id_usuario')
            ->join('personas pe', 'u.persona  = pe.id_persona')
            ->join('especialidades e', 'p.especialidad  = e.id_especialidad')
            ->where('e.id_especialidad', 4);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_profesional($id_profesional)
    {
        $this->db
            ->select('u.*, p.*, pe.*, e.especialidad as especialidad')
            ->from('profesionales p')
            ->join('usuarios u', 'p.usuario  = u.id_usuario')
            ->join('personas pe', 'u.persona  = pe.id_persona')
            ->join('especialidades e', 'p.especialidad  = e.id_especialidad')
            ->where('p.id_profesional', $id_profesional);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->row();
        } else {
            return false;
        }
    }

    public function get_profesional_usuario($id_usuario)
    {
        $this->db
            ->select('u.*, p.*, pe.*, e.especialidad as especialidad, u.usuario as nombre_usuario')
            ->from('profesionales p')
            ->join('usuarios u', 'p.usuario  = u.id_usuario')
            ->join('personas pe', 'u.persona  = pe.id_persona')
            ->join('especialidades e', 'p.especialidad  = e.id_especialidad')
            ->where('p.usuario', $id_usuario);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->row();
        } else {
            return false;
        }
    }

    public function set_profesional($id_usuario,  $id_especialidad, $duracionHora, $telefono, $color, $color_calendario)
    {

        $data = array(
            'usuario'           => $id_usuario,
            'especialidad'      => $id_especialidad,
            'duracionHora'      => $duracionHora,
            'telefono'          => $telefono,
            'color'             => $color,
            'color_calendario'  => $color_calendario,
        );

        $this->db->insert('profesionales', $data);

        return $this->db->insert_id();
    }

    public function get_medicos_especialidad($id_especialidad)
    {
        $this->db
            ->select('*')
            ->from('profesionales p')
            ->join('usuarios u', 'p.usuario = u.id_usuario')
             ->join('personas pe', 'u.persona = pe.id_persona')
            ->join('especialidades e', 'p.especialidad = e.id_especialidad')
            ->where('u.activo', 'si')
            ->where('e.id_especialidad', $id_especialidad);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_medicos_establecimiento($id_establacimiento)
    {
        $this->db
            ->select('m.id_medico, m.nombres')
            ->from('medicos m')
            ->join('establecimientos e', 'm.establecimiento = e.id_establecimiento')
            ->where('m.activo', 1)
            ->where('e.id_establecimiento', $id_establacimiento);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function set_nuevo_medico($id_establecimiento, $nombres, $id_especialidad)
    {
        $data = array(
            'establecimiento'   => $id_establecimiento,
            'nombres'           => $nombres,
            'especialidad'      => $id_especialidad
        );
        $this->db->insert('medicos', $data);

        return $this->db->insert_id();
    }

}
