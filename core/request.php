<?php
namespace core;

use \core\config;

final class request implements \super\running
{
	private $config;
	private $router;
	
	
	public function __construct()
	{
		$this->config = config::get('request');
		
		
	}

	/**
	 * init Controller
	 * @param void
	 *
	 * @return int	HTTP code
	 */
	public function run()
	{
		var_dump($_SERVER, $this->config);	
	}
}
