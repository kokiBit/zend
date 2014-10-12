<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class TestMstTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function fetchAll($testId)
	{
		$resultSet = $this->tableGateway->select(array('ID' => $testId));
		return $resultSet;
	}
}