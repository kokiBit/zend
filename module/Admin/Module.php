<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Admin\Model\TestMstTable;
use Admin\Model\TestMst;
use Admin\Model\TypeMstTable;
use Admin\Model\TypeMst;
use Admin\Model\QuestionMstTable;
use Admin\Model\QuestionMst;

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
                'Admin\Model\TestMstTable'=> function($sm) {
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
                'Admin\Model\TypeMstTable'=> function($sm) {
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
                'Admin\Model\QuestionMstTable'=> function($sm) {
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
