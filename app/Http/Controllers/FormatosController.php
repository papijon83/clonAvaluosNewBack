<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Log;

class FormatosController extends Controller
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

    public function generaAcusePDF(Request $request)
    {
        try {
            $data = decrypt($request->input('token'));
            $no_unico = $request->input('no_unico');

            $datosPDF = [];

            $datosPDF['numeroUnico'] = trim($data['numeroUnico']);
            $datosPDF['region'] = trim($data['cuentaCatastral']['region']);
            $datosPDF['manzana'] = trim($data['cuentaCatastral']['manzana']);
            $datosPDF['lote'] = trim($data['cuentaCatastral']['lote']);
            $datosPDF['unidadprivativa'] = trim($data['cuentaCatastral']['unidadprivativa']);
            $datosPDF['digitoverificador'] = trim($data['cuentaCatastral']['digitoverificador']);
            $datosPDF['cuentaAgua'] = trim($data['cuentaAgua']);
            $datosPDF['propietario']['apellidopaterno'] = trim($data['propietario']['apellidopaterno']);
            $datosPDF['propietario']['apellidomaterno'] = trim($data['propietario']['apellidomaterno']);
            $datosPDF['propietario']['nombre'] = trim($data['propietario']['nombre']);
            $datosPDF['propietario']['calle'] = trim($data['propietario']['calle']);
            $datosPDF['propietario']['numeroexterior'] = trim($data['propietario']['numeroexterior']);
            $datosPDF['propietario']['numerointerior'] = trim($data['propietario']['numerointerior']);
            $datosPDF['propietario']['nombrecolonia'] = trim($data['propietario']['nombrecolonia']);
            $datosPDF['propietario']['nombredelegacion'] = trim($data['propietario']['nombredelegacion']);
            $datosPDF['propietario']['codigopostal'] = trim($data['propietario']['codigopostal']);
            $datosPDF['propietario']['entidad'] = trim("DISTRITO FEDERAL");
            $datosPDF['propietario']['telefono'] = trim("5555555555");
            $datosPDF['inmueble']['calle'] = trim("AAAAAAAAAAAAAAAA");
            $datosPDF['inmueble']['manzana'] = trim("1111");
            $datosPDF['inmueble']['lote'] = trim("1111");
            $datosPDF['inmueble']['numeroexterior'] = trim("1111");
            $datosPDF['inmueble']['numerointerior'] = trim("1111");
            $datosPDF['inmueble']['nombrecolonia'] = trim("AAAAAAAAAAAAA");
            $datosPDF['inmueble']['nombredelegacion'] = trim("AAAAAAAAAAAAA");
            $datosPDF['inmueble']['codigopostal'] = trim("11111");
            $datosPDF['numescritura'] = trim($data['escritura']['numescritura']);
            $datosPDF['fecha'] = Carbon::parse(trim($data['fuenteInformacionLegal']['fecha']))->format('d/m/Y');
            $datosPDF['numnotario'] = trim($data['escritura']['numnotario']);
            $datosPDF['nombrenotario'] = trim($data['escritura']['nombrenotario']);
            $datosPDF['distritojudicialnotario'] = trim($data['escritura']['distritojudicialnotario']);
           
            $formato = view('acuse_pdf', compact("datosPDF"))->render();
            $pdf = PDF::loadHTML($formato);
            $pdf->setOptions(['chroot' => 'public']);
            Storage::put('formato.pdf', $pdf->output());

            return response()->json(['pdfbase64' => base64_encode(Storage::get('formato.pdf')), 'nombre' => $no_unico . '.pdf'], 200);
        } catch (\Throwable $th) {
            error_log($th);
            Log::info($th);
            return response()->json(['mensaje' => 'Error en el servidor'], 500);
        }
    }
}
