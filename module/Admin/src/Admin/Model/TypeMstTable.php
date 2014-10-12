<?php
namespace Admin\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Adapter\Adapter;

class TypeMstTable
{
	protected $tableGateway;

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

	public function fetchAll($id)
	{
		$resultSet = $this->tableGateway->select(array('TEST_ID' => $id));
		return $resultSet;
	}

	public function insertTypeMst($testId, $typeNumber, $typeName, $typeContents)
	{
		$data = array(
			'TEST_ID' => $testId,
			'Type_NUMBER' => $typeNumber,
			'TYPE_NAME' => $typeName,
			'CONTENTS' => $typeContents);
		$this->tableGateway->insert($data);
	}

	public function getTestId($testId)
	{
		$sql = new Sql($this->adapter);
		$select = $sql->select();
		$select->from('type_mst');
		$select->where(array('TEST_ID' => $testId));
		$select->order('TYPE_NUMBER ASC');

		$statement = $sql->prepareStatementForSqlObject($select);
		$results = $statement->execute();

		return $results;
	}

	public function getTypeNum($testId, $typeNum)
	{
		$sql = new Sql($this->adapter);
		$select = $sql->select();
		$select->from('type_mst');
		$select->where(array('TEST_ID' => $testId, 'TYPE_NUMBER' => $typeNum));

		$statement = $sql->prepareStatementForSqlObject($select);
		$results = $statement->execute();

		return $results;
	}

	public function updateType($name, $contents, $typeNum, $testId)
	{
		$sql = new Sql($this->adapter);
		$update = $sql->update();
		$update->table('type_mst');
		$update->set(array('CONTENTS' => $contents, 'TYPE_NAME' => $name));
		$update->where(array('TEST_ID' => $testId, 'TYPE_NUMBER' => $typeNum));

		$statement = $sql->prepareStatementForSqlObject($update);
		$results = $statement->execute();
	}
}