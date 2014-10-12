<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController
{  
    protected $testMstTable;
    protected $typeMstTable;
    protected $questionMstTable;

    public function indexAction()
    {   
        session_start();
        if(isset($_SESSION['title'])) {
            unset($_SESSION['title']);
            unset($_SESSION['type']);
        }

        $title = $this->params()->fromRoute('title');
        $testId = $this->params()->fromRoute('testId');

        $types = $this->getTestMstTable()->fetchAll($testId);
        foreach ($types as $type) {
        }

        $array = array();
        
        for ($i=1; $i <= $type->TYPE ; $i++) { 
            $array[$i] = array();
        }

        //問題を配列に格納
        $questions = $this->getQuestionMstTable()->getQestionByTestId($testId);
        foreach ($questions as $key => $value) {
            array_push($array[substr($value['NUMBER'],0,1)],$value['NUMBER']);
        }

        //結果を配列に格納
        $results = $this->getTypeMstTable()->getTestId($testId);
        foreach ($results as $result) {
            array_push($array[$type->TYPE], $result['TYPE_NAME']);
        }
        $view = array(
            'array' => $array,
            'title' => $title,
            'testId' => $testId,);

        return new ViewModel($view);
    }

    public function registAction()
    {
        $questionId = $this->params()->fromRoute('id');
        $testId = $this->params()->fromRoute('testId');
        $title = $this->params()->fromRoute('title');
        
        $results = $this->getQuestionMstTable()->getQuestionContents($testId, $questionId);
        foreach ($results as $key => $value) {
        }

        $view = array(
            'id' => $questionId,
            'testId' => $testId,
            'title' => $title,
            'contents' => $value['CONTENTS']);

        return new ViewModel($view);
    }

    public function completeAction()
    {
        $questionId = $this->params()->fromRoute('id');
        $testId = $this->params()->fromRoute('testId');
        $title = $this->params()->fromRoute('title');

        $this->getQuestionMstTable()->updateQuestion($_POST['contents'], $questionId, $testId);
        
        return $this->redirect()->toRoute('adminUser', array('title' => $title, 'testId' => $testId));
    }

    public function typeRegistAction()
    {
        $typeNum = $this->params()->fromRoute('id');
        $testId = $this->params()->fromRoute('testId');
        $title = $this->params()->fromRoute('title');

        $results = $this->getTypeMstTable()->getTypeNum($testId, $typeNum);
        foreach ($results as $key => $value) {
        }
        
        $view = array(
            'id' => $typeNum,
            'result' => $value,);

        return new ViewModel($view);
    }

    public function typeCompleteAction()
    {
        $typeNum = $this->params()->fromRoute('id');
        $testId = $this->params()->fromRoute('testId');
        $title = $this->params()->fromRoute('title');

        $this->getTypeMstTable()->updateType($_POST['title'], $_POST['contents'], $typeNum, $testId);
        
        return $this->redirect()->toRoute('adminUser', array('title' => $title, 'testId' => $testId));
    }

    public function getTestMstTable()
    {
        if(!$this->testMstTable) {
            $sm = $this->getServiceLocator();
            $this->testMstTable = $sm->get('Admin\Model\TestMstTable');
        }
        return $this->testMstTable;
    }

    public function getTypeMstTable()
    {
        if(!$this->typeMstTable) {
            $sm = $this->getServiceLocator();
            $this->typeMstTable = $sm->get('Admin\Model\TypeMstTable');
        }
        return $this->typeMstTable;
    }
    
    public function getQuestionMstTable()
    {
        if(!$this->questionMstTable) {
            $sm = $this->getServiceLocator();
            $this->questionMstTable = $sm->get('Admin\Model\QuestionMstTable');
        }
        return $this->questionMstTable;
    }
}
