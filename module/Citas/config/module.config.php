<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Citas;

return array(
    'router' => array(
        'routes' => array(
            
            'index'     => array(
                'type'    => 'segment',
                'options' => array(
                    'route'       => '/index[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults'    => array(
                        'controller' => 'Citas\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'citas'     => array(
                'type'    => 'segment',
                'options' => array(
                    'route'       => '/citas[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults'    => array(
                        'controller' => 'Citas\Controller\Citas',
                        'action'     => 'index',
                    ),
                ),
            ),
            'usuarios'     => array(
                'type'    => 'segment',
                'options' => array(
                    'route'       => '/usuarios[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults'    => array(
                        'controller' => 'Citas\Controller\Usuarios',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
   
    'controllers' => array(
        'invokables' => array(
            'Citas\Controller\Index' => Controller\IndexController::class,
            // 'Citas\Controller\Oridnum' => Controller\OridnumController::class,
            'Citas\Controller\Usuarios' => Controller\UsuariosController::class,
            'Citas\Controller\Citas' => Controller\CitasController::class
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Citas'            => __DIR__ . '/../view',
        ),
    ),

);
