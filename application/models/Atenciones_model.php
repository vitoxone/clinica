<?php

class Atenciones_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function set_atencion_paciente($id_diagnostico, $frecuencia_cardiaca, $presion_arterial, $temperatura, $estatura, $imc, $estado_animo, $agudeza_visual, $destreza_manual, $dependencia)
    {
        $data = array(
            'diagnostico'                       => $id_diagnostico,
            'frecuencia_cardiaca'               => $frecuencia_cardiaca,
            'presion_arterial'                  => $presion_arterial,
            'temperatura'                       => $temperatura,
            'estatura'                          => $estatura,
            'estatura'                          => $estatura,
            'imc'                               => $imc,  
            'estado_animo'                      => $estado_animo,
            'agudeza_visual'                    => $agudeza_visual,
            'destreza_manual'                   => $destreza_manual,
            'dependencia'                       => $dependencia

        );
        $this->db->set('created', 'NOW()', false);
        $this->db->insert('atenciones', $data);

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

    public function guardar_insumos_utilizados($id_atencion, $id_insumo, $cantidad, $gratis)
    {
        $data = array(
            'atencion'                     => $id_atencion,
            'insumo'                       => $id_insumo,
            'cantidad_unitaria'            => $cantidad,
            'gratis'                       => $gratis,
        );
        $this->db->set('created', 'NOW()', false);
        $this->db->insert('insumos_utilizados', $data);

        return $this->db->insert_id();
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
            ->group_by('a.id_atencion')
            ->order_by('a.id_atencion', 'DESC');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

}
