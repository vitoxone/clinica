<?php if (!defined('BASEPATH')) exit('No direct script access allowed');  

class Export_excel{

    function to_excel($array, $filename, $startDate, $endDate) {
        header('Content-Disposition: attachment; filename='.$filename.'.xls');
        header('Content-type: application/force-download');
        header('Content-Transfer-Encoding: binary');
        header('Pragma: public');
        print "\xEF\xBB\xBF"; // UTF-8 BOM
        $h = array();
        foreach($array as $row){
            foreach($row as $key=>$val){
                if(!in_array($key, $h)){
                    $h[] = $key;   
                }
            }
        }

        echo '<table>
        <tr><th colspan="3">Datos desde '.$startDate.' hasta '.$endDate.'</th></tr>
        <tr>';
        foreach($h as $key) {
            $key = ucwords($key);
            echo '<th style="border:1px #888 solid;background-color:black;color:white;">'.$key.'</th>';
        }
        echo '</tr>';

        foreach($array as $row){
            echo '<tr>';
            foreach($row as $val)
                $this->writeRow(str_replace('.', ',', $val));   
        }
        echo '</tr>';
        echo '</table>';

    }

    function writeRow($val) {
        echo '<td style="border:1px #888 solid;color:#555;">'.$val.'</td>';              
    }

}
?>