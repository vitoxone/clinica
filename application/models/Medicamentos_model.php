<?php

class Medicamentos_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function get_medicamentos()
    {
        $this->db
            ->select('m.*')
            ->from('medicamentos m');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_insumos()
    {
        $this->db
            ->select('i.*, li.nombre as nombre_linea, fi.nombre as nombre_familia')
            ->from('insumos i')
            ->join('lineas_insumos li', 'i.linea = li.id_linea_insumo')
            ->join('familias_insumos fi', 'i.familia = fi.id_familia_insumo')
            ->limit('2');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_insumos_activos()
    {
        $this->db
            ->select('i.*, li.nombre as nombre_linea, fi.nombre as nombre_familia')
            ->from('insumos i')
            ->join('lineas_insumos li', 'i.linea = li.id_linea_insumo')
            ->join('familias_insumos fi', 'i.familia = fi.id_familia_insumo')
            ->where('i.activo', 1)
            ->where('i.stock_unitario >', 0);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }


    public function update_stock_insumo($id_insumo, $stock_unitario)
    {
        $data = array(
            'stock_unitario'   => $stock_unitario
        );

        $this->db->set('modified', 'NOW()', false);
        $this->db->where('id_insumo', $id_insumo);
        $this->db->update('insumos', $data);

        return $stock_unitario;
    }

    public function activar_insumo($id_insumo, $activo)
    {
        $data = array(
            'activo'   => $activo
        );

        $this->db->set('modified', 'NOW()', false);
        $this->db->where('id_insumo', $id_insumo);
        $this->db->update('insumos', $data);

        return true;
    }

    public function restar_stock_insumo($id_insumo, $cantidad)
    {
        $data = array(
            'stock_unitario = stock_unitario-', $cantidad
        );

        $this->db->set('modified', 'NOW()', false);
        $this->db->where('id_insumo', $id_insumo);
        $this->db->update('insumos', $data);

      //  var_dump($this->db->last_query()); die();

        return true;
    }

    public function get_stock_insumo($id_insumo)
    {
        $this->db
            ->select('i.stock_unitario')
            ->from('insumos i')
            ->where('i.id_insumo', $id_insumo);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->row();
        } else {
            return false;
        }
    }
}
