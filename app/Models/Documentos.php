<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Documentos
{

    /*public function insertDocumentoDigital($cuentaCatastral,$tipoDocumentoDigital,$idUsuario){
        
        $idDocumentoDigital = 0;
        $descripcion = "Avaluo_".$cuentaCatastral;
        $fecha_hoy = new Carbon(date('Y-m-d'));
        $fecha = $fecha_hoy->format('d/m/y');
        //echo "SOY FECHA ".$fecha; exit();
        $procedure = 'BEGIN
        DOC.DOC_DOCUMENTOS_DIGITALES_PCKG.DOC_INSERTDOCUMENTODIGITAL_P(
            :P_DESCRIPCION,
            :P_IDTIPODOCUMENTODIGITAL,
            :P_FECHA,
            :P_IDUSUARIO,
            :P_IDDOCUMENTODIGITAL
        ); END;';
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare($procedure);
        $stmt->bindParam(':P_DESCRIPCION', $descripcion, \PDO::PARAM_STR);
        $stmt->bindParam(':P_IDTIPODOCUMENTODIGITAL',$tipoDocumentoDigital, \PDO::PARAM_INT);
        $stmt->bindParam(':P_FECHA',$fecha,\PDO::PARAM_STR);
        $stmt->bindParam(':P_IDUSUARIO',$idUsuario,\PDO::PARAM_INT);
        $stmt->bindParam(':P_IDDOCUMENTODIGITAL',$idDocumentoDigital,\PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        $pdo->commit();
        $pdo->close();
        DB::commit();
        DB::reconnect();
        return $idDocumentoDigital ? $idDocumentoDigital : 0;    

    }*/

    public function tran_InsertAvaluo($descripcion,$tipoDocumentoDigital,$fecha,$idUsuario){
        
        $idDocumentoDigital = 0;
        //$descripcion = "Avaluo_".$cuentaCatastral;
        $fecha_hoy = new Carbon($fecha);
        $fecha = $fecha_hoy->format('d/m/y');
        //echo "SOY FECHA ".$fecha; exit();
        $procedure = 'BEGIN
        DOC.DOC_DOCUMENTOS_DIGITALES_PCKG.DOC_INSERTDOCUMENTODIGITAL_P(
            :P_DESCRIPCION,
            :P_IDTIPODOCUMENTODIGITAL,
            :P_FECHA,
            :P_IDUSUARIO,
            :P_IDDOCUMENTODIGITAL
        ); END;';
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare($procedure);
        $stmt->bindParam(':P_DESCRIPCION', $descripcion, \PDO::PARAM_STR);
        $stmt->bindParam(':P_IDTIPODOCUMENTODIGITAL',$tipoDocumentoDigital, \PDO::PARAM_INT);
        $stmt->bindParam(':P_FECHA',$fecha,\PDO::PARAM_STR);
        $stmt->bindParam(':P_IDUSUARIO',$idUsuario,\PDO::PARAM_INT);
        $stmt->bindParam(':P_IDDOCUMENTODIGITAL',$idDocumentoDigital,\PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        $pdo->commit();
        $pdo->close();
        DB::commit();
        DB::reconnect();
        return $idDocumentoDigital ? $idDocumentoDigital : 0;    

    }

    public function insertDocumentoDigitalFoto($descripcion,$tipoDocumentoDigital,$fechaAvaluo,$idUsuario){
        
        $idDocumentoDigital = 0;
        //$descripcion = $nombreFoto;
        $fecha_ini = new Carbon($fechaAvaluo);
        $fecha = $fecha_ini->format('d/m/y');
        //echo "SOY FECHA ".$fecha; exit();
        $procedure = 'BEGIN
        DOC.DOC_DOCUMENTOS_DIGITALES_PCKG.DOC_INSERTDOCUMENTODIGITAL_P(
            :P_DESCRIPCION,
            :P_IDTIPODOCUMENTODIGITAL,
            :P_FECHA,
            :P_IDUSUARIO,
            :P_IDDOCUMENTODIGITAL
        ); END;';
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare($procedure);
        $stmt->bindParam(':P_DESCRIPCION', $descripcion, \PDO::PARAM_STR);
        $stmt->bindParam(':P_IDTIPODOCUMENTODIGITAL',$tipoDocumentoDigital, \PDO::PARAM_INT);
        $stmt->bindParam(':P_FECHA',$fecha,\PDO::PARAM_STR);
        $stmt->bindParam(':P_IDUSUARIO',$idUsuario,\PDO::PARAM_INT);
        $stmt->bindParam(':P_IDDOCUMENTODIGITAL',$idDocumentoDigital,\PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        $pdo->commit();
        $pdo->close();
        DB::commit();
        DB::reconnect();
        return $idDocumentoDigital ? $idDocumentoDigital : 0;    

    }

    public function tran_InsertFichero($idDocumentoDigital,$nombre,$descripcion,$binarioDatos){
        
        $idficherodoc = 0;     
        $procedure = 'BEGIN
        DOC.DOC_DOCUMENTOS_DIGITALES_PCKG.DOC_INSERTFICHERODOCUMENTO_P(
            :P_IDDOCUMENTODIGITAL,
            :P_NOMBRE,
            :P_DESCRIPCION,
            :P_BINARIODATOS,
            :P_IDFICHERODOC
        ); END;';
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare($procedure);
        $stmt->bindParam(':P_IDDOCUMENTODIGITAL', $idDocumentoDigital, \PDO::PARAM_INT);
        $stmt->bindParam(':P_NOMBRE',$nombre, \PDO::PARAM_STR);
        $stmt->bindParam(':P_DESCRIPCION',$descripcion,\PDO::PARAM_STR);
        $stmt->bindParam(':P_BINARIODATOS',$binarioDatos,\PDO::PARAM_LOB);
        $stmt->bindParam(':P_IDFICHERODOC',$idficherodoc,\PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        $pdo->commit();
        $pdo->close();
        DB::commit();
        DB::reconnect();
        return $idficherodoc ? $idficherodoc : 0;    

    }

    public function tran_InsertFicheroAvaluo($idDocumentoDigital,$nombre,$descripcion,$binarioDatos){
        
        $idficherodoc = 0;
        $rutaArchivos = getcwd();
        $nombreDes = $binarioDatos;

        $myfile = fopen($rutaArchivos."/".$nombreDes, "r");
        $binarioDatos = fread($myfile, filesize($rutaArchivos."/".$nombreDes));        
        fclose($myfile);  

        $procedure = 'BEGIN
        DOC.DOC_DOCUMENTOS_DIGITALES_PCKG.DOC_INSERTFICHERODOCUMENTO_P(
            :P_IDDOCUMENTODIGITAL,
            :P_NOMBRE,
            :P_DESCRIPCION,
            :P_BINARIODATOS,
            :P_IDFICHERODOC
        ); END;';
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare($procedure);
        $stmt->bindParam(':P_IDDOCUMENTODIGITAL', $idDocumentoDigital, \PDO::PARAM_INT);
        $stmt->bindParam(':P_NOMBRE',$nombre, \PDO::PARAM_STR);
        $stmt->bindParam(':P_DESCRIPCION',$descripcion,\PDO::PARAM_STR);
        $stmt->bindParam(':P_BINARIODATOS',$binarioDatos,\PDO::PARAM_LOB);
        $stmt->bindParam(':P_IDFICHERODOC',$idficherodoc,\PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        $pdo->commit();
        $pdo->close();
        DB::commit();
        DB::reconnect();

        shell_exec("rm -f ".$rutaArchivos."/".str_replace(" ","\ ",$nombreDes));

        return $idficherodoc ? $idficherodoc : 0;    

    }

    public function InsertFotoInmueble($idDocumentoDigital, $tipoFotoInm){

        $procedure = 'BEGIN
        DOC.DOC_DOCUMENTOS_DIGITALES_PCKG.DOC_INSERTDOCFOTOINMUEBLE_P(
            :P_IDDOCUMENTODIGITAL,
            :P_CODTIPOFOTOINMUEBLE
        ); END;';
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare($procedure);
        $stmt->bindParam(':P_IDDOCUMENTODIGITAL', $idDocumentoDigital, \PDO::PARAM_INT);
        $stmt->bindParam(':P_CODTIPOFOTOINMUEBLE',$tipoFotoInm, \PDO::PARAM_STR);        
        $stmt->execute();
        $stmt->closeCursor();
        $pdo->commit();
        $pdo->close();
        DB::commit();
        DB::reconnect();
    }

    public function tran_InsertFotoInmueble($fichero, $nombreFoto, $descripcion, $fechaAvaluo, $tipoFoto, $idUsuario){
        //$descripcion = "Foto_".$nombreFoto;
        $idDocumentoDigital = $this->insertDocumentoDigitalFoto($descripcion,3,$fechaAvaluo,$idUsuario);
        $idficherodoc = $this->tran_InsertFichero($idDocumentoDigital,$nombreFoto,$nombreFoto,$fichero);
        $this->InsertFotoInmueble($idDocumentoDigital, $tipoFoto);
        return $idDocumentoDigital ? $idDocumentoDigital : 0;
    }

    public function get_numero_unico_db($idAvaluo){         
        $numeroUnicoAvaluo = convierte_a_arreglo(DB::select("SELECT NUMEROUNICO FROM FEXAVA_AVALUO WHERE IDAVALUO = $idAvaluo"));
        return trim($numeroUnicoAvaluo[0]['numerounico']);
    }

    public function get_idavaluo_db($numeroUnico){
        $numeroUnicoAvaluo = convierte_a_arreglo(DB::select("SELECT IDAVALUO FROM FEXAVA_AVALUO WHERE NUMEROUNICO = '$numeroUnico'"));
        return trim($numeroUnicoAvaluo[0]['idavaluo']);
    }

    public function valida_existencia($numeroAvaluo,$idpersona_perito){
        $rowsAvaluos = convierte_a_arreglo(DB::select("SELECT * FROM FEXAVA_AVALUO WHERE NUMEROAVALUO = '$numeroAvaluo' AND IDPERSONAPERITO = $idpersona_perito AND CODESTADOAVALUO != 2"));
        if(count($rowsAvaluos) > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
}