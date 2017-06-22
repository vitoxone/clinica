<?php

class Ventas_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function get_ventas_usuario($id_usuario)
    {
        $this->db
            ->select('vp.*, p.*')
            ->from('paciente_vendedor vp')
            ->join('pacientes p', 'vp.paciente = p.id_paciente')
            ->where('p.objetado', 0);
            if (is_array($id_usuario))
            {
                $this->db->where_in('vp.usuario', $id_usuario);

            }
            else
            {
                $this->db->where('vp.usuario', $id_usuario);
            }
            $this->db->order_by('vp.created', 'DESC');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_profesional_zona($id_profesional, $id_zona, $id_rol_zona){

        $this->db
            ->select('pz.*')
            ->from('profesional_zona pz')
            ->where('pz.profesional', $id_profesional)
            ->where('pz.zona', $id_zona)
            ->where('pz.rol', $id_rol_zona);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->row();
        } else {
            return false;
        }
    }

    public function get_zonas_vendedor($id_usuario){

        $this->db
            ->select('pz.id_profesional_zona, rpz.id_rol_profesional_zona, rpz.nombre as nombre_rol, z.id_zona, z.nombre as nombre_zona')
            ->from('usuarios u')
            ->join('profesionales p', 'p.usuario = u.id_usuario')
            ->join('profesional_zona pz', 'p.id_profesional = pz.profesional')
            ->join('zonas z', 'pz.zona = z.id_zona')
            ->join('roles_profesional_zona rpz', 'pz.rol = rpz.id_rol_profesional_zona')
            ->where('u.id_usuario', $id_usuario);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_zonas_activas(){

        $this->db
            ->distinct()
            ->select('z.id_zona, z.nombre as nombre_zona')
            ->from('usuarios u')
            ->join('profesionales p', 'p.usuario = u.id_usuario')
            ->join('profesional_zona pz', 'p.id_profesional = pz.profesional')
            ->join('zonas z', 'pz.zona = z.id_zona')
            ->join('roles_profesional_zona rpz', 'pz.rol = rpz.id_rol_profesional_zona')
            ->where('z.activo', 1);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }
    public function get_supervisor_zona($id_zona){

        $this->db
            ->select('u.id_usuario')
            ->from('usuarios u')
            ->join('profesionales p', 'p.usuario = u.id_usuario')
            ->join('profesional_zona pz', 'p.id_profesional = pz.profesional')
            ->join('zonas z', 'pz.zona = z.id_zona')
            ->join('roles_profesional_zona rpz', 'pz.rol = rpz.id_rol_profesional_zona')
            ->where('z.id_zona', $id_zona)
            ->where('rpz.id_rol_profesional_zona', 2);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->row();
        } else {
            return false;
        }
    }

    public function get_vendedores(){
        
        $this->db
            ->select('u.id_usuario, pe.rut, p.id_profesional, pe.nombre as nombres, pe.apellido_paterno, pe.apellido_materno, z.nombre as zona, rpz.id_rol_profesional_zona')
            ->from('usuarios u')
            ->join('personas pe', 'u.persona = pe.id_persona')
            ->join('profesionales p', 'p.usuario = u.id_usuario')
            ->join('profesional_zona pz', 'p.id_profesional = pz.profesional')
            ->join('zonas z', 'pz.zona = z.id_zona')
            ->join('roles_profesional_zona rpz', 'pz.rol = rpz.id_rol_profesional_zona')
            ->where_in('rpz.id_rol_profesional_zona', [3,2])
            ->order_by('rpz.id_rol_profesional_zona', 'ASC');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }
    public function get_vendedor($id_usuario){
        
        $this->db
            ->select('u.id_usuario, pe.rut, p.id_profesional, pe.nombre as nombres, pe.apellido_paterno, pe.apellido_materno, z.nombre as zona, rpz.id_rol_profesional_zona')
            ->from('usuarios u')
            ->join('personas pe', 'u.persona = pe.id_persona')
            ->join('profesionales p', 'p.usuario = u.id_usuario')
            ->join('profesional_zona pz', 'p.id_profesional = pz.profesional')
            ->join('zonas z', 'pz.zona = z.id_zona')
            ->join('roles_profesional_zona rpz', 'pz.rol = rpz.id_rol_profesional_zona')
            ->where('u.id_usuario', $id_usuario);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->row();
        } else {
            return false;
        }
    }

    public function get_vendedores_zona($id_zona){
        
        $this->db
            ->select('u.id_usuario, pe.rut, p.id_profesional, pe.nombre as nombres, pe.apellido_paterno, pe.apellido_materno, rpz.id_rol_profesional_zona')
            ->from('usuarios u')
            ->join('personas pe', 'u.persona = pe.id_persona')
            ->join('profesionales p', 'p.usuario = u.id_usuario')
            ->join('profesional_zona pz', 'p.id_profesional = pz.profesional')
            ->join('zonas z', 'pz.zona = z.id_zona')
            ->join('roles_profesional_zona rpz', 'pz.rol = rpz.id_rol_profesional_zona')
            ->where('z.id_zona', $id_zona)
            ->where_in('rpz.id_rol_profesional_zona', [3,2])
            ->order_by('rpz.id_rol_profesional_zona', 'ASC');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_zonas_ventas()
    {
        $this->db
            ->select('zo.*')
            ->from('zonas zo')
            ->where('zo.activo', 1);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_roles_zonas()
    {
        $this->db
            ->select('ruz.*')
            ->from('roles_profesional_zona ruz')
            ->where('ruz.activo', 1);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return false;
        }
    }

    public function get_vendedor_paciente($id_paciente)
    {
        $this->db
            ->select('pv.*, pe.*')
            ->from('paciente_vendedor pv')
            ->join('usuarios u', 'pv.usuario = u.id_usuario')
            ->join('personas pe', 'u.persona = pe.id_persona')
            ->where('pv.paciente', $id_paciente);

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->row();
        } else {
            return false;
        }
    }

    public function set_profesional_zona($id_profesional,  $id_zona, $id_rol_zona)
    {

        $data = array(
            'profesional'  => $id_profesional,
            'zona'         => $id_zona,
            'rol'           => $id_rol_zona);
        $this->db->set('created', 'NOW()', false);
        $this->db->insert('profesional_zona', $data);

        return $this->db->insert_id();
    }


    public function registrar_venta_paciente($id_paciente, $id_usuario)
    {
        $data = array(
            'paciente'                 => $id_paciente,
            'usuario'                  => $id_usuario
        );
        $this->db->set('created', 'NOW()', false);
        $this->db->insert('paciente_vendedor', $data);

        return $this->db->insert_id();
    }

    public function ventas_mensuales_vendedor($id_usuario)
    {
        $consulta = $this->db->query("SELECT Count(pv.id_paciente_vendedor)  AS numero_ventas,
                                        DATE_FORMAT(pv.created, '%m') AS periodo
                                        FROM
                                            paciente_vendedor pv
                                        WHERE
                                            pv.usuario = $id_usuario
                                        GROUP BY DATE_FORMAT(pv.created, '%m')
                                        ORDER BY periodo ASC");

        //var_dump($this->db->last_query()); die();

        if ($consulta->num_rows() > 0)
        {
            return $consulta->result();
        } 
        else
        {
            return FALSE;
        }
    } 
    public function ventas_mensuales_vendedor_zona($id_zona)
    {
        $consulta = $this->db->query("SELECT Count(pv.id_paciente_vendedor)  AS numero_ventas,
                                        DATE_FORMAT(pv.created, '%m') AS periodo
                                        FROM
                                            paciente_vendedor pv
                                        JOIN 
                                            usuarios u ON pv.usuario = u.id_usuario
                                        JOIN 
                                            profesionales p ON p.usuario = u.id_usuario
                                        JOIN 
                                            profesional_zona pz ON pz.profesional = p.id_profesional           
                                        WHERE
                                            pz.zona = $id_zona
   
                                        GROUP BY DATE_FORMAT(pv.created, '%m')
                                        ORDER BY periodo ASC");

        //var_dump($this->db->last_query()); die();

        if ($consulta->num_rows() > 0)
        {
            return $consulta->result();
        } 
        else
        {
            return FALSE;
        }
    }

    public function ventas_mensuales_totales()
    {
        $consulta = $this->db->query("SELECT Count(pv.id_paciente_vendedor)  AS numero_ventas,
                                        DATE_FORMAT(pv.created, '%m') AS periodo
                                        FROM
                                            paciente_vendedor pv
                                        JOIN 
                                            usuarios u ON pv.usuario = u.id_usuario
                                        JOIN 
                                            profesionales p ON p.usuario = u.id_usuario
                                        JOIN 
                                            profesional_zona pz ON pz.profesional = p.id_profesional           
                                        GROUP BY DATE_FORMAT(pv.created, '%m')
                                        ORDER BY periodo ASC");

        //var_dump($this->db->last_query()); die();

        if ($consulta->num_rows() > 0)
        {
            return $consulta->result();
        } 
        else
        {
            return FALSE;
        }
    }

    public function ventas_totales_zona_por_vendedor($id_zona)
    {
        $consulta = $this->db->query("SELECT Count(pv.id_paciente_vendedor)  AS numero_ventas,
                                        per.nombre as nombre, per.apellido_paterno  as apellido
                                        FROM
                                            paciente_vendedor pv
                                        JOIN 
                                            usuarios u ON pv.usuario = u.id_usuario
                                        JOIN 
                                            personas per ON u.persona = per.id_persona    
                                        JOIN 
                                            profesionales p ON p.usuario = u.id_usuario
                                        JOIN 
                                            profesional_zona pz ON pz.profesional = p.id_profesional           
                                        WHERE
                                            pz.zona = $id_zona
                                        GROUP BY nombre, apellido
                                        ORDER BY nombre, apellido ASC");

        //var_dump($this->db->last_query()); die();

        if ($consulta->num_rows() > 0)
        {
            return $consulta->result();
        } 
        else
        {
            return FALSE;
        }
    }

    public function ventas_totales_por_zona()
    {
        $consulta = $this->db->query("SELECT Count(pv.id_paciente_vendedor)  AS numero_ventas,
                                        z.nombre as nombre_zona
                                        FROM
                                            paciente_vendedor pv
                                        JOIN 
                                            usuarios u ON pv.usuario = u.id_usuario
                                        JOIN 
                                            personas per ON u.persona = per.id_persona    
                                        JOIN 
                                            profesionales p ON p.usuario = u.id_usuario
                                        JOIN 
                                            profesional_zona pz ON pz.profesional = p.id_profesional 
                                        JOIN
                                            zonas z ON pz.zona = z.id_zona              
                                        GROUP BY nombre_zona");

        //var_dump($this->db->last_query()); die();

        if ($consulta->num_rows() > 0)
        {
            return $consulta->result();
        } 
        else
        {
            return FALSE;
        }
    }

}
