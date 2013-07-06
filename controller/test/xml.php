<?php
namespace controller\test;

use \library\xml2array;


/**
 * 你好，世界
 * @author xiaoai
 * @return boolean
 */
final class xml extends \super\controller
{
	public function run()
	{
		$file = BASE_DIR .'/config/main.xml';
		$content = file_get_contents($file);

		// $xml = new SimpleXMLElement($content);
		// var_dump($xml);

		$xml = new xml2array($content);
		$array = $xml->get();

		var_dump($array);
	}
}
