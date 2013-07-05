<?php
namespace core\request\router;

final class path extends \super\router
{
	private $uri = '';

	public function __construct()
	{
		$this->uri = $_SERVER['REQUEST_URI'];
	}

	public function run()
	{
		$uri = trim($this->uri, '/');
		if( strlen($uri) > 0 ){
			$paths = explode('/', $uri);
			foreach($paths as $k=>$path){
				if( strlen($path) > 0 ){
					if( is_numeric($path) ){
						$k--;
						break;
					}
				}
			}
		}else{
			$paths = array();
			$k = 0;
		}
		$location = $this->splice($paths, ++$k);
		$this->controller = $this->getControllerClass(
					$location['namespace'], $location['controller'] );
		$this->param = $location['param'];
	}

}