<?php
namespace core;

use \core\exception\fileException;

final class autoload
{
	static public function init()
	{
		spl_autoload_register(__CLASS__.'::load');
	}

	static public function load($name)
	{
		$file = self::class2file($name);

		if( ! file_exists($file) ){
			throw new fileException("Not Found: <{$file}>");
		}
		require $file;
	}
	
	
	static private function class2file($class)
	{
		$file = str_replace('\\', '/', $class). '.php';
		$file = BASE_DIR. '/'. $file;
		
		return $file;
	}
	
}
