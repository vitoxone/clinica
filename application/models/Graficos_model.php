<?php

class Graficos_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


   public function porcentaje_utiliza_convatect($startDate,$endDate){
    $this->db
            ->select('id_establecimiento as id, nombre')
            ->from('establecimientos est')
            ->where('estado', '1');
        $consulta = $this->db->get();
        $total = $this->get_pacientes();
        if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
              $arreglo[] = array('nombre' => $value->nombre, 'porcentaje'=>number_format((100*(($this->numero_utiliza_convatect($value->id,$startDate,$endDate))/$total)),2,',', ' '), 'cantidad' => (int)$this->numero_utiliza_convatect($value->id,$startDate,$endDate));
            
          }
            return $arreglo;
        } else {
            return false;
        }
   }

   public function porcentaje_recomienda_convatect($startDate,$endDate){
    $this->db
            ->select('id_establecimiento as id, nombre')
            ->from('establecimientos est')
            ->where('estado', '1');
        $consulta = $this->db->get();
        $total = $this->get_pacientes();
        if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
            if (1) {
              $arreglo[] = array('nombre' => $value->nombre, 'porcentaje'=>number_format((100*(($this->numero_recomienda_convatect($value->id,$startDate,$endDate))/$total)),2,',', ' '), 'cantidad' => (int)$this->numero_recomienda_convatect($value->id,$startDate,$endDate));
            }else{
              return false;
            }
            
          }
            return $arreglo;
        } else {
            return false;
        }
   }

   public function porcentaje_dispositivos_medicos($startDate,$endDate){
    $this->db
            ->select('id_establecimiento as id, nombre')
            ->from('establecimientos est')
            ->where('estado', '1');
        $consulta = $this->db->get();
        $total = $this->get_pacientes();
        if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
            if (1) {
              $arreglo[] = array('nombre' => $value->nombre, 'porcentaje'=>number_format((100*(($this->numero_dispositivos_medicos($value->id,$startDate,$endDate))/$total)),2,',', ' '), 'cantidad' => (int)$this->numero_dispositivos_medicos($value->id,$startDate,$endDate));
            }else{
              return false;
            }
            
          }
            return $arreglo;
        } else {
            return false;
        }
   }

   public function porcentaje_utiliza_complementos($startDate,$endDate){
    $this->db
            ->select('id_establecimiento as id, nombre')
            ->from('establecimientos est')
            ->where('estado', '1');
        $consulta = $this->db->get();
        $total = $this->get_pacientes();
        if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
            if (1) {
              $arreglo[] = array('nombre' => $value->nombre, 'porcentaje'=>number_format((100*(($this->numero_utiliza_complementos($value->id,$startDate,$endDate))/$total)),2,',', ' '), 'cantidad' => (int)$this->numero_utiliza_complementos($value->id,$startDate,$endDate));
            }else{
              return false;
            }
            
          }
            return $arreglo;
        } else {
            return false;
        }
   }

   public function porcentaje_recomienda_contigo($startDate,$endDate){
    $this->db
            ->select('id_establecimiento as id, nombre')
            ->from('establecimientos est')
            ->where('estado', '1');
        $consulta = $this->db->get();
        $total = $this->get_pacientes();
        if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
            if (1) {
              $arreglo[] = array('nombre' => $value->nombre, 'porcentaje'=>number_format((100*(((int)$this->numero_recomienda_contigo($value->id,$startDate,$endDate))/$total)),2,',', ' '), 'cantidad' => (int)$this->numero_recomienda_contigo($value->id,$startDate,$endDate));
            }else{
              return false;
            }
            
          }
            return $arreglo;
        } else {
            return false;
        }
   }

   public function porcentaje_activo_programa($startDate,$endDate){
    $this->db
            ->select('id_establecimiento as id, nombre')
            ->from('establecimientos est')
            ->where('estado', '1');
        $consulta = $this->db->get();
        $total = $this->get_pacientes();
        if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
            if (1) {
              $arreglo[] = array('nombre' => $value->nombre, 'porcentaje'=>number_format((100*(($this->numero_activo_programa($value->id,$startDate,$endDate))/$total)),2,',', ' '), 'cantidad' => (int)$this->numero_activo_programa($value->id,$startDate,$endDate));
            }else{
              return false;
            }
            
          }
            return $arreglo;
        } else {
            return false;
        }
   }

   public function porcentaje_cierre_quirurgico($startDate,$endDate){
    $this->db
            ->select('id_establecimiento as id, nombre')
            ->from('establecimientos est')
            ->where('estado', '1');
        $consulta = $this->db->get();
        $total = $this->get_pacientes();
        if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
            if (1) {
              $arreglo[] = array('nombre' => $value->nombre, 'porcentaje'=>number_format((100*(($this->numero_cierre_quirurgico($value->id,$startDate,$endDate))/$total)),2,',', ' '), 'cantidad' => (int)$this->numero_cierre_quirurgico($value->id,$startDate,$endDate));
            }else{
              return false;
            }
            
          }
            return $arreglo;
        } else {
            return false;
        }
   }

   public function porcentaje_complicaciones_dispositivo($startDate,$endDate){
    $this->db
            ->select('id_establecimiento as id, nombre')
            ->from('establecimientos est')
            ->where('estado', '1');
        $consulta = $this->db->get();
        $total = $this->get_pacientes();
        if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
            if (1) {
              $arreglo[] = array('nombre' => $value->nombre, 'porcentaje'=>number_format((100*(($this->numero_complicaciones_dispositivo($value->id,$startDate,$endDate))/$total)),2,',', ' '), 'cantidad' => (int)$this->numero_complicaciones_dispositivo($value->id,$startDate,$endDate));
            }else{
              return false;
            }
            
          }
            return $arreglo;
        } else {
            return false;
        }
   }

   public function get_pacientes(){
      $this->db
          ->select('count(*) as cantidad')
          ->from('pacientes p')
          ->join('encuestas e', 'e.paciente = p.id_paciente', 'left')
          ->where('p.activo', 1);

      $consulta = $this->db->get();

      if ($consulta->num_rows() > 0) {
        foreach ($consulta->result() as $key => $value) {
            $cantidad = $value->cantidad;
          }
          return $cantidad;
      } else {
          return false;
      }
    }

    public function get_ostomias(){
      $this->db
          ->select('count(*) as cantidad')
          ->from('ostomias');

      $consulta = $this->db->get();

      if ($consulta->num_rows() > 0) {
        foreach ($consulta->result() as $key => $value) {
            $cantidad = $value->cantidad;
          }
          return $cantidad;
      } else {
          return false;
      }
    }

    public function numero_utiliza_convatect($id_establecimiento,$startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->join('establecimientos est', 'est.id_establecimiento = pac.establecimiento')
          ->join('sistema_encuesta se', 'se.encuesta = enc.id_encuesta')
          ->where('est.id_establecimiento', $id_establecimiento);
      $this->db->where('enc.fecha_llamado >= "'.$startDate.'" AND enc.fecha_llamado <= "'.$endDate.'"');

      $consulta = $this->db->get();

      if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
              $cantidad = $value->cantidad;
          }
          return $cantidad;
      } else {
          return false;
      }
   }

   public function numero_recomienda_convatect($id_establecimiento,$startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->join('establecimientos est', 'est.id_establecimiento = pac.establecimiento')
          ->where('est.id_establecimiento', $id_establecimiento)
          ->where('enc.recomienda_convatec', '1');
      $this->db->where('enc.fecha_llamado >= "'.$startDate.'" AND enc.fecha_llamado <= "'.$endDate.'"');
      $consulta = $this->db->get();

      if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
              $cantidad = $value->cantidad;
          }
          return $cantidad;
      } else {
          return false;
      }
   }
   
   public function numero_dispositivos_medicos($id_establecimiento,$startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->join('establecimientos est', 'est.id_establecimiento = pac.establecimiento')
          ->where('est.id_establecimiento', $id_establecimiento)
          ->where('enc.correccion_entrega', '1');
      $this->db->where('enc.fecha_llamado >= "'.$startDate.'" AND enc.fecha_llamado <= "'.$endDate.'"');
      $consulta = $this->db->get();

      if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
              $cantidad = $value->cantidad;
          }
          return $cantidad;
      } else {
          return false;
      }
   }

   public function numero_utiliza_complementos($id_establecimiento,$startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->join('establecimientos est', 'est.id_establecimiento = pac.establecimiento')
          ->join('adjuvante_encuesta ae', 'ae.encuesta = enc.id_encuesta')
          ->where('est.id_establecimiento', $id_establecimiento);
      $this->db->where('enc.fecha_llamado >= "'.$startDate.'" AND enc.fecha_llamado <= "'.$endDate.'"');
      $consulta = $this->db->get();

      if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
              $cantidad = $value->cantidad;
          }
          return $cantidad;
      } else {
          return false;
      }
   }
   
   public function numero_recomienda_contigo($id_establecimiento,$startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->join('establecimientos est', 'est.id_establecimiento = pac.establecimiento')
          ->where('est.id_establecimiento', $id_establecimiento)
          ->where('enc.recomienda_programa','1');
      $this->db->where('enc.fecha_llamado >= "'.$startDate.'" AND enc.fecha_llamado <= "'.$endDate.'"');
      $consulta = $this->db->get();

      if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
              $cantidad = $value->cantidad;
          }
          return $cantidad;
      } else {
          return false;
      }
   }

   public function numero_activo_programa($id_establecimiento,$startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->join('establecimientos est', 'est.id_establecimiento = pac.establecimiento')
          ->where('est.id_establecimiento', $id_establecimiento)
          ->where('enc.estado_programa','1');
      $this->db->where('enc.fecha_llamado >= "'.$startDate.'" AND enc.fecha_llamado <= "'.$endDate.'"');
      $consulta = $this->db->get();

      if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
              $cantidad = $value->cantidad;
          }
          return $cantidad;
      } else {
          return false;
      }
   }

   public function numero_cierre_quirurgico($id_establecimiento,$startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->join('establecimientos est', 'est.id_establecimiento = pac.establecimiento')
          ->where('est.id_establecimiento', $id_establecimiento)
          ->where('enc.cierre_quirurgico','1');
      $this->db->where('enc.fecha_llamado >= "'.$startDate.'" AND enc.fecha_llamado <= "'.$endDate.'"');
      $consulta = $this->db->get();

      if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
              $cantidad = $value->cantidad;
          }
          return $cantidad;
      } else {
          return false;
      }
   }

   public function numero_complicaciones_dispositivo($id_establecimiento,$startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->join('establecimientos est', 'est.id_establecimiento = pac.establecimiento')
          ->where('est.id_establecimiento', $id_establecimiento)
          ->where('enc.remitido','1');
      $this->db->where('enc.fecha_llamado >= "'.$startDate.'" AND enc.fecha_llamado <= "'.$endDate.'"');
      $consulta = $this->db->get();

      if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
              $cantidad = $value->cantidad;
          }
          return $cantidad;
      } else {
          return false;
      }
   }
   

   //Pacientes Atendidos
  public function porcentaje_pacientes_contigo($startDate,$endDate){
      $total = $this->get_pacientes();
      $arreglo[0] = array(''=> 'Pacientes activos','porcentaje'=>number_format((100*(((int)$this->numero_pacientes_contigo($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => (int)$this->numero_pacientes_contigo($startDate,$endDate));
      $arreglo[1] = array(''=> 'Pacientes inactivos','porcentaje'=>100 - number_format((100*(((int)$this->numero_pacientes_contigo($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => $total - (int)$this->numero_pacientes_contigo($startDate,$endDate));
    return $arreglo;
   } 
   
  public function numero_pacientes_contigo($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->where('enc.estado_programa','1');
      $this->db->where('enc.fecha_llamado >= "'.$startDate.'" AND enc.fecha_llamado <= "'.$endDate.'"');
      $consulta = $this->db->get();

      if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
              $cantidad = $value->cantidad;
          }
          return $cantidad;
      } else {
          return false;
      }
   }
  
  public function porcentaje_pacientes_instituciones_convatec($startDate,$endDate){
      $total = $this->get_pacientes();
      $arreglo[0] = array(''=> 'Pacientes que se atienden','porcentaje'=>number_format((100*(((int)$this->numero_pacientes_instituciones_convatec($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => (int)$this->numero_pacientes_instituciones_convatec($startDate,$endDate));
      $arreglo[1] = array(''=> 'Pacientes que no se atienden','porcentaje'=>100 - number_format((100*(((int)$this->numero_pacientes_instituciones_convatec($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => $total - (int)$this->numero_pacientes_instituciones_convatec($startDate,$endDate));
    return $arreglo;
   } 
   
  public function numero_pacientes_instituciones_convatec($startDate,$endDate){
    $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->join('establecimientos est', 'est.id_establecimiento = pac.establecimiento')
          ->join('sistema_encuesta se', 'se.encuesta = enc.id_encuesta');
    $this->db->where('enc.fecha_llamado >= "'.$startDate.'" AND enc.fecha_llamado <= "'.$endDate.'"');
      $consulta = $this->db->get();

      if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
              $cantidad = $value->cantidad;
          }
          return $cantidad;
      } else {
          return false;
      }
   }

   public function porcentaje_pacientes_utiliza_convatec($startDate,$endDate){
      $total = $this->get_pacientes();
      $arreglo[0] = array(''=> 'Pacientes que utilizan','porcentaje'=>number_format((100*(((int)$this->numero_pacientes_utiliza_convatec($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => (int)$this->numero_pacientes_utiliza_convatec($startDate,$endDate));
      $arreglo[1] = array(''=> 'Pacientes que no utilizan','porcentaje'=>100 - number_format((100*(((int)$this->numero_pacientes_utiliza_convatec($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => $total - (int)$this->numero_pacientes_utiliza_convatec($startDate,$endDate));
    return $arreglo;
   } 
   
  public function numero_pacientes_utiliza_convatec($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->join('sistema_encuesta se', 'se.encuesta = enc.id_encuesta');
      $this->db->where('enc.fecha_llamado >= "'.$startDate.'" AND enc.fecha_llamado <= "'.$endDate.'"');          
      $consulta = $this->db->get();

      if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
              $cantidad = $value->cantidad;
          }
          return $cantidad;
      } else {
          return false;
      }
   }

   public function porcentaje_pacientes_recomienda_convatect($startDate,$endDate){
      $total = $this->get_pacientes();
      $arreglo[0] = array(''=> 'Pacientes que recomiendan','porcentaje'=>number_format((100*(((int)$this->numero_pacientes_recomienda_convatect($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => (int)$this->numero_pacientes_recomienda_convatect($startDate,$endDate));
      $arreglo[1] = array(''=> 'Pacientes que no recomiendan','porcentaje'=>100 - number_format((100*(((int)$this->numero_pacientes_recomienda_convatect($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => $total - (int)$this->numero_pacientes_recomienda_convatect($startDate,$endDate));
    return $arreglo;
   } 
   
  public function numero_pacientes_recomienda_convatect($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->where('enc.recomienda_convatec', '1');
      $this->db->where('enc.fecha_llamado >= "'.$startDate.'" AND enc.fecha_llamado <= "'.$endDate.'"');
      $consulta = $this->db->get();

      if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
              $cantidad = $value->cantidad;
          }
          return $cantidad;
      } else {
          return false;
      }
   }

   public function porcentaje_pacientes_complicaciones($startDate,$endDate){
      $total = $this->get_pacientes();
      $arreglo[0] = array(''=> 'Pacientes con complicaciones','porcentaje'=>number_format((100*(((int)$this->numero_pacientes_complicaciones($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => (int)$this->numero_pacientes_complicaciones($startDate,$endDate));
      $arreglo[1] = array(''=> 'Pacientes sin complicaciones','porcentaje'=>100 - number_format((100*(((int)$this->numero_pacientes_complicaciones($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' =>$total - (int)$this->numero_pacientes_complicaciones($startDate,$endDate));
    return $arreglo;
   } 
   
  public function numero_pacientes_complicaciones($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->where('enc.remitido','1');
      $this->db->where('enc.fecha_llamado >= "'.$startDate.'" AND enc.fecha_llamado <= "'.$endDate.'"');
      $consulta = $this->db->get();

      if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
              $cantidad = $value->cantidad;
          }
          return $cantidad;
      } else {
          return false;
      }
   }

   public function porcentaje_pacientes_dispositivo($startDate,$endDate){
      $total = $this->get_pacientes();
      $arreglo[0] = array(''=> 'Pacientes que han cambiado','porcentaje'=>number_format((100*(((int)$this->numero_pacientes_dispositivo($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => (int)$this->numero_pacientes_dispositivo($startDate,$endDate));
      $arreglo[1] = array(''=> 'Pacientes que no han cambiado','porcentaje'=>100 - number_format((100*(((int)$this->numero_pacientes_dispositivo($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' =>$total - (int)$this->numero_pacientes_dispositivo($startDate,$endDate));
    return $arreglo;
   } 
   
  public function numero_pacientes_dispositivo($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->where('enc.correccion_entrega', '1');
      $this->db->where('enc.fecha_llamado >= "'.$startDate.'" AND enc.fecha_llamado <= "'.$endDate.'"');
      $consulta = $this->db->get();

      if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
              $cantidad = $value->cantidad;
          }
          return $cantidad;
      } else {
          return false;
      }
   }


   public function porcentaje_pacientes_recomienda_contigo($startDate,$endDate){
      $total = $this->get_pacientes();
      $arreglo[0] = array(''=> 'Pacientes que recomiendan','porcentaje'=>number_format((100*(((int)$this->numero_pacientes_recomienda_contigo($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => (int)$this->numero_pacientes_recomienda_contigo($startDate,$endDate));
      $arreglo[1] = array(''=> 'Pacientes que no recomiendan','porcentaje'=>100 - number_format((100*(((int)$this->numero_pacientes_recomienda_contigo($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' =>$total - (int)$this->numero_pacientes_recomienda_contigo($startDate,$endDate));
    return $arreglo;
   } 
   
  public function numero_pacientes_recomienda_contigo($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->where('enc.recomienda_programa','1');
      $this->db->where('enc.fecha_llamado >= "'.$startDate.'" AND enc.fecha_llamado <= "'.$endDate.'"');
      $consulta = $this->db->get();

      if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
              $cantidad = $value->cantidad;
          }
          return $cantidad;
      } else {
          return false;
      }
   }


   //Indicadores de Calidad
  public function porcentaje_pacientes_retomaron_actividad($startDate,$endDate){
      $total = $this->get_pacientes();
      $arreglo[0] = array(''=> 'Pacientes que retomaron','porcentaje'=>number_format((100*(((int)$this->numero_pacientes_retomaron_actividad($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => (int)$this->numero_pacientes_retomaron_actividad($startDate,$endDate));
      $arreglo[1] = array(''=> 'Pacientes que no retomaron','porcentaje'=>100 - number_format((100*(((int)$this->numero_pacientes_retomaron_actividad($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => $total - (int)$this->numero_pacientes_retomaron_actividad($startDate,$endDate));
    return $arreglo;
   } 
   
  public function numero_pacientes_retomaron_actividad($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->where('enc.tiempo_retorno_laboral','6');
      $this->db->where('enc.fecha_llamado >= "'.$startDate.'" AND enc.fecha_llamado <= "'.$endDate.'"');
      $consulta = $this->db->get();

      if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
              $cantidad = $value->cantidad;
          }
          return $cantidad;
      } else {
          return false;
      }
   }

   public function porcentaje_pacientes_adherencia_autocuidado($startDate,$endDate){
      $total = $this->get_pacientes();
      $arreglo[0] = array(''=> 'Pacientes con adherencia','porcentaje'=>number_format((100*(((int)$this->numero_pacientes_adherencia_autocuidado($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => (int)$this->numero_pacientes_adherencia_autocuidado($startDate,$endDate));
      $arreglo[1] = array(''=> 'Pacientes sin adherencia','porcentaje'=>100 - number_format((100*(((int)$this->numero_pacientes_adherencia_autocuidado($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => $total - (int)$this->numero_pacientes_adherencia_autocuidado($startDate,$endDate));
    return $arreglo;
   } 
   
  public function numero_pacientes_adherencia_autocuidado($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->where('enc.autocuidado','1');
      $this->db->where('enc.fecha_llamado >= "'.$startDate.'" AND enc.fecha_llamado <= "'.$endDate.'"');
      $consulta = $this->db->get();

      if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
              $cantidad = $value->cantidad;
          }
          return $cantidad;
      } else {
          return false;
      }
   }
   
   //Impacto economico
  public function numero_pacientes_activos_contigo($startDate,$endDate){
      $total = $this->get_pacientes();
      $arreglo[0] = array(''=> 'Pacientes activos','porcentaje'=>number_format((100*(((int)$this->numero_pacientes_activos_contigo_1($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => (int)$this->numero_pacientes_activos_contigo_1($startDate,$endDate));
      $arreglo[1] = array(''=> 'Pacientes inactivos','porcentaje'=>100 - number_format((100*(((int)$this->numero_pacientes_activos_contigo_1($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => $total - (int)$this->numero_pacientes_activos_contigo_1($startDate,$endDate));
    return $arreglo;
   } 
   
  public function numero_pacientes_activos_contigo_1($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->where('enc.estado_programa','1');
      $this->db->where('enc.fecha_llamado >= "'.$startDate.'" AND enc.fecha_llamado <= "'.$endDate.'"');
      $consulta = $this->db->get();

      if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
              $cantidad = $value->cantidad;
          }
          return $cantidad;
      } else {
          return false;
      }
   }

   public function numero_pacientes_ostomia_temporal($startDate,$endDate){
      $total = $this->get_pacientes();
      $arreglo[0] = array(''=> 'Pacientes activos','porcentaje'=>number_format((100*(((int)$this->numero_pacientes_ostomia_temporal_1($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => (int)$this->numero_pacientes_ostomia_temporal_1($startDate,$endDate));
      $arreglo[1] = array(''=> 'Pacientes inactivos','porcentaje'=>100 - number_format((100*(((int)$this->numero_pacientes_ostomia_temporal_1($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => $total - (int)$this->numero_pacientes_ostomia_temporal_1($startDate,$endDate));
    return $arreglo;
   } 
   
  public function numero_pacientes_ostomia_temporal_1($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->where('enc.cierre_quirurgico','1');
      $this->db->where('enc.fecha_llamado >= "'.$startDate.'" AND enc.fecha_llamado <= "'.$endDate.'"');
      $consulta = $this->db->get();

      if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
              $cantidad = $value->cantidad;
          }
          return $cantidad;
      } else {
          return false;
      }
   }

   public function numero_pacientes_ostomia($startDate,$endDate){
      $total = $this->get_pacientes();
      $arreglo[0] = array(''=> 'Pacientes con Ostomia','porcentaje'=>number_format((100*(((int)$this->numero_pacientes_ostomia_1($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => (int)$this->numero_pacientes_ostomia_1($startDate,$endDate));
      $arreglo[1] = array(''=> 'Pacientes sin Ostomia','porcentaje'=>100 - number_format((100*(((int)$this->numero_pacientes_ostomia_1($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => $total - (int)$this->numero_pacientes_ostomia_1($startDate,$endDate));
    return $arreglo;
   } 
   
  public function numero_pacientes_ostomia_1($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->where('enc.remitido','1');
      $this->db->where('enc.fecha_llamado >= "'.$startDate.'" AND enc.fecha_llamado <= "'.$endDate.'"');
      $consulta = $this->db->get();

      if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
              $cantidad = $value->cantidad;
          }
          return $cantidad;
      } else {
          return false;
      }
   }

   public function numero_pacientes_correccion_receta($startDate,$endDate){
      $total = $this->get_pacientes();
      $arreglo[0] = array(''=> 'Pacientes con correción ','porcentaje'=>number_format((100*(((int)$this->numero_pacientes_correccion_receta_1($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => (int)$this->numero_pacientes_correccion_receta_1($startDate,$endDate));
      $arreglo[1] = array(''=> 'Pacientes sin correción','porcentaje'=>100 - number_format((100*(((int)$this->numero_pacientes_correccion_receta_1($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => $total - (int)$this->numero_pacientes_correccion_receta_1($startDate,$endDate));
    return $arreglo;
   } 
   
  public function numero_pacientes_correccion_receta_1($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->where('enc.remitido','1')
          ->where('enc.correccion_entrega','1');
      $this->db->where('enc.fecha_llamado >= "'.$startDate.'" AND enc.fecha_llamado <= "'.$endDate.'"');
      $consulta = $this->db->get();

      if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
              $cantidad = $value->cantidad;
          }
          return $cantidad;
      } else {
          return false;
      }
   }

   public function numero_pacientes_complicaciones_estomales($startDate,$endDate){
      $total = $this->get_pacientes();
      $arreglo[0] = array(''=> 'Pacientes con complicaciones','porcentaje'=>number_format((100*(((int)$this->numero_pacientes_complicaciones_estomales_1($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => (int)$this->numero_pacientes_complicaciones_estomales_1($startDate,$endDate));
      $arreglo[1] = array(''=> 'Pacientes sin complicaciones','porcentaje'=>100 - number_format((100*(((int)$this->numero_pacientes_complicaciones_estomales_1($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => $total - (int)$this->numero_pacientes_complicaciones_estomales_1($startDate,$endDate));
    return $arreglo;
   } 
   
  public function numero_pacientes_complicaciones_estomales_1($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->where('enc.remitido','1')
          ->where('enc.correccion_entrega','0');
      $this->db->where('enc.fecha_llamado >= "'.$startDate.'" AND enc.fecha_llamado <= "'.$endDate.'"');
      $consulta = $this->db->get();

      if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
              $cantidad = $value->cantidad;
          }
          return $cantidad;
      } else {
          return false;
      }
   }

   public function clasificacion_tipos_ostomias($startDate,$endDate){
    $this->db
            ->select('id_tipo_ostomia as id, nombre')
            ->from('tipos_ostomia tip');
        $consulta = $this->db->get();
        $total = $this->get_ostomias();
        if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
              $arreglo[] = array('nombre' => $value->nombre, 'porcentaje'=>number_format((100*(($this->numero_tipos_ostomias($value->id,$startDate,$endDate))/$total)),2,',', ' '), 'cantidad' => (int)$this->numero_tipos_ostomias($value->id,$startDate,$endDate));
            
          }
            return $arreglo;
        } else {
            return false;
        }
   }

   public function numero_tipos_ostomias($id_tipo_ostomia,$startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('ostomias ost')
          //->join('tipos_ostomia tip', 'tip.id_tipo_ostomia = ost.tipo_ostomia')
          ->where('ost.tipo_ostomia', $id_tipo_ostomia);
      $this->db->where('ost.modified >= "'.$startDate.'" AND ost.modified <= "'.$endDate.'"');

      $consulta = $this->db->get();

      if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
              $cantidad = $value->cantidad;
          }
          return $cantidad;
      } else {
          return false;
      }
   }

   public function clasificacion_etiologia($startDate,$endDate){
    $this->db
            ->select('id_categoria_ostomia as id, cat.nombre as nombre')
            ->from('categorias_ostomia cat')
            ->join('tipos_ostomia tip','tip.categoria = cat.id_categoria_ostomia');
        $consulta = $this->db->get();
        $total = $this->get_ostomias();
        if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
              $arreglo[] = array('nombre' => $value->nombre, 'porcentaje'=>number_format((100*(($this->numero_etiologia($value->id,$startDate,$endDate))/$total)),2,',', ' '), 'cantidad' => (int)$this->numero_etiologia($value->id,$startDate,$endDate));
            
          }
            return $arreglo;
        } else {
            return false;
        }
   }

   public function numero_etiologia($categoria,$startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('ostomias ost')
          ->join('tipos_ostomia tip', 'tip. id_tipo_ostomia = ost.tipo_ostomia')
          ->where('tip.categoria', $categoria);
      $this->db->where('ost.modified >= "'.$startDate.'" AND ost.modified <= "'.$endDate.'"');

      $consulta = $this->db->get();

      if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
              $cantidad = $value->cantidad;
          }
          return $cantidad;
      } else {
          return false;
      }
   }


   public function numero_pacientes_ostomia_tipos($startDate,$endDate){
      $total = $this->get_pacientes();
      $arreglo[0] = array(''=> 'Pacientes con ostomias temporales','porcentaje'=>number_format((100*(((int)$this->numero_pacientes_ostomia_tipos_1($startDate,$endDate,1))/$total)),2,'.', ' '), 'cantidad' => (int)$this->numero_pacientes_ostomia_tipos_1($startDate,$endDate,1));
      $arreglo[1] = array(''=> 'Pacientes sin ostomias definitivas','porcentaje'=>number_format((100*(((int)$this->numero_pacientes_ostomia_tipos_1($startDate,$endDate,0))/$total)),2,'.', ' '), 'cantidad' => (int)$this->numero_pacientes_ostomia_tipos_1($startDate,$endDate,0));
      $arreglo[2] = array(''=> 'Otros','porcentaje'=>100 - number_format((100*(((int)$this->numero_pacientes_ostomia_tipos_1($startDate,$endDate,0))/$total)),2,'.', ' '), 'cantidad' => $total - (int)$this->numero_pacientes_ostomia_tipos_1($startDate,$endDate,0));
    return $arreglo;
   } 
   
  public function numero_pacientes_ostomia_tipos_1($startDate,$endDate,$tipo){
      $this->db
          ->select('count(*) as cantidad')
          ->from('ostomias ost')
          ->where('ost.temporalidad',$tipo);
      $this->db->where('ost.modified >= "'.$startDate.'" AND ost.modified <= "'.$endDate.'"');
      $consulta = $this->db->get();

      if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
              $cantidad = $value->cantidad;
          }
          return $cantidad;
      } else {
          return false;
      }
   }

   public function recomendacion_productos_convatec($startDate,$endDate,$op1,$op2){
      $total = $this->get_pacientes();
      $arreglo[0] = array(''=> 'Opinión de Pacientes','porcentaje'=>number_format((100*(((int)$this->recomendacion_productos_convatec_1($startDate,$endDate,$op1,$op2))/$total)),2,'.', ' '), 'cantidad' => (int)$this->recomendacion_productos_convatec_1($startDate,$endDate,$op1,$op2));
      $arreglo[1] = array(''=> 'Otros','porcentaje'=>100 - number_format((100*(((int)$this->recomendacion_productos_convatec_1($startDate,$endDate,$op1,$op2))/$total)),2,'.', ' '), 'cantidad' => $total - (int)$this->recomendacion_productos_convatec_1($startDate,$endDate,$op1,$op2));
    return $arreglo;
   } 
   
  public function recomendacion_productos_convatec_1($startDate,$endDate,$op1,$op2){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->where('enc.recomienda_convatec',$op1)
          ->where('enc.recomienda_programa',$op2);
      $this->db->where('enc.fecha_llamado >= "'.$startDate.'" AND enc.fecha_llamado <= "'.$endDate.'"');
      $consulta = $this->db->get();

      if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
              $cantidad = $value->cantidad;
          }
          return $cantidad;
      } else {
          return false;
      }
   }


}
