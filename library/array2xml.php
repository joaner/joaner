<?php
namespace library;

use \XMLWriter;

final class array2xml implements \super\runner
{
	const CHARSET = 'UTF-8';
	
	private $data;
	
	private $xml;
	
	
	public function __construct(array $data, $file=null)
	{
		$this->data = $data;
		$this->xml = new XMLWriter();
		$this->xml->openURI(is_null($file) ? 'php://output' : $file);
		$this->xml->startDocument('1.0', self::CHARSET);
	}
	
	public function set($indent)
	{
		$this->xml->setIndent(true);
		return $this->xml->setIndentString($indent);
	}
	
	public function run()
	{
		$this->write($this->data);
	}
	
	private function write($data)
	{
		foreach($data as $name=>$value){
			$this->xml->startElement($name);
			if( is_array($value) ){
				$this->write($value);
			}else{
				$this->xml->text($value);
			}
			$this->xml->endElement();
		}
	}
	
}