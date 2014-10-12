<?php
namespace Admin\Model;

class TypeMst
{
	public $TEST_ID;
	public $TYPE_NUMBER;
	public $CONTENTS;
	public $TYPE_NAME;

	public function exchangeArray($data)
	{
		$this->TEST_ID = (isset($data['TEST_ID']))?$data['TEST_ID']:0;
		$this->TYPE_NUMBER = (isset($data['TYPE_NUMBER']))?$data['TYPE_NUMBER']:'';
		$this->CONTENTS = (isset($data['CONTENTS']))?$data['CONTENTS']:'';
		$this->TYPE_NAME = (isset($data['TYPE_NAME']))?$data['TYPE_NAME']:'';
	}
}