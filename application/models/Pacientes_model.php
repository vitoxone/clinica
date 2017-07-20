<?php

class Pacientes_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_paciente($id_paciente)
    {
        $this->db
            ->select('p.*, d.direccion as direccion_nombre, c.*, tdi.nombre as nombre_tipo_documento, tdi.id_tipo_documento_identificacion, i.*, r.*, p.activo as estado_paciente')
            ->from('pacientes p')
            ->join('isapres i', 'p.isapre = i.id_isapre', 'left')
            ->join('direccion d', 'd.id_direccion = p.direccion', 'left')
            ->join('comunas c', 'd.comuna = c.id', 'left')
            ->join('regiones r', 'c.padre = r.id_region', 'left')
            ->join('tipos_documentos_identificacion tdi', 'p.tipo_documento_identificacion = tdi.id_tipo_documento_identificacion', 'left')
            ->where('p.id_paciente', $id_paciente);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->row();
        } else {
            return false;
        }
    }



    public function get_diagnostico_paciente($id_paciente){

        $this->db
            ->select('p.*, d.*')
            ->from('pacientes p')
            ->join('diagnostico d', 'p.diagnostico = d.id_diagnostico')
            ->where('p.id_paciente', $id_paciente);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->row();
        } else {
            return false;
        }
    }
    public function get_cie10_diagnostico($id_diagnostico){

        $this->db
            ->select('cd.*, c.*')
            ->from('cies10_diagnostico cd')
            ->join('cie10 c', 'cd.cie10 = c.id_cie10')
            ->where('cd.diagnostico', $id_diagnostico);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }
    public function get_tipos_documentos()
    {
        $this->db
            ->select('*')
            ->from('tipos_documentos_identificacion')
            ->limit(1);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_pacientes()
    {
        $this->db
            ->select('p.*')
            ->from('pacientes p')
            ->order_by('p.created', 'DESC');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }
    public function get_pacientes_sin_verificar()
    {
        $this->db
            ->select('p.*')
            ->from('pacientes p')
            ->where('p.validado', 0)
            ->order_by('p.corregido', 'DESC')
            ->order_by('p.objetado', 'ASC');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }
    public function get_pacientes_objetados_vendedor($id_vendedor)
    {
        $this->db
            ->select('p.*')
            ->from('pacientes p')
            ->join('paciente_vendedor pv', 'p.id_paciente = pv.paciente')
            ->where('p.objetado', 1)
            ->where('p.validado', 0)
            ->where('pv.usuario', $id_vendedor)
            ->order_by('p.objetado', 'ASC');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }
    public function get_pacientes_verificados()
    {
        $this->db
            ->select('p.*')
            ->from('pacientes p')
            ->where('p.validado', 1);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }
    public function existe_paciente_rut($rut){
        $this->db
            ->select('p.*')
            ->from('pacientes p')
            ->where('p.rut', $rut);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function llamados_paciente($id_paciente)
    {
        $this->db
            ->select('e.*')
            ->from('encuestas e')
            ->where('e.paciente', $id_paciente);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_pacientes_domiciliarios()
    {
        $this->db
            ->select('count(*) as numero, p.domiciliario')
            ->from('pacientes p')
            ->group_by('p.domiciliario');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_pacientes_por_establecimiento()
    {
        $this->db
            ->select('count(*) as numero, es.nombre as nombre_establecimiento')
            ->from('diagnostico d')
            ->join('establecimientos es', 'd.establecimiento = es.id_establecimiento')
            ->group_by('es.id_establecimiento');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }
    public function get_pacientes_por_establecimiento_mes($mes)
    {
        $this->db
            ->select('count(*) as numero, es.nombre as nombre_establecimiento')
            ->from('diagnostico d')
            ->join('establecimientos es', 'd.establecimiento = es.id_establecimiento')
          //  ->where('MONTH(e.fecha_llamado)', $mes)
            ->group_by('nombre_establecimiento');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }
    public function get_pacientes_contigo_agrupados()
    {
        $this->db
            ->select('count(*) as numero, p.contigo')
            ->from('pacientes p')
            ->group_by('p.contigo');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_pacientes_contigo()
    {
        $this->db
            ->select('p.*')
            ->from('pacientes p')
            ->where('p.contigo', 1);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_pacientes_activos()
    {
        $this->db
            ->select('p.*')
            ->from('pacientes p');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_diagnosticos_profesionales($id_diagnostico){
        $this->db
            ->select('dp.created as fecha_registro, pe.nombre as nombre_profesional, pe.apellido_paterno  as apellido_paterno')
            ->from('diagnostico_profesional dp')
            ->join('profesionales p', 'dp.profesional = p.id_profesional')
            ->join('usuarios u', 'p.usuario  = u.id_usuario')
            ->join('personas pe', 'u.persona  = pe.id_persona')
            ->where('dp.diagnostico', $id_diagnostico);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }

    }
    public function get_ostomias_profesionales($id_ostomia){
        $this->db
            ->select('op.created as fecha_registro, pe.nombre as nombre_profesional, pe.apellido_paterno  as apellido_paterno')
            ->from('ostomia_profesional op')
            ->join('profesionales p', 'op.profesional = p.id_profesional')
            ->join('usuarios u', 'p.usuario  = u.id_usuario')
            ->join('personas pe', 'u.persona  = pe.id_persona')
            ->where('op.ostomia', $id_ostomia);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }

    }

    public function get_ostomias_diagnostico($id_diagnostico)
    {
        $this->db
            ->select('o.*, to.*')
            ->from('ostomias o')
            ->join('tipos_ostomia to', 'o.tipo_ostomia = to.id_tipo_ostomia')
            ->where('o.diagnostico', $id_diagnostico);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_valoraciones_ostomias($id_ostomia)
    {
        $this->db
            ->select('vo.*')
            ->from('valoracion_ostomia vo')
            ->where('vo.ostomia', $id_ostomia)
            ->order_by('vo.id_valoracion_ostomia', 'DESC');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function vincular_diagnostico_paciente($id_paciente, $id_diagnostico){
        $data = array(
            'diagnostico' => $id_diagnostico,
        );

        $this->db->where('id_paciente', $id_paciente);
        $this->db->update('pacientes', $data);

        return true;

    }

    public function set_estado_paciente($id_paciente, $estado){
        $data = array(
            'activo' => $estado,
        );

        $this->db->where('id_paciente', $id_paciente);
        $this->db->update('pacientes', $data);

        return true;
    }

    public function vincular_cie10_diagnostico($id_diagnostico, $id_cie10){
        $data = array(
            'diagnostico' => $id_diagnostico,
            'cie10' => $id_cie10,
        );

        $this->db->insert('cies10_diagnostico', $data);

        return $this->db->insert_id();

    }

    public function borrar_cie10_diagnostico($id_diagnostico){
        $this->db->where('diagnostico', $id_diagnostico);
        $this->db->delete('cies10_diagnostico');

    }

    public function delete_paciente($id_paciente){
        $this->db->where('id_paciente', $id_paciente);
        $this->db->delete('pacientes');

    }


    public function set_nuevo_paciente($id_paciente_antiguo, $id_tipo_documento_identificacion, $rut,  $nombres, $apellido_paterno, $apellido_materno, $fecha_nacimiento, $genero, $id_direccion, $id_isapre, $fonasa_plan, $telefono, $celular, $email, $programa_contigo, $atencion_domiciliaria, $nombre_acompanante, $edad_acompanante, $parentesco_acompanante, $telefono_acompanante, $id_establecimiento, $id_medico_tratante, $fecha_cirugia, $comentario_validacion, $validar, $objetar, $corregir)
    {

        $data = array(
            'tipo_documento_identificacion' => $id_tipo_documento_identificacion,
            'rut'                           => $rut,
            'nombres'                       => $nombres,
            'apellido_paterno'              => $apellido_paterno,
            'apellido_materno'              => $apellido_materno,
            'fecha_nacimiento'              => $fecha_nacimiento,
            'genero'                        => $genero,
            'direccion'                     => $id_direccion,
            'isapre'                        => $id_isapre,
            'fonasa_plan'                   => $fonasa_plan,
            'telefono'                      => $telefono,
            'celular'                       => $celular,
            'email'                         => $email,
            'contigo'                       => $programa_contigo,
            'domiciliario'                  => $atencion_domiciliaria,
            'nombre_acompanante'            => $nombre_acompanante,
            'edad_acompanante'              => $edad_acompanante,
            'parentesco_acompanante'        => $parentesco_acompanante,
            'telefono_acompanante'          => $telefono_acompanante,
            'establecimiento'               => $id_establecimiento,
            'medico_tratante'               => $id_medico_tratante,
            'fecha_cirugia'                 => $fecha_cirugia,
            'validado'                      => $validar,
            'objetado'                      => $objetar,
            'corregido'                     => $corregir,
            'comentario_validacion'         => $comentario_validacion
        );
        if($id_paciente_antiguo){
            $this->db->set('modified', 'NOW()', false);
            $this->db->where('id_paciente', $id_paciente_antiguo);
            $this->db->update('pacientes', $data);
            return $id_paciente_antiguo;

        }else{
            $this->db->set('created', 'NOW()', false);
            $this->db->insert('pacientes', $data);
            return $this->db->insert_id();
        }

        
    }


    public function set_nuevo_diagnostico($diagnostico_principal, $diagnostico_atencion, $recibe_kit, $seguimiento, $motivo_consulta, $antecedentes_patologicos, $antecedentes_quirurgicos, $antecedentes_alergicos, $antecedentes_farmacologicos, $antecedentes_familiares, $historia_clinica, $tratamiento_actual_quirurgico, $tratamiento_actual_radioterapia, $tratamiento_actual_quimioterapia, $tratamiento_actual_otro, $establecimiento, $medico_tratante, $fecha_cirugia)
    {
        $data = array(
            'principal'                     => $diagnostico_principal,
            'secundario'                    => $diagnostico_atencion,
            'recibe_kit'                    => $recibe_kit,
            'seguimiento'                   => $seguimiento,
            'motivo_consulta'               => $motivo_consulta,
            'antecedentes_patologicos'      => $antecedentes_patologicos,
            'antecedentes_quirurgicos'      => $antecedentes_quirurgicos,
            'antecedentes_alergicos'        => $antecedentes_alergicos,
            'antecedentes_farmacologicos'   => $antecedentes_farmacologicos,
            'antecedentes_familiares'       => $antecedentes_familiares,
            'historia_clinica'              => $historia_clinica,
            'tratamiento_actual_quirurgico' => $tratamiento_actual_quirurgico,
            'tratamiento_actual_radioterapia' => $tratamiento_actual_radioterapia,
            'tratamiento_actual_quimioterapia' => $tratamiento_actual_quimioterapia,
            'tratamiento_actual_otro'       => $tratamiento_actual_otro,
            'establecimiento'               => $establecimiento, 
            'medico_tratante'               => $medico_tratante,
            'fecha_cirugia'                 => $fecha_cirugia
        );

        $this->db->set('created', 'NOW()', false);
        $this->db->set('modified', 'NOW()', false);
        $this->db->insert('diagnostico', $data);

        return $this->db->insert_id();
    }

    public function actualizar_diagnostico($id_diagnostico, $diagnostico_principal, $diagnostico_atencion, $recibe_kit, $seguimiento, $motivo_consulta, $antecedentes_patologicos, $antecedentes_quirurgicos, $antecedentes_alergicos, $antecedentes_farmacologicos, $antecedentes_familiares, $historia_clinica, $tratamiento_actual_quirurgico, $tratamiento_actual_radioterapia, $tratamiento_actual_quimioterapia, $tratamiento_actual_otro, $establecimiento, $medico_tratante, $fecha_cirugia)
    {
        $data = array(
            'principal'                     => $diagnostico_principal,
            'secundario'                    => $diagnostico_atencion,
            'recibe_kit'                    => $recibe_kit,
            'seguimiento'                   => $seguimiento,
            'motivo_consulta'               => $motivo_consulta,
            'antecedentes_patologicos'      => $antecedentes_patologicos,
            'antecedentes_quirurgicos'      => $antecedentes_quirurgicos,
            'antecedentes_alergicos'        => $antecedentes_alergicos,
            'antecedentes_farmacologicos'   => $antecedentes_farmacologicos,
            'antecedentes_familiares'       => $antecedentes_familiares,
            'historia_clinica'              => $historia_clinica,
            'tratamiento_actual_quirurgico' => $tratamiento_actual_quirurgico,
            'tratamiento_actual_radioterapia' => $tratamiento_actual_radioterapia,
            'tratamiento_actual_quimioterapia' => $tratamiento_actual_quimioterapia,
            'tratamiento_actual_otro'       => $tratamiento_actual_otro,
            'establecimiento'               => $establecimiento,
            'medico_tratante'               => $medico_tratante,
            'fecha_cirugia'                 => $fecha_cirugia
        );

        $this->db->set('modified', 'NOW()', false);
        $this->db->where('id_diagnostico', $id_diagnostico);
        $this->db->update('diagnostico', $data);

        return true;
    }
    //$diagnostico_antiguo->id_diagnostico, $ostomia['tipo_ostomia']['id_tipo_ostomia'], $ostomia['ubicacion_estoma']['id_ubicacion_estoma'], $ostomia['boca_proximal'], $ostomia['boca_distal'], $ostomia['puente_piel'], $ostomia['temporalidad'], $una_boca, $dos_bocas, $en_asa, $fisula, $ostomia['angulo_drenaje'], $ostomia['comentario_drenaje'], $ostomia['sacsl'], $ostomia['sacst'], $ostomia['comentario_sacs']

    public function set_ostomia_diagnostico($id_diagnostico, $id_tipo_ostomia, $ubicacion_estoma, $boca_proximal, $boca_distal, $puente_piel, $temporalidad, $una_boca, $dos_bocas, $en_asa, $fisula, $angulo_drenaje, $comentario_drenaje, $marcacion_prequirurgica)
    {
        $data = array(
            'diagnostico'                   => $id_diagnostico,
            'tipo_ostomia'                  => $id_tipo_ostomia,
            'ubicacion'                     => $ubicacion_estoma,
            'tamano_boca_proximal'          => $boca_proximal,
            'tamano_boca_distal'            => $boca_distal,
            'puente_piel'                   => $puente_piel,
            'temporalidad'                  => $temporalidad,
            'una_boca'                      => $una_boca,
            'dos_bocas'                     => $dos_bocas,
            'en_asa'                        => $en_asa,
            'fisula'                        => $fisula,
            'angulo_drenaje'                => $angulo_drenaje,
            'comentario_drenaje'            => $comentario_drenaje,
            'marcacion_pre_quirurgica'      =>$marcacion_prequirurgica
        );

        $this->db->set('created', 'NOW()', false);
        $this->db->insert('ostomias', $data);

        return $this->db->insert_id();
    }

    public function update_ostomia_diagnostico($id_ostomia, $id_diagnostico, $id_tipo_ostomia, $ubicacion_estoma, $boca_proximal, $boca_distal, $puente_piel, $temporalidad, $una_boca, $dos_bocas, $en_asa, $fisula, $angulo_drenaje, $comentario_drenaje,  $marcacion_prequirurgica)
    {
        $data = array(
            'diagnostico'                   => $id_diagnostico,
            'tipo_ostomia'                  => $id_tipo_ostomia,
            'ubicacion'                     => $ubicacion_estoma,
            'tamano_boca_proximal'          => $boca_proximal,
            'tamano_boca_distal'            => $boca_distal,
            'puente_piel'                   => $puente_piel,
            'temporalidad'                  => $temporalidad,
            'una_boca'                      => $una_boca,
            'dos_bocas'                     => $dos_bocas,
            'en_asa'                        => $en_asa,
            'fisula'                        => $fisula,
            'angulo_drenaje'                => $angulo_drenaje,
            'comentario_drenaje'            => $comentario_drenaje,
            'marcacion_pre_quirurgica'      =>$marcacion_prequirurgica
        );

        $this->db->set('modified', 'NOW()', false);
        $this->db->where('id_ostomia', $id_ostomia);
        $this->db->update('ostomias', $data);

        return $this->db->insert_id();
    }

    public function registrar_diagnostico_profesional($id_diagnostico, $id_profesional, $primer_registro)
    {
        $data = array(
            'diagnostico'                  => $id_diagnostico,
            'profesional'                  => $id_profesional,
            'primer_registro'              => $primer_registro
        );
        $this->db->set('created', 'NOW()', false);
        $this->db->insert('diagnostico_profesional', $data);

        return $this->db->insert_id();
    }

    public function registrar_estomia_profesional($id_ostomia, $id_profesional, $primer_registro)
    {
        $data = array(
            'ostomia'                       => $id_ostomia,
            'profesional'                  => $id_profesional,
            'primer_registro'              => $primer_registro
        );
        $this->db->set('created', 'NOW()', false);
        $this->db->insert('ostomia_profesional', $data);

        return $this->db->insert_id();
    }

    public function registrar_valoracion_estomia($id_ostomia, $sacsl, $sacst, $comentario_sacs, $primer_registro)
    {
        $data = array(
            'ostomia'                       => $id_ostomia,
            'sacsl'                         => $sacsl,
            'sacst'                         => $sacst,
            'comentario_sacs'               => $comentario_sacs,
            'primer_registro'               => $primer_registro
        );
        $this->db->set('created', 'NOW()', false);
        $this->db->insert('valoracion_ostomia', $data);

        return $this->db->insert_id();
    }

    public function get_ultima_valoracion_ostomia($id_ostomia)
    {
        $this->db
            ->select('vo.*')
            ->from('valoracion_ostomia vo')
            ->where('vo.ostomia', $id_ostomia)
            ->order_by('vo.id_valoracion_ostomia', 'DESC');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->row();
        } else {
            return false;
        }
    }

    public function get_direcciones_paciente($id_paciente)
    {
        $this->db
            ->select('d.* , dp.defecto')
            ->from('direcciones_paciente dp')
            ->join('direccion d ','d.id_direccion = dp.direccion')
            ->where('dp.paciente', $id_paciente)
            ->order_by('dp.id_direccion_paciente', 'DESC');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function set_direccion($id_paciente, $direccion)
    {
        $data = array(
            'direccion   '   => $direccion

        );
        $this->db->insert('direccion', $data);

        $data = array(
            'direccion'   => $this->db->insert_id(),
            'paciente'    => $id_paciente

        );
        $this->db->insert('direcciones_paciente', $data);

        return $this->db->insert_id();
    }

    public function get_direccion_paciente($id_direccion)
    {
        $this->db
            ->select('*')
            ->from('direcciones_paciente dp')
            ->where('dp.direccion', $id_direccion);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->row();
        } else {
            return false;
        }
    }

    public function get_domicilio_por_id_direccion_paciente($id_direccion_paciente)
    {
        $this->db
            ->select('d.*')
            ->from('direcciones_paciente dp')
            ->join('direccion d','d.id_direccion = dp.direccion')
            ->where('dp.id_direccion_paciente', $id_direccion_paciente);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->row();
        } else {
            return false;
        }
    }

}
