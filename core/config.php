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
	private static $name;
	
	/**
	 * one configure file content
	 * @var array
	 */
	private static $config;
	
	
	public function __construct($name)
	{
		if( ! array_key_exists($name, self::$configs) ){
			$file = BASE_DIR. "/config/{$name}";
			self::$configs[$name] = include $file;
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
	
}
