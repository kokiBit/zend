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

class AnswerController extends AbstractActionController
{
    protected $testMstTable;
    protected $typeMstTable;
    protected $questionMstTable;

    public function indexAction()
    {

        return new ViewModel();
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
