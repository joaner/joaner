<?php
namespace controller;

use \core\config;
use \library\array2xml, \library\httpMime;


final class index extends \super\controller
{
	public function run()
	{
		HttpMime::type('xml');
		
		$data = config::get();
		$data = array('config'=>$data);
		$convert = new array2xml($data);
		$convert->set("\t");
		$convert->run();
	}
}
