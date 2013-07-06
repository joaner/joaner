<?php
namespace core;

use \core\cache;

use \library\xml2array;


final class config
{
	/**
	 * all configure files content list
	 * @var array
	 */
	private static $configs = array();
	
	/**
	 * current configure type about self::$config
	 * @var string
	 */
	private static $name;
	
	/**
	 * one configure file content
	 * @var array
	 */
	private static $config;
	
	
	public function __construct($name)
	{
		if( ! array_key_exists($name, self::$configs) ){
			// $cache = cache::getInstance('file');
			$key = __CLASS__.'::'.$name;
			// $config = $cache->get($key);
			//if( is_null($config) ){
				$config = $this->read($name);
			// 	$cache->set($key, $config);
			//}

			self::$configs[$name] = $config;
		}
		self::$config	=& self::$configs[$name];
		self::$name		= $name;
	}
	
	/**
	 * get configure content by name
	 * @param string|int $name [, mixed $... ]
	 */
	public static function &get()
	{
		$current = self::$config;
		foreach(func_get_args() as $name){
			$current = $current[$name];
		}
		
		return $current;
	}

	private function read($name)
	{
		$ext = PATHINFO($name, PATHINFO_EXTENSION);
		$file = BASE_DIR .'/config/'.$name;

		switch($ext)
		{
			case 'php';
				$config = include $file;
			break;
			case 'xml':
				$content = file_get_contents($file);
				$array = new xml2array($content);

				$config = $array->get();
			break;
		}

		return $config;
	}
	
}
