<?php
namespace library;

use \Reflector;

final class parseDocComment
{
	private $docComment;
	private $docs = array();
	
	public function __construct($doc)
	{
		$this->docComment = $doc;
		$this->parse($this->docComment);
	}
	
	
	public function get($name=null)
	{
		if( ! is_null($name) ){
			if( isset($this->docs[$name]) ){
				return $this->docs[$name];
			}
		}else{
			return $this->docs;
		}
	}

	public function __get($name)
	{
		return $this->get($name);
	}
	
	private function parse($doc)
	{	
		$docs = explode("\n", $doc);
		foreach($docs as $line){
			$line = ltrim($line, " \t/*");
			if( strlen($line)<3 || $line{0} !== '@' ){
				continue;
			}
			$tab = strpos($line, "\t");
			$blank = strpos($line, " ");
			if( is_int($tab) && $blank > $tab ){
				$split = "\t";
			}elseif( is_int($blank) ){
				$split = ' ';
			}else{
				continue;
			}
			list($name, $value) = explode($split, $line, 2);
			$this->docs[ltrim($name, '@')] = $value;
		}
		
	}
}
