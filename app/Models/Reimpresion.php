<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Log;

class Reimpresion
{
    public function infoAcuse($idavaluo){
        $arrInfoAcuse = array();
        $numeroUnico = DB::select("SELECT NUMEROUNICO FROM FEXAVA_AVALUO WHERE IDAVALUO = $idavaluo");
        $arrInfoAcuse['numeroUnico'] = $numeroUnico[0]->numerounico;
        $camposCuentaCatastral = array('region','manzana','lote','unidadprivativa','digitoverificador');
        $infoCuentaCatastral = array();
        foreach($camposCuentaCatastral as $campoBuscar){
            $arrDato = DB::select("SELECT ".$campoBuscar." FROM FEXAVA_AVALUO WHERE IDAVALUO = $idavaluo");            
            //$campoEncontrado = strtolower($campoBuscar);
            $infoCuentaCatastral[$campoBuscar] = $arrDato[0]->$campoBuscar;            
        }
        $arrInfoAcuse['cuentaCatastral'] = $infoCuentaCatastral;
        $cuentaAgua = 'NO SE PROPORCIONO.';
        $arrInfoAcuse['cuentaAgua'] = $cuentaAgua;

        $infoPropietario = DB::select("SELECT * FROM FEXAVA_DATOSPERSONAS WHERE IDAVALUO = $idavaluo AND CODTIPOFUNCION = 'P'");
        $arrInfoPropietario = array_map("convierte_a_arreglo",$infoPropietario);
        $arrInfoAcuse['propietario'] = $arrInfoPropietario[0];
        $infoSolicitante = DB::select("SELECT * FROM FEXAVA_DATOSPERSONAS WHERE IDAVALUO = $idavaluo AND CODTIPOFUNCION = 'S'");
        $arrInfoSolicitante = array_map("convierte_a_arreglo",$infoSolicitante);
        $arrInfoAcuse['solicitante'] = $arrInfoSolicitante[0];

        
        $infoEscritura = DB::select("SELECT * FROM FEXAVA_ESCRITURA WHERE IDAVALUO = $idavaluo");
        $arrInfoEscritura = array_map("convierte_a_arreglo",$infoEscritura);
        $arrInfoAcuse['escritura'] = $arrInfoEscritura[0];

        $infoFuenteInformacion = DB::select("SELECT * FROM FEXAVA_FUENTEINFORMACIONLEG WHERE IDAVALUO = $idavaluo");
        $arrinfoFuenteInformacion = array_map("convierte_a_arreglo",$infoFuenteInformacion);
        $arrInfoAcuse['fuenteInformacionLegal'] = $arrinfoFuenteInformacion[0];
        return $arrInfoAcuse;        
    }
    

}