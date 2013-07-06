<?php
namespace controller\test;

use \library\reflection, \library\docComment;


/**
 * 你好，世界
 * @author xiaoai
 * @return boolean
 */
final class ref extends \super\controller
{
	public function run()
	{
		$ref = reflection::import($this);
		$doc = new docComment($ref->getDocDocument());
		
		$doc->get();
	}
}
