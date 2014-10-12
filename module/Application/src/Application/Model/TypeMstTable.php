<?php
namespace Application\Model;

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

	public function fetchAll()
	{
		$resultSet = $this->tableGateway->select();
		return $resultSet;
	}

	public function getTypeContents($testId, $number)
	{
		$sql = new Sql($this->adapter);
		$select = $sql->select();
		$select->from('type_mst');
		$select->where(array('TEST_ID' => $testId, 'TYPE_NUMBER' => $number));

		$statement = $sql->prepareStatementForSqlObject($select);
		$results = $statement->execute();

		return $results;
	}
}