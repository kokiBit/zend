<?php
namespace Application\Model;

class TestMst
{
	public $ID;
	public $TITLE;
	public $TYPE;

	public function exchangeArray($data)
	{
		$this->ID = (isset($data['ID']))?$data['ID']:0;
		$this->TITLE = (isset($data['TITLE']))?$data['TITLE']:'';
		$this->TYPE = (isset($data['TYPE']))?$data['TYPE']:'';

	}
}