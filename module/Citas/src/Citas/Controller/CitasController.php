<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Citas\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Citas\Model\Psicologa\Usuarios;
use Citas\Model\Psicologa\Historial;
use Citas\Model\Psicologa\Citas;

class CitasController extends AbstractActionController
{
	
	public $Adapter;// base de datos
    private $auth;//autenticacion Sesion

    public function __construct() {
        //Cargamos el servicio de autenticacion en el constructor
        $this->auth = new AuthenticationService();        
    }
    
    //CONTROLLER panelprincipal
    public function panelprincipalAction(){
        $identify = $this->auth->getStorage()->read();
        if ($identify) {
            
            $view = new ViewModel();
            $this->layout('layout/layoutCitas');
            $this->layout()->sesion = $identify;
            return $view;
        }   
        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . '/index/index');
    }

    public function indexAction()
    {
        $identify = $this->auth->getStorage()->read();

		$this->Adapter = $this->getServiceLocator()->get('Zend\Db\Adapter');
		$dataUsuario = new Usuarios($this->Adapter);
        $usuario = $dataUsuario->fetchAll();

        $index['usuario'] = $usuario;
        
        $action = $this->getRequest()->getServer()->get('REQUEST_URI');
        $this->addHistorial($action, "", "citas>index Vista");

        $this->layout('layout/layout');
        $this->layout()->sesion = $identify;
        $view = new ViewModel($index);
        return $view;
    }

    public function loginAction(){
    	return new ViewModel();
    }

    public function agendaAction(){
        $identify = $this->auth->getStorage()->read();

        if ($identify) {
            // $action = $this->getRequest()->getServer()->get('REQUEST_URI');
            // $this->addHistorial($action, "", "citas>agenda Vista");

            $view = new ViewModel();
            $this->layout('layout/layoutCitas');
            $this->layout()->sesion = $identify;
            return $view;
        }   
        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . '/index/index');
    }

    public function editsitioAction(){
        $identify = $this->auth->getStorage()->read();

        if ($identify) {
            // $view = new ViewModel(['Json' => json_encode($rest)]);
            $view = new ViewModel();
            $this->layout('layout/layoutCitas');
            $this->layout()->sesion = $identify;
            // $view->setTerminal(true);
            return $view;
        }   
        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . '/index/index');
    }

    public function historialAction(){
        $identify = $this->auth->getStorage()->read();

        if ($identify) {
            // $view = new ViewModel(['Json' => json_encode($rest)]);
            $view = new ViewModel();
            $this->layout('layout/layoutCitas');
            $this->layout()->sesion = $identify;
            // $view->setTerminal(true);
            return $view;
        }   
        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . '/index/index');
    }

    public function notasAction(){
        $identify = $this->auth->getStorage()->read();

        if ($identify) {
            // $view = new ViewModel(['Json' => json_encode($rest)]);
            $view = new ViewModel();
            $this->layout('layout/layoutCitas');
            $this->layout()->sesion = $identify;
            // $view->setTerminal(true);
            return $view;
        }   
        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . '/index/index');
    }

    public function pacientesAction(){
        $identify = $this->auth->getStorage()->read();

        if ($identify) {
            // $view = new ViewModel(['Json' => json_encode($rest)]);
            $view = new ViewModel();
            $this->layout('layout/layoutCitas');
            $this->layout()->sesion = $identify;
            // $view->setTerminal(true);
            return $view;
        }   
        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . '/index/index');
    }

    public function pagosAction(){
        $identify = $this->auth->getStorage()->read();

        if ($identify) {
            // $view = new ViewModel(['Json' => json_encode($rest)]);
            $view = new ViewModel();
            $this->layout('layout/layoutCitas');
            $this->layout()->sesion = $identify;
            // $view->setTerminal(true);
            return $view;
        }   
        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . '/index/index');
    }

    public function registrosAction(){
        $identify = $this->auth->getStorage()->read();

        if ($identify) {
            // $view = new ViewModel(['Json' => json_encode($rest)]);
            $view = new ViewModel();
            $this->layout('layout/layoutCitas');
            $this->layout()->sesion = $identify;
            // $view->setTerminal(true);
            return $view;
        }   
        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . '/index/index');
    }

    public function usuariosAction(){
        $identify = $this->auth->getStorage()->read();

        if ($identify) {
            // $view = new ViewModel(['Json' => json_encode($rest)]);
            $view = new ViewModel();
            $this->layout('layout/layoutCitas');
            $this->layout()->sesion = $identify;
            // $view->setTerminal(true);
            return $view;
        }   
        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . '/index/index');
    }

    //CONTROLLER consultar
    public function consultarAction(){
        $identify = $this->auth->getStorage()->read();

        if ($identify) {
            
            $view = new ViewModel();
            $this->layout('layout/layoutCitas');
            $this->layout()->sesion = $identify;
            return $view;
        }   
        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . '/index/index');
    }

/*----------------------------------------------------------*
*                      MODULO PACIENTES                     *
*-----------------------------------------------------------*/
    //CONTROLLER getpacientes
    public function getpacientesAction(){
        $identify = $this->auth->getStorage()->read();
        if ($identify) {
            $this->Adapter = $this->getServiceLocator()->get('Zend\Db\Adapter');
            $DBUsuarios = new Usuarios($this->Adapter);
            $usuario = $DBUsuarios->getAllPacientes();

            $view = new ViewModel( ['Json' => json_encode(['data' => $usuario])] );
            $view->setTemplate('citas/index/json');
            $view->setTerminal(true);
            return $view;
        }
        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . '/');
    }

    public function sugerirpacientesAction(){
        $identify = $this->auth->getStorage()->read();
        if ($identify) {
            $busqueda = $this->getRequest()->getPost('criterio');

            $this->Adapter = $this->getServiceLocator()->get('Zend\Db\Adapter');
            $DBUsuarios = new Usuarios($this->Adapter);
            $usuario = $DBUsuarios->getSugestPacientes($busqueda);

            $view = new ViewModel( ['Json' => json_encode(['data' => $usuario])] );
            $view->setTemplate('citas/index/json');
            $view->setTerminal(true);
            return $view;
        }
        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . '/');
    }
/*----------------------------------------------------------*
*                       MODULO USUARIOS                     *
*-----------------------------------------------------------*/
    public function getsuariosAction(){
        $identify = $this->auth->getStorage()->read();
        if ($identify) {
            $this->Adapter = $this->getServiceLocator()->get('Zend\Db\Adapter');
            $busqueda = $this->getRequest()->getPost('criterio');

            $DBUsuarios = new Usuarios($this->Adapter);
            if ($busqueda == 'all') {
                $usuario = $DBUsuarios->getAllUsuarios();
            }
            else{
                $usuario = $DBUsuarios->getBsqlUsuarios($busqueda);
            }

            $view = new ViewModel(['Json' => json_encode(['data' =>  $usuario ])]);
            $view->setTemplate('citas/index/json');
            $view->setTerminal(true);
            return $view;
        }
        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . '/index/index');
    }


    //CONTROLLER busqusuarios
    public function busqusuariosAction(){
        $identify = $this->auth->getStorage()->read();
        if ($identify) {
            $busqueda = $this->getRequest()->getPost('criterio');

            $this->Adapter =$this->getServiceLocator()->get('Zend\Db\Adapter');
            $DBUsuarios = new Usuarios($this->Adapter);
            $usuarios = $DBUsuarios->getBsqlUsuarios($busqueda);

            $view = new ViewModel(['Json' => json_encode(['data' => $usuarios])]);
            $view->setTemplate('citas/index/json');
            $view->setTerminal(true);
            return $view;
        }
        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . '/index/index');
    }


    // /CONTROLLER sugerirusuarios
    public function sugerirusrAction(){
        $identify = $this->auth->getStorage()->read();
        if ($identify) {
            $busqueda = $this->getRequest()->getPost('criterio');

            $this->Adapter =$this->getServiceLocator()->get('Zend\Db\Adapter');
            $DBUsuarios = new Usuarios($this->Adapter);
            $usuarios = $DBUsuarios->getSugestUsuarios($busqueda);

            $view = new ViewModel(['Json' => json_encode(['data' => $usuarios])]);
            $view->setTemplate('citas/index/json');
            $view->setTerminal(true);
            return $view;
        }
        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . '/index/index');
    }    

/*----------------------------------------------------------*
*                        MODULO AGENDA                      *
*-----------------------------------------------------------*/
    //CONTROLLER agenda
    public function citasAction(){
        $identify = $this->auth->getStorage()->read();
        if ($identify) {

            $DBCitas = new Citas($this->getServiceLocator()->get("Zend\Db\Adapter"));
            $agenda = $DBCitas->getCitas();

            if ($agenda) {
                $response = ["status" => "success", "message" => "Datos recuperados con éxito", "data" => $agenda ];
            }
            else {
                $response = ["status" => "error", "message" => "Datos no recuperados", "data" => null ];
            }

            $view = new ViewModel( ['Json' => json_encode( $response )] );
            $view->setTemplate('citas/index/json');
            $view->setTerminal(true);
            return $view;
        }
    }
  

/*----------------------------------------------------------*
*                      MODULO HISTORIAL                     *
*-----------------------------------------------------------*/
    public function addHistorial($seccion, $accion, $desc){
        $identify = $this->auth->getStorage()->read();
        if ($identify) {
            $servParam = $this->getRequest()->getServer();
            $remoteAddr = $servParam->get('REMOTE_ADDR');
            $remoteDisp = $servParam->get('HTTP_USER_AGENT');

            $this->Adapter = $this->getServiceLocator()->get('Zend/Db/Adapter');

            $DBHistorial = new Historial($this->Adapter);

            $arrayHistorial = array(
                'idUsuario' => $identify['claveUsuario'],
                'Seccion' => $seccion,
                'Accion' => $accion,
                'Description' => $desc,
                'Ip' => $remoteAddr,
                'Dispositivo' => $remoteDisp
            );

            $historial = $DBHistorial->addHistorial($arrayHistorial);
            return $historial;
        }
        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . '/');
    }

    public function gethistorialAction(){
        $identify = $this->auth->getStorage()->read();
        if ($identify) {
            $this->Adapter = $this->getServiceLocator()->get('Zend/Db/Adapter');

            $DBHistorial = new Historial($this->Adapter);
            $historial = $DBHistorial->getHistorial();

            $view = new ViewModel(['Json' => json_encode(['data' => $historial])]);
            $view->setTemplate('citas/index/json');
            $view->setTerminal(true);
            return $view;
        }
        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . '/');
    }

  
/*----------------------------------------------------------*
*                      MODULO USUARIOS                      *
*-----------------------------------------------------------*/
    //CONTROLLER usuarios
    public function usuariosdosAction(){
        $identify = $this->auth->getStorage()->read();
        if ($identify) {
            $this->Adapter = $this->getServiceLocator()->get('Zend/Db/Adapter');

            $DBHistorial = new Historial($this->Adapter);
            $historial = $DBHistorial->getHistorial();

            $view = new ViewModel(['Json' => json_encode(['data' => $historial])]);
            $view->setTemplate('citas/index/json');
            $view->setTerminal(true);
            return $view;
        }
        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . '/');
    }


/*----------------------------------------------------------*
*                      MODULO CONSULTA                     *
*-----------------------------------------------------------*/
    //CONTROLLER sugerenciausuariosconsulta
    public function sugerenciausuariosconsultaAction(){
        $identify = $this->auth->getStorage()->read();
        if ($identify) {
            $busqueda = $this->getRequest()->getPost("criterio");

            if ($busqueda) {

                $DBUsuarios = new Usuarios($this->getServiceLocator()->get("Zend\Db\Adapter"));
                $usuarios = $DBUsuarios->getSugerenciaUsuariosConsulta();

                if ($usuarios) {
                    $response = ["status" => "success", "message" => "Datos encontrados", "data" => $usuarios ];
                }
                else{
                    $response = ["status" => "error", "message" => "No se encontraron datos", "data" => null ];
                }
            }
            else{
                $response = ["status" => "error", "message" => "No se recibieron parámetros", "data" => null ];
            }
            $view = new ViewModel(["Json" => json_encode( $response )]);
            $view->setTemplate("citas/index/json");
            $view->setTerminal(true);
            return $view;
        }
        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/");
    }

    //CONTROLLER sugerenciausuariosconsulta
    public function sugerenciausuarioslistaAction(){
        $identify = $this->auth->getStorage()->read();
        if ($identify) {
            $busqueda = $this->getRequest()->getPost("criterio");

            if ($busqueda) {

                $DBUsuarios = new Usuarios($this->getServiceLocator()->get("Zend\Db\Adapter"));
                $usuarios = $DBUsuarios->getSugerenciaUsuariosConsulta();

                if ($usuarios) {
                    $response = ["status" => "success", "message" => "Datos encontrados", "data" => $usuarios ];
                }
                else{
                    $response = ["status" => "error", "message" => "No se encontraron datos", "data" => null ];
                }
            }
            else{
                $response = ["status" => "error", "message" => "No se recibieron parámetros", "data" => null ];
            }
            $view = new ViewModel(["Json" => json_encode( $response )]);
            $view->setTemplate("citas/index/json");
            $view->setTerminal(true);
            return $view;
        }
        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/");
    }

    /**
    *  Guardar la información del paciente
    */
    public function guardardatospersonalesAction(){
        $identify = $this->auth->getStorage()->read();
        if ($identify) {
            $nombrePaciente = $this->getRequest()->getPost("nombrePaciente");
            $fechaNacimiento = $this->getRequest()->getPost("fechaNacimiento");
            $alergias = $this->getRequest()->getPost("alergias");

            if ($busqueda) {
                try {
                    $DBUsuarios = new Usuarios($this->getServiceLocator()->get("Zend\Db\Adapter"));
                    $usuarios = $DBUsuarios->getSugerenciaUsuariosConsulta();

                    if ($usuarios) {
                        $response = ["status" => "success", "message" => "Datos encontrados", "data" => $usuarios ];
                    }
                    else{
                        $response = ["status" => "error", "message" => "No se encontraron datos", "data" => null ];
                    }
                } catch (Exception $e) {
                    $response = ["status" => "error", "message" => "No hubo ninguna conexión a la BD", "data" => "Error : " . $e->getMessage()];
                }
            }
            else{
                $response = ["status" => "error", "message" => "No se recibieron parámetros", "data" => null ];
            }
            $view = new ViewModel(["Json" => json_encode( $response )]);
            $view->setTemplate("citas/index/json");
            $view->setTerminal(true);
            return $view;
        }
        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/");
    }

    /**
    *  Guardar los sintomas
    */
    public function guardarsintomasAction(){
        $identify = $this->auth->getStorage()->read();
        if ($identify) {
            $nombrePaciente = $this->getRequest()->getPost("nombrePaciente");
            $fechaNacimiento = $this->getRequest()->getPost("fechaNacimiento");
            $alergias = $this->getRequest()->getPost("alergias");

            if ($busqueda) {
                try {
                    $DBUsuarios = new Usuarios($this->getServiceLocator()->get("Zend\Db\Adapter"));
                    $usuarios = $DBUsuarios->getSugerenciaUsuariosConsulta();

                    if ($usuarios) {
                        $response = ["status" => "success", "message" => "Datos encontrados", "data" => $usuarios ];
                    }
                    else{
                        $response = ["status" => "error", "message" => "No se encontraron datos", "data" => null ];
                    }
                } catch (Exception $e) {
                    $response = ["status" => "error", "message" => "No hubo ninguna conexión a la BD", "data" => "Error : " . $e->getMessage()];
                }
            }
            else{
                $response = ["status" => "error", "message" => "No se recibieron parámetros", "data" => null ];
            }
            $view = new ViewModel(["Json" => json_encode( $response )]);
            $view->setTemplate("citas/index/json");
            $view->setTerminal(true);
            return $view;
        }
        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/");
    }

    /**
    *  Guardar los sintomas
    */
    public function guardarrevisionAction(){
        $identify = $this->auth->getStorage()->read();
        if ($identify) {
            $nombrePaciente = $this->getRequest()->getPost("nombrePaciente");
            $fechaNacimiento = $this->getRequest()->getPost("fechaNacimiento");
            $alergias = $this->getRequest()->getPost("alergias");

            if ($busqueda) {
                try {
                    $DBUsuarios = new Usuarios($this->getServiceLocator()->get("Zend\Db\Adapter"));
                    $usuarios = $DBUsuarios->getSugerenciaUsuariosConsulta();

                    if ($usuarios) {
                        $response = ["status" => "success", "message" => "Datos encontrados", "data" => $usuarios ];
                    }
                    else{
                        $response = ["status" => "error", "message" => "No se encontraron datos", "data" => null ];
                    }
                } catch (Exception $e) {
                    $response = ["status" => "error", "message" => "No hubo ninguna conexión a la BD", "data" => "Error : " . $e->getMessage()];
                }
            }
            else{
                $response = ["status" => "error", "message" => "No se recibieron parámetros", "data" => null ];
            }
            $view = new ViewModel(["Json" => json_encode( $response )]);
            $view->setTemplate("citas/index/json");
            $view->setTerminal(true);
            return $view;
        }
        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/");
    }

    /**
    *  Guardar los sintomas
    */
    public function guardartratamientoAction(){
        $identify = $this->auth->getStorage()->read();
        if ($identify) {
            $nombrePaciente = $this->getRequest()->getPost("nombrePaciente");
            $fechaNacimiento = $this->getRequest()->getPost("fechaNacimiento");
            $alergias = $this->getRequest()->getPost("alergias");

            if ($busqueda) {
                try {
                    $DBUsuarios = new Usuarios($this->getServiceLocator()->get("Zend\Db\Adapter"));
                    $usuarios = $DBUsuarios->getSugerenciaUsuariosConsulta();

                    if ($usuarios) {
                        $response = ["status" => "success", "message" => "Datos encontrados", "data" => $usuarios ];
                    }
                    else{
                        $response = ["status" => "error", "message" => "No se encontraron datos", "data" => null ];
                    }
                } catch (Exception $e) {
                    $response = ["status" => "error", "message" => "No hubo ninguna conexión a la BD", "data" => "Error : " . $e->getMessage()];
                }
            }
            else{
                $response = ["status" => "error", "message" => "No se recibieron parámetros", "data" => null ];
            }
            $view = new ViewModel(["Json" => json_encode( $response )]);
            $view->setTemplate("citas/index/json");
            $view->setTerminal(true);
            return $view;
        }
        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/");
    }


}
