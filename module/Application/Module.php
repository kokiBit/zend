<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Application\Model\UserTable;
use Application\Model\User;
use Application\Model\TestMstTable;
use Application\Model\TestMst;
use Application\Model\TypeMstTable;
use Application\Model\TypeMst;
use Application\Model\QuestionMstTable;
use Application\Model\QuestionMst;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Application\Model\UserTable'=> function($sm) {
                    $tableGateway = $sm->get('UserTableGateWay');
                    $table = new UserTable($tableGateway);
                    return $table;
                }
                ,'UserTableGateway' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new User());
                    return new TableGateway(
                        'user_mst',$dbAdapter,null,$resultSetPrototype
                    );
                },
                'Application\Model\TestMstTable'=> function($sm) {
                    $tableGateway = $sm->get('TestMstTableGateWay');
                    $table = new TestMstTable($tableGateway);
                    return $table;
                }
                ,'TestMstTableGateway' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new TestMst());
                    return new TableGateway(
                        'test_mst',$dbAdapter,null,$resultSetPrototype
                    );
                },
                'Application\Model\TypeMstTable'=> function($sm) {
                    $tableGateway = $sm->get('TypeMstTableGateWay');
                    $table = new TypeMstTable($tableGateway);
                    return $table;
                }
                ,'TypeMstTableGateway' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new TypeMst());
                    return new TableGateway(
                        'type_mst',$dbAdapter,null,$resultSetPrototype
                    );
                },
                'Application\Model\QuestionMstTable'=> function($sm) {
                    $tableGateway = $sm->get('QuestionMstTableGateWay');
                    $table = new QuestionMstTable($tableGateway);
                    return $table;
                }
                ,'QuestionMstTableGateway' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new QuestionMst());
                    return new TableGateway(
                        'question_mst',$dbAdapter,null,$resultSetPrototype
                    );
                },
            )
        );
    }
}
