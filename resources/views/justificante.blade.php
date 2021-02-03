<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            @page { margin: 180px 50px; font-family: Arial, Helvetica, sans-serif!important; font-size: 13px;} 
            #header { position: fixed; left: 0px; top: -130px; right: 0px; height: 90px; text-align: center;} 
            #footer { position: fixed; left: 0px; bottom: -130px; right: 0px; height: 40px; text-align: center; } 
            #footer .page:after { content: counter(page, decimal); } 
            .grises{color: #8D8D8D;}
            .tabla_cabeza_gris{width: 100%; border-collapse: collapse!important; margin-top: 2%;}
                .tabla_cabeza_gris>thead>tr>th, .tabla_cabeza_gris>tbody>tr>td {border: 1px solid #000; padding: 2px;}
                .tabla_cabeza_gris>thead{background-color: #D3D3D3; font-size: 10px!important;}
            .centrado{text-align: center;}
            .pleca_verde{background-color: #9ACD32; color: #fff; border: 0px; text-align: right; margin: 2% 0 2% 0; pading: 5px; font-size: 15px;}
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
                            <td class="grises">15/08/2013</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><b>Avaluo:</b></td>
                            <td class="grises">MRN-23-345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><b>No. Único:</b></td>
                            <td class="grises">{{$datosPDF['no_unico']}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><b>Registro T.D.F</b></td>
                            <td class="grises">097654</td>
                        </tr>
                </table>
                <hr style="background-color: #9ACD32; height: 5px; border: 0px;">
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
                            <td>JFNVHF88</td>
                        </tr>
                        <tr>
                            <td><b>FECHA DEL AVALÚO:</b></td>
                            <td>JFNVHF88</td>
                        </tr>
                        <tr>
                            <td><b>SOLICITANTE:</b></td>
                            <td>
                                Tipo persona: Física
                                SRA. ELOÍSA LARA PORTAL
                                ESCRITURACION
                                CONOCER EL VALOR COMERCIAL.
                                UBICACIÓN DEL INMUEBLE: Calle : CERRADA DE TOLUCA
                                Delegación:
                                Cuenta agua: 15-33-426-961-001-000-7
                                Edificio:
                                Lote:
                                -
                                0
                                Nº Interior : DEPTO. 301
                                01
                                Colonia: OLIVAR DE LOS PADRES
                                CP : 01780
                                Nº Exterior: 40
                                154-139-26-012 4
                                Condominal
                                SRA. LAILA MATUK MARTÍNEZ Y CORP.
                                Nº Exterior: 3344
                                Colonia: CD. JARDIN COYOACAN
                            </td>
                        </tr>
                        <tr>
                            <td><b>INMUEBLE QUE SE EVALÚA:</b></td>
                            <td>JFNVHF88</td>
                        </tr>
                        <tr>
                            <td><b>RÉGIMEN DE PROPIEDAD:</b></td>
                            <td>JFNVHF88</td>
                        </tr>
                        <tr>
                            <td><b>PROPIETARIO DEL INMUEBLE:</b></td>
                            <td>JFNVHF88</td>
                        </tr>
                        <tr>
                            <td><b>OBJETO DEL AVALÚO:</b></td>
                            <td>JFNVHF88</td>
                        </tr>
                        <tr>
                            <td><b>PROPÓSITO DEL AVALÚO:</b></td>
                            <td>JFNVHF88</td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border: 1px solid #B5B5B5; border-right: 0px;"><b>UBICACIÓN DEL INMUEBLE:</b></td>
                            <td style="border: 1px solid #B5B5B5; border-left: 0px;">JFNVHF88</td>
                        </tr>
                    </table>


                <!-- 2.- Características Urbanas -->
                <div class="pleca_verde"><b>II. CARACTERÍSTICAS URBANAS</b></div>

                    <table>
                        <tr>
                            <td><b>CLASIFICACIÓN DE LA ZONA:</b></td>
                            <td>Habitación de segundo orden</td>
                        </tr>
                        <tr>
                            <td><b>ÍNDICE DE SATURACIÓN DE LA ZONA:</b></td>
                            <td>Habitación de segundo orden</td>
                        </tr>
                        <tr>
                            <td><b>TIPO DE CONSTRUCCIÓN DOMINANTE:</b></td>
                            <td>Habitación de segundo orden</td>
                        </tr>
                        <tr>
                            <td><b>DENSISAD DE LA POBLACIÓN:</b></td>
                            <td>Habitación de segundo orden</td>
                        </tr>
                        <tr>
                            <td><b>NIVEL SOCIOECONÓMICO DE LA ZONA:</b></td>
                            <td>Habitación de segundo orden</td>
                        </tr>
                        <tr>
                            <td><b>CONTAMINACIÓN DEL MEDIO AMBIENTE:</b></td>
                            <td>Habitación de segundo orden</td>
                        </tr>
                        <tr>
                            <td><b>CLASE GENERAL DE INMUEBLES DE LA ZONA:</b></td>
                            <td>Habitación de segundo orden</td>
                        </tr>
                        <tr>
                            <td><b>USO DEL SUELO:</b></td>
                            <td>Habitación de segundo orden</td>
                        </tr>
                        <tr>
                            <td><b>ÁREA LIBRE OBLIGATORIA:</b></td>
                            <td>Habitación de segundo orden</td>
                        </tr>
                        <tr>
                            <td><b>VÍAS DE ACCESO E IMPORTANCIA DE LAS MISMAS:</b></td>
                            <td>Habitación de segundo orden</td>
                        </tr>
                    </table>


                    <h4 style="margin-top: 4%;">SERVICIOS PÚBLICOS Y EQUIPAMIENTO URBANO:</h4>

                        <table>
                            <tr>
                                <td><b>Red de distribución agua potable:</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Red de recolección de aguas residuales:</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Red de drenaje de aguas pluviales en la calle:</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Red de drenaje de aguas pluviales en la zona:</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Sistema mixto (aguas pluviales y residuales):</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Suministro eléctrico:</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Acometida al inmueble:</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Alumbrado público:</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Vialidades:</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Banquetas:</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Guarniciones:</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Nivel de infraestructura en la zona (%):</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Gas natural:</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Teléfonos suministro:</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Señalización de vías:</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Acometida al inmueble tel.:</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Distancia transporte urbano:</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Frecuencia transporte urbano:</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Distancia transporte suburbano:</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Frecuencia transporte suburbano:</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Vigilancia:</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Recolección de basura:</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Templo:</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Mercados:</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Plazas públicas:</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Parques y jardines:</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Escuelas:</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Hospitales:</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Bancos:</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Estación de transporte:</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Nivel de equipamiento urbano:</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                            <tr>
                                <td><b>Nomenclatura de calles</b></td>
                                <td>Habitación de segundo orden</td>
                            </tr>
                        </table>


                <!-- 3.- Terreno -->
                <div class="pleca_verde"><b>III. TERRENO</b></div>

                    <div><b>CALLES TRANSVERSALES, LIMÍTROFES Y ORIENTACIÓN:</b></div>
                    <div>ACERA ORIENTADA AL NORTE ENTRE CALLE DON MANUELITO AL PONIENTE Y AV. ROMULO O' FARRIL AL SUR Y AL ORIENTE.</div>

                    <h4 style="margin-top: 4%;">CROQUIS DE LOCALIZACIÓN:</h4>
                        
                        <table style="width: 100%;">
                            <tr>
                                <td style="width: 50%; padding: 10px;"><img src="https://es-static.z-dn.net/files/dc9/0eacbfcd7dccb90481b36cec81628392.png"></td>
                                <td style="width: 50%; padding: 10px;"><img src="https://es-static.z-dn.net/files/dc9/0eacbfcd7dccb90481b36cec81628392.png"></td>
                            </tr>
                        </table>


                    <h4 style="margin-top: 4%;">MEDIDAS Y COLINDANCIAS:</h4>
                   
                        <table>
                            <tr>
                                <td><b>Fuente:</b></td>
                                <td>Escritura</td>
                            </tr>
                            <tr>
                                <td><b>Número escritura:</b></td>
                                <td>26354</td>
                                <td><b>Número volumen:</b></td>
                                <td>2635</td>
                            </tr>
                            <tr>
                                <td><b>Número notaría:</b></td>
                                <td>77</td>
                                <td><b>Nombre de notario:</b></td>
                                <td>LIC. JOSE DE JESUS NIÑO DE LA SELVA</td>
                            </tr>
                            <tr>
                                <td><b>Entidad federativa:</b></td>
                                <td>CDMX</td>
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
                                <tr>
                                    <td>AL NORTE</td>
                                    <td>10.80</td>
                                    <td>CON CERRADA TOLUCA.</td>
                                </tr>
                                <tr>
                                    <td>AL SUR</td>
                                    <td>10.80</td>
                                    <td>CON CERRADA TOLUCA.</td>
                                </tr>
                                <tr>
                                    <td>AL ESTE</td>
                                    <td>10.80</td>
                                    <td>CON CERRADA TOLUCA.</td>
                                </tr>
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
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                </tr>
                            </tbody>
                        </table>
                        <div style="text-align: right;"><b>SUPERFICIE TOTAL TERRENO: $46.00</b></div>


                    <h4 style="margin-top: 4%;">TOPOGRAFÍA Y CONFIGURACIÓN:</h4>
                   
                        <table>
                            <tr>
                                <td><b>CARACTERÍSTICAS PANORÁMICAS:</b></td>
                                <td>LA VISTA QUE TIENE ES A LA CALLE DE SU UBICACIÓN.</td>
                            </tr>
                            <tr>
                                <td><b>DENSIDAD HABITACIONAL:</b></td>
                                <td>Baja, 100 a 200 hab/ha una vivienda por lote de 250 m^2</td>
                            </tr>
                            <tr>
                                <td><b>SERVIDUMBRE O RESTRICCIONES:</b></td>
                                <td>LAS PROPIAS DEL RÉGIMEN DE PROPIEDAD EN CONDOMINIO.</td>
                            </tr>
                        </table>


                <!-- 4.- Descripción General del Inmueble -->
                <div class="pleca_verde"><b>IV.- DESCRIPCIÓN GENERAL DEL INMUEBLE</b></div>

                    <div><b>USO ACTUAL:</b></div>
                    <div>DEPARTAMENTO MODERNO, DE BUENA CALIDAD, DE UN TIPO EN UNA PLANTA Y CONSTA DE: ACCESO, MEDIO BAÑO, SALA, COMEDOR, COCINA,
                    ESTUDIO, 2 RECAMARAS CON BAÑO COMPLETO, ESCALERA ASCENDENTE, PLANTA AZOTEA, ROOF GARDEN Y CUARTO DE LAVADO.</div>


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
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
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
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                    <td class="centrado">x</td>
                                </tr>
                            </tbody>
                        </table>

                        <table>
                            <tr>
                                <td><b>INDIVISO</b></td>
                                <td>100%</td>
                            </tr>
                            <tr>
                                <td><b>VIDA ÚTIL PROMEDIO DEL INMUEBLE:</b></td>
                                <td>79</td>
                            </tr>
                            <tr>
                                <td><b>EDAD APROXIMADA DE LA CONSTRUCCIÓN:</b></td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td><b>VIDA ÚTIL REMANENTE:</b></td>
                                <td></td>
                            </tr>
                        </table>


                <!-- 5.- Elementos de la Construcción -->
                <div class="pleca_verde"><b>V.- ELEMENTOS DE LA CONSTRUCCIÓN</b></div>

                    <h4 style="margin-top: 4%;"><b>a) OBRA NEGRA O GRUESA:</b></h4>

                        <table>
                            <tr>
                                <td><b>CIMIENTOS:</b></td>
                                <td>100%</td>
                            </tr>
                            <tr>
                                <td><b>ESTRUCTURA:</b></td>
                                <td>79</td>
                            </tr>
                            <tr>
                                <td><b>MUROS:</b></td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td><b>ENTREPISOS:</b></td>
                                <td>x</td>
                            </tr>
                            <tr>
                                <td><b>TECHOS:</b></td>
                                <td>x</td>
                            </tr>
                            <tr>
                                <td><b>AZOTEAS:</b></td>
                                <td>x</td>
                            </tr>
                            <tr>
                                <td><b>BARDAS:</b></td>
                                <td>x</td>
                            </tr>
                        </table>


                    <h4 style="margin-top: 4%;"><b>b) REVESTIMIENTOS Y ACABADOS INTERIORES</b></h4>

                        <table>
                            <tr>
                                <td><b>APLANADOS:</b></td>
                                <td>100%</td>
                            </tr>
                            <tr>
                                <td><b>PLAFONES:</b></td>
                                <td>79</td>
                            </tr>
                            <tr>
                                <td><b>LAMBRINES:</b></td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td><b>PISOS:</b></td>
                                <td>x</td>
                            </tr>
                            <tr>
                                <td><b>ZOCLOS:</b></td>
                                <td>x</td>
                            </tr>
                            <tr>
                                <td><b>ESCALERAS:</b></td>
                                <td>x</td>
                            </tr>
                            <tr>
                                <td><b>PINTURA:</b></td>
                                <td>x</td>
                            </tr>
                            <tr>
                                <td><b>RECUBRIMIENTOS ESPECIALES:</b></td>
                                <td>x</td>
                            </tr>
                        </table>


                    <h4 style="margin-top: 4%;"><b>c) CARPINTERÍA</b></h4>

                        <table>
                            <tr>
                                <td><b>PUERTAS INTERIORES:</b></td>
                                <td>100%</td>
                            </tr>
                            <tr>
                                <td><b>GUARDARROPAS:</b></td>
                                <td>79</td>
                            </tr>
                            <tr>
                                <td><b>MUEBLES EMPOTRADOS O FIJOS:</b></td>
                                <td>1</td>
                            </tr>
                        </table>


                    <h4 style="margin-top: 4%;"><b>d) INSTALACIONES HIDRAULICAS Y SANITARIAS</b></h4>

                        <table>
                            <tr>
                                <td><b>MUEBLES DE BAÑO:</b></td>
                                <td>100%</td>
                            </tr>
                            <tr>
                                <td><b>RAMALEOS HIDRÁULICOS:</b></td>
                                <td>79</td>
                            </tr>
                            <tr>
                                <td><b>RAMALEOS SANITARIOS:</b></td>
                                <td>1</td>
                            </tr>
                        </table>


                    <table>
                        <tr>
                            <td><b>e) INSTALACIONES ELÉCTRICAS Y ALUMBRADO</b></td>
                            <td>100%</td>
                        </tr>
                    </table>


                    <h4 style="margin-top: 4%;"><b>f) PUERTAS Y VENTANERÍA METÁLICA</b></h4>

                        <table>
                            <tr>
                                <td><b>HERRERÍA:</b></td>
                                <td>100%</td>
                            </tr>
                            <tr>
                                <td><b>VENTANERÍA:</b></td>
                                <td>79</td>
                            </tr>
                        </table>


                    <table>
                        <tr>
                            <td><b>g) VIDRIERÍA</b></td>
                            <td>100%</td>
                        </tr>
                    </table>


                    <table>
                        <tr>
                            <td><b>h) CERRAJERÍA</b></td>
                            <td>100%</td>
                        </tr>
                    </table>


                    <table>
                        <tr>
                            <td><b>i) FACHADAS</b></td>
                            <td>100%</td>
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
                                    <td class="centrado">x</td>
                                    <td>x</td>
                                    <td>x</td>
                                    <td>x</td>
                                    <td>x</td>
                                    <td>x</td>
                                    <td>x</td>
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
                                <tr>
                                    <td class="centrado">OC17</td>
                                    <td>x</td>
                                    <td>x</td>
                                    <td>x</td>
                                    <td>x</td>
                                    <td>x</td>
                                    <td>x</td>
                                </tr>
                                <tr>
                                    <td class="centrado">OC17</td>
                                    <td>x</td>
                                    <td>x</td>
                                    <td>x</td>
                                    <td>x</td>
                                    <td>x</td>
                                    <td>x</td>
                                </tr>
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
                <!-- 7.- COMPARACIÓN DE MERCADO -->
                <div style="background-color: #9ACD32; color: #fff; border: 0px; text-align: right;">VII. COMPARACIÓN DE MERCADO</div>
                <h4 style="margin-top: 4%;">TERRENOS DIRECTOS</h4>
                <h4 style="margin-top: 4%;">TERRENOS</h4>
                <hr>
                <span>Investigación productos comparables</span>
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
                        <tr>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                        </tr>
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
                        <tr>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                        </tr>
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
                            <td>dato</td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario de tierra homologado</b></td>
                            <td>dato</td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario sin homologar mínimo</b></td>
                            <td>dato</td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario sin homologar máximo</b></td>
                            <td>dato</td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado mínimo</b></td>
                            <td>dato</td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado máximo</b></td>
                            <td>dato</td>
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
                            <td>dato</td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado</b></td>
                            <td>dato</td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario sin homologar mínimo</b></td>
                            <td>dato</td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario sin homologar máximo</b></td>
                            <td>dato</td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado mínimo</b></td>
                            <td>dato</td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado máximo</b></td>
                            <td>dato</td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario aplicable al residual</b></td>
                            <td>dato</td>
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
                            <td>dato</td>
                        </tr>
                        <tr>
                            <td><b>Total de egresos</b></td>
                            <td>dato</td>
                        </tr>
                        <tr>
                            <td><b>Utilidad propuesta</b></td>
                            <td>dato</td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario de tierra resisdual</b></td>
                            <td>dato</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <p>VALOR UNITARIO DE TIERRA DEL AVALUO: DATO</p>
                <br>
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
                        <tr>
                            <td>1</td>
                            <td>DESIERTO DE LOS LEONES. TETELPAN. 01700</td>
                            <td>2 RECÁMARAS, 2 BAÑOS Y 2 ESTACIONAMIENTO</td>
                        </tr>
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
                        <tr>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                        </tr>
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
                            <td>dato</td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado</b></td>
                            <td>dato</td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario sin homologar mínimo</b></td>
                            <td>dato</td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario sin homologar máximo</b></td>
                            <td>dato</td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado mínimo</b></td>
                            <td>dato</td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado máximo</b></td>
                            <td>dato</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <p>VALOR UNITARIO APLICABLE AL AVALUO:</p>
                <p>VALOR DE MERCADO DEL INMUEBLE:</p>
                <br>
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
                        <tr>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                        </tr>
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
                        <tr>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                        </tr>
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
                            <td>dato</td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado</b></td>
                            <td>dato</td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario sin homologar mínimo</b></td>
                            <td>dato</td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario sin homologar máximo</b></td>
                            <td>dato</td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado mínimo</b></td>
                            <td>dato</td>
                        </tr>
                        <tr>
                            <td><b>Valor unitario homologado máximo</b></td>
                            <td>dato</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <p>VALOR UNITARIO APLICABLE AL AVALUO:</p>
                <br>

                <!-- 8.- ÍNDICE FÍSICO O DIRECTO -->
                <div style="background-color: #9ACD32; color: #fff; border: 0px; text-align: right; margin: 2% 0 2% 0;"><b>VIII.- ÍNDICE FÍSICO O DIRECTO</b></div>
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
                        <tr>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <p>Total superficie: dato '           'Valor del terreno total: dato </p>
                <br>
                <p>Indiviso de la unidad que se valua: dato</p>
                <p>VALOR TOTAL DEL TERRENO PROPORCIONAL: dato</p>
                <br>
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
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                        </tr>
                    </tbody>
                </table>
                <p>Total superficie: dato '                  ' Total construcciones privativas: dato</p>
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
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                        </tr>
                    </tbody>
                </table>
                <p>Total superficie: dato '                  ' Total construcciones comunes: dato</p>
                <br>
                <p>VALOR TOTAL DE LAS CONTRUCCIONES: dato</p>
                <br>
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
                        <tr>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <p>Total de las instalaciones privativas: dato</p>
                <br>
                <p><b>COMUNES: </b></p>
                <table class="tabla_cabeza_gris">
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
                </table>
                <br>
                <p>Indiviso de la unidad que se Valua: dato</p>
                <p>TOTAL DE LAS INSTALACIONES: dato</p>
                <br>
                <br>
                <p>ÍNDICE FÍSICO DIRECTO (Importe total de enfoque de costos):</p>
                
                <!-- 9.- INDICE DE CAPITALIZACIÓN DE RENTAS -->
                <div style="background-color: #9ACD32; color: #fff; border: 0px; text-align: right; margin: 2% 0 2% 0;"><b>IX.- INDICE DE CAPITALIZACIÓN DE RENTAS</b></div>
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
                        <tr>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                            <td>dato</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <p><b>ANÁLISIS DE DEDUCCIONES:</b></p>
                <table style="border-collapse: collapse; width: 100%;">
                    <thead>
                        <tr>
                            <th>Concepto</th>
                            <th>Monto ($)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>dato</td>
                            <td>dato</td>
                        </tr>
                    </tbody>
                </table>
                <table style="border-collapse: collapse; width: 100%;">
                    <thead>
                        <tr>
                            <th>Concepto</th>
                            <th>Monto ($)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>dato</td>
                            <td>dato</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <table style="border-collapse: collapse; width: 100%;">
                    <tbody>
                        <tr>
                            <td><b>DEDUCCIONES MENSUALES:</b></td>
                            <td>dato</td>
                        </tr>
                        <tr>
                            <td><b>PRODUCTO LIQUIDO MENSUAL:</b></td>
                            <td>dato</td>
                        </tr>
                        <tr>
                            <td><b>PRODUCTO LIQUIDO ANUAL:</b></td>
                            <td>dato</td>
                        </tr>
                        <tr>
                            <td><b>TASA DE CAPITALIZACIÓN APLICALE:</b></td>
                            <td>dato</td>
                        </tr>
                    </tbody>
                </table>
                <p><span>La tasa de capitalización aplicable aquí referida deberá ser justificada en el apartado de consideracinoes propias.</span></p>
                <br>
                <p>RESULTADO DE LA APLICACIÓN DEL ENFOQUE DE INGRESOS (VALOR POR CAPITALIZACIÓN DE RENTAS): dato</p>
                <br>
                
                <!-- 10.- RESUMEN DE VALORES -->
                <div style="background-color: #9ACD32; color: #fff; border: 0px; text-align: right; margin: 2% 0 2% 0;"><b>X.- RESUMEN DE VALORES</b></div>
                <p>ÍNDICE FÍSICO DIRECTO: dato</p>
                <p>VALOR POR CAPITALIZACIÓN DE RENTAS</p>
                <p>VALOR DE MERCADO DE LAS CONSTRUCCIONES:</p>
                <br>
                <p>CONSIDERACIONES: </p>
                <br>
                
                <!-- 11.- CONCLUSIONES SOBRE EL VALOR COMERCIAL -->
                <div style="background-color: #9ACD32; color: #fff; border: 0px; text-align: right; margin: 2% 0 2% 0;"><b>XII.- CONCLUSIONES SOBRE EL VALOR COMERCIAL</b></div>
                <p>CONSIDERAMOS QUE EL VALOR COMERCIAL CORRESPONDE A: dato</p>
                <br>
                <p><span>Esta cantidad estimamos que representa el valor comercial del inmueble al día:</span></p>
                <p>VALOR REFERIDO: dato '     ' FECHA: dato '        ' FACTOR: dato '       '</p>
                <br>
                <p>Perito valuador: dato '                    ' Registro T.D.F.: dato</p>
                <br>
                <div style="background-color: #5d6d7e; color: #fff; border: 0px; text-align: right; margin: 2% 0 2% 0;"><b>ANEXO FOTOGRÁFICO SUJETO</b></div>
                <br>
                <p><b>INMUEBLE OBJETO DE ESTE AVALÚO</b></p>
                <img>
                <span>Cuenta: dato '        ' Número ext o int: dato</span>
                <br>
                <div style="background-color: #5d6d7e; color: #fff; border: 0px; text-align: right; margin: 2% 0 2% 0;"><b>ANEXO FOTOGRÁFICO COMPARABLES</b></div>
                <p><b>INMUEBLES EN VENTA</b></p>
                <img>
                <span>Cuenta: dato '        ' Número ext o int: dato</span>
                <p><b>INMUEBLES EN RENTA</b></p>
                <img>
                <span>Cuenta: dato '        ' Número ext o int: dato</span>

            </div>
        </div> 
        <!-- Fin de CONTENIDO -->

    </body>

</html>