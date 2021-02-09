<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            @page { margin: 120px 50px 80px 50px; font-family: Arial, Helvetica, sans-serif!important; font-size: 9px;} 
            #header { position: fixed; left: 0px; top: -75px; right: 0px; height: 70px; text-align: center;} 
            #footer { position: fixed; left: 0px; bottom: -25px; right: 0px; height: 40px; text-align: center; } 
            #footer .page:after { content: counter(page, decimal); } 
            .grises{color: #8D8D8D;}
            .negritas{font-weight: bolder;}
            
            .tabla_cabeza_gris{width: 100%; border-collapse: collapse!important; margin-top: 2%;}
                .tabla_cabeza_gris>thead>tr>th, .tabla_cabeza_gris>tbody>tr>td {border: 1px solid #000; padding: 2px;}
                .tabla_cabeza_gris>thead{background-color: #D3D3D3; font-size: 10px!important;}

            .tabla_gris_valor{width: 100%; margin-top: 2%; margin-bottom: 2%; border-collapse: separate; border-spacing: 10px 5px;}
                .tabla_gris_valor>thead>tr>th{background-color: #D3D3D3; font-size: 10px!important; text-align: right; padding: 4px; font-size: 12px;}

            .tabla_gris_valor_no_bold{width: 100%; margin-top: 2%; margin-bottom: 2%; border-collapse: separate; border-spacing: 10px 5px;}
                .tabla_gris_valor_no_bold>thead>tr>th{background-color: #D3D3D3; font-size: 10px!important; text-align: left; padding: 4px; font-size: 12px; font-weight: lighter;}

            .tabla_doble{width: 80%; border-collapse: collapse!important;}
                 .tabla_doble>thead>tr>th{border-bottom: 2px solid #000;}
                 .tabla_doble>tfoot>tr>td{border-top: 2px solid #000;}
            
            .centrado{text-align: center;}
            .pleca_verde{background-color: #00A346; color: #fff; border: 0px; text-align: right; margin: 2% 0 2% 0; padding: 5px; font-size: 15px;}
            .letras_pequenas{font-weight: lighter; font-size: 10px;}
        </style>
    </head>


    <body>

        <!-- HEADER -->
        <div id="header">
                <table style="width: 100%;">
                        <tr style="width: 100%;">
                            <td style="width: 50%;" rowspan="4"><img style="width: 320px;" src="data:image/png;base64,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"></td>
                            <td><b>Fecha:</b></td>
                            <td class="grises">
                                @isset($infoAvaluo['Encabezado']['Fecha'])
                                    {{$infoAvaluo['Encabezado']['Fecha']}}
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <!-- <td></td> -->
                            <td><b>Avaluo:</b></td>
                            <td class="grises">
                                @isset($infoAvaluo['Encabezado']['Avaluo_No'])
                                    {{$infoAvaluo['Encabezado']['Avaluo_No']}}
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <!-- <td></td> -->
                            <td><b>No. Único:</b></td>
                            <td class="grises">
                                @isset($infoAvaluo['Encabezado']['No_Unico'])
                                    {{$infoAvaluo['Encabezado']['No_Unico']}}
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <!-- <td></td> -->
                            <td><b>Registro T.D.F</b></td>
                            <td class="grises">
                                @isset($infoAvaluo['Encabezado']['Registro_TDF'])
                                    {{$infoAvaluo['Encabezado']['Registro_TDF']}}
                                @endisset
                            </td>
                        </tr>
                </table>
                <hr style="background-color: #00A346; height: 5px; border: 0px;">
        </div>
        <!-- Fin de HEADER -->


        <!-- FOOTER -->
        <div id="footer">  
            <p class="page"><?php $PAGE_NUM ?></p> 
        </div>
        <!-- Fin de FOOTER -->


        <!-- CONTENIDO -->
        <div id="content">
            <div class="page_break" style="font-family: Montserrat; margin-top: 0px; margin-bottom: 0px;">

                <div style="text-align: right; padding-top: 10px;">AVALÚO</div>

                <!-- 1.- ANTECEDENTES -->
                <div class="pleca_verde"><b>I. ANTECEDENTES</b></div>

                    <table style="border-collapse: collapse; width: 100%;">
                        <tr>
                            <td colspan="2">SOCIEDAD QUE PRACTICA EL AVALUO</td>
                        </tr>
                        <tr>
                            <td><b>VALUADOR:</b></td>
                            <td>
                            @isset($infoAvaluo['Sociedad_Participa']['Valuador'])
                                <span class="grises">{{$infoAvaluo['Sociedad_Participa']['Valuador']}}</span>
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>FECHA DEL AVALÚO:</b></td>
                            <td>
                            @isset($infoAvaluo['Sociedad_Participa']['Fecha_del_Avaluo'])
                                <span class="grises">{{$infoAvaluo['Sociedad_Participa']['Fecha_del_Avaluo']}}</span>
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td valign="top"><b>SOLICITANTE:</b></td>
                            <td>
                                Tipo persona: 
                                @isset($infoAvaluo['Sociedad_Participa']['Solicitante']['Tipo_persona'])
                                    <span class="grises">{{$infoAvaluo['Sociedad_Participa']['Solicitante']['Tipo_persona']}}</span>
                                @endisset
                                <br>
                                @isset($infoAvaluo['Sociedad_Participa']['Solicitante']['Nombre'])
                                    <span class="grises">{{$infoAvaluo['Sociedad_Participa']['Solicitante']['Nombre']}}</span> 
                                @endisset
                                <br>
                                UBICACIÓN DEL INMUEBLE: Calle : 
                                @isset($infoAvaluo['Sociedad_Participa']['Solicitante']['Calle'])
                                    <span class="grises">{{$infoAvaluo['Sociedad_Participa']['Solicitante']['Calle']}}</span> 
                                @endisset
                                <br>
                                Nº Exterior: 
                                @isset($infoAvaluo['Sociedad_Participa']['Solicitante']['No_Exterior'])
                                    <span class="grises">{{$infoAvaluo['Sociedad_Participa']['Solicitante']['No_Exterior']}}</span> 
                                @endisset
                                <br>
                                Nº Interior: 
                                @isset($infoAvaluo['Sociedad_Participa']['Solicitante']['No_Interior'])
                                    <span class="grises">{{$infoAvaluo['Sociedad_Participa']['Solicitante']['No_Interior']}}</span> 
                                @endisset
                                <br>
                                Colonia: 
                                @isset($infoAvaluo['Sociedad_Participa']['Solicitante']['Colonia'])
                                    <span class="grises">{{$infoAvaluo['Sociedad_Participa']['Solicitante']['Colonia']}}</span>
                                @endisset
                                CP : 
                                @isset($infoAvaluo['Sociedad_Participa']['Solicitante']['CP'])
                                    <span class="grises">{{$infoAvaluo['Sociedad_Participa']['Solicitante']['CP']}}</span> 
                                @endisset
                                <br>
                                Alcaldía: 
                                @isset($infoAvaluo['Sociedad_Participa']['Solicitante']['Delegacion'])
                                    <span class="grises">{{$infoAvaluo['Sociedad_Participa']['Solicitante']['Delegacion']}}</span>
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>INMUEBLE QUE SE EVALÚA:</b></td>
                            <td>
                            @isset($infoAvaluo['Sociedad_Participa']['inmuebleQueSeValua'])
                                <span class="grises">{{$infoAvaluo['Sociedad_Participa']['inmuebleQueSeValua']}}</span>
                            @endisset                            
                            </td>
                        </tr>
                        <tr>
                            <td><b>RÉGIMEN DE PROPIEDAD:</b></td>
                            <td>
                            @isset($infoAvaluo['Sociedad_Participa']['regimenDePropiedad'])
                                <span class="grises">{{$infoAvaluo['Sociedad_Participa']['regimenDePropiedad']}}</span>
                            @endisset                            
                            </td>
                        </tr>
                        <tr>
                            <td valign="top"><b>PROPIETARIO DEL INMUEBLE:</b></td>
                            <td>
                                Tipo persona: 
                                @isset($infoAvaluo['Sociedad_Participa']['Propietario']['Tipo_persona'])
                                    <span class="grises">{{$infoAvaluo['Sociedad_Participa']['Propietario']['Tipo_persona']}}</span>
                                @endisset
                                <br>
                                
                                @isset($infoAvaluo['Sociedad_Participa']['Propietario']['Nombre'])
                                    <span class="grises">{{$infoAvaluo['Sociedad_Participa']['Propietario']['Nombre']}}</span>
                                @endisset
                                <br>
                                UBICACIÓN DEL INMUEBLE: Calle : 
                                @isset($infoAvaluo['Sociedad_Participa']['Propietario']['Calle'])
                                    <span class="grises">{{$infoAvaluo['Sociedad_Participa']['Propietario']['Calle']}}</span>
                                @endisset
                                <br>
                                Nº Exterior: 
                                @isset($infoAvaluo['Sociedad_Participa']['Propietario']['No_Exterior'])
                                    <span class="grises">{{$infoAvaluo['Sociedad_Participa']['Propietario']['No_Exterior']}}</span>
                                @endisset
                                <br>
                                Nº Interior: 
                                @isset($infoAvaluo['Sociedad_Participa']['Propietario']['No_Interior'])
                                    <span class="grises">{{$infoAvaluo['Sociedad_Participa']['Propietario']['No_Interior']}}</span>
                                @endisset
                                <br>
                                Colonia: 
                                @isset($infoAvaluo['Sociedad_Participa']['Propietario']['Colonia'])
                                    <span class="grises">{{$infoAvaluo['Sociedad_Participa']['Propietario']['Colonia']}}</span>
                                @endisset
                                CP : 
                                @isset($infoAvaluo['Sociedad_Participa']['Propietario']['CP'])
                                    <span class="grises">{{$infoAvaluo['Sociedad_Participa']['Propietario']['CP']}}</span>
                                @endisset
                                <br>
                                Alcaldía: 
                                @isset($infoAvaluo['Sociedad_Participa']['Propietario']['Delegacion'])
                                    <span class="grises">{{$infoAvaluo['Sociedad_Participa']['Propietario']['Delegacion']}}</span>
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>OBJETO DEL AVALÚO:</b></td>
                            <td>
                            @isset($infoAvaluo['Sociedad_Participa']['Objeto_Avaluo'])
                                <span class="grises">{{$infoAvaluo['Sociedad_Participa']['Objeto_Avaluo']}}</span>
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>PROPÓSITO DEL AVALÚO:</b></td>
                            <td>
                            @isset($infoAvaluo['Sociedad_Participa']['Proposito_Avaluo'])
                                <span class="grises">{{$infoAvaluo['Sociedad_Participa']['Proposito_Avaluo']}}</span>
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border: 1px solid #B5B5B5; padding: 8px;">
                                <table style="width: 100%;">
                                    <tr>
                                        <td valign="top" style="width: 35%;"><b>UBICACIÓN DEL INMUEBLE:</b></td>
                                        <td style="width: 15%;" class="negritas">
                                            Calle:<br>
                                            <b>Nº Exterior:</b><br>
                                            <b>Nº Interior:</b><br>
                                            <b>Colonia:</b><br>
                                            <b>CP:</b><br>
                                            <b>Alcaldía:</b><br>
                                            <b>Edificio:</b><br>
                                            <b>Lote:</b><br>
                                            <b>Cuenta agua:</b>
                                        </td>
                                        <td style="width: 50%;">
                                            @isset($infoAvaluo['Ubicacion_Inmueble']['Calle'])
                                                <span class="grises">{{$infoAvaluo['Ubicacion_Inmueble']['Calle']}}</span>
                                            @endisset
                                            <br>
                                            @isset($infoAvaluo['Ubicacion_Inmueble']['No_Exterior'])
                                                <span class="grises">{{$infoAvaluo['Ubicacion_Inmueble']['No_Exterior']}}</span>
                                            @endisset
                                            <br>
                                            @isset($infoAvaluo['Ubicacion_Inmueble']['No_Interior'])
                                                <span class="grises">{{$infoAvaluo['Ubicacion_Inmueble']['No_Interior']}}</span>
                                            @endisset
                                            <br>
                                            @isset($infoAvaluo['Ubicacion_Inmueble']['Colonia'])
                                                <span class="grises">{{$infoAvaluo['Ubicacion_Inmueble']['Colonia']}}</span>
                                            @endisset
                                            <br>
                                            @isset($infoAvaluo['Ubicacion_Inmueble']['CP'])
                                                <span class="grises">{{$infoAvaluo['Ubicacion_Inmueble']['CP']}}</span>
                                            @endisset
                                            <br>
                                            @isset($infoAvaluo['Ubicacion_Inmueble']['Delegacion'])
                                                <span class="grises">{{$infoAvaluo['Ubicacion_Inmueble']['Delegacion']}}</span>
                                            @endisset
                                            <br>
                                            @isset($infoAvaluo['Ubicacion_Inmueble']['Edificio'])
                                                <span class="grises">{{$infoAvaluo['Ubicacion_Inmueble']['Edificio']}}</span>
                                            @endisset
                                            <br>
                                            @isset($infoAvaluo['Ubicacion_Inmueble']['Lote'])
                                                <span class="grises">{{$infoAvaluo['Ubicacion_Inmueble']['Lote']}}</span>
                                            @endisset
                                            <br>
                                            @isset($infoAvaluo['Ubicacion_Inmueble']['Cuenta_agua'])
                                                <span class="grises">{{$infoAvaluo['Ubicacion_Inmueble']['Cuenta_agua']}}</span>
                                            @endisset
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>


                <!-- 2.- Características Urbanas -->
                <div class="pleca_verde"><b>II. CARACTERÍSTICAS URBANAS</b></div>

                    <table style="width: 100%">
                        <tr>
                            <td style="width: 35%;"><b>CLASIFICACIÓN DE LA ZONA:</b></td>
                            <td style="width: 65%;">
                            @isset($infoAvaluo['Clasificacion_de_la_zona'])
                                <span class="grises">{{$infoAvaluo['Clasificacion_de_la_zona']}}</span>
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>ÍNDICE DE SATURACIÓN DE LA ZONA:</b></td>
                            <td>
                            @isset($infoAvaluo['Indice_Saturacion_Zona'])
                                <span class="grises">{{$infoAvaluo['Indice_Saturacion_Zona']}}</span>
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>TIPO DE CONSTRUCCIÓN DOMINANTE:</b></td>
                            <td>
                            @isset($infoAvaluo['Tipo_Construccion_Dominante'])
                                <span class="grises">{{$infoAvaluo['Tipo_Construccion_Dominante']}}</span>
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>DENSISAD DE LA POBLACIÓN:</b></td>
                            <td>
                            @isset($infoAvaluo['Densidad_Poblacion'])
                                <span class="grises">{{$infoAvaluo['Densidad_Poblacion']}}</span>
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>NIVEL SOCIOECONÓMICO DE LA ZONA:</b></td>
                            <td>
                            @isset($infoAvaluo['Nivel_Socioeconomico_Zona'])
                                <span class="grises">{{$infoAvaluo['Nivel_Socioeconomico_Zona']}}</span>
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>CONTAMINACIÓN DEL MEDIO AMBIENTE:</b></td>
                            <td>
                            @isset($infoAvaluo['Contaminacion_Medio_Ambiente'])
                                <span class="grises">{{$infoAvaluo['Contaminacion_Medio_Ambiente']}}</span>
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>CLASE GENERAL DE INMUEBLES DE LA ZONA:</b></td>
                            <td>
                            @isset($infoAvaluo['Clase_General_De_Inmuebles_Zona'])
                                <span class="grises">{{$infoAvaluo['Clase_General_De_Inmuebles_Zona']}}</span>
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>USO DEL SUELO:</b></td>
                            <td>
                            @isset($infoAvaluo['Uso_Suelo'])
                                <span class="grises">{{$infoAvaluo['Uso_Suelo']}}</span>
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>ÁREA LIBRE OBLIGATORIA:</b></td>
                            <td>
                            @isset($infoAvaluo['Area_Libre_Obligatoria'])
                                <span class="grises">{{$infoAvaluo['Area_Libre_Obligatoria']}}</span>
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td valign="top"><b>VÍAS DE ACCESO E IMPORTANCIA DE LAS MISMAS:</b></td>
                            <td>
                            @isset($infoAvaluo['Vias_Acceso_E_Importancia'])
                                <span class="grises">{{$infoAvaluo['Vias_Acceso_E_Importancia']}}</span>
                            @endisset
                            </td>
                        </tr>
                    </table>


                    <h4 style="margin-top: 4%;">SERVICIOS PÚBLICOS Y EQUIPAMIENTO URBANO:</h4>

                        <table>
                            <tr>
                                <td><b>Red de distribución agua potable:</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Red_Agua_Potable'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Red_Agua_Potable']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Red de recolección de aguas residuales:</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Red_Aguas_Residuales'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Red_Aguas_Residuales']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Red de drenaje de aguas pluviales en la calle:</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Red_Drenaje_Aguas_Pluviales_Calle'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Red_Drenaje_Aguas_Pluviales_Calle']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Red de drenaje de aguas pluviales en la zona:</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Red_Drenaje_Aguas_Pluviales_Zona'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Red_Drenaje_Aguas_Pluviales_Zona']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Sistema mixto (aguas pluviales y residuales):</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Sistema_Mixto'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Sistema_Mixto']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Suministro eléctrico:</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Suministro_Electrico'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Suministro_Electrico']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Acometida al inmueble:</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Acometida_Inmueble'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Acometida_Inmueble']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Alumbrado público:</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Alumbrado_Publico'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Alumbrado_Publico']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Vialidades:</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Vialidades'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Vialidades']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Banquetas:</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Banquetas'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Banquetas']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Guarniciones:</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Guarniciones'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Guarniciones']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Nivel de infraestructura en la zona (%):</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Nivel_Infraestructura_Zona'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Nivel_Infraestructura_Zona']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Gas natural:</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Gas_Natutral'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Gas_Natutral']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Teléfonos suministro:</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Telefonos_Suministro'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Telefonos_Suministro']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Señalización de vías:</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Senalizacion_Vias'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Senalizacion_Vias']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Acometida al inmueble tel.:</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Acometida_Inmueble_Tel'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Acometida_Inmueble_Tel']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Distancia transporte urbano:</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Distancia_Transporte_Urbano'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Distancia_Transporte_Urbano']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Frecuencia transporte urbano:</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Frecuencia_Transporte_Urbano'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Frecuencia_Transporte_Urbano']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Distancia transporte suburbano:</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Distancia_Transporte_Suburbano'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Distancia_Transporte_Suburbano']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Frecuencia transporte suburbano:</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Frecuencia_Transporte_Suburbano'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Frecuencia_Transporte_Suburbano']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Vigilancia:</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Vigilancia'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Vigilancia']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Recolección de basura:</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Recoleccion_Basura'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Recoleccion_Basura']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Templo:</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Templo'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Templo']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Mercados:</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Mercados'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Mercados']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Plazas públicas:</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Plazas_Publicas'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Plazas_Publicas']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Parques y jardines:</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Parques_Jardines'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Parques_Jardines']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Escuelas:</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Escuelas'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Escuelas']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Hospitales:</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Hospitales'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Hospitales']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Bancos:</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Bancos'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Bancos']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Estación de transporte:</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Estacion_Transporte'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Estacion_Transporte']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Nivel de equipamiento urbano:</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Nivel_Equipamiento_Urbano'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Nivel_Equipamiento_Urbano']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Nomenclatura de calles</b></td>
                                <td>
                                @isset($infoAvaluo['Servicios_Publicos_Equipamiento']['Nomenclatura_Calles'])
                                    <span class="grises">{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Nomenclatura_Calles']}}</span>
                                @endisset
                                </td>
                            </tr>
                        </table>


                <!-- 3.- Terreno -->
                <div class="pleca_verde"><b>III. TERRENO</b></div>

                    <div><b>CALLES TRANSVERSALES, LIMÍTROFES Y ORIENTACIÓN:</b></div>
                    <div>
                    @isset($infoAvaluo['Calles_Transversales_Limitrofes'])
                    <span class="grises">{{$infoAvaluo['Calles_Transversales_Limitrofes']}}</span>
                    @endisset
                    </div> 

                    <h4 style="margin-top: 4%;">CROQUIS DE LOCALIZACIÓN:</h4>
                        
                        <table style="width: 100%;">
                            <tr>
                                <td style="width: 50%; padding: 10px;" class="centrado"><img style="max-width: 320px;" src="data:image/png;base64,{{$infoAvaluo['Croquis_Localizacion']['Microlocalizacion']}}"></td>
                                <td style="width: 50%; padding: 10px;" class="centrado"><img style="max-width: 320px;" src="data:image/png;base64,{{$infoAvaluo['Croquis_Localizacion']['Macrolocalizacion']}}"></td>
                            </tr>
                        </table>


                    <h4 style="margin-top: 4%;">MEDIDAS Y COLINDANCIAS:</h4>
                   
                        <table>
                            <tr>
                                <td><b>Fuente:</b></td>
                                <td>
                                @isset($infoAvaluo['Medidas_Colindancias']['Fuente'])
                                    <span class="grises">{{$infoAvaluo['Medidas_Colindancias']['Fuente']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Número escritura:</b></td>
                                <td>
                                @isset($infoAvaluo['Medidas_Colindancias']['Numero_Escritura'])
                                    <span class="grises">{{$infoAvaluo['Medidas_Colindancias']['Numero_Escritura']}}</span>
                                @endisset
                                </td>
                                <td><b>Número volumen:</b></td>
                                <td>
                                @isset($infoAvaluo['Medidas_Colindancias']['Numero_Volumen'])
                                    <span class="grises">{{$infoAvaluo['Medidas_Colindancias']['Numero_Volumen']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Número notaría:</b></td>
                                <td>
                                @isset($infoAvaluo['Medidas_Colindancias']['Numero_Notaria'])
                                    <span class="grises">{{$infoAvaluo['Medidas_Colindancias']['Numero_Notaria']}}</span>
                                @endisset
                                </td>
                                <td><b>Nombre de notario:</b></td>
                                <td>
                                @isset($infoAvaluo['Medidas_Colindancias']['Nombre_Notario'])
                                    <span class="grises">{{$infoAvaluo['Medidas_Colindancias']['Nombre_Notario']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Entidad federativa:</b></td>
                                <td>
                                @isset($infoAvaluo['Medidas_Colindancias']['Entidad_Federativa'])
                                    <span class="grises">{{$infoAvaluo['Medidas_Colindancias']['Entidad_Federativa']}}</span>
                                @endisset
                                </td>
                            </tr>
                        </table>


                        @if(isset($infoAvaluo['Colindancias']))
                            <table class="tabla_cabeza_gris">
                                <thead>
                                    <tr>
                                        <th>Orientación</th>
                                        <th>Medida En Metros</th>
                                        <th>Descripción Colindante</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @isset($infoAvaluo['Colindancias'])
                                    @foreach($infoAvaluo['Colindancias'] as $value_colindancias)
                                    <tr>
                                        <td><span class="grises">{{$value_colindancias['Orientacion']}}</span></td>
                                        <td><span class="grises">{{$value_colindancias['MedidaEnMetros']}}</span></td>
                                        <td><span class="grises">{{$value_colindancias['DescripcionColindante']}}</span></td>
                                    </tr>
                                    @endforeach
                                @endisset
                                </tbody>
                            </table>
                        @endif


                        @if(isset($infoAvaluo['Superficie_Total_Segun']))
                            <h4 style="margin-top: 4%;">SUPERFICIE TOTAL SEGÚN:</h4>

                                <table class="tabla_cabeza_gris">
                                    <thead>
                                        <tr>
                                            <th>Ident. Fracción</th>
                                            <th>Sup Fracción</th>
                                            <th>Fzo</th>
                                            <th>Fub</th>
                                            <th>FFr</th>
                                            <th>Ffo</th>
                                            <th>Fsu</th>
                                            <th>Clave Area De Valor</th>
                                            <th>Valor</th>
                                            <th>Descripción</th>
                                            <th>Fre</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="centrado">
                                            @isset($infoAvaluo['Superficie_Total_Segun']['Ident_Fraccion'])
                                                <span class="grises">{{$infoAvaluo['Superficie_Total_Segun']['Ident_Fraccion']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($infoAvaluo['Superficie_Total_Segun']['Sup_Fraccion'])
                                                <span class="grises">{{$infoAvaluo['Superficie_Total_Segun']['Sup_Fraccion']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($infoAvaluo['Superficie_Total_Segun']['Fzo'])
                                                <span class="grises">{{$infoAvaluo['Superficie_Total_Segun']['Fzo']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($infoAvaluo['Superficie_Total_Segun']['Fub'])
                                                <span class="grises">{{$infoAvaluo['Superficie_Total_Segun']['Fub']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($infoAvaluo['Superficie_Total_Segun']['FFr'])
                                                <span class="grises">{{$infoAvaluo['Superficie_Total_Segun']['FFr']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($infoAvaluo['Superficie_Total_Segun']['Ffo'])
                                                <span class="grises">{{$infoAvaluo['Superficie_Total_Segun']['Ffo']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($infoAvaluo['Superficie_Total_Segun']['Fsu'])
                                                <span class="grises">{{$infoAvaluo['Superficie_Total_Segun']['Fsu']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($infoAvaluo['Superficie_Total_Segun']['Clave_Area_Valor'])
                                                <span class="grises">{{$infoAvaluo['Superficie_Total_Segun']['Clave_Area_Valor']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($infoAvaluo['Superficie_Total_Segun']['Valor'])
                                                <span class="grises">{{$infoAvaluo['Superficie_Total_Segun']['Valor']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($infoAvaluo['Superficie_Total_Segun']['Descripcion'])
                                                <span class="grises">{{$infoAvaluo['Superficie_Total_Segun']['Descripcion']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($infoAvaluo['Superficie_Total_Segun']['Fre'])
                                                <span class="grises">{{$infoAvaluo['Superficie_Total_Segun']['Fre']}}</span>
                                            @endisset
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div style="text-align: right;">
                                    <b>SUPERFICIE TOTAL TERRENO: 
                                    @isset($infoAvaluo['Superficie_Total_Segun']['Totales']['Superficie_Total_Terreno'])
                                        $<span class="grises">{{$infoAvaluo['Superficie_Total_Segun']['Totales']['Superficie_Total_Terreno']}}</span>
                                    @endisset                        
                                    </b>
                                </div>
                        @endif


                    <h4 style="margin-top: 4%;">TOPOGRAFÍA Y CONFIGURACIÓN:</h4>
                   
                        <table>
                            <tr>
                                <td><b>CARACTERÍSTICAS PANORÁMICAS:</b></td>
                                <td>
                                @isset($infoAvaluo['Topografia_Configuracion']['Caracteristicas_Panoramicas'])
                                    <span class="grises">{{$infoAvaluo['Topografia_Configuracion']['Caracteristicas_Panoramicas']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>DENSIDAD HABITACIONAL:</b></td>
                                <td>
                                @isset($infoAvaluo['Topografia_Configuracion']['Densidad_Habitacional'])
                                    <span class="grises">{{$infoAvaluo['Topografia_Configuracion']['Densidad_Habitacional']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>SERVIDUMBRE O RESTRICCIONES:</b></td>
                                <td>
                                @isset($infoAvaluo['Topografia_Configuracion']['Servidumbre_Restricciones'])
                                    <span class="grises">{{$infoAvaluo['Topografia_Configuracion']['Servidumbre_Restricciones']}}</span>
                                @endisset
                                </td>
                            </tr>
                        </table>


                <!-- 4.- Descripción General del Inmueble -->
                <div class="pleca_verde"><b>IV.- DESCRIPCIÓN GENERAL DEL INMUEBLE</b></div>

                    <div><b>USO ACTUAL:</b></div>
                    <div>
                    @isset($infoAvaluo['Uso_Actual'])
                        <span class="grises">{{$infoAvaluo['Uso_Actual']}}</span>
                    @endisset
                    </div>


                    @if(isset($infoAvaluo['Construcciones_Privativas']))
                        <h4 style="margin-top: 4%;">CONSTRUCCIONES PRIVATIVAS</h4>

                            <table  class="tabla_cabeza_gris">
                                <thead>
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Descripción</th>
                                        <th>Uso</th>
                                        <th>Nº Niveles Del Tipo</th>
                                        <th>Clave Rango De Niveles</th>
                                        <th>Puntaje</th>
                                        <th>Clase</th>
                                        <th>Edad</th>
                                        <th>Vida Util Total Del Tipo</th>
                                        <th>Vida Util Remanente</th>
                                        <th>Conservación</th>
                                        <th>Sup.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i_construccionesP = 1;
                                @endphp
                                @if(isset($infoAvaluo['Construcciones_Privativas'][0]))
                                    @foreach($infoAvaluo['Construcciones_Privativas'] as $value_construccionesP)
                                        <tr>
                                            <td class="centrado">
                                                {{$i_construccionesP++}}
                                            </td>
                                            <td class="centrado">
                                            @isset($value_construccionesP['Descripcion'])
                                                <span class="grises">{{$value_construccionesP['Descripcion']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($value_construccionesP['Uso'])
                                                <span class="grises">{{$value_construccionesP['Uso']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($value_construccionesP['No_Niveles_Tipo'])
                                                <span class="grises">{{$value_construccionesP['No_Niveles_Tipo']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($value_construccionesP['Clave_Rango_Niveles'])
                                                <span class="grises">{{$value_construccionesP['Clave_Rango_Niveles']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($value_construccionesP['Puntaje'])
                                                <span class="grises">{{$value_construccionesP['Puntaje']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($value_construccionesP['Clase'])
                                                <span class="grises">{{$value_construccionesP['Clase']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($value_construccionesP['Edad'])
                                                <span class="grises">{{$value_construccionesP['Edad']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($value_construccionesP['Vida_Util_Total_Tipo'])
                                                <span class="grises">{{$value_construccionesP['Vida_Util_Total_Tipo']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($value_construccionesP['Vida_Util_Remanente'])
                                                <span class="grises">{{$value_construccionesP['Vida_Util_Remanente']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($value_construccionesP['Conservacion'])
                                                <span class="grises">{{$value_construccionesP['Conservacion']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($value_construccionesP['Sup'])
                                                <span class="grises">{{$value_construccionesP['Sup']}}</span>
                                            @endisset
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                        <tr>
                                            <td class="centrado">
                                            1
                                            </td>
                                            <td class="centrado">
                                            @isset($infoAvaluo['Construcciones_Privativas']['Descripcion'])
                                                <span class="grises">{{$infoAvaluo['Construcciones_Privativas']['Descripcion']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($infoAvaluo['Construcciones_Privativas']['Uso'])
                                                <span class="grises">{{$infoAvaluo['Construcciones_Privativas']['Uso']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($infoAvaluo['Construcciones_Privativas']['No_Niveles_Tipo'])
                                                <span class="grises">{{$infoAvaluo['Construcciones_Privativas']['No_Niveles_Tipo']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($infoAvaluo['Construcciones_Privativas']['Clave_Rango_Niveles'])
                                                <span class="grises">{{$infoAvaluo['Construcciones_Privativas']['Clave_Rango_Niveles']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($infoAvaluo['Construcciones_Privativas']['Puntaje'])
                                                <span class="grises">{{$infoAvaluo['Construcciones_Privativas']['Puntaje']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($infoAvaluo['Construcciones_Privativas']['Clase'])
                                                <span class="grises">{{$infoAvaluo['Construcciones_Privativas']['Clase']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($infoAvaluo['Construcciones_Privativas']['Edad'])
                                                <span class="grises">{{$infoAvaluo['Construcciones_Privativas']['Edad']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($infoAvaluo['Construcciones_Privativas']['Vida_Util_Total_Tipo'])
                                                <span class="grises">{{$infoAvaluo['Construcciones_Privativas']['Vida_Util_Total_Tipo']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($infoAvaluo['Construcciones_Privativas']['Vida_Util_Remanente'])
                                                <span class="grises">{{$infoAvaluo['Construcciones_Privativas']['Vida_Util_Remanente']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($infoAvaluo['Construcciones_Privativas']['Conservacion'])
                                                <span class="grises">{{$infoAvaluo['Construcciones_Privativas']['Conservacion']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($infoAvaluo['Construcciones_Privativas']['Sup'])
                                                <span class="grises">{{$infoAvaluo['Construcciones_Privativas']['Sup']}}</span>
                                            @endisset
                                            </td>
                                        </tr>
                                @endif
                                </tbody>
                            </table>
                    @endif


                    @if(isset($infoAvaluo['Construcciones_Comunes']))
                        <h4 style="margin-top: 4%;">CONSTRUCCIONES COMUNES</h4>

                            <table  class="tabla_cabeza_gris">
                                <thead>
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Descripción</th>
                                        <th>Uso</th>
                                        <th>Nº Niveles Del Tipo</th>
                                        <th>Clave Rango De Niveles</th>
                                        <th>Puntaje</th>
                                        <th>Clase</th>
                                        <th>Edad</th>
                                        <th>Vida Util Total Del Tipo</th>
                                        <th>Vida Util Remanente</th>
                                        <th>Conservación</th>
                                        <th>Sup.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i_construccionesC = 1;
                                @endphp
                                @if(isset($infoAvaluo['Construcciones_Comunes'][0]))
                                    @foreach($infoAvaluo['Construcciones_Comunes'] as $value_construccionesC)
                                        <tr>
                                            <td class="centrado">
                                                {{$i_construccionesC++}}
                                            </td>
                                            <td class="centrado">
                                            @isset($value_construccionesC['Descripcion'])
                                                <span class="grises">{{$value_construccionesC['Descripcion']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($value_construccionesC['Uso'])
                                                <span class="grises">{{$value_construccionesC['Uso']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($value_construccionesC['No_Niveles_Tipo'])
                                                <span class="grises">{{$value_construccionesC['No_Niveles_Tipo']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($value_construccionesC['Clave_Rango_Niveles'])
                                                <span class="grises">{{$value_construccionesC['Clave_Rango_Niveles']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($value_construccionesC['Puntaje'])
                                                <span class="grises">{{$value_construccionesC['Puntaje']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($value_construccionesC['Clase'])
                                                <span class="grises">{{$value_construccionesC['Clase']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($value_construccionesC['Edad'])
                                                <span class="grises">{{$value_construccionesC['Edad']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($value_construccionesC['Vida_Util_Total_Tipo'])
                                                <span class="grises">{{$value_construccionesC['Vida_Util_Total_Tipo']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($value_construccionesC['Vida_Util_Remanente'])
                                                <span class="grises">{{$value_construccionesC['Vida_Util_Remanente']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($value_construccionesC['Conservacion'])
                                                <span class="grises">{{$value_construccionesC['Conservacion']}}</span>
                                            @endisset
                                            </td>
                                            <td class="centrado">
                                            @isset($value_construccionesC['Sup'])
                                                <span class="grises">{{$value_construccionesC['Sup']}}</span>
                                            @endisset
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="centrado">
                                        @isset($infoAvaluo['Construcciones_Comunes']['Tipo'])
                                            <span class="grises">{{$infoAvaluo['Construcciones_Comunes']['Tipo']}}</span>
                                        @endisset
                                        </td>
                                        <td class="centrado">
                                        @isset($infoAvaluo['Construcciones_Comunes']['Descripcion'])
                                            <span class="grises">{{$infoAvaluo['Construcciones_Comunes']['Descripcion']}}</span>
                                        @endisset
                                        </td>
                                        <td class="centrado">
                                        @isset($infoAvaluo['Construcciones_Comunes']['Uso'])
                                            <span class="grises">{{$infoAvaluo['Construcciones_Comunes']['Uso']}}</span>
                                        @endisset
                                        </td>
                                        <td class="centrado">
                                        @isset($infoAvaluo['Construcciones_Comunes']['No_Niveles_Tipo'])
                                            <span class="grises">{{$infoAvaluo['Construcciones_Comunes']['No_Niveles_Tipo']}}</span>
                                        @endisset
                                        </td>
                                        <td class="centrado">
                                        @isset($infoAvaluo['Construcciones_Comunes']['Clave_Rango_Niveles'])
                                            <span class="grises">{{$infoAvaluo['Construcciones_Comunes']['Clave_Rango_Niveles']}}</span>
                                        @endisset
                                        </td>
                                        <td class="centrado">
                                        @isset($infoAvaluo['Construcciones_Comunes']['Puntaje'])
                                            <span class="grises">{{$infoAvaluo['Construcciones_Comunes']['Puntaje']}}</span>
                                        @endisset
                                        </td>
                                        <td class="centrado">
                                        @isset($infoAvaluo['Construcciones_Comunes']['Clase'])
                                            <span class="grises">{{$infoAvaluo['Construcciones_Comunes']['Clase']}}</span>
                                        @endisset
                                        </td>
                                        <td class="centrado">
                                        @isset($infoAvaluo['Construcciones_Comunes']['Edad'])
                                            <span class="grises">{{$infoAvaluo['Construcciones_Comunes']['Edad']}}</span>
                                        @endisset
                                        </td>
                                        <td class="centrado">
                                        @isset($infoAvaluo['Construcciones_Comunes']['Vida_Util_Total_Tipo'])
                                            <span class="grises">{{$infoAvaluo['Construcciones_Comunes']['Vida_Util_Total_Tipo']}}</span>
                                        @endisset
                                        </td>
                                        <td class="centrado">
                                        @isset($infoAvaluo['Construcciones_Comunes']['Vida_Util_Remanente'])
                                            <span class="grises">{{$infoAvaluo['Construcciones_Comunes']['Vida_Util_Remanente']}}</span>
                                        @endisset
                                        </td>
                                        <td class="centrado">
                                        @isset($infoAvaluo['Construcciones_Comunes']['Conservacion'])
                                            <span class="grises">{{$infoAvaluo['Construcciones_Comunes']['Conservacion']}}</span>
                                        @endisset
                                        </td>
                                        <td class="centrado">
                                        @isset($infoAvaluo['Construcciones_Comunes']['Sup'])
                                            <span class="grises">{{$infoAvaluo['Construcciones_Comunes']['Sup']}}</span>
                                        @endisset
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                    @endif
                    

                        <table>
                            <tr>
                                <td><b>INDIVISO</b></td>
                                <td>
                                @isset($infoAvaluo['Indiviso'])
                                    <span class="grises">{{$infoAvaluo['Indiviso']}} %</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>VIDA ÚTIL PROMEDIO DEL INMUEBLE:</b></td>
                                <td>
                                @isset($infoAvaluo['Vida_Util_Promedio_Inmueble'])
                                    <span class="grises">{{$infoAvaluo['Vida_Util_Promedio_Inmueble']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>EDAD APROXIMADA DE LA CONSTRUCCIÓN:</b></td>
                                <td>
                                @isset($infoAvaluo['Edad_Aproximada_Construccion'])
                                    <span class="grises">{{$infoAvaluo['Edad_Aproximada_Construccion']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>VIDA ÚTIL REMANENTE:</b></td>
                                <td>
                                @isset($infoAvaluo['Vida_Util_Remanente'])
                                    <span class="grises">{{$infoAvaluo['Vida_Util_Remanente']}}</span>
                                @endisset
                                </td>
                            </tr>
                        </table>


                <!-- 5.- Elementos de la Construcción -->
                <div class="pleca_verde"><b>V.- ELEMENTOS DE LA CONSTRUCCIÓN</b></div>

                    <h4 style="margin-top: 4%;"><b>a) OBRA NEGRA O GRUESA:</b></h4>

                        <table>
                            <tr>
                                <td><b>CIMIENTOS:</b></td>
                                <td>
                                @isset($infoAvaluo['Obra_Negra_Gruesa']['Cimientos'])
                                    <span class="grises">{{$infoAvaluo['Obra_Negra_Gruesa']['Cimientos']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>ESTRUCTURA:</b></td>
                                <td>
                                @isset($infoAvaluo['Obra_Negra_Gruesa']['Estructura'])
                                    <span class="grises">{{$infoAvaluo['Obra_Negra_Gruesa']['Estructura']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>MUROS:</b></td>
                                <td>
                                @isset($infoAvaluo['Obra_Negra_Gruesa']['Muros'])
                                    <span class="grises">{{$infoAvaluo['Obra_Negra_Gruesa']['Muros']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>ENTREPISOS:</b></td>
                                <td>
                                @isset($infoAvaluo['Obra_Negra_Gruesa']['Entrepiso'])
                                    <span class="grises">{{$infoAvaluo['Obra_Negra_Gruesa']['Entrepiso']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>TECHOS:</b></td>
                                <td>
                                @isset($infoAvaluo['Obra_Negra_Gruesa']['Techos'])
                                    <span class="grises">{{$infoAvaluo['Obra_Negra_Gruesa']['Techos']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>AZOTEAS:</b></td>
                                <td>
                                @isset($infoAvaluo['Obra_Negra_Gruesa']['Azoteas'])
                                    <span class="grises">{{$infoAvaluo['Obra_Negra_Gruesa']['Azoteas']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>BARDAS:</b></td>
                                <td>
                                @isset($infoAvaluo['Obra_Negra_Gruesa']['Bardas'])
                                    <span class="grises">{{$infoAvaluo['Obra_Negra_Gruesa']['Bardas']}}</span>
                                @endisset
                                </td>
                            </tr>
                        </table>


                    <h4 style="margin-top: 4%;"><b>b) REVESTIMIENTOS Y ACABADOS INTERIORES</b></h4>

                        <table>
                            <tr>
                                <td><b>APLANADOS:</b></td>
                                <td>
                                @isset($infoAvaluo['Revestimientos_Acabados_Interiores']['Aplanados'])
                                    <span class="grises">{{$infoAvaluo['Revestimientos_Acabados_Interiores']['Aplanados']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>PLAFONES:</b></td>
                                <td>
                                @isset($infoAvaluo['Revestimientos_Acabados_Interiores']['Plafones'])
                                    <span class="grises">{{$infoAvaluo['Revestimientos_Acabados_Interiores']['Plafones']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>LAMBRINES:</b></td>
                                <td>
                                @isset($infoAvaluo['Revestimientos_Acabados_Interiores']['Lambrines'])
                                    <span class="grises">{{$infoAvaluo['Revestimientos_Acabados_Interiores']['Lambrines']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>PISOS:</b></td>
                                <td>
                                @isset($infoAvaluo['Revestimientos_Acabados_Interiores']['Pisos'])
                                    <span class="grises">{{$infoAvaluo['Revestimientos_Acabados_Interiores']['Pisos']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>ZOCLOS:</b></td>
                                <td>
                                @isset($infoAvaluo['Revestimientos_Acabados_Interiores']['Zoclos'])
                                    <span class="grises">{{$infoAvaluo['Revestimientos_Acabados_Interiores']['Zoclos']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>ESCALERAS:</b></td>
                                <td>
                                @isset($infoAvaluo['Revestimientos_Acabados_Interiores']['Escaleras'])
                                    <span class="grises">{{$infoAvaluo['Revestimientos_Acabados_Interiores']['Escaleras']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>PINTURA:</b></td>
                                <td>
                                @isset($infoAvaluo['Revestimientos_Acabados_Interiores']['Pintura'])
                                    <span class="grises">{{$infoAvaluo['Revestimientos_Acabados_Interiores']['Pintura']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>RECUBRIMIENTOS ESPECIALES:</b></td>
                                <td>
                                @isset($infoAvaluo['Revestimientos_Acabados_Interiores']['Recubrimientos_Especiales'])
                                    <span class="grises">{{$infoAvaluo['Revestimientos_Acabados_Interiores']['Recubrimientos_Especiales']}}</span>
                                @endisset
                                </td>
                            </tr>
                        </table>


                    <h4 style="margin-top: 4%;"><b>c) CARPINTERÍA</b></h4>

                        <table>
                            <tr>
                                <td><b>PUERTAS INTERIORES:</b></td>
                                <td>
                                @isset($infoAvaluo['Carpinteria']['Puertas_Interiores'])
                                    <span class="grises">{{$infoAvaluo['Carpinteria']['Puertas_Interiores']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>GUARDARROPAS:</b></td>
                                <td>
                                @isset($infoAvaluo['Carpinteria']['Guardarropas'])
                                    <span class="grises">{{$infoAvaluo['Carpinteria']['Guardarropas']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>MUEBLES EMPOTRADOS O FIJOS:</b></td>
                                <td>
                                @isset($infoAvaluo['Carpinteria']['Muebles_Empotrados'])
                                    <span class="grises">{{$infoAvaluo['Carpinteria']['Muebles_Empotrados']}}</span>
                                @endisset
                                </td>
                            </tr>
                        </table>


                    <h4 style="margin-top: 4%;"><b>d) INSTALACIONES HIDRAULICAS Y SANITARIAS</b></h4>

                        <table>
                            <tr>
                                <td><b>MUEBLES DE BAÑO:</b></td>
                                <td>
                                @isset($infoAvaluo['Instalaciones_Hidraulicas_Sanitrias']['Muebles_Banio'])
                                    <span class="grises">{{$infoAvaluo['Instalaciones_Hidraulicas_Sanitrias']['Muebles_Banio']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>RAMALEOS HIDRÁULICOS:</b></td>
                                <td>
                                @isset($infoAvaluo['Instalaciones_Hidraulicas_Sanitrias']['Ramaleos_Hidraulicos'])
                                    <span class="grises">{{$infoAvaluo['Instalaciones_Hidraulicas_Sanitrias']['Ramaleos_Hidraulicos']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>RAMALEOS SANITARIOS:</b></td>
                                <td>
                                @isset($infoAvaluo['Instalaciones_Hidraulicas_Sanitrias']['Ramaleos_Sanitarios'])
                                    <span class="grises">{{$infoAvaluo['Instalaciones_Hidraulicas_Sanitrias']['Ramaleos_Sanitarios']}}</span>
                                @endisset
                                </td>
                            </tr>
                        </table>


                    <table>
                        <tr>
                            <td><b>e) INSTALACIONES ELÉCTRICAS Y ALUMBRADO</b></td>
                            <td>
                            @isset($infoAvaluo['Instalaciones_Electricas_Alumbrados'])
                                <span class="grises">{{$infoAvaluo['Instalaciones_Electricas_Alumbrados']}}</span>
                            @endisset
                            </td>
                        </tr>
                    </table>


                    <h4 style="margin-top: 4%;"><b>f) PUERTAS Y VENTANERÍA METÁLICA</b></h4>

                        <table>
                            <tr>
                                <td><b>HERRERÍA:</b></td>
                                <td>
                                @isset($infoAvaluo['Puertas_Ventaneria_Metalica']['Herreria'])
                                    <span class="grises">{{$infoAvaluo['Puertas_Ventaneria_Metalica']['Herreria']}}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>VENTANERÍA:</b></td>
                                <td>
                                @isset($infoAvaluo['Puertas_Ventaneria_Metalica']['Ventaneria'])
                                    <span class="grises">{{$infoAvaluo['Puertas_Ventaneria_Metalica']['Ventaneria']}}</span>
                                @endisset
                                </td>
                            </tr>
                        </table>


                    <table>
                        <tr>
                            <td><b>g) VIDRIERÍA</b></td>
                            <td>
                            @isset($infoAvaluo['Vidrieria'])
                                <span class="grises">{{$infoAvaluo['Vidrieria']}}</span>
                            @endisset
                            </td>
                        </tr>
                    </table>


                    <table>
                        <tr>
                            <td><b>h) CERRAJERÍA</b></td>
                            <td>
                            @isset($infoAvaluo['Cerrajeria'])
                                <span class="grises">{{$infoAvaluo['Cerrajeria']}}</span>
                            @endisset
                            </td>
                        </tr>
                    </table>


                    <table>
                        <tr>
                            <td><b>i) FACHADAS</b></td>
                            <td>
                            @isset($infoAvaluo['Fachadas'])
                                <span class="grises">{{$infoAvaluo['Fachadas']}}</span>
                            @endisset
                            </td>
                        </tr>
                    </table>


                    <h4 style="margin-top: 4%;"><b>j) INSTALACIONES ESPECIALES</b></h4>
                        <!-- PRIVATIVAS -->
                        @if(isset($infoAvaluo['Instalaciones_Especiales']['Privativas']))
                            <span><b>Privativas</b></span>
                            <table class="tabla_cabeza_gris" style="">
                                <thead>
                                    <tr>
                                        <th>Clave</th>
                                        <th>Descripción</th>
                                        <th>Unidad</th>
                                        <th>Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($infoAvaluo['Instalaciones_Especiales']['Privativas'][0]))
                                        @foreach($infoAvaluo['Instalaciones_Especiales']['Privativas'] as $value_instalacionesEspeciales)
                                            <tr>
                                                <td class="centrado">
                                                @isset($value_instalacionesEspeciales['Clave'])
                                                    <span class="grises">{{$value_instalacionesEspeciales['Clave']}}</span>
                                                @endisset
                                                </td>
                                                <td>
                                                @isset($value_instalacionesEspeciales['Descripcion'])
                                                    <span class="grises">{{$value_instalacionesEspeciales['Descripcion']}}</span>
                                                @endisset
                                                </td>
                                                <td>
                                                @isset($value_instalacionesEspeciales['Unidad'])
                                                    <span class="grises">{{$value_instalacionesEspeciales['Unidad']}}</span>
                                                @endisset
                                                </td>
                                                <td>
                                                @isset($value_instalacionesEspeciales['Cantidad'])
                                                    <span class="grises">{{$value_instalacionesEspeciales['Cantidad']}}</span>
                                                @endisset
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="centrado">
                                            @isset($infoAvaluo['Instalaciones_Especiales']['Privativas']['Clave'])
                                                <span class="grises">{{$infoAvaluo['Instalaciones_Especiales']['Privativas']['Clave']}}</span>
                                            @endisset
                                            </td>
                                            <td>
                                            @isset($infoAvaluo['Instalaciones_Especiales']['Privativas']['Descripcion'])
                                                <span class="grises">{{$infoAvaluo['Instalaciones_Especiales']['Privativas']['Descripcion']}}</span>
                                            @endisset
                                            </td>
                                            <td>
                                            @isset($infoAvaluo['Instalaciones_Especiales']['Privativas']['Unidad'])
                                                <span class="grises">{{$infoAvaluo['Instalaciones_Especiales']['Privativas']['Unidad']}}</span>
                                            @endisset
                                            </td>
                                            <td>
                                            @isset($infoAvaluo['Instalaciones_Especiales']['Privativas']['Cantidad'])
                                                <span class="grises">{{$infoAvaluo['Instalaciones_Especiales']['Privativas']['Cantidad']}}</span>
                                            @endisset
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        @endif
                        <br>

                        <!-- COMUNES -->
                        @if(isset($infoAvaluo['Instalaciones_Especiales']['Comunes']))
                            <span><b>Comunes</b></span>
                            <table class="tabla_cabeza_gris" style="">
                                <thead>
                                    <tr>
                                        <th>Clave</th>
                                        <th>Descripción</th>
                                        <th>Unidad</th>
                                        <th>Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($infoAvaluo['Instalaciones_Especiales']['Comunes'][0]))
                                        @foreach($infoAvaluo['Instalaciones_Especiales']['Comunes'] as $value_instalacionesEspeciales)
                                            <tr>
                                                <td class="centrado">
                                                @isset($value_instalacionesEspeciales['Clave'])
                                                    <span class="grises">{{$value_instalacionesEspeciales['Clave']}}</span>
                                                @endisset
                                                </td>
                                                <td>
                                                @isset($value_instalacionesEspeciales['Descripcion'])
                                                    <span class="grises">{{$value_instalacionesEspeciales['Descripcion']}}</span>
                                                @endisset
                                                </td>
                                                <td>
                                                @isset($value_instalacionesEspeciales['Unidad'])
                                                    <span class="grises">{{$value_instalacionesEspeciales['Unidad']}}</span>
                                                @endisset
                                                </td>
                                                <td>
                                                @isset($value_instalacionesEspeciales['Cantidad'])
                                                    <span class="grises">{{$value_instalacionesEspeciales['Cantidad']}}</span>
                                                @endisset
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="centrado">
                                            @isset($infoAvaluo['Instalaciones_Especiales']['Comunes']['Clave'])
                                                <span class="grises">{{$infoAvaluo['Instalaciones_Especiales']['Comunes']['Clave']}}</span>
                                            @endisset
                                            </td>
                                            <td>
                                            @isset($infoAvaluo['Instalaciones_Especiales']['Comunes']['Descripcion'])
                                                <span class="grises">{{$infoAvaluo['Instalaciones_Especiales']['Comunes']['Descripcion']}}</span>
                                            @endisset
                                            </td>
                                            <td>
                                            @isset($infoAvaluo['Instalaciones_Especiales']['Comunes']['Unidad'])
                                                <span class="grises">{{$infoAvaluo['Instalaciones_Especiales']['Comunes']['Unidad']}}</span>
                                            @endisset
                                            </td>
                                            <td>
                                            @isset($infoAvaluo['Instalaciones_Especiales']['Comunes']['Cantidad'])
                                                <span class="grises">{{$infoAvaluo['Instalaciones_Especiales']['Comunes']['Cantidad']}}</span>
                                            @endisset
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        @endif 

                    <h4 style="margin-top: 4%;"><b>k) ELEMENTOS ACCESORIOS</b></h4>

                        @if(isset($infoAvaluo['Elementos_Accesorios']['Privativas']))
                            <span><b>Privativas</b></span>
                            <table class="tabla_cabeza_gris" style="">
                                <thead>
                                    <tr>
                                        <th>Clave</th>
                                        <th>Descripción</th>
                                        <th>Unidad</th>
                                        <th>Cantidad</th>
                                        <th>Edad</th>
                                        <th>Vida Útil Total</th>
                                        <th>Valor Unitario</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(isset($infoAvaluo['Elementos_Accesorios']['Privativas'][0]))
                                    @foreach($infoAvaluo['Elementos_Accesorios']['Privativas'] as $value_elementoAccP)
                                        <tr>
                                            <td class="centrado">
                                            @isset($value_elementoAccP['Clave'])
                                                <span class="grises">{{$value_elementoAccP['Clave']}}</span>
                                            @endisset
                                            </td>
                                            <td>
                                            @isset($value_elementoAccP['Descripcion'])
                                                <span class="grises">{{$value_elementoAccP['Descripcion']}}</span>
                                            @endisset
                                            </td>
                                            <td>
                                            @isset($value_elementoAccP['Unidad'])
                                                <span class="grises">{{$value_elementoAccP['Unidad']}}</span>
                                            @endisset
                                            </td>
                                            <td>
                                            @isset($value_elementoAccP['Cantidad'])
                                                <span class="grises">{{$value_elementoAccP['Cantidad']}}</span>
                                            @endisset
                                            </td>
                                            <td>
                                            @isset($value_elementoAccP['Edad'])
                                                <span class="grises">{{$value_elementoAccP['Edad']}}</span>
                                            @endisset
                                            </td>
                                            <td>
                                            @isset($value_elementoAccP['Vida_Util_Total'])
                                                <span class="grises">{{$value_elementoAccP['Vida_Util_Total']}}</span>
                                            @endisset
                                            </td>
                                            <td>
                                            @isset($value_elementoAccP['Valor_Unitario'])
                                                <span class="grises">{{$value_elementoAccP['Valor_Unitario']}}</span>
                                            @endisset
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="centrado">
                                        @isset($infoAvaluo['Elementos_Accesorios']['Privativas']['Clave'])
                                            <span class="grises">{{$infoAvaluo['Elementos_Accesorios']['Privativas']['Clave']}}</span>
                                        @endisset
                                        </td>
                                        <td>
                                        @isset($infoAvaluo['Elementos_Accesorios']['Privativas']['Descripcion'])
                                            <span class="grises">{{$infoAvaluo['Elementos_Accesorios']['Privativas']['Descripcion']}}</span>
                                        @endisset
                                        </td>
                                        <td>
                                        @isset($infoAvaluo['Elementos_Accesorios']['Privativas']['Unidad'])
                                            <span class="grises">{{$infoAvaluo['Elementos_Accesorios']['Privativas']['Unidad']}}</span>
                                        @endisset
                                        </td>
                                        <td>
                                        @isset($infoAvaluo['Elementos_Accesorios']['Privativas']['Cantidad'])
                                            <span class="grises">{{$infoAvaluo['Elementos_Accesorios']['Privativas']['Cantidad']}}</span>
                                        @endisset
                                        </td>
                                        <td>
                                        @isset($infoAvaluo['Elementos_Accesorios']['Privativas']['Edad'])
                                            <span class="grises">{{$infoAvaluo['Elementos_Accesorios']['Privativas']['Edad']}}</span>
                                        @endisset
                                        </td>
                                        <td>
                                        @isset($infoAvaluo['Elementos_Accesorios']['Privativas']['Vida_Util_Total'])
                                            <span class="grises">{{$infoAvaluo['Elementos_Accesorios']['Privativas']['Vida_Util_Total']}}</span>
                                        @endisset
                                        </td>
                                        <td>
                                        @isset($infoAvaluo['Elementos_Accesorios']['Privativas']['Valor_Unitario'])
                                            <span class="grises">{{$infoAvaluo['Elementos_Accesorios']['Privativas']['Valor_Unitario']}}</span>
                                        @endisset
                                        </td>
                                    </tr>
                                @endif    
                                </tbody>
                            </table>
                        @endif


                    <h4 style="margin-top: 4%;"><b>l) OBRAS COMPLEMENTARIAS</b></h4>
                        
                        @if(isset($infoAvaluo['Obras_Complementarias']['Privativas']))
                            <span><b>Privativas</b></span>
                            <table class="tabla_cabeza_gris" style="">
                                <thead>
                                    <tr>
                                        <th>Clave</th>
                                        <th>Descripción</th>
                                        <th>Unidad</th>
                                        <th>Cantidad</th>
                                        <th>Edad</th>
                                        <th>Vida Útil Total</th>
                                        <th>Valor Unitario</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(isset($infoAvaluo['Obras_Complementarias']['Privativas'][0]))
                                    @foreach($infoAvaluo['Obras_Complementarias']['Privativas'] as $value_obras)
                                        <tr>
                                            <td class="centrado">
                                            @isset($value_obras['Clave'])
                                                <span class="grises">{{$value_obras['Clave']}}</span>
                                            @endisset
                                            </td>
                                            <td>
                                            @isset($value_obras['Descripcion'])
                                                <span class="grises">{{$value_obras['Descripcion']}}</span>
                                            @endisset
                                            </td>
                                            <td>
                                            @isset($value_obras['Unidad'])
                                                <span class="grises">{{$value_obras['Unidad']}}</span>
                                            @endisset
                                            </td>
                                            <td>
                                            @isset($value_obras['Cantidad'])
                                                <span class="grises">{{$value_obras['Cantidad']}}</span>
                                            @endisset
                                            </td>
                                            <td>
                                            @isset($value_obras['Edad'])
                                                <span class="grises">{{$value_obras['Edad']}}</span>
                                            @endisset
                                            </td>
                                            <td>
                                            @isset($value_obras['Vida_Util_Total'])
                                                <span class="grises">{{$value_obras['Vida_Util_Total']}}</span>
                                            @endisset
                                            </td>
                                            <td>
                                            @isset($value_obras['Valor_Unitario'])
                                                <span class="grises">{{$value_obras['Valor_Unitario']}}</span>
                                            @endisset
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="centrado">
                                        @isset($infoAvaluo['Obras_Complementarias']['Privativas']['Clave'])
                                            <span class="grises">{{$infoAvaluo['Obras_Complementarias']['Privativas']['Clave']}}</span>
                                        @endisset
                                        </td>
                                        <td>
                                        @isset($infoAvaluo['Obras_Complementarias']['Privativas']['Descripcion'])
                                            <span class="grises">{{$infoAvaluo['Obras_Complementarias']['Privativas']['Descripcion']}}</span>
                                        @endisset
                                        </td>
                                        <td>
                                        @isset($infoAvaluo['Obras_Complementarias']['Privativas']['Unidad'])
                                            <span class="grises">{{$infoAvaluo['Obras_Complementarias']['Privativas']['Unidad']}}</span>
                                        @endisset
                                        </td>
                                        <td>
                                        @isset($infoAvaluo['Obras_Complementarias']['Privativas']['Cantidad'])
                                            <span class="grises">{{$infoAvaluo['Obras_Complementarias']['Privativas']['Cantidad']}}</span>
                                        @endisset
                                        </td>
                                        <td>
                                        @isset($infoAvaluo['Obras_Complementarias']['Privativas']['Edad'])
                                            <span class="grises">{{$infoAvaluo['Obras_Complementarias']['Privativas']['Edad']}}</span>
                                        @endisset
                                        </td>
                                        <td>
                                        @isset($infoAvaluo['Obras_Complementarias']['Privativas']['Vida_Util_Total'])
                                            <span class="grises">{{$infoAvaluo['Obras_Complementarias']['Privativas']['Vida_Util_Total']}}</span>
                                        @endisset
                                        </td>
                                        <td>
                                        @isset($infoAvaluo['Obras_Complementarias']['Privativas']['Valor_Unitario'])
                                            <span class="grises">{{$infoAvaluo['Obras_Complementarias']['Privativas']['Valor_Unitario']}}</span>
                                        @endisset
                                        </td>
                                    </tr>                                
                                @endif
                                </tbody>
                            </table>
                        @endif

                <!-- 6.- Consideraciones Previas al Avalúo -->
                <div class="pleca_verde"><b>VI.- CONSIDERACIONES PREVIAS AL AVALÚO</b></div>

                <p class="letras_pequenas">
                    @isset($infoAvaluo['Consideraciones_Previas_Al_Avaluo'])
                        <span class="grises">{{$infoAvaluo['Consideraciones_Previas_Al_Avaluo']}}</span>
                    @endisset
                </p>



                <br>
                <!-- 7.- Comparación de Mercado -->
                <div class="pleca_verde">VII. COMPARACIÓN DE MERCADO</div>
                <h4 style="margin-top: 4%;">TERRENOS DIRECTOS</h4>
                <h4 style="margin-top: 4%;">TERRENOS</h4>
                <hr>
                <span><b>Investigación productos comparables</b></span>


                <!-- TABLA UNO TERRENOS DIRECTOS -->
                @if(isset($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaUno']))
                    <table class="tabla_cabeza_gris">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Ubicación</th>
                                <th>Descripción</th>
                                <th>C.U.S</th>
                                <th>Uso del suelo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i_tUno = 1;
                            @endphp
                            @if(isset($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaUno'][0]))
                                @foreach($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaUno'] as $value_tablaUno)
                                    <tr>
                                        <td>{{$i_tUno++}}</td>
                                        <td>
                                        @isset($value_tablaUno['Ubicacion'])
                                            <span class="grises">{{$value_tablaUno['Ubicacion']}}</span>
                                        @endisset
                                        </td>
                                        <td>
                                        @isset($value_tablaUno['Descripcion'])
                                            <span class="grises">{{$value_tablaUno['Descripcion']}}</span>
                                        @endisset
                                        </td>
                                        <td>
                                        @isset($value_tablaUno['C_U_S'])
                                            <span class="grises">{{$value_tablaUno['C_U_S']}}</span>
                                        @endisset
                                        </td>
                                        <td>
                                        @isset($value_tablaUno['Uso_Suelo'])
                                            <span class="grises">{{$value_tablaUno['Uso_Suelo']}}</span>
                                        @endisset
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>
                                    @isset($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaUno'])
                                    1
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaUno']['Ubicacion'])
                                        <span class="grises">{{$infoAvaluo['Terrenos']['Terrenos_Directos']['TablaUno']['Ubicacion']}}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaUno']['Descripcion'])
                                        <span class="grises">{{$infoAvaluo['Terrenos']['Terrenos_Directos']['TablaUno']['Descripcion']}}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaUno']['C_U_S'])
                                        <span class="grises">{{$infoAvaluo['Terrenos']['Terrenos_Directos']['TablaUno']['C_U_S']}}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaUno']['Uso_Suelo'])
                                        <span class="grises">{{$infoAvaluo['Terrenos']['Terrenos_Directos']['TablaUno']['Uso_Suelo']}}</span>
                                    @endisset
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                @endif
                <br>


                <!-- TABLA DOS TERRENOS DIRECTOS -->
                @if(isset($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaDos']))
                    <table class="tabla_cabeza_gris">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>F. Negociación</th>
                                <th>Superficie</th>
                                <th>Fzo</th>
                                <th>Fub</th>
                                <th>FFr</th>
                                <th>Ffo</th>
                                <th>Fsu</th>
                                <th>F(otro)</th>
                                <th>Fre</th>
                                <th>Precio solicitado</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $i_tDos = 1;
                        @endphp
                        @if(isset($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaDos'][0]))
                            @foreach($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaDos'] as $value_tablaDos)
                                <tr>
                                    <td>{{ $i_tDos++ }}</td>
                                    <td>
                                    @isset($value_tablaDos['F_Negociacion'])
                                        <span class="grises">{{ $value_tablaDos['F_Negociacion'] }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_tablaDos['Superficie'])
                                        <span class="grises">{{ number_format($value_tablaDos['Superficie'],2) }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_tablaDos['Fzo'])
                                        <span class="grises">{{ $value_tablaDos['Fzo'] }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_tablaDos['Fub'])
                                        <span class="grises">{{ $value_tablaDos['Fub'] }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_tablaDos['FFr'])
                                        <span class="grises">{{ $value_tablaDos['FFr'] }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_tablaDos['Ffo'])
                                        <span class="grises">{{ $value_tablaDos['Ffo'] }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_tablaDos['Fsu'])
                                        <span class="grises">{{ $value_tablaDos['Fsu'] }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_tablaDos['F_otro'])
                                        <span class="grises">{{ $value_tablaDos['F_otro'] }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_tablaDos['Fre'])
                                        <span class="grises">{{ number_format($value_tablaDos['Fre'],4) }}</span>
                                    @endisset
                                    </td>
                                    <td>$
                                    @isset($value_tablaDos['Precio_Solicitado'])
                                        <span class="grises">{{ number_format($value_tablaDos['Precio_Solicitado'],2) }}</span>
                                    @endisset
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaDos'])
                                    1
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaDos']['F_Negociacion'])
                                    <span class="grises">{{ $infoAvaluo['Terrenos']['Terrenos_Directos']['TablaDos']['F_Negociacion'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaDos']['Superficie'])
                                    <span class="grises">{{ number_format($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaDos']['Superficie'],2) }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaDos']['Fzo'])
                                    <span class="grises">{{ $infoAvaluo['Terrenos']['Terrenos_Directos']['TablaDos']['Fzo'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaDos']['Fub'])
                                    <span class="grises">{{ $infoAvaluo['Terrenos']['Terrenos_Directos']['TablaDos']['Fub'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaDos']['FFr'])
                                    <span class="grises">{{ $infoAvaluo['Terrenos']['Terrenos_Directos']['TablaDos']['FFr'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaDos']['Ffo'])
                                    <span class="grises">{{ $infoAvaluo['Terrenos']['Terrenos_Directos']['TablaDos']['Ffo'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaDos']['Fsu'])
                                    <span class="grises">{{ $infoAvaluo['Terrenos']['Terrenos_Directos']['TablaDos']['Fsu'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaDos']['F_otro'])
                                    <span class="grises">{{ $infoAvaluo['Terrenos']['Terrenos_Directos']['TablaDos']['F_otro'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaDos']['Fre'])
                                    <span class="grises">{{ number_format($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaDos']['Fre'],4) }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaDos']['Precio_Solicitado'])
                                    <span class="grises">$ {{ number_format($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaDos']['Precio_Solicitado'],2) }}</span>
                                @endisset
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                @endif
                <br>

                <table>
                    <thead>
                        <tr>
                            <th><b>Conclusiones de homologación terrenos:</b></th>
                            <th>  </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>Valor unitario de tierra promedio</b></td>
                            <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Directos']['Conclusiones_Homologacion_Terrenos']['Valor_Unitario_Tierra_Promedio'])
                                    <span class="grises">{{ number_format($infoAvaluo['Terrenos']['Terrenos_Directos']['Conclusiones_Homologacion_Terrenos']['Valor_Unitario_Tierra_Promedio'],2) }}</span>
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario de tierra homologado</b></td>
                            <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Directos']['Conclusiones_Homologacion_Terrenos']['Valor_Unitario_Tierra_Homologado'])
                                    <span class="grises">{{ number_format($infoAvaluo['Terrenos']['Terrenos_Directos']['Conclusiones_Homologacion_Terrenos']['Valor_Unitario_Tierra_Homologado'],2) }}</span>
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario sin homologar mínimo</b></td>
                            <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Directos']['Conclusiones_Homologacion_Terrenos']['Valor_Unitario_Sin_Homologar_Minimo'])
                                    <span class="grises">{{ number_format($infoAvaluo['Terrenos']['Terrenos_Directos']['Conclusiones_Homologacion_Terrenos']['Valor_Unitario_Sin_Homologar_Minimo'],2) }}</span>
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario sin homologar máximo</b></td>
                            <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Directos']['Conclusiones_Homologacion_Terrenos']['Valor_Unitario_Sin_Homologar_Maximo'])
                                    <span class="grises">{{ number_format($infoAvaluo['Terrenos']['Terrenos_Directos']['Conclusiones_Homologacion_Terrenos']['Valor_Unitario_Sin_Homologar_Maximo'],2) }}</span>
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado mínimo</b></td>
                            <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Directos']['Conclusiones_Homologacion_Terrenos']['Valor_Unitario_Homologado_Minimo'])
                                    <span class="grises">{{ number_format($infoAvaluo['Terrenos']['Terrenos_Directos']['Conclusiones_Homologacion_Terrenos']['Valor_Unitario_Homologado_Minimo'],2) }}</span>
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado máximo</b></td>
                            <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Directos']['Conclusiones_Homologacion_Terrenos']['Valor_Unitario_Homologado_Maximo'])
                                    <span class="grises">{{ number_format($infoAvaluo['Terrenos']['Terrenos_Directos']['Conclusiones_Homologacion_Terrenos']['Valor_Unitario_Homologado_Maximo'],2) }}</span>
                                @endisset
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>


                <!-- RESIDUALES -->
                <h4 style="margin-top: 4%;">TERRENOS RESIDUALES</h4>
                <hr>
                <table>
                    <tbody>
                        <tr>
                            <td><b>Tipo de producto inmobilario propuesto</b></td>
                            <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Tipo_Producto_Inmoviliario_Propuesto'])
                                    <span class="grises">{{ $infoAvaluo['Terrenos']['Terrenos_Residuales']['Tipo_Producto_Inmoviliario_Propuesto'] }}</span>
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Número de unidades vendibles</b></td>
                            <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Numero_Unidades_Vendibles'])
                                    <span class="grises">{{ $infoAvaluo['Terrenos']['Terrenos_Residuales']['Numero_Unidades_Vendibles'] }}</span>
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Superficie vendible por unidad</b></td>
                            <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Superficie_Vendible_Unidad'])
                                    <span class="grises">{{ $infoAvaluo['Terrenos']['Terrenos_Residuales']['Superficie_Vendible_Unidad'] }}</span>
                                @endisset
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <p><b>Investigación productos comparables</b></p>

                    @if(isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Investigacion_Productos_Comparables']))
                        <table class="tabla_cabeza_gris">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Ubicación</th>
                                    <th>Descripcioón</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                                $iTR = 1;
                            @endphp
                                @if(isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Investigacion_Productos_Comparables'][0]))
                                    @foreach($infoAvaluo['Terrenos']['Terrenos_Residuales']['Investigacion_Productos_Comparables'] as $value_terrenosResidualesIPC)
                                        <tr>
                                            <td class="centrado">
                                                <span class="grises">{{$iTR++}}</span>
                                            </td>
                                            <td>
                                            @isset($value_terrenosResidualesIPC['Ubicacion'])
                                                <span class="grises">{{$value_terrenosResidualesIPC['Ubicacion']}}</span>
                                            @endisset
                                            </td>
                                            <td>
                                            @isset($value_terrenosResidualesIPC['Descripcion'])
                                                <span class="grises">{{$value_terrenosResidualesIPC['Descripcion']}}</span>
                                            @endisset
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="centrado">
                                        @isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Investigacion_Productos_Comparables'])
                                            <span class="grises">1</span>
                                        @endisset
                                        </td>
                                        <td>
                                        @isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Investigacion_Productos_Comparables']['Ubicacion'])
                                            <span class="grises">{{$infoAvaluo['Terrenos']['Terrenos_Residuales']['Investigacion_Productos_Comparables']['Ubicacion']}}</span>
                                        @endisset
                                        </td>
                                        <td>
                                        @isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Investigacion_Productos_Comparables']['Descripcion'])
                                            <span class="grises">{{$infoAvaluo['Terrenos']['Terrenos_Residuales']['Investigacion_Productos_Comparables']['Descripcion']}}</span>
                                        @endisset
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    @endif


                    @if(isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Investigacion_Productos_Comparables_2']))
                        <table class="tabla_cabeza_gris">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>F. Negociación</th>
                                    <th>Superficie</th>
                                    <th>Precio Solicitado</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                                $iTR_2 = 1;
                            @endphp
                                @if(isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Investigacion_Productos_Comparables_2'][0]))
                                    @foreach($infoAvaluo['Terrenos']['Terrenos_Residuales']['Investigacion_Productos_Comparables_2'] as $value_terrenosResidualesIPC_2)
                                        <tr>
                                            <td class="centrado">
                                                {{$iTR_2++}}
                                            </td>
                                            <td>
                                            @isset($value_terrenosResidualesIPC_2['F_Negociacion'])
                                                <span class="grises">{{$value_terrenosResidualesIPC_2['F_Negociacion']}}</span>
                                            @endisset
                                            </td>
                                            <td>
                                            @isset($value_terrenosResidualesIPC_2['Superficie'])
                                                <span class="grises">{{$value_terrenosResidualesIPC_2['Superficie']}}</span>
                                            @endisset
                                            </td>
                                            <td>
                                            @isset($value_terrenosResidualesIPC_2['Precio_Solicitado'])
                                                <span class="grises">{{$value_terrenosResidualesIPC_2['Precio_Solicitado']}}</span>
                                            @endisset
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="centrado">
                                        @isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Investigacion_Productos_Comparables_2'])
                                            <span class="grises">1</span>
                                        @endisset
                                        </td>
                                        <td>
                                        @isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Investigacion_Productos_Comparables_2']['F_Negociacion'])
                                            <span class="grises">{{$infoAvaluo['Terrenos']['Terrenos_Residuales']['Investigacion_Productos_Comparables_2']['F_Negociacion']}}</span>
                                        @endisset
                                        </td>
                                        <td>
                                        @isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Investigacion_Productos_Comparables_2']['Superficie'])
                                            <span class="grises">{{$infoAvaluo['Terrenos']['Terrenos_Residuales']['Investigacion_Productos_Comparables_2']['Superficie']}}</span>
                                        @endisset
                                        </td>
                                        <td>
                                        @isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Investigacion_Productos_Comparables_2']['Precio_Solicitado'])
                                            <span class="grises">{{$infoAvaluo['Terrenos']['Terrenos_Residuales']['Investigacion_Productos_Comparables_2']['Precio_Solicitado']}}</span>
                                        @endisset
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    @endif


                <br>
                <table>
                    <thead>
                        <tr>
                            <th>Conclusiones homologación comp. residuales</th>
                            <th>     
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>Valor unitario promedio</b></td>
                            <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Conclusiones_Homologacion_Comp_Residuales']['Valor_Unitario_Promedio'])
                                    <span class="grises">{{$infoAvaluo['Terrenos']['Terrenos_Residuales']['Conclusiones_Homologacion_Comp_Residuales']['Valor_Unitario_Promedio']}}</span>
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado</b></td>
                            <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Conclusiones_Homologacion_Comp_Residuales']['Valor_Unitario_Homologado'])
                                    <span class="grises">{{$infoAvaluo['Terrenos']['Terrenos_Residuales']['Conclusiones_Homologacion_Comp_Residuales']['Valor_Unitario_Homologado']}}</span>
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario sin homologar mínimo</b></td>
                            <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Conclusiones_Homologacion_Comp_Residuales']['Valor_Unitario_Sin_Homologar_Minimo'])
                                    <span class="grises">{{$infoAvaluo['Terrenos']['Terrenos_Residuales']['Conclusiones_Homologacion_Comp_Residuales']['Valor_Unitario_Sin_Homologar_Minimo']}}</span>
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario sin homologar máximo</b></td>
                            <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Conclusiones_Homologacion_Comp_Residuales']['Valor_Unitario_Sin_Homologar_Maximo'])
                                    <span class="grises">{{$infoAvaluo['Terrenos']['Terrenos_Residuales']['Conclusiones_Homologacion_Comp_Residuales']['Valor_Unitario_Sin_Homologar_Maximo']}}</span>
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado mínimo</b></td>
                            <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Conclusiones_Homologacion_Comp_Residuales']['Valor_Unitario_Homologado_Minimo'])
                                    <span class="grises">{{$infoAvaluo['Terrenos']['Terrenos_Residuales']['Conclusiones_Homologacion_Comp_Residuales']['Valor_Unitario_Homologado_Minimo']}}</span>
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado máximo</b></td>
                            <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Conclusiones_Homologacion_Comp_Residuales']['Valor_Unitario_Homologado_Maximo'])
                                    <span class="grises">{{$infoAvaluo['Terrenos']['Terrenos_Residuales']['Conclusiones_Homologacion_Comp_Residuales']['Valor_Unitario_Homologado_Maximo']}}</span>
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario aplicable al residual</b></td>
                            <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Conclusiones_Homologacion_Comp_Residuales']['Valor_Unitario_Aplicable_Residual'])
                                    <span class="grises">{{$infoAvaluo['Terrenos']['Terrenos_Residuales']['Conclusiones_Homologacion_Comp_Residuales']['Valor_Unitario_Aplicable_Residual']}}</span>
                                @endisset
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <table>
                    <thead>
                        <tr>
                            <th>Análisis residual</th>
                            <th>  </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>Total de ingresos</b></td>
                            <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Analisis_Residual']['Total_Ingresos'])
                                    <span class="grises">{{$infoAvaluo['Terrenos']['Terrenos_Residuales']['Analisis_Residual']['Total_Ingresos']}}</span>
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Total de egresos</b></td>
                            <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Analisis_Residual']['Total_Egresos'])
                                    <span class="grises">{{$infoAvaluo['Terrenos']['Terrenos_Residuales']['Analisis_Residual']['Total_Egresos']}}</span>
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Utilidad propuesta</b></td>
                            <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Analisis_Residual']['Unidad_Propuesta'])
                                    <span class="grises">{{$infoAvaluo['Terrenos']['Terrenos_Residuales']['Analisis_Residual']['Unidad_Propuesta']}}</span>
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario de tierra resisdual</b></td>
                            <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Analisis_Residual']['Valor_Unitario_Tierra_Residual'])
                                    <span class="grises">{{$infoAvaluo['Terrenos']['Terrenos_Residuales']['Analisis_Residual']['Valor_Unitario_Tierra_Residual']}}</span>
                                @endisset
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- TIERRA DEL AVALUO -->
                <table class="tabla_gris_valor">
                    <thead>
                        <tr>
                            <th>VALOR UNITARIO DE TIERRA DEL AVALUO</th>
                            <th>
                            @isset($infoAvaluo['Terrenos']['Valor_Unitario_Tierra_Del_Avaluo'])
                                <span class="grises">{{ $infoAvaluo['Terrenos']['Valor_Unitario_Tierra_Del_Avaluo'] }}
                            @endisset
                            </th>
                        </tr>
                    </thead> 
                </table>

                <h4 style="margin-top: 4%;">CONSTRUCCIONES EN VENTA</h4>
                <hr>
                <p>Investigación productos comparables</p>

                @if(isset($infoAvaluo['Construcciones_En_Venta']['Investigacion_Productos_Comparables']['TablaUno']))
                    <table class="tabla_cabeza_gris">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Ubicación</th>
                                <th>Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $iC_Uno = 1;
                        @endphp
                        @if(isset($infoAvaluo['Construcciones_En_Venta']['Investigacion_Productos_Comparables']['TablaUno'][0]))
                            @foreach($infoAvaluo['Construcciones_En_Venta']['Investigacion_Productos_Comparables']['TablaUno'] as $valueC_tablaUno)
                                <tr>
                                    <td>
                                        <span class="grises">{{ $iC_Uno++ }}</span>
                                    </td>
                                    <td>
                                    @isset($valueC_tablaUno['Ubicacion'])
                                        <span class="grises">{{ $valueC_tablaUno['Ubicacion'] }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($valueC_tablaUno['Descripcion'])
                                        <span class="grises">{{ $valueC_tablaUno['Descripcion'] }}</span>
                                    @endisset
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>
                                @isset($infoAvaluo['Construcciones_En_Venta']['Investigacion_Productos_Comparables']['TablaUno'])
                                <span class="grises">1</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Construcciones_En_Venta']['Investigacion_Productos_Comparables']['TablaUno']['Ubicacion'])
                                    <span class="grises">{{ $infoAvaluo['Construcciones_En_Venta']['Investigacion_Productos_Comparables']['TablaUno']['Ubicacion'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Construcciones_En_Venta']['Investigacion_Productos_Comparables']['TablaUno']['Descripcion'])
                                    <span class="grises">{{ $infoAvaluo['Construcciones_En_Venta']['Investigacion_Productos_Comparables']['TablaUno']['Descripcion'] }}</span>
                                @endisset
                                </td>
                            </tr>                        
                        @endif    
                        </tbody>
                    </table>
                @endif


                @if(isset($infoAvaluo['Construcciones_En_Venta']['Investigacion_Productos_Comparables']['TablaDos']))
                    <table class="tabla_cabeza_gris">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>F. Negociación</th>
                                <th>Superficie vendible</th>
                                <th>Precio solicitado</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $iC_Dos = 1;
                        @endphp
                        @if(isset($infoAvaluo['Construcciones_En_Venta']['Investigacion_Productos_Comparables']['TablaDos'][0]))
                            @foreach($infoAvaluo['Construcciones_En_Venta']['Investigacion_Productos_Comparables']['TablaDos'] as $valueC_tablaDos)
                                <tr>
                                    <td><span class="grises">{{ $iC_Dos++ }}</span></td>
                                    <td>
                                    @isset($valueC_tablaDos['F_Negociacion'])
                                        <span class="grises">{{ number_format($valueC_tablaDos['F_Negociacion'],2) }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($valueC_tablaDos['Superficie_Vendible'])
                                        <span class="grises">{{ number_format($valueC_tablaDos['Superficie_Vendible'],2) }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($valueC_tablaDos['Precio_Solicitado'])
                                        $<span class="grises">{{ number_format($valueC_tablaDos['Precio_Solicitado'],2) }}</span>
                                    @endisset
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>
                                @isset($infoAvaluo['Construcciones_En_Venta']['Investigacion_Productos_Comparables']['TablaDos'])
                                <span class="grises">1</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Construcciones_En_Venta']['Investigacion_Productos_Comparables']['TablaDos']['F_Negociacion'])
                                <span class="grises">{{ number_format($infoAvaluo['Construcciones_En_Venta']['Investigacion_Productos_Comparables']['TablaDos']['F_Negociacion'],2) }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Construcciones_En_Venta']['Investigacion_Productos_Comparables']['TablaDos']['Superficie_Vendible'])
                                <span class="grises">{{ number_format($infoAvaluo['Construcciones_En_Venta']['Investigacion_Productos_Comparables']['TablaDos']['Superficie_Vendible'],2) }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Construcciones_En_Venta']['Investigacion_Productos_Comparables']['TablaDos']['Precio_Solicitado'])
                                    <span class="grises">${{ number_format($infoAvaluo['Construcciones_En_Venta']['Investigacion_Productos_Comparables']['TablaDos']['Precio_Solicitado'],2) }}</span>
                                @endisset
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                @endif
                <br>


                <table>
                    <thead>
                        <tr>
                            <th>Conclusiones homologación comp. residuales</th>
                            <th>  </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>Valor unitario promedio</b></td>
                            <td>
                            @isset($infoAvaluo['Construcciones_En_Venta']['Conclusion_Homologacion_Contrucciones_Venta']['Valor_Unitario_Promedio'])
                                <span class="grises">{{ number_format($infoAvaluo['Construcciones_En_Venta']['Conclusion_Homologacion_Contrucciones_Venta']['Valor_Unitario_Promedio'],2) }}</span>
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado</b></td>
                            <td>
                            @isset($infoAvaluo['Construcciones_En_Venta']['Conclusion_Homologacion_Contrucciones_Venta']['Valor_Unitario_Homologado'])
                                <span class="grises">{{ number_format($infoAvaluo['Construcciones_En_Venta']['Conclusion_Homologacion_Contrucciones_Venta']['Valor_Unitario_Homologado'],2) }}</span>
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario sin homologar mínimo</b></td>
                            <td>
                            @isset($infoAvaluo['Construcciones_En_Venta']['Conclusion_Homologacion_Contrucciones_Venta']['Valor_Unitario_Sin_Homolgar_Minimo'])
                                <span class="grises">{{ number_format($infoAvaluo['Construcciones_En_Venta']['Conclusion_Homologacion_Contrucciones_Venta']['Valor_Unitario_Sin_Homolgar_Minimo'],2) }}</span>
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario sin homologar máximo</b></td>
                            <td>
                            @isset($infoAvaluo['Construcciones_En_Venta']['Conclusion_Homologacion_Contrucciones_Venta']['Valor_Unitario_Sin_Homolgar_Maximo'])
                                <span class="grises">{{ number_format($infoAvaluo['Construcciones_En_Venta']['Conclusion_Homologacion_Contrucciones_Venta']['Valor_Unitario_Sin_Homolgar_Maximo'],2) }}</span>
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado mínimo</b></td>
                            <td>
                            @isset($infoAvaluo['Construcciones_En_Venta']['Conclusion_Homologacion_Contrucciones_Venta']['Valor_Unitario_Homologado_Minimo'])
                                <span class="grises">{{ number_format($infoAvaluo['Construcciones_En_Venta']['Conclusion_Homologacion_Contrucciones_Venta']['Valor_Unitario_Homologado_Minimo'],2) }}</span>
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado máximo</b></td>
                            <td>
                            @isset($infoAvaluo['Construcciones_En_Venta']['Conclusion_Homologacion_Contrucciones_Venta']['Valor_Unitario_Homologado_Maximo'])
                                <span class="grises">{{ number_format($infoAvaluo['Construcciones_En_Venta']['Conclusion_Homologacion_Contrucciones_Venta']['Valor_Unitario_Homologado_Maximo'],2) }}</span>
                            @endisset
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <table class="tabla_gris_valor">
                    <thead>
                        <tr>
                            <th>VALOR UNITARIO APLICABLE AL AVALUO:</th>
                            <th>
                            @isset($infoAvaluo['Construcciones_En_Venta']['Valor_Unitario_Aplicable_Avaluo'])
                                <span class="grises">${{ number_format($infoAvaluo['Construcciones_En_Venta']['Valor_Unitario_Aplicable_Avaluo'],2) }}</span>
                            @endisset
                            </th>
                        </tr>
                    </thead> 
                </table>
                
                <table class="tabla_gris_valor">
                    <thead>
                        <tr>
                            <th>VALOR DE MERCADO DEL INMUEBLE:</th>
                            <th>
                            @isset($infoAvaluo['Construcciones_En_Venta']['Valor_Mercado_Del_Inmueble'])
                                <span class="grises">${{ number_format($infoAvaluo['Construcciones_En_Venta']['Valor_Mercado_Del_Inmueble'],2) }}</span>
                            @endisset
                            </th>
                        </tr>
                    </thead> 
                </table>

                <h4 style="margin-top: 4%;">CONTRUCCIONES EN RENTA</h4>
                <hr>
                <br>
                <p><b>Investigación productos comparables</b></p>
                <br>

                @if(isset($infoAvaluo['Construcciones_En_Renta']['Investigacion_Productos_Comparables']['TablaUno']))
                    <table class="tabla_cabeza_gris">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Ubicación</th>
                                <th>Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $iCR_Uno = 1;
                        @endphp
                        @if(isset($infoAvaluo['Construcciones_En_Renta']['Investigacion_Productos_Comparables']['TablaUno'][0]))
                            @foreach($infoAvaluo['Construcciones_En_Renta']['Investigacion_Productos_Comparables']['TablaUno'] as $valueCR_tablaUno)
                                <tr>
                                    <td><span class="grises">{{ $iCR_Uno++ }}</span></td>
                                    <td>
                                    @isset($valueCR_tablaUno['Ubicacion'])
                                        <span class="grises">{{ $valueCR_tablaUno['Ubicacion'] }}</span>
                                    @endisset                                
                                    </td>
                                    <td>
                                    @isset($valueCR_tablaUno['Descripcion'])
                                        <span class="grises">{{ $valueCR_tablaUno['Descripcion'] }}</span>
                                    @endisset                                
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>
                                @isset($infoAvaluo['Construcciones_En_Renta']['Investigacion_Productos_Comparables']['TablaUno'])
                                    <span class="grises">1</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Construcciones_En_Renta']['Investigacion_Productos_Comparables']['TablaUno']['Ubicacion'])
                                    <span class="grises">{{ $infoAvaluo['Construcciones_En_Renta']['Investigacion_Productos_Comparables']['TablaUno']['Ubicacion'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Construcciones_En_Renta']['Investigacion_Productos_Comparables']['TablaUno']['Descripcion'])
                                    <span class="grises">{{ $infoAvaluo['Construcciones_En_Renta']['Investigacion_Productos_Comparables']['TablaUno']['Descripcion'] }}</span>
                                @endisset
                                </td>
                            </tr>
                        @endisset
                        </tbody>
                    </table>
                @endif
                <br>


                <!-- TABLA DOS -->
                @if(isset($infoAvaluo['Construcciones_En_Renta']['Investigacion_Productos_Comparables']['TablaDos']))
                    <table class="tabla_cabeza_gris">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>F. Negociación</th>
                                <th>Superficie vendible</th>
                                <th>Precio solicitado</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $iCR_Dos = 1;
                        @endphp
                        @if(isset($infoAvaluo['Construcciones_En_Renta']['Investigacion_Productos_Comparables']['TablaDos'][0]))
                            @foreach($infoAvaluo['Construcciones_En_Renta']['Investigacion_Productos_Comparables']['TablaDos'] as $valueCR_tablaDos)
                                <tr>
                                    <td><span class="grises">{{ $iCR_Dos++ }}</span></td>
                                    <td>
                                    @isset($valueCR_tablaDos['F_Negociacion'])
                                        <span class="grises">{{ number_format($valueCR_tablaDos['F_Negociacion'],2) }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($valueCR_tablaDos['Superficie_Vendible'])
                                        <span class="grises">{{ $valueCR_tablaDos['Superficie_Vendible'] }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($valueCR_tablaDos['Precio_Solicitado'])
                                        $<span class="grises">{{ number_format($valueCR_tablaDos['Precio_Solicitado'],2) }}</span>
                                    @endisset
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>
                                @isset($infoAvaluo['Construcciones_En_Renta']['Investigacion_Productos_Comparables']['TablaDos'])                                
                                    <span class="grises">1</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Construcciones_En_Renta']['Investigacion_Productos_Comparables']['TablaDos']['F_Negociacion'])                                
                                <span class="grises">{{ number_format($infoAvaluo['Construcciones_En_Renta']['Investigacion_Productos_Comparables']['TablaDos']['F_Negociacion'],2) }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Construcciones_En_Renta']['Investigacion_Productos_Comparables']['TablaDos']['Superficie_Vendible'])                                
                                <span class="grises">{{ $infoAvaluo['Construcciones_En_Renta']['Investigacion_Productos_Comparables']['TablaDos']['Superficie_Vendible'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Construcciones_En_Renta']['Investigacion_Productos_Comparables']['TablaDos']['Precio_Solicitado'])                                
                                    <span class="grises">${{ number_format($infoAvaluo['Construcciones_En_Renta']['Investigacion_Productos_Comparables']['TablaDos']['Precio_Solicitado'],2) }}</span>
                                @endisset
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                @endif
                <br>

                <table>
                    <thead>
                        <tr>
                            <th>Conclusiones homologación construcciones en renta</th>
                            <th>  </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>Valor unitario promedio</b></td>
                            <td>
                            @isset($infoAvaluo['Construcciones_En_Renta']['Conclusion_Homologacion_Contrucciones_Renta']['Valor_Unitario_Promedio'])
                                <span class="grises">{{ $infoAvaluo['Construcciones_En_Renta']['Conclusion_Homologacion_Contrucciones_Renta']['Valor_Unitario_Promedio'] }}
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado</b></td>
                            <td>
                            @isset($infoAvaluo['Construcciones_En_Renta']['Conclusion_Homologacion_Contrucciones_Renta']['Valor_Unitario_Homologado'])
                                <span class="grises">{{ $infoAvaluo['Construcciones_En_Renta']['Conclusion_Homologacion_Contrucciones_Renta']['Valor_Unitario_Homologado'] }}
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario sin homologar mínimo</b></td>
                            <td>
                            @isset($infoAvaluo['Construcciones_En_Renta']['Conclusion_Homologacion_Contrucciones_Renta']['Valor_Unitario_Sin_Homolgar_Minimo'])
                                <span class="grises">{{ $infoAvaluo['Construcciones_En_Renta']['Conclusion_Homologacion_Contrucciones_Renta']['Valor_Unitario_Sin_Homolgar_Minimo'] }}</span>
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario sin homologar máximo</b></td>
                            <td>
                            @isset($infoAvaluo['Construcciones_En_Renta']['Conclusion_Homologacion_Contrucciones_Renta']['Valor_Unitario_Sin_Homolgar_Maximo'])
                                <span class="grises">{{ $infoAvaluo['Construcciones_En_Renta']['Conclusion_Homologacion_Contrucciones_Renta']['Valor_Unitario_Sin_Homolgar_Maximo'] }}</span>
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado mínimo</b></td>
                            <td>
                            @isset($infoAvaluo['Construcciones_En_Renta']['Conclusion_Homologacion_Contrucciones_Renta']['Valor_Unitario_Homologado_Minimo'])
                                <span class="grises">{{ $infoAvaluo['Construcciones_En_Renta']['Conclusion_Homologacion_Contrucciones_Renta']['Valor_Unitario_Homologado_Minimo'] }}</span>
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado máximo</b></td>
                            <td>
                            @isset($infoAvaluo['Construcciones_En_Renta']['Conclusion_Homologacion_Contrucciones_Renta']['Valor_Unitario_Homologado_Maximo'])
                                <span class="grises">{{ $infoAvaluo['Construcciones_En_Renta']['Conclusion_Homologacion_Contrucciones_Renta']['Valor_Unitario_Homologado_Maximo'] }}</span>
                            @endisset
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="tabla_gris_valor">
                    <thead>
                        <tr>
                            <th>VALOR UNITARIO APLICABLE AL AVALUO:</th>
                            <th>
                            @isset($infoAvaluo['Construcciones_En_Renta']['Valor_Unitario_Aplicable_Avaluo'])
                                ${{ number_format($infoAvaluo['Construcciones_En_Renta']['Valor_Unitario_Aplicable_Avaluo'],2) }}</span>
                            @endisset
                            </th>
                        </tr>
                    </thead> 
                </table>
                

                <!-- 8.- Índice Físico o Directo -->
                <div class="pleca_verde"><b>VIII.- ÍNDICE FÍSICO O DIRECTO</b></div>
                <p><b>a) CÁLCULO DEL VALOR DEL TERRENO</b></p>

                @if(isset($infoAvaluo['Calculo_Del_Valor_Del_Terreno']))
                    <table class="tabla_cabeza_gris">
                        <thead>
                            <tr>
                                <th>Fracc.</th>
                                <th>Área de valor</th>
                                <th>Superficie (m2)</th>
                                <th>Fzo</th>
                                <th>Fub</th>
                                <th>FFr</th>
                                <th>Ffo</th>
                                <th>Fsu</th>
                                <th>Fot</th>
                                <th>F. Resultante</th>
                                <th>VALOR FRACCIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(isset($infoAvaluo['Calculo_Del_Valor_Del_Terreno'][0]))
                            @foreach($infoAvaluo['Calculo_Del_Valor_Del_Terreno'] as $value_valorTerreno)
                                <tr>
                                    <td>
                                    @isset($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Fracc'])
                                        <span class="grises">{{ $infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Fracc'] }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Clave_Area_Valor'])
                                        <span class="grises">{{ $infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Clave_Area_Valor'] }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Superficie_m2'])
                                        <span class="grises">{{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Superficie_m2'],2) }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Fzo'])
                                        <span class="grises">{{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Fzo'],2) }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Fub'])
                                        <span class="grises">{{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Fub'],2) }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['FFr'])
                                        <span class="grises">{{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['FFr'],2) }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Ffo'])
                                        <span class="grises">{{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Ffo'],2) }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Fsu'])
                                        <span class="grises">{{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Fsu'],2) }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Fot'])
                                        <span class="grises">{{ $infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Fot'] }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['F_Resultante'])
                                        <span class="grises">{{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['F_Resultante'],2) }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Valor_Fraccion'])
                                        <span class="grises">{{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Valor_Fraccion'],2) }}</span>
                                    @endisset
                                    </td>
                                </tr>
                            @endforeach                            
                        @else
                            <tr>
                                <td>
                                @isset($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Fracc'])
                                    <span class="grises">{{ $infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Fracc'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Clave_Area_Valor'])
                                    <span class="grises">{{ $infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Clave_Area_Valor'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Superficie_m2'])
                                    <span class="grises">{{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Superficie_m2'],2) }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Fzo'])
                                    <span class="grises">{{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Fzo'],2) }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Fub'])
                                    <span class="grises">{{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Fub'],2) }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['FFr'])
                                    <span class="grises">{{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['FFr'],2) }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Ffo'])
                                    <span class="grises">{{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Ffo'],2) }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Fsu'])
                                    <span class="grises">{{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Fsu'],2) }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Fot'])
                                    <span class="grises">{{ $infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Fot'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['F_Resultante'])
                                    <span class="grises">{{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['F_Resultante'],2) }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Valor_Fraccion'])
                                    <span class="grises">{{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Valor_Fraccion'],2) }}</span>
                                @endisset
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <br>
                    <p><b>Total superficie:<span class="grises">{{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Totales']['Total_Superficie'],2) }}</span> '           'Valor del terreno total:<span class="grises">{{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Totales']['Valor_Del_Terreno_Total'],2) }}</span> </b></p>
                    <br>
                    <p>Indiviso de la unidad que se valua:<span class="grises">{{ $infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Totales']['Indiviso_Unidad_Que_Se_Valua'] }}</span> %</p>
                @endif

                <table class="tabla_gris_valor">
                    <thead>
                        <tr>
                            <th>VALOR TOTAL DEL TERRENO PROPORCIONAL:</th>
                            <th><span class="grises">${{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Totales']['Valor_Total_Del_Terreno_Proporcional'],2) }}</span></th>
                        </tr>
                    </thead> 
                </table>
                
                <p><b>b) CÁLCULO DEL VALOR DE LAS CONTRUCCIONES</b></p>

                <!-- PRIVATIVAS -->
                @if(isset($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']))
                    <p><b>PRIVATIVAS: </b></p>
                    <table class="tabla_cabeza_gris">
                        <thead>
                            <tr>
                                <th>Fracc.</th>
                                <th>Descripción</th>
                                <th>Uso</th>
                                <th>Clase</th>
                                <th>Superficie (m2)</th>
                                <th>Valor unitario</th>
                                <th>Edad</th>
                                <th>Fco</th>
                                <th>FRe</th>
                                <th>VALOR FRACCIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(isset($infoAvaluo['Calculo_Valor_Construcciones']['Privativas'][0]))
                            @foreach($infoAvaluo['Calculo_Valor_Construcciones']['Privativas'] as $value_valorContruccionesP)
                            <tr>
                                    <td>
                                    @isset($value_valorContruccionesP['Fracc'])
                                    <span class="grises">  {{ $value_valorContruccionesP['Fracc'] }}
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorContruccionesP['Descripcion'])
                                    <span class="grises">  {{ $value_valorContruccionesP['Descripcion'] }}
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorContruccionesP['Uso'])
                                    <span class="grises">  {{ $value_valorContruccionesP['Uso'] }}
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorContruccionesP['Clase'])
                                    <span class="grises">  {{ $value_valorContruccionesP['Clase'] }}
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorContruccionesP['Superficie_m2'])
                                    <span class="grises">  {{ number_format($value_valorContruccionesP['Superficie_m2'],2) }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorContruccionesP['Valor_Unitario'])
                                    <span class="grises">  {{ number_format($value_valorContruccionesP['Valor_Unitario'],2) }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorContruccionesP['Edad'])
                                    <span class="grises">  {{ number_format($value_valorContruccionesP['Edad'],2) }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorContruccionesP['Fco'])
                                    <span class="grises">  {{ number_format($value_valorContruccionesP['Fco'],2) }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorContruccionesP['FRe'])
                                    <span class="grises">  {{ number_format($value_valorContruccionesP['FRe'],2) }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorContruccionesP['Valor_Fraccion'])
                                        <span class="grises">$ {{ number_format($value_valorContruccionesP['Valor_Fraccion'],2) }}</span>
                                    @endisset
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Fracc'])
                                <span class="grises">  {{ $infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Fracc'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Descripcion'])
                                <span class="grises">  {{ $infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Descripcion'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Uso'])
                                <span class="grises">  {{ $infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Uso'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Clase'])
                                <span class="grises">  {{ $infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Clase'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Superficie_m2'])
                                <span class="grises">  {{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Superficie_m2'],2) }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Valor_Unitario'])
                                <span class="grises">  {{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Valor_Unitario'],2) }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Edad'])
                                <span class="grises">  {{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Edad'],2) }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Fco'])
                                <span class="grises">  {{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Fco'],2) }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['FRe'])
                                <span class="grises">  {{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['FRe'],2) }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Valor_Fraccion'])
                                    <span class="grises">$ {{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Valor_Fraccion'],2) }}</span>
                                @endisset
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
    
                    <p>Total superficie: 
                    @isset($infoAvaluo['Calculo_Valor_Construcciones']['Totales_Privativas']['Total_Superficie'])
                    <span class="grises"> {{ $infoAvaluo['Calculo_Valor_Construcciones']['Totales_Privativas']['Total_Superficie'] }}</span>
                    @endisset
                    Total construcciones privativas: 
                    @isset($infoAvaluo['Calculo_Valor_Construcciones']['Totales_Privativas']['Total_Construcciones_Privativas'])
                        <span class="grises">${{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Totales_Privativas']['Total_Construcciones_Privativas'],2) }}</span></p>
                    @endisset
                    <br>
                @endif


                <!-- COMUNES -->
                @if(isset($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']))
                    <p><b>COMUNES: </b></p>
                    <table class="tabla_cabeza_gris">
                        <thead>
                            <tr>
                                <th>Fracc.</th>
                                <th>Descripción</th>
                                <th>Uso</th>
                                <th>Clase</th>
                                <th>Superficie (m2)</th>
                                <th>Valor unitario</th>
                                <th>Edad</th>
                                <th>Fco</th>
                                <th>FRe</th>
                                <th>Indiviso</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(isset($infoAvaluo['Calculo_Valor_Construcciones']['Comunes'][0]))
                            @foreach($infoAvaluo['Calculo_Valor_Construcciones']['Comunes'] as $value_valorConstruccionesC)
                                <tr>
                                    <td>
                                    @isset($value_valorConstruccionesC['Fracc'])
                                        <span class="grises">{{ $value_valorConstruccionesC['Fracc'] }}</span>                                @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorConstruccionesC['Descripcion'])
                                        <span class="grises">{{ $value_valorConstruccionesC['Descripcion'] }}</span>                                @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorConstruccionesC['Uso'])
                                        <span class="grises">{{ $value_valorConstruccionesC['Uso'] }}</span>                                @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorConstruccionesC['Superficie_m2'])
                                        <span class="grises">{{ number_format($value_valorConstruccionesC['Superficie_m2'],2) }}</span>                                @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorConstruccionesC['Valor_Unitario'])
                                        <span class="grises">{{ number_format($value_valorConstruccionesC['Valor_Unitario'],2) }}</span>                                @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorConstruccionesC['Edad'])
                                        <span class="grises">{{ number_format($value_valorConstruccionesC['Edad'],2) }}</span>                                @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorConstruccionesC['Fco'])
                                        <span class="grises">{{ number_format($value_valorConstruccionesC['Fco'],2) }}</span>                                @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorConstruccionesC['FRe'])
                                        <span class="grises">{{ number_format($value_valorConstruccionesC['FRe'],2) }}</span>                                @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorConstruccionesC['Valor_Fraccion'])
                                        <span class="grises">{{ number_format($value_valorConstruccionesC['Valor_Fraccion'],2) }}</span>                                @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorConstruccionesC['Indiviso'])
                                        <span class="grises">{{ $value_valorConstruccionesC['Indiviso'] }}%</span>
                                    @endisset
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Fracc'])
                                    <span class="grises">{{ $infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Fracc'] }}</span>                            @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Descripcion'])
                                    <span class="grises">{{ $infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Descripcion'] }}</span>                            @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Uso'])
                                    <span class="grises">{{ $infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Uso'] }}</span>                            @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Superficie_m2'])
                                    <span class="grises">{{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Superficie_m2'],2) }}</span>                            @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Valor_Unitario'])
                                    <span class="grises">{{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Valor_Unitario'],2) }}</span>                            @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Edad'])
                                    <span class="grises">{{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Edad'],2) }}</span>                            @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Fco'])
                                    <span class="grises">{{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Fco'],2) }}</span>                            @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['FRe'])
                                    <span class="grises">{{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['FRe'],2) }}</span>                            @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Valor_Fraccion'])
                                    <span class="grises">{{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Valor_Fraccion'],2) }}</span>                            @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Indiviso'])
                                    <span class="grises">{{ $infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Indiviso'] }}%</span>
                                @endisset
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <p>Total superficie: 
                    @isset($infoAvaluo['Calculo_Valor_Construcciones']['Totales_Comunes']['Total_Superficie'])
                    <span class="grises">  {{ $infoAvaluo['Calculo_Valor_Construcciones']['Totales_Comunes']['Total_Superficie'] }}</span>
                    @endisset
                    Total construcciones comunes: 
                    @isset($infoAvaluo['Calculo_Valor_Construcciones']['Totales_Comunes']['Total_Construcciones_Comunes'])
                        <span class="grises">$ {{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Totales_Comunes']['Total_Construcciones_Comunes'],2) }}</span></p>
                    @endisset
                @endif


                <table class="tabla_gris_valor">
                    <thead>
                        <tr>
                            <th>VALOR TOTAL DE LAS CONTRUCCIONES:</th>
                            <th>
                            @isset($infoAvaluo['Calculo_Valor_Construcciones']['Totales_Comunes']['Valor_Total_De_Las_Construcciones'])
                                <span class="grises">$ {{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Totales_Comunes']['Valor_Total_De_Las_Construcciones'],2) }}</span>
                            @endisset
                            </th>
                        </tr>
                    </thead> 
                </table>
                
                <p><b>c) DE LAS INSTALACIONES ESPECIALES, OBRAS COMPLEMENTARIOAS Y ELEMENTOS ACCESORIOS</b></p>
                <br>
                <p><b>PRIVATIVAS:</b></p>

                <!-- PRIVATIVAS -->
                @if(isset($infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Privativas']))
                    <table class="tabla_cabeza_gris">
                        <thead>
                            <tr>
                                <th> </th>
                                <th>Clave</th>
                                <th>Concepto</th>
                                <th>Cantidad</th>
                                <th>Valor unitario</th>
                                <th>Edad</th>
                                <th>Importe</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(isset($infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Privativas'][0]))
                            @foreach($infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Privativas'] as $valueEA_tablaPri)
                                <tr>
                                    <td>
                                    @isset($valueEA_tablaPri['0'])
                                        <span class="grises">{{ $valueEA_tablaPri['0'] }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($valueEA_tablaPri['Clave'])
                                        <span class="grises">{{ $valueEA_tablaPri['Clave'] }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($valueEA_tablaPri['Concepto'])
                                        <span class="grises">{{ $valueEA_tablaPri['Concepto'] }}</span> 
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($valueEA_tablaPri['Cantidad'])
                                        <span class="grises">{{ number_format($valueEA_tablaPri['Cantidad'],2) }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($valueEA_tablaPri['Valor_Unitario'])
                                        <span class="grises">{{ number_format($valueEA_tablaPri['Valor_Unitario'],2) }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($valueEA_tablaPri['Edad'])
                                        <span class="grises">{{ $valueEA_tablaPri['Edad'] }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($valueEA_tablaPri['Importe'])
                                        $ <span class="grises">{{ number_format($valueEA_tablaPri['Importe'],2) }}</span>
                                    @endisset
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>
                                @isset($infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Privativas']['0'])
                                    <span class="grises">{{ $infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Privativas']['0'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Privativas']['Clave'])
                                    <span class="grises">{{ $infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Privativas']['Clave'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Privativas']['Concepto'])
                                    <span class="grises">{{ $infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Privativas']['Concepto'] }}</span> 
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Privativas']['Cantidad'])
                                    <span class="grises">{{ number_format($infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Privativas']['Cantidad'],2) }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Privativas']['Valor_Unitario'])
                                    <span class="grises">{{ number_format($infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Privativas']['Valor_Unitario'],2) }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Privativas']['Edad'])
                                    <span class="grises">{{ $infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Privativas']['Edad'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Privativas']['Importe'])
                                    <span class="grises">$ {{ number_format($infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Privativas']['Importe'],2) }}</span>
                                @endisset
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <br>
                    <p><b>Total de las instalaciones privativas:</b> 
                    @isset($infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Totales']['Total_De_Las_Instalaciones'])
                        <span class="grises">$ {{ number_format($infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Totales']['Total_De_Las_Instalaciones'],2) }}</span>
                    @endisset
                    </p>
                    <br>
                @endif



                <p><b>COMUNES: </b></p>
                <!-- <table class="tabla_cabeza_gris">
                    <thead>
                        <tr>
                            <th>Fracc.</th>
                            <th>Descripción</th>
                            <th>Uso</th>
                            <th>Clase</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                        </tr>
                    </tbody>
                </table> -->
                <br>
                <p>Indiviso de la unidad que se Valua: 
                @isset($infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Totales']['Indiviso_Unidad_Que_Se_Valua'])
                    <span class="grises">{{ number_format($infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Totales']['Indiviso_Unidad_Que_Se_Valua'],2) }}%</spn>
                @endisset
                </p>

                <table class="tabla_gris_valor">
                    <thead>
                        <tr>
                            <th>TOTAL DE LAS INSTALACIONES:</th>
                            <th>
                            @isset($infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Totales']['Total_De_Las_Instalaciones'])
                                <span class="grises">${{ number_format($infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Totales']['Total_De_Las_Instalaciones'],2) }}</span>
                            @endisset
                            </th>
                        </tr>
                    </thead> 
                </table>

                <table class="tabla_gris_valor">
                    <thead>
                        <tr>
                            <th>ÍNDICE FÍSICO DIRECTO (Importe total de enfoque de costos):</th>
                            <th>
                            @isset($infoAvaluo['Indice_Fisico_Directo'])
                                <span class="grises">${{ number_format($infoAvaluo['Indice_Fisico_Directo'],2) }}</span>
                            @endisset
                            </th>
                        </tr>
                    </thead> 
                </table>
               
                
                <!-- 9.- Índice de Capitalización de Rentas -->
                <div class="pleca_verde"><b>IX.- INDICE DE CAPITALIZACIÓN DE RENTAS</b></div>
                <p><b>RENTA ESTIMADA</b></p>

                @if(isset($infoAvaluo['Renta_Estimada']))
                    <table class="tabla_cabeza_gris">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Ubicación</th>
                                <th>Superficie (m2)</th>
                                <th>Renta Mensual</th>
                                <th>Renta por m2</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $i_EA = 1;
                        @endphp
                        @if(isset($infoAvaluo['Renta_Estimada'][0]))
                            @foreach($infoAvaluo['Renta_Estimada'] as $valueEA_tablaPri)
                                <tr>
                                    <td><span class="grises">{{ $i_EA++ }}</span></td>
                                    <td>
                                    @isset($valueEA_tablaPri['Ubicacion'])                                
                                        <span class="grises">{{ $valueEA_tablaPri['Ubicacion'] }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($valueEA_tablaPri['Superficie_m2'])                                
                                        <span class="grises">{{ $valueEA_tablaPri['Superficie_m2'] }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($valueEA_tablaPri['Renta_Mensual'])                                
                                        <span class="grises">$ {{ number_format($valueEA_tablaPri['Renta_Mensual'],2) }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($valueEA_tablaPri['Renta_m2'])                                
                                        <span class="grises">$ {{ number_format($valueEA_tablaPri['Renta_m2'],2) }}</span>
                                    @endisset
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>
                                @isset($infoAvaluo['Renta_Estimada'])
                                    <span class="grises">1</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Renta_Estimada']['Ubicacion'])
                                <span class="grises"> {{ $infoAvaluo['Renta_Estimada']['Ubicacion'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Renta_Estimada']['Superficie_m2'])
                                <span class="grises"> {{ $infoAvaluo['Renta_Estimada']['Superficie_m2'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Renta_Estimada']['Renta_Mensual'])
                                    <span class="grises">${{ number_format($infoAvaluo['Renta_Estimada']['Renta_Mensual'],2) }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Renta_Estimada']['Renta_m2'])
                                    <span class="grises">${{ number_format($infoAvaluo['Renta_Estimada']['Renta_m2'],2) }}</span>
                                @endisset
                                </td>
                            </tr>
                        @endisset
                        </tbody>
                    </table>
                @endif
                <br>
                <p><b>ANÁLISIS DE DEDUCCIONES:</b></p>

                <table style="border-collapse: collapse; width: 100%; margin-bottom: 2%;">
                    <tr>
                        <td>
                            <table class="tabla_doble">
                                <thead>
                                    <tr>
                                        <th>Concepto</th>
                                        <th>Monto ($)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>a) Vacíos:</td>
                                        <td>
                                        @isset($infoAvaluo['Analisis_Deducciones']['Vacios'])
                                            <span class="grises">${{ number_format($infoAvaluo['Analisis_Deducciones']['Vacios'],2) }}</span>
                                        @endisset
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>b) Impuesto predial:</td>
                                        <td>
                                        @isset($infoAvaluo['Analisis_Deducciones']['Impuesto_Predial'])
                                            <span class="grises">${{ number_format($infoAvaluo['Analisis_Deducciones']['Impuesto_Predial'],2) }}</span>
                                        @endisset
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>c) Servicio de agua:</td>
                                        <td>
                                        @isset($infoAvaluo['Analisis_Deducciones']['Servicio_Agua'])
                                            <span class="grises">${{ number_format($infoAvaluo['Analisis_Deducciones']['Servicio_Agua'],2) }}</span>
                                        @endisset
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>d) Conserv. y mant.:</td>
                                        <td>
                                        @isset($infoAvaluo['Analisis_Deducciones']['Conserv_Mant'])
                                            <span class="grises">${{ number_format($infoAvaluo['Analisis_Deducciones']['Conserv_Mant'],2) }}</span>
                                        @endisset
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>e) Administración:</td>
                                        <td>
                                        @isset($infoAvaluo['Analisis_Deducciones']['Administracion'])
                                            <span class="grises">${{ number_format($infoAvaluo['Analisis_Deducciones']['Administracion'],2) }}</span>
                                        @endisset
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>f) Energía eléctrica:</td>
                                        <td>
                                        @isset($infoAvaluo['Analisis_Deducciones']['Energia_Electrica'])
                                            <span class="grises">${{ number_format($infoAvaluo['Analisis_Deducciones']['Energia_Electrica'],2) }}</span>
                                        @endisset
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <table class="tabla_doble">
                                <thead>
                                    <tr>
                                        <th>Concepto</th>
                                        <th>Monto ($)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>g) Seguros:</td>
                                        <td>
                                        @isset($infoAvaluo['Analisis_Deducciones']['Seguros'])
                                            <span class="grises">${{ number_format($infoAvaluo['Analisis_Deducciones']['Seguros'],2) }}</span>
                                        @endisset
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>h) Otros:</td>
                                        <td>
                                        @isset($infoAvaluo['Analisis_Deducciones']['Otros'])
                                            <span class="grises">${{ number_format($infoAvaluo['Analisis_Deducciones']['Otros'],2) }}</span>
                                        @endisset
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>i) Depreciación Fiscal:</td>
                                        <td>
                                        @isset($infoAvaluo['Analisis_Deducciones']['Depreciacion_Fiscal'])
                                            <span class="grises">${{ number_format($infoAvaluo['Analisis_Deducciones']['Depreciacion_Fiscal'],2) }}</span>
                                        @endisset
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>j) Deducc. Fiscales:</td>
                                        <td>
                                        @isset($infoAvaluo['Analisis_Deducciones']['Deducc_Fiscales'])
                                            <span class="grises">${{ number_format($infoAvaluo['Analisis_Deducciones']['Deducc_Fiscales'],2) }}</span>
                                        @endisset
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>k) I.S.R.</td>
                                        <td>
                                        @isset($infoAvaluo['Analisis_Deducciones']['ISR'])
                                            <span class="grises">${{ number_format($infoAvaluo['Analisis_Deducciones']['ISR'],2) }}</span>
                                        @endisset
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><b>SUMA:</b></td>
                                        <td><b>
                                        @isset($infoAvaluo['Analisis_Deducciones']['Totales']['Suma'])
                                            <span class="grises">$ {{ number_format($infoAvaluo['Analisis_Deducciones']['Totales']['Suma'],2) }}</span>
                                        @endisset
                                        </b>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </td>
                    </tr>
                </table>
                
                <table style="border-collapse: collapse; width: 100%;">
                    <tbody>
                        <tr>
                            <td><b>DEDUCCIONES MENSUALES:</b></td>
                            <td>
                            @isset($infoAvaluo['Analisis_Deducciones']['Totales']['Deducciones_Mensuales'])
                                <span class="grises">${{ number_format($infoAvaluo['Analisis_Deducciones']['Totales']['Deducciones_Mensuales'],2) }}</span>
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>PRODUCTO LIQUIDO MENSUAL:</b></td>
                            <td>
                            @isset($infoAvaluo['Analisis_Deducciones']['Totales']['Producto_Liquido_Mensual'])
                                <span class="grises">${{ number_format($infoAvaluo['Analisis_Deducciones']['Totales']['Producto_Liquido_Mensual'],2) }}</span>
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>PRODUCTO LIQUIDO ANUAL:</b></td>
                            <td>
                            @isset($infoAvaluo['Analisis_Deducciones']['Totales']['Producto_Liquido_Anual'])
                                <span class="grises">${{ number_format($infoAvaluo['Analisis_Deducciones']['Totales']['Producto_Liquido_Anual'],2) }}</span>
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>TASA DE CAPITALIZACIÓN APLICALE:</b></td>
                            <td>
                            @isset($infoAvaluo['Analisis_Deducciones']['Totales']['Tasa_Capitalizacion_Aplicable'])
                                <span class="grises">{{ number_format($infoAvaluo['Analisis_Deducciones']['Totales']['Tasa_Capitalizacion_Aplicable'],2) }}%</span>
                            @endisset
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p><span>La tasa de capitalización aplicable aquí referida deberá ser justificada en el apartado de consideracinoes propias.</span></p>

                <table class="tabla_gris_valor">
                    <thead>
                        <tr>
                            <th>RESULTADO DE LA APLICACIÓN DEL ENFOQUE DE INGRESOS (VALOR POR CAPITALIZACIÓN DE RENTAS):</th>
                            <th>
                            @isset($infoAvaluo['Resultado_Aplicacion_Enfoque_Ingresos'])                                
                                <span class="grises">${{ number_format($infoAvaluo['Resultado_Aplicacion_Enfoque_Ingresos'],2) }}</span>
                            @endisset
                            </th>
                        </tr>
                    </thead> 
                </table>
                
                
                <!-- 10.- Resumen de Valores -->
                <div class="pleca_verde"><b>X.- RESUMEN DE VALORES</b></div>

                <table class="tabla_gris_valor">
                    <thead>
                        <tr>
                            <th>ÍNDICE FÍSICO DIRECTO:</th>
                            <th>
                            @isset($infoAvaluo['Resultado_Aplicacion_Enfoque_Ingresos'])
                                <span class="grises">${{ number_format($infoAvaluo['Indice_Fisico_Directo'],2) }}</span>
                            @endisset
                            </th>
                        </tr>
                    </thead> 
                </table>

                <table class="tabla_gris_valor">
                    <thead>
                        <tr>
                            <th>VALOR POR CAPITALIZACIÓN DE RENTAS:</th>
                            <th>
                            @isset($infoAvaluo['Resultado_Aplicacion_Enfoque_Ingresos'])
                                <span class="grises">${{ number_format($infoAvaluo['Valor_Capitalizacion_Rentas'],2) }}</span>
                            @endisset
                            </th>
                        </tr>
                    </thead> 
                </table>

                <table class="tabla_gris_valor">
                    <thead>
                        <tr>
                            <th>VALOR DE MERCADO DE LAS CONSTRUCCIONES:</th>
                            <th>
                            @isset($infoAvaluo['Resultado_Aplicacion_Enfoque_Ingresos'])
                                <span class="grises">${{ number_format($infoAvaluo['Valor_Mercado_Construcciones'],2) }}</span>
                            @endisset
                            </th>
                        </tr>
                    </thead> 
                </table>

                <!-- 11.- Consideraciones Previas a la Conclusión -->
                <div class="pleca_verde"><b>XI.- CONSIDERACIONES PREVIAS A LA CONCLUSIÓN</b></div>

                    <p class="letras_pequenas">
                        <!-- PARA LOS EFECTOS DEL "MANUAL DE PROCEDIMIENTOS Y LINEAMIENTOS TÉCNICOS DE VALUACIÓN INMOBILIARIA, PUBLICADO POR LA SECRETARÍA DE FINANZAS EN LA
                        GACETA OFICIAL DEL DISTRITO FEDERAL DE FECHA 06 DE DICIEMBRE DE 2013 CON EL NÚMERO VI.<br><br>
                        <u>AVALÚO COMERCIAL:</u> EL DICTAMEN TÉCNICO PRACTICADO POR PERSONA AUTORIZADA O REGISTRADA ANTE LA AUTORIDAD FISCAL, QUE PERMITE ESTIMAR EL VALOR
                        COMERCIAL DE UN BIEN INMUEBLE, CON BASE EN SU USO, CARACTERÍSTICAS FÍSICAS, ADEMÁS DE LAS CARACTERÍSTICAS URBANAS DE LA ZONA DONDE SE UBICA, ASÍ COMO
                        LA INVESTIGACIÓN, ANÁLISIS Y PONDERACIÓN DEL MERCADO INMOBILIARIO, Y QUE CONTENIDO EN UN DOCUMENTO O ARCHIVO ELECTRÓNICO QUE REÚNA LOS REQUISITOS
                        MÍNIMOS DE FORMA Y CONTENIDO ESTABLECIDOS EN EL PRESENTE MANUAL, SIRVE COMO BASE PARA DETERMINAR ALGUNA DE LAS CONTRIBUCIONES ESTABLECIDAS EN EL
                        CÓDIGO.<br><br>
                        <u>AVALÚO CATASTRAL:</u> EL DICTAMEN TÉCNICO PRACTICADO POR PERSONA AUTORIZADA O REGISTRADA ANTE LA AUTORIDAD FISCAL, QUE SIRVE PARA APOYAR AL
                        CONTRIBUYENTE PARA SOLICITAR LA MODIFICACIÓN DE DATOS CATASTRALES Y PERMITE DETERMINAR EL VALOR CATASTRAL DE UN BIEN INMUEBLE CON BASE EN SUS
                        CARACTERÍSTICAS FÍSICAS (USO, TIPO, CLASE, EDAD, INSTALACIONES ESPECIALES, OBRAS COMPLEMENTARIAS Y ELEMENTOS ACCESORIOS) APLICANDO LOS VALORES
                        UNITARIOS DE SUELO Y CONSTRUCCIONES QUE LA ASAMBLEA LEGISLATIVA DEL D.F. EMITE EN EL CÓDIGO FISCAL QUE APLIQUE.”<br><br>
                        EL PRESENTE AVALÚO ES DE USO EXCLUSIVO DEL(OS) SOLICITANTE(S) PARA EL DESTINO O PROPÓSITO EXPRESADO EN LA HOJA 1, CAPÍTULO I, POR LO QUE NO PODRÁ SER
                        UTILIZADO PARA FINES DISTINTOS.<br><br>
                        LA VIGENCIA DEL PRESENTE DOCUMENTO ESTARÁ DETERMINADA POR SU PROPÓSITO O DESTINO Y DEPENDERÁ BÁSICAMENTE DE LA TEMPORALIDAD QUE ESTABLEZCA EN SU
                        CASO LA INSTITUCIÓN EMISORA DEL AVALÚO, LA AUTORIDAD COMPETENTE Ó LOS FACTORES EXTERNOS QUE INFLUYEN EN EL VALOR COMERCIAL.<br><br>
                        LA EDAD CONSIDERADA EN EL PRESENTE AVALÚO CORRESPONDE A LA "APARENTE" O "ESTIMADA" POR EL PERITO VALUADOR EN RAZÓN DE LA OBSERVACIÓN DIRECTA DE LOS
                        ACABADOS Y ESTADO DE CONSERVACIÓN, POR LO QUE NO ES NECESARIAMENTE LA EDAD CRONOLÓGICA PRECISA DEL INMUEBLE.<br><br>
                        EL FACTOR DE DEMÉRITO APLICADO PARA LAS CONSTRUCCIONES EN EL ENFOQUE DE COSTOS, INCLUYE TANTO LA DEPRECIACIÓN POR EDAD COMO POR EL ESTADO DE
                        CONSERVACIÓN.<br><br>
                        SE ANALIZARON LOS VALORES OBTENIDOS EN EL PRESENTE AVALÚO Y EN FUNCIÓN DE LOS FACTORES DE COMERCIALIZACIÓN Y A LAS CONDICIONES QUE ACTUALMENTE
                        PREVALECEN EN EL MERCADO INMOBILIARIO DE ESTA ZONA DE LA CIUDAD, SE LLEGA A LAS SIGUIENTES CONCLUSIONES.<br><br>
                        CONSIDERACIONES:<br><br> -->
                        @isset($infoAvaluo['Consideraciones'])
                            <span class="grises">{{ $infoAvaluo['Consideraciones'] }}</span>
                        @endisset
                    </p>

                
                <!-- 12.- Conclusiones sobre el Valor Comercial -->
                <div class="pleca_verde"><b>XII.- CONCLUSIONES SOBRE EL VALOR COMERCIAL</b></div>
                <table class="tabla_gris_valor">
                    <thead>
                        <tr>
                            <th>CONSIDERAMOS QUE EL VALOR COMERCIAL CORRESPONDE A:</th>
                            <th>
                            @isset($infoAvaluo['Consideramos_Que_Valor_Comercial_Corresponde'])
                                <span class="grises">${{ number_format($infoAvaluo['Consideramos_Que_Valor_Comercial_Corresponde'],2) }}</span>
                            @endisset
                            </th>
                        </tr>
                    </thead> 
                </table>
                <br>
                <p><span>Esta cantidad estimamos que representa el valor comercial del inmueble al día:</span></p>
                <table class="tabla_gris_valor_no_bold">
                    <thead>
                        <tr>
                            <th>VALOR REFERIDO: 
                            @isset($infoAvaluo['Valor_Referido']['Valor_Referido'])
                                <span class="grises">${{ number_format($infoAvaluo['Valor_Referido']['Valor_Referido'],2)}}</span>
                            @endisset
                            </th>
                            <th>FECHA: 
                            @isset($infoAvaluo['Valor_Referido']['Fecha'])
                                <span class="grises">{{ $infoAvaluo['Valor_Referido']['Fecha'] }}</span>
                            @endisset
                            </th>
                            <th>FACTOR:
                            @isset($infoAvaluo['Valor_Referido']['Factor'])
                                <span class="grises">{{ $infoAvaluo['Valor_Referido']['Factor']}}</span>
                            @endisset
                            </th>
                        </tr>
                    </thead>
                </table>
                <br>
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="border-top: 2px solid #000;">Perito valuador:
                            @isset($infoAvaluo['Perito_Valuador'])
                                <span class="grises">{{ $infoAvaluo['Perito_Valuador'] }}</span>
                            @endisset
                            </th>
                            <th style="width: 5%;"></th>
                            <th style="border-top: 2px solid #000;">Registro T.D.F.:</th>
                        </tr>
                    </thead>
                </table>
                <br>
                <div style="background-color: #5d6d7e; color: #fff; border: 0px; text-align: right; margin: 2% 0 2% 0;"><b>ANEXO FOTOGRÁFICO SUJETO</b></div>
                <br>
                <p><b>INMUEBLE OBJETO DE ESTE AVALÚO</b></p>
                <table style="width: 100%" style="border-collapse: separate; border-spacing: 10px 5px;">
                    @isset($infoAvaluo['Inmueble_Objeto_Avaluo'])
                        @foreach($infoAvaluo['Inmueble_Objeto_Avaluo'] as $value_inmuebleOA)
                            @if($loop->iteration & 1)
                                <tr>
                                    <td style="width: 50%; text-align:center">
                                        <div class="card">
                                            <img src="data:image/png;base64,{{$value_inmuebleOA['Foto']}}" style="width: 100%;" />
                                            <div class="container2">
                                                Cuenta: <span class="grises">{{ $value_inmuebleOA['Cuenta_Catastral'] }}</span> '        ' @if($value_inmuebleOA['Interior_O_Exterior'] == 'E') Exterior @else Interior @endif 
                                            </div>
                                        </div>
                                    </td>
                                @if(count($infoAvaluo['Inmueble_Objeto_Avaluo']) < 2)
                                    <td style="width: 50%!important; text-align:center">
                                    </td>
                                @endif
                            @else
                                    <td style="width: 50%; text-align:center">
                                        <div class="card">
                                            <img src="data:image/png;base64,{{$value_inmuebleOA['Foto']}}" style="width: 100%;" />
                                            <div class="container2">
                                                Cuenta: <span class="grises">{{ $value_inmuebleOA['Cuenta_Catastral'] }}</span> '        ' @if($value_inmuebleOA['Interior_O_Exterior'] == 'E') Exterior @else Interior @endif 
                                            </div>
                                        </div>
                                    </td>
                                @if(count($infoAvaluo['Inmueble_Objeto_Avaluo']) < 2)
                                    <td style="width: 50%!important; text-align:center">
                                    </td>
                                @endif
                                </tr>
                            @endif
                        @endforeach
                    @endisset
                </table>
                <br>
                <div style="background-color: #5d6d7e; color: #fff; border: 0px; text-align: right; margin: 2% 0 2% 0;"><b>ANEXO FOTOGRÁFICO COMPARABLES</b></div>
                <p><b>INMUEBLES EN VENTA</b></p>
                <br><br><br>
                <table style="width: 100%" style="border-collapse: separate; border-spacing: 10px 5px; margin-top: 5%;">
                @isset($infoAvaluo['Inmueble_Venta'])    
                    @foreach($infoAvaluo['Inmueble_Venta'] as $value_inmuebleEV)
                        @if($loop->iteration & 1)
                            <tr>
                                <td style="width: 50%; text-align:center">
                                    <div class="card">
                                        <img src="data:image/png;base64,{{$value_inmuebleEV['Foto']}}" style="width: 100%;" />
                                        <div class="container2">
                                            Cuenta: <span class="grises">{{ $value_inmuebleEV['Cuenta_Catastral'] }}</span> '        ' @if($value_inmuebleEV['Interior_O_Exterior'] == 'E') Exterior @else Interior @endif 
                                        </div>
                                    </div>
                                </td>
                                @if(count($infoAvaluo['Inmueble_Venta']) < 2)
                                    <td style="width: 50%!important; text-align:center">
                                    </td>
                                @endif
                        @else
                                <td style="width: 50%; text-align:center">
                                    <div class="card">
                                        <img src="data:image/png;base64,{{$value_inmuebleEV['Foto']}}" style="width: 100%;" />
                                        <div class="container2">
                                            Cuenta: <span class="grises">{{ $value_inmuebleEV['Cuenta_Catastral'] }}</span> '        ' @if($value_inmuebleEV['Interior_O_Exterior'] == 'E') Exterior @else Interior @endif 
                                        </div>
                                    </div>
                                </td>
                                @if(count($infoAvaluo['Inmueble_Venta']) < 2)
                                    <td style="width: 50%!important; text-align:center">
                                    </td>
                                @endif
                            </tr>
                        @endif
                    @endforeach
                @endisset
                </table>
                <br>
                <p><b>INMUEBLES EN RENTA</b></p>
                <br>
                <table style="width: 100%" style="border-collapse: separate; border-spacing: 10px 5px; margin-top: 5%;">
                @isset($infoAvaluo['Inmueble_Renta'])    
                    @foreach($infoAvaluo['Inmueble_Renta'] as $value_inmuebleR)
                        @if($loop->iteration & 1)
                            <tr>
                                <td style="width: 50%; text-align:center">
                                    <div class="card">
                                        <img src="data:image/png;base64,{{$value_inmuebleR['Foto']}}" style="width: 320px;" />
                                        <div class="container2">
                                            Cuenta: <span class="grises">{{ $value_inmuebleR['Cuenta_Catastral'] }}</span> '        ' @if($value_inmuebleR['Interior_O_Exterior'] == 'E') Exterior @else Interior @endif 
                                        </div>
                                    </div>
                                </td>
                                @if(count($infoAvaluo['Inmueble_Renta']) < 2)
                                    <td style="width: 50%!important; text-align:center">
                                    </td>
                                @endif
                        @else
                                <td style="width: 50%; text-align:center">
                                    <div class="card">
                                        <img src="data:image/png;base64,{{$value_inmuebleR['Foto']}}" style="width: 320px;" />
                                        <div class="container2">
                                            Cuenta: <span class="grises">{{ $value_inmuebleR['Cuenta_Catastral'] }}</span> '        ' @if($value_inmuebleR['Interior_O_Exterior'] == 'E') Exterior @else Interior @endif 
                                        </div>
                                    </div>
                                </td>
                                @if(count($infoAvaluo['Inmueble_Renta']) < 2)
                                    <td style="width: 50%!important; text-align:center">
                                    </td>
                                @endif
                            </tr>
                        @endif
                    @endforeach
                @endisset
                </table>
            </div>
        </div> 
        <!-- Fin de CONTENIDO -->

    </body>

</html>