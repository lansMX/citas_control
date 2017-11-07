<?php

namespace Citas\Model\Psicologa;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Historial extends TableGateway
{
    
    
    public function __construct(Adapter $adapter = null, $databaseSchema = null, ResultSet $selectResultPrototype = null)
    {
        return parent::__construct('tab_historial', $adapter, $databaseSchema, $selectResultPrototype);
    }
    
    //MODEL fetchAll
    //@param 
    public function addHistorial($value){
        // return $value;
        return $this->insert($value);
    }

    public  function getHistorial(){
        return $this->adapter->query("SELECT idTab_Historial as idHistorial, idUsuario as idUsr, Seccion as seccion, Accion as action, Description as descripcion, Fecha as fecha, Ip as ip, Dispositivo as disp FROM tab_historial; ", Adapter::QUERY_MODE_EXECUTE)->toArray();
    }

    public function getHistorialByIdUsr($idUsuario){
        return $this->adapter->query("SELECT idTab_Historial as idHistorial, idUsuario as idUsr, Seccion as seccion, Accion as action, Description as descripcion, Fecha as fecha, Ip as ip, Dispositivo as disp FROM tab_historial WHERE idUsuario = '{$idUsuario}';", Adapter::QUERY_MODE_EXECUTE)->toArray();
    }

    
}
