<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Fis
{

    public function getDataByObtenerValorUnitarioConstruccion($codUso,$codClase,$codRangoNiveles,$numeroNiveles,$periodo){
        
        try{
            $anio = date('Y');
            $valUno = '1';
            $procedure = 'BEGIN
            FIS.FIS_VUC_PKG.fis_select_valorunitario_p(
                :par_coduso,
                :par_codclase,
                :par_codrangoniveles,
                :par_numeroniveles,
                :par_ano,
                :par_periodo,
                :c_vuc
            ); END;';
            $conn = oci_connect(env("DB_USERNAME_FIS"), env("DB_PASSWORD"), env("DB_TNS"));
            $stmt = oci_parse($conn, $procedure);
            oci_bind_by_name($stmt, ':par_coduso', $codUso,3);
            oci_bind_by_name($stmt, ':par_codclase', $codClase, 3);
            oci_bind_by_name($stmt, ':par_codrangoniveles', $codRangoNiveles, 2);
            oci_bind_by_name($stmt, ':par_numeroniveles', $numeroNiveles, 3);
            oci_bind_by_name($stmt, ':par_ano',$anio);
            oci_bind_by_name($stmt, ':par_periodo',$valUno);
            $cursor = oci_new_cursor($conn);
            oci_bind_by_name($stmt, ":c_vuc", $cursor, -1, OCI_B_CURSOR);
            oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
            oci_execute($cursor, OCI_COMMIT_ON_SUCCESS);
            oci_free_statement($stmt);
            oci_close($conn);
            oci_fetch_all($cursor, $valores, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($cursor);            
            if (count($valores) > 0) {    
                return tofloat($valores[0]['VALORUNITARIO']);                
            } else {
                return [];
            }

        }catch (\Throwable $th){

            error_log($th);
            Log::info($th);
            return 'Error al obtener la desviación estandar.';
            
        }         

    }
    
}