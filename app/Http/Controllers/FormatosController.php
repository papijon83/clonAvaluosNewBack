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
            $datosPDF['no_unico'] =  $no_unico;
            $formato = view('justificante', compact("datosPDF"))->render();
            $pdf = PDF::loadHTML($formato);
            $pdf->setOptions(['chroot' => 'public']);
            Storage::put('formato.pdf', $pdf->output());

            return response()->json(['pdfbase64' => base64_encode(Storage::get('formato.pdf')), 'nombre' =>  $no_unico . '.pdf'], 200);
        } catch (\Throwable $th) {
            error_log($th);
            Log::info($th);
            return response()->json(['mensaje' => 'Error en el servidor'], 500);
        }
    }
}
