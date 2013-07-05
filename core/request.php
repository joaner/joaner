<?php
namespace core;

use \core\config;

use \core\request\router;

final class request implements \super\runner
{
	private $config;

	private $router;
	
	
	public function __construct()
	{
		router::init();
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
		
		$controller = new $this->router->controller($this->router->param);

		return $controller;		
	}
}
