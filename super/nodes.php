<?php
namespace super;


abstract class nodes implements \super\factory
{
	static protected $configure = array();
	static protected $instances = array();
	static protected $namespace;

	static public function init($configure=null)
	{
		static::$namespace = get_called_class();
		if( is_null($configure) ){
			$configure = call_user_func_array(
						'\core\config::get', 
						explode('\\', trim(static::$namespace, '\\'))
					);
		}
		static::$configure = $configure;
	}


	static public function getInstance($name=null)
	{
		if( is_null($name) ){
			$name = static::$configure['default'];
		}
		
		if( ! isset(self::$instances[$name]) ){
			$conf = isset(self::$configure['nodes'][$name]) ? static::$configure['nodes'][$name] : null; 
			$name = static::$namespace .'\\'. $name;

			static::$instances[$name] = new $name($conf);
		}
		return static::$instances[$name];
	}

}
