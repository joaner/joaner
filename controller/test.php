<?php
namespace controller;

use \core\cache;


final class test extends \super\controller
{
	public function run()
	{
		cache::init();
		$file = cache::getInstance('file');
		// $file::set('hello', $_SERVER);
		var_dump( $file::get('hello') );
	}
}
