<?php
namespace core;

use \core\cache;

use \library\xml2array, \library\dataSerialize;

final class config
{
	const cachefile = 'configs-cache.php';
	
	/**
	 * all configure files content list
	 * @var array
	 */
	private static $configs = array();
	
	/**
	 * configs cache file create time
	 * @var int
	 */
	private static $ctime;
	
	/**
	 * cache file
	 * @var string
	 */
	private static $cachefile;
	
	/**
	 * need reset configs;
	 * @var boolean
	 */
	private static $reset = false;
	
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
		$file = BASE_DIR .'/config/'.$name;
		if( filectime($file) >= self::$ctime ){
			self::$configs[$name] = $this->read($file);
			self::$reset = true;
		}
		self::$config	=& self::$configs[$name];
		self::$name		= $name;
	}
	
	public static function init($dir=null)
	{
		is_null($dir) && $dir=sys_get_temp_dir();
		self::$cachefile = $dir.'/'.self::cachefile;
		self::$ctime = filectime(self::$cachefile);
		
		if( is_int(self::$ctime) ){
			self::$configs = dataSerialize::import(self::$cachefile);
		}else{
			self::$reset = true;
		}
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

	private function read($file)
	{
		$ext = PATHINFO($file, PATHINFO_EXTENSION);

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
	
	public function __destruct()
	{
		if( self::$reset === true ){
			$content = dataSerialize::export(self::$configs);
			file_put_contents(self::$cachefile, $content);
		}
	}
	
}
