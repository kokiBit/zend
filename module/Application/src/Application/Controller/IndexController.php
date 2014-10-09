<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\User;
use Zend\Http\Client;
use Zend\Http\Request;
//use Zend\Config\Factory;

class IndexController extends AbstractActionController
{
    
    protected $userTable;
    protected $testMstTable;
    protected $typeMstTable;
    protected $questionMstTable;

    public function __construct()
     {
//        $config = \Zend\Config\Factory::fromFile('httpclient.ini');
//        $client->setOptions($config);
     }

    public function indexAction()
    {
/*        $request = new Request();
        $client = new Client('http://animemap.net/api/table/okayama.json');
        //$client->setRequest($request);
        $request->setUri('http://animemap.net/api/table/okayama.json');
        $response = $client->dispatch($request);
        $body = $response->getContent();
        $value = json_decode($body)->response;*/
/*
        $testMst = $this->getTestMstTable()->fetchAll();
        $typeMst = $this->getTypeMstTable()->fetchAll();
        $questionMst = $this->getQuestionMstTable()->fetchAll();

        foreach ($typeMst as $key => $value) {
            var_dump($value);
        }
        exit();

        foreach ($testMst as $key => $value) {
            var_dump($value);
        }

        exit();





        $id = $this->params()->fromRoute('p',0);
        var_dump($id);

        if($id === '3-1') {
            var_dump('ok');
        }
        exit();



        $view = array(
            'res' => $value,);*/

        return new ViewModel();
    }

    public function getUserTable()
    {
    	if(!$this->userTable) {
    		$sm = $this->getServiceLocator();
    		$this->userTable = $sm->get('Application\Model\UserTable');
    	}
    	return $this->userTable;
    }

    public function getTestMstTable()
    {
        if(!$this->testMstTable) {
            $sm = $this->getServiceLocator();
            $this->testMstTable = $sm->get('Application\Model\TestMstTable');
        }
        return $this->testMstTable;
    }

    public function getTypeMstTable()
    {
        if(!$this->typeMstTable) {
            $sm = $this->getServiceLocator();
            $this->typeMstTable = $sm->get('Application\Model\TypeMstTable');
        }
        return $this->typeMstTable;
    }
    
    public function getQuestionMstTable()
    {
        if(!$this->questionMstTable) {
            $sm = $this->getServiceLocator();
            $this->questionMstTable = $sm->get('Application\Model\QuestionMstTable');
        }
        return $this->questionMstTable;
    }
}
