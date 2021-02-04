<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            @page { margin: 180px 50px; font-family: Arial, Helvetica, sans-serif!important; font-size: 9px;} 
            #header { position: fixed; left: 0px; top: -130px; right: 0px; height: 90px; text-align: center;} 
            #footer { position: fixed; left: 0px; bottom: -130px; right: 0px; height: 40px; text-align: center; } 
            #footer .page:after { content: counter(page, decimal); } 
            .grises{color: #8D8D8D;}
            .negritas{font-weight: bolder;}

            .tabla_cabeza_gris{width: 100%; border-collapse: collapse!important; margin-top: 2%;}
                .tabla_cabeza_gris>thead>tr>th, .tabla_cabeza_gris>tbody>tr>td {border: 1px solid #000; padding: 2px;}
                .tabla_cabeza_gris>thead{background-color: #D3D3D3; font-size: 10px!important;}

            .tabla_gris_valor{width: 100%; margin-top: 2%; margin-bottom: 2%; border-collapse: separate; border-spacing: 10px 5px;}
                .tabla_gris_valor>thead>tr>th{background-color: #D3D3D3; font-size: 10px!important; text-align: right; padding: 4px; font-size: 12px;}

            .tabla_doble{width: 80%; border-collapse: collapse!important;}
                 .tabla_doble>thead>tr>th{border-bottom: 2px solid #000;}
                 .tabla_doble>tfoot>tr>td{border-top: 2px solid #000;}
            
            .centrado{text-align: center;}
            .pleca_verde{background-color: #00A346; color: #fff; border: 0px; text-align: right; margin: 2% 0 2% 0; pading: 5px; font-size: 15px;}
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
                            <td class="grises">{{$infoAvaluo['Encabezado']['Fecha']}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><b>Avaluo:</b></td>
                            <td class="grises">{{$infoAvaluo['Encabezado']['Avaluo_No']}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><b>No. Único:</b></td>
                            <td class="grises">{{$infoAvaluo['Encabezado']['No_Unico']}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><b>Registro T.D.F</b></td>
                            <td class="grises">{{$infoAvaluo['Encabezado']['Registro_TDF']}}</td>
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

                <div style="text-align: right; padding-bottom: 10px;">AVALÚO</div>

                <!-- 1.- ANTECEDENTES -->
                <div class="pleca_verde"><b>I. ANTECEDENTES</b></div>

                    <table style="border-collapse: collapse; width: 100%;">
                        <tr>
                            <td colspan="2">SOCIEDAD QUE PRACTICA EL AVALUO</td>
                        </tr>
                        <tr>
                            <td><b>VALUADOR:</b></td>
                            <td>{{$infoAvaluo['Sociedad_Participa']['Valuador']}}</td>
                        </tr>
                        <tr>
                            <td><b>FECHA DEL AVALÚO:</b></td>
                            <td>{{$infoAvaluo['Sociedad_Participa']['Fecha_del_Avaluo']}}</td>
                        </tr>
                        <tr>
                            <td valign="top"><b>SOLICITANTE:</b></td>
                            <td>
                                Tipo persona: {{$infoAvaluo['Sociedad_Participa']['Solicitante']['Tipo_persona']}} <br>
                                {{$infoAvaluo['Sociedad_Participa']['Solicitante']['Nombre']}} <br>
                                ESCRITURACION - no viene <br>
                                CONOCER EL VALOR COMERCIAL. - no viene <br>
                                UBICACIÓN DEL INMUEBLE: Calle : {{$infoAvaluo['Sociedad_Participa']['Solicitante']['Calle']}} <br>
                                Delegación: {{$infoAvaluo['Sociedad_Participa']['Solicitante']['Delegacion']}} <br>
                                Cuenta agua: - no viene <br>
                                Edificio: - no viene <br>
                                Lote: - no viene <br>
                                Nº Interior : {{$infoAvaluo['Sociedad_Participa']['Solicitante']['No_Interior']}} <br>
                                Colonia: OLIVAR DE LOS PADRES <br>
                                CP : {{$infoAvaluo['Sociedad_Participa']['Solicitante']['CP']}} <br>
                                Nº Exterior: 40 <br>
                                154-139-26-012 4 <br>
                                Condominal <br>
                                SRA. LAILA MATUK MARTÍNEZ Y CORP. <br>
                                Nº Exterior: {{$infoAvaluo['Sociedad_Participa']['Solicitante']['No_Exterior']}} <br>
                                Colonia: {{$infoAvaluo['Sociedad_Participa']['Solicitante']['Colonia']}}
                            </td>
                        </tr>
                        <tr>
                            <td><b>INMUEBLE QUE SE EVALÚA:</b></td>
                            <td>{{$infoAvaluo['Sociedad_Participa']['inmuebleQueSeValua']}}</td>
                        </tr>
                        <tr>
                            <td><b>RÉGIMEN DE PROPIEDAD:</b></td>
                            <td>{{$infoAvaluo['Sociedad_Participa']['regimenDePropiedad']}}</td>
                        </tr>
                        <tr>
                            <td><b>PROPIETARIO DEL INMUEBLE:</b></td>
                            <td>{{$infoAvaluo['Sociedad_Participa']['Propietario']['Nombre']}}</td>
                        </tr>
                        <tr>
                            <td><b>OBJETO DEL AVALÚO:</b></td>
                            <td>{{$infoAvaluo['Sociedad_Participa']['Objeto_Avaluo']}}</td>
                        </tr>
                        <tr>
                            <td><b>PROPÓSITO DEL AVALÚO:</b></td>
                            <td>{{$infoAvaluo['Sociedad_Participa']['Proposito_Avaluo']}}</td>
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
                                            {{$infoAvaluo['Ubicacion_Inmueble']['Calle']}}<br>
                                            {{$infoAvaluo['Ubicacion_Inmueble']['No_Exterior']}}<br>
                                            {{$infoAvaluo['Ubicacion_Inmueble']['No_Interior']}}<br>
                                            {{$infoAvaluo['Ubicacion_Inmueble']['Colonia']}}<br>
                                            {{$infoAvaluo['Ubicacion_Inmueble']['CP']}}<br>
                                            {{$infoAvaluo['Ubicacion_Inmueble']['Delegacion']}}<br>
                                            {{$infoAvaluo['Ubicacion_Inmueble']['Edificio']}}<br>
                                            {{$infoAvaluo['Ubicacion_Inmueble']['Lote']}}<br>
                                            {{$infoAvaluo['Ubicacion_Inmueble']['Cuenta_agua']}}
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
                            <td style="width: 65%;">{{$infoAvaluo['Clasificacion_de_la_zona']}}</td>
                        </tr>
                        <tr>
                            <td><b>ÍNDICE DE SATURACIÓN DE LA ZONA:</b></td>
                            <td>{{$infoAvaluo['Indice_Saturacion_Zona']}}</td>
                        </tr>
                        <tr>
                            <td><b>TIPO DE CONSTRUCCIÓN DOMINANTE:</b></td>
                            <td>{{$infoAvaluo['Tipo_Construccion_Dominante']}}</td>
                        </tr>
                        <tr>
                            <td><b>DENSISAD DE LA POBLACIÓN:</b></td>
                            <td>{{$infoAvaluo['Densidad_Poblacion']}}</td>
                        </tr>
                        <tr>
                            <td><b>NIVEL SOCIOECONÓMICO DE LA ZONA:</b></td>
                            <td>{{$infoAvaluo['Nivel_Socioeconomico_Zona']}}</td>
                        </tr>
                        <tr>
                            <td><b>CONTAMINACIÓN DEL MEDIO AMBIENTE:</b></td>
                            <td>{{$infoAvaluo['Contaminacion_Medio_Ambiente']}}</td>
                        </tr>
                        <tr>
                            <td><b>CLASE GENERAL DE INMUEBLES DE LA ZONA:</b></td>
                            <td>--no viene--</td>
                        </tr>
                        <tr>
                            <td><b>USO DEL SUELO:</b></td>
                            <td>{{$infoAvaluo['Uso_Suelo']}}</td>
                        </tr>
                        <tr>
                            <td><b>ÁREA LIBRE OBLIGATORIA:</b></td>
                            <td>{{$infoAvaluo['Area_Libre_Obligatoria']}}</td>
                        </tr>
                        <tr>
                            <td valign="top"><b>VÍAS DE ACCESO E IMPORTANCIA DE LAS MISMAS:</b></td>
                            <td>{{$infoAvaluo['Vias_Acceso_E_Importancia']}}</td>
                        </tr>
                    </table>


                    <h4 style="margin-top: 4%;">SERVICIOS PÚBLICOS Y EQUIPAMIENTO URBANO:</h4>

                        <table>
                            <tr>
                                <td><b>Red de distribución agua potable:</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Red_Agua_Potable']}}</td>
                            </tr>
                            <tr>
                                <td><b>Red de recolección de aguas residuales:</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Red_Aguas_Residuales']}}</td>
                            </tr>
                            <tr>
                                <td><b>Red de drenaje de aguas pluviales en la calle:</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Red_Drenaje_Aguas_Pluviales_Calle']}}</td>
                            </tr>
                            <tr>
                                <td><b>Red de drenaje de aguas pluviales en la zona:</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Red_Drenaje_Aguas_Pluviales_Zona']}}</td>
                            </tr>
                            <tr>
                                <td><b>Sistema mixto (aguas pluviales y residuales):</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Sistema_Mixto']}}</td>
                            </tr>
                            <tr>
                                <td><b>Suministro eléctrico:</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Suministro_Electrico']}}</td>
                            </tr>
                            <tr>
                                <td><b>Acometida al inmueble:</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Acometida_Inmueble']}}</td>
                            </tr>
                            <tr>
                                <td><b>Alumbrado público:</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Alumbrado_Publico']}}</td>
                            </tr>
                            <tr>
                                <td><b>Vialidades:</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Vialidades']}}</td>
                            </tr>
                            <tr>
                                <td><b>Banquetas:</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Banquetas']}}</td>
                            </tr>
                            <tr>
                                <td><b>Guarniciones:</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Guarniciones']}}</td>
                            </tr>
                            <tr>
                                <td><b>Nivel de infraestructura en la zona (%):</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Nivel_Infraestructura_Zona']}}</td>
                            </tr>
                            <tr>
                                <td><b>Gas natural:</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Gas_Natutral']}}</td>
                            </tr>
                            <tr>
                                <td><b>Teléfonos suministro:</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Telefonos_Suministro']}}</td>
                            </tr>
                            <tr>
                                <td><b>Señalización de vías:</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Senalizacion_Vias']}}</td>
                            </tr>
                            <tr>
                                <td><b>Acometida al inmueble tel.:</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Acometida_Inmueble_Tel']}}</td>
                            </tr>
                            <tr>
                                <td><b>Distancia transporte urbano:</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Distancia_Transporte_Urbano']}}</td>
                            </tr>
                            <tr>
                                <td><b>Frecuencia transporte urbano:</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Frecuencia_Transporte_Urbano']}}</td>
                            </tr>
                            <tr>
                                <td><b>Distancia transporte suburbano:</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Distancia_Transporte_Suburbano']}}</td>
                            </tr>
                            <tr>
                                <td><b>Frecuencia transporte suburbano:</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Frecuencia_Transporte_Suburbano']}}</td>
                            </tr>
                            <tr>
                                <td><b>Vigilancia:</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Vigilancia']}}</td>
                            </tr>
                            <tr>
                                <td><b>Recolección de basura:</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Recoleccion_Basura']}}</td>
                            </tr>
                            <tr>
                                <td><b>Templo:</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Templo']}}</td>
                            </tr>
                            <tr>
                                <td><b>Mercados:</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Mercados']}}</td>
                            </tr>
                            <tr>
                                <td><b>Plazas públicas:</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Plazas_Publicas']}}</td>
                            </tr>
                            <tr>
                                <td><b>Parques y jardines:</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Parques_Jardines']}}</td>
                            </tr>
                            <tr>
                                <td><b>Escuelas:</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Escuelas']}}</td>
                            </tr>
                            <tr>
                                <td><b>Hospitales:</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Hospitales']}}</td>
                            </tr>
                            <tr>
                                <td><b>Bancos:</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Bancos']}}</td>
                            </tr>
                            <tr>
                                <td><b>Estación de transporte:</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Estacion_Transporte']}}</td>
                            </tr>
                            <tr>
                                <td><b>Nivel de equipamiento urbano:</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Nivel_Equipamiento_Urbano']}}</td>
                            </tr>
                            <tr>
                                <td><b>Nomenclatura de calles</b></td>
                                <td>{{$infoAvaluo['Servicios_Publicos_Equipamiento']['Nomenclatura_Calles']}}</td>
                            </tr>
                        </table>


                <!-- 3.- Terreno -->
                <div class="pleca_verde"><b>III. TERRENO</b></div>

                    <div><b>CALLES TRANSVERSALES, LIMÍTROFES Y ORIENTACIÓN:</b></div>
                    <div>{{$infoAvaluo['Calles_Transversales_Limitrofes']}}</div> 

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
                                <td>{{$infoAvaluo['Medidas_Colindancias']['Fuente']}}</td>
                            </tr>
                            <tr>
                                <td><b>Número escritura:</b></td>
                                <td>{{$infoAvaluo['Medidas_Colindancias']['Numero_Escritura']}}</td>
                                <td><b>Número volumen:</b></td>
                                <td>{{$infoAvaluo['Medidas_Colindancias']['Numero_Volumen']}}</td>
                            </tr>
                            <tr>
                                <td><b>Número notaría:</b></td>
                                <td>{{$infoAvaluo['Medidas_Colindancias']['Numero_Notaria']}}</td>
                                <td><b>Nombre de notario:</b></td>
                                <td>{{$infoAvaluo['Medidas_Colindancias']['Nombre_Notario']}}</td>
                            </tr>
                            <tr>
                                <td><b>Entidad federativa:</b></td>
                                <td>{{$infoAvaluo['Medidas_Colindancias']['Entidad_Federativa']}}</td>
                            </tr>
                        </table>


                        <table  class="tabla_cabeza_gris">
                            <thead>
                                <tr>
                                    <th>Orientación</th>
                                    <th>Medida En Metros</th>
                                    <th>Descripción Colindante</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($infoAvaluo['Colindancias'] as $value_colindancias)
                                <tr>
                                    <td>{{$value_colindancias['Orientacion']}}</td>
                                    <td>{{$value_colindancias['MedidaEnMetros']}}</td>
                                    <td>{{$value_colindancias['DescripcionColindante']}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>


                    <h4 style="margin-top: 4%;">SUPERFICIE TOTAL SEGÚN:</h4>

                        <table  class="tabla_cabeza_gris">
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
                                    <td class="centrado">{{$infoAvaluo['Superficie_Total_Segun']['Ident_Fraccion']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Superficie_Total_Segun']['Sup_Fraccion']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Superficie_Total_Segun']['Fzo']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Superficie_Total_Segun']['Fub']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Superficie_Total_Segun']['FFr']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Superficie_Total_Segun']['Ffo']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Superficie_Total_Segun']['Fsu']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Superficie_Total_Segun']['Clave_Area_Valor']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Superficie_Total_Segun']['Valor']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Superficie_Total_Segun']['Descripcion']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Superficie_Total_Segun']['Fre']}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div style="text-align: right;"><b>SUPERFICIE TOTAL TERRENO: ${{$infoAvaluo['Superficie_Total_Segun']['Totales']['Superficie_Total_Terreno']}}</b></div>


                    <h4 style="margin-top: 4%;">TOPOGRAFÍA Y CONFIGURACIÓN:</h4>
                   
                        <table>
                            <tr>
                                <td><b>CARACTERÍSTICAS PANORÁMICAS:</b></td>
                                <td>{{$infoAvaluo['Topografia_Configuracion']['Caracteristicas_Panoramicas']}}</td>
                            </tr>
                            <tr>
                                <td><b>DENSIDAD HABITACIONAL:</b></td>
                                <td>{{$infoAvaluo['Topografia_Configuracion']['Densidad_Habitacional']}}</td>
                            </tr>
                            <tr>
                                <td><b>SERVIDUMBRE O RESTRICCIONES:</b></td>
                                <td>{{$infoAvaluo['Topografia_Configuracion']['Servidumbre_Restricciones']}}</td>
                            </tr>
                        </table>


                <!-- 4.- Descripción General del Inmueble -->
                <div class="pleca_verde"><b>IV.- DESCRIPCIÓN GENERAL DEL INMUEBLE</b></div>

                    <div><b>USO ACTUAL:</b></div>
                    <div>{{$infoAvaluo['Uso_Actual']}}</div>


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
                                <tr>
                                    <td class="centrado">{{$infoAvaluo['Construcciones_Privativas']['Tipo']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Construcciones_Privativas']['Descripcion']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Construcciones_Privativas']['Uso']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Construcciones_Privativas']['No_Niveles_Tipo']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Construcciones_Privativas']['Clave_Rango_Niveles']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Construcciones_Privativas']['Puntaje']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Construcciones_Privativas']['Clase']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Construcciones_Privativas']['Edad']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Construcciones_Privativas']['Vida_Util_Total_Tipo']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Construcciones_Privativas']['Vida_Util_Remanente']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Construcciones_Privativas']['Conservacion']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Construcciones_Privativas']['Sup']}}</td>
                                </tr>
                            </tbody>
                        </table>


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
                                <tr>
                                    <td class="centrado">{{$infoAvaluo['Construcciones_Comunes']['Tipo']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Construcciones_Comunes']['Descripcion']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Construcciones_Comunes']['Uso']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Construcciones_Comunes']['No_Niveles_Tipo']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Construcciones_Comunes']['Clave_Rango_Niveles']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Construcciones_Comunes']['Puntaje']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Construcciones_Comunes']['Clase']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Construcciones_Comunes']['Edad']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Construcciones_Comunes']['Vida_Util_Total_Tipo']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Construcciones_Comunes']['Vida_Util_Remanente']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Construcciones_Comunes']['Conservacion']}}</td>
                                    <td class="centrado">{{$infoAvaluo['Construcciones_Comunes']['Sup']}}</td>
                                </tr>
                            </tbody>
                        </table>

                        <table>
                            <tr>
                                <td><b>INDIVISO</b></td>
                                <td>{{$infoAvaluo['Indiviso']}}%</td>
                            </tr>
                            <tr>
                                <td><b>VIDA ÚTIL PROMEDIO DEL INMUEBLE:</b></td>
                                <td>{{$infoAvaluo['Vida_Util_Promedio_Inmueble']}}</td>
                            </tr>
                            <tr>
                                <td><b>EDAD APROXIMADA DE LA CONSTRUCCIÓN:</b></td>
                                <td>{{$infoAvaluo['Edad_Aproximada_Construccion']}}</td>
                            </tr>
                            <tr>
                                <td><b>VIDA ÚTIL REMANENTE:</b></td>
                                <td>{{$infoAvaluo['Vida_Util_Remanente']}}</td>
                            </tr>
                        </table>


                <!-- 5.- Elementos de la Construcción -->
                <div class="pleca_verde"><b>V.- ELEMENTOS DE LA CONSTRUCCIÓN</b></div>

                    <h4 style="margin-top: 4%;"><b>a) OBRA NEGRA O GRUESA:</b></h4>

                        <table>
                            <tr>
                                <td><b>CIMIENTOS:</b></td>
                                <td>{{$infoAvaluo['Obra_Negra_Gruesa']['Cimientos']}}</td>
                            </tr>
                            <tr>
                                <td><b>ESTRUCTURA:</b></td>
                                <td>{{$infoAvaluo['Obra_Negra_Gruesa']['Estructura']}}</td>
                            </tr>
                            <tr>
                                <td><b>MUROS:</b></td>
                                <td>{{$infoAvaluo['Obra_Negra_Gruesa']['Muros']}}</td>
                            </tr>
                            <tr>
                                <td><b>ENTREPISOS:</b></td>
                                <td>{{$infoAvaluo['Obra_Negra_Gruesa']['Entrepiso']}}</td>
                            </tr>
                            <tr>
                                <td><b>TECHOS:</b></td>
                                <td>{{$infoAvaluo['Obra_Negra_Gruesa']['Techos']}}</td>
                            </tr>
                            <tr>
                                <td><b>AZOTEAS:</b></td>
                                <td>{{$infoAvaluo['Obra_Negra_Gruesa']['Azoteas']}}</td>
                            </tr>
                            <tr>
                                <td><b>BARDAS:</b></td>
                                <td>{{$infoAvaluo['Obra_Negra_Gruesa']['Bardas']}}</td>
                            </tr>
                        </table>


                    <h4 style="margin-top: 4%;"><b>b) REVESTIMIENTOS Y ACABADOS INTERIORES</b></h4>

                        <table>
                            <tr>
                                <td><b>APLANADOS:</b></td>
                                <td>{{$infoAvaluo['Revestimientos_Acabados_Interiores']['Aplanados']}}</td>
                            </tr>
                            <tr>
                                <td><b>PLAFONES:</b></td>
                                <td>{{$infoAvaluo['Revestimientos_Acabados_Interiores']['Plafones']}}</td>
                            </tr>
                            <tr>
                                <td><b>LAMBRINES:</b></td>
                                <td>{{$infoAvaluo['Revestimientos_Acabados_Interiores']['Lambrines']}}</td>
                            </tr>
                            <tr>
                                <td><b>PISOS:</b></td>
                                <td>{{$infoAvaluo['Revestimientos_Acabados_Interiores']['Pisos']}}</td>
                            </tr>
                            <tr>
                                <td><b>ZOCLOS:</b></td>
                                <td>{{$infoAvaluo['Revestimientos_Acabados_Interiores']['Zoclos']}}</td>
                            </tr>
                            <tr>
                                <td><b>ESCALERAS:</b></td>
                                <td>{{$infoAvaluo['Revestimientos_Acabados_Interiores']['Escaleras']}}</td>
                            </tr>
                            <tr>
                                <td><b>PINTURA:</b></td>
                                <td>{{$infoAvaluo['Revestimientos_Acabados_Interiores']['Pintura']}}</td>
                            </tr>
                            <tr>
                                <td><b>RECUBRIMIENTOS ESPECIALES:</b></td>
                                <td>{{$infoAvaluo['Revestimientos_Acabados_Interiores']['Recubrimientos_Especiales']}}</td>
                            </tr>
                        </table>


                    <h4 style="margin-top: 4%;"><b>c) CARPINTERÍA</b></h4>

                        <table>
                            <tr>
                                <td><b>PUERTAS INTERIORES:</b></td>
                                <td>{{$infoAvaluo['Carpinteria']['Puertas_Interiores']}}</td>
                            </tr>
                            <tr>
                                <td><b>GUARDARROPAS:</b></td>
                                <td>{{$infoAvaluo['Carpinteria']['Guardarropas']}}</td>
                            </tr>
                            <tr>
                                <td><b>MUEBLES EMPOTRADOS O FIJOS:</b></td>
                                <td>{{$infoAvaluo['Carpinteria']['Muebles_Empotrados']}}</td>
                            </tr>
                        </table>


                    <h4 style="margin-top: 4%;"><b>d) INSTALACIONES HIDRAULICAS Y SANITARIAS</b></h4>

                        <table>
                            <tr>
                                <td><b>MUEBLES DE BAÑO:</b></td>
                                <td>{{$infoAvaluo['Instalaciones_Hidraulicas_Sanitrias']['Muebles_Banio']}}</td>
                            </tr>
                            <tr>
                                <td><b>RAMALEOS HIDRÁULICOS:</b></td>
                                <td>{{$infoAvaluo['Instalaciones_Hidraulicas_Sanitrias']['Ramaleos_Hidraulicos']}}</td>
                            </tr>
                            <tr>
                                <td><b>RAMALEOS SANITARIOS:</b></td>
                                <td>{{$infoAvaluo['Instalaciones_Hidraulicas_Sanitrias']['Ramaleos_Sanitarios']}}</td>
                            </tr>
                        </table>


                    <table>
                        <tr>
                            <td><b>e) INSTALACIONES ELÉCTRICAS Y ALUMBRADO</b></td>
                            <td>{{$infoAvaluo['Instalaciones_Electricas_Alumbrados']}}</td>
                        </tr>
                    </table>


                    <h4 style="margin-top: 4%;"><b>f) PUERTAS Y VENTANERÍA METÁLICA</b></h4>

                        <table>
                            <tr>
                                <td><b>HERRERÍA:</b></td>
                                <td>{{$infoAvaluo['Puertas_Ventaneria_Metalica']['Herreria']}}</td>
                            </tr>
                            <tr>
                                <td><b>VENTANERÍA:</b></td>
                                <td>{{$infoAvaluo['Puertas_Ventaneria_Metalica']['Ventaneria']}}</td>
                            </tr>
                        </table>


                    <table>
                        <tr>
                            <td><b>g) VIDRIERÍA</b></td>
                            <td>{{$infoAvaluo['Vidrieria']}}</td>
                        </tr>
                    </table>


                    <table>
                        <tr>
                            <td><b>h) CERRAJERÍA</b></td>
                            <td>{{$infoAvaluo['Cerrajeria']}}</td>
                        </tr>
                    </table>


                    <table>
                        <tr>
                            <td><b>i) FACHADAS</b></td>
                            <td>{{$infoAvaluo['Fachadas']}}</td>
                        </tr>
                    </table>


                    <h4 style="margin-top: 4%;"><b>j) INSTALACIONES ESPECIALES</b></h4>


                    <h4 style="margin-top: 4%;"><b>k) ELEMENTOS ACCESORIOS</b></h4>

                    <table class="tabla_cabeza_gris" style="">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="background-color: #FFF; border-top: 1px solid white; border-bottom: 0px; border-left: 1px solid white!important;" valign="top"><br><br>Privativas</th>
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
                                <tr>
                                    <td class="centrado">{{$infoAvaluo['Elementos_Accesorios']['Privativas']['Clave']}}</td>
                                    <td>{{$infoAvaluo['Elementos_Accesorios']['Privativas']['Descripcion']}}</td>
                                    <td>{{$infoAvaluo['Elementos_Accesorios']['Privativas']['Unidad']}}</td>
                                    <td>{{$infoAvaluo['Elementos_Accesorios']['Privativas']['Cantidad']}}</td>
                                    <td>{{$infoAvaluo['Elementos_Accesorios']['Privativas']['Edad']}}</td>
                                    <td>{{$infoAvaluo['Elementos_Accesorios']['Privativas']['Vida_Util_Total']}}</td>
                                    <td>{{$infoAvaluo['Elementos_Accesorios']['Privativas']['Valor_Unitario']}}</td>
                                </tr>
                            </tbody>
                        </table>


                    <h4 style="margin-top: 4%;"><b>l) OBRAS COMPLEMENTARIAS</b></h4>

                    <table class="tabla_cabeza_gris" style="">
                            <thead>
                                <tr>
                                    <th rowspan="3" style="background-color: #FFF; border-top: 1px solid white; border-bottom: 0px; border-left: 1px solid white!important;" valign="top"><br><br>Privativas</th>
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
                                @foreach($infoAvaluo['Obras_Complementarias']['Privativas'] as $value_obras)
                                <tr>
                                    <td class="centrado">{{$value_obras['Clave']}}</td>
                                    <td>{{$value_obras['Descripcion']}}</td>
                                    <td>{{$value_obras['Unidad']}}</td>
                                    <td>{{$value_obras['Cantidad']}}</td>
                                    <td>{{$value_obras['Edad']}}</td>
                                    <td>{{$value_obras['Vida_Util_Total']}}</td>
                                    <td>{{$value_obras['Valor_Unitario']}}</td>
                                </tr>
                                @endforeach   
                            </tbody>
                        </table>


                <!-- 6.- Consideraciones Previas al Avalúo -->
                <div class="pleca_verde"><b>VI.- CONSIDERACIONES PREVIAS AL AVALÚO</b></div>

                <p class="letras_pequenas">
                    CON FUNDAMENTO EN LO ESTABLECIDO EN EL ARTÍCULO 20 DEL MANUAL DE PROCEDIMIENTOS Y LINEAMIENTOS TÉCNICOS DE VALUACIÓN INMOBILIARIA, PUBLICADO EL 06 DE DICIEMBRE DE 2013 EN LA GACETA OFICIAL DEL DISTRITO FEDERAL, DÉCIMA SEXTA ÉPOCA NO. 1749, Y CONSIDERANDO QUE EL INMUEBLE MOTIVO DEL PRESENTE AVALÚO DEBE SER VALUADO EN FUNCIÓN DE LA OFERTA Y DEMANDA DE INMUEBLES SIMILARES OFERTADOS EN EL MERCADO ABIERTO INMOBILIARIO Y A QUE TAMBIÉN DEBERÁ VALUARSE ATENDIENDO AL PRINCIPIO ECONÓMICO DE SUSTITUCIÓN, POR LO QUE DEBERÁ VALUARSE TAMBIÉN EN FUNCIÓN DE SU VALOR DE REPOSICIÓN NETO Y A QUE EXISTEN INMUEBLES SIMILARES OFERTADOS EN EL MERCADO INMOBILIARIO EN VENTA Y RENTA POR LO QUE RESULTA IMPORTANTE CONOCER EL VALOR PRESENTE NETO DE LOS INGRESOS QUE SERÁ CAPAZ DE PRODUCIR.<br><br>

                    ADICIONALMENTE Y PARTIENDO DE QUE LOS TRES ANÁLISIS ARRIBA DESCRITOS SON DISTINTOS A LOS UTILIZADOS POR LA AUTORIDAD FISCAL PARA LA REVISIÓN Y CONSIDERANDO LO ESTABLECIDO EN EL PÁRRAFO III DEL MISMO ARTÍCULO 20 DEL MANUAL DE PROCEDIMIENTOS Y LINEAMIENTOS TÉCNICOS DE VALUACIÓN INMOBILIARIA, PUBLICADO EL 06 DE DICIEMBRE DE 2013 EN LA GACETA OFICIAL DEL DISTRITO FEDERAL, DÉCIMA SEXTA ÉPOCA NO. 1749 SE ANEXA COMO PARTE INTEGRANTE DEL AVALÚO LA SIGUIENTE MEMORIA TÉCNICA.<br><br>

                    I. EXPOSICIÓN DE MOTIVOS:<br><br>

                    a. EL INMUEBLE MOTIVO DEL PRESENTE AVALUÓ DEBE SER VALUADO EN FUNCIÓN DE LA OFERTA Y DEMANDA DE INMUEBLES SIMILARES OFERTADOS EN EL MERCADO ABIERTO INMOBILIARIO.<br>
                    I. MÉTODO COMPARATIVO O ENFOQUE DE MERCADO, ES EL DESARROLLO ANALÍTICO A TRAVÉS DEL CUAL SE OBTIENE UN VALOR QUE RESULTA DE COMPARAR EL BIEN QUE SE VALÚA (SUJETO) CON EL PRECIO OFERTADO BIENES SIMILARES (COMPARABLES), AJUSTADOS POR SUS PRINCIPALES FACTORES DIFERENCIALES (HOMOLOGACIÓN).<br>
                    II. VALOR COMERCIAL O DE MERCADO: ES LA CANTIDAD ESTIMADA DE DINERO CIRCULANTE A CAMBIO DE LA CUAL EL VENDEDOR Y EL COMPRADOR DEL BIEN QUE SE VALÚA, ESTANDO BIEN INFORMADOS Y SIN NINGÚN TIPO DE PRESIÓN O APREMIO, ESTARÍAN DISPUESTOS A ACEPTAR EN EFECTIVO POR SU ENAJENACIÓN, EN UN PERIODO RAZONABLE.<br>
                    III. LOS FACTORES ESPECÍFICOS APLICABLES A ESTA METODOLOGÍA SE DESGLOSAN EN EL SIGUIENTE CAPÍTULO EN EL DESARROLLO DEL MÉTODO.<br><br>

                    b. DEBERÁ VALUARSE ATENDIENDO AL PRINCIPIO ECONÓMICO QUE DICE QUE NINGÚN COMPRADOR PAGARA POR UN BIEN UNA CANTIDAD SUPERIOR A LA QUE LE COSTARÍA REPRODUCIRLO, POR LO QUE DEBERÁ VALUARSE TAMBIÉN EN FUNCIÓN DE SU VALOR DE REPOSICIÓN NETO.<br>
                    i. MÉTODO FÍSICO, DIRECTO O ENFOQUE DE COSTOS, ES EL PROCESO TÉCNICO NECESARIO PARA ESTIMAR EL COSTO DE REPRODUCCIÓN O DE REEMPLAZO DE UN BIEN SIMILAR AL QUE SE VALÚA, AFECTADO POR LA DEPRECIACIÓN ATRIBUIBLE A LOS FACTORES DE EDAD Y ESTADO DE CONSERVACIÓN Y EN SU CASO, LA OBSOLESCENCIA ECONÓMICA, FUNCIONAL Y TECNOLÓGICA DEL BIEN.<br>
                    ii. COSTO DE REPOSICIÓN NUEVO, (V.R.N.): ES EL COSTO DIRECTO ACTUAL DE REPRODUCIR DE MODO EFICIENTE UN DETERMINADO BIEN. PARA EL CASO DE LOS INMUEBLES EN RAZÓN DE SU ESTRUCTURA Y ACABADOS, INCLUYENDO ÚNICAMENTE LOS COSTOS INDIRECTOS PROPIOS DEL CONSTRUCTOR O CONTRATISTA.<br>
                    iii. COSTO NETO DE REPOSICIÓN, (V.N.R.): ES EL QUE RESULTA DE DESCONTAR AL COSTO DE REPOSICIÓN NUEVO (V.R.N.) LOS DEMÉRITOS ATRIBUIBLES A LA DEPRECIACIÓN POR EDAD Y ESTADO DE CONSERVACIÓN Ó SU EQUIVALENTE EN COSTOS DIRECTOS A INCURRIR PARA DEVOLVER A LA CONSTRUCCIÓN SU ESTADO ORIGINAL O NUEVO PARA EL CASO DE LOS INMUEBLES.<br>
                    iv. LOS COSTOS DE REPOSICIÓN FUERON TOMADOS DE LOS PRONTUARIOS Y ADAPTADOS AL CASO EN PARTICULAR.<br><br>

                    c. EXISTEN INMUEBLES SIMILARES OFERTADOS EN EL MERCADO INMOBILIARIO EN RENTA POR LO QUE RESULTA IMPORTANTE CONOCER EL VALOR PRESENTE NETO DE LOS INGRESOS QUE EN EL FUTURO SEA CAPAZ DE GENERAR EL INMUEBLE.<br>
                    i. MÉTODO TRADICIONAL DE CAPITALIZACIÓN DE RENTAS O ENFOQUE DE INGRESOS, ES EL PROCEDIMIENTO MEDIANTE EL CUAL SE ESTIMA EL VALOR PRESENTE O CAPITALIZADO DE LOS INGRESOS NETOS POR RENTAS QUE PRODUCE O ES SUSCEPTIBLE DE PRODUCIR UN INMUEBLE A LA FECHA DEL AVALÚO DURANTE UN LARGO PLAZO (MAYOR A 50 AÑOS) DE MODO CONSTANTE (A PERPETUIDAD), DESCONTADOS POR UNA DETERMINADA TASA DE CAPITALIZACIÓN (REAL) APLICABLE AL CASO EN ESTUDIO.<br>
                    ii. TASA DE CAPITALIZACIÓN (%): ES EL RENDIMIENTO PORCENTUAL NETO ANUAL O TASA DE DESCUENTO REAL QUE LE SERÍA EXIGIBLE A UN DETERMINADO GÉNERO DE INMUEBLES, CLASIFICADOS EN RAZÓN DE SU USO, ESTO ES, A SU NIVEL DE RIESGO (PLAZO DE RETORNO DE LA INVERSIÓN) Y GRADO DE LIQUIDEZ OBTENIDA MEDIANTE LA COMPARACIÓN DE INMUEBLES COMPARABLES CON EL OBJETO DEL AVALÚO TANTO EN VENTA COMO EN RENTA.<br><br>

                    II. DESGLOSE DE LA INFORMACIÓN QUE SUSTENTA LOS CÁLCULOS EFECTUADOS.<br><br>

                    a. LA INFORMACIÓN QUE SE UTILIZA EN LOS TRES MÉTODOS DE VALUACIÓN EMPLEADOS SE DESCRIBE EN EL DESARROLLO DE LA METODOLOGÍA Y SU APLICACIÓN POR LO QUE ESTE CAPÍTULO DE LA MEMORIA DE ANÁLISIS A QUE OBLIGA EL MANUAL DE PROCEDIMIENTOS Y LINEAMIENTOS TÉCNICOS DE VALUACIÓN INMOBILIARIA, EN SU ARTÍCULO 21 SE CONSIDERA CUBIERTO CON EL PROPIO DESARROLLO DE LA METODOLOGÍA.<br><br>

                    III. DESCRIPCIÓN DE LOS CÁLCULOS REALIZADOS.<br><br>

                    a. LOS CÁLCULOS REALIZADOS EN LOS TRES MÉTODOS DE VALUACIÓN EMPLEADOS SE DESCRIBEN EN EL DESARROLLO DE LA METODOLOGÍA Y SU APLICACIÓN POR LO QUE ESTE CAPÍTULO DE LA MEMORIA DE ANÁLISIS A QUE OBLIGA EL MANUAL DE PROCEDIMIENTOS Y LINEAMIENTOS TÉCNICOS DE VALUACIÓN INMOBILIARIA, EN SU ARTÍCULO 21 SE CONSIDERA CUBIERTO CON EL PROPIO DESARROLLO DE LA METODOLOGÍA.<br><br>

                    CONDICIONANTES Y SALVEDADES DEL AVALÚO<br><br>
                    
                    LA INFORMACIÓN Y ANTECEDENTES DE PROPIEDAD ASENTADOS EN EL PRESENTE AVALÚO ES LA CONTENIDA EN LA DOCUMENTACIÓN OFICIAL ROPORCIONADA POR EL SOLICITANTE Y/O PROPIETARIO DEL BIEN A VALUAR, LA CUAL ASUMIMOS COMO CORRECTA. ENTRE ELLA, PODEMOS MENCIONAR A LA ESCRITURA DE PROPIEDAD O DOCUMENTO QUE LO IDENTIFICA LEGALMENTE, LOS PLANOS ARQUITECTÓNICOS Y EL REGISTRO CATASTRAL (BOLETA PREDIAL).<br>
                    LA PROBABLE EXISTENCIA DE GRAVÁMENES, RESERVAS DE DOMINIO, ADEUDOS FISCALES O DE CUALQUIER OTRO TIPO QUE PUDIERAN AFECTAR EL BIEN QUE SE VALÚA, QUE NO HAYAN SIDO DECLARADOS POR EL SOLICITANTE Y/O PROPIETARIO DEL MISMO, NO SERÁN CAUSA DE RESPONSABILIDAD ALGUNA PARA EL PERITO VALUADOR POR INFORMACIÓN OMITIDA EN LA SOLICITUD DEL AVALÚO.<br>
                    QUIENES INTERVENIMOS EN EL PRESENTE AVALÚO DECLARAMOS BAJO PROTESTA DE DECIR VERDAD QUE NO GUARDAMOS NINGÚN TIPO DE RELACIÓN O NEXO DE PARENTESCO O DE NEGOCIOS CON EL CLIENTE O PROPIETARIO DEL BIEN QUE SE VALÚA.<br><br>
                </p>


                <br>
                <!-- 7.- Comparación de Mercado -->
                <div style="background-color: #00A346; color: #fff; border: 0px; text-align: right;">VII. COMPARACIÓN DE MERCADO</div>
                <h4 style="margin-top: 4%;">TERRENOS DIRECTOS</h4>
                <h4 style="margin-top: 4%;">TERRENOS</h4>
                <hr>
                <span><b>Investigación productos comparables</b></span>
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
                        @isset($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaUno'])
                            @foreach($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaUno'] as $value_tablaUno)
                        <tr>
                            <td>{{$i_tUno++}}</td>
                            <td>{{$value_tablaUno['Ubicacion']}}</td>
                            <td>{{$value_tablaUno['Descripcion']}}</td>
                            <td>{{$value_tablaUno['C_U_S']}}</td>
                            <td>{{$value_tablaUno['Uso_Suelo']}}</td>
                        </tr>
                            @endforeach
                        @endisset
                    </tbody>
                </table>
                <br>
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
                        $i_tDos = 0;
                    @endphp
                    @isset($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaDos'])
                        @foreach($infoAvaluo['Terrenos']['Terrenos_Directos']['TablaDos'] as $value_tablaDos)
                        <tr>
                            <td>{{ $i_tDos }}</td>
                            <td>{{ $value_tablaDos['F_Negociacion'] }}</td>
                            <td>{{ number_format($value_tablaDos['Superficie'],2) }}</td>
                            <td>{{ $value_tablaDos['Fzo'] }}</td>
                            <td>{{ $value_tablaDos['Fub'] }}</td>
                            <td>{{ $value_tablaDos['FFr'] }}</td>
                            <td>{{ $value_tablaDos['Ffo'] }}</td>
                            <td>{{ $value_tablaDos['Fsu'] }}</td>
                            <td>{{ $value_tablaDos['F_otro'] }}</td>
                            <td>{{ number_format($value_tablaDos['Fre'],4) }}</td>
                            <td>${{ number_format($value_tablaDos['Precio_Solicitado'],2) }}</td>
                        </tr>
                        @endforeach
                    @endisset
                    </tbody>
                </table>
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
                                    {{ number_format($infoAvaluo['Terrenos']['Terrenos_Directos']['Conclusiones_Homologacion_Terrenos']['Valor_Unitario_Tierra_Promedio'],2) }}
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario de tierra homologado</b></td>
                            <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Directos']['Conclusiones_Homologacion_Terrenos']['Valor_Unitario_Tierra_Homologado'])
                                    {{ number_format($infoAvaluo['Terrenos']['Terrenos_Directos']['Conclusiones_Homologacion_Terrenos']['Valor_Unitario_Tierra_Homologado'],2) }}
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario sin homologar mínimo</b></td>
                            <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Directos']['Conclusiones_Homologacion_Terrenos']['Valor_Unitario_Sin_Homologar_Minimo'])
                                    {{ number_format($infoAvaluo['Terrenos']['Terrenos_Directos']['Conclusiones_Homologacion_Terrenos']['Valor_Unitario_Sin_Homologar_Minimo'],2) }}
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario sin homologar máximo</b></td>
                            <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Directos']['Conclusiones_Homologacion_Terrenos']['Valor_Unitario_Sin_Homologar_Maximo'])
                                    {{ number_format($infoAvaluo['Terrenos']['Terrenos_Directos']['Conclusiones_Homologacion_Terrenos']['Valor_Unitario_Sin_Homologar_Maximo'],2) }}
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado mínimo</b></td>
                            <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Directos']['Conclusiones_Homologacion_Terrenos']['Valor_Unitario_Homologado_Minimo'])
                                    {{ number_format($infoAvaluo['Terrenos']['Terrenos_Directos']['Conclusiones_Homologacion_Terrenos']['Valor_Unitario_Homologado_Minimo'],2) }}
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado máximo</b></td>
                            <td>
                                @isset($infoAvaluo['Terrenos']['Terrenos_Directos']['Conclusiones_Homologacion_Terrenos']['Valor_Unitario_Homologado_Maximo'])
                                    {{ number_format($infoAvaluo['Terrenos']['Terrenos_Directos']['Conclusiones_Homologacion_Terrenos']['Valor_Unitario_Homologado_Maximo'],2) }}
                                @endisset
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <h4 style="margin-top: 4%;">TERRENOS RESIDUALES</h4>
                <hr>
                <table>
                    <tbody>
                        <tr>
                            <td><b>Tipo de producto inmobilario propuesto</b></td>
                            <td>dato</td>
                        </tr>
                        <tr>
                            <td><b>Número de unidades vendibles</b></td>
                            <td>dato</td>
                        </tr>
                        <tr>
                            <td><b>Superficie vendible por unidad</b></td>
                            <td>dato</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <p><b>Investigación productos comparables</b></p>
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
                            <td></td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado</b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario sin homologar mínimo</b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario sin homologar máximo</b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado mínimo</b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado máximo</b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario aplicable al residual</b></td>
                            <td></td>
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
                            <td></td>
                        </tr>
                        <tr>
                            <td><b>Total de egresos</b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><b>Utilidad propuesta</b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario de tierra resisdual</b></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>

                
                <table class="tabla_gris_valor">
                    <thead>
                        <tr>
                            <th>VALOR UNITARIO DE TIERRA DEL AVALUO</th>
                            <th>{{ $infoAvaluo['Terrenos']['Valor_Unitario_Tierra_Del_Avaluo'] }}</th>
                        </tr>
                    </thead> 
                </table>

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
                    @isset($infoAvaluo['Construcciones_En_Venta']['Investigacion_Productos_Comparables']['TablaUno'])
                        @foreach($infoAvaluo['Construcciones_En_Venta']['Investigacion_Productos_Comparables']['TablaUno'] as $valueC_tablaUno)
                        <tr>
                            <td>{{ $iC_Uno++ }}</td>
                            <td>{{ $valueC_tablaUno['Ubicacion'] }}</td>
                            <td>{{ $valueC_tablaUno['Descripcion'] }}</td>
                        </tr>
                        @endforeach
                    @endisset    
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
                    @isset($infoAvaluo['Construcciones_En_Venta']['Investigacion_Productos_Comparables']['TablaDos'])
                        @foreach($infoAvaluo['Construcciones_En_Venta']['Investigacion_Productos_Comparables']['TablaDos'] as $valueC_tablaDos)
                        <tr>
                            <td>{{ $iC_Dos++ }}</td>
                            <td>{{ number_format($valueC_tablaDos['F_Negociacion'],2) }}</td>
                            <td>{{ number_format($valueC_tablaDos['Superficie_Vendible'],2) }}</td>
                            <td>${{ number_format($valueC_tablaDos['Precio_Solicitado'],2) }}</td>
                        </tr>
                        @endforeach
                    @endisset
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
                                {{ number_format($infoAvaluo['Construcciones_En_Venta']['Conclusion_Homologacion_Contrucciones_Venta']['Valor_Unitario_Promedio'],2) }}
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado</b></td>
                            <td>
                            @isset($infoAvaluo['Construcciones_En_Venta']['Conclusion_Homologacion_Contrucciones_Venta']['Valor_Unitario_Homologado'])
                                {{ number_format($infoAvaluo['Construcciones_En_Venta']['Conclusion_Homologacion_Contrucciones_Venta']['Valor_Unitario_Homologado'],2) }}
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario sin homologar mínimo</b></td>
                            <td>
                            @isset($infoAvaluo['Construcciones_En_Venta']['Conclusion_Homologacion_Contrucciones_Venta']['Valor_Unitario_Sin_Homolgar_Minimo'])
                                {{ number_format($infoAvaluo['Construcciones_En_Venta']['Conclusion_Homologacion_Contrucciones_Venta']['Valor_Unitario_Sin_Homolgar_Minimo'],2) }}
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario sin homologar máximo</b></td>
                            <td>
                            @isset($infoAvaluo['Construcciones_En_Venta']['Conclusion_Homologacion_Contrucciones_Venta']['Valor_Unitario_Sin_Homolgar_Maximo'])
                                {{ number_format($infoAvaluo['Construcciones_En_Venta']['Conclusion_Homologacion_Contrucciones_Venta']['Valor_Unitario_Sin_Homolgar_Maximo'],2) }}
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado mínimo</b></td>
                            <td>
                            @isset($infoAvaluo['Construcciones_En_Venta']['Conclusion_Homologacion_Contrucciones_Venta']['Valor_Unitario_Homologado_Minimo'])
                                {{ number_format($infoAvaluo['Construcciones_En_Venta']['Conclusion_Homologacion_Contrucciones_Venta']['Valor_Unitario_Homologado_Minimo'],2) }}
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado máximo</b></td>
                            <td>
                            @isset($infoAvaluo['Construcciones_En_Venta']['Conclusion_Homologacion_Contrucciones_Venta']['Valor_Unitario_Homologado_Maximo'])
                                {{ number_format($infoAvaluo['Construcciones_En_Venta']['Conclusion_Homologacion_Contrucciones_Venta']['Valor_Unitario_Homologado_Maximo'],2) }}
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
                                ${{ number_format($infoAvaluo['Construcciones_En_Venta']['Valor_Unitario_Aplicable_Avaluo'],2) }}
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
                                ${{ number_format($infoAvaluo['Construcciones_En_Venta']['Valor_Mercado_Del_Inmueble'],2) }}
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
                    @isset($infoAvaluo['Construcciones_En_Renta']['Investigacion_Productos_Comparables']['TablaUno'])
                        @foreach($infoAvaluo['Construcciones_En_Renta']['Investigacion_Productos_Comparables']['TablaUno'] as $valueCR_tablaUno)
                        <tr>
                            <td>{{ $iCR_Uno++ }}</td>
                            <td>{{ $valueCR_tablaUno['Ubicacion'] }}</td>
                            <td>{{ $valueCR_tablaUno['Descripcion'] }}</td>
                        </tr>
                        @endforeach
                    @endisset
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
                        $iCR_Dos = 1;
                    @endphp
                    @isset($infoAvaluo['Construcciones_En_Renta']['Investigacion_Productos_Comparables']['TablaDos'])
                        @foreach($infoAvaluo['Construcciones_En_Renta']['Investigacion_Productos_Comparables']['TablaDos'] as $valueCR_tablaDos)
                        <tr>
                            <td>{{ $iCR_Dos++ }}</td>
                            <td>{{ number_format($valueCR_tablaDos['F_Negociacion'],2) }}</td>
                            <td>{{ $valueCR_tablaDos['Superficie_Vendible'] }}</td>
                            <td>${{ number_format($valueCR_tablaDos['Precio_Solicitado'],2) }}</td>
                        </tr>
                        @endforeach
                    @endisset
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
                                {{ $infoAvaluo['Construcciones_En_Renta']['Conclusion_Homologacion_Contrucciones_Renta']['Valor_Unitario_Promedio'] }}
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado</b></td>
                            <td>
                            @isset($infoAvaluo['Construcciones_En_Renta']['Conclusion_Homologacion_Contrucciones_Renta']['Valor_Unitario_Homologado'])
                                {{ $infoAvaluo['Construcciones_En_Renta']['Conclusion_Homologacion_Contrucciones_Renta']['Valor_Unitario_Homologado'] }}
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario sin homologar mínimo</b></td>
                            <td>
                            @isset($infoAvaluo['Construcciones_En_Renta']['Conclusion_Homologacion_Contrucciones_Renta']['Valor_Unitario_Sin_Homolgar_Minimo'])
                                {{ $infoAvaluo['Construcciones_En_Renta']['Conclusion_Homologacion_Contrucciones_Renta']['Valor_Unitario_Sin_Homolgar_Minimo'] }}
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario sin homologar máximo</b></td>
                            <td>
                            @isset($infoAvaluo['Construcciones_En_Renta']['Conclusion_Homologacion_Contrucciones_Renta']['Valor_Unitario_Sin_Homolgar_Maximo'])
                                {{ $infoAvaluo['Construcciones_En_Renta']['Conclusion_Homologacion_Contrucciones_Renta']['Valor_Unitario_Sin_Homolgar_Maximo'] }}
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado mínimo</b></td>
                            <td>
                            @isset($infoAvaluo['Construcciones_En_Renta']['Conclusion_Homologacion_Contrucciones_Renta']['Valor_Unitario_Homologado_Minimo'])
                                {{ $infoAvaluo['Construcciones_En_Renta']['Conclusion_Homologacion_Contrucciones_Renta']['Valor_Unitario_Homologado_Minimo'] }}
                            @endisset
                            </td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado máximo</b></td>
                            <td>
                            @isset($infoAvaluo['Construcciones_En_Renta']['Conclusion_Homologacion_Contrucciones_Renta']['Valor_Unitario_Homologado_Maximo'])
                                {{ $infoAvaluo['Construcciones_En_Renta']['Conclusion_Homologacion_Contrucciones_Renta']['Valor_Unitario_Homologado_Maximo'] }}
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
                                ${{ number_format($infoAvaluo['Construcciones_En_Renta']['Valor_Unitario_Aplicable_Avaluo'],2) }}
                            @endisset
                            </th>
                        </tr>
                    </thead> 
                </table>
                

                <!-- 8.- Índice Físico o Directo -->
                <div class="pleca_verde"><b>VIII.- ÍNDICE FÍSICO O DIRECTO</b></div>
                <p><b>a) CÁLCULO DEL VALOR DEL TERRENO</b></p>
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
                    @isset($infoAvaluo['Calculo_Del_Valor_Del_Terreno'])
                        <tr>
                            <td>{{ $infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Fracc'] }}</td>
                            <td>{{ $infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Clave_Area_Valor'] }}</td>
                            <td>{{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Superficie_m2'],2) }}</td>
                            <td>{{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Fzo'],2) }}</td>
                            <td>{{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Fub'],2) }}</td>
                            <td>{{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['FFr'],2) }}</td>
                            <td>{{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Ffo'],2) }}</td>
                            <td>{{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Fsu'],2) }}</td>
                            <td>{{ $infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Fot'] }}</td>
                            <td>{{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['F_Resultante'],2) }}</td>
                            <td>{{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Valor_Fraccion'],2) }}</td>
                        </tr>
                    @endisset
                    </tbody>
                </table>
                <br>
                <p><b>Total superficie: {{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Totales']['Total_Superficie'],2) }} '           'Valor del terreno total: {{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Totales']['Valor_Del_Terreno_Total'],2) }} </b></p>
                <br>
                <p>Indiviso de la unidad que se valua: {{ $infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Totales']['Indiviso_Unidad_Que_Se_Valua'] }} %</p>

                <table class="tabla_gris_valor">
                    <thead>
                        <tr>
                            <th>VALOR TOTAL DEL TERRENO PROPORCIONAL:</th>
                            <th>${{ number_format($infoAvaluo['Calculo_Del_Valor_Del_Terreno']['Totales']['Valor_Total_Del_Terreno_Proporcional'],2) }}</th>
                        </tr>
                    </thead> 
                </table>
                
                <p><b>b) CÁLCULO DEL VALOR DE LAS CONTRUCCIONES</b></p>
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
                        <tr>
                            <td>{{ $infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Fracc'] }}</td>
                            <td>{{ $infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Descripcion'] }}</td>
                            <td>{{ $infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Uso'] }}</td>
                            <td>{{ $infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Clase'] }}</td>
                            <td>{{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Superficie_m2'],2) }}</td>
                            <td>{{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Valor_Unitario'],2) }}</td>
                            <td>{{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Edad'],2) }}</td>
                            <td>{{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Fco'],2) }}</td>
                            <td>{{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['FRe'],2) }}</td>
                            <td>${{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Privativas']['Valor_Fraccion'],2) }}</td>
                        </tr>
                    </tbody>
                </table>
                <p>Total superficie: {{ $infoAvaluo['Calculo_Valor_Construcciones']['Totales_Privativas']['Total_Superficie'] }} '                  ' Total construcciones privativas: ${{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Totales_Privativas']['Total_Construcciones_Privativas'],2) }}</p>
                <br>
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
                        <tr>
                            <td>{{ $infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Fracc'] }}</td>
                            <td>{{ $infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Descripcion'] }}</td>
                            <td>{{ $infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Uso'] }}</td>
                            <td>{{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Superficie_m2'],2) }}</td>
                            <td>{{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Valor_Unitario'],2) }}</td>
                            <td>{{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Edad'],2) }}</td>
                            <td>{{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Fco'],2) }}</td>
                            <td>{{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['FRe'],2) }}</td>
                            <td>{{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Valor_Fraccion'],2) }}</td>
                            <td>{{ $infoAvaluo['Calculo_Valor_Construcciones']['Comunes']['Indiviso'] }}%</td>
                        </tr>
                    </tbody>
                </table>
                <p>Total superficie: {{ $infoAvaluo['Calculo_Valor_Construcciones']['Totales_Comunes']['Total_Superficie'] }} '                  ' Total construcciones comunes: ${{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Totales_Comunes']['Total_Construcciones_Comunes'],2) }}</p>
                
                <table class="tabla_gris_valor">
                    <thead>
                        <tr>
                            <th>VALOR TOTAL DE LAS CONTRUCCIONES:</th>
                            <th>${{ number_format($infoAvaluo['Calculo_Valor_Construcciones']['Totales_Comunes']['Valor_Total_De_Las_Construcciones'],2) }}</th>
                        </tr>
                    </thead> 
                </table>
                
                <p><b>c) DE LAS INSTALACIONES ESPECIALES, OBRAS COMPLEMENTARIOAS Y ELEMENTOS ACCESORIOS</b></p>
                <br>
                <p><b>PRIVATIVAS:</b></p>
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
                    @isset($infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Privativas'])
                        @foreach($infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Privativas'] as $valueEA_tablaPri)
                        <tr>
                            <td>{{ $valueEA_tablaPri['0'] }}</td>
                            <td>{{ $valueEA_tablaPri['Clave'] }}</td>
                            <td>{{ $valueEA_tablaPri['Concepto'] }} </td>
                            <td>{{ number_format($valueEA_tablaPri['Cantidad'],2) }}</td>
                            <td>{{ number_format($valueEA_tablaPri['Valor_Unitario'],2) }}</td>
                            <td>{{ $valueEA_tablaPri['Edad'] }}</td>
                            <td>${{ number_format($valueEA_tablaPri['Importe'],2) }}</td>
                        </tr>
                        @endforeach
                    @endisset
                    </tbody>
                </table>
                <br>
                <p><b>Total de las instalaciones privativas:</b> ${{ number_format($infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Totales']['Total_De_Las_Instalaciones'],2) }}</p>
                <br>
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
                <p>Indiviso de la unidad que se Valua: {{ number_format($infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Totales']['Indiviso_Unidad_Que_Se_Valua'],2) }}%</p>

                <table class="tabla_gris_valor">
                    <thead>
                        <tr>
                            <th>TOTAL DE LAS INSTALACIONES:</th>
                            <th>${{ number_format($infoAvaluo['Instalaciones_Especiales_Obras_Complementarias_Elementos_Accesorios']['Totales']['Total_De_Las_Instalaciones'],2) }}</th>
                        </tr>
                    </thead> 
                </table>

                <table class="tabla_gris_valor">
                    <thead>
                        <tr>
                            <th>ÍNDICE FÍSICO DIRECTO (Importe total de enfoque de costos):</th>
                            <th>${{ number_format($infoAvaluo['Indice_Fisico_Directo'],2) }}</th>
                        </tr>
                    </thead> 
                </table>
               
                
                <!-- 9.- Índice de Capitalización de Rentas -->
                <div class="pleca_verde"><b>IX.- INDICE DE CAPITALIZACIÓN DE RENTAS</b></div>
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
                    @isset($infoAvaluo['Renta_Estimada'])
                        @foreach($infoAvaluo['Renta_Estimada'] as $valueEA_tablaPri)
                        <tr>
                            <td>{{ $i_EA++ }}</td>
                            <td>{{ $valueEA_tablaPri['Ubicacion'] }}</td>
                            <td>{{ $valueEA_tablaPri['Superficie_m2'] }}</td>
                            <td>${{ number_format($valueEA_tablaPri['Renta_Mensual'],2) }}</td>
                            <td>${{ number_format($valueEA_tablaPri['Renta_m2'],2) }}</td>
                        </tr>
                        @endforeach
                    @endisset
                    </tbody>
                </table>
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
                                        <td><b>${{ number_format($infoAvaluo['Analisis_Deducciones']['Vacios'],2) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>b) Impuesto predial:</td>
                                        <td><b>${{ number_format($infoAvaluo['Analisis_Deducciones']['Impuesto_Predial'],2) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>c) Servicio de agua:</td>
                                        <td><b>${{ number_format($infoAvaluo['Analisis_Deducciones']['Servicio_Agua'],2) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>d) Conserv. y mant.:</td>
                                        <td><b>${{ number_format($infoAvaluo['Analisis_Deducciones']['Conserv_Mant'],2) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>e) Administración:</td>
                                        <td><b>${{ number_format($infoAvaluo['Analisis_Deducciones']['Administracion'],2) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>f) Energía eléctrica:</td>
                                        <td><b>${{ number_format($infoAvaluo['Analisis_Deducciones']['Energia_Electrica'],2) }}</b></td>
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
                                        <td><b>${{ number_format($infoAvaluo['Analisis_Deducciones']['Seguros'],2) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>h) Otros:</td>
                                        <td><b>${{ number_format($infoAvaluo['Analisis_Deducciones']['Otros'],2) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>i) Depreciación Fiscal:</td>
                                        <td><b>${{ number_format($infoAvaluo['Analisis_Deducciones']['Depreciacion_Fiscal'],2) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>j) Deducc. Fiscales:</td>
                                        <td><b>${{ number_format($infoAvaluo['Analisis_Deducciones']['Deducc_Fiscales'],2) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>k) I.S.R.</td>
                                        <td><b>${{ number_format($infoAvaluo['Analisis_Deducciones']['ISR'],2) }}</b></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>SUMA:</td>
                                        <td><b>${{ number_format($infoAvaluo['Analisis_Deducciones']['Totales']['Suma'],2) }}</b></td>
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
                            <td>${{ number_format($infoAvaluo['Analisis_Deducciones']['Totales']['Deducciones_Mensuales'],2) }}</td>
                        </tr>
                        <tr>
                            <td><b>PRODUCTO LIQUIDO MENSUAL:</b></td>
                            <td>${{ number_format($infoAvaluo['Analisis_Deducciones']['Totales']['Producto_Liquido_Mensual'],2) }}</td>
                        </tr>
                        <tr>
                            <td><b>PRODUCTO LIQUIDO ANUAL:</b></td>
                            <td>${{ number_format($infoAvaluo['Analisis_Deducciones']['Totales']['Producto_Liquido_Anual'],2) }}</td>
                        </tr>
                        <tr>
                            <td><b>TASA DE CAPITALIZACIÓN APLICALE:</b></td>
                            <td>{{ number_format($infoAvaluo['Analisis_Deducciones']['Totales']['Tasa_Capitalizacion_Aplicable'],2) }}%</td>
                        </tr>
                    </tbody>
                </table>
                <p><span>La tasa de capitalización aplicable aquí referida deberá ser justificada en el apartado de consideracinoes propias.</span></p>

                <table class="tabla_gris_valor">
                    <thead>
                        <tr>
                            <th>RESULTADO DE LA APLICACIÓN DEL ENFOQUE DE INGRESOS (VALOR POR CAPITALIZACIÓN DE RENTAS):</th>
                            <th>${{ number_format($infoAvaluo['Resultado_Aplicacion_Enfoque_Ingresos'],2) }}</th>
                        </tr>
                    </thead> 
                </table>
                
                
                <!-- 10.- Resumen de Valores -->
                <div class="pleca_verde"><b>X.- RESUMEN DE VALORES</b></div>

                <table class="tabla_gris_valor">
                    <thead>
                        <tr>
                            <th>ÍNDICE FÍSICO DIRECTO:</th>
                            <th>${{ number_format($infoAvaluo['Indice_Fisico_Directo']) }}</th>
                        </tr>
                    </thead> 
                </table>

                <table class="tabla_gris_valor">
                    <thead>
                        <tr>
                            <th>VALOR POR CAPITALIZACIÓN DE RENTAS:</th>
                            <th>${{ number_format($infoAvaluo['Valor_Capitalizacion_Rentas'],2) }}</th>
                        </tr>
                    </thead> 
                </table>

                <table class="tabla_gris_valor">
                    <thead>
                        <tr>
                            <th>VALOR DE MERCADO DE LAS CONSTRUCCIONES:</th>
                            <th>${{ number_format($infoAvaluo['Valor_Mercado_Construcciones'],2) }}</th>
                        </tr>
                    </thead> 
                </table>

                <!-- 11.- Consideraciones Previas a la Conclusión -->
                <div class="pleca_verde"><b>XI.- CONSIDERACIONES PREVIAS A LA CONCLUSIÓN</b></div>

                    <p class="letras_pequenas">
                        PARA LOS EFECTOS DEL "MANUAL DE PROCEDIMIENTOS Y LINEAMIENTOS TÉCNICOS DE VALUACIÓN INMOBILIARIA, PUBLICADO POR LA SECRETARÍA DE FINANZAS EN LA
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
                        CONSIDERACIONES:<br><br>
                        {{ $infoAvaluo['Consideraciones'] }}
                    </p>

                
                <!-- 12.- Conclusiones sobre el Valor Comercial -->
                <div class="pleca_verde"><b>XII.- CONCLUSIONES SOBRE EL VALOR COMERCIAL</b></div>
                <table class="tabla_gris_valor">
                    <thead>
                        <tr>
                            <th>CONSIDERAMOS QUE EL VALOR COMERCIAL CORRESPONDE A:</th>
                            <th>${{ number_format($infoAvaluo['Consideramos_Que_Valor_Comercial_Corresponde'],2) }}</th>
                        </tr>
                    </thead> 
                </table>
                <br>
                <p><span>Esta cantidad estimamos que representa el valor comercial del inmueble al día:</span></p>
                <p>VALOR REFERIDO: ${{ number_format($infoAvaluo['Valor_Referido']['Valor_Referido'],2)}} '     ' FECHA: {{ $infoAvaluo['Valor_Referido']['Fecha']}} '        ' FACTOR: {{ $infoAvaluo['Valor_Referido']['Factor']}} '       '</p>
                <br>
                <p>Perito valuador: {{ $infoAvaluo['Perito_Valuador'] }} '                    ' Registro T.D.F.: dato</p>
                <br>
                <div style="background-color: #5d6d7e; color: #fff; border: 0px; text-align: right; margin: 2% 0 2% 0;"><b>ANEXO FOTOGRÁFICO SUJETO</b></div>
                <br>
                <p><b>INMUEBLE OBJETO DE ESTE AVALÚO</b></p>
                @foreach($infoAvaluo['Inmueble_Objeto_Avaluo'] as $value_inmuebleOA)
                <img src="data:image/png;base64,{{$value_inmuebleOA['Foto']}}" width="85" height="85" />
                <span>Cuenta: {{ $value_inmuebleOA['Cuenta_Catastral'] }} '        ' @if($value_inmuebleOA['Interior_O_Exterior'] == 'E') Exterior @else Interior @endif</span>
                @endforeach
                <br>
                <div style="background-color: #5d6d7e; color: #fff; border: 0px; text-align: right; margin: 2% 0 2% 0;"><b>ANEXO FOTOGRÁFICO COMPARABLES</b></div>
                <p><b>INMUEBLES EN VENTA</b></p>
                @foreach($infoAvaluo['Inmueble_Venta'] as $value_inmuebleEV)
                <img src="data:image/png;base64,{{$value_inmuebleEV['Foto']}}" width="85" height="85" />
                <span>Cuenta: {{ $value_inmuebleEV['Cuenta_Catastral'] }} '        ' @if($value_inmuebleEV['Interior_O_Exterior'] == 'E') Exterior @else Interior @endif</span>
                @endforeach
                <br>
                <p><b>INMUEBLES EN RENTA</b></p>
                @foreach($infoAvaluo['Inmueble_Renta'] as $value_inmuebleR)
                <img src="data:image/png;base64,{{$value_inmuebleR['Foto']}}" width="85" height="85" />
                <span>Cuenta: {{ $value_inmuebleR['Cuenta_Catastral'] }} '        ' @if($value_inmuebleR['Interior_O_Exterior'] == 'E') Exterior @else Interior @endif</span>
                @endforeach
            </div>
        </div> 
        <!-- Fin de CONTENIDO -->

    </body>

</html>