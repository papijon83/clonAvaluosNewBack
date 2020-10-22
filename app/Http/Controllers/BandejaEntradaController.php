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
<<<<<<< HEAD
    
    function descomprimirCualquierFormato($archivo){
        //var_dump($request);
        //$archivo = $request->file('files');        
        
        if($this->validarTamanioFichero(filesize($archivo)) == FALSE){
=======

    function descomprimirCualquierFormato(Request $request)
    {
        //var_dump($request);
        $archivo = $request->file('files');

        if ($this->validarTamanioFichero(filesize($archivo)) == FALSE) {
>>>>>>> 41fe191a9f3b68ea366a71bfc94f97dacf3e4bc8
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
<<<<<<< HEAD
                    $myfile = fopen($rutaArchivos."/".$nombreDes, "r");
                    $res = fread($myfile, filesize($rutaArchivos."/".$nombreDes));
                    //$res = simplexml_load_file($rutaArchivos."/".$nombreDes);
                    fclose($myfile);
                    shell_exec("rm -f ".$rutaArchivos."/".str_replace(" ","\ ",$nombreDes));
                }else{
=======
                    $res = response()->json(simplexml_load_file($rutaArchivos . "/" . $nombreDes), 200);
                    shell_exec("rm -f " . $rutaArchivos . "/" . str_replace(" ", "\ ", $nombreDes));
                } else {
>>>>>>> 41fe191a9f3b68ea366a71bfc94f97dacf3e4bc8
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
<<<<<<< HEAD
                    $myfile = fopen($rutaArchivos."/".$nombreDes, "r");
                    $res = fread($myfile, filesize($rutaArchivos."/".$nombreDes));
                    //$res = simplexml_load_file($rutaArchivos."/".$nombreDes);
                    fclose($myfile);                   
                    shell_exec("rm -f ".$rutaArchivos."/".str_replace(" ","\ ",$nombreDes));
                }else{
=======
                    $res = response()->json(simplexml_load_file($rutaArchivos . "/" . $nombreDes), 200);
                    shell_exec("rm -f " . $rutaArchivos . "/" . str_replace(" ", "\ ", $nombreDes));
                } else {
>>>>>>> 41fe191a9f3b68ea366a71bfc94f97dacf3e4bc8
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
<<<<<<< HEAD
                    $myfile = fopen($rutaArchivos."/".$nombreDes, "r");
                    $res = fread($myfile, filesize($rutaArchivos."/".$nombreDes));
                    //$res = simplexml_load_file($rutaArchivos."/".$nombreDes);
                    fclose($myfile);
                    shell_exec("rm -f ".$rutaArchivos."/".str_replace(" ","\ ",$nombreDes));
                }else{
=======
                    $res = response()->json(simplexml_load_file($rutaArchivos . "/" . $nombreDes), 200);
                    shell_exec("rm -f " . $rutaArchivos . "/" . str_replace(" ", "\ ", $nombreDes));
                } else {
>>>>>>> 41fe191a9f3b68ea366a71bfc94f97dacf3e4bc8
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
<<<<<<< HEAD
    
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
        $camposFexavaAvaluo = $this->guardarAvaluoAntecedentes($xml, $camposFexavaAvaluo, $idPersona);
        //$camposFexavaAvaluo['CaracteristicasUrbanas'] = array();
        $camposFexavaAvaluo = $this->guardarAvaluoCaracteristicasUrbanas($xml, $camposFexavaAvaluo, $idPersona);
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
=======

    function esValidoAvaluo($docXml)
    {
        $xml = new DOMDocument();
        $xml->load($docXml);
>>>>>>> 41fe191a9f3b68ea366a71bfc94f97dacf3e4bc8

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

    public function guardarAvaluoTerreno(){
        
    }

    public function obtenerNumUnicoAv($tipo){
        $anio = date('Y');
        return "A-".$tipo."-".$anio."-";
    }
}
