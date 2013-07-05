<?php
namespace core\cache;

use \library\dataSerialize;

final class file implements \super\core\cache
{
	private $store = array();
	private $dir;

	public $lifetime = 0;
	public $note = array();


	public static $instance;


	public function __construct($configure)
	{
		$this->dir = $configure['temp_dir'];
		self::$instance = $this;
	}

	

	public function &__get($key)
	{
		return self::get($key);
	}

	public function __set($key, $value)
	{
		return self::set($key, $value);
	}


	static public function &get($key)	
	{
		if( ! array_key_exists($key, self::$instance->store) ){
			$filename = self::$instance->filename($key);
			self::$instance->store[$key] = dataSerialize::import($filename);
		}
		return self::$instance->store[$key];
	}
	
	static public function set($name, $content, array $options=null)
	{
		$note = self::$instance->note;
		if( ! is_null($options) ){
			$note = array_merge($note, $options);
			if( !isset($note['expire']) && isset($note['lifetime']) ){
				$note['expire'] = SYS_TIME + $note['lifetime'];
			}
		}
		self::$instance->store[$name] = $content;
		$filename = self::$instance->filename($name);

		$content = dataSerialize::export($content, self::$instance->note);
		$result = file_put_contents($filename, $content);
		
		return $result;
	}
	
	private function filename($name)
	{
		return self::$instance->dir.'/joanercache_'.dechex(crc32($name));
	}
}
