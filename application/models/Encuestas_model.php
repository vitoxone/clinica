<?php

class Encuestas_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function set_nueva_encuesta($id_paciente, $fecha_llamado, $hora_inicio, $hora_fin, $profesional, $correccion_entrega, $cierre_quirurgico, $remitido, $evento_adverso, $sistema_dispositivo,  $numero_placas, $dispositivos_mes, $numero_bolsas, $motivo_no_utiliza, $actividad_laboral, $recomienda_convatec,$recomienda_programa, $autocuidado, $tiempo_retorno_laboral, $estado_programa, $proximo_llamado, $observaciones, $contesta, $tiempo_duracion)
    {
        $data = array(
            'paciente'                      => $id_paciente,
            'fecha_llamado'                 => $fecha_llamado,
            'hora_inicio'                   => $hora_inicio,
            'hora_fin'                      => $hora_fin,
            'profesional'                   => $profesional,
            'correccion_entrega'            => $correccion_entrega,  
            'cierre_quirurgico'             => $cierre_quirurgico,
            'remitido'                      => $remitido,
            'evento_adverso'                => $evento_adverso,
            'sistema_dispositivo'           => $sistema_dispositivo,
            'numero_placas'                 => $numero_placas,
            'dispositivos_mes'              => $dispositivos_mes,
            'numero_bolsas'                 => $numero_bolsas,
            'motivo_no_utiliza'             => $motivo_no_utiliza,
            'actividad_laboral'             => $actividad_laboral,
            'recomienda_convatec'           => $recomienda_convatec,
            'recomienda_programa'           => $recomienda_programa,
            'autocuidado'                   => $autocuidado,
            'tiempo_retorno_laboral'        => $tiempo_retorno_laboral,
            'estado_programa'               => $estado_programa,
            'proximo_llamado'               => $proximo_llamado,
            'observaciones'                 => $observaciones,
            'contesta'                      => $contesta,
            'tiempo_duracion'               => $tiempo_duracion,

        );
        $this->db->set('created', 'NOW()', false);
        $this->db->insert('encuestas', $data);

        return $this->db->insert_id();
    }

    public function get_encuestas_paciente($id_paciente)
    {
        $this->db
            ->select('e.*, pro.*, u.*, p.*, p.nombre as nombres, e.created as fecha_creacion')
            ->from('encuestas e')
            ->join('profesionales pro', 'e.profesional = pro.id_profesional')
            ->join('usuarios u', 'pro.usuario = u.id_usuario')
            ->join('personas p', 'u.persona = p.id_persona')
            ->where('e.paciente', $id_paciente)
            ->order_by('e.id_encuesta', 'ASC');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_encuesta($id_encuesta)
    {
        $this->db
            ->select('e.*, pro.*, u.*, p.*, p.nombre as nombres, e.created as fecha_creacion')
            ->from('encuestas e')
            ->join('profesionales pro', 'e.profesional = pro.id_profesional')
            ->join('usuarios u', 'pro.usuario = u.id_usuario')
            ->join('personas p', 'u.persona = p.id_persona')
            ->where('e.id_encuesta', $id_encuesta);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->row();
        } else {
            return false;
        }
    }

    public function get_sistemas_encuesta($id_encuesta)
    {
        $this->db
            ->select('s.*')
            ->from('sistema_encuesta se')
            ->join('sistemas s', 'se.sistema = s.id_sistema')
            ->where('se.encuesta', $id_encuesta);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_adjuvantes_encuesta($id_encuesta)
    {
        $this->db
            ->select('a.*')
            ->from('adjuvante_encuesta ae')
            ->join('adjuvantes a', 'ae.adjuvante = a.id_adjuvante')
            ->where('ae.encuesta', $id_encuesta);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

}
