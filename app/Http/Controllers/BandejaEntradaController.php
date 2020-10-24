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
        $idPersona = 1;
        $file = $request->file('files');
        $contents = $this->descomprimirCualquierFormato($file);        
        $xml = new \SimpleXMLElement($contents);        
        $elementoFecha = $xml->xpath('//Comercial//Identificacion//FechaAvaluo[@id="a.2"]');
        $fechaAvaluo = $elementoFecha[0];

        $esComercial = $xml->xpath('//Comercial');
        if(count($esComercial) > 0){
            $esComercial = true;
            $tipoTramite = 1;            
        }else{
            $esComercial = false;
            $tipoTramite = 2;            
        }
        //$camposFexavaAvaluo = $this->camposFexAva();
        $camposFexavaAvaluo = array();
        $camposFexavaAvaluo['CODESTADOAVALUO'] =  1; //CODESTADOAVALUO (Recibido)
        $fecha_hoy = new Carbon(date('Y-m-d'));
        $fecha_presentacion = $fecha_hoy->format('Y-m-d');
        $camposFexavaAvaluo['FECHA_PRESENTACION'] = $fecha_presentacion;
        $camposFexavaAvaluo['CODTIPOTRAMITE'] = $tipoTramite;

        $infoXmlIdentificacion = $xml->xpath('//Comercial//Identificacion[@id="a"]');
        $camposFexavaAvaluo = $this->guardarAvaluoIdentificacion($infoXmlIdentificacion, $camposFexavaAvaluo, $idPersona);
        $camposFexavaAvaluo['Antecedentes'] = array();
        $camposFexavaAvaluo = $this->guardarAvaluoAntecedentes($xml, $camposFexavaAvaluo);
        //$camposFexavaAvaluo['CaracteristicasUrbanas'] = array();
        $camposFexavaAvaluo = $this->guardarAvaluoCaracteristicasUrbanas($xml, $camposFexavaAvaluo);

        $camposFexavaAvaluo = $this->guardarAvaluoTerreno($xml, $camposFexavaAvaluo);

        $camposFexavaAvaluo = $this->guardarAvaluoDescripcionImueble($xml, $camposFexavaAvaluo);

        $camposFexavaAvaluo = $this->guardarAvaluoElementosConstruccion($xml, $camposFexavaAvaluo);

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

    public function guardarAvaluoIdentificacion($infoXmlIdentificacion, $camposFexavaAvaluo, $idPersona){
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
            $camposFexavaAvaluo['IDPERSONAPERITO'] = '';//aqui se usa IdPeritoSociedadByRegistro(registroPerito, string.Empty, true);
            $camposFexavaAvaluo['IDPERSONASOCIEDAD'] = '';//aqui se usa IdPeritoSociedadByRegistro(registroPerito, registroSoci, false);
        }
        
        if($camposFexavaAvaluo['CODTIPOTRAMITE'] == 2){
            $tipo = "CAT";
        }else if($camposFexavaAvaluo['CODTIPOTRAMITE'] == 1){
            $tipo = "COM";
        }
        $camposFexavaAvaluo['CODTIPOTRAMITE'] = $this->obtenerNumUnicoAv($tipo);      
        return $camposFexavaAvaluo;
    }

    public function guardarAvaluoAntecedentes($infoXmlAntecedentes, $camposFexavaAvaluo){
        $infoXmlSolicitante = $infoXmlAntecedentes->xpath('//Comercial//Antecedentes[@id="b"]//Solicitante[@id="b.1"]');
        $camposFexavaAvaluo['Antecedentes']['Solicitante'] = array();
        foreach($infoXmlSolicitante[0] as $llave => $elemento){
            $arrSolicitante[$llave] = (String)($elemento);
        }

        if(trim($arrSolicitante['A.Paterno']) != ''){
            $camposFexavaAvaluo['Antecedentes']['Solicitante']['APELLIDOPATERNO'] = $arrSolicitante['A.Paterno'];
        }
        if(trim($arrSolicitante['A.Materno']) != ''){
        $camposFexavaAvaluo['Antecedentes']['Solicitante']['APELLIDOMATERNO'] = $arrSolicitante['A.Materno'];
        }
        if(trim($arrSolicitante['Nombre']) != ''){
        $camposFexavaAvaluo['Antecedentes']['Solicitante']['NOMBRE'] = $arrSolicitante['Nombre'];
        }
        if(trim($arrSolicitante['Calle']) != ''){
        $camposFexavaAvaluo['Antecedentes']['Solicitante']['CALLE'] = $arrSolicitante['Calle'];
        }
        if(trim($arrSolicitante['NumeroInterior']) != ''){
        $camposFexavaAvaluo['Antecedentes']['Solicitante']['NUMEROINTERIOR'] = $arrSolicitante['NumeroInterior'];
        }
        if(trim($arrSolicitante['NumeroExterior']) != ''){
        $camposFexavaAvaluo['Antecedentes']['Solicitante']['NUMEROEXTERIOR'] = $arrSolicitante['NumeroExterior'];
        }
        if(trim($arrSolicitante['CodigoPostal']) != ''){
        $camposFexavaAvaluo['Antecedentes']['Solicitante']['CODIGOPOSTAL'] = $arrSolicitante['CodigoPostal'];
        }
        if(is_int($arrSolicitante['Delegacion'])){
            $camposFexavaAvaluo['Antecedentes']['Solicitante']['IDDELEGACION'] = $arrSolicitante['Delegacion'];
            $camposFexavaAvaluo['Antecedentes']['Solicitante']['NOMBREDELEGACION'] = '';
        }else{
            //aqui se obtendria el iddelegacion por el nombre
            $idDelegacion = "ObtenerIdDelegacionPorNombre()";
            if($idDelegacion != -1){
                $camposFexavaAvaluo['Antecedentes']['Solicitante']['IDDELEGACION'] = $idDelegacion;
                $camposFexavaAvaluo['Antecedentes']['Solicitante']['NOMBREDELEGACION'] = $arrSolicitante['Delegacion'];
            }
        }
        if(trim($arrSolicitante['Colonia']) != ''){
            //aqui se obtendria el idColonia por el nombre
            $idColonia = "ObtenerIdColoniaPorNombreyDelegacion()";
            if($idColonia != -1){
                $camposFexavaAvaluo['Antecedentes']['Solicitante']['IDCOLONIA'] = $idColonia;
                $camposFexavaAvaluo['Antecedentes']['Solicitante']['NOMBRECOLONIA'] = $arrSolicitante['Colonia'];
            }
        }

        if(trim($arrSolicitante['TipoPersona']) != ''){
            $camposFexavaAvaluo['Antecedentes']['Solicitante']['TIPOPERSONA'] = $arrSolicitante['TipoPersona'];
        }

        $camposFexavaAvaluo['Antecedentes']['Solicitante']['CODTIPOFUNCION'] = "S";

        /************************************************************/

        $infoXmlPropietario = $infoXmlAntecedentes->xpath('//Comercial//Antecedentes[@id="b"]//Propietario[@id="b.2"]');
        $camposFexavaAvaluo['Antecedentes']['Propietario'] = array();
        foreach($infoXmlPropietario[0] as $llave => $elemento){
            $arrPropietario[$llave] = (String)($elemento);
        }
        if(trim($arrPropietario['A.Paterno']) != ''){
            $camposFexavaAvaluo['Antecedentes']['Propietario']['APELLIDOPATERNO'] = $arrPropietario['A.Paterno'];
        }
        if(trim($arrPropietario['A.Materno']) != ''){
        $camposFexavaAvaluo['Antecedentes']['Propietario']['APELLIDOMATERNO'] = $arrPropietario['A.Materno'];
        }
        if(trim($arrPropietario['Nombre']) != ''){
        $camposFexavaAvaluo['Antecedentes']['Propietario']['NOMBRE'] = $arrPropietario['Nombre'];
        }
        if(trim($arrPropietario['Calle']) != ''){
        $camposFexavaAvaluo['Antecedentes']['Propietario']['CALLE'] = $arrPropietario['Calle'];
        }
        if(trim($arrPropietario['NumeroInterior']) != ''){
        $camposFexavaAvaluo['Antecedentes']['Propietario']['NUMEROINTERIOR'] = $arrPropietario['NumeroInterior'];
        }
        if(trim($arrPropietario['NumeroExterior']) != ''){
        $camposFexavaAvaluo['Antecedentes']['Propietario']['NUMEROEXTERIOR'] = $arrPropietario['NumeroExterior'];
        }
        if(trim($arrPropietario['CodigoPostal']) != ''){
        $camposFexavaAvaluo['Antecedentes']['Propietario']['CODIGOPOSTAL'] = $arrPropietario['CodigoPostal'];
        }
        if(is_int($arrPropietario['Delegacion'])){
            $camposFexavaAvaluo['Antecedentes']['Propietario']['IDDELEGACION'] = $arrPropietario['Delegacion'];
            $camposFexavaAvaluo['Antecedentes']['Propietario']['NOMBREDELEGACION'] = '';
        }else{
            //aqui se obtendria el iddelegacion por el nombre
            $idDelegacion = "ObtenerIdDelegacionPorNombre()";
            if($idDelegacion != -1){
                $camposFexavaAvaluo['Antecedentes']['Propietario']['IDDELEGACION'] = $idDelegacion;
                $camposFexavaAvaluo['Antecedentes']['Propietario']['NOMBREDELEGACION'] = $arrPropietario['Delegacion'];
            }
        }
        if(trim($arrPropietario['Colonia']) != ''){
            //aqui se obtendria el idColonia por el nombre
            $idColonia = "ObtenerIdColoniaPorNombreyDelegacion()";
            if($idColonia != -1){
                $camposFexavaAvaluo['Antecedentes']['Propietario']['IDCOLONIA'] = $idColonia;
                $camposFexavaAvaluo['Antecedentes']['Propietario']['NOMBRECOLONIA'] = $arrPropietario['Colonia'];
            }
        }

        if(trim($arrPropietario['TipoPersona']) != ''){
            $camposFexavaAvaluo['Antecedentes']['Propietario']['TIPOPERSONA'] = $arrPropietario['TipoPersona'];
        }
        
        $camposFexavaAvaluo['Antecedentes']['Propietario']['PERSONA_PROPIETARIO'] = "P";

        /************************************************************/

        $infoXmlCuentaCatastral = $infoXmlAntecedentes->xpath('//Comercial//Antecedentes[@id="b"]//InmuebleQueSeValua[@id="b.3"]//CuentaCatastral[@id="b.3.10"]');
        $camposFexavaAvaluo['Antecedentes']['CuentaCatastral'] = array();
        foreach($infoXmlCuentaCatastral[0] as $llave => $elemento){
            $arrCuentaCatastral[$llave] = (String)($elemento);
        }
        
        if(trim($arrCuentaCatastral['Region'] != '')){
            $camposFexavaAvaluo['Antecedentes']['CuentaCatastral']['REGION'] = $arrCuentaCatastral['Region'];
        }

        if(trim($arrCuentaCatastral['Manzana'] != '')){
            $camposFexavaAvaluo['Antecedentes']['CuentaCatastral']['MANZANA'] = $arrCuentaCatastral['Manzana'];
        }

        if(trim($arrCuentaCatastral['Lote'] != '')){
            $camposFexavaAvaluo['Antecedentes']['CuentaCatastral']['LOTE'] = $arrCuentaCatastral['Lote'];
        }

        if(trim($arrCuentaCatastral['Localidad'] != '')){
            $camposFexavaAvaluo['Antecedentes']['CuentaCatastral']['UNIDADPRIVATIVA'] = $arrCuentaCatastral['Localidad'];
        }

        if(trim($arrCuentaCatastral['DigitoVerificador'] != '')){
            $camposFexavaAvaluo['Antecedentes']['CuentaCatastral']['DIGITOVERIFICADOR'] = $arrCuentaCatastral['DigitoVerificador'];
        }

        /************************************************************/

        $infoXmlPropositoDelAvaluo = $infoXmlAntecedentes->xpath('//Comercial//Antecedentes[@id="b"]//PropositoDelAvaluo[@id="b.4"]');
        $camposFexavaAvaluo['Antecedentes']['PROPOSITO'] = (String)($infoXmlPropositoDelAvaluo[0]);

        /************************************************************/

        $infoXmlObjetoDelAvaluo = $infoXmlAntecedentes->xpath('//Comercial//Antecedentes[@id="b"]//ObjetoDelAvaluo[@id="b.5"]');
        $camposFexavaAvaluo['Antecedentes']['OBJETO'] = (String)($infoXmlObjetoDelAvaluo[0]);

        

        return $camposFexavaAvaluo;
    }

    public function guardarAvaluoCaracteristicasUrbanas($infoXmlCaracteristicas, $camposFexavaAvaluo){
        $infoXmlCaracteristicasUrbanas = $infoXmlCaracteristicas->xpath('//Comercial//CaracteristicasUrbanas[@id="c"]');
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
            $idClaseEjercicio = "SolicitarObtenerIdClasesByCodeAndAno(fechaAvaluo, codClase)";
            $camposFexavaAvaluo['CUCODCLASESCONSTRUCCION'] = $idClaseEjercicio;
        }

        if(trim($arrCaracteristicasUrbanas['DensidadDePoblacion']) != ''){
            $camposFexavaAvaluo['CUCODDENSIDADPOBLACION'] = $arrCaracteristicasUrbanas['DensidadDePoblacion'];
        }

        if(trim($arrCaracteristicasUrbanas['NivelSocioeconomicoDeLaZona']) != ''){
            $camposFexavaAvaluo['CUCODNIVELSOCIOECONOMICO'] = $arrCaracteristicasUrbanas['NivelSocioeconomicoDeLaZona'];
        }

        /********************************Uso del Suelo**********************************/
        $infoXmlUsoDelSuelo = $infoXmlCaracteristicas->xpath('//Comercial//CaracteristicasUrbanas[@id="c"]//UsoDelSuelo[@id="c.6"]');        
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

        $infoXmlServiciosPublicosYEquipamientoUrbano = $infoXmlCaracteristicas->xpath('//Comercial//CaracteristicasUrbanas[@id="c"]//ServiciosPublicosYEquipamientoUrbano[@id="c.8"]');        
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

    public function guardarAvaluoTerreno($infoXmlTerreno, $camposFexavaAvaluo){        
        $infoXmlCallesTransversalesLimitrofesYOrientacion = $infoXmlTerreno->xpath('//Comercial//Terreno[@id="d"]//CallesTransversalesLimitrofesYOrientacion[@id="d.1"]');        
        $query = (String)($infoXmlCallesTransversalesLimitrofesYOrientacion[0]);

        $infoXmlCroquisMicroLocalizacion = $infoXmlTerreno->xpath('//Comercial//Terreno[@id="d"]//CroquisMicroLocalizacion[@id="d.2"]');        
        $queryMicro = (String)($infoXmlCroquisMicroLocalizacion[0]);
        
        $infoXmlCroquisMacroLocalizacion = $infoXmlTerreno->xpath('//Comercial//Terreno[@id="d"]//CroquisMacroLocalizacion[@id="d.3"]');        
        $queryMacro = (String)($infoXmlCroquisMacroLocalizacion[0]);

        //AQUI FALTA GUARDAR LAS FOTOS Y CAMBIAR LO QUE TRAIA DE INFORMACION EN EL XML POR LOS ID OBTENIDOS Tran_InsertFichero

        $infoXmlEscritura = $infoXmlTerreno->xpath('//Comercial//Terreno[@id="d"]//MedidasYColindancias[@id="d.4"]//FuenteDeInformacionLegal[@id="d.4.1"]//Escritura[@id="d.4.1.1"]');
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
        
        $arrPrincipalFuente = $infoXmlTerreno->xpath('//Comercial//Terreno[@id="d"]//MedidasYColindancias[@id="d.4"]//FuenteDeInformacionLegal[@id="d.4.1"]');
        $arrIdsFuenteDeInformacionLegal = array();
        $arrFuenteDeInformacionLegal = array();
        foreach($arrPrincipalFuente[0] as $llave => $elemento){
            $arrIdsFuenteDeInformacionLegal[(String)($elemento['id'])] = $llave;
            $arrFuenteDeInformacionLegal[$llave] = $elemento;
        }
        
        if(isset($arrIdsFuenteDeInformacionLegal['d.4.1.2'])){
            $etiqueta = $arrIdsFuenteDeInformacionLegal['d.4.1.2'];
            $camposFexavaAvaluo['FEXAVA_FUENTEINFORMACIONLEG'] = array();
            $infoXmlSentencia = $infoXmlTerreno->xpath('//Comercial//Terreno[@id="d"]//MedidasYColindancias[@id="d.4"]//FuenteDeInformacionLegal[@id="d.4.1"]//'.$etiqueta.'[@id="d.4.1.2"]');
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
                $infoXmlContratoPrivado = $infoXmlTerreno->xpath('//Comercial//Terreno[@id="d"]//MedidasYColindancias[@id="d.4"]//FuenteDeInformacionLegal[@id="d.4.1"]//'.$etiqueta.'[@id="d.4.1.3"]');
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
            $infoXmlAlineamiento = $infoXmlTerreno->xpath('//Comercial//Terreno[@id="d"]//MedidasYColindancias[@id="d.4"]//FuenteDeInformacionLegal[@id="d.4.1"]//'.$etiqueta.'[@id="d.4.1.4"]');
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

        $arrPrincipalSuperficie = $infoXmlTerreno->xpath('//Comercial//Terreno[@id="d"]//SuperficieDelTerreno[@id="d.5"]');
        $arrIdsSuperficieDelTerreno = array();
        $arrSuperficieDelTerreno = array();
        foreach($arrPrincipalSuperficie[0] as $llave => $elemento){
            $arrIdsSuperficieDelTerreno[(String)($elemento['id'])] = $llave;
            $SuperficieDelTerreno[$llave] = $elemento;
        }
        
        if(isset($arrIdsSuperficieDelTerreno['d.5.1'])){
            $etiqueta = $arrIdsFuenteDeInformacionLegal['d.5.1'];
            $camposFexavaAvaluo['FEXAVA_SUPERFICIE'] = array();
            $infoXmlSuperficieDelTerreno = $infoXmlTerreno->xpath('//Comercial//Terreno[@id="d"]//SuperficieDelTerreno[@id="d.5"]//'.$etiqueta.'[@id="d.5.1"]');
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
            $infoXmlSuperficieDelTerrenoComun = $infoXmlTerreno->xpath('//Comercial//Terreno[@id="d"]//SuperficieDelTerreno[@id="d.5"]//'.$etiqueta.'[@id="d.5.2"]');
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

        $arrPrincipalIndiviso = $infoXmlTerreno->xpath('//Comercial//Terreno[@id="d"]//Indiviso[@id="d.6"]');        
        if(trim((String)($arrPrincipalIndiviso[0])) != ''){
            $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['TEINDIVISO'] = (String)($arrPrincipalIndiviso[0]);
        }

        $arrPrincipalTopografiaYConfiguracion = $infoXmlTerreno->xpath('//Comercial//Terreno[@id="d"]//TopografiaYConfiguracion[@id="d.7"]');
        if(trim((String)($arrPrincipalTopografiaYConfiguracion[0])) != ''){
            $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['CUCODTOPOGRAFIA'] = (String)($arrPrincipalTopografiaYConfiguracion[0]);
        }

        $arrPrincipalCaracteristicasPanoramicas = $infoXmlTerreno->xpath('//Comercial//Terreno[@id="d"]//CaracteristicasPanoramicas[@id="d.8"]');
        if(trim((String)($arrPrincipalCaracteristicasPanoramicas[0])) != ''){
            $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['TECARACTERISTICASPARONAMICAS'] = (String)($arrPrincipalCaracteristicasPanoramicas[0]);
        }

        $arrPrincipalDensidadHabitacional = $infoXmlTerreno->xpath('//Comercial//Terreno[@id="d"]//DensidadHabitacional[@id="d.9"]');
        if(trim((String)($arrPrincipalDensidadHabitacional[0])) != ''){
            $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['TECODDENSIDADHABITACIONAL'] = (String)($arrPrincipalDensidadHabitacional[0]);
        }

        $arrPrincipalServidumbresORestricciones  = $infoXmlTerreno->xpath('//Comercial//Terreno[@id="d"]//ServidumbresORestricciones[@id="d.10"]');
        if(trim((String)($arrPrincipalServidumbresORestricciones[0])) != ''){
            $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['TESERVIDUMBRESORESTRICCIONES'] = (String)($arrPrincipalServidumbresORestricciones[0]);
        }       

        return $camposFexavaAvaluo;
    }

    public function guardarAvaluoDescripcionImueble($infoXmlTerreno, $camposFexavaAvaluo){

        $fechaAvaluo = $camposFexavaAvaluo['FECHAAVALUO'];

        $arrPrincipalUsoActual = $infoXmlTerreno->xpath('//Comercial//DescripcionDelInmueble[@id="e"]//UsoActual[@id="e.1"]');        
        if(trim((String)($arrPrincipalUsoActual[0])) != ''){
            $camposFexavaAvaluo['FEXAVA_SUPERFICIE']['DIUSOACTUAL'] = (String)($arrPrincipalUsoActual[0]);
        }
                    
        
        /**********************************************Tipos de Construccion*********************************************/
        $arrPrincipalDescripcionDelInmueble = $infoXmlTerreno->xpath('//Comercial//DescripcionDelInmueble[@id="e"]');        
        $arrIdsDescripcionDelInmueble = array();
        $arrDescripcionDelInmueble = array();
        foreach($arrPrincipalDescripcionDelInmueble[0] as $llave => $elemento){
            $arrIdsDescripcionDelInmueble[(String)($elemento['id'])] = $llave;
            $arrDescripcionDelInmueble[$llave] = $elemento;
        }
        

        /**********************************************Construcciones Privativas*****************************************/
        if(isset($arrIdsDescripcionDelInmueble['e.2'])){
            $usoActual = $infoXmlTerreno->xpath('//Comercial//DescripcionDelInmueble[@id="e"]//TiposDeConstruccion[@id="e.2"]');
            $arrPrincipalUsoActual = $this->obtenElementosPrincipal($usoActual);                        
            $camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION'] = array();
            
            if(isset($arrPrincipalUsoActual['arrIds']['e.2.1'])){                
               $construccionesPrivativas = $infoXmlTerreno->xpath('//Comercial//DescripcionDelInmueble[@id="e"]//TiposDeConstruccion[@id="e.2"]//'.$arrPrincipalUsoActual['arrIds']['e.2.1'].'[@id="e.2.1"]');
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
                $construccionesComunes = $infoXmlTerreno->xpath('//Comercial//DescripcionDelInmueble[@id="e"]//TiposDeConstruccion[@id="e.2"]//'.$arrPrincipalUsoActual['arrIds']['e.2.5'].'[@id="e.2.5"]');
                $arrConstruccionesComunes = $this->obtenElementos($construccionesComunes);                       
                $controlElemento = count($camposFexavaAvaluo['FEXAVA_TIPOCONSTRUCCION']) - 1;
                for($i=0;$i<count($construccionesComunes);$i++){
                    $controlElemento = $controlElemento + 1;
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
                }                

            }

            /*********************************************************************************************************************/

            if(isset($arrPrincipalUsoActual['arrIds']['e.2.3'])){
                $valorTotalDeConstruccionesPrivativas = $infoXmlTerreno->xpath('//Comercial//DescripcionDelInmueble[@id="e"]//ValorTotalDeConstruccionesPrivativas[@id="e.2.3"]');
                if(trim($valorTotalDeConstruccionesPrivativas[0]) != ''){
                    $camposFexavaAvaluo['DIVALORTOTALCONSPRIVATIVAS'] = (String)($valorTotalDeConstruccionesPrivativas[0]);
                }
            }

            if(isset($arrPrincipalUsoActual['arrIds']['e.2.7'])){
                $valorTotalDeConstruccionesComunes = $infoXmlTerreno->xpath('//Comercial//DescripcionDelInmueble[@id="e"]//ValorTotalDeConstruccionesComunes[@id="e.2.7"]');
                if(trim($valorTotalDeConstruccionesComunes[0]) != ''){
                    $camposFexavaAvaluo['DIVALORTOTALCONSTCOMUNES'] = (String)($valorTotalDeConstruccionesComunes[0]);
                }
            }        
        }

        if(isset($arrIdsDescripcionDelInmueble['e.3'])){
            $vidaUtilTotalPonderadaDelInmueble = $infoXmlTerreno->xpath('//Comercial//DescripcionDelInmueble[@id="e"]//VidaUtilTotalPonderadaDelInmueble[@id="e.3"]');

            if(trim($vidaUtilTotalPonderadaDelInmueble[0]) != ''){
                $camposFexavaAvaluo['DIVIDAUTILPONDERADA'] = (String)($vidaUtilTotalPonderadaDelInmueble[0]);
            }
        }

        if(isset($arrIdsDescripcionDelInmueble['e.4'])){
            $edadPonderadaDelInmueble = $infoXmlTerreno->xpath('//Comercial//DescripcionDelInmueble[@id="e"]//EdadPonderadaDelInmueble[@id="e.4"]');
            
            if(trim($edadPonderadaDelInmueble[0]) != ''){
                $camposFexavaAvaluo['DIEDADPONDERADA'] = (String)($edadPonderadaDelInmueble[0]);
            }
        }

        if(isset($arrIdsDescripcionDelInmueble['e.5'])){
            $vidaUtilRemanentePonderadaDelInmueble = $infoXmlTerreno->xpath('//Comercial//DescripcionDelInmueble[@id="e"]//VidaUtilRemanentePonderadaDelInmueble[@id="e.5"]');
            
            if(trim($vidaUtilRemanentePonderadaDelInmueble[0]) != ''){
                $camposFexavaAvaluo['DIVIDAUTILREMANENTEPONDERADA'] = (String)($vidaUtilRemanentePonderadaDelInmueble[0]);
            }
        }

        if(isset($arrIdsDescripcionDelInmueble['e.6'])){
            $porcentSuperfUltimNivelRespectoAnterior = $infoXmlTerreno->xpath('//Comercial//DescripcionDelInmueble[@id="e"]//PorcentSuperfUltimNivelRespectoAnterior[@id="e.6"]');
            
            if(trim($porcentSuperfUltimNivelRespectoAnterior[0]) != ''){
                $camposFexavaAvaluo['DIPORCENTAJESUPULTNIVEL'] = (String)($porcentSuperfUltimNivelRespectoAnterior[0]);
            }
        }

        return $camposFexavaAvaluo;

    }

    public function guardarAvaluoElementosConstruccion($infoXmlElementosConst, $camposFexavaAvaluo){

        $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST'] = array();

        $elementosConst = $infoXmlElementosConst->xpath('//Comercial//ElementosDeLaConstruccion[@id="f"]');
        $arrPrincipalElementosConst = $this->obtenElementosPrincipal($elementosConst);       

        if(isset($arrPrincipalElementosConst['arrIds']['f.1']) && count($arrPrincipalElementosConst['arrElementos'][$arrPrincipalElementosConst['arrIds']['f.1']]) > 0){
            $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_OBRANEGRA'] = array();
            $obraNegra = $infoXmlElementosConst->xpath('//Comercial//ElementosDeLaConstruccion[@id="f"]//'.$arrPrincipalElementosConst['arrIds']['f.1'].'[@id="f.1"]');
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
            $obraRevestimientos = $infoXmlElementosConst->xpath('//Comercial//ElementosDeLaConstruccion[@id="f"]//'.$arrPrincipalElementosConst['arrIds']['f.2'].'[@id="f.2"]');
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
                $carpinteria = $infoXmlElementosConst->xpath('//Comercial//ElementosDeLaConstruccion[@id="f"]//'.$arrPrincipalElementosConst['arrIds']['f.3'].'[@id="f.3"]');
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
            $hidraulicos = $infoXmlElementosConst->xpath('//Comercial//ElementosDeLaConstruccion[@id="f"]//'.$arrPrincipalElementosConst['arrIds']['f.4'].'[@id="f.4"]');
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
            $electricas = $infoXmlElementosConst->xpath('//Comercial//ElementosDeLaConstruccion[@id="f"]//InstalacionesElectricasYAlumbrado[@id="f.16"]');    
            $camposFexavaAvaluo['IEYALUMBRADO'] = (String)($electricas[0]);
        }

        /*********************************************Puertas y ventanería metálica**********************************************************************/

        if(isset($arrPrincipalElementosConst['arrIds']['f.5']) && count($arrPrincipalElementosConst['arrElementos'][$arrPrincipalElementosConst['arrIds']['f.5']]) > 0){
            $camposFexavaAvaluo['FEXAVA_ELEMENTOSCONST']['FEXAVA_PUERTASYVENTANERIA'] = array();
            $puertasYVentanas = $infoXmlElementosConst->xpath('//Comercial//ElementosDeLaConstruccion[@id="f"]//'.$arrPrincipalElementosConst['arrIds']['f.5'].'[@id="f.5"]');
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
            $electricas = $infoXmlElementosConst->xpath('//Comercial//ElementosDeLaConstruccion[@id="f"]//Vidreria[@id="f.6"]');    
            $camposFexavaAvaluo['VIDRERIA'] = (String)($electricas[0]);
        }

        if(isset($arrPrincipalElementosConst['arrIds']['f.7'])){
            $cerrajeria = $infoXmlElementosConst->xpath('//Comercial//ElementosDeLaConstruccion[@id="f"]//Cerrajeria[@id="f.7"]');    
            $camposFexavaAvaluo['CERRAJERIA'] = (String)($cerrajeria[0]);
        }

        if(isset($arrPrincipalElementosConst['arrIds']['f.8'])){
            $fachadas = $infoXmlElementosConst->xpath('//Comercial//ElementosDeLaConstruccion[@id="f"]//Fachadas[@id="f.8"]');    
            $camposFexavaAvaluo['FACHADAS'] = (String)($fachadas[0]);
        }

        /********************************************************Instalaciones Especiales. Privativas******************************************************************/

        

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
        $arrIds = array();
        $arrElementos = array();
        $arrRes = array();

        //if(count($arrPrincipal) > 1){
            for($i=0;$i<count($arrPrincipal);$i++){

                foreach($arrPrincipal[$i] as $llave => $elemento){
                    $arrIds[(String)($elemento['id'])] = $llave;
                    $arrElementos[$llave] = $elemento;                    
                }

                $arrRes['arrIds'][$i] = $arrIds;
                $arrRes['arrElementos'][$i] = $arrElementos;               
            }     

        /*}else{

            foreach($arrPrincipal[0] as $llave => $elemento){
                $arrIds[(String)($elemento['id'])] = $llave;
                $arrElementos[$llave] = $elemento;
            }
            $arrRes['arrIds'] = $arrIds;
            $arrRes['arrElementos'] = $arrElementos;

        }*/
        
        return $arrRes;
    }

    public function obtenerNumUnicoAv($tipo){
        $anio = date('Y');
        return "A-".$tipo."-".$anio."-";
    }
}
