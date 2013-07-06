<?php
namespace library;

use \ReflectionClass, \ReflectionMethod;


final class reflection
{
	static public function import($class, $method=null)
	{
		if( is_null($method) ){
			$ref = new ReflectionClass($class);
		}else{
			$ref = new ReflectionMethod($class, $method);
		}
		
		return $ref;
	}
}