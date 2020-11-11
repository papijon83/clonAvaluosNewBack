<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatosExtrasAvaluo
{
    public function IdPeritoSociedadByRegistro($registroPerito, $esPerito)
    {
        $dsePeritosSociedades = array();

        if ($esPerito)
        { 
            $dsePeritosSociedades = $this->modelPeritoSociedad->getPeritoById($registroPerito);

            if (count($dsePeritosSociedades) > 0)
            {
                return $dsePeritosSociedades;
            }
        }
        else
        {
            $dsePeritosSociedades = $this->modelPeritoSociedad->getSociedadByIdPerito($registroPerito);

            if (count($dsePeritosSociedades) > 0)
            {
                return $dsePeritosSociedades;
            }
        }

        return -1;
    }

    public function ObtenerIdDelegacionPorNombre($nombreDelegacion)
    {
        $nombreDelegacion = strtoupper($nombreDelegacion);
        
        $rowsDelegaciones = DB::select("SELECT * FROM CAS.CAS_DELEGACION WHERE NOMBRE = '$nombreDelegacion'");

        if (count($rowsDelegaciones) > 0)
        {
            $idDelegacion = $rowsDelegaciones[0]->iddelegacion;
        }
        else
        {
            return -1;
        }

        return $idDelegacion;
    }

    public function ObtenerIdDelegacionPorClave($codDelegacion)
    {        
        $rowsDelegaciones = DB::select("SELECT * FROM CAS.CAS_DELEGACION WHERE CLAVE = '$codDelegacion'");

        if (count($rowsDelegaciones) > 0)
        {
            $idDelegacion = $rowsDelegaciones[0]->iddelegacion;
        }
        else
        {
            return -1;
        }

        return $idDelegacion;
    }

    public function ObtenerIdColoniaPorNombreyDelegacion($nombreColonia, $codDelegacion)
    {
        $nombreColonia = strtoupper($nombreColonia);

        $rowsDelegaciones = DB::select("SELECT * FROM CAS.CAS_DELEGACION WHERE CLAVE = '$codDelegacion'");

        if (count($rowsDelegaciones) > 0)
        {
            $idDelegacion = $rowsDelegaciones[0]->iddelegacion;
        }
        else
        {
            return -1;
        }

        $rowsColonias = DB::select("SELECT * FROM CAS.CAS_COLONIA WHERE NOMBRE = '$nombreColonia' AND IDDELEGACION = '$idDelegacion'");

        if (count($rowsColonias) > 0)
        {
            $idColonia = $rowsColonias[0]->idcolonia;
        }
        else
        {
            return -1;
        }

        return $idColonia;
    }

    public function SolicitarObtenerIdClasesByCodeAndAno($fecha, $codClase)
    {
        //FIS_CLASESEJERCICIO
        $c_filtro = DB::select("SELECT * FROM FIS.FIS_CATCLASES WHERE CODCLASE = '$codClase'");

        if(count($c_filtro) == 0){            
            return "el codigo de clase ".$codClase." no existe en el catalogo de clases";
        }else{
            return $c_filtro[0]->idclases;
        }
    }

    public function SolicitarObtenerIdUsosByCodeAndAno($fecha, $codUso)
    {
        //FIS_USOSEJERCICIO
        $c_filtro = DB::select("SELECT * FROM FIS.FIS_CATUSOS WHERE CODUSO = '$codUso'");

        if(count($c_filtro) == 0){            
            return "el codigo de uso ".$codUso." no existe en el catalogo de usos";
        }else{
            return $c_filtro[0]->idusos;
        }
    }

    public function SolicitarObtenerIdRangoNivelesByCodeAndAno($fecha, $codRangoNiveles)
    {
        //FIS_RANGONIVELESEJERCICIO - ORA-01031: privilegios insuficientes
        //$c_filtro = DB::select("SELECT * FROM FIS.FIS_RANGONIVELESEJERCICIO");
        $c_filtro = DB::select("SELECT * FROM FIS.FIS_CATUSOS WHERE CODUSO = '$codRangoNiveles'");

        if(count($c_filtro) == 0){            
            return "el codigo de rango ".$codRangoNiveles." no existe en el catalogo de rangos";
        }else{
            return $c_filtro;
        }
    }

    public function ObtenerClaseUsoByIdUsoIdClase($idUsoEjercicio, $idClaseEjercicio)
    {
        //FEXAVA_CATCLASEUSO - ORA-00942: la tabla o vista no existe
        //$c_claseUso = DB::select("SELECT * FROM FEXAVA_CATCLASEUSO");
        $c_claseUso = DB::select("SELECT * FROM FIS.FIS_CATUSOS WHERE CODUSO = '$idUsoEjercicio'");
        return $c_claseUso;
    }
}