<?php
namespace core;

final class autoload
{
	static public function init()
	{
		spl_autoload_register(__CLASS__.'::load');
	}

	static public function load($name)
	{
		$file = str_replace('\\', '/', $name). '.php';
		require BASE_DIR. '/'. $file;
	}
}
