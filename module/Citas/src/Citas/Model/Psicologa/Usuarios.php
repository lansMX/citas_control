<?php

namespace Citas\Model\Psicologa;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Usuarios extends TableGateway
{
    
    
    public function __construct(Adapter $adapter = null, $databaseSchema = null, ResultSet $selectResultPrototype = null)
    {
        return parent::__construct('Tab_Usuarios', $adapter, $databaseSchema, $selectResultPrototype);
    }
    
    //MODEL fetchAll
    //@param 
    public function fetchAll(){
        return $this->adapter->query("SELECT * FROM Tab_Usuarios", Adapter::QUERY_MODE_EXECUTE)->toArray();
    }

    public function getAuth($usr, $pswd){
        return $this->adapter->query("SELECT idTab_Usuario as idUsuario, Nombre as nombre, Usuario as user, idTipoUsuario as idTipoUsr FROM Tab_Usuarios WHERE (Usuario = '{$usr}' || Nombre = '{$usr}') && Password = '{$pswd}'; ", Adapter::QUERY_MODE_EXECUTE)->current();
    }

    public function getAllUsuarios(){
        $sqlUsuarios = "SELECT u.idTab_Usuario AS idUsuario, u.Nombre AS nombre, u.Usuario AS usuario, u.PASsword AS pswd, u.Apellidos AS apat, u.Foto as imgUsr, u.Telefono AS tel, u.Email AS mail, u.Direccion AS dir, tu.idTab_TipoUsuario AS idTipoUsuario, tu.Nombre AS tipoUsuario FROM tab_usuarios u JOIN tab_tipousuario tu on tu.idTab_TipoUsuario = u.idTab_Usuario; ";
        // return $sqlUsuarios;
        return $this->adapter->query($sqlUsuarios, Adapter::QUERY_MODE_EXECUTE)->toArray();
    }

    public function getBsqlUsuarios($criterio){
        $sqlUsuarios = "SELECT u.idTab_Usuario AS idUsuario, u.Nombre AS nombre, u.Usuario AS usuario, u.PAssword AS pswd, u.Apellidos AS apat, u.Telefono AS tel, u.Email AS mail, u.Direccion AS dir, tu.idTab_TipoUsuario AS idTipoUsuario, tu.Nombre AS tipoUsuario 
            FROM tab_usuarios u 
            JOIN tab_tipousuario tu on tu.idTab_TipoUsuario = u.idTab_Usuario
            WHERE u.Nombre like '%{$criterio}%' || u.Usuario like '%{$criterio}%' || u.idTab_Usuario = '{$criterio}'; ";
        // return $sqlUsuarios;
        return $this->adapter->query($sqlUsuarios, Adapter::QUERY_MODE_EXECUTE)->toArray();
    } 

    public function getSugestUsuarios($criterio){
        $criterio = trim($criterio);
        $sqlUsuarios = "SELECT u.idTab_Usuario AS idUsuario, u.Nombre AS nombre, u.Usuario AS usuario, u.PASsword AS pswd, u.Apellidos AS apat, u.Telefono AS tel, u.Email AS mail, u.Direccion AS dir, tu.idTab_TipoUsuario AS idTipoUsuario, tu.Nombre AS tipoUsuario, Foto as imgUsr 
            FROM tab_usuarios u 
            JOIN tab_tipousuario tu on tu.idTab_TipoUsuario = u.idTab_Usuario
            WHERE u.Nombre like '%{$criterio}%' || u.Usuario like '%{$criterio}%' || u.idTab_Usuario like '%{$criterio}%'; ";
        return $this->adapter->query($sqlUsuarios, Adapter::QUERY_MODE_EXECUTE)->toArray();
    } 

    public function getListaSugerenciaUsuarios($criterio){
        $criterio = trim($criterio);
        $sqlUsuarios = "SELECT idTab_Usuario as idUsuario, concat(Nombre, ' ', Apellidos) as nombreCompleto, fechaNacimiento as fechaNaciemiento, Foto as foto FROM tab_usuarios WHERE Nombre like '%${'criterio'}%' || Apellidos like '%${'criterio'}%' LIMIT 15;";
        return $this->adapter->query($sqlUsuario, Adapter::QUERY_MODE_EXECUTE)->toArray();
    }


    public function getSugerenciaUsuariosConsulta($criterio){
        $criterio = trim($criterio);
        $sqlUsuarios = "SELECT idTab_Usuario as idUsuario, concat(Nombre, ' ', Apellidos) as nombreCompleto, fechaNacimiento as fechaNaciemiento FROM tab_usuarios WHERE Nombre like '%${'criterio'}%' || Apellidos like '%${'criterio'}%' LIMIT 5;";
        return $this->adapter->query($sqlUsuarios, Adapter::QUERY_MODE_EXECUTE)->toArray();
    }


    /* Pacientes*/
    public function getAllPacientes(){
        $sqlUsuarios = "SELECT u.idTab_Usuario AS idUsuario, u.Nombre AS nombre, u.Usuario AS usuario, u.PASsword AS pswd, u.Apellidos AS apat, u.Foto as imgUsr, u.Telefono AS tel, u.Email AS mail, u.Direccion AS dir, tu.idTab_TipoUsuario AS idTipoUsuario, tu.Nombre AS tipoUsuario FROM tab_usuarios u JOIN tab_tipousuario tu on tu.idTab_TipoUsuario = u.idTab_Usuario WHERE tu.idTab_TipoUsuario = 3; ";

        return $this->adapter->query($sqlUsuarios, Adapter::QUERY_MODE_EXECUTE)->toArray();
    }

    public function getSugestPacientes($criterio){
        $criterio = trim($criterio);
        $sqlUsuarios = "SELECT u.idTab_Usuario AS idUsuario, u.Nombre AS nombre, u.Usuario AS usuario, u.PASsword AS pswd, u.Apellidos AS apat, u.Telefono AS tel, u.Email AS mail, u.Direccion AS dir, tu.idTab_TipoUsuario AS idTipoUsuario, tu.Nombre AS tipoUsuario, Foto as imgUsr 
            FROM tab_usuarios u 
            JOIN tab_tipousuario tu on tu.idTab_TipoUsuario = u.idTab_Usuario
            WHERE u.Nombre like '%{$criterio}%' || u.Usuario like '%{$criterio}%' || u.idTab_Usuario like '%{$criterio}%' && tu.idTab_TipoUsuario = 3; ";
        return $this->adapter->query($sqlUsuarios, Adapter::QUERY_MODE_EXECUTE)->toArray();
    } 






    public function selectEmpresa($id)
    {
        
        $SQL = "SELECT * from Tab_Empresa empresa INNER JOIN Tab_Usuarios usuario on  empresa.idTab_Usuarios = usuario.idTab_Usuarios where empresa.NombreEmpresa like'{$id}%'";
        
        $rowset = $this->adapter->query($SQL, Adapter::QUERY_MODE_EXECUTE);
        
        return $rowset->toArray();
    }
    
    
    /*
        public function InsertarEmpresa($data = array()) {
            $this->insert($data);
        }
    */
    public function ActualizarPerfil($id, $perfil)
    {
        try {
            $this->update(array('PerfilPublico' => $perfil), array('idTab_Usuarios' => $id));
            
            return $id;
        } catch (Zend_Exception $e) {
            return false;
        }
    }
    
    public function getInfGeneral($idUsuario)
    {
        $SQL = "SELECT Nombre, Apellidos, FechaNacimiento, idCat_Paises, idCat_Estado,  ";
        $SQL .= "idCat_Municipio, CodigoPostal, Nacionalidad, TipoLicenciaConducir, Telefono1, Foto  ";
        $SQL .= "FROM Tab_Usuarios ";
        $SQL .= "WHERE idTab_Usuarios = $idUsuario ";
        $rowset = $this->adapter->query($SQL, Adapter::QUERY_MODE_EXECUTE);
        
        return $rowset->current();
    }

    public function getInfGeneralApp($idUsuario)
    {
        $SQL = "SELECT * ";
        $SQL .= "FROM Tab_Usuarios ";
        $SQL .= "WHERE idTab_Usuarios = $idUsuario ";
        $rowset = $this->adapter->query($SQL, Adapter::QUERY_MODE_EXECUTE);
        
        return $rowset->current();
    }
    
    public function updateFotoPerfil($idUsuario, $arch)
    {
        try {
            $this->update(array('Foto' => $arch), array('idTab_Usuarios' => $idUsuario));
            
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    
    public function getFotoById($idUsuario)
    {
        $SQL = "SELECT Foto FROM Tab_Usuarios WHERE idTab_Usuarios = $idUsuario; ";
        
        return $this->adapter->query($SQL, Adapter::QUERY_MODE_EXECUTE)->current();
    }
    
    public function getFullName($idUsuario)
    {
        $SQL = "SELECT Nombre, Apellidos FROM Tab_Usuarios WHERE idTab_Usuarios = $idUsuario; ";
        
        return $this->adapter->query($SQL, Adapter::QUERY_MODE_EXECUTE)->current();
    }
    
    
    public function loguearce($nombre, $contrasena)
    {
        $SQL = "SELECT tu.*, tu.Usuario, tu.Contrasena, tu.TipoUsuario FROM Tab_Usuarios tu WHERE
                tu.Usuario = '$nombre' &&
                tu.Contrasena = '$contrasena' &&
                tu.TipoUsuario = 'Administrador' &&
                tu.Estatus = 'Activo'";
        
        return $this->adapter->query($SQL, Adapter::QUERY_MODE_EXECUTE)->current();
    }
    
    
    //funcion temporl
    public function listarUsuariosPostulantes()
    {
        $SQL = "SELECT idTab_Usuarios, Nombre, Apellidos FROM Tab_Usuarios WHERE TipoUsuario = 'Postulante' ";
        
        return $this->adapter->query($SQL, Adapter::QUERY_MODE_EXECUTE)->toArray();
        
    }
    
    public function eliminarfoto($usuario)
    {
        try {
            $this->update(array('Foto' => null), array('idTab_Usuarios' => $usuario));
            
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    
    public function get_Info_Usuario_By_idTab_Usuarios($idTab_Usuarios)
    {
        $result = $this->select(array('idTab_Usuarios' => $idTab_Usuarios));
        return $result->current();
    }

    public function ExisteCorreo($correo){
        $sql = "SELECT COUNT(idTab_Usuarios) AS existe FROM Tab_Usuarios WHERE Usuario = '$correo' ";
        echo $sql;
        return $this->adapter->query($sql, Adapter::QUERY_MODE_EXECUTE)->current()->existe;
    }

    public function ObtenerCorreoPorID($id){
        $sql = "SELECT Usuario AS correo FROM Tab_Usuarios WHERE idTab_Usuarios = '$id' LIMIT 1";
        return $this->adapter->query($sql, Adapter::QUERY_MODE_EXECUTE)->current()->correo;
    }
    public function GuardarCodigoSeguridad($correo, $codigo){
        $sql = "UPDATE Tab_Usuarios SET CodigoSeguridad = '$codigo' WHERE Usuario = '$correo' ";
        return $this->adapter->query($sql, Adapter::QUERY_MODE_EXECUTE);
    }

    public function VerificarCodigo($codigo, $hash){
        $sql = "SELECT idTab_Usuarios AS id FROM Tab_Usuarios WHERE md5(Usuario) = '$hash' AND CodigoSeguridad = '$codigo' LIMIT 1";
        return $this->adapter->query($sql, Adapter::QUERY_MODE_EXECUTE)->current()->id;
    }

    public function ActualizarContrasena($usuario, $contrasena){
        $sql = "UPDATE Tab_Usuarios SET Contrasena = '$contrasena', CodigoSeguridad = NULL WHERE idTab_Usuarios = '$usuario' ";
        return $this->adapter->query($sql, Adapter::QUERY_MODE_EXECUTE);
    }

    // Tabla de porcentajes
    // 25% Datos personales
    // 20% Formaciones y Experiencia Profesional
    // 10% Archivos y Conocimientos
    // 7% Perfil Profesional
    // 3% Idiomas
    public function porcentajeDatosPersonales($idUsr){
        $sql = "SELECT ";
        $sql .= "SUM( ";
        $sql .= "if(Usuario is null, 0, 1)+ ";
        $sql .= "if(Contrasena is null, 0, 1)+ ";
        $sql .= "if(Nombre is null, 0, 1)+ ";
        $sql .= "if(Apellidos is null, 0, 1)+ ";
        $sql .= "if(Correo is null, 0, 1)+ ";
        $sql .= "if(Edad is null, 0, 1)+ ";
        $sql .= "if(FechaNacimiento is null, 0, 1)+ ";
        $sql .= "if(Telefono1 is null, 0, 1)+ ";
        $sql .= "if(idCat_Paises is null, 0, 1)+ ";
        $sql .= "if(idCat_Estado is null, 0, 1)+ ";
        $sql .= "if(idCat_Municipio is null, 0, 1)+ ";
        $sql .= "if(CodigoPostal is null, 0, 1)+ ";
        $sql .= "if(Foto is null, 0, 1)+ ";
        $sql .= "if(TipoLicenciaConducir is null, 0, 1)+ ";
        $sql .= "if(Nacionalidad is null, 0, 1) ";
        $sql .= ") as camposCompletos ";
        $sql .= "FROM ";
        $sql .= "Tab_Usuarios ";
        $sql .= "WHERE ";
        $sql .= "idTab_Usuarios = $idUsr; ";
        //Se concideran 15 campos como informacion completa
        $totalRegistro = $this->adapter->query($sql, Adapter::QUERY_MODE_EXECUTE)->current()['camposCompletos']; 
        return round((($totalRegistro * 25) / 15 ), 2);
    }
}
