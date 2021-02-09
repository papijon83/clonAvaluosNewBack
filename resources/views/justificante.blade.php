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
                            <td style="width: 50%;"></td>
                            <td><b>Fecha:</b></td>
                            <td class="grises">
                                @isset($infoAvaluo['Encabezado']['Fecha'])
                                    {{$infoAvaluo['Encabezado']['Fecha']}}
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><b>Avaluo:</b></td>
                            <td class="grises">
                                @isset($infoAvaluo['Encabezado']['Avaluo_No'])
                                    {{$infoAvaluo['Encabezado']['Avaluo_No']}}
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><b>No. Único:</b></td>
                            <td class="grises">
                                @isset($infoAvaluo['Encabezado']['No_Unico'])
                                    {{$infoAvaluo['Encabezado']['No_Unico']}}
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td></td>
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
                                Delegación: 
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
                                            <b>Delegación:</b><br>
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
                                <span class="grises">${{$infoAvaluo['Superficie_Total_Segun']['Totales']['Superficie_Total_Terreno']}}</span>
                            @endisset                        
                            </b>
                        </div>


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


                    <h4 style="margin-top: 4%;">CONSTRUCCIONES PRIVATIVAS</h4>
                    @if(isset($infoAvaluo['Construcciones_Privativas']))
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
                                            <span class="grises">{{$i_construccionesP++}}</span>
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

                    <h4 style="margin-top: 4%;">CONSTRUCCIONES COMUNES</h4>
                    @if(isset($infoAvaluo['Construcciones_Comunes']))
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
                                            <span class="grises">{{$i_construccionesC++}}</span>
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
                    <br>
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
                        <span><b>Privativas</b></span>
                        @if(isset($infoAvaluo['Instalaciones_Especiales']['Privativas']))
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
                        <span><b>Comunes</b></span>
                        @if(isset($infoAvaluo['Instalaciones_Especiales']['Comunes']))
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
                        <span><b>Privativas</b></span>
                        @if(isset($infoAvaluo['Elementos_Accesorios']['Privativas']))
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
                        <span><b>Privativas</b></span>
                        @if(isset($infoAvaluo['Obras_Complementarias']['Privativas']))
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
                @if(isset($infoAvaluo['Consideraciones_Previas_Al_Avaluo']))
                <p class="letras_pequenas">
                    @isset($infoAvaluo['Consideraciones_Previas_Al_Avaluo'])
                        <span class="grises">{{$infoAvaluo['Consideraciones_Previas_Al_Avaluo']}}</span>
                    @endisset
                </p>
                @endif


                <br>
                <!-- 7.- Comparación de Mercado -->
                <div class="pleca_verde">VII. COMPARACIÓN DE MERCADO</div>
                <h4 style="margin-top: 4%;">TERRENOS DIRECTOS</h4>
                @if(isset($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaUno']) || isset($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaDos']))
                    <h4 style="margin-top: 4%;">TERRENOS</h4>
                    <hr>
                    <!-- TABLA UNO TERRENOS DIRECTOS -->
                    <span><b>Investigación productos comparables</b></span>
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
                                        <td><span class="grises">{{$i_tUno++}}</td></span>
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
                                    <td><span class="grises">{{ $i_tDos++ }}</td></span>
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
                                    $ <span class="grises">{{ number_format($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaDos']['Precio_Solicitado'],2) }}</span>
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
                @endif
                <br>
                <!-- RESIDUALES -->
                
                
                @if(isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Tipo_Producto_Inmoviliario_Propuesto'])
                    || @isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Numero_Unidades_Vendibles'])
                    || @isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Superficie_Vendible_Unidad']))
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
                @endif
                
                @if(isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Investigacion_Productos_Comparables']))
                    <table class="tabla_cabeza_gris" style="">
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
                                        1
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

                <!-- Tabla dos -->
                @if(isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Investigacion_Productos_Comparables_2']))
                    <table class="tabla_cabeza_gris" style="">
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
                                            <span class="grises">{{$iTR_2++}}</span>
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
                                        1
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
                    <br>
                @endif
                
                @if(isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Investigacion_Productos_Comparables'])
                    || isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Investigacion_Productos_Comparables_2'][0]))
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
                @endif
                <!-- Tabla Análisis residual -->
                @if(isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Analisis_Residual']['Total_Ingresos'])
                    || @isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Analisis_Residual']['Total_Egresos'])
                    || @isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Analisis_Residual']['Unidad_Propuesta'])
                    || @isset($infoAvaluo['Terrenos']['Terrenos_Residuales']['Analisis_Residual']['Valor_Unitario_Tierra_Residual']))
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
                                <td><b>Valor unitario de tierra residual</b></td>
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
                                    <span class="grises">{{ $infoAvaluo['Terrenos']['Valor_Unitario_Tierra_Del_Avaluo'] }}</span>
                                @endisset
                                </th>
                            </tr>
                        </thead> 
                    </table>
                @endif

                
                @if(isset($infoAvaluo['Construcciones_En_Venta']['Investigacion_Productos_Comparables']['TablaUno'])
                    || isset($infoAvaluo['Construcciones_En_Venta']['Investigacion_Productos_Comparables']['TablaDos']))
                    <h4 style="margin-top: 4%;">CONSTRUCCIONES EN VENTA</h4>
                    <hr>
                    <p>Investigación productos comparables</p>
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
                                    1
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
                                    <td><span class="grises">{{ $iC_Dos++ }}</td></span>
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
                                        <span class="grises">${{ number_format($valueC_tablaDos['Precio_Solicitado'],2) }}</span>
                                    @endisset
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>
                                @isset($infoAvaluo['Construcciones_En_Venta']['Investigacion_Productos_Comparables']['TablaDos'])
                                    1
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
                @endif
                
                <!-- CONSTRUCCIONES EN RENTA -->
                @if(isset($infoAvaluo['Construcciones_En_Renta']['Investigacion_Productos_Comparables']['TablaUno'])
                    || isset($infoAvaluo['Construcciones_En_Renta']['Investigacion_Productos_Comparables']['TablaDos'][0]))
                    <h4 style="margin-top: 4%;">CONTRUCCIONES EN RENTA</h4>
                    <hr>
                    <br>
                    <p><b>Investigación productos comparables</b></p>
                    <br>
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
                                    <td>{{ $iCR_Uno++ }}</td>
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
                                    1
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
                    <br>
                    <!-- TABLA DOS -->
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
                                    <td><span class="grises">{{ $iCR_Dos++ }}</td></span>
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
                                        <span class="grises">${{ number_format($valueCR_tablaDos['Precio_Solicitado'],2) }}</span>
                                    @endisset
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>
                                @isset($infoAvaluo['Construcciones_En_Renta']['Investigacion_Productos_Comparables']['TablaDos'])                                
                                    1
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
                                    <span class="grises">{{ $infoAvaluo['Construcciones_En_Renta']['Conclusion_Homologacion_Contrucciones_Renta']['Valor_Unitario_Promedio'] }}</span>
                                @endisset
                                </td>
                            </tr>
                            <tr>
                                <td><b>Valor unitario homologado</b></td>
                                <td>
                                @isset($infoAvaluo['Construcciones_En_Renta']['Conclusion_Homologacion_Contrucciones_Renta']['Valor_Unitario_Homologado'])
                                    <span class="grises">{{ $infoAvaluo['Construcciones_En_Renta']['Conclusion_Homologacion_Contrucciones_Renta']['Valor_Unitario_Homologado'] }}</span>
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
                                    <span class="grises">${{ number_format($infoAvaluo['Construcciones_En_Renta']['Valor_Unitario_Aplicable_Avaluo'],2) }}</span>
                                @endisset
                                </th>
                            </tr>
                        </thead> 
                    </table>
                @endif

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
                    <p><b>Total superficie: <span class="grises">{{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Totales']['Total_Superficie'],2) }}</span> '           'Valor del terreno total: <span class="grises">{{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Totales']['Valor_Del_Terreno_Total'],2) }}</span> </b></p>
                    <br>
                    <p>Indiviso de la unidad que se valua: <span class="grises">{{ $infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Totales']['Indiviso_Unidad_Que_Se_Valua'] }}</span> %</p>

                    <table class="tabla_gris_valor">
                        <thead>
                            <tr>
                                <th>VALOR TOTAL DEL TERRENO PROPORCIONAL:</th>
                                <th><span class="grises">${{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Totales']['Valor_Total_Del_Terreno_Proporcional'],2) }}</span></th>
                            </tr>
                        </thead> 
                    </table>
                @endif

                <p><b>b) CÁLCULO DEL VALOR DE LAS CONTRUCCIONES</b></p>
                <!-- PRIVATIVAS -->
                @if(isset($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']))
                    <p><b>PRIVATIVAS: </b></p>
                    <table class="tabla_cabeza_gris">
                        <thead>
                            <tr>
                                <th>Tipo.</th>
                                <th>Descripción</th>
                                <th>Uso</th>
                                <th>N° Niveles Del Tipo</th>
                                <th>Clave Rango De Niveles</th>
                                <th>Clase</th>
                                <th>Valor Unitario Cat.</th>
                                <th>Depreciación por Edad</th>
                                <th>Valor</th>
                                <th>Sup.</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(isset($infoAvaluo['Calculo_Valor_Construcciones']['Privativas'][0]))
                            @foreach($infoAvaluo['Calculo_Valor_Construcciones']['Privativas'] as $value_valorContruccionesP)
                            <tr>
                                    <td>
                                    @isset($value_valorContruccionesP['Tipo'])
                                        <span class="grises">{{ $value_valorContruccionesP['Tipo'] }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorContruccionesP['Descripcion'])
                                        <span class="grises">{{ $value_valorContruccionesP['Descripcion'] }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorContruccionesP['Uso'])
                                        <span class="grises">{{ $value_valorContruccionesP['Uso'] }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorContruccionesP['Numero_Niveles_Tipo'])
                                        <span class="grises">{{ $value_valorContruccionesP['Numero_Niveles_Tipo'] }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorContruccionesP['Clave_Rango_Niveles'])
                                        <span class="grises">{{ $value_valorContruccionesP['Clave_Rango_Niveles'] }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorContruccionesP['Clase'])
                                        <span class="grises">{{ $value_valorContruccionesP['Clase'] }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorContruccionesP['Valor_Unitario'])
                                        <span class="grises">{{ number_format($value_valorContruccionesP['Valor_Unitario'],2) }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorContruccionesP['Depreciacion_Por_Edad'])
                                        <span class="grises">{{ number_format($value_valorContruccionesP['Depreciacion_Por_Edad'],2) }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorContruccionesP['Valor'])
                                        <span class="grises">{{ number_format($value_valorContruccionesP['Valor'],2) }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorContruccionesP['Sup'])
                                        <span class="grises">{{ number_format($value_valorContruccionesP['Sup'],2) }}</span>
                                    @endisset
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Tipo'])
                                    <span class="grises">{{ $infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Tipo'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Descripcion'])
                                    <span class="grises">{{ $infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Descripcion'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Uso'])
                                    <span class="grises">{{ $infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Uso'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Numero_Niveles_Tipo'])
                                    <span class="grises">{{ $infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Numero_Niveles_Tipo'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Clave_Rango_Niveles'])
                                    <span class="grises">{{ $infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Clave_Rango_Niveles'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Clase'])
                                    <span class="grises">{{ $infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Clase'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Valor_Unitario'])
                                    <span class="grises">{{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Valor_Unitario'],2) }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Depreciacion_Por_Edad'])
                                    <span class="grises">{{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Depreciacion_Por_Edad'],2) }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Valor'])
                                    <span class="grises">{{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Valor'],2) }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Sup'])
                                    <span class="grises">{{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Sup'],2) }}</span>
                                @endisset
                                </td>
                            </tr>
                        @endif
                            <tr>
                                <td colspan="10" style="text-align: right; padding-right: 10px;">
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Totales_Privativas']['Total_Superficie'])
                                    SUPERFICIE TOTAL DE LAS CONSTRUCCIONES PRIVATIVAS: <span class="grises">{{ $infoAvaluo['Calculo_Valor_Construcciones']['Totales_Privativas']['Total_Superficie'] }}</span>
                                @endisset
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="tabla_gris_valor">
                        <thead>
                            <tr>
                                <th>VALOR TOTAL DE LAS CONSTRUCCIONES PRIVATIVAS:</th>
                                <th>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Totales_Privativas']['Total_Construcciones_Privativas'])
                                    <span class="grises">${{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Totales_Privativas']['Total_Construcciones_Privativas'],2) }}</span>
                                @endisset
                                </th>
                            </tr>
                        </thead> 
                    </table>
                <br>
                @endif

                <!-- COMUNES -->
                @if(isset($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']) && !empty($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']))
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
                                        <span class="grises">{{ $value_valorConstruccionesC['Fracc'] }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorConstruccionesC['Descripcion'])
                                        <span class="grises">{{ $value_valorConstruccionesC['Descripcion'] }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorConstruccionesC['Uso'])
                                        <span class="grises">{{ $value_valorConstruccionesC['Uso'] }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorConstruccionesC['Superficie_m2'])
                                        <span class="grises">{{ number_format($value_valorConstruccionesC['Superficie_m2'],2) }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorConstruccionesC['Valor_Unitario'])
                                        <span class="grises">{{ number_format($value_valorConstruccionesC['Valor_Unitario'],2) }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorConstruccionesC['Edad'])
                                        <span class="grises">{{ number_format($value_valorConstruccionesC['Edad'],2) }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorConstruccionesC['Fco'])
                                        <span class="grises">{{ number_format($value_valorConstruccionesC['Fco'],2) }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorConstruccionesC['FRe'])
                                        <span class="grises">{{ number_format($value_valorConstruccionesC['FRe'],2) }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_valorConstruccionesC['Valor_Fraccion'])
                                        <span class="grises">{{ number_format($value_valorConstruccionesC['Valor_Fraccion'],2) }}</span>
                                    @endisset
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
                                    <span class="grises">{{ $infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Fracc'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Descripcion'])
                                    <span class="grises">{{ $infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Descripcion'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Uso'])
                                    <span class="grises">{{ $infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Uso'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Superficie_m2'])
                                    <span class="grises">{{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Superficie_m2'],2) }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Valor_Unitario'])
                                    <span class="grises">{{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Valor_Unitario'],2) }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Edad'])
                                    <span class="grises">{{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Edad'],2) }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Fco'])
                                    <span class="grises">{{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Fco'],2) }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['FRe'])
                                    <span class="grises">{{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['FRe'],2) }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Valor_Fraccion'])
                                    <span class="grises">{{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Valor_Fraccion'],2) }}</span>
                                @endisset
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
                        <span class="grises">{{ $infoAvaluo['Calculo_Valor_Construcciones']['Totales_Comunes']['Total_Superficie'] }}</span>
                    @endisset
                    Total construcciones comunes: 
                    @isset($infoAvaluo['Calculo_Valor_Construcciones']['Totales_Comunes']['Total_Construcciones_Comunes'])
                        <span class="grises">$ {{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Totales_Comunes']['Total_Construcciones_Comunes'],2) }}</span></p>
                    @endisset
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
                @endif
                
                <p><b>c) CÁLCULO DEL VALOR DE LAS CONSTRUCCIONES COMUNES</b></p>
                <br>
                @if(isset($infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Privativas']))
                    <p><b>PRIVATIVAS:</b></p>
                    <!-- PRIVATIVAS -->
                    <table class="tabla_cabeza_gris">
                        <thead>
                            <tr>
                                <th> </th>
                                <th>Clave</th>
                                <th>Concepto</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(isset($infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Privativas'][0]))
                            @foreach($infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Privativas'] as $value_obrasCEA)
                                <tr>
                                    <td>
                                    @isset($value_obrasCEA['0'])
                                        <span class="grises">{{ $value_obrasCEA['0'] }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_obrasCEA['Clave'])
                                        <span class="grises">{{ $value_obrasCEA['Clave'] }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_obrasCEA['Concepto'])
                                        <span class="grises">{{ $value_obrasCEA['Concepto'] }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($value_obrasCEA['Cantidad'])
                                        <span class="grises">{{ $value_obrasCEA['Cantidad'] }}</span>
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
                                    <span class="grises">{{ $infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Privativas']['Cantidad'] }}</span>
                                @endisset
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <br>
                    <p><b>Total de las instalaciones privativas:</b> 
                    @isset($infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Totales']['Total_De_Las_Instalaciones'])
                        <span class="grises">${{ number_format($infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Totales']['Total_De_Las_Instalaciones'],2) }}</span>
                    @endisset
                    </p>
                    <br>
                @endif

                @if(isset($infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Comunes']))
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
                    <table class="tabla_gris_valor">
                        <thead>
                            <tr>
                                <th>VALOR TOTAL DE LAS CONSTRUCCIONES COMUNES:</th>
                                <th>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Totales_Comunes']['Total_Construcciones_Comunes'])
                                    <span class="grises">${{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Totales_Comunes']['Total_Construcciones_Comunes'],2) }}</span>
                                @endisset
                                </th>
                            </tr>
                        </thead> 
                    </table>
                    <table class="tabla_gris_valor">
                        <thead>
                            <tr>
                                <th>VALOR TOTAL DE LAS CONSTRUCCIONES COMUNES POR INDIVISO:</th>
                                <th>
                                @isset($infoAvaluo['Calculo_Valor_Construcciones']['Totales_Comunes']['Total_Construcciones_Comunes_Por_Indiviso'])
                                    <span class="grises">${{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Totales_Comunes']['Total_Construcciones_Comunes_Por_Indiviso'],2) }}</span>
                                @endisset
                                </th>
                            </tr>
                        </thead> 
                    </table>
                @endif

                    
                    <table class="tabla_gris_valor">
                        <thead>
                            <tr>
                                <th>IMPORTE INSTALACIONES ESPECIALES, ELEMENTOS ACCESORIOS Y OBRAS COMP.</th>
                                <th>
                                @isset($infoAvaluo['Importe_Instalaciones_Especiales_Elementos_Accesorios_Obras_Comp'])
                                    <span class="grises">$ {{ number_format($infoAvaluo['Importe_Instalaciones_Especiales_Elementos_Accesorios_Obras_Comp'],2) }}</span>
                                @endisset
                                </th>
                            </tr>
                        </thead> 
                    </table>

                    <table class="tabla_gris_valor">
                        <thead>
                            <tr>
                                <th>IMPORTE TOTAL DEL VALOR CATASTRAL:</th>
                                <th>
                                @isset($infoAvaluo['Importe_Total_Valor_Catastral'])
                                    <span class="grises">$ {{ number_format($infoAvaluo['Importe_Total_Valor_Catastral'],2) }}</span>
                                @endisset
                                </th>
                            </tr>
                        </thead> 
                    </table>

                    <table class="tabla_gris_valor">
                        <thead>
                            <tr>
                                <th>AVANCE OBRA:</th>
                                <th>
                                @isset($infoAvaluo['Avance_Obra'])
                                    <span class="grises"> {{ number_format($infoAvaluo['Avance_Obra'],2) }}%</span>
                                @endisset
                                </th>
                            </tr>
                        </thead> 
                    </table>

                    <table class="tabla_gris_valor">
                        <thead>
                            <tr>
                                <th>IMPORTE TOTAL DEL VALOR CATASTRAL OBRA EN PROCESO:</th>
                                <th>
                                @isset($infoAvaluo['Importe_Total_Valor_Catastral_Obra_Proceso'])
                                    <span class="grises">$ {{ number_format($infoAvaluo['Importe_Total_Valor_Catastral_Obra_Proceso'],2) }}</span>
                                @endisset
                                </th>
                            </tr>
                        </thead> 
                    </table>

                <!-- 9.- Índice de Capitalización de Rentas -->
                <div class="pleca_verde"><b>IX.- INDICE DE CAPITALIZACIÓN DE RENTAS</b></div>
                @if(isset($infoAvaluo['Renta_Estimada']))
                    <p><b>RENTA ESTIMADA</b></p>
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
                                    <td><span class="grises">{{ $i_EA++ }}</td></span>
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
                                        <span class="grises">${{ number_format($valueEA_tablaPri['Renta_Mensual'],2) }}</span>
                                    @endisset
                                    </td>
                                    <td>
                                    @isset($valueEA_tablaPri['Renta_m2'])                                
                                        <span class="grises">${{ number_format($valueEA_tablaPri['Renta_m2'],2) }}</span>
                                    @endisset
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>
                                @isset($infoAvaluo['Renta_Estimada'])
                                    1
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Renta_Estimada']['Ubicacion'])
                                    <span class="grises">{{ $infoAvaluo['Renta_Estimada']['Ubicacion'] }}</span>
                                @endisset
                                </td>
                                <td>
                                @isset($infoAvaluo['Renta_Estimada']['Superficie_m2'])
                                    <span class="grises">{{ $infoAvaluo['Renta_Estimada']['Superficie_m2'] }}</span>
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
                    <br>
                @endif

                @if(isset($infoAvaluo['Analisis_Deducciones']['Totales']['Suma']))
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
                                                <span class="grises">${{ number_format($infoAvaluo['Analisis_Deducciones']['Totales']['Suma'],2) }}</span>
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
                                    <span class="grises">$ number_format($infoAvaluo['Resultado_Aplicacion_Enfoque_Ingresos'],2) }}</span>
                                @endisset
                                </th>
                            </tr>
                        </thead> 
                    </table>
                @endif
                
                <!-- 10.- Resumen de Valores -->
                <div class="pleca_verde"><b>X.- RESUMEN DE VALORES</b></div>

                <table class="tabla_gris_valor">
                    <thead>
                        <tr>
                            <th>IMPORTE TOTAL DEL VALOR CATASTRAL:</th>
                            <th>
                            @isset($infoAvaluo['Importe_Total_Valor_Catastral'])
                                <span class="grises">${{ number_format($infoAvaluo['Importe_Total_Valor_Catastral'],2) }}</span>
                            @endisset
                            </th>
                        </tr>
                    </thead> 
                </table>

                <table class="tabla_gris_valor">
                    <thead>
                        <tr>
                            <th>IMPORTE TOTAL DEL VALOR CATASTRAL OBRA EN PROCESO:</th>
                            <th>
                            @isset($infoAvaluo['Importe_Total_Valor_Catastral_Obra_Proceso'])
                                <span class="grises">${{ number_format($infoAvaluo['Importe_Total_Valor_Catastral_Obra_Proceso'],2) }}</span>
                            @endisset
                            </th>
                        </tr>
                    </thead> 
                </table>

                <!-- 11.- Consideraciones Previas a la Conclusión -->
                <div class="pleca_verde"><b>XI.- CONSIDERACIONES PREVIAS A LA CONCLUSIÓN</b></div>

                    <p class="letras_pequenas">
                        @if(isset($infoAvaluo['Consideraciones']))
                            <span class="grises">{{ $infoAvaluo['Consideraciones'] }}</span>
                        @endif
                    </p>

                
                <!-- 12.- Conclusiones sobre el Valor Comercial -->
                <div class="pleca_verde"><b>XII.- CONCLUSIONES SOBRE EL VALOR COMERCIAL</b></div>
                <table class="tabla_gris_valor">
                    <thead>
                        <tr>
                            <th>CONSIDERAMOS QUE EL VALOR CATASTRAL CORRESPONDE A:</th>
                            <th>
                            @isset($infoAvaluo['Consideramos_Que_Valor_Catastral_Corresponde'])
                                <span class="grises">${{ number_format($infoAvaluo['Consideramos_Que_Valor_Catastral_Corresponde'],2) }}</span>
                            @endisset
                            </th>
                        </tr>
                    </thead> 
                </table>
                <br>
                <!-- <p><span>Esta cantidad estimamos que representa el valor comercial del inmueble al día:</span></p>
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
                </table> -->
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
                                                Cuenta: <span class="grises">{{ $value_inmuebleOA['Cuenta_Catastral'] }} '        ' @if($value_inmuebleOA['Interior_O_Exterior'] == 'E') Exterior @else Interior @endif </span>
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
                                                Cuenta: <span class="grises">{{ $value_inmuebleOA['Cuenta_Catastral'] }} '        ' @if($value_inmuebleOA['Interior_O_Exterior'] == 'E') Exterior @else Interior @endif </span>
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
                                            Cuenta: <span class="grises">{{ $value_inmuebleEV['Cuenta_Catastral'] }} '        ' @if($value_inmuebleEV['Interior_O_Exterior'] == 'E') Exterior @else Interior @endif </span>
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
                                            Cuenta: <span class="grises">{{ $value_inmuebleEV['Cuenta_Catastral'] }} '        ' @if($value_inmuebleEV['Interior_O_Exterior'] == 'E') Exterior @else Interior @endif </span>
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
                                            Cuenta: <span class="grises">{{ $value_inmuebleR['Cuenta_Catastral'] }} '        ' @if($value_inmuebleR['Interior_O_Exterior'] == 'E') Exterior @else Interior @endif </span>
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
                                            Cuenta: <span class="grises">{{ $value_inmuebleR['Cuenta_Catastral'] }} '        ' @if($value_inmuebleR['Interior_O_Exterior'] == 'E') Exterior @else Interior @endif </span>
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