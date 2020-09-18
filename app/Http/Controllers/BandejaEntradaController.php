<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BandejaEntradaController extends Controller
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

    public function avaluos(Request $request)
    {
        try {
            $fechaIni = $request->query('fecha_ini');
            $fechaFin = $request->query('fecha_fin');
            $noAvaluo = $request->query('no_avaluo');
            $noUnico = $request->query('no_unico');
            $ctaCatastral = $request->query('cta_catastral');
            $table = DB::table('FEXAVA_AVALUO');

            $avaluos = $table->paginate(15);
            return response()->json($avaluos, 200);
        } catch (\Throwable $th) {
            //Log::info($th);
            error_log($th);
            return response()->json(['mensaje' => 'Error en el servidor'], 500);
        }
    }

    public function isai(Request $request)
    {
        try {
            $fechaIni = $request->query('fecha_ini');
            $fechaFin = $request->query('fecha_fin');
            $noAvaluo = $request->query('no_avaluo');
            $noUnico = $request->query('no_unico');
            $ctaCatastral = $request->query('cta_catastral');

            $table = DB::table('FEXAVA_AVALUO');
            $table->join('FEXAVA_CATESTADOSAVALUO', 'FEXAVA_AVALUO.codestadoavaluo', '=', 'FEXAVA_CATESTADOSAVALUO.codestadoavaluo');


            $table->select(
                DB::raw('TRIM(FEXAVA_AVALUO.numerounico) as numerounico'),
                'FEXAVA_AVALUO.numeroavaluo',
                'FEXAVA_AVALUO.region',
                'FEXAVA_AVALUO.manzana',
                'FEXAVA_AVALUO.lote',
                'FEXAVA_AVALUO.unidadprivativa',
                'FEXAVA_AVALUO.fecha_presentacion',
                'FEXAVA_CATESTADOSAVALUO.descripcion as estadoavaluo',
                DB::raw("CASE
                            WHEN FEXAVA_AVALUO.codtipotramite = '1' 
                                THEN 'COM'
                                ELSE 'CAT'
                        END as tipotramite")
            );

            if ($fechaIni && $fechaFin) {
                $fi = new Carbon($fechaIni);
                $ff = new Carbon($fechaFin);
                $table->whereBetween('fecha_presentacion', [$fi->format('Y-m-d'), $ff->format('Y-m-d')]);
            }

            if ($noAvaluo) {
                $table->where('numeroavaluo', $noAvaluo);
            }

            if ($noUnico) {
                $table->where('numerounico', $noUnico);
            }

            if ($ctaCatastral) {
                $cta = explode('-', $ctaCatastral);
                if (count($cta) === 4) {
                    $table->where('region', $cta[0]);
                    $table->where('manzana', $cta[1]);
                    $table->where('lote', $cta[2]);
                    $table->where('unidadprivativa', $cta[3]);
                } else {
                    return response()->json(['mensaje' => 'Formato de cuenta predial incorrecta'], 400);
                }
            }

            $avaluos = $table->paginate(15);
            return response()->json($avaluos, 200);
        } catch (\Throwable $th) {
            //Log::info($th);
            error_log($th);
            return response()->json(['mensaje' => 'Error en el servidor'], 500);
        }
    }

    //
}
