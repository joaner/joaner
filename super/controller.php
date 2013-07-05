<?php
namespace super;

abstract class controller implements \super\runner
{
	private $param;

	public function __construct($param=null)
	{
		$this->param = $param;
	}

	abstract function run();


	public function __toString()
	{
		return ''; // $this->view->display();
	}
}
