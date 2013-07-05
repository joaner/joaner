<?php
namespace core;

use \core\request\router;
use \core\exception\requestException;


final class request implements \super\runner
{
	private $config;

	private $router;
	
	
	public function __construct()
	{
		$this->router = router::getInstance();
	}

	/**
	 * init Controller
	 * @param void
	 *
	 * @return int	HTTP code
	 */
	public function run()
	{
		$this->router->run();
		
		if( ! class_exists($this->router->controller) ){
			throw new requestException();
		}
		$controller = new $this->router->controller($this->router->param);

		return $controller;		
	}
}
