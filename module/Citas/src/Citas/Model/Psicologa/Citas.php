<?php

namespace Citas\Model\Psicologa;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Citas extends TableGateway
{
    
    
    public function __construct(Adapter $adapter = null, $databaseSchema = null, ResultSet $selectResultPrototype = null)
    {
        return parent::__construct('tab_cita', $adapter, $databaseSchema, $selectResultPrototype);
    }
    
    //MODEL fetchAll
    //@param 
    public function addCita($value){
        // return $value;
        return $this->insert($value);
    }

    public  function getCitas(){
        /*return "SELECT cit.idTab_Cita AS idCita, cit.idUsuario AS idUsr, cit.Fecha AS fecha, 
            cit.FechaCita AS fechaCita, cit.Estatus AS estatus, concat(usr.Nombre, ' ', usr.Apellidos) as nombreUsuario
            FROM tab_cita cit
            JOIN tab_usuarios usr on usr.idTab_Usuario = cit.idUsuario;";*/
        return $this->adapter->query("SELECT cit.idTab_Cita AS idCita, cit.idUsuario AS idUsr, cit.Fecha AS fecha, 
        	cit.FechaCita AS fechaCita, cit.Estatus AS estatus, concat(usr.Nombre, ' ', usr.Apellidos) as nombreUsuario
			FROM tab_cita cit
			JOIN tab_usuarios usr on usr.idTab_Usuario = cit.idUsuario;", Adapter::QUERY_MODE_EXECUTE)->toArray();
    }

    public function getHistorialByIdUsr($idUsuario){
        return $this->adapter->query("SELECT idTab_Historial AS idHistorial, idUsuario AS idUsr, Seccion AS seccion, Accion AS action, Description AS descripcion, Fecha AS fecha, Ip AS ip, Dispositivo AS disp FROM tab_historial WHERE idUsuario = '{$idUsuario}';", Adapter::QUERY_MODE_EXECUTE)->toArray();
    }

    public function existePaciente($idUsuario){
        try{
            return $this->adapter->query("SELECT count(1) FROM idTab_Usuario as idUsuario FROM tab_usuarios WHERE idUsuario = '${'idUsuario'}';", Adapter::QUERY_MODE_EXECUTE)->current();
        }
        catch(Exception $e){

        }
    }

    /**
    * Model guardarCampo
    * @param idUsuario
    */
    public function generarCita($idUsuario){
        try{
            $sql_existe = "INSERT INTO tab_cita (idUsuario, Estatus, FechaCita) VALUES ('${'idUsuario'}', 'Pendiente', CURRENT_TIMESTAMP);";
            return $this->adapter->query($sql_existe, Adapter::QUERY_MODE_EXECUTE)->current();
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
    * Model guardarCampo
    * @param idUsuario
    */
    public function guardarPaciente($idUsuario, $alergias){
        try{
            if($this->existePaciente($idUsuario)){
                $sqlInsertaPaciente = "INSERT INTO tab_pacientes (idTab_Usuario, Alergias) VALUES ('${'idUsuario'}', '${'Alergias'}');";
                return $this->adapter->query($sqlInsertaPaciente, Adapter::QUERY_MODE_EXECUTE)->current();
            }
            else{
                $sqlPaciente = "SELECT idTab_Usuario as idUsuario FROM tab_pacientes WHERE idTab_Usuario = '${'idUsuario'}';";
                return $this->adapter->query($sqlPaciente, Adapter::QUERY_MODE_EXECUTE)->current();
            }
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
    * Model guardarCampo
    * @param idUsuario
    */
    public function guardarSintomas($idCita, $sintoma, $intensidad, $frecuencia, $extra = "", $idUsuario){
        try{
            $sql_existe = "INSERT INTO tab_sintomas (idTab_Consulta, Nombre, Intesidad, Frecuencia, DescripcionExtra) VALUES ('${'idCita'}',${'sintoma'}',  '${'intensidad'}', '${'frecuencia'}', '${'extra'}');";
            return $this->adapter->query($sql_existe, Adapter::QUERY_MODE_EXECUTE)->current();
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
    * Model guardarCampo
    * @param idUsuario
    */
    public function guardarRevision($idUsuario){
        try{
            $sql_existe = "SELECT * WHERE id = '${'idUsuario'}';";
            return $this->adapter->query($sql_existe, Adapter::QUERY_MODE_EXECUTE)->current();
        }
        catch(Exception $e){
            return $e;
        }
    }

    /**
    * Model guardarCampo
    * @param idUsuario
    */
    public function guardarTratamiento($idUsuario){
        try{
            $sql_existe = "SELECT * WHERE id = '${'idUsuario'}';";
            return $this->adapter->query($sql_existe, Adapter::QUERY_MODE_EXECUTE)->current();
        }
        catch(Exception $e){
            return $e;
        }
    }

}


