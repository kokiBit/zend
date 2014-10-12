<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/admin/',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'adminTop' => array(
                 'type'    => 'Literal',
                'options' => array(
                    'route'    => '/admin/',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),'adminTitle' => array(
                 'type'    => 'Literal',
                'options' => array(
                    'route'    => '/admin/title/',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Title',
                        'action'     => 'index',
                    ),
                ),
            ),'adminType' => array(
                 'type'    => 'Literal',
                'options' => array(
                    'route'    => '/admin/type/',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Type',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'complete'    =>  array(
                        'type'  =>  'Literal',
                        'options'   =>  array(
                            'route' =>  'complete/',
                            'defaults'  =>  array(
                                'controller'    => 'Admin\Controller\Type',
                                'action'     => 'complete',
                            ),
                        ),
                    ),
                ),
            ),'adminUser' => array(
                 'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/user/:title/:testId/',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\User',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'regist'    =>  array(
                        'type'  =>  'segment',
                        'options'   =>  array(
                            'route' =>  ':id/',
                            'defaults'  =>  array(
                                'controller'    => 'Admin\Controller\User',
                                'action'     => 'regist',
                            ),
                        ),
                    ),'complete'    =>  array(
                        'type'  =>  'segment',
                        'options'   =>  array(
                            'route' =>  ':id/complete/',
                            'defaults'  =>  array(
                                'controller'    => 'Admin\Controller\User',
                                'action'     => 'complete',
                            ),
                        ),
                    ),'typeRegist'    =>  array(
                        'type'  =>  'segment',
                        'options'   =>  array(
                            'route' =>  'type/:id/',
                            'defaults'  =>  array(
                                'controller'    => 'Admin\Controller\User',
                                'action'     => 'typeRegist',
                            ),
                        ),
                    ),'typeComplete'    =>  array(
                        'type'  =>  'segment',
                        'options'   =>  array(
                            'route' =>  'type/:id/complete/',
                            'defaults'  =>  array(
                                'controller'    => 'Admin\Controller\User',
                                'action'     => 'typeComplete',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Index' => 'Admin\Controller\IndexController',
            'Admin\Controller\Title' => 'Admin\Controller\TitleController',
            'Admin\Controller\Type' => 'Admin\Controller\TypeController',
            'Admin\Controller\User' => 'Admin\Controller\UserController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
