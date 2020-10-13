<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BandejaEntradaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function avaluos(Request $request)
    { //echo "<pre>"; print_r($request); exit();
        try {
            $fechaIni = $request->query('fecha_ini');
            $fechaFin = $request->query('fecha_fin');
            $noAvaluo = $request->query('no_avaluo');
            $noUnico = $request->query('no_unico');
            $ctaCatastral = $request->query('cta_catastral');
            $table = DB::table('FEXAVA_AVALUO');

            $avaluos = $table->paginate(15);
            return response()->json($avaluos, 200);
        } catch (\Throwable $th) {
            //Log::info($th);
            error_log($th);
            return response()->json(['mensaje' => 'Error en el servidor'], 500);
        }
    }

    public function isai(Request $request)
    {
        try {
            $fechaIni = $request->query('fecha_ini');
            $fechaFin = $request->query('fecha_fin');
            $noAvaluo = $request->query('no_avaluo');
            $noUnico = $request->query('no_unico');
            $ctaCatastral = $request->query('cta_catastral');

            $table = DB::table('FEXAVA_AVALUO');
            $table->join('FEXAVA_CATESTADOSAVALUO', 'FEXAVA_AVALUO.codestadoavaluo', '=', 'FEXAVA_CATESTADOSAVALUO.codestadoavaluo');


            $table->select(
                DB::raw('TRIM(FEXAVA_AVALUO.numerounico) as numerounico'),
                'FEXAVA_AVALUO.numeroavaluo',
                'FEXAVA_AVALUO.region',
                'FEXAVA_AVALUO.manzana',
                'FEXAVA_AVALUO.lote',
                'FEXAVA_AVALUO.unidadprivativa',
                'FEXAVA_AVALUO.fecha_presentacion',
                'FEXAVA_CATESTADOSAVALUO.descripcion as estadoavaluo',
                DB::raw("CASE
                            WHEN FEXAVA_AVALUO.codtipotramite = '1' 
                                THEN 'COM'
                                ELSE 'CAT'
                        END as tipotramite")
            );

            if ($fechaIni && $fechaFin) {
                $fi = new Carbon($fechaIni);
                $ff = new Carbon($fechaFin);
                $table->whereBetween('fecha_presentacion', [$fi->format('Y-m-d'), $ff->format('Y-m-d')]);
            }

            if ($noAvaluo) {
                $table->where('numeroavaluo', $noAvaluo);
            }

            if ($noUnico) {
                $table->where('numerounico', $noUnico);
            }

            if ($ctaCatastral) {
                $cta = explode('-', $ctaCatastral);
                if (count($cta) === 4) {
                    $table->where('region', $cta[0]);
                    $table->where('manzana', $cta[1]);
                    $table->where('lote', $cta[2]);
                    $table->where('unidadprivativa', $cta[3]);
                } else {
                    return response()->json(['mensaje' => 'Formato de cuenta predial incorrecta'], 400);
                }
            }

            $avaluos = $table->paginate(15);
            return response()->json($avaluos, 200);
        } catch (\Throwable $th) {
            //Log::info($th);
            error_log($th);
            return response()->json(['mensaje' => 'Error en el servidor'], 500);
        }
    }

    public function ModificarEstadoAvaluo(Request $request){
        try{
            //print_r($request); exit();
            $id_avaluo = $request->query('id_avaluo');
            $code_estado_avaluo = $request->query('code_estado_avaluo');

            $procedure = 'BEGIN
            FEXAVA.FEXAVA_AVALUOS_PKG.FEXAVA_UPDATE_AVALUOS_ESTADO_P(
                :PAR_IDAVALUO,
                :PAR_CODESTADOAVALUO
            ); END;';
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare($procedure);
            $stmt->bindParam(':PAR_IDAVALUO', $id_avaluo, \PDO::PARAM_INT);
            $stmt->bindParam(':PAR_CODESTADOAVALUO', $code_estado_avaluo, \PDO::PARAM_INT);            
            $stmt->execute();            
            $stmt->closeCursor();
            $pdo->commit();
            $pdo->close();
            DB::commit();
            DB::reconnect();
            return response()->json(['mensaje' => 'Estado Actualizado'], 200);
        } catch (\Throwable $th) {
            //Log::info($th);
            error_log($th);
            return response()->json(['mensaje' => 'Error en el servidor'], 500);
        }
    }

    public function avaluosProximos(Request $request){
        
            //print_r($request); exit();
            $id_avaluo = $request->query('id_avaluo');
            $id_persona_perito = $request->query('id_persona_perito');
            $page_size = $request->query('page_size');
            $page = $request->query('page');
            $sortexpression = $request->query('sortexpression');

            $procedure = 'BEGIN
            FEXAVA.FEXAVA_AVALUOS_PKG.FEXAVA_SEL_V_PROXIMID_PERITO_P(
                :PAR_ID_AVALUO,
                :PAR_IDPERSONAPERITO,
                :PAGE_SIZE,
                :PAGE,
                :SORTEXPRESSION,
                :C_AVALUOS
            ); END;';
            $conn = oci_connect(env("DB_USERNAME"), env("DB_PASSWORD"), env("DB_TNS"));
            $stmt = oci_parse($conn, $procedure);
            oci_bind_by_name($stmt, ':PAR_ID_AVALUO', $id_avaluo);
            oci_bind_by_name($stmt, ':PAR_IDPERSONAPERITO', $id_persona_perito, 300);
            oci_bind_by_name($stmt, ':PAGE_SIZE', $page_size, 300);
            oci_bind_by_name($stmt, ':PAGE', $page, 300);
            oci_bind_by_name($stmt, ':SORTEXPRESSION', $sortexpression);
            $cursor = oci_new_cursor($conn);
            oci_bind_by_name($stmt, ":C_AVALUOS", $cursor, -1, OCI_B_CURSOR);
            oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
            oci_execute($cursor, OCI_COMMIT_ON_SUCCESS);
            oci_free_statement($stmt);
            oci_close($conn);
            oci_fetch_all($cursor, $avaluos, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($cursor);

            if (count($avaluos) > 0) {
                return $avaluos;
            } else {
                return [];
            }                
    }

    public function buscaNotario(Request $request){
        
        //print_r($request); exit();
        $numero_notario = $request->query('numero_notario') == '' ? null : $request->query('numero_notario');
        $nombre_notario = $request->query('nombre_notario') == '' ? null : $request->query('nombre_notario');
        $ape_paterno = $request->query('ape_paterno') == '' ? null : $request->query('ape_paterno');
        $ape_materno = $request->query('ape_materno') == '' ? null : $request->query('ape_materno');
        $rfc = $request->query('rfc') == '' ? null : $request->query('rfc');
        $curp = $request->query('curp') == '' ? null : $request->query('curp');
        $claveife = $request->query('claveife') == '' ? null : $request->query('claveife');
        $page_size = $request->query('page_size ') == '' ? 1 : $request->query('page_size ');
        $page = $request->query('page') == '' ? 1 : $request->query('page');
        $sortexpression = $request->query('sortexpression') == '' ? 'NUMERO' : $request->query('sortexpression');

        $procedure = 'BEGIN
        FEXAVA.FEXAVA_NOTARIOS_PKG.fexava_select_notariosbuscar_p(
            :PAR_NUMERO,
            :PAR_NOMBRE,
            :PAR_APELLIDOPATERNO,
            :PAR_APELLIDOMATERNO,
            :PAR_RFC,
            :PAR_CURP,
            :PAR_CLAVEIFE,
            :PAGE_SIZE,
            :PAGE,
            :SORTEXPRESSION,
            :C_NOTARIOS
        ); END;';
        $conn = oci_connect(env("DB_USERNAME"), env("DB_PASSWORD"), env("DB_TNS"));
        $stmt = oci_parse($conn, $procedure);
        oci_bind_by_name($stmt, ':PAR_NUMERO', $numero_notario);
        oci_bind_by_name($stmt, ':PAR_NOMBRE', $nombre_notario, 300);
        oci_bind_by_name($stmt, ':PAR_APELLIDOPATERNO', $ape_paterno, 300);
        oci_bind_by_name($stmt, ':PAR_APELLIDOMATERNO', $ape_materno, 300);
        oci_bind_by_name($stmt, ':PAR_RFC', $rfc, 300);
        oci_bind_by_name($stmt, ':PAR_CURP', $curp, 300);
        oci_bind_by_name($stmt, ':PAR_CLAVEIFE', $claveife, 300);
        oci_bind_by_name($stmt, ':PAGE_SIZE', $page_size, 300);
        oci_bind_by_name($stmt, ':PAGE', $page, 300);
        oci_bind_by_name($stmt, ':SORTEXPRESSION', $sortexpression);
        $cursor = oci_new_cursor($conn);
        oci_bind_by_name($stmt, ":C_NOTARIOS", $cursor, -1, OCI_B_CURSOR);
        oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
        oci_execute($cursor, OCI_COMMIT_ON_SUCCESS);
        oci_free_statement($stmt);
        oci_close($conn);
        oci_fetch_all($cursor, $notarios, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
        oci_free_cursor($cursor);

        if (count($notarios) > 0) {
            return $notarios;
        } else {
            return [];
        }                
    }

    public function asignaNotarioAvaluo(Request $request){
        try{
            //print_r($request); exit();
            $id_persona_notario = $request->query('id_persona_notario');
            $id_avaluo = $request->query('id_avaluo');

            $procedure = 'BEGIN
            FEXAVA.FEXAVA_AVALUOS_PKG.fexava_update_ava_notarios_p(
                :PAR_IPNOTARIO,
                :PAR_IDAVALUO
            ); END;';
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare($procedure);
            $stmt->bindParam(':PAR_IPNOTARIO', $id_persona_notario, \PDO::PARAM_INT);
            $stmt->bindParam(':PAR_IDAVALUO', $id_avaluo, \PDO::PARAM_INT);            
            $stmt->execute();            
            $stmt->closeCursor();
            $pdo->commit();
            $pdo->close();
            DB::commit();
            DB::reconnect();
            return response()->json(['mensaje' => 'Notario Actualizado'], 200);
        } catch (\Throwable $th) {
            //Log::info($th);
            error_log($th);
            return response()->json(['mensaje' => 'Error en el servidor'], 500);
        }
    }
    
    function descomprimirCualquierFormato(Request $request){
        //var_dump($request);
        $archivo = $request->file('files');        
        
        if($this->validarTamanioFichero(filesize($archivo)) == FALSE){
            $res = response()->json(['mensaje' => 'El tamaño del fichero es muy grande.'], 500);
            return $res;
        }
        if($archivo){
            $nombreArchivo = $archivo->getClientOriginalName(); // OK WORK!
            $rutaArchivos = getcwd();
        }
        //echo "EL NOMBRE DEL ARCHIVO ".$nombreArchivo; exit();
        $ext = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
        switch ($ext){
            case 'zip':

                $cadenaDes = shell_exec("zipinfo -1 $archivo");
                $numeroNombres = count(explode("\n",trim($cadenaDes)));                
                if($numeroNombres == 1){
                    $arrDes = explode("\n",trim($cadenaDes));                    
                    $nombreDes = trim($arrDes[0]);
                    shell_exec("unzip $archivo -d $rutaArchivos");
                    $res = response()->json(simplexml_load_file($rutaArchivos."/".$nombreDes), 200);
                    shell_exec("rm -f ".$rutaArchivos."/".str_replace(" ","\ ",$nombreDes));
                }else{
                    $res = response()->json(['mensaje' => 'El fichero debe contener un único archivo.'], 500);
                }

                break;
            case 'gz':                
                //echo "SOY EL NOMBE DEL ARCHIVO ".$nombreArchivo; exit();
                $cadenaDes = shell_exec("gunzip -l ".$archivo);
                $arrCadenas = explode("%",trim($cadenaDes));               
                if(count($arrCadenas) < 3){
                    $nombreDes = explode("\n",trim($arrCadenas[1]));                    
                    shell_exec("gunzip $archivo");
                    $res = response()->json(simplexml_load_file($rutaArchivos."/".$nombreDes), 200);
                    shell_exec("rm -f ".$rutaArchivos."/".str_replace(" ","\ ",$nombreDes));
                }else{
                    $res = response()->json(['mensaje' => 'El fichero debe contener un único archivo.'], 500);
                }

                break;
            case 'rar':
                                
                $cadenaDes = shell_exec("unrar lt $archivo");
                $numeroNombres = substr_count($cadenaDes,"Name:");
                if($numeroNombres == 1){
                    $arrDes = explode("\n",$cadenaDes);
                    $arrNombreDes = explode(":",$arrDes[6]);
                    $nombreDes = trim($arrNombreDes[1]);
                    shell_exec("unrar x $archivo $rutaArchivos");
                    $res = response()->json(simplexml_load_file($rutaArchivos."/".$nombreDes), 200);
                    shell_exec("rm -f ".$rutaArchivos."/".str_replace(" ","\ ",$nombreDes));
                }else{
                    $res = response()->json(['mensaje' => 'El fichero debe contener un único archivo.'], 500);
                }                
                break;
        }

        return $res;
    }
    
    function validarTamanioFichero($bytesXmlAvaluo){
        $tamanioMaximo = 4194304;        
        if($tamanioMaximo < $bytesXmlAvaluo){
            return FALSE;
        }else{
            return TRUE;
        }
    }
    
    function esValidoAvaluo($docXml){
        $xml = new DOMDocument();
        $xml->load($docXml);

        if (!$xml->schemaValidate('EsquemaAvaluo.xsd')) {
            print '<b>DOMDocument::schemaValidate() Generated Errors!</b>';
            libxml_display_errors();
        }
    }

}
