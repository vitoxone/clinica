<?php

class Ventas_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function get_ventas_usuario($id_usuario, $fecha_inicio = null, $fecha_fin = null)
    {
        $this->db
            ->select('vp.*, p.*, vp.created as fecha_venta')
            ->from('paciente_vendedor vp')
            ->join('pacientes p', 'vp.paciente = p.id_paciente')
            ->where('p.demo', 0)
            ->where('p.objetado', 0);
            if (is_array($id_usuario))
            {
                $this->db->where_in('vp.usuario', $id_usuario);

            }
            else
            {
                $this->db->where('vp.usuario', $id_usuario);
            }
            if($fecha_inicio != null && $fecha_fin != null){
                $this->db->where('vp.created >= "'. date('Y-m-d', strtotime($fecha_inicio)).' 00:00:00"');
                $this->db->where('vp.created <= "'. date('Y-m-d', strtotime($fecha_fin)).' 23:59:59"');
            }
            $this->db->order_by('vp.created', 'DESC');

        $consulta = $this->db->get();

        //var_dump($this->db->last_query()); die;

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

    public function get_vendedores($activo = null){
        

        $this->db
            ->select('u.id_usuario, pe.rut, p.id_profesional, pe.nombre as nombres, pe.apellido_paterno, pe.apellido_materno, z.nombre as zona, rpz.id_rol_profesional_zona')
            ->from('usuarios u')
            ->join('personas pe', 'u.persona = pe.id_persona')
            ->join('profesionales p', 'p.usuario = u.id_usuario')
            ->join('profesional_zona pz', 'p.id_profesional = pz.profesional')
            ->join('zonas z', 'pz.zona = z.id_zona')
            ->join('roles_profesional_zona rpz', 'pz.rol = rpz.id_rol_profesional_zona')
            ->where_in('rpz.id_rol_profesional_zona', [3,2]);
            if($activo){
                 $this->db->where('u.activo', 1);
            }
            $this->db->order_by('rpz.id_rol_profesional_zona', 'ASC');

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

    public function get_reporte_pacientes($fecha_inicio, $fecha_fin, $vendedores, $contigo, $domiciliario){
        $this->db
            ->select('p.*, p.created as fecha_registro, per.nombre as nombre_vendedor, per.apellido_paterno as apellido_vendedor')
            ->from('pacientes p')
            ->join('paciente_vendedor pv', 'pv.paciente = p.id_paciente')
            ->join('usuarios u', 'pv.usuario = u.id_usuario')
            ->join('personas per', 'u.persona = per.id_persona')
            ->where('p.demo', 0)
            ->where('p.validado', 1)
            ->where_in('u.id_usuario', $vendedores);
            if($contigo  && $domiciliario){
                $this->db->where('(p.contigo = 1 OR p.domiciliario = 1)');  
            }
            else{
                if($contigo){
                    $this->db->where('p.contigo', 1);   
                }
                if($domiciliario){
                    $this->db->where('p.domiciliario', 1);   
                } 
            }

            $this->db->where('p.created >= "'. date('Y-m-d', strtotime($fecha_inicio)).' 00:00:00"');
            $this->db->where('p.created <= "'. date('Y-m-d', strtotime($fecha_fin)).' 23:59:59"');

        $consulta = $this->db->get();
        //var_dump($this->db->last_query()); die;

        if ($consulta->num_rows() > 0)
        {
            return $consulta->result();
        }
        else
        {
            return false;
        }
    }
    public function get_reporte_vendedores($fecha_inicio, $fecha_fin, $vendedores, $contigo, $domiciliario)
    {
        $fecha_inicio = '"'.date('Y-m-d', strtotime($fecha_inicio)).' 00:00:00"';
        $fecha_fin = '"'.date('Y-m-d', strtotime($fecha_fin)).' 23:59:59"';
         $vendedores_in = "";

            foreach ($vendedores as $value)
            {
                $vendedores_in .= "$value,";
            }

        $vendedores_in = substr($vendedores_in, 0, -1);

        $sql = "SELECT Count(pv.id_paciente_vendedor)  AS cantidad_ventas,
                                        u.id_usuario, per.nombre as nombre_vendedor, per.apellido_paterno as apellido_vendedor,
                                        per.rut
                                        FROM
                                            paciente_vendedor pv
                                        JOIN    
                                            pacientes pa ON pv.paciente = pa.id_paciente
                                        JOIN 
                                            usuarios u ON pv.usuario = u.id_usuario
                                        JOIN
                                            personas per ON u.persona = per.id_persona
                                        JOIN  
                                            profesionales p ON p.usuario = u.id_usuario          
                                        WHERE pv.created BETWEEN $fecha_inicio and $fecha_fin
                                        AND
                                            pa.demo = 0
                                        AND
                                            pa.validado = 1   

                                        AND u.id_usuario IN($vendedores_in)";

                                        if($contigo  && $domiciliario){
                                            $sql = $sql." AND (pa.contigo = 1 OR pa.domiciliario =1 )"; 
                                        }
                                        else{
                                            if($contigo){
                                                $sql = $sql." AND pa.contigo = 1"; 
                                            }
                                            if($domiciliario){
                                                $sql = $sql." AND pa.domiciliario = 1"; 
                                            }
                                        } 

                                        $sql = $sql." GROUP by u.id_usuario
                                        ORDER BY cantidad_ventas DESC";

        $consulta = $this->db->query($sql);


        if ($consulta->num_rows() > 0)
        {
            return $consulta->result();
        } 
        else
        {
            return FALSE;
        }
    }

    public function get_ingresos_vendedor($fecha_inicio, $fecha_fin, $vendedor, $contigo, $domiciliario, $oncovida, $cmc, $establecimientos)
    {
        $fecha_inicio = '"'.date('Y-m-d', strtotime($fecha_inicio)).' 00:00:00"';
        $fecha_fin = '"'.date('Y-m-d', strtotime($fecha_fin)).' 23:59:59"';

        $establecimientos_in = "";

        if(!empty($establecimientos)){
            foreach ($establecimientos as $value)
            {
               
                $id = $this->encrypt->decode(base64_decode($value['id_establecimiento']));
                $establecimientos_in .= "$id,";
            }

            $establecimientos_in = substr($establecimientos_in, 0, -1);
        }


        $sql = "SELECT Count(pv.id_paciente_vendedor)  AS cantidad_ventas
                                        FROM
                                            paciente_vendedor pv
                                        JOIN    
                                            pacientes pa ON pv.paciente = pa.id_paciente
                                        JOIN 
                                            usuarios u ON pv.usuario = u.id_usuario
                                        JOIN
                                            personas per ON u.persona = per.id_persona
                                        JOIN  
                                            profesionales p ON p.usuario = u.id_usuario          
                                        WHERE pv.created BETWEEN $fecha_inicio and $fecha_fin
                                        AND
                                            pa.demo = 0
                                        AND
                                            pa.validado = 1      

                                        AND u.id_usuario = $vendedor";

                                        if($contigo){
                                            $sql = $sql." AND pa.contigo = 1"; 
                                        }
                                        if($domiciliario){
                                            $sql = $sql." AND pa.domiciliario = 1"; 
                                        }
                                        if($oncovida){
                                            $sql = $sql." AND pa.oncovida = 1"; 
                                        }
                                        if($cmc){
                                            $sql = $sql." AND pa.cmc = 1"; 
                                        }
                                        if($establecimientos_in != ""){
                                            $sql = $sql." AND pa.establecimiento IN($establecimientos_in)"; 
                                        };

        $consulta = $this->db->query($sql);


        if ($consulta->num_rows() > 0)
        {
            return $consulta->row();
        } 
        else
        {
            return FALSE;
        }
    }

    public function get_vendedores_zona($id_zona){
        
        $this->db
            ->select('u.id_usuario, u.activo, pe.rut, p.id_profesional, pe.nombre as nombres, pe.apellido_paterno, pe.apellido_materno, rpz.id_rol_profesional_zona')
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
        $this->db->select('u.id_usuario, pe.rut, p.id_profesional, pe.nombre as nombres, pe.apellido_paterno, pe.apellido_materno')
            ->from('paciente_vendedor pv')
            ->join('usuarios u', 'pv.usuario = u.id_usuario')
            ->join('profesionales p', 'p.usuario = u.id_usuario')
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

    public function ventas_mensuales_vendedor($id_usuario, $tipo)
    {
        switch ($tipo) {
            case 'all':
                $consulta = $this->db->query("SELECT Count(pv.id_paciente_vendedor)  AS numero_ventas,
                                DATE_FORMAT(pv.created, '%m') AS periodo, DATE_FORMAT(pv.created, '%y') AS anio
                                FROM
                                    paciente_vendedor pv
                                JOIN
                                    pacientes p ON pv.paciente = p.id_paciente    

                                WHERE
                                    p.demo = 0
                                AND     
                                    pv.usuario = $id_usuario
                                 AND
                                    pv.created >=date_sub(CURDATE(),INTERVAL 12 month)

                                GROUP BY DATE_FORMAT(pv.created, '%m-%Y')  
                                ORDER BY pv.created ASC");
                break;
            case 'contigo':
                $consulta = $this->db->query("SELECT Count(pv.id_paciente_vendedor)  AS numero_ventas,
                                DATE_FORMAT(pv.created, '%m') AS periodo, DATE_FORMAT(pv.created, '%y') AS anio
                                FROM
                                    paciente_vendedor pv
                                JOIN
                                    pacientes p ON pv.paciente = p.id_paciente    

                                WHERE
                                    p.demo = 0
                                AND     
                                    pv.usuario = $id_usuario
                                AND
                                    p.contigo = 1

                                AND
                                    pv.created >=date_sub(CURDATE(),INTERVAL 12 month)

                                GROUP BY DATE_FORMAT(pv.created, '%m-%Y')  
                                ORDER BY pv.created ASC");
                break;
            case 'pad':
                $consulta = $this->db->query("SELECT Count(pv.id_paciente_vendedor)  AS numero_ventas,
                                DATE_FORMAT(pv.created, '%m') AS periodo, DATE_FORMAT(pv.created, '%y') AS anio
                                FROM
                                    paciente_vendedor pv
                                JOIN
                                    pacientes p ON pv.paciente = p.id_paciente    

                                WHERE
                                    p.demo = 0
                                AND     
                                    pv.usuario = $id_usuario
                                AND
                                    p.domiciliario = 1
                                AND
                                    pv.created >=date_sub(CURDATE(),INTERVAL 12 month)

                                GROUP BY DATE_FORMAT(pv.created, '%m-%Y')  
                                ORDER BY pv.created ASC");
                break;
                case 'oncovida':
                $consulta = $this->db->query("SELECT Count(pv.id_paciente_vendedor)  AS numero_ventas,
                                DATE_FORMAT(pv.created, '%m') AS periodo, DATE_FORMAT(pv.created, '%y') AS anio
                                FROM
                                    paciente_vendedor pv
                                JOIN
                                    pacientes p ON pv.paciente = p.id_paciente    

                                WHERE
                                    p.demo = 0
                                AND     
                                    pv.usuario = $id_usuario
                                AND
                                    p.oncovida = 1
                                AND
                                    pv.created >=date_sub(CURDATE(),INTERVAL 12 month)

                                GROUP BY DATE_FORMAT(pv.created, '%m-%Y')  
                                ORDER BY pv.created ASC");
                break;
                case 'cmc':
                $consulta = $this->db->query("SELECT Count(pv.id_paciente_vendedor)  AS numero_ventas,
                                DATE_FORMAT(pv.created, '%m') AS periodo, DATE_FORMAT(pv.created, '%y') AS anio
                                FROM
                                    paciente_vendedor pv
                                JOIN
                                    pacientes p ON pv.paciente = p.id_paciente    

                                WHERE
                                    p.demo = 0
                                AND     
                                    pv.usuario = $id_usuario
                                AND
                                    p.cmc = 1
                                AND
                                    pv.created >=date_sub(CURDATE(),INTERVAL 12 month)

                                GROUP BY DATE_FORMAT(pv.created, '%m-%Y')  
                                ORDER BY pv.created ASC");
                break;
            case 'otros':
                $consulta = $this->db->query("SELECT Count(pv.id_paciente_vendedor)  AS numero_ventas,
                                DATE_FORMAT(pv.created, '%m') AS periodo, DATE_FORMAT(pv.created, '%y') AS anio
                                FROM
                                    paciente_vendedor pv
                                JOIN
                                    pacientes p ON pv.paciente = p.id_paciente    

                                WHERE
                                    p.demo = 0
                                AND     
                                    pv.usuario = $id_usuario
                                AND
                                    p.contigo = 0
                                AND 
                                    p.domiciliario = 0  
                                AND 
                                    p.oncovida = 0
                                AND
                                    p.cmc = 0          
                                AND
                                    pv.created >=date_sub(CURDATE(),INTERVAL 12 month)

                                GROUP BY DATE_FORMAT(pv.created, '%m-%Y')  
                                ORDER BY pv.created ASC");
                break;
            
            default:
                break;
        }



        if ($consulta->num_rows() > 0)
        {
            return $consulta->result();
        } 
        else
        {
            return [];
        }
    } 
    public function ventas_mensuales_vendedor_zona($id_zona)
    {
        $consulta = $this->db->query("SELECT Count(pv.id_paciente_vendedor)  AS numero_ventas,
                                        DATE_FORMAT(pv.created, '%m') AS periodo, DATE_FORMAT(pv.created, '%y') AS anio
                                        FROM
                                            paciente_vendedor pv
                                        JOIN 
                                            usuarios u ON pv.usuario = u.id_usuario
                                        JOIN 
                                            profesionales p ON p.usuario = u.id_usuario
                                        JOIN 
                                            profesional_zona pz ON pz.profesional = p.id_profesional           
                                        JOIN
                                            pacientes pa ON pv.paciente = pa.id_paciente    

                                        WHERE
                                            pa.demo = 0
                                        AND    
                                            pz.zona = $id_zona
   
                                        AND
                                            pv.created >=date_sub(CURDATE(),INTERVAL 12 month)

                                        GROUP BY DATE_FORMAT(pv.created, '%m-%Y')  
                                        ORDER BY pv.created ASC");

        if ($consulta->num_rows() > 0)
        {
            return $consulta->result();
        } 
        else
        {
            return FALSE;
        }
    }
    public function ventas_mensuales_vendedor_zona_contigo($id_zona)
    {
        $consulta = $this->db->query("SELECT Count(pv.id_paciente_vendedor)  AS numero_ventas,
                                        DATE_FORMAT(pv.created, '%m') AS periodo, DATE_FORMAT(pv.created, '%y') AS anio
                                        FROM
                                            paciente_vendedor pv
                                        JOIN 
                                            usuarios u ON pv.usuario = u.id_usuario
                                        JOIN 
                                            profesionales p ON p.usuario = u.id_usuario
                                        JOIN 
                                            profesional_zona pz ON pz.profesional = p.id_profesional           
                                        JOIN
                                            pacientes pa ON pv.paciente = pa.id_paciente    

                                        WHERE
                                            pa.demo = 0
                                        AND    
                                            pz.zona = $id_zona
                                        AND
                                            pa.contigo = 1    
   
                                        AND
                                            pv.created >=date_sub(CURDATE(),INTERVAL 12 month)

                                        GROUP BY DATE_FORMAT(pv.created, '%m-%Y')  
                                        ORDER BY pv.created ASC");

        if ($consulta->num_rows() > 0)
        {
            return $consulta->result();
        } 
        else
        {
            return [];
        }
    }

    public function ventas_mensuales_vendedor_zona_pad($id_zona)
    {
        $consulta = $this->db->query("SELECT Count(pv.id_paciente_vendedor)  AS numero_ventas,
                                        DATE_FORMAT(pv.created, '%m') AS periodo, DATE_FORMAT(pv.created, '%y') AS anio
                                        FROM
                                            paciente_vendedor pv
                                        JOIN 
                                            usuarios u ON pv.usuario = u.id_usuario
                                        JOIN 
                                            profesionales p ON p.usuario = u.id_usuario
                                        JOIN 
                                            profesional_zona pz ON pz.profesional = p.id_profesional           
                                        JOIN
                                            pacientes pa ON pv.paciente = pa.id_paciente    

                                        WHERE
                                            pa.demo = 0
                                        AND    
                                            pz.zona = $id_zona
                                        AND
                                            pa.domiciliario = 1    
                                        AND
                                            pv.created >=date_sub(CURDATE(),INTERVAL 12 month)

                                        GROUP BY DATE_FORMAT(pv.created, '%m-%Y')  
                                        ORDER BY pv.created ASC");

        if ($consulta->num_rows() > 0)
        {
            return $consulta->result();
        } 
        else
        {
            return [];
        }
    }
    public function ventas_mensuales_vendedor_zona_oncovida($id_zona)
    {
        $consulta = $this->db->query("SELECT Count(pv.id_paciente_vendedor)  AS numero_ventas,
                                        DATE_FORMAT(pv.created, '%m') AS periodo, DATE_FORMAT(pv.created, '%y') AS anio
                                        FROM
                                            paciente_vendedor pv
                                        JOIN 
                                            usuarios u ON pv.usuario = u.id_usuario
                                        JOIN 
                                            profesionales p ON p.usuario = u.id_usuario
                                        JOIN 
                                            profesional_zona pz ON pz.profesional = p.id_profesional           
                                        JOIN
                                            pacientes pa ON pv.paciente = pa.id_paciente    

                                        WHERE
                                            pa.demo = 0
                                        AND    
                                            pz.zona = $id_zona
                                        AND
                                            pa.oncovida = 1    
                                        AND
                                            pv.created >=date_sub(CURDATE(),INTERVAL 12 month)

                                        GROUP BY DATE_FORMAT(pv.created, '%m-%Y')  
                                        ORDER BY pv.created ASC");

        if ($consulta->num_rows() > 0)
        {
            return $consulta->result();
        } 
        else
        {
            return [];
        }
    }
    public function ventas_mensuales_vendedor_zona_cmc($id_zona)
    {
        $consulta = $this->db->query("SELECT Count(pv.id_paciente_vendedor)  AS numero_ventas,
                                        DATE_FORMAT(pv.created, '%m') AS periodo, DATE_FORMAT(pv.created, '%y') AS anio
                                        FROM
                                            paciente_vendedor pv
                                        JOIN 
                                            usuarios u ON pv.usuario = u.id_usuario
                                        JOIN 
                                            profesionales p ON p.usuario = u.id_usuario
                                        JOIN 
                                            profesional_zona pz ON pz.profesional = p.id_profesional           
                                        JOIN
                                            pacientes pa ON pv.paciente = pa.id_paciente    

                                        WHERE
                                            pa.demo = 0
                                        AND    
                                            pz.zona = $id_zona
                                        AND
                                            pa.cmc = 1    
                                        AND
                                            pv.created >=date_sub(CURDATE(),INTERVAL 12 month)

                                        GROUP BY DATE_FORMAT(pv.created, '%m-%Y')  
                                        ORDER BY pv.created ASC");

        if ($consulta->num_rows() > 0)
        {
            return $consulta->result();
        } 
        else
        {
            return [];
        }
    }

    public function ventas_mensuales_vendedor_zona_otros($id_zona)
    {
        $consulta = $this->db->query("SELECT Count(pv.id_paciente_vendedor)  AS numero_ventas,
                                        DATE_FORMAT(pv.created, '%m') AS periodo, DATE_FORMAT(pv.created, '%y') AS anio
                                        FROM
                                            paciente_vendedor pv
                                        JOIN 
                                            usuarios u ON pv.usuario = u.id_usuario
                                        JOIN 
                                            profesionales p ON p.usuario = u.id_usuario
                                        JOIN 
                                            profesional_zona pz ON pz.profesional = p.id_profesional           
                                        JOIN
                                            pacientes pa ON pv.paciente = pa.id_paciente    

                                        WHERE
                                            pa.demo = 0
                                        AND    
                                            pz.zona = $id_zona
                                        AND
                                            pa.domiciliario = 0
                                        AND
                                            pa.contigo = 0 
                                        AND
                                            pa.oncovida = 0
                                        AND
                                            pa.cmc = 0               
           
                                        AND
                                                pv.created >=date_sub(CURDATE(),INTERVAL 12 month)

                                        GROUP BY DATE_FORMAT(pv.created, '%m-%Y')  
                                        ORDER BY pv.created ASC");

        if ($consulta->num_rows() > 0)
        {
            return $consulta->result();
        } 
        else
        {
            return [];
        }
    }

    public function ventas_mensuales_totales($fecha_inicio = null, $fecha_fin = null)
    {
            if($fecha_inicio != null && $fecha_fin != null) {
                $sql2 = " AND
                pv.created BETWEEN ".date('Y-m-d', strtotime($fecha_inicio)) ." OR ".date('Y-m-d', strtotime($fecha_fin))." ";
            }
                else{ 
                    $sql2 = " AND
                pv.created >= date_sub(CURDATE(),INTERVAL 12 month)";
            } 

        $consulta = $this->db->query("SELECT Count(pv.id_paciente_vendedor)  AS numero_ventas,
                                        DATE_FORMAT(pv.created, '%m') AS periodo, DATE_FORMAT(pv.created, '%y') AS anio
                                        FROM
                                            paciente_vendedor pv
                                        JOIN 
                                            usuarios u ON pv.usuario = u.id_usuario
                                        JOIN 
                                            profesionales p ON p.usuario = u.id_usuario
                                        JOIN 
                                            profesional_zona pz ON pz.profesional = p.id_profesional 
                                        JOIN
                                            pacientes pa ON pv.paciente = pa.id_paciente    
                                        WHERE
                                            pa.demo = 0".
                                            $sql2.
                                        "GROUP BY DATE_FORMAT(pv.created, '%m-%Y')  
                                        ORDER BY pv.created ASC");

      //  var_dump($this->db->last_query()); die;

        if ($consulta->num_rows() > 0)
        {
            return $consulta->result();
        } 
        else
        {
            return FALSE;
        }
    }


    public function ventas_mensuales_contigo()
    {
        $consulta = $this->db->query("SELECT Count(pv.id_paciente_vendedor)  AS numero_ventas,
                                        DATE_FORMAT(pv.created, '%m') AS periodo, DATE_FORMAT(pv.created, '%y') AS anio
                                        FROM
                                            paciente_vendedor pv
                                        JOIN 
                                            usuarios u ON pv.usuario = u.id_usuario
                                        JOIN 
                                            profesionales p ON p.usuario = u.id_usuario
                                        JOIN 
                                            profesional_zona pz ON pz.profesional = p.id_profesional 
                                        JOIN 
                                            pacientes pa ON pv.paciente = pa.id_paciente
                                        WHERE
                                            pa.contigo = 1
                                        AND
                                            pa.demo = 0                          
                                        AND
                                            pv.created >=date_sub(CURDATE(),INTERVAL 12 month)

                                        GROUP BY DATE_FORMAT(pv.created, '%m-%Y')  
                                        ORDER BY pv.created ASC");


        if ($consulta->num_rows() > 0)
        {
            return $consulta->result();
        } 
        else
        {
            return [];
        }
    }

    public function ventas_mensuales_pad()
    {
        $consulta = $this->db->query("SELECT Count(pv.id_paciente_vendedor)  AS numero_ventas,
                                        DATE_FORMAT(pv.created, '%m') AS periodo, DATE_FORMAT(pv.created, '%y') AS anio
                                        FROM
                                            paciente_vendedor pv
                                        JOIN 
                                            usuarios u ON pv.usuario = u.id_usuario
                                        JOIN 
                                            profesionales p ON p.usuario = u.id_usuario
                                        JOIN 
                                            profesional_zona pz ON pz.profesional = p.id_profesional 
                                        JOIN 
                                            pacientes pa ON pv.paciente = pa.id_paciente
                                        WHERE
                                            pa.domiciliario = 1
                                        AND
                                            pa.demo = 0                           
                                        AND
                                            pv.created >=date_sub(CURDATE(),INTERVAL 12 month)

                                        GROUP BY DATE_FORMAT(pv.created, '%m-%Y')  
                                        ORDER BY pv.created ASC");


        if ($consulta->num_rows() > 0)
        {
            return $consulta->result();
        } 
        else
        {
            return [];
        }
    }
        public function ventas_mensuales_oncovida()
    {
        $consulta = $this->db->query("SELECT Count(pv.id_paciente_vendedor)  AS numero_ventas,
                                        DATE_FORMAT(pv.created, '%m') AS periodo, DATE_FORMAT(pv.created, '%y') AS anio
                                        FROM
                                            paciente_vendedor pv
                                        JOIN 
                                            usuarios u ON pv.usuario = u.id_usuario
                                        JOIN 
                                            profesionales p ON p.usuario = u.id_usuario
                                        JOIN 
                                            profesional_zona pz ON pz.profesional = p.id_profesional 
                                        JOIN 
                                            pacientes pa ON pv.paciente = pa.id_paciente
                                        WHERE
                                            pa.oncovida = 1
                                        AND
                                            pa.demo = 0                           
                                        AND
                                            pv.created >=date_sub(CURDATE(),INTERVAL 12 month)

                                        GROUP BY DATE_FORMAT(pv.created, '%m-%Y')  
                                        ORDER BY pv.created ASC");


        if ($consulta->num_rows() > 0)
        {
            return $consulta->result();
        } 
        else
        {
            return [];
        }
    }
    public function ventas_mensuales_cmc()
    {
        $consulta = $this->db->query("SELECT Count(pv.id_paciente_vendedor)  AS numero_ventas,
                                        DATE_FORMAT(pv.created, '%m') AS periodo, DATE_FORMAT(pv.created, '%y') AS anio
                                        FROM
                                            paciente_vendedor pv
                                        JOIN 
                                            usuarios u ON pv.usuario = u.id_usuario
                                        JOIN 
                                            profesionales p ON p.usuario = u.id_usuario
                                        JOIN 
                                            profesional_zona pz ON pz.profesional = p.id_profesional 
                                        JOIN 
                                            pacientes pa ON pv.paciente = pa.id_paciente
                                        WHERE
                                            pa.cmc = 1
                                        AND
                                            pa.demo = 0                           
                                        AND
                                            pv.created >=date_sub(CURDATE(),INTERVAL 12 month)

                                        GROUP BY DATE_FORMAT(pv.created, '%m-%Y')  
                                        ORDER BY pv.created ASC");


        if ($consulta->num_rows() > 0)
        {
            return $consulta->result();
        } 
        else
        {
            return [];
        }
    }
    public function ventas_mensuales_no()
    {
        $consulta = $this->db->query("SELECT Count(pv.id_paciente_vendedor)  AS numero_ventas,
                                        DATE_FORMAT(pv.created, '%m') AS periodo, DATE_FORMAT(pv.created, '%y') AS anio
                                        FROM
                                            paciente_vendedor pv
                                        JOIN 
                                            usuarios u ON pv.usuario = u.id_usuario
                                        JOIN 
                                            profesionales p ON p.usuario = u.id_usuario
                                        JOIN 
                                            profesional_zona pz ON pz.profesional = p.id_profesional 
                                        JOIN 
                                            pacientes pa ON pv.paciente = pa.id_paciente
                                        WHERE
                                            pa.domiciliario = 0
                                        AND 
                                            pa.contigo = 0
                                        AND
                                            pa.demo = 0    

                                        AND
                                            pv.created >=date_sub(CURDATE(),INTERVAL 12 month)

                                        GROUP BY DATE_FORMAT(pv.created, '%m-%Y')  
                                        ORDER BY pv.created ASC");

        if ($consulta->num_rows() > 0)
        {
            return $consulta->result();
        } 
        else
        {
            return [];
        }
    }

    public function ventas_totales_zona_por_vendedor($id_zona, $tipo)
    {

        switch ($tipo) {
            case 'all':
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
                                JOIN 
                                    pacientes pa ON pv.paciente = pa.id_paciente               
                                WHERE
                                    pz.zona = $id_zona
                                AND
                                    pa.demo = 0        

                                GROUP BY nombre, apellido
                                ORDER BY nombre, apellido ASC");
                break;
            case 'contigo':
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
                                JOIN 
                                    pacientes pa ON pv.paciente = pa.id_paciente               
                                WHERE
                                    pz.zona = $id_zona
                                AND
                                    pa.demo = 0
                                AND
                                    pa.contigo = 1            

                                GROUP BY nombre, apellido
                                ORDER BY nombre, apellido ASC");
                break;  
            case 'pad':
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
                                JOIN 
                                    pacientes pa ON pv.paciente = pa.id_paciente               
                                WHERE
                                    pz.zona = $id_zona
                                AND
                                    pa.demo = 0
                                AND
                                    pa.domiciliario = 1            

                                GROUP BY nombre, apellido
                                ORDER BY nombre, apellido ASC");
                break;
                case 'oncovida':
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
                                JOIN 
                                    pacientes pa ON pv.paciente = pa.id_paciente               
                                WHERE
                                    pz.zona = $id_zona
                                AND
                                    pa.demo = 0
                                AND
                                    pa.oncovida = 1            

                                GROUP BY nombre, apellido
                                ORDER BY nombre, apellido ASC");
                break;
                case 'cmc':
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
                                JOIN 
                                    pacientes pa ON pv.paciente = pa.id_paciente               
                                WHERE
                                    pz.zona = $id_zona
                                AND
                                    pa.demo = 0
                                AND
                                    pa.cmc = 1            

                                GROUP BY nombre, apellido
                                ORDER BY nombre, apellido ASC");
                break;
            case 'otros':
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
                                JOIN 
                                    pacientes pa ON pv.paciente = pa.id_paciente               
                                WHERE
                                    pz.zona = $id_zona
                                AND
                                    pa.demo = 0
                                AND
                                    pa.contigo = 0 
                                AND
                                    pa.domiciliario = 0 
                                AND 
                                    pa.oncovida = 0
                                AND 
                                    pa.cmc = 0            

                                GROUP BY nombre, apellido
                                ORDER BY nombre, apellido ASC");
                break;        
            
            default:
                break;
        }

        if ($consulta->num_rows() > 0)
        {
            return $consulta->result();
        } 
        else
        {
            return [];
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
                                        JOIN 
                                            pacientes pa ON pv.paciente = pa.id_paciente 
                                        WHERE
                                            pa.demo = 0                      
                                        GROUP BY nombre_zona");

        if ($consulta->num_rows() > 0)
        {
            return $consulta->result();
        } 
        else
        {
            return FALSE;
        }
    }
    
    public function ventas_contigo_por_zona()
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
                                        JOIN 
                                            pacientes pa ON pv.paciente = pa.id_paciente
                                        WHERE
                                            pa.contigo = 1  
                                        AND
                                            pa.demo = 0               
                                        GROUP BY nombre_zona");

        if ($consulta->num_rows() > 0)
        {
            return $consulta->result();
        } 
        else
        {
            return [];
        }
    }

    public function ventas_pad_por_zona()
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
                                        JOIN 
                                            pacientes pa ON pv.paciente = pa.id_paciente
                                        WHERE
                                            pa.domiciliario = 1
                                        AND
                                            pa.demo = 0    

                                        GROUP BY nombre_zona");

        if ($consulta->num_rows() > 0)
        {
            return $consulta->result();
        } 
        else
        {
            return [];
        }
    }
        public function ventas_oncovida_por_zona()
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
                                        JOIN 
                                            pacientes pa ON pv.paciente = pa.id_paciente
                                        WHERE
                                            pa.oncovida = 1
                                        AND
                                            pa.demo = 0    

                                        GROUP BY nombre_zona");

        if ($consulta->num_rows() > 0)
        {
            return $consulta->result();
        } 
        else
        {
            return [];
        }
    }
    public function ventas_cmc_por_zona()
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
                                        JOIN 
                                            pacientes pa ON pv.paciente = pa.id_paciente
                                        WHERE
                                            pa.cmc = 1
                                        AND
                                            pa.demo = 0    

                                        GROUP BY nombre_zona");

        if ($consulta->num_rows() > 0)
        {
            return $consulta->result();
        } 
        else
        {
            return [];
        }
    }

    public function ventas_otros_por_zona()
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
                                        JOIN 
                                            pacientes pa ON pv.paciente = pa.id_paciente
                                        WHERE
                                            pa.domiciliario = 0
                                        AND
                                            pa.contigo = 0
                                        AND
                                            pa.oncovida = 0
                                        AND 
                                            pa.cmc = 0
                                        AND         
                                            pa.demo = 0               
                                        GROUP BY nombre_zona");

        if ($consulta->num_rows() > 0)
        {
            return $consulta->result();
        } 
        else
        {
            return [];
        }
    }

}
