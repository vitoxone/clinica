<?php

class Atenciones_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function set_atencion_paciente($id_diagnostico, $frecuencia_cardiaca, $presion_arterial, $temperatura, $estatura, $peso, $imc, $estado_animo, $agudeza_visual, $destreza_manual, $actividad, $dependencia, $descripcion)
    {
        $data = array(
            'diagnostico'                       => $id_diagnostico,
            'frecuencia_cardiaca'               => $frecuencia_cardiaca,
            'presion_arterial'                  => $presion_arterial,
            'temperatura'                       => $temperatura,
            'estatura'                          => $estatura,
            'peso'                              => $peso,
            'imc'                               => $imc,  
            'estado_animo'                      => $estado_animo,
            'agudeza_visual'                    => $agudeza_visual,
            'destreza_manual'                   => $destreza_manual,
            'actividad'                         => $actividad, 
            'dependencia'                       => $dependencia,
            'descripcion'                       => $descripcion

        );
        $this->db->set('created', 'NOW()', false);
        $this->db->insert('atenciones', $data);

        return $this->db->insert_id();
    }

    public function update_atencion_paciente( $id_atencion, $id_diagnostico, $frecuencia_cardiaca, $presion_arterial, $temperatura, $estatura, $peso, $imc, $estado_animo, $agudeza_visual, $destreza_manual, $actividad, $dependencia, $descripcion)
    {
        $data = array(
            'diagnostico'                       => $id_diagnostico,
            'frecuencia_cardiaca'               => $frecuencia_cardiaca,
            'presion_arterial'                  => $presion_arterial,
            'temperatura'                       => $temperatura,
            'estatura'                          => $estatura,
            'peso'                              => $peso,
            'imc'                               => $imc,  
            'estado_animo'                      => $estado_animo,
            'agudeza_visual'                    => $agudeza_visual,
            'destreza_manual'                   => $destreza_manual,
            'actividad'                         => $actividad, 
            'dependencia'                       => $dependencia,
            'descripcion'                       => $descripcion

        );
        $this->db->set('modified', 'NOW()', false);
        $this->db->where('id_atencion', $id_atencion);
        $this->db->update('atenciones', $data);

        return $this->db->insert_id();
    }

    public function registrar_atencion_profesional($id_atencion, $id_profesional, $primer_registro)
    {
        $data = array(
            'atencion'                     => $id_atencion,
            'profesional'                  => $id_profesional,
            'primer_registro'              => $primer_registro
        );
        $this->db->set('created', 'NOW()', false);
        $this->db->insert('atencion_profesional', $data);

        return $this->db->insert_id();
    }

    public function guardar_insumos_utilizados($id_atencion, $id_insumo, $cantidad, $gratis, $detalle)
    {
        $data = array(
            'atencion'                     => $id_atencion,
            'insumo'                       => $id_insumo,
            'cantidad_unitaria'            => $cantidad,
            'gratis'                       => $gratis,
            'detalle'                      => $detalle
        );
        $this->db->set('created', 'NOW()', false);
        $this->db->insert('insumos_utilizados', $data);

        return $this->db->insert_id();
    }


    public function update_insumos_utilizados($id_insumo_utilizado, $cantidad, $gratis, $detalle)
    {
        $data = array(
            'cantidad_unitaria'            => $cantidad,
            'gratis'                       => $gratis,
            'detalle'                      => $detalle
        );
        $this->db->set('created', 'NOW()', false);
        $this->db->where('id_insumo_utilizado', $id_insumo_utilizado);
        $this->db->update('insumos_utilizados', $data);

        return true;
    }
    
    public function get_atenciones_paciente($id_diagnostico)
    {
        $this->db
            ->select('a.*,ap.*, a.created as fecha_registro, pe.nombre as nombre_profesional, pe.apellido_paterno  as apellido_paterno')
            ->from('atenciones a')
            ->join('atencion_profesional ap', 'a.id_atencion = ap.atencion')
            ->join('profesionales p', 'ap.profesional = p.id_profesional')
            ->join('usuarios u', 'p.usuario  = u.id_usuario')
            ->join('personas pe', 'u.persona  = pe.id_persona')
            ->where('a.diagnostico', $id_diagnostico)
            ->group_by('a.created')
            ->order_by('fecha_registro', 'DESC');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_insumos_atencion($id_atencion)
    {
        $this->db
            ->select('iu.cantidad_unitaria, iu.gratis, iu.detalle, i.*, i.sap as sap_insumo,  li.nombre as nombre_linea, fi.nombre as nombre_familia')
            ->from('insumos_utilizados iu')
            ->join('insumos i', 'iu.insumo = i.id_insumo')
            ->join('lineas_insumos li', 'i.linea = li.id_linea_insumo')
            ->join('familias_insumos fi', 'i.familia = fi.id_familia_insumo')
            ->where('iu.atencion', $id_atencion)
            ->order_by('iu.id_insumo_utilizado', 'DESC');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_insumo_utilizado($id_insumo, $id_atencion){
        $this->db
            ->select('iu.*')
            ->from('insumos_utilizados iu')
            ->where('iu.insumo', $id_insumo)
            ->where('iu.atencion', $id_atencion);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->row();
        } else {
            return false;
        }
    }

}
