<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function tipoNivel($nivel) {
    if ($nivel <= 3) {
        return 'Pre Escolar';
    }
    if ($nivel <= 11 and $nivel >= 4) {
        return 'B&aacute;sico';
    } else {
        return 'Medio';
    }
}

function PonerPunto($numero)
{
  if($numero == NULL)
  {
    return 0;
  }
  else
  {
    //Si es float
    if(substr_count($numero, '.') != 0)
    {
      $numero=number_format($numero,2,",",".");
    }
    else
    {
      $numero=number_format($numero,0,",",".");
    }
    return $numero;
  } 
}

//Devuelve 1° Medio == 1, 4° Medio == 12
function nivelCurso($nivel) {
    if ($nivel == 1) {
        return ' Play Group';
    }
    if ($nivel == 2) {
        return ' Pre kinder';
    }
    if ($nivel == 3) {
        return ' Kinder';
    }
    if ($nivel <= 11 and $nivel >= 4) {
        $nivel = $nivel - 3;
        return $nivel . '&deg; B&aacute;sico';
    } else if ($nivel == 12) {
        return '1&deg; Medio';
    } else if ($nivel == 13) {
        return '2&deg; Medio';
    } else if ($nivel == 14) {
        return '3&deg; Medio';
    } else if ($nivel == 15) {
        return '4&deg; Medio';
    } else {
        return NULL;
    }
}

function mesUnix($mes) {
    if ($mes == 01) {
        return 1483228800;
    }
    if ($mes == 02) {
        return 1485907200;
    }
    if ($mes == 03) {
        return 1488326400;
    }
    if ($mes == 04) {
        return 1491004800;
    }
    if ($mes == 05) {
        return 1493596800;
    }
    if ($mes == 06) {
        return 1496275200;
    }
    if ($mes == 07) {
        return 1498867200;
    }
    if ($mes == 08) {
        return 1501545600;
    }
    if ($mes == 09) {
        return 1504224000;
    }

}



function get_tipo_usuario($tipo_usuario){
	if($tipo_usuario == 2){
		return 'Alumno';
	}
	elseif($tipo_usuario == 4){
		return 'Profesor';
	}
	elseif($tipo_usuario == 10){
		return 'Coordinador';
	}
}

function elimina_acentos($string){
    $a = 'ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ'; 
    $b = 'AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn'; 
    $string = utf8_decode($string);     
    $string = strtr($string, utf8_decode($a), $b); 
    return utf8_encode($string); 
}

//Funcion que genera un random string simple para contraseñas
function randomStringCorto(){

   $size = 3;
   $chars = "12345789";
   $string = "";
   $length = strlen( $chars );

   for($i = 0; $i < $size; $i++){
       $string .= $chars{ rand( 0, $length-1 ) };
   }

   return $string;
} 
function randomStringLargo(){

   $size = 15;
   $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789";
   $string = "";
   $length = strlen( $chars );

   for($i = 0; $i < $size; $i++){
       $string .= $chars{ rand( 0, $length-1 ) };
   }

   return $string;
}  

function randomStringEntera() {

	$CI = get_instance();
	$CI->load->model('Codigos_model');

    $k = 0;
    while ($k == 0) {
        $array = array();
        for ($i = 0; $i < 20; $i++) {
            $string = (string)NULL;
            $length = ceil(rand(50, 60) / 10);
            $string = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789"), 0, $length);
            $array[$i] = $string;
        }

       	$si_existen = count($CI->Codigos_model->get_si_existen_codigos($array));

        if ($si_existen == 0) {
            if (strlen($string) > 4) {
                $k = 1;
            }
        }
    }
    return $array;
}

    //CONVIERTE UN MES EN NÚMERO A PALABRA
function MesPalabra($mes){
  
  switch($mes){
    
    case 1:
      return "enero";
      break;
    
    case 2:
      return "febrero";
      break;
    
    case 3:
      return "marzo";
      break;
    
    case 4:
      return "abril";
      break;
    
    case 5:
      return "mayo";
      break;
    
    case 6:
      return "junio";
      break;
    
    case 7:
      return "julio";
      break;
    
    case 8:
      return "agosto";
      break;
    
    case 9:
      return "septiembre";
      break;
    
    case 10:
      return "octubre";
      break;
    
    case 11:
      return "noviembre";
      break;
    
    case 12:
      return "diciembre";
      break;
  }
}

function randomStringResto() {

	$CI = get_instance();
	$CI->load->model('Codigos_model');

    $k = 0;
    while ($k == 0) {
        $string = (string)NULL;
        $length = ceil(rand(50, 60) / 10);
        $string = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789"), 0, $length);
        $array[0] = $string;

       	$si_existen = count($CI->Codigos_model->get_si_existen_codigos($array));
        
        if($si_existen == 0) {
            if (strlen($string) > 4) {
                $k = 1;
            }
        }
    }
    return $array;
}