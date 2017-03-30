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

    public function get_tipo_herida($id_tipo_herida)
    {
        $this->db
            ->select('*')
            ->from('tipos_heridas')
            ->where('activo', 1)
            ->where('id_tipo_herida', $id_tipo_herida)
            ->order_by('id_tipo_herida','ASC');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function set_herida_paciente($id_diagnostico, $tipo_herida, $profundidad_herida, $largo_herida, $ancho_herida, $tejido_granulatorio, $comentario)
    {
        $data = array(
            'diagnostico'              => $id_diagnostico,
            'tipo_herida'              => $tipo_herida,
            'profundidad'              => $profundidad_herida,
            'largo'                    => $largo_herida,
            'ancho'                    => $ancho_herida,
            'tejido_granulatorio'      => $tejido_granulatorio,
            'comentario'               => $comentario,
        );
        $this->db->set('created', 'NOW()', false);
        $this->db->insert('heridas', $data);

        return $this->db->insert_id();
    }

    public function update_herida_paciente($id_herida, $tipo_herida, $profundidad_herida, $largo_herida, $ancho_herida, $tejido_granulatorio, $comentario)
    {
        $data = array(
            'tipo_herida'              => $tipo_herida,
            'profundidad'              => $profundidad_herida,
            'largo'                    => $largo_herida,
            'ancho'                    => $ancho_herida,
            'tejido_granulatorio'      => $tejido_granulatorio,
            'comentario'               => $comentario,
        );
        $this->db->set('modified', 'NOW()', false);
        $this->db->where('id_heridas', $id_herida);
        $this->db->update('heridas', $data);

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

    public function borrar_ubicaciones_herida($id_herida)
    {
        $this->db->where('herida', $id_herida);
        $this->db->delete('ubicacion_herida'); 

    }

    public function delete_herida_clasificacion_tipo_herida($id_herida)
    {
        $this->db->where('herida', $id_herida);
        $this->db->delete('herida_clasificacion_tipo_herida'); 

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

    public function get_clasificacion_tipo_herida_id_herida($id_herida)
    {
        $this->db
            ->select('hcth.*, cth.*')
            ->from('herida_clasificacion_tipo_herida hcth')
            ->join('clasificacion_tipo_herida cth', 'hcth.clasificacion_tipo_herida = cth.id_clasificacion_tipo_herida')
            ->where('hcth.herida', $id_herida);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->row();
        } else {
            return false;
        }
    }

    public function update_herida_clasificacion_tipo_herida($id_herida_clasificacion_tipo_herida, $id_clasificacion_tipo_herida)
    {
        $data = array(
            'clasificacion_tipo_herida'   => $id_clasificacion_tipo_herida
        );
        $this->db->set('modified', 'NOW()', false);
        $this->db->where('id_herida_clasificacion_tipo_herida', $id_herida_clasificacion_tipo_herida);
        $this->db->update('herida_clasificacion_tipo_herida', $data);

        return $this->db->insert_id();
    }

    public function set_herida_clasificacion_tipo_herida($id_herida, $id_clasificacion_tipo_herida)
    {
        $data = array(
            'herida'   => $id_herida,
            'clasificacion_tipo_herida'   => $id_clasificacion_tipo_herida
        );
        $this->db->set('created', 'NOW()', false);
        $this->db->insert('herida_clasificacion_tipo_herida', $data);

        return $this->db->insert_id();
    }


    public function get_heridas_paciente($id_diagnostico)
    {
        $this->db
            ->select('h.*,th.*, h.created as fecha_herida, pe.nombre as nombre_profesional, pe.apellido_paterno  as apellido_paterno')
            ->from('heridas h')
            ->join('tipos_heridas th', 'h.tipo_herida = th.id_tipo_herida')
            ->join('herida_profesional hp', 'h.id_heridas = hp.herida')
            ->join('profesionales p', 'hp.profesional = p.id_profesional')
            ->join('usuarios u', 'p.usuario  = u.id_usuario')
            ->join('personas pe', 'u.persona  = pe.id_persona')
            ->where('h.diagnostico', $id_diagnostico)
            ->group_by('h.id_heridas')
            ->order_by('h.id_heridas', 'DESC');

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
