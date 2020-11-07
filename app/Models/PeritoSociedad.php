<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

class PeritoSociedad
{
    public function getPeritoById($idPersona){

        return DB::table('RCON.RCON_PERITO')
        ->join('RCON.RCON_PERSONAFISICA', 'RCON.RCON_PERSONAFISICA.idpersona', '=', 'RCON.RCON_PERITO.idpersona')
        ->where('RCON.RCON_PERITO.idpersona',$idPersona)->first();

    }

    public function getSociedadByIdPerito($idPersona){

        return DB::table('RCON.RCON_SOCIEDADPERITO')
        ->join('RCON.RCON_PERSONAMORAL', 'RCON.RCON_PERSONAMORAL.idpersona', '=', 'RCON.RCON_SOCIEDADPERITO.IDSOCIEDAD')
        ->where('RCON.RCON_SOCIEDADPERITO.idperito',$idPersona)->first();
        
    }
}