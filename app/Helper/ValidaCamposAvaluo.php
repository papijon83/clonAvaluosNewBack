<?php
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

function convierte_a_arreglo($data){    
    return json_decode( json_encode($data), true );
}

function define_validacion($tipo_validacion, $valor){
    $existeSeparador = strpos($tipo_validacion,'_');
    if($existeSeparador != FALSE){
        $arrValidaciones = explode('_',$tipo_validacion);
        if(count($arrValidaciones) == 2){
            switch ($arrValidaciones[0]) {
                case 'nonEmptyString':
                    return val_vacio_longitud($valor, $arrValidaciones[1]);
                break;
                case 'string':
                    return val_longitud($valor, $arrValidaciones[1]);
                break;
                case 'decimalPositivo':
                    return val_decimal_positivo_tipo($valor, $arrValidaciones[1]);
                break;
                case 'nullableDecimalPositivo':
                    return val_nullable_decimal_positivo_tipo($valor, $arrValidaciones[1]);                
                break;
                
            }
        }
    }else{

        switch ($tipo_validacion) {
            case '':
                return 'correcto';
            break;        
            case 'date':
                return val_date($valor);
            break;
            case 'nullableDate':
                return val_nullable_date($valor);
            break;
            case 'catColonia':               
                return val_cat_colonia($valor);
            break;

            case 'catDelegacion':               
                return val_cat_delegacion($valor);
            break;

            case 'subTipoPersona':               
                return val_cat_tipo_persona($valor);
            break;

            case 'regionManzanaUp':               
                return val_region_manzana_localidad($valor);
            break;
            
            case 'lote':               
                return val_lote($valor);
            break;

            case 'digitoVerificador':               
                return val_stringLength1($valor);
            break;

            case 'catRegimen':               
                return val_cat_regimen($valor);
            break;

            case 'subTipoPersonaProp':
                return val_cat_tipo_persona($valor);
            break;

            case 'catClasificacionZona':
                return val_cat_clasificacion_zona($valor);
            break;

            case 'decimalPositivo':
                return val_decimal_positivo($valor);
            break;

            case 'catClasesConstruccion':
                return val_cat_clases_construccion($valor);
            break;

            case 'catDensidadPoblacion':
                return val_cat_densidad_poblacion($valor);
            break;
            case 'catNivelSocioeconomico':
                return val_cat_nivel_socioeconomico($valor);
            break;

            case 'nonEmptyString':
                return val_vacio($valor);
            break;

            case 'catAguaPotable':
                return val_cat_agua_potable($valor);
            break;

            case 'catDrenaje':
                return val_cat_drenaje($valor);
            break;

            case 'catDrenajePluvial':
                return val_cat_drenaje_pluvial($valor);
            break;

            case 'catSuministroElectrico':
                return val_cat_suministro_electrico($valor);
            break;

            case 'catAcometidaInmueble':
                return val_cat_acometida_inmueble($valor);
            break;

            case 'catAlumbradoPublico':
                return val_cat_alumbrado_publico($valor);
            break;

            case 'catVialidades':
                return val_cat_vialidades($valor);
            break;

            case 'catBanquetas':
                return val_cat_banquetas($valor);
            break;

            case 'catGuarniciones':
                return val_cat_guarniciones($valor);
            break;
            
            case 'catGasNatural':
                return val_cat_gas_natural($valor);
            break;

            case 'catSuministroTelefonico':
                return val_cat_suministro_telefonico($valor);
            break;

            case 'catSenalizacionVias':
                return val_cat_senalizacion_vias($valor);
            break;

            case 'catNomenclaturaCalles':
                return val_cat_nomenclatura_calles($valor);
            break;

            case 'catVigilanciaZona':
                return val_cat_vigilancia_zona($valor);
            break;

            case 'catRecoleccionBasura':
                return val_cat_recoleccion_basura($valor);
            break;
            case 'boolean':
                return val_boolean($valor);
            break;
            case 'decimal':
                return val_decimal($valor);
            break;
            case 'base64Binary':
                return val_base64_binary($valor);
            break;
            case 'SUB-Indiviso':
                return val_decimal_positivo_tipo($valor, '98');                
            break;

            case 'catTopografia':
                return val_cat_topografia($valor);
            break;

            case 'catDensidadHabitacional':
                return val_cat_densidad_habitacional($valor);
            break;

            case 'SUB-IdentificadorFraccionN1Priv':
                return val_decimal_positivo($valor);
            break;

            case 'SUB-SuperficieFraccionN1Priv':
                return val_decimal_positivo_tipo($valor, '222');
            break;

            case 'SUB-FzoPriv':
                return val_decimal_positivo_tipo($valor, '32');
            break;
            case 'SUB-FubPriv':
                return val_decimal_positivo_tipo($valor, '32');
            break;

            case 'SUB-FFrPriv':
                return val_decimal_positivo_tipo($valor, '32');
            break;

            case 'SUB-FfoPriv':
                return val_decimal_positivo_tipo($valor, '32');
            break;

            case 'SUB-FsuPriv':
                return val_decimal_positivo_tipo($valor, '32');
            break;

            case 'SUB-ClaveDeAreaDeValorPriv':
                return val_vacio($valor);
            break;

            case 'SUB-FrePriv':
                return val_decimal_positivo($valor);
            break;

            case 'SUB-ValorDeLaFraccionNPriv':
                return val_decimal_positivo($valor);
            break;

            case 'SUB-ValorCatastralDeTierraAplicableALaFraccionPriv':
                return val_decimal_positivo($valor);
            break;

            case 'nullableDecimalPositivo':            
                return val_nullable_decimal_positivo($valor);
            break;

            case 'nullableDecimal':            
                return val_nullable_decimal($valor);
            break;

            case 'SUB-SuperficieTotalDeConstruccionesPrivativas':
            case 'SUB-ValorTotalDeConstruccionesPrivativas':
            case 'SUB-ValorTotalDeLasConstruccionesProIndiviso':
            case 'SUB-SuperficieTotalDeConstruccionesComunes':
            case 'SUB-ValorTotalDeConstruccionesComunes':
            case 'SUB-ValorTotalDeLasConstruccionesProIndivisoComunes':
                return val_nullable_decimal_positivo($valor);
            break;

            case 'SUB-Descripcion':
            case 'SUB-DescripcionComunes':
                return val_longitud($valor, 50);
            break;

            case 'SUB-ClaveUso':
            case 'SUB-ClaveUsoComunes':
                return val_usos_construcciones($valor);
            break;

            case 'SUB-NumeroDeNivelesDelTipo':
            case 'SUB-NumeroDeNivelesDelTipoComunes':
                return val_nullable_decimal_positivo_tipo($valor, '30');
            break;

            case 'SUB-ClaveRangoDeNiveles':
            case 'SUB-ClaveRangoDeNivelesComunes':
                return val_nullable_cat_rango_nivel_tgdf($valor);
            break;

            case 'SUB-PuntajeDeClasificacion':
            case 'SUB-PuntajeDeClasificacionComunes':
                return val_nullable_decimal_positivo($valor);
            break;

            case 'SUB-ClaveClase':
            case 'SUB-ClaveClaseComunes':
                return val_cat_clases_construccion($valor);
            break;

            case 'SUB-Edad':
            case 'SUB-EdadComunes':
            case 'SUB-VidaUtilTipo':
            case 'SUB-VidaUtilTipoComunes':
            case 'SUB-VidaUtilRemanente':
            case 'SUB-VidaUtilRemanenteComunes':
                return val_nullable_decimal_positivo($valor);
            break;

            case 'SUB-ClaveConservacion':
            case 'SUB-ClaveConservacionComunes':
                return val_nullable_cat_estado_conservacion($valor);
            break;

            case 'SUB-Superficie':
            case 'SUB-SuperficieComunes':
                return val_nullable_decimal_positivo_tipo($valor, '222');
            break;

            case 'SUB-ValorunitariodereposicionNuevo':
            case 'SUB-ValorunitariodereposicionNuevoComunes':
            case 'SUB-FactorDeEdad':
            case 'SUB-FactorDeEdadComunes':
            case 'SUB-FactorResultante':
            case 'SUB-FactorResultanteComunes':
            case 'SUB-ValorDeLaFraccionNDescInmueble':
            case 'SUB-ValorDeLaFraccionNDescInmuebleComunes':
            case 'SUB-PorcentajeIndivisoComunes':
                return val_nullable_decimal_positivo($valor);
            break;

            case 'SUB-ValorDeLaFraccionNDescInmueble':
            case 'SUB-ValorDeLaFraccionNDescInmuebleComunes':
            case 'SUB-ValorUnitarioCatastral':
            case 'SUB-ValorUnitarioCatastralComunes':
            case 'SUB-DepreciacionPorEdad':
            case 'SUB-DepreciacionPorEdadComunes':
            case 'SUB-PorcentajeIndivisoComunes':
                return val_nullable_decimal_positivo($valor);
            break;

            case 'SUB-Cimentacion':                
                return val_longitud($valor, '50');
            break;

            case 'SUB-ClaveInstalacionEspecial-PrivativaCom':
            case 'SUB-ClaveInstalacionEspecial-ComunesCom':
                return val_cat_instalaciones_especiales($valor);
            break;
            case 'SUB-DescripcionInstalacionEspecial-Privativa':
            case 'SUB-DescripcionInstalacionEspecial-Comunes':
                return val_longitud($valor, '100');
            break;
            case 'SUB-UnidadInstalacionEspecial-Privativa':
            case 'SUB-UnidadInstalacionEspecial-Comunes':
                return val_longitud($valor, '20');
            break;
            case 'SUB-CantidadInstalacionEspecial-Privativa':
            case 'SUB-CantidadInstalacionEspecial-Comunes':
                return val_nullable_decimal_positivo_tipo($valor, '222');
            break;
            case 'SUB-ValorUnitarioInstalacionEspecial-Privativa':
            case 'SUB-ImporteInstalacionEspecialComunes':
                return val_nullable_decimal_positivo($valor);
            break;
            case 'SUB-FactorDeEdadInstalacionEspecial':
            case 'SUB-FactorDeEdadInstalacionEspecialComunes':            
                return val_decimal_positivo_tipo($valor, '06');
            break;
            case 'SUB-ImporteInstalacionEspecial':
            case 'SUB-PorcentajeIndivisoEspecialComunes':
                return val_nullable_decimal_positivo($valor);
            break;
            case 'SUB-ValorUnitarioInstalacionEspecial-Comunes':
                return val_decimal_positivo($valor);
            break;
            case 'SUB-ImporteTotalInstalacionesEspecialesPrivativas':
            case 'SUB-ImporteTotalInstalacionesEspecialesComunes':
                return val_nullable_decimal_positivo($valor);
            break;

            case 'SUB-ClaveElementoAccesorio-PrivativasCom':
            case 'SUB-ClaveElementoAccesorio-ComunesCom':
            case 'SUB-ClaveObraComplementaria-PrivativasCom':
            case 'SUB-ClaveObraComplementaria-ComunesCom':
                return val_cat_instalaciones_especiales($valor);
            break;

            case 'SUB-DescripcionElementoAccesorio-Privativas':
            case 'SUB-DescripcionElementoAccesorio-ComunesCom':
            case 'SUB-DescripcionObraComplementaria-Privativas':
            case 'SUB-DescripcionObraComplementaria-ComunesCom':
                return val_vacio_longitud($valor, '100');
            break;

            case 'SUB-UnidadElementoAccesorio-Privativas':
            case 'SUB-UnidadElementoAccesorio-ComunesCom':
            case 'SUB-UnidadObraComplementaria-Privativas':
            case 'SUB-UnidadObraComplementaria-ComunesCom':
                return val_vacio_longitud($valor, '20');
            break;

            case 'SUB-CantidadElementoAccesorio-Privativas':
            case 'SUB-CantidadElementoAccesorio-ComunesCom':
            case 'SUB-CantidadObraComplementaria-Privativas':
            case 'SUB-CantidadObraComplementaria-ComunesCom':
                return val_decimal_positivo_tipo($valor, '222');
            break;

            case 'SUB-EdadElementoAccesorio':
            case 'SUB-VidaUtilTotalElementoAccesorio':
            case 'SUB-ValorUnitarioElementoAccesorio-Privativas':
            case 'SUB-FactorDeEdadElementoAccesorio':
            case 'SUB-ImporteElementoAccesorio':
            case 'SUB-EdadElementoAccesorio-Comunes':
            case 'SUB-VidaUtilTotalElementoAccesorioComunes':
            case 'SUB-ValorUnitarioElementoAccesorio-Comunes':
            case 'SUB-FactorDeEdadElementoAccesorioComunes':
            case 'SUB-ImporteElementoAccesorio-Comunes':
            case 'SUB-EdadObraComplementaria-Privativas':
            case 'SUB-ValorUnitarioObraComplementaria-Privativas':
            case 'SUB-ImporteObraComplementaria-Privativas':
            case 'SUB-EdadObraComplementaria-Comunes':
            case 'SUB-VidaUtilTotalObraComplementaria-Comunes':
            case 'SUB-ValorUnitarioObraComplementaria-Comunes':
                return val_decimal_positivo($valor);
            break;

            case 'SUB-PorcentajeIndivisoAccesorio-Comunes':
            case 'SUB-ImporteTotalElementosAccesoriosPrivativas':
            case 'SUB-ImporteTotalElementosAccesoriosComunes-Comunes':
            case 'SUB-ImporteObraComplementaria-complementaria':
            case 'SUB-PorcentajeIndivisoObraComplementaria-complementaria':
            case 'SUB-ImporteTotalObrasComplementariasPrivativas':
            case 'SUB-ImporteTotalObrasComplementariasComunes':
            case 'SUB-ImporteTotalInstalacionesAccesoriosComplementariasPrivativas':
            case 'SUB-ImporteTotalInstalacionesAccesoriosComplementariasComunes':
            case 'SUB-ImporteIndivisoInstalacionesEspecialesObrasComplementariasYElementosAccesoriosComunes':
            case 'SUB-ImporteIndivisoInstalacionesEspecialesObrasComplementariasYElementosAccesoriosPrivativas':
                return val_nullable_decimal_positivo($valor);
            break;

            case 'SUB-FactorDeEdadObraComplementaria-Privativas':
            case 'SUB-FactorDeEdadObraComplementaria-Comunes':
            case 'SUB-ImporteTotalObrasComplementariasComunes':
                return val_decimal_positivo_tipo($valor, '06');
            break;

            case 'SUB-ClaveInstalacionEspecial-PrivativaCat':
            case 'SUB-ClaveInstalacionEspecial-ComunesCat':
            case 'SUB-ClaveElementoAccesorio-PrivativasCat':
            case 'SUB-ClaveElementoAccesorio-ComunesCat':
            case 'SUB-ClaveObraComplementaria-PrivativasCat':
            case 'SUB-ClaveObraComplementaria-ComunesCat':          
                return val_cat_instalaciones_especiales($valor);
            break;
            
            case 'SUB-DescripcionElementoAccesorio-ComunesCat':
            case 'SUB-DescripcionObraComplementaria-ComunesCat':            
                return val_vacio_longitud($valor, '100');
            break;

            case 'SUB-UnidadElementoAccesorio-ComunesCat':
            case 'SUB-UnidadObraComplementaria-ComunesCat':
                return val_vacio_longitud($valor, '20');
            break;

            case 'SUB-CantidadElementoAccesorio-ComunesCat':
            case 'SUB-CantidadObraComplementaria-ComunesCat':
                return val_decimal_positivo_tipo($valor, '222');
            break;

            case 'nullableRegionManzanaUp':                
                return val_nullable_region_manzana_localidad($valor);
            break;

            case 'SUB-ValorUnitarioDeTierraAplicableAlAvaluo':
            case 'SUB-ValorDeMercadoDelInmueble':
                return val_decimal_positivo($valor);
            break;            

            case 'nullableLote':
                return val_nullable_lote($valor);
            break;

            case 'SUB-ImporteTotalDelEnfoqueDeCostos':
            case 'SUB-ImporteInstalacionesEspeciales':
            case 'SUB-ImporteTotalValorCatastralObraEnProceso':        
                return val_nullable_decimal_positivo($valor);
            break;
            
            case 'SUB-ImporteTotalValorCatastral':
                return val_decimal_positivo($valor);
            break;

            case 'SUB-AvanceDeObra':
                return val_decimal_positivo_tipo($valor, '32');
            break;
            case 'SUB-ImporteEnfoqueDeIngresos':
                return val_nullable_decimal_positivo($valor);
            break;
            case 'catTipoFotoInmueble':
                return val_cat_tipo_foto_inmueble($valor);
            break;
        }

    }
}

function val_vacio_longitud($valor, $longitud){
    $estado = "correcto";

    if(is_array($valor)){
        if(isset($valor['@attributes'])){
            unset($valor['@attributes']);
        }
        
        if(count($valor) == 1){
            $valor = $valor[0];
        }else{
            $valor = '';
        }
        
    }

    if(trim($valor) == ''){
        return "no puede estar vacio";
    }

    if(strlen($valor) > $longitud){
        return "excede la longitud permitida de ".$longitud;
    }
    return $estado;
}

function val_date($fecha){
    $valores = explode('-', $fecha);
	if(count($valores) == 3 && checkdate($valores[1], $valores[2], $valores[0])){
		return "correcto";
    }
	return "no es una fecha valida";
}

function val_nullable_date($fecha){

    if(val_null_string($fecha) == 'correcto'){
        return "correcto";
    }

    $valores = explode('-', $fecha);
	if(count($valores) == 3 && checkdate($valores[1], $valores[2], $valores[0])){
		return "correcto";
    }
	return "no es una fecha valida";
}

function val_longitud($valor, $longitud){
    $estado = "correcto";
   
    if(is_array($valor)){
        if(isset($valor['@attributes'])){
            unset($valor['@attributes']);
        }        
        if(count($valor) == 1){
            $valor = $valor[0];
        }else{
            $valor = '';
        }
        
    }

    if(strlen($valor) > $longitud && trim($valor) != ''){
        return "excede la longitud permitida de ".$longitud;
    }
    return $estado;
}

function val_cat_colonia($valor){    
    $estado = 'correcto';
    $res = val_vacio_longitud($valor, 50);    
    if($res != 'correcto'){
        return $res;
    }/*else{
        $valor = strtoupper($valor);
        $idColonia = convierte_a_arreglo(DB::select("SELECT IDCOLONIA FROM CAS.CAS_COLONIA WHERE NOMBRE = '$valor'"));
        
        if(count($idColonia) == 0){            
            return "con la colonia ".$valor." no existe en el catalogo de colonias";
        }
    }*/
    return $estado;
}

function val_cat_delegacion($valor){
    $estado = 'correcto';
    $res = val_vacio_longitud($valor, 50);    
    if($res != 'correcto'){
        return $res;
    }/*else{
        $idDelegacion = convierte_a_arreglo(DB::select("SELECT IDDELEGACION FROM CAS.CAS_DELEGACION WHERE CLAVE = '$valor'"));
        
        if(count($idDelegacion) == 0){            
            return "con la delegacion ".$valor." no existe en el catalogo de colonias";
        }
    }*/
    return $estado;
}

function val_cat_tipo_persona($valor){
    $estado = 'correcto';      
    $valor = strtoupper($valor);
    $idTipoPersona = convierte_a_arreglo(DB::select("SELECT CODTIPOSPERSONA FROM RCON.RCON_CATTIPOSPERSONA WHERE CODTIPOSPERSONA = '$valor'"));
        
    if(count($idTipoPersona) == 0){            
        return "con el tipo persona ".$valor." no existe en el catalogo de tipos persona";
    }
    
    return $estado;
}

function val_cat_tipo_foto_inmueble($valor){
    $estado = 'correcto';      
    $arrTipoFoto = array('I','E');
    if(in_array($valor,$arrTipoFoto)){
        return $estado;
    }else{
        return "con el tipo foto ".$valor." no existe en el catalogo de tipo foto";
    }
    
}

function val_nullable_region_manzana_localidad($valor){
    
    $estado = 'correcto';
    
    if(val_null_string($valor) == 'correcto'){
        return $estado;
    }
    
    $res = val_longitud($valor, 3);

    if($res != 'correcto'){
        return $res;
    }else{
        
        $patron = '[0|1|2|3|4|5|6|7|8|9|A|B|C|D|E|F|H|J|K|M|N|P|Q|R|T|U|V|W|X|Y]';
        if (preg_match($patron, $valor)) {
            return $estado;
        }else{
            return "contiene caracteres no validos";
        }
    }
}

function val_region_manzana_localidad($valor){
    $estado = 'correcto';
    $res = val_longitud($valor, 3);

    if($res != 'correcto'){
        return $res;
    }else{
        $patron = '[0|1|2|3|4|5|6|7|8|9|A|B|C|D|E|F|H|J|K|M|N|P|Q|R|T|U|V|W|X|Y]';
        if (preg_match($patron, $valor)) {
            return $estado;
        }else{
            return "contiene caracteres no validos";
        }
    }
}

function val_lote($valor){
    $estado = 'correcto';
    $res = val_longitud($valor, 2);

    if($res != 'correcto'){
        return $res;
    }else{
        $patron ='[0|1|2|3|4|5|6|7|8|9|A|B|C|D|E|F|H|J|K|M|N|P|Q|R|T|U|V|W|X|Y]';
        if (preg_match($patron, $valor)) {
            return $estado;
        }else{
            return "contiene caracteres no validos";
        }
    }
}

function val_nullable_lote($valor){
    $estado = 'correcto';

    if(val_null_string($valor) == 'correcto'){
        return $estado;
    }

    $res = val_longitud($valor, 2);

    if($res != 'correcto'){
        return $res;
    }else{
        $patron ='[0|1|2|3|4|5|6|7|8|9|A|B|C|D|E|F|H|J|K|M|N|P|Q|R|T|U|V|W|X|Y]';
        if (preg_match($patron, $valor)) {
            return $estado;
        }else{
            return "contiene caracteres no validos";
        }
    }
}

function val_stringLength1($valor){
    $estado = 'correcto';
    $res = val_longitud($valor, 1);
    if($res != 'correcto'){
        return $res;
    }
    return  $estado;
}

function val_nonNegativeInteger($valor){
    $estado = 'correcto';
    $valorInt = intval($valor);
    if($valorInt == $valor){
        if(is_int($valorInt) && $valorInt >= 0){
            return $estado;
        }else{
            return "contiene un valor no entero o negativo";
        }
    }else{
        return "contiene un valor no entero o negativo";
    }
    
}

function val_cat_regimen($valor){     
    $estado = 'correcto';       
    $res = val_nonNegativeInteger($valor);   
    if($res == 'correcto'){
        $idRegimen = convierte_a_arreglo(DB::select("SELECT CODREGIMENPROPIEDAD FROM FEXAVA_CATREGIMENPROPIEDAD WHERE CODREGIMENPROPIEDAD = '$valor'"));    
        if(count($idRegimen) == 0){            
            return "el regimen ".$valor." no existe en el catalogo de regimen propiedad";
        }
        return $estado;
    }else{
        return $res;
    }
    
}

function val_cat_clasificacion_zona($valor){
    $estado = 'correcto';
    $res = val_nonNegativeInteger($valor);
    if($res == 'correcto'){
        $idClasificacionZona = convierte_a_arreglo(DB::select("SELECT CODCLASIFICACIONZONA FROM FEXAVA_CATCLASIFICACIONZONA WHERE CODCLASIFICACIONZONA = '$valor'"));           
        if(count($idClasificacionZona) == 0){            
            return "el codigo de clasificacion de zona ".$valor." no existe en el catalogo de clasificacion zona";
        }
        return $estado;
    }else{
        return $res;
    }
}

function val_decimal_positivo($valor){
    $estado = 'correcto';
    $res = val_decimal($valor);
    if($res == 'correcto'){
        if($valor < 0){
            return "contiene un valor negativo";
        }else{
            return $estado;
        }
    }else{
        return $res;
    }    
    
}

function val_cat_clases_construccion($valor){
    $estado = 'correcto';
    $idClaseConstruccion = convierte_a_arreglo(DB::select("SELECT IDCLASES FROM FIS.FIS_CATCLASES WHERE CODCLASE = '$valor'"));        
    if(count($idClaseConstruccion) == 0){            
        return "el codigo de clase de construccion ".$valor." no existe en el catalogo de clases";
    }
    return $estado;
    
}

function val_cat_densidad_poblacion($valor){
    $estado = 'correcto';
    $res = val_nonNegativeInteger($valor);
    if($res == 'correcto'){
        $idDensidadPoblacion = convierte_a_arreglo(DB::select("SELECT CODDENSIDADPOBLACION FROM FEXAVA_CATDENSIDADPOB WHERE CODDENSIDADPOBLACION = '$valor'"));            
        if(count($idDensidadPoblacion) == 0){            
            return "el codigo de densidad de poblacion ".$valor." no existe en el catalogo de densidad de población";
        }
        return $estado;
    }else{
        return $res;
    }
}

function val_cat_nivel_socioeconomico($valor){
    $estado = 'correcto';
    $res = val_nonNegativeInteger($valor);
    if($res == 'correcto'){
        $idNivelSocioeconomico = convierte_a_arreglo(DB::select("SELECT CODNIVELSOCIOECONOMICO FROM FEXAVA_CATNIVELSOCIOECON WHERE CODNIVELSOCIOECONOMICO = '$valor'"));          
        if(count($idNivelSocioeconomico) == 0){            
            return "el codigo de nivel socioeconomico ".$valor." no existe en el catalogo de nivel socioeconomico";
        }
        return $estado;
    }else{
        return $res;
    }
}

function val_decimal_positivo_tipo($valor, $tipo){
    $estado = 'correcto';
    $pos = strpos($valor, '.');

    if($tipo == '06'){
        $res = val_decimal_positivo($valor);
        if($res == 'correcto'){            
            //$patron = '/\d{1,3}+.\d{0,1}/';
            $patron = '/\d{1,3}/';
            if (!preg_match($patron, $valor)) {
                return "no corresponde a un formato valido para este campo";
            }else{
                if($valor > 999){
                    return "contiene un valor mayor a 999";
                }else{
                    if($valor < 0.6){
                        return "contiene un valor menor a 0.6";
                    }else{
                        return $estado;
                    }                    
                }
            }
        }
        
    }
    
    if($tipo == '30'){
        $res = val_decimal_positivo($valor);
        if($res == 'correcto'){
            $patron = '/\d{1,3}/';
            if (!preg_match($patron, $valor)) {
                return "no corresponde a un formato valido para este campo";
            }else{
                if($valor > 999){
                    return "contiene un valor mayor a 999";
                }else{
                    return $estado;
                }
            }
        }
        
    }

    if($tipo == '32'){
        if($valor > 10){
            return "contiene un valor mayor a 10";
        }
        $res = val_decimal_positivo($valor);
        if($res == 'correcto'){
            if($pos === TRUE || $pos === 1){
                $elementosCantidad = explode('.',$valor);
                if((strlen($elementosCantidad[0])+strlen($elementosCantidad[1])) > 3){
                    return " contiene mas de 3 digitos";
                }
                $patron = '/\d{1}+.\d{1,2}/';
                if (!preg_match($patron, $valor)) {
                    return "no corresponde a un formato valido para este campo";
                }                    
                return $estado;                   
            }else{    
                return $estado;
            }                
        }else{
            return $res;
        }            
    }

        if($tipo == '52'){
            if($valor > 100){
                return "contiene un valor mayor a 100";
            }
            $res = val_decimal_positivo($valor);
            if($res == 'correcto'){
                if($pos === TRUE || $pos === 1){
                    $elementosCantidad = explode('.',$valor);
                    if((strlen($elementosCantidad[0])+strlen($elementosCantidad[1])) > 5){
                        return " contiene mas de 5 digitos";
                    }
                    $patron = '/\d{1,3}+.\d{1,2}/';
                    if (!preg_match($patron, $valor)) {
                        return "no corresponde a un formato valido para este campo";
                    }                    
                    return $estado;                   
                }else{    
                    return $estado;
                }                
            }else{
                return $res;
            }            
        }

        if($tipo == '54'){
            if($valor > 10){
                return "contiene un valor mayor a 10";
            }    
            $res = val_decimal_positivo($valor);
            if($res == 'correcto'){
                if($pos === TRUE || $pos === 1){
                    $elementosCantidad = explode('.',$valor);
                    if((strlen($elementosCantidad[0])+strlen($elementosCantidad[1])) > 5){
                        return " contiene mas de 5 digitos";
                    }
                    $patron = '/\d{1}+.\d{1,4}/';
                    if (!preg_match($patron, $valor)) {
                        return "no corresponde a un formato valido para este campo";
                    }        
                    return $estado;  
                    
                }else{
                    return $estado;
                }            
            }else{
                return $res;
            }            
        }

        if($tipo == '98'){                        
            if($valor > 10){
                return "contiene un valor mayor a 10";
            }                          
            $res = val_decimal_positivo($valor);
            if($res == 'correcto'){                                             
                if($pos === TRUE || $pos === 1){                    
                    $elementosCantidad = explode('.',$valor);
                    if((strlen($elementosCantidad[0])+strlen($elementosCantidad[1])) > 9){
                        return " contiene mas de 9 digitos";
                    }                   
                    $patron = '/\d{1}+.\d{1,8}/';
                    if (!preg_match($patron, $valor)) {
                        return "no corresponde a un formato valido para este campo";
                    }                          
                    return $estado;  
                    
                }else{
                    return $estado;
                }            
            }else{
                return $res;
            }            
        }

        if($tipo == '223'){                        
            if($valor > 9999999999999999999){
                return "contiene un valor mayor a 9999999999999999999";
            }                          
            $res = val_decimal_positivo($valor);
            if($res == 'correcto'){                                             
                if($pos === TRUE || $pos === 1){                    
                    $elementosCantidad = explode('.',$valor);
                    if((strlen($elementosCantidad[0])+strlen($elementosCantidad[1])) > 22){
                        return " contiene mas de 22 digitos";
                    }                   
                    $patron = '/\d{1,19}+.\d{1,3}/';
                    if (!preg_match($patron, $valor)) {
                        return "no corresponde a un formato valido para este campo";
                    }                          
                    return $estado;  
                    
                }else{
                    return $estado;
                }            
            }else{
                return $res;
            }            
        }

        if($tipo == '222'){                        
            if($valor > 99999999999999999999){
                return "contiene un valor mayor a 99999999999999999999";
            }                          
            $res = val_decimal_positivo($valor);
            if($res == 'correcto'){                                             
                if($pos === TRUE || $pos === 1){                    
                    $elementosCantidad = explode('.',$valor);
                    if((strlen($elementosCantidad[0])+strlen($elementosCantidad[1])) > 22){
                        return " contiene mas de 22 digitos";
                    }                   
                    $patron = '/\d{1,20}+.\d{1,2}/';
                    if (!preg_match($patron, $valor)) {
                        return "no corresponde a un formato valido para este campo";
                    }                          
                    return $estado;  
                    
                }else{
                    return $estado;
                }            
            }else{
                return $res;
            }            
        }

    
}

function val_vacio($valor){
    $estado = 'correcto';
    if(trim($valor) == ''){
        return "no puede estar vacio";
    }
    return $estado;
}

function val_cat_agua_potable($valor){
    $estado = 'correcto';
    $idAguaPotable = convierte_a_arreglo(DB::select("SELECT CODAGUAPOTABLE FROM FEXAVA_CATAGUAPOTABLE WHERE CODAGUAPOTABLE = '$valor'"));    
    if(count($idAguaPotable) == 0){            
        return "el codigo de agua potable ".$valor." no existe en el catalogo de agua potable";
    }
    return $estado;    
}

function val_cat_drenaje($valor){
    $estado = 'correcto';
    $idDrenajeInmueble = convierte_a_arreglo(DB::select("SELECT CODDRENAJEINMUEBLE FROM FEXAVA_CATDRENAJEINMUEBLE WHERE CODDRENAJEINMUEBLE = '$valor'"));    
    if(count($idDrenajeInmueble) == 0){            
        return "el codigo de drenaje ".$valor." no existe en el catalogo de drenaje inmueble";
    }
    return $estado;
}

function val_cat_drenaje_pluvial($valor){
    $estado = 'correcto';
    $res = val_nonNegativeInteger($valor);
    if($res == 'correcto'){
        $idDrenajePluvial = convierte_a_arreglo(DB::select("SELECT CODDRENAJEPLUVIAL FROM FEXAVA_CATDRENAJEPLUVIAL WHERE CODDRENAJEPLUVIAL = '$valor'"));    
        if(count($idDrenajePluvial) == 0){            
            return "el codigo de drenaje pluvial ".$valor." no existe en el catalogo de drenaje pluvial";
        }
        return $estado;
    }else{
        return $res;
    }
}

function val_cat_suministro_electrico($valor){
    $estado = 'correcto';
    $res = val_nonNegativeInteger($valor);
    if($res == 'correcto'){
        $idSuministroElectrico = convierte_a_arreglo(DB::select("SELECT CODSUMINISTROELECTRICO FROM FEXAVA_CATSUMINISTROELEC WHERE CODSUMINISTROELECTRICO = '$valor'"));    
        if(count($idSuministroElectrico) == 0){            
            return "el codigo de suministro electrico ".$valor." no existe en el catalogo de suministro electrico";
        }
        return $estado;
    }else{
        return $res;
    }
}

function val_cat_acometida_inmueble($valor){
    $estado = 'correcto';
    $res = val_nonNegativeInteger($valor);
    if($res == 'correcto'){
        $idAcometidaInmueble = convierte_a_arreglo(DB::select("SELECT CODACOMETIDAINMUEBLE FROM FEXAVA_CATACOMETIDAINM WHERE CODACOMETIDAINMUEBLE = '$valor'"));    
        if(count($idAcometidaInmueble) == 0){            
            return "el codigo de acometida inmueble ".$valor." no existe en el catalogo de acometida inmueble";
        }
        return $estado;
    }else{
        return $res;
    }
}

function val_cat_alumbrado_publico($valor){
    $estado = 'correcto';
    $res = val_nonNegativeInteger($valor);
    if($res == 'correcto'){
        $idAlumbradoPublico = convierte_a_arreglo(DB::select("SELECT CODALUMBRADOPUBLICO FROM FEXAVA_CATALUMBRADOPUBLICO WHERE CODALUMBRADOPUBLICO = '$valor'"));    
        if(count($idAlumbradoPublico) == 0){            
            return "el codigo de alumbrado publico ".$valor." no existe en el catalogo de alumbrado publico";
        }
        return $estado;
    }else{
        return $res;
    }
}

function val_cat_vialidades($valor){
    $estado = 'correcto';
    $res = val_nonNegativeInteger($valor);
    if($res == 'correcto'){
        $idVialidad = convierte_a_arreglo(DB::select("SELECT CODVIALIDADES FROM FEXAVA_CATVIALIDADES WHERE CODVIALIDADES = '$valor'"));    
        if(count($idVialidad) == 0){            
            return "el codigo de vialidad ".$valor." no existe en el catalogo de vialidad";
        }
        return $estado;
    }else{
        return $res;
    }
}

function val_cat_banquetas($valor){
    $estado = 'correcto';
    $res = val_nonNegativeInteger($valor);
    if($res == 'correcto'){
        $idBanquetas = convierte_a_arreglo(DB::select("SELECT CODBANQUETAS FROM FEXAVA_CATBANQUETAS WHERE CODBANQUETAS = '$valor'"));    
        if(count($idBanquetas) == 0){            
            return "el codigo de banqueta ".$valor." no existe en el catalogo de banqueta";
        }
        return $estado;
    }else{
        return $res;
    }
}

function val_cat_guarniciones($valor){
    $estado = 'correcto';
    $res = val_nonNegativeInteger($valor);
    if($res == 'correcto'){
        $idGuarniciones = convierte_a_arreglo(DB::select("SELECT CODGUARNICIONES FROM FEXAVA_CATGUARNICIONES WHERE CODGUARNICIONES = '$valor'"));    
        if(count($idGuarniciones) == 0){            
            return "el codigo de guarnicion ".$valor." no existe en el catalogo de guarnicion";
        }
        return $estado;
    }else{
        return $res;
    }
}

function val_cat_gas_natural($valor){
    $estado = 'correcto';
    $res = val_nonNegativeInteger($valor);
    if($res == 'correcto'){
        $idGasNatural = convierte_a_arreglo(DB::select("SELECT CODGASNATURAL FROM FEXAVA_CATGASNATURAL WHERE CODGASNATURAL = '$valor'"));    
        if(count($idGasNatural) == 0){            
            return "el codigo de gas natural ".$valor." no existe en el catalogo de gas natural";
        }
        return $estado;
    }else{
        return $res;
    }
}

function val_cat_suministro_telefonico($valor){
    $estado = 'correcto';
    $res = val_nonNegativeInteger($valor);
    if($res == 'correcto'){
        $idSuministroTelefonico = convierte_a_arreglo(DB::select("SELECT CODSUMINISTROTELEFONICA FROM FEXAVA_CATSUMINISTROTEL WHERE CODSUMINISTROTELEFONICA = '$valor'"));    
        if(count($idSuministroTelefonico) == 0){            
            return "el codigo de suministro telefonico ".$valor." no existe en el catalogo de suministro telefonico";
        }
        return $estado;
    }else{
        return $res;
    }
}

function val_cat_senalizacion_vias($valor){
    $estado = 'correcto';
    $res = val_nonNegativeInteger($valor);
    if($res == 'correcto'){
        $idSenalizacionVias = convierte_a_arreglo(DB::select("SELECT CODSENALIZACIONVIAS FROM FEXAVA_CATSENALIZACIONVIAS WHERE CODSENALIZACIONVIAS = '$valor'"));    
        if(count($idSenalizacionVias) == 0){            
            return "el codigo de señalizacion ".$valor." no existe en el catalogo de señalizacion vias";
        }
        return $estado;
    }else{
        return $res;
    }
}

function val_cat_nomenclatura_calles($valor){
    $estado = 'correcto';
    $res = val_nonNegativeInteger($valor);
    if($res == 'correcto'){
        $idNomenclaturaCalle = convierte_a_arreglo(DB::select("SELECT CODNOMENCLATURACALLE FROM FEXAVA_CATNOMENCLATURACALLE WHERE CODNOMENCLATURACALLE = '$valor'"));    
        if(count($idNomenclaturaCalle) == 0){            
            return "el codigo de nomenclatura calle ".$valor." no existe en el catalogo de nomenclatura calle";
        }
        return $estado;
    }else{
        return $res;
    }
}

function val_cat_vigilancia_zona($valor){
    $estado = 'correcto';
    $res = val_nonNegativeInteger($valor);
    if($res == 'correcto'){
        $idVigilanciaZona = convierte_a_arreglo(DB::select("SELECT CODVIGILANCIAZONA FROM FEXAVA_CATVIGILANCIAZONA WHERE CODVIGILANCIAZONA = '$valor'"));    
        if(count($idVigilanciaZona) == 0){            
            return "el codigo de vigilancia ".$valor." no existe en el catalogo de vigilancia zona";
        }
        return $estado;
    }else{
        return $res;
    }
}

function val_cat_recoleccion_basura($valor){
    $estado = 'correcto';
    $res = val_nonNegativeInteger($valor);
    if($res == 'correcto'){
        $idRecoleccionBasura = convierte_a_arreglo(DB::select("SELECT CODRECOLECCIONBASURA FROM FEXAVA_CATRECOLECCIONBASURA WHERE CODRECOLECCIONBASURA = '$valor'"));    
        if(count($idRecoleccionBasura) == 0){            
            return "el codigo de recoleccion basura ".$valor." no existe en el catalogo de Recoleccion Basura";
        }
        return $estado;
    }else{
        return $res;
    }
}

function val_boolean($valor){    
    $estado = 'correcto';    
    if(boolval($valor) || $valor == '0' || $valor == '1'){    
        return $estado;
    }else{
        return "no es un valor booleano";
    }
}

function val_decimal($valor){
    $estado = 'correcto';
    if(is_numeric($valor)){
        return $estado;
    }else{
        return "contiene un valor que no es decimal";
    }        
}

function val_base64_binary($valor){
    $estado = 'correcto';
    try {

        if(base64_encode(base64_decode($valor, true)) === $valor){
            return $estado;
        }else{
            return "no contiene un base64";
        }
       
    } catch (\Throwable $th) {
        return "no contiene un base64";
    }
    
}

function val_cat_topografia($valor){
    $estado = 'correcto';
    $res = val_nonNegativeInteger($valor);
    if($res == 'correcto'){
        $idTopografia = convierte_a_arreglo(DB::select("SELECT CODTOPOGRAFIA FROM FEXAVA_CATTOPOGRAFIA WHERE CODTOPOGRAFIA = '$valor'"));    
        if(count($idTopografia) == 0){            
            return "el codigo de topografia ".$valor." no existe en el catalogo de Topografia";
        }
        return $estado;
    }else{
        return $res;
    }
    
}

function val_cat_densidad_habitacional($valor){
    $estado = 'correcto';
    $res = val_nonNegativeInteger($valor);
    if($res == 'correcto'){
        $idDensidadHabit = convierte_a_arreglo(DB::select("SELECT CODDENSIDADHABITACIONAL FROM FEXAVA_CATDENSIDADHAB WHERE CODDENSIDADHABITACIONAL = '$valor'"));    
        if(count($idDensidadHabit) == 0){            
            return "el codigo de densidad habitacional ".$valor." no existe en el catalogo de densidad habitacional";
        }
        return $estado;
    }else{
        return $res;
    }
}

function val_nullable_decimal_positivo($valor){
    $estado = 'correcto';    
    if(val_null_string($valor) == 'correcto'){
        return $estado;
    }elseif(val_decimal_positivo($valor) == 'correcto'){
        
        return $estado;
    }else{
        return "no corresponde a un formato valido para este campo";
    }
}

function val_nullable_decimal($valor){
    $estado = 'correcto';    
    if(val_null_string($valor) == 'correcto'){
        return $estado;
    }elseif(val_decimal($valor) == 'correcto'){
        
        return $estado;
    }else{
        return "no corresponde a un formato valido para este campo";
    }
}

function val_nullable_decimal_positivo_tipo($valor, $tipo){
    $estado = 'correcto';
    if(val_null_string($valor) == 'correcto'){
        return $estado;
    }elseif(val_decimal_positivo_tipo($valor, $tipo) == 'correcto'){
        return $estado;
    }else{
        return "no corresponde a un formato valido para este campo";
    }
}

function val_null_string($valor){
    if($valor === ''){
        return 'correcto';
    }
}

function val_usos_construcciones($valor){
    $estado = 'correcto';  
    $idUsos = convierte_a_arreglo(DB::select("SELECT IDUSOS FROM FIS.FIS_CATUSOS WHERE CODUSO = '$valor'"));    
    if(count($idUsos) == 0){            
        return "el codigo de uso construccion ".$valor." no existe en el catalogo de usos";
    }
    return $estado;    
}

function val_nullable_cat_rango_nivel_tgdf($valor){
    $estado = 'correcto';
    if(val_null_string($valor) == 'correcto'){
        return $estado;
    }elseif(val_cat_rango_nivel_tgdf($valor) == 'correcto'){
        return $estado;
    }else{
        return "no corresponde a un formato valido para este campo";
    }
}

function val_cat_rango_nivel_tgdf($valor){
    $estado = 'correcto';
    $arrRangos = array('01','02','05','10','15','20','99','RU');   
    if(in_array($valor,$arrRangos)){
        return $estado;
    }else{
        return "el codigo de nivel ".$valor." no existe en el catalogo de nivel";
    }        
}

function val_nullable_cat_estado_conservacion($valor){
    $estado = 'correcto';
    $res = val_nonNegativeInteger($valor);
    if($res == 'correcto'){
        $idEstadoConservacion = convierte_a_arreglo(DB::select("SELECT CODESTADOCONSERVACION FROM FEXAVA_CATESTADOCONSERV WHERE CODESTADOCONSERVACION = '$valor'"));    
        if(count($idEstadoConservacion) == 0){            
            return "el codigo de estado conservacion".$valor." no existe en el catalogo de estado conservacion";
        }
        return $estado;
    }else{
        return $res;
    }
}

function val_cat_instalaciones_especiales($valor){
    $estado = 'correcto';
    $arrInstalacionesEspeciales = array('IE01','IE02','IE03','IE04','IE05','IE06','IE07','IE08','IE09','IE10','IE11','IE12','IE13','IE14','IE15','IE16','IE17','IE18','IE19','EA01','EA02','EA03','EA04','EA05','EA06','EA07','EA08','EA09','EA10','EA11','EA12','OC01','OC02','OC03','OC04','OC05','OC06','OC07','OC08','OC09','OC10','OC11','OC12','OC13','OC14','OC15','OC16','OC17');
    if(in_array($valor,$arrInstalacionesEspeciales)){
        return $estado;
    }else{
        return "el codigo de instalaciones especiales ".$valor." no existe en el catalogo de instalaciones especiales";
    }
}

/**************************************************************************************************************************************************************************/

function valida_AvaluoIdentificacion($data){    
    //$elementos = array('NumeroDeAvaluo','FechaAvaluo','ClaveValuador','ClaveSociedad');
    $validaciones = array('NumeroDeAvaluo' => 'nonEmptyString_30','FechaAvaluo' => 'date','ClaveValuador' => 'nonEmptyString_20','ClaveSociedad' => 'string_20');  
    $errores = array();
    $data = array_map("convierte_a_arreglo",$data);
    $numeroIdentificaciones = count($data);
    if($numeroIdentificaciones == 0){
        $errores[] = "El XML no cuenta con la parte de Identificacion";
    }elseif ($numeroIdentificaciones > 1) {
        $errores[] = "El XML cuenta con mas de una Identificacion";
    }else{
        foreach($validaciones as $etiqueta => $validacion){
            if(!isset($data[0][$etiqueta])){
                $errores[] = "Falta ".$etiqueta." en Identificacion";
            }else{                
                $resValidacion = define_validacion($validacion, $data[0][$etiqueta]);    
                if($resValidacion != 'correcto'){
                    $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                }
            }
        }    
        
    }
    return $errores;
}

function valida_AvaluoAntecedentes($data, $elementoPrincipal){
    if($elementoPrincipal == '//Comercial'){
        $validacionesb = array('PropositoDelAvaluo' => 'nonEmptyString_50', 'ObjetoDelAvaluo' => 'nonEmptyString_50', 'RegimenDePropiedad' => 'catRegimen');    
        $validacionesb1 = array('A.Paterno' => 'string_35','A.Materno' => 'string_35','Nombre' => 'nonEmptyString_50','Calle' => 'nonEmptyString_50','NumeroInterior' => 'nonEmptyString_30', 'NumeroExterior' => 'nonEmptyString_25','Colonia' =>'catColonia', 'CodigoPostal' => 'nonEmptyString_5', 'Delegacion' => 'catDelegacion','TipoPersona' => 'subTipoPersona');
        $validacionesb2 = array('A.Paterno' => 'string_35','A.Materno' => 'string_35','Nombre' => 'nonEmptyString_50','Calle' => 'nonEmptyString_50','NumeroInterior' => 'nonEmptyString_30', 'NumeroExterior' => 'nonEmptyString_25','Colonia' =>'catColonia', 'CodigoPostal' => 'nonEmptyString_5', 'Delegacion' => 'catDelegacion','TipoPersona' => 'subTipoPersona');
        $validacionesb3 = array('Calle' => 'nonEmptyString_50','NumeroInterior' => 'nonEmptyString_30','NumeroExterior' => 'nonEmptyString_25','Manzana' => 'string_50','Lote' => 'string_50', 'Edificio' => 'string_50','Colonia' =>'catColonia', 'CodigoPostal' => 'nonEmptyString_5', 'Delegacion' => 'catDelegacion', 'CuentaCatastral' => 'validacionesb310', 'CuentaDeAgua' => '');
        $validacionesb310 = array('Region' => 'regionManzanaUp', 'Manzana' => 'regionManzanaUp', 'Lote' => 'lote', 'Localidad' => 'regionManzanaUp', 'DigitoVerificador' => 'digitoVerificador');
    }else{
        $validacionesb = array('PropositoDelAvaluo' => 'nonEmptyString_50', 'ObjetoDelAvaluo' => 'nonEmptyString_50', 'RegimenDePropiedad' => 'catRegimen');
        $validacionesb1 = array('A.Paterno' => 'string_35','A.Materno' => 'string_35','Nombre' => 'nonEmptyString_50','Calle' => 'nonEmptyString_50','NumeroInterior' => 'nonEmptyString_30', 'NumeroExterior' => 'nonEmptyString_25','Colonia' =>'catColonia', 'CodigoPostal' => 'nonEmptyString_5', 'Delegacion' => 'catDelegacion','TipoPersona' => 'subTipoPersona');
        $validacionesb2 = array('A.Paterno' => 'string_35','A.Materno' => 'string_35','Nombre' => 'nonEmptyString_50','Calle' => 'nonEmptyString_50','NumeroInterior' => 'nonEmptyString_30', 'NumeroExterior' => 'nonEmptyString_25','Colonia' =>'catColonia', 'CodigoPostal' => 'nonEmptyString_5', 'Delegacion' => 'catDelegacion','TipoPersona' => 'subTipoPersonaProp');
        $validacionesb3 = array('Calle' => 'nonEmptyString_50','NumeroInterior' => 'nonEmptyString_30','NumeroExterior' => 'nonEmptyString_25','Manzana' => 'string_50','Lote' => 'string_50', 'Edificio' => 'string_50','Colonia' =>'catColonia', 'CodigoPostal' => 'nonEmptyString_5', 'Delegacion' => 'catDelegacion', 'CuentaCatastral' => 'validacionesb310', 'CuentaDeAgua' => '');
        $validacionesb310 = array('Region' => 'regionManzanaUp', 'Manzana' => 'regionManzanaUp', 'Lote' => 'lote', 'Localidad' => 'regionManzanaUp', 'DigitoVerificador' => 'digitoVerificador');
    }
    
    $errores = array();
    $data = array_map("convierte_a_arreglo",$data);
    $numeroAntecedentes = count($data);    
    if($numeroAntecedentes == 0){
        $errores[] = "El XML no cuenta con la parte de Antecedentes";
    }elseif ($numeroAntecedentes > 1) {
        $errores[] = "El XML cuenta con mas de un Antecedente";
    }else{
        foreach($validacionesb1 as $etiqueta => $validacion){
            if(!isset($data[0]['Solicitante'][$etiqueta])){
                $errores[] = "Falta ".$etiqueta." en Antecedentes (Solicitante)";
            }else{                   
                $resValidacionSolicitante = define_validacion($validacion, $data[0]['Solicitante'][$etiqueta]);                
                if($resValidacionSolicitante != 'correcto'){
                    $errores[] = "El campo ".$etiqueta." ".$resValidacionSolicitante;
                }                
            }
        }
        
        foreach($validacionesb2 as $etiqueta => $validacion){
            if(!isset($data[0]['Propietario'][$etiqueta])){
                $errores[] = "Falta ".$etiqueta." en Antecedentes (Propietario)";
            }else{
                $resValidacionPropietario = define_validacion($validacion, $data[0]['Propietario'][$etiqueta]);                
                if($resValidacionPropietario != 'correcto'){
                    $errores[] = "El campo ".$etiqueta." ".$resValidacionPropietario;
                }
            }
        }

        foreach($validacionesb3 as $etiqueta => $validacion){
            if(!isset($data[0]['InmuebleQueSeValua'][$etiqueta])){
                $errores[] = "Falta ".$etiqueta." en Antecedentes (InmuebleQueSeValua)";
            }else{
                if($etiqueta == 'CuentaCatastral'){ 
                    $arrCuentaCatastral = $data[0]['InmuebleQueSeValua'][$etiqueta];                                    
                    foreach($validacionesb310 as $etiquetaCatastral => $validacionCatastral){
                        if(!isset($arrCuentaCatastral[$etiquetaCatastral])){
                            $errores[] = "Falta ".$etiquetaCatastral." en Antecedentes (CuentaCatastral)";
                        }else{
                            
                            $resValidacionCuentaCatastral = define_validacion($validacionCatastral, $arrCuentaCatastral[$etiquetaCatastral]);                
                            if($resValidacionCuentaCatastral != 'correcto'){
                                $errores[] = "El campo ".$etiquetaCatastral." ".$resValidacionCuentaCatastral;
                            }
                        }
                    }
                }else{
                    
                    $resValidacionInmuebleQueSeValua = define_validacion($validacion, $data[0]['InmuebleQueSeValua'][$etiqueta]);                
                    if($resValidacionInmuebleQueSeValua != 'correcto'){
                        $errores[] = "El campo ".$etiqueta.": ".$resValidacionInmuebleQueSeValua;
                    }
                }
                
            }
        }

        foreach($validacionesb as $etiquetaPrincipal => $validacionPrincipal){
            if(!isset($data[0][$etiquetaPrincipal])){
                $errores[] = "Falta ".$etiquetaPrincipal." en Antecedentes ";
            }else{
                $resValidacionPrincipal = define_validacion($validacionPrincipal, $data[0][$etiquetaPrincipal]);                
                if($resValidacionPrincipal != 'correcto'){
                    $errores[] = "El campo ".$etiquetaPrincipal." ".$resValidacionPrincipal;
                }
            }
        }        
        
    }
    return $errores;
}

function valida_AvaluoCaracteristicasUrbanas($data){    
    $validacionesc = array('ContaminacionAmbientalEnLaZona' => 'string_250','ClasificacionDeLaZona' => 'catClasificacionZona','IndiceDeSaturacionDeLaZona' => 'decimalPositivo','ClaseGeneralDeInmueblesDeLaZona' => 'catClasesConstruccion', 'DensidadDePoblacion' => 'catDensidadPoblacion', 'NivelSocioeconomicoDeLaZona' => 'catNivelSocioeconomico');
    $validacionesc6 = array('UsoDelSuelo' => 'nonEmptyString_50', 'AreaLibreObligatoria' => 'decimalPositivo_52', 'NumeroMaximoDeNivelesAConstruir' => 'decimalPositivo_30', 'CoeficienteDeUsoDelSuelo' => 'decimalPositivo');
    $validacionesc7 = array('ViasDeAccesoEImportancia' => 'nonEmptyString');
    $validacionesc8 = array('RedDeDistribucionAguaPotable' => 'catAguaPotable', 'RedDeRecoleccionDeAguasResiduales' => 'catDrenaje', 'RedDeDrenajeDeAguasPluvialesEnLaCalle' => 'catDrenajePluvial', 'RedDeDrenajeDeAguasPluvialesEnLaZona' => 'catDrenajePluvial', 'SistemaMixto' => 'catDrenaje', 'SuministroElectrico' => 'catSuministroElectrico', 'AcometidaAlInmueble' => 'catAcometidaInmueble', 'AlumbradoPublico' => 'catAlumbradoPublico', 'Vialidades' => 'catVialidades', 'Banquetas' => 'catBanquetas', 'Guarniciones' => 'catGuarniciones', 'NivelDeInfraestructuraEnLaZona' => 'decimalPositivo_54', 'GasNatural' => 'catGasNatural', 'TelefonosSuministro' => 'catSuministroTelefonico', 'AcometidaAlInmuebleTel' => 'catAcometidaInmueble', 'SennalizacionDeVias' => 'catSenalizacionVias', 'NomenclaturaDeCalles' => 'catNomenclaturaCalles', 'DistanciaTranporteUrbano' => 'decimalPositivo', 'FrecuenciaTransporteUrbano' => 'decimalPositivo', 'DistanciaTransporteSuburbano' => 'decimalPositivo', 'FrecuenciaTransporteSuburbano' => 'decimalPositivo', 'Vigilancia' => 'catVigilanciaZona', 'RecoleccionDeBasura' => 'catRecoleccionBasura', 'Templo' => 'boolean', 'Mercados' => 'boolean', 'PlazasPublicas' => 'boolean', 'ParquesYJardines' => 'boolean', 'Escuelas' => 'boolean', 'Hospitales' => 'boolean', 'Bancos' => 'boolean', 'EstacionDeTransporte' => 'boolean', 'NivelDeEquipamientoUrbano' => 'decimal');
    $errores = array();
    $data = array_map("convierte_a_arreglo",$data);    
    $numeroCaracteristicasUrbanas = count($data);    
    if ($numeroCaracteristicasUrbanas > 1) {
        $errores[] = "El XML cuenta con mas de una seccion de Caracteristicas Urbanas";
    }else{
        foreach($validacionesc as $etiqueta => $validacion){
            if(!isset($data[0][$etiqueta])){
                $errores[] = "Falta ".$etiqueta." en Antecedentes (Solicitante)";
            }else{
                $resValidacion = define_validacion($validacion, $data[0][$etiqueta]);                             
                if($resValidacion != 'correcto'){
                    $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                }
            }
        }
        
        foreach($validacionesc6 as $etiqueta => $validacion){
            if(!isset($data[0]['UsoDelSuelo'][$etiqueta])){
                $errores[] = "Falta ".$etiqueta." en CaracteristicasUrbanas (UsoDelSuelo)";
            }else{
                $resValidacion = define_validacion($validacion, $data[0]['UsoDelSuelo'][$etiqueta]);                
                if($resValidacion != 'correcto'){
                    $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                }
            
            }
        }

        foreach($validacionesc7 as $etiqueta => $validacion){
            if(!isset($data[0][$etiqueta])){
                $errores[] = "Falta ".$etiqueta." en CaracteristicasUrbanas";
            }else{
                $resValidacion = define_validacion($validacion, $data[0][$etiqueta]);                
                if($resValidacion != 'correcto'){
                    $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                }
            }
        }

        foreach($validacionesc8 as $etiqueta => $validacion){
            if(!isset($data[0]['ServiciosPublicosYEquipamientoUrbano'][$etiqueta])){
                $errores[] = "Falta ".$etiqueta." en CaracteristicasUrbanas";
            }else{
                $resValidacion = define_validacion($validacion, $data[0]['ServiciosPublicosYEquipamientoUrbano'][$etiqueta]);                
                if($resValidacion != 'correcto'){
                    $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                }                
            }
        }
    }
    return $errores;
}

function valida_AvaluoTerreno($data, $elementoPrincipal){   
    if($elementoPrincipal == '//Comercial'){
        $validacionesd = array('CallesTransversalesLimitrofesYOrientacion' => 'nonEmptyString', 'CroquisMicroLocalizacion' => 'base64Binary', 'CroquisMacroLocalizacion' => 'base64Binary', 'Indiviso' => 'SUB-Indiviso', 'TopografiaYConfiguracion' => 'catTopografia', 'CaracteristicasPanoramicas' => 'nonEmptyString_250', 'DensidadHabitacional' => 'catDensidadHabitacional', 'ServidumbresORestricciones' => 'nonEmptyString_250', 'SuperficieTotalDelTerreno' => 'decimalPositivo', 'ValorTotalDelTerreno' => 'decimalPositivo', 'ValorTotalDelTerrenoProporcional' => 'decimalPositivo');
        $validacionesd411 = array('NumeroDeEscritura' => 'decimalPositivo', 'NumeroDeVolumen' => 'nonEmptyString_7', 'FechaEscritura' => 'date', 'NumeroNotaria' => 'decimalPositivo', 'NombreDelNotario' => 'nonEmptyString_50', 'DistritoJudicialNotario' => 'nonEmptyString_50');
        $validacionesd412 = array('Juzgado' => 'nonEmptyString_50', 'Fecha' => 'date', 'NumeroExpediente' => 'nonEmptyString_16');
        $validacionesd413 = array('Fecha' => 'date', 'NombreAdquirente' => 'nonEmptyString_50', 'Apellido1Adquirente' => 'nonEmptyString_100', 'Apellido2Adquirente' => 'nonEmptyString_50', 'NombreEnajenante' => 'nonEmptyString_50', 'Apellido1Enajenante' => 'nonEmptyString_100', 'Apellido2Enajenante' => 'nonEmptyString_50');
        $validacionesd414 = array('Fecha' => 'date', 'NumeroFolio' => 'nonEmptyString_20');
        $validacionesd42 = array('Orientacion' => 'nonEmptyString', 'MedidaEnMetros' => 'decimalPositivo_223', 'DescripcionColindante' => 'nonEmptyString');
        $validacionesd5P = array('IdentificadorFraccionN1' => 'SUB-IdentificadorFraccionN1Priv', 'SuperficieFraccionN1' => 'SUB-SuperficieFraccionN1Priv', 'Fzo' => 'SUB-FzoPriv', 'Fub' => 'SUB-FubPriv', 'FFr' => 'SUB-FFrPriv', 'Ffo' => 'SUB-FfoPriv', 'Fsu' => 'SUB-FsuPriv', 'ClaveDeAreaDeValor' => 'SUB-ClaveDeAreaDeValorPriv', 'Fre' => 'SUB-FrePriv', 'ValorDeLaFraccionN' => 'SUB-ValorDeLaFraccionNPriv');
        $validacionesd5C = array('IdentificadorFraccionN1' => 'SUB-IdentificadorFraccionN1Com', 'SuperficieFraccionN1' => 'SUB-SuperficieFraccionN1Com', 'Fzo' => 'SUB-FzoCom', 'Fub' => 'SUB-FubCom', 'FFr' => 'SUB-FFrCom', 'Ffo' => 'SUB-FfoCom', 'Fsu' => 'SUB-FsuCom', 'ClaveDeAreaDeValor' => 'SUB-ClaveDeAreaDeValorCom', 'Fre' => 'SUB-FreCom', 'ValorDeLaFraccionN' => 'SUB-ValorDeLaFraccionNCom');       
    }else{
        $validacionesd = array('CallesTransversalesLimitrofesYOrientacion' => 'nonEmptyString', 'CroquisMicroLocalizacion' => 'base64Binary', 'CroquisMacroLocalizacion' => 'base64Binary','Indiviso' => 'SUB-Indiviso', 'TopografiaYConfiguracion' => 'catTopografia', 'CaracteristicasPanoramicas' => 'nonEmptyString_250', 'DensidadHabitacional' => 'catDensidadHabitacional', 'ServidumbresORestricciones' => 'nonEmptyString_250', 'SuperficieTotalDelTerreno' => 'decimalPositivo', 'ValorTotalDelTerreno' => 'decimalPositivo', 'ValorTotalDelTerrenoProporcional' => 'decimalPositivo');
        $validacionesd411 = array('NumeroDeEscritura' => 'decimalPositivo', 'NumeroDeVolumen' => 'nonEmptyString_7', 'FechaEscritura' => 'date', 'NumeroNotaria' => 'decimalPositivo', 'NombreDelNotario' => 'nonEmptyString_50', 'DistritoJudicialNotario' => 'nonEmptyString_50');
        $validacionesd412 = array('Juzgado' => 'nonEmptyString_50', 'Fecha' => 'date', 'NumeroExpediente' => 'nonEmptyString_16');
        $validacionesd413 = array('Fecha' => 'date', 'NombreAdquirente' => 'nonEmptyString_50', 'Apellido1Adquirente' => 'nonEmptyString_100', 'Apellido2Adquirente' => 'nonEmptyString_50', 'NombreEnajenante' => 'nonEmptyString_50', 'Apellido1Enajenante' => 'nonEmptyString_100', 'Apellido2Enajenante' => 'nonEmptyString_50');
        $validacionesd414 = array('Fecha' => 'date', 'NumeroFolio' => 'nonEmptyString_20');
        $validacionesd42 = array('Orientacion' => 'nonEmptyString', 'MedidaEnMetros' => 'decimalPositivo_223', 'DescripcionColindante' => 'nonEmptyString');
        $validacionesd5P = array('IdentificadorFraccionN1' => 'SUB-IdentificadorFraccionN1Priv', 'SuperficieFraccionN1' => 'SUB-SuperficieFraccionN1Priv', 'ClaveDeAreaDeValor' => 'SUB-ClaveDeAreaDeValorPriv', 'ValorCatastralDeTierraAplicableALaFraccion' => 'SUB-ValorCatastralDeTierraAplicableALaFraccionPriv');
        $validacionesd5P = array('IdentificadorFraccionN1' => 'SUB-IdentificadorFraccionN1Com', 'SuperficieFraccionN1' => 'SUB-SuperficieFraccionN1Com', 'ClaveDeAreaDeValor' => 'SUB-ClaveDeAreaDeValorCom', 'ValorCatastralDeTierraAplicableALaFraccion' => 'SUB-ValorCatastralDeTierraAplicableALaFraccionCom');
    }
    
    $errores = array();
    $data = array_map("convierte_a_arreglo",$data);

    $numeroTerrenos = count($data);    
    if ($numeroTerrenos > 1) {
        $errores[] = "El XML cuenta con mas de una seccion de Terreno";
    }else{
        foreach($validacionesd as $etiqueta => $validacion){
            if(!isset($data[0][$etiqueta])){
                $errores[] = "Falta ".$etiqueta." en MedidasYColindancias";
            }else{
                $resValidacion = define_validacion($validacion, $data[0][$etiqueta]);                             
                if($resValidacion != 'correcto'){
                    $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                }
            }
        }
        
        
        foreach($validacionesd411 as $etiqueta => $validacion){
            if(!isset($data[0]['MedidasYColindancias']['FuenteDeInformacionLegal']['Escritura'][$etiqueta])){
                $errores[] = "Falta ".$etiqueta." en MedidasYColindancias (Escritura)";
            }else{
                $resValidacion = define_validacion($validacion, $data[0]['MedidasYColindancias']['FuenteDeInformacionLegal']['Escritura'][$etiqueta]);                             
                if($resValidacion != 'correcto'){
                    $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                }
            }
        }

        if(isset($data[0]['MedidasYColindancias']['FuenteDeInformacionLegal']['Sentencia'])){
            foreach($validacionesd412 as $etiqueta => $validacion){
                if(!isset($data[0]['MedidasYColindancias']['FuenteDeInformacionLegal']['Sentencia'][$etiqueta])){
                    $errores[] = "Falta ".$etiqueta." en FuenteDeInformacionLegal (Sentencia)";
                }else{
                    $resValidacion = define_validacion($validacion, $data[0]['MedidasYColindancias']['FuenteDeInformacionLegal']['Sentencia'][$etiqueta]);                             
                    if($resValidacion != 'correcto'){
                        $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                    }
                }
            }
        }
        
        if(isset($data[0]['MedidasYColindancias']['FuenteDeInformacionLegal']['ContratoPrivado'])){
            foreach($validacionesd413 as $etiqueta => $validacion){
                if(!isset($data[0]['MedidasYColindancias']['FuenteDeInformacionLegal']['ContratoPrivado'][$etiqueta])){
                    $errores[] = "Falta ".$etiqueta." en FuenteDeInformacionLegal (ContratoPrivado)";
                }else{
                    $resValidacion = define_validacion($validacion, $data[0]['MedidasYColindancias']['FuenteDeInformacionLegal']['ContratoPrivado'][$etiqueta]);                             
                    if($resValidacion != 'correcto'){
                        $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                    }
                }
            }
        }
        
        if(isset($data[0]['MedidasYColindancias']['FuenteDeInformacionLegal']['AlineamientoYNumeroOficial'])){
            foreach($validacionesd414 as $etiqueta => $validacion){
                if(!isset($data[0]['MedidasYColindancias']['FuenteDeInformacionLegal']['AlineamientoYNumeroOficial'][$etiqueta])){
                    $errores[] = "Falta ".$etiqueta." en FuenteDeInformacionLegal (AlineamientoYNumeroOficial)";
                }else{
                    $resValidacion = define_validacion($validacion, $data[0]['MedidasYColindancias']['FuenteDeInformacionLegal']['AlineamientoYNumeroOficial'][$etiqueta]);                             
                    if($resValidacion != 'correcto'){
                        $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                    }
                }
            }
        }

        $numeroColindancias = 0;
        $numeroColindancias = count($data[0]['MedidasYColindancias']['Colindancias']);      

        if($numeroColindancias == 0){
            $errores[] = "El XML no cuenta con la seccion de Colindancias";
        }else{
            foreach($data[0]['MedidasYColindancias']['Colindancias'] as $colindancia){
                foreach($validacionesd42 as $etiqueta => $validacion){
                    if(!isset($colindancia[$etiqueta])){
                        $errores[] = "Falta ".$etiqueta." en Colindancias";
                    }else{
                        $resValidacion = define_validacion($validacion, $colindancia[$etiqueta]);                             
                        if($resValidacion != 'correcto'){
                            $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                        }
                    }
                }
            }
        }
        
        foreach($validacionesd5P as $etiqueta => $validacion){
            if(!isset($data[0]['SuperficieDelTerreno'][$etiqueta])){
                $errores[] = "Falta ".$etiqueta." en SuperficieDelTerreno";
            }else{
                $resValidacion = define_validacion($validacion, $data[0]['SuperficieDelTerreno'][$etiqueta]);                             
                if($resValidacion != 'correcto'){
                    $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                }
            }
        }
        
    }

    return $errores;    
}

function valida_AvaluoDescripcionImueble($data, $elementoPrincipal){

    if($elementoPrincipal == '//Comercial'){
        //$validacionese = array('UsoActual' => 'nonEmptyString_2000', 'VidaUtilTotalPonderadaDelInmueble' => 'nullableDecimalPositivo', 'EdadPonderadaDelInmueble' => 'nullableDecimalPositivo', 'VidaUtilRemanentePonderadaDelInmueble' => 'nullableDecimalPositivo');
        $validacionese = array('UsoActual' => 'nonEmptyString_2000', 'VidaUtilTotalPonderadaDelInmueble' => 'nullableDecimalPositivo', 'EdadPonderadaDelInmueble' => 'nullableDecimalPositivo', 'VidaUtilRemanentePonderadaDelInmueble' => 'nullableDecimalPositivo', 'PorcentSuperfUltimNivelRespectoAnterior' => 'decimalPositivo_54');

        $validacionese2 = array('SuperficieTotalDeConstruccionesPrivativas' => 'SUB-SuperficieTotalDeConstruccionesPrivativas', 'ValorTotalDeConstruccionesPrivativas' => 'SUB-ValorTotalDeConstruccionesPrivativas', 'ValorTotalDeLasConstruccionesProIndiviso' => 'SUB-ValorTotalDeLasConstruccionesProIndiviso', 'SuperficieTotalDeConstruccionesComunes' => 'SUB-SuperficieTotalDeConstruccionesComunes', 'ValorTotalDeConstruccionesComunes' => 'SUB-ValorTotalDeConstruccionesComunes', 'ValorTotalDeLasConstruccionesComunesProIndiviso' => 'SUB-ValorTotalDeLasConstruccionesProIndivisoComunes');

        $validacionese21 = array('Descripcion' => 'SUB-Descripcion', 'ClaveUso' => 'SUB-ClaveUso', 'NumeroDeNivelesDelTipo' => 'SUB-NumeroDeNivelesDelTipo', 'ClaveRangoDeNiveles' => 'SUB-ClaveRangoDeNiveles', 'PuntajeDeClasificacion' => 'SUB-PuntajeDeClasificacion', 'ClaveClase' => 'SUB-ClaveClase', 'Edad' => 'SUB-Edad', 'VidaUtilTotalDelTipo' => 'SUB-VidaUtilTipo', 'VidaUtilRemanente' => 'SUB-VidaUtilRemanente', 'ClaveConservacion' => 'SUB-ClaveConservacion', 'Superficie' => 'SUB-Superficie', 'ValorunitariodereposicionNuevo' => 'SUB-ValorunitariodereposicionNuevo', 'FactorDeEdad' => 'SUB-FactorDeEdad', 'FactorResultante' => 'SUB-FactorResultante', 'ValorDeLaFraccionN' => 'SUB-ValorDeLaFraccionNDescInmueble');

        $validacionese25 = array('Descripcion' => 'SUB-DescripcionComunes', 'ClaveUso' => 'SUB-ClaveUsoComunes', 'NumeroDeNivelesDelTipo' => 'SUB-NumeroDeNivelesDelTipoComunes', 'ClaveRangoDeNiveles' => 'SUB-ClaveRangoDeNivelesComunes', 'PuntajeDeClasificacion' => 'SUB-PuntajeDeClasificacionComunes', 'ClaveClase' => 'SUB-ClaveClaseComunes', 'Edad' => 'SUB-EdadComunes', 'VidaUtilTotalDelTipo' => 'SUB-VidaUtilTipoComunes', 'VidaUtilRemanente' => 'SUB-VidaUtilRemanenteComunes', 'ClaveConservacion' => 'SUB-ClaveConservacionComunes', 'Superficie' => 'SUB-SuperficieComunes', 'ValorunitariodereposicionNuevo' => 'SUB-ValorunitariodereposicionNuevoComunes', 'FactorDeEdad' => 'SUB-FactorDeEdadComunes', 'FactorResultante' => 'SUB-FactorResultanteComunes', 'ValorDeLaFraccionN' => 'SUB-ValorDeLaFraccionNDescInmuebleComunes','PorcentajeIndivisoComunes' => 'SUB-PorcentajeIndivisoComunes');
    }else{
        //$validacionese = array('UsoActual' => 'nonEmptyString_2000', 'VidaUtilTotalPonderadaDelInmueble' => 'nullableDecimalPositivo', 'EdadPonderadaDelInmueble' => 'nullableDecimalPositivo', 'VidaUtilRemanentePonderadaDelInmueble' => 'nullableDecimalPositivo');
        $validacionese = array('UsoActual' => 'nonEmptyString_2000', 'VidaUtilTotalPonderadaDelInmueble' => 'nullableDecimalPositivo', 'EdadPonderadaDelInmueble' => 'nullableDecimalPositivo', 'VidaUtilRemanentePonderadaDelInmueble' => 'nullableDecimalPositivo', 'PorcentSuperfUltimNivelRespectoAnterior' => 'decimalPositivo_54');

        $validacionese2 = array('SuperficieTotalDeConstruccionesPrivativas' => 'SUB-SuperficieTotalDeConstruccionesPrivativas', 'ValorTotalDeConstruccionesPrivativas' => 'SUB-ValorTotalDeConstruccionesPrivativas', 'ValorTotalDeLasConstruccionesProIndiviso' => 'SUB-ValorTotalDeLasConstruccionesProIndiviso', 'SuperficieTotalDeConstruccionesComunes' => 'SUB-SuperficieTotalDeConstruccionesComunes', 'ValorTotalDeConstruccionesComunes' => 'SUB-ValorTotalDeConstruccionesComunes', 'ValorTotalDeLasConstruccionesComunesProIndiviso' => 'SUB-ValorTotalDeLasConstruccionesProIndivisoComunes');
        
        $validacionese21 = array('Descripcion' => 'SUB-Descripcion', 'ClaveUso' => 'SUB-ClaveUso', 'NumeroDeNivelesDelTipo' => 'SUB-NumeroDeNivelesDelTipo', 'ClaveRangoDeNiveles' => 'SUB-ClaveRangoDeNiveles', 'PuntajeDeClasificacion' => 'SUB-PuntajeDeClasificacion', 'ClaveClase' => 'SUB-ClaveClase', 'Edad' => 'SUB-Edad', 'VidaUtilTotalDelTipo' => 'SUB-VidaUtilTipo', 'VidaUtilRemanente' => 'SUB-VidaUtilRemanente', 'ClaveConservacion' => 'SUB-ClaveConservacion', 'Superficie' => 'SUB-Superficie', 'ValorDeLaFraccionN' => 'SUB-ValorDeLaFraccionNDescInmueble', 'ValorUnitarioCatastral' => 'SUB-ValorUnitarioCatastral', 'DepreciacionPorEdad' => 'SUB-DepreciacionPorEdad');
       
        $validacionese21 = array('Descripcion' => 'SUB-Descripcion', 'ClaveUso' => 'SUB-ClaveUso', 'NumeroDeNivelesDelTipo' => 'SUB-NumeroDeNivelesDelTipo', 'ClaveRangoDeNiveles' => 'SUB-ClaveRangoDeNiveles', 'PuntajeDeClasificacion' => 'SUB-PuntajeDeClasificacion', 'ClaveClase' => 'SUB-ClaveClase', 'Edad' => 'SUB-Edad', 'VidaUtilTotalDelTipo' => 'SUB-VidaUtilTipo', 'VidaUtilRemanente' => 'SUB-VidaUtilRemanente', 'ClaveConservacion' => 'SUB-ClaveConservacion', 'Superficie' => 'SUB-Superficie', 'ValorDeLaFraccionN' => 'SUB-ValorDeLaFraccionNDescInmueble', 'ValorUnitarioCatastral' => 'SUB-ValorUnitarioCatastral', 'DepreciacionPorEdad' => 'SUB-DepreciacionPorEdad', 'PorcentajeIndivisoComunes' => 'SUB-PorcentajeIndivisoComunes');
    }

    $errores = array();
    $data = array_map("convierte_a_arreglo",$data);
    //print_r($data[0]['TiposDeConstruccion']['SuperficieTotalDeConstruccionesPrivativas']); exit();
    foreach($validacionese as $etiqueta => $validacion){
        if(!isset($data[0][$etiqueta]) && $data[0][$etiqueta] != 'PorcentSuperfUltimNivelRespectoAnterior'){
            $errores[] = "Falta ".$etiqueta." en DescripcionDelInmueble";
        }else{
            $resValidacion = define_validacion($validacion, $data[0][$etiqueta]);                
            if($resValidacion != 'correcto'){
                $errores[] = "El campo ".$etiqueta." ".$resValidacion;
            }                
        }
    }
    //print_r($data[0]['TiposDeConstruccion']['ValorTotalDeLasConstruccionesComunesProIndiviso']); exit();
    foreach($validacionese2 as $etiqueta => $validacion){
        if(!isset($data[0]['TiposDeConstruccion'][$etiqueta])){
            $errores[] = "Falta ".$etiqueta." en TiposDeConstruccion";
        }else{
            //echo  $etiqueta." ".$data[0]['TiposDeConstruccion'][$etiqueta]."\n";
            $resValidacion = define_validacion($validacion, $data[0]['TiposDeConstruccion'][$etiqueta]);                
            if($resValidacion != 'correcto'){
                $errores[] = "El campo ".$etiqueta." ".$resValidacion;
            }                
        }
    }
    
    if(isset($data[0]['TiposDeConstruccion']['ConstruccionesPrivativas']['@attributes']) && $data[0]['TiposDeConstruccion']['ConstruccionesPrivativas']['@attributes']['id'] == 'e.2.1'){
        foreach($validacionese21 as $etiqueta => $validacion){
            if(!isset($data[0]['TiposDeConstruccion']['ConstruccionesPrivativas'][$etiqueta])){
                $errores[] = "Falta ".$etiqueta." en ConstruccionesPrivativas";
            }else{
                $resValidacion = define_validacion($validacion, $data[0]['TiposDeConstruccion']['ConstruccionesPrivativas'][$etiqueta]);                
                if($resValidacion != 'correcto'){
                    $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                }                
            }
        }
    } 

    if(isset($data[0]['TiposDeConstruccion']['ConstruccionesPrivativas'][0]['@attributes']) && $data[0]['TiposDeConstruccion']['ConstruccionesPrivativas'][0]['@attributes']['id'] == 'e.2.1'){
        foreach($data[0]['TiposDeConstruccion']['ConstruccionesPrivativas'] as $llavePrincipal => $elementoPrincipal){            
            //if(is_array($elementoPrincipal) && $elementoPrincipal['id'] != 'e.2.1'){
                    foreach($validacionese21 as $etiqueta => $validacion){
                        if(!isset($elementoPrincipal[$etiqueta])){
                            $errores[] = "Falta ".$etiqueta." en ConstruccionesPrivativas";
                        }else{
                            $resValidacion = define_validacion($validacion, $elementoPrincipal[$etiqueta]);                
                            if($resValidacion != 'correcto'){
                                $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                            }                
                        }
                    }
            //}
           
        }
    }


    if(isset($data[0]['TiposDeConstruccion']['ConstruccionesComunes']['@attributes']) && $data[0]['TiposDeConstruccion']['ConstruccionesComunes']['@attributes']['id'] == 'e.2.5'){
        foreach($validacionese21 as $etiqueta => $validacion){
            if(!isset($data[0]['TiposDeConstruccion']['ConstruccionesComunes'][$etiqueta])){
                $errores[] = "Falta ".$etiqueta." en ConstruccionesComunes";
            }else{
                $resValidacion = define_validacion($validacion, $data[0]['TiposDeConstruccion']['ConstruccionesComunes'][$etiqueta]);                
                if($resValidacion != 'correcto'){
                    $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                }                
            }
        }
    } 

    if(isset($data[0]['TiposDeConstruccion']['ConstruccionesComunes'][0]['@attributes']) && $data[0]['TiposDeConstruccion']['ConstruccionesComunes'][0]['@attributes']['id'] == 'e.2.5'){
        foreach($data[0]['TiposDeConstruccion']['ConstruccionesComunes'] as $llavePrincipal => $elementoPrincipal){            
            //if(is_array($elementoPrincipal) && $elementoPrincipal['id'] != 'e.2.1'){
                    foreach($validacionese25 as $etiqueta => $validacion){
                        if(!isset($elementoPrincipal[$etiqueta])){
                            $errores[] = "Falta ".$etiqueta." en ConstruccionesComunes";
                        }else{
                            $resValidacion = define_validacion($validacion, $elementoPrincipal[$etiqueta]);                
                            if($resValidacion != 'correcto'){
                                $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                            }                
                        }
                    }
            //}            
        }
    }       

    return $errores;
}


function valida_AvaluoElementosDeLaConstruccion($data, $elementoPrincipal){
    if($elementoPrincipal == '//Comercial'){
        $validacionesf = array('InstalacionesElectricasYAlumbrado' => 'string_250', 'Vidreria' => 'string_250', 'Cerrajeria' => 'string_250', 'Fachadas' => 'string_250', 'ImporteTotalInstalacionesAccesoriosComplementariasPrivativas' => 'SUB-ImporteTotalInstalacionesAccesoriosComplementariasPrivativas', 'ImporteTotalInstalacionesAccesoriosComplementariasComunes' => 'SUB-ImporteTotalInstalacionesAccesoriosComplementariasComunes', 'ImporteIndivisoInstalacionesEspecialesObrasComplementariasYElementosAccesoriosComunes' => 'SUB-ImporteIndivisoInstalacionesEspecialesObrasComplementariasYElementosAccesoriosComunes', 'ImporteIndivisoInstalacionesEspecialesObrasComplementariasYElementosAccesoriosPrivativas' => 'SUB-ImporteIndivisoInstalacionesEspecialesObrasComplementariasYElementosAccesoriosPrivativas');

        $validacionesf1 = array('Cimentacion' => 'SUB-Cimentacion', 'Estructura' => 'string_250', 'Muros' => 'string_250', 'Entrepisos' => 'string_250', 'Techos' => 'string_250', 'Azoteas' => 'string_250', 'Bardas' => 'string_250');
        $validacionesf2 = array('Aplanados' => 'string_500', 'Plafones' => 'string_500', 'Lambrines' => 'string_500', 'Pisos' => 'string_500', 'Zoclos' => 'string_500', 'Escaleras' => 'string_500', 'Pintura' => 'string_500', 'RecubrimientosEspeciales' => 'string_500');
        $validacionesf3 = array('PuertasInteriores' => 'string_250', 'Guardaropas' => 'string_250', 'MueblesEmpotradosOFijos' => 'string_250');
        $validacionesf4 = array('MueblesDeBanno' => 'string_500', 'RamaleosHidraulicos' => 'string_500', 'RamaleosSanitarios' => 'string_500');
        $validacionesf5 = array('Herreria' => 'string_500', 'Ventaneria' => 'string_250');

        $validacionesf9 = array('ImporteTotalInstalacionesEspecialesPrivativas' => 'SUB-ImporteTotalInstalacionesEspecialesPrivativas', 'ImporteTotalInstalacionesEspecialesComunes' => 'SUB-ImporteTotalInstalacionesEspecialesComunes');

        $validacionesf91 = array('ClaveInstalacionEspecial' => 'SUB-ClaveInstalacionEspecial-PrivativaCom', 'DescripcionInstalacionEspecial' => 'SUB-DescripcionInstalacionEspecial-Privativa', 'UnidadInstalacionEspecial' => 'SUB-UnidadInstalacionEspecial-Privativa', 'CantidadInstalacionEspecial' => 'SUB-CantidadInstalacionEspecial-Privativa', 'EdadInstalacionEspecial' => 'nullableDecimalPositivo', 'VidaUtilTotalInstalacionEspecial' => 'nullableDecimalPositivo', 'ValorUnitarioInstalacionEspecial' => 'SUB-ValorUnitarioInstalacionEspecial-Privativa', 'FactorDeEdadInstalacionEspecial' => 'SUB-FactorDeEdadInstalacionEspecial', 'ImporteInstalacionEspecial' => 'SUB-ImporteInstalacionEspecial');

        $validacionesf92 = array('ClaveInstalacionEspecial' => 'SUB-ClaveInstalacionEspecial-ComunesCom', 'DescripcionInstalacionEspecial' => 'SUB-DescripcionInstalacionEspecial-Comunes', 'UnidadInstalacionEspecial' => 'SUB-UnidadInstalacionEspecial-Comunes', 'CantidadInstalacionEspecial' => 'SUB-CantidadInstalacionEspecial-Comunes', 'EdadInstalacionEspecial' => 'nullableDecimalPositivo', 'VidaUtilTotalInstalacionEspecial' => 'nullableDecimalPositivo', 'ValorUnitarioInstalacionEspecial' => 'SUB-ValorUnitarioInstalacionEspecial-Comunes', 'FactorDeEdadInstalacionEspecial' => 'SUB-FactorDeEdadInstalacionEspecialComunes', 'ImporteInstalacionEspecial' => 'SUB-ImporteInstalacionEspecialComunes', 'PorcentajeIndivisoEspecial' => 'SUB-PorcentajeIndivisoEspecialComunes');

        $validacionesf10 = array('ImporteTotalElementosAccesoriosPrivativas' => 'SUB-ImporteTotalElementosAccesoriosPrivativas', 'ImporteTotalElementosAccesoriosComunes' => 'SUB-ImporteTotalElementosAccesoriosComunes-Comunes');

        $validacionesf101 = array('ClaveElementoAccesorio' => 'SUB-ClaveElementoAccesorio-PrivativasCom', 'DescripcionElementoAccesorio' => 'SUB-DescripcionElementoAccesorio-Privativas', 'UnidadElementoAccesorio' => 'SUB-UnidadElementoAccesorio-Privativas', 'CantidadElementoAccesorio' => 'SUB-CantidadElementoAccesorio-Privativas', 'EdadElementoAccesorio' => 'SUB-EdadElementoAccesorio', 'VidaUtilTotalElementoAccesorio' => 'SUB-VidaUtilTotalElementoAccesorio', 'ValorUnitarioElementoAccesorio' => 'SUB-ValorUnitarioElementoAccesorio-Privativas', 'FactorDeEdadElementoAccesorio' => 'SUB-FactorDeEdadElementoAccesorio', 'ImporteElementoAccesorio' => 'SUB-ImporteElementoAccesorio');

        $validacionesf102 = array('ClaveElementoAccesorio' => 'SUB-ClaveElementoAccesorio-ComunesCom', 'DescripcionElementoAccesorio' => 'SUB-DescripcionElementoAccesorio-ComunesCom', 'UnidadElementoAccesorio' => 'SUB-UnidadElementoAccesorio-ComunesCom', 'CantidadElementoAccesorio' => 'SUB-CantidadElementoAccesorio-ComunesCom', 'EdadElementoAccesorio' => 'SUB-EdadElementoAccesorio-Comunes', 'VidaUtilTotalElementoAccesorio' => 'SUB-VidaUtilTotalElementoAccesorioComunes', 'ValorUnitarioElementoAccesorio' => 'SUB-ValorUnitarioElementoAccesorio-Comunes', 'FactorDeEdadElementoAccesorio' => 'SUB-FactorDeEdadElementoAccesorioComunes', 'ImporteElementoAccesorio' => 'SUB-ImporteElementoAccesorio-Comunes', 'PorcentajeIndivisoAccesorio' => 'SUB-PorcentajeIndivisoAccesorio-Comunes');

        $validacionesf11 = array('ImporteTotalObrasComplementariasPrivativas' => 'SUB-ImporteTotalObrasComplementariasPrivativas', 'ImporteTotalObrasComplementariasComunes' => 'SUB-ImporteTotalObrasComplementariasComunes');

        $validacionesf111 = array('ClaveObraComplementaria' => 'SUB-ClaveObraComplementaria-PrivativasCom', 'DescripcionObraComplementaria' => 'SUB-DescripcionObraComplementaria-Privativas', 'UnidadObraComplementaria' => 'SUB-UnidadObraComplementaria-Privativas', 'CantidadObraComplementaria' => 'SUB-CantidadObraComplementaria-Privativas', 'EdadObraComplementaria' => 'SUB-EdadObraComplementaria-Privativas', 'VidaUtilTotalObraComplementaria' => 'nullableDecimalPositivo', 'ValorUnitarioObraComplementaria' => 'SUB-ValorUnitarioObraComplementaria-Privativas', 'FactorDeEdadObraComplementaria' => 'SUB-FactorDeEdadObraComplementaria-Privativas', 'ImporteObraComplementaria' => 'SUB-ImporteObraComplementaria-Privativas');

        $validacionesf112 = array('ClaveObraComplementaria' => 'SUB-ClaveObraComplementaria-ComunesCom', 'DescripcionObraComplementaria' => 'SUB-DescripcionObraComplementaria-ComunesCom', 'UnidadObraComplementaria' => 'SUB-UnidadObraComplementaria-ComunesCom', 'CantidadObraComplementaria' => 'SUB-CantidadObraComplementaria-ComunesCom', 'EdadObraComplementaria' => 'SUB-EdadObraComplementaria-Comunes', 'VidaUtilTotalObraComplementaria' => 'SUB-VidaUtilTotalObraComplementaria-Comunes', 'ValorUnitarioObraComplementaria' => 'SUB-ValorUnitarioObraComplementaria-Comunes', 'FactorDeEdadObraComplementaria' => 'SUB-FactorDeEdadObraComplementaria-Comunes', 'ImporteObraComplementaria' => 'SUB-ImporteObraComplementaria-complementaria', 'PorcentajeIndivisoObraComplementaria' => 'SUB-PorcentajeIndivisoObraComplementaria-complementaria');
    }else{
        $validacionesf = array('InstalacionesElectricasYAlumbrado' => 'string_250', 'Vidreria' => 'string_250', 'Cerrajeria' => 'string_250', 'Fachadas' => 'string_250', 'ImporteTotalInstalacionesAccesoriosComplementariasPrivativas' => 'SUB-ImporteTotalInstalacionesAccesoriosComplementariasPrivativas', 'ImporteTotalInstalacionesAccesoriosComplementariasComunes' => 'SUB-ImporteTotalInstalacionesAccesoriosComplementariasComunes', 'ImporteIndivisoInstalacionesEspecialesObrasComplementariasYElementosAccesoriosComunes' => 'SUB-ImporteIndivisoInstalacionesEspecialesObrasComplementariasYElementosAccesoriosComunes', 'ImporteIndivisoInstalacionesEspecialesObrasComplementariasYElementosAccesoriosPrivativas' => 'SUB-ImporteIndivisoInstalacionesEspecialesObrasComplementariasYElementosAccesoriosPrivativas');
        $validacionesf1 = array('Cimentacion' => 'SUB-Cimentacion', 'Estructura' => 'string_250', 'Muros' => 'string_250', 'Entrepisos' => 'string_250', 'Techos' => 'string_250', 'Azoteas' => 'string_250', 'Bardas' => 'string_250');
        $validacionesf2 = array('Aplanados' => 'string_500', 'Plafones' => 'string_500', 'Lambrines' => 'string_500', 'Pisos' => 'string_500', 'Zoclos' => 'string_500', 'Escaleras' => 'string_500', 'Pintura' => 'string_250', 'RecubrimientosEspeciales' => 'string_250');
        $validacionesf3 = array('PuertasInteriores' => 'string_250', 'Guardaropas' => 'string_250', 'MueblesEmpotradosOFijos' => 'string_250');
        $validacionesf4 = array('MueblesDeBanno' => 'string_500', 'RamaleosHidraulicos' => 'string_500', 'RamaleosSanitarios' => 'string_500');
        
        $validacionesf5 = array('Herreria' => 'string_250', 'Ventaneria' => 'string_250', 'Vidreria' => 'string_250', 'Cerrajeria' => 'string_250', 'Fachadas' => 'string_250');

        $validacionesf91 = array('ClaveInstalacionEspecial' => 'SUB-ClaveInstalacionEspecial-PrivativaCat', 'DescripcionInstalacionEspecial' => 'SUB-DescripcionInstalacionEspecial-Privativa', 'UnidadInstalacionEspecial' => 'SUB-UnidadInstalacionEspecial-Privativa', 'CantidadInstalacionEspecial' => 'SUB-CantidadInstalacionEspecial-Privativa');

        $validacionesf92 = array('ClaveInstalacionEspecial' => 'SUB-ClaveInstalacionEspecial-ComunesCat', 'DescripcionInstalacionEspecial' => 'SUB-DescripcionInstalacionEspecial-Comunes', 'UnidadInstalacionEspecial' => 'SUB-UnidadInstalacionEspecial-Comunes', 'CantidadInstalacionEspecial' => 'SUB-CantidadInstalacionEspecial-Comunes');

        $validacionesf101 = array('ClaveElementoAccesorio' => 'SUB-ClaveElementoAccesorio-PrivativasCat', 'DescripcionElementoAccesorio' => 'SUB-DescripcionElementoAccesorio-Privativas', 'UnidadElementoAccesorio' => 'SUB-UnidadElementoAccesorio-Privativas', 'CantidadElementoAccesorio' => 'SUB-CantidadElementoAccesorio-Privativas');

        $validacionesf102 = array('ClaveElementoAccesorio' => 'SUB-ClaveElementoAccesorio-ComunesCat', 'DescripcionElementoAccesorio' => 'SUB-DescripcionElementoAccesorio-ComunesCat', 'UnidadElementoAccesorio' => 'SUB-UnidadElementoAccesorio-ComunesCat', 'CantidadElementoAccesorio' => 'SUB-CantidadElementoAccesorio-ComunesCat');

        $validacionesf111 = array('ClaveObraComplementaria' => 'SUB-ClaveObraComplementaria-PrivativasCat', 'DescripcionObraComplementaria' => 'SUB-DescripcionObraComplementaria-Privativas', 'UnidadObraComplementaria' => 'SUB-UnidadObraComplementaria-Privativas', 'CantidadObraComplementaria' => 'SUB-CantidadObraComplementaria-Privativas');

        $validacionesf112 = array('ClaveObraComplementaria' => 'SUB-ClaveObraComplementaria-ComunesCat', 'DescripcionObraComplementaria' => 'SUB-DescripcionObraComplementaria-ComunesCat', 'UnidadObraComplementaria' => 'SUB-UnidadObraComplementaria-ComunesCat', 'CantidadObraComplementaria' => 'SUB-CantidadObraComplementaria-ComunesCat');
    }

    $errores = array(); 
    $data = array_map("convierte_a_arreglo",$data);

    foreach($validacionesf as $etiqueta => $validacion){
        if(!isset($data[0][$etiqueta])){
            $errores[] = "Falta ".$etiqueta." en ElementosDeLaConstruccion";
        }else{
            $resValidacion = define_validacion($validacion, $data[0][$etiqueta]);                
            if($resValidacion != 'correcto'){
                $errores[] = "El campo ".$etiqueta." ".$resValidacion;
            }                
        }
    }

    foreach($validacionesf1 as $etiqueta => $validacion){
        if(!isset($data[0]['ObraNegra'][$etiqueta])){
            $errores[] = "Falta ".$etiqueta." en ObraNegra";
        }else{
            $resValidacion = define_validacion($validacion, $data[0]['ObraNegra'][$etiqueta]);                
            if($resValidacion != 'correcto'){
                $errores[] = "El campo ".$etiqueta." ".$resValidacion;
            }                
        }
    }

    foreach($validacionesf2 as $etiqueta => $validacion){
        if(!isset($data[0]['RevestimientosYAcabadosInteriores'][$etiqueta])){
            $errores[] = "Falta ".$etiqueta." en RevestimientosYAcabadosInteriores";
        }else{
            $resValidacion = define_validacion($validacion, $data[0]['RevestimientosYAcabadosInteriores'][$etiqueta]);                
            if($resValidacion != 'correcto'){
                $errores[] = "El campo ".$etiqueta." ".$resValidacion;
            }                
        }
    }

    foreach($validacionesf3 as $etiqueta => $validacion){
        if(!isset($data[0]['Carpinteria'][$etiqueta])){
            $errores[] = "Falta ".$etiqueta." en Carpinteria";
        }else{
            $resValidacion = define_validacion($validacion, $data[0]['Carpinteria'][$etiqueta]);                
            if($resValidacion != 'correcto'){
                $errores[] = "El campo ".$etiqueta." ".$resValidacion;
            }                
        }
    }

    foreach($validacionesf4 as $etiqueta => $validacion){
        if(!isset($data[0]['InstalacionesHidraulicasYSanitrias'][$etiqueta])){
            $errores[] = "Falta ".$etiqueta." en InstalacionesHidraulicasYSanitrias";
        }else{
            $resValidacion = define_validacion($validacion, $data[0]['InstalacionesHidraulicasYSanitrias'][$etiqueta]);                
            if($resValidacion != 'correcto'){
                $errores[] = "El campo ".$etiqueta." ".$resValidacion;
            }                
        }
    }

    foreach($validacionesf5 as $etiqueta => $validacion){
        if(!isset($data[0]['PuertasYVentaneriaMetalica'][$etiqueta])){
            $errores[] = "Falta ".$etiqueta." en PuertasYVentaneriaMetalica";
        }else{
            $resValidacion = define_validacion($validacion, $data[0]['PuertasYVentaneriaMetalica'][$etiqueta]);                
            if($resValidacion != 'correcto'){
                $errores[] = "El campo ".$etiqueta." ".$resValidacion;
            }                
        }
    }

    if(isset($data[0]['InstalacionesEspeciales']['Privativas']['@attributes']) && $data[0]['InstalacionesEspeciales']['Privativas']['@attributes']['id'] == 'f.9.1'){
        foreach($validacionesf91 as $etiqueta => $validacion){
            if(!isset($data[0]['InstalacionesEspeciales']['Privativas'][$etiqueta])){
                $errores[] = "Falta ".$etiqueta." en en InstalacionesEspeciales (Privativas)";
            }else{
                $resValidacion = define_validacion($validacion, $data[0]['InstalacionesEspeciales']['Privativas'][$etiqueta]);                
                if($resValidacion != 'correcto'){
                    $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                }                
            }
        }
    }

    if(isset($data[0]['InstalacionesEspeciales']['Privativas'][0]['@attributes']) && $data[0]['InstalacionesEspeciales']['Privativas'][0]['@attributes']['id'] == 'f.9.1'){
        foreach($data[0]['InstalacionesEspeciales']['Privativas'] as $llavePrincipal => $elementoPrincipal){            
            //if(is_array($elementoPrincipal) && $elementoPrincipal['id'] != 'e.2.1'){
                    foreach($validacionesf91 as $etiqueta => $validacion){
                        if(!isset($elementoPrincipal[$etiqueta])){
                            $errores[] = "Falta ".$etiqueta." en InstalacionesEspeciales (Privativas)";
                        }else{
                            $resValidacion = define_validacion($validacion, $elementoPrincipal[$etiqueta]);                
                            if($resValidacion != 'correcto'){
                                $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                            }                
                        }
                    }
            //}            
        }
    }

    if(isset($data[0]['InstalacionesEspeciales']['Comunes']['@attributes']) && $data[0]['InstalacionesEspeciales']['Comunes']['@attributes']['id'] == 'f.9.2'){
        foreach($validacionesf92 as $etiqueta => $validacion){
            if(!isset($data[0]['InstalacionesEspeciales']['Comunes'][$etiqueta])){
                $errores[] = "Falta ".$etiqueta." en en InstalacionesEspeciales (Comunes)";
            }else{
                $resValidacion = define_validacion($validacion, $data[0]['InstalacionesEspeciales']['Comunes'][$etiqueta]);                
                if($resValidacion != 'correcto'){
                    $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                }                
            }
        }
    }

    if(isset($data[0]['InstalacionesEspeciales']['Comunes'][0]['@attributes']) && $data[0]['InstalacionesEspeciales']['Comunes'][0]['@attributes']['id'] == 'f.9.2'){
        foreach($data[0]['InstalacionesEspeciales']['Comunes'] as $llavePrincipal => $elementoPrincipal){            
            //if(is_array($elementoPrincipal) && $elementoPrincipal['id'] != 'e.2.1'){
                    foreach($validacionesf92 as $etiqueta => $validacion){
                        if(!isset($elementoPrincipal[$etiqueta])){
                            $errores[] = "Falta ".$etiqueta." en InstalacionesEspeciales (Comunes)";
                        }else{
                            $resValidacion = define_validacion($validacion, $elementoPrincipal[$etiqueta]);                
                            if($resValidacion != 'correcto'){
                                $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                            }                
                        }
                    }
            //}            
        }
    }

    foreach($validacionesf9 as $etiqueta => $validacion){
        if(!isset($data[0]['InstalacionesEspeciales'][$etiqueta])){
            $errores[] = "Falta ".$etiqueta." en InstalacionesEspeciales";
        }else{
            $resValidacion = define_validacion($validacion, $data[0]['InstalacionesEspeciales'][$etiqueta]);                
            if($resValidacion != 'correcto'){
                $errores[] = "El campo ".$etiqueta." ".$resValidacion;
            }                
        }
    }

    if(isset($data[0]['ElementosAccesorios']['Privativas']['@attributes']) && $data[0]['ElementosAccesorios']['Privativas']['@attributes']['id'] == 'f.10.1'){
        foreach($validacionesf101 as $etiqueta => $validacion){
            if(!isset($data[0]['ElementosAccesorios']['Privativas'][$etiqueta])){
                $errores[] = "Falta ".$etiqueta." en en ElementosAccesorios (Privativas)";
            }else{
                $resValidacion = define_validacion($validacion, $data[0]['ElementosAccesorios']['Privativas'][$etiqueta]);                
                if($resValidacion != 'correcto'){
                    $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                }                
            }
        }
    }

    if(isset($data[0]['ElementosAccesorios']['Privativas'][0]['@attributes']) && $data[0]['ElementosAccesorios']['Privativas'][0]['@attributes']['id'] == 'f.10.1'){
        foreach($data[0]['ElementosAccesorios']['Privativas'] as $llavePrincipal => $elementoPrincipal){            
            //if(is_array($elementoPrincipal) && $elementoPrincipal['id'] != 'e.2.1'){
                    foreach($validacionesf101 as $etiqueta => $validacion){
                        if(!isset($elementoPrincipal[$etiqueta])){
                            $errores[] = "Falta ".$etiqueta." en ElementosAccesorios (Privativas)";
                        }else{
                            $resValidacion = define_validacion($validacion, $elementoPrincipal[$etiqueta]);                
                            if($resValidacion != 'correcto'){
                                $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                            }                
                        }
                    }
            //}            
        }
    }

    if(isset($data[0]['ElementosAccesorios']['Comunes']['@attributes']) && $data[0]['ElementosAccesorios']['Comunes']['@attributes']['id'] == 'f.10.2'){
        foreach($validacionesf102 as $etiqueta => $validacion){
            if(!isset($data[0]['ElementosAccesorios']['Comunes'][$etiqueta])){
                $errores[] = "Falta ".$etiqueta." en en ElementosAccesorios (Comunes)";
            }else{
                $resValidacion = define_validacion($validacion, $data[0]['ElementosAccesorios']['Comunes'][$etiqueta]);                
                if($resValidacion != 'correcto'){
                    $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                }                
            }
        }
    }

    if(isset($data[0]['ElementosAccesorios']['Comunes'][0]['@attributes']) && $data[0]['ElementosAccesorios']['Comunes'][0]['@attributes']['id'] == 'f.10.2'){
        foreach($data[0]['ElementosAccesorios']['Comunes'] as $llavePrincipal => $elementoPrincipal){            
            //if(is_array($elementoPrincipal) && $elementoPrincipal['id'] != 'e.2.1'){
                    foreach($validacionesf102 as $etiqueta => $validacion){
                        if(!isset($elementoPrincipal[$etiqueta])){
                            $errores[] = "Falta ".$etiqueta." en ElementosAccesorios (Comunes)";
                        }else{
                            $resValidacion = define_validacion($validacion, $elementoPrincipal[$etiqueta]);                
                            if($resValidacion != 'correcto'){
                                $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                            }                
                        }
                    }
            //}            
        }
    }

    foreach($validacionesf10 as $etiqueta => $validacion){
        if(!isset($data[0]['ElementosAccesorios'][$etiqueta])){
            $errores[] = "Falta ".$etiqueta." en ElementosAccesorios";
        }else{
            $resValidacion = define_validacion($validacion, $data[0]['ElementosAccesorios'][$etiqueta]);                
            if($resValidacion != 'correcto'){
                $errores[] = "El campo ".$etiqueta." ".$resValidacion;
            }                
        }
    }

    if(isset($data[0]['ObrasComplementarias']['Privativas']['@attributes']) && $data[0]['ObrasComplementarias']['Privativas']['@attributes']['id'] == 'f.11.1'){
        foreach($validacionesf111 as $etiqueta => $validacion){
            if(!isset($data[0]['ObrasComplementarias']['Privativas'][$etiqueta])){
                $errores[] = "Falta ".$etiqueta." en en ObrasComplementarias (Privativas)";
            }else{
                $resValidacion = define_validacion($validacion, $data[0]['ObrasComplementarias']['Privativas'][$etiqueta]);                
                if($resValidacion != 'correcto'){
                    $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                }                
            }
        }
    }

    if(isset($data[0]['ObrasComplementarias']['Privativas'][0]['@attributes']) && $data[0]['ObrasComplementarias']['Privativas'][0]['@attributes']['id'] == 'f.11.1'){
        foreach($data[0]['ObrasComplementarias']['Privativas'] as $llavePrincipal => $elementoPrincipal){            
            //if(is_array($elementoPrincipal) && $elementoPrincipal['id'] != 'e.2.1'){
                    foreach($validacionesf111 as $etiqueta => $validacion){
                        if(!isset($elementoPrincipal[$etiqueta])){
                            $errores[] = "Falta ".$etiqueta." en ObrasComplementarias (Privativas)";
                        }else{
                            $resValidacion = define_validacion($validacion, $elementoPrincipal[$etiqueta]);                
                            if($resValidacion != 'correcto'){
                                $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                            }                
                        }
                    }
            //}            
        }
    }

    if(isset($data[0]['ObrasComplementarias']['Comunes']['@attributes']) && $data[0]['ObrasComplementarias']['Comunes']['@attributes']['id'] == 'f.11.2'){
        foreach($validacionesf112 as $etiqueta => $validacion){
            if(!isset($data[0]['ObrasComplementarias']['Comunes'][$etiqueta])){
                $errores[] = "Falta ".$etiqueta." en en ObrasComplementarias (Comunes)";
            }else{
                $resValidacion = define_validacion($validacion, $data[0]['ObrasComplementarias']['Comunes'][$etiqueta]);                
                if($resValidacion != 'correcto'){
                    $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                }                
            }
        }
    }

    if(isset($data[0]['ObrasComplementarias']['Comunes'][0]['@attributes']) && $data[0]['ObrasComplementarias']['Comunes'][0]['@attributes']['id'] == 'f.11.2'){
        foreach($data[0]['ObrasComplementarias']['Comunes'] as $llavePrincipal => $elementoPrincipal){            
            //if(is_array($elementoPrincipal) && $elementoPrincipal['id'] != 'e.2.1'){
                    foreach($validacionesf112 as $etiqueta => $validacion){
                        if(!isset($elementoPrincipal[$etiqueta])){
                            $errores[] = "Falta ".$etiqueta." en ObrasComplementarias (Comunes)";
                        }else{
                            $resValidacion = define_validacion($validacion, $elementoPrincipal[$etiqueta]);                
                            if($resValidacion != 'correcto'){
                                $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                            }                
                        }
                    }
            //}            
        }
    }

    foreach($validacionesf11 as $etiqueta => $validacion){
        if(!isset($data[0]['ObrasComplementarias'][$etiqueta])){
            $errores[] = "Falta ".$etiqueta." en ObrasComplementarias";
        }else{
            $resValidacion = define_validacion($validacion, $data[0]['ObrasComplementarias'][$etiqueta]);                
            if($resValidacion != 'correcto'){
                $errores[] = "El campo ".$etiqueta." ".$resValidacion;
            }                
        }
    }    
    //print_r($data[0]['InstalacionesEspeciales']); exit();
    
    return $errores;
}

function valida_ConsideracionesPreviasAlAvaluo($data){

    $validacionesg = array('ConsideracionesPreviasAlAvaluo' => 'string_2000');
    $errores = array(); 
    $data = array_map("convierte_a_arreglo",$data);

    foreach($validacionesg as $etiqueta => $validacion){
        if(!isset($data[0]['ConsideracionesPreviasAlAvaluo'][$etiqueta])){
            $errores[] = "Falta ".$etiqueta." en ConsideracionesPreviasAlAvaluo";
        }else{
            $resValidacion = define_validacion($validacion, $data[0]['ConsideracionesPreviasAlAvaluo'][$etiqueta]);                
            if($resValidacion != 'correcto'){
                $errores[] = "El campo ".$etiqueta." ".$resValidacion;
            }                
        }
    }

    return $errores;
}

function valida_AvaluoEnfoqueMercado($data){

    $validacionesh = array('ValorDeMercadoDelInmueble' => 'SUB-ValorDeMercadoDelInmueble');

    $validacionesh1 = array('ValorUnitarioDeTierraAplicableAlAvaluo' => 'SUB-ValorUnitarioDeTierraAplicableAlAvaluo');    

    $validacionesh11 = array('Calle' => 'nonEmptyString_100', 'Colonia' => 'catColonia', 'Delegacion' => 'catDelegacion', 'CodigoPostal' => 'nonEmptyString_5', 'DescripcionDelPredio' => 'nonEmptyString_250', 'UsoDelSuelo' => 'nonEmptyString_50', 'UsoDelSuelo' => 'nonEmptyString_50', 'CUS' => 'decimalPositivo', 'Superficie' => 'decimalPositivo_222', 'Fzo' => 'decimalPositivo_32', 'Fub' => 'decimalPositivo_32', 'FFr' => 'decimalPositivo_32', 'Ffo' => 'decimalPositivo_32', 'Fsu' => 'decimalPositivo_32', 'Fre' => 'decimalPositivo', 'PrecioSolicitado' => 'decimalPositivo', 'FactorDeNegociacion' => 'decimalPositivo');
    $validacionesh11n5 = array('Telefono' => 'nonEmptyString_20', 'Informante' => 'nonEmptyString_100');
    $validacionesh11n18 = array('Valor' => 'decimalPositivo', 'Descripcion' => 'nonEmptyString_50');

    $validacionesh12 = array('ValorUnitarioDeTierraPromedio' => 'decimalPositivo', 'ValorUnitarioDeTierraHomologado' => 'decimalPositivo', 'ValorUnitarioSinHomologarMinimo' => 'decimalPositivo', 'ValorUnitarioSinHomologarMaximo' => 'decimalPositivo', 'ValorUnitarioHomologadoMinimo' => 'decimalPositivo', 'ValorUnitarioHomologadoMaximo' => 'decimalPositivo');

    $validacionesh13 = array('TipoDeProductoInmobiliarioPropuesto' => 'nonEmptyString', 'NumeroDeUnidadesVendibles' => 'decimalPositivo', 'SuperficieVendiblePorUnidad' => 'decimalPositivo');
    $validacionesh134 = array('Calle' => 'nonEmptyString_50', 'Colonia' => 'catColonia', 'Delegacion' => 'catDelegacion', 'CodigoPostal' => 'nonEmptyString_5', 'DescripcionDelComparable' => 'nonEmptyString_250', 'SuperficieVendiblePorUnidad' => 'decimalPositivo_222', 'PrecioSolicitado' => 'decimalPositivo', 'FactorDeNegociacion' => 'decimalPositivo');
    $validacionesh134n5 = array('Telefono' => 'nonEmptyString_20', 'Informante' => 'nonEmptyString_100');

    $validacionesh135 = array('ValorUnitarioPromedio' => 'decimalPositivo', 'ValorUnitarioHomologado' => 'decimalPositivo', 'ValorUnitarioSinHomologarMinimo' => 'decimalPositivo', 'ValorUnitarioSinHomologarMaximo' => 'decimalPositivo', 'ValorUnitarioHomologadoMinimo' => 'decimalPositivo', 'ValorUnitarioHomologadoMaximo' => 'decimalPositivo', 'ValorUnitarioAplicableAlResidual' => 'decimalPositivo');

    $validacionesh136 = array('TotalDeIngresos' => 'decimalPositivo', 'TotalDeEgresos' => 'decimalPositivo', 'UtilidadPropuesta' => 'nonEmptyString', 'ValorUnitarioDeTierraResidual' => 'decimalPositivo');

    $validacionesh21 = array('Calle' => 'nonEmptyString_50', 'Colonia' => 'catColonia', 'Delegacion' => 'catDelegacion', 'CodigoPostal' => 'nonEmptyString_5', 'DescripcionDelComparable' => 'nonEmptyString_250', 'SuperficieVendiblePorUnidad' => 'decimalPositivo_222', 'PrecioSolicitado' => 'decimalPositivo', 'FactorDeNegociacion' => 'decimalPositivo');

    $validacionesh21n5 = array('Telefono' => 'nonEmptyString_20', 'Informante' => 'nonEmptyString_100');

    $validacionesh21n10 = array('Region' => 'nullableRegionManzanaUp', 'Manzana' => 'nullableRegionManzanaUp', 'Lote' => 'nullableLote', 'Localidad' => 'nullableRegionManzanaUp');

    $validacionesh22 = array('ValorUnitarioPromedio' => 'decimalPositivo', 'ValorUnitarioHomologado' => 'decimalPositivo', 'ValorUnitarioSinHomologarMinimo' => 'decimalPositivo', 'ValorUnitarioSinHomologarMaximo' => 'decimalPositivo', 'ValorUnitarioHomologadoMinimo' => 'decimalPositivo', 'ValorUnitarioHomologadoMaximo' => 'decimalPositivo', 'ValorUnitarioAplicableAlAvaluo' => 'decimalPositivo');

    $validacionesh41 = array('Calle' => 'nonEmptyString_50', 'Colonia' => 'catColonia', 'Delegacion' => 'catDelegacion', 'CodigoPostal' => 'nonEmptyString_5', 'DescripcionDelComparable' => 'nonEmptyString_250', 'SuperficieVendiblePorUnidad' => 'decimalPositivo_222', 'PrecioSolicitado' => 'decimalPositivo', 'FactorDeNegociacion' => 'decimalPositivo');

    $validacionesh41n5 = array('Telefono' => 'nonEmptyString_20', 'Informante' => 'nonEmptyString_100');

    $validacionesh41n10 = array('Region' => 'nullableRegionManzanaUp', 'Manzana' => 'nullableRegionManzanaUp', 'Lote' => 'nullableLote', 'Localidad' => 'nullableRegionManzanaUp');

    $validacionesh42 = array('ValorUnitarioPromedio' => 'decimalPositivo', 'ValorUnitarioHomologado' => 'decimalPositivo', 'ValorUnitarioSinHomologarMinimo' => 'decimalPositivo', 'ValorUnitarioSinHomologarMaximo' => 'decimalPositivo', 'ValorUnitarioHomologadoMinimo' => 'decimalPositivo', 'ValorUnitarioHomologadoMaximo' => 'decimalPositivo', 'ValorUnitarioAplicableAlAvaluo' => 'decimalPositivo');

    $errores = array(); 
    $data = array_map("convierte_a_arreglo",$data);

    foreach($validacionesh as $etiqueta => $validacion){
        if(!isset($data[0][$etiqueta])){
            $errores[] = "Falta ".$etiqueta." en Enfoque de Mercado";
        }else{
            $resValidacion = define_validacion($validacion, $data[0][$etiqueta]);                
            if($resValidacion != 'correcto'){
                $errores[] = "El campo ".$etiqueta." ".$resValidacion;
            }                
        }
    }

    foreach($validacionesh1 as $etiqueta => $validacion){
        if(!isset($data[0]['Terrenos'][$etiqueta])){
            $errores[] = "Falta ".$etiqueta." en Terrenos";
        }else{
            $resValidacion = define_validacion($validacion, $data[0]['Terrenos'][$etiqueta]);                
            if($resValidacion != 'correcto'){
                $errores[] = "El campo ".$etiqueta." ".$resValidacion;
            }                
        }
    }

    //print_r($data); exit();
    if(isset($data[0]['Terrenos']['TerrenosDirectos']['@attributes']) && $data[0]['Terrenos']['TerrenosDirectos']['@attributes']['id'] == 'h.1.1'){
        foreach($validacionesh11 as $etiqueta => $validacion){
            if(!isset($data[0]['Terrenos']['TerrenosDirectos'][$etiqueta])){
                $errores[] = "Falta ".$etiqueta." en en Terrenos (TerrenosDirectos)";
            }else{
                $resValidacion = define_validacion($validacion, $data[0]['Terrenos']['TerrenosDirectos'][$etiqueta]);                
                if($resValidacion != 'correcto'){
                    $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                }                
            }
        }

        if(isset($data[0]['Terrenos']['TerrenosDirectos']['FuenteDeInformacion'])){
            foreach($validacionesh11n5 as $etiqueta => $validacion){
                if(!isset($data[0]['Terrenos']['TerrenosDirectos']['FuenteDeInformacion'][$etiqueta])){
                    $errores[] = "Falta ".$etiqueta." en en Terrenos (FuenteDeInformacion)";
                }else{
                    $resValidacion = define_validacion($validacion, $data[0]['Terrenos']['TerrenosDirectos']['FuenteDeInformacion'][$etiqueta]);                
                    if($resValidacion != 'correcto'){
                        $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                    }                
                }
            }
        }

        if(isset($data[0]['Terrenos']['TerrenosDirectos']['Fot'])){
            foreach($validacionesh11n18 as $etiqueta => $validacion){
                if(!isset($data[0]['Terrenos']['TerrenosDirectos']['Fot'][$etiqueta])){
                    $errores[] = "Falta ".$etiqueta." en en Terrenos (Fot)";
                }else{
                    $resValidacion = define_validacion($validacion, $data[0]['Terrenos']['TerrenosDirectos']['Fot'][$etiqueta]);                
                    if($resValidacion != 'correcto'){
                        $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                    }                
                }
            }
        }
    }

    if(isset($data[0]['Terrenos']['TerrenosDirectos'][0]['@attributes']) && $data[0]['Terrenos']['TerrenosDirectos'][0]['@attributes']['id'] == 'h.1.1'){
        foreach($data[0]['Terrenos']['TerrenosDirectos'] as $llavePrincipal => $elementoPrincipal){            
            //if(is_array($elementoPrincipal) && $elementoPrincipal['id'] != 'e.2.1'){
                    foreach($validacionesh11 as $etiqueta => $validacion){
                        if(!isset($elementoPrincipal[$etiqueta])){
                            $errores[] = "Falta ".$etiqueta." en Terrenos (TerrenosDirectos)";
                        }else{
                            $resValidacion = define_validacion($validacion, $elementoPrincipal[$etiqueta]);                
                            if($resValidacion != 'correcto'){
                                $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                            }                
                        }
                    }
            //}
            
            if(isset($elementoPrincipal['FuenteDeInformacion'])){

                foreach($validacionesh11n5 as $etiqueta => $validacion){
                    if(!isset($elementoPrincipal['FuenteDeInformacion'][$etiqueta])){
                        $errores[] = "Falta ".$etiqueta." en Terrenos (FuenteDeInformacion)";
                    }else{
                        $resValidacion = define_validacion($validacion, $elementoPrincipal['FuenteDeInformacion'][$etiqueta]);                
                        if($resValidacion != 'correcto'){
                            $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                        }                
                    }
                }

            }

            if(isset($elementoPrincipal['Fot'])){

                foreach($validacionesh11n5 as $etiqueta => $validacion){
                    if(!isset($elementoPrincipal['Fot'][$etiqueta])){
                        $errores[] = "Falta ".$etiqueta." en Terrenos (Fot)";
                    }else{
                        $resValidacion = define_validacion($validacion, $elementoPrincipal['Fot'][$etiqueta]);                
                        if($resValidacion != 'correcto'){
                            $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                        }                
                    }
                }

            }
        }
    }

    if(isset($data[0]['Terrenos']['ConclusionesHomologacionTerrenos'])){

        foreach($validacionesh12 as $etiqueta => $validacion){
            if(!isset($data[0]['Terrenos']['ConclusionesHomologacionTerrenos'][$etiqueta])){
                $errores[] = "Falta ".$etiqueta." en en Terrenos (ConclusionesHomologacionTerrenos)";
            }else{
                $resValidacion = define_validacion($validacion, $data[0]['Terrenos']['ConclusionesHomologacionTerrenos'][$etiqueta]);                
                if($resValidacion != 'correcto'){
                    $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                }                
            }
        }

    }else{
        $errores[] = "Falta ConclusionesHomologacionTerrenos en en Terrenos";
    }

    if(isset($data[0]['Terrenos']['TerrenosResidual']['@attributes']) && $data[0]['Terrenos']['TerrenosResidual']['@attributes']['id'] == 'h.1.3'){
        foreach($validacionesh13 as $etiqueta => $validacion){
            if(!isset($data[0]['Terrenos']['TerrenosResidual'][$etiqueta])){
                $errores[] = "Falta ".$etiqueta." en en Terrenos (TerrenosResidual)";
            }else{
                $resValidacion = define_validacion($validacion, $data[0]['Terrenos']['TerrenosResidual'][$etiqueta]);                
                if($resValidacion != 'correcto'){
                    $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                }                
            }
        }

        if(isset($data[0]['Terrenos']['TerrenosResidual']['InvestigacionProductosComparables'])){
            foreach($validacionesh134 as $etiqueta => $validacion){
                if(!isset($data[0]['Terrenos']['TerrenosResidual']['InvestigacionProductosComparables'][$etiqueta])){
                    $errores[] = "Falta ".$etiqueta." en en TerrenosResidual (InvestigacionProductosComparables)";
                }else{
                    $resValidacion = define_validacion($validacion, $data[0]['Terrenos']['TerrenosResidual']['InvestigacionProductosComparables'][$etiqueta]);                
                    if($resValidacion != 'correcto'){
                        $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                    }                
                }
            }
    
            if(isset($data[0]['Terrenos']['TerrenosResidual']['InvestigacionProductosComparables']['FuenteDeInformacion'])){
                foreach($validacionesh134n5 as $etiqueta => $validacion){
                    if(!isset($data[0]['Terrenos']['TerrenosResidual']['InvestigacionProductosComparables']['FuenteDeInformacion'][$etiqueta])){
                        $errores[] = "Falta ".$etiqueta." en en InvestigacionProductosComparables (FuenteDeInformacion)";
                    }else{
                        $resValidacion = define_validacion($validacion, $data[0]['Terrenos']['TerrenosResidual']['InvestigacionProductosComparables']['FuenteDeInformacion'][$etiqueta]);                
                        if($resValidacion != 'correcto'){
                            $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                        }                
                    }
                }
            }
        }

        if(isset($data[0]['Terrenos']['TerrenosResidual']['ConclusionesHomologacionCompResiduales'])){
            foreach($validacionesh135 as $etiqueta => $validacion){
                if(!isset($data[0]['Terrenos']['TerrenosResidual']['ConclusionesHomologacionCompResiduales'][$etiqueta])){
                    $errores[] = "Falta ".$etiqueta." en en TerrenosResidual (ConclusionesHomologacionCompResiduales)";
                }else{
                    $resValidacion = define_validacion($validacion, $data[0]['Terrenos']['TerrenosResidual']['ConclusionesHomologacionCompResiduales'][$etiqueta]);                
                    if($resValidacion != 'correcto'){
                        $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                    }                
                }
            }
        }

        if(isset($data[0]['Terrenos']['TerrenosResidual']['AnalisisResidual'])){
            foreach($validacionesh136 as $etiqueta => $validacion){
                if(!isset($data[0]['Terrenos']['TerrenosResidual']['AnalisisResidual'][$etiqueta])){
                    $errores[] = "Falta ".$etiqueta." en en TerrenosResidual (AnalisisResidual)";
                }else{
                    $resValidacion = define_validacion($validacion, $data[0]['Terrenos']['TerrenosResidual']['AnalisisResidual'][$etiqueta]);                
                    if($resValidacion != 'correcto'){
                        $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                    }                
                }
            }
        }
    }
    
    //print_r($data[0]['ConstruccionesEnVenta']); exit();
    if(isset($data[0]['ConstruccionesEnVenta']['@attributes']) && $data[0]['ConstruccionesEnVenta']['@attributes']['id'] == 'h.2'){
        $numeroInvestigacionProductosComparables = count($data[0]['ConstruccionesEnVenta']['InvestigacionProductosComparables']);
        if($numeroInvestigacionProductosComparables < 4){
            $errores[] = "Existen menos de 4 InvestigacionProductosComparables";
        }else{
            //print_r($data[0]['ConstruccionesEnVenta']['InvestigacionProductosComparables']); exit();
            foreach($data[0]['ConstruccionesEnVenta']['InvestigacionProductosComparables'] as $llavePrincipal => $elementoPrincipal){            
                
                foreach($validacionesh21 as $etiqueta => $validacion){
                    if(!isset($elementoPrincipal[$etiqueta])){
                        $errores[] = "Falta ".$etiqueta." en ConstruccionesEnVenta (InvestigacionProductosComparables)";
                    }else{
                        $resValidacion = define_validacion($validacion, $elementoPrincipal[$etiqueta]);                
                        if($resValidacion != 'correcto'){
                            $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                        }                
                    }
                }
                
                foreach($validacionesh21n5 as $etiqueta => $validacion){
                    if(!isset($elementoPrincipal['FuenteDeInformacion'][$etiqueta])){
                        $errores[] = "Falta ".$etiqueta." en InvestigacionProductosComparables (FuenteDeInformacion)";
                    }else{
                        $resValidacion = define_validacion($validacion, $elementoPrincipal['FuenteDeInformacion'][$etiqueta]);                
                        if($resValidacion != 'correcto'){
                            $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                        }                
                    }
                }

                foreach($validacionesh21n10 as $etiqueta => $validacion){
                    if(!isset($elementoPrincipal['CuentaCatastral'][$etiqueta])){
                        $errores[] = "Falta ".$etiqueta." en InvestigacionProductosComparables (CuentaCatastral)";
                    }else{                                             
                        $resValidacion = define_validacion($validacion, $elementoPrincipal['CuentaCatastral'][$etiqueta]);
                        if($resValidacion != 'correcto'){
                            $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                        }    
                    }
                }                
            }
            //print_r($data[0]['ConstruccionesEnVenta']['ConclusionesHomologacionConstruccionesEnVenta']); exit();
            foreach($validacionesh22 as $etiqueta => $validacion){
                if(!isset($data[0]['ConstruccionesEnVenta']['ConclusionesHomologacionConstruccionesEnVenta'][$etiqueta])){
                    $errores[] = "Falta ".$etiqueta." en ConstruccionesEnVenta (ConclusionesHomologacionConstruccionesEnVenta)";
                }else{                                             
                    $resValidacion = define_validacion($validacion, $data[0]['ConstruccionesEnVenta']['ConclusionesHomologacionConstruccionesEnVenta'][$etiqueta]);
                    if($resValidacion != 'correcto'){
                        $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                    }    
                }
            }

        }
    }

    if(isset($data[0]['ConstruccionesEnRenta']['@attributes']) && $data[0]['ConstruccionesEnRenta']['@attributes']['id'] == 'h.4'){
       
        if(isset($data[0]['ConstruccionesEnRenta']['InvestigacionProductosComparables']['@attributes']) && $data[0]['ConstruccionesEnRenta']['InvestigacionProductosComparables']['@attributes']['id'] == 'h.4.1'){
            foreach($validacionesh41 as $etiqueta => $validacion){
                if(!isset($data[0]['ConstruccionesEnRenta']['InvestigacionProductosComparables'][$etiqueta])){
                    $errores[] = "Falta ".$etiqueta." en en ConstruccionesEnRenta (InvestigacionProductosComparables)";
                }else{
                    $resValidacion = define_validacion($validacion, $data[0]['ConstruccionesEnRenta']['InvestigacionProductosComparables'][$etiqueta]);                
                    if($resValidacion != 'correcto'){
                        $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                    }                
                }
            }

            foreach($validacionesh41n5 as $etiqueta => $validacion){
                if(!isset($data[0]['ConstruccionesEnRenta']['InvestigacionProductosComparables']['FuenteDeInformacion'][$etiqueta])){
                    $errores[] = "Falta ".$etiqueta." en en InvestigacionProductosComparables (FuenteDeInformacion)";
                }else{
                    $resValidacion = define_validacion($validacion, $data[0]['ConstruccionesEnRenta']['InvestigacionProductosComparables']['FuenteDeInformacion'][$etiqueta]);                
                    if($resValidacion != 'correcto'){
                        $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                    }                
                }
            }

            foreach($validacionesh41n10 as $etiqueta => $validacion){
                if(!isset($data[0]['ConstruccionesEnRenta']['InvestigacionProductosComparables']['CuentaCatastral'][$etiqueta])){
                    $errores[] = "Falta ".$etiqueta." en en InvestigacionProductosComparables (CuentaCatastral)";
                }else{
                    $resValidacion = define_validacion($validacion, $data[0]['ConstruccionesEnRenta']['InvestigacionProductosComparables']['CuentaCatastral'][$etiqueta]);                
                    if($resValidacion != 'correcto'){
                        $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                    }                
                }
            }
        }

        if(isset($data[0]['ConstruccionesEnRenta']['InvestigacionProductosComparables'][0]['@attributes']) && $data[0]['ConstruccionesEnRenta']['InvestigacionProductosComparables'][0]['@attributes']['id'] == 'h.4.1'){
            
            foreach($data[0]['ConstruccionesEnRenta']['InvestigacionProductosComparables'] as $llavePrincipal => $elementoPrincipal){
                
                foreach($validacionesh41 as $etiqueta => $validacion){
                    if(!isset($elementoPrincipal[$etiqueta])){
                        $errores[] = "Falta ".$etiqueta." en en ConstruccionesEnRenta (InvestigacionProductosComparables)";
                    }else{
                        $resValidacion = define_validacion($validacion, $elementoPrincipal[$etiqueta]);                
                        if($resValidacion != 'correcto'){
                            $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                        }                
                    }
                }

                foreach($validacionesh41n5 as $etiqueta => $validacion){
                    if(!isset($elementoPrincipal['FuenteDeInformacion'][$etiqueta])){
                        $errores[] = "Falta ".$etiqueta." en en InvestigacionProductosComparables (FuenteDeInformacion)";
                    }else{
                        $resValidacion = define_validacion($validacion, $elementoPrincipal['FuenteDeInformacion'][$etiqueta]);                
                        if($resValidacion != 'correcto'){
                            $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                        }                
                    }
                }
                //echo "ENTRE AQUI "; print_r($elementoPrincipal['CuentaCatastral']); exit();
                if(isset($elementoPrincipal['CuentaCatastral'])){
                    foreach($validacionesh41n10 as $etiqueta => $validacion){
                        //echo $elementoPrincipal['CuentaCatastral'][$etiqueta]; echo "\n";
                        if(!isset($elementoPrincipal['CuentaCatastral'][$etiqueta])){
                            $errores[] = "Falta ".$etiqueta." en en InvestigacionProductosComparables (CuentaCatastral)";
                        }else{
                            $resValidacion = define_validacion($validacion, $elementoPrincipal['CuentaCatastral'][$etiqueta]);                
                            if($resValidacion != 'correcto'){
                                $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                            }                
                        }
                    }
                }                

            }
            
        }

        foreach($validacionesh42 as $etiqueta => $validacion){
            if(!isset($data[0]['ConstruccionesEnRenta']['ConclusionesHomologacionConstruccionesEnVenta'][$etiqueta])){
                $errores[] = "Falta ".$etiqueta." en en ConstruccionesEnRenta (ConclusionesHomologacionConstruccionesEnVenta)";
            }else{
                $resValidacion = define_validacion($validacion, $data[0]['ConstruccionesEnRenta']['ConclusionesHomologacionConstruccionesEnVenta'][$etiqueta]);                
                if($resValidacion != 'correcto'){
                    $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                }                
            }
        }        

    }
    return $errores;
}

    function valida_AvaluoEnfoqueCostosComercial($data, $elementoPrincipal){

        $validacionesi = array('ImporteTotalDelEnfoqueDeCostos' => 'SUB-ImporteTotalDelEnfoqueDeCostos');    
        $errores = array();       
        $data = array_map("convierte_a_arreglo",$data);
        
        foreach($validacionesi as $etiqueta => $validacion){
            
            if(!isset($data[0][$etiqueta])){
                $errores[] = "Falta ".$etiqueta." en en EnfoqueDeCostos";
            }else{
                $resValidacion = define_validacion($validacion, $data[0][$etiqueta]);                                
                if($resValidacion != 'correcto'){
                    $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                }                
            }
        }
        return $errores;
    }

function valida_AvaluoEnfoqueCostosCatastral($data, $elementoPrincipal){

    $validacionesj = array('ImporteInstalacionesEspeciales' => 'SUB-ImporteInstalacionesEspeciales', 'ImporteTotalValorCatastral' => 'SUB-ImporteTotalValorCatastral', 'AvanceDeObra' => 'SUB-AvanceDeObra', 'ImporteTotalValorCatastralObraEnProceso' => 'SUB-ImporteTotalValorCatastralObraEnProceso');        

    $errores = array(); 
    $data = array_map("convierte_a_arreglo",$data);

    foreach($validacionesj as $etiqueta => $validacion){
        if(!isset($data[0]['EnfoqueDeCostos'][$etiqueta])){
            $errores[] = "Falta ".$etiqueta." en en EnfoqueDeCostos";
        }else{
            $resValidacion = define_validacion($validacion, $data[0]['EnfoqueDeCostos'][$etiqueta]);                
            if($resValidacion != 'correcto'){
                $errores[] = "El campo ".$etiqueta." ".$resValidacion;
            }                
        }
    }
    return $errores;
}

function valida_AvaluoEnfoqueIngresos($data, $elementoPrincipal){
    if($elementoPrincipal == '//Comercial'){
        $validacionesk = array('RentaBrutaMensual' => 'nullableDecimalPositivo', 'ProductoLiquidoAnual' => 'nullableDecimalPositivo', 'TasaDeCapitalizacionAplicable' => 'decimalPositivo', 'ImporteEnfoqueDeIngresos' => 'SUB-ImporteEnfoqueDeIngresos');
        $validacionesk2 = array('Vacios' => 'decimalPositivo', 'ImpuestoPredial' => 'decimalPositivo', 'ServicioDeAgua' => 'decimalPositivo', 'ConservacionYMantenimiento' => 'decimalPositivo', 'ServicioEnergiaElectrica' => 'decimalPositivo', 'Administracion' => 'decimalPositivo', 'Seguros' => 'decimalPositivo', 'DepreciacionFiscal' => 'decimalPositivo', 'Otros' => 'decimalPositivo', 'DeduccionesFiscales' => 'decimalPositivo', 'ImpuestoSobreLaRenta' => 'decimalPositivo', 'DeduccionesMensuales' => 'decimalPositivo', 'PorcentajeDeduccionesMensuales' => 'nullableDecimalPositivo_54');
        
    }

    $errores = array(); 
    $data = array_map("convierte_a_arreglo",$data);
    
    foreach($validacionesk as $etiqueta => $validacion){
        //print_r($data[0][$etiqueta]); echo "\n";
        if(!isset($data[0][$etiqueta])){
            $errores[] = "Falta ".$etiqueta." en en EnfoqueDeIngresos";
        }else{
            $resValidacion = define_validacion($validacion, $data[0][$etiqueta]);                
            if($resValidacion != 'correcto'){
                $errores[] = "El campo ".$etiqueta." ".$resValidacion;
            }                
        }
    }

    foreach($validacionesk2 as $etiqueta => $validacion){
        if(!isset($data[0]['Deducciones'][$etiqueta])){
            $errores[] = "Falta ".$etiqueta." en EnfoqueDeIngresos (Deducciones)";
        }else{
            
            $resValidacion = define_validacion($validacion, $data[0]['Deducciones'][$etiqueta]);                
            if($resValidacion != 'correcto'){
                $errores[] = "El campo ".$etiqueta." ".$resValidacion;
            }                
        }
    }
    return $errores;
    
}
    
function valida_AvaluoConsideracionesPreviasALaConclusion($data, $elementoPrincipal){
    $validacionesn = array('ConsideracionesPreviasALaConclusion' => 'string_2000');

    $errores = array(); 
    $data = array_map("convierte_a_arreglo",$data);

    foreach($validacionesn as $etiqueta => $validacion){
        
        if(!isset($data[0][$etiqueta])){
            $errores[] = "Falta ".$etiqueta." en ConsideracionesPreviasALaConclusion";
        }else{
            $resValidacion = define_validacion($validacion, $data[0][$etiqueta]);                
            if($resValidacion != 'correcto'){
                $errores[] = "El campo ".$etiqueta." ".$resValidacion;
            }                
        }
    }
    return $errores;
}

function valida_AvaluoConclusionDelAvaluoComercial($data, $elementoPrincipal){
    $validacioneso = array('ValorComercialDelInmueble' => 'decimalPositivo');
    //print_r($data); exit();
    $errores = array(); 
    $data = array_map("convierte_a_arreglo",$data);
    //print_r($data); exit();
    foreach($validacioneso as $etiqueta => $validacion){
        
        if(!isset($data[0][$etiqueta])){
            $errores[] = "Falta ".$etiqueta." en ConclusionDelAvaluo";
        }else{
            $resValidacion = define_validacion($validacion, $data[0][$etiqueta]);                
            if($resValidacion != 'correcto'){
                $errores[] = "El campo ".$etiqueta." ".$resValidacion;
            }                
        }
    }
    return $errores;
}

function valida_AvaluoConclusionDelAvaluoCatastral($data, $elementoPrincipal){
    $validacioneso = array('ValorComercialDelInmueble' => 'decimalPositivo');

    $errores = array(); 
    $data = array_map("convierte_a_arreglo",$data);

    foreach($validacioneso as $etiqueta => $validacion){
        
        if(!isset($data[0][$etiqueta])){
            $errores[] = "Falta ".$etiqueta." en ConclusionDelAvaluo";
        }else{
            $resValidacion = define_validacion($validacion, $data[0][$etiqueta]);                
            if($resValidacion != 'correcto'){
                $errores[] = "El campo ".$etiqueta." ".$resValidacion;
            }                
        }
    }
    return $errores;
}

function valida_AvaluoValorReferido($data, $elementoPrincipal){
    $validacionesp = array('FechaDeValorReferido' => 'nullableDate', 'IndiceAntiguo' => 'nullableDecimal', 'IndiceActual' => 'nullableDecimalPositivo', 'FactorDeConversion' => 'nullableDecimalPositivo', 'ValorReferido' => 'nullableDecimalPositivo');

    $errores = array(); 
    $data = array_map("convierte_a_arreglo",$data);
    
    unset($data[0]['@attributes']);
    //echo count($data[0]); exit();
    if(count($data[0]) == 0){

    }else{
        foreach($validacionesp as $etiqueta => $validacion){
        
            if(!isset($data[0][$etiqueta])){
                $errores[] = "Falta ".$etiqueta." en ValorReferido";
            }else{
                $resValidacion = define_validacion($validacion, $data[0][$etiqueta]);                
                if($resValidacion != 'correcto'){
                    $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                }                
            }
        }
    }    
    
    return $errores;
}

function valida_AvaluoAnexoFotografico($data, $elementoPrincipal){
    if($elementoPrincipal == '//Comercial'){
        $validacionesq11 = array('Region' => 'regionManzanaUp', 'Manzana' => 'regionManzanaUp', 'Lote' => 'lote', 'Localidad' => 'regionManzanaUp');
        $validacionesq12 = array('Foto' => 'base64Binary', 'InteriorOExterior' => 'catTipoFotoInmueble');
        $validacionesq2n1 = array('Region' => 'nullableRegionManzanaUp', 'Manzana' => 'nullableRegionManzanaUp', 'Lote' => 'nullableLote', 'Localidad' => 'nullableRegionManzanaUp');
        $validacionesq2n2 = array('Foto' => 'base64Binary', 'InteriorOExterior' => 'catTipoFotoInmueble');
        $validacionesq3n1 = array('Region' => 'nullableRegionManzanaUp', 'Manzana' => 'nullableRegionManzanaUp', 'Lote' => 'nullableLote', 'Localidad' => 'nullableRegionManzanaUp');
        $validacionesq3n2 = array('Foto' => 'base64Binary', 'InteriorOExterior' => 'catTipoFotoInmueble');
    }else{
        $validacionesq11 = array('Region' => 'regionManzanaUp', 'Manzana' => 'regionManzanaUp', 'Lote' => 'lote', 'Localidad' => 'regionManzanaUp');
        $validacionesq12 = array('Foto' => 'base64Binary', 'InteriorOExterior' => 'catTipoFotoInmueble');        
    }

    $errores = array(); 
    $data = array_map("convierte_a_arreglo",$data);
    //print_r($data); exit();
    foreach($validacionesq11 as $etiquetaCatastral => $validacionCatastral){
        if(!isset($data[0]['Sujeto']['CuentaCatastral'][$etiquetaCatastral])){
            $errores[] = "Falta ".$etiquetaCatastral." en Sujeto (CuentaCatastral)";
        }else{
            
            $resValidacionCuentaCatastral = define_validacion($validacionCatastral, $data[0]['Sujeto']['CuentaCatastral'][$etiquetaCatastral]);                
            if($resValidacionCuentaCatastral != 'correcto'){
                $errores[] = "El campo ".$etiquetaCatastral." ".$resValidacionCuentaCatastral;
            }
        }
    }

    if(count($data[0]['Sujeto']['FotosInmuebleAvaluo']) < 8){
        $errores[] = "Existen menos de 8 FotosInmuebleAvaluo";
    }else{
        foreach($data[0]['Sujeto']['FotosInmuebleAvaluo'] as $llavePrincipal => $elementoPrincipal){

            foreach($validacionesq12 as $etiqueta => $validacion){
                if(!isset($elementoPrincipal[$etiqueta])){
                    $errores[] = "Falta ".$etiqueta." en Sujeto (FotosInmuebleAvaluo)";
                }else{
                    
                    $resValidacion = define_validacion($validacion, $elementoPrincipal[$etiqueta]);                
                    if($resValidacion != 'correcto'){
                        $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                    }
                }
            }
        }
        
    }
    
    if(isset($data[0]['ComparableRentas'])){

        if(isset($data[0]['ComparableRentas']['@attributes']) && $data[0]['ComparableRentas']['@attributes']['id'] == 'q.2'){

            foreach($validacionesq2n1 as $etiqueta => $validacion){
                if(!isset($data[0]['ComparableRentas']['CuentaCatastral'][$etiqueta])){
                    $errores[] = "Falta ".$etiqueta." en en ComparableRentas (CuentaCatastral)";
                }else{
                    $resValidacion = define_validacion($validacion, $data[0]['ComparableRentas']['CuentaCatastral'][$etiqueta]);                
                    if($resValidacion != 'correcto'){
                        $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                    }                
                }
            }

            foreach($validacionesq2n2 as $etiqueta => $validacion){
                if(!isset($data[0]['ComparableRentas']['FotosInmuebleAvaluo'][$etiqueta])){
                    $errores[] = "Falta ".$etiqueta." en ComparableRentas (FotosInmuebleAvaluo)";
                }else{
                    
                    $resValidacion = define_validacion($validacion, $data[0]['ComparableRentas']['FotosInmuebleAvaluo'][$etiqueta]);                
                    if($resValidacion != 'correcto'){
                        $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                    }
                }
            }

        }
    
        if(isset($data[0]['ComparableRentas'][0]['@attributes']) && $data[0]['ComparableRentas'][0]['@attributes']['id'] == 'q.2'){
            foreach($data[0]['ComparableRentas'] as $llavePrincipal => $elementoPrincipal){            
                
                foreach($validacionesq2n1 as $etiqueta => $validacion){
                    if(!isset($elementoPrincipal['CuentaCatastral'][$etiqueta])){
                        $errores[] = "Falta ".$etiqueta." en en ComparableRentas (CuentaCatastral)";
                    }else{
                        $resValidacion = define_validacion($validacion, $elementoPrincipal['CuentaCatastral'][$etiqueta]);                
                        if($resValidacion != 'correcto'){
                            $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                        }                
                    }
                }
    
                foreach($validacionesq2n2 as $etiqueta => $validacion){
                    if(!isset($elementoPrincipal['FotosInmuebleAvaluo'][$etiqueta])){
                        $errores[] = "Falta ".$etiqueta." en ComparableRentas (FotosInmuebleAvaluo)";
                    }else{
                        
                        $resValidacion = define_validacion($validacion, $elementoPrincipal['FotosInmuebleAvaluo'][$etiqueta]);                
                        if($resValidacion != 'correcto'){
                            $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                        }
                    }
                }            
            }
        }

    }


    if(isset($data[0]['ComparableVentas'])){

        if(isset($data[0]['ComparableVentas']['@attributes']) && $data[0]['ComparableVentas']['@attributes']['id'] == 'q.2'){

            foreach($validacionesq3n1 as $etiqueta => $validacion){
                if(!isset($data[0]['ComparableVentas']['CuentaCatastral'][$etiqueta])){
                    $errores[] = "Falta ".$etiqueta." en en ComparableVentas (CuentaCatastral)";
                }else{
                    $resValidacion = define_validacion($validacion, $data[0]['ComparableVentas']['CuentaCatastral'][$etiqueta]);                
                    if($resValidacion != 'correcto'){
                        $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                    }                
                }
            }

            foreach($validacionesq3n2 as $etiqueta => $validacion){
                if(!isset($data[0]['ComparableVentas']['FotosInmuebleAvaluo'][$etiqueta])){
                    $errores[] = "Falta ".$etiqueta." en ComparableVentas (FotosInmuebleAvaluo)";
                }else{
                    
                    $resValidacion = define_validacion($validacion, $data[0]['ComparableVentas']['FotosInmuebleAvaluo'][$etiqueta]);                
                    if($resValidacion != 'correcto'){
                        $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                    }
                }
            }

        }
    
        if(isset($data[0]['ComparableVentas'][0]['@attributes']) && $data[0]['ComparableVentas'][0]['@attributes']['id'] == 'q.2'){
            foreach($data[0]['ComparableVentas'] as $llavePrincipal => $elementoPrincipal){            
                
                foreach($validacionesq3n1 as $etiqueta => $validacion){
                    if(!isset($elementoPrincipal['CuentaCatastral'][$etiqueta])){
                        $errores[] = "Falta ".$etiqueta." en en ComparableVentas (CuentaCatastral)";
                    }else{
                        $resValidacion = define_validacion($validacion, $elementoPrincipal['CuentaCatastral'][$etiqueta]);                
                        if($resValidacion != 'correcto'){
                            $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                        }                
                    }
                }
    
                foreach($validacionesq3n2 as $etiqueta => $validacion){
                    if(!isset($elementoPrincipal['FotosInmuebleAvaluo'][$etiqueta])){
                        $errores[] = "Falta ".$etiqueta." en ComparableVentas (FotosInmuebleAvaluo)";
                    }else{
                        
                        $resValidacion = define_validacion($validacion, $elementoPrincipal['FotosInmuebleAvaluo'][$etiqueta]);                
                        if($resValidacion != 'correcto'){
                            $errores[] = "El campo ".$etiqueta." ".$resValidacion;
                        }
                    }
                }            
            }
        }

    }

    return $errores;

}

?>