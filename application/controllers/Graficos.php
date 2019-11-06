<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Graficos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Export_excel');
        $this->load->model('Graficos_model');
        if (!$this->session->userdata('id_usuario'))
        {
          redirect(base_url());
        }
        
    }

    /* Instituciones de salud */
    public function instituciones_de_salud($opcion = 0,$startDate = null,$endDate = null){
        date_default_timezone_set('America/Lima');
        $fecha = date("d")."-".date("m")."-".(date("Y") - 1);
        $fecha1 = date("d")."-".date("m")."-".date("Y");
        $startDate = ($startDate == null) ? $fecha : $startDate;
        $endDate = ($endDate == null) ? $fecha1 : $endDate;
        $startDate1 = date_format(date_create($startDate), 'Y-m-d');
        $endDate1 = date_format(date_create($endDate), 'Y-m-d');

        switch ($opcion) {
            case 0:{
                $graficos = $this->Graficos_model->porcentaje_utiliza_convatect($startDate1,$endDate1);
                $datos['titulo'] = 'Porcentaje de cada institución utiliza Convatec';
                break;
            }
            case 1:{
                $graficos = $this->Graficos_model->porcentaje_recomienda_convatect($startDate1,$endDate1);
                $datos['titulo'] = 'Porcentaje de cada institución recomienda Convatec';
                break;
            }
            case 2:{
                $graficos = $this->Graficos_model->porcentaje_dispositivos_medicos($startDate1,$endDate1);
                $datos['titulo'] = 'Porcentaje de cada institución cambio sus dispositivos médicos';
                break;
            }
            case 3:{
                $graficos = $this->Graficos_model->porcentaje_utiliza_complementos($startDate1,$endDate1);
                $datos['titulo'] = 'Porcentaje de cada institución utiliza complementos';
                break;
            }
            case 4:{
                $graficos = $this->Graficos_model->porcentaje_recomienda_contigo($startDate1,$endDate1);
                $datos['titulo'] = 'Porcentaje de cada institución recomienda el Programa ConTigo Me más';
                break;
            }
            case 5:{
                $graficos = $this->Graficos_model->porcentaje_activo_programa($startDate1,$endDate1);
                $datos['titulo'] = 'Porcentaje de cada institución está activo en el programa';
                break;
            }
            case 6:{
                $graficos = $this->Graficos_model->porcentaje_cierre_quirurgico($startDate1,$endDate1);
                $datos['titulo'] = 'Porcentaje de cada institución tienen cierre quirúrgico pendiente';
                break;
            }
            case 7:{
                $graficos = $this->Graficos_model->porcentaje_complicaciones_dispositivo($startDate1,$endDate1);
                $datos['titulo'] = 'Porcentaje de cada institución ha tenido complicaciones por el dispositivo médico que le entregan en una institución de salud';
                break;
            }
            default:{
                $graficos = $this->Graficos_model->porcentaje_utiliza_convatect($startDate1,$endDate1);
                $datos['titulo'] = 'Porcentaje de cada institución utiliza Convatec';
                $opcion = 0;
                break;
            }
        }
        $datos['startDate'] = $startDate;
        $datos['endDate'] = $endDate;
        $datos['posicion'] = $opcion;
        $datos['datos'] = $graficos;
        $datos['tituloX'] = 'Instituciones';
        $datos['tituloY'] = 'Porcentaje';
        $datos['active_view'] = 'graficos';
        
        $this->load->view('header.php');
        $this->load->view('navigation_admin.php', $datos);
        $this->load->view('graficos/instituciones_de_salud.php');
        $this->load->view('footer.php');
    }

    public function exportar_instituciones_de_salud($opcion = 0,$startDate = null,$endDate = null){
        date_default_timezone_set('America/Lima');
        $fecha = date("d")."-".date("m")."-".(date("Y") - 1);
        $fecha1 = date("d")."-".date("m")."-".date("Y");
        $startDate = ($startDate == null) ? $fecha : $startDate;
        $endDate = ($endDate == null) ? $fecha1 : $endDate;
        $startDate1 = date_format(date_create($startDate), 'Y-m-d');
        $endDate1 = date_format(date_create($endDate), 'Y-m-d');

        switch ($opcion) {
            case 0:{
                $graficos = $this->Graficos_model->porcentaje_utiliza_convatect($startDate1,$endDate1);
                break;
            }
            case 1:{
                $graficos = $this->Graficos_model->porcentaje_recomienda_convatect($startDate1,$endDate1);
                break;
            }
            case 2:{
                $graficos = $this->Graficos_model->porcentaje_dispositivos_medicos($startDate1,$endDate1);
                break;
            }
            case 3:{
                $graficos = $this->Graficos_model->porcentaje_utiliza_complementos($startDate1,$endDate1);
                break;
            }
            case 4:{
                $graficos = $this->Graficos_model->porcentaje_recomienda_contigo($startDate1,$endDate1);
                break;
            }
            case 5:{
                $graficos = $this->Graficos_model->porcentaje_activo_programa($startDate1,$endDate1);
                break;
            }
            case 6:{
                $graficos = $this->Graficos_model->porcentaje_cierre_quirurgico($startDate1,$endDate1);
                break;
            }
            case 7:{
                $graficos = $this->Graficos_model->porcentaje_complicaciones_dispositivo($startDate1,$endDate1);
                break;
            }
            default:{
                $graficos = $this->Graficos_model->porcentaje_utiliza_convatect($startDate1,$endDate1);
                break;
            }
        }

        $this->export_excel->to_excel($graficos,'Estadistica',$startDate,$endDate);
    }

    /* Pacientes atendidos */
    public function pacientes_atendidos($opcion = 0,$startDate = null,$endDate = null){
        date_default_timezone_set('America/Lima');
        $fecha = date("d")."-".date("m")."-".(date("Y") - 1);
        $fecha1 = date("d")."-".date("m")."-".date("Y");
        $startDate = ($startDate == null) ? $fecha : $startDate;
        $endDate = ($endDate == null) ? $fecha1 : $endDate;
        $startDate1 = date_format(date_create($startDate), 'Y-m-d');
        $endDate1 = date_format(date_create($endDate), 'Y-m-d');

        switch ($opcion) {

            case 0:{
                $graficos = false;
                $datos['titulo'] = 'Sábana de pacientes totales (Sólamente descargable Excel)';
                $datos['tituloX'] = 'Pacientes activos';
                $datos['tituloY'] = 'Pacientes inactivos';
                break;
            }
            case 1:{
                $graficos = false;
                $datos['titulo'] = 'Sábana de ostomías totales (Sólamente descargable Excel)';
                $datos['tituloX'] = 'Pacientes activos';
                $datos['tituloY'] = 'Pacientes inactivos';
                break;
            }
            case 2:{
                $graficos = $this->Graficos_model->porcentaje_pacientes_contigo($startDate1,$endDate1);
                $datos['titulo'] = 'Porcentaje del total están activos en el Programa ConTigo Me';
                $datos['tituloX'] = 'Pacientes activos';
                $datos['tituloY'] = 'Pacientes inactivos';
                break;
            }
            case 3:{
                $graficos = $this->Graficos_model->porcentaje_pacientes_instituciones_convatec($startDate1,$endDate1);
                $datos['titulo'] = 'Porcentaje se atiende en las diferentes instituciones utiliza Convatec';
                $datos['tituloX'] = 'Pacientes que se atienden';
                $datos['tituloY'] = 'Pacientes que no se atienden';
                break;
            }
            case 4:{
                $graficos = $this->Graficos_model->porcentaje_pacientes_utiliza_convatec($startDate1,$endDate1);
                $datos['titulo'] = 'Porcentaje utiliza Convatec';
                $datos['tituloX'] = 'Pacientes que utilizan';
                $datos['tituloY'] = 'Pacientes que no utilizan';
                break;
            }
            case 5:{
                $graficos = $this->Graficos_model->porcentaje_pacientes_recomienda_convatect($startDate1,$endDate1);
                $datos['titulo'] = 'Porcentaje recomienda Convatec';
                $datos['tituloX'] = 'Pacientes que recomiendan';
                $datos['tituloY'] = 'Pacientes que no recomiendan';
                break;
            }
            case 6:{
                $graficos = $this->Graficos_model->porcentaje_pacientes_complicaciones($startDate1,$endDate1);
                $datos['titulo'] = 'Porcentaje ha tenido complicaciones con su dispositivo medico';
                $datos['tituloX'] = 'Pacientes con complicaciones';
                $datos['tituloY'] = 'Pacientes sin complicaciones';
                break;
            }
            case 7:{
                $graficos = $this->Graficos_model->porcentaje_pacientes_dispositivo($startDate1,$endDate1);
                $datos['titulo'] = 'Porcentaje ha cambiado su dispositivo médico';
                $datos['tituloX'] = 'Pacientes que han cambiado';
                $datos['tituloY'] = 'Pacientes que no han cambiado';
                break;
            }
            case 8:{
                $graficos = $this->Graficos_model->porcentaje_pacientes_recomienda_contigo($startDate1,$endDate1);
                $datos['titulo'] = 'Porcentaje recomienda el Programa ConTigo Me';
                $datos['tituloX'] = 'Pacientes que recomiendan';
                $datos['tituloY'] = 'Pacientes que no recomiendan';
                break;
            }
            case 9:{
                $graficos = false;
                $datos['titulo'] = 'Sábana de atenciones totales (Sólamente descargable Excel)';
                $datos['tituloX'] = 'Atenciones';
                $datos['tituloY'] = 'Atenciones';
                break;
            }
            default:{
                $graficos = $this->Graficos_model->porcentaje_pacientes_contigo($startDate1,$endDate1);
                $datos['titulo'] = 'Porcentaje del total están activos en el Programa ConTigo Me';
                $opcion = 0;
                $datos['tituloX'] = 'Pacientes activos';
                $datos['tituloY'] = 'Pacientes inactivos';
                break;
            }
        }
        $datos['startDate'] = $startDate;
        $datos['endDate'] = $endDate;
        $datos['posicion'] = $opcion;
        $datos['datos'] = $graficos;
        $datos['active_view'] = 'graficos';
        
        $this->load->view('header.php');
        $this->load->view('navigation_admin.php', $datos);
        $this->load->view('graficos/pacientes_atendidos.php');
        $this->load->view('footer.php');
    }

    public function exportar_pacientes_atendidos($opcion = 0,$startDate = null,$endDate = null){
        date_default_timezone_set('America/Lima');
        $fecha = date("d")."-".date("m")."-".(date("Y") - 1);
        $fecha1 = date("d")."-".date("m")."-".date("Y");
        $startDate = ($startDate == null) ? $fecha : $startDate;
        $endDate = ($endDate == null) ? $fecha1 : $endDate;
        $startDate1 = date_format(date_create($startDate), 'Y-m-d');
        $endDate1 = date_format(date_create($endDate), 'Y-m-d');

        switch ($opcion) {
            case 0:{
                $graficos = $this->Graficos_model->get_sabana_pacientes($startDate1,$endDate1);
                break;
            }
            case 1:{
                $graficos = $this->Graficos_model->get_sabana_ostomias($startDate1,$endDate1);
                break;
            }
            case 2:{
                $graficos = $this->Graficos_model->porcentaje_pacientes_contigo($startDate1,$endDate1);
                break;
            }
            case 3:{
                $graficos = $this->Graficos_model->porcentaje_pacientes_instituciones_convatec($startDate1,$endDate1);
                break;
            }
            case 4:{
                $graficos = $this->Graficos_model->porcentaje_pacientes_utiliza_convatec($startDate1,$endDate1);
                break;
            }
            case 5:{
                $graficos = $this->Graficos_model->porcentaje_pacientes_recomienda_convatect($startDate1,$endDate1);
                break;
            }
            case 6:{
                $graficos = $this->Graficos_model->porcentaje_pacientes_complicaciones($startDate1,$endDate1);
                break;
            }
            case 7:{
                $graficos = $this->Graficos_model->porcentaje_pacientes_dispositivo($startDate1,$endDate1);
                break;
            }
            case 8:{
                $graficos = $this->Graficos_model->porcentaje_pacientes_recomienda_contigo($startDate1,$endDate1);
                break;
            }
            case 9:{
                $graficos = $this->Graficos_model->get_sabana_atenciones($startDate1,$endDate1);
                break;
            }
            default:{
                $graficos = $this->Graficos_model->porcentaje_pacientes_contigo($startDate1,$endDate1);
                break;
            }
        }

        $this->export_excel->to_excel($graficos,'Estadistica',$startDate,$endDate);
    }

    /* Indicadores de calidad de vida */
    public function indicadores_de_calidad($opcion = 0,$startDate = null,$endDate = null){
        date_default_timezone_set('America/Lima');
        $fecha = date("d")."-".date("m")."-".(date("Y") - 1);
        $fecha1 = date("d")."-".date("m")."-".date("Y");
        $startDate = ($startDate == null) ? $fecha : $startDate;
        $endDate = ($endDate == null) ? $fecha1 : $endDate;
        $startDate1 = date_format(date_create($startDate), 'Y-m-d');
        $endDate1 = date_format(date_create($endDate), 'Y-m-d');

        switch ($opcion) {
            case 0:{
                $graficos = $this->Graficos_model->porcentaje_pacientes_retomaron_actividad($startDate1,$endDate1);
                $datos['titulo'] = 'Porcentaje de pacientes que retomaron su actividad laboral antes de la ostomía en un tiempo de 3 meses';
                $datos['tituloX'] = 'Pacientes que retomaron';
                $datos['tituloY'] = 'Pacientes que no retomaron';
                break;
            }
            case 1:{
                $graficos = $this->Graficos_model->porcentaje_pacientes_adherencia_autocuidado($startDate1,$endDate1);
                $datos['titulo'] = 'Porcentaje de pacientes con adherencia al autocuidado de su ostomía';
                $datos['tituloX'] = 'Pacientes con adherencia';
                $datos['tituloY'] = 'Pacientes sin adherencia';
                break;
            }
            default:{
                $graficos = $this->Graficos_model->porcentaje_pacientes_retomaron_actividad($startDate1,$endDate1);
                $datos['titulo'] = 'Porcentaje de pacientes que retomaron su actividad laboral antes de la ostomía en un tiempo de 3 meses';
                $opcion = 0;
                $datos['tituloX'] = 'Pacientes que retomaron';
                $datos['tituloY'] = 'Pacientes que no retomaron';
                break;
            }
        }
        $datos['startDate'] = $startDate;
        $datos['endDate'] = $endDate;
        $datos['posicion'] = $opcion;
        $datos['datos'] = $graficos;
        $datos['active_view'] = 'graficos';
        
        $this->load->view('header.php');
        $this->load->view('navigation_admin.php', $datos);
        $this->load->view('graficos/indicadores_de_calidad.php');
        $this->load->view('footer.php');
    }

    public function exportar_indicadores_de_calidad($opcion = 0,$startDate = null,$endDate = null){
        date_default_timezone_set('America/Lima');
        $fecha = date("d")."-".date("m")."-".(date("Y") - 1);
        $fecha1 = date("d")."-".date("m")."-".date("Y");
        $startDate = ($startDate == null) ? $fecha : $startDate;
        $endDate = ($endDate == null) ? $fecha1 : $endDate;
        $startDate1 = date_format(date_create($startDate), 'Y-m-d');
        $endDate1 = date_format(date_create($endDate), 'Y-m-d');
        
        switch ($opcion) {
            case 0:{
                $graficos = $this->Graficos_model->porcentaje_pacientes_retomaron_actividad($startDate1,$endDate1);
                break;
            }
            case 1:{
                $graficos = $this->Graficos_model->porcentaje_pacientes_adherencia_autocuidado($startDate1,$endDate1);
                break;
            }
            default:{
                $graficos = $this->Graficos_model->porcentaje_pacientes_retomaron_actividad($startDate1,$endDate1);
                break;
            }
        }

        $this->export_excel->to_excel($graficos,'Estadistica',$startDate,$endDate);
    }

    /* Impacto economico */
    public function impacto_economico($opcion = 0,$startDate = null,$endDate = null){
        date_default_timezone_set('America/Lima');
        $fecha = date("d")."-".date("m")."-".(date("Y") - 1);
        $fecha1 = date("d")."-".date("m")."-".date("Y");
        $startDate = ($startDate == null) ? $fecha : $startDate;
        $endDate = ($endDate == null) ? $fecha1 : $endDate;
        $startDate1 = date_format(date_create($startDate), 'Y-m-d');
        $endDate1 = date_format(date_create($endDate), 'Y-m-d');

        switch ($opcion) {
            case 0:{
                $graficos = $this->Graficos_model->numero_pacientes_activos_contigo($startDate1,$endDate1);
                $datos['titulo'] = 'Número de pacientes activos en el programa Contigo';
                $datos['tituloX'] = 'Pacientes activos';
                $datos['tituloY'] = 'Pacientes inactivos';
                break;
            }
            case 1:{
                $graficos = $this->Graficos_model->numero_pacientes_ostomia_temporal($startDate1,$endDate1);
                $datos['titulo'] = 'Número de pacientes con ostomia temporal pendientes por cierre quirúrgico';
                $datos['tituloX'] = 'Pacientes con ostomia';
                $datos['tituloY'] = 'Pacientes sin ostomia';
                break;
            }
            case 2:{
                $graficos = $this->Graficos_model->numero_pacientes_ostomia($startDate1,$endDate1);
                $datos['titulo'] = 'Número de pacientes con ostomia definitiva';
                $datos['tituloX'] = 'Pacientes con ostomia';
                $datos['tituloY'] = 'Pacientes sin ostomia';
                break;
            }
            case 3:{
                $graficos = $this->Graficos_model->numero_pacientes_correccion_receta($startDate1,$endDate1);
                $datos['titulo'] = 'Número de pacientes con corrección en la receta de dispositivos para ostomía';
                $datos['tituloX'] = 'Pacientes con corrección';
                $datos['tituloY'] = 'Pacientes sin corrección';
                break;
            }
            case 4:{
                $graficos = $this->Graficos_model->numero_pacientes_complicaciones_estomales($startDate1,$endDate1);
                $datos['titulo'] = 'Número de complicaciones estomales evitadas';
                $datos['tituloX'] = 'Pacientes con complicaciones';
                $datos['tituloY'] = 'Pacientes sin complicaciones';
                break;
            }
            default:{
                $graficos = $this->Graficos_model->numero_pacientes_activos_contigo($startDate1,$endDate1);
                $datos['titulo'] = 'Número de pacientes activos en el programa Contigo';
                $opcion = 0;
                $datos['tituloX'] = 'Pacientes activos';
                $datos['tituloY'] = 'Pacientes inactivos';
                break;
              }
        }
        $datos['startDate'] = $startDate;
        $datos['endDate'] = $endDate;
        $datos['posicion'] = $opcion;
        $datos['datos'] = $graficos;
        $datos['active_view'] = 'graficos';
        
        $this->load->view('header.php');
        $this->load->view('navigation_admin.php', $datos);
        $this->load->view('graficos/impacto_economico.php');
        $this->load->view('footer.php');
    }

    public function exportar_impacto_economico($opcion = 0,$startDate = null,$endDate = null){
        date_default_timezone_set('America/Lima');
        $fecha = date("d")."-".date("m")."-".(date("Y") - 1);
        $fecha1 = date("d")."-".date("m")."-".date("Y");
        $startDate = ($startDate == null) ? $fecha : $startDate;
        $endDate = ($endDate == null) ? $fecha1 : $endDate;
        $startDate1 = date_format(date_create($startDate), 'Y-m-d');
        $endDate1 = date_format(date_create($endDate), 'Y-m-d');

        switch ($opcion) {
            case 0:{
                $graficos = $this->Graficos_model->numero_pacientes_activos_contigo($startDate1,$endDate1);
                break;
            }
            case 1:{
                $graficos = $this->Graficos_model->numero_pacientes_ostomia_temporal($startDate1,$endDate1);
                break;
            }
            case 2:{
                $graficos = $this->Graficos_model->numero_pacientes_ostomia($startDate1,$endDate1);
                break;
            }
            case 3:{
                $graficos = $this->Graficos_model->numero_pacientes_correccion_receta($startDate1,$endDate1);
                break;
            }
            case 4:{
                $graficos = $this->Graficos_model->numero_pacientes_complicaciones_estomales($startDate1,$endDate1);
                break;
            }
            default:{
                $graficos = $this->Graficos_model->numero_pacientes_activos_contigo($startDate1,$endDate1);
                break;
            }
        }

        $this->export_excel->to_excel($graficos,'Estadistica',$startDate,$endDate);
    }

    /* Indicadores de impacto del programa */
    public function indicadores_impacto($opcion = 0,$startDate = null,$endDate = null,$op1 = null,$op2 = null){
        date_default_timezone_set('America/Lima');
        $fecha = date("d")."-".date("m")."-".(date("Y") - 1);
        $fecha1 = date("d")."-".date("m")."-".date("Y");
        $startDate = ($startDate == null) ? $fecha : $startDate;
        $endDate = ($endDate == null) ? $fecha1 : $endDate;
        $startDate1 = date_format(date_create($startDate), 'Y-m-d');
        $endDate1 = date_format(date_create($endDate), 'Y-m-d');
        $op1 = ($op1 != null) ? $op1 : "1";
        $op2 = ($op2 != null) ? $op2 : "1";
        $datos['pregunta12'] = $op1;
        $datos['pregunta13'] = $op2;

        switch ($opcion) {
            case 0:{
                $graficos = $this->Graficos_model->clasificacion_tipos_ostomias($startDate1,$endDate1);
                $datos['titulo'] = 'Clasificación por tipos de ostomías';
                $datos['tituloX'] = 'Porcentaje';
                $datos['tituloY'] = 'Tipo de Ostomía';
                $datos['tipo_grafico'] = 'barras';
                break;
            }
            case 1:{
                $graficos = $this->Graficos_model->clasificacion_etiologia($startDate1,$endDate1);
                $datos['titulo'] = 'Clasificación por etiología';
                $datos['tituloX'] = 'Porcentaje';
                $datos['tituloY'] = 'Categoría';
                $datos['tipo_grafico'] = 'barras';
                break;
            }
            case 2:{
                $graficos = $this->Graficos_model->numero_pacientes_ostomia_tipos($startDate1,$endDate1);
                $datos['titulo'] = 'Número de pacientes con ostomias temporales y definitivas';
                $datos['tituloX'] = 'Pacientes con ostomias temporales';
                $datos['tituloY'] = 'Pacientes sin ostomias definitivas';
                $datos['tipo_grafico'] = 'pastel';
                break;
            }
            case 3:{
                $graficos = $this->Graficos_model->recomendacion_productos_convatec($startDate1,$endDate1,$op1,$op2);
                $datos['titulo'] = 'Recomendación de productos convatec';
                $datos['tituloX'] = 'Opinión de Pacientes';
                $datos['tituloY'] = 'Otros';
                $datos['tipo_grafico'] = 'pastel';
                break;
            }
            default:{
                $opcion = 0;
                $graficos = $this->Graficos_model->clasificacion_tipos_ostomias($startDate1,$endDate1);
                $datos['titulo'] = 'Clasificación por tipos de ostomías';
                $datos['tituloX'] = 'Porcentaje';
                $datos['tituloY'] = 'Tipo de Ostomía';
                $datos['tipo_grafico'] = 'barras';
                break;
              }
        }
        $datos['startDate'] = $startDate;
        $datos['endDate'] = $endDate;
        $datos['posicion'] = $opcion;
        $datos['datos'] = $graficos;
        $datos['active_view'] = 'graficos';
        
        $this->load->view('header.php');
        $this->load->view('navigation_admin.php', $datos);
        $this->load->view('graficos/indicadores_impacto.php');
        $this->load->view('footer.php');
    }

    public function exportar_indicadores_impacto($opcion = 0,$startDate = null,$endDate = null,$op1 = null,$op2 = null){
        date_default_timezone_set('America/Lima');
        $fecha = date("d")."-".date("m")."-".(date("Y") - 1);
        $fecha1 = date("d")."-".date("m")."-".date("Y");
        $startDate = ($startDate == null) ? $fecha : $startDate;
        $endDate = ($endDate == null) ? $fecha1 : $endDate;
        $startDate1 = date_format(date_create($startDate), 'Y-m-d');
        $endDate1 = date_format(date_create($endDate), 'Y-m-d');
        $op1 = ($op1 != null) ? $op1 : "1";
        $op2 = ($op2 != null) ? $op2 : "1";
        $datos['pregunta12'] = $op1;
        $datos['pregunta13'] = $op2;

        switch ($opcion) {
            case 0:{
                $graficos = $this->Graficos_model->clasificacion_tipos_ostomias($startDate1,$endDate1);
                break;
            }
            case 1:{
                $graficos = $this->Graficos_model->clasificacion_etiologia($startDate1,$endDate1);
                break;
            }
            case 2:{
                $graficos = $this->Graficos_model->numero_pacientes_ostomia_tipos($startDate1,$endDate1);
                break;
            }
            case 3:{
                $graficos = $this->Graficos_model->recomendacion_productos_convatec($startDate1,$endDate1,$op1,$op2);
                break;
            }
            default:{
                $graficos = $this->Graficos_model->clasificacion_tipos_ostomias($startDate1,$endDate1);
                break;
            }
        }

        $this->export_excel->to_excel($graficos,'Estadistica',$startDate,$endDate);
    }

}
