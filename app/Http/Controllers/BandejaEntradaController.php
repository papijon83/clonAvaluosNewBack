<?php

namespace App\Http\Controllers;

use App\Models\PeritoSociedad;
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
    protected $modelPeritoSociedad;
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
            $codEstado = $request->query('estado');
            $ctaCatastral = $request->query('cta_catastral');
            $table = DB::table('FEXAVA_AVALUO');
            $table->join('FEXAVA_CATESTADOSAVALUO', 'FEXAVA_AVALUO.codestadoavaluo', '=', 'FEXAVA_CATESTADOSAVALUO.codestadoavaluo');
            $table->join('RCON.RCON_PERITO', 'FEXAVA_AVALUO.idpersonaperito', '=', 'RCON.RCON_PERITO.idpersona');
            //$table->join('RCON.RCON_SOCIEDADVALUACION', 'FEXAVA_AVALUO.idpersonasociedad', '=', 'RCON.RCON_SOCIEDADVALUACION.idpersona');
            //$table->join('RCON.RCON_NOTARIO', 'FEXAVA_AVALUO.idpersonanotario', '=', 'RCON.RCON_NOTARIO.idpersona');
            $table->select(
                DB::raw('TRIM(FEXAVA_AVALUO.numerounico) as numerounico'),
                'FEXAVA_AVALUO.region',
                'FEXAVA_AVALUO.manzana',
                'FEXAVA_AVALUO.lote',
                'FEXAVA_AVALUO.unidadprivativa',
                'FEXAVA_AVALUO.fecha_presentacion',
                'FEXAVA_CATESTADOSAVALUO.descripcion as estadoavaluo',
                'RCON.RCON_PERITO.registro as perito',
                //'RCON.RCON_SOCIEDADVALUACION.registro as sociedad',
                //'RCON.RCON_NOTARIO.NUMNOTARIO as notario',
                DB::raw("CASE
                            WHEN FEXAVA_AVALUO.codtipotramite = '1' 
                                THEN 'COM'
                                ELSE 'CAT'
                        END as tipotramite")
            );

            if ($fechaIni && $fechaFin) {
                $fi = new Carbon($fechaIni);
                $ff = new Carbon($fechaFin);
                $table->whereBetween('FEXAVA_AVALUO.fecha_presentacion', [$fi->format('Y-m-d'), $ff->format('Y-m-d')]);
            }

            if ($noAvaluo) {
                $table->where('FEXAVA_AVALUO.numeroavaluo', $noAvaluo);
            }

            if ($noUnico) {
                $table->where(DB::raw('TRIM(FEXAVA_AVALUO.numerounico)'), $noUnico);
            }

            if ($codEstado) {
                $table->where('FEXAVA_AVALUO.codestadoavaluo', $codEstado);
            }

            if ($ctaCatastral) {
                $cta = explode('-', $ctaCatastral);
                if (count($cta) === 4) {
                    $table->where('FEXAVA_AVALUO.region', $cta[0]);
                    $table->where('FEXAVA_AVALUO.manzana', $cta[1]);
                    $table->where('FEXAVA_AVALUO.lote', $cta[2]);
                    $table->where('FEXAVA_AVALUO.unidadprivativa', $cta[3]);
                } else {
                    return response()->json(['mensaje' => 'Formato de cuenta predial incorrecta'], 400);
                }
            }
            $table->orderBy('FEXAVA_AVALUO.fecha_presentacion' , 'desc');
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

    public function ModificarEstadoAvaluo(Request $request)
    {
        try {
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

    public function avaluosProximos(Request $request)
    {

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

    public function buscaNotario(Request $request)
    {

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

    public function asignaNotarioAvaluo(Request $request)
    {
        try {
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
    
    function descomprimirCualquierFormato($archivo){
        //var_dump($request);
        //$archivo = $request->file('files');        
        
        if($this->validarTamanioFichero(filesize($archivo)) == FALSE){
            $res = response()->json(['mensaje' => 'El tamaño del fichero es muy grande.'], 500);
            return $res;
        }
        if ($archivo) {
            $nombreArchivo = $archivo->getClientOriginalName(); // OK WORK!
            $rutaArchivos = getcwd();
        }
        //echo "EL NOMBRE DEL ARCHIVO ".$nombreArchivo; exit();
        $ext = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
        switch ($ext) {
            case 'zip':

                $cadenaDes = shell_exec("zipinfo -1 $archivo");
                $numeroNombres = count(explode("\n", trim($cadenaDes)));
                if ($numeroNombres == 1) {
                    $arrDes = explode("\n", trim($cadenaDes));
                    $nombreDes = trim($arrDes[0]);
                    shell_exec("unzip $archivo -d $rutaArchivos");
                    $myfile = fopen($rutaArchivos."/".$nombreDes, "r");
                    $res = fread($myfile, filesize($rutaArchivos."/".$nombreDes));
                    //$res = simplexml_load_file($rutaArchivos."/".$nombreDes);
                    fclose($myfile);
                    shell_exec("rm -f ".$rutaArchivos."/".str_replace(" ","\ ",$nombreDes));
                }else{
                    $res = response()->json(['mensaje' => 'El fichero debe contener un único archivo.'], 500);
                }

                break;
            case 'gz':
                //echo "SOY EL NOMBE DEL ARCHIVO ".$nombreArchivo; exit();
                $cadenaDes = shell_exec("gunzip -l " . $archivo);
                $arrCadenas = explode("%", trim($cadenaDes));
                if (count($arrCadenas) < 3) {
                    $nombreDes = explode("\n", trim($arrCadenas[1]));
                    shell_exec("gunzip $archivo");
                    $myfile = fopen($rutaArchivos."/".$nombreDes, "r");
                    $res = fread($myfile, filesize($rutaArchivos."/".$nombreDes));
                    //$res = simplexml_load_file($rutaArchivos."/".$nombreDes);
                    fclose($myfile);                   
                    shell_exec("rm -f ".$rutaArchivos."/".str_replace(" ","\ ",$nombreDes));
                }else{
                    $res = response()->json(['mensaje' => 'El fichero debe contener un único archivo.'], 500);
                }

                break;
            case 'rar':

                $cadenaDes = shell_exec("unrar lt $archivo");
                $numeroNombres = substr_count($cadenaDes, "Name:");
                if ($numeroNombres == 1) {
                    $arrDes = explode("\n", $cadenaDes);
                    $arrNombreDes = explode(":", $arrDes[6]);
                    $nombreDes = trim($arrNombreDes[1]);
                    shell_exec("unrar x $archivo $rutaArchivos");
                    $myfile = fopen($rutaArchivos."/".$nombreDes, "r");
                    $res = fread($myfile, filesize($rutaArchivos."/".$nombreDes));
                    //$res = simplexml_load_file($rutaArchivos."/".$nombreDes);
                    fclose($myfile);
                    shell_exec("rm -f ".$rutaArchivos."/".str_replace(" ","\ ",$nombreDes));
                }else{
                    $res = response()->json(['mensaje' => 'El fichero debe contener un único archivo.'], 500);
                }
                break;
        }

        return $res;
    }

    function validarTamanioFichero($bytesXmlAvaluo)
    {
        $tamanioMaximo = 4194304;
        if ($tamanioMaximo < $bytesXmlAvaluo) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    function esValidoAvaluo(Request $request){
        $file = $request->file('files');
        $contents = $this->descomprimirCualquierFormato($file);
        $this->doc = new \DOMDocument('1.0', 'utf-8');        
        //$xsd = 'EsquemaAvaluo.xsd';
        //$xsd = 'Prueba.xsd';
        $xsd = 'EsquemaAvaluomiodos.xsd';
        if (!file_exists($xsd)) {
            echo "Archivo <b>$xsd</b> no existe.";
            return false;
        }
        //Habilita/Deshabilita errores libxml y permite al usuario extraer 
        //información de errores según sea necesario
        libxml_use_internal_errors(true);       
        //echo $contents; exit();
        $this->doc->loadXML($contents, LIBXML_NOBLANKS);
        /*$myfilexsd = fopen('EsquemaAvaluo.xsd', "r");
        $resxsd = fread($myfilexsd, filesize('EsquemaAvaluo.xsd'));    
        fclose($myfilexsd); */
        //var_dump($resxsd); exit();        
        $this->doc->schemaValidate($xsd);
        //echo "EL ERROR ";
        $this->errors = libxml_get_errors();
        $msg = '';
        foreach ($this->errors as $error) {
            switch ($error->level) {
                case LIBXML_ERR_WARNING:
                    $nivel = 'Warning';
                    break;
                case LIBXML_ERR_ERROR :
                    $nivel = 'Error_1';
                    break;
                case LIBXML_ERR_FATAL:
                    $nivel = 'Fatal Error_1';
                    break;
            }
            echo $msg .= "<b>Error $error->code [$nivel]:</b><br>"
                    . str_repeat('&nbsp;', 6) . "Linea: $error->line<br>"
                    . str_repeat('&nbsp;', 6) . "Mensaje: $error->message<br>";
        }
        //fclose($myfile);
        // Valida un documento basado en un esquema
        if (!$this->doc->schemaValidate($xsd)) {
            echo "AQUI SI LLEGO "; exit();
            //Recupera un array de errores
            $this->errors = libxml_get_errors();
            return false;
        }

        
        //Limpia el buffer de errores de libxml
        libxml_clear_errors();
        echo "LLEGUE HASTA ACA  "; exit();
        return true;
    }

    function guardarAvaluo(Request $request){
        $this->modelPeritoSociedad = new PeritoSociedad();        
        $idPersona = 318;
        $file = $request->file('files');
        $contents = $this->descomprimirCualquierFormato($file);        
        $xml = new \SimpleXMLElement($contents);        
        $elementoFecha = $xml->xpath('//Comercial//Identificacion//FechaAvaluo[@id="a.2"]');
        $fechaAvaluo = $elementoFecha[0];

        $esComercial = $xml->xpath('//Comercial');
        if(count($esComercial) > 0){
            $esComercial = true;
            $tipoTramite = 1;
            $elementoPrincipal = '//Comercial';            
        }else{
            $esComercial = false;
            $tipoTramite = 2;
            $elementoPrincipal = '//Comercial';            
        }
        //$camposFexavaAvaluo = $this->camposFexAva();
        $camposFexavaAvaluo = array();
        $camposFexavaAvaluo['CODESTADOAVALUO'] =  1; //CODESTADOAVALUO (Recibido)
        $fecha_hoy = new Carbon(date('Y-m-d'));
        $fecha_presentacion = $fecha_hoy->format('Y-m-d');
        $camposFexavaAvaluo['FECHA_PRESENTACION'] = $fecha_presentacion;
        $camposFexavaAvaluo['CODTIPOTRAMITE'] = $tipoTramite;

        $infoXmlIdentificacion = $xml->xpath($elementoPrincipal.'//Identificacion[@id="a"]');
        $camposFexavaAvaluo = $this->guardarAvaluoIdentificacion($infoXmlIdentificacion, $camposFexavaAvaluo, $idPersona,$elementoPrincipal);
        $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS'] = array();
        $camposFexavaAvaluo = $this->guardarAvaluoAntecedentes($xml, $camposFexavaAvaluo,$elementoPrincipal);
        //$camposFexavaAvaluo['CaracteristicasUrbanas'] = array();
        $camposFexavaAvaluo = $this->guardarAvaluoCaracteristicasUrbanas($xml, $camposFexavaAvaluo,$elementoPrincipal);

        $camposFexavaAvaluo = $this->guardarAvaluoTerreno($xml, $camposFexavaAvaluo,$elementoPrincipal);

        $camposFexavaAvaluo = $this->guardarAvaluoDescripcionImueble($xml, $camposFexavaAvaluo,$elementoPrincipal);
        $camposFexavaAvaluo['IDAVALUO'] = 0;
        $camposFexavaAvaluo = $this->guardarAvaluoElementosConstruccion($xml, $camposFexavaAvaluo,$elementoPrincipal);
        $camposFexavaAvaluo = $this->guardarAvaluoEnfoqueMercado($xml, $camposFexavaAvaluo,$elementoPrincipal);
        $camposFexavaAvaluo = $this->guardarAvaluoEnfoqueCostosComercial($xml, $camposFexavaAvaluo,$elementoPrincipal);
        $camposFexavaAvaluo = $this->guardarAvaluoEnfoqueCostosCatastral($xml, $camposFexavaAvaluo,$elementoPrincipal);
        $camposFexavaAvaluo = $this->guardarAvaluoEnfoqueIngresos($xml, $camposFexavaAvaluo,$elementoPrincipal);
        $camposFexavaAvaluo = $this->guardarAvaluoResumenConclusionAvaluo($xml, $camposFexavaAvaluo,$elementoPrincipal);
        $camposFexavaAvaluo = $this->guardarAvaluoValorReferido($xml, $camposFexavaAvaluo,$elementoPrincipal);
        $camposFexavaAvaluo = $this->guardarAvaluoAnexoFotografico($xml, $camposFexavaAvaluo,$elementoPrincipal);
        

        echo "LA INFO "; print_r($camposFexavaAvaluo); exit();
        /*$this->doc = new \DOMDocument('1.0', 'utf-8');
        libxml_use_internal_errors(true);    
        $this->doc->loadXML($contents, LIBXML_NOBLANKS);*/
    }

    public function camposFexAva()
    {
        try {
           $camposFexavaAvaluo = DB::select("SELECT column_name FROM all_tab_columns WHERE table_name = 'FEXAVA_AVALUO'");
           //print_r($camposFexavaAvaluo); exit();
           $arrCamposFexavaAvaluo = array();
           foreach($camposFexavaAvaluo as $elemento){
               $arrCamposFexavaAvaluo[$elemento->column_name] = '';
           }           
           return $arrCamposFexavaAvaluo;
           
        } catch (\Throwable $th) {
            //Log::info($th);
            error_log($th);
            return response()->json(['mensaje' => 'Error en el servidor'], 500);
        }
    }

    public function guardarAvaluoIdentificacion($infoXmlIdentificacion, $camposFexavaAvaluo, $idPersona,$elementoPrincipal){
        $errores = valida_AvaluoIdentificacion($infoXmlIdentificacion);
        if(count($errores) > 0){
            return array('ERROR' => $errores);
        }
        $arrIdentificacion = array();
        foreach($infoXmlIdentificacion[0] as $llave => $elemento){
            $arrIdentificacion[$llave] = (String)($elemento);
        }                 
        if($arrIdentificacion['NumeroDeAvaluo'] != ''){            
            $camposFexavaAvaluo['NUMEROAVALUO'] = $arrIdentificacion['NumeroDeAvaluo'];
        } 
        if($arrIdentificacion['FechaAvaluo'] != ''){            
            $camposFexavaAvaluo['FECHAAVALUO'] = $arrIdentificacion['FechaAvaluo'];
        }
        if($arrIdentificacion['ClaveValuador'] != ''){            
            $registroPerito = $arrIdentificacion['ClaveValuador'];
            $camposFexavaAvaluo['IDPERSONAPERITO'] = $idPersona;
        }
        if($arrIdentificacion['ClaveSociedad'] != ''){            
            $registroSoci = $arrIdentificacion['ClaveSociedad'];
            $camposFexavaAvaluo['IDPERSONAPERITO'] = $this->IdPeritoSociedadByRegistro($idPersona, true);//aqui se usa IdPeritoSociedadByRegistro(registroPerito, string.Empty, true);
            $camposFexavaAvaluo['IDPERSONASOCIEDAD'] = $this->IdPeritoSociedadByRegistro($idPersona, false);//aqui se usa IdPeritoSociedadByRegistro(registroPerito, registroSoci, false);
        }
        
        if($camposFexavaAvaluo['CODTIPOTRAMITE'] == 2){
            $tipo = "CAT";
        }else if($camposFexavaAvaluo['CODTIPOTRAMITE'] == 1){
            $tipo = "COM";
        }
        $camposFexavaAvaluo['NUMEROUNICO'] = $this->obtenerNumUnicoAv($tipo);      
        return $camposFexavaAvaluo;
    }

    public function guardarAvaluoAntecedentes($infoXmlAntecedentes, $camposFexavaAvaluo,$elementoPrincipal){        
        $infoXmlSolicitante = $infoXmlAntecedentes->xpath($elementoPrincipal.'//Antecedentes[@id="b"]//Solicitante[@id="b.1"]');
        $errores = valida_AvaluoAntecedentes($infoXmlAntecedentes->xpath($elementoPrincipal.'//Antecedentes[@id="b"]'), $elementoPrincipal);
        if(count($errores) > 0){
            return array('ERROR' => $errores);
        }
        $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Solicitante'] = array();
        foreach($infoXmlSolicitante[0] as $llave => $elemento){
            $arrSolicitante[$llave] = (String)($elemento);
        }

        if(trim($arrSolicitante['A.Paterno']) != ''){
            $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Solicitante']['APELLIDOPATERNO'] = $arrSolicitante['A.Paterno'];
        }
        if(trim($arrSolicitante['A.Materno']) != ''){
        $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Solicitante']['APELLIDOMATERNO'] = $arrSolicitante['A.Materno'];
        }
        if(trim($arrSolicitante['Nombre']) != ''){
        $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Solicitante']['NOMBRE'] = $arrSolicitante['Nombre'];
        }
        if(trim($arrSolicitante['Calle']) != ''){
        $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Solicitante']['CALLE'] = $arrSolicitante['Calle'];
        }
        if(trim($arrSolicitante['NumeroInterior']) != ''){
        $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Solicitante']['NUMEROINTERIOR'] = $arrSolicitante['NumeroInterior'];
        }
        if(trim($arrSolicitante['NumeroExterior']) != ''){
        $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Solicitante']['NUMEROEXTERIOR'] = $arrSolicitante['NumeroExterior'];
        }
        if(trim($arrSolicitante['CodigoPostal']) != ''){
        $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Solicitante']['CODIGOPOSTAL'] = $arrSolicitante['CodigoPostal'];
        }
        if(is_int($arrSolicitante['Delegacion'])){
            $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Solicitante']['IDDELEGACION'] = $arrSolicitante['Delegacion'];
            $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Solicitante']['NOMBREDELEGACION'] = '';
        }else{
            //aqui se obtendria el iddelegacion por el nombre
            $idDelegacion = $this->ObtenerIdDelegacionPorNombre($arrSolicitante['Delegacion']);
            if($idDelegacion != -1){
                $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Solicitante']['IDDELEGACION'] = $idDelegacion;
            }
            $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Solicitante']['NOMBREDELEGACION'] = $arrSolicitante['Delegacion'];
        }
        if(trim($arrSolicitante['Colonia']) != ''){
            //aqui se obtendria el idColonia por el nombre
            $idColonia = $this->ObtenerIdColoniaPorNombreyDelegacion(trim($arrSolicitante['Colonia']), $arrSolicitante['Delegacion']);
            if($idColonia != -1){
                $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Solicitante']['IDCOLONIA'] = $idColonia;
            }
            $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Solicitante']['NOMBRECOLONIA'] = $arrSolicitante['Colonia'];
        }

        if(trim($arrSolicitante['TipoPersona']) != ''){
            $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Solicitante']['TIPOPERSONA'] = $arrSolicitante['TipoPersona'];
        }

        $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Solicitante']['CODTIPOFUNCION'] = "S";

        /************************************************************/

        $infoXmlPropietario = $infoXmlAntecedentes->xpath($elementoPrincipal.'//Antecedentes[@id="b"]//Propietario[@id="b.2"]');
        $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Propietario'] = array();
        foreach($infoXmlPropietario[0] as $llave => $elemento){
            $arrPropietario[$llave] = (String)($elemento);
        }
        if(trim($arrPropietario['A.Paterno']) != ''){
            $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Propietario']['APELLIDOPATERNO'] = $arrPropietario['A.Paterno'];
        }
        if(trim($arrPropietario['A.Materno']) != ''){
        $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Propietario']['APELLIDOMATERNO'] = $arrPropietario['A.Materno'];
        }
        if(trim($arrPropietario['Nombre']) != ''){
        $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Propietario']['NOMBRE'] = $arrPropietario['Nombre'];
        }
        if(trim($arrPropietario['Calle']) != ''){
        $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Propietario']['CALLE'] = $arrPropietario['Calle'];
        }
        if(trim($arrPropietario['NumeroInterior']) != ''){
        $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Propietario']['NUMEROINTERIOR'] = $arrPropietario['NumeroInterior'];
        }
        if(trim($arrPropietario['NumeroExterior']) != ''){
        $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Propietario']['NUMEROEXTERIOR'] = $arrPropietario['NumeroExterior'];
        }
        if(trim($arrPropietario['CodigoPostal']) != ''){
        $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Propietario']['CODIGOPOSTAL'] = $arrPropietario['CodigoPostal'];
        }
        if(is_int($arrPropietario['Delegacion'])){
            $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Propietario']['IDDELEGACION'] = $arrPropietario['Delegacion'];
            $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Propietario']['NOMBREDELEGACION'] = '';
        }else{
            //aqui se obtendria el iddelegacion por el nombre
            $idDelegacion = $this->ObtenerIdDelegacionPorNombre($arrSolicitante['Delegacion']);
            if($idDelegacion != -1){
                $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Propietario']['IDDELEGACION'] = $idDelegacion;
            }
            $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Propietario']['NOMBREDELEGACION'] = $arrPropietario['Delegacion'];
        }
        if(trim($arrPropietario['Colonia']) != ''){
            //aqui se obtendria el idColonia por el nombre
            $idColonia = $this->ObtenerIdColoniaPorNombreyDelegacion(trim($arrSolicitante['Colonia']), $arrSolicitante['Delegacion']);
            if($idColonia != -1){
                $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Propietario']['IDCOLONIA'] = $idColonia;
            }
            $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Propietario']['NOMBRECOLONIA'] = $arrPropietario['Colonia'];
        }

        if(trim($arrPropietario['TipoPersona']) != ''){
            $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Propietario']['TIPOPERSONA'] = $arrPropietario['TipoPersona'];
        }
        
        $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['Propietario']['PERSONA_PROPIETARIO'] = "P";

        /************************************************************/

        $infoXmlCuentaCatastral = $infoXmlAntecedentes->xpath($elementoPrincipal.'//Antecedentes[@id="b"]//InmuebleQueSeValua[@id="b.3"]//CuentaCatastral[@id="b.3.10"]');
        $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['CuentaCatastral'] = array();
        foreach($infoXmlCuentaCatastral[0] as $llave => $elemento){
            $arrCuentaCatastral[$llave] = (String)($elemento);
        }
        
        if(trim($arrCuentaCatastral['Region'] != '')){
            $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['CuentaCatastral']['REGION'] = $arrCuentaCatastral['Region'];
        }

        if(trim($arrCuentaCatastral['Manzana'] != '')){
            $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['CuentaCatastral']['MANZANA'] = $arrCuentaCatastral['Manzana'];
        }

        if(trim($arrCuentaCatastral['Lote'] != '')){
            $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['CuentaCatastral']['LOTE'] = $arrCuentaCatastral['Lote'];
        }

        if(trim($arrCuentaCatastral['Localidad'] != '')){
            $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['CuentaCatastral']['UNIDADPRIVATIVA'] = $arrCuentaCatastral['Localidad'];
        }

        if(trim($arrCuentaCatastral['DigitoVerificador'] != '')){
            $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['CuentaCatastral']['DIGITOVERIFICADOR'] = $arrCuentaCatastral['DigitoVerificador'];
        }

        /************************************************************/

        $infoXmlPropositoDelAvaluo = $infoXmlAntecedentes->xpath($elementoPrincipal.'//Antecedentes[@id="b"]//PropositoDelAvaluo[@id="b.4"]');
        $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['PROPOSITO'] = (String)($infoXmlPropositoDelAvaluo[0]);

        /************************************************************/

        $infoXmlObjetoDelAvaluo = $infoXmlAntecedentes->xpath($elementoPrincipal.'//Antecedentes[@id="b"]//ObjetoDelAvaluo[@id="b.5"]');
        $camposFexavaAvaluo['FEXAVA_DATOSPERSONAS']['OBJETO'] = (String)($infoXmlObjetoDelAvaluo[0]);

        

        return $camposFexavaAvaluo;
    }

    public function guardarAvaluoCaracteristicasUrbanas($infoXmlCaracteristicas, $camposFexavaAvaluo,$elementoPrincipal){
        $infoXmlCaracteristicasUrbanas = $infoXmlCaracteristicas->xpath($elementoPrincipal.'//CaracteristicasUrbanas[@id="c"]');

        $errores = valida_AvaluoCaracteristicasUrbanas($infoXmlCaracteristicasUrbanas);   
        if(count($errores) > 0){
            return array('ERROR' => $errores);
        }
        //$camposFexavaAvaluo['CaracteristicasUrbanas'] = array();
        foreach($infoXmlCaracteristicasUrbanas[0] as $llave => $elemento){
            $arrCaracteristicasUrbanas[$llave] = (String)($elemento);
        }
        if(trim($arrCaracteristicasUrbanas['ClasificacionDeLaZona']) != ''){
            $camposFexavaAvaluo['CUCODCLASIFICACIONZONA'] = $arrCaracteristicasUrbanas['ClasificacionDeLaZona'];
        }

        if(trim($arrCaracteristicasUrbanas['IndiceDeSaturacionDeLaZona']) != ''){
            $camposFexavaAvaluo['CUINDICESATURACIONZONA'] = $arrCaracteristicasUrbanas['IndiceDeSaturacionDeLaZona'];
        }

        $fechaAvaluo = $camposFexavaAvaluo['FECHAAVALUO'];
        if(trim($arrCaracteristicasUrbanas['ClaseGeneralDeInmueblesDeLaZona']) != ''){
            $codClase = $arrCaracteristicasUrbanas['ClaseGeneralDeInmueblesDeLaZona'];
            $idClaseEjercicio = $this->SolicitarObtenerIdClasesByCodeAndAno($fechaAvaluo, $codClase); //No se si el query sea el correcto ya que obtiene por fecha pero no hay fecha en la tabla
            $camposFexavaAvaluo['CUCODCLASESCONSTRUCCION'] = $idClaseEjercicio;
        }

        if(trim($arrCaracteristicasUrbanas['DensidadDePoblacion']) != ''){
            $camposFexavaAvaluo['CUCODDENSIDADPOBLACION'] = $arrCaracteristicasUrbanas['DensidadDePoblacion'];
        }

        if(trim($arrCaracteristicasUrbanas['NivelSocioeconomicoDeLaZona']) != ''){
            $camposFexavaAvaluo['CUCODNIVELSOCIOECONOMICO'] = $arrCaracteristicasUrbanas['NivelSocioeconomicoDeLaZona'];
        }

        /********************************Uso del Suelo**********************************/
        $infoXmlUsoDelSuelo = $infoXmlCaracteristicas->xpath($elementoPrincipal.'//CaracteristicasUrbanas[@id="c"]//UsoDelSuelo[@id="c.6"]');        
        foreach($infoXmlUsoDelSuelo[0] as $llave => $elemento){
            $arrUsoDelSuelos[$llave] = (String)($elemento);
        }

        if(trim($arrUsoDelSuelos['UsoDelSuelo']) != ''){
            $camposFexavaAvaluo['CUUSO'] = $arrUsoDelSuelos['UsoDelSuelo'];
        }

        if(trim($arrUsoDelSuelos['AreaLibreObligatoria']) != ''){
            $camposFexavaAvaluo['CUAREALIBREOBLIGATORIO'] = $arrUsoDelSuelos['AreaLibreObligatoria'];
        }

        if(trim($arrUsoDelSuelos['NumeroMaximoDeNivelesAConstruir']) != ''){
            $camposFexavaAvaluo['CUNUMMAXNIVELESACONSTRUIR'] = $arrUsoDelSuelos['NumeroMaximoDeNivelesAConstruir'];
        }

        if(trim($arrUsoDelSuelos['CoeficienteDeUsoDelSuelo']) != ''){
            $camposFexavaAvaluo['CUCOEFICIENTE'] = $arrUsoDelSuelos['CoeficienteDeUsoDelSuelo'];
        }

        /***************************************Servicios públicos y equipamiento urbano*************/

        $infoXmlServiciosPublicosYEquipamientoUrbano = $infoXmlCaracteristicas->xpath($elementoPrincipal.'//CaracteristicasUrbanas[@id="c"]//ServiciosPublicosYEquipamientoUrbano[@id="c.8"]');        
        foreach($infoXmlServiciosPublicosYEquipamientoUrbano[0] as $llave => $elemento){
            $arrServiciosPublicosYEquipamientoUrbanos[$llave] = (String)($elemento);
        }
        //print_r($arrServiciosPublicosYEquipamientoUrbanos); exit();
        if(trim($arrServiciosPublicosYEquipamientoUrbanos['RedDeDistribucionAguaPotable']) != ''){
            $camposFexavaAvaluo['CUCODAGUAPOTABLE'] = $arrServiciosPublicosYEquipamientoUrbanos['RedDeDistribucionAguaPotable'];
        }

        if(trim($arrServiciosPublicosYEquipamientoUrbanos['RedDeRecoleccionDeAguasResiduales']) != ''){
            $camposFexavaAvaluo['CUCODAGUAPOTABLERESIDUAL'] = $arrServiciosPublicosYEquipamientoUrbanos['RedDeRecoleccionDeAguasResiduales'];
        }

        if(trim($arrServiciosPublicosYEquipamientoUrbanos['RedDeDrenajeDeAguasPluvialesEnLaCalle']) != ''){
            $camposFexavaAvaluo['CUCODDRENAJEPLUVIALCALLE'] = $arrServiciosPublicosYEquipamientoUrbanos['RedDeDrenajeDeAguasPluvialesEnLaCalle'];
        }

        if(trim($arrServiciosPublicosYEquipamientoUrbanos['RedDeDrenajeDeAguasPluvialesEnLaZona']) != ''){
            $camposFexavaAvaluo['CUCODDRENAJEPLUVIALZONA'] = $arrServiciosPublicosYEquipamientoUrbanos['RedDeDrenajeDeAguasPluvialesEnLaZona'];
        }

        if(trim($arrServiciosPublicosYEquipamientoUrbanos['SistemaMixto']) != ''){
            $camposFexavaAvaluo['CUCODDRENAJEINMUEBLE'] = $arrServiciosPublicosYEquipamientoUrbanos['SistemaMixto'];
        }

        if(trim($arrServiciosPublicosYEquipamientoUrbanos['SuministroElectrico']) != ''){
            $camposFexavaAvaluo['CUCODSUMINISTROELECTRICO'] = $arrServiciosPublicosYEquipamientoUrbanos['SuministroElectrico'];
        }

        if(trim($arrServiciosPublicosYEquipamientoUrbanos['AcometidaAlInmueble']) != ''){
            $camposFexavaAvaluo['CUCODACOMETIDAINMUEBLE'] = $arrServiciosPublicosYEquipamientoUrbanos['AcometidaAlInmueble'];
        }

        if(trim($arrServiciosPublicosYEquipamientoUrbanos['AlumbradoPublico']) != ''){
            $camposFexavaAvaluo['CUCODALUMBRADOPUBLICO'] = $arrServiciosPublicosYEquipamientoUrbanos['AlumbradoPublico'];
        }

        if(trim($arrServiciosPublicosYEquipamientoUrbanos['Vialidades']) != ''){
            $camposFexavaAvaluo['CUCODVIALIDADES'] = $arrServiciosPublicosYEquipamientoUrbanos['Vialidades'];
        }

        if(trim($arrServiciosPublicosYEquipamientoUrbanos['Banquetas']) != ''){
            $camposFexavaAvaluo['CUCODBANQUETAS'] = $arrServiciosPublicosYEquipamientoUrbanos['Banquetas'];
        }

        if(trim($arrServiciosPublicosYEquipamientoUrbanos['Guarniciones']) != ''){
            $camposFexavaAvaluo['CUCODGUARNICIONES'] = $arrServiciosPublicosYEquipamientoUrbanos['Guarniciones'];
        }

        if(trim($arrServiciosPublicosYEquipamientoUrbanos['NivelDeInfraestructuraEnLaZona']) != ''){
            $camposFexavaAvaluo['CUPORCENTAJEINFRAESTRUCTURA'] = $arrServiciosPublicosYEquipamientoUrbanos['NivelDeInfraestructuraEnLaZona'];
        }

        if(trim($arrServiciosPublicosYEquipamientoUrbanos['GasNatural']) != ''){
            $camposFexavaAvaluo['CUCODGASNATURAL'] = $arrServiciosPublicosYEquipamientoUrbanos['GasNatural'];
        }

        if(trim($arrServiciosPublicosYEquipamientoUrbanos['TelefonosSuministro']) != ''){
            $camposFexavaAvaluo['CUCODSUMINISTROTELEFONICA'] = $arrServiciosPublicosYEquipamientoUrbanos['TelefonosSuministro'];
        }

        if(trim($arrServiciosPublicosYEquipamientoUrbanos['AcometidaAlInmuebleTel']) != ''){
            $camposFexavaAvaluo['CUCODACOMETIDAINMUEBLETEL'] = $arrServiciosPublicosYEquipamientoUrbanos['AcometidaAlInmuebleTel'];
        }

        if(trim($arrServiciosPublicosYEquipamientoUrbanos['SennalizacionDeVias']) != ''){
            $camposFexavaAvaluo['CUCODSENALIZACIONVIAS'] = $arrServiciosPublicosYEquipamientoUrbanos['SennalizacionDeVias'];
        }

        if(trim($arrServiciosPublicosYEquipamientoUrbanos['NomenclaturaDeCalles']) != ''){
            $camposFexavaAvaluo['CUCODNOMENCLATURACALLE'] = $arrServiciosPublicosYEquipamientoUrbanos['NomenclaturaDeCalles'];
        }

        if(trim($arrServiciosPublicosYEquipamientoUrbanos['DistanciaTranporteUrbano']) != ''){
            $camposFexavaAvaluo['CUDISTANCIATRANSPORTEURBANO'] = $arrServiciosPublicosYEquipamientoUrbanos['DistanciaTranporteUrbano'];
        }

        if(trim($arrServiciosPublicosYEquipamientoUrbanos['FrecuenciaTransporteUrbano']) != ''){
            $camposFexavaAvaluo['CUFRECUENCIATRANSPORTEURBANO'] = $arrServiciosPublicosYEquipamientoUrbanos['FrecuenciaTransporteUrbano'];
        }

        if(trim($arrServiciosPublicosYEquipamientoUrbanos['DistanciaTransporteSuburbano']) != ''){
            $camposFexavaAvaluo['CUDISTANCIATRANSPORTESUBURB'] = $arrServiciosPublicosYEquipamientoUrbanos['DistanciaTransporteSuburbano'];
        }

        if(trim($arrServiciosPublicosYEquipamientoUrbanos['FrecuenciaTransporteSuburbano']) != ''){
            $camposFexavaAvaluo['CUFRECUENCIATRANSPORTESUBURB'] = $arrServiciosPublicosYEquipamientoUrbanos['FrecuenciaTransporteSuburbano'];
        }

        if(trim($arrServiciosPublicosYEquipamientoUrbanos['Vigilancia']) != ''){
            $camposFexavaAvaluo['CUCODVIGILANCIAZONA'] = $arrServiciosPublicosYEquipamientoUrbanos['Vigilancia'];
        }

        if(trim($arrServiciosPublicosYEquipamientoUrbanos['RecoleccionDeBasura']) != ''){
            $camposFexavaAvaluo['CUCODRECOLECCIONBASURA'] = $arrServiciosPublicosYEquipamientoUrbanos['RecoleccionDeBasura'];
        }

        if(trim($arrServiciosPublicosYEquipamientoUrbanos['Templo']) != ''){
            $camposFexavaAvaluo['CUEXISTEIGLESIA'] = $arrServiciosPublicosYEquipamientoUrbanos['Templo'];
        }

        if(trim($arrServiciosPublicosYEquipamientoUrbanos['Mercados']) != ''){
            $camposFexavaAvaluo['CUEXISTEMERCADOS'] = $arrServiciosPublicosYEquipamientoUrbanos['Mercados'];
        }

        if(trim($arrServiciosPublicosYEquipamientoUrbanos['PlazasPublicas']) != ''){
            $camposFexavaAvaluo['CUEXISTEPLAZASPUBLICOS'] = $arrServiciosPublicosYEquipamientoUrbanos['PlazasPublicas'];
        }

        if(trim($arrServiciosPublicosYEquipamientoUrbanos['ParquesYJardines']) != ''){
            $camposFexavaAvaluo['CUEXISTEPARQUESJARDINES'] = $arrServiciosPublicosYEquipamientoUrbanos['ParquesYJardines'];
        }

        if(trim($arrServiciosPublicosYEquipamientoUrbanos['Escuelas']) != ''){
            $camposFexavaAvaluo['CUEXISTEESCUELAS'] = $arrServiciosPublicosYEquipamientoUrbanos['Escuelas'];
        }

        if(trim($arrServiciosPublicosYEquipamientoUrbanos['Hospitales']) != ''){
            $camposFexavaAvaluo['CUEXISTEHOSPITALES'] = $arrServiciosPublicosYEquipamientoUrbanos['Hospitales'];
        }

        if(trim($arrServiciosPublicosYEquipamientoUrbanos['Bancos']) != ''){
            $camposFexavaAvaluo['CUEXISTEBANCOS'] = $arrServiciosPublicosYEquipamientoUrbanos['Bancos'];
        }

        if(trim($arrServiciosPublicosYEquipamientoUrbanos['EstacionDeTransporte']) != ''){
            $camposFexavaAvaluo['CUEXISTEESTACIONTRANSPORTE'] = $arrServiciosPublicosYEquipamientoUrbanos['EstacionDeTransporte'];
        }

        return $camposFexavaAvaluo;
    }

    public function guardarAvaluoTerreno($infoXmlTerreno, $camposFexavaAvaluo,$elementoPrincipal){
        $errores = valida_AvaluoTerreno($infoXmlTerreno->xpath($elementoPrincipal.'//Terreno[@id="d"]'), $elementoPrincipal);    
        if(count($errores) > 0){
            return array('ERROR' => $errores);
        }                       
        $infoXmlCallesTransversalesLimitrofesYOrientacion = $infoXmlTerreno->xpath($elementoPrincipal.'//Terreno[@id="d"]//CallesTransversalesLimitrofesYOrientacion[@id="d.1"]');        
        $query = (String)($infoXmlCallesTransversalesLimitrofesYOrientacion[0]);

        $infoXmlCroquisMicroLocalizacion = $infoXmlTerreno->xpath($elementoPrincipal.'//Terreno[@id="d"]//CroquisMicroLocalizacion[@id="d.2"]');        
        $queryMicro = (String)($infoXmlCroquisMicroLocalizacion[0]);
        
        $infoXmlCroquisMacroLocalizacion = $infoXmlTerreno->xpath($elementoPrincipal.'//Terreno[@id="d"]//CroquisMacroLocalizacion[@id="d.3"]');        
        $queryMacro = (String)($infoXmlCroquisMacroLocalizacion[0]);

        //AQUI FALTA GUARDAR LAS FOTOS Y CAMBIAR LO QUE TRAIA DE INFORMACION EN EL XML POR LOS ID OBTENIDOS Tran_InsertFichero

        $infoXmlEscritura = $infoXmlTerreno->xpath($elementoPrincipal.'//Terreno[@id="d"]//MedidasYColindancias[@id="d.4"]//FuenteDeInformacionLegal[@id="d.4.1"]//Escritura[@id="d.4.1.1"]');
        $arrEscritura = array();
        $controlElemntos = 0;
        foreach($infoXmlEscritura[0] as $llave => $elemento){
            $arrEscritura[$llave] =(String)($elemento);
            if(trim($arrEscritura[$llave]) != ''){
                $controlElemntos = $controlElemntos+1;
            }
        } //print_r($infoXmlEscritura); echo "SOY controlElemntos ".$controlElemntos; exit();
        if($controlElemntos > 0){
            $camposFexavaAvaluo['FEXAVA_FUENTEINFORMACIONLEG'] = array();
            $camposFexavaAvaluo['FEXAVA_FUENTEINFORMACIONLEG']['CODTIPOFUENTEINFORMACION'] = '1';

            if(trim($arrEscritura['FechaEscritura']) != ''){
                $camposFexavaAvaluo['FEXAVA_FUENTEINFORMACIONLEG']['FECHA'] = $arrEscritura['FechaEscritura'];
            }

            $camposFexavaAvaluo['FEXAVA_ESCRITURA'] = array();
            if(trim($arrEscritura['NumeroDeEscritura']) != ''){
                $camposFexavaAvaluo['FEXAVA_ESCRITURA']['NUMESCRITURA'] =  $arrEscritura['NumeroDeEscritura'];
            }

            if(trim($arrEscritura['NumeroDeVolumen']) != ''){
                $camposFexavaAvaluo['FEXAVA_ESCRITURA']['NUMVOLUMEN'] =  $arrEscritura['NumeroDeVolumen'];
            }

            if(trim($arrEscritura['NumeroNotaria']) != ''){
                $camposFexavaAvaluo['FEXAVA_ESCRITURA']['NUMNOTARIO'] =  $arrEscritura['NumeroNotaria'];
            }

            if(trim($arrEscritura['NombreDelNotario']) != ''){
                $camposFexavaAvaluo['FEXAVA_ESCRITURA']['NOMBRENOTARIO'] =  $arrEscritura['NombreDelNotario'];
            }

            if(trim($arrEscritura['DistritoJudicialNotario']) != ''){
                $camposFexavaAvaluo['FEXAVA_ESCRITURA']['DISTRITOJUDICIALNOTARIO'] =  $arrEscritura['DistritoJudicialNotario'];
            }
        }
        /***********************************************************Sentencia**********************************************************************/
        
        $arrPrincipalFuente = $infoXmlTerreno->xpath($elementoPrincipal.'//Terreno[@id="d"]//MedidasYColindancias[@id="d.4"]//FuenteDeInformacionLegal[@id="d.4.1"]');
        $arrIdsFuenteDeInformacionLegal = array();
        $arrFuenteDeInformacionLegal = array();
        foreach($arrPrincipalFuente[0] as $llave => $elemento){
            $arrIdsFuenteDeInformacionLegal[(String)($elemento['id'])] = $llave;
            $arrFuenteDeInformacionLegal[$llave] = $elemento;
        }
        
        if(isset($arrIdsFuenteDeInformacionLegal['d.4.1.2'])){
            $etiqueta = $arrIdsFuenteDeInformacionLegal['d.4.1.2'];
            $camposFexavaAvaluo['FEXAVA_FUENTEINFORMACIONLEG'] = array();
            $infoXmlSentencia = $infoXmlTerreno->xpath($elementoPrincipal.'//Terreno[@id="d"]//MedidasYColindancias[@id="d.4"]//FuenteDeInformacionLegal[@id="d.4.1"]//'.$etiqueta.'[@id="d.4.1.2"]');
            $arrIdsSentencia = array();
            $arrSentencia = array();            
            foreach($infoXmlSentencia[0] as $llave => $elemento){
                $arrIdsSentencia[(String)($elemento['id'])] = $llave;
                $arrSentencia[$llave] =(String)($elemento);                
            }

            $camposFexavaAvaluo['FEXAVA_FUENTEINFORMACIONLEG']['CODTIPOFUENTEINFORMACION'] = '2';            

            if(isset($arrIdsSentencia['d.4.1.2.2']) and trim($arrSentencia[$arrIdsSentencia['d.4.1.2.2']]) != ''){
                $camposFexavaAvaluo['FEXAVA_FUENTEINFORMACIONLEG']['FECHA'] = $arrSentencia[$arrIdsSentencia['d.4.1.2.2']];
            }

            $camposFexavaAvaluo['FEXAVA_SENTENCIA'] = array();

            if(isset($arrIdsSentencia['d.4.1.2.1']) and trim($arrSentencia[$arrIdsSentencia['d.4.1.2.1']]) != ''){
                $camposFexavaAvaluo['FEXAVA_SENTENCIA']['JUZGADO'] = $arrSentencia[$arrIdsSentencia['d.4.1.2.1']];
            }

            if(isset($arrIdsSentencia['d.4.1.2.3']) and trim($arrSentencia[$arrIdsSentencia['d.4.1.2.3']]) != ''){
                $camposFexavaAvaluo['FEXAVA_SENTENCIA']['NUMEXPEDIENTE'] = $arrSentencia[$arrIdsSentencia['d.4.1.2.3']];
            }
        }

            /***********************************************************Contrato Privado**********************************************************************/

            if(isset($arrIdsFuenteDeInformacionLegal['d.4.1.3'])){
                $etiqueta = $arrIdsFuenteDeInformacionLegal['d.4.1.3'];
                $camposFexavaAvaluo['FEXAVA_FUENTEINFORMACIONLEG'] = array();
                $infoXmlContratoPrivado = $infoXmlTerreno->xpath($elementoPrincipal.'//Terreno[@id="d"]//MedidasYColindancias[@id="d.4"]//FuenteDeInformacionLegal[@id="d.4.1"]//'.$etiqueta.'[@id="d.4.1.3"]');
                $arrIdsContratoPrivado = array();
                $arrContratoPrivado = array();            
                foreach($infoXmlContratoPrivado[0] as $llave => $elemento){
                    $arrIdsContratoPrivado[(String)($elemento['id'])] = $llave;
                    $arrContratoPrivado[$llave] =(String)($elemento);                
                }
    
                $camposFexavaAvaluo['FEXAVA_FUENTEINFORMACIONLEG']['CODTIPOFUENTEINFORMACION'] = '3';                
    
                if(isset($arrIdsContratoPrivado['d.4.1.3.1']) and trim($arrContratoPrivado[$arrIdsContratoPrivado['d.4.1.3.1']]) != ''){
                    $camposFexavaAvaluo['FEXAVA_FUENTEINFORMACIONLEG']['FECHA'] = $arrContratoPrivado[$arrIdsContratoPrivado['d.4.1.3.1']];
                }
    
                $camposFexavaAvaluo['FEXAVA_CONTRATOPRIVADO'] = array();
    
                if(isset($arrIdsContratoPrivado['d.4.1.3.2']) and trim($arrContratoPrivado[$arrIdsContratoPrivado['d.4.1.3.2']]) != ''){
                    $camposFexavaAvaluo['FEXAVA_CONTRATOPRIVADO']['NOMBREADQUIRIENTE'] = $arrSentencia[$arrIdsContratoPrivado['d.4.1.3.2']];
                }
    
                if(isset($arrIdsContratoPrivado['d.4.1.2.3']) and trim($arrContratoPrivado[$arrIdsContratoPrivado['d.4.1.2.3']]) != ''){
                    $camposFexavaAvaluo['FEXAVA_CONTRATOPRIVADO']['APELLIDOPATERNOADQUIRIENTE'] = $arrContratoPrivado[$arrIdsContratoPrivado['d.4.1.2.3']];
                }

                if(isset($arrIdsContratoPrivado['d.4.1.3.4']) and trim($arrContratoPrivado[$arrIdsContratoPrivado['d.4.1.3.4']]) != ''){
                    $camposFexavaAvaluo['FEXAVA_CONTRATOPRIVADO']['APELLIDOMATERNOADQUIRIENTE'] = $arrContratoPrivado[$arrIdsContratoPrivado['d.4.1.3.4']];
                }

                if(isset($arrIdsContratoPrivado['d.4.1.3.5']) and trim($arrContratoPrivado[$arrIdsContratoPrivado['d.4.1.3.5']]) != ''){
                    $camposFexavaAvaluo['FEXAVA_CONTRATOPRIVADO']['NOMBREENAJENANTE'] = $arrContratoPrivado[$arrIdsContratoPrivado['d.4.1.3.5']];
                }

                if(isset($arrIdsContratoPrivado['d.4.1.3.6']) and trim($arrContratoPrivado[$arrIdsContratoPrivado['d.4.1.3.6']]) != ''){
                    $camposFexavaAvaluo['FEXAVA_CONTRATOPRIVADO']['APELLIDOPATERNOENAJENANTE'] = $arrContratoPrivado[$arrIdsContratoPrivado['d.4.1.3.6']];
                }

                if(isset($arrIdsContratoPrivado['d.4.1.3.7']) and trim($arrContratoPrivado[$arrIdsContratoPrivado['d.4.1.3.7']]) != ''){
                    $camposFexavaAvaluo['FEXAVA_CONTRATOPRIVADO']['APELLIDOMATERNOENAJENANTE'] = $arrContratoPrivado[$arrIdsContratoPrivado['d.4.1.3.7']];
                }

        }

        /***********************************************************Alineamiento y numero oficial**********************************************************************/

        if(isset($arrIdsFuenteDeInformacionLegal['d.4.1.4'])){
            $etiqueta = $arrIdsFuenteDeInformacionLegal['d.4.1.4'];
            $camposFexavaAvaluo['FEXAVA_FUENTEINFORMACIONLEG'] = array();
            $infoXmlAlineamiento = $infoXmlTerreno->xpath($elementoPrincipal.'//Terreno[@id="d"]//MedidasYColindancias[@id="d.4"]//FuenteDeInformacionLegal[@id="d.4.1"]//'.$etiqueta.'[@id="d.4.1.4"]');
            $arrIdsAlineamiento = array();
            $arrAlineamiento = array();            
            foreach($infoXmlAlineamiento[0] as $llave => $elemento){
                $arrIdsAlineamiento[(String)($elemento['id'])] = $llave;
                $arrAlineamiento[$llave] =(String)($elemento);                
            }

            $camposFexavaAvaluo['FEXAVA_FUENTEINFORMACIONLEG']['CODTIPOFUENTEINFORMACION'] = '4';                

            if(isset($arrIdsAlineamiento['d.4.1.4.1']) and trim($arrAlineamiento[$arrIdsAlineamiento['d.4.1.4.1']]) != ''){
                $camposFexavaAvaluo['FEXAVA_FUENTEINFORMACIONLEG']['FECHA'] = $arrAlineamiento[$arrIdsAlineamiento['d.4.1.4.1']];
            }

            $camposFexavaAvaluo['FEXAVA_ALINEAMIENTONUMOFI'] = array();
            if(isset($arrIdsAlineamiento['d.4.1.4.2']) and trim($arrAlineamiento[$arrIdsAlineamiento['d.4.1.4.2']]) != ''){
                $camposFexavaAvaluo['FEXAVA_ALINEAMIENTONUMOFI']['NUMFOLIO'] = $arrAlineamiento[$arrIdsAlineamiento['d.4.1.4.2']];
            }
            

        }        

        /**********************************************Superficie del terreno (Privativas)*****************************************/

        $arrPrincipalSuperficie = $infoXmlTerreno->xpath($elementoPrincipal.'//Terreno[@id="d"]//SuperficieDelTerreno[@id="d.5"]');
        $arrIdsSuperficieDelTerreno = array();
        $arrSuperficieDelTerreno = array();
        foreach($arrPrincipalSuperficie[0] as $llave => $elemento){
            $arrIdsSuperficieDelTerreno[(String)($elemento['id'])] = $llave;
            $SuperficieDelTerreno[$llave] = $elemento;
        }
        
        if(isset($arrIdsSuperficieDelTerreno['d.5.1'])){
            $etiqueta = $arrIdsFuenteDeInformacionLegal['d.5.1'];
            $camposFexavaAvaluo['FEXAVA_SUPERFICIE'] = array();
            $infoXmlSuperficieDelTerreno = $infoXmlTerreno->xpath($elementoPrincipal.'//Terreno[@id="d"]//SuperficieDelTerreno[@id="d.5"]//'.$etiqueta.'[@id="d.5.1"]');
            $arrIdsSuperficieDelTerreno = array();
            $arrSuperficieDelTerreno = array();
            foreach($infoXmlSuperficieDelTerreno[0] as $llave => $elemento){
                $arrIdsSuperficieDelTerreno[(String)($elemento['id'])] = $llave;
                $arrSuperficieDelTerreno[$llave] =(String)($elemento);
            }

            if(isset($arrIdsSuperficieDelTerreno['d.5.1.n.1']) and trim($arrSuperficieDelTerreno[$arrIdsSuperficieDelTerreno['d.5.1.n.1']]) != ''){
                $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['IDENTIFICADORFRACCION'] = $arrSuperficieDelTerreno[$arrIdsSuperficieDelTerreno['d.5.1.n.1']];
            }

            if(isset($arrIdsSuperficieDelTerreno['d.5.1.n.2']) and trim($arrSuperficieDelTerreno[$arrIdsSuperficieDelTerreno['d.5.1.n.2']]) != ''){
                $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['SUPERFICIEFRACCION'] = $arrSuperficieDelTerreno[$arrIdsSuperficieDelTerreno['d.5.1.n.2']];
            }

            if(isset($arrIdsSuperficieDelTerreno['d.5.1.n.3']) and trim($arrSuperficieDelTerreno[$arrIdsSuperficieDelTerreno['d.5.1.n.3']]) != ''){
                $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['FZO'] = $arrSuperficieDelTerreno[$arrIdsSuperficieDelTerreno['d.5.1.n.3']];
            }

            if(isset($arrIdsSuperficieDelTerreno['d.5.1.n.4']) and trim($arrSuperficieDelTerreno[$arrIdsSuperficieDelTerreno['d.5.1.n.4']]) != ''){
                $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['FUB'] = $arrSuperficieDelTerreno[$arrIdsSuperficieDelTerreno['d.5.1.n.4']];
            }

            if(isset($arrIdsSuperficieDelTerreno['d.5.1.n.5']) and trim($arrSuperficieDelTerreno[$arrIdsSuperficieDelTerreno['d.5.1.n.5']]) != ''){
                $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['FFR'] = $arrSuperficieDelTerreno[$arrIdsSuperficieDelTerreno['d.5.1.n.5']];
            }

            if(isset($arrIdsSuperficieDelTerreno['d.5.1.n.6']) and trim($arrSuperficieDelTerreno[$arrIdsSuperficieDelTerreno['d.5.1.n.6']]) != ''){
                $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['FFO'] = $arrSuperficieDelTerreno[$arrIdsSuperficieDelTerreno['d.5.1.n.6']];
            }

            if(isset($arrIdsSuperficieDelTerreno['d.5.1.n.7']) and trim($arrSuperficieDelTerreno[$arrIdsSuperficieDelTerreno['d.5.1.n.7']]) != ''){
                $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['FSU'] = $arrSuperficieDelTerreno[$arrIdsSuperficieDelTerreno['d.5.1.n.7']];
            }

            if(isset($arrIdsSuperficieDelTerreno['d.5.1.n.9.1']) and trim($arrSuperficieDelTerreno[$arrIdsSuperficieDelTerreno['d.5.1.n.9.1']]) != ''){
                $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['FOTVALOR'] = $arrSuperficieDelTerreno[$arrIdsSuperficieDelTerreno['d.5.1.n.9.1']];
            }

            if(isset($arrIdsSuperficieDelTerreno['d.5.1.n.9.2']) and trim($arrSuperficieDelTerreno[$arrIdsSuperficieDelTerreno['d.5.1.n.9.2']]) != ''){
                $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['FOTDESCRIPCION'] = $arrSuperficieDelTerreno[$arrIdsSuperficieDelTerreno['d.5.1.n.9.2']];
            }

            if(isset($arrIdsSuperficieDelTerreno['d.5.1.n.12']) and trim($arrSuperficieDelTerreno[$arrIdsSuperficieDelTerreno['d.5.1.n.12']]) != ''){
                $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['VALCATASTRALTIERRA'] = $arrSuperficieDelTerreno[$arrIdsSuperficieDelTerreno['d.5.1.n.12']];
            }
            $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['CODTIPO'] = "P";
        }

        /**********************************************Superficie del terreno (Comunes)*****************************************/
            
        if(isset($arrIdsSuperficieDelTerreno['d.5.2'])){
            $etiqueta = $arrIdsFuenteDeInformacionLegal['d.5.2'];
            $camposFexavaAvaluo['FEXAVA_SUPERFICIE'] = array();
            $infoXmlSuperficieDelTerrenoComun = $infoXmlTerreno->xpath($elementoPrincipal.'//Terreno[@id="d"]//SuperficieDelTerreno[@id="d.5"]//'.$etiqueta.'[@id="d.5.2"]');
            $arrIdsSuperficieDelTerrenoComun = array();
            $arrSuperficieDelTerrenoComun = array();
            foreach($infoXmlSuperficieDelTerrenoComun[0] as $llave => $elemento){
                $arrIdsSuperficieDelTerrenoComun[(String)($elemento['id'])] = $llave;
                $arrSuperficieDelTerrenoComun[$llave] =(String)($elemento);
            }

            if(isset($arrIdsSuperficieDelTerrenoComun['d.5.2.n.1']) and trim($arrSuperficieDelTerrenoComun[$arrIdsSuperficieDelTerrenoComun['d.5.2.n.1']]) != ''){
                $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['IDENTIFICADORFRACCION'] = $arrSuperficieDelTerrenoComun[$arrIdsSuperficieDelTerrenoComun['d.5.2.n.1']];
            }

            if(isset($arrIdsSuperficieDelTerrenoComun['d.5.2.n.2']) and trim($arrSuperficieDelTerrenoComun[$arrIdsSuperficieDelTerrenoComun['d.5.2.n.2']]) != ''){
                $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['SUPERFICIEFRACCION'] = $arrSuperficieDelTerrenoComun[$arrIdsSuperficieDelTerrenoComun['d.5.2.n.2']];
            }

            if(isset($arrIdsSuperficieDelTerrenoComun['d.5.2.n.3']) and trim($arrSuperficieDelTerrenoComun[$arrIdsSuperficieDelTerrenoComun['d.5.2.n.3']]) != ''){
                $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['FZO'] = $arrSuperficieDelTerrenoComun[$arrIdsSuperficieDelTerrenoComun['d.5.2.n.3']];
            }

            if(isset($arrIdsSuperficieDelTerrenoComun['d.5.2.n.4']) and trim($arrSuperficieDelTerrenoComun[$arrIdsSuperficieDelTerrenoComun['d.5.2.n.4']]) != ''){
                $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['FUB'] = $arrSuperficieDelTerrenoComun[$arrIdsSuperficieDelTerrenoComun['d.5.2.n.4']];
            }

            if(isset($arrIdsSuperficieDelTerrenoComun['d.5.2.n.5']) and trim($arrSuperficieDelTerrenoComun[$arrIdsSuperficieDelTerrenoComun['d.5.2.n.5']]) != ''){
                $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['FFR'] = $arrSuperficieDelTerrenoComun[$arrIdsSuperficieDelTerrenoComun['d.5.2.n.5']];
            }

            if(isset($arrIdsSuperficieDelTerrenoComun['d.5.2.n.6']) and trim($arrSuperficieDelTerrenoComun[$arrIdsSuperficieDelTerrenoComun['d.5.2.n.6']]) != ''){
                $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['FFO'] = $arrSuperficieDelTerrenoComun[$arrIdsSuperficieDelTerrenoComun['d.5.2.n.6']];
            }

            if(isset($arrIdsSuperficieDelTerrenoComun['d.5.2.n.7']) and trim($arrSuperficieDelTerrenoComun[$arrIdsSuperficieDelTerrenoComun['d.5.2.n.7']]) != ''){
                $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['FSU'] = $arrSuperficieDelTerrenoComun[$arrIdsSuperficieDelTerrenoComun['d.5.2.n.7']];
            }

            if(isset($arrIdsSuperficieDelTerrenoComun['d.5.2.n.9.1']) and trim($arrSuperficieDelTerrenoComun[$arrIdsSuperficieDelTerrenoComun['d.5.2.n.9.1']]) != ''){
                $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['FOTVALOR'] = $arrSuperficieDelTerrenoComun[$arrIdsSuperficieDelTerrenoComun['d.5.2.n.9.1']];
            }

            if(isset($arrIdsSuperficieDelTerrenoComun['d.5.2.n.9.2']) and trim($arrSuperficieDelTerrenoComun[$arrIdsSuperficieDelTerrenoComun['d.5.2.n.9.2']]) != ''){
                $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['FOTDESCRIPCION'] = $arrSuperficieDelTerrenoComun[$arrIdsSuperficieDelTerrenoComun['d.5.2.n.9.2']];
            }

            if(isset($arrIdsSuperficieDelTerrenoComun['d.5.2.n.12']) and trim($arrSuperficieDelTerrenoComun[$arrIdsSuperficieDelTerrenoComun['d.5.2.n.12']]) != ''){
                $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['VALCATASTRALTIERRA'] = $arrSuperficieDelTerrenoComun[$arrIdsSuperficieDelTerrenoComun['d.5.2.n.12']];
            }
            $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['CODTIPO'] = "C";
        }

        /**************************************************************************************************************************/

        $arrPrincipalIndiviso = $infoXmlTerreno->xpath($elementoPrincipal.'//Terreno[@id="d"]//Indiviso[@id="d.6"]');        
        if(trim((String)($arrPrincipalIndiviso[0])) != ''){
            $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['TEINDIVISO'] = (String)($arrPrincipalIndiviso[0]);
        }

        $arrPrincipalTopografiaYConfiguracion = $infoXmlTerreno->xpath($elementoPrincipal.'//Terreno[@id="d"]//TopografiaYConfiguracion[@id="d.7"]');
        if(trim((String)($arrPrincipalTopografiaYConfiguracion[0])) != ''){
            $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['CUCODTOPOGRAFIA'] = (String)($arrPrincipalTopografiaYConfiguracion[0]);
        }

        $arrPrincipalCaracteristicasPanoramicas = $infoXmlTerreno->xpath($elementoPrincipal.'//Terreno[@id="d"]//CaracteristicasPanoramicas[@id="d.8"]');
        if(trim((String)($arrPrincipalCaracteristicasPanoramicas[0])) != ''){
            $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['TECARACTERISTICASPARONAMICAS'] = (String)($arrPrincipalCaracteristicasPanoramicas[0]);
        }

        $arrPrincipalDensidadHabitacional = $infoXmlTerreno->xpath($elementoPrincipal.'//Terreno[@id="d"]//DensidadHabitacional[@id="d.9"]');
        if(trim((String)($arrPrincipalDensidadHabitacional[0])) != ''){
            $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['TECODDENSIDADHABITACIONAL'] = (String)($arrPrincipalDensidadHabitacional[0]);
        }

        $arrPrincipalServidumbresORestricciones  = $infoXmlTerreno->xpath($elementoPrincipal.'//Terreno[@id="d"]//ServidumbresORestricciones[@id="d.10"]');
        if(trim((String)($arrPrincipalServidumbresORestricciones[0])) != ''){
            $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['TESERVIDUMBRESORESTRICCIONES'] = (String)($arrPrincipalServidumbresORestricciones[0]);
        }       

        return $camposFexavaAvaluo;
    }

    public function guardarAvaluoDescripcionImueble($infoXmlTerreno, $camposFexavaAvaluo,$elementoPrincipal){
        $errores = valida_AvaluoDescripcionImueble($infoXmlTerreno->xpath($elementoPrincipal.'//DescripcionDelInmueble[@id="e"]'), $elementoPrincipal);    
        if(count($errores) > 0){
            return array('ERROR' => $errores);
        }
        $fechaAvaluo = $camposFexavaAvaluo['FECHAAVALUO'];

        $arrPrincipalUsoActual = $infoXmlTerreno->xpath($elementoPrincipal.'//DescripcionDelInmueble[@id="e"]//UsoActual[@id="e.1"]');        
        if(trim((String)($arrPrincipalUsoActual[0])) != ''){
            $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['DIUSOACTUAL'] = (String)($arrPrincipalUsoActual[0]);
        }
                    
        
        /**********************************************Tipos de Construccion*********************************************/
        $arrPrincipalDescripcionDelInmueble = $infoXmlTerreno->xpath($elementoPrincipal.'//DescripcionDelInmueble[@id="e"]');        
        $arrIdsDescripcionDelInmueble = array();
        $arrDescripcionDelInmueble = array();
        foreach($arrPrincipalDescripcionDelInmueble[0] as $llave => $elemento){
            $arrIdsDescripcionDelInmueble[(String)($elemento['id'])] = $llave;
            $arrDescripcionDelInmueble[$llave] = $elemento;
        }
        

        /**********************************************Construcciones Privativas*****************************************/
        if(isset($arrIdsDescripcionDelInmueble['e.2'])){
            $usoActual = $infoXmlTerreno->xpath($elementoPrincipal.'//DescripcionDelInmueble[@id="e"]//TiposDeConstruccion[@id="e.2"]');
            $arrPrincipalUsoActual = $this->obtenElementosPrincipal($usoActual);                        
            $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'] = array();
            
            if(isset($arrPrincipalUsoActual['arrIds']['e.2.1'])){                
               $construccionesPrivativas = $infoXmlTerreno->xpath($elementoPrincipal.'//DescripcionDelInmueble[@id="e"]//TiposDeConstruccion[@id="e.2"]//'.$arrPrincipalUsoActual['arrIds']['e.2.1'].'[@id="e.2.1"]');
               $arrConstruccionesPrivativas = $this->obtenElementos($construccionesPrivativas);
              
                for($i=0;$i<count($construccionesPrivativas);$i++){

                    $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$i] = array();

                    if(isset($arrConstruccionesPrivativas['arrIds'][$i]['e.2.1.n.1'])){
                        $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$i]['DESCRIPCION'] = (String)($arrConstruccionesPrivativas['arrElementos'][$i][$arrConstruccionesPrivativas['arrIds'][$i]['e.2.1.n.1']]);
                       }
        
                       if(isset($arrConstruccionesPrivativas['arrIds'][$i]['e.2.1.n.2'])){
                        //Aqui usar SolicitarObtenerIdUsosByCodeAndAno();
                        $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$i]['IDUSOSEJERCICIO'] = (String)($arrConstruccionesPrivativas['arrElementos'][$i][$arrConstruccionesPrivativas['arrIds'][$i]['e.2.1.n.2']]);
                       }
        
                       if(isset($arrConstruccionesPrivativas['arrIds'][$i]['e.2.1.n.3'])){
                        $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$i]['NUMNIVELES'] = (String)($arrConstruccionesPrivativas['arrElementos'][$i][$arrConstruccionesPrivativas['arrIds'][$i]['e.2.1.n.3']]);
                       }
        
                       if(isset($arrConstruccionesPrivativas['arrIds'][$i]['e.2.1.n.4'])){
                           //Aqui usar SolicitarObtenerIdRangoNivelesByCodeAndAno(fechaAvaluo, codRangoNiveles)
                        $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$i]['IDRANGONIVELESEJERCICIO'] = (String)($arrConstruccionesPrivativas['arrElementos'][$i][$arrConstruccionesPrivativas['arrIds'][$i]['e.2.1.n.4']]);
                       }
        
                       if(isset($arrConstruccionesPrivativas['arrIds'][$i]['e.2.1.n.5'])){                
                        $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$i]['PUNTAJECLASIFICACION'] = (String)($arrConstruccionesPrivativas['arrElementos'][$i][$arrConstruccionesPrivativas['arrIds'][$i]['e.2.1.n.5']]);
                       }
        
                       if(isset($arrConstruccionesPrivativas['arrIds'][$i]['e.2.1.n.6'])){
                        $codClase = (String)($arrConstruccionesPrivativas['arrElementos'][$i][$arrConstruccionesPrivativas['arrIds'][$i]['e.2.1.n.6']]);
                           //Aqui usar SolicitarObtenerIdClasesByCodeAndAno(fechaAvaluo, codClase)               
                        $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$i]['IDCLASESEJERCICIO'] = (String)($arrConstruccionesPrivativas['arrElementos'][$i][$arrConstruccionesPrivativas['arrIds'][$i]['e.2.1.n.6']]);
                       }
        
                       if(isset($arrConstruccionesPrivativas['arrIds'][$i]['e.2.1.n.7'])){                               
                        $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$i]['EDAD'] = (String)($arrConstruccionesPrivativas['arrElementos'][$i][$arrConstruccionesPrivativas['arrIds'][$i]['e.2.1.n.7']]);
                       }
        
                       if(isset($arrConstruccionesPrivativas['arrIds'][$i]['e.2.1.n.8'])){
                        $idUsoEjercicio = $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$i]['IDUSOSEJERCICIO'];
                        $idClaseEjercicio = $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$i]['IDCLASESEJERCICIO'];
                        if($codClase != 'U'){
                            //•	En el caso de clase única (U), no se debe validar el campo e.2.1.n.8 - Vida útil total del tipo y  por tanto no existe la relación clase uso en la tabla fexava_usoClase
                            // AQUI USAR $catdt = ObtenerClaseUsoByIdUsoIdClase(idUsoEjercicio, idClaseEjercicio);
                            //if(count($catdt) > 0){
                                $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$i]['IDUSOCLASEEJERCICIO'] = (String)($arrConstruccionesPrivativas['arrElementos'][$i][$arrConstruccionesPrivativas['arrIds'][$i]['e.2.1.n.8']]);
                            //}                    
                        }                               
                        
                       }
        
                       if(isset($arrConstruccionesPrivativas['arrIds'][$i]['e.2.1.n.9'])){                               
                        $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$i]['VIDAUTILREMANENTE'] = (String)($arrConstruccionesPrivativas['arrElementos'][$i][$arrConstruccionesPrivativas['arrIds'][$i]['e.2.1.n.9']]);
                       }
        
                       if(isset($arrConstruccionesPrivativas['arrIds'][$i]['e.2.1.n.10'])){                               
                        $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$i]['CODESTADOCONSERVACION'] = (String)($arrConstruccionesPrivativas['arrElementos'][$i][$arrConstruccionesPrivativas['arrIds'][$i]['e.2.1.n.10']]);
                       }
        
                       if(isset($arrConstruccionesPrivativas['arrIds'][$i]['e.2.1.n.11'])){                               
                        $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$i]['SUPERFICIE'] = (String)($arrConstruccionesPrivativas['arrElementos'][$i][$arrConstruccionesPrivativas['arrIds'][$i]['e.2.1.n.11']]);
                       }
        
                       if(isset($arrConstruccionesPrivativas['arrIds'][$i]['e.2.1.n.12'])){                               
                        $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$i]['VALORUNITARIOREPNUEVO'] = (String)($arrConstruccionesPrivativas['arrElementos'][$i][$arrConstruccionesPrivativas['arrIds'][$i]['e.2.1.n.12']]);
                       }
        
                       $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$i]['CODTIPO'] = "P";
                }


            }

            /**********************************************Construcciones Comunes*****************************************/

            if(isset($arrPrincipalUsoActual['arrIds']['e.2.5'])){
                $construccionesComunes = $infoXmlTerreno->xpath($elementoPrincipal.'//DescripcionDelInmueble[@id="e"]//TiposDeConstruccion[@id="e.2"]//'.$arrPrincipalUsoActual['arrIds']['e.2.5'].'[@id="e.2.5"]');
                $arrConstruccionesComunes = $this->obtenElementos($construccionesComunes);
                if(count($camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION']) == 0){
                    $controlElemento = count($camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION']);
                }else{
                    $controlElemento = count($camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION']) - 1;
                }                       
                
                for($i=0;$i<count($construccionesComunes);$i++){
                    
                    $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$controlElemento] = array();

                    if(isset($arrConstruccionesComunes['arrIds'][$i]['e.2.5.n.1'])){
                        $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$controlElemento]['DESCRIPCION'] = (String)($arrConstruccionesComunes['arrElementos'][$i][$arrConstruccionesComunes['arrIds'][$i]['e.2.5.n.1']] );
                    }

                    if(isset($arrConstruccionesComunes['arrIds'][$i]['e.2.5.n.2'])){
                        $codUso = (String)($arrConstruccionesComunes['arrElementos'][$i][$arrConstruccionesComunes['arrIds'][$i]['e.2.5.n.2']]);
                        //Aqui usar SolicitarObtenerIdUsosByCodeAndAno(fechaAvaluo, codUso);
                        $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$controlElemento]['IDUSOSEJERCICIO'] = (String)($arrConstruccionesComunes['arrElementos'][$i][$arrConstruccionesComunes['arrIds'][$i]['e.2.5.n.2']]);
                    }

                    if(isset($arrConstruccionesComunes['arrIds'][$i]['e.2.5.n.3'])){
                        $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$controlElemento]['NUMNIVELES'] = (String)($arrConstruccionesComunes['arrElementos'][$i][$arrConstruccionesComunes['arrIds'][$i]['e.2.5.n.3']]);
                    }

                    if(isset($arrConstruccionesComunes['arrIds'][$i]['e.2.5.n.4'])){
                        $codRangoNiveles = (String)($arrConstruccionesComunes['arrElementos'][$i][$arrConstruccionesComunes['arrIds'][$i]['e.2.5.n.4']]);
                        //Aqui usar SolicitarObtenerIdRangoNivelesByCodeAndAno(fechaAvaluo, codRangoNiveles);
                        $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$controlElemento]['IDRANGONIVELESEJERCICIO'] = (String)($arrConstruccionesComunes['arrElementos'][$i][$arrConstruccionesComunes['arrIds'][$i]['e.2.5.n.4']]);
                    }

                    if(isset($arrConstruccionesComunes['arrIds'][$i]['e.2.5.n.5'])){
                        $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$controlElemento]['PUNTAJECLASIFICACION'] = (String)($arrConstruccionesComunes['arrElementos'][$i][$arrConstruccionesComunes['arrIds'][$i]['e.2.5.n.5']]);
                    }

                    if(isset($arrConstruccionesComunes['arrIds'][$i]['e.2.5.n.6'])){
                        $codClase = (String)($arrConstruccionesComunes['arrElementos'][$i][$arrConstruccionesComunes['arrIds'][$i]['e.2.5.n.6']]);
                        //Aqui usar SolicitarObtenerIdClasesByCodeAndAno(fechaAvaluo, codClase);
                        $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$controlElemento]['IDCLASESEJERCICIO'] = (String)($arrConstruccionesComunes['arrElementos'][$i][$arrConstruccionesComunes['arrIds'][$i]['e.2.5.n.6']]);
                    }
                    
                    if(isset($arrConstruccionesComunes['arrIds'][$i]['e.2.5.n.7'])){
                        $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$controlElemento]['EDAD'] = (String)($arrConstruccionesComunes['arrElementos'][$i][$arrConstruccionesComunes['arrIds'][$i]['e.2.5.n.7']]);
                    }
                    
                    if(isset($arrConstruccionesComunes['arrIds'][$i]['e.2.5.n.8'])){                    
                        $idUsoEjercicio = $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$controlElemento]['IDUSOSEJERCICIO'];
                        $idClaseEjercicio = $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$controlElemento]['IDCLASESEJERCICIO'];
                        if($codClase != 'U'){
                            //•	En el caso de clase única (U), no se debe validar el campo e.2.1.n.8 - Vida útil total del tipo y  por tanto no existe la relación clase uso en la tabla fexava_usoClase
                            //AQUI USAR $catdt = ObtenerClaseUsoByIdUsoIdClase(idUsoEjercicio, idClaseEjercicio);
                            //if(count($catdt) > 0){
                                $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$controlElemento]['IDUSOCLASEEJERCICIO'] = (String)($arrConstruccionesComunes['arrElementos'][$i][$arrConstruccionesComunes['arrIds'][$i]['e.2.5.n.8']]);
                            //}
                        }
                    }
                    if(isset($arrConstruccionesComunes['arrIds'][$i]['e.2.5.n.9'])){
                        $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$controlElemento]['VIDAUTILREMANENTE'] = (String)($arrConstruccionesComunes['arrElementos'][$i][$arrConstruccionesComunes['arrIds'][$i]['e.2.5.n.9']]);
                    }

                    if(isset($arrConstruccionesComunes['arrIds'][$i]['e.2.5.n.10'])){
                        $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$controlElemento]['CODESTADOCONSERVACION'] = (String)($arrConstruccionesComunes['arrElementos'][$i][$arrConstruccionesComunes['arrIds'][$i]['e.2.5.n.10']]);
                    }

                    if(isset($arrConstruccionesComunes['arrIds'][$i]['e.2.5.n.11'])){
                        $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$controlElemento]['SUPERFICIE'] = (String)($arrConstruccionesComunes['arrElementos'][$i][$arrConstruccionesComunes['arrIds'][$i]['e.2.5.n.11']]);
                    }

                    if(isset($arrConstruccionesComunes['arrIds'][$i]['e.2.5.n.12'])){
                        $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$controlElemento]['VALORUNITARIOREPNUEVO'] = (String)($arrConstruccionesComunes['arrElementos'][$i][$arrConstruccionesComunes['arrIds'][$i]['e.2.5.n.12']]);
                    }

                    if(isset($arrConstruccionesComunes['arrIds'][$i]['e.2.5.n.18'])){
                        $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$controlElemento]['TEINDIVISO'] = (String)($arrConstruccionesComunes['arrElementos'][$i][$arrConstruccionesComunes['arrIds'][$i]['e.2.5.n.12']]);
                    }

                    $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'][$controlElemento]['CODTIPO'] = "C";
                    $controlElemento = $controlElemento + 1;
                }                

            }

            /*********************************************************************************************************************/

            if(isset($arrPrincipalUsoActual['arrIds']['e.2.3'])){
                $valorTotalDeConstruccionesPrivativas = $infoXmlTerreno->xpath($elementoPrincipal.'//DescripcionDelInmueble[@id="e"]//ValorTotalDeConstruccionesPrivativas[@id="e.2.3"]');
                if(trim($valorTotalDeConstruccionesPrivativas[0]) != ''){
                    $camposFexavaAvaluo['DIVALORTOTALCONSPRIVATIVAS'] = (String)($valorTotalDeConstruccionesPrivativas[0]);
                }
            }

            if(isset($arrPrincipalUsoActual['arrIds']['e.2.7'])){
                $valorTotalDeConstruccionesComunes = $infoXmlTerreno->xpath($elementoPrincipal.'//DescripcionDelInmueble[@id="e"]//ValorTotalDeConstruccionesComunes[@id="e.2.7"]');
                if(trim($valorTotalDeConstruccionesComunes[0]) != ''){
                    $camposFexavaAvaluo['DIVALORTOTALCONSTCOMUNES'] = (String)($valorTotalDeConstruccionesComunes[0]);
                }
            }        
        }

        if(isset($arrIdsDescripcionDelInmueble['e.3'])){
            $vidaUtilTotalPonderadaDelInmueble = $infoXmlTerreno->xpath($elementoPrincipal.'//DescripcionDelInmueble[@id="e"]//VidaUtilTotalPonderadaDelInmueble[@id="e.3"]');

            if(trim($vidaUtilTotalPonderadaDelInmueble[0]) != ''){
                $camposFexavaAvaluo['DIVIDAUTILPONDERADA'] = (String)($vidaUtilTotalPonderadaDelInmueble[0]);
            }
        }

        if(isset($arrIdsDescripcionDelInmueble['e.4'])){
            $edadPonderadaDelInmueble = $infoXmlTerreno->xpath($elementoPrincipal.'//DescripcionDelInmueble[@id="e"]//EdadPonderadaDelInmueble[@id="e.4"]');
            
            if(trim($edadPonderadaDelInmueble[0]) != ''){
                $camposFexavaAvaluo['DIEDADPONDERADA'] = (String)($edadPonderadaDelInmueble[0]);
            }
        }

        if(isset($arrIdsDescripcionDelInmueble['e.5'])){
            $vidaUtilRemanentePonderadaDelInmueble = $infoXmlTerreno->xpath($elementoPrincipal.'//DescripcionDelInmueble[@id="e"]//VidaUtilRemanentePonderadaDelInmueble[@id="e.5"]');
            
            if(trim($vidaUtilRemanentePonderadaDelInmueble[0]) != ''){
                $camposFexavaAvaluo['DIVIDAUTILREMANENTEPONDERADA'] = (String)($vidaUtilRemanentePonderadaDelInmueble[0]);
            }
        }

        if(isset($arrIdsDescripcionDelInmueble['e.6'])){
            $porcentSuperfUltimNivelRespectoAnterior = $infoXmlTerreno->xpath($elementoPrincipal.'//DescripcionDelInmueble[@id="e"]//PorcentSuperfUltimNivelRespectoAnterior[@id="e.6"]');
            
            if(trim($porcentSuperfUltimNivelRespectoAnterior[0]) != ''){
                $camposFexavaAvaluo['DIPORCENTAJESUPULTNIVEL'] = (String)($porcentSuperfUltimNivelRespectoAnterior[0]);
            }
        }

        return $camposFexavaAvaluo;

    }

    public function guardarAvaluoElementosConstruccion($infoXmlElementosConst, $camposFexavaAvaluo,$elementoPrincipal){

        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST'] = array();

        $elementosConst = $infoXmlElementosConst->xpath($elementoPrincipal.'//ElementosDeLaConstruccion[@id="f"]');
        
        $errores = valida_AvaluoElementosDeLaConstruccion($elementosConst, $elementoPrincipal);    
        if(count($errores) > 0){
            return array('ERROR' => $errores);
        }
        
        $arrPrincipalElementosConst = $this->obtenElementosPrincipal($elementosConst);       

        if(isset($arrPrincipalElementosConst['arrIds']['f.1']) && count($arrPrincipalElementosConst['arrElementos'][$arrPrincipalElementosConst['arrIds']['f.1']]) > 0){
            $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_OBRANEGRA'] = array();
            $obraNegra = $infoXmlElementosConst->xpath($elementoPrincipal.'//ElementosDeLaConstruccion[@id="f"]//'.$arrPrincipalElementosConst['arrIds']['f.1'].'[@id="f.1"]');
            $arrObraNegra = $this->obtenElementosPrincipal($obraNegra);
            //print_r($arrObraNegra); exit();
            if(isset($arrObraNegra['arrIds']['f.1.1'])){
                $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_OBRANEGRA']['CIMENTACION'] = (String)($arrObraNegra['arrElementos'][$arrObraNegra['arrIds']['f.1.1']]);
            }

            if(isset($arrObraNegra['arrIds']['f.1.2'])){
                $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_OBRANEGRA']['ESTRUCTURA'] = (String)($arrObraNegra['arrElementos'][$arrObraNegra['arrIds']['f.1.2']]);
            }

            if(isset($arrObraNegra['arrIds']['f.1.3'])){
                $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_OBRANEGRA']['MUROS'] = (String)($arrObraNegra['arrElementos'][$arrObraNegra['arrIds']['f.1.3']]);
            }

            if(isset($arrObraNegra['arrIds']['f.1.4'])){
                $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_OBRANEGRA']['ENTREPISOS'] = (String)($arrObraNegra['arrElementos'][$arrObraNegra['arrIds']['f.1.4']]);
            }

            if(isset($arrObraNegra['arrIds']['f.1.5'])){
                $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_OBRANEGRA']['TECHOS'] = (String)($arrObraNegra['arrElementos'][$arrObraNegra['arrIds']['f.1.5']]);
            }

            if(isset($arrObraNegra['arrIds']['f.1.6'])){
                $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_OBRANEGRA']['AZOTEAS'] = (String)($arrObraNegra['arrElementos'][$arrObraNegra['arrIds']['f.1.6']]);
            }

            if(isset($arrObraNegra['arrIds']['f.1.7'])){
                $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_OBRANEGRA']['BARDAS'] = (String)($arrObraNegra['arrElementos'][$arrObraNegra['arrIds']['f.1.7']]);
            }
        }

        /*************************************************************Revestimientos***************************************************************/

        if(isset($arrPrincipalElementosConst['arrIds']['f.2']) && count($arrPrincipalElementosConst['arrElementos'][$arrPrincipalElementosConst['arrIds']['f.2']]) > 0){
            $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_REVESTIMIENTOACABADO'] = array();
            $obraRevestimientos = $infoXmlElementosConst->xpath($elementoPrincipal.'//ElementosDeLaConstruccion[@id="f"]//'.$arrPrincipalElementosConst['arrIds']['f.2'].'[@id="f.2"]');
            $arrRevestimientos = $this->obtenElementosPrincipal($obraRevestimientos);

            if(isset($arrRevestimientos['arrIds']['f.2.1'])){
                $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_REVESTIMIENTOACABADO']['APLANADOS'] = (String)($arrRevestimientos['arrElementos'][$arrRevestimientos['arrIds']['f.2.1']]);
            }

            if(isset($arrRevestimientos['arrIds']['f.2.2'])){
                $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_REVESTIMIENTOACABADO']['PLAFONES'] = (String)($arrRevestimientos['arrElementos'][$arrRevestimientos['arrIds']['f.2.2']]);
            }

            if(isset($arrRevestimientos['arrIds']['f.2.3'])){
                $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_REVESTIMIENTOACABADO']['LAMBRINES'] = (String)($arrRevestimientos['arrElementos'][$arrRevestimientos['arrIds']['f.2.3']]);
            }

            if(isset($arrRevestimientos['arrIds']['f.2.4'])){
                $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_REVESTIMIENTOACABADO']['PISOS'] = (String)($arrRevestimientos['arrElementos'][$arrRevestimientos['arrIds']['f.2.4']]);
            }

            if(isset($arrRevestimientos['arrIds']['f.2.5'])){
                $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_REVESTIMIENTOACABADO']['ZOCLOS'] = (String)($arrRevestimientos['arrElementos'][$arrRevestimientos['arrIds']['f.2.5']]);
            }

            if(isset($arrRevestimientos['arrIds']['f.2.6'])){
                $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_REVESTIMIENTOACABADO']['ESCALERAS'] = (String)($arrRevestimientos['arrElementos'][$arrRevestimientos['arrIds']['f.2.6']]);
            }

            if(isset($arrRevestimientos['arrIds']['f.2.7'])){
                $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_REVESTIMIENTOACABADO']['PINTURA'] = (String)($arrRevestimientos['arrElementos'][$arrRevestimientos['arrIds']['f.2.7']]);
            }

            if(isset($arrRevestimientos['arrIds']['f.2.8'])){
                $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_REVESTIMIENTOACABADO']['RECUBRIMIENTOSESPECIALES'] = (String)($arrRevestimientos['arrElementos'][$arrRevestimientos['arrIds']['f.2.8']]);
            }
        }

        /*************************************************************Carpinteria***************************************************************/

        if(isset($arrPrincipalElementosConst['arrIds']['f.3']) && count($arrPrincipalElementosConst['arrElementos'][$arrPrincipalElementosConst['arrIds']['f.3']]) > 0){
                $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_CARPINTERIA'] = array();
                $carpinteria = $infoXmlElementosConst->xpath($elementoPrincipal.'//ElementosDeLaConstruccion[@id="f"]//'.$arrPrincipalElementosConst['arrIds']['f.3'].'[@id="f.3"]');
                $arrCarpinteria = $this->obtenElementosPrincipal($carpinteria);

            if(isset($arrCarpinteria['arrIds']['f.3.1'])){
                $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_CARPINTERIA']['PUERTASINTERIORES'] = (String)($arrCarpinteria['arrElementos'][$arrCarpinteria['arrIds']['f.3.1']]);
            }

            if(isset($arrCarpinteria['arrIds']['f.3.2'])){
                $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_CARPINTERIA']['GUARDAROPAS'] = (String)($arrCarpinteria['arrElementos'][$arrCarpinteria['arrIds']['f.3.2']]);
            }

            if(isset($arrCarpinteria['arrIds']['f.3.3'])){
                $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_CARPINTERIA']['MUEBLESEMPOTRADOSFIJOS'] = (String)($arrCarpinteria['arrElementos'][$arrCarpinteria['arrIds']['f.3.3']]);
            }

        }

        /************************************************************Instalaciones hidráulicas y sanitrias***************************************************************/
            
        if(isset($arrPrincipalElementosConst['arrIds']['f.4']) && count($arrPrincipalElementosConst['arrElementos'][$arrPrincipalElementosConst['arrIds']['f.4']]) > 0){
            $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_INSTALACIONHIDSAN'] = array();
            $hidraulicos = $infoXmlElementosConst->xpath($elementoPrincipal.'//ElementosDeLaConstruccion[@id="f"]//'.$arrPrincipalElementosConst['arrIds']['f.4'].'[@id="f.4"]');
            $arrHidraulicos = $this->obtenElementosPrincipal($hidraulicos);

            if(isset($arrHidraulicos['arrIds']['f.4.1'])){
                $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_INSTALACIONHIDSAN']['MUEBLESBANO'] = (String)($arrHidraulicos['arrElementos'][$arrHidraulicos['arrIds']['f.4.1']]);
            }

            if(isset($arrHidraulicos['arrIds']['f.4.2'])){
                $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_INSTALACIONHIDSAN']['RAMALEOSHIDRAULICOS'] = (String)($arrHidraulicos['arrElementos'][$arrHidraulicos['arrIds']['f.4.2']]);
            }

            if(isset($arrHidraulicos['arrIds']['f.4.3'])){
                $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_INSTALACIONHIDSAN']['RAMALEOSSANITARIOS'] = (String)($arrHidraulicos['arrElementos'][$arrHidraulicos['arrIds']['f.4.3']]);
            }

        }

        /*********************************************Instalaciones Especiales y alumbrado**********************************************************************/
    
        if(isset($arrPrincipalElementosConst['arrIds']['f.16'])){
            $electricas = $infoXmlElementosConst->xpath($elementoPrincipal.'//ElementosDeLaConstruccion[@id="f"]//InstalacionesElectricasYAlumbrado[@id="f.16"]');    
            $camposFexavaAvaluo['IEYALUMBRADO'] = (String)($electricas[0]);
        }

        /*********************************************Puertas y ventanería metálica**********************************************************************/

        if(isset($arrPrincipalElementosConst['arrIds']['f.5']) && count($arrPrincipalElementosConst['arrElementos'][$arrPrincipalElementosConst['arrIds']['f.5']]) > 0){
            $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_PUERTASYVENTANERIA'] = array();
            $puertasYVentanas = $infoXmlElementosConst->xpath($elementoPrincipal.'//ElementosDeLaConstruccion[@id="f"]//'.$arrPrincipalElementosConst['arrIds']['f.5'].'[@id="f.5"]');
            $arrPuertasYVentanas = $this->obtenElementosPrincipal($puertasYVentanas);

            if(isset($arrPuertasYVentanas['arrIds']['f.5.1'])){
                $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_PUERTASYVENTANERIA']['HERRERIA'] = (String)($arrPuertasYVentanas['arrElementos'][$arrPuertasYVentanas['arrIds']['f.5.1']]);
            }

            if(isset($arrPuertasYVentanas['arrIds']['f.5.2'])){
                $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_PUERTASYVENTANERIA']['VENTANERIA'] = (String)($arrPuertasYVentanas['arrElementos'][$arrPuertasYVentanas['arrIds']['f.5.2']]);
            }    

        }

        /**********************************************************************************************************************************************************/

        if(isset($arrPrincipalElementosConst['arrIds']['f.6'])){
            $electricas = $infoXmlElementosConst->xpath($elementoPrincipal.'//ElementosDeLaConstruccion[@id="f"]//Vidreria[@id="f.6"]');    
            $camposFexavaAvaluo['VIDRERIA'] = (String)($electricas[0]);
        }

        if(isset($arrPrincipalElementosConst['arrIds']['f.7'])){
            $cerrajeria = $infoXmlElementosConst->xpath($elementoPrincipal.'//ElementosDeLaConstruccion[@id="f"]//Cerrajeria[@id="f.7"]');    
            $camposFexavaAvaluo['CERRAJERIA'] = (String)($cerrajeria[0]);
        }

        if(isset($arrPrincipalElementosConst['arrIds']['f.8'])){
            $fachadas = $infoXmlElementosConst->xpath($elementoPrincipal.'//ElementosDeLaConstruccion[@id="f"]//Fachadas[@id="f.8"]');    
            $camposFexavaAvaluo['FACHADAS'] = (String)($fachadas[0]);
        }

        
        if(isset($arrPrincipalElementosConst['arrIds']['f.9']) && count($arrPrincipalElementosConst['arrElementos'][$arrPrincipalElementosConst['arrIds']['f.9']]) > 0){
            $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'] = array();
            $elementosExtra = $infoXmlElementosConst->xpath($elementoPrincipal.'//ElementosDeLaConstruccion[@id="f"]//'.$arrPrincipalElementosConst['arrIds']['f.9'].'[@id="f.9"]');
            $arrPrincipalElementosExtra = $this->obtenElementosPrincipal($elementosExtra);
            //print_r($camposFexavaAvaluo); exit();
            /********************************************************Instalaciones Especiales. Privativas******************************************************************/
            if(isset($arrPrincipalElementosExtra['arrIds']['f.9.1'])){

                $instalacionesEspeciales = $infoXmlElementosConst->xpath($elementoPrincipal.'//ElementosDeLaConstruccion[@id="f"]//InstalacionesEspeciales[@id="f.9"]//'.$arrPrincipalElementosExtra['arrIds']['f.9.1'].'[@id="f.9.1"]');
                $arrInstalacionesEspeciales = $this->obtenElementos($instalacionesEspeciales);
                //print_r($arrInstalacionesEspeciales); exit();                           
                
                for($i=0;$i<count($instalacionesEspeciales);$i++){
                    $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$i] = array();
                    //print_r($arrInstalacionesEspeciales); exit();
                    if(isset($arrInstalacionesEspeciales['arrIds'][$i]['f.9.1.n.1'])){
                        $claveInstEsp = (String)($arrInstalacionesEspeciales['arrElementos'][$i][$arrInstalacionesEspeciales['arrIds'][$i]['f.9.1.n.1']]);
                        //AQUI UTILIZAR codInstEsp = CatastralUtils.ObtenerInstEspecialByClave(claveInstEsp).CODINSTESPECIALES;
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$i]['CODINSTALACIONESESPECIALES'] = (String)($arrInstalacionesEspeciales['arrElementos'][$i][$arrInstalacionesEspeciales['arrIds'][$i]['f.9.1.n.1']]);
                    }

                    if(isset($arrInstalacionesEspeciales['arrIds'][$i]['f.9.1.n.3'])){
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$i]['UNIDAD'] = (String)($arrInstalacionesEspeciales['arrElementos'][$i][$arrInstalacionesEspeciales['arrIds'][$i]['f.9.1.n.3']]);
                    }

                    if(isset($arrInstalacionesEspeciales['arrIds'][$i]['f.9.1.n.4'])){
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$i]['CANTIDAD'] = (String)($arrInstalacionesEspeciales['arrElementos'][$i][$arrInstalacionesEspeciales['arrIds'][$i]['f.9.1.n.4']]);
                    }

                    if(isset($arrInstalacionesEspeciales['arrIds'][$i]['f.9.1.n.5'])){
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$i]['EDAD'] = (String)($arrInstalacionesEspeciales['arrElementos'][$i][$arrInstalacionesEspeciales['arrIds'][$i]['f.9.1.n.5']]);
                    }

                    if(isset($arrInstalacionesEspeciales['arrIds'][$i]['f.9.1.n.7'])){
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$i]['VALORUNITARIO'] = (String)($arrInstalacionesEspeciales['arrElementos'][$i][$arrInstalacionesEspeciales['arrIds'][$i]['f.9.1.n.7']]);
                    }

                    $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$i]['CODTIPO'] = "C";
                    $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$i]['IDAVALUO'] = $camposFexavaAvaluo['IDAVALUO'];
                }                
            }

            /********************************************************Instalaciones Especiales. Comunes******************************************************************/

            if(isset($arrPrincipalElementosExtra['arrIds']['f.9.2'])){
                $instalacionesEspecialesComunes = $infoXmlElementosConst->xpath($elementoPrincipal.'//ElementosDeLaConstruccion[@id="f"]//InstalacionesEspeciales[@id="f.9"]//'.$arrPrincipalElementosExtra['arrIds']['f.9.2'].'[@id="f.9.2"]');
                $arrInstalacionesEspecialesComunes = $this->obtenElementos($instalacionesEspecialesComunes);
                //print_r($arrInstalacionesEspecialesComunes); exit();

                    $controlElemento = count($camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA']) - 1;                         
                
                for($i=0;$i<count($instalacionesEspecialesComunes);$i++){
                    $controlElemento = $controlElemento+1;
                    $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento] = array();
                    //print_r($arrInstalacionesEspecialesComunes); exit();
                    if(isset($arrInstalacionesEspecialesComunes['arrIds'][$i]['f.9.2.n.1'])){
                        $claveInstEsp = (String)($arrInstalacionesEspecialesComunes['arrElementos'][$i][$arrInstalacionesEspecialesComunes['arrIds'][$i]['f.9.2.n.1']]);
                        //AQUI UTILIZAR codInstEsp = CatastralUtils.ObtenerInstEspecialByClave(claveInstEsp).CODINSTESPECIALES;
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['CODINSTALACIONESESPECIALES'] = (String)($arrInstalacionesEspecialesComunes['arrElementos'][$i][$arrInstalacionesEspecialesComunes['arrIds'][$i]['f.9.2.n.1']]);
                    }

                    if(isset($arrInstalacionesEspecialesComunes['arrIds'][$i]['f.9.2.n.3'])){
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['UNIDAD'] = (String)($arrInstalacionesEspecialesComunes['arrElementos'][$i][$arrInstalacionesEspecialesComunes['arrIds'][$i]['f.9.2.n.3']]);
                    }

                    if(isset($arrInstalacionesEspecialesComunes['arrIds'][$i]['f.9.2.n.4'])){
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['CANTIDAD'] = (String)($arrInstalacionesEspecialesComunes['arrElementos'][$i][$arrInstalacionesEspecialesComunes['arrIds'][$i]['f.9.2.n.4']]);
                    }

                    if(isset($arrInstalacionesEspecialesComunes['arrIds'][$i]['f.9.2.n.5'])){
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['EDAD'] = (String)($arrInstalacionesEspecialesComunes['arrElementos'][$i][$arrInstalacionesEspecialesComunes['arrIds'][$i]['f.9.2.n.5']]);
                    }

                    if(isset($arrInstalacionesEspecialesComunes['arrIds'][$i]['f.9.2.n.7'])){
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['VALORUNITARIO'] = (String)($arrInstalacionesEspecialesComunes['arrElementos'][$i][$arrInstalacionesEspecialesComunes['arrIds'][$i]['f.9.2.n.7']]);
                    }

                    if(isset($arrInstalacionesEspecialesComunes['arrIds'][$i]['f.9.2.n.10'])){
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['TEINDIVISO'] = (String)($arrInstalacionesEspecialesComunes['arrElementos'][$i][$arrInstalacionesEspecialesComunes['arrIds'][$i]['f.9.2.n.10']]);
                    }

                    $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['CODTIPO'] = "P";
                    $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['IDAVALUO'] = $camposFexavaAvaluo['IDAVALUO'];
                    
                }               
            }
        }     
                           

        if(isset($arrPrincipalElementosConst['arrIds']['f.10']) && count($arrPrincipalElementosConst['arrElementos'][$arrPrincipalElementosConst['arrIds']['f.10']]) > 0){
            /********************************************************Elementos Accesorios. Privativas******************************************************************/
            if(!isset($camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'])){
                $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'] = array();
            }

            $elementosExtra = $infoXmlElementosConst->xpath($elementoPrincipal.'//ElementosDeLaConstruccion[@id="f"]//'.$arrPrincipalElementosConst['arrIds']['f.10'].'[@id="f.10"]');
            $arrPrincipalElementosExtra = $this->obtenElementosPrincipal($elementosExtra);
            //print_r($arrPrincipalElementosExtra); exit();
            if(isset($arrPrincipalElementosExtra['arrIds']['f.10.1'])){

                $accesoriosPrivativas = $infoXmlElementosConst->xpath($elementoPrincipal.'//ElementosDeLaConstruccion[@id="f"]//'.$arrPrincipalElementosConst['arrIds']['f.10'].'[@id="f.10"]//'.$arrPrincipalElementosExtra['arrIds']['f.10.1'].'[@id="f.10.1"]');
                $arrAccesoriosPrivativas = $this->obtenElementos($accesoriosPrivativas);                                   
                $controlElemento = count($camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA']) - 1;                                          
                
                for($i=0;$i<count($accesoriosPrivativas);$i++){
                    $controlElemento = $controlElemento+1;
                    $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento] = array();
                    //print_r($arrAccesoriosPrivativas); exit();
                    if(isset($arrAccesoriosPrivativas['arrIds'][$i]['f.10.1.n.1'])){
                        $claveInstEsp = (String)($arrAccesoriosPrivativas['arrElementos'][$i][$arrAccesoriosPrivativas['arrIds'][$i]['f.10.1.n.1']]);
                        //AQUI UTILIZAR codInstEsp = CatastralUtils.ObtenerInstEspecialByClave(claveInstEsp).CODINSTESPECIALES;
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['CODINSTALACIONESESPECIALES'] = (String)($arrAccesoriosPrivativas['arrElementos'][$i][$arrAccesoriosPrivativas['arrIds'][$i]['f.10.1.n.1']]);
                    }

                    if(isset($arrAccesoriosPrivativas['arrIds'][$i]['f.10.1.n.3'])){
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['UNIDAD'] = (String)($arrAccesoriosPrivativas['arrElementos'][$i][$arrAccesoriosPrivativas['arrIds'][$i]['f.10.1.n.3']]);
                    }

                    if(isset($arrAccesoriosPrivativas['arrIds'][$i]['f.10.1.n.4'])){
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['CANTIDAD'] = (String)($arrAccesoriosPrivativas['arrElementos'][$i][$arrAccesoriosPrivativas['arrIds'][$i]['f.10.1.n.4']]);
                    }

                    if(isset($arrAccesoriosPrivativas['arrIds'][$i]['f.10.1.n.5'])){
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['EDAD'] = (String)($arrAccesoriosPrivativas['arrElementos'][$i][$arrAccesoriosPrivativas['arrIds'][$i]['f.10.1.n.5']]);
                    }

                    if(isset($arrAccesoriosPrivativas['arrIds'][$i]['f.10.1.n.7'])){
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['VALORUNITARIO'] = (String)($arrAccesoriosPrivativas['arrElementos'][$i][$arrAccesoriosPrivativas['arrIds'][$i]['f.10.1.n.7']]);
                    }

                    $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['CODTIPO'] = "P";
                    $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['IDAVALUO'] = $camposFexavaAvaluo['IDAVALUO'];
                }                
            }

            /********************************************************Elementos Accesorios. Comunes******************************************************************/

            if(isset($arrPrincipalElementosExtra['arrIds']['f.10.2'])){                
                $accesoriosComunes = $infoXmlElementosConst->xpath($elementoPrincipal.'//ElementosDeLaConstruccion[@id="f"]//'.$arrPrincipalElementosConst['arrIds']['f.10'].'[@id="f.10"]//'.$arrPrincipalElementosExtra['arrIds']['f.10.2'].'[@id="f.10.2"]');
                $arrAccesoriosComunes = $this->obtenElementos($accesoriosComunes);                
                $controlElemento = count($camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA']) - 1;                                      
                
                for($i=0;$i<count($accesoriosComunes);$i++){
                    $controlElemento = $controlElemento+1;
                    $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento] = array();
                    //print_r($arrAccesoriosComunes); exit();
                    if(isset($arrAccesoriosComunes['arrIds'][$i]['f.10.2.n.1'])){
                        $claveInstEsp = (String)($arrAccesoriosComunes['arrElementos'][$i][$arrAccesoriosComunes['arrIds'][$i]['f.10.2.n.1']]);
                        //AQUI UTILIZAR codInstEsp = CatastralUtils.ObtenerInstEspecialByClave(claveInstEsp).CODINSTESPECIALES;
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['CODINSTALACIONESESPECIALES'] = (String)($arrAccesoriosComunes['arrElementos'][$i][$arrAccesoriosComunes['arrIds'][$i]['f.10.2.n.1']]);
                    }

                    if(isset($arrAccesoriosComunes['arrIds'][$i]['f.10.2.n.3'])){
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['UNIDAD'] = (String)($arrAccesoriosComunes['arrElementos'][$i][$arrAccesoriosComunes['arrIds'][$i]['f.10.2.n.3']]);
                    }

                    if(isset($arrAccesoriosComunes['arrIds'][$i]['f.10.2.n.4'])){
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['CANTIDAD'] = (String)($arrAccesoriosComunes['arrElementos'][$i][$arrAccesoriosComunes['arrIds'][$i]['f.10.2.n.4']]);
                    }

                    if(isset($arrAccesoriosComunes['arrIds'][$i]['f.10.2.n.5'])){
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['EDAD'] = (String)($arrAccesoriosComunes['arrElementos'][$i][$arrAccesoriosComunes['arrIds'][$i]['f.10.2.n.5']]);
                    }

                    if(isset($arrAccesoriosComunes['arrIds'][$i]['f.10.2.n.7'])){
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['VALORUNITARIO'] = (String)($arrAccesoriosComunes['arrElementos'][$i][$arrAccesoriosComunes['arrIds'][$i]['f.10.2.n.7']]);
                    }

                    if(isset($arrAccesoriosComunes['arrIds'][$i]['f.10.2.n.10'])){
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['TEINDIVISO'] = (String)($arrAccesoriosComunes['arrElementos'][$i][$arrAccesoriosComunes['arrIds'][$i]['f.10.2.n.10']]);
                    }

                    $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['CODTIPO'] = "C";
                    $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['IDAVALUO'] = $camposFexavaAvaluo['IDAVALUO'];                    
                }               
            }
        }

        if(isset($arrPrincipalElementosConst['arrIds']['f.11']) && count($arrPrincipalElementosConst['arrElementos'][$arrPrincipalElementosConst['arrIds']['f.11']]) > 0){
            /********************************************************Obras Complementarias. Privativas******************************************************************/
            if(!isset($camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'])){
                $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'] = array();
            }
            $elementosExtra = $infoXmlElementosConst->xpath($elementoPrincipal.'//ElementosDeLaConstruccion[@id="f"]//'.$arrPrincipalElementosConst['arrIds']['f.11'].'[@id="f.11"]');
            $arrPrincipalElementosExtra = $this->obtenElementosPrincipal($elementosExtra);
            //print_r($arrPrincipalElementosExtra); exit();
            if(isset($arrPrincipalElementosExtra['arrIds']['f.11.1'])){

                $obrasComplementariasPrivativas = $infoXmlElementosConst->xpath($elementoPrincipal.'//ElementosDeLaConstruccion[@id="f"]//'.$arrPrincipalElementosConst['arrIds']['f.11'].'[@id="f.11"]//'.$arrPrincipalElementosExtra['arrIds']['f.11.1'].'[@id="f.11.1"]');
                $arrObrasComplementariasPrivativas = $this->obtenElementos($obrasComplementariasPrivativas);
                                   
                    $controlElemento = count($camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA']) - 1;                                          
                
                for($i=0;$i<count($accesoriosPrivativas);$i++){
                    $controlElemento = $controlElemento+1;
                    $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento] = array();
                    //print_r($arrObrasComplementariasPrivativas); exit();
                    if(isset($arrObrasComplementariasPrivativas['arrIds'][$i]['f.11.1.n.1'])){
                        $claveInstEsp = (String)($arrObrasComplementariasPrivativas['arrElementos'][$i][$arrObrasComplementariasPrivativas['arrIds'][$i]['f.11.1.n.1']]);
                        //AQUI UTILIZAR codInstEsp = CatastralUtils.ObtenerInstEspecialByClave(claveInstEsp).CODINSTESPECIALES;
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['CODINSTALACIONESESPECIALES'] = (String)($arrObrasComplementariasPrivativas['arrElementos'][$i][$arrObrasComplementariasPrivativas['arrIds'][$i]['f.11.1.n.1']]);
                    }

                    if(isset($arrObrasComplementariasPrivativas['arrIds'][$i]['f.11.1.n.3'])){
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['UNIDAD'] = (String)($arrObrasComplementariasPrivativas['arrElementos'][$i][$arrObrasComplementariasPrivativas['arrIds'][$i]['f.11.1.n.3']]);
                    }

                    if(isset($arrObrasComplementariasPrivativas['arrIds'][$i]['f.11.1.n.4'])){
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['CANTIDAD'] = (String)($arrObrasComplementariasPrivativas['arrElementos'][$i][$arrObrasComplementariasPrivativas['arrIds'][$i]['f.11.1.n.4']]);
                    }

                    if(isset($arrObrasComplementariasPrivativas['arrIds'][$i]['f.11.1.n.5'])){
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['EDAD'] = (String)($arrObrasComplementariasPrivativas['arrElementos'][$i][$arrObrasComplementariasPrivativas['arrIds'][$i]['f.11.1.n.5']]);
                    }

                    if(isset($arrObrasComplementariasPrivativas['arrIds'][$i]['f.11.1.n.7'])){
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['VALORUNITARIO'] = (String)($arrObrasComplementariasPrivativas['arrElementos'][$i][$arrObrasComplementariasPrivativas['arrIds'][$i]['f.11.1.n.7']]);
                    }

                    $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['CODTIPO'] = "P";
                    $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['IDAVALUO'] = $camposFexavaAvaluo['IDAVALUO'];
                }                
            }

            /********************************************************Obras Complementarias. Comunes******************************************************************/

            if(isset($arrPrincipalElementosExtra['arrIds']['f.11.2'])){

                $obrasComplementariasComunes = $infoXmlElementosConst->xpath($elementoPrincipal.'//ElementosDeLaConstruccion[@id="f"]//'.$arrPrincipalElementosConst['arrIds']['f.11'].'[@id="f.11"]//'.$arrPrincipalElementosExtra['arrIds']['f.11.2'].'[@id="f.11.2"]');
                $arrObrasComplementariasComunes = $this->obtenElementos($obrasComplementariasComunes);
                //print_r($arrObrasComplementariasComunes); exit();                   
                $controlElemento = count($camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA']) - 1;                                          
                
                for($i=0;$i<count($obrasComplementariasComunes);$i++){
                    $controlElemento = $controlElemento+1;
                    $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento] = array();                    
                    if(isset($arrObrasComplementariasComunes ['arrIds'][$i]['f.11.2.n.1'])){
                        $claveInstEsp = (String)($arrObrasComplementariasComunes ['arrElementos'][$i][$arrObrasComplementariasComunes ['arrIds'][$i]['f.11.2.n.1']]);
                        //AQUI UTILIZAR codInstEsp = CatastralUtils.ObtenerInstEspecialByClave(claveInstEsp).CODINSTESPECIALES;
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['CODINSTALACIONESESPECIALES'] = (String)($arrObrasComplementariasComunes ['arrElementos'][$i][$arrObrasComplementariasComunes ['arrIds'][$i]['f.11.2.n.1']]);
                    }

                    if(isset($arrObrasComplementariasComunes ['arrIds'][$i]['f.11.2.n.3'])){
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['UNIDAD'] = (String)($arrObrasComplementariasComunes ['arrElementos'][$i][$arrObrasComplementariasComunes ['arrIds'][$i]['f.11.2.n.3']]);
                    }

                    if(isset($arrObrasComplementariasComunes ['arrIds'][$i]['f.11.2.n.4'])){
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['CANTIDAD'] = (String)($arrObrasComplementariasComunes ['arrElementos'][$i][$arrObrasComplementariasComunes ['arrIds'][$i]['f.11.2.n.4']]);
                    }

                    if(isset($arrObrasComplementariasComunes ['arrIds'][$i]['f.11.2.n.5'])){
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['EDAD'] = (String)($arrObrasComplementariasComunes ['arrElementos'][$i][$arrObrasComplementariasComunes ['arrIds'][$i]['f.11.2.n.5']]);
                    }

                    if(isset($arrObrasComplementariasComunes ['arrIds'][$i]['f.11.2.n.7'])){
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['VALORUNITARIO'] = (String)($arrObrasComplementariasComunes ['arrElementos'][$i][$arrObrasComplementariasComunes ['arrIds'][$i]['f.11.2.n.7']]);
                    }

                    if(isset($arrObrasComplementariasComunes ['arrIds'][$i]['f.11.2.n.10'])){
                        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['TEINDIVISO'] = (String)($arrObrasComplementariasComunes ['arrElementos'][$i][$arrObrasComplementariasComunes ['arrIds'][$i]['f.11.2.n.10']]);
                    }

                    $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['CODTIPO'] = "C";
                    $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_ELEMENTOSEXTRA'][$controlElemento]['IDAVALUO'] = $camposFexavaAvaluo['IDAVALUO'];
                }                
            }


        }        


        return $camposFexavaAvaluo;

    }

    public function guardarAvaluoEnfoqueMercado($infoXmlElementosConst, $camposFexavaAvaluo,$elementoPrincipal){
        $camposFexavaAvaluo['FEXAVA_TERRENOMERCADO'] = array();

        $enfoqueDeMercado = $infoXmlElementosConst->xpath($elementoPrincipal.'//EnfoqueDeMercado[@id="h"]');
        $errores = valida_AvaluoEnfoqueMercado($enfoqueDeMercado, $elementoPrincipal);    
        if(count($errores) > 0){
            return array('ERROR' => $errores);
        }
        $arrPrincipalEnfoqueDeMercado = $this->obtenElementosPrincipal($enfoqueDeMercado);
        //print_r($arrPrincipalEnfoqueDeMercado); exit();
        if(isset($arrPrincipalEnfoqueDeMercado['arrIds']['h.1']) && count($arrPrincipalEnfoqueDeMercado['arrElementos'][$arrPrincipalEnfoqueDeMercado['arrIds']['h.1']]) > 0){           
            $terrenos = $infoXmlElementosConst->xpath($elementoPrincipal.'//EnfoqueDeMercado[@id="h"]//'.$arrPrincipalEnfoqueDeMercado['arrIds']['h.1'].'[@id="h.1"]');
            $arrTerrenos = $this->obtenElementosPrincipal($terrenos);
            /********************************************************Conclusiones homologación terrenos******************************************************************/
            if(isset($arrTerrenos['arrIds']['h.1.2'])){
                $camposFexavaAvaluo['FEXAVA_TERRENOMERCADO'] = array();
                $conclusionesHomologacionTerreno = $infoXmlElementosConst->xpath($elementoPrincipal.'//EnfoqueDeMercado[@id="h"]//'.$arrPrincipalEnfoqueDeMercado['arrIds']['h.1'].'[@id="h.1"]//'.$arrTerrenos['arrIds']['h.1.2'].'[@id="h.1.2"]');
                $arrConclusionesHomologacionTerreno = $this->obtenElementosPrincipal($conclusionesHomologacionTerreno);
                //print_r($arrConclusionesHomologacionTerreno); exit();

                if(isset($arrConclusionesHomologacionTerreno['arrIds']['h.1.2.2'])){
                    $camposFexavaAvaluo['FEXAVA_TERRENOMERCADO']['VALORUNITARIOTIERRAPROMEDIO'] = (String)($arrConclusionesHomologacionTerreno ['arrElementos'][$arrConclusionesHomologacionTerreno ['arrIds']['h.1.2.2']]);
                }

                if(isset($arrConclusionesHomologacionTerreno['arrIds']['h.1.2.2'])){
                    $camposFexavaAvaluo['FEXAVA_TERRENOMERCADO']['VALORUNITARIOTIERRAHOMOLOGADO'] = (String)($arrConclusionesHomologacionTerreno ['arrElementos'][$arrConclusionesHomologacionTerreno ['arrIds']['h.1.2.2']]);
                }

                $camposFexavaAvaluo['FEXAVA_TERRENOMERCADO']['CODTIPOTERRENO'] = 'D';
            }

            /********************************************************Terrenos Directos******************************************************************/

            if(isset($arrTerrenos['arrIds']['h.1.1'])){
                $camposFexavaAvaluo['FEXAVA_DATOSTERRENOS'] = array();
                $terrenosDirectos = $infoXmlElementosConst->xpath($elementoPrincipal.'//EnfoqueDeMercado[@id="h"]//'.$arrPrincipalEnfoqueDeMercado['arrIds']['h.1'].'[@id="h.1"]//'.$arrTerrenos['arrIds']['h.1.1'].'[@id="h.1.1"]');
                $arrTerrenosDirectos = $this->obtenElementos($terrenosDirectos);
                //print_r($arrTerrenosDirectos); exit();
                $controlElemento = count($camposFexavaAvaluo['FEXAVA_DATOSTERRENOS']) - 1;

                for($i=0;$i < count($terrenosDirectos); $i++){
                    $controlElemento = $controlElemento + 1;
                    if(isset($arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.1'])){
                        $camposFexavaAvaluo['FEXAVA_DATOSTERRENOS'][$controlElemento]['CALLE'] = (String)($arrTerrenosDirectos['arrElementos'][$i][$arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.1']]);
                    }
    
                    if(isset($arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.3'])){
                        $codDelegacion = (String)($arrTerrenosDirectos['arrElementos'][$i][$arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.3']]);
                        //AQUI USAR datosTerrenosRow.IDDELEGACION = CatastralUtils.ObtenerIdDelegacionPorClave(codDelegacion);
                        $camposFexavaAvaluo['FEXAVA_DATOSTERRENOS'][$controlElemento]['IDDELEGACION'] = (String)($arrTerrenosDirectos['arrElementos'][$i][$arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.3']]);
                        if(isset($arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.2'])){
                            //Aqui usar CatastralUtils.ObtenerIdColoniaPorNombreyDelegacion(queryn.ToStringXElement(), codDelegacion);
                            $camposFexavaAvaluo['FEXAVA_DATOSTERRENOS'][$controlElemento]['IDCOLONIA'] = (String)($arrTerrenosDirectos['arrElementos'][$i][$arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.2']]);
                        }
    
                    }
    
                    if(isset($arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.4'])){
                        $camposFexavaAvaluo['FEXAVA_DATOSTERRENOS'][$controlElemento]['CODIGOPOSTAL'] = (String)($arrTerrenosDirectos['arrElementos'][$i][$arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.2']]);
                    }
    
                    if(isset($arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.5']) && count($arrTerrenosDirectos['arrElementos'][$i][$arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.5']]) > 0){
                        //print_r($arrTerrenosDirectos['arrElementos'][$i][$arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.5']]); exit();
                        $subarreglo = $arrTerrenosDirectos['arrElementos'][$i][$arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.5']];
                        $camposFexavaAvaluo['FEXAVA_DATOSTERRENOS'][$controlElemento]['TELEFONO'] = (String)($subarreglo->Telefono);
                        $camposFexavaAvaluo['FEXAVA_DATOSTERRENOS'][$controlElemento]['INFORMANTE'] = (String)($subarreglo->Informante); 
                    }

                    if(isset($arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.6'])){
                        $camposFexavaAvaluo['FEXAVA_DATOSTERRENOS'][$controlElemento]['DESCRIPCION'] = (String)($arrTerrenosDirectos['arrElementos'][$i][$arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.6']]);
                    }

                    if(isset($arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.7'])){
                        $camposFexavaAvaluo['FEXAVA_DATOSTERRENOS'][$controlElemento]['USOSUELO'] = (String)($arrTerrenosDirectos['arrElementos'][$i][$arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.7']]);
                    }

                    if(isset($arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.8'])){
                        $camposFexavaAvaluo['FEXAVA_DATOSTERRENOS'][$controlElemento]['CUS'] = (String)($arrTerrenosDirectos['arrElementos'][$i][$arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.8']]);
                    }

                    if(isset($arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.9'])){
                        $camposFexavaAvaluo['FEXAVA_DATOSTERRENOS'][$controlElemento]['SUPERFICIE'] = (String)($arrTerrenosDirectos['arrElementos'][$i][$arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.9']]);
                    }

                    if(isset($arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.10'])){
                        $camposFexavaAvaluo['FEXAVA_DATOSTERRENOS'][$controlElemento]['FZO'] = (String)($arrTerrenosDirectos['arrElementos'][$i][$arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.10']]);
                    }

                    if(isset($arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.11'])){
                        $camposFexavaAvaluo['FEXAVA_DATOSTERRENOS'][$controlElemento]['FUB'] = (String)($arrTerrenosDirectos['arrElementos'][$i][$arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.11']]);
                    }

                    if(isset($arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.12'])){
                        $camposFexavaAvaluo['FEXAVA_DATOSTERRENOS'][$controlElemento]['FFR'] = (String)($arrTerrenosDirectos['arrElementos'][$i][$arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.12']]);
                    }

                    if(isset($arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.13'])){
                        $camposFexavaAvaluo['FEXAVA_DATOSTERRENOS'][$controlElemento]['FFO'] = (String)($arrTerrenosDirectos['arrElementos'][$i][$arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.13']]);
                    }

                    if(isset($arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.14'])){
                        $camposFexavaAvaluo['FEXAVA_DATOSTERRENOS'][$controlElemento]['FSU'] = (String)($arrTerrenosDirectos['arrElementos'][$i][$arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.14']]);
                    }

                    if(isset($arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.18']) && count($arrTerrenosDirectos['arrElementos'][$i][$arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.18']]) > 0){
                        $fot = $infoXmlElementosConst->xpath($elementoPrincipal.'//EnfoqueDeMercado[@id="h"]//'.$arrPrincipalEnfoqueDeMercado['arrIds']['h.1'].'[@id="h.1"]//'.$arrTerrenos['arrIds']['h.1.1'].'[@id="h.1.1"]//'.$arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.18'].'[@id="h.1.1.n.18"]');
                        $arrFot = $this->obtenElementosPrincipal($fot);
                        if(isset($arrTerrenosDirectos['arrIds']['h.1.1.n.18.1'])){
                            $camposFexavaAvaluo['FEXAVA_DATOSTERRENOS'][$controlElemento]['FOTVALOR'] = (String)($arrFot['arrElementos'][$arrTerrenosDirectos['arrIds']['h.1.1.n.18.1']]);
                        }
                        if(isset($arrTerrenosDirectos['arrIds']['h.1.1.n.18.2'])){
                            $camposFexavaAvaluo['FEXAVA_DATOSTERRENOS'][$controlElemento]['FOTDESCRIPCION'] = (String)($arrFot['arrElementos'][$arrTerrenosDirectos['arrIds']['h.1.1.n.18.2']]);
                        }
                        
                    }

                    if(isset($arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.15'])){
                        $camposFexavaAvaluo['FEXAVA_DATOSTERRENOS'][$controlElemento]['PRECIOSOLICITADO'] = (String)($arrTerrenosDirectos['arrElementos'][$i][$arrTerrenosDirectos['arrIds'][$i]['h.1.1.n.15']]);
                    }
                    
                }
                
            }

            if(isset($arrTerrenos['arrIds']['h.1.3'])){
                $camposFexavaAvaluo['FEXAVA_TERRENOMERCADO'] = array();
                $conclusionesHomologacionTerreno = $infoXmlElementosConst->xpath($elementoPrincipal.'//EnfoqueDeMercado[@id="h"]//'.$arrPrincipalEnfoqueDeMercado['arrIds']['h.1'].'[@id="h.1"]//'.$arrTerrenos['arrIds']['h.1.3'].'[@id="h.1.3"]');
                $arrConclusionesHomologacionTerreno = $this->obtenElementosPrincipal($conclusionesHomologacionTerreno);
                //print_r($arrConclusionesHomologacionTerreno); exit();

                /********************************************************Conclusiones homologación comp. Residuales******************************************************************/
                if(isset($arrConclusionesHomologacionTerreno['arrIds']['h.1.3.5'])){
                    $conclusionesHomologacionResiduales = $infoXmlElementosConst->xpath($elementoPrincipal.'//EnfoqueDeMercado[@id="h"]//'.$arrPrincipalEnfoqueDeMercado['arrIds']['h.1'].'[@id="h.1"]//'.$arrTerrenos['arrIds']['h.1.3'].'[@id="h.1.3"]//'.$arrConclusionesHomologacionTerreno['arrIds']['h.1.3.5'].'[@id="h.1.3.5"]');
                    $arrConclusionesHomologacionResiduales = $this->obtenElementosPrincipal($conclusionesHomologacionResiduales);

                    if(isset($arrConclusionesHomologacionResiduales['arrIds']['h.1.3.5.1'])){
                        $camposFexavaAvaluo['FEXAVA_TERRENOMERCADO']['VALORUNITARIOTIERRAPROMEDIO'] = (String)($arrConclusionesHomologacionResiduales['arrElementos'][$arrConclusionesHomologacionResiduales['arrIds']['h.1.3.5.1']]);
                    }

                    if(isset($arrConclusionesHomologacionResiduales['arrIds']['h.1.3.5.2'])){
                        $camposFexavaAvaluo['FEXAVA_TERRENOMERCADO']['VALORUNITARIOTIERRAHOMOLOGADO'] = (String)($arrConclusionesHomologacionResiduales['arrElementos'][$arrConclusionesHomologacionResiduales['arrIds']['h.1.3.5.2']]);
                    }
                    
                }

                if(isset($arrConclusionesHomologacionTerreno['arrIds']['h.1.3.6'])){
                    $conclusionesHomologacionResiduales = $infoXmlElementosConst->xpath($elementoPrincipal.'//EnfoqueDeMercado[@id="h"]//'.$arrPrincipalEnfoqueDeMercado['arrIds']['h.1'].'[@id="h.1"]//'.$arrTerrenos['arrIds']['h.1.3'].'[@id="h.1.3"]//'.$arrConclusionesHomologacionTerreno['arrIds']['h.1.3.6'].'[@id="h.1.3.6"]');
                    $arrConclusionesHomologacionResiduales = $this->obtenElementosPrincipal($conclusionesHomologacionResiduales);

                    if(isset($arrConclusionesHomologacionResiduales['arrIds']['h.1.3.6.4'])){
                        $camposFexavaAvaluo['FEXAVA_TERRENOMERCADO']['VALORUNITARIORESIDUAL'] = (String)($arrConclusionesHomologacionResiduales['arrElementos'][$arrConclusionesHomologacionResiduales['arrIds']['h.1.3.6.4']]);
                    }
                }

                $camposFexavaAvaluo['FEXAVA_TERRENOMERCADO']['CODTIPOTERRENO'] = 'R';

                /********************************************************Investigación productos comparables******************************************************************/

                if(isset($arrConclusionesHomologacionTerreno['arrIds']['h.1.3.4'])){
                    $productosComparables = $infoXmlElementosConst->xpath($elementoPrincipal.'//EnfoqueDeMercado[@id="h"]//'.$arrPrincipalEnfoqueDeMercado['arrIds']['h.1'].'[@id="h.1"]//'.$arrTerrenos['arrIds']['h.1.3'].'[@id="h.1.3"]//'.$arrConclusionesHomologacionTerreno['arrIds']['h.1.3.4'].'[@id="h.1.3.4"]');
                    $arrProductosComparables = $this->obtenElementos($productosComparables);
                    if(!isset($camposFexavaAvaluo['FEXAVA_DATOSTERRENOS'])){
                        $camposFexavaAvaluo['FEXAVA_DATOSTERRENOS'] = array();
                    }                    
                    $controlElemento = count($camposFexavaAvaluo['FEXAVA_DATOSTERRENOS']) - 1;
                    for($i=0;$i < count($productosComparables);$i++){
                        $controlElemento = $controlElemento + 1;

                        if(isset($arrProductosComparables['arrIds'][$i]['h.1.3.4.n.1'])){
                            $camposFexavaAvaluo['FEXAVA_DATOSTERRENOS'][$controlElemento]['CALLE'] = (String)($arrProductosComparables['arrElementos'][$i][$arrProductosComparables['arrIds'][$i]['h.1.3.4.n.1']]);
                        }

                        if(isset($arrProductosComparables['arrIds'][$i]['h.1.3.4.n.3'])){
                            $codDelegacion = (String)($arrProductosComparables['arrElementos'][$i][$arrProductosComparables['arrIds'][$i]['h.1.3.4.n.3']]);
                            //AQUI USAR datosTerrenosRow.IDDELEGACION = CatastralUtils.ObtenerIdDelegacionPorClave(codDelegacion);
                            $camposFexavaAvaluo['FEXAVA_DATOSTERRENOS'][$controlElemento]['IDDELEGACION'] = (String)($arrProductosComparables['arrElementos'][$i][$arrProductosComparables['arrIds'][$i]['h.1.3.4.n.3']]);
                            if(isset($arrProductosComparables['arrIds'][$i]['h.1.3.4.n.2'])){
                                //AQUI USAR datosTerrenosRow.IDCOLONIA = CatastralUtils.ObtenerIdColoniaPorNombreyDelegacion(queryn.ToStringXElement(), codDelegacion);
                                $camposFexavaAvaluo['FEXAVA_DATOSTERRENOS'][$controlElemento]['IDCOLONIA'] = (String)($arrProductosComparables['arrElementos'][$i][$arrProductosComparables['arrIds'][$i]['h.1.3.4.n.2']]);
                            }
                        }

                        if(isset($arrProductosComparables['arrIds'][$i]['h.1.3.4.n.4'])){
                            $camposFexavaAvaluo['FEXAVA_DATOSTERRENOS'][$controlElemento]['CODIGOPOSTAL'] = (String)($arrProductosComparables['arrElementos'][$i][$arrProductosComparables['arrIds'][$i]['h.1.3.4.n.4']]);
                        }

                        if(isset($arrProductosComparables['arrIds'][$i]['h.1.3.4.n.5']) && count($arrProductosComparables['arrElementos'][$i][$arrProductosComparables['arrIds'][$i]['h.1.3.4.n.5']]) > 0){
                            $fot = $infoXmlElementosConst->xpath($elementoPrincipal.'//EnfoqueDeMercado[@id="h"]//'.$arrPrincipalEnfoqueDeMercado['arrIds']['h.1'].'[@id="h.1"]//'.$arrTerrenos['arrIds']['h.1.1'].'[@id="h.1.1"]//'.$arrProductosComparables['arrIds'][$i]['h.1.3.4.n.5'].'[@id="h.1.3.4.n.5"]');
                            $arrFot = $this->obtenElementosPrincipal($fot);
                            if(isset($arrProductosComparables['arrIds']['h.1.3.4.n.5.1'])){
                                $camposFexavaAvaluo['FEXAVA_DATOSTERRENOS'][$controlElemento]['TELEFONO'] = (String)($arrFot['arrElementos'][$arrFot['arrIds']['h.1.3.4.n.5.1']]);
                            }
                            if(isset($arrProductosComparables['arrIds']['h.1.3.4.n.5.2'])){
                                $camposFexavaAvaluo['FEXAVA_DATOSTERRENOS'][$controlElemento]['INFORMANTE'] = (String)($arrFot['arrElementos'][$arrFot['arrIds']['h.1.3.4.n.5.2']]);
                            }
                            
                        }

                        if(isset($arrProductosComparables['arrIds'][$i]['h.1.3.4.n.6'])){
                            $camposFexavaAvaluo['FEXAVA_DATOSTERRENOS'][$controlElemento]['DESCRIPCION'] = (String)($arrProductosComparables['arrElementos'][$i][$arrProductosComparables['arrIds'][$i]['h.1.3.4.n.6']]);
                        }

                        if(isset($arrProductosComparables['arrIds'][$i]['h.1.3.4.n.7'])){
                            $camposFexavaAvaluo['FEXAVA_DATOSTERRENOS'][$controlElemento]['SUPERFICIE'] = (String)($arrProductosComparables['arrElementos'][$i][$arrProductosComparables['arrIds'][$i]['h.1.3.4.n.7']]);
                        }

                        if(isset($arrProductosComparables['arrIds'][$i]['h.1.3.4.n.8'])){
                            $camposFexavaAvaluo['FEXAVA_DATOSTERRENOS'][$controlElemento]['PRECIOSOLICITADO'] = (String)($arrProductosComparables['arrElementos'][$i][$arrProductosComparables['arrIds'][$i]['h.1.3.4.n.8']]);
                        }

                        
                    }
                }
            }

            if(isset($arrTerrenos['arrIds']['h.1.4'])){
                $valorUnitarioDeTierraAplicableAlAvaluo = $infoXmlElementosConst->xpath($elementoPrincipal.'//EnfoqueDeMercado[@id="h"]//'.$arrPrincipalEnfoqueDeMercado['arrIds']['h.1'].'[@id="h.1"]//'.$arrTerrenos['arrIds']['h.1.4'].'[@id="h.1.4"]');
                $arrValorUnitarioDeTierraAplicableAlAvaluo = $this->obtenElementosPrincipal($valorUnitarioDeTierraAplicableAlAvaluo);
                
                $camposFexavaAvaluo['VALORUNITARIOTIERRAAVALUO'] = (String)($valorUnitarioDeTierraAplicableAlAvaluo[0]);
            }

        }

        /*********************************************************************** Conclusiones homologación construcciones en venta*********************************************************/

        if(isset($arrPrincipalEnfoqueDeMercado['arrIds']['h.2']) && count($arrPrincipalEnfoqueDeMercado['arrElementos'][$arrPrincipalEnfoqueDeMercado['arrIds']['h.2']]) > 0){
            $construccionesEnVenta = $infoXmlElementosConst->xpath($elementoPrincipal.'//EnfoqueDeMercado[@id="h"]//'.$arrPrincipalEnfoqueDeMercado['arrIds']['h.2'].'[@id="h.2"]');
            $arrConstruccionesEnVenta = $this->obtenElementosPrincipal($construccionesEnVenta);
            
            if(isset($arrConstruccionesEnVenta['arrIds']['h.2.2'])){
                $camposFexavaAvaluo['FEXAVA_CONSTRUCCIONESMER'] = array();
                $camposFexavaAvaluo['FEXAVA_CONSTRUCCIONESMER'][0] = array();               
                $conclusionesHomologacionConstruccionesEnVenta = $infoXmlElementosConst->xpath($elementoPrincipal.'//EnfoqueDeMercado[@id="h"]//'.$arrPrincipalEnfoqueDeMercado['arrIds']['h.2'].'[@id="h.2"]//'.$arrConstruccionesEnVenta['arrIds']['h.2.2'].'[@id="h.2.2"]');
                $arrConclusionesHomologacionConstruccionesEnVenta = $this->obtenElementosPrincipal($conclusionesHomologacionConstruccionesEnVenta);

                //print_r($arrConclusionesHomologacionConstruccionesEnVenta); exit();
                $camposFexavaAvaluo['FEXAVA_CONSTRUCCIONESMER'][0]['IDMODOCONSTRUCCION'] = 'V';
                if(isset($arrConclusionesHomologacionConstruccionesEnVenta['arrIds']['h.2.2.1'])){
                    $camposFexavaAvaluo['FEXAVA_CONSTRUCCIONESMER'][0]['VALORUNITARIOPROMEDIO'] = (String)($arrConclusionesHomologacionConstruccionesEnVenta['arrElementos'][$arrConclusionesHomologacionConstruccionesEnVenta['arrIds']['h.2.2.1']]);
                }

                if(isset($arrConclusionesHomologacionConstruccionesEnVenta['arrIds']['h.2.2.2'])){
                    $camposFexavaAvaluo['FEXAVA_CONSTRUCCIONESMER'][0]['VALORUNITARIOHOMOLOGADO'] = (String)($arrConclusionesHomologacionConstruccionesEnVenta['arrElementos'][$arrConclusionesHomologacionConstruccionesEnVenta['arrIds']['h.2.2.2']]);
                }

                if(isset($arrConclusionesHomologacionConstruccionesEnVenta['arrIds']['h.2.2.7'])){
                    $camposFexavaAvaluo['FEXAVA_CONSTRUCCIONESMER'][0]['VALORUNITARIOAPLICABLE'] = (String)($arrConclusionesHomologacionConstruccionesEnVenta['arrElementos'][$arrConclusionesHomologacionConstruccionesEnVenta['arrIds']['h.2.2.7']]);
                }
                
            }

            if(isset($arrConstruccionesEnVenta['arrIds']['h.2.1'])){
                $camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP'] = array();
                $investigacionProductosComparables = $infoXmlElementosConst->xpath($elementoPrincipal.'//EnfoqueDeMercado[@id="h"]//'.$arrPrincipalEnfoqueDeMercado['arrIds']['h.2'].'[@id="h.2"]//'.$arrConstruccionesEnVenta['arrIds']['h.2.1'].'[@id="h.2.1"]');
                $arrInvestigacionProductosComparables = $this->obtenElementos($investigacionProductosComparables);

                $controlElemento = count($camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP']) - 1;
                $controlCuentaCatastral = 0;
                $controlFuenteInformacion = 0;
                for($i=0;$i < count($investigacionProductosComparables); $i++){
                    $controlElemento = $controlElemento + 1;

                    if(isset($arrInvestigacionProductosComparables['arrIds'][$i]['h.2.1.n.1'])){
                        $camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP'][$controlElemento]['CALLE'] = (String)($arrInvestigacionProductosComparables['arrElementos'][$i][$arrInvestigacionProductosComparables['arrIds'][$i]['h.2.1.n.1']]);
                    }

                    if(isset($arrInvestigacionProductosComparables['arrIds'][$i]['h.2.1.n.3'])){
                        $codDelegacion = (String)($arrInvestigacionProductosComparables['arrElementos'][$i][$arrInvestigacionProductosComparables['arrIds'][$i]['h.2.1.n.3']]);
                        //AQUI USAR investigacionProductosComparablesRow.IDDELEGACION = CatastralUtils.ObtenerIdDelegacionPorClave(codDelegacion)
                        $camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP'][$controlElemento]['IDDELEGACION'] = (String)($arrInvestigacionProductosComparables['arrElementos'][$i][$arrInvestigacionProductosComparables['arrIds'][$i]['h.2.1.n.3']]);
                        if(isset($arrInvestigacionProductosComparables['arrIds'][$i]['h.2.1.n.2'])){
                            //Aqui usar CatastralUtils.ObtenerIdColoniaPorNombreyDelegacion(queryn.ToStringXElement(), codDelegacion);
                            $camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP'][$controlElemento]['IDCOLONIA'] = (String)($arrInvestigacionProductosComparables['arrElementos'][$i][$arrInvestigacionProductosComparables['arrIds'][$i]['h.2.1.n.2']]);                            
                        }
                    }

                    if(isset($arrInvestigacionProductosComparables['arrIds'][$i]['h.2.1.n.4'])){
                        $camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP'][$controlElemento]['CODIGOPOSTAL'] = (String)($arrInvestigacionProductosComparables['arrElementos'][$i][$arrInvestigacionProductosComparables['arrIds'][$i]['h.2.1.n.4']]);
                    }

                    if(isset($arrInvestigacionProductosComparables['arrIds'][$i]['h.2.1.n.5']) && count($arrInvestigacionProductosComparables['arrElementos'][$i][$arrInvestigacionProductosComparables['arrIds'][$i]['h.2.1.n.5']]) > 0){
                        $fuenteDeInformacion = $infoXmlElementosConst->xpath($elementoPrincipal.'//EnfoqueDeMercado[@id="h"]//'.$arrPrincipalEnfoqueDeMercado['arrIds']['h.2'].'[@id="h.2"]//'.$arrConstruccionesEnVenta['arrIds']['h.2.1'].'[@id="h.2.1"]//'.$arrInvestigacionProductosComparables['arrIds'][$i]['h.2.1.n.5'].'[@id="h.2.1.n.5"]');
                        $arrFuenteDeInformacion = $this->obtenElementos($fuenteDeInformacion);
                        if(isset($arrFuenteDeInformacion['arrIds'][$controlFuenteInformacion]['h.2.1.n.5.1'])){
                            $camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP'][$controlElemento]['TELEFONO'] = (String)($arrFuenteDeInformacion['arrElementos'][$controlFuenteInformacion][$arrFuenteDeInformacion['arrIds'][$controlFuenteInformacion]['h.2.1.n.5.1']]);
                        }
                        if(isset($arrFuenteDeInformacion['arrIds'][$controlFuenteInformacion]['h.2.1.n.5.2'])){
                            $camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP'][$controlElemento]['INFORMANTE'] = (String)($arrFuenteDeInformacion['arrElementos'][$controlFuenteInformacion][$arrFuenteDeInformacion['arrIds'][$controlFuenteInformacion]['h.2.1.n.5.2']]);
                        }
                        $controlFuenteInformacion = $controlFuenteInformacion+1;
                    }

                    if(isset($arrInvestigacionProductosComparables['arrIds'][$i]['h.2.1.n.6'])){
                        $camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP'][$controlElemento]['DESCRIPCION'] = (String)($arrInvestigacionProductosComparables['arrElementos'][$i][$arrInvestigacionProductosComparables['arrIds'][$i]['h.2.1.n.6']]);
                    }

                    if(isset($arrInvestigacionProductosComparables['arrIds'][$i]['h.2.1.n.7'])){
                        $camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP'][$controlElemento]['SUPERFICIEVENDIBLEPORUNIDAD'] = (String)($arrInvestigacionProductosComparables['arrElementos'][$i][$arrInvestigacionProductosComparables['arrIds'][$i]['h.2.1.n.7']]);
                    }

                    if(isset($arrInvestigacionProductosComparables['arrIds'][$i]['h.2.1.n.8'])){
                        $camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP'][$controlElemento]['PRECIOSOLICITADO'] = (String)($arrInvestigacionProductosComparables['arrElementos'][$i][$arrInvestigacionProductosComparables['arrIds'][$i]['h.2.1.n.8']]);
                    }

                    if(isset($arrInvestigacionProductosComparables['arrIds'][$i]['h.2.1.n.10']) && count($arrInvestigacionProductosComparables['arrElementos'][$i][$arrInvestigacionProductosComparables['arrIds'][$i]['h.2.1.n.10']]) > 0){
                        $cuentaCatastral = $infoXmlElementosConst->xpath($elementoPrincipal.'//EnfoqueDeMercado[@id="h"]//'.$arrPrincipalEnfoqueDeMercado['arrIds']['h.2'].'[@id="h.2"]//'.$arrConstruccionesEnVenta['arrIds']['h.2.1'].'[@id="h.2.1"]//'.$arrInvestigacionProductosComparables['arrIds'][$i]['h.2.1.n.10'].'[@id="h.2.1.n.10"]');
                        $arrFuenteDeInformacion = $this->obtenElementos($cuentaCatastral);
                        if(isset($arrFuenteDeInformacion['arrIds'][$controlCuentaCatastral]['h.2.1.n.10.1'])){
                            $camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP'][$controlElemento]['REGION'] = (String)($arrFuenteDeInformacion['arrElementos'][$controlCuentaCatastral][$arrFuenteDeInformacion['arrIds'][$controlCuentaCatastral]['h.2.1.n.10.1']]);
                        }
                        if(isset($arrFuenteDeInformacion['arrIds'][$controlCuentaCatastral]['h.2.1.n.10.2'])){
                            $camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP'][$controlElemento]['MANZANA'] = (String)($arrFuenteDeInformacion['arrElementos'][$controlCuentaCatastral][$arrFuenteDeInformacion['arrIds'][$controlCuentaCatastral]['h.2.1.n.10.2']]);
                        }
                        if(isset($arrFuenteDeInformacion['arrIds'][$controlCuentaCatastral]['h.2.1.n.10.3'])){
                            $camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP'][$controlElemento]['LOTE'] = (String)($arrFuenteDeInformacion['arrElementos'][$controlCuentaCatastral][$arrFuenteDeInformacion['arrIds'][$controlCuentaCatastral]['h.2.1.n.10.3']]);
                        }
                        if(isset($arrFuenteDeInformacion['arrIds'][$controlCuentaCatastral]['h.2.1.n.10.4'])){
                            $camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP'][$controlElemento]['UNIDADPRIVATIVA'] = (String)($arrFuenteDeInformacion['arrElementos'][$controlCuentaCatastral][$arrFuenteDeInformacion['arrIds'][$controlCuentaCatastral]['h.2.1.n.10.4']]);
                        }
                        $controlCuentaCatastral = $controlCuentaCatastral+1; 
                    }

                }
            }
        }
        /**********************************************************************************************************************************************************************/
        if(isset($arrPrincipalEnfoqueDeMercado['arrIds']['h.3'])){
            $valorDeMercadoDelInmueble = $infoXmlElementosConst->xpath($elementoPrincipal.'//EnfoqueDeMercado[@id="h"]//'.$arrPrincipalEnfoqueDeMercado['arrIds']['h.3'].'[@id="h.3"]');
            //echo (String)($valorDeMercadoDelInmueble[0]); exit();            
            $camposFexavaAvaluo['DIVALORMERCADO'] = (String)($valorDeMercadoDelInmueble[0]);
        }

        /******************************************************************Conclusiones homologación construcciones en venta********************************************************/

        if(isset($arrPrincipalEnfoqueDeMercado['arrIds']['h.4'])){
            $construccionesEnRenta = $infoXmlElementosConst->xpath($elementoPrincipal.'//EnfoqueDeMercado[@id="h"]//'.$arrPrincipalEnfoqueDeMercado['arrIds']['h.4'].'[@id="h.4"]');
            $arrConstruccionesEnRenta = $this->obtenElementosPrincipal($construccionesEnRenta);
            //print_r($arrConstruccionesEnRenta); exit();

            if(isset($arrConstruccionesEnRenta['arrIds']['h.4.2'])){
                $conclusioneshomologacionConstruccionesEnVenta = $infoXmlElementosConst->xpath($elementoPrincipal.'//EnfoqueDeMercado[@id="h"]//'.$arrPrincipalEnfoqueDeMercado['arrIds']['h.4'].'[@id="h.4"]//'.$arrConstruccionesEnRenta['arrIds']['h.4.2'].'[@id="h.4.2"]');
                $arrConclusioneshomologacionConstruccionesEnVenta = $this->obtenElementosPrincipal($conclusioneshomologacionConstruccionesEnVenta);

                if(!isset($camposFexavaAvaluo['FEXAVA_CONSTRUCCIONESMER'])){
                    $camposFexavaAvaluo['FEXAVA_CONSTRUCCIONESMER'] = array();
                    $camposFexavaAvaluo['FEXAVA_CONSTRUCCIONESMER'][0] = array();
                    $controlElemento = 0;
                }else{
                    $controlElemento = count($camposFexavaAvaluo['FEXAVA_CONSTRUCCIONESMER']);
                }
                

                if(isset($arrConclusioneshomologacionConstruccionesEnVenta['arrIds']['h.4.2.1'])){
                    $camposFexavaAvaluo['FEXAVA_CONSTRUCCIONESMER'][$controlElemento]['VALORUNITARIOPROMEDIO'] = (String)($arrConclusioneshomologacionConstruccionesEnVenta['arrElementos'][$arrConclusioneshomologacionConstruccionesEnVenta['arrIds']['h.4.2.1']]);
                }

                if(isset($arrConclusioneshomologacionConstruccionesEnVenta['arrIds']['h.4.2.2'])){
                    $camposFexavaAvaluo['FEXAVA_CONSTRUCCIONESMER'][$controlElemento]['VALORUNITARIOHOMOLOGADO'] = (String)($arrConclusioneshomologacionConstruccionesEnVenta['arrElementos'][$arrConclusioneshomologacionConstruccionesEnVenta['arrIds']['h.4.2.2']]);
                }

                if(isset($arrConclusioneshomologacionConstruccionesEnVenta['arrIds']['h.4.2.7'])){
                    $camposFexavaAvaluo['FEXAVA_CONSTRUCCIONESMER'][$controlElemento]['VALORUNITARIOAPLICABLE'] = (String)($arrConclusioneshomologacionConstruccionesEnVenta['arrElementos'][$arrConclusioneshomologacionConstruccionesEnVenta['arrIds']['h.4.2.7']]);
                }

                $camposFexavaAvaluo['FEXAVA_CONSTRUCCIONESMER'][$controlElemento]['IDMODOCONSTRUCCION'] = 'R';
            }

            if ($this->esTerrenoValdio($infoXmlElementosConst, $elementoPrincipal) == TRUE){
                if(isset($arrConstruccionesEnRenta['arrIds']['h.4.1'])){
                
                    if(!isset($camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP'])){
                        $camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP'] = array();
                    }
                    
                    $investigacionProductoscomparables = $infoXmlElementosConst->xpath($elementoPrincipal.'//EnfoqueDeMercado[@id="h"]//'.$arrPrincipalEnfoqueDeMercado['arrIds']['h.4'].'[@id="h.4"]//'.$arrConstruccionesEnRenta['arrIds']['h.4.1'].'[@id="h.4.1"]');
                    $arrInvestigacionProductoscomparables = $this->obtenElementos($investigacionProductoscomparables);
                    $controlElemento = count($camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP']) - 1;
                    //print_r($arrInvestigacionProductoscomparables); exit();
                    $controlCuentaCatastral = 0;
                    $controlFuenteInformacion = 0;
                    for($i=0; $i < count($investigacionProductoscomparables); $i++){
                        $controlElemento = $controlElemento + 1;
                        $camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP'][$controlElemento] = array();
    
                        if(isset($arrInvestigacionProductoscomparables['arrIds'][$i]['h.4.1.n.1'])){
                            $camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP'][$controlElemento]['CALLE'] = (String)($arrInvestigacionProductoscomparables['arrElementos'][$i][$arrInvestigacionProductoscomparables['arrIds'][$i]['h.4.1.n.1']]);
                        }
    
                        if(isset($arrInvestigacionProductoscomparables['arrIds'][$i]['h.4.1.n.3'])){
                            $codDelegacion = (String)($arrInvestigacionProductoscomparables['arrElementos'][$i][$arrInvestigacionProductoscomparables['arrIds'][$i]['h.4.1.n.3']]);
                            //Aqui usar investigacionProductosComparablesRow.IDDELEGACION = CatastralUtils.ObtenerIdDelegacionPorClave(codDelegacion);
                            $camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP'][$controlElemento]['IDDELEGACION'] = (String)($arrInvestigacionProductoscomparables['arrElementos'][$i][$arrInvestigacionProductoscomparables['arrIds'][$i]['h.4.1.n.3']]);
                            if(isset($arrInvestigacionProductoscomparables['arrIds'][$controlElemento]['h.4.1.n.2'])){
                                //Aqui usar investigacionProductosComparablesRow.IDCOLONIA = CatastralUtils.ObtenerIdColoniaPorNombreyDelegacion(queryn.ToStringXElement(), codDelegacion);
                                $camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP'][$controlElemento]['IDCOLONIA'] = (String)($arrInvestigacionProductoscomparables['arrElementos'][$i][$arrInvestigacionProductoscomparables['arrIds'][$i]['h.4.1.n.2']]);
                            }
                        }
    
                        if(isset($arrInvestigacionProductoscomparables['arrIds'][$i]['h.4.1.n.4'])){
                            $camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP'][$controlElemento]['CODIGOPOSTAL'] = (String)($arrInvestigacionProductoscomparables['arrElementos'][$i][$arrInvestigacionProductoscomparables['arrIds'][$i]['h.4.1.n.4']]);
                        }
    
                        if(isset($arrInvestigacionProductoscomparables['arrIds'][$i]['h.4.1.n.5']) && count($arrInvestigacionProductoscomparables['arrElementos'][$i][$arrInvestigacionProductoscomparables['arrIds'][$i]['h.4.1.n.5']]) > 0){
                            $fuenteDeInformacion = $infoXmlElementosConst->xpath($elementoPrincipal.'//EnfoqueDeMercado[@id="h"]//'.$arrPrincipalEnfoqueDeMercado['arrIds']['h.4'].'[@id="h.4"]//'.$arrConstruccionesEnRenta['arrIds']['h.4.1'].'[@id="h.4.1"]//'.$arrInvestigacionProductoscomparables['arrIds'][$i]['h.4.1.n.5'].'[@id="h.4.1.n.5"]');
                            //print_r($fuenteDeInformacion); exit();
                            $arrFuenteDeInformacion = $this->obtenElementos($fuenteDeInformacion);
                            //print_r($arrFuenteDeInformacion); exit();
                            if(isset($arrFuenteDeInformacion['arrIds'][$controlFuenteInformacion]['h.4.1.n.5.1'])){
                                $camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP'][$controlElemento]['TELEFONO'] = (String)($arrFuenteDeInformacion['arrElementos'][$controlFuenteInformacion][$arrFuenteDeInformacion['arrIds'][$controlFuenteInformacion]['h.4.1.n.5.1']]);
                            }
                            if(isset($arrFuenteDeInformacion['arrIds'][$controlFuenteInformacion]['h.4.1.n.5.2'])){
                                $camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP'][$controlElemento]['INFORMANTE'] = (String)($arrFuenteDeInformacion['arrElementos'][$controlFuenteInformacion][$arrFuenteDeInformacion['arrIds'][$controlFuenteInformacion]['h.4.1.n.5.2']]);
                            }
                            $controlFuenteInformacion = $controlFuenteInformacion+1;
                        }
    
                        if(isset($arrInvestigacionProductoscomparables['arrIds'][$i]['h.4.1.n.7'])){
                            $camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP'][$controlElemento]['SUPERFICIEVENDIBLEPORUNIDAD'] = (String)($arrInvestigacionProductoscomparables['arrElementos'][$i][$arrInvestigacionProductoscomparables['arrIds'][$i]['h.4.1.n.7']]);
                        }
    
                        if(isset($arrInvestigacionProductoscomparables['arrIds'][$i]['h.4.1.n.8'])){
                            $camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP'][$controlElemento]['PRECIOSOLICITADO'] = (String)($arrInvestigacionProductoscomparables['arrElementos'][$i][$arrInvestigacionProductoscomparables['arrIds'][$i]['h.4.1.n.8']]);
                        }
                        //print_r($arrInvestigacionProductoscomparables['arrIds'][$i]);
                        if(isset($arrInvestigacionProductoscomparables['arrIds'][$i]['h.4.1.n.10']) && count($arrInvestigacionProductoscomparables['arrElementos'][$i][$arrInvestigacionProductoscomparables['arrIds'][$i]['h.4.1.n.10']]) > 0){
                            $cuentaCatastral = $infoXmlElementosConst->xpath($elementoPrincipal.'//EnfoqueDeMercado[@id="h"]//'.$arrPrincipalEnfoqueDeMercado['arrIds']['h.4'].'[@id="h.4"]//'.$arrConstruccionesEnRenta['arrIds']['h.4.1'].'[@id="h.4.1"]//'.$arrInvestigacionProductoscomparables['arrIds'][$i]['h.4.1.n.10'].'[@id="h.4.1.n.10"]');
                            //print_r($cuentaCatastral); exit();
    
                            $arrCuentaCatastral = $this->obtenElementos($cuentaCatastral);
                            //print_r($arrCuentaCatastral); exit();
                            if(isset($arrCuentaCatastral['arrIds'][$controlCuentaCatastral]['h.4.1.n.10.1'])){
                                $camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP'][$controlElemento]['REGION'] = (String)($arrCuentaCatastral['arrElementos'][$controlCuentaCatastral][$arrCuentaCatastral['arrIds'][$controlCuentaCatastral]['h.4.1.n.10.1']]);
                            }
                            if(isset($arrCuentaCatastral['arrIds'][$controlCuentaCatastral]['h.4.1.n.10.2'])){
                                $camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP'][$controlElemento]['MANZANA'] = (String)($arrCuentaCatastral['arrElementos'][$controlCuentaCatastral][$arrCuentaCatastral['arrIds'][$controlCuentaCatastral]['h.4.1.n.10.2']]);
                            }
                            if(isset($arrCuentaCatastral['arrIds'][$controlCuentaCatastral]['h.4.1.n.10.3'])){
                                $camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP'][$controlElemento]['LOTE'] = (String)($arrCuentaCatastral['arrElementos'][$controlCuentaCatastral][$arrCuentaCatastral['arrIds'][$controlCuentaCatastral]['h.4.1.n.10.3']]);
                            }
                            if(isset($arrCuentaCatastral['arrIds'][$controlCuentaCatastral]['h.4.1.n.10.4'])){
                                $camposFexavaAvaluo['FEXAVA_INVESTPRODUCTOSCOMP'][$controlElemento]['UNIDADPRIVATIVA'] = (String)($arrCuentaCatastral['arrElementos'][$controlCuentaCatastral][$arrCuentaCatastral['arrIds'][$controlCuentaCatastral]['h.4.1.n.10.4']]);
                            }
                            $controlCuentaCatastral = $controlCuentaCatastral+1;
                        }
                    }
                }
            }
            
            
           
        }
        
        return $camposFexavaAvaluo;
        
    }

    /// <summary>
        /// Inserta los datos referentes al enfoque de costos del avaluo Comercial en el dseAvaluos desde
        /// el elemento xml.
        /// </summary>
        /// <param name="enfoqueCostosComercial">Elemento xml con los datos de enfoque de costos
        /// comerciales.</param>
        
    public function guardarAvaluoEnfoqueCostosComercial($xmlEnfoqueDeCostos, $camposFexavaAvaluo,$elementoPrincipal){
        $errores = valida_AvaluoEnfoqueCostosComercial($xmlEnfoqueDeCostos->xpath($elementoPrincipal.'//EnfoqueDeCostos[@id="i"]'), $elementoPrincipal);    
        if(count($errores) > 0){
            return array('ERROR' => $errores);
        }
        $enfoqueDeCostos = $xmlEnfoqueDeCostos->xpath($elementoPrincipal.'//EnfoqueDeCostos[@id="i"]//ImporteTotalDelEnfoqueDeCostos[@id="i.6"]');        
        $camposFexavaAvaluo['IMPORTETOTALENFCOSTOS'] = (String)($enfoqueDeCostos[0]);
        return $camposFexavaAvaluo;
    }

    /// <summary>
        /// Inserta los datos referentes al enfoque de costos del avaluo Catastral en el dseAvaluos desde
        /// el elemento xml.
        /// </summary>
        /// <param name="enfoqueCostosCatastral">Elemento xml con los datos de enfoque de costos
        /// catastrales.</param>
    public function guardarAvaluoEnfoqueCostosCatastral($xmlEnfoqueDeCostos, $camposFexavaAvaluo,$elementoPrincipal){
        
        $camposFexavaAvaluo['FEXAVA_ENFOQUECOSTESCAT'] = array();
        $general = $xmlEnfoqueDeCostos->xpath($elementoPrincipal);        
        $arrGeneral = $this->obtenElementosPrincipal($general);        
        //print_r($arrGeneral['arrIds']); exit();
        if(isset(($arrGeneral['arrIds']['j']))){

            $errores = valida_AvaluoEnfoqueCostosCatastral($xmlEnfoqueDeCostos->xpath($elementoPrincipal.'//EnfoqueDeCostos[@id="j"]'), $elementoPrincipal);    
            if(count($errores) > 0){
                return array('ERROR' => $errores);
            }

            $instalacionesEsp = $xmlEnfoqueDeCostos->xpath($elementoPrincipal.'//'.$arrGeneral['arrIds']['j'].'[@id="j"]');
            $arrInstalacionesEsp = $this->obtenElementosPrincipal($instalacionesEsp);
            if(isset($arrInstalacionesEsp['arrIds']['j.4'])){
                $camposFexavaAvaluo['FEXAVA_ENFOQUECOSTESCAT']['IMPINSTALACIONESESPECIALES'] = $arrInstalacionesEsp['arrElementos'][$arrInstalacionesEsp['arrIds']['j.4']];
            }

            if(isset($arrInstalacionesEsp['arrIds']['j.5'])){
                $camposFexavaAvaluo['FEXAVA_ENFOQUECOSTESCAT']['IMPTOTVALORCATASTRAL'] = $arrInstalacionesEsp['arrElementos'][$arrInstalacionesEsp['arrIds']['j.5']];
            }

            if(isset($arrInstalacionesEsp['arrIds']['j.6'])){
                $camposFexavaAvaluo['FEXAVA_ENFOQUECOSTESCAT']['AVANCEOBRA'] = $arrInstalacionesEsp['arrElementos'][$arrInstalacionesEsp['arrIds']['j.6']];
            }

            if(isset($arrInstalacionesEsp['arrIds']['j.7'])){
                $camposFexavaAvaluo['FEXAVA_ENFOQUECOSTESCAT']['IMPTOTVALCATASTRALOBRAPROCESO'] = $arrInstalacionesEsp['arrElementos'][$arrInstalacionesEsp['arrIds']['j.7']];
            }
            
        }
        return $camposFexavaAvaluo;
    }

    /// <summary>
    /// Inserta los datos referentes al enfoque de ingresos en el dseAvaluos desde el elemento xml.
    /// </summary>
    /// <param name="enfoqueIngresos">Elemento xml con los datos de enfoque de ingresos.</param>
    public function guardarAvaluoEnfoqueIngresos($xmlEnfoqueDeIngresos, $camposFexavaAvaluo,$elementoPrincipal){
        if($this->esTerrenoValdio($xmlEnfoqueDeIngresos, $elementoPrincipal) == TRUE){

            $enfoqueDeIngresos = $xmlEnfoqueDeIngresos->xpath($elementoPrincipal.'//EnfoqueDeIngresos[@id="k"]');

            $errores = valida_AvaluoEnfoqueIngresos($enfoqueDeIngresos, $elementoPrincipal);    
            if(count($errores) > 0){
                return array('ERROR' => $errores);
            }

            $arrEnfoqueDeIngresos = $this->obtenElementosPrincipal($enfoqueDeIngresos);
            
            if(isset($arrEnfoqueDeIngresos['arrIds']['k.1'])){
                $camposFexavaAvaluo['EIRENTABRUTAMENSUAL'] = (String)($arrEnfoqueDeIngresos['arrElementos'][$arrEnfoqueDeIngresos['arrIds']['k.1']]);
            }

            if(isset($arrEnfoqueDeIngresos['arrIds']['k.3'])){
                $camposFexavaAvaluo['EIPRODUCTOLIQUIDOANUAL'] = (String)($arrEnfoqueDeIngresos['arrElementos'][$arrEnfoqueDeIngresos['arrIds']['k.3']]);
            }

            if(isset($arrEnfoqueDeIngresos['arrIds']['k.4'])){
                $camposFexavaAvaluo['EITASACAPITALIZACION'] = (String)($arrEnfoqueDeIngresos['arrElementos'][$arrEnfoqueDeIngresos['arrIds']['k.4']]);
            }

            if(isset($arrEnfoqueDeIngresos['arrIds']['k.5'])){
                $camposFexavaAvaluo['EIIMPORTE'] = (String)($arrEnfoqueDeIngresos['arrElementos'][$arrEnfoqueDeIngresos['arrIds']['k.5']]);
            }
        }
        return $camposFexavaAvaluo;        

    }

    /// <summary>
        /// Inserta los datos referentes al resumen conclusion del avaluo en el dseAvaluos desde el
        /// elemento xml.
        /// </summary>
        /// <param name="conclusionAvaluo">Elemento xml con los datos de la conclusion del avaluo.</param>
    public function guardarAvaluoResumenConclusionAvaluo($xmlConclusionAvaluo, $camposFexavaAvaluo, $elementoPrincipal){
        $conclusionAvaluo = $xmlConclusionAvaluo->xpath($elementoPrincipal.'//ConclusionDelAvaluo[@id="o"]');
        
        $arrConclusionAvaluo = $this->obtenElementosPrincipal($conclusionAvaluo);

        if(isset($arrConclusionAvaluo['arrIds']['o.1'])){
            $errores = valida_AvaluoConclusionDelAvaluoComercial($conclusionAvaluo, $elementoPrincipal);    
            if(count($errores) > 0){
                return array('ERROR' => $errores);
            }
            $camposFexavaAvaluo['VALORCOMERCIAL'] = (String)($arrConclusionAvaluo['arrElementos'][$arrConclusionAvaluo['arrIds']['o.1']]);
        }

        if(isset($arrConclusionAvaluo['arrIds']['o.2'])){
            $errores = valida_AvaluoConclusionDelAvaluoCatastral($conclusionAvaluo, $elementoPrincipal);    
            if(count($errores) > 0){
                return array('ERROR' => $errores);
            }
            $camposFexavaAvaluo['VALORCATASTRAL'] = (String)($arrConclusionAvaluo['arrElementos'][$arrConclusionAvaluo['arrIds']['o.2']]);
        }
        return $camposFexavaAvaluo;
    }

    /// <summary>
        /// Inserta los datos referentes al valor referido del avaluo en el dseAvaluos desde el elemento
        /// xml.
        /// </summary>
        /// <param name="valorReferido">Elemento xml con los datos del valor referido del avaluo.</param>
    public function guardarAvaluoValorReferido($xmlValorReferido, $camposFexavaAvaluo, $elementoPrincipal){
        $valorReferido = $xmlValorReferido->xpath($elementoPrincipal.'//ValorReferido[@id="p"]');

        $errores = valida_AvaluoValorReferido($valorReferido, $elementoPrincipal);    
            if(count($errores) > 0){
                return array('ERROR' => $errores);
            }

        $arrValorReferido = $this->obtenElementosPrincipal($valorReferido);

        if(isset($arrValorReferido['arrIds']['p.1'])){
            $camposFexavaAvaluo['FECHAVALORREFERIDO'] = (String)($arrValorReferido['arrElementos'][$arrValorReferido['arrIds']['p.1']]);
        }
        if(isset($arrValorReferido['arrIds']['p.2'])){
            $camposFexavaAvaluo['VALORREFERIDO'] = (String)($arrValorReferido['arrElementos'][$arrValorReferido['arrIds']['p.2']]);
        }

        return $camposFexavaAvaluo;
    }

    /// <summary>
        /// Inserta los datos referentes al anexo fotografico del avaluo en el dseAvaluos desde el
        /// elemento xml.
        /// </summary>
        /// <param name="transactionHelper">La transacción ayudante.</param>
        /// <param name="anexoFotografico">Elemento xml con los datos del anexo fotografico del avaluo.</param>
    public function guardarAvaluoAnexoFotografico($xmlAnexoFotografico, $camposFexavaAvaluo, $elementoPrincipal){
        $cuentaCatastralStr = '';
        $indiceCuentaCatastral = '1';
        $anexoFotografico = $xmlAnexoFotografico->xpath($elementoPrincipal.'//AnexoFotografico[@id="q"]');

        $errores = valida_AvaluoAnexoFotografico($anexoFotografico, $elementoPrincipal);    
            if(count($errores) > 0){
                return array('ERROR' => $errores);
            }

        $arrAnexoFotografico = $this->obtenElementosPrincipal($anexoFotografico);
        if(isset($arrAnexoFotografico['arrIds']['q.1'])){
            $cuentaCatastral = $xmlAnexoFotografico->xpath($elementoPrincipal.'//AnexoFotografico[@id="q"]//'.$arrAnexoFotografico['arrIds']['q.1'].'[@id="q.1"]//CuentaCatastral[@id="q.1.1"]');            
            $arrCuentaCatastral = $this->obtenElementosPrincipal($cuentaCatastral);
            //print_r($arrCuentaCatastral); exit();
            if(isset($arrCuentaCatastral['arrIds']['q.1.1.1'])){
                
                $cuentaCatastralStr .= (String)($arrCuentaCatastral['arrElementos'][$arrCuentaCatastral['arrIds']['q.1.1.1']]);
            }

            if(isset($arrCuentaCatastral['arrIds']['q.1.1.2'])){
                $cuentaCatastralStr .= (String)($arrCuentaCatastral['arrElementos'][$arrCuentaCatastral['arrIds']['q.1.1.2']]);
            }

            if(isset($arrCuentaCatastral['arrIds']['q.1.1.3'])){
                $cuentaCatastralStr .= (String)($arrCuentaCatastral['arrElementos'][$arrCuentaCatastral['arrIds']['q.1.1.3']]);
            }

            if(isset($arrCuentaCatastral['arrIds']['q.1.1.4'])){
                $cuentaCatastralStr .= (String)($arrCuentaCatastral['arrElementos'][$arrCuentaCatastral['arrIds']['q.1.1.4']]);
            }

            $fotosInmuebleAvaluo = $xmlAnexoFotografico->xpath($elementoPrincipal.'//AnexoFotografico[@id="q"]//'.$arrAnexoFotografico['arrIds']['q.1'].'[@id="q.1"]//FotosInmuebleAvaluo[@id="q.1.2"]');            
            $arrFotosInmuebleAvaluo = $this->obtenElementos($fotosInmuebleAvaluo);            
            $camposFexavaAvaluo['FEXAVA_FOTOAVALUO'] = array();
            for($i=0;$i<count($fotosInmuebleAvaluo);$i++){
                if(isset($arrFotosInmuebleAvaluo['arrIds'][$i]['q.1.2.n.2'])){
                    $tipoFoto = $this->tipoInmueble((String)($arrFotosInmuebleAvaluo['arrElementos'][$i][$arrFotosInmuebleAvaluo['arrIds'][$i]['q.1.2.n.2']]));                    
                }

                if(isset($arrFotosInmuebleAvaluo['arrIds'][$i]['q.1.2.n.1'])){
                    $idFoto = 0;
                    $nombreFoto = $indiceCuentaCatastral."_".$cuentaCatastralStr.".jpg";

                    //Aqui se inserta el docto 
                    /*idFoto = doc_trans.Tran_InsertFotoInmueble(
                        transactionHelper,
                        Convert.FromBase64String(queryn.ToStringXElement()),
                        nombreFoto,
                        Constantes.NOMBRE_FOTOS_PREFIJO + nombreFoto,
                        dseAvaluos.FEXAVA_AVALUO[0].FECHAAVALUO,
                        tipoFoto, null).Value;*/
                }
                $indiceCuentaCatastral = $indiceCuentaCatastral +1;
                /****Pendiente******/
                //Reemplazamos en el XML del avaluo, la foto por el id obtenido de documental.
                $camposFexavaAvaluo['FEXAVA_FOTOAVALUO'][$i]['IDDOCUMENTOFOTO'] = $idFoto;
            }
            
           
        }

      /****************************************************Comparable Rentas*****************************************/
        if(isset($arrAnexoFotografico['arrIds']['q.2'])){
            $camposFexavaAvaluo['FEXAVA_FOTOCOMPARABLE'] = array();
            $comparableRentas = $xmlAnexoFotografico->xpath($elementoPrincipal.'//AnexoFotografico[@id="q"]//'.$arrAnexoFotografico['arrIds']['q.2'].'[@id="q.2"]');            
            $arrComparableRentas = $this->obtenElementos($comparableRentas);
            //$listCuentaCatastral = array();
            
            for($i=0;$i < count($comparableRentas); $i++){
                $listCuentaCatastral = array();
                if(isset($arrComparableRentas['arrIds'][$i]['q.2.n.1'])){
                    //print_r($arrComparableRentas['arrElementos'][$i][$arrComparableRentas['arrIds'][$i]['q.2.n.1']]); exit();
                    $infoCuenta = $arrComparableRentas['arrElementos'][$i][$arrComparableRentas['arrIds'][$i]['q.2.n.1']];
                    $listCuentaCatastral[] = (String)($infoCuenta->Region);
                    $listCuentaCatastral[] = (String)($infoCuenta->Manzana);
                    $listCuentaCatastral[] = (String)($infoCuenta->Lote);
                    $listCuentaCatastral[] = (String)($infoCuenta->Localidad);
                    $cuentaCatastralStr = '';
                    foreach($listCuentaCatastral as $elementoCuenta){
                        $cuentaCatastralStr .= $elementoCuenta;
                    }                
                    
                }                
                $indiceCuentaCatastral = 1;

                if(isset($arrComparableRentas['arrIds'][$i]['q.2.n.2'])){
                    $fotosInmuebleAvaluo = $xmlAnexoFotografico->xpath($elementoPrincipal.'//AnexoFotografico[@id="q"]//'.$arrAnexoFotografico['arrIds']['q.2'].'[@id="q.2"]//FotosInmuebleAvaluo[@id="q.2.n.2"]');
                    $arrFotosInmuebleAvaluo = $this->obtenElementos($fotosInmuebleAvaluo);

                    for($e=0;$e<count($fotosInmuebleAvaluo);$e++){
                        if(isset($arrFotosInmuebleAvaluo['arrIds'][$e]['q.2.n.2.n.2'])){
                            $tipoFoto = $this->tipoInmueble((String)($arrFotosInmuebleAvaluo['arrElementos'][$e][$arrFotosInmuebleAvaluo['arrIds'][$e]['q.2.n.2.n.2']]));
                        }

                        if(isset($arrFotosInmuebleAvaluo['arrIds'][$e]['q.2.n.2.n.1'])){
                            $nombreFoto = $indiceCuentaCatastral."_".".jpg";
                            
                            //Insertamos en Documental. Nos devuelve el id de la foto.
                            //AQUI USAMOS 
                            /*decimal idFoto = doc_trans.Tran_InsertFotoInmueble(
                                transactionHelper,
                                Convert.FromBase64String(querynn.ToStringXElement()),
                                nombreFoto,
                                Constantes.NOMBRE_FOTOS_PREFIJO + nombreFoto,
                                dseAvaluos.FEXAVA_AVALUO[0].FECHAAVALUO,
                                tipoFoto, null).Value; */

                                $indiceCuentaCatastral = $indiceCuentaCatastral + 1;

                                //Reemplazar en el XML del avaluo, la foto por el id obtenido de documental.

                                if(count($listCuentaCatastral) == 4){
                                    $cadenaSelect = "REGION = '".$listCuentaCatastral[0]."' AND MANZANA = '".$listCuentaCatastral[1]."' AND LOTE = '".$listCuentaCatastral[2]."' AND UNIDADPRIVATIVA = '".$listCuentaCatastral[3]."' AND ROWNUM = 1";
                                    $investProductosCompRow = DB::select("SELECT * FROM FEXAVA_INVESTPRODUCTOSCOMP WHERE ".$cadenaSelect);
                                    //print_r($investProductosCompRow);
                                    $arrInvestProductosCompRow = array();
                                    foreach($investProductosCompRow[0] as $llaveRenglon => $elementoRenglon){
                                        $arrInvestProductosCompRow[$llaveRenglon] = $elementoRenglon;
                                    }
                                    $camposFexavaAvaluo['FEXAVA_FOTOCOMPARABLE'][$e]['FEXAVA_INVESTPRODUCTOSCOMP'] = $arrInvestProductosCompRow;
                                    $camposFexavaAvaluo['FEXAVA_FOTOCOMPARABLE'][$e]['IDDOCUMENTOFOTO'] = $idFoto;
                                    
                                }
                        }
                    }
                    
                    

                    //exit();
                }

            }
            
        
        }

        /****************************************************Comparable Ventas*****************************************/

        if(isset($arrAnexoFotografico['arrIds']['q.3'])){
            $comparableVentas = $xmlAnexoFotografico->xpath($elementoPrincipal.'//AnexoFotografico[@id="q"]//'.$arrAnexoFotografico['arrIds']['q.3'].'[@id="q.3"]');            
            $arrComparableVentas = $this->obtenElementos($comparableVentas);
            //$listCuentaCatastral = array();

            for($i=0;$i < count($comparableVentas); $i++){
                $listCuentaCatastral = array();
                if(isset($arrComparableVentas['arrIds'][$i]['q.3.n.1'])){
                    
                    $infoCuenta = $arrComparableVentas['arrElementos'][$i][$arrComparableVentas['arrIds'][$i]['q.3.n.1']];
                    $listCuentaCatastral[] = (String)($infoCuenta->Region);
                    $listCuentaCatastral[] = (String)($infoCuenta->Manzana);
                    $listCuentaCatastral[] = (String)($infoCuenta->Lote);
                    $listCuentaCatastral[] = (String)($infoCuenta->Localidad);
                    $cuentaCatastralStr = '';
                    foreach($listCuentaCatastral as $elementoCuenta){
                        $cuentaCatastralStr .= $elementoCuenta;
                    }
                    
                    $indiceCuentaCatastral = 1;
                    
                    if(isset($arrComparableVentas['arrIds'][$i]['q.3.n.2'])){
                        $fotosInmuebleAvaluoVentas = $xmlAnexoFotografico->xpath($elementoPrincipal.'//AnexoFotografico[@id="q"]//'.$arrAnexoFotografico['arrIds']['q.3'].'[@id="q.3"]//FotosInmuebleAvaluo[@id="q.3.n.2"]');
                        $arrFotosInmuebleAvaluoVentas = $this->obtenElementos($fotosInmuebleAvaluoVentas);
                        $controlElementos = count($camposFexavaAvaluo['FEXAVA_FOTOCOMPARABLE']);
                        for($e=0;$e<count($fotosInmuebleAvaluoVentas);$e++){
                            if(isset($arrFotosInmuebleAvaluoVentas['arrIds'][$e]['q.3.n.2.n.2'])){
                                $tipoFoto = $this->tipoInmueble((String)($arrFotosInmuebleAvaluoVentas['arrElementos'][$e][$arrFotosInmuebleAvaluoVentas['arrIds'][$e]['q.3.n.2.n.2']]));
                            }

                            if(isset($arrFotosInmuebleAvaluoVentas['arrIds'][$e]['q.3.n.2.n.1'])){
                                $nombreFoto = $indiceCuentaCatastral."_".$cuentaCatastralStr.".jpg";

                                //Insertamos en Documental. Nos devuelve el id de la foto.
                                //AQUI USAMOS 
                                /*decimal idFoto = doc_trans.Tran_InsertFotoInmueble(
                                transactionHelper,
                                Convert.FromBase64String(querynn.ToStringXElement()),
                                nombreFoto,
                                Constantes.NOMBRE_FOTOS_PREFIJO + nombreFoto,
                                dseAvaluos.FEXAVA_AVALUO[0].FECHAAVALUO,
                                tipoFoto, null).Value; */

                                $indiceCuentaCatastral = $indiceCuentaCatastral + 1;

                                //Reemplazar en el XML del avaluo, la foto por el id obtenido de documental.

                                if(count($listCuentaCatastral) == 4){
                                    
                                    $cadenaSelect = "REGION = '".$listCuentaCatastral[0]."' AND MANZANA = '".$listCuentaCatastral[1]."' AND LOTE = '".$listCuentaCatastral[2]."' AND UNIDADPRIVATIVA = '".$listCuentaCatastral[3]."' AND ROWNUM = 1";
                                    $investProductosCompRow = DB::select("SELECT * FROM FEXAVA_INVESTPRODUCTOSCOMP WHERE ".$cadenaSelect);
                                    //print_r($investProductosCompRow);
                                    $arrInvestProductosCompRow = array();
                                    foreach($investProductosCompRow[0] as $llaveRenglon => $elementoRenglon){
                                        $arrInvestProductosCompRow[$llaveRenglon] = $elementoRenglon;
                                    }
                                    $camposFexavaAvaluo['FEXAVA_FOTOCOMPARABLE'][$controlElementos]['FEXAVA_INVESTPRODUCTOSCOMP'] = $arrInvestProductosCompRow;
                                    $camposFexavaAvaluo['FEXAVA_FOTOCOMPARABLE'][$controlElementos]['IDDOCUMENTOFOTO'] = $idFoto;
                                    
                                }
                            }
                        }
                    }
                }
            }
        }
        
        return $camposFexavaAvaluo;
    }
    
    public function obtenElementosPrincipal($arrPrincipal){
        $arrIds = array();
        $arrElementos = array();
        $arrRes = array();

            foreach($arrPrincipal[0] as $llave => $elemento){
                $arrIds[(String)($elemento['id'])] = $llave;
                $arrElementos[$llave] = $elemento;
            }
            $arrRes['arrIds'] = $arrIds;
            $arrRes['arrElementos'] = $arrElementos;        
        
        return $arrRes;
    }

    public function obtenElementos($arrPrincipal){
        $arrRes = array();

            for($i=0;$i<count($arrPrincipal);$i++){
                $arrElementos = array();
                $arrIds = array();
                foreach($arrPrincipal[$i] as $llave => $elemento){
                    $arrIds[(String)($elemento['id'])] = $llave;
                    $arrElementos[$llave] = $elemento;                    
                }

                $arrRes['arrIds'][$i] = $arrIds;
                $arrRes['arrElementos'][$i] = $arrElementos;               
            }    
        
        return $arrRes;
    }

    public function obtenerNumUnicoAv($tipo){
        $anio = date('Y');
        return "A-".$tipo."-".$anio."-";
    }

    public function esTerrenoValdio($data, $elementoPrincipal){
        $resultado = FALSE;
        $general = $data->xpath($elementoPrincipal);        
        $arrGeneral = $this->obtenElementosPrincipal($general);
        
        if(isset($arrGeneral['arrIds']['e'])){
            $descripcionDelInmueble = $data->xpath($elementoPrincipal.'//'.$arrGeneral['arrIds']['e'].'[@id="e"]//TiposDeConstruccion[@id="e.2"]');
            $arrDescripcionDelInmueble = $this->obtenElementos($descripcionDelInmueble);
            
            if(isset($arrDescripcionDelInmueble['arrIds'][0]['e.2.1']) && isset($arrDescripcionDelInmueble['arrIds'][0]['e.2.5']) && count($arrDescripcionDelInmueble['arrElementos'][0][$arrDescripcionDelInmueble['arrIds'][0]['e.2.1']]) > 0 &&  count($arrDescripcionDelInmueble['arrElementos'][0][$arrDescripcionDelInmueble['arrIds'][0]['e.2.5']]) > 0){
                
                return TRUE;
            }else{
                return FALSE;
            }
        }else{
            return $resultado;
        }
        
    }

    public function tipoInmueble($data){
        switch ($data) {
            case 'I':
                return 'I';
                break;
            
            default:
                return 'F';
                break;
        }
    }

    private function IdPeritoSociedadByRegistro($registroPerito, $esPerito)
    {
        $dsePeritosSociedades = array();

        if ($esPerito)
        { 
            $dsePeritosSociedades = $this->modelPeritoSociedad->getPeritoById($registroPerito);

            if (count($dsePeritosSociedades) > 0)
            {
                return $dsePeritosSociedades;
            }
        }
        else
        {
            $dsePeritosSociedades = $this->modelPeritoSociedad->getSociedadByIdPerito($registroPerito);

            if (count($dsePeritosSociedades) > 0)
            {
                return $dsePeritosSociedades;
            }
        }

        return -1;
    }

    private function ObtenerIdDelegacionPorNombre($nombreDelegacion)
    {
        $nombreDelegacion = strtoupper($nombreDelegacion);
        
        $rowsDelegaciones = DB::select("SELECT * FROM CAS.CAS_DELEGACION WHERE NOMBRE = '$nombreDelegacion'");

        if (count($rowsDelegaciones) > 0)
        {
            $idDelegacion = $rowsDelegaciones[0]->iddelegacion;
        }
        else
        {
            return -1;
        }

        return $idDelegacion;
    }

    private function ObtenerIdColoniaPorNombreyDelegacion($nombreColonia, $codDelegacion)
    {
        $nombreColonia = strtoupper($nombreColonia);

        $rowsDelegaciones = DB::select("SELECT * FROM CAS.CAS_DELEGACION WHERE CLAVE = '$codDelegacion'");

        if (count($rowsDelegaciones) > 0)
        {
            $idDelegacion = $rowsDelegaciones[0]->iddelegacion;
        }
        else
        {
            return -1;
        }

        $rowsColonias = DB::select("SELECT * FROM CAS.CAS_COLONIA WHERE NOMBRE = '$nombreColonia' AND IDDELEGACION = '$idDelegacion'");

        if (count($rowsColonias) > 0)
        {
            $idColonia = $rowsColonias[0]->idcolonia;
        }
        else
        {
            return -1;
        }

        return $idColonia;
    }

    private function SolicitarObtenerIdClasesByCodeAndAno($fecha, $codClase)
    {
        //FIS_CLASESEJERCICIO
        $c_filtro = DB::select("SELECT * FROM FIS.FIS_CATCLASES WHERE CODCLASE = '$codClase'");

        if(count($c_filtro) == 0){            
            return "el codigo de clase ".$codClase." no existe en el catalogo de clases";
        }else{
            return $c_filtro[0]->idclases;
        }
    }

    private function SolicitarObtenerIdUsosByCodeAndAno($fecha, $codUso)
    {
        //FIS_USOSEJERCICIO
        $c_filtro = DB::select("SELECT * FROM FIS.FIS_CATUSOS WHERE CODUSO = '$codUso'");

        if(count($c_filtro) == 0){            
            return "el codigo de uso ".$codUso." no existe en el catalogo de usos";
        }else{
            return $c_filtro[0]->idusos;
        }
    }

    private function SolicitarObtenerIdRangoNivelesByCodeAndAno($fecha, $codRangoNiveles)
    {
        //FIS_RANGONIVELESEJERCICIO
        $c_filtro = DB::select("SELECT * FROM FIS.FIS_RANGONIVELESEJERCICIO");

        if(count($c_filtro) == 0){            
            return "el codigo de rango ".$codRangoNiveles." no existe en el catalogo de rangos";
        }else{
            return $c_filtro;
        }
    }

    private function ObtenerClaseUsoByIdUsoIdClase($idUsoEjercicio, $idClaseEjercicio)
    {
        //FEXAVA_CATCLASEUSO
        $c_claseUso = DB::select("SELECT * FROM FEXAVA_CATCLASEUSO");
        
        if(count($c_claseUso) == 0){
            return "la clase uso ".$idClaseEjercicio." no existe en el catalogo de clases uso";
        }else{
            return $c_claseUso;
        }
    }
}
