<?php
namespace super;

abstract class Exception extends \Exception
{
	public function __construct($message=null, $code=null)
	{
		if( ! is_null($message) )
		$message = htmlspecialchars($message);
		parent::__construct($message, $code);
	}
	
	public function __toString()
	{
		return var_export($this, true);
	}	
}