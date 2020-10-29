<?php
use Illuminate\Support\Facades\DB;

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
    if($elementoPrincipal == 'Comercial'){
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
    $validacionesc = array('ContaminacionAmbientalEnLaZona' => 'string_250','ClasificacionDeLaZona' => 'catClasificacionZona','IndiceDeSaturacionDeLaZona' => 'DecimalPositivo','IndiceDeSaturacionDeLaZona' => 'DecimalPositivo','ClaseGeneralDeInmueblesDeLaZona' => 'catClasesConstruccion', 'DensidadDePoblacion' => 'catDensidadPoblacion', 'NivelSocioeconomicoDeLaZona' => 'catNivelSocioeconomico');
    $errores = array();
    $data = array_map("convierte_a_arreglo",$data);
    print_r($data); exit();
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
    }
}

?>