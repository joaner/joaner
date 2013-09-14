<?php
namespace core;

use \core\cache;

use \library\xml2array, \library\dataSerialize;

final class config
{
	const default_file = 'main.xml';
	const cache_header = 'configcache-';
	
	/**
	 * all configure files content list
	 * @var array
	 */
	private static $configs = array();
	
	
	public static function init($name=self::default_file, $dir=null)
	{
		self::loadConfig($name);
	}

	private static function loadConfig($name)
	{
		$sourcefile 	= BASE_DIR .'/config/'.$name;
		$cachefile 		= TEMP_DIR .'/'. self::cache_header . $name;
		$ctime = @filectime($cachefile);
		if( file_exists($cachefile) && 
			WORK !== 'product' &&
			$ctime = filectime($cachefile) && 
			$ctime>filectime($sourcefile) ){
			self::$configs = dataSerialize::import($cachefile);
		}else{
			self::$configs = self::readConfig($sourcefile);
			
			$content = dataSerialize::export(self::$configs);
			file_put_contents($cachefile, $content);
		}
	}
	
	/**
	 * get configure content by name
	 * @param string|int $name [, mixed $... ]
	 */
	public static function &get()
	{
		$current = self::$configs;
		foreach(func_get_args() as $name){
			$current = $current[$name];
		}
		
		return $current;
	}

	private static function readConfig($file)
	{
		if( ! file_exists($file) ){
			throw new fileException($file);
		}
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
	
}
