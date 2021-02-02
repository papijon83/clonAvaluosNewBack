
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            @page {
                size: A4;
            }
            body, html { 
                font-family: Arial, Helvetica, sans-serif;
                font-size: 12px;
            }
            table {
                text-align: center !important;
                width: 100%;
                border: 1px solid black;
            }
            .cuenta_catastral {
                width: 60%;
            }
            .cuenta_agua {
                text-align: center;
                width: 60%;
                height: 40px;
                border:1px solid black;
            }
            .propietario_solicitante {
                width: 100%;
                border:1px solid black;
            }
            .ubicacion_inmueble {
                width: 100%;
                border:1px solid black;
            }
            .datos_escritura {
                width: 100%;
            }
            .col-md-1 {
                display:inline-block;
                width: 50px;
            }
        </style>
    </head>
    <body>
        <strong>NÚMERO ÚNICO </strong>{{$datosPDF['numeroUnico']}}
        <br>
        <br>
        <strong>I. CUENTA CATASTRAL</strong>
        <br>
        <div class="cuenta_catastral">
            <table>
                <thead>
                    <tr>
                        <th>Reg.</th>
                        <th>Manz.</th>
                        <th>Lote</th>
                        <th>Loc.</th>
                        <th>D.V.</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$datosPDF['region']}}</td>
                        <td>{{$datosPDF['manzana']}}</td>
                        <td>{{$datosPDF['lote']}}</td>
                        <td>{{$datosPDF['unidadprivativa']}}</td>
                        <td>{{$datosPDF['digitoverificador']}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br>
        <br>
        <strong>II. CUENTA DE AGUA</strong>
        <div class="cuenta_agua">
            <p>{{$datosPDF['cuentaAgua']}}</p>
        </div>
        <br>
        <br>
        <strong>III. DATOS DEL PROPIETARIO O SOLICITANTE DEL AVALÚO</strong>
        <div class="propietario_solicitante">
            <strong>Nombre, denominación o razón social</strong><span class="col-md-1"></span>{{$datosPDF['propietario']['apellidopaterno']}} {{$datosPDF['propietario']['apellidomaterno']}} {{$datosPDF['propietario']['nombre']}}
            <br>
            <strong>Calle</strong><span class="col-md-1"></span>{{$datosPDF['propietario']['calle']}}<span class="col-md-1"></span>
            <strong>No. Exterior</strong><span class="col-md-1"></span>{{$datosPDF['propietario']['numeroexterior']}}<span class="col-md-1"></span>
            <strong>No. Interior</strong><span class="col-md-1"></span>{{$datosPDF['propietario']['numerointerior']}}
            <br>
            <strong>Colonia</strong><span class="col-md-1"></span>{{$datosPDF['propietario']['nombrecolonia']}}
            <br>
            <strong>Delegación o Municipio</strong><span class="col-md-1"></span>{{$datosPDF['propietario']['nombredelegacion']}}<span class="col-md-1"></span>
            <strong>Código Postal</strong><span class="col-md-1"></span>{{$datosPDF['propietario']['codigopostal']}}
            <br>
            <strong>Entidad Federativa</strong><span class="col-md-1"></span>{{$datosPDF['propietario']['entidad']}}<span class="col-md-1"></span>
            <strong>Teléfono</strong><span class="col-md-1"></span>{{$datosPDF['propietario']['telefono']}}
        </div>
        <br>
        <br>
        <strong>IV. UBICACIÓN DEL INMUEBLE QUE SE ADQUIERE</strong>
        <div class="ubicacion_inmueble">
            <strong>Calle</strong><span class="col-md-1"></span>{{$datosPDF['inmueble']['calle']}}
            <br>
            <strong>Manzana</strong><span class="col-md-1"></span>{{$datosPDF['inmueble']['manzana']}}<span class="col-md-1"></span>
            <strong>Lote</strong><span class="col-md-1"></span>{{$datosPDF['inmueble']['lote']}}<span class="col-md-1"></span>
            <strong>No. Exterior</strong><span class="col-md-1"></span>{{$datosPDF['inmueble']['numeroexterior']}}<span class="col-md-1"></span>
            <strong>No. Interior</strong><span class="col-md-1"></span>{{$datosPDF['inmueble']['numerointerior']}}
            <br>
            <strong>Colonia</strong><span class="col-md-1"></span>{{$datosPDF['inmueble']['nombrecolonia']}}<span class="col-md-1"></span>
            <strong>Delegación</strong><span class="col-md-1"></span>{{$datosPDF['inmueble']['nombredelegacion']}}<span class="col-md-1"></span>
            <strong>Código Postal</strong><span class="col-md-1"></span>{{$datosPDF['inmueble']['codigopostal']}}
        </div>
        <br>
        <br>
        <strong>V. DATOS DE LA ESCRITURA</strong>
        <div class="datos_escritura">
            <strong>Número Escritura</strong><span class="col-md-1"></span>{{$datosPDF['numescritura']}}<span class="col-md-1"></span>
            <strong>Fecha</strong><span class="col-md-1"></span>{{$datosPDF['fecha']}}
            <br>
            <strong>Número Notaria</strong><span class="col-md-1"></span>{{$datosPDF['numnotario']}}
            <br>
            <strong>Nombre del Notario</strong><span class="col-md-1"></span>{{$datosPDF['nombrenotario']}}
            <br>
            <strong>Entidad Federativa</strong><span class="col-md-1"></span>{{$datosPDF['distritojudicialnotario']}}
        </div>
    </body>
</html>