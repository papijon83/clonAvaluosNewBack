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
            $dsePeritosSociedades = $this->getPeritoById($registroPerito);
            
            if (count($dsePeritosSociedades) > 0)
            {
                return $dsePeritosSociedades;
            }
        }
        else
        {
            $dsePeritosSociedades = $this->getSociedadByIdPerito($registroPerito);

            if (count($dsePeritosSociedades) > 0)
            {
                return $dsePeritosSociedades;
            }
        }

        return -1;
    }

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
        $conn = oci_connect("FIS", env("DB_PASSWORD"), env("DB_TNS"));        
        $sqlcadena = oci_parse($conn, "SELECT * FROM FIS.FIS_RANGONIVELESEJERCICIO WHERE IDRANGONIVELESEJERCICIO  = '$codRangoNiveles'");
        oci_execute($sqlcadena);

        $fila = oci_fetch_array($sqlcadena, OCI_ASSOC+OCI_RETURN_NULLS);
        oci_free_statement($sqlcadena);
        oci_close($conn);

        if(count($fila) == 0){            
            return "el codigo de rango ".$codRangoNiveles." no existe en el catalogo de rangos";
        }else{
            return $fila['IDRANGONIVELESEJERCICIO'];
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