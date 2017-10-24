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

class CitasController extends AbstractActionController
{
	
	public $dbAdapter;// base de datos
    private $auth;//autenticacion Sesion

    public function __construct() {
        //Cargamos el servicio de autenticacion en el constructor
        $this->auth = new AuthenticationService();        
    }
    
    public function indexAction()
    {

		$this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter');
		$dataUsuario = new Usuarios($this->dbAdapter);            
            //$postulaciones = $dataRelVaUser->getAll_User($identify['idTab_Usuario']); 
        $usuario = $dataUsuario->fetchAll();
		$index['usuario'] = $usuario;
		// $this->layout()->sesion = $identify;
        $this->layout('layout/layout');
        $this->layout()->sesion = $identify;
        $view = new ViewModel($index);
        return $view;
        return new ViewModel();
    }

    public function loginAction(){
    	return new ViewModel();
    }

	public function citasAction(){
    	return new ViewModel();
    }

    public function agendaAction(){
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


/*----------------------------------------------------------*
*                       MODULO USUARIOS                     *
*-----------------------------------------------------------*/
    public function getsuariosAction(){
        $identify = $this->auth->getStorage()->read();
        if ($identify) {
            $this->Adapter = $this->getServiceLocator()->get('Zend\Db\Adapter');
            $DBUsuarios = new Usuarios($this->Adapter);
            $usuario = $DBUsuarios->getAllUsuarios();

            $view = new ViewModel(['Json' => json_encode(['data' => $usuario])]);
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
    public function sugerirusuariosAction(){
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

    
}
