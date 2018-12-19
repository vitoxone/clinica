<?php

class Fichas_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function get_contactos_seguimiento($id_formulario)
    {
        $this->db
            ->select('*')
            ->from('contactos')
            ->where('formulario_contacto', $id_formulario)
            ->order_by('numero', 'ASC');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function is_seguimiento_activo($id_paciente)
    {
        $this->db
            ->select('*')
            ->from('contacto_paciente')
            ->where('paciente', $id_paciente);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

     public function set_contacto_paciente($id_paciente, $id_contacto, $fecha)
    {
        $data = array(
            'paciente'                  => $id_paciente,
            'contacto'                  => $id_contacto,
            'fecha'                     => $fecha
        );
        $this->db->set('created', 'NOW()', false);
        $this->db->insert('contacto_paciente', $data);

        return $this->db->insert_id();
    }


    public function get_isapres()
    {
        $this->db
            ->select('*')
            ->from('isapres')
            ->where('activa', '1');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_cies()
    {
        $this->db
            ->select('*')
            ->from('cie10');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }
    public function get_adjuvantes($actual)
    {
        $this->db
            ->select('*')
            ->from('adjuvantes')
            ->where('actual', $actual);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_tipos_atenciones_activas()
    {
        $this->db
            ->select('*')
            ->from('tipo_atencion')
            ->where('activo', 1);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_complicaciones_tipo_estomia($id_tipo_ostomia)
    {
        $this->db
            ->select('c.*, to.categoria as categoria')
            ->from('complicaciones c')
            ->join('tipos_ostomia to', 'c.tipo_ostomia = to.id_tipo_ostomia')
            ->where('to.id_tipo_ostomia', $id_tipo_ostomia);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_tipos_ostomias()
    {
        $this->db
            ->select('*')
            ->from('tipos_ostomia')
            //->where('activa', 1);
            //->group_by('categoria')
            ->order_by('orden','ASC');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }
    public function get_marcas_sistemas()
    {
        $this->db
            ->select('*')
            ->from('sistemas')
            ->where('estado', 1);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }
    public function get_sistemas_convatec()
    {
        $this->db
            ->select('*')
            ->from('sistemas')
            ->where('estado', 1)
            ->where('marca', 'Convatec');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }
    public function get_sistemas_por_marca($marca)
    {
        $this->db
            ->select('*')
            ->from('sistemas')
            ->where('estado', 1)
            ->where('marca', $marca);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }
    public function get_tipos_ostomias_por_categoria($categoria)
    {
        $this->db
            ->select('*')
            ->from('tipos_ostomia')
            ->where('activa', 1)
            ->where('categoria', $categoria);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_ubicacion_estoma($id_ubicacion)
    {
        $this->db
            ->select('*')
            ->from('ubicaciones_estomas')
            ->where('id_ubicacion_estoma', $id_ubicacion);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->row();
        } else {
            return false;
        }
    }
    public function get_tipo_ostomia($id_tipo_ostomia)
    {
        $this->db
            ->select('*')
            ->from('tipos_ostomia')
            ->where('id_tipo_ostomia', $id_tipo_ostomia);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->row();
        } else {
            return false;
        }
    }
    public function get_categoria_ostomia($id_categoria_ostomia)
    {
        $this->db
            ->select('*')
            ->from('categorias_ostomia')
            ->where('id_categoria_ostomia', $id_categoria_ostomia);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->row();
        } else {
            return false;
        }
    }

    public function get_categorias_ostomias()
    {
        $this->db
            ->select('*')
            ->from('categorias_ostomia')
            ->where('activa', 1)
            ->order_by('id_categoria_ostomia');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_ubicaciones_estomas($tipo)
    {
        $this->db
            ->select('*')
            ->from('ubicaciones_estomas')
            ->where('tipo', $tipo);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_barreras()
    {
        $this->db
            ->select('*')
            ->from('barreras')
            ->where('activa', 1);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_bolsas()
    {
        $this->db
            ->select('*')
            ->from('bolsas')
            ->where('activa', 1);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_tipos_accesorios()
    {
        $this->db
            ->select('*')
            ->from('tipos_accesorios')
            ->where('activo', 1);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_establecimiento($id_establecimiento)
    {
        $this->db
            ->select('e.*, c.comuna as nombre_comuna')
            ->from('establecimientos e')
            ->join('comunas c', 'e.comuna = c.id')
            ->where('e.id_establecimiento', $id_establecimiento);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->row();
        } else {
            return false;
        }
    }

    public function get_medico_tratante($id_medico){
        $this->db
            ->select('m.*')
            ->from('medicos m')
            ->where('m.id_medico', $id_medico);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->row();
        } else {
            return false;
        } 
    }
    
    public function get_medicos_establecimiento($id_establecimiento){
        $this->db
            ->select('m.*')
            ->from('medicos m')
            ->where('m.establecimiento', $id_establecimiento);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        } 
    }

    public function get_establecimientos()
    {
        $this->db
            ->select('e.*, c.comuna as nombre_comuna')
            ->from('establecimientos e')
            ->join('comunas c', 'e.comuna = c.id')
            ->where('e.estado', 1);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_total_establecimientos()
    {
        $this->db
            ->select('e.*, c.comuna as nombre_comuna, r.region as nombre_region')
            ->from('establecimientos e')
            ->join('comunas c', 'e.comuna = c.id')
            ->join('regiones r', 'c.region = r.id_region')
            ->where('e.estado', 1);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_formularios_contactos()
    {
        $this->db
            ->select('fc.*')
            ->from('formulario_contacto fc');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function registrar_sistema_encuesta($id_encuesta, $id_sistema)
    {
        $data = array(
            'encuesta'                 => $id_encuesta,
            'sistema'                  => $id_sistema
        );
        $this->db->set('created', 'NOW()', false);
        $this->db->insert('sistema_encuesta', $data);

        return $this->db->insert_id();
    }

    public function registrar_adjuvante_encuesta($id_encuesta, $id_adjuvante)
    {
        $data = array(
            'encuesta'                   => $id_encuesta,
            'adjuvante'                  => $id_adjuvante
        );
        $this->db->set('created', 'NOW()', false);
        $this->db->insert('adjuvante_encuesta', $data);

        return $this->db->insert_id();
    }

    public function set_alias_establecimiento($id_establecimiento, $alias)
    {
        $data = array(
            'alias'      => $alias
        );

        $this->db->where('id_establecimiento', $id_establecimiento);
        $this->db->update('establecimientos', $data);

        return true;
    }

    public function update_contacto_paciente_encuesta($id_contacto_paciente, $id_encuesta, $contesta){
        if($contesta){
            $exitoso = 1; 
            $fallido = 0;
        }else{
            $exitoso = 0; 
            $fallido = 1;
        }

        $data = array(
            'encuesta' => $id_contacto_paciente,
            'pendiente' => 0,
            'exitoso' => $exitoso,
            'fallido' => $fallido
        );

        $this->db->where('id_contacto_paciente', $id_contacto_paciente);
        $this->db->update('contacto_paciente', $data);

        return true;

    }

}
