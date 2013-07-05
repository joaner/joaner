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
		$file = str_replace('\\', '/', $name). '.php';
		$file = BASE_DIR. '/'. $file;

		if( ! file_exists($file) ){
			throw new fileException("Not Found: <{$file}>");
		}
		require $file;
	}
}
