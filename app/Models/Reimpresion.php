<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Documentos;
use Log;

class Reimpresion
{
    protected $modelDocumentos;

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

        $this->modelDocumentos = new Documentos();

        //echo "EL QUE LLEGA "."SELECT NOMBRE, BINARIODATOS FROM DOC.DOC_FICHERODOCUMENTO WHERE IDDOCUMENTODIGITAL = $idAvaluo"; exit();
        $infoArchivo = DB::select("SELECT NOMBRE, BINARIODATOS FROM DOC.DOC_FICHERODOCUMENTO WHERE IDDOCUMENTODIGITAL = $idAvaluo AND NOMBRE LIKE 'Avaluo_%'");
        //$arrInfoArchivo = convierte_a_arreglo($infoArchivo);
        $rutaArchivos = getcwd();
        $nombreArchivo = $infoArchivo[0]->nombre;
        $archivoComprimido = $infoArchivo[0]->binariodatos;
        $myfile = fopen($rutaArchivos."/".$nombreArchivo, "a+");
        fwrite($myfile,$archivoComprimido);
        fclose($myfile);
        $comandoDescomprimir = "7z e ".$rutaArchivos."/".$nombreArchivo;        
        shell_exec($comandoDescomprimir); 
        $comandoRm = "rm ".$rutaArchivos."/".$nombreArchivo;
        shell_exec($comandoRm);
        $myfile = fopen($rutaArchivos."/default", "r");
        $contenidoArchivo = fread($myfile, filesize($rutaArchivos."/default"));
        fclose($myfile);        
        $xml = simplexml_load_string($contenidoArchivo,'SimpleXMLElement', LIBXML_NOCDATA);
        $comandoRmDefault = "rm ".$rutaArchivos."/default";
        shell_exec($comandoRmDefault);
        $arrXML = convierte_a_arreglo($xml); //print_r($arrXML); exit();

        $infoFexava = DB::select("SELECT * FROM FEXAVA_AVALUO WHERE IDAVALUO = $idAvaluo");
        $arrInfoFexava = array_map("convierte_a_arreglo",$infoFexava);
        $arrFexava = $arrInfoFexava[0];

        $infoReimpresion = array();

        if(isset($arrXML['Comercial'])){
            $elementoPrincipal = $arrXML['Comercial'];
        }

        if(isset($arrXML['Catastral'])){
            $elementoPrincipal = $arrXML['Catastral'];
        }

        $identificacion = $elementoPrincipal['Identificacion'];

        $infoReimpresion['Encabezado'] = array();

        $infoReimpresion['Encabezado']['Fecha'] = $identificacion['FechaAvaluo'];
        $infoReimpresion['Encabezado']['Avaluo_No'] = $identificacion['NumeroDeAvaluo'];
        $infoReimpresion['Encabezado']['No_Unico'] = $arrFexava['numerounico'];
        $infoReimpresion['Encabezado']['Registro_TDF'] = $identificacion['ClaveValuador'];

        $infoReimpresion['Sociedad_Participa'] = array();
        /*$antecedentes = $elementoPrincipal['Antecedentes'];
        $solicitante = $antecedentes['Solicitante'];*/

        $infoSolicitante = DB::select("SELECT * FROM FEXAVA_DATOSPERSONAS WHERE IDAVALUO = $idAvaluo AND CODTIPOFUNCION = 'S'");
        $arrinfoSolicitante = array_map("convierte_a_arreglo",$infoSolicitante);
        $arrSolicitante = $arrinfoSolicitante[0];

        $infoReimpresion['Sociedad_Participa']['Valuador'] = $identificacion['ClaveValuador'];
        $infoReimpresion['Sociedad_Participa']['Fecha_del_Avaluo'] = $identificacion['FechaAvaluo'];
        $infoReimpresion['Sociedad_Participa']['Solicitante'] = array();
        $infoReimpresion['Sociedad_Participa']['Solicitante']['Tipo_persona'] = $arrSolicitante['tipopersona'] == 'F' ? "Física" : "Moral";
        $infoReimpresion['Sociedad_Participa']['Solicitante']['Nombre'] = $arrSolicitante['nombre']." ".$arrSolicitante['apellidopaterno']." ".$arrSolicitante['apellidomaterno'];
        $infoReimpresion['Sociedad_Participa']['Solicitante']['Calle'] = $arrSolicitante['calle'];
        $infoReimpresion['Sociedad_Participa']['Solicitante']['No_Exterior'] = $arrSolicitante['numeroexterior'];
        $infoReimpresion['Sociedad_Participa']['Solicitante']['No_Interior'] = $arrSolicitante['numerointerior'];
        $infoReimpresion['Sociedad_Participa']['Solicitante']['Colonia'] = $arrSolicitante['nombrecolonia'];
        $infoReimpresion['Sociedad_Participa']['Solicitante']['CP'] = $arrSolicitante['codigopostal'];
        $infoReimpresion['Sociedad_Participa']['Solicitante']['Delegacion'] = $arrSolicitante['nombredelegacion'];

        $infoReimpresion['Sociedad_Participa']['inmuebleQueSeValua'] = $arrFexava['region']."-".$arrFexava['manzana']."-".$arrFexava['lote']."-".$arrFexava['unidadprivativa']." ".$arrFexava['digitoverificador'];
        $infoReimpresion['Sociedad_Participa']['regimenDePropiedad'] = $this->modelDocumentos->get_regimen_propiedad($arrFexava['codregimenpropiedad']);

        $infoPropietario = DB::select("SELECT * FROM FEXAVA_DATOSPERSONAS WHERE IDAVALUO = $idAvaluo AND CODTIPOFUNCION = 'P'");
        $arrinfoPropietario = array_map("convierte_a_arreglo",$infoPropietario);
        $arrPropietario = $arrinfoPropietario[0];

        $infoReimpresion['Sociedad_Participa']['Propietario'] = array();
        $infoReimpresion['Sociedad_Participa']['Propietario']['Tipo_persona'] = $arrPropietario['tipopersona'] == 'F' ? "Física" : "Moral";
        $infoReimpresion['Sociedad_Participa']['Propietario']['Nombre'] = $arrPropietario['nombre']." ".$arrPropietario['apellidopaterno']." ".$arrPropietario['apellidomaterno'];
        $infoReimpresion['Sociedad_Participa']['Propietario']['Calle'] = $arrPropietario['calle'];
        $infoReimpresion['Sociedad_Participa']['Propietario']['No_Exterior'] = $arrPropietario['numeroexterior'];
        $infoReimpresion['Sociedad_Participa']['Propietario']['No_Interior'] = $arrPropietario['numerointerior'];
        $infoReimpresion['Sociedad_Participa']['Propietario']['Colonia'] = $arrPropietario['nombrecolonia'];
        $infoReimpresion['Sociedad_Participa']['Propietario']['CP'] = $arrPropietario['codigopostal'];
        $infoReimpresion['Sociedad_Participa']['Propietario']['Delegacion'] = $arrPropietario['nombredelegacion'];

        $infoReimpresion['Sociedad_Participa']['Objeto_Avaluo'] = $arrFexava['objeto'];
        $infoReimpresion['Sociedad_Participa']['Proposito_Avaluo'] = $arrFexava['proposito'];

        $infoReimpresion['Ubicacion_Inmueble'] = array();
        $ubicacionInmueble = $elementoPrincipal['Antecedentes']['InmuebleQueSeValua'];

        $infoReimpresion['Ubicacion_Inmueble']['Calle'] = $ubicacionInmueble['Calle'];
        $infoReimpresion['Ubicacion_Inmueble']['No_Exterior'] = $ubicacionInmueble['NumeroExterior'];
        $infoReimpresion['Ubicacion_Inmueble']['No_Interior'] = $ubicacionInmueble['NumeroInterior'];
        $infoReimpresion['Ubicacion_Inmueble']['Colonia'] = $ubicacionInmueble['Colonia'];
        $infoReimpresion['Ubicacion_Inmueble']['CP'] = $ubicacionInmueble['CodigoPostal'];
        $infoReimpresion['Ubicacion_Inmueble']['Delegacion'] = $ubicacionInmueble['Delegacion'];
        $infoReimpresion['Ubicacion_Inmueble']['Edificio'] = "-";
        $infoReimpresion['Ubicacion_Inmueble']['Lote'] = 0;
        $infoReimpresion['Ubicacion_Inmueble']['Cuenta_agua'] = $ubicacionInmueble['CuentaDeAgua'];

        $infoReimpresion['Clasificacion de la zona'] = $this->modelDocumentos->get_clasificacion_zona($arrFexava['cucodclasificacionzona']);
        $infoReimpresion['Indice_Saturacion_Zona'] = $arrFexava['cuindicesaturacionzona'] <= 1 ? $arrFexava['cuindicesaturacionzona'] * 100 : $arrFexava['cuindicesaturacionzona'];
        
        $caracterisiticasUrbanas = $elementoPrincipal['CaracteristicasUrbanas'];
        $infoReimpresion['Tipo_Construccion_Dominante'] = $caracterisiticasUrbanas['ClaseGeneralDeInmueblesDeLaZona'];
        $infoReimpresion['Densidad_Poblacion'] = $this->modelDocumentos->get_densidad_poblacion($arrFexava['cucoddensidadpoblacion']);
        $infoReimpresion['Nivel_Socioeconomico_Zona'] = $this->modelDocumentos->get_nivel_socioeconomico_zona($arrFexava['cucodnivelsocioeconomico']);
        $infoReimpresion['Contaminacion_Medio_Ambiente'] = $caracterisiticasUrbanas['ContaminacionAmbientalEnLaZona'];
        $infoReimpresion['Contaminacion_Medio_Ambiente'] = $caracterisiticasUrbanas['ClaseGeneralDeInmueblesDeLaZona'];
        $infoReimpresion['Uso_Suelo'] = $arrFexava['cuuso'];
        $infoReimpresion['Area_Libre_Obligatoria'] = $arrFexava['cuarealibreobligatorio'];
        $infoReimpresion['Vias_Acceso_E_Importancia'] = $caracterisiticasUrbanas['ViasDeAccesoEImportancia'];

        $infoReimpresion['Servicios_Publicos_Equipamiento'] = array();

        $infoReimpresion['Servicios_Publicos_Equipamiento']['Red_Agua_Potable'] = $this->modelDocumentos->get_red_agua_potable($arrFexava['cucodaguapotable']);
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Red_Aguas_Residuales'] = $this->modelDocumentos->get_red_agua_potable($arrFexava['cucodaguapotableresidual']);
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Red_Drenaje_Aguas_Pluviales_Calle'] = $this->modelDocumentos->get_drenaje_pluvial_calle_zona($arrFexava['cucoddrenajepluvialcalle']);
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Red_Drenaje_Aguas_Pluviales_Zona'] = $this->modelDocumentos->get_drenaje_pluvial_calle_zona($arrFexava['cucoddrenajepluvialzona']);
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Sistema_Mixto'] = $this->modelDocumentos->get_drenaje_mixto($arrFexava['cucoddrenajeinmueble']);
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Suministro_Electrico'] = $this->modelDocumentos->get_suministro_electrico($arrFexava['cucodsuministroelectrico']);
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Acometida_Inmueble'] = $this->modelDocumentos-> get_acometida_inmueble($arrFexava['cucodacometidainmueble']);
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Alumbrado_Publico'] = $this->modelDocumentos->get_alumbrado_publico($arrFexava['cucodalumbradopublico']);
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Vialidades'] = $this->modelDocumentos->get_vialidades($arrFexava['cucodvialidades']);
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Banquetas'] = $this->modelDocumentos->get_banquetas($arrFexava['cucodbanquetas']);
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Guarniciones'] = $this->modelDocumentos->get_guarniciones($arrFexava['cucodguarniciones']);
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Nivel_Infraestructura_Zona'] = $arrFexava['cuporcentajeinfraestructura'] <= 1 ? $arrFexava['cuporcentajeinfraestructura'] * 100 : $arrFexava['cuporcentajeinfraestructura'];
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Gas_Natutral'] = $this->modelDocumentos->get_gas_natural($arrFexava['cucodgasnatural']);
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Telefonos_Suministro'] = $this->modelDocumentos->get_suministro_tel($arrFexava['cucodsuministrotelefonica']);
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Senalizacion_Vias'] = $this->modelDocumentos->get_senal_vias($arrFexava['cucodsenalizacionvias']);
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Acometida_Inmueble_Tel'] = $this->modelDocumentos->get_acometida_inmueble_tel($arrFexava['cucodacometidainmuebletel']);
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Distancia_Transporte_Urbano'] =  $arrFexava['cudistanciatransporteurbano'];
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Frecuencia_Transporte_Urbano'] = $arrFexava['cufrecuenciatransporteurbano'];
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Distancia_Transporte_Suburbano'] = $arrFexava['cudistanciatransportesuburb'];
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Frecuencia_Transporte_Suburbano'] = $arrFexava['cufrecuenciatransportesuburb'];
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Vigilancia'] = $this->modelDocumentos->get_vigilancia_zona($arrFexava['cucodvigilanciazona']);
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Recoleccion_Basura'] = $this->modelDocumentos->get_recoleccion_basura($arrFexava['cucodrecoleccionbasura']);
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Templo'] = $arrFexava['cuexisteiglesia'] == 1 ? 'Si' : 'No';
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Mercados'] = $arrFexava['cuexistemercados'] == 1 ? 'Si' : 'No';
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Plazas_Publicas'] = $arrFexava['cuexisteplazaspublicos'] == 1 ? 'Si' : 'No';
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Parques_Jardines'] = $arrFexava['cuexisteparquesjardines'] == 1 ? 'Si' : 'No';
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Escuelas'] = $arrFexava['cuexisteescuelas'] == 1 ? 'Si' : 'No';
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Hospitales'] = $arrFexava['cuexistehospitales'] == 1 ? 'Si' : 'No';
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Bancos'] = $arrFexava['cuexistebancos'] == 1 ? 'Si' : 'No';
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Estacion_Transporte'] = $arrFexava['cuexisteestaciontransporte'] == 1 ? 'Si' : 'No';
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Nivel_Equipamiento_Urbano'] = $caracterisiticasUrbanas['ServiciosPublicosYEquipamientoUrbano']['NivelDeEquipamientoUrbano'];
        $infoReimpresion['Servicios_Publicos_Equipamiento']['Nomenclatura_Calles'] = $this->modelDocumentos->get_nomenclatura_calle($arrFexava['cucodnomenclaturacalle']);

        $terreno = $elementoPrincipal['Terreno'];

        $infoReimpresion['Calles_Transversales_Limitrofes'] = $terreno['CallesTransversalesLimitrofesYOrientacion'];

        $infoReimpresion['Croquis_Localizacion'] = array();
        $infoReimpresion['Croquis_Localizacion']['Microlocalizacion'] = base64_encode($this->modelDocumentos->get_fichero_documento($terreno['CroquisMicroLocalizacion']));
        $infoReimpresion['Croquis_Localizacion']['Macrolocalizacion'] = base64_encode($this->modelDocumentos->get_fichero_documento($terreno['CroquisMacroLocalizacion']));

        $infoReimpresion['Medidas_Colindancias'] = array();
        $fuenteDeInformacion = $terreno['MedidasYColindancias']['FuenteDeInformacionLegal'];

        $infoReimpresion['Medidas_Colindancias']['Fuente'] = isset($fuenteDeInformacion['Escritura']) ? 'Escritura' : '';
        $infoReimpresion['Medidas_Colindancias']['Numero_Escritura'] = $fuenteDeInformacion['Escritura']['NumeroDeEscritura'];
        $infoReimpresion['Medidas_Colindancias']['Numero_Notaria'] = $fuenteDeInformacion['Escritura']['NumeroNotaria'];
        $infoReimpresion['Medidas_Colindancias']['Entidad_Federativa'] = $fuenteDeInformacion['Escritura']['DistritoJudicialNotario'];
        $infoReimpresion['Medidas_Colindancias']['Numero_Volumen'] = $fuenteDeInformacion['Escritura']['NumeroDeVolumen'];
        $infoReimpresion['Medidas_Colindancias']['Nombre_Notario'] = $fuenteDeInformacion['Escritura']['NombreDelNotario'];

        $colindancias = $terreno['MedidasYColindancias']['Colindancias'];
        $infoReimpresion['Colindancias'] = array();

        foreach($colindancias as $colindancia){
            unset($colindancia['@attributes']);
            $infoReimpresion['Colindancias'][] = $colindancia;
        }

        $infoReimpresion['Superficie_Total_Segun'] = array();
        /*$infoSuperficie = DB::select("SELECT * FROM FEXAVA_SUPERFICIE WHERE IDAVALUO = $idAvaluo");
        $arrInfoSuperficie = array_map("convierte_a_arreglo",$infoSuperficie);
        $arrSuperficie = $arrInfoSuperficie[0];
        print_r($arrSuperficie); exit();*/
        $superficieDelTerreno = $terreno['SuperficieDelTerreno'];
        $infoReimpresion['Superficie_Total_Segun']['Ident_Fraccion'] = $superficieDelTerreno['IdentificadorFraccionN1'];
        $infoReimpresion['Superficie_Total_Segun']['Sup_Fraccion'] = $superficieDelTerreno['SuperficieFraccionN1'];
        $infoReimpresion['Superficie_Total_Segun']['Fzo'] = $superficieDelTerreno['Fzo'];
        $infoReimpresion['Superficie_Total_Segun']['Fub'] = $superficieDelTerreno['Fub'];
        $infoReimpresion['Superficie_Total_Segun']['FFr'] = $superficieDelTerreno['FFr'];
        $infoReimpresion['Superficie_Total_Segun']['Ffo'] = $superficieDelTerreno['Ffo'];
        $infoReimpresion['Superficie_Total_Segun']['Fsu'] = $superficieDelTerreno['Fsu'];
        $infoReimpresion['Superficie_Total_Segun']['Clave_Area_Valor'] = $superficieDelTerreno['ClaveDeAreaDeValor'];
        $infoReimpresion['Superficie_Total_Segun']['Valor'] = $superficieDelTerreno['Fot']['Valor'];
        $infoReimpresion['Superficie_Total_Segun']['Descripcion'] = $superficieDelTerreno['Fot']['Descripcion'];
        $infoReimpresion['Superficie_Total_Segun']['Fre'] = $superficieDelTerreno['Fre'];

        $infoReimpresion['Topografia_Configuracion'] = array();
        $infoReimpresion['Topografia_Configuracion']['Caracteristicas_Panoramicas'] = $arrFexava['tecaracteristicasparonamicas'];
        $infoReimpresion['Topografia_Configuracion']['Densidad_Habitacional'] = $arrFexava['tecoddensidadhabitacional'];
        $infoReimpresion['Topografia_Configuracion']['Servidumbre_Restricciones'] = $arrFexava['teservidumbresorestricciones'];

        $infoReimpresion['Uso_Actual'] = $arrFexava['diusoactual'];
        
        $infoReimpresion['Construcciones_Privativas'] = array();            
        
        $descripcionInmueble = $elementoPrincipal['DescripcionDelInmueble'];
        $tiposContruccion = $descripcionInmueble['TiposDeConstruccion'];

        if(isset($tiposContruccion['ConstruccionesPrivativas']['@attributes'])){
            $infoReimpresion['Construcciones_Privativas']['Tipo'] = '';
            $infoReimpresion['Construcciones_Privativas']['Descripcion'] = $tiposContruccion['ConstruccionesPrivativas']['Descripcion'];
            $infoReimpresion['Construcciones_Privativas']['Uso'] = $tiposContruccion['ConstruccionesPrivativas']['ClaveUso'];
            $infoReimpresion['Construcciones_Privativas']['No_Niveles_Tipo'] = $tiposContruccion['ConstruccionesPrivativas']['NumeroDeNivelesDelTipo'];
            $infoReimpresion['Construcciones_Privativas']['Clave_Rango_Niveles'] = $tiposContruccion['ConstruccionesPrivativas']['ClaveRangoDeNiveles'];
            $infoReimpresion['Construcciones_Privativas']['Puntaje'] = $tiposContruccion['ConstruccionesPrivativas']['PuntajeDeClasificacion'];
            $infoReimpresion['Construcciones_Privativas']['Clase'] = $tiposContruccion['ConstruccionesPrivativas']['ClaveClase'];
            $infoReimpresion['Construcciones_Privativas']['Edad'] = $tiposContruccion['ConstruccionesPrivativas']['Edad'];
            $infoReimpresion['Construcciones_Privativas']['Vida_Util_Total_Tipo'] = $tiposContruccion['ConstruccionesPrivativas']['VidaUtilTotalDelTipo'];
            $infoReimpresion['Construcciones_Privativas']['Vida_Util_Remanente'] = $tiposContruccion['ConstruccionesPrivativas']['VidaUtilRemanente'];
            $infoReimpresion['Construcciones_Privativas']['Conservacion'] = $tiposContruccion['ConstruccionesPrivativas']['ClaveConservacion'];
            $infoReimpresion['Construcciones_Privativas']['Sup'] = $tiposContruccion['ConstruccionesPrivativas']['Superficie'];
        }

        if(isset($tiposContruccion['ConstruccionesPrivativas'][0])){
            $control = 0;
            foreach($tiposContruccion['ConstruccionesPrivativas'] as $construccionPrivativa){
                $infoReimpresion['Construcciones_Privativas'][$control]['Tipo'] = '';
                $infoReimpresion['Construcciones_Privativas'][$control]['Descripcion'] = $construccionPrivativa['Descripcion'];
                $infoReimpresion['Construcciones_Privativas'][$control]['Uso'] = $construccionPrivativa['ClaveUso'];
                $infoReimpresion['Construcciones_Privativas'][$control]['No_Niveles_Tipo'] = $construccionPrivativa['NumeroDeNivelesDelTipo'];
                $infoReimpresion['Construcciones_Privativas'][$control]['Clave_Rango_Niveles'] = $construccionPrivativa['ClaveRangoDeNiveles'];
                $infoReimpresion['Construcciones_Privativas'][$control]['Puntaje'] = $construccionPrivativa['PuntajeDeClasificacion'];
                $infoReimpresion['Construcciones_Privativas'][$control]['Clase'] = $construccionPrivativa['ClaveClase'];
                $infoReimpresion['Construcciones_Privativas'][$control]['Edad'] = $construccionPrivativa['Edad'];
                $infoReimpresion['Construcciones_Privativas'][$control]['Vida_Util_Total_Tipo'] = $construccionPrivativa['VidaUtilTotalDelTipo'];
                $infoReimpresion['Construcciones_Privativas'][$control]['Vida_Util_Remanente'] = $construccionPrivativa['VidaUtilRemanente'];
                $infoReimpresion['Construcciones_Privativas'][$control]['Conservacion'] = $construccionPrivativa['ClaveConservacion'];
                $infoReimpresion['Construcciones_Privativas'][$control]['Sup'] = $construccionPrivativa['Superficie'];
                $control = $control + 1;
            }
        }
        
        if(isset($tiposContruccion['ConstruccionesComunes']['@attributes'])){
            $infoReimpresion['Construcciones_Comunes']['Tipo'] = '';
            $infoReimpresion['Construcciones_Comunes']['Descripcion'] = $tiposContruccion['ConstruccionesComunes']['Descripcion'];
            $infoReimpresion['Construcciones_Comunes']['Uso'] = $tiposContruccion['ConstruccionesComunes']['ClaveUso'];
            $infoReimpresion['Construcciones_Comunes']['No_Niveles_Tipo'] = $tiposContruccion['ConstruccionesComunes']['NumeroDeNivelesDelTipo'];
            $infoReimpresion['Construcciones_Comunes']['Clave_Rango_Niveles'] = $tiposContruccion['ConstruccionesComunes']['ClaveRangoDeNiveles'];
            $infoReimpresion['Construcciones_Comunes']['Puntaje'] = $tiposContruccion['ConstruccionesComunes']['PuntajeDeClasificacion'];
            $infoReimpresion['Construcciones_Comunes']['Clase'] = $tiposContruccion['ConstruccionesComunes']['ClaveClase'];
            $infoReimpresion['Construcciones_Comunes']['Edad'] = $tiposContruccion['ConstruccionesComunes']['Edad'];
            $infoReimpresion['Construcciones_Comunes']['Vida_Util_Total_Tipo'] = $tiposContruccion['ConstruccionesComunes']['VidaUtilTotalDelTipo'];
            $infoReimpresion['Construcciones_Comunes']['Vida_Util_Remanente'] = $tiposContruccion['ConstruccionesComunes']['VidaUtilRemanente'];
            $infoReimpresion['Construcciones_Comunes']['Conservacion'] = $tiposContruccion['ConstruccionesComunes']['ClaveConservacion'];
            $infoReimpresion['Construcciones_Comunes']['Sup'] = $tiposContruccion['ConstruccionesComunes']['Superficie'];
        }

        if(isset($tiposContruccion['ConstruccionesComunes'][0])){
            $control = 0;
            foreach($tiposContruccion['ConstruccionesComunes'] as $construccionComun){
                $infoReimpresion['Construcciones_Comunes'][$control]['Tipo'] = '';
                $infoReimpresion['Construcciones_Comunes'][$control]['Descripcion'] = $construccionComun['Descripcion'];
                $infoReimpresion['Construcciones_Comunes'][$control]['Uso'] = $construccionComun['ClaveUso'];
                $infoReimpresion['Construcciones_Comunes'][$control]['No_Niveles_Tipo'] = $construccionComun['NumeroDeNivelesDelTipo'];
                $infoReimpresion['Construcciones_Comunes'][$control]['Clave_Rango_Niveles'] = $construccionComun['ClaveRangoDeNiveles'];
                $infoReimpresion['Construcciones_Comunes'][$control]['Puntaje'] = $construccionComun['PuntajeDeClasificacion'];
                $infoReimpresion['Construcciones_Comunes'][$control]['Clase'] = $construccionComun['ClaveClase'];
                $infoReimpresion['Construcciones_Comunes'][$control]['Edad'] = $construccionComun['Edad'];
                $infoReimpresion['Construcciones_Comunes'][$control]['Vida_Util_Total_Tipo'] = $construccionComun['VidaUtilTotalDelTipo'];
                $infoReimpresion['Construcciones_Comunes'][$control]['Vida_Util_Remanente'] = $construccionComun['VidaUtilRemanente'];
                $infoReimpresion['Construcciones_Comunes'][$control]['Conservacion'] = $construccionComun['ClaveConservacion'];
                $infoReimpresion['Construcciones_Comunes'][$control]['Sup'] = $construccionComun['Superficie'];
                $control = $control + 1;
            }
        }
        
        $infoReimpresion['Indiviso'] = $terreno['Indiviso'];
        $infoReimpresion['Vida_Util_Promedio_Inmueble'] = $descripcionInmueble['VidaUtilTotalPonderadaDelInmueble'];
        $infoReimpresion['Edad_Aproximada_Construccion'] = $descripcionInmueble['EdadPonderadaDelInmueble'];
        $infoReimpresion['Vida_Util_Remanente'] = $descripcionInmueble['VidaUtilRemanentePonderadaDelInmueble'];

        $elementosConstruccion = $elementoPrincipal['ElementosDeLaConstruccion'];
        $obraNegra = $elementosConstruccion['ObraNegra'];

        $infoReimpresion['Obra_Negra_Gruesa'] = array();

        $infoReimpresion['Obra_Negra_Gruesa']['Cimientos'] = $obraNegra['Cimentacion'];
        $infoReimpresion['Obra_Negra_Gruesa']['Estructura'] = $obraNegra['Estructura'];
        $infoReimpresion['Obra_Negra_Gruesa']['Muros'] = $obraNegra['Muros'];
        $infoReimpresion['Obra_Negra_Gruesa']['Entrepiso'] = $obraNegra['Entrepisos'];
        $infoReimpresion['Obra_Negra_Gruesa']['Techos'] = $obraNegra['Techos'];
        $infoReimpresion['Obra_Negra_Gruesa']['Azoteas'] = $obraNegra['Azoteas'];
        $infoReimpresion['Obra_Negra_Gruesa']['Bardas'] = $obraNegra['Bardas'];

        $infoReimpresion['Revestimientos_Acabados_Interiores'] = array();
        $revestimientosAcabados = $elementosConstruccion['RevestimientosYAcabadosInteriores'];

        $infoReimpresion['Revestimientos_Acabados_Interiores']['Aplanados'] = $revestimientosAcabados['Aplanados'];
        $infoReimpresion['Revestimientos_Acabados_Interiores']['Plafones'] = $revestimientosAcabados['Plafones'];
        $infoReimpresion['Revestimientos_Acabados_Interiores']['Lambrines'] = $revestimientosAcabados['Lambrines'];
        $infoReimpresion['Revestimientos_Acabados_Interiores']['Pisos'] = $revestimientosAcabados['Pisos'];
        $infoReimpresion['Revestimientos_Acabados_Interiores']['Zoclos'] = $revestimientosAcabados['Zoclos'];
        $infoReimpresion['Revestimientos_Acabados_Interiores']['Escaleras'] = $revestimientosAcabados['Escaleras'];
        $infoReimpresion['Revestimientos_Acabados_Interiores']['Pintura'] = $revestimientosAcabados['Pintura'];
        $infoReimpresion['Revestimientos_Acabados_Interiores']['Recubrimientos_Especiales'] = $revestimientosAcabados['RecubrimientosEspeciales'];

        $infoReimpresion['Carpinteria'] = array();
        $carpinteria = $elementosConstruccion['Carpinteria'];

        $infoReimpresion['Carpinteria']['Puertas_Interiores'] = $carpinteria['PuertasInteriores'];
        $infoReimpresion['Carpinteria']['Guardarropas'] = $carpinteria['Guardaropas'];
        $infoReimpresion['Carpinteria']['Muebles_Empotrados'] = $carpinteria['MueblesEmpotradosOFijos'];

        $infoReimpresion['Instalaciones_Hidraulicas_Sanitrias'] = array();
        $hidraulicasSanitarias = $elementosConstruccion['InstalacionesHidraulicasYSanitrias'];

        $infoReimpresion['Instalaciones_Hidraulicas_Sanitrias']['Muebles_Banio'] = $hidraulicasSanitarias['MueblesDeBanno'];
        $infoReimpresion['Instalaciones_Hidraulicas_Sanitrias']['Ramaleos_Hidraulicos'] = $hidraulicasSanitarias['RamaleosHidraulicos'];
        $infoReimpresion['Instalaciones_Hidraulicas_Sanitrias']['Ramaleos_Sanitarios'] = $hidraulicasSanitarias['RamaleosSanitarios'];

        $infoReimpresion['Instalaciones_Electricas_Alumbrados'] = $elementosConstruccion['InstalacionesElectricasYAlumbrado'];

        $infoReimpresion['Puertas_Ventaneria_Metalica'] = array();
        $puertasVentaneria = $elementosConstruccion['PuertasYVentaneriaMetalica'];

        $infoReimpresion['Puertas_Ventaneria_Metalica']['Herreria'] = $puertasVentaneria['Herreria'];
        $infoReimpresion['Puertas_Ventaneria_Metalica']['Ventaneria'] = $puertasVentaneria['Ventaneria'];

        $infoReimpresion['Vidrieria'] = $elementosConstruccion['Vidreria'];
        $infoReimpresion['Cerrajeria'] = $elementosConstruccion['Cerrajeria'];
        $infoReimpresion['Fachadas'] = $elementosConstruccion['Fachadas'];

        $infoReimpresion['Instalaciones_Especiales'] = array();

        $infoReimpresion['Elementos_Accesorios']  = array();
        $elementosAccesorios = $elementosConstruccion['ElementosAccesorios'];

        if(isset($elementosAccesorios['Privativas']['@attributes'])){
            $infoReimpresion['Elementos_Accesorios']['Privativas'] = array();
            $infoReimpresion['Elementos_Accesorios']['Privativas']['Clave'] = $elementosAccesorios['Privativas']['ClaveElementoAccesorio'];
            $infoReimpresion['Elementos_Accesorios']['Privativas']['Descripcion'] = $elementosAccesorios['Privativas']['DescripcionElementoAccesorio'];
            $infoReimpresion['Elementos_Accesorios']['Privativas']['Unidad'] = $elementosAccesorios['Privativas']['UnidadElementoAccesorio'];
            $infoReimpresion['Elementos_Accesorios']['Privativas']['Cantidad'] = $elementosAccesorios['Privativas']['CantidadElementoAccesorio'];
            $infoReimpresion['Elementos_Accesorios']['Privativas']['Edad'] = $elementosAccesorios['Privativas']['EdadElementoAccesorio'];
            $infoReimpresion['Elementos_Accesorios']['Privativas']['Vida_Util_Total'] = $elementosAccesorios['Privativas']['VidaUtilTotalElementoAccesorio'];
            $infoReimpresion['Elementos_Accesorios']['Privativas']['Valor_Unitario'] = $elementosAccesorios['Privativas']['ValorUnitarioElementoAccesorio'];
        }

        if(isset($elementosAccesorios['Privativas'][0])){
            $infoReimpresion['Elementos_Accesorios']['Privativas'] = array();
            $control = 0;
            foreach($elementosAccesorios['Privativas'] as $elementoAccesorio){
                $infoReimpresion['Elementos_Accesorios']['Privativas'][$control]['Clave'] = $elementoAccesorio['ClaveElementoAccesorio'];
                $infoReimpresion['Elementos_Accesorios']['Privativas'][$control]['Descripcion'] = $elementoAccesorio['DescripcionElementoAccesorio'];
                $infoReimpresion['Elementos_Accesorios']['Privativas'][$control]['Unidad'] = $elementoAccesorio['UnidadElementoAccesorio'];
                $infoReimpresion['Elementos_Accesorios']['Privativas'][$control]['Cantidad'] = $elementoAccesorio['CantidadElementoAccesorio'];
                $infoReimpresion['Elementos_Accesorios']['Privativas'][$control]['Edad'] = $elementoAccesorio['EdadElementoAccesorio'];
                $infoReimpresion['Elementos_Accesorios']['Privativas'][$control]['Vida_Util_Total'] = $elementoAccesorio['VidaUtilTotalElementoAccesorio'];
                $infoReimpresion['Elementos_Accesorios']['Privativas'][$control]['Valor_Unitario'] = $elementoAccesorio['ValorUnitarioElementoAccesorio'];
                $control = $control + 1;
            }
        }

        if(isset($elementosAccesorios['Comunes']['@attributes'])){
            $infoReimpresion['Elementos_Accesorios']['Comunes'] = array();
            $infoReimpresion['Elementos_Accesorios']['Comunes']['Clave'] = $elementosAccesorios['Comunes']['ClaveElementoAccesorio'];
            $infoReimpresion['Elementos_Accesorios']['Comunes']['Descripcion'] = $elementosAccesorios['Comunes']['DescripcionElementoAccesorio'];
            $infoReimpresion['Elementos_Accesorios']['Comunes']['Unidad'] = $elementosAccesorios['Comunes']['UnidadElementoAccesorio'];
            $infoReimpresion['Elementos_Accesorios']['Comunes']['Cantidad'] = $elementosAccesorios['Comunes']['CantidadElementoAccesorio'];
            $infoReimpresion['Elementos_Accesorios']['Comunes']['Edad'] = $elementosAccesorios['Comunes']['EdadElementoAccesorio'];
            $infoReimpresion['Elementos_Accesorios']['Comunes']['Vida_Util_Total'] = $elementosAccesorios['Comunes']['VidaUtilTotalElementoAccesorio'];
            $infoReimpresion['Elementos_Accesorios']['Comunes']['Valor_Unitario'] = $elementosAccesorios['Comunes']['ValorUnitarioElementoAccesorio'];
        }

        if(isset($elementosAccesorios['Comunes'][0])){
            $infoReimpresion['Elementos_Accesorios']['Comunes'] = array();
            $control = 0;
            foreach($elementosAccesorios['Comunes'] as $elementoAccesorio){
                $infoReimpresion['Elementos_Accesorios']['Comunes'][$control]['Clave'] = $elementoAccesorio['ClaveElementoAccesorio'];
                $infoReimpresion['Elementos_Accesorios']['Comunes'][$control]['Descripcion'] = $elementoAccesorio['DescripcionElementoAccesorio'];
                $infoReimpresion['Elementos_Accesorios']['Comunes'][$control]['Unidad'] = $elementoAccesorio['UnidadElementoAccesorio'];
                $infoReimpresion['Elementos_Accesorios']['Comunes'][$control]['Cantidad'] = $elementoAccesorio['CantidadElementoAccesorio'];
                $infoReimpresion['Elementos_Accesorios']['Comunes'][$control]['Edad'] = $elementoAccesorio['EdadElementoAccesorio'];
                $infoReimpresion['Elementos_Accesorios']['Comunes'][$control]['Vida_Util_Total'] = $elementoAccesorio['VidaUtilTotalElementoAccesorio'];
                $infoReimpresion['Elementos_Accesorios']['Comunes'][$control]['Valor_Unitario'] = $elementoAccesorio['ValorUnitarioElementoAccesorio'];
                $control = $control + 1;
            }
        }

        /******************************************************************************************************************************************************/
        
        $infoReimpresion['Obras_Complementarias']  = array();
        $obrasComplementarias = $elementosConstruccion['ObrasComplementarias'];

        if(isset($obrasComplementarias['Privativas']['@attributes'])){
            $infoReimpresion['Obras_Complementarias']['Privativas'] = array();
            $infoReimpresion['Obras_Complementarias']['Privativas']['Clave'] = $obrasComplementarias['Privativas']['ClaveObraComplementaria'];
            $infoReimpresion['Obras_Complementarias']['Privativas']['Descripcion'] = $obrasComplementarias['Privativas']['DescripcionObraComplementaria'];
            $infoReimpresion['Obras_Complementarias']['Privativas']['Unidad'] = $obrasComplementarias['Privativas']['UnidadObraComplementaria'];
            $infoReimpresion['Obras_Complementarias']['Privativas']['Cantidad'] = $obrasComplementarias['Privativas']['CantidadObraComplementaria'];
            $infoReimpresion['Obras_Complementarias']['Privativas']['Edad'] = $obrasComplementarias['Privativas']['EdadObraComplementaria'];
            $infoReimpresion['Obras_Complementarias']['Privativas']['Vida_Util_Total'] = $obrasComplementarias['Privativas']['VidaUtilTotalObraComplementaria'];
            $infoReimpresion['Obras_Complementarias']['Privativas']['Valor_Unitario'] = $obrasComplementarias['Privativas']['ValorUnitarioObraComplementaria'];
        }

        if(isset($obrasComplementarias['Privativas'][0])){
            $infoReimpresion['Obras_Complementarias']['Privativas'] = array();
            $control = 0;
            foreach($obrasComplementarias['Privativas'] as $obraComplementaria){
                $infoReimpresion['Obras_Complementarias']['Privativas'][$control]['Clave'] = $obraComplementaria['ClaveObraComplementaria'];
                $infoReimpresion['Obras_Complementarias']['Privativas'][$control]['Descripcion'] = $obraComplementaria['DescripcionObraComplementaria'];
                $infoReimpresion['Obras_Complementarias']['Privativas'][$control]['Unidad'] = $obraComplementaria['UnidadObraComplementaria'];
                $infoReimpresion['Obras_Complementarias']['Privativas'][$control]['Cantidad'] = $obraComplementaria['CantidadObraComplementaria'];
                $infoReimpresion['Obras_Complementarias']['Privativas'][$control]['Edad'] = $obraComplementaria['EdadObraComplementaria'];
                $infoReimpresion['Obras_Complementarias']['Privativas'][$control]['Vida_Util_Total'] = $obraComplementaria['VidaUtilTotalObraComplementaria'];
                $infoReimpresion['Obras_Complementarias']['Privativas'][$control]['Valor_Unitario'] = $obraComplementaria['ValorUnitarioObraComplementaria'];
                $control = $control + 1;
            }
        }

        if(isset($obrasComplementarias['Comunes']['@attributes'])){
            $infoReimpresion['Obras_Complementarias']['Comunes'] = array();
            $infoReimpresion['Obras_Complementarias']['Comunes']['Clave'] = $obrasComplementarias['Comunes']['ClaveObraComplementaria'];
            $infoReimpresion['Obras_Complementarias']['Comunes']['Descripcion'] = $obrasComplementarias['Comunes']['DescripcionObraComplementaria'];
            $infoReimpresion['Obras_Complementarias']['Comunes']['Unidad'] = $obrasComplementarias['Comunes']['UnidadObraComplementaria'];
            $infoReimpresion['Obras_Complementarias']['Comunes']['Cantidad'] = $obrasComplementarias['Comunes']['CantidadObraComplementaria'];
            $infoReimpresion['Obras_Complementarias']['Comunes']['Edad'] = $obrasComplementarias['Comunes']['EdadObraComplementaria'];
            $infoReimpresion['Obras_Complementarias']['Comunes']['Vida_Util_Total'] = $obrasComplementarias['Comunes']['VidaUtilTotalObraComplementaria'];
            $infoReimpresion['Obras_Complementarias']['Comunes']['Valor_Unitario'] = $obrasComplementarias['Comunes']['ValorUnitarioObraComplementaria'];
        }

        if(isset($obrasComplementarias['Comunes'][0])){
            $infoReimpresion['Obras_Complementarias']['Comunes'] = array();
            $control = 0;
            foreach($obrasComplementarias['Comunes'] as $obraComplementaria){
                $infoReimpresion['Obras_Complementarias']['Comunes'][$control]['Clave'] = $obraComplementaria['ClaveObraComplementaria'];
                $infoReimpresion['Obras_Complementarias']['Comunes'][$control]['Descripcion'] = $obraComplementaria['DescripcionObraComplementaria'];
                $infoReimpresion['Obras_Complementarias']['Comunes'][$control]['Unidad'] = $obraComplementaria['UnidadObraComplementaria'];
                $infoReimpresion['Obras_Complementarias']['Comunes'][$control]['Cantidad'] = $obraComplementaria['CantidadObraComplementaria'];
                $infoReimpresion['Obras_Complementarias']['Comunes'][$control]['Edad'] = $obraComplementaria['EdadObraComplementaria'];
                $infoReimpresion['Obras_Complementarias']['Comunes'][$control]['Vida_Util_Total'] = $obraComplementaria['VidaUtilTotalObraComplementaria'];
                $infoReimpresion['Obras_Complementarias']['Comunes'][$control]['Valor_Unitario'] = $obraComplementaria['ValorUnitarioObraComplementaria'];
                $control = $control + 1;
            }
        }

        /*********************************************************************************************************************/

        $infoReimpresion['Terrenos_Directos']  = array();
        $infoReimpresion['Terrenos_Directos']['Terrenos'] = array();
        $infoReimpresion['Terrenos_Directos']['Terrenos']['TablaUno'] = array();
        $infoReimpresion['Terrenos_Directos']['Terrenos']['TablaDos'] = array();

        $enfoqueMercado = $elementoPrincipal['EnfoqueDeMercado'];
        $terrenos = $enfoqueMercado['Terrenos'];
        $terrenosDirectos = $terrenos['TerrenosDirectos'];
        
        $control = 0;
        foreach($terrenosDirectos as $terrenoDirecto){
            $infoReimpresion['Terrenos_Directos']['Terrenos']['TablaUno'][$control]['Ubicacion'] = $terrenoDirecto['Calle'].". ".$terrenoDirecto['Colonia'].". ".$terrenoDirecto['CodigoPostal'].".";
            $infoReimpresion['Terrenos_Directos']['Terrenos']['TablaUno'][$control]['Descripcion'] = $terrenoDirecto['DescripcionDelPredio'];
            $infoReimpresion['Terrenos_Directos']['Terrenos']['TablaUno'][$control]['C_U_S'] = $terrenoDirecto['CUS'];
            $infoReimpresion['Terrenos_Directos']['Terrenos']['TablaUno'][$control]['Uso_Suelo'] = $terrenoDirecto['UsoDelSuelo'];

            $infoReimpresion['Terrenos_Directos']['Terrenos']['TablaDos'][$control]['F_Negociacion'] = $terrenoDirecto['FactorDeNegociacion'];
            $infoReimpresion['Terrenos_Directos']['Terrenos']['TablaDos'][$control]['Superficie'] = $terrenoDirecto['Superficie'];
            $infoReimpresion['Terrenos_Directos']['Terrenos']['TablaDos'][$control]['Fzo'] = $terrenoDirecto['Fzo'];
            $infoReimpresion['Terrenos_Directos']['Terrenos']['TablaDos'][$control]['Fub'] = $terrenoDirecto['Fub'];
            $infoReimpresion['Terrenos_Directos']['Terrenos']['TablaDos'][$control]['FFr'] = $terrenoDirecto['FFr'];
            $infoReimpresion['Terrenos_Directos']['Terrenos']['TablaDos'][$control]['Ffo'] = $terrenoDirecto['Ffo'];
            $infoReimpresion['Terrenos_Directos']['Terrenos']['TablaDos'][$control]['Fsu'] = $terrenoDirecto['Fsu'];
            $infoReimpresion['Terrenos_Directos']['Terrenos']['TablaDos'][$control]['F_otro'] = $terrenoDirecto['Fot']['Valor'];
            $infoReimpresion['Terrenos_Directos']['Terrenos']['TablaDos'][$control]['Fre'] = $terrenoDirecto['Fre'];
            $infoReimpresion['Terrenos_Directos']['Terrenos']['TablaDos'][$control]['Precio_Solicitado'] = $terrenoDirecto['PrecioSolicitado'];

            $control = $control + 1;
        }

        $infoReimpresion['Terrenos_Directos']['Terrenos']['Conclusiones_Homologacion_Terrenos'] = array();

        return $infoReimpresion;
        
        /*$arrTablas = array('CROQUIS','FEXAVA_DATOSPERSONAS','FEXAVA_FUENTEINFORMACIONLEG','FEXAVA_ESCRITURA','FEXAVA_SUPERFICIE','FEXAVA_TIPOCONSTRUCCION','FEXAVA_ELEMENTOSCONST','FEXAVA_TERRENOMERCADO','FEXAVA_DATOSTERRENOS','FEXAVA_CONSTRUCCIONESMER','FEXAVA_ENFOQUECOSTESCAT','FEXAVA_FOTOAVALUO','FEXAVA_FOTOCOMPARABLE');
        $arrElementosConst = array('FEXAVA_OBRANEGRA','FEXAVA_REVESTIMIENTOACABADO','FEXAVA_CARPINTERIA','FEXAVA_INSTALACIONHIDSAN','FEXAVA_PUERTASYVENTANERIA','FEXAVA_ELEMENTOSEXTRA');
        
        $arrFexava = array();

        $infoFexava = DB::select("SELECT * FROM FEXAVA_AVALUO WHERE IDAVALUO = $idAvaluo");
        $arrInfoFexava = array_map("convierte_a_arreglo",$infoFexava);
        $arrFexava['FEXAVA_AVALUO'] = $arrInfoFexava[0];
        $this->modelDocumentos = new Documentos();
        $arrFexava['FEXAVA_AVALUO']['valuador'] = $this->modelDocumentos->get_valuador($arrFexava['FEXAVA_AVALUO']['idpersonaperito']);
        $arrFexava['FEXAVA_AVALUO']['inmuebleQueSeValua'] = $arrFexava['FEXAVA_AVALUO']['region']."-".$arrFexava['FEXAVA_AVALUO']['manzana']."-".$arrFexava['FEXAVA_AVALUO']['lote']."-".$arrFexava['FEXAVA_AVALUO']['unidadprivativa']." ".$arrFexava['FEXAVA_AVALUO']['digitoverificador'];
        $arrFexava['FEXAVA_AVALUO']['codregimenpropiedad'] = $this->modelDocumentos->get_regimen_propiedad($arrFexava['FEXAVA_AVALUO']['codregimenpropiedad']);
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

        return $arrFexava; */
    }
    

}