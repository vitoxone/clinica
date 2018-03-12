<?php

class Galeria_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('text_helper');
    }


    public function guardar_imagen($data){
        $this->db->insert("paciente_galeria",$data);

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        else{
            return false;
        }
    }

    public function actualizar_imagen($data,$id_imagen){
        $this->db->where('id_galeria', $id_imagen);
        $this->db->update('paciente_galeria', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        else{
            return false;
        }
    }
    
    public function obtener_galerias($id_paciente){
        $this->db->select('id_galeria,nombre,detalle,slug,fecha_creacion,usuario');    
        $this->db->from('paciente_galeria');
        $this->db->join('usuarios', 'usuarios.id_usuario = paciente_galeria.id_usuario','left');
        $this->db->where('id_paciente',$id_paciente);
        $query = $this->db->get();

        return $query->result();
    }

    public function obtener_datos($id_imagen){
        $query = $this->db->select('id_galeria,nombre,detalle,slug')->from('paciente_galeria')->where('id_galeria',$id_imagen)->get();
        return $query->result();
    }
    
    
    public function eliminar_imagenes($lista){
        $imagen = explode("/", $lista);
        for ($i=0; $i < (count($imagen) - 1) ; $i++) { 
            $this->delete($imagen[$i]);
        }
    }

    public function delete($id){
        $this->db->where('id_galeria', $id);
        $this->db->delete('paciente_galeria');
    }

    public function validar_imagen($id){
        $query = $this->db->query("SELECT COUNT(id_galeria) FROM paciente_galeria WHERE id_galeria = ".$id);
        return $query->num_rows();
    }
}