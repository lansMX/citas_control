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
		$dataUsuario = new Usuarios($this->dbAdapter);            
            //$postulaciones = $dataRelVaUser->getAll_User($identify['idTab_Usuario']); 
        $usuario = $dataUsuario->fetchAll();
		$index['usuario'] = $usuario;
		// $this->layout()->sesion = $identify;
        $this->layout('layout/layout');
        $view = new ViewModel($index);
        return $view;
    }

    public function loginAction(){
    	return new ViewModel();
    }



}
