<?php
namespace core;

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
	private static $namespace;
	
	/**
	 * one configure file content
	 * @var array
	 */
	private static $config;
	
	
	public function __construct($namespace)
	{
		if( ! array_key_exists($namespace, self::$configs) ){
			$file = BASE_DIR. "/config/{$namespace}.php";
			self::$configs[$namespace] = include $file;
		}
		self::$config	 =& self::$configs[$namespace];
		self::$namespace = $namespace;
	}
	
	/**
	 * get configure content by name
	 * @param string|int $name [, mixed $... ]
	 */
	public static function &get($name)
	{
		$current = self::$config;
		foreach(func_get_args() as $name){
			$current = $current[$name];
		}
		
		return $current;
	}
	
}