<?php
namespace library;

use \SimpleXMLElement;

final class xml2array
{
	public function __construct(&$content)
	{
		$this->xml = new SimpleXMLElement($content);
	}

	private function dom2array(SimpleXMLElement $parent)
	{
    	$array = array();

    	foreach ($parent as $name => $element) {
        	($node = & $array[$name])
            	&& (1 === count($node) ? $node = array($node) : 1)
            	&& $node = & $node[];

        	$node = $element->count() ? $this->dom2array($element) : trim($element);
    	}

    	return $array;
	}

	public function get()
	{
		return $this->dom2array($this->xml);
	}

}
