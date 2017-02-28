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

    public function registrar_ubicacion_herida($id_herida, $id_ubicacion)
    {
        $data = array(
            'herida'                        => $id_herida,
            'ubicacion'              => $id_ubicacion
        );
        $this->db->set('created', 'NOW()', false);
        $this->db->insert('ubicacion_herida', $data);

        return $this->db->insert_id();
    }

    public function get_clasificaciones_tipo_herida($id_tipo_herida)
    {
        $this->db
            ->select('cth.*')
            ->from('clasificacion_tipo_herida cth')
            ->where('cth.tipo_herida', $id_tipo_herida);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_heridas_paciente($id_diagnostico)
    {
        $this->db
            ->select('e.*,th.*, e.created as fecha_registro, pe.nombre as nombre_profesional, pe.apellido_paterno  as apellido_paterno')
            ->from('heridas e')
            ->join('tipos_heridas th', 'e.tipo_herida = th.id_tipo_herida')
            ->join('herida_profesional hp', 'e.id_heridas = hp.herida')
            ->join('profesionales p', 'hp.profesional = p.id_profesional')
            ->join('usuarios u', 'p.usuario  = u.id_usuario')
            ->join('personas pe', 'u.persona  = pe.id_persona')
            ->where('e.diagnostico', $id_diagnostico)
            //->group_by('a.id_atencion')
            ->order_by('e.id_heridas', 'DESC');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_ubicacion_herida($id_herida)
    {
        $this->db
            ->select('*')
            ->from('ubicacion_herida uh')
            ->join('ubicaciones_estomas he', 'uh.ubicacion = he.id_ubicacion_estoma')
            ->where('uh.herida', $id_herida);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }



}
