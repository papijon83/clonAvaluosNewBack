<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Documentos
{

    public function insertDocumentoDigital($cuentaCatastral,$tipoDocumentoDigital,$idUsuario){
        
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

    }

    public function insertDocumentoDigitalFoto($nombreFoto,$tipoDocumentoDigital,$fechaAvaluo,$idUsuario){
        
        $idDocumentoDigital = 0;
        $descripcion = $nombreFoto;
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

    public function tran_InsertFotoInmueble($fichero, $nombreFoto, $fechaAvaluo, $tipoFoto, $idUsuario){
        $descripcion = "Foto_".$nombreFoto;
        $idDocumentoDigital = $this->insertDocumentoDigitalFoto($descripcion,3,$fechaAvaluo,$idUsuario);
        $idficherodoc = $this->tran_InsertFichero($idDocumentoDigital,$nombreFoto,$nombreFoto,$fichero);
        $this->InsertFotoInmueble($idDocumentoDigital, $tipoFoto);

    }
}