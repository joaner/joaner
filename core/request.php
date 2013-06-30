<?php
namespace core;

use \core\config;

final class request implements \super\runner
{
	private $config;

	private $router;
	
	
	public function __construct()
	{
		$this->config = config::get('request');
		if( isset($this->config['router']) ){
			$router = '\\core\\router\\'. $this->config['router']['name'];
			$this->router = new $router($this->config['router']);
		}
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
