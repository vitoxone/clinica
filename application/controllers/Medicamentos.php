<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medicamentos extends CI_Controller {

	public function __construct() {
        parent::__construct();

    }


	public function listado_medicamentos()
	{

		$this->load->model('Medicamentos_model');


		$datos['medicamentos'] = $this->Medicamentos_model->get_medicamentos();


		$this->load->view('header.php');
		$this->load->view('navigation_admin.php');
		$this->load->view('medicamentos/listado_medicamentos', $datos);
		$this->load->view('footer.php');
	}

    public function getRewriteString($sString) {
          $string = strtolower(htmlentities($sString));
          //$string = preg_replace("/&(.)(uml);/", "$1e", $string);
         // $string = preg_replace("/&(.)(acute|cedil|circ|ring|tilde|uml);/", "$1", $string);
          $string = preg_replace("/([\n]+)/", ' ', html_entity_decode($string));
          $string = trim($string, "-");
         return $string;
    }

	public function listado_insumos()
	{

		$this->load->model('Medicamentos_model');

		$insumos = $this->Medicamentos_model->get_insumos_bodega_general();

		if($insumos){
        	foreach($insumos as $insumo){
        		if($insumo->activo){
        			$activo = true;
        		}else{
        			$activo = false;
        		}
            	$insumos_list[] = array('id_insumo' => $insumo->id_insumo, 'linea' => $insumo->nombre_linea ,'familia' => $insumo->nombre_familia,'sap' => $insumo->sap, 'icc' => $insumo->icc, 'descripcion_sap' => $insumo->descripcion_sap, 'material' => $insumo->material, 'composicion' => $insumo->composicion, 'unidad_medida'=>$insumo->unidad_medida, 'stock_unitario'=>intval($insumo->stock_general), 'activo'=>$activo, 'guardando'=>0);
                     																			
            }
        }else{
        	$insumos_list[] = '{}';
        }
        $datos['insumos'] = json_encode($insumos_list);

        $datos['active_view'] = 'insumos';
 
		$this->load->view('header.php');
		$this->load->view('navigation_admin.php', $datos);
		$this->load->view('medicamentos/listado_insumos', $datos);
		$this->load->view('footer.php');
	}

	public function get_insumos_validos()
	{

		$this->load->model('Medicamentos_model');


		$insumos = $this->Medicamentos_model->get_insumos();

		if($insumos){
        	foreach($insumos as $insumo){
        		if($insumo->activo){
        			$activo = true;
        		}else{
        			$activo = false;
        		}
            	$insumos_list[] = array('id_insumo' => $insumo->id_insumo, 'linea' => $insumo->nombre_linea ,'familia' => $insumo->nombre_familia,'sap' => $insumo->sap, 'icc' => $insumo->icc, 'descripcion_sap' => $insumo->descripcion_sap, 'material' => $insumo->material, 'composicion' => $insumo->composicion, 'unidad_medida'=>$insumo->unidad_medida, 'stock_unitario'=>intval($insumo->stock_unitario), 'cantidad'=>1, 'gratis'=>0, 'activo'=>$activo);
                     																			
            }
        }else{
        	$insumos_list[] = '{}';
        }

        echo json_encode($insumos_list);
	}

	public function get_insumos_activos()
	{

		$this->load->model('Medicamentos_model');


		$insumos = $this->Medicamentos_model->get_insumos_activos();

		if($insumos){
        	foreach($insumos as $insumo){
        		if($insumo->activo){
        			$activo = true;
        		}else{
        			$activo = false;
        		}
            	$insumos_list[] = array('id_insumo' => $insumo->id_insumo, 'linea' => $insumo->nombre_linea ,'familia' => $insumo->nombre_familia,'sap' => $insumo->sap, 'icc' => $insumo->icc, 'descripcion_sap' => $insumo->descripcion_sap, 'material' => $insumo->material, 'composicion' => $insumo->composicion, 'unidad_medida'=>$insumo->unidad_medida, 'stock_unitario'=>intval($insumo->stock_unitario), 'cantidad'=>1, 'gratis'=>0, 'activo'=>$activo);
                     																			
            }
        }else{
        	$insumos_list[] = '{}';
        }

        echo json_encode($insumos_list);
	}

	public function update_stock_insumo(){

        $this->load->model('Medicamentos_model');

        $insumo = $this->input->post('insumo');
        $stock_nuevo     		= $insumo['stock_unitario'];

        	$stock_unitario = $this->Medicamentos_model->update_stock_insumo($insumo['id_insumo'], $stock_nuevo);
       
    }

    public function activar_insumo(){

        $this->load->model('Medicamentos_model');

        $insumo = $this->input->post('insumo');
        //$activo     		= isset($insumo['activo']) ?  $insumo['activo'] : false;

        if($insumo['activo'] == 'true'){
        	$activo = 1;
        }else{
        	$activo = 0;
        }
        
        $stock_unitario = $this->Medicamentos_model->activar_insumo($insumo['id_insumo'], $activo);
       
    }

    
}
