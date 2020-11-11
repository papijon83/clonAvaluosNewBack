<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GuardaenBD
{

    public function insertAvaluo($arrAvaluo){
        echo "AQUIIIIIIIIIIIIIIIIIIIIIII 1"; exit();      
       $arrTablas = array('FEXAVA_DATOSPERSONAS','FEXAVA_FUENTEINFORMACIONLEG','FEXAVA_ESCRITURA','FEXAVA_SUPERFICIE','FEXAVA_TIPOCONSTRUCCION','FEXAVA_ELEMENTOSCONST','FEXAVA_OBRANEGRA','FEXAVA_REVESTIMIENTOACABADO','FEXAVA_CARPINTERIA','FEXAVA_INSTALACIONHIDSAN','FEXAVA_PUERTASYVENTANERIA','FEXAVA_ELEMENTOSEXTRA','FEXAVA_TERRENOMERCADO','FEXAVA_DATOSTERRENOS','FEXAVA_CONSTRUCCIONESMER','FEXAVA_INVESTPRODUCTOSCOMP','FEXAVA_ENFOQUECOSTESCAT','FEXAVA_FOTOAVALUO','FEXAVA_FOTOCOMPARABLE','FEXAVA_INVESTPRODUCTOSCOMP');
       foreach($arrTablas as $tabla){        
        if(in_array($tabla,$arrTablas)){            
            switch ($tabla) {
                case 'FEXAVA_DATOSPERSONAS':
                    print_r($arrAvaluo[0]); exit();
                    foreach($arrAvaluo[$tabla] as $idTabla => $elementosTabla){
                        if($idTabla != 'CuentaCatastral'){
                            $this->insertDatos($tabla,$elementosTabla);
                        }
                    }
                break;    
            }
        }
       }           

    }

    public function insertDatos($tabla,$elementosTabla){
        echo "AQUIIIIIIIIIIIIIIIIIIIIIII"; exit();
        $iniQuery = "INSERT INTO ".$tabla."(";
        $campos = '';
        $valores = '';
        foreach($elementosTabla as $idElemento => $elemento){
            $campos .= $idElemento.",";
            $valores .= "'".$elemento."',";
        }
        $campos = substr($campos,-1);
        $valores = substr($valores,-1);
        $query = $iniQuery.$campos.") VALUES (".$valores.")";
        echo $query."\n";
    }
    
}