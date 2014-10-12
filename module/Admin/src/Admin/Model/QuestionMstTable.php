<?php
namespace Admin\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Adapter\Adapter;

class QuestionMstTable
{
	protected $tableGateway;
	protected $adapter;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
		$this->adapter = new Adapter(array(
    		'driver' => 'Pdo_Mysql',
		    'database' => 'kokibit',
		    'username' => 'koki',
		    'password' => 'seattle',
		    'hostname' => '153.121.43.40'
 		));
	}

	public function insertQuestionMst($testId, $questionNum)
	{
		$data = array(
			'TEST_ID' => $testId,
			'NUMBER' => $questionNum,);

		$this->tableGateway->insert($data);
	}

	public function getQestionByTestId($testId)
	{	
		$sql = new Sql($this->adapter);
		$select = $sql->select();
		$select->from('question_mst');
		$select->where(array('TEST_ID' => $testId));
		$select->order('NUMBER ASC');

		$statement = $sql->prepareStatementForSqlObject($select);
		$results = $statement->execute();

		return $results;
	}

	public function getQuestionContents($testId, $questionId)
	{
		$sql = new Sql($this->adapter);
		$select = $sql->select();
		$select->from('question_mst');
		$select->where(array('TEST_ID' => $testId, 'NUMBER' => $questionId));

		$statement = $sql->prepareStatementForSqlObject($select);
		$results = $statement->execute();

		return $results;
	}

	public function updateQuestion($contents, $questionId, $testId)
	{
		$sql = new Sql($this->adapter);
		$update = $sql->update();
		$update->table('question_mst');
		$update->set(array('CONTENTS' => $contents,));
		$update->where(array('TEST_ID' => $testId, 'NUMBER' => $questionId));

		$statement = $sql->prepareStatementForSqlObject($update);
		$results = $statement->execute();
	}
}