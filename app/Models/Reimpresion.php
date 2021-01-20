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

    public function infoAvaluo($idAvaluo){
        $arrTablas = array('CROQUIS','FEXAVA_DATOSPERSONAS','FEXAVA_FUENTEINFORMACIONLEG','FEXAVA_ESCRITURA','FEXAVA_SUPERFICIE','FEXAVA_TIPOCONSTRUCCION','FEXAVA_ELEMENTOSCONST','FEXAVA_TERRENOMERCADO','FEXAVA_DATOSTERRENOS','FEXAVA_CONSTRUCCIONESMER','FEXAVA_ENFOQUECOSTESCAT','FEXAVA_FOTOAVALUO','FEXAVA_FOTOCOMPARABLE');
        $arrElementosConst = array('FEXAVA_OBRANEGRA','FEXAVA_REVESTIMIENTOACABADO','FEXAVA_CARPINTERIA','FEXAVA_INSTALACIONHIDSAN','FEXAVA_PUERTASYVENTANERIA','FEXAVA_ELEMENTOSEXTRA');
        
        $arrFexava = array();

        $infoFexava = DB::select("SELECT * FROM FEXAVA_AVALUO WHERE IDAVALUO = $idAvaluo");
        $arrInfoFexava = array_map("convierte_a_arreglo",$infoFexava);
        $arrFexava['FEXAVA_AVALUO'] = $arrInfoFexava[0];

        foreach($arrTablas as $tabla){
            switch ($tabla){
                case 'CROQUIS':
                    $infoCroquis = DB::select("SELECT * FROM DOC.DOC_FICHERODOCUMENTO WHERE IDDOCUMENTODIGITAL = $idAvaluo");
                    $arrInfoFuenteInformacion = array_map("convierte_a_arreglo",$infoCroquis); //print_r($arrInfoFuenteInformacion); exit();
                    $arrFexava['CROQUIS'] = $arrInfoFuenteInformacion;
                break;
                case 'FEXAVA_DATOSPERSONAS':
                    $arrInfoAcuse = array();              
                    $infoPropietario = DB::select("SELECT * FROM FEXAVA_DATOSPERSONAS WHERE IDAVALUO = $idAvaluo AND CODTIPOFUNCION = 'P'");
                    $arrInfoPropietario = array_map("convierte_a_arreglo",$infoPropietario);
                    $arrInfoAcuse['propietario'] = $arrInfoPropietario[0];
                    $infoSolicitante = DB::select("SELECT * FROM FEXAVA_DATOSPERSONAS WHERE IDAVALUO = $idAvaluo AND CODTIPOFUNCION = 'S'");
                    $arrInfoSolicitante = array_map("convierte_a_arreglo",$infoSolicitante);
                    $arrInfoAcuse['solicitante'] = $arrInfoSolicitante[0];
                    $arrFexava['FEXAVA_DATOSPERSONAS'] = $arrInfoAcuse;              
                break;

                case 'FEXAVA_FUENTEINFORMACIONLEG':
                    $infoFuenteInformacion = DB::select("SELECT * FROM FEXAVA_FUENTEINFORMACIONLEG WHERE IDAVALUO = $idAvaluo");
                    $arrInfoFuenteInformacion = array_map("convierte_a_arreglo",$infoFuenteInformacion);
                    $arrFexava['FEXAVA_FUENTEINFORMACIONLEG'] = $arrInfoFuenteInformacion[0];
                break;

                case 'FEXAVA_ESCRITURA':
                    $infoEscritura = DB::select("SELECT * FROM FEXAVA_ESCRITURA WHERE IDAVALUO = $idAvaluo");
                    $arrInfoEscritura = array_map("convierte_a_arreglo",$infoEscritura);
                    $arrFexava['FEXAVA_ESCRITURA'] = $arrInfoEscritura[0];
                break;

                case 'FEXAVA_TIPOCONSTRUCCION':
                    $arrFexava['FEXAVA_TIPOCONSTRUCCION'] = array();
                    $infoTiposConstruccion = DB::select("SELECT * FROM FEXAVA_TIPOCONSTRUCCION WHERE IDAVALUO = $idAvaluo");
                    $control = 0;
                    foreach($infoTiposConstruccion as $info){
                        $arrInfoTiposConstruccion = array_map("convierte_a_arreglo",$infoTiposConstruccion);
                        $arrFexava['FEXAVA_TIPOCONSTRUCCION'][$control] = $arrInfoTiposConstruccion[0];
                        $control = $control + 1;
                    }
                    
                break;

                case 'FEXAVA_ELEMENTOSCONST':
                    $arrFexava['FEXAVA_ELEMENTOSCONST'] = array();
                    foreach($arrElementosConst as $tablaElementosConst){
                        if($tablaElementosConst != 'FEXAVA_ELEMENTOSEXTRA'){
                            $infoTabla = DB::select("SELECT * FROM $tablaElementosConst WHERE IDAVALUO = $idAvaluo");
                            $arrTabla = array_map("convierte_a_arreglo",$infoTabla);
                            $arrFexava['FEXAVA_ELEMENTOSCONST'][$tablaElementosConst] = $arrTabla[0];
                        }else{
                            $infoTabla = DB::select("SELECT * FROM $tablaElementosConst WHERE IDAVALUO = $idAvaluo");
                            $arrTabla = array_map("convierte_a_arreglo",$infoTabla);
                            $arrFexava['FEXAVA_ELEMENTOSCONST'][$tablaElementosConst] = $arrTabla;   
                        }
                        
                    }   
                break;

                case 'FEXAVA_TERRENOMERCADO':
                    $infoTerrenoMercado = DB::select("SELECT * FROM FEXAVA_TERRENOMERCADO WHERE IDAVALUO = $idAvaluo");
                    $arrInfoTerrenoMercado = array_map("convierte_a_arreglo",$infoTerrenoMercado);
                    $arrFexava['FEXAVA_TERRENOMERCADO'] = $arrInfoTerrenoMercado[0];
                break;

                case 'FEXAVA_DATOSTERRENOS':
                    $infoDatosTerreno = DB::select("SELECT * FROM FEXAVA_DATOSTERRENOS WHERE IDTERRENOMERCADO = ".$arrFexava['FEXAVA_TERRENOMERCADO']['idterrenomercado']);
                    $arrInfoDatosTerreno = array_map("convierte_a_arreglo",$infoDatosTerreno);
                    $arrFexava['FEXAVA_DATOSTERRENOS'] = $arrInfoDatosTerreno;
                break;

                case 'FEXAVA_CONSTRUCCIONESMER':
                    $infoConstruccionesMer = DB::select("SELECT * FROM FEXAVA_CONSTRUCCIONESMER WHERE IDAVALUO = $idAvaluo");
                    $arrInfoConstruccionesMer = array_map("convierte_a_arreglo",$infoConstruccionesMer);
                    $arrFexava['FEXAVA_CONSTRUCCIONESMER'] = $arrInfoConstruccionesMer;

                    for($i = 0; $i < count($arrFexava['FEXAVA_CONSTRUCCIONESMER']); $i++){
                        $infoInvestProductosComp = DB::select("SELECT * FROM FEXAVA_INVESTPRODUCTOSCOMP WHERE IDCONSTRUCCIONESMERCADO = ".$arrFexava['FEXAVA_CONSTRUCCIONESMER'][$i]['idconstruccionesmercado']);
                        $arrInfoInvestProductosComp = array_map("convierte_a_arreglo",$infoInvestProductosComp);
                        $arrFexava['FEXAVA_CONSTRUCCIONESMER'][$i]['FEXAVA_INVESTPRODUCTOSCOMP'] = $arrInfoInvestProductosComp;
                    }
                break;

                case 'FEXAVA_ENFOQUECOSTESCAT':
                    $infoEnfoqueCost = DB::select("SELECT * FROM FEXAVA_ENFOQUECOSTESCAT WHERE IDAVALUO = $idAvaluo");
                    $arrInfoEnfoqueCost = array_map("convierte_a_arreglo",$infoEnfoqueCost);
                    $arrFexava['FEXAVA_ENFOQUECOSTESCAT'] = $arrInfoEnfoqueCost;                    
                break;

                case 'FEXAVA_FOTOAVALUO':
                    $arrFexava['FEXAVA_FOTOAVALUO'] = array();
                    $infoFotoAvaluo = DB::select("SELECT * FROM FEXAVA_FOTOAVALUO WHERE IDAVALUO = $idAvaluo");
                    $arrInfoFotoAvaluo = array_map("convierte_a_arreglo",$infoFotoAvaluo);
                    foreach($arrInfoFotoAvaluo as $fotoAvaluo){
                        $idDocumentoDigital = $fotoAvaluo['iddocumentofoto'];
                        $infoFotoAvaluoCompleta =  DB::table('DOC.DOC_DOCUMENTOFOTOINMUEBLE')
                        ->join('DOC.DOC_FICHERODOCUMENTO', 'DOC.DOC_DOCUMENTOFOTOINMUEBLE.iddocumentodigital', '=', 'DOC.DOC_FICHERODOCUMENTO.iddocumentodigital')
                        ->where('DOC.DOC_DOCUMENTOFOTOINMUEBLE.iddocumentodigital',$idDocumentoDigital)->first();
                        $arrFexava['FEXAVA_FOTOAVALUO'][] = $infoFotoAvaluoCompleta;
                    }
                    //print_r($arrInfoFotoAvaluo); exit();
                                        
                break;
            }
        }

        return $arrFexava;
    }
    

}