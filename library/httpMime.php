<?php
namespace library;

final class httpMime
{
	private static $types = array(
		'xml' => 'application/xml'	
	);
	
	static public function type($type)
	{
		if( !headers_sent() ){
			if( isset(self::$types[$type]) ){
				$mimetype = self::$types[$type];
				return header("Content-Type: {$mimetype}");
			}else{
				return false;
			}
		}
	}
}