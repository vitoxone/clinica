<?php

class Usuarios_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function login($nombre_usuario, $password, $remember)
    {
        $this->db
            ->select('u.*, p.*, e.especialidad as especialidad_nombre, u.usuario as nombre_usuario')
            ->from('usuarios u')
            ->join('profesionales p', 'p.usuario = u.id_usuario')
            ->join('especialidades e', 'p.especialidad = e.id_especialidad')
            ->where('u.usuario', $nombre_usuario)
            ->where('u.password', $password);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            $row = $consulta->row();
            $this->session->set_userdata('id_usuario', $row->id_usuario);
            $this->session->set_userdata('nombre_usuario', $row->nombre_usuario);
            $this->session->set_userdata('especialidad', $row->especialidad_nombre);

            if ($remember == 'true') {
                $this->load->helper('cookie');
                $token  = md5($row->nombre_usuario . time());
                $cookie = array(
                    'name'   => 'clinica_token_int',
                    'value'  => $token,
                    'expire' => 1209600,
                    'path'   => '/',
                );
                set_cookie($cookie);
                $this->guardar_token($row->id_usuario, $token);
            }

        } else {
            return 'El usuario o contraseña son incorrectos';
        }
    }


    public function get_usuarios()
    {
        $this->db
            ->select('u.*, p.*, e.especialidad as nombre_especialidad')
            ->from('usuarios u')
            ->join('personas p', 'u.persona = p.id_persona')
            ->join('profesionales pro', 'u.id_usuario  = pro.usuario')
            ->join('especialidades e', 'pro.especialidad  = e.id_especialidad');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_husos_horarios()
    {
        $this->db
            ->select('ho.*')
            ->from('huso_horario ho');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }



    public function get_huso_horario_usuario($id_usuario)
    {
        $this->db
            ->select('ho.*')
            ->from('usuarios u')
            ->join('huso_horario ho', 'u.huso_horario = ho.id_huso_horario')
            ->where('u.id_usuario', $id_usuario);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->row();
        } else {
            return false;
        }
    }

    public function get_usuario($id_usuario)
    {
        $this->db
            ->select('u.*, p.*, pro.*, e.*, u.usuario as nombre_usuario, e.especialidad as nombre_especialidad')
            ->from('usuarios u')
            ->join('personas p', 'u.persona  = p.id_persona')
            ->join('profesionales pro', 'u.id_usuario  = pro.usuario')
            ->join('especialidades e', 'pro.especialidad  = e.id_especialidad')
            ->where('u.id_usuario', $id_usuario);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->row();
        } else {
            return false;
        }
    }


    public function get_ultimos_accesos()
    {
        $this->db
            ->select('au.*, p.*,  u.usuario as nombre_usuario, au.created as fecha_acceso')
            ->from('accesos_usuarios au')
            ->join('usuarios u', 'au.usuario  = u.id_usuario')
            ->join('personas p', 'u.persona  = p.id_persona')
            ->order_by('au.created', 'DESC');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }


    public function set_usuario($id_persona,  $activo, $tipo_usuario, $nombre_usuario, $id_huso_horario,  $pass)
    {

        $data = array(
            'persona'        => $id_persona,
            'activo'         => $activo,
            'tipo'           => $tipo_usuario,
            'usuario'        => $nombre_usuario,
            'huso_horario'   => $id_huso_horario,
            'password'       => $pass,
            'clinica'        => 1,
        );

        $this->db->insert('usuarios', $data);

        return $this->db->insert_id();
    }

    public function set_acceso_usuario($id_usuario, $sistema_operativo, $navegador, $navegador_version, $user_agent, $lat, $lng)
    {

        $data = array(
            'usuario'             => $id_usuario,
            'sistema_operativo'   => $sistema_operativo,
            'navegador'           => $navegador,
            'navegador_version'   => $navegador_version,
            'user_agent'          => $user_agent,
            'lat'                 => $lat,
            'lng'                 => $lng
        );
        $this->db->set('created', 'NOW()', false);
        $this->db->insert('accesos_usuarios', $data);

        return $this->db->insert_id();
    }

    public function update_usuario($id_usuario,  $activo, $tipo_usuario, $nombre_usuario)
    {

        $data = array(
            'activo'         => $activo,
            'tipo'           => $tipo_usuario,
            'usuario'        => $nombre_usuario,
        );


        $this->db->set('modified', 'NOW()', false);
        $this->db->where('id_usuario', $id_usuario);
        $this->db->update('usuarios', $data);

        return true;
    }

    public function update_password($id_usuario,  $password)
    {

        $data = array(
            'password'       => $password
        );

        $this->db->where('id_usuario', $id_usuario);
        $this->db->update('usuarios', $data);
    }


    public function set_persona($nombres, $apellido_paterno, $apellido_materno, $rut, $direccion)
    {

        $data = array(
            'nombre'                => $nombres,
            'apellido_paterno'      => $apellido_paterno,
            'apellido_materno'      => $apellido_materno,
            'rut'                   => $rut,
            'direccion'             => $direccion,
        );

        $this->db->insert('personas', $data);

        return $this->db->insert_id();
    }

    public function update_persona($id_persona, $nombres, $apellido_paterno, $apellido_materno, $direccion)
    {

        $data = array(
            'nombre'                => $nombres,
            'apellido_paterno'      => $apellido_paterno,
            'apellido_materno'      => $apellido_materno,
            'direccion'             => $direccion,
        );

        $this->db->set('modified', 'NOW()', false);
        $this->db->where('id_persona', $id_persona);
        $this->db->update('personas', $data);

        return true;
    }

    public function update_nombre_usuario($id_usuario, $nombre_usuario)
    {
        $data = array(
            'nombre_usuario' => $nombre_usuario,
        );

        $this->db->where('id_usuario', $id_usuario);
        $this->db->update('usuarios', $data);

        return true;
    }

    public function guardar_token($id, $token)
    {
        $data = array('token' => $token);

        $this->db->where('id_usuario', $id);
        $this->db->update('usuarios', $data);
    }

    public function autologin($token)
    {
        $this->db->select('u.*')
            ->from('usuarios u')
            ->where('u.token', $token);

        $usuario = $this->db->get();
        $row     = $usuario->row();

        $this->login($row->nombre_usuario, $row->pass, true);
        redirect(base_url());
    }

    public function verificar_usuario($nombre_usuario, $password){

        $this->db
            ->select('u.*')
            ->from('usuarios u')
            ->where('u.usuario', $nombre_usuario)
            ->where('u.password', $password);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }

    }

    public function activar_usuario($id_usuario, $activo)
    {
        $data = array(
            'activo'   => $activo
        );

        $this->db->where('id_usuario', $id_usuario);
        $this->db->update('usuarios', $data);

        return true;
    }
    public function obtener_rol($id_usuario){
        $this->db
            ->select('esp.especialidad as especialidad')
            ->from('profesionales pro')
            ->join('especialidades esp', 'esp.id_especialidad = pro.especialidad')
            ->where('pro.usuario', $id_usuario);
        $consulta = $this->db->get();
        $row = $consulta->row();
        return $row->especialidad;
    }

}
