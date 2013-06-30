<?php
namespace core;

final class response implements \super\runner
{
	private $controller;

	public function __construct($controller)
	{
		$this->controller = $controller;
	}

	public function run()
	{
		echo $this->controller;
	}
}
