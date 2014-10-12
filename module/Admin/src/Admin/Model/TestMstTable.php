<?php
namespace Admin\Model;

use Zend\Db\TableGateway\TableGateway;

class TestMstTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function fetchAll($id)
	{
		$resultSet = $this->tableGateway->select(array('ID' => $id));
		return $resultSet;
	}

	public function insertTestMst($title, $type)
	{
		$data = array(
			'TITLE' => $title,
			'TYPE' => $type);
		$this->tableGateway->insert($data);
		
		$lastId = $this->tableGateway->lastInsertValue;

		return $lastId;
	}
}