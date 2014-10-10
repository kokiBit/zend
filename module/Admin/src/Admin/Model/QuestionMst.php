<?php
namespace Admin\Model;

class QuestionMst
{
	public $TEST_ID;
	public $NUMBER;
	public $CONTENTS;

	public function exchangeArray($data)
	{
		$this->TEST_ID = (isset($data['TEST_ID']))?$data['TEST_ID']:0;
		$this->NUMBER = (isset($data['NUMBER']))?$data['NUMBER']:'';
		$this->CONTENTS = (isset($data['CONTENTS']))?$data['CONTENTS']:'';

	}
}