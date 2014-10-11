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

class TypeController extends AbstractActionController
{
    protected $testMstTable;
    protected $typeMstTable;
    protected $questionMstTable;

    public function indexAction()
    {
        session_start();
        $_SESSION['title'] = $_POST['title'];
        $_SESSION['type'] = $_POST['type'];

        $view = array(
            'type' => $_POST['type'],);

        return new ViewModel($view);
    }

    public function completeAction()
    {
        session_start();
        $lastId = $this->getTestMstTable()->insertTestMst($_SESSION['title'], $_SESSION['type']);
        
        //type_mstにinsertするt処理
        foreach ($_POST['typeName'] as $key => $value) {
            $this->getTypeMstTable()->insertTypeMst($lastId, $key, $value, $_POST['typeContents'][$key]);
        }

        //questionにinsertするためのデータ構造を作成する
        for ($i=1; $i <= $_SESSION['type']-1; $i++) { 
            for ($j=1; $j <=$i ; $j++) { 
                $questionNum = $i.'-'.$j;
                $this->getQuestionMstTable()->insertQuestionMst($lastId,$questionNum);
            }
        }
        return $this->redirect()->toRoute('adminUser', array('title' => $_SESSION['title'], 'testId' => $lastId));
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
