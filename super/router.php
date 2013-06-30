<?php
namespace super;

use \core\config;

abstract class router implements \super\runner
{
	protected $config = array();

	public function __construct($config=null)
	{
		$this->config = $config;
	}

	abstract function run();


	/**
	 * @param array $uri
	 * @param int $k
	 */
	protected function splice(array &$uri, $k)
	{
		if( $k-1 > 0 ){
			$namespace = array_splice($uri, 0, $k-1);
		}
		if( count($uri) > 0 ){
			$controller = array_shift($uri);
		}
		$param = $uri;
		return array(
			'namespace' => isset($namespace) ? $namespace : false,
			'controller' => isset($controller) ? $controller : false,
			'param' => isset($param) ? $param : false,
		);
	}
	
	/**
	 * 
	 * @param string|array|loolean	$namespace
	 * @param string|boolean		$controller
	 * @return string
	 */
	public function getControllerClass($namespace, $controller)
	{
		if( $namespace === false ){
			$namespace = $this->config['default']['namespace'];
		}elseif( is_array($namespace) ){
			$namespace = '\\'. implode('\\', $namespace);
		}

		if( $controller === false ){
			$controller = $this->config['default']['controller'];
		}

		return "\\controller{$namespace}\\{$controller}";
	}

}
