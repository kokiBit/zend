<?php
namespace Admin\Model;

use Zend\Db\TableGateway\TableGateway;

class TypeMstTable
{
	protected $tableGateway;

 	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function insertTypeMst($testId, $typeNumber, $typeName, $typeContents)
	{
		$data = array(
			'TEST_ID' => $testId,
			'Type_Number' => $typeNumber,
			'TYPE_NAME' => $typeName,
			'CONTENTS' => $typeContents);
		$this->tableGateway->insert($data);
	}
}