<?php

class Citas_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    
    public function get_citas($ids_enfermeras)
    {
        $this->db
            ->select('c.*, ta.nombre as nombre_tipo_atencion, pe.nombre as nombre_profesional, pe.apellido_paterno  as apellido_paterno, p.id_paciente as id_paciente, p.nombres as nombre_paciente, pro.color as color, pro.color_calendario as color_calendario')
            ->from('citas c')
            ->join('tipo_atencion ta', 'c.tipo_atencion = ta.id_tipo_atencion')
            ->join('pacientes p', 'c.paciente = p.id_paciente')
            ->join('profesionales pro', 'c.profesional = pro.id_profesional')
            ->join('usuarios u', 'pro.usuario = u.id_usuario')
            ->join('personas pe', 'u.persona = pe.id_persona')
            ->where('u.activo', 1)
            ->where_in('c.profesional', $ids_enfermeras);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }
    public function get_cita($id_cita)
    {
        $this->db
            ->select('c.*,ta.id_tipo_atencion, ta.nombre as nombre_tipo_atencion, u.id_usuario as id_usuario, pe.nombre as nombre_profesional, pe.apellido_paterno  as apellido_paterno, p.id_paciente as id_paciente, p.nombres as nombre_paciente, p.apellido_paterno as apellido_paterno_paciente, p.apellido_materno as apellido_materno_paciente, p.rut as rut_paciente,p.contigo, p.diagnostico, p.domiciliario, pro.color as color, pro.color_calendario as color_calendario ')
            ->from('citas c')
            ->join('tipo_atencion ta', 'c.tipo_atencion = ta.id_tipo_atencion')
            ->join('pacientes p', 'c.paciente = p.id_paciente')
            ->join('profesionales pro', 'c.profesional = pro.id_profesional')
            ->join('usuarios u', 'pro.usuario = u.id_usuario')
            ->join('personas pe', 'u.persona = pe.id_persona')
            ->where('c.id_cita', $id_cita);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->row();
        } else {
            return false;
        }
    }

    public function set_nueva_cita($id_tipo_atencion, $id_profesional, $id_paciente, $fecha_hora_inicio, $fecha_hora_fin ,$id_direccion)
    {
        $data = array(
            'tipo_atencion'            => $id_tipo_atencion,
            'paciente'                 => $id_paciente,
            'profesional'              => $id_profesional,
            'fecha_inicio'             => $fecha_hora_inicio,
            'fecha_fin'                => $fecha_hora_fin,
            'direcciones_paciente'     => $id_direccion

        );
        $this->db->set('created', 'NOW()', false);
        $this->db->insert('citas', $data);

        return $this->db->insert_id();
    }

    public function update_cita($id_cita, $id_tipo_atencion, $id_profesional, $id_paciente, $fecha_hora_inicio, $fecha_hora_fin,$id_direccion_paciente)
    {
        $data = array(
            'tipo_atencion'            => $id_tipo_atencion,
            'paciente'                 => $id_paciente,
            'profesional'              => $id_profesional,
            'fecha_inicio'             => $fecha_hora_inicio,
            'fecha_fin'                => $fecha_hora_fin,
            'direcciones_paciente '    => $id_direccion_paciente

        );

        $this->db->set('modified', 'NOW()', false);
        $this->db->where('id_cita', $id_cita);
        $this->db->update('citas', $data);

        return true;
    }

}
