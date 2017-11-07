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

class IndexController extends AbstractActionController
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
		// $dataUsuario = new Usuarios($this->dbAdapter);            
  //           //$postulaciones = $dataRelVaUser->getAll_User($identify['idTab_Usuario']); 
  //       $usuario = $dataUsuario->fetchAll();
		// $index['usuario'] = $usuario;
        
        // $this->layout()->sesion = $identify;
        $view = new ViewModel();
        $this->layout('layout/layout');        
        return $view;
    }

    public function homeAction(){
        return new ViewModel();
    }

    public function verificarAction(){
        #Obtener datos post
        $USR = $this->getRequest()->getPost("user");
        $PWD = $this->getRequest()->getPost("pass");

        #Adaptador
        $this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter');

        #Modelo
        $DbUsuarios = new Usuarios($this->dbAdapter);
        $RsUsuario = $DbUsuarios->getAuth($USR, $PWD);        

        if ($RsUsuario) {
            $ArrayUsuario = [                                     
                'claveUsuario'      => $RsUsuario['idUsuario'], 
                'usuario'    => $RsUsuario['user'], 
                'nombreUsuario' => $RsUsuario['nombre'],
                'claveTipoUsuario' => $RsUsuario['idTipoUsr']
            ];
            $identify = $this->auth->getStorage()->write($ArrayUsuario);
            $this->layout()->sesion = $identify;
            // $rest = [ 'status' => 'success', 'message' => 'Inicio de sesión correcto' ];
            $rest = [ 'status' => 'success', 'message' => 'Inicio de sesión correcto' ];
        } else {
            $rest = [ 'status' => 'error', 'message' => 'Credenciales incorrectas' ];
        }

        $view = new ViewModel(['Json' => json_encode($rest)]);
        $view->setTemplate('citas/index/json');
        $view->setTerminal(true);
        return $view;
    }

    public function loginAction(){
        $view = new ViewModel();        
        $this->layout('layout/layoutVacio');
        return $view;
    }

    public function logoutAction(){
        $identify = $this->auth->getStorage()->read();

        if ($identify) {
            $this->auth->getStorage()->clear();    
        }   
        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . '/index/index');
    }


    

}
