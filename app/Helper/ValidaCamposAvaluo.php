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
        $validacionese = array('UsoActual' => 'nonEmptyString_2000', 'VidaUtilTotalPonderadaDelInmueble' => 'nullableDecimalPositivo', 'EdadPonderadaDelInmueble' => 'nullableDecimalPositivo', 'VidaUtilRemanentePonderadaDelInmueble' => 'nullableDecimalPositivo', 'PorcentSuperfUltimNivelRespectoAnterior' => 'decimalPositivo_54');
        $validacionese2 = array('SuperficieTotalDeConstruccionesPrivativas' => 'SUB-SuperficieTotalDeConstruccionesPrivativas', 'ValorTotalDeConstruccionesPrivativas' => 'SUB-ValorTotalDeConstruccionesPrivativas', 'ValorTotalDeLasConstruccionesProIndiviso' => 'SUB-ValorTotalDeLasConstruccionesProIndiviso', 'SuperficieTotalDeConstruccionesComunes' => 'SUB-SuperficieTotalDeConstruccionesComunes', 'ValorTotalDeConstruccionesComunes' => 'SUB-ValorTotalDeConstruccionesComunes', 'ValorTotalDeLasConstruccionesComunesProIndiviso' => 'SUB-ValorTotalDeLasConstruccionesProIndivisoComunes');
        $validacionese21 = array('Descripcion' => 'SUB-Descripcion', 'ClaveUso' => 'SUB-ClaveUso', 'NumeroDeNivelesDelTipo' => 'SUB-NumeroDeNivelesDelTipo', 'ClaveRangoDeNiveles' => 'SUB-ClaveRangoDeNiveles', 'PuntajeDeClasificacion' => 'SUB-PuntajeDeClasificacion', 'ClaveClase' => 'SUB-ClaveClase', 'Edad' => 'SUB-Edad', 'VidaUtilTotalDelTipo' => 'SUB-VidaUtilTipo', 'VidaUtilRemanente' => 'SUB-VidaUtilRemanente', 'ClaveConservacion' => 'SUB-ClaveConservacion', 'Superficie' => 'SUB-Superficie', 'ValorunitariodereposicionNuevo' => 'SUB-ValorunitariodereposicionNuevo', 'FactorDeEdad' => 'SUB-FactorDeEdad', 'FactorResultante' => 'SUB-FactorResultante', 'ValorDeLaFraccionN' => 'SUB-ValorDeLaFraccionNDescInmueble');

        $validacionese25 = array('Descripcion' => 'SUB-DescripcionComunes', 'ClaveUso' => 'SUB-ClaveUsoComunes', 'NumeroDeNivelesDelTipo' => 'SUB-NumeroDeNivelesDelTipoComunes', 'ClaveRangoDeNiveles' => 'SUB-ClaveRangoDeNivelesComunes', 'PuntajeDeClasificacion' => 'SUB-PuntajeDeClasificacionComunes', 'ClaveClase' => 'SUB-ClaveClaseComunes', 'Edad' => 'SUB-EdadComunes', 'VidaUtilTotalDelTipo' => 'SUB-VidaUtilTipoComunes', 'VidaUtilRemanente' => 'SUB-VidaUtilRemanenteComunes', 'ClaveConservacion' => 'SUB-ClaveConservacionComunes', 'Superficie' => 'SUB-SuperficieComunes', 'ValorunitariodereposicionNuevo' => 'SUB-ValorunitariodereposicionNuevoComunes', 'FactorDeEdad' => 'SUB-FactorDeEdadComunes', 'FactorResultante' => 'SUB-FactorResultanteComunes', 'ValorDeLaFraccionN' => 'SUB-ValorDeLaFraccionNDescInmuebleComunes','PorcentajeIndivisoComunes' => 'SUB-PorcentajeIndivisoComunes');
    }else{

    }

    $errores = array();
    $data = array_map("convierte_a_arreglo",$data);
    //print_r($data[0]['TiposDeConstruccion']['SuperficieTotalDeConstruccionesPrivativas']); exit();
    foreach($validacionese as $etiqueta => $validacion){
        if(!isset($data[0][$etiqueta])){
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
    $errores = array();

    return $errores;
}

?>