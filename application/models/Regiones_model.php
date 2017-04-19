<?php

class Regiones_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_regiones()
    {
        $this->db
            ->select('*')
            ->from('regiones')
            ->where('activo', '1')
            ->order_by('orden', 'asc');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_comunas_by_region($id_region)
    {
        $this->db
            ->select('c.*')
            ->from('comunas c')
            ->where('c.region', $id_region);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function set_nueva_direccion($direccion, $id_comuna)
    {
        $data = array(
            'direccion'     => $direccion,
            'comuna'        => $id_comuna); 


        $this->db->insert('direccion', $data);

        return $this->db->insert_id();
    }


    public function vincular_direccion_paciente($id_paciente, $id_direccion, $defecto)
    {
        $data = array(
            'paciente'         => $id_paciente,
            'direccion'        => $id_direccion,
            'defecto'          => $defecto); 


        $this->db->insert('direcciones_paciente', $data);

        return $this->db->insert_id();
    }

    public function actualizar_direccion($id_direccion, $direccion, $id_comuna)
    {
        $data = array(
            'direccion'     => $direccion,
            'comuna'        => $id_comuna); 

        $this->db->where('id_direccion', $id_direccion);
        $this->db->update('direccion', $data);

        return $this->db->insert_id();
    }

}
