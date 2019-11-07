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
        //$total = $this->get_pacientes($startDate,$endDate);
        $total = $this->total_numero_utiliza_convatect($startDate,$endDate);

        if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
            $cantidad = (int)$this->numero_utiliza_convatect($value->id,$startDate,$endDate);
            if ($cantidad > 0) {  
              $arreglo[] = array('nombre' => $value->nombre, 'porcentaje'=>number_format((100*(($this->numero_utiliza_convatect($value->id,$startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => $cantidad);
            }
              
            
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
        //$total = $this->get_pacientes($startDate,$endDate);
        $total = $this->total_numero_recomienda_convatect($startDate,$endDate);
        if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
            $cantidad = (int)$this->numero_recomienda_convatect($value->id,$startDate,$endDate);
            if ($cantidad > 0) {
              $arreglo[] = array('nombre' => $value->nombre, 'porcentaje'=>number_format((100*(($this->numero_recomienda_convatect($value->id,$startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => $cantidad);
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
        //$total = $this->get_pacientes($startDate,$endDate);
        $total = $this->total_numero_dispositivos_medicos($startDate,$endDate);
        if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
            $cantidad = (int)$this->numero_dispositivos_medicos($value->id,$startDate,$endDate);
            if ($cantidad > 0) {
              $arreglo[] = array('nombre' => $value->nombre, 'porcentaje'=>number_format((100*(($this->numero_dispositivos_medicos($value->id,$startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => $cantidad);
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
        //$total = $this->get_pacientes($startDate,$endDate);
        $total = $this->total_numero_utiliza_complementos($startDate,$endDate);
        if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
            $cantidad = (int)$this->numero_utiliza_complementos($value->id,$startDate,$endDate);
            if ($cantidad > 0) {
              $arreglo[] = array('nombre' => $value->nombre, 'porcentaje'=>number_format((100*(($this->numero_utiliza_complementos($value->id,$startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => $cantidad);
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
        //$total = $this->get_pacientes($startDate,$endDate);
        $total = $this->total_numero_recomienda_contigo($startDate,$endDate);
        if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
            $cantidad = (int)$this->numero_recomienda_contigo($value->id,$startDate,$endDate);
            if ($cantidad > 0) {
              $arreglo[] = array('nombre' => $value->nombre, 'porcentaje'=>number_format((100*(((int)$this->numero_recomienda_contigo($value->id,$startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => $cantidad);
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
        //$total = $this->get_pacientes($startDate,$endDate);
        $total = $this->total_numero_activo_programa($startDate,$endDate);
        if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
            $cantidad = (int)$this->numero_activo_programa($value->id,$startDate,$endDate);
            if ($cantidad > 0) {
              $arreglo[] = array('nombre' => $value->nombre, 'porcentaje'=>number_format((100*(($this->numero_activo_programa($value->id,$startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => $cantidad);
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
        //$total = $this->get_pacientes($startDate,$endDate);
        $total = $this->total_numero_cierre_quirurgico($startDate,$endDate);
        if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
            $cantidad = (int)$this->numero_cierre_quirurgico($value->id,$startDate,$endDate);
            if ($cantidad > 0) {
              $arreglo[] = array('nombre' => $value->nombre, 'porcentaje'=>number_format((100*(($this->numero_cierre_quirurgico($value->id,$startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => $cantidad);
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
        //$total = $this->get_pacientes($startDate,$endDate);
        $total = $this->total_numero_complicaciones_dispositivo($startDate,$endDate);
        if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
            $cantidad = (int)$this->numero_complicaciones_dispositivo($value->id,$startDate,$endDate);
            if ($cantidad > 0) {
              $arreglo[] = array('nombre' => $value->nombre, 'porcentaje'=>number_format((100*(($this->numero_complicaciones_dispositivo($value->id,$startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => $cantidad);
            }
            
          }
            return $arreglo;
        } else {
            return false;
        }
   }

   public function get_pacientes($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('pacientes p')
          ->join('encuestas e', 'e.paciente = p.id_paciente', 'left')
          ->where('p.activo', 1)
          ->where('p.contigo', 1);
      $this->db->where('p.created >= "'.$startDate.'" AND p.created <= "'.$endDate.'"');
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
          ->where('est.id_establecimiento', $id_establecimiento)
          ->where('pac.contigo', 1);
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

   public function total_numero_utiliza_convatect($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->join('establecimientos est', 'est.id_establecimiento = pac.establecimiento')
          ->join('sistema_encuesta se', 'se.encuesta = enc.id_encuesta')
          ->where('pac.contigo', 1);
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
          ->where('enc.recomienda_convatec', '1')
          ->where('pac.contigo', 1);
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

   public function total_numero_recomienda_convatect($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->join('establecimientos est', 'est.id_establecimiento = pac.establecimiento')
          ->where('enc.recomienda_convatec', '1')
          ->where('pac.contigo', 1);
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
          ->where('enc.correccion_entrega', '1')
          ->where('pac.contigo', 1);
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

   public function total_numero_dispositivos_medicos($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->join('establecimientos est', 'est.id_establecimiento = pac.establecimiento')
          ->where('enc.correccion_entrega', '1')
          ->where('pac.contigo', 1);
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
          ->where('est.id_establecimiento', $id_establecimiento)
          ->where('pac.contigo', 1);
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

   public function total_numero_utiliza_complementos($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->join('establecimientos est', 'est.id_establecimiento = pac.establecimiento')
          ->join('adjuvante_encuesta ae', 'ae.encuesta = enc.id_encuesta')
          ->where('pac.contigo', 1);
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
          ->where('enc.recomienda_programa','1')
          ->where('pac.contigo', 1);
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

   public function total_numero_recomienda_contigo($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->join('establecimientos est', 'est.id_establecimiento = pac.establecimiento')
          ->where('enc.recomienda_programa','1')
          ->where('pac.contigo', 1);
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
          ->where('enc.estado_programa','1')
          ->where('pac.contigo', 1);
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

   public function total_numero_activo_programa($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->join('establecimientos est', 'est.id_establecimiento = pac.establecimiento')
          ->where('enc.estado_programa','1')
          ->where('pac.contigo', 1);
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
          ->where('enc.cierre_quirurgico','1')
          ->where('pac.contigo', 1);
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

   public function total_numero_cierre_quirurgico($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->join('establecimientos est', 'est.id_establecimiento = pac.establecimiento')
          ->where('enc.cierre_quirurgico','1')
          ->where('pac.contigo', 1);
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
          ->where('enc.remitido','1')
          ->where('pac.contigo', 1);
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

   public function total_numero_complicaciones_dispositivo($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->join('establecimientos est', 'est.id_establecimiento = pac.establecimiento')
          ->where('enc.remitido','1')
          ->where('pac.contigo', 1);
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
      $total = $this->get_pacientes($startDate,$endDate);
      $arreglo[0] = array(''=> 'Pacientes activos','porcentaje'=>number_format((100*(((int)$this->numero_pacientes_contigo($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => (int)$this->numero_pacientes_contigo($startDate,$endDate));
      $arreglo[1] = array(''=> 'Pacientes inactivos','porcentaje'=>100 - number_format((100*(((int)$this->numero_pacientes_contigo($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => $total - (int)$this->numero_pacientes_contigo($startDate,$endDate));
    return $arreglo;
   } 
   
  public function numero_pacientes_contigo($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->where('enc.estado_programa','1')
          ->where('pac.contigo', 1);
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
      $total = $this->get_pacientes($startDate,$endDate);
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
          ->join('sistema_encuesta se', 'se.encuesta = enc.id_encuesta')
          ->where('pac.contigo', 1);
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
      $total = $this->get_pacientes($startDate,$endDate);
      $arreglo[0] = array(''=> 'Pacientes que utilizan','porcentaje'=>number_format((100*(((int)$this->numero_pacientes_utiliza_convatec($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => (int)$this->numero_pacientes_utiliza_convatec($startDate,$endDate));
      $arreglo[1] = array(''=> 'Pacientes que no utilizan','porcentaje'=>100 - number_format((100*(((int)$this->numero_pacientes_utiliza_convatec($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => $total - (int)$this->numero_pacientes_utiliza_convatec($startDate,$endDate));
    return $arreglo;
   } 
   
  public function numero_pacientes_utiliza_convatec($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->join('sistema_encuesta se', 'se.encuesta = enc.id_encuesta')
          ->where('pac.contigo', 1);
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
      $total = $this->get_pacientes($startDate,$endDate);
      $arreglo[0] = array(''=> 'Pacientes que recomiendan','porcentaje'=>number_format((100*(((int)$this->numero_pacientes_recomienda_convatect($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => (int)$this->numero_pacientes_recomienda_convatect($startDate,$endDate));
      $arreglo[1] = array(''=> 'Pacientes que no recomiendan','porcentaje'=>100 - number_format((100*(((int)$this->numero_pacientes_recomienda_convatect($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => $total - (int)$this->numero_pacientes_recomienda_convatect($startDate,$endDate));
    return $arreglo;
   } 
   
  public function numero_pacientes_recomienda_convatect($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->where('enc.recomienda_convatec', '1')
          ->where('pac.contigo', 1);
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
      $total = $this->get_pacientes($startDate,$endDate);
      $arreglo[0] = array(''=> 'Pacientes con complicaciones','porcentaje'=>number_format((100*(((int)$this->numero_pacientes_complicaciones($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => (int)$this->numero_pacientes_complicaciones($startDate,$endDate));
      $arreglo[1] = array(''=> 'Pacientes sin complicaciones','porcentaje'=>100 - number_format((100*(((int)$this->numero_pacientes_complicaciones($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' =>$total - (int)$this->numero_pacientes_complicaciones($startDate,$endDate));
    return $arreglo;
   } 
   
  public function numero_pacientes_complicaciones($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->where('enc.remitido','1')
          ->where('pac.contigo', 1);
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
      $total = $this->get_pacientes($startDate,$endDate);
      $arreglo[0] = array(''=> 'Pacientes que han cambiado','porcentaje'=>number_format((100*(((int)$this->numero_pacientes_dispositivo($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => (int)$this->numero_pacientes_dispositivo($startDate,$endDate));
      $arreglo[1] = array(''=> 'Pacientes que no han cambiado','porcentaje'=>100 - number_format((100*(((int)$this->numero_pacientes_dispositivo($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' =>$total - (int)$this->numero_pacientes_dispositivo($startDate,$endDate));
    return $arreglo;
   } 
   
  public function numero_pacientes_dispositivo($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->where('enc.correccion_entrega', '1')
          ->where('pac.contigo', 1);
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
      $total = $this->get_pacientes($startDate,$endDate);
      $arreglo[0] = array(''=> 'Pacientes que recomiendan','porcentaje'=>number_format((100*(((int)$this->numero_pacientes_recomienda_contigo($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => (int)$this->numero_pacientes_recomienda_contigo($startDate,$endDate));
      $arreglo[1] = array(''=> 'Pacientes que no recomiendan','porcentaje'=>100 - number_format((100*(((int)$this->numero_pacientes_recomienda_contigo($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' =>$total - (int)$this->numero_pacientes_recomienda_contigo($startDate,$endDate));
    return $arreglo;
   } 
   
  public function numero_pacientes_recomienda_contigo($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->where('enc.recomienda_programa','1')
          ->where('pac.contigo', 1);
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
      $total = $this->get_pacientes($startDate,$endDate);
      $arreglo[0] = array(''=> 'Pacientes que retomaron','porcentaje'=>number_format((100*(((int)$this->numero_pacientes_retomaron_actividad($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => (int)$this->numero_pacientes_retomaron_actividad($startDate,$endDate));
      $arreglo[1] = array(''=> 'Pacientes que no retomaron','porcentaje'=>100 - number_format((100*(((int)$this->numero_pacientes_retomaron_actividad($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => $total - (int)$this->numero_pacientes_retomaron_actividad($startDate,$endDate));
    return $arreglo;
   } 
   
  public function numero_pacientes_retomaron_actividad($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->where('enc.tiempo_retorno_laboral','6')
          ->where('pac.contigo', 1);
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
      $total = $this->get_pacientes($startDate,$endDate);
      $arreglo[0] = array(''=> 'Pacientes con adherencia','porcentaje'=>number_format((100*(((int)$this->numero_pacientes_adherencia_autocuidado($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => (int)$this->numero_pacientes_adherencia_autocuidado($startDate,$endDate));
      $arreglo[1] = array(''=> 'Pacientes sin adherencia','porcentaje'=>100 - number_format((100*(((int)$this->numero_pacientes_adherencia_autocuidado($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => $total - (int)$this->numero_pacientes_adherencia_autocuidado($startDate,$endDate));
    return $arreglo;
   } 
   
  public function numero_pacientes_adherencia_autocuidado($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->where('enc.autocuidado','1')
          ->where('pac.contigo', 1);
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
      $total = $this->get_pacientes($startDate,$endDate);
      $arreglo[0] = array(''=> 'Pacientes activos','porcentaje'=>number_format((100*(((int)$this->numero_pacientes_activos_contigo_1($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => (int)$this->numero_pacientes_activos_contigo_1($startDate,$endDate));
      $arreglo[1] = array(''=> 'Pacientes inactivos','porcentaje'=>100 - number_format((100*(((int)$this->numero_pacientes_activos_contigo_1($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => $total - (int)$this->numero_pacientes_activos_contigo_1($startDate,$endDate));
    return $arreglo;
   } 
   
  public function numero_pacientes_activos_contigo_1($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->where('enc.estado_programa','1')
          ->where('pac.contigo', 1);
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
      $total = $this->get_pacientes($startDate,$endDate);
      $arreglo[0] = array(''=> 'Pacientes activos','porcentaje'=>number_format((100*(((int)$this->numero_pacientes_ostomia_temporal_1($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => (int)$this->numero_pacientes_ostomia_temporal_1($startDate,$endDate));
      $arreglo[1] = array(''=> 'Pacientes inactivos','porcentaje'=>100 - number_format((100*(((int)$this->numero_pacientes_ostomia_temporal_1($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => $total - (int)$this->numero_pacientes_ostomia_temporal_1($startDate,$endDate));
    return $arreglo;
   } 
   
  public function numero_pacientes_ostomia_temporal_1($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->where('enc.cierre_quirurgico','1')
          ->where('pac.contigo', 1);
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
      $total = $this->get_pacientes($startDate,$endDate);
      $arreglo[0] = array(''=> 'Pacientes con Ostomia','porcentaje'=>number_format((100*(((int)$this->numero_pacientes_ostomia_1($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => (int)$this->numero_pacientes_ostomia_1($startDate,$endDate));
      $arreglo[1] = array(''=> 'Pacientes sin Ostomia','porcentaje'=>100 - number_format((100*(((int)$this->numero_pacientes_ostomia_1($startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => $total - (int)$this->numero_pacientes_ostomia_1($startDate,$endDate));
    return $arreglo;
   } 
   
  public function numero_pacientes_ostomia_1($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('encuestas enc')
          ->join('pacientes pac', 'pac.id_paciente = enc.paciente')
          ->where('enc.remitido','1')
          ->where('pac.contigo', 1);
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
      $total = $this->get_pacientes($startDate,$endDate);
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
          ->where('enc.correccion_entrega','1')
          ->where('pac.contigo', 1);
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
      $total = $this->get_pacientes($startDate,$endDate);
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
          ->where('enc.correccion_entrega','0')
          ->where('pac.contigo', 1);
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
        //$total = $this->get_ostomias();
        $total = $this->total_numero_tipos_ostomias($startDate,$endDate);
        if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
            $cantidad = (int)$this->numero_tipos_ostomias($value->id,$startDate,$endDate);
            if($cantidad > 0){
              $arreglo[] = array('nombre' => $value->nombre, 'porcentaje'=>number_format((100*(($this->numero_tipos_ostomias($value->id,$startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => $cantidad);
            }
            
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

   public function total_numero_tipos_ostomias($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('ostomias ost');
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
        //$total = $this->get_ostomias();
        $total = $this->total_numero_etiologia($startDate,$endDate);
        if ($consulta->num_rows() > 0) {
          foreach ($consulta->result() as $key => $value) {
            $cantidad = (int)$this->numero_etiologia($value->id,$startDate,$endDate);
            if($cantidad > 0){
              $arreglo[] = array('nombre' => $value->nombre, 'porcentaje'=>number_format((100*(($this->numero_etiologia($value->id,$startDate,$endDate))/$total)),2,'.', ' '), 'cantidad' => $cantidad);
            }
            
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

   public function total_numero_etiologia($startDate,$endDate){
      $this->db
          ->select('count(*) as cantidad')
          ->from('ostomias ost')
          ->join('tipos_ostomia tip', 'tip. id_tipo_ostomia = ost.tipo_ostomia');
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
      $total = $this->get_pacientes($startDate,$endDate);
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
      $total = $this->get_pacientes($startDate,$endDate);
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

    public function get_sabana_pacientes($fecha_ini = '0000-00-00', $fecha_fin = '0000-00-00'){
        $sql= "SELECT
                p.`id_paciente` as 'Id_Paciente',
                CONVERT(p.`nombres` USING utf8) as 'Nombres',
                CONVERT(p.`apellido_paterno` USING utf8) as 'Apellido Paterno',
                CONVERT(p.`apellido_materno` USING utf8) as 'Apellido Materno',
                IF(
                    p.`fecha_nacimiento`,
                    p.`fecha_nacimiento`,
                    '-') AS 'Fecha Nacimiento',
                IF(
                    p.`fecha_nacimiento`,
                    TIMESTAMPDIFF(YEAR,p.`fecha_nacimiento`,CURDATE()),
                    '-') AS 'Edad',
                p.`rut` as 'DNI',
                IF(p.`email` = '',
                    '-',
                    p.`email`
                    ) AS 'Email',
                IF(
                    p.`genero` = 1,
                    'Masculino',
                    IF(p.`genero` = 2, 'Femenino', '-')
                    ) AS 'Género',
                IF(p.`isapre`, (SELECT Isapre.isapre FROM isapres Isapre WHERE Isapre.`id_isapre`= p.isapre LIMIT 1),'-') as 'Isapre',
                IF(p.`fonasa_plan` != '',p.`fonasa_plan`,'-') AS 'Plan Isapre',
                IF(
                    p.`archivo_consentimiento` != '',
                    'Si',
                    'No') AS 'Consentimiento firmado',
                p.`archivo_consentimiento` as 'Url Consentimiento',
                IF(p.`direccion`, (SELECT Comuna.comuna FROM direccion Direccion JOIN comunas Comuna ON (Comuna.id = Direccion.`comuna`) WHERE Direccion.`id_direccion` = p.direccion LIMIT 1),'-') as 'Comuna',
                IF(p.`direccion`, (SELECT Region.Region FROM direccion Direccion JOIN comunas Comuna ON (Comuna.id = Direccion.`comuna`) JOIN regiones Region ON (Comuna.region = Region.id_region) WHERE Direccion.`id_direccion` = p.direccion LIMIT 1),'-') as 'Region',
                IF(
                p.contigo = 1,
                'SI',
                'NO'
                 ) as 'Contigo',
                IF(
                  p.domiciliario = 1,
                'SI',
                'NO'
                ) As 'PAD',
                IF(
                p.oncovida = 1,
                'SI',
                'NO'
                ) As 'Oncovida',
                IF(
                p.cmc = 1,
                'SI',
                'NO'
                ) as 'CMC',
                ifnull(
                    (SELECT
                        COUNT(DISTINCT(Atencion.created))
                        FROM atenciones Atencion
                        JOIN diagnostico d1 ON (Atencion.diagnostico = d1.id_diagnostico)
                        JOIN pacientes p1 ON (d1.id_diagnostico = p1.diagnostico)
                        WHERE
                            p1.id_paciente = p.id_paciente  
                        ), 0
                    ) as 'Nro de Atenciones',
                ifnull(
                    (SELECT
                        COUNT(DISTINCT(Ostomia.created))
                        FROM ostomias Ostomia
                        JOIN diagnostico d1 ON (Ostomia.diagnostico = d1.id_diagnostico)
                        JOIN pacientes p1 ON (d1.id_diagnostico = p1.diagnostico)
                        WHERE
                            p1.id_paciente = p.id_paciente  
                        ), 0
                    ) as 'Nro de Ostomias',
                ifnull(
                    (SELECT
                        COUNT(DISTINCT(Herida.created))
                        FROM heridas Herida
                        JOIN diagnostico d1 ON (Herida.diagnostico = d1.id_diagnostico)
                        JOIN pacientes p1 ON (d1.id_diagnostico = p1.diagnostico)
                        WHERE
                            p1.id_paciente = p.id_paciente  
                        ), 0
                    ) as 'Nro de Heridas',
                ifnull(
                    (SELECT
                        COUNT(DISTINCT(Encuesta.created))
                        FROM encuestas Encuesta
                        JOIN pacientes p1 ON (Encuesta.paciente = p1.id_paciente)
                        WHERE
                            p1.id_paciente = p.id_paciente
                        ), 0
                    ) as 'Nro de Llamados',
                ifnull(
                    (SELECT
                        COUNT(DISTINCT(Cita.created))
                        FROM citas Cita
                        JOIN pacientes p1 ON (Cita.paciente = p1.id_paciente)
                        WHERE
                            p1.id_paciente = p.id_paciente  
                        ), 0
                    ) as 'Nro Veces Agendado',
                IF(p.`establecimiento`, (SELECT Establecimiento.nombre FROM establecimientos Establecimiento WHERE Establecimiento.`id_establecimiento` = p.establecimiento LIMIT 1), 'No registrado' ) as 'Establecimiento Médico',    
                IF(p.`medico_tratante`, (SELECT Medico.nombres FROM medicos Medico WHERE Medico.`id_medico` = p.medico_tratante LIMIT 1),'No registrado') as 'Médico Tratante',
                (Select CONCAT(Vendedor.nombre, ' ', Vendedor.apellido_paterno) FROM paciente_vendedor PacienteVendedor JOIN usuarios Usuario ON (PacienteVendedor.`usuario` = Usuario.`id_usuario`) JOIN personas Vendedor ON (Usuario.`persona` = Vendedor.id_persona) WHERE PacienteVendedor.paciente = p.id_paciente limit 1 ) as 'Vendedor',
                p.`parentesco_acompanante` AS 'Acompañante',
                IF(p.activo = 1,
                    'Activo',
                    'Inactivo'
                ) as 'Estado',
                IF(p.validado = 1,
                    'Si',
                    'No'
                ) as 'Validado',
                p.created AS 'Fecha Inscripcion'
                FROM
                    pacientes p 
                WHERE 
                    p.nombres != 'Prueba'
                    AND IF('#FECHAINI#' != '0000-00-00' AND '#FECHAFIN#' != '0000-00-00' ,
                (p.created BETWEEN '#FECHAINI#' AND '#FECHAFIN#'), 1)";


                $sql = str_replace("#FECHAINI#", $fecha_ini.' 23:59:59', $sql);
                $sql = str_replace("#FECHAFIN#", $fecha_fin.' 23:59:59', $sql);

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

    public function get_sabana_ostomias($fecha_ini = '0000-00-00', $fecha_fin = '0000-00-00'){
        $sql= "SELECT
                Ostomia.id_ostomia,
                Paciente.`id_paciente` as 'Id_Paciente',
                  CONVERT(Paciente.`nombres` USING utf8) as 'Nombres',
                  CONVERT(Paciente.`apellido_paterno` USING utf8) as 'Apellido Paterno',
                  CONVERT(Paciente.`apellido_materno` USING utf8) as 'Apellido Materno',
                  IF(Paciente.activo = 1,
                     'Activo',
                     'Inactivo'
                  ) as 'Estado Paciente',
                TipoOstomia.nombre as 'Tipo Ostomía',
                IF(
                  Ubicacion.`id_ubicacion_estoma` IS NULL,
                  '-',
                  Ubicacion.`nombre`
                ) 'Ubicación',
                IF(Ostomia.`tamano_boca_proximal` != '',
                Ostomia.`tamano_boca_proximal`,
                '-'
                ) as 'Tamaño boca Proximal',
                IF(Ostomia.`tamano_boca_distal` != '',
                Ostomia.`tamano_boca_distal`,
                '-'
                ) as 'Tamaño boca Distal',
                IF(Ostomia.`puente_piel` = 1,
                'Si',
                'No'
                ) as 'Puente Piel',
                IF(Ostomia.`temporalidad` = 1,
                'Si',
                'No'
                ) as 'Puente Piel',
                IF(Ostomia.`una_boca` = 1,
                'Si',
                'No'
                ) as 'Una Boca',
                IF(Ostomia.`dos_bocas` = 1,
                'Si',
                'No'
                ) as 'Dos Bocas',
                  IF(Ostomia.`en_asa` = 1,
                'Si',
                'No'
                ) as 'En Asa',
                IF(Ostomia.`fisula` = 1,
                'Si',
                'No'
                ) as 'Físula',
                (case
                      when Ostomia.angulo_drenaje = 1 then 'Centro'
                      when Ostomia.angulo_drenaje = 2 then 'Cuadrante 3 a 6'
                      when Ostomia.angulo_drenaje = 3 then 'Cuadrante 6 a 9'
                      when Ostomia.angulo_drenaje = 4 then 'Cuadrante 9 a 12'
                  when Ostomia.angulo_drenaje = 5 then 'Cuadrante 12 a 3'
                      else ''
                  end) as 'Ángulo de Drenaje',
                (SELECT ValoracionOstomia.sacst FROM valoracion_ostomia ValoracionOstomia WHERE ValoracionOstomia.ostomia = Ostomia.id_ostomia order by ValoracionOstomia.id_valoracion_ostomia DESC limit 1) as 'SacsT',
                  (SELECT ValoracionOstomia.sacsl FROM valoracion_ostomia ValoracionOstomia WHERE ValoracionOstomia.ostomia = Ostomia.id_ostomia order by ValoracionOstomia.id_valoracion_ostomia DESC limit 1) as 'SacsL',
                IF(Ostomia.`marcacion_pre_quirurgica` = 1,
                'Si',
                'No'
                ) as 'Marcación Pre Quiurgica',
                ifnull((SELECT Atencion.created FROM atenciones Atencion WHERE Atencion.diagnostico = Diagnostico.id_diagnostico order by Atencion.id_atencion DESC limit 1), '-') as 'Fecha Última Atención',
                ifnull((SELECT 
                CONCAT(P.nombre, ' ', P.apellido_paterno) 
                FROM 
                  atencion_profesional AtencionProfesional 
                  JOIN profesionales Profesional ON (AtencionProfesional.profesional = Profesional.id_profesional)
                  JOIN usuarios Usuario ON (Profesional.usuario = Usuario.id_usuario) 
                  JOIN personas P ON (Usuario.persona = P.id_persona)
                  JOIN atenciones A ON (AtencionProfesional.atencion = A.id_atencion) 
                WHERE 
                  A.diagnostico = Diagnostico.id_diagnostico 
                order by A.id_atencion DESC 
                limit 1), '-') as 'Atendido Por',
                ifnull((SELECT Atencion.estado_animo FROM atenciones Atencion WHERE Atencion.diagnostico = Diagnostico.id_diagnostico order by Atencion.id_atencion DESC limit 1), '-') as 'Estado Ánimo',
                ifnull((SELECT Atencion.Agudeza_visual FROM atenciones Atencion WHERE Atencion.diagnostico = Diagnostico.id_diagnostico order by Atencion.id_atencion DESC limit 1), '-') as 'Agudeza Visual',
                ifnull((SELECT Atencion.destreza_manual FROM atenciones Atencion WHERE Atencion.diagnostico = Diagnostico.id_diagnostico order by Atencion.id_atencion DESC limit 1), '-') as 'Destreza Manual',
                ifnull((SELECT Atencion.actividad FROM atenciones Atencion WHERE Atencion.diagnostico = Diagnostico.id_diagnostico order by Atencion.id_atencion DESC limit 1), '-') as 'Actividad',
                ifnull((SELECT Atencion.dependencia FROM atenciones Atencion WHERE Atencion.diagnostico = Diagnostico.id_diagnostico order by Atencion.id_atencion DESC limit 1), '-') as 'Dependencia'
                FROM
                  ostomias Ostomia
                  JOIN diagnostico Diagnostico ON (Ostomia.`diagnostico` = Diagnostico.`id_diagnostico`)
                  JOIN tipos_ostomia TipoOstomia ON (Ostomia.`tipo_ostomia` = TipoOstomia.`id_tipo_ostomia`)
                  JOIN pacientes Paciente ON (Diagnostico.id_diagnostico = Paciente.diagnostico)
                  LEFT JOIN ubicaciones_estomas Ubicacion ON (Ostomia.`ubicacion` = Ubicacion.`id_ubicacion_estoma`)
                  WHERE Paciente.nombres != 'Prueba'
                  AND IF('#FECHAINI#' != '0000-00-00' AND '#FECHAFIN#' != '0000-00-00' ,
                  (Ostomia.created BETWEEN '#FECHAINI#' AND '#FECHAFIN#'), 1)";


              $sql = str_replace("#FECHAINI#", $fecha_ini, $sql);
              $sql = str_replace("#FECHAFIN#", $fecha_fin, $sql);
                
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
        public function get_sabana_atenciones($fecha_ini = '0000-00-00', $fecha_fin = '0000-00-00'){
        $sql= "SELECT
                Atencion.id_atencion,
                Paciente.`id_paciente` as 'Id_Paciente',
                  CONVERT(Paciente.`nombres` USING utf8) as 'Nombres',
                  CONVERT(Paciente.`apellido_paterno` USING utf8) as 'Apellido Paterno',
                  CONVERT(Paciente.`apellido_materno` USING utf8) as 'Apellido Materno',
                  IF(Paciente.activo = 1,
                     'Activo',
                     'Inactivo'
                  ) as 'Estado Paciente',
                    Atencion.diagnostico as 'Id Diagnostico',
                    Atencion.frecuencia_cardiaca as 'Frecuencia cardiaca',
                    Atencion.presion_arterial as 'Presión arterial',
                    Atencion.temperatura as 'Temperatura',
                    Atencion.peso as 'Peso',
                    Atencion.estatura as 'Estatura',
                    Atencion.imc as 'IMC',
                    Atencion.estado_animo as 'Estado Ánimo',
                    Atencion.agudeza_visual as 'Agudeza Visual',
                    Atencion.destreza_manual as 'Destreza Manual',
                    Atencion.actividad as 'Actividad',
                    Atencion.descripcion as 'Descripcion',
                    Atencion.dependencia as 'Dependencia',
                    Atencion.created as 'Fecha Atención',
                ifnull((SELECT 
                CONCAT(P.nombre, ' ', P.apellido_paterno) 
                FROM 
                  atencion_profesional AtencionProfesional 
                  JOIN profesionales Profesional ON (AtencionProfesional.profesional = Profesional.id_profesional)
                  JOIN usuarios Usuario ON (Profesional.usuario = Usuario.id_usuario) 
                  JOIN personas P ON (Usuario.persona = P.id_persona)
                  JOIN atenciones A ON (AtencionProfesional.atencion = A.id_atencion) 
                WHERE 
                  A.diagnostico = Atencion.diagnostico 
                order by A.id_atencion DESC 
                limit 1), '-') as 'Atendido Por'
                FROM
                  atenciones Atencion
                  JOIN diagnostico Diagnostico ON (Atencion.`diagnostico` = Diagnostico.`id_diagnostico`)
                  JOIN pacientes Paciente ON (Diagnostico.id_diagnostico = Paciente.diagnostico)
                  WHERE Paciente.nombres != 'Prueba'
                  AND IF('#FECHAINI#' != '0000-00-00' AND '#FECHAFIN#' != '0000-00-00' ,
                  (Atencion.created BETWEEN '#FECHAINI#' AND '#FECHAFIN#'), 1)";


              $sql = str_replace("#FECHAINI#", $fecha_ini, $sql);
              $sql = str_replace("#FECHAFIN#", $fecha_fin, $sql);
                
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
     public function get_sabana_insumos_utilizados($fecha_ini = '0000-00-00', $fecha_fin = '0000-00-00'){
        $sql= "SELECT
                InsumoUtilizado.insumo as 'id_insumo',
                InsumoUtilizado.cantidad_unitaria as 'Cantidad',
                IF(InsumoUtilizado.gratis = 1,
                     'Si',
                     'No'
                  ) as 'Gratis',
                A.id_atencion,
                LineaInsumo.nombre as 'Linea',
                FamiliaInsumo.nombre as 'Familia',
                Insumo.sap as 'Sap',   
                Insumo.icc as 'Icc',
                Insumo.descripcion_sap as 'Descripcion sap',
                Insumo.material as 'Material',
                Paciente.`id_paciente` as 'Id_Paciente',
                  CONVERT(Paciente.`nombres` USING utf8) as 'Nombres',
                  CONVERT(Paciente.`apellido_paterno` USING utf8) as 'Apellido Paterno',
                  CONVERT(Paciente.`apellido_materno` USING utf8) as 'Apellido Materno'
                FROM 
                  insumos_utilizados InsumoUtilizado 
                  JOIN insumos Insumo ON (InsumoUtilizado.insumo = Insumo.id_insumo)
                  JOIN lineas_insumos LineaInsumo ON (Insumo.linea = LineaInsumo.id_linea_insumo )
                  JOIN familias_insumos FamiliaInsumo ON (Insumo.linea = FamiliaInsumo.id_familia_insumo )
                  JOIN atenciones A ON (InsumoUtilizado.atencion = A.id_atencion) 
                  JOIN atencion_profesional AtencionProfesional ON (A.id_atencion = AtencionProfesional.atencion) 
                  JOIN diagnostico Diagnostico ON (A.diagnostico = Diagnostico.id_diagnostico)
                  JOIN pacientes Paciente ON (Diagnostico.id_diagnostico = Paciente.diagnostico)
                  JOIN profesionales Profesional ON (AtencionProfesional.profesional = Profesional.id_profesional)
                  JOIN usuarios Usuario ON (Profesional.usuario = Usuario.id_usuario) 
                  JOIN personas P ON (Usuario.persona = P.id_persona)
                  WHERE Paciente.nombres != 'Prueba'
                  AND IF('#FECHAINI#' != '0000-00-00' AND '#FECHAFIN#' != '0000-00-00' ,
                  (A.created BETWEEN '#FECHAINI#' AND '#FECHAFIN#'), 1)";


              $sql = str_replace("#FECHAINI#", $fecha_ini, $sql);
              $sql = str_replace("#FECHAFIN#", $fecha_fin, $sql);
                
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
    
    public function get_sabana_imagenes($fecha_ini = '0000-00-00', $fecha_fin = '0000-00-00'){
        $sql= "SELECT
                PacienteGaleria.id_galeria,
                PacienteGaleria.`id_paciente` as 'Id_Paciente',
                PacienteGaleria.nombre as 'nombre',
                 CONCAT('http://34.197.228.212/clinica/uploads/', PacienteGaleria.slug) as 'Url',
                PacienteGaleria.detalle as 'Detalle'
                FROM
                  paciente_galeria PacienteGaleria
                  JOIN pacientes Paciente ON (PacienteGaleria.id_paciente = Paciente.id_paciente)
                  WHERE Paciente.nombres != 'Prueba'
                  AND IF('#FECHAINI#' != '0000-00-00' AND '#FECHAFIN#' != '0000-00-00' ,
                  (PacienteGaleria.created BETWEEN '#FECHAINI#' AND '#FECHAFIN#'), 1)";


              $sql = str_replace("#FECHAINI#", $fecha_ini, $sql);
              $sql = str_replace("#FECHAFIN#", $fecha_fin, $sql);
                
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
}

