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

    
}


